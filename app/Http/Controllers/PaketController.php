<?php

namespace App\Http\Controllers;

use App\Models\paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paket.create');
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
    public function show(paket $paket)
    {
        $paket = paket;;FindOrFail($paket);
        return view('paket.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paket $paket)
    {
        $paket = paket::findOrFail($paket);
        return view('paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, paket $paket)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        $paket ;;FindOrFail($paket);
        $paket->update($request->all());
        return redirect()->route('paket.index')->with('success', 'Paket  berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paket $paket)
    {
        $paket = paket::findOrFail($paket);
        $paket->delete();
        return redirect()->route('paket.index')->with('success', 'Paket  berhasil dihapus.');
    }
}
