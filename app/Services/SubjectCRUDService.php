<?php

namespace App\Services;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;

class SubjectCRUDService extends CRUDService
{
    protected $modelClass = Subject::class;
    protected $modelResourceClass = SubjectResource::class;
    protected $withModels = ['category', 'materials'];
}
