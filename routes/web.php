<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
<<<<<<< HEAD
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\UserLocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
=======
>>>>>>> 441a248 (in the staff finish)
use App\Http\Controllers\LockerDetailController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\MaintenanceController;
<<<<<<< HEAD
=======
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLocationController;
use Illuminate\Support\Facades\Route;
>>>>>>> 441a248 (in the staff finish)

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

<<<<<<< HEAD
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









































































































































































































































































































































































































Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');

=======
});

// Bora: user dashboard
>>>>>>> 441a248 (in the staff finish)
Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->name('users.dashboard');

<<<<<<< HEAD
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
=======
// Admin CRUD (resource already gives index/create/store/show/edit/update/destroy)
Route::resource('users', UserController::class);
Route::resource('locations', LocationController::class);
Route::resource('lockers', LockerController::class);

// Maintenance
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
Route::patch('/maintenance/{maintenance}/resolve', [MaintenanceController::class, 'resolve'])
    ->name('maintenance.resolve');
>>>>>>> 441a248 (in the staff finish)

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

<<<<<<< HEAD
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


Route::get('/maintenance', function () {
    return view('staff.maintenance');
})->name('maintenance');
=======
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

// Login and register (Dalin)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register/staff', [AuthController::class, 'showStaffRegister'])->name('register.staff');
Route::post('/register/staff', [AuthController::class, 'staffRegister'])->name('register.staff.store');
Route::get('/register/user', [AuthController::class, 'showUserRegister'])->name('register.user');
Route::post('/register/user', [AuthController::class, 'userRegister'])->name('register.user.store');

// Staff: user list / add user
Route::get('/user', [UserController::class, 'index'])->name('staff.user.index');
Route::post('/user', [UserController::class, 'store'])->name('staff.user.store');

// Change Active / Inactive
Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
>>>>>>> 441a248 (in the staff finish)
