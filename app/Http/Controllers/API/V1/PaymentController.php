<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\PaymentDTO;
use App\Http\Controllers\Controller;
use App\Services\PaymentCRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $serviceClass;
    protected $classDTO;

    public function __construct()
    {
        $this->serviceClass = new PaymentCRUDService();
        $this->classDTO = new PaymentDTO();
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
