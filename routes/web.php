<?php

use App\Http\Controllers\AuthContrller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\LockerUsageController;
Route::get('/', function () {
    return view('welcome');
});



Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');

Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');

Route::patch('/maintenance/{id}/resolve', [MaintenanceController::class, 'resolve'])->name('maintenance.resolve');

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

// Mony With Route

Route::get('locker-usage', [LockerUsageController::class, 'index'])->name('locker-usage');

Route::get('user', function () {
    return view('staff.user');
})->name('staff.user');


Route::prefix('staff')->name('staff.')->group(function () {

    // user
    Route::get('/user', function () {
        return view('staff.user');
    })->name('staff.user');

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

    // setting
    
    
});
