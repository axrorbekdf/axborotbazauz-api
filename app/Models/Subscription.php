<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, Searchable, QueryFilter;

    protected $fillable = [
        "name",
        "price",
        "period",
        "responsible_worker",
    ];

    protected $casts = [
        "period" => "array"
    ];

    protected $searchable = [
        "name",
        "price",
        "period",
        // "responsible_worker",
    ];

    
}
