<?php

namespace App\Providers;

use Elasticsearch\ClientBuilder as ESClientBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 生产环境不抛出NOTICE|WARNING
        if (in_array(request()->server('REMOTE_ADDR'), ['127.0.0.1', '::1'])) {
            error_reporting(E_ALL);
        } else {
            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        }

        // 
        Carbon::setLocale('zh');

        // 设置 Nginx 反向代理模式下 Scheme 参数
        if (substr(config('app.url'), 0, 5) === 'https') {
            URL::forceScheme('https');
        }

        // 从数据库后台读取配置信息 todo
        $config = [];

        // 定义全局语言包类型
        Config::set('app.locale', $config['lang'] ?? 'zh_cn');

    

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        // 往服务容器中注入一个名为 es 的单例对象
        $this->app->singleton('es', function () {
            // 从配置文件读取 Elasticsearch 服务器列表
            $builder = ESClientBuilder::create()->setHosts(config('database.elasticsearch.hosts'));
            // 如果是开发环境
            if (app()->environment() == 'local') {
                // 配置日志，Elasticsearch 的请求和返回数据将打印到日志文件中，方便我们调试
                $builder->setLogger(app('log')->driver());
            }

            return $builder->build();
        });
    }
}
