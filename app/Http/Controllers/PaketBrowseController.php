<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\View\View;

class PaketBrowseController extends Controller
{
    public function index(): View
    {
        $pakets = Paket::with('fotografer')
            ->where('tersedia', true)
            ->whereHas('fotografer', function ($query) {
                $query->where('status_akun', 'active');
            })
            ->get();

        return view('packages', compact('pakets'));
    }
}