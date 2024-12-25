<?php

namespace App\Http\Controllers\API\Auth;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserCRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    protected $serviceClass;
    protected $classDTO;

    public function __construct()
    {
        $this->serviceClass = new UserCRUDService();
        $this->classDTO = new UserDTO();
    }

    public function index(){

        return $this->serviceClass->index();

    }

    public function forOptions(){

        return $this->serviceClass->forOptions();

    }


    public function view(string $id){

        return $this->serviceClass->view($id);
    }

    public function store(){

        $data = $this->classDTO->fromRequest([
            "name" => request()->name,
            "phone" => request()->phone,
            "email" => request()->email,
            "login" => request()->login,
            "password" => request()->password ? Hash::make(request()->password) : null,
            "is_active" => request()->is_active,
            "responsible_worker" => Auth::user()->name ?? "Not name",
        ]);
        
        if(is_array($data))
            return $data;

        return $this->serviceClass->store($data->toArray());
       
    }

    public function update(string $id){

        $data = $this->classDTO->fromRequest([
            "id" => $id,
            "name" => request()->name,
            "phone" => request()->phone,
            "email" => request()->email,
            "login" => request()->login,
            "password" => Hash::make(request()->password),
            "is_active" => request()->is_active,
            "responsible_worker" => Auth::user()->name ?? "Not name",
        ]);
        
        if(is_array($data))
            return $data;

        return $this->serviceClass->update($id, $data->toArray());
    }

   
    public function destroy(string $id){

        return $this->serviceClass->destroy($id);
    }

}
