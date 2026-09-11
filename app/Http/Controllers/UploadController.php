<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Services\UploadR2Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function __construct(protected UploadR2Service $r2)
    {
    }

    public function uploadChunk(Request $request)
    {
        $files = $request->file('file') ?? $request->file('images');
        if (!$files) return response()->json(['error' => 'No file'], 400);


        $chunkNumber = $request->input('dzchunkindex', 0);
        $totalChunks = $request->input('dztotalchunkcount', 1);

        foreach ($files as $index => $file) {
            $fileName = $request->input('dzfilename', $file->getClientOriginalName());
            $fileId = $request->input('dzuuid', $fileName) . (count($files) > 1 ? "-{$index}" : "");

            $file->move(storage_path('app/uploads/chunks'), $fileId . '.part' . $chunkNumber);

            if ($chunkNumber == $totalChunks - 1) {
                $this->mergeChunks($fileId, $fileName, $totalChunks);
            }
        }

        return response()->json(['status' => 'success']);
    }

    private function mergeChunks($fileId, $fileName, $totalChunks)
    {
        $finalPath = storage_path('app/uploads/' . $fileName);
        $file = fopen($finalPath, 'wb');

        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkPath = storage_path('app/uploads/chunks/' . $fileId . '.part' . $i);
            if (file_exists($chunkPath)) {
                $chunk = fopen($chunkPath, 'rb');
                stream_copy_to_stream($chunk, $file);
                fclose($chunk);
                @unlink($chunkPath);
            }
        }

        fclose($file);
        $this->r2->upload($file, 'test', 'testname.jpg');
    }
}
