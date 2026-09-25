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
Route::group(['prefix' => '/lockerdetail', 'as' => 'lockerdetail.'], function () {
    Route::get('/', function () {
        return view('lockerdetail.index', [
            'facility' => 'Riverside Sports Center',
            'lockers' => [
                ['code' => 'A01', 'status' => 'available'],
                ['code' => 'A02', 'status' => 'in_use'],
                ['code' => 'A03', 'status' => 'maintenance'],
                ['code' => 'B01', 'status' => 'available'],
                ['code' => 'B02', 'status' => 'in_use'],
                ['code' => 'B03', 'status' => 'maintenance'],
                ['code' => 'C01', 'status' => 'available'],
                ['code' => 'C02', 'status' => 'in_use'],
                ['code' => 'C03', 'status' => 'maintenance'],
                ['code' => 'D01', 'status' => 'available'],
                ['code' => 'D02', 'status' => 'in_use'],
                ['code' => 'D03', 'status' => 'maintenance'],
            ],
        ]);
    })->name('index');
}); 