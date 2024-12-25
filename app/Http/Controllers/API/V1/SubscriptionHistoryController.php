<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\SubscriptionHistoryDTO;
use App\Http\Controllers\Controller;
use App\Services\SubscriptionHistoryCRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionHistoryController extends Controller
{
    protected $serviceClass;
    protected $classDTO;

    public function __construct()
    {
        $this->serviceClass = new SubscriptionHistoryCRUDService();
        $this->classDTO = new SubscriptionHistoryDTO();
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
            "user_id" => request()->user_id,
            "subscription_id" => request()->subscription_id,
            "payment_id" => request()->payment_id,
            "start_date" => request()->start_date,
            "end_date" => request()->end_date,
            "responsible_worker" => Auth::user()->name ?? "Not name",
        ]);
        
        if(is_array($data))
            return $data;

        return $this->serviceClass->store($data->toArray());
       
    }

    public function update(string $id){

        $data = $this->classDTO->fromRequest([
            "id" => $id,
            "user_id" => request()->user_id,
            "subscription_id" => request()->subscription_id,
            "payment_id" => request()->payment_id,
            "start_date" => request()->start_date,
            "end_date" => request()->end_date,
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
