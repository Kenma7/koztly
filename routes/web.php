<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\KosanController;
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


// Landing page ambil data kosan dari controller
Route::get('/landing', [KosanController::class, 'landing'])->name('landing');


// Landing page ambil data kosan dari controller
Route::get('/landing', [KosanController::class, 'landing'])->name('landing');

// ----------------------
// Route kosan public (HAPUS DUPLICATE!)
// ----------------------
Route::get('/kosan', [KosanController::class, 'index'])->name('kosan.index');
Route::get('/kosan/{id}', [KosanController::class, 'show'])->name('kosan.show');

// ----------------------
// Auth User Routes
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('kosan.index');
    })->name('dashboard');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Profile (HAPUS DUPLICATE!)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ----------------------
    // BOOKING PROCESS (PUNYAMU - isalz)
    // ----------------------
    Route::get('/kosan/{id}/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/kosan/{id}/booking', [BookingController::class, 'store'])->name('booking.store');
   Route::get('/booking/{id}', [BookingController::class, 'show'])->name('user.booking.show');
    Route::post('/booking/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('booking.upload-bukti');
    Route::put('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

    // ----------------------
    // BOOKING HISTORY (PUNYANYA - pipahz)  
    // ----------------------
    Route::prefix('user')->name('user.')->group(function () {
        // History List
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
        
        // History Detail (NEW - ganti dari show)
        Route::get('/bookings/{id}', [BookingController::class, 'showHistory'])->name('bookings.detail');
        
        // Edit & Delete History
        Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
        Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('booking.update');
        Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
        
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

require __DIR__.'/auth.php';