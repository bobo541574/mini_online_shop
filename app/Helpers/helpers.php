<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('strtoslug')) {
    function strtoslug($arg, $timestamp = true, $sperator = "-"): string
    {
        $time = '';
        if ($timestamp) {
            $time = str_replace(':', '-', Carbon::now());
        }

        if (is_array($arg)) {
            return Str::slug(implode($sperator, str_replace('.', '-', $arg)) . '-' . $time);
        }

        return Str::slug(str_replace('.', '-', $arg) . '-' . $time);
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission): bool
    {
        $user = auth()->user();

        if ($user) {
            if ($user->role->permissions) {
                return in_array($permission, $user->role->permissions->pluck('slug')->toArray());
            }
            return false;
        }
        return false;
    }
}

if (!function_exists('check_active')) {
    function check_active($url): string
    {
        if (url()->current() != $url)
            return "text-light";
        return '';
    }
}

if (!function_exists('pluck_relation')) {
    function pluck_relation($role): array
    {
        return $role->permissions->pluck('id')->toArray();
    }
}

if (!function_exists('multiple_selected')) {
    function multiple_selected($old, $id)
    {
        if (isset($old, $id)) {
            return in_array($id, $old) ? "selected=selected" : '';
        }

        return false;
    }
}

if (!function_exists('numberTranslate')) {
    function numberTranslate($data)
    {
        $array = [];
        $temp = str_split($data, 1);
        foreach ($temp as $value) {
            $array[] = trans($value, [], session('locale'));
        }
        return implode("", $array);
    }
}
