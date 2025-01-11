<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory, Searchable, QueryFilter;

    protected $fillable = [
        "title",
        "slug",
        "category_id",
        "subject_id",
        "downloads",
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
        "pages.content"
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function pages(){
        return $this->hasMany(MaterialPage::class);
    }
}
