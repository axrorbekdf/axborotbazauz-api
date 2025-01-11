<?php

namespace App\Http\Controllers\API\V1;

use App\DTO\MaterialDTO;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Services\MaterialCRUDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    protected $serviceClass;
    protected $classDTO;

    public function __construct()
    {
        $this->serviceClass = new MaterialCRUDService();
        $this->classDTO = new MaterialDTO();
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
            "slug" => createUniqueSlug(request()->title, Material::class),
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
            "slug" => createUniqueSlug(request()->title, Material::class),
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


    public function readPdfAndReadWordPages(Request $request){

        // Validayatsiya

        $validate = validate($request->all(), [
            'file' => 'required|mimes:pdf,docx,doc,pptx,ppt|max:20480', // Faqat PDF,PPT,DOC fayllar uchun
        ]);
    
        if ($validate !== true) return $validate;
        
        // Faylni yuklash
        $file = $request->file('file');

        return $this->serviceClass->readPdfAndReadWordPages($file);
       
    }
}
