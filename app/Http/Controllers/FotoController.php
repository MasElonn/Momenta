<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Storage;

class FotoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'acara_id' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp',
        ]);

        $dir = "foto";
        $acara_id = $request->acara_id;

        foreach ($request->file('images') as $index => $image) {
            $ext = $image->getClientOriginalExtension();

            $filename = $acara_id . '-' . time() . '-' . $index . '.' . $ext;

            $path = $image->storeAs($dir, $filename, 'r2');
            $file_url = Storage::disk('r2')->url($path);

            Foto::create([
                'acara_id' => $acara_id,
                'r2_bucket' => $dir,
                'r2_key'    => $file_url,
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
