<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\SubscriptionDTO;
use App\Http\Controllers\Controller;
use App\Services\SubscriptionCRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    protected $serviceClass;
    protected $classDTO;

    public function __construct()
    {
        $this->serviceClass = new SubscriptionCRUDService();
        $this->classDTO = new SubscriptionDTO();
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
            "price" => request()->price,
            "period" => request()->period,
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
            "price" => request()->price,
            "period" => request()->period,
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
