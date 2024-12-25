<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Traits\BaseDTO;

class PaymentDTO implements DTOInterface
{
    use BaseDTO;

    public $id = null;
    public $name;
    public $responsible_worker;

    
    public function rules(): array
    {
        return [
            "name" => $this->id ? "required|unique:payments,name".$this->id : "required|unique:payments,name",
            "responsible_worker" => "required"
        ];
    }
    
}
