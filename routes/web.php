<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;

// ----------------------
// Landing / Loading
// ----------------------
Route::get('', function () {
     return view('loading.loading'); // resources/views/loading/loading.blade.php
})->name('home');

Route::get('/landing', function () {
    return view('landing.index'); // resources/views/landing/index.blade.php
})->name('landing');

//------------------
//Route kosan public
//------------------
Route::get('/kosan', [KosanController::class, 'index'])->name('kosan.index');
Route::get('/kosan/{id}', [KosanController::class, 'show'])->name('kosan.show');
//Route::get('/kosan/{id}/booking', [KosanController::class, 'bookingForm'])->name('kosan.booking.form');
//Route::post('/kosan/{id}/booking', [KosanController::class, 'bookingSubmit'])->name('kosan.booking.submit');


// ----------------------
// Dashboard user
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // user dashboard
    })->name('dashboard');

    // Logout user
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Profile user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


//Route booking
Route::get('/kosan/{id}/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/kosan/{id}/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/kosan/{id}/booking/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
//Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
Route::post('/booking/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('booking.upload-bukti');
Route::put('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
});

// ----------------------
// Dashboard Admin
// ----------------------
Route::prefix('admin')->name('admin.')->middleware(['auth', 'rolecheck:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Logout admin → gunakan controller AuthenticatedSessionController
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::resource('kosan', App\Http\Controllers\Admin\KostController::class);
    Route::resource('kamar', App\Http\Controllers\Admin\KamarController::class);
    Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
});

// ----------------------
// Sidebar toggle
// ----------------------
Route::post('/sidebar/toggle', function (Request $request) {
    session(['sidebar_minimized' => $request->minimized]);
    return response()->json(['success' => true]);
})->name('sidebar.toggle');

// ----------------------
// Auth routes
// ----------------------
require __DIR__.'/auth.php';