<?php
namespace App\Services\FileUpload;

use App\Services\FileUpload\Interfaces\FileUploaderInterface;
use App\Services\FileUpload\Interfaces\FileConverterInterface;

class FileManager
{
    private $uploader;
    private $converter;

    public function __construct(FileUploaderInterface $uploader, ?FileConverterInterface $converter = null)
    {
        $this->uploader = $uploader;
        $this->converter = $converter;
    }

    public function processFile($file): string
    {
        $uploadedFilePath = $this->uploader->upload($file);

        if ($this->converter) {
            return $this->converter->convert($uploadedFilePath);
        }

        return $uploadedFilePath;
    }
}
