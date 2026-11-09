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
            ->get();

        return view('packages', compact('pakets'));
    }
}