<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Traits\BaseDTO;

class FilePageDTO implements DTOInterface
{
    use BaseDTO;

    public $file_id;
    public $number;
    public $content;
    public $previewPath;
    public $responsible_worker;

    
    public function rules(): array
    {
        return [
            "file_id" => "required",
            "number" => "required",
            "content" => "required",
            "previewPath" => "required",
            "responsible_worker" => "required",
        ];
    }
    
}
