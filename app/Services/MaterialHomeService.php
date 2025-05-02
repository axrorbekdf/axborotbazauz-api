<?php

namespace App\Services;

use App\Http\Resources\MaterialForHomeResource;
use App\Models\Material;

class MaterialHomeService extends CRUDService
{
    protected $modelClass = Material::class;
    protected $modelResourceClass = MaterialForHomeResource::class;
    protected $withModels = ['category','subject', 'pages'];

}
