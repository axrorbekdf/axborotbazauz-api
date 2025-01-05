<?php

namespace App\Services;

use App\Http\Resources\FileResource;
use App\Models\File;

class FileCRUDService extends CRUDService
{
    protected $modelClass = File::class;
    protected $modelResourceClass = FileResource::class;
    protected $withModels = ['category','subject'];
}
