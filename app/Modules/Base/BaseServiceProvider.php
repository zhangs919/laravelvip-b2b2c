<?php

namespace App\Modules\Base;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Base\Http\Controllers';

    /**
     * Register services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {

        // 视图
        $this->loadViewsFrom(resource_path('views/base/web/tpl_2018'), 'base');
        //        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'base');

        // 语言包
        $this->loadTranslationsFrom(__DIR__ . '/Resources/Lang', 'base');

        // 数据库迁移
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        // 路由
        $this->registerRoute($router);

        // 命令
        if ($this->app->runningInConsole()) {
            // 发布Seeder文件
            // php artisan vendor:publish --provider="App\Modules\Base\BaseServiceProvider" --tag=seeds --force
            $this->publishes([
                __DIR__ . '/Database/Seeds' => $this->app->databasePath('seeds')
            ], 'seeds');
        }
    }

   /**
     * Register routes.
     *
     * @param $router
     */
    protected function registerRoute(Router $router)
    {
//        if (!$this->app->routesAreCached()) {
//            $routes = glob(app_path('Modules/Base/Routes/web/*.php'));
//            foreach ($routes as $file) {
//                $router->middleware('web')
//                    ->namespace($this->namespace)
//                    ->group($file);
//            }
//
//            $router->middleware('api')->namespace($this->namespace)->group(__DIR__ . '/Routes/api/api.php');
//        }
    }
}