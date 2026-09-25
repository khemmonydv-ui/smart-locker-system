<?php

use App\Http\Controllers\AuthContrller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');



Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
