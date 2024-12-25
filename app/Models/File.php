<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, Searchable, QueryFilter;

    protected $fillable = [
        "title",
        "slug",
        "downloads",
        "category_id",
        "subject_id",
        "path",
        "size",
        "type",
        "responsible_worker",
    ];

    protected $searchable = [
        "title",
        "slug",
        "downloads",
        "category.name",
        "subject.name",
        "size",
        "type",
        "responsible_worker",
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function pages(){
        return $this->hasMany(FilePage::class);
    }
}
