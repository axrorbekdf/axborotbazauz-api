<?php

namespace App\Filter\Trait;

use Illuminate\Database\Eloquent\Builder;

trait QueryFilter
{
    /**
     * Filtrlarni qo'llash uchun scope.
     *
     * @param Builder $builder
     * @param $request
     * @return Builder
     */
    public function scopeFilter(Builder $builder, $request): Builder
    {
        // Model nomidan foydalanib Filter sinfini aniqlash
        $filterClass = $this->getFilterClass();

        if (class_exists($filterClass)) {
            $filter = new $filterClass($request); // Filter sinfini yarating
            return $filter->apply($builder);       // Filterni qo'llash
        }

        return $builder; // Agar filter sinfi topilmasa, filtr qo'llanmaydi
    }

    /**
     * Modelga mos keluvchi Filter sinf nomini aniqlash.
     *
     * @return string
     */
    protected function getFilterClass(): string
    {
        $modelName = class_basename($this); // Model nomini olish, masalan: 'User'
        return "App\\Filter\\Models\\{$modelName}Filter"; // Filter sinfi nomini qaytarish
    }
}
