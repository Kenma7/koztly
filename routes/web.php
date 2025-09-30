<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\KosanController;
use Illuminate\Support\Facades\Auth;

// Landing / Welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('home'); // ini manggil home.blade.php
})->name('dashboard');

// ADMIN
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [App\Http\Controllers\Admin\DashboardController::class, 'logout'])->name('logout');

    Route::resource('kosan', App\Http\Controllers\Admin\KostController::class);
    Route::resource('kamar', App\Http\Controllers\Admin\KamarController::class);
    Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
});

// USER
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard');

    Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::get('/{id}', [BookingController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [BookingController::class, 'edit'])->name('edit'); // <--- ini
    Route::put('/{id}', [BookingController::class, 'update'])->name('update'); // <--- ini
    Route::delete('/{id}', [BookingController::class, 'destroy'])->name('destroy'); // <-- ini
    Route::post('/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('upload-bukti');
    Route::put('/{id}/cancel', [BookingController::class, 'cancel'])->name('cancel');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
});

// Auth routes
require __DIR__.'/auth.php';

// Kosan Routes
Route::get('/kosan', [KosanController::class, 'index'])->name('kosan.index');
Route::get('/kosan/{id}', [KosanController::class, 'show'])->name('kosan.show');
Route::get('/kosan/{id}/booking', [KosanController::class, 'bookingForm'])->name('kosan.booking.form');
Route::post('/kosan/{id}/booking', [KosanController::class, 'bookingSubmit'])->name('kosan.booking.submit');

// Sidebar toggle
Route::post('/sidebar/toggle', function (Request $request) {
    session(['sidebar_minimized' => $request->minimized]);
    return response()->json(['success' => true]);
})->name('sidebar.toggle');


// use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\User\BookingController;
// use App\Http\Controllers\KosanController;
// use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

// // Landing / Welcome
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::get('/dashboard', function () {
//     return view('home'); // ini manggil home.blade.php
// })->name('dashboard');

// // ----------------------
// // ADMIN
// // ----------------------
// Route::prefix('admin')->name('admin.')->middleware(['auth','rolecheck:admin'])->group(function () {
//     // Dashboard Admin
//     Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
//     Route::post('/logout', [AdminDashboard::class, 'logout'])->name('logout');

//     // Resource Routes
//     Route::resource('kosan', App\Http\Controllers\Admin\KostController::class);
//     Route::resource('kamar', App\Http\Controllers\Admin\KamarController::class);
//     Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
// });

// // ----------------------
// // USER
// // ----------------------
// Route::prefix('user')->name('user.')->middleware(['auth','rolecheck:user'])->group(function () {
//     // Dashboard user
//     Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard');

//     // Booking
//     Route::prefix('booking')->name('booking.')->group(function () {
//         Route::get('/', [BookingController::class, 'index'])->name('index');
//         Route::get('/{id}', [BookingController::class, 'show'])->name('show');
//         Route::post('/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('upload-bukti');
//         Route::put('/{id}/cancel', [BookingController::class, 'cancel'])->name('cancel');
//     });

//     // Profile
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');

//     // Logout User
//     Route::post('/logout', function () {
//         Auth::logout();
//         return redirect()->route('home');
//     })->name('logout');
// });

// // ----------------------
// // KOSAN (Public)
// // ----------------------
// Route::get('/kosan', [KosanController::class, 'index'])->name('kosan.index');
// Route::get('/kosan/{id}', [KosanController::class, 'show'])->name('kosan.show');
// Route::get('/kosan/{id}/booking', [KosanController::class, 'bookingForm'])->name('kosan.booking.form');
// Route::post('/kosan/{id}/booking', [KosanController::class, 'bookingSubmit'])->name('kosan.booking.submit');

// // ----------------------
// // Sidebar toggle
// // ----------------------
// Route::post('/sidebar/toggle', function (Request $request) {
//     session(['sidebar_minimized' => $request->minimized]);
//     return response()->json(['success' => true]);
// })->name('sidebar.toggle');

// // ----------------------
// // Auth scaffolding
// // ----------------------
// require __DIR__.'/auth.php';
