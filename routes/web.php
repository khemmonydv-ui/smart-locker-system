<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Staff's Dashboard Route Mony

Route::get('/staff/dashboard', function () {
    return view('Staff.dashboard');
})->name('staff.dashboard');


