<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('LandingPage');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload', [FotoController::class, 'store'])->name('foto.upload');

    Route::patch('/dashboard/profile', [ProfileController::class, 'updateProfile'])->name('dashboard.updateProfile');
    Route::patch('/dashboard/password', [ProfileController::class, 'updatePassword'])->name('dashboard.updatePassword');
    Route::delete('/dashboard/delete', [ProfileController::class, 'destroy'])->name('dashboard.destroy');

    Route::post('/get-coordinates', [GeocodingController::class, 'getCoordinates']);

    Route::get('/booking/{id}', [TransaksiController::class, 'show'])->name('booking.show');
    Route::post('/booking', [TransaksiController::class, 'create'])->name('booking.create');
    Route::get('/pembayaran/{id}', [TransaksiController::class, 'index'])->name('pembayaran');
    Route::post('/bayar', [TransaksiController::class, 'upload'])->name('pembayaran.upload');
    Route::get('/finish/{id}', [TransaksiController::class, 'finish'])->name('finish');
    Route::delete('/cancel/{id}', [TransaksiController::class, 'destroy'])->name('cancel.booking');

    Route::post('/transaksi/{id}/accept', [TransaksiController::class, 'accept'])->name('transaksi.accept');
    Route::post('/transaksi/{id}/reject', [TransaksiController::class, 'reject'])->name('transaksi.reject');

    Route::get('/acara/{acaraId}/download', [FotoController::class, 'downloadAll'])
        ->name('foto.downloadAll');

    Route::get('/download', [FotoController::class, 'downloadFoto'])->name('foto.download');
    Route::post('/delete/{id}', [FotoController::class, 'destroy'])->name('foto.delete');

});



require __DIR__.'/auth.php';
