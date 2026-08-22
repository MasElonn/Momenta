<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
$user = User::get();
Route::get('/dashboard', function () use ( $user) {
    return view('UserDashboard',['user' => $user]);
})->middleware(['auth', 'verified'])->name('UserDashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dash', function(){
    return view ('UserDashboard',['user' => 'Budi','role' => 'customer']);
});

require __DIR__.'/auth.php';
