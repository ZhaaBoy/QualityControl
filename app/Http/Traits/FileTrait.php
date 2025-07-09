<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    public function storeFile($path, $file)
    {
        $path = $file->storeAs("public/{$path}", $file->hashName());
        return basename($path);
    }

    public function deleteFile($path, $dataFile, $file = true): bool
    {
        if (Storage::disk('public')->exists($path) && !empty($dataFile) && $file) {
            Storage::disk('public')->delete("{$path}/{$dataFile}");
            return true;
        }
        return false;
    }
}
