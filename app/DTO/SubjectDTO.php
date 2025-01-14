<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Traits\BaseDTO;

class SubjectDTO implements DTOInterface
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
            "name" => $this->id ? "required|unique:subjects,name,".$this->id : "required|unique:subjects,name",
            "slug" => "required",
            "count" => "required",
            "responsible_worker" => "required",
        ];
    }
    
}
