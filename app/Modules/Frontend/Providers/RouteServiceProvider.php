<?php

namespace App\Modules\Frontend\Providers;

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
    protected $namespace = 'App\Modules\Frontend\Http\Controllers';

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

        //
    }

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
            require module_path('frontend', 'Routes/web.php');
        });*/

        /* 将web中的路由按模块分成多个子文件 */
        // 手机端访问
        $design_page = request()->get('page','');
//        $design_page = empty($design_page) ? str_contains($design_page, 'm_') : false;
        if (is_mobile() || (request()->getHost() == env('MOBILE_DOMAIN')) || $design_page) {
            foreach(glob(module_path('frontend', 'Routes/mobile/*.php'))as $file){
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group($file);
            }
        }

        // PC或app访问
        if (!is_mobile() || (request()->getHost() == env('FRONTEND_DOMAIN'))) {
            foreach(glob(module_path('frontend', 'Routes/pc/*.php'))as $file){
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group($file);
            }
        }
//        else { // PC或app访问
//            foreach(glob(module_path('frontend', 'Routes/pc/*.php'))as $file){
//                Route::middleware('web')
//                    ->namespace($this->namespace)
//                    ->group($file);
//            }
//        }


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
            require module_path('frontend', 'Routes/api.php');
        });*/

        /* 将api中的路由按模块分成多个子文件 */
        foreach(glob(module_path('frontend', 'Routes/api/*.php'))as $file){
            Route::middleware('api')
                ->namespace($this->namespace)
                ->group($file);
        }
    }
}
