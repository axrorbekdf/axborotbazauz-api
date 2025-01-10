<?php
namespace App\Services\FileUpload\Uploaders;


class PdfUploader extends BaseFileUploader
{
    public function __construct()
    {
        parent::__construct(public_path('uploads/pdf'));
    }
}