<?php

namespace App\Modules\Frontend;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WebServiceProvider extends ServiceProvider
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

        // 判断请求来源客户端
		$tplPath = 'web';
//		Log::stack(['api'])->error('web');
//		Log::stack(['api'])->error(request()->getHost());
        // 视图
//        $this->loadViewsFrom(resource_path('views/frontend/' . $tplPath . '/tpl_2018'), 'frontend');
        //        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'frontend');

        // 语言包
        $this->loadTranslationsFrom(__DIR__ . '/Resources/Lang', 'frontend');

        // 数据库迁移
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        // 路由
        $this->registerRoute($router);

        // 命令
        if ($this->app->runningInConsole()) {
            // 发布Seeder文件
            // php artisan vendor:publish --provider="App\Modules\Frontend\FrontendServiceProvider" --tag=seeds --force
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
		if (!$this->app->routesAreCached()) {
			// pc
			$routes = glob(app_path('Modules/Frontend/Routes/pc/*.php'));
			foreach ($routes as $file) {
				$router->middleware('web')
					->namespace($this->namespace)
					->group($file);
			}
		}
	}
}
