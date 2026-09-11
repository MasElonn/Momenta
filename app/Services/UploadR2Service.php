<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class UploadR2Service
{
    public function upload(string $filePath, string $dir, ?string $filename = null): string
    {
        $filename = $filename ?? basename($filePath);

        $path = Storage::disk('r2')->putFileAs($dir, new File($filePath), $filename);

        return Storage::disk('r2')->url($path);
    }
}
