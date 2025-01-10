<?php
namespace App\Services\FileUpload\Converters;

use App\Services\FileUpload\Interfaces\FileConverterInterface;

class PptToDocAndPdfConverter implements FileConverterInterface
{
    public function convert(string $filePath): string
    {
        // PPT faylni DOCga aylantirish
        $docPath = str_replace('.ppt', '.doc', $filePath);
        $docPath = str_replace('.pptx', '.doc', $docPath);
        exec("libreoffice --headless --convert-to doc $filePath --outdir " . dirname($filePath));

        // DOCdan PDFga aylantirish
        $pdfPath = str_replace('.doc', '.pdf', $docPath);
        $docToPdfConverter = new DocToPdfConverter();
        $pdfPath = $docToPdfConverter->convert($docPath);

        return $pdfPath;
    }
}