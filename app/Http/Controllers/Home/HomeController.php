<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryForHomeResource;
use App\Http\Resources\SubjectForHomeResource;
use App\Models\Category;
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
            ->with('category')
            ->get();

        return successResponse(SubjectForHomeResource::collection($model));
    }

    public function materials(){
        
    }
}
