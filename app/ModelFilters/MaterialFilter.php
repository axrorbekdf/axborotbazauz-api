<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class MaterialFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];


    public function category($category_id)
    {
        $this->where('category_id', $category_id);
    }

    public function subject($subject_id)
    {
        $this->where('subject_id', $subject_id);
    }

    public function categorySlug($slug)
    {
        $this->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function subjectSlug($slug)
    {
        $this->whereHas('subject', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }
}
