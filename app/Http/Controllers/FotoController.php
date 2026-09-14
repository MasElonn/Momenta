<?php

namespace App\Http\Controllers;

use App\Models\Foto;

use App\Services\UploadR2Service;
use App\Services\ChunkUploadService;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FotoController extends Controller
{

    public function __construct(
        protected ChunkUploadService $chunkUpload,
        protected UploadR2Service $r2
    ) {}
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
            'file' => 'required|file',
            'dzuuid'=> 'required|string',
            'dzchunkindex' => 'required|integer',
            'dztotalchunkcount' => 'required|integer',
        ]);

        $chunkIndex  = (int) $request->input('dzchunkindex');
        $totalChunks = (int) $request->input('dztotalchunkcount');
        $ext    = $request->file('file')->getClientOriginalExtension();
        $fileId      = $request->input('dzuuid');
        $acaraId     = $request->input('acara_id');

        $this->chunkUpload->saveChunk($request->file('file'), $fileId, $chunkIndex);

        if (!$this->chunkUpload->isLastChunk($totalChunks, $chunkIndex)) {
            session()->flash('success', 'All files uploaded successfully!');

        }
        $fileName = $acaraId .'-'. now()->toDateString() . '-' .Str::Random(5) . '.' . $ext;

        $dir = 'foto';
        $fileUrl = $this->chunkUpload->mergeAndUpload($fileId, $fileName, $totalChunks, $dir);

       Foto::create([
            'acara_id'  => $acaraId,
            'r2_bucket' => $dir,
            'r2_key'    => $fileUrl,
        ]);

        return response()->json(['success' => 'true']);
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
