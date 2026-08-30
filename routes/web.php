<?php

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
})->name('home');



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $role = Auth::user()->role;
        if ($role == 'customer') {
            return view('UserDashboard');
        }
        return view('ftUserDashboard');

    })->name('UserDashboard');

    //fotografer comming soon
    /*Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('UserDashboard', ['user' => $user]);
    })->name('UserDashboard');*/

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route::get('/dashboard', [UserController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard/profile', [UserController::class, 'updateProfile'])->name('dashboard.updateProfile');
    Route::patch('/dashboard/password', [UserController::class, 'updatePassword'])->name('dashboard.updatePassword');
    Route::delete('/dashboard', [UserController::class, 'destroy'])->name('dashboard.destroy');
});

Route::get('/dash', function(){
    return view ('UserDashboard',['user' => 'Budi','role' => 'customer']);
});



Route::get('/test-checkout', function () {
    return view('checkout.midtrans_test', [
        'pakets' => \App\Models\Paket::all(),
    ]);
});

Route::post('/checkout', [TransaksiController::class, 'midtransCheckout'])->name('checkout.midtrans');


require __DIR__.'/auth.php';
