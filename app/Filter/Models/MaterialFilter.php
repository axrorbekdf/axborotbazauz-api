<?php

namespace App\Filter\Models;

use App\Filter\Abstract\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class MaterialFilter extends QueryFilter
{
    public function categoryId(Builder $query, $value): void
    {
        $query->where('category_id', $value);
    }

    public function subjectId(Builder $query, $value): void
    {
        $query->where('subject_id', $value);
    }

    public function categorySlug(Builder $query, $value): void
    {
        $query->whereHas('category', function ($query) use ($value) {
            $query->where('slug', $value);
        });
    }

    public function subjectSlug(Builder $query, $value): void
    {
        $query->whereHas('subject', function ($query) use ($value) {
            $query->where('slug', $value);
        });
    }
}
