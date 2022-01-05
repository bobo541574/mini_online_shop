<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

if (!function_exists('strtoslug')) {
    function strtoslug($arg, $timestamp = true, $sperator = "-"): string
    {
        $time = '';
        if ($timestamp) {
            if (is_bool($timestamp)) {
                $time = '-' . str_replace(':', '-', Carbon::now());
            } else {
                $time = '-' . str_replace(':', '-', Carbon::parse($timestamp)->format('Y-m-d-g-i-s'));
            }
        }

        if (is_array($arg)) {
            return Str::slug(implode($sperator, str_replace('.', '-', $arg)) . $time);
        }

        return Str::slug(str_replace('.', '-', $arg) . $time);
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission): bool
    {
        $user = auth()->user();

        if (Cache::has('permissions') && session('auth_user_id') == $user->id) {
            $cachePermissions = Cache::get('permissions');
        } else {
            Cache::put('permissions', $user->role->permissions, 86400);
            $cachePermissions = $user->role->permissions;
            session()->put('auth_user_id', $user->id);
        }

        if ($user && $user->role) {
            if ($cachePermissions) {
                return in_array($permission, $cachePermissions->pluck('slug')->toArray());
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

// Image Retrieve From Storage
if (!function_exists('image_url')) {
    function image_url($data)
    {
        if (config('app.env') === 'production') {
            return 'http://mini-online-shop.test/' . $data;
        }
        return 'http://mini-online-shop.test/storage' . $data;
    }
}

// Table Body Font Weight Change With Locale
if (!function_exists('table_font_with_locale')) {
    function table_font_with_locale()
    {
        return (session('locale') === "mm") ? "fw-bold" : '';
    }
}
