<?php
namespace App\Services\FileUpload\Interfaces;

interface FileUploaderInterface
{
    public function upload($file): string;
}
