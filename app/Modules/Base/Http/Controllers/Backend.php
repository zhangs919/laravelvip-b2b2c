<?php

namespace App\Modules\Base\Http\Controllers;

use App\Models\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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


        // 检查是否有访问权限 todo 等权限系统做完善了再写这里的代码
//        abort(403, '对不起，您现在还没有获得此操作的权限');

        // 验证是否登录 todo 必须使用中间件方式 否则获取不到用户登录信息
        $this->middleware(function ($request, $next) {

            // 当前激活url
            list($active_url, $active_menus) = get_backend_active_menus();
            view()->share('active_url', $active_url);
            view()->share('active_menus', $active_menus);


//            Response::withCookie('lastmenus', implode('|', $active_menus), 7);
//            cookie('lastmenus', implode('|', $active_menus));

            if (auth('admin')->check()) {
                $this->admin_info = session('admin');
                if (empty($this->admin_info)) {
                    $this->admin_info = auth('admin')->user();
                    $this->admin_id = auth('admin')->id();
                }else {
                    $this->admin_id = session('admin')->user_id;
                }

                $auth_id = $this->admin_info->role_id; // 权限id
                $auth_info = AdminRole::where('role_id', $auth_id)->select(['role_id', 'role_name', 'auth_codes'])->first();
                //解析已有权限
//                $auth_codes = unserialize(backend_decrypt($auth_info->auth_codes, MD5_KEY.md5($auth_info->role_name)));
//                dd(backend_decrypt($auth_info->auth_codes, MD5_KEY));
                $auth_codes = unserialize(backend_decrypt($auth_info->auth_codes, MD5_KEY));
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
//            dd($this->admin);


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


            /*todo 如果$group = type 则将data-tab-id设置为tab_$key 否则设置为$array[2]*/
            if ($group != '') {
                // 如果是带?group=foo格式的url
                $actActived = !empty(explode($group.'=', $value['url'])[1]) ? explode($group.'=', $value['url'])[1] : $array[2];
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

                $actArr = explode('_', $array[2]);
                if (count($actArr) == 2) {
                    $url = '/'.$array[0].'/'.$array[1].'/'.$actArr[1].$extra;
                }
            }


//            dd($actActived);
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