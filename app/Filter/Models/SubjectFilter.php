<?php

namespace App\Filter\Models;

use App\Filter\Abstract\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class SubjectFilter extends QueryFilter
{
    public function category(Builder $query, $value): void
    {
        $query->where('category_id', $value);
    }
}
