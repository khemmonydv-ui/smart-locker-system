<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationLockerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LockerController;
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





































Route::get('/login', function () {
    return view('login.index');
})->name('login');

// route user dalin
Route::group(['prefix'=>'user','as' => 'users.'], function(){
    // Login page
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // Login store
    Route::post('/login', [AuthController::class, 'login']);
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');

Route::get('/dashboard', function () {
    return view('staff.dashboard');
})->name('dashboard');

// locations route group dalin
Route::group(['prefix' => 'locations', 'as' => 'locations.'], function () {

    // Location list
    Route::get('/', [LocationController::class, 'index'
    ])->name('index');

    // Add location
    Route::post('/', [LocationController::class, 'store'
    ])->name('store');

    // Edit location
    Route::get('/{location}/edit', [LocationController::class, 'edit'
    ])->name('edit');

     // Update location
    Route::put('/{location}', [LocationController::class, 'update'
    ])->name('update');

    // Delete location
    Route::delete('/{location}', [LocationController::class, 'destroy'
    ])->name('destroy');

});

// lockers route group dalin
Route::group(['prefix' => 'lockers', 'as' => 'lockers.'], function () {

    // Locker list
    Route::get('/', [LockerController::class, 'index'])
        ->name('index');

    // Add locker
    Route::post('/', [LockerController::class, 'store'])
        ->name('store');

     // Edit locker
    Route::get('/{locker}/edit', [LockerController::class, 'edit'
    ])->name('edit');

     // Update locker
    Route::put('/{locker}', [LockerController::class, 'update'
    ])->name('update');

});


Route::get('/locker-usage', function () {
    return view('staff.locker-usage');
})->name('locker-usage');

Route::get('/maintenance', function () {
    return view('staff.maintenance');
})->name('maintenance');
