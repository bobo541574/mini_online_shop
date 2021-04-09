<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('strtoslug')) {
    function strtoslug(...$args)
    {
        return Str::slug(implode("-", $args) . '-' . str_replace(':', '-', Carbon::now()));
    }
}
