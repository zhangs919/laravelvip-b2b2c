<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-10-09
// | Description: 商家中心助手函数
// +----------------------------------------------------------------------


/*********************** 商家中心 函数 ************************/
/**
 * 商家中心 店铺信息
 * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
 */
function seller_shop_info()
{
    $data = session('shop_info');
    return $data;
}

/**
 * 商家中心 卖家用户信息
 *
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
function seller_info()
{
    $data = auth('seller')->user();
    return $data;
}

/**
 * 商家中心菜单
 *
 * @param string $module
 * @return array|mixed
 */
function seller_top_menus($module = '')
{
    $menus = [
        // 首页
        'index' => [
            'title' => '首页',
            'parent_menu' => 'root',
            'menus' => 'index',
            'url' => '',
            'child' => [
                [
                    'title' => '欢迎页',
                    'parent_menu' => 'index',
                    'menus' =>'index|index-welcome',
                    'url' => '/index'
                ],
                [
                    'title' => '新手向导',
                    'parent_menu' => 'index',
                    'menus' =>'index|index-guide',
                    'url' => '/index/index/guide'
                ],
            ]
        ],

        // 商品
        'goods' => [
            'title' => '商品',
            'parent_menu' => 'root',
            'menus' => 'goods',
            'url' => '',
            'child' => [
                [
                    'title' => '商品管理',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-list',
                    'url' => '/goods/list/index'
                ],
                [
                    'title' => '发布商品',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-publish',
                    'url' => '/goods/publish/add'
                ],
                [
                    'title' => '数据采集',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-cloud-manage',
                    'url' => '/goods/cloud/cloud-manage'
                ],
                /*[
                    'title' => '系统商品库',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|lib-goods-list',
                    'url' => '/goods/lib-goods/index'
                ],
                [
                    'title' => '商品批量上传',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-upload',
                    'url' => '/goods/upload/add'
                ],*/
                [
                    'title' => '店铺商品分类',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-category-list',
                    'url' => '/goods/category/list'
                ],
                [
                    'title' => '规格管理',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-spec-list',
                    'url' => '/goods/spec/list'
                ],
                /*[
                    'title' => '商品单位',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-goods-unit-list',
                    'url' => '/goods/goods-unit/list'
                ],*/
                [
                    'title' => '运费设置',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|shop-freight-list',
                    'url' => '/shop/freight/list'
                ],
                [
                    'title' => '图片空间',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-image-dir-list',
                    'url' => '/goods/image-dir/list'
                ],
                /*[
                    'title' => '详情版式',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-info-templet',
                    'url' => '/goods/layout/list'
                ],
                [
                    'title' => '常见问题',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-questions',
                    'url' => '/goods/questions/list'
                ],*/
                [
                    'title' => '商品设置',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-set',
                    'url' => '/goods/goods-set/index'
                ],
                [
                    'title' => '回收站',
                    'parent_menu' => 'goods',
                    'menus' =>'goods|goods-pictures-recover',
                    'url' => '/goods/list/trash'
                ],
            ]
        ],

        // 交易
        'trade' => [
            'title' => '交易',
            'parent_menu' => 'root',
            'menus' => 'trade',
            'url' => '',
            'child' => [
                [
                    'title' => '交易设置',
                    'parent_menu' => 'trade',
                    'menus' =>'trade|trade-set',
                    'url' => '/shop/config/index?group=trade'
                ],
                [
                    'title' => '订单管理',
                    'parent_menu' => 'trade',
                    'menus' =>'trade|trade-order-list',
                    'url' => '/trade/order/list'
                ],
                [
                    'title' => '发货单管理',
                    'parent_menu' => 'trade',
                    'menus' =>'trade|trade-delivery-list',
                    'url' => '/trade/delivery/list'
                ],
                [
                    'title' => '退款/退货管理',
                    'parent_menu' => 'trade',
                    'menus' =>'trade|trade-back-list',
                    'url' => '/trade/back/list'
                ],
                [
                    'title' => '售后管理',
                    'parent_menu' => 'trade',
                    'menus' =>'trade|trade-after-sale-list',
                    'url' => '/trade/back/list?is_after_sale=1'
                ],
                [
                    'title' => '投诉管理',
                    'parent_menu' => 'trade',
                    'menus' =>'trade|trade-complaint-manage',
                    'url' => '/trade/complaint/list'
                ],
                [
                    'title' => '评价管理',
                    'parent_menu' => 'trade',
                    'menus' =>'trade|trade-evaluate-buyer-list',
                    'url' => '/trade/service/evaluate-buyer-list'
                ],
            ]
        ],

        // 营销dashboard
        'dashboard' => [
            'title' => '营销',
            'parent_menu' => 'root',
            'menus' => 'dashboard',
            'url' => '',
            'child' => [
                [
                    'title' => '营销中心',
                    'parent_menu' => 'dashboard',
                    'menus' =>'dashboard|dashboard-center',
                    'url' => '/dashboard/center/index'
                ],
            ]
        ],

        // 会员
        'member' => [
            'title' => '会员',
            'parent_menu' => 'root',
            'menus' => 'member',
            'url' => '',
            'child' => [
                [
                    'title' => '会员列表',
                    'parent_menu' => 'member',
                    'menus' =>'member|member-list',
                    'url' => '/member/member/user-list?type=1&order=1'
                ],
                [
                    'title' => '会员等级',
                    'parent_menu' => 'member',
                    'menus' =>'member|member-level',
                    'url' => '/member/rank/list'
                ],
            ]
        ],

        // 店铺
        'shop' => [
            'title' => '店铺',
            'parent_menu' => 'root',
            'menus' => 'shop',
            'url' => '',
            'child' => [
                [
                    'title' => '店铺设置',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-set',
                    'url' => '/shop/shop-set/edit'
                ],
                [
                    'title' => '店铺信息',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-info',
                    'url' => '/shop/shop-info/shop-info'
                ],
                [
                    'title' => '打印设置',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-print-spec',
                    'url' => '/shop/print-spec/list'
                ],
                [
                    'title' => '配送方式',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-express-list',
                    'url' => '/shop/shipping/self'
                ],
                [
                    'title' => '保障服务',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-shop-contract',
                    'url' => '/shop/contract/list'
                ],
                [
                    'title' => '上门自提',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|self-pickup',
                    'url' => '/goods/self-pickup/list'
                ],
                [
                    'title' => '文章列表',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-article-list',
                    'url' => '/article/article/list'
                ],
                [
                    'title' => '店铺导航',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-navigation',
                    'url' => '/shop/navigation/list'
                ],
                [
                    'title' => '店铺装修',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-design',
                    'url' => '/design/tpl-setting/setup?page=shop',
                    'target' => '_blank',
                ],
                [
                    'title' => '授权周边系统',
                    'parent_menu' => 'shop',
                    'menus' =>'shop|shop-oauth',
                    'url' => '/oauth/oauth/index'
                ]
            ]
        ],

        // 网点
        'store' => [
            'title' => '网点',
            'parent_menu' => 'root',
            'menus' => 'store',
            'url' => '',
            'child' => [
                [
                    'title' => '线下网点管理',
                    'parent_menu' => 'store',
                    'menus' =>'store|store-list',
                    'url' => '/store/default/list'
                ],
                [
                    'title' => '网点分组管理',
                    'parent_menu' => 'store',
                    'menus' =>'store|store-group-list',
                    'url' => '/store/group/list'
                ],
                [
                    'title' => '网点销售统计',
                    'parent_menu' => 'store',
                    'menus' =>'store|store-trade-list',
                    'url' => '/store/trade/list'
                ],
            ]
        ],

        // 账号
        'account' => [
            'title' => '账号',
            'parent_menu' => 'root',
            'menus' => 'account',
            'url' => '',
            'child' => [
                [
                    'title' => '帐号管理',
                    'parent_menu' => 'account',
                    'menus' =>'account|shop-account',
                    'url' => '/shop/account/list'
                ],
                [
                    'title' => '阿里云旺',
                    'parent_menu' => 'account',
                    'menus' =>'account|shop-config-aliim',
                    'url' => '/shop/config/index?group=aliim'
                ],
                [
                    'title' => '客服类型',
                    'parent_menu' => 'account',
                    'menus' =>'account|shop-customer-type-list',
                    'url' => '/shop/customer-type/list'
                ],
                [
                    'title' => '客服管理',
                    'parent_menu' => 'account',
                    'menus' =>'account|shop-customer-list',
                    'url' => '/shop/customer/list'
                ],
                [
                    'title' => '系统消息',
                    'parent_menu' => 'account',
                    'menus' =>'account|shop-message',
                    'url' => '/shop/message/index'
                ],
                [
                    'title' => '操作日志',
                    'parent_menu' => 'account',
                    'menus' =>'account|shop-log-list',
                    'url' => '/shop/log/list'
                ],
            ]
        ],

        // 财务
        'finance' => [
            'title' => '财务',
            'parent_menu' => 'root',
            'menus' => 'finance',
            'url' => '',
            'child' => [
//                    [
//                        'title' => '交易记录',
//                        'parent_menu' => 'finance',
//                        'menus' =>'finance|finance-seller-account',
//                        'url' => '/finance/seller-account/list'
//                    ],
                [
                    'title' => '结算管理',
                    'parent_menu' => 'finance',
                    'menus' =>'finance|finance-bill-manager-list',
                    'url' => '/finance/bill/shop-bill'
                ],
                [
                    'title' => '网点结算',
                    'parent_menu' => 'finance',
                    'menus' =>'finance|finance-bill--list',
                    'url' => '/finance/bill/store-bill'
                ],
                [
                    'title' => '店铺账户明细',
                    'parent_menu' => 'finance',
                    'menus' =>'finance|finance-account-detail',
                    'url' => '/finance/account-detail/list'
                ],
            ]
        ],

        // 财务报表 statistics
        'statistics' => [
            'title' => '统计',
            'parent_menu' => 'root',
            'menus' => 'statistics',
            'url' => '',
            'child' => [
                [
                    'title' => '数据概况',
                    'parent_menu' => 'statistics',
                    'menus' =>'statistics|data-profiling',
                    'url' => '/statistics/data-profiling/index'
                ],
                [
                    'title' => '营业统计',
                    'parent_menu' => 'statistics',
                    'menus' =>'statistics|sales-statistics',
                    'url' => '/statistics/sales-statistics/index'
                ],
                [
                    'title' => '商品分析',
                    'parent_menu' => 'statistics',
                    'menus' =>'statistics|goods-analyse',
                    'url' => '/statistics/goods-analyse/index'
                ],
                [
                    'title' => '单品分析',
                    'parent_menu' => 'statistics',
                    'menus' =>'statistics|goods-statistics',
                    'url' => '/statistics/goods-statistics/sales'
                ],
                [
                    'title' => '交易分析',
                    'parent_menu' => 'statistics',
                    'menus' =>'statistics|trade-analyse',
                    'url' => '/statistics/trade-analyse/index'
                ],
                [
                    'title' => '会员统计',
                    'parent_menu' => 'statistics',
                    'menus' =>'statistics|users-statistics',
                    'url' => '/statistics/users-statistics/list'
                ],
            ]
        ],

        // 移动端
        'weixin' => [
            'title' => '移动端',
            'parent_menu' => 'root',
            'menus' => 'weixin',
            'url' => '',
            'child' => [
                [
                    'title' => '微信设置',
                    'parent_menu' => 'weixin',
                    'menus' =>'weixin|shop-weixin-config',
                    'url' => '/shop/config/index?group=weixin'
                ],
                [
                    'title' => '自定义菜单',
                    'parent_menu' => 'weixin',
                    'menus' =>'weixin|shop-weixin-menu',
                    'url' => '/shop/weixin-menu/list'
                ],
                [
                    'title' => '关键词回复',
                    'parent_menu' => 'weixin',
                    'menus' =>'weixin|shop-weixin-keyword',
                    'url' => '/shop/weixin-keyword/list'
                ],
            ]
        ],

        // 收银台
        /*'cash' => [
            'title' => '收银台',
            'parent_menu' => 'root',
            'menus' => 'cash',
            'url' => '',
            'child' => [
                [
                    'title' => '收银设置',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|shop-config-receipt',
                    'url' => '/cash/receipt/index'
                ],
                [
                    'title' => '电子秤设置',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|shop-config-weighter',
                    'url' => '/cash/weighter/set'
                ],
                [
                    'title' => '收银员管理',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|cash-user-list',
                    'url' => '/cash/user/list'
                ],
                [
                    'title' => '收银员业绩',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|cash-sales-list',
                    'url' => '/cash/sales/list'
                ],
                [
                    'title' => '线下订单',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|cash-order-list',
                    'url' => '/cash/order/list'
                ],
                [
                    'title' => '线下退货单',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|cash-back-list',
                    'url' => '/cash/back/list'
                ],
                [
                    'title' => '线下进货明细',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|cash-stock-list',
                    'url' => '/cash/stock/list'
                ],
                [
                    'title' => '盘点历史',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|cash-check-list',
                    'url' => '/cash/check/list'
                ],
                [
                    'title' => '商品报损',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|cash-loss-list',
                    'url' => '/cash/loss/list'
                ],
                [
                    'title' => '线下销售统计',
                    'parent_menu' => 'cash',
                    'menus' =>'cash|cash-statistic-index',
                    'url' => '/cash/sales-statistic/index'
                ],
            ]
        ],*/


    ];

    if ($module != '') {
        return $menus[$module];
    }

    return $menus;
}

/**
 * 获取商家中心 左侧菜单
 *
 * @return array|mixed
 */
function seller_left_menus()
{

    // 左侧菜单 根据当前active module 获取该module下的菜单
    $left_menus = seller_top_menus(seller_active_menu()['parent_menu']);
    $left_menus = !empty($left_menus['child']) ? $left_menus['child'] : [];

    return $left_menus;
}

/**
 * 获取商家中心 当前激活菜单
 *
 * @return mixed
 */
function seller_active_menu()
{
    $current_url = request()->getPathInfo();
    $new_menus = array_collapse(array_column(seller_top_menus(),'child'));
    $active_menu = $new_menus[0];
    foreach ($new_menus as $v){
        if ($v['url'] == $current_url) {
            // 当前激活菜单
            $active_menu = $v;
            break;
        }
    }
    return $active_menu;
}


//function seller_active_module()
//{
//    $active_module = seller_active_menu()['parent_menu'];
//    //get_seller_mac_by_url(seller_active_menu()['url'])[0];
//    return $active_module;
//}
//function seller_active_controller()
//{
//    $active_action = get_seller_mac_by_url(seller_active_menu()['url'])[1];
//    return $active_action;
//}

/**
 * 获取商家后台url
 * m：模块
 * a：方法
 * c：控制器
 *
 * @param $url
 * @return array
 */
function get_seller_mac_by_url($url)
{
    $url_arr = array_values(array_filter(explode('/', $url)));
    if (count($url_arr) == 3) {
        $module = $url_arr[0];
        $controller = $url_arr[1];
        $action = $url_arr[2];
    } elseif (count($url_arr) == 2) {
        $module = 'index';
        $controller = $url_arr[0];
        $action = $url_arr[1];
    } else {
        $module = '';
        $controller = '';
        $action = '';
    }
    return [$module,$controller,$action];
}


if (! function_exists('get_shop_config_group'))
{

    /**
     *
     * 获取商家后台配置分组信息
     *
     * @param $group
     * @return bool|mixed
     */
    function get_shop_config_group($group = '')
    {
        $data = [
            'system' => [
                'code' => 'system',
                'title' => '系统',
                'explain' => [],
                'anchor' => [],
            ],
            'trade' => [
                'code' => 'trade',
                'title' => '交易设置',
                'explain' => [
                    '接单模式：不影响自由购订单、堂内点餐订单、积分兑换订单、提货券订单、预售订单、拼团订单、砍价订单，接单模式只对普通订单起作用',
                    '只要卖家设置了在哪种订单状态下自动打印订单的话，那么只要有客户下单了之后，打印机即可自动打印订单，不需要你手动操作。例如：我设置了订单在已付款的状态下自动打印，那么只要付了款的订单都不需要你手动去点击打印，机子会自动出单。当然，如果你不需要自动打印则不设置自动打印即可',
                    '买家付款后自动打印订单规则：<p class="m-t-2">1.下单并支付成功<b>&gt;</b>声音提醒、自动打印订单；</p><p class="m-t-2">2.下单未支付<b>&gt;</b>无声音提醒、不自动打印订单<b>&gt;</b>买家二次支付成功<b>&gt;</b>声音提醒、自动打印订单；</p>'
                ],
                'anchor' => [
                    '接单设置',
                    '自动打印',
                    '声音提醒'
                ],
            ],
            'goods' => [
                'code' => 'goods',
                'title' => '商品设置 - 基本设置',
                'explain' => [],
                'anchor' => [
                    '商品编辑'
                ],
            ],
            'shop_other' => [
                'code' => 'shop_other',
                'title' => '店铺设置 - 高级设置',
                'explain' => [],
                'anchor' => [
                    '店铺首页设置',
                    '店铺商品列表设置'
                ],
            ],
            'shipping' => [
                'code' => 'shipping',
                'title' => '配送方式 - 自行配送',
                'explain' => [
                    '店铺开启自行配送后，在发货时即可使用无需物流'
                ],
                'anchor' => [],
            ],
            'aliim' => [
                'code' => 'aliim',
                'title' => '阿里云旺 - 云旺客服设置',
                'explain' => [],
                'anchor' => [],
            ],
            'weixin' => [
                'code' => 'weixin',
                'title' => '微信设置 - 微信对接',
                'explain' => [
                    '引导用户关注公众号成为你的粉丝，进行后续的粉丝运营',
                    '必须绑定认证的服务号，否则将无法正常使用微信自定义菜单、关键词自动回复',
                    '微商城里面的微信支付统一用平台的微信支付'
                ],
                'anchor' => [
                    '平台方微信公众号二维码',
                    '微信对接', // 提示：店铺如需对接微信，需配置公众号AppId及AppSecret
                    '微信配置' // 提示：URL及Token需在微信公众号平台进行配置
                ],
            ],
            'freight' => [
                'code' => 'freight',
                'title' => '运费设置 - 店铺统一运费',
                'explain' => [],
                'anchor' => [],
            ],
            'navigation' => [
                'code' => 'navigation',
                'title' => '店铺导航 - 店铺导航设置',
                'explain' => [
                    '可以给店铺导航添加背景颜色'
                ],
                'anchor' => [],
            ],
        ];

        if ($group == '') {
            return $data;
        }

        if (!isset($data[$group])) {
            return false;
        }

        return $data[$group];
    }
}

if (! function_exists('shop_log'))
{
    /**
     * 记录商家后台管理日志
     *
     * @param $log_content
     * @return \App\Repositories\User|bool
     */
    function shop_log($log_content)
    {
        // 检查是否登录
        if (! auth('seller')->check()) {
            return false;
        }
        $insert = [
            'content' => $log_content,
            'user_name' => auth('seller')->user()->user_name,
            'user_id' => auth('seller')->id(),
            'ip' => request()->ip(),
            'url' => request()->path()
        ];

        $shopLog = new \App\Repositories\ShopLogRepository(new \App\Models\ShopLog());
        $ret = $shopLog->store($insert);

        return $ret;
    }
}

function get_shipping_config_lable()
{
    $data = [
        'seller_name' => '发件人-姓名',
        'seller_mobile' => '发件人-联系电话',
        'seller_address' => '发件人-地址',
        'seller_postcode' => '发件人-邮编',
        'seller_shipping' => '发件人-公司',
        'buyer_name' => '收件人-姓名',
        'buyer_mobile' => '收件人-联系电话',
        'buyer_address' => '收件人-地址',
        'buyer_postcode' => '收件人-邮编',
        'buyer_shipping' => '收件人-公司',
        'goods_name' => '货品名称',
        'current_date' => '当前日期',
        'order_remarks' => '订单备注',
        'number' => '数量',
    ];

    return $data;
}

/**
 * 获取24小时数组
 *
 * @return array
 */
function get_day_hours()
{
    $hours = range(0, 23);
    foreach ($hours as $k=>&$v) {
        if ($k < 10) {
            $v = str_pad($v, 2, "0", STR_PAD_LEFT);
        }
    }
    return $hours;
}

/**
 * 获取60分钟数组
 *
 * @return array
 */
function get_hour_minutes($step = 5)
{
    $minutes = range(0, 59, $step);
    foreach ($minutes as $k=>&$v) {
        if ($k < 10) {
            $v = str_pad($v, 2, "0", STR_PAD_LEFT);
        }
    }
    array_push($minutes, 59);
    return $minutes;
}