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
// | Date:2018-07-28
// | Description: 后端助手函数
// +----------------------------------------------------------------------

// 基本常量定义
define('MD5_KEY', md5('laravelvip')); // md5 加密key

/**
 * 加密函数
 *
 * @param string $txt 需要加密的字符串
 * @param string $key 密钥
 * @return string 返回加密结果
 */
if (!function_exists("backend_encrypt")) {

    function backend_encrypt($txt, $key = ''){
        if (empty($txt)) return $txt;
        if (empty($key)) $key = md5(MD5_KEY);
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
        $ikey ="-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
        $nh1 = rand(0,64);
        $nh2 = rand(0,64);
        $nh3 = rand(0,64);
        $ch1 = $chars{$nh1};
        $ch2 = $chars{$nh2};
        $ch3 = $chars{$nh3};
        $nhnum = $nh1 + $nh2 + $nh3;
        $knum = 0;$i = 0;
        while(isset($key{$i})) $knum +=ord($key{$i++});
        $mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum%8,$knum%8 + 16);
        $txt = base64_encode(time().'_'.$txt);
        $txt = str_replace(array('+','/','='),array('-','_','.'),$txt);
        $tmp = '';
        $j=0;$k = 0;
        $tlen = strlen($txt);
        $klen = strlen($mdKey);
        for ($i=0; $i<$tlen; $i++) {
            $k = $k == $klen ? 0 : $k;
            $j = ($nhnum+strpos($chars,$txt{$i})+ord($mdKey{$k++}))%64;
            $tmp .= $chars{$j};
        }
        $tmplen = strlen($tmp);
        $tmp = substr_replace($tmp,$ch3,$nh2 % ++$tmplen,0);
        $tmp = substr_replace($tmp,$ch2,$nh1 % ++$tmplen,0);
        $tmp = substr_replace($tmp,$ch1,$knum % ++$tmplen,0);
        return $tmp;
    }

}


/**
 * 解密函数
 *
 * @param string $txt 需要解密的字符串
 * @param string $key 密匙
 * @return string 字符串类型的返回结果
 */
if (!function_exists("backend_decrypt")) {

    function backend_decrypt($txt, $key = '', $ttl = 0){
        if (empty($txt)) return $txt;
        if (empty($key)) $key = md5(MD5_KEY);

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
        $ikey ="-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
        $knum = 0;$i = 0;
        $tlen = @strlen($txt);
        while(isset($key{$i})) $knum +=ord($key{$i++});
        $ch1 = @$txt{$knum % $tlen};
        $nh1 = strpos($chars,$ch1);
        $txt = @substr_replace($txt,'',$knum % $tlen--,1);
        $ch2 = @$txt{$nh1 % $tlen};
        $nh2 = @strpos($chars,$ch2);
        $txt = @substr_replace($txt,'',$nh1 % $tlen--,1);
        $ch3 = @$txt{$nh2 % $tlen};
        $nh3 = @strpos($chars,$ch3);
        $txt = @substr_replace($txt,'',$nh2 % $tlen--,1);
        $nhnum = $nh1 + $nh2 + $nh3;
        $mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum % 8,$knum % 8 + 16);
        $tmp = '';
        $j=0; $k = 0;
        $tlen = @strlen($txt);
        $klen = @strlen($mdKey);
        for ($i=0; $i<$tlen; $i++) {
            $k = $k == $klen ? 0 : $k;
            $j = strpos($chars,$txt{$i})-$nhnum - ord($mdKey{$k++});
            while ($j<0) $j+=64;
            $tmp .= $chars{$j};
        }
        $tmp = str_replace(array('-','_','.'),array('+','/','='),$tmp);
        $tmp = trim(base64_decode($tmp));

        if (preg_match("/\d{10}_/s",substr($tmp,0,11))){
            if ($ttl > 0 && (time() - substr($tmp,0,11) > $ttl)){
                $tmp = null;
            }else{
                $tmp = substr($tmp,11);
            }
        }
        return $tmp;
    }

}

function backend_menu() {
    // 系统
    $_menu[] = [
        'name' => '系统',
        'url' => '',
        'menus' => 'system',
        'child' => [
            [
                'name' => '首页',
                'icon' => 'fa fa-home fa-fw',
                'url' => '',
                'menus' => 'system-index',
                'child' => [
                    [
                        'name' => '欢迎页',
                        'url' => '/index/index/index',
                        'menus' => 'welcome'
                    ],
                    [
                        'name' => '新手向导',
                        'url' => '/index/index/operation-flow',
                        'menus' => 'operation-flow'
                    ],
                    [
                        'name' => '控制面板',
                        'url' => '/index/index/control-panel',
                        'menus' => 'panel'
                    ],
                ],
            ],
            [
                'name' => '设置',
                'icon' => 'fa fa-cogs fa-fw',
                'url' => '',
                'menus' => 'system-setting',
                'child' => [
                    [
                        'name' => '网站管理',
                        'url' => '/system/config/index?group=website',
                        'menus' => 'system-setting-website'
                    ],
                    [
                        'name' => '管理员管理',
                        'url' => '/system/admin/list',
                        'menus' => 'system-setting-admin'
                    ],
                    [
                        'name' => '配置管理',
                        'url' => '/system/system/index',
                        'menus' => 'system-setting-system'
                    ],
                    [
                        'name' => '店铺配置管理',
                        'url' => '/system/shop-config-field/index',
                        'menus' => 'system-setting-shop_config_field'
                    ],
                    [
                        'name' => '地区管理',
                        'url' => '/system/region/list',
                        'menus' => 'system-setting-region'
                    ],
                    [
                        'name' => '操作日志',
                        'url' => '/system/log/list',
                        'menus' => 'system-setting-log'
                    ],
                    [
                        'name' => '清测试数据',
                        'url' => '/system/clear-data/index',
                        'menus' => 'system-setting-clear'
                    ],
                ],
            ],
            [
                'name' => '接口',
                'icon' => 'fa fa-plug fa-fw',
                'url' => '',
                'menus' => 'system-api',
                'child' => [
                    [
                        'name' => '邮件设置',
                        'url' => '/system/config/index?group=smtp',
                        'menus' => 'system-setting-email'
                    ],
                    [
                        'name' => '短信设置',
                        'url' => '/system/config/index?group=sms',
                        'menus' => 'system-setting-sms'
                    ],
                    [
                        'name' => '阿里OSS',
                        'url' => '/system/config/index?group=alioss',
                        'menus' => 'system-setting-alioss'
                    ],
                    [
                        'name' => '阿里云旺',
                        'url' => '/system/config/index?group=aliim',
                        'menus' => 'system-setting-aliim'
                    ],
                    [
                        'name' => '高德地图',
                        'url' => '/system/config/index?group=amap',
                        'menus' => 'system-setting-amap'
                    ],
                    [
                        'name' => '第三方登录',
                        'url' => '/system/config/index?group=website_login',
                        'menus' => 'system-setting-website-login'
                    ],
                    [
                        'name' => '支付设置',
                        'url' => '/mall/payment/list',
                        'menus' => 'mall-setting-payment'
                    ],
                    [
                        'name' => '快递鸟设置',
                        'url' => '/system/config/index?group=kdniao',
                        'menus' => 'system-setting-kdniao'
                    ],
                    [
                        'name' => '达达配送',
                        'url' => '/system/config/index?group=dada',
                        'menus' => 'system-setting-dada'
                    ],
                    [
                        'name' => '应用服务',
                        'url' => '/system/region/application-service',
                        'menus' => 'system-setting-application-service'
                    ],
                    [
                        'name' => '对接周边系统',
                        'url' => '/oauth/oauth/index',
                        'menus' => 'system-setting-oauth'
                    ],

                ],
            ],
            [
                'name' => 'SEO',
                'icon' => 'fa fa-paper-plane fa-fw',
                'url' => '',
                'menus' => 'system-seo',
                'child' => [
                    [
                        'name' => '首页',
                        'url' => '/system/config/index?group=seo_index',
                        'menus' => 'system-seo-seo_index'
                    ],
                    [
                        'name' => '团购',
                        'url' => '/system/config/index?group=seo_group_buy',
                        'menus' => 'system-seo-seo_group_buy'
                    ],
                    [
                        'name' => '拼团',
                        'url' => '/system/config/index?group=seo_groupon',
                        'menus' => 'system-seo-seo_groupon'
                    ],
                    [
                        'name' => '砍价',
                        'url' => '/system/config/index?group=seo_bargain',
                        'menus' => 'system-seo-seo_bargain'
                    ],
                    [
                        'name' => '品牌',
                        'url' => '/system/config/index?group=seo_brand',
                        'menus' => 'system-seo-seo_brand'
                    ],
                    [
                        'name' => '文章',
                        'url' => '/system/config/index?group=seo_article',
                        'menus' => 'system-seo-seo_article'
                    ],
                    [
                        'name' => '商品',
                        'url' => '/system/config/index?group=seo_goods',
                        'menus' => 'system-seo-seo_goods'
                    ],
                    [
                        'name' => '店铺',
                        'url' => '/system/config/index?group=seo_shop',
                        'menus' => 'system-seo-seo_shop'
                    ],
                    [
                        'name' => '资讯频道',
                        'url' => '/system/config/index?group=seo_news',
                        'menus' => 'system-seo-seo_news'
                    ],
                    [
                        'name' => '商品分类',
                        'url' => '/system/seo-category/list',
                        'menus' => 'system-seo-seo_category'
                    ],
                    [
                        'name' => '网站地图',
                        'url' => '/system/seo/sitemap',
                        'menus' => 'system-seo-seo_map'
                    ],

                ],
            ],
        ]
    ];

    // 商城
    $_menu[] = [
        'name' => '商城',
        'url' => '',
        'menus' => 'mall',
        'child' => [
            [
                'name' => '设置',
                'icon' => 'fa fa-cogs fa-fw',
                'url' => '',
                'menus' => 'mall-setting',
                'child' => [
                    [
                        'name' => '商城设置',
                        'url' => '/system/config/index?group=mall',
                        'menus' => 'mall-setting-index'
                    ],
                    [
                        'name' => '图片设置',
                        'url' => '/system/config/index?group=default_image',
                        'menus' => 'mall-setting-image'
                    ],
                    [
                        'name' => '默认搜索',
                        'url' => '/mall/search/default-search',
                        'menus' => 'mall-setting-search'
                    ],
                    [
                        'name' => '热门搜索',
                        'url' => '/mall/hot-search/list',
                        'menus' => 'mall-setting-hot-search'
                    ],
                    [
                        'name' => '消息模板',
                        'url' => '/mall/message-template/list',
                        'menus' => 'mall-setting-message'
                    ],
                    [
                        'name' => '快递公司',
                        'url' => '/mall/shipping/list',
                        'menus' => 'mall-setting-express'
                    ],
                    [
                        'name' => '打印设置',
                        'url' => '/mall/print-spec/list',
                        'menus' => 'mall-setting-pring'
                    ],
                    [
                        'name' => '消费保障',
                        'url' => '/mall/contract/audit-list',
                        'menus' => 'mall-setting-contract'
                    ],
                    [
                        'name' => '收银系统',
                        'url' => '/system/config/index?group=cash',
                        'menus' => 'mall-setting-cash'
                    ],
                    [
                        'name' => '上门自提',
                        'url' => '/mall/self-pickup/list',
                        'menus' => 'mall-setting-pickup'
                    ],

                ],
            ],
            [
                'name' => '商品',
                'icon' => 'fa fa-shopping-cart fa-fw',
                'url' => '',
                'menus' => 'mall-goods',
                'child' => [
                    [
                        'name' => '商品设置',
                        'url' => '/system/config/index?group=goods',
                        'menus' => 'mall-goods-setting'
                    ],
                    [
                        'name' => '商品管理',
                        'url' => '/goods/default/list',
                        'menus' => 'mall-goods-manage'
                    ],
                    [
                        'name' => '云端产品库',
                        'url' => '/goods/cloud/list',
                        'menus' => 'mall-cloud-goods-manage'
                    ],
                    [
                        'name' => '本地商品库',
                        'url' => '/goods/lib-goods/list',
                        'menus' => 'mall-lib-goods-manage'
                    ],
                    [
                        'name' => '商品库商品分类',
                        'url' => '/goods/lib-category/list',
                        'menus' => 'mall-lib-category'
                    ],
                    [
                        'name' => '分类管理',
                        'url' => '/goods/category/list',
                        'menus' => 'mall-goods-category'
                    ],
                    [
                        'name' => '品牌管理',
                        'url' => '/goods/brand/list',
                        'menus' => 'mall-goods-brand'
                    ],
                    [
                        'name' => '商品类型',
                        'url' => '/goods/goods-type/list',
                        'menus' => 'mall-goods-type-list'
                    ],
                    [
                        'name' => '图片空间',
                        'url' => '/goods/image-dir/list',
                        'menus' => 'mall-goods-gallery'
                    ],

                ],
            ],
            [
                'name' => '交易',
                'icon' => 'fa fa-legal fa-fw',
                'url' => '',
                'menus' => 'mall-trade',
                'child' => [
                    [
                        'name' => '交易设置',
                        'url' => '/system/config/index?group=trade&tabs=trade,integral',
                        'menus' => 'mall-trade-setting'
                    ],
                    [
                        'name' => '商品订单',
                        'url' => '/trade/order/list',
                        'menus' => 'mall-trade-order'
                    ],
                    [
                        'name' => '自由购订单',
                        'url' => '/dashboard/freebuy/list',
                        'menus' => 'mall-freebuy-order'
                    ],
                    [
                        'name' => '堂内点餐订单',
                        'url' => '/dashboard/reachbuy/list',
                        'menus' => 'mall-reachbuy-order'
                    ],
                    [
                        'name' => '退款管理',
                        'url' => '/trade/refund/list',
                        'menus' => 'mall-trade-refund'
                    ],
                    [
                        'name' => '售后管理',
                        'url' => '/trade/refund/list?is_after_sale=1',
                        'menus' => 'mall-trade-after-sale'
                    ],
                    [
                        'name' => '投诉管理',
                        'url' => '/trade/complaint/list',
                        'menus' => 'mall-trade-complaint'
                    ],
                    [
                        'name' => '评价管理',
                        'url' => '/trade/service/evaluate-buyer-list',
                        'menus' => 'mall-trade-service'
                    ],

                ],
            ],
            [
                'name' => '店铺',
                'icon' => 'fa fa-institution fa-fw',
                'url' => '',
                'menus' => 'mall-shop',
                'child' => [
                    [
                        'name' => '开店设置',
                        'url' => '/shop/shop-setting/index',
                        'menus' => 'mall-shop-setting'
                    ],
                    [
                        'name' => '入驻店铺',
                        'url' => '/shop/shop/index?is_supply=0',
                        'menus' => 'mall-shop-list'
                    ],
                    [
                        'name' => '自营店铺',
                        'url' => '/shop/self-shop/index?is_supply=0',
                        'menus' => 'mall-self-shop-list'
                    ],
                    [
                        'name' => '推荐开店',
                        'url' => '/shop/recommend-shop/list',
                        'menus' => 'mall-shop-recommend-shop'
                    ],
                    [
                        'name' => '预上线店铺留言',
                        'url' => '/shop/recommend-msg/list',
                        'menus' => 'mall-recommend-shop-msg'
                    ],
                    [
                        'name' => '店铺信誉',
                        'url' => '/shop/shop-credit/index',
                        'menus' => 'mall-shop-credit'
                    ],
                    [
                        'name' => '店铺分类',
                        'url' => '/shop/shop-class/index',
                        'menus' => 'mall-shop-class'
                    ],
                    [
                        'name' => '店铺评分',
                        'url' => '/system/config/index?group=desc_conform',
                        'menus' => 'mall-shop-mark'
                    ],
                    [
                        'name' => '采集控制',
                        'url' => '/shop/collect/list',
                        'menus' => 'mall-shop-collect'
                    ],
                    [
                        'name' => '网点控制',
                        'url' => '/shop/store/list',
                        'menus' => 'mall-shop-store'
                    ],
                    [
                        'name' => '店铺众包授权',
                        'url' => '/shop/logistics/list',
                        'menus' => 'mall-shop-logistics'
                    ],
                    [
                        'name' => '收银系统授权',
                        'url' => '/shop/cash-oauth/list',
                        'menus' => 'mall-shop-cash-oauth'
                    ],
                    [
                        'name' => '达达配送授权',
                        'url' => '/shop/dada/list',
                        'menus' => 'mall-shop-dada'
                    ],
                ],
            ],
            [
                'name' => '会员',
                'icon' => 'fa fa-user fa-fw',
                'url' => '',
                'menus' => 'mall-user',
                'child' => [
                    [
                        'name' => '会员设置',
                        'url' => '/system/config/index?group=user',
                        'menus' => 'mall-user-set'
                    ],
                    [
                        'name' => '会员列表',
                        'url' => '/user/user/list',
                        'menus' => 'mall-user-list'
                    ],
                    [
                        'name' => '会员等级',
                        'url' => '/user/user-rank/list',
                        'menus' => 'mall-user-rank-list'
                    ],
                    [
                        'name' => '店铺会员等级',
                        'url' => '/user/shop/list',
                        'menus' => 'mall-user-shop-list'
                    ],

                ],
            ],
            [
                'name' => '分销',
                'icon' => 'fa fa-share-alt fa-fw',
                'url' => '',
                'menus' => 'mall-distrib',
                'child' => [
                    [
                        'name' => '分销返利设置',
                        'url' => '/system/config/index?group=distrib',
                        'menus' => 'distrib-set'
                    ],
                    [
                        'name' => '分销商品列表',
                        'url' => '/distrib/distrib-goods/list',
                        'menus' => 'distrib-goods-list'
                    ],
                    [
                        'name' => '分销商列表',
                        'url' => '/distrib/distributor/list',
                        'menus' => 'distrib-distributor-list'
                    ],
                    [
                        'name' => '分销订单列表',
                        'url' => '/distrib/distrib-order/list',
                        'menus' => 'distrib-order-list'
                    ],

                ],
            ],
            [
                'name' => '营销',
                'icon' => 'fa fa-tags fa-fw',
                'url' => '',
                'menus' => 'mall-dashboard',
                'child' => [
                    [
                        'name' => '营销中心',
                        'url' => '/dashboard/center/index',
                        'menus' => 'mall-dashboard-center'
                    ],
                    [
                        'name' => '店铺营销权限',
                        'url' => 'dashboard/shop-auth/index',
                        'menus' => 'mall-dashboard-auth'
                    ],

                ],
            ],
            [
                'name' => '文章',
                'icon' => 'fa fa-file-text-o fa-fw',
                'url' => '',
                'menus' => 'mall-article',
                'child' => [
                    [
                        'name' => '文章分类',
                        'url' => '/article/article-cat/list',
                        'menus' => 'mall-article-article-category'
                    ],
                    [
                        'name' => '文章列表',
                        'url' => '/article/article/list',
                        'menus' => 'mall-article-article-list'
                    ],

                ],
            ],
            [
                'name' => '装修',
                'icon' => 'fa fa-paint-brush fa-fw',
                'url' => '',
                'menus' => 'mall-design',
                'child' => [
                    [
                        'name' => '首页装修',
                        'url' => '/design/tpl-setting/setup',
                        'menus' => 'mall-design-setup',
                        'target' => '_blank',
                    ],
                    [
                        'name' => '资讯频道装修',
                        'url' => '/design/tpl-setting/setup?page=news',
                        'menus' => 'news-design-setup',
                        'target' => '_blank',
                    ],
                    [
                        'name' => '商城导航',
                        'url' => '/design/navigation/list?nav_page=site&show_all=1',
                        'menus' => 'site-navigation'
                    ],
                    [
                        'name' => '个性化设置',
                        'url' => '/system/config/index?group=login_bg',
                        'menus' => 'mall-personal-setting'
                    ],
                    [
                        'name' => '资质导航',
                        'url' => '/mall/copyright-auth/list',
                        'menus' => 'mall-copyright-auth'
                    ],
                    [
                        'name' => '友情链接',
                        'url' => '/mall/links/list',
                        'menus' => 'mall-setting-links'
                    ],

                ],
            ],
        ]
    ];

    // 会员
    $_menu[] = [
        'name' => '会员',
        'url' => '',
        'menus' => 'user',
        'child' => [
            [
                'name' => '会员',
                'icon' => 'fa fa-user fa-fw',
                'url' => '',
                'menus' => 'user-user',
                'child' => [
                    [
                        'name' => '会员列表',
                        'url' => '/user/user/list',
                        'menus' => 'user-user-list'
                    ],
                    [
                        'name' => '会员标签',
                        'url' => '/user/label/list',
                        'menus' => 'user-user-label'
                    ],
                ],
            ],
            [
                'name' => '运营',
                'icon' => 'fa fa-line-chart fa-fw',
                'url' => '',
                'menus' => 'user-operative',
                'child' => [
                    [
                        'name' => '智能营销',
                        'url' => '/dashboard/customer-analysis/index',
                        'menus' => 'user-operative-smart'
                    ],
                    [
                        'name' => '商圈营销',
                        'url' => '/dashboard/trade-area/list',
                        'menus' => 'user-operative-district'
                    ],
                ],
            ],
            [
                'name' => '分析',
                'icon' => 'fa fa-user fa-fw',
                'url' => '',
                'menus' => 'user-analyse',
                'child' => [
                    [
                        'name' => '会员数据',
                        'url' => '/finance/users-statistics/index',
                        'menus' => 'user-analyse-data'
                    ],
                    [
                        'name' => '会员分析',
                        'url' => '/finance/users-statistics/users-list',
                        'menus' => 'user-analyse-statistics'
                    ],
                    [
                        'name' => '群组分析',
                        'url' => '/dashboard/group-analysis/list',
                        'menus' => 'user-group-analysis'
                    ],
                    [
                        'name' => '商圈分析',
                        'url' => '/dashboard/trade-area-analysis/list',
                        'menus' => 'user-analyse-area-analysis'
                    ],

                ],
            ],
            [
                'name' => '设置',
                'icon' => 'fa fa-cogs fa-fw',
                'url' => '',
                'menus' => 'user-setting',
                'child' => [
                    [
                        'name' => '会员设置',
                        'url' => '/system/config/index?group=user',
                        'menus' => 'user-setting-default'
                    ],
                    [
                        'name' => '会员等级',
                        'url' => '/user/user-rank/list',
                        'menus' => 'user-setting-rank-list'
                    ],
                    [
                        'name' => '店铺会员等级',
                        'url' => '/user/shop/list',
                        'menus' => 'user-setting-shop-list'
                    ],

                ],
            ],
        ]
    ];

    // 财务
    $_menu[] = [
        'name' => '财务',
        'url' => '',
        'menus' => 'finance',
        'child' => [
            [
                'name' => '资金',
                'icon' => 'fa fa-money fa-fw',
                'url' => '',
                'menus' => 'finance-capital',
                'child' => [
                    [
                        'name' => '商城账户',
                        'url' => '/finance/mall-account/list',
                        'menus' => 'finance-mall-account-list'
                    ],
                    [
                        'name' => '会员账户',
                        'url' => '/finance/user-account/list',
                        'menus' => 'finance-user-account-list'
                    ],
                    [
                        'name' => '充值管理',
                        'url' => '/finance/recharge/list',
                        'menus' => 'finance-recharge-list'
                    ],
                    [
                        'name' => '提现管理',
                        'url' => '/finance/deposit/list',
                        'menus' => 'finance-deposit-list'
                    ],
                    [
                        'name' => '神码统计',
                        'url' => '/finance/cashier/stats',
                        'menus' => 'finance-stats'
                    ],

                ],
            ],
            [
                'name' => '账单',
                'icon' => 'fa fa-clipboard fa-fw',
                'url' => '',
                'menus' => 'finance-bill',
                'child' => [
                    [
                        'name' => '店铺账单',
                        'url' => '/finance/bill/system-shop-bill',
                        'menus' => 'finance-shop-bill'
                    ],
                    [
                        'name' => '应收线下账单',
                        'url' => '/finance/offline-bill/list',
                        'menus' => 'finance-offline-bill'
                    ],

                ],
            ],
            [
                'name' => '统计',
                'icon' => 'fa fa-line-chart fa-fw',
                'url' => '',
                'menus' => 'finance-statistics',
                'child' => [
                    [
                        'name' => '数据概况',
                        'url' => '/finance/data-profiling/index',
                        'menus' => 'data-profiling-default'
                    ],
                    [
                        'name' => '店铺统计',
                        'url' => '/finance/shops-statistics/index',
                        'menus' => 'finance-shops-statistics'
                    ],
//                    [
//                        'name' => '会员统计',
//                        'url' => '/finance/users-statistics/index',
//                        'menus' => 'finance-users-statistics'
//                    ],
                    [
                        'name' => '销售分析',
                        'url' => '/finance/sales-analyse/index',
                        'menus' => 'finance-sales-analyse'
                    ],
                    [
                        'name' => '行业分析',
                        'url' => '/finance/industry-analyse/index',
                        'menus' => 'finance-industry-analyse'
                    ],
                    [
                        'name' => '财务统计',
                        'url' => '/finance/finance-statistics/index',
                        'menus' => 'finance-sales-statistics'
                    ],

                ],
            ],
        ]
    ];

    // APP
    $_menu[] = [
        'name' => 'APP',
        'url' => '',
        'menus' => 'app',
        'child' => [
            [
                'name' => '设置',
                'icon' => 'fa fa-cogs fa-fw',
                'url' => '',
                'menus' => 'app-setting',
                'child' => [
                    [
                        'name' => '商店设置',
                        'url' => '/system/config/index?group=app_setting',
                        'menus' => 'app-setting-store'
                    ],
                    [
                        'name' => '引导图片',
                        'url' => '/system/config/index?group=app_guide',
                        'menus' => 'app-setting-guide'
                    ],
                    [
                        'name' => '消息推送',
                        'url' => '/app/push-message/index',
                        'menus' => 'app_push_message'
                    ],
                    [
                        'name' => '基本设置',
                        'url' => '/system/config/index?group=app_setting_basic',
                        'menus' => 'mobile-setting-basic'
                    ],
                    [
                        'name' => '登录设置',
                        'url' => '/system/config/index?group=app_setting_login',
                        'menus' => 'mobile-setting-login'
                    ],
                    [
                        'name' => '首页设置',
                        'url' => '/system/config/index?group=app_setting_index',
                        'menus' => 'mobile-setting-index'
                    ],

                ],
            ],
            [
                'name' => '装修',
                'icon' => 'fa fa-magic fa-fw',
                'url' => '',
                'menus' => 'app-renovation',
                'child' => [
                    [
                        'name' => '首页装修',
                        'url' => '/design/tpl-setting/setup?page=app',
                        'menus' => 'app-setting-template',
                        'target' => '_blank',
                    ],

                ],
            ],
            [
                'name' => '打包',
                'icon' => 'fa fa-briefcase fa-fw',
                'url' => '',
                'menus' => 'app-pack',
                'child' => [
                    [
                        'name' => '自助打包教程',
                        'url' => '/app/pack/course',
                        'menus' => 'app-pack-course'
                    ],

                ],
            ],
            [
                'name' => '商家',
                'icon' => 'fa fa-flag fa-fw',
                'url' => '',
                'menus' => 'app-seller',
                'child' => [
                    [
                        'name' => '商家设置',
                        'url' => '/system/config/index?group=app_seller_setting',
                        'menus' => 'app-seller-setting'
                    ],
                    [
                        'name' => '消息推送',
                        'url' => '/app/seller-push-message/index',
                        'menus' => 'app-seller-push-message'
                    ],

                ],
            ],
            [
                'name' => '网点',
                'icon' => 'fa fa-map-marker fa-fw',
                'url' => '',
                'menus' => 'app-store',
                'child' => [
                    [
                        'name' => '网点设置',
                        'url' => '/system/config/index?group=app_store_setting',
                        'menus' => 'app-store-setting'
                    ],
                    [
                        'name' => '消息推送',
                        'url' => '/app/store-push-message/index',
                        'menus' => 'app-store-push-message'
                    ],

                ],
            ],
        ]
    ];

    // 微商城
    $_menu[] = [
        'name' => '微商城',
        'url' => '',
        'menus' => 'weixin',
        'child' => [
            [
                'name' => '设置',
                'icon' => 'fa fa-cogs fa-fw',
                'url' => '',
                'menus' => 'mobile-setting',
                'child' => [
                    [
                        'name' => '基本设置',
                        'url' => '/system/config/index?group=mobile_setting_basic',
                        'menus' => 'mobile-setting-basic'
                    ],
                    [
                        'name' => '登录设置',
                        'url' => '/system/config/index?group=mobile_setting_login',
                        'menus' => 'mobile-setting-login'
                    ],
                    [
                        'name' => '首页设置',
                        'url' => '/system/config/index?group=mobile_setting_index',
                        'menus' => 'mobile-setting-index'
                    ],

                ],
            ],
            [
                'name' => '微信',
                'icon' => 'fa fa-weixin fa-fw',
                'url' => '',
                'menus' => 'mobile-weixin',
                'child' => [
                    [
                        'name' => '微信设置',
                        'url' => '/system/config/index?group=weixin',
                        'menus' => 'mobile-weixin-config'
                    ],
                    [
                        'name' => '微信绑定',
                        'url' => '/system/config/index?group=weixin_bind',
                        'menus' => 'mobile-weixin_bind'
                    ],
                    [
                        'name' => '自定义菜单',
                        'url' => '/weixin/menu/list',
                        'menus' => 'mobile-weixin-menu'
                    ],
                    [
                        'name' => '关键词回复',
                        'url' => '/weixin/keyword/list',
                        'menus' => 'mobile-weixin-keyword'
                    ],
                    [
                        'name' => '粉丝管理',
                        'url' => '/weixin/user/list',
                        'menus' => 'mobile-weixin-user'
                    ],
                    [
                        'name' => '二维码管理',
                        'url' => '/weixin/qcode/list',
                        'menus' => 'mobile-weixin-qcode'
                    ],
                    [
                        'name' => '微信素材',
                        'url' => '/weixin/material/list',
                        'menus' => 'mobile-weixin-material'
                    ],
                    [
                        'name' => '消息推送',
                        'url' => '/weixin/push/index',
                        'menus' => 'mobile-weixin-push'
                    ],
                    [
                        'name' => '微信海报设置',
                        'url' => '/system/config/index?group=weixin_poster',
                        'menus' => 'mobile-weixin_poster'
                    ],
                    [
                        'name' => '微信小程序设置',
                        'url' => '/system/config/index?group=weixin_programs',
                        'menus' => 'mobile-weixin_programs'
                    ],
                    [
                        'name' => '微信小程序码管理',
                        'url' => '/weixin/programs-qrcode/list',
                        'menus' => 'mobile-weixin-programs-qrcode'
                    ],

                ],
            ],
            [
                'name' => '装修',
                'icon' => 'fa fa-magic fa-fw',
                'url' => '',
                'menus' => 'mobile-design',
                'child' => [
                    [
                        'name' => '首页装修',
                        'url' => '/design/tpl-setting/setup?page=m_site',
                        'menus' => 'mobile-design-setup',
                        'target' => '_blank',
                    ],
                    [
                        'name' => '资讯频道装修',
                        'url' => '/design/tpl-setting/setup?page=m_news',
                        'menus' => 'mobile-news-design',
                        'target' => '_blank',
                    ],
                    [
                        'name' => '商品详情页装修',
                        'url' => '/design/tpl-setting/setup?page=m_goods',
                        'menus' => 'mobile-goods-design',
                        'target' => '_blank',
                    ],

                ],
            ],
        ]
    ];

    return $_menu;
}

function get_backend_active_menus() {
//    $lastmenus = cookie('lastmenus'); // data-menus=mall|mall-setting|mall-setting-message
    if (request()->getPathInfo() == '/') {
        $active_url = '/index/index/index';
    } else {
        $active_url = request()->getRequestUri();
    }

    $menus = backend_menu();
    $arr2 = $arr3 = [];
    $active_menus = [];
    foreach ($menus as $menu) {
        if (!empty($menu['child'])) {
            foreach ($menu['child'] as $menu2) {
                $arr2[] = $menu2;
                if (!empty($menu2['child'])) {
                    foreach ($menu2['child'] as $menu3) {
                        $arr3[] = $menu3;
                        if ($active_url == $menu3['url']) {
                            $active_menus = [
                                $menu['menus'],
                                $menu2['menus'],
                                $menu3['menus'],
                            ];
                        }
                    }
                }
            }
        }
    }
    return [$active_url, $active_menus];
}

/**
 * 自定义函数递归的复制带有多级子目录的目录
 * 递归复制文件夹
 * @param type $src 原目录
 * @param type $dst 复制到的目录
 */
//参数说明：
//自定义函数递归的复制带有多级子目录的目录
function recurse_copy($src, $dst)
{
    $now = time();
    $dir = opendir($src);
    @mkdir($dst);

    while (false !== $file = readdir($dir)) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                recurse_copy($src . '/' . $file, $dst . '/' . $file);
            }
            else {
                if (file_exists($dst . DIRECTORY_SEPARATOR . $file)) {
                    if (!is_writeable($dst . DIRECTORY_SEPARATOR . $file)) {
                        exit($dst . DIRECTORY_SEPARATOR . $file . '不可写');
                    }
                    @unlink($dst . DIRECTORY_SEPARATOR . $file);
                }
                if (file_exists($dst . DIRECTORY_SEPARATOR . $file)) {
                    @unlink($dst . DIRECTORY_SEPARATOR . $file);
                }
                $copyrt = copy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file);
                if (!$copyrt) {
                    echo 'copy ' . $dst . DIRECTORY_SEPARATOR . $file . ' failed<br>';
                }
            }
        }
    }
    closedir($dir);
}

// 递归删除文件夹
function delFile($path,$delDir = FALSE) {
    if(!is_dir($path))
        return FALSE;
    $handle = @opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir) return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}