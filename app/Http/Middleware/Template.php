<?php

namespace App\Http\Middleware;

use Closure;

/**
 * PC、Mobile自动判断模板渲染
 * 根据不同的二级域名 渲染不同的模板
 *
 * Class Template
 * @package App\Http\Middleware
 */
class Template
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cur_domain = $_SERVER['HTTP_HOST'];

        /**
         * 设置模板路径
         */
        $module = '';
        if ($cur_domain == env('FRONTEND_DOMAIN') || $cur_domain == env('GOODS_DETAIL_DOMAIN')) {
            $module = 'Frontend';
        } elseif ($cur_domain == env('BACKEND_DOMAIN')) {
            $module = 'Backend';
        } elseif ($cur_domain == env('SELLER_DOMAIN')) {
            $module = 'Seller';
        } elseif ($cur_domain == env('STORE_DOMAIN')) {
            $module = 'Store';
        } elseif ($cur_domain == env('MOBILE_DOMAIN') || $cur_domain == env('MOBILE_GOODS_DETAIL_DOMAIN')) {
            $module = 'Mobile';
        }

        $view_path = '';
        if ($module != '') {
            $view_path = resource_path('views/'.strtolower($module).'/web/tpl_2018');
            if ($module == 'Mobile') {
                $view_path = resource_path('views/frontend/web_mobile/tpl_2018');
            }
        //    $view_path = app_path('Modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views');
        }

        // 获取视图查找器实例
        $view = app('view')->getFinder();
        // 重新定义视图目录
        $view->prependLocation($view_path);

        return $next($request);
    }
}
