<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Has Role
        Blade::if('hasrole', function () {
            $role = false;

            if (auth()->user() && auth()->user()->role != 0) {
                if (count(auth()->user()->role->permissions) != 0) {
                    $role = true;
                }
            }

            return $role;
        });
    }
}
