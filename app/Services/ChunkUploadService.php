<?php
namespace App\Services;

class ChunkUploadService
{
    protected string $chunkDir = "uploads/chunks/";
    public function __construct(protected UploadR2Service $r2)
    {
    }
    public function saveChunk($file, string $fileId, int $chunkIndex): void
    {
        $targetDir = storage_path('app/' . $this->chunkDir);
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $fileId . '.part' . $chunkIndex);
    }

    public function isLastChunk($chunkNumber, $chunkIndex): bool
    {
        return $chunkIndex == $chunkNumber - 1;

    }

    public function mergeAndUpload($fileId, $fileName, $totalChunks, $dir): string
    {
        $finalPath = storage_path('app/' . $fileId . '_' . $fileName);
        $file = fopen($finalPath, 'wb');

        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkPath = storage_path('app/' . $this->chunkDir . $fileId . '.part' . $i);
            if (file_exists($chunkPath)) {
                $chunk = fopen($chunkPath, 'rb');
                stream_copy_to_stream($chunk, $file);
                fclose($chunk);
                @unlink($chunkPath);
            }
        }

        fclose($file);

        $fileUrl = $this->r2->upload($finalPath, $dir, $fileName);

        @unlink($finalPath);

        return $fileUrl;
    }
}
