<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationLockerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LockerDetailController;
use App\Http\Controllers\YourLocker;
use App\Http\Controllers\MaintenanceController;


Route::get('/', function () {
    return view('welcome');
});































































































































































































































































































































































































Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');

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

Route::post('/settings/account', function () {
    return back()->with('success', 'Account details updated. (not actually persisted yet)');
})->name('settings.account');
 
Route::post('/settings/password', function () {
    return back()->with('success', 'Password changed. (not actually persisted yet)');
})->name('settings.password');



Route::get('locker-usage', [LockerUsageController::class, 'index'])->name('locker-usage');


Route::prefix('staff')->name('staff.')->group(function () {

    // lockerusage
    Route::get('/locker-usage', [LockerUsageController::class, 'index'])
        ->name('locker-usage');


});





  // Maintenance page (list): staff.maintenance.index
    Route::get('/maintenance', [MaintenanceController::class, 'index'])
        ->name('maintenance.index');

    // Save a new report: POST, because it creates data (was GET before)
    Route::post('/maintenance', [MaintenanceController::class, 'store'])
        ->name('maintenance.store');

    // Mark resolved: PATCH, because it updates data (was GET before).
    // {maintenance} must match the controller parameter name for route model binding.
    Route::patch('/maintenance/{maintenance}/resolve', [MaintenanceController::class, 'resolve'])
        ->name('maintenance.resolve');

    Route::get('/settings', function () {
        return view('staff.settings', [
            'title' => 'Settings',
            'user'  => auth()->user(), // will be null if not logged in yet
            'systemSettings' => [
                'system_name' => 'SmartHub Locker System',
                'field_two'   => '',
                'field_three' => '',
            ],
        ]);
    })->name('settings.index');
    
// TEMPORARY: these only need to exist so the page can render
// (the form "action" URLs are built even before anything is submitted).
// They don't save anything yet — replace with real controller methods later.
 
Route::post('/settings/system', function () {
    return back()->with('success', 'System settings saved. (not actually persisted yet)');
})->name('settings.system');
 
Route::post('/settings/account', function () {
    return back()->with('success', 'Account details updated. (not actually persisted yet)');
})->name('settings.account');
 
Route::post('/settings/password', function () {
    return back()->with('success', 'Password changed. (not actually persisted yet)');
})->name('settings.password');



Route::prefix('staff')->name('staff.')->group(function () {

    // lockerusage
    Route::get('/locker-usage', [LockerUsageController::class, 'index'])
        ->name('locker-usage');

    // miantenance
    Route::get('/maintenanace', [MaintenanceController::class, 'index'])
        ->name('maintenance.index');

    Route::get('/miantenance', [MaintenanceController::class, 'store'])
        ->name('maintenance.store');
        
    Route::get('/maintenace/{id}/resolve', [MaintenanceController::class, 'resolve'])
        ->name('maintenance.resolve'); 
}); 

    // User list
    Route::get('/staff/user', [UserController::class, 'index'])->name('staff.user.index');

    // Add a user
    Route::post('/staff/user', [UserController::class, 'store'])->name('staff.user.store');

    // View one user
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // Change Active / Inactive
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');