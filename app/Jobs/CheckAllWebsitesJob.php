<?php

namespace App\Jobs;

use App\Models\HealthCheckBatch;
use App\Models\HealthCheckResult;
use App\Models\WebApp;

class CheckAllWebsitesJob
{
    /**
     * Run the next batch of URLs for a given batch.
     * Called by the polling endpoint — checks 10 URLs per call.
     * Returns progress info.
     */
    public static function checkNextBatch(string $batchId): array
    {
        $batch = HealthCheckBatch::where('batch_id', $batchId)->first();
        if (!$batch) {
            return ['error' => 'Batch not found'];
        }

        // If already done or failed, just return status
        if (in_array($batch->status, ['completed', 'failed'])) {
            return [
                'batch_id'  => $batch->batch_id,
                'total'     => $batch->total,
                'completed' => $batch->completed,
                'status'    => $batch->status,
                'percent'   => $batch->progress_percent,
            ];
        }

        $skipDomains = [
            'play.google.com', 'apps.apple.com', 'drive.google.com',
            'docs.google.com', 'dropbox.com', 'onedrive.live.com'
        ];

        // Build query for websites
        $query = WebApp::with('opd')
            ->where('alamat_tautan', 'like', 'http%')
            ->where('jenis_aplikasi', 'like', '%web%');

        if ($batch->scope !== 'all') {
            $query->where('opd_id', (int) $batch->scope);
        }

        $allWebsites = $query->get()->filter(function ($app) use ($skipDomains) {
            $host = parse_url($app->alamat_tautan, PHP_URL_HOST);
            return !in_array($host, $skipDomains);
        })->values();

        // First call: set total and status
        if ($batch->status === 'pending') {
            $batch->update([
                'total'  => $allWebsites->count(),
                'status' => 'running',
            ]);
        }

        // Get IDs already checked
        $checkedIds = HealthCheckResult::where('batch_id', $batchId)
            ->pluck('web_app_id')
            ->toArray();

        // Get next batch of unchecked websites
        $unchecked = $allWebsites->filter(fn($app) => !in_array($app->id, $checkedIds));

        if ($unchecked->isEmpty()) {
            // All done!
            $batch->update(['status' => 'completed', 'completed' => $allWebsites->count()]);
            return [
                'batch_id'  => $batch->batch_id,
                'total'     => $allWebsites->count(),
                'completed' => $allWebsites->count(),
                'status'    => 'completed',
                'percent'   => 100,
            ];
        }

        // Take next 10 and check them concurrently
        $nextBatch = $unchecked->take(10);
        $results = self::checkUrlsConcurrently($nextBatch);

        foreach ($nextBatch as $index => $app) {
            $result = $results[$index] ?? ['http_code' => 0, 'status' => 'error', 'response_time' => 0];

            HealthCheckResult::create([
                'batch_id'         => $batchId,
                'web_app_id'       => $app->id,
                'nama_web_app'     => $app->nama_web_app,
                'nama_opd'         => $app->opd->nama_opd ?? '-',
                'url'              => $app->alamat_tautan,
                'http_code'        => $result['http_code'],
                'status'           => $result['status'],
                'response_time_ms' => $result['response_time'],
            ]);
        }

        $newCompleted = count($checkedIds) + $nextBatch->count();
        $total = $allWebsites->count();
        $isDone = $newCompleted >= $total;

        $batch->update([
            'completed' => $newCompleted,
            'status'    => $isDone ? 'completed' : 'running',
        ]);

        return [
            'batch_id'  => $batch->batch_id,
            'total'     => $total,
            'completed' => $newCompleted,
            'status'    => $isDone ? 'completed' : 'running',
            'percent'   => $total > 0 ? round(($newCompleted / $total) * 100) : 0,
        ];
    }

    /**
     * Check multiple URLs concurrently using curl_multi.
     */
    private static function checkUrlsConcurrently($apps): array
    {
        $multiHandle = curl_multi_init();
        $handles = [];
        $startTimes = [];

        foreach ($apps as $index => $app) {
            $ch = curl_init($app->alamat_tautan);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; HealthCheck/1.0)');

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

            $status = 'offline';
            if ($httpCode >= 200 && $httpCode < 400) {
                $status = $responseTime > 2000 ? 'slow' : 'online';
            }

            $results[$index] = [
                'http_code'     => $httpCode,
                'status'        => $status,
                'response_time' => $responseTime,
            ];

            curl_multi_remove_handle($multiHandle, $ch);
            curl_close($ch);
        }

        curl_multi_close($multiHandle);

        return $results;
    }
}
