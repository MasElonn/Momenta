<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed',
        ]);

        $acara = Acara::where('acara_id', $id)
            ->whereHas('transaksi.paket', function ($query) {
                $query->where('fotografer_id', auth()->id());
            })
            ->firstOrFail();

        $acara->update([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Jadwal berhasil diperbarui.');

    }


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
    public function show(Acara $acara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acara $acara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function destroy(Acara $acara)
    {
        $acara = Acara::where('acara_id', $id)
            ->whereHas('transaksi.paket', function ($query) {
                $query->where('fotografer_id', auth()->id());
            })
            ->firstOrFail();

        $acara->delete();

        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
    }

