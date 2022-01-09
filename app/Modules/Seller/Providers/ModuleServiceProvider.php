<?php

namespace App\Modules\Seller\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'seller');
//        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'seller');
        $this->loadViewsFrom(resource_path('views/seller/web/tpl_2018'), 'seller');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'seller');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
