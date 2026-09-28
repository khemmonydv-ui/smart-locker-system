<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationLockerController;
use App\Http\Controllers\LockerUsageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Staff's Dashboard Route Mony

Route::get('/staff/dashboard', function () {
    return view('Staff.dashboard');
})->name('staff.dashboard');




//bora //
Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->name('users.dashboard');

Route::get('/users/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.details_locations');
Route::get('/locations/{location}/lockers', [LocationLockerController::class, 'index'])->name('locations.lockers');

Route::prefix('my-locker')->name('locker.')->group(function () {
    Route::get('/', [LockerUsageController::class, 'show'])->name('show');
    Route::post('/{usage}/unlock', [LockerUsageController::class, 'unlock'])->name('unlock');
    Route::post('/{usage}/release', [LockerUsageController::class, 'release'])->name('release');
});
