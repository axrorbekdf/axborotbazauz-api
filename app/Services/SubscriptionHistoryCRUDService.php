<?php

namespace App\Services;

use App\Http\Resources\SubscriptionHistoryResource;
use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubscriptionHistoryCRUDService extends CRUDService
{
    protected $modelClass = SubscriptionHistory::class;
    protected $modelResourceClass = SubscriptionHistoryResource::class;
    protected $withModels = ["user","subscription","payment"];



    public function store(array $data){
        
        $obuna = Subscription::find($data['subscription_id']);

        // Bugungi sana
        $startDate = Carbon::today(); // Boshlanish sanasi
        $endDate = $startDate->copy()->addDays($obuna->period); // Tugash sanasi (bugundan $days kun keyin)

        $data['start_date'] = $startDate->format('d-m-Y');
        $data['end_date'] = $endDate->format('d-m-Y');
        
        $model = $this->modelClass::create($data);

        return successResponse($this->modelResourceClass::make($model));
    }


    public function update(string $id, $data){

        try{
            $model = $this->modelClass::findOrfail($id);
            
            $obuna = Subscription::find($data['subscription_id']);

            // Bugungi sana
            $startDate = Carbon::today(); // Boshlanish sanasi
            $endDate = $startDate->copy()->addDays($obuna->period); // Tugash sanasi (bugundan $days kun keyin)

            $data['start_date'] = $startDate->format('d-m-Y');
            $data['end_date'] = $endDate->format('d-m-Y');
            
            $model->update($data);
            
        }catch(Exception $e){
            if ($e instanceof ModelNotFoundException) {
                return errorResponse("Record not found!");
            }else{
                return errorResponse($e->getMessage());
            }
        }
        

        return successResponse($this->modelResourceClass::make($model));
    }
}
