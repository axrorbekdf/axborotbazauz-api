<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\FileDTO;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Services\FileCRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    protected $serviceClass;
    protected $classDTO;

    public function __construct()
    {
        $this->serviceClass = new FileCRUDService();
        $this->classDTO = new FileDTO();
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
            "title" => request()->title,
            "slug" => createUniqueSlug(request()->name, File::class),
            "downloads" => request()->downloads,
            "category_id" => request()->category_id,
            "subject_id" => request()->subject_id,
            "path" => request()->path,
            "size" => request()->size,
            "type" => request()->type,
            "responsible_worker" => Auth::user()->name ?? "Not name",
        ]);
        
        if(is_array($data))
            return $data;

        return $this->serviceClass->store($data->toArray());
       
    }

    public function update(string $id){

        $data = $this->classDTO->fromRequest([
            "title" => request()->title,
            "slug" => createUniqueSlug(request()->name, File::class),
            "downloads" => request()->downloads,
            "category_id" => request()->category_id,
            "subject_id" => request()->subject_id,
            "path" => request()->path,
            "size" => request()->size,
            "type" => request()->type,
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
