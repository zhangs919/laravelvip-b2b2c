<?php

namespace App\Modules\Backend\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'backend');
        $this->loadViewsFrom(resource_path('views/backend/web/tpl_2018'), 'backend');
//        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'backend');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'backend');
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
