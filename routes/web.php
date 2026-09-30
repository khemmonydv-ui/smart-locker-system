<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\UserLocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Locations: list, details, lockers-at-a-location bora
Route::prefix('users/locations')->name('locations.')->group(function () {

    Route::get('/', [UserLocationController::class, 'index'])
        ->name('index');

    Route::get('/{location}', [UserLocationController::class, 'show'])
        ->name('details_locations');

    Route::get('/{location}/lockers', [UserLocationController::class, 'lockers'])
        ->name('lockers');

});
// bora route user dashboard
Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->name('users.dashboard'); 




































// Route login and register dalin
// Show login page 
Route::get('/login', [AuthController::class, 'showLogin']) ->name('login'); 
// Submit login 
Route::post('/login', [AuthController::class, 'login']) ->name('login.store'); 
// Logout 
Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');

// Staff register page 
Route::get('/register/staff', [AuthController::class, 'showStaffRegister']) ->name('register.staff'); 
// Store staff
Route::post('/register/staff', [AuthController::class, 'staffRegister']) ->name('register.staff.store'); 
// User register page 
Route::get('/register/user', [AuthController::class, 'showUserRegister']) ->name('register.user'); 
// Store user 
Route::post('/register/user', [AuthController::class, 'userRegister']) ->name('register.user.store');

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