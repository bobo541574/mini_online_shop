<?php

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

if (!function_exists('strtoslug')) {
    function strtoslug($arg, $timestamp = true): string
    {
        $time = '';
        if ($timestamp) {
            $time = str_replace(':', '-', Carbon::now());
        }

        if (is_array($arg)) {
            return Str::slug(implode("-", str_replace('.', '-', $arg)) . '-' . $time);
        }

        return Str::slug(str_replace('.', '-', $arg) . '-' . $time);
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission): bool
    {
        $user = auth()->user();
        if ($user) {
            return in_array($permission, $user->role->permissions->pluck('slug')->toArray());
        }
        return false;
    }
}

if (!function_exists('pluck_relation')) {
    function pluck_relation($role): array
    {
        return $role->permissions->pluck('id')->toArray();
    }
}
