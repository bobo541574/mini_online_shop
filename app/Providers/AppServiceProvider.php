<?php

namespace App\Providers;

use App\Models\ProductAttribute;
use App\Observers\ProductAttributeObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }

        Paginator::useBootstrap();

        // ProductAttribute::observe(ProductAttributeObserver::class);
    }
}
