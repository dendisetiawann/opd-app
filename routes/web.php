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
});

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/web-apps', [AdminController::class, 'index'])->name('web-apps.index');
    Route::get('/web-apps/{webApp}', [AdminController::class, 'show'])->name('web-apps.show');
    
    // User Management
    Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/reset-password', [\App\Http\Controllers\AdminUserController::class, 'resetPassword'])->name('users.reset-password');
});

// Profile Routes (accessible by all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
