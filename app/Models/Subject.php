<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, Searchable, QueryFilter;

    protected $fillable = [
        "name",
        "slug",
        "count",
        "category_id",
        "responsible_worker",
    ];

    protected $searchable = [
        "name",
        "count",
        "responsible_worker",
        "category.name"
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function materials(){
        return $this->hasMany(Material::class);
    }
}
