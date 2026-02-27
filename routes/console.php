<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/**
 * Schedule Health Check Queue Processing
 * 
 * Cara setup di server (cPanel/Cron):
 * * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
 * 
 * Atau manual jalankan:
 * php artisan queue:work --queue=health-check --stop-when-empty
 */

// Proses queue health-check tiap menit
Schedule::command('queue:work --queue=health-check --stop-when-empty --max-time=55')
    ->everyMinute()
    ->withoutOverlapping()
    ->onOneServer()
    ->appendOutputTo(storage_path('logs/health-check-queue.log'));

// Auto health check harian jam 9 pagi (opsional)
// Uncomment kalau mau check otomatis tiap hari tanpa klik manual
/*
Schedule::call(function () {
    $batchId = \Illuminate\Support\Str::uuid()->toString();
    
    \App\Models\HealthCheckBatch::create([
        'batch_id' => $batchId,
        'total' => 0,
        'completed' => 0,
        'status' => 'pending',
        'user_id' => null,
        'scope' => 'all',
    ]);
    
    \App\Jobs\ProcessHealthCheckJob::dispatch($batchId)->onQueue('health-check');
    
    \Illuminate\Support\Facades\Log::info("Auto health check scheduled: {$batchId}");
})->dailyAt('09:00')->name('auto-health-check');
*/
