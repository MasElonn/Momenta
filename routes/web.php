<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\PaketBrowseController;
use App\Models\Paket;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Pricing packages are pulled from the database, not hardcoded — see
    // resources/views/LandingPage.blade.php.
    $pakets = Paket::latest()->get();

    return view('LandingPage', compact('pakets'));
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        if ($role == 'customer') {
            return app(DashboardController::class)->index();
        }

        return view('FotograferDashboard');
    })->name('dashboard');
});

// "My Packages" CRUD — only accessible to authenticated users with the
// fotografer role. Uses the same 'paket' table/model as the public
// pricing section, scoped to Auth::id() so a photographer only ever
// sees and manages their own packages.
Route::middleware(['auth', 'verified', \App\Http\Middleware\EnsureIsFotografer::class])->group(function () {
    Route::resource('dashboard/paket', PaketController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy'])
        ->names('paket');
});

Route::get('/finish', function () {
    return view('Finish');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload', [FotoController::class, 'store'])->name('foto.upload');

    Route::patch('/dashboard/profile', [UserController::class, 'updateProfile'])->name('dashboard.updateProfile');
    Route::patch('/dashboard/password', [UserController::class, 'updatePassword'])->name('dashboard.updatePassword');
    Route::delete('/dashboard', [UserController::class, 'destroy'])->name('dashboard.destroy');

    Route::post('/get-coordinates', [GeocodingController::class, 'getCoordinates']);

    // {id} here is the fotografer's user_id — TransaksiController::show()
    // looks up that fotografer and lists their packages. Was previously
    // pointed at BookingController::show(), which doesn't exist (that
    // controller only has update()); this was silently breaking every
    // "Pilih Paket" / "Pilih Fotografer" button in the app.
    Route::get('/booking/{id}', [TransaksiController::class, 'show'])->name('booking.show');

    route::post('/booking/', [TransaksiController::class, 'create'])->name('booking.create');
    route::get('/pembayaran', [TransaksiController::class, 'index'])->name('pembayaran');
    route::post('/bayar', [TransaksiController::class, 'upload'])->name('pembayaran.upload');

    Route::get('/cek-ketersediaan', [AvailabilityController::class, 'index'])->name('availability.index');
    Route::post('/cek-ketersediaan', [AvailabilityController::class, 'check'])->name('availability.check');

    Route::get('/paket', [PaketBrowseController::class, 'index'])->name('packages.index');
});



require __DIR__.'/auth.php';