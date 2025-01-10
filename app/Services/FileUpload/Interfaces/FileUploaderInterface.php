<?php
namespace App\Services\FileUpload\Interfaces;

interface FileConverterInterface
{
    public function convert(string $filePath): string;
}
