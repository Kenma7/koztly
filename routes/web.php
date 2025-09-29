<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BookingController;
use App\Models\Booking;

Route::get('/', function () {
    return view('welcome');
});

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

/*
|--------------------------------------------------------------------------
| Booking Routes
|--------------------------------------------------------------------------
*/

Route::prefix('user')->name('user.')->group(function () {
    
    // Dashboard user
    Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard');

    // Booking Routes
    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index'); // riwayat booking
        Route::get('/{id}', [BookingController::class, 'show'])->name('show');
        Route::post('/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('upload-bukti');
        Route::put('/{id}/cancel', [BookingController::class, 'cancel'])->name('cancel');
    });

    // Profile user
    Route::get('/profile', [BookingController::class, 'index'])->name('profile');

    // Logout
    Route::post('/logout', [App\Http\Controllers\Admin\DashboardController::class, 'logout'])->name('logout');
});
