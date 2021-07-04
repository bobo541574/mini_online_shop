<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BaldeServiceProvider extends ServiceProvider
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

            if (auth()->user()) {
                $role = auth()->user()->role_id;
            }

            return $role;
        });
    }
}
