<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\KosanController;
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

// ----------------------
// Dashboard user
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // user dashboard
    })->name('dashboard');

    // Profile user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout user
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Booking user
    Route::prefix('user/booking')->name('user.booking.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/{id}', [BookingController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BookingController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BookingController::class, 'update'])->name('update');
        Route::delete('/{id}', [BookingController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('upload-bukti');
        Route::put('/{id}/cancel', [BookingController::class, 'cancel'])->name('cancel');
    });
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
// Kosan Public
// ----------------------
Route::get('/kosan', [KosanController::class, 'index'])->name('kosan.index');
Route::get('/kosan/{id}', [KosanController::class, 'show'])->name('kosan.show');
Route::get('/kosan/{id}/booking', [KosanController::class, 'bookingForm'])->name('kosan.booking.form');
Route::post('/kosan/{id}/booking', [KosanController::class, 'bookingSubmit'])->name('kosan.booking.submit');

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
