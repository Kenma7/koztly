<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\KosanController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ----------------------
// Landing / Loading
// ----------------------
Route::get('', function () {
     return view('loading.loading');
})->name('home');

Route::get('/landing', function () {
    return view('landing.index');
})->name('landing');

// ----------------------
// Route kosan public
// ----------------------
Route::get('/kosan', [KosanController::class, 'index'])->name('kosan.index');
Route::get('/kosan/{id}', [KosanController::class, 'show'])->name('kosan.show');

// ----------------------
// Auth User Routes
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ----------------------
    // BOOKING PROCESS (Fitur Kamu)
    // ----------------------
    Route::get('/kosan/{id}/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/kosan/{id}/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('booking.upload-bukti');
    Route::put('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

    // ----------------------
    // BOOKING HISTORY (Fitur Teman Kamu)
    // ----------------------
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');           // bookings.index
        Route::get('/{id}/edit', [BookingController::class, 'edit'])->name('edit');    // bookings.edit
        Route::put('/{id}', [BookingController::class, 'update'])->name('update');     // bookings.update
        Route::delete('/{id}', [BookingController::class, 'destroy'])->name('destroy'); // bookings.destroy
    });
});

// ----------------------
// Admin Routes
// ----------------------
Route::prefix('admin')->name('admin.')->middleware(['auth', 'rolecheck:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
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