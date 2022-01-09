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
// | Date:2018-08-15
// | Description:PC端前端基类控制器
// +----------------------------------------------------------------------

namespace App\Modules\Base\Http\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\CartRepository;
use App\Repositories\CopyrightAuthRepository;
use App\Repositories\LinksRepository;
use App\Repositories\SeoRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class Frontend extends Foundation
{

    protected $template;

    protected $article;

    protected $copyrightAuth;

    protected $flinks;


    protected $view_path;

    protected $user = null;

    protected $user_id = 0;

    protected $session_id;

    protected $need_auth = false; // 是否需要登录 默认否

    protected $cart_goods_num = 0; // 购物车商品数量

    protected $user_rank_info = null;

    /*以下方法是新的基类方法*/
    protected $app_extra_data = null;
    protected $app_data = null;
    protected $web_data = null;
    protected $compact_data = null;
    protected $tpl_view = null;


    public function __construct()
    {
        parent::__construct();

//        $this->load_helper('');

        $this->template = new TemplateRepository();
        $this->article = new ArticleRepository();
        $this->copyrightAuth = new CopyrightAuthRepository();
        $this->flinks = new LinksRepository();

        $this->session_id = session()->getId(); // 当前的 session_id

        // 设置模板路径
//        $this->view_path = 'frontend.web.tpl_2018.';
//        view()->share('view_path', $this->view_path);


//        if (is_mobile() && (request()->getHost() != env('MOBILE_DOMAIN'))) {
//            // 手机访问 跳转到手机端相应页面
//            $pathInfo = request()->getPathInfo();
//            $basePath = $pathInfo;
//            $queryString = request()->getQueryString();
//            if ($queryString != '') {
//                $basePath = $pathInfo.'?'.$queryString;
//            }
//            $mobile_domain_host = __HTTP__.env('MOBILE_DOMAIN').$basePath;
//            return redirect($mobile_domain_host);
//        }
//        if (is_mobile() && (request()->getHost() == env('FRONTEND_DOMAIN'))) {
//
//            $this->middleware(function ($request, $next) {
//                // 手机访问 跳转到手机端相应页面
//                $pathInfo = request()->getPathInfo();
//                $basePath = $pathInfo;
//                $queryString = request()->getQueryString();
//                if ($queryString != '') {
//                    $basePath = $pathInfo.'?'.$queryString;
//                }
//                $mobile_domain_host = 'http://'.env('MOBILE_DOMAIN').$basePath;
//                return redirect($mobile_domain_host);
//
//            });
//        }

        // 验证是否登录 todo 必须使用中间件方式 否则获取不到用户登录信息
        $this->middleware(function ($request, $next) {
            if (is_mobile() && (request()->getHost() == env('FRONTEND_DOMAIN'))) {
                // 手机访问 跳转到手机端相应页面
                $pathInfo = request()->getPathInfo();
                $basePath = $pathInfo;
                $queryString = request()->getQueryString();
                if ($queryString != '') {
                    $basePath = $pathInfo.'?'.$queryString;
                }

                $mobile_domain_host = 'http://'.env('MOBILE_DOMAIN').$basePath;
                return redirect($mobile_domain_host);
            }

            if (auth('user')->check()) {
//                $this->user = session('user');
                if (empty($this->user)) {
                    $this->user = auth('user')->user();
                    $this->user_id = auth('user')->id();
                }else {
                    $this->user_id = session('user')->user_id;
                }

                // 会员等级信息
                $userRep = new UserRepository();
                $userRankInfo = $userRep->getUserRank($this->user->rank_points);
                view()->share('user_rank_info', $userRankInfo);
                $this->user_rank_info = $userRankInfo;

                // 会员安全级别
                $userSecurityLevel = $userRep->getUserSecurityLevel($this->user);
                $this->user->security_level = $userSecurityLevel;
                view()->share('user_info', $this->user);


                // 给用户计算会员价 登录前后不一样 todo 后期完善
                /*if ($user) {
                    $user['discount'] = (empty($user['discount'])) ? 1 : $user['discount'];
                    if($user['discount'] != 1) {
                        $c = Cart::where(['user_id' => $user['user_id'], 'prom_type' => 0])->where('member_goods_price = goods_price')->count();
                        $c && Cart::where(['user_id' => $user['user_id'], 'prom_type' => 0])->update(['member_goods_price' => ['exp', 'goods_price*' . $user['discount']]]);
                    }
                }*/
            }

            // 如果某些页面需要登录验证 则判断
            if (!auth('user')->check() && $this->need_auth) {
                if ($request->ajax()) {
                    return result(99, null, '需要登录');
                } else {
                    redirect('/login.html')->send();exit();
                }
            }

            // 获取当前登录用户购物车商品数量
            $cart = new CartRepository();
            $cart->setUserId($this->user_id);
            $cart->setUniqueId(session()->getId());
            $this->cart_goods_num = $cart->getUserCartGoodsNum();
            view()->share('cart_goods_num',$this->cart_goods_num);

            // 关键词搜索历史
            $search_history = !empty($_COOKIE['search_history']) ? unserialize($_COOKIE['search_history']) : [];
            view()->share('search_history', $search_history);

            return $next($request);
        });


        if (is_mobile() && !is_app()) { // 手机端访问 针对微信端)
            $this->compactMobileCommonData(); // 默认输出Mobile端公共变量
        } elseif(!is_mobile()) {
            $this->compactPcCommonData(); // 默认输出PC端公共变量
        }
//        $this->displayData();
//        $this->compactPcCommonData(); // 默认输出PC端公共变量
//        $this->compactMobileCommonData(); // 默认输出Mobile端公共变量

    }




    /**
     * 输出PC端公共变量
     */
    public function compactPcCommonData()
    {

        if (request()->routeIs('pc_news_home') || request()->routeIs('pc_news_list') || request()->routeIs('pc_show_news')) {
            // pc端资讯首页或列表
            $nav_page = 'news';
            $nav_position = 2; // 中间
            $limit = 5;
        } else {
            // 默认 pc端中间导航
            $nav_page = 'site';
            $nav_position = 2; // 底部
            $limit = 13;
        }

        $navigation = $this->template->getNavigationData($nav_page, $limit, $nav_position); // 中间导航菜单
        $nav_category = $this->template->getNavCategoryData(); // 分类导航
        $footer_help_article = $this->article->getHelpCenterArticle(); // 帮助中心文章列表
        $footer_navigation = $this->template->getNavigationData('site', 5, 3); // 底部导航菜单

//        dd($nav_category);
        // 底部资质导航
        $copyCondition = [
            'where' => [
                ['is_show', 1]
            ],
            'sortname' => 'auth_sort',
            'sortorder' => 'asc'
        ];
        list($copyright_auth, $copyright_auth_total) = $this->copyrightAuth->getList($copyCondition);

        // 底部友情链接
        $condition = [
            'where' => [
                ['is_show',1]
            ],
            'sortname' => 'links_sort',
            'sortorder' => 'asc',
        ];
        list($links_list, $links_total) = $this->flinks->getList($condition);

        $blocks = [
            'navigation' => $navigation,
            'nav_category' => $nav_category,
            'footer_help_article' => $footer_help_article,
            'footer_navigation' => $footer_navigation,
            'copyright_auth' => $copyright_auth,
            'links_list' => $links_list,
        ];

        $this->setLayoutBlock($blocks);
    }

    /**
     * 输出Mobile端公共变量
     */
    public function compactMobileCommonData()
    {

        if (request()->routeIs('mobile_news_home') || request()->routeIs('mobile_news_list')) {
            // 手机端资讯首页或列表
            $nav_page = 'm_news';
            $nav_position = 2; // 中间
            $limit = 5;
        } else {
            // 默认 手机端底部导航
            $nav_page = 'm_site';
            $nav_position = 3; // 底部
            $limit = 5;
        }

        $navigation = $this->template->getNavigationData($nav_page, $limit, $nav_position); // 导航菜单
        $blocks = [
            'navigation' => $navigation,
        ];

        $this->setLayoutBlock($blocks);
    }

    /**
     * SEO设置
     *
     * 如果是分类或者自定义tkd
     * $type = [1 => 'title', 2 => 'keywords', 3 => discription]
     * $params = ['name' => '关键词或者分类名称']
     *
     * @param string|array $type 如：seo_goods（商品详情页）
     * @param array $params
     */
    public function show_seo($type, $params = []){

        if (!empty($type)) {
            $seoRep = new SeoRepository();
            $seoArr = $seoRep->type($type, $params);
            $seo['title'] = preg_replace("/{.*}/siU",'', $seoArr['title']);
            $seo['keywords'] = preg_replace("/{.*}/siU",'', $seoArr['keywords']);
            $seo['discription'] = preg_replace("/{.*}/siU",'', $seoArr['discription']);
            if (isset($seoArr['image'])) {
                $seo['image'] = preg_replace("/{.*}/siU",'', $seoArr['image']);
            }

            view()->share('seo_title', !empty($seo['title']) ? $seo['title'] : sysconf('site_name'));
            view()->share('seo_keywords', !empty($seo['keywords']) ? $seo['keywords'] : sysconf('site_name'));
            view()->share('seo_description', !empty($seo['discription']) ? $seo['discription'] : sysconf('site_name'));
            view()->share('seo_image', isset($seo['image']) ? $seo['image'] : '');
        }

    }


    /*以下方法是新的基类方法 为了缩减代码量 复用代码 PC端、微信端、APP端三端共用一个方法*/


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
        $appContext = !empty($data['app_context_data']) ? $data['app_context_data'] : $this->getAppContext();
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
        if ($this->user_id > 0) {
            $user = $this->user;
            $user_rank_info = $this->user_rank_info;
            $unreadMsgCnt = "0"; // todo 未读消息数量

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
                'last_ip' => $user->last_ip,
                'last_region_code' => null,
                'user_rank' => [
                    'rank_id' => $user_rank_info['rank_id'],
                    'rank_name' => $user_rank_info['rank_name'],
                    'rank_img' => $user_rank_info['rank_img'],
                    'min_points' => $user_rank_info['min_points'],
                    'max_points' => $user_rank_info['max_points'],
                    'type' => $user_rank_info['type'],
                    'is_special' => $user_rank_info['is_special'],
                ],
                'unread_msg_cnt' => $unreadMsgCnt,
            ];
        }

        $data['context'] = [
            'current_time' => time(), // 当前时间戳 12位
            'user_info' => $user_info, // 用户信息
            'config'=>[
                'mall_logo'=>sysconf('mall_logo'),
                'backend_logo'=>sysconf('backend_logo'),
                'site_name'=>sysconf('site_name'),
                'user_center_logo'=>sysconf('user_center_logo'),
                'mall_region_code'=>sysconf('mall_region_code'),
                'mall_region_name' => [
                    '42'=>'湖北省',
                    '42,11'=>'黄冈市',
                    '42,11,22'=>'红安县'
                ],
                'mall_address'=>sysconf('mall_address'),
                'site_icp'=>sysconf('site_icp'),
                'site_copyright'=>sysconf('site_copyright'),
                'stats_code'=>sysconf('stats_code'),
                'mall_service_right'=>sysconf('mall_service_right'),
                'open_download_qrcode'=>sysconf('open_download_qrcode'),
                'mall_phone'=>sysconf('mall_phone'),
                'mall_email'=>sysconf('mall_email'),
                'mall_qq'=>sysconf('mall_qq'),
                'mall_wangwang'=>sysconf('mall_wangwang'),
                'favicon'=>sysconf('favicon'),
                'mall_wx_qrcode'=>sysconf('mall_wx_qrcode'),
                'default_user_portrait'=>sysconf('default_user_portrait'),
                'aliim_enable'=>sysconf('aliim_enable'),
//                'aliim_appkey'=>sysconf('aliim_appkey'),
//                'aliim_secret_key'=>sysconf('aliim_secret_key'),
//                'aliim_main_customer'=>sysconf('aliim_main_customer'),
//                'aliim_customer_logo'=>sysconf('aliim_customer_logo'),
//                'aliim_welcome_words'=>sysconf('aliim_welcome_words'),
//                'aliim_uid'=>sysconf('aliim_uid'),
//                'aliim_pwd'=>sysconf('aliim_pwd'),
                'goods_price_format'=>'￥{0}'
            ],
            'site_id'=>0
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
            sysconf('app_android_is_open');

            return result(0, $this->app_data, '', $this->app_extra_data);
        } elseif (is_app('ios')) { // Ios端访问
            sysconf('app_ios_is_open');

            return result(0, $this->app_data, '', $this->app_extra_data);
        } elseif (is_mobile() && !is_app()) { // 手机端访问 针对微信端
            // 网站状态 1正常 0暂时关闭
            if (sysconf('m_site_status') == 0) {
                // 暂时关闭
                abort(505, '站点维护中');
            }

            /*start 以下是没有手机端页面的路由*/
            $request_path = request()->path();
            if (str_contains($request_path, 'help/')) {// 手机端暂不支持帮助中心
                abort(500, '手机端暂不支持帮助中心');
            }

            /*end 没有手机端页面的路由*/

            // 输出公共变量
            $this->compactMobileCommonData();

            return view($this->tpl_view, $this->compact_data);
        } else { // pc端访问
            // 网站状态 1正常 2升级中 0暂时关闭
            if (sysconf('site_status') == 2) {
                // 升级中
                abort(404, sysconf('upgrade_comment'));
            } elseif (sysconf('site_status') == 0) {
                // 暂时关闭
                abort(404, sysconf('close_comment'));
            }

            // 输出公共变量
            $this->compactPcCommonData();

            if (!empty($this->tpl_view)) {
                return view($this->tpl_view, $this->compact_data);
            }
        }
    }

}