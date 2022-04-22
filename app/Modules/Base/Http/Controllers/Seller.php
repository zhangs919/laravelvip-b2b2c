<?php

namespace App\Modules\Base\Http\Controllers;

use App\Models\ShopRole;
use Illuminate\Http\Request;

class Seller extends Foundation
{

//    protected $menu_select;

    protected $seller_info = null;

    protected $seller_id = 0;

    /*以下方法是新的基类方法*/
    protected $app_extra_data = null;
    protected $app_data = null;
    protected $web_data = null;
    protected $compact_data = null;
    protected $tpl_view = null;

    /**
     * 权限内容
     */
    protected $permission;

    public function __construct()
    {
        parent::__construct();

//        $this->load_helper('');

        $this->middleware('auth.seller:seller');


        // 检查是否有访问权限 todo 等权限系统做完善了再写这里的代码
//        abort(403, '对不起，您现在还没有获得此操作的权限');

        // 商家后台菜单
        // 顶部菜单
//        $top_menus = $this->menus();
//        view()->share('top_menus', $top_menus);
        // 获取当前active module
//        $current_path = explode('/', request()->path());

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

                $auth_id = $this->seller_info->role_id; // 权限id
                $auth_info = ShopRole::where('role_id', $auth_id)->select(['role_id', 'role_name', 'auth_codes'])->first();
                //解析已有权限
//                $auth_codes = unserialize(backend_decrypt($auth_info->auth_codes, MD5_KEY.md5($auth_info->role_name)));
                $auth_codes = unserialize(backend_decrypt($auth_info->auth_codes, MD5_KEY));
                $this->permission = $auth_codes;
                $request_route = @$request->route()->action['as'];
                if (empty($auth_codes)) {
                    $auth_codes = [];
                }

                if (/*$this->seller_id != 1 && */
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
            view()->share('shop_info', seller_shop_info());

            $messageCount = 0; // todo 获取店铺未读消息
            view()->share('messageCount', $messageCount);

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
//        dd($menu_select);
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


            /*todo 如果$group = type 则将data-tab-id设置为tab_$key 否则设置为$array[2]*/
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

            if (!empty($this->tpl_view)) {
                return view($this->tpl_view, $this->compact_data);
            }
        }
    }



//    protected final function auth_nodes()
//    {
//        $auth_nodes = [
//            // 首页
//            [
//                'title' => '首页',
//                'parent_id' => 'root',
//                'value' => 'seller-index',
//                'child' => [
//                    [
//                        'title' => '首页',
//                        'parent_id' => 'seller-index',
//                        'value' => 'index',
//                        'id' => 'index',
//                        'child' => [
//                            [
//                                'title' => '新手向导',
//                                'parent_id' => 'index',
//                                'value' => 'guide',
//                                'id' => 'guide'
//                            ],
//                            [
//                                'title' => '欢迎页',
//                                'parent_id' => 'index',
//                                'value' => 'welcome',
//                                'id' => 'welcome'
//                            ]
//                        ],
//
//                    ]
//                ]
//            ],
//            // 商品
//            [
//                'title' => '商品',
//                'parent_id' => 'root',
//                'value' => 'goods',
//                'id' => 'goods',
//                'child' => [
//                    [
//                        'title' => '商品管理',
//                        'parent_id' => 'goods',
//                        'value' => 'goods',
//                        'id' => 'shop-goods',
//                        'child' => [
//                            [
//                                'title' => '商品发布',
//                                'parent_id' => 'shop-goods',
//                                'value' => 'shop-goods-add',
//                                'id' => 'shop-goods-add',
//                            ],
//                            [
//                                'title' => '商品列表',
//                                'parent_id' => 'shop-goods',
//                                'value' => 'shop-goods-list',
//                                'id' => 'shop-goods-list'
//                            ],
//                            [
//                                'title' => '商品编辑',
//                                'parent_id' => 'shop-goods',
//                                'value' => 'shop-goods-edit',
//                                'id' => 'shop-goods-edit'
//                            ],
//                            [
//                                'title' => '商品上架/下架',
//                                'parent_id' => 'shop-goods',
//                                'value' => 'shop-goods-sale',
//                                'id' => 'shop-goods-sale'
//                            ],
//                            [
//                                'title' => '商品删除',
//                                'parent_id' => 'shop-goods',
//                                'value' => 'shop-goods-delete',
//                                'id' => 'shop-goods-delete'
//                            ],
//                        ],
//
//                    ]
//                ]
//            ],
//        ];
//
//        return $auth_nodes;
//    }

    /**
     * 商家中心菜单
     *
     * @param string $module 模块名称
     * @return array|mixed
     */
//    protected final function menus($module = '')
//    {
//        $menus = [
//            // 首页
//            'index' => [
//                'title' => '首页',
//                'parent_menu' => 'root',
//                'menus' => 'index',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '欢迎页',
//                        'parent_menu' => 'index',
//                        'menus' =>'index|index-welcome',
//                        'url' => '/index'
//                    ],
//                    [
//                        'title' => '新手向导',
//                        'parent_menu' => 'index',
//                        'menus' =>'index|index-guide',
//                        'url' => '/index/index/guide'
//                    ],
//                ]
//            ],
//
//            // 商品
//            'goods' => [
//                'title' => '商品',
//                'parent_menu' => 'root',
//                'menus' => 'goods',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '商品管理',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-list',
//                        'url' => '/goods/list/index'
//                    ],
//                    [
//                        'title' => '发布商品',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-publish',
//                        'url' => '/goods/publish/add'
//                    ],
//                    [
//                        'title' => '数据采集',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-cloud-list',
//                        'url' => '/goods/cloud/goods-list'
//                    ],
//                    /*[
//                        'title' => '系统商品库',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|lib-goods-list',
//                        'url' => '/goods/lib-goods/index'
//                    ],
//                    [
//                        'title' => '商品批量上传',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-upload',
//                        'url' => '/goods/upload/add'
//                    ],*/
//                    [
//                        'title' => '店铺商品分类',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-category-list',
//                        'url' => '/goods/category/list'
//                    ],
//                    [
//                        'title' => '规格管理',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-spec-list',
//                        'url' => '/goods/spec/list'
//                    ],
//                    /*[
//                        'title' => '商品单位',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-goods-unit-list',
//                        'url' => '/goods/goods-unit/list'
//                    ],*/
//                    [
//                        'title' => '运费设置',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|shop-freight-list',
//                        'url' => '/shop/freight/list'
//                    ],
//                    [
//                        'title' => '图片空间',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-image-dir-list',
//                        'url' => '/goods/image-dir/list'
//                    ],
//                    /*[
//                        'title' => '详情版式',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-info-templet',
//                        'url' => '/goods/layout/list'
//                    ],
//                    [
//                        'title' => '常见问题',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-questions',
//                        'url' => '/goods/questions/list'
//                    ],*/
//                    [
//                        'title' => '商品设置',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-set',
//                        'url' => '/shop/config/index?group=goods'
//                    ],
//                    [
//                        'title' => '回收站',
//                        'parent_menu' => 'goods',
//                        'menus' =>'goods|goods-pictures-recover',
//                        'url' => '/goods/list/trash'
//                    ],
//                ]
//            ],
//
//            // 交易
//            'trade' => [
//                'title' => '交易',
//                'parent_menu' => 'root',
//                'menus' => 'trade',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '交易设置',
//                        'parent_menu' => 'trade',
//                        'menus' =>'trade|trade-set',
//                        'url' => '/shop/config/index?group=trade'
//                    ],
//                    [
//                        'title' => '订单管理',
//                        'parent_menu' => 'trade',
//                        'menus' =>'trade|trade-order-list',
//                        'url' => '/trade/order/list'
//                    ],
//                    [
//                        'title' => '发货单管理',
//                        'parent_menu' => 'trade',
//                        'menus' =>'trade|trade-delivery-list',
//                        'url' => '/trade/delivery/list'
//                    ],
//                    [
//                        'title' => '退款/退货管理',
//                        'parent_menu' => 'trade',
//                        'menus' =>'trade|trade-back-list',
//                        'url' => '/trade/back/list'
//                    ],
//                    [
//                        'title' => '售后管理',
//                        'parent_menu' => 'trade',
//                        'menus' =>'trade|trade-after-sale-list',
//                        'url' => '/trade/back/list?is_after_sale=1'
//                    ],
//                    [
//                        'title' => '投诉管理',
//                        'parent_menu' => 'trade',
//                        'menus' =>'trade|trade-complaint-manage',
//                        'url' => '/trade/complaint/list'
//                    ],
//                    [
//                        'title' => '评价管理',
//                        'parent_menu' => 'trade',
//                        'menus' =>'trade|trade-evaluate-buyer-list',
//                        'url' => '/trade/service/evaluate-buyer-list'
//                    ],
//                ]
//            ],
//
//            // 营销dashboard
//            'dashboard' => [
//                'title' => '营销',
//                'parent_menu' => 'root',
//                'menus' => 'dashboard',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '营销中心',
//                        'parent_menu' => 'dashboard',
//                        'menus' =>'dashboard|dashboard-center',
//                        'url' => '/dashboard/center/index'
//                    ],
//                ]
//            ],
//
//            // 会员
//            'member' => [
//                'title' => '会员',
//                'parent_menu' => 'root',
//                'menus' => 'member',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '会员列表',
//                        'parent_menu' => 'member',
//                        'menus' =>'member|member-list',
//                        'url' => '/member/member/user-list?type=1&order=1'
//                    ],
//                    [
//                        'title' => '会员等级',
//                        'parent_menu' => 'member',
//                        'menus' =>'member|member-level',
//                        'url' => '/member/rank/list'
//                    ],
//                ]
//            ],
//
//            // 店铺
//            'shop' => [
//                'title' => '店铺',
//                'parent_menu' => 'root',
//                'menus' => 'shop',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '店铺设置',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-set',
//                        'url' => '/shop/shop-set/edit'
//                    ],
//                    [
//                        'title' => '店铺信息',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-info',
//                        'url' => '/shop/shop-info/shop-info'
//                    ],
//                    [
//                        'title' => '打印设置',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-print-spec',
//                        'url' => '/shop/print-spec/list'
//                    ],
//                    [
//                        'title' => '配送方式',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-express-list',
//                        'url' => '/shop/shipping/self'
//                    ],
//                    [
//                        'title' => '保障服务',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-shop-contract',
//                        'url' => '/shop/contract/list'
//                    ],
//                    [
//                        'title' => '上门自提',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|self-pickup',
//                        'url' => '/goods/self-pickup/list'
//                    ],
//                    [
//                        'title' => '文章列表',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-article-list',
//                        'url' => '/article/article/list'
//                    ],
//                    [
//                        'title' => '店铺导航',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-navigation',
//                        'url' => '/shop/navigation/list'
//                    ],
//                    [
//                        'title' => '店铺装修',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-design',
//                        'url' => '/design/tpl-setting/setup?page=shop'
//                    ],
//                    [
//                        'title' => '授权周边系统',
//                        'parent_menu' => 'shop',
//                        'menus' =>'shop|shop-oauth',
//                        'url' => '/oauth/oauth/index'
//                    ]
//                ]
//            ],
//
//            // 网点
//            'store' => [
//                'title' => '网点',
//                'parent_menu' => 'root',
//                'menus' => 'store',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '线下网点管理',
//                        'parent_menu' => 'store',
//                        'menus' =>'store|store-list',
//                        'url' => '/store/default/list'
//                    ],
//                    [
//                        'title' => '网点分组管理',
//                        'parent_menu' => 'store',
//                        'menus' =>'store|store-group-list',
//                        'url' => '/store/group/list'
//                    ],
//                    [
//                        'title' => '网点销售统计',
//                        'parent_menu' => 'store',
//                        'menus' =>'store|store-trade-list',
//                        'url' => '/store/trade/list'
//                    ],
//                ]
//            ],
//
//            // 账号
//            'account' => [
//                'title' => '账号',
//                'parent_menu' => 'root',
//                'menus' => 'account',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '帐号管理',
//                        'parent_menu' => 'account',
//                        'menus' =>'account|shop-account',
//                        'url' => '/shop/account/list'
//                    ],
//                    [
//                        'title' => '阿里云旺',
//                        'parent_menu' => 'account',
//                        'menus' =>'account|shop-config-aliim',
//                        'url' => '/shop/config/index?group=aliim'
//                    ],
//                    [
//                        'title' => '客服类型',
//                        'parent_menu' => 'account',
//                        'menus' =>'account|shop-customer-type-list',
//                        'url' => '/shop/customer-type/list'
//                    ],
//                    [
//                        'title' => '客服管理',
//                        'parent_menu' => 'account',
//                        'menus' =>'account|shop-customer-list',
//                        'url' => '/shop/customer/list'
//                    ],
//                    [
//                        'title' => '系统消息',
//                        'parent_menu' => 'account',
//                        'menus' =>'account|shop-message',
//                        'url' => '/shop/message/index'
//                    ],
//                    [
//                        'title' => '操作日志',
//                        'parent_menu' => 'account',
//                        'menus' =>'account|shop-log-list',
//                        'url' => '/shop/log/list'
//                    ],
//                ]
//            ],
//
//            // 财务
//            'finance' => [
//                'title' => '财务',
//                'parent_menu' => 'root',
//                'menus' => 'finance',
//                'url' => '',
//                'child' => [
////                    [
////                        'title' => '交易记录',
////                        'parent_menu' => 'finance',
////                        'menus' =>'finance|finance-seller-account',
////                        'url' => '/finance/seller-account/list'
////                    ],
//                    [
//                        'title' => '结算管理',
//                        'parent_menu' => 'finance',
//                        'menus' =>'finance|finance-bill-manager-list',
//                        'url' => '/finance/bill/shop-bill'
//                    ],
//                    [
//                        'title' => '网点结算',
//                        'parent_menu' => 'finance',
//                        'menus' =>'finance|finance-bill--list',
//                        'url' => '/finance/bill/store-bill'
//                    ],
//                    [
//                        'title' => '店铺账户明细',
//                        'parent_menu' => 'finance',
//                        'menus' =>'finance|finance-account-detail',
//                        'url' => '/finance/account-detail/list'
//                    ],
//                ]
//            ],
//
//            // 移动端
//            'weixin' => [
//                'title' => '移动端',
//                'parent_menu' => 'root',
//                'menus' => 'weixin',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '微信设置',
//                        'parent_menu' => 'weixin',
//                        'menus' =>'weixin|shop-weixin-config',
//                        'url' => '/shop/config/index?group=weixin'
//                    ],
//                    [
//                        'title' => '自定义菜单',
//                        'parent_menu' => 'weixin',
//                        'menus' =>'weixin|shop-weixin-menu',
//                        'url' => '/shop/weixin-menu/list'
//                    ],
//                    [
//                        'title' => '关键词回复',
//                        'parent_menu' => 'weixin',
//                        'menus' =>'weixin|shop-weixin-keyword',
//                        'url' => '/shop/weixin-keyword/list'
//                    ],
//                ]
//            ],
//
//            // 收银台
//            /*'cash' => [
//                'title' => '收银台',
//                'parent_menu' => 'root',
//                'menus' => 'cash',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '收银设置',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|shop-config-receipt',
//                        'url' => '/cash/receipt/index'
//                    ],
//                    [
//                        'title' => '电子秤设置',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|shop-config-weighter',
//                        'url' => '/cash/weighter/set'
//                    ],
//                    [
//                        'title' => '收银员管理',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|cash-user-list',
//                        'url' => '/cash/user/list'
//                    ],
//                    [
//                        'title' => '收银员业绩',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|cash-sales-list',
//                        'url' => '/cash/sales/list'
//                    ],
//                    [
//                        'title' => '线下订单',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|cash-order-list',
//                        'url' => '/cash/order/list'
//                    ],
//                    [
//                        'title' => '线下退货单',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|cash-back-list',
//                        'url' => '/cash/back/list'
//                    ],
//                    [
//                        'title' => '线下进货明细',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|cash-stock-list',
//                        'url' => '/cash/stock/list'
//                    ],
//                    [
//                        'title' => '盘点历史',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|cash-check-list',
//                        'url' => '/cash/check/list'
//                    ],
//                    [
//                        'title' => '商品报损',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|cash-loss-list',
//                        'url' => '/cash/loss/list'
//                    ],
//                    [
//                        'title' => '线下销售统计',
//                        'parent_menu' => 'cash',
//                        'menus' =>'cash|cash-statistic-index',
//                        'url' => '/cash/sales-statistic/index'
//                    ],
//                ]
//            ],*/
//
//            // 财务报表 statistics
//            'statistics' => [
//                'title' => '财务报表',
//                'parent_menu' => 'root',
//                'menus' => 'statistics',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '数据概况',
//                        'parent_menu' => 'statistics',
//                        'menus' =>'statistics|data-profiling',
//                        'url' => '/statistics/data-profiling/index'
//                    ],
//                    [
//                        'title' => '营业统计',
//                        'parent_menu' => 'statistics',
//                        'menus' =>'statistics|sales-statistics',
//                        'url' => '/statistics/sales-statistics/index'
//                    ],
//                    [
//                        'title' => '商品分析',
//                        'parent_menu' => 'statistics',
//                        'menus' =>'statistics|goods-analyse',
//                        'url' => '/statistics/goods-analyse/index'
//                    ],
//                    [
//                        'title' => '单品分析',
//                        'parent_menu' => 'statistics',
//                        'menus' =>'statistics|goods-statistics',
//                        'url' => '/statistics/goods-statistics/sales'
//                    ],
//                    [
//                        'title' => '交易分析',
//                        'parent_menu' => 'statistics',
//                        'menus' =>'statistics|trade-analyse',
//                        'url' => '/statistics/trade-analyse/index'
//                    ],
//                    [
//                        'title' => '会员统计',
//                        'parent_menu' => 'statistics',
//                        'menus' =>'statistics|users-statistics',
//                        'url' => '/statistics/users-statistics/list'
//                    ],
//                ]
//            ],
//        ];
//
//        if ($module != '') {
//            return $menus[$module];
//        }
//
//        return $menus;
//    }


}