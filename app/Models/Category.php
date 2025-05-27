<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    use HasFactory, Searchable, Filterable;

    protected $fillable = [
        "name",
        "slug",
        "count",
        "responsible_worker",
    ];

    protected $searchable = [
        "name",
        // "count",
        // "responsible_worker",
    ];

    public function materials(){
        return $this->hasMany(Material::class);
    }
}
