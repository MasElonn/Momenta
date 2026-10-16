<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\View\View;

class PaketBrowseController extends Controller
{
    /**
     * Customer-facing "Daftar Paket": every package from every fotografer,
     * so a customer can compare options before booking. Separate from
     * PaketController, which is the fotografer's own create/edit/delete.
     */
    public function index(): View
    {
        $pakets = Paket::with('fotografer')
            ->latest()
            ->get();

        return view('packages', compact('pakets'));
    }
}