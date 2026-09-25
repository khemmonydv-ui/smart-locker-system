<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
});

// Staff's Dashboard Route Mony

Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');

// Users Dashboard Route Bora
Route:: get ('/users/dashboard', function() {
    return view('users.dashboard');
})->name('users.dashboard');


Route::get('/users/locations', [LocationController::class, 'index'])->name('locations.index');
