<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
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

    // User Monitoring Routes (scoped to user's OPD)
    Route::prefix('monitoring')->name('monitoring.')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserMonitoringController::class, 'index'])->name('index');
        Route::get('/health-check', [\App\Http\Controllers\UserMonitoringController::class, 'healthCheck'])->name('health-check');
        Route::post('/health-check/check-url', [\App\Http\Controllers\UserMonitoringController::class, 'checkUrl'])->name('health-check.check-url');
        Route::get('/apps-by-filter', [\App\Http\Controllers\UserMonitoringController::class, 'getAppsByFilter'])->name('apps-by-filter');
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
        Route::get('/user-analytics', [\App\Http\Controllers\AdminMonitoringController::class, 'userAnalytics'])->name('user-analytics');
        Route::get('/laporan', [\App\Http\Controllers\AdminMonitoringController::class, 'laporan'])->name('laporan');
        Route::get('/laporan/export-pdf', [\App\Http\Controllers\AdminMonitoringController::class, 'exportPdf'])->name('laporan.export-pdf');
        Route::get('/laporan/export-excel', [\App\Http\Controllers\AdminMonitoringController::class, 'exportExcel'])->name('laporan.export-excel');
        Route::get('/health-check', [\App\Http\Controllers\AdminMonitoringController::class, 'healthCheck'])->name('health-check');
        Route::post('/health-check/check-url', [\App\Http\Controllers\AdminMonitoringController::class, 'checkUrl'])->name('health-check.check-url');
        Route::get('/apps-by-filter', [\App\Http\Controllers\AdminMonitoringController::class, 'getAppsByFilter'])->name('apps-by-filter');
    });
});

// Profile Routes (accessible by all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'removePhoto'])->name('profile.photo.remove');
});

require __DIR__.'/auth.php';
