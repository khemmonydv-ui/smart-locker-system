<?php

use App\Http\Controllers\AuthContrller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerUsageController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/staff/dashboard', function () {
    return view('Staff.dashboard');  
})->name('staff.dashboard');

Route::get('/staff/user', function () {
    return view('/Staff.user');
})->name('staff.user');

Route::get('staff/locker-usage', function () {
    return view('/staff.locker-usage');
})->name('locker-usage');



// Users Dashboard Route Bora
Route:: get ('/users/dashboard', function() {
    return view('Users.dashboard');
})->name('users.dashboard');


Route::get('/users/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.details_locations');
Route::resource('locations', LocationController::class);
Route::get('/locations/{location}', [LocationController::class, 'show']);
