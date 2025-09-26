<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Route ke admin
Route::get('/admin', function () {
    return ('hello'); // tampilkan dashboard
});

