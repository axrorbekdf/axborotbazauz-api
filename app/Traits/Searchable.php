<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

trait Searchable
{

    public function scopeSearch(Builder $builder, $term = '')
    {
        // if (!$this->searchable) {
        //     throw new Exception('Searchable property is not added!');
        // }

        // if (!$term) $term = '';

        // $split = explode(" ", $term);

        // foreach ($this->searchable as $searchable) {

        //     if (str_contains($searchable, '.')) {
        //         $relation = Str::beforeLast($searchable, '.');
        //         $column = Str::afterLast($searchable, '.');

        //         $builder->orWhere(function ($query) use ($split, $relation, $column) {
        //             foreach ($split as $val) {
        //                 $query->whereRelation($relation, $column, 'like', "%$val%");
        //             }
        //         });

        //         continue;
        //     }

        //     $builder->orWhere(function ($query) use ($split, $searchable) {
        //         foreach ($split as $val) {
        //             $query->where($searchable, 'like', "%$val%");
        //         }
        //     });
        // }
        // return $builder;

        if (!$this->searchable) {
            throw new Exception('Searchable property is not added!');
        }
    
        if (!$term) return $builder;
    
        $builder->where(function ($query) use ($term) {
            foreach ($this->searchable as $column) {
                if (str_contains($column, '.')) {
                    [$relation, $col] = explode('.', $column);
                    $query->orWhereRelation($relation, $col, 'like', "%$term%");
                } else {
                    $query->orWhere($column, 'like', "%$term%");
                }
            }
        });
    
        return $builder;
    }
}
