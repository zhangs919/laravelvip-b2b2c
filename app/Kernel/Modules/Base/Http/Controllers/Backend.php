<?php

namespace App\Kernel\Modules\Base\Http\Controllers;


class Backend extends Foundation
{
    protected $admin_info = null;

    protected $admin_id = 0;

    /**
     * 权限内容
     */
    protected $permission;

    public function __construct()
    {
        parent::__construct();

//        $this->load_helper('');

        $this->middleware('auth.admin:admin');

        // 验证是否登录  必须使用中间件方式 否则获取不到用户登录信息
        $this->middleware(function ($request, $next) {

            // 当前激活url
            list($active_url, $active_menus) = get_backend_active_menus();

            view()->share('active_url', $active_url);
            view()->share('active_menus', $active_menus);

            if (auth('admin')->check()) {
                $this->admin_info = session('admin');
                if (empty($this->admin_info)) {
                    $this->admin_info = auth('admin')->user();
                    $this->admin_id = auth('admin')->id();
                }else {
                    $this->admin_id = session('admin')->user_id;
                }

                //解析权限组权限
                $role_auth_codes = unserialize(backend_decrypt($this->admin_info->adminRole->auth_codes, MD5_KEY)) ?: [];
                // 解析管理员额外权限
                $admin_auth_codes = unserialize(backend_decrypt($this->admin_info->auth_codes, $this->admin_info->auth_key)) ?: [];
                $auth_codes = array_merge($role_auth_codes, $admin_auth_codes);

                $this->permission = $auth_codes;

                $request_route = @$request->route()->action['as'];
                if (empty($auth_codes)) {
                    $auth_codes = [];
                }
                if ($this->admin_id != 1 && !empty($request_route) && !in_array($request_route, $auth_codes) && \request()->getPathInfo() != '/') {
                    // 超级管理员不验证权限
                    // 无访问权限 通过路由来判断是否有权限 admin_node表中routes字段存储该权限节点路由地址即可
                    if ($request->ajax()) {
                        // ajax 请求 返回json
                        return result(-1, '', '对不起，您现在还没有获得此操作的权限');
                    }
                    abort(403, '对不起，您现在还没有获得此操作的权限');
                }
            }

            // 如果某些页面需要登录验证 则判断
//            if (!auth('user')->check()) {
//                redirect('/login.html')->send();exit();
//            }
            view()->share('admin', $this->admin_info);
            view()->share('admin_id', $this->admin_id);

            return $next($request);
        });

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
                $actActived = isset(explode($group.'=', $value['url'])[1]) ? explode($group.'=', $value['url'])[1] : $array[2];
//                $actActived = explode($group.'=', $value['url'])[1];
                $data_tab_id = $actActived;
                if ($group == 'type') {
                    $data_tab_id = $key;
                }
            } else {
                // 普通格式：System/Config/index 或者System/admin/admin_list
                $actActived = $array[2];
//                $actActived = strtolower($array[1]).'_'.$array[2];
                $data_tab_id = $actActived;

                if (!str_contains($array[2], '?')) {
                    $actArr = explode('_', $array[2]);
                    if (count($actArr) == 2) {
                        $url = '/'.$array[0].'/'.$array[1].'/'.$actArr[1].$extra;
                    }
                }

            }

            if ($actActived == $actived) {
                $a_attr = "class=\"current\" data-tab-id=\"tab_{$data_tab_id}\" data-tab-current=\"true\"";
            } else {
                $a_attr = "href=\"{$url}\" onclick=\"if($.loading){ $.loading.start(); }\" data-tab-id=\"tab_{$data_tab_id}\"";
            }

            $fixedBarStr .= sprintf('<li><a %s><span>%s</span></a></li>', $a_attr, $value['text']);
            $titleBarStr .= sprintf('<li role="presentation"><a %s>%s</a></li>', "href=\"{$url}\" data-tab-id=\"tab_{$data_tab_id}\"", $value['text']);
        }
        $fixedBarHtml = "<ul class=\"tab-base shop-row\">{$fixedBarStr}</ul>";
        $titleBarHtml = "<ul class=\"dropdown-menu flipInX animated\" role=\"menu\" aria-labelledby=\"dropdownTab\">{$titleBarStr}</ul>";

        view()->share('fixedBarHtml', $fixedBarHtml);
        view()->share('titleBarHtml', $titleBarHtml);
//        return [$fixedBarHtml, $titleBarHtml];
    }

}
