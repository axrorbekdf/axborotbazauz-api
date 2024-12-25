<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    use HasFactory, Searchable, QueryFilter;

    protected $fillable = [
        "name",
        "slug",
        "count",
        "responsible_worker",
    ];

    protected $searchable = [
        "name",
        "count",
        "responsible_worker",
    ];

    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }
}
