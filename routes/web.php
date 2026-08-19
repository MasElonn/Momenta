<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('LendingPage');
});

Route::get('/Login', function () {
    return view('auth.login');
});

Route::get('/dash', function (){
    return view('UserDashboard',['user' => 'Budi', 'role' => 'customer']);
});

