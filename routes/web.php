<?php

use App\Http\Controllers\AuthContrller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});









































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

// Staff Login
Route::group(['prefix'=> 'staff','as'=>'staffs.'], function(){
    // staff login
    Route::get('/register', [StaffContrller::class, 'showRegister'])->name('register');
    // Staff login store
    Route::post('/register', [StaffContrller::class, 'register']);
});