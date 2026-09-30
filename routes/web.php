<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationLockerController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerDetailController;
<<<<<<< HEAD
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use App\Models\Location;
use App\Models\LockerUsage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
=======
use App\Http\Controllers\YourLocker;
use App\Http\Controllers\MaintenanceController;

>>>>>>> refs/remotes/origin/feature/users-dashboard

Route::get('/', function () {
    return view('welcome');
});

// Admin pages: URLs start with /admin
Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('lockers', LockerController::class);
});

// User-facing: report a locker problem
Route::get('/report-problem', [MaintenanceController::class, 'create'])->name('maintenance.create');
Route::post('/report-problem', [MaintenanceController::class, 'store'])->name('maintenance.store');

// TODO: staff maintenance ticket list/resolve — MaintenanceController doesn't
// have index()/resolve() methods yet, and there's no staff view built for
// this. Left commented out so hitting these URLs doesn't crash the app.
// Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
// Route::patch('/maintenance/{id}/resolve', [MaintenanceController::class, 'resolve'])->name('maintenance.resolve');

Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');

<<<<<<< HEAD
Route::get('/staff/user', function () {
    return view('staff.user');
})->name('staff.user');

Route::get('/staff/locker-usage', function () {
    return view('staff.locker-usage');
})->name('locker-usage');
=======

>>>>>>> refs/remotes/origin/feature/users-dashboard

// Users Dashboard
Route::get('/users/dashboard', function () {
    return view('users.dashboard', [
        'locations' => Location::orderBy('distance_km')->take(3)->get(),
        'activeUsage' => LockerUsage::with(['locker.location'])
            ->where('user_id', Auth::id())
            ->whereNull('ended_at')
            ->latest('started_at')
            ->first(),
    ]);
})->name('users.dashboard');

// Locations: list, details, lockers-at-a-location
Route::prefix('users/locations')->name('locations.')->group(function () {
    Route::get('/', [LocationController::class, 'index'])->name('index');
    Route::get('/{location}', [LocationController::class, 'show'])->name('details_locations');
    Route::get('/{location}/lockers', [LocationLockerController::class, 'index'])->name('lockers');
});

// The locker you're currently using: view, unlock, release
Route::prefix('my-locker')->name('locker.')->group(function () {
    Route::get('/', [LockerUsageController::class, 'show'])->name('show');
    Route::post('/{usage}/unlock', [LockerUsageController::class, 'unlock'])->name('unlock');
    Route::post('/{usage}/release', [LockerUsageController::class, 'release'])->name('release');
});

// User pages: choose a locker, create PIN, unlock, release
// NOTE: may overlap with the my-locker group above — worth reconciling later
Route::prefix('lockerdetail')->group(function () {
    Route::get('/', [LockerDetailController::class, 'index'])->name('lockerdetail.index');
    Route::get('/location/{location}', [LockerDetailController::class, 'location'])->name('lockerdetail.location');
});

Route::get('/settings', function () {
    return view('staff.settings', [
        'title' => 'Settings',
        'user'  => auth()->user(),
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

<<<<<<< HEAD
// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
=======



















































































































































































































































































































































































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

>>>>>>> refs/remotes/origin/feature/users-dashboard
