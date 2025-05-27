<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPage extends Model
{
    use HasFactory, Searchable, Filterable;

    protected $fillable = [
        "material_id",
        "number",
        "content",
        "previewPath",
        "responsible_worker",
    ];

    protected $searchable = [
        // "material.name",
        // "number",
        "content",
        // "previewPath",
        // "responsible_worker",
    ];

    public function material(){
        return $this->belongsTo(Material::class);
    }
}
