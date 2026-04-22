<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuditLogController;
use App\Http\Controllers\AdminSiteEditorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechOptionController;
use App\Http\Controllers\WebAppController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// User Dashboard & Web Apps Routes
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        $webApps = auth()->user()->webApps()->with('opd')->latest()->take(5)->get();
        $totalApps = auth()->user()->webApps()->count();
        return view('dashboard', compact('webApps', 'totalApps'));
    })->name('dashboard');
    
    Route::resource('web-apps', WebAppController::class);
    Route::get('/api/tech-options/{kategori}', [TechOptionController::class, 'index'])->name('api.tech-options');

    // User Monitoring Routes (scoped to user's OPD)
    Route::prefix('monitoring')->name('monitoring.')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserMonitoringController::class, 'index'])->name('index');
        Route::get('/health-check', [\App\Http\Controllers\UserMonitoringController::class, 'healthCheck'])->name('health-check');
        Route::post('/health-check/check-url', [\App\Http\Controllers\UserMonitoringController::class, 'checkUrl'])->name('health-check.check-url');
        Route::post('/health-check/bulk-start', [\App\Http\Controllers\UserMonitoringController::class, 'startBulkCheck'])->name('health-check.bulk-start');
        Route::get('/health-check/bulk-progress/{batchId}', [\App\Http\Controllers\UserMonitoringController::class, 'getBulkProgress'])->name('health-check.bulk-progress');
        Route::get('/health-check/bulk-results/{batchId}', [\App\Http\Controllers\UserMonitoringController::class, 'getBulkResults'])->name('health-check.bulk-results');
        Route::get('/health-check/export/{batchId}', [\App\Http\Controllers\UserMonitoringController::class, 'exportHealthCheck'])->name('health-check.export');
        Route::get('/export-opd', [\App\Http\Controllers\UserMonitoringController::class, 'exportOpdApps'])->name('export-opd');
        Route::get('/apps-by-filter', [\App\Http\Controllers\UserMonitoringController::class, 'getAppsByFilter'])->name('apps-by-filter');
        Route::get('/version-breakdown', [\App\Http\Controllers\UserMonitoringController::class, 'getVersionBreakdown'])->name('version-breakdown');
        Route::get('/dbms-version-breakdown', [\App\Http\Controllers\UserMonitoringController::class, 'getDbmsVersionBreakdown'])->name('dbms-version-breakdown');
        Route::get('/library-version-breakdown', [\App\Http\Controllers\UserMonitoringController::class, 'getLibraryVersionBreakdown'])->name('library-version-breakdown');
        Route::get('/opd/{opd}/apps', [\App\Http\Controllers\UserMonitoringController::class, 'getOpdApps'])->name('opd.apps');
    });
});

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/web-apps', [AdminController::class, 'index'])->name('web-apps.index');
    Route::get('/web-apps/{webApp}', [AdminController::class, 'show'])->name('web-apps.show');
    
    // User Management
    Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/opd/search', [\App\Http\Controllers\AdminUserController::class, 'searchOpd'])->name('opd.search');
    Route::get('/users/{user}/created', [\App\Http\Controllers\AdminUserController::class, 'created'])->name('users.created');
    Route::get('/users/{user}/export-pdf', [\App\Http\Controllers\AdminUserController::class, 'exportPdf'])->name('users.export-pdf');
    Route::get('/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/reset-password', [\App\Http\Controllers\AdminUserController::class, 'resetPassword'])->name('users.reset-password');
    Route::post('/users/{user}/update-email', [\App\Http\Controllers\AdminUserController::class, 'updateEmail'])->name('users.update-email');

    // Monitoring Routes
    Route::prefix('monitoring')->name('monitoring.')->group(function () {
        Route::get('/', [\App\Http\Controllers\AdminMonitoringController::class, 'index'])->name('index');
        Route::get('/teknologi', [\App\Http\Controllers\AdminMonitoringController::class, 'teknologi'])->name('teknologi');
        Route::get('/repository', [\App\Http\Controllers\AdminMonitoringController::class, 'repository'])->name('repository');
        Route::get('/database', [\App\Http\Controllers\AdminMonitoringController::class, 'database'])->name('database');
        Route::get('/opd', [\App\Http\Controllers\AdminMonitoringController::class, 'opd'])->name('opd');
        Route::get('/backup', [\App\Http\Controllers\AdminMonitoringController::class, 'backup'])->name('backup');
        Route::get('/health-check', [\App\Http\Controllers\AdminMonitoringController::class, 'healthCheck'])->name('health-check');
        Route::post('/health-check/check-url', [\App\Http\Controllers\AdminMonitoringController::class, 'checkUrl'])->name('health-check.check-url');
        Route::post('/health-check/bulk-start', [\App\Http\Controllers\AdminMonitoringController::class, 'startBulkCheck'])->name('health-check.bulk-start');
        Route::get('/health-check/bulk-progress/{batchId}', [\App\Http\Controllers\AdminMonitoringController::class, 'getBulkProgress'])->name('health-check.bulk-progress');
        Route::get('/health-check/bulk-results/{batchId}', [\App\Http\Controllers\AdminMonitoringController::class, 'getBulkResults'])->name('health-check.bulk-results');
        Route::get('/health-check/export/{batchId}', [\App\Http\Controllers\AdminMonitoringController::class, 'exportHealthCheck'])->name('health-check.export');
        Route::post('/health-check/export-opd', [\App\Http\Controllers\AdminMonitoringController::class, 'exportHealthCheckOpd'])->name('health-check.export-opd');
        Route::get('/opd/export-all', [\App\Http\Controllers\AdminMonitoringController::class, 'exportAllOpd'])->name('opd.export-all');
        Route::get('/opd/{opd}/export', [\App\Http\Controllers\AdminMonitoringController::class, 'exportOpdApps'])->name('opd.export');
        Route::get('/apps-by-filter', [\App\Http\Controllers\AdminMonitoringController::class, 'getAppsByFilter'])->name('apps-by-filter');
        Route::get('/version-breakdown', [\App\Http\Controllers\AdminMonitoringController::class, 'getVersionBreakdown'])->name('version-breakdown');
        Route::get('/dbms-version-breakdown', [\App\Http\Controllers\AdminMonitoringController::class, 'getDbmsVersionBreakdown'])->name('dbms-version-breakdown');
        Route::get('/library-version-breakdown', [\App\Http\Controllers\AdminMonitoringController::class, 'getLibraryVersionBreakdown'])->name('library-version-breakdown');
    });
    
    // OPD Detail API
    Route::get('/opd/{opd}/apps', [\App\Http\Controllers\AdminMonitoringController::class, 'getOpdApps']);

    // Site Editor
    Route::get('/site-editor', [AdminSiteEditorController::class, 'index'])->name('site-editor.index');
    Route::put('/site-editor', [AdminSiteEditorController::class, 'update'])->name('site-editor.update');
    Route::post('/site-editor/upload-image', [AdminSiteEditorController::class, 'uploadImage'])->name('site-editor.upload-image');

    // Audit Log
    Route::get('/audit-log', [AdminAuditLogController::class, 'index'])->name('audit-log.index');
});

// Site Editor Preview (outside auth middleware so iframe can load without redirect)
Route::get('/admin/site-editor/preview/{page}', [AdminSiteEditorController::class, 'preview'])->name('admin.site-editor.preview');

// Profile Routes (accessible by all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/email/verify', [ProfileController::class, 'verifyEmailUpdate'])->name('profile.email.verify');
    Route::post('/profile/email/resend', [ProfileController::class, 'resendEmailOtp'])->name('profile.email.resend');
    Route::delete('/profile/email/cancel', [ProfileController::class, 'cancelEmailUpdate'])->name('profile.email.cancel');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'removePhoto'])->name('profile.photo.remove');
});

require __DIR__.'/auth.php';
