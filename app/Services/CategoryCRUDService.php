<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryCRUDService extends CRUDService
{
    protected $modelClass = Category::class;
    protected $modelResourceClass = CategoryResource::class;
    protected $withModels = ['subjects', 'files'];
}
