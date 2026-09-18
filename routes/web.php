<?php

use App\Http\Controllers\FotoController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('LandingPage');
});


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        // Kalau user belum pernah pilih role, arahkan dulu ke halaman Pilih Role
        if (! $role) {
            return redirect()->route('role.select');
        }

        if ($role == 'customer') {
            return view('CustomerDashboard');
        }
        return view('FotograferDashboard');

    })->name('dashboard');

    // Halaman Pilih Role — cuma bisa diakses user yang sudah login
    Route::get('/pilih-role', [RoleController::class, 'show'])->name('role.select');
    Route::post('/pilih-role', [RoleController::class, 'store'])->name('role.store');

});
Route::get('/finish', function () {
    return view('Finish');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload', [FotoController::class, 'store'])->name('foto.upload');

    //Route::get('/dashboard', [UserController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard/profile', [UserController::class, 'updateProfile'])->name('dashboard.updateProfile');
    Route::patch('/dashboard/password', [UserController::class, 'updatePassword'])->name('dashboard.updatePassword');
    Route::delete('/dashboard', [UserController::class, 'destroy'])->name('dashboard.destroy');

    Route::post('/get-coordinates', [GeocodingController::class, 'getCoordinates']);

    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');

    route::post('/booking/', [TransaksiController::class, 'create'])->name('booking.create');
    route::get('/pembayaran', [TransaksiController::class, 'index'])->name('pembayaran');
    route::post('/bayar', [TransaksiController::class, 'upload'])->name('pembayaran.upload');
});



require __DIR__.'/auth.php';