<?php
namespace App\Services\FileUpload\Uploaders;

use Illuminate\Support\Str;
use App\Services\FileUpload\Interfaces\FileUploaderInterface;

abstract class BaseFileUploader implements FileUploaderInterface
{
    protected $uploadDirectory;

    public function __construct($uploadDirectory)
    {
        $this->uploadDirectory = $uploadDirectory;
    }

    public function upload($file): string
    {
        // Faylni yuklash
        $file = $file->file('file');
        // Fayl nomini va kengaytmasini ajratib olish
        $fileInfo = pathinfo($file->getClientOriginalName());
        $basename = $fileInfo['filename']; // Fayl nomi (kengaytmasiz)
        $extension = $fileInfo['extension']; // Fayl kengaytmasi
        
        $fayl_upload_tima = time();
        $fileName = $fayl_upload_tima . '-' . Str::slug($basename).'.'.$extension;

        $filePath = $file->storeAs('uploads/'.$fayl_upload_tima,$fileName, 'public');

        $filename = $file->getClientOriginalName();
        $file->move($this->uploadDirectory, $filename);
        return $this->uploadDirectory . '/' . $filename;
    }
}
