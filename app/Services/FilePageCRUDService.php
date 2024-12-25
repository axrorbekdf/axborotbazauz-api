<?php

namespace App\Services;

use App\Http\Resources\FilePageResource;
use App\Models\FilePage;

class FilePageCRUDService extends CRUDService
{
    protected $modelClass = FilePage::class;
    protected $modelResourceClass = FilePageResource::class;
    protected $withModels = ['files'];
}
