<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home');
});


Route::get('dash', function (){
    return view('UserDashboard',['user' => 'Budi', 'role' => 'customer']);
});
