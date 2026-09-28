<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationLockerController;
use App\Http\Controllers\LockerUsageController;
use App\Models\Location;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');

Route::get('/users/dashboard', function () {
    return view('users.dashboard', [
        'locations' => Location::orderBy('distance_km')->take(3)->get(),
    ]);
})->name('users.dashboard');

Route::get('/users/dashboard', [UserDashboardController::class, 'index'])
    ->name('users.dashboard');


    
Route::prefix('users/locations')->name('locations.')->group(function () {
    Route::get('/', [LocationController::class, 'index'])->name('index');
    Route::get('/{location}', [LocationController::class, 'show'])->name('details_locations');
    Route::get('/{location}/lockers', [LocationLockerController::class, 'index'])->name('lockers');
});

Route::prefix('my-locker')->name('locker.')->group(function () {
    Route::get('/', [LockerUsageController::class, 'show'])->name('show');
    Route::post('/{usage}/unlock', [LockerUsageController::class, 'unlock'])->name('unlock');
    Route::post('/{usage}/release', [LockerUsageController::class, 'release'])->name('release');
});
