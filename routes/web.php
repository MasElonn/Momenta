<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
})->name('home');



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('UserDashboard', ['user' => $user]);
    })->name('UserDashboard');

    Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('UserDashboard', ['user' => $user]);
    })->name('UserDashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dash', function(){
    return view ('UserDashboard',['user' => 'Budi','role' => 'customer']);
});

require __DIR__.'/auth.php';
