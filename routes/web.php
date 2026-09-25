<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Staff's Dashboard Route Mony

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

