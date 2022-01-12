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

use App\Models\Cart;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CartRepository;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\ShopConfigRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Services\ConnectApi;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\Exception;
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

    public function __construct()
    {
        parent::__construct();

        $this->template = new  TemplateRepository();
        $this->selector = new TemplateSelectorRepository();
        $this->templateItem = new TemplateItemRepository();
        $this->templateCat = new TemplateCatRepository();
        $this->navBanner = new NavBannerRepository();
        $this->navigation = new NavigationRepository();
        $this->navQuickService = new NavQuickServiceRepository();
    }

    public function home(Request $request)
    {
        if (is_app()) {
            $page = 'app';
        } elseif (is_mobile() || (request()->getHost() == env('MOBILE_DOMAIN'))) {
            $page = 'm_site';
        } else {
            $page = 'site';
        }

        // 获取首页焦点图
        $navBannerCondition = [
            'where' => [
                ['nav_page', $page],
                ['is_show', 1]
            ],
            'limit' => 5, // 只取5个
            'sortname' => 'banner_sort',
            'sortorder' => 'asc'
        ];
        list($nav_banner, $total) = $this->navBanner->getList($navBannerCondition);

//        $shopConfigRep = new ShopConfigRepository();
//        $shopConfigRep->createShopConfigData(1);

        $template = $this->templateItem->getTplItems($page); // app端模板数据

        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page); // 模板Html数据

        // 判断首页静态页面开启状态
        $webStatic = false;


        $compact = compact('page', 'tplHtml', 'navContainerHtml', 'nav_banner', 'webStatic');

        $this->show_seo('seo_index'); // SEO

//        $str = '';
//        $data = object_to_field_str($str);
//        dd($data);
//        dd(is_mobile());
        // 测试代码
//        dd(json_decode(sysconf('shipping_time'),true));
//        $user = new User();
//        var_dump($user->makeVisible('updated_at')->get()->toArray());die;


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
            'tpl_view' => 'home.home'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
//        return view('home.home', $compact);
    }


    /**
     * 测试短信发送功能
     */
    public function send()
    {

        $connectApi = new ConnectApi();
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
        print_r($data);die;
    }
}