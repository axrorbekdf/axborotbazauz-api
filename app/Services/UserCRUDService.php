<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserCRUDService extends CRUDService
{
    protected $modelClass = User::class;
    protected $modelResourceClass = UserResource::class;
    protected $withModels = [];


    public function store(array $data){
        
        $model = $this->modelClass::create($data);

        if($model && $model->is_active){
            return successResponse([
                'token' => $model->createToken('token')->plainTextToken
            ]);
        }

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

    /**
    * Active and disActive User
    */
    public function isActive( string $id, $is_active)
    {
        $user = $this->modelClass::findOrFail($id);

        $user->update([
            'is_active' => $is_active
        ]);

        $user->tokens->each(function ($token) {
            $token->delete();
        });

        return successResponse("Updated succesfuly!");
    }
}
