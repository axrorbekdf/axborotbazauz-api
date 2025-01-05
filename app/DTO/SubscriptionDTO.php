<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Traits\BaseDTO;

class SubscriptionDTO implements DTOInterface
{
    use BaseDTO;

    public $id = null;
    public $name;
    public $price;
    public $period;
    public $responsible_worker;

    
    public function rules(): array
    {
        return [
            "name" => $this->id ? "required|unique:subscriptions,name,".$this->id : "required|unique:subscriptions,name",
            "price" => "required|int",
            "period" => "required|array",
            "responsible_worker" => "required"
        ];
    }
    
}
