<?php

namespace App\Services;

use Exception;
use App\Helpers\FileS3;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\CRUDServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CRUDService implements CRUDServiceInterface
{
    protected $modelClass;
    protected $modelResourceClass;
    protected $withModels = [];

    
    public function index(){

        // $model = $this->modelClass::query()
        //     ->with($this->withModels)
        //     ->filter(request()->all());

        // if(request()->search && (request()->search !== "null" && request()->search !== "NULL")){

        //     $model = $model->search(request()->search);
        // }

        // if(request()->column && request()->direction){
        //     $model = $model->orderBy(request()->column, request()->direction);
        // }

        // if(request()->perPage){
        //     $model = $model->paginate(request()->perPage);
        // }else{
        //     $model = $model->get();
        // }

        $cacheKey = 'model_query_' . md5(request()->fullUrl());

        $model = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $query = $this->modelClass::query()
                ->with($this->withModels)
                ->filter(request()->all());

            if (request()->search && (request()->search !== "null" && request()->search !== "NULL")) {
                $query = $query->search(request()->search);
            }

            if (request()->column && request()->direction) {
                $query = $query->orderBy(request()->column, request()->direction);
            }

            if (request()->perPage) {
                return $query->paginate(request()->perPage);
            }

            return $query->get();
        });
    
        
        return successResponse($this->modelResourceClass::collection($model)
                ->response()->getData(true));
    }

    public function forOptions(){

        $model = $this->modelClass::query();

        if(request()->search && (request()->search !== "null" && request()->search !== "NULL")){

            $model = $model->search(request()->search);
        }

        $model = $model->get();

        return successResponse($this->modelResourceClass::collection($model)
                ->response()->getData(true));
    }

    public function view(string $id){
        try{
            $model = $this->modelClass::findOrFail($id);
            
        }catch(Exception $e){
            if ($e instanceof ModelNotFoundException) {

                return errorResponse("Record not found!");
            }else{
                return errorResponse($e->getMessage());
            }
        }
        return successResponse($this->modelResourceClass::make($model));
    }

    public function store(array $data){
        
        $model = $this->modelClass::create($data);

        return successResponse($this->modelResourceClass::make($model));
    }
    
    public function update(string $id, $data){

        try{
            $model = $this->modelClass::findOrfail($id);
        
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
    
    public function destroy(string $id){
        try{
            $this->modelClass::findOrFail($id)->delete();
            
        }catch(Exception $e){
            if ($e instanceof ModelNotFoundException) {

                return errorResponse("Record not found!");
            }else{
                return errorResponse($e->getMessage());
            }
        }

        return successResponse("Deleted successfuly!");
    }

    public function restore(string $id){
        try{
            $this->modelClass::findOrFail($id)->restore();
            
        }catch(Exception $e){
            if ($e instanceof ModelNotFoundException) {

                return errorResponse("Record not found!");
            }else{
                return errorResponse($e->getMessage());
            }
        }

        return successResponse("Deleted successfuly!");
    }

    public function forceDelete(string $id){
        try{
            $this->modelClass::onlyTrashed()
                ->findOrFail($id)
                ->forceDelete();
            
        }catch(Exception $e){
            if ($e instanceof ModelNotFoundException) {

                return errorResponse("Record not found!");
            }else{
                return errorResponse($e->getMessage());
            }
        }

        return successResponse("Deleted successfuly!");
    }

    public function imageStore(){
        

        // dd(request()->file('file'));

        $data = FileS3::store('minio_mobile_app', 'products', request());
        dd($data);
    }

    public function imageDelete(){
        return "Delete";
    }
}
