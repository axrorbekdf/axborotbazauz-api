<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, Searchable, QueryFilter;

    protected $fillable = [
        "name",
        "responsible_worker"
    ];

    protected $searchable = [
        "name",
        "responsible_worker"
    ];
}
