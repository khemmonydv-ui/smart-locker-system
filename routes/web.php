<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Staff's Dashboard Route Mony

Route::get('/staff/dashboard', function () {
    return view('Staff.dashboard');
})->name('staff.dashboard');

// Users Dashboard Route Bora
Route:: get ('/users/dashboard', function() {
    return view('users.dashboard');
})->name('users.dashboard');

