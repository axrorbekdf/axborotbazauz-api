<?php

use Carbon\Carbon;

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
