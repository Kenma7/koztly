<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosanController;

Route::get('/', function () {
    return view('welcome');
});


//Route admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kost', App\Http\Controllers\Admin\KostController::class);
    Route::resource('kamar', App\Http\Controllers\Admin\KamarController::class);
    Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
});
<<<<<<< HEAD

//Route kosan
Route::get('/kosan', [KosanController::class, 'index'])->name('kosan.index');
Route::get('/kosan/{id}', [KosanController::class, 'show'])->name('kosan.show');
Route::get('/kosan/{id}/booking', [KosanController::class, 'bookingForm'])->name('kosan.booking.form');
Route::post('/kosan/{id}/booking', [KosanController::class, 'bookingSubmit'])->name('kosan.booking.submit');
=======
>>>>>>> main
