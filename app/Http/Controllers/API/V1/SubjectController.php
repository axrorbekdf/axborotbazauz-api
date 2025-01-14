<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\SubjectDTO;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Services\SubjectCRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    protected $serviceClass;
    protected $classDTO;

    public function __construct()
    {
        $this->serviceClass = new SubjectCRUDService();
        $this->classDTO = new SubjectDTO();
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
            "slug" => createUniqueSlug(request()->name, Subject::class),
            "count" => request()->count,
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
            "slug" => createUniqueSlug(request()->name, Subject::class),
            "count" => request()->count,
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
