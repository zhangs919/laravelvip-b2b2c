<?php

namespace App\Modules\Store\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'store');
//        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'store');
        $this->loadViewsFrom(resource_path('views/store/web/tpl_2018'), 'store');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'store');
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
