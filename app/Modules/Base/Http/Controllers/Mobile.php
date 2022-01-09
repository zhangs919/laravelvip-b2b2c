<?php

namespace App\Modules\Base\Http\Controllers;


use App\Repositories\CartRepository;
use App\Repositories\SeoRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\UserRepository;

class Mobile extends Foundation
{

    protected $template;

    protected $view_path;

    protected $user = null;

    protected $user_id = 0;

    protected $session_id;

    protected $need_auth = false; // 是否需要登录 默认否

    protected $cart_goods_num = 0; // 购物车商品数量


    public function __construct()
    {
        parent::__construct();

//        $this->load_helper('');

        // 网站状态 1正常 0暂时关闭
        if (sysconf('m_site_status') == 0) {
            // 暂时关闭
            abort(404, '站点维护中');
        }

        $this->checkRequestRoute(); // 检查请求路由 如果该路由地址没有手机端页面 则抛出异常

        $this->template = new TemplateRepository();

        $this->session_id = session()->getId(); // 当前的 session_id

        $this->compactCommonData();

        // 设置模板路径
        $this->view_path = 'frontend.web_mobile.tpl_2018.';
        view()->share('view_path', $this->view_path);


        // 验证是否登录 todo 必须使用中间件方式 否则获取不到用户登录信息
        $this->middleware(function ($request, $next) {

            /*start 以下是没有手机端页面的路由*/
            $request_path = request()->path();
            if (str_contains($request_path, 'help/')) {// 手机端暂不支持帮助中心
                abort(500, '手机端暂不支持帮助中心');
            }

            /*end 没有手机端页面的路由*/

            if (auth('user')->check()) {
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

                // 会员安全级别
                $userSecurityLevel = $userRep->getUserSecurityLevel($this->user);
                $this->user->security_level = $userSecurityLevel;
                view()->share('user_info', $this->user);
            }

            // 如果某些页面需要登录验证 则判断
            if (!auth('user')->check() && $this->need_auth) {
                redirect('/login.html')->send();exit();
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
    }

    public function checkRequestRoute()
    {
        // 手机端暂不支持帮助中心
    }


    /**
     * 输出公共变量
     */
    public function compactCommonData()
    {

        if (request()->routeIs('m_news_home') || request()->routeIs('m_news_list')) {
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

}