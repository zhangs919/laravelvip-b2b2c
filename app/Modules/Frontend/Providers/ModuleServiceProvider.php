<?php

namespace App\Modules\Frontend\Providers;

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
        // 判断请求来源客户端
        if (is_app()) { // app端
            $tplPath = '';
        } elseif (is_mobile()) { // 手机端
            $tplPath = 'web_mobile';
        } else { // pc端
            $tplPath = 'web';
        }
//        dd(resource_path('views/frontend/'.$tplPath.'/tpl_2018'));
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'frontend');
        $this->loadViewsFrom(resource_path('views/frontend/'.$tplPath.'/tpl_2018'), 'frontend');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'frontend');
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
