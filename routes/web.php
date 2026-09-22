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