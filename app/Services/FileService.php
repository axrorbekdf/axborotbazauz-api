<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class FileService
{
    public static function deleteFilesByExtension($directory, $extension)
    {
        if (!File::exists($directory)) {
            return "Papka topilmadi: $directory";
        }

        $folders = File::directories($directory);

        foreach ($folders as $folder) {
            $files = File::glob("$folder/*.$extension");

            foreach ($files as $file) {
                File::delete($file);
            }
        }

        return "Belgilangan fayllar o‘chirildi.";
    }
}
