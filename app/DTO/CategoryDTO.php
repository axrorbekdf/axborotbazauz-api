<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Traits\BaseDTO;

class CategoryDTO implements DTOInterface
{
    use BaseDTO;

    public $id = null;
    public $name;
    public $slug;
    public $count;
    public $responsible_worker;

    
    public function rules(): array
    {
        return [
            "name" => $this->id ? "required|unique:categories,name,".$this->id : "required|unique:categories,name",
            "slug" => "required",
            "count" => "required|int",
            "responsible_worker" => "required"
        ];
    }
    
}
