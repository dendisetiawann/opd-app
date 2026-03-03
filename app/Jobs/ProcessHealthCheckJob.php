<?php

namespace App\Jobs;

use App\Models\HealthCheckBatch;
use App\Models\HealthCheckResult;
use App\Models\WebApp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessHealthCheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300; // 5 menit max execution
    public $tries = 3;     // Retry 3x kalau gagal
    
    protected string $batchId;
    protected ?int $opdId;
    protected int $chunkSize = 50; // 50 website per job (optimasi kecepatan)

    /**
     * Create a new job instance.
     */
    public function __construct(string $batchId, ?int $opdId = null)
    {
        $this->batchId = $batchId;
        $this->opdId = $opdId;
        $this->onQueue('health-check'); // Queue terpisah
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $batch = HealthCheckBatch::where('batch_id', $this->batchId)->first();
        
        if (!$batch) {
            Log::error("Health Check: Batch not found - {$this->batchId}");
            return;
        }

        // Skip domain yang bukan website
        $skipDomains = [
            'play.google.com', 'apps.apple.com', 'drive.google.com',
            'docs.google.com', 'dropbox.com', 'onedrive.live.com'
        ];

        // Build query
        $query = WebApp::with('opd')
            ->where('alamat_tautan', 'like', 'http%')
            ->where('jenis_aplikasi', 'like', '%web%');

        if ($this->opdId) {
            $query->where('opd_id', $this->opdId);
        }

        $allWebsites = $query->get()->filter(function ($app) use ($skipDomains) {
            $host = parse_url($app->alamat_tautan, PHP_URL_HOST);
            return !in_array($host, $skipDomains);
        })->values();

        // Update batch total
        $batch->update([
            'total' => $allWebsites->count(),
            'status' => 'running'
        ]);

        // Ambil yang sudah dicek
        $checkedIds = HealthCheckResult::where('batch_id', $this->batchId)
            ->pluck('web_app_id')
            ->toArray();

        // Filter yang belum dicek
        $unchecked = $allWebsites->reject(function ($app) use ($checkedIds) {
            return in_array($app->id, $checkedIds);
        });

        // Ambil chunk berikutnya
        $nextChunk = $unchecked->take($this->chunkSize);

        if ($nextChunk->isEmpty()) {
            // Semua sudah dicek
            $batch->update(['status' => 'completed']);
            Log::info("Health Check: Batch {$this->batchId} completed");
            return;
        }

        // Proses chunk ini
        $results = $this->checkUrlsConcurrently($nextChunk);

        foreach ($nextChunk as $index => $app) {
            $result = $results[$index] ?? [
                'http_code' => 0, 
                'status' => 'error', 
                'response_time' => 0
            ];

            HealthCheckResult::create([
                'batch_id'         => $this->batchId,
                'web_app_id'       => $app->id,
                'nama_web_app'     => $app->nama_web_app,
                'opd_nama'         => $app->opd->nama_opd ?? '-',
                'alamat_tautan'    => $app->alamat_tautan,
                'http_code'        => $result['http_code'],
                'status'           => $result['status'],
                'response_time_ms' => $result['response_time'],
            ]);
        }

        $newCompleted = count($checkedIds) + $nextChunk->count();
        $batch->update(['completed' => $newCompleted]);

        // Jika masih ada yang belum dicek, dispatch job lagi
        $remaining = $unchecked->count() - $nextChunk->count();
        
        if ($remaining > 0) {
            // Delay 1 detik antar job biar tidak overwhelm server
            self::dispatch($this->batchId, $this->opdId)
                ->delay(now()->addSecond())
                ->onQueue('health-check');
        } else {
            $batch->update(['status' => 'completed']);
            Log::info("Health Check: Batch {$this->batchId} completed - {$newCompleted} websites");
        }
    }

    /**
     * Check multiple URLs concurrently using curl_multi
     */
    private function checkUrlsConcurrently($apps): array
    {
        $multiHandle = curl_multi_init();
        $handles = [];
        $startTimes = [];

        foreach ($apps as $index => $app) {
            $ch = curl_init($app->alamat_tautan);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);            // 5 detik timeout (cepat)
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);     // 3 detik koneksi
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Production: true
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; HealthCheck/1.0)');
            curl_setopt($ch, CURLOPT_HEADER, true);

            curl_multi_add_handle($multiHandle, $ch);
            $handles[$index] = $ch;
            $startTimes[$index] = microtime(true);
        }

        // Execute all requests simultaneously
        $running = null;
        do {
            curl_multi_exec($multiHandle, $running);
            if ($running > 0) {
                curl_multi_select($multiHandle, 0.1);
            }
        } while ($running > 0);

        // Collect results
        $results = [];
        foreach ($handles as $index => $ch) {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $responseTime = round((microtime(true) - $startTimes[$index]) * 1000);
            $error = curl_error($ch);

            // Tentukan status
            $status = 'offline';
            if ($httpCode >= 200 && $httpCode < 400) {
                $status = $responseTime > 2000 ? 'slow' : 'online';
            }

            $results[$index] = [
                'http_code'     => $httpCode,
                'status'        => $status,
                'response_time' => $responseTime,
                'error'         => $error,
            ];

            curl_multi_remove_handle($multiHandle, $ch);
            curl_close($ch);
        }

        curl_multi_close($multiHandle);

        return $results;
    }

    /**
     * Handle job failure
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("Health Check Job Failed: " . $exception->getMessage());
        
        $batch = HealthCheckBatch::where('batch_id', $this->batchId)->first();
        if ($batch) {
            $batch->update(['status' => 'failed']);
        }
    }
}
