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
//        $cur_domain = $_SERVER['HTTP_HOST'];
        $cur_domain = $request->getHost();

        /**
         * 设置模板路径
         */
        $module = '';
        if ($cur_domain == config('lrw.frontend_domain') || $cur_domain == config('lrw.goods_detail_domain')) {
            $module = 'Frontend';
        } elseif ($cur_domain == config('lrw.backend_domain')) {
            $module = 'Backend';
        } elseif ($cur_domain == config('lrw.seller_domain')) {
            $module = 'Seller';
        } elseif ($cur_domain == config('lrw.store_domain')) {
            $module = 'Store';
        } elseif ($cur_domain == config('lrw.mobile_domain') || $cur_domain == config('lrw.api_domain') || $cur_domain == config('lrw.mobile_goods_detail_domain')) {
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

        // 重新定义站点目录


        return $next($request);
    }
}
