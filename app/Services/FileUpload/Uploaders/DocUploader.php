<?php
namespace App\Services\FileUpload\Uploaders;

class DocUploader extends BaseFileUploader
{
    public function __construct()
    {
        parent::__construct(public_path('uploads/doc'));
    }
}