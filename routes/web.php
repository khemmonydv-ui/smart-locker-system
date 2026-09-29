<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationLockerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerDetailController;
use App\Http\Controllers\YourLocker;


Route::get('/', function () {
    return view('welcome');
});

// Admin pages: URLs start with /admin
Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('lockers', LockerController::class);
});

// User pages: choose a locker, create PIN, unlock, release
Route::prefix('lockerdetail')->group(function () {
    Route::get('/', [LockerDetailController::class, 'index'])->name('lockerdetail.index');
    Route::get('/location/{location}', [LockerDetailController::class, 'location'])->name('lockerdetail.location');

    Route::post('/use', [YourLocker::class, 'store'])->name('locker.use');
    Route::get('/yourlocker/{code}', [YourLocker::class, 'show'])->name('locker.show');
    Route::post('/yourlocker/{code}/unlock', [YourLocker::class, 'unlock'])->name('locker.unlock');
    Route::post('/yourlocker/{code}/release', [YourLocker::class, 'release'])->name('locker.release');
});
