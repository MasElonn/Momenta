<?php
namespace App\Services;

use Midtrans\Config;

class MidtransService {
    public function __construct() {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
