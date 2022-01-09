<?php

namespace App\Modules\Backend\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Backend\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the module.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();

        // 将路由按模块分成多个子文件
//        $this->mapRoutes();
    }

    /**
     * 将Web路由按模块分成多个子文件
     */
//    protected function mapRoutes()
//    {
//        /* 将web中的路由按模块分成多个子文件 */
//        foreach(glob(module_path('backend', 'Routes/web/*.php'))as $file){
//            Route::middleware('web')
//                ->namespace($this->namespace)
//                ->group($file);
//        }
//    }

    /**
     * Define the "web" routes for the module.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        /*Route::group([
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require module_path('backend', 'Routes/web.php');
        });*/

        /* 将web中的路由按模块分成多个子文件 */
        foreach(glob(module_path('backend', 'Routes/web/*.php'))as $file){
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group($file);
        }
    }

    /**
     * Define the "api" routes for the module.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        /*Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require module_path('backend', 'Routes/api.php');
        });*/

        /* 将api中的路由按模块分成多个子文件 */
        foreach(glob(module_path('backend', 'Routes/api/*.php'))as $file){
            Route::middleware('api')
                ->namespace($this->namespace)
                ->group($file);
        }
    }
}
