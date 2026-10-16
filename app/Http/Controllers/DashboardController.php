<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {

            $transaksis = Transaksi::with(['acara.foto', 'paket.fotografer'])
                ->where('customer_id', $user->user_id)
                ->orderBy('created_at', 'desc')
                ->paginate(3);

            return view('CustomerDashboard', compact('transaksis'));

        } elseif ($user->role === 'fotografer') {

            $transaksis = Transaksi::with(['acara.foto', 'paket.fotografer'])
                ->whereHas('paket', function ($query) use ($user) {
                    $query->where('fotografer_id', $user->user_id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(3);

            return view('FotograferDashboard', compact('transaksis'));
        }

        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
