<?php

namespace App\Kernel\Modules\Base\Http\Controllers;


class Seller extends Foundation
{

    protected $seller_info = null;

    protected $seller_id = 0;

    protected $shop_info = null; // 店铺信息

    protected $shop_id = 0; // 店铺id

    /*以下方法是新的基类方法*/
    protected $app_extra_data = null;
    protected $app_data = null;
    protected $web_data = null;
    protected $compact_data = null;
    protected $tpl_view = null;

    protected $menu_select = [];
    protected $fixedBarHtml = '';
    protected $titleBarHtml = '';
    protected $messageCount = 0;


    /**
     * 权限内容
     */
    protected $permission;

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth.seller:seller');

        // 清除view缓存 否则页面参数会缓存 显示不正常
		view()->share('menu_select', ['action'=>'', 'current'=>'']);
		view()->share('fixedBarHtml', '');
		view()->share('titleBarHtml', '');
		view()->share('messageCount', 0);

        // 设置当前激活url
        $seller_active_menu = explode('|', seller_active_menu()['menus']);
        $active_module = $seller_active_menu[0];
        $active_action = $seller_active_menu[1];
        $this->set_menu_select($active_module, $active_action);


        // 验证是否登录 todo 必须使用中间件方式 否则获取不到用户登录信息
        $this->middleware(function ($request, $next) {

            if (auth('seller')->check()) {
                $this->seller_info = session('seller');
                if (empty($this->seller_info)) {
                    $this->seller_info = auth('seller')->user();
                    $this->seller_id = auth('seller')->id();
                }else {
                    $this->seller_id = session('seller')->user_id;
                }

                //解析权限组权限
                $role_auth_codes = !empty($this->seller_info->shopRole->auth_codes) ? unserialize(backend_decrypt($this->seller_info->shopRole->auth_codes, MD5_KEY)) : [];
                // 解析管理员额外权限
                $admin_auth_codes = !empty($this->seller_info->auth_codes) ? unserialize(backend_decrypt($this->seller_info->auth_codes, $this->seller_info->auth_key)) : [];
                $auth_codes = array_merge($role_auth_codes, $admin_auth_codes);

                $this->permission = $auth_codes;
                $request_route = @$request->route()->action['as'];
                if (empty($auth_codes)) {
                    $auth_codes = [];
                }

                if ($this->seller_id != seller_shop_info()->user_id &&
                    !empty($request_route)
                    && !in_array($request_route, $auth_codes)
                    && $request_route != 'seller_home'
                ) {
                    // 店主管理员不验证权限
                    // 无访问权限 通过路由来判断是否有权限 shop_node表中routes字段存储该权限节点路由地址即可
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

            view()->share('seller', $this->seller_info);
            view()->share('seller_id', $this->seller_id);
            view()->share('shop', seller_shop_info());

            $messageCount = 5; // todo 获取店铺未读消息

			$this->messageCount = $messageCount;

            $this->shop_info = seller_shop_info();
            $this->shop_id = seller_shop_info()->shop_id ?? 0;

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
		$this->menu_select = $menu_select;
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
            if ($filter_link != '' && (in_array($array[2], explode(',', $filter_link)) || in_array($value['url'], explode(',', $filter_link)))) {
                unset($key);
                continue;
            }

            // url 处理
            $url = '/'.$value['url'].$extra;


            /*todo 如果$group = type 则将data-tab-id设置为tab_$key 否则设置为$array[2]*/
            if ($group != '') {
                // 如果是带?group=foo格式的url
                $actActived = isset(explode($group.'=', $value['url'])[1]) ? explode($group.'=', $value['url'])[1] : $array[2];
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
		$this->fixedBarHtml = $fixedBarHtml;
		$this->titleBarHtml = $titleBarHtml;
    }


    /*以下方法是新的基类方法 为了缩减代码量 复用代码 PC端、APP端两端共用一个方法*/


    /**
     * 设置数据
     *
     * @param $data
     * $data => [
     *  'app_extra_data' => [], app额外数据部分
     *  'app_prefix_data' => [], app数据前部分
     *  'app_context_data' => [], app数据context部分
     *  'app_suffix_data' => [], app数据后部分
     *  'web_data' => [], 前端数据对象
     *  'compact_data' => [], 需要渲染到模板的数据对象
     *  'tpl_view' => [], 渲染模板路径
     * ]
     */
    protected final function setData($data)
    {
        $appExtraData = !empty($data['app_extra_data']) ? $data['app_extra_data'] : [];
        $appPrefixData = !empty($data['app_prefix_data']) ? $data['app_prefix_data'] : [];
        $appContext = !empty($data['app_context_data']) ? $data['app_context_data'] : [];
        $appSuffixData = !empty($data['app_suffix_data']) ? $data['app_suffix_data'] : [];

        // 设置view中的变量
		$data['compact_data']['menu_select'] = $this->menu_select;
		$data['compact_data']['fixedBarHtml'] = $this->fixedBarHtml;
		$data['compact_data']['titleBarHtml'] = $this->titleBarHtml;
		$data['compact_data']['seller'] = $this->seller_info;
		$data['compact_data']['seller_id'] = $this->seller_id;
		$data['compact_data']['messageCount'] = $this->messageCount;
		$data['compact_data']['shop'] = $this->shop_info;

        $appData = array_merge($appPrefixData, $appContext, $appSuffixData);

        if (!empty($appExtraData)) { // 当传入app_extra_data参数时，使用app_data参数
            $appData = [];
        }
        $this->app_extra_data = $appExtraData;
        $this->app_data = $appData;
        $this->web_data = $data['web_data'];
        $this->compact_data = $data['compact_data'];
        $this->tpl_view = $data['tpl_view'];
    }

    /**
     * 获取app端 接口数据 context对象
     *
     * @return mixed
     */
    protected final function getAppContext()
    {
        $user_info = [];
        if ($this->seller_id > 0) {
            $user = $this->seller_info;

            $user_info = [
                'user_id' => $user->user_id,
                'user_name' => $user->user_name,
                'nickname' => $user->nickname,
                'headimg' => $user->headimg,
                'email' => $user->email,
                'email_validated' => $user->email_validated,
                'mobile' => $user->mobile,
                'mobile_validated' => $user->mobile_validated,
                'is_seller' => $user->is_seller,
                'shop_id' => $user->shop_id,
                'last_time' => strtotime($user->last_login),
                'last_ip' => $user->last_ip
            ];
        }

        $data['context'] = [
            'current_time' => time(), // 当前时间戳 12位
            'user_info' => $user_info, // 用户信息
            'config'=>[
                'mall_logo'=>sysconf('mall_logo'),
                'site_name'=>sysconf('site_name'),
                'seller_center_logo'=>sysconf('seller_center_logo'),
                'site_icp'=>sysconf('site_icp'),
                'site_copyright'=>sysconf('site_copyright'),
                'site_powered_by' => '',
                'mall_phone'=>sysconf('mall_phone'),
                'mall_email'=>sysconf('mall_email'),
                'mall_qq'=>sysconf('mall_qq'),
                'mall_wangwang'=>sysconf('mall_wangwang'),
                'mall_wx_qrcode'=>sysconf('mall_wx_qrcode'),
                'favicon' => get_image_url(sysconf('favicon'))
            ]
        ];

        return $data;
    }

    /**
     * 模板渲染及APP客户端返回数据
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected final function displayData()
    {
        if (is_app('android')) { // Android端访问
            return result(0, $this->app_data, '', $this->app_extra_data);
        } elseif (is_app('ios')) { // Ios端访问
            return result(0, $this->app_data, '', $this->app_extra_data);
        } elseif (is_mobile() && !is_app()) { // 手机端访问 针对微信端 todo 商家后台暂时没有手机端
            return view($this->tpl_view, $this->compact_data);
        } else { // pc端访问
            // 输出公共变量
			$this->compact_data['context'] = $this->getAppContext()['context'];

            if (!empty($this->tpl_view)) {
                return view($this->tpl_view, $this->compact_data);
            }
        }
    }

}
