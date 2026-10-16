<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class UploadR2Service
{
    public function upload(UploadedFile|File|string $file, string $dir, ?string $filename = null): string
    {
        $filename = $filename ?? basename($file);

        $path = Storage::disk('r2')->putFileAs($dir, $file, $filename);

        return Storage::disk('r2')->url($path);
    }
    public function path(string $dir, string $filename): string
    {
        return $dir . '/' . $filename;
    }
}
