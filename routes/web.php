<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route kamu
Route::get('/koztly', function () {
    return view('loading.loading');
});

Route::get('/landing', function () {
    return view('landing.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','rolecheck:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Logout Admin
    Route::post('/logout', [App\Http\Controllers\Admin\DashboardController::class, 'logout'])->name('logout');
    
    // Resource Routes
    Route::resource('kosan', App\Http\Controllers\Admin\KostController::class);
    Route::resource('kamar', App\Http\Controllers\Admin\KamarController::class);
    Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
});
