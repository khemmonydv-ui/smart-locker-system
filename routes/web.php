<?php

use App\Http\Controllers\AuthContrller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerUsageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login.index');
})->name('login');

// route user dalin
Route::group(['prefix' => 'user', 'as' => 'users.'], function () {
    // Login page
    Route::get('/login', [AuthContrller::class, 'showLogin'])->name('login');
    // Login store
    Route::post('/login', [AuthContrller::class, 'login']);
    // Logout
    Route::post('/logout', [AuthContrller::class, 'logout'])->name('logout');
});

Route::get('/staff/locker-usage', [LockerUsageController::class, 'index'])->name('staff.locker-usage');

Route::get('/staff/dashboard', function () {
    return view('Staff.dashboard');
})->name('staff.dashboard');
