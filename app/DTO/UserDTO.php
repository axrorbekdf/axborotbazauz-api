<?php

namespace App\DTO;

use App\Interfaces\DTOInterface;
use App\Traits\BaseDTO;

class UserDTO implements DTOInterface
{
    use BaseDTO;

    public $id = null;
    public $name;
    public $phone;
    public $email;
    public $login;
    public $password;
    public $is_active;
    public $responsible_worker;

    
    public function rules(): array
    {
        return [
            "name" => "required",
            "phone" => $this->phone ? "unique:users,phone" : "",
            "email" => $this->email ? "unique:users,email" : "",
            "login" => $this->login ? "unique:users,login" : "",
            "password" => "required|min:6",
            "is_active" => "required|bool",
            "responsible_worker" => "required",
        ];
    }
    
}
