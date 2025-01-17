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
use Illuminate\Http\Request;

class HomeController extends Controller
{
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

        $model = Material::query()
            ->with('category','subject', 'pages')
            ->search($request->search)
            ->filter($request->all())
            ->paginate($request->perPage ?? 10);

        return successResponse(MaterialForHomeResource::collection($model));
    }

    public function materialShow(Request $request){

        $model = Material::query()
            ->with('category','subject', 'pages')
            ->where('slug', $request->slug)
            ->first();

        return successResponse(MaterialShowForHomeResource::make($model));
    }
}
