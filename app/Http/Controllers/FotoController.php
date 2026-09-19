<?php

namespace App\Http\Controllers;

use App\Models\Foto;

use App\Services\UploadR2Service;
use App\Services\ChunkUploadService;

use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\Laravel\Facades\Image;
use ZipStream\ZipStream;



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
        try {

            $thumbName = 'thumb-' . $fileName;
            $thumbPath = storage_path('app/' . $fileId . '_thumb_' . $thumbName);

            Image::decode($mergedPath)
                ->scale(width: 400)
                ->save($thumbPath);

            $thumbUrl = $this->r2->upload($thumbPath, $dir . '/thumbnails', $thumbName);

            @unlink($thumbPath);
        } catch (\Exception $e) {

        }

        @unlink($mergedPath);

        Foto::create([
            'acara_id'      => $acaraId,
            'r2_dir'     => $dir,
            'r2_url'        => $fileUrl,
            'thumbnail_url' => $thumbUrl,
        ]);

        return response()->json(['success' => true]);
    }

    public function downloadAll(string $acaraId)
    {
        $fotos = Foto::where('acara_id', $acaraId)->get();

        if ($fotos->isEmpty()) {
            abort(404);
        }

        return response()->stream(function () use ($fotos) {
            $zip = new ZipStream(
                outputName: 'gallery-' . now()->format('Ymd-His') . '.zip',
                sendHttpHeaders: true,
            );

            foreach ($fotos as $foto) {
                $filename = basename($foto->r2_url);
                $path = $foto->r2_dir . '/' . $filename;

                if (!Storage::disk('r2')->exists($path)) {
                    continue;
                }

                $stream = Storage::disk('r2')->readStream($path);
                $zip->addFileFromStream($filename, $stream);
                fclose($stream);
            }

            $zip->finish();
        }, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="gallery.zip"',
        ]);
    }
    public function downloadFoto(Request $request)
    {
        $url = $request->r2_url;
        $filename = basename(parse_url($url, PHP_URL_PATH));

        return response()->streamDownload(function () use ($url) {
            $response = Http::withOptions(['stream' => true])->get($url);
            $body = $response->toPsrResponse()->getBody();

            while (!$body->eof()) {
                echo $body->read(1024 * 64);
                flush();
            }
        }, $filename);
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

    }
}
