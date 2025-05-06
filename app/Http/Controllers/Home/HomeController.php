<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryForHomeResource;
use App\Http\Resources\MaterialForHomeResource;
use App\Http\Resources\MaterialShowForHomeResource;
use App\Http\Resources\SubjectForHomeResource;
use App\Models\Category;
use App\Models\Material;
use App\Models\Subject;
use App\Services\MaterialHomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    protected $materialClass;

    public function __construct()
    {
        $this->materialClass = new MaterialHomeService();
    }

    public function categories(Request $request){
        $model = Category::query()
            ->search($request->search)
            ->withCount(['materials as total_materials'])
            ->get();

        return successResponse(CategoryForHomeResource::collection($model));
    }

    public function subjects(Request $request){
        $model = Subject::query()
            ->search($request->search)
            ->get();

        return successResponse(SubjectForHomeResource::collection($model));
    }

    public function materials(Request $request){

        return $this->materialClass->index();

    }

    public function materialShow(Request $request){

        $model = Material::query()
            ->with('category','subject', 'pages')
            ->where('slug', $request->slug)
            ->first();

        return successResponse(MaterialShowForHomeResource::make($model));
    }

    public function materialDownload(Request $request){

       // Materialni slug bo‘yicha topish
        $model = Material::where('slug', $request->slug)->first();

        // Agar material topilmasa, xatolik qaytarish
        if (!$model) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        $model->update([
            "downloads" => $model->downloads+1
        ]);
        
        $pathExplode = explode("/", $model->path);
        $pathExplode[2] = $pathExplode[1]."-".$model->slug.".zip";
        $modelPath = implode("/",$pathExplode);

        // Fayl yo‘lini olish
        // $filePath = 'public/' . str_replace('.zip', ".".$model->type, $model->path); // Baza maydoniga qarab o‘zgartiring
        $filePath = 'public/' . $modelPath; // Baza maydoniga qarab o‘zgartiring

        // Fayl mavjudligini tekshirish
        if (!Storage::exists($filePath)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        // Faylni yuklab berish
        return Storage::download($filePath, $model->original_name);
    }
}
