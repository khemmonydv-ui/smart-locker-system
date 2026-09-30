<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerDetailController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Users dashboard (Bora) - must stay ABOVE Route::resource('users') or it is caught by users/{user}
// Locations: list, details, lockers-at-a-location (Bora)
Route::prefix('users/locations')->name('locations.')->group(function () {

    Route::get('/', [UserLocationController::class, 'index'])
        ->name('index');

    Route::get('/{location}', [UserLocationController::class, 'show'])
        ->name('details_locations');

    Route::get('/{location}/lockers', [UserLocationController::class, 'lockers'])
        ->name('lockers');

});

// Bora: user dashboard
Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->name('users.dashboard');

// Admin CRUD (resource already gives index/create/store/show/edit/update/destroy)
Route::resource('users', UserController::class);
Route::resource('locations', LocationController::class);
Route::resource('lockers', LockerController::class);

// Maintenance
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
Route::patch('/maintenance/{maintenance}/resolve', [MaintenanceController::class, 'resolve'])
    ->name('maintenance.resolve');

// Dashboards
Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');

Route::get('/dashboard', function () {
    return view('staff.dashboard');
})->name('dashboard');

// User pages: choose a locker, create PIN, unlock, release
Route::prefix('lockerdetail')->group(function () {
    Route::get('/', [LockerDetailController::class, 'index'])->name('lockerdetail.index');
    Route::get('/location/{location}', [LockerDetailController::class, 'location'])->name('lockerdetail.location');
});

// Staff area: locker usage + settings (Account + Password only — no System Information)
Route::middleware('auth')->prefix('staff')->name('staff.')->group(function () {

    // Locker usage page
    Route::get('/locker-usage', [LockerUsageController::class, 'index'])
        ->name('locker-usage');

    // Settings page: staff.settings.index
    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings.index');

    // PATCH/PUT = "update existing data"
    Route::patch('/settings/account', [SettingsController::class, 'updateAccount'])
        ->name('settings.account');

    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])
        ->name('settings.password');
});

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

// Staff: user list / add user
Route::get('/user', [UserController::class, 'index'])->name('staff.user.index');
Route::post('/user', [UserController::class, 'store'])->name('staff.user.store');

// Change Active / Inactive
Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
