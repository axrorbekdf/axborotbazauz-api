<?php
namespace App\Services\FileUpload\Uploaders;

class PptUploader extends BaseFileUploader
{
    public function __construct()
    {
        parent::__construct(public_path('uploads/ppt'));
    }
}