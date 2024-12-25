<?php

namespace App\Filter\Abstract;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Filtrlash jarayonini amalga oshiradi.
     *
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter) && !is_null($value)) {
                $this->$filter($query, $value);
            }
        }

        return $query;
    }

    /**
     * Filtrlarning ro'yxatini qaytaradi.
     *
     * @return array
     */
    protected function filters(): array
    {
        return $this->request;
    }
}
