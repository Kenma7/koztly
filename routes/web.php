<?php

use illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosanController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('home'); // ini manggil home.blade.php
})->name('dashboard');

//Route admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kost', App\Http\Controllers\Admin\KostController::class);
    Route::resource('kamar', App\Http\Controllers\Admin\KamarController::class);
    Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
});

//Route kosan
Route::get('/kosan', [KosanController::class, 'index'])->name('kosan.index');
Route::get('/kosan/{id}', [KosanController::class, 'show'])->name('kosan.show');
Route::get('/kosan/{id}/booking', [KosanController::class, 'bookingForm'])->name('kosan.booking.form');
Route::post('/kosan/{id}/booking', [KosanController::class, 'bookingSubmit'])->name('kosan.booking.submit');

//sidebar toggle
// routes/web.php
Route::post('/sidebar/toggle', function (Request $request) {
    session(['sidebar_minimized' => $request->minimized]);
    return response()->json(['success' => true]);
})->name('sidebar.toggle');