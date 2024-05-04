<?php

namespace App\Kernel\Modules\Base\Http\Controllers;

use Illuminate\Http\Request;

class Store extends Foundation
{

//    protected $menu_select;

    protected $user_info = null;

    protected $user_id = 0;

    public function __construct()
    {
        parent::__construct();

//        $this->load_helper('');

        $this->middleware('auth.store:store');

//        abort(403, '网点管理中心正在开发中...');



        // 商家后台菜单
        // 顶部菜单
//        $top_menus = $this->menus();
//        view()->share('top_menus', $top_menus);
        // 获取当前active module
        $current_path = explode('/', request()->path());

//        if (empty($current_path[0])) {
//            $active_module = 'index';
//            $active_action = 'index';
//        } else {
//            $active_module = $current_path[0];
//            $active_action = explode('/',  request()->path());
//            $active_action = count($active_action) == 3 ? $active_action[1] : $active_action[0];
//        }
//        view()->share('active_module', $active_module); // 当前active 模块 如：goods
//        view()->share('active_action', '/'.$active_action); // 当前active 方法 如：goods/list/index
//
//        // 左侧菜单 根据当前active module 获取该module下的菜单
//        $left_menus = $this->menus($active_module);
//        $left_menus = !empty($left_menus['child']) ? $left_menus['child'] : [];
//        view()->share('left_menus', $left_menus);

        // 设置当前激活url
        $store_active_menu = explode('|', seller_active_menu()['menus']);
        $active_module = $store_active_menu[0];
        $active_action = $store_active_menu[1];
        $this->set_menu_select($active_module, $active_action);


        // 验证是否登录 必须使用中间件方式 否则获取不到用户登录信息
        $this->middleware(function ($request, $next) {

            if (auth('store')->check()) {
                $this->user_info = session('store');
                if (empty($this->user_info)) {
                    $this->user_info = auth('store')->user();
                    $this->user_id = auth('store')->id();
                }else {
                    $this->user_id = session('store')->user_id;
                }
            }

            // 如果某些页面需要登录验证 则判断
//            if (!auth('user')->check()) {
//                redirect('/login.html')->send();exit();
//            }

            view()->share('store', $this->user_info);
            view()->share('user_id', $this->user_id);
//            dd($this->seller_info);

            return $next($request);
        });

    }

    /**
     * 设置当前激活url
     *
     * @param string $active_module 当前模块
     * @param string $active_action 当前控制器
     */
    protected final function set_menu_select($active_module = '', $active_action = '')
    {
        $menu_select = ['action'=>$active_module, 'current'=>$active_action];
        view()->share('menu_select', $menu_select);
    }

    protected final function sublink($links = [], $actived = '', $group = '', $extra = '', $filter_link = '')
    {

        $fixedBarStr = '';
        $titleBarStr = '';
        foreach ($links as $key => $value) {
            $array = explode('/', $value['url']);
            if (empty($array[2])) $array[2] = 'index';
//            if (!$this->checkPermission($array)) continue;

            // 过滤add方法
            if ($filter_link != '' && in_array($array[2], explode(',', $filter_link))) {
                unset($key);
                continue;
            }

            // url 处理
            $url = '/'.$value['url'].$extra;


            /* 如果$group = type 则将data-tab-id设置为tab_$key 否则设置为$array[2]*/
            if ($group != '') {
                // 如果是带?group=foo格式的url
                $actActived = !empty(explode($group.'=', $value['url'])[1]) ? explode($group.'=', $value['url'])[1] : $array[2];
                $data_tab_id = $actActived;
                if ($group == 'type') {
                    $data_tab_id = $key;
                }
            } else {
                // 普通格式：System/Config/index 或者System/admin/admin_list
                $actActived = $array[2];
//                $actActived = strtolower($array[1]).'_'.$array[2];
                $data_tab_id = $actActived;

                $actArr = explode('_', $array[2]);
                if (count($actArr) == 2) {
                    $url = '/'.$array[0].'/'.$array[1].'/'.$actArr[1].$extra;
                }
            }

            if ($actActived == $actived || $value['url'] == \request()->path()) {
                $li_attr = "class=\"active\"";
            } else {
                $li_attr = "";
            }

            $fixedBarStr .= sprintf('<li %s><a href='.$url.'>%s</a></li>', $li_attr, $value['text']);
        }

        $fixedBarHtml = "<ul class=\"tab\">{$fixedBarStr}</ul>";

        view()->share('fixedBarHtml', $fixedBarHtml);
    }


}