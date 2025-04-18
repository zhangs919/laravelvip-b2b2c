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
// | Date:2018-08-17
// | Description: 首页控制器
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Events\NewPrice;
use App\Events\PusherEvent;
use App\Jobs\ExampleJob;
use App\Models\Article;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BonusRepository;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Services\ConnectApi;
use App\Services\JpushService;
use App\Services\UniPushService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use QL\QueryList;

class HomeController extends Frontend
{

    protected $template;
    protected $selector;
    protected $templateItem;
    protected $templateCat;
    protected $navBanner;
    protected $navigation;
    protected $navQuickService;

    public function __construct(
        TemplateRepository $template
        ,TemplateSelectorRepository $selector
        ,TemplateItemRepository $templateItem
        ,TemplateCatRepository $templateCat
        ,NavBannerRepository $navBanner
        ,NavigationRepository $navigation
        ,NavQuickServiceRepository $navQuickService
    )
    {
        parent::__construct();

        $this->template = $template;
        $this->selector = $selector;
        $this->templateItem = $templateItem;
        $this->templateCat = $templateCat;
        $this->navBanner = $navBanner;
        $this->navigation = $navigation;
        $this->navQuickService = $navQuickService;
    }


    /**
     * 获取底部导航
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function navigation()
    {
        if (is_app()) {
            $nav_page = 'app';
        } else {
            $nav_page = 'm_site';
        }
        $limit = 6;
        $nav_position = 3; // 底部
        $navigation = $this->template->getNavigationData($nav_page, $limit, $nav_position); // 导航菜单

        $data = [
            'navigation' => $navigation,
            'txtColor' => [
                'title' => '文字颜色',
                'name' => 'txtColor',
                'default' => [
                    'item' => '#282828'
                ],
                'color' => [
                    'item' => '#282828'
                ]
            ],
            'activeTxtColor' => [
                'title' => '选中文字颜色',
                'name' => 'activeTxtColor',
                'default' => [
                    'item' => '#F62C2C'
                ],
                'color' => [
                    'item' => '#F62C2C'
                ]
            ],
            'bgColor' => [
                'title' => '背景颜色',
                'name' => 'bgColor',
                'default' => [
                    'item' => '#fff'
                ],
                'color' => [
                    'item' => '#fff'
                ]
            ]
        ];
        return result(0, $data);
    }

    public function home(Request $request, $tpl_name = 'home')
    {
//        $data = Article::search("订单")->get();
//        $data = Article::all();
//        dd($data);
//        $params = [
//            'group_name' => '测试组', //RASL_0921_881c1882ef6345d6addda4352adfa521 RASL_0921_5c5f23a956944f5282013236e3fa65c1
//            'title' => '测试',
//            'body' => '测试',
////            'cid' => '9eea11bec080b30dea017dc9c80d4009',
//            'click_type' => 'none'
//        ];
//        $params = [
////            'is_async' => false,
////            'task_id' => 'RASL_0921_09b0768075074b30bc8f1259d6f82166', //
//            'title' => '测试122',
//            'body' => '测试2',
//            'tag_list' => [
//                [
//                    'key' => 'phone_type',
//                    'values' => [
//                        'android',
//                        'ios'
//                    ],
//                    'opt_type' => 'or'
//                ]
//            ],
//            'click_type' => 'none'
//        ];
//        $params = [
//            'is_async' => false,
//            'msg_list' => [
//                [
//                    'title' => '测试',
//                    'body' => '测试',
//                    'alias' => 'a1',
//                    'click_type' => 'none'
//                ],
//                [
//                    'title' => '测试2',
//                    'body' => '测试2',
//                    'alias' => 'a1',
//                    'click_type' => 'none'
//                ],
//            ]
//        ];
//        dd((new UniPushService())->pushByTag($params));
        if (is_app()) {
            $page = 'app';
        } elseif (is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) {
            $page = 'm_site';
        } else {
            $page = 'site';
        }

        // 获取首页焦点图
        list($nav_banner, $total) = $this->navBanner->getNavBanner($page);
        $template = $this->templateItem->getTplItems($page); // app端模板数据
        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page); // 模板Html数据

        // 判断首页静态页面开启状态
        $webStatic = (is_mobile() && !is_app()) ? sysconf('m_site_web_static') : sysconf('site_web_static');
        $sign_in_entry = "0"; // 签到入口是否开启 0-不显示 1-显示签到入口弹框


        $compact = compact('page','template', 'tplHtml', 'navContainerHtml', 'nav_banner', 'webStatic','sign_in_entry');

        $this->show_seo('seo_index'); // SEO

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'template' => $template,
                'app_header_style' => 1,
            ],
            'app_suffix_data' => [
                'user_id' => null,
                'user_name' => null,
                'SYS_SITE_MODE' => '1',
                'site_id' => 1,
                'site_name' => '总站',
                'goods_counts' => 0
            ],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'home.'.$tpl_name
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function bonusPush(Request $request, $bonus_id)
    {
        $seo_title = sysconf('site_name');

        $bonusRep = new BonusRepository();
        $bonus_info = $bonusRep->getById($bonus_id);
        if (empty($bonus_info)) {
            return abort(404, '红包id无效');
        }

        $bonus_info->shop_name = Shop::where('shop_id', $bonus_info->shop_id)->value('shop_name');

        return view('home.bonus_push', compact('seo_title', 'bonus_info'));
    }

    public function bonusSuccess(Request $request, $bonus_id)
    {
        $seo_title = sysconf('site_name');

        $bonusRep = new BonusRepository();
        $bonus_info = $bonusRep->getById($bonus_id);

        if (empty($bonus_info)) {
            return abort(404, '红包id无效');
        }

        $bonus_info->user_name = $this->user['user_name'] ?? null;
        $bonus_info->shop_name = Shop::where('shop_id', $bonus_info->shop_id)->value('shop_name');

        return view('home.bonus_success', compact('seo_title', 'bonus_info'));
    }

    /**
     * 装修预览
     *
     * @param Request $request
     * @return mixed
     */
    public function preview(Request $request)
    {

        return $this->home($request, 'preview');
    }


    /**
     * 测试短信发送功能
     */
    public function send(Request $request, ConnectApi $connectApi)
    {
        $a = Article::search('订单查询')->get();
        dd($a);
        $ret = $connectApi->sendCaptcha('18669035369', 1);

//        $smsService = new SmsService();
//        $ret = $smsService->send('18669035369', '您的验证码为：6379，该验证码 5 分钟内有效，请勿泄漏于他人。');

        dd($ret);
    }

    public function collectGoods()
    {
        header('Content-type:text/html;charset=utf-8');
        $url = "https://detail.tmall.com/item.htm?id=578637124349&spm=875.7931836/B.2017077.6.6614426510Skct&scm=1007.12144.81309.73263_0&pvid=20e53276-e569-45a0-bfb2-b6c57d38ae79&utparam={%22x_hestia_source%22:%2273263%22,%22x_object_type%22:%22item%22,%22x_mt%22:8,%22x_src%22:%2273263%22,%22x_pos%22:5,%22x_pvid%22:%2220e53276-e569-45a0-bfb2-b6c57d38ae79%22,%22x_object_id%22:578637124349}";
//        $ql = QueryList::get($url)->encoding('utf-8', 'gbk');
//        $rt = [];
//        $rt['goods_name'] = $ql->find('.tb-detail-hd > h1')->texts();
//        $rt['goods_price'] = $ql->find('.tm-price-panel dd span')->texts();
//
//        dd($rt);

        $str = QueryList::get($url)
            ->encoding('utf-8', 'gbk')->getHtml();
        $preg = "/TShop.Setup\(*?\)/i";
        $start_str = <<<STR
TShop.Setup(
	  	
STR;
        $end_str = <<<STR
	  );
})()
STR;


        $preg = "/TShop.Setup\([\s\S]*?\}\)\(\)/i";
        preg_match($preg,$str, $matches);    //第四个参数中的3表示替换3次，默认是-1，替换全部
        $res = str_replace([$start_str, $end_str], '', $matches[0]);
        $goods_data = json_decode($res, true);
        var_export($goods_data);die;
        $rules = [
            'goods_name' => ['.tb-detail-hd > h1', 'text'],
            'goods_price' => ['tm-fcs-panel', 'html'],
            'tm_count' => ['.tm-count', 'text'],
            'images' =>['img', 'src'],
            'reg' => ['TShop.Setup', 'text']
        ];
        $data = QueryList::get($url)
            ->encoding('utf-8', 'gbk')
            ->rules($rules)->range('')->queryData();
        dd($data);die;
    }

    public function amap()
    {

        return view('home.amap');
    }

    /**
     * pusher 测试
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pusherTest()
    {

// 记录器提供了 7 种在 RFC 5424 标准内定义的记录等级:
// debug, info, notice, warning, error, critical, and alert.
//        Log::info('info');
//        Log::info('info',array('context'=>'additional info'));
//        Log::error('error');
//        Log::warning('warning');

        // 开启 log
//        DB::connection()->enableQueryLog();
//        DB::table('user')->get();
// 获取已执行的查询数组
//        dd(URL::asset('foo/bar'));

// 获取 monolog 实例
//        Log::getMonolog();
// 添加监听器
//        Log::listen(function($level, $message, $context) {});

//        dd(collect(['taylor', 'abigail']));
//        dd(Str::snake('fooBar'));
//        dd(Arr::flatten(['name'=>'joe','language'=>['php','ruby']]));
//        dd(elixir('js/jquery.js'));

//        event(new PusherEvent('hello world'));
        Queue::push(ExampleJob::dispatch(),['message'=>'hello']);
//        Event::dispatch(new PusherEvent('heloo'));
//        dd(Event::getListeners('pusher-event'));
//        while (true) {
//            event(new NewPrice([
//                'value' => rand(0, 5000)
//            ]));
//            sleep(1);
//        }

//        event(new NewPrice([
//            'value' => rand(0, 5000)
//        ]));

        return view('home.pusher_test');
    }

    /**
     * 手动测试推送（极光推送）
     *
     * @param Request $request
     */
    public function jpush(Request $request)
    {
        // 推送平台 ios android
        $params['platform'] = 'android';
        // 推送标题
        $params['title'] = '恭喜您中奖了！';
        // 推送内容
        $params['content'] = '恭喜您中奖了！500万元大奖哦！';
        // 通知栏样式 ID
        $params['builderId'] = 1;
        // 附加字段（这里自定义 Key / value 信息，以供业务使用）
        $params['extras'] = [
            'orderid' => 13545,
        ];
        // 推送类型 1-别名 2-注册id 3-全部
        $params['type'] = 3;

        // 注册ID 可以是单个 也可以是 数组
        // $params['registrationId'] = '170976fsdas554ewerr98f28';
        // or
        // $params['registrationId'] = [
        //     '170976fsdas554ewerr98f28',
        //     '120c8545we15we46b8929e'
        // ];

        // 别名 可以是单个 也可以是 数组
        // $params['alias'] = '51651545154';
        // or
        // $params['alias'] = [
        //     '51651545154',
        //     '61654564897',
        // ];

        // 开始推送
        $data = JpushService::androidOrIosPushByAlias($params);

        dd($data);
    }
}
