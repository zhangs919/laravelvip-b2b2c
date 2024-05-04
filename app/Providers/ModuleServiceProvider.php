<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $services = glob(app_path('Modules/*/*ServiceProvider.php'));

        foreach ($services as $service) {
            $slice = explode('/', $service);

            $module = $slice[count($slice) - 2];
            $this->app->register('App\Modules\\' . $module . '\\' . basename($service, '.php'));
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
