<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Traits\BaseDTO;

class FileDTO implements DTOInterface
{
    use BaseDTO;

    public $id = null;
    public $title;
    public $slug;
    public $downloads;
    public $category_id;
    public $subject_id;
    public $path;
    public $size;
    public $type;
    public $responsible_worker;

    
    public function rules(): array
    {
        return [
            "title" => "required",
            "slug" => "required",
            "downloads" => "required|int",
            "category_id" => "required|int",
            "subject_id" => "required|int",
            "path" => "",
            "size" => "required",
            "type" => "required",
            "responsible_worker" => "required",
        ];
    }
    
}
