<?php

use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/midtrans', [TransaksiController::class, 'midtransWebhook']);
