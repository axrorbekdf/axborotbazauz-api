<?php

namespace App\Traits;

use App\Interfaces\DTOInterface;

trait BaseDTO 
{ 
    public function marge($data): DTOInterface{

        foreach(get_object_vars($this) as $key => $item){
            $this->$key = $data[$key] ?? null;
        }

        return $this;
    }

    public function toArray(): array{
        $data = [];
        foreach(get_object_vars($this) as $key => $item){
            $data[$key] = $this->$key;
        }

        return $data;
    }

    public function fromRequest($data): DTOInterface|array
    {
        $this->marge($data);

        $validate = validate($data, $this->rules());
    
        if ($validate !== true) return $validate;
    
       return $this;
    
    }
}
