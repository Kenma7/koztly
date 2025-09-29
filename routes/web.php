<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/koztly', function () {
    return view('loading.loading');
});

Route::get('/landing', function () {
    return view('landing.index');
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','rolecheck:admin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
