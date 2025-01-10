<?php
namespace App\Services\FileUpload\Converters;

use App\Services\FileUpload\Interfaces\FileConverterInterface;

class DocToPdfConverter implements FileConverterInterface
{
    public function convert(string $filePath): string
    {
        // DOC faylni PDF formatga aylantirish
        $outputPath = str_replace('.doc', '.pdf', $filePath);
        $outputPath = str_replace('.docx', '.pdf', $outputPath);

        // Misol uchun, "exec" orqali LibreOffice'dan foydalanish
        exec("libreoffice --headless --convert-to pdf $filePath --outdir " . dirname($filePath));

        return $outputPath;
    }
}