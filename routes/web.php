<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LockerDetail;


Route::get('/', function () {
    return view('welcome');
});

// Staff's Dashboard Route Mony

Route::get('/staff/dashboard', function () {
    return view('Staff.dashboard');
})->name('staff.dashboard');

// Users Dashboard Route Bora
Route:: get ('/users/dashboard', function() {
    return view('Users.dashboard');
})->name('users.dashboard');

//locker detail pech
Route::group(['prefix'=>'/lockerdetail','as'=>'lockerdetail.'], function(){
     Route::get('/', [LockerDetail::class, 'index'])->name('index');
});