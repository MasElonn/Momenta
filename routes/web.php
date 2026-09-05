<?php

use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('LendingPage');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $role = Auth::user()->role;
        if ($role == 'customer') {
            return view('CustomerDashboard');
        }
        return view('FotograferDashboard');

    })->name('UserDashboard');


});
Route::post('/get-coordinates', [GeocodingController::class, 'getCoordinates']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route::get('/dashboard', [UserController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard/profile', [UserController::class, 'updateProfile'])->name('dashboard.updateProfile');
    Route::patch('/dashboard/password', [UserController::class, 'updatePassword'])->name('dashboard.updatePassword');
    Route::delete('/dashboard', [UserController::class, 'destroy'])->name('dashboard.destroy');
});



Route::post('/get-coordinates', [GeocodingController::class, 'getCoordinates']);



require __DIR__.'/auth.php';
