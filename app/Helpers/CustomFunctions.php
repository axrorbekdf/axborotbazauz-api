<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        if ($date) return Carbon::parse($date)->format('d.m.Y');
        else return null;
    }
}

if (!function_exists('dateTimeFormat')) {
    function dateTimeFormat($date)
    {
        if ($date) return Carbon::parse($date)->format('d.m.Y H:i:s');
        else return null;
    }
}

if (!function_exists('createUniqueSlug')) {
    function createUniqueSlug($name, $model)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;

        $count = 1;
        while ($model::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
