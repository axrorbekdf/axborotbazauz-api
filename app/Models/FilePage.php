<?php

namespace App\Models;

use App\Filter\Trait\QueryFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilePage extends Model
{
    use HasFactory, Searchable, QueryFilter;

    protected $fillable = [
        "file_id",
        "number",
        "content",
        "previewPath",
        "responsible_worker",
    ];

    protected $searchable = [
        "file.name",
        "number",
        "content",
        "previewPath",
        "responsible_worker",
    ];

    public function file(){
        return $this->belongsTo(File::class);
    }
}
