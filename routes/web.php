<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationLockerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerDetailController;
use App\Http\Controllers\YourLocker;


=======
use App\Http\Controllers\MaintenanceController;
>>>>>>> 46af316 (that just static)
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// Admin pages: URLs start with /admin
Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('lockers', LockerController::class);
});
=======
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');

<<<<<<< HEAD
Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');

Route::patch('/maintenance/{id}/resolve', [MaintenanceController::class, 'resolve'])->name('maintenance.resolve');
>>>>>>> 46af316 (that just static)
=======
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
>>>>>>> e97a97b (just only static)

// User pages: choose a locker, create PIN, unlock, release
Route::prefix('lockerdetail')->group(function () {
    Route::get('/', [LockerDetailController::class, 'index'])->name('lockerdetail.index');
    Route::get('/location/{location}', [LockerDetailController::class, 'location'])->name('lockerdetail.location');

<<<<<<< HEAD
    Route::post('/use', [YourLocker::class, 'store'])->name('locker.use');
    Route::get('/yourlocker/{code}', [YourLocker::class, 'show'])->name('locker.show');
    Route::post('/yourlocker/{code}/unlock', [YourLocker::class, 'unlock'])->name('locker.unlock');
    Route::post('/yourlocker/{code}/release', [YourLocker::class, 'release'])->name('locker.release');
});
=======



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

































Route::get('/login', function () {
    return view('login.index');
})->name('login');


// route user dalin
Route::group(['prefix'=>'user','as' => 'users.'], function(){
    // Login page
    Route::get('/login', [AuthContrller::class, 'showLogin'])->name('login');
    // Login store
    Route::post('/login', [AuthContrller::class, 'login']);
    // Logout
    Route::post('/logout', [AuthContrller::class, 'logout'])->name('logout');

});


>>>>>>> 46af316 (that just static)
