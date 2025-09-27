<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Route admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kost', App\Http\Controllers\Admin\KostController::class);
    Route::resource('kamar', App\Http\Controllers\Admin\KamarController::class);
    Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
});
