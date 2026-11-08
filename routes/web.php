<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\Admin\FotograferController;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\PaketBrowseController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $fotografer = User::where('role', 'fotografer')
        ->with(['pakets' => function ($query) {
            $query->where('tersedia', true);
        }])
        ->get();

    return view('LandingPage', compact('fotografer'));
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

Route::middleware(['auth', 'verified', \App\Http\Middleware\EnsureIsFotografer::class])->group(function () {
    Route::resource('dashboard/paket', PaketController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy'])
        ->names('paket');
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
    Route::post('/booking/cek-jadwal', [AvailabilityController::class, 'check'])
    ->middleware('auth')
    ->name('booking.availability.check');

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

    Route::get('/paket', [PaketBrowseController::class, 'index'])->name('packages.index');
});


Route::middleware([
    'auth',
    'verified',
    \App\Http\Middleware\EnsureIsAdmin::class,
])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/fotografer', [FotograferController::class, 'index'])
            ->name('fotografer.index');

        Route::get('/fotografer/create', [FotograferController::class, 'create'])
            ->name('fotografer.create');

        Route::post('/fotografer', [FotograferController::class, 'store'])
            ->name('fotografer.store');

        Route::get('/fotografer/{id}/edit', [FotograferController::class, 'edit'])
            ->name('fotografer.edit');

        Route::put('/fotografer/{id}', [FotograferController::class, 'update'])
            ->name('fotografer.update');

        Route::delete('/fotografer/{id}', [FotograferController::class, 'destroy'])
            ->name('fotografer.destroy');
    });

require __DIR__.'/auth.php';