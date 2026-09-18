<?php

namespace App\Http\Controllers;

use App\Models\Foto;

use App\Services\UploadR2Service;
use App\Services\ChunkUploadService;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Intervention\Image\Laravel\Facades\Image;


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

        set_time_limit(0);
        $request->validate([
            'acara_id' => 'required',
            'file' => 'required|file',
            'dzuuid' => 'required|string',
            'dzchunkindex' => 'required|integer',
            'dztotalchunkcount' => 'required|integer',
        ]);

        $chunkIndex  = (int) $request->input('dzchunkindex');
        $totalChunks = (int) $request->input('dztotalchunkcount');
        $ext         = $request->file('file')->getClientOriginalExtension();
        $fileId      = $request->input('dzuuid');
        $acaraId     = $request->input('acara_id');

        $this->chunkUpload->saveChunk($request->file('file'), $fileId, $chunkIndex);

        if (!$this->chunkUpload->isLastChunk($totalChunks, $chunkIndex)) {
            return response()->json(['success' => true]);
        }

        $fileName = $acaraId . '-' . now()->toDateString() . '-' . Str::random(5) . '.' . $ext;
        $dir = 'foto/' . $acaraId;


        $mergedPath = $this->chunkUpload->merge($fileId, $totalChunks);

        $fileUrl = $this->r2->upload($mergedPath, $dir, $fileName);

        $thumbUrl = null;

            $thumbName = 'thumb-' . $fileName;
            $thumbPath = storage_path('app/' . $fileId . '_thumb_' . $thumbName);

        Image::decode($mergedPath)
            ->scale(width: 400)
            ->save($thumbPath);

            $thumbUrl = $this->r2->upload($thumbPath, $dir . '/thumbnails', $thumbName);

            @unlink($thumbPath);


        @unlink($mergedPath);

        Foto::create([
            'acara_id'      => $acaraId,
            'r2_dir'     => $dir,
            'r2_url'        => $fileUrl,
            'thumbnail_url' => $thumbUrl,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fotoAcara = Foto::where('acara_id', $id);
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

    }
}
