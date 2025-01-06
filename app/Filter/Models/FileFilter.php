<?php

namespace App\Filter\Models;

use App\Filter\Abstract\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class FileFilter extends QueryFilter
{
    public function category(Builder $query, $value): void
    {
        $query->where('category_id', $value);
    }

    public function subject(Builder $query, $value): void
    {
        $query->where('subject_id', $value);
    }
}
