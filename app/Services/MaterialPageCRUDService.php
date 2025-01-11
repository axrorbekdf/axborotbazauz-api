<?php

namespace App\Services;

use App\Http\Resources\MaterialPageResource;
use App\Models\MaterialPage;

class MaterialPageCRUDService extends CRUDService
{
    protected $modelClass = MaterialPage::class;
    protected $modelResourceClass = MaterialPageResource::class;
    protected $withModels = ['material'];
}
