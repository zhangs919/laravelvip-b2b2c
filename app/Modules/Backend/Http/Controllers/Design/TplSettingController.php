<?php

namespace App\Modules\Backend\Http\Controllers\Design;

use App\Models\Article;
use App\Models\ArticleCat;
use App\Models\Bonus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\Shop;
use App\Models\TemplateCat;
use App\Models\TemplateItem;
use App\Models\TplBackup;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\LinkTypeRepository;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\ShopCreditRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TplSettingController extends Backend
{

    protected $template;
    protected $selector;
    protected $templateItem;
    protected $templateCat;
    protected $navBanner;
    protected $navigation;
    protected $navQuickService;
    protected $linkType; // 链接类型

    public function __construct(
        TemplateRepository $template
        ,TemplateSelectorRepository $selector
        ,TemplateItemRepository $templateItem
        ,TemplateCatRepository $templateCat
        ,NavBannerRepository $navBanner
        ,NavigationRepository $navigation
        ,NavQuickServiceRepository $navQuickService
        ,LinkTypeRepository $linkType
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
        $this->linkType = $linkType;
    }

    public function setup(Request $request)
    {

        $page = $request->get('page', 'site');
        $topic_id = $request->get('topic_id', 0);

        // 从 template_item 表中获取模板数据
        $where[] = ['page', $page];
        if ($topic_id > 0) {
            $where[] = ['topic_id', $topic_id];
        }
        $condition = [
            // data,shop_id,page,sort,ext_info,tpl_title,is_valid,site_id,code,file //这些字段从模板表取 tpl_name,icon,type
            'field' => ['uid', 'data', 'shop_id', 'page', 'sort', 'ext_info', 'tpl_title', 'is_valid', 'site_id', 'code', 'file'],
            'where' => $where,
            'limit' => 0, // 查询全部
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($templateItems, $itemCount) = $this->templateItem->getList($condition);

        foreach ($templateItems as &$item)
        {
//            $tplItem = $this->templateItem->detail(['uid'=>$item->uid, 'page'=>$page]);

            $tplInfo = $this->template->detail(['code'=>$item->code]);

            $render = $this->templateItem->getTemplateItemHtml($item->uid, $page, true);

            $item->format_is_valid = $item->is_valid ? '隐藏' : '显示';
            $item->file = $render;
            $item->tpl_name = $tplInfo->tpl_name;
            $item->icon = $tplInfo->icon;
            $item->type = $tplInfo->type;


        }
        $jsonData = $templateItems;
        $navigation_limit = 13;
        $nav_position = 2;
        $webStatic = 0;

        switch ($page) {
            case 'site':
                // 电脑端首页装修
                $sTitle = '商城首页';
                $nav_position = 2; // 中部导航
                $navigation_limit = 13;

                // 判断首页静态页面开启状态
                $webStatic = sysconf('site_web_static');
                // 测试数据
//                $jsonData = '';
                break;
            case 'm_site':
                // 微商城装修
                $sTitle = '微商城首页';
                // 测试数据
//                $jsonData = '';
                $nav_position = 3; // 底部导航
                $navigation_limit = 5;

                // 判断首页静态页面开启状态
                $webStatic = sysconf('m_site_web_static');

                break;
            case 'topic':
                // 电脑端专题活动装修
                $sTitle = '专题活动';
                // 测试数据
//                 $jsonData = '';

                break;
            case 'm_topic':
                // 手机端专题活动装修
                $sTitle = '微专题活动';
                // 测试数据
//                 $jsonData = '';

                $jsonDataEmpty = '[]'; // 空数据
                break;
            case 'news':
                // 电脑端资讯装修
                $sTitle = '资讯频道';
                // 测试数据
                $nav_position = 2; // 中部导航
                $navigation_limit = 5;

                break;
            case 'm_news':
                // 手机端资讯装修
                $sTitle = '微资讯频道';
                $nav_position = 2; // 底部导航

                // 测试数据
//                 $jsonData = '';

                break;

            case 'm_goods':
                // 手机端商品详情页装修
                $sTitle = '';
                $nav_position = 3; // 底部导航
                $navigation_limit = 3;

                // 测试数据
                $jsonData = '';

                break;

            case 'app':
                // APP端首页装修
                $sTitle = 'APP首页';
                $nav_position = 3; // 底部导航
                $navigation_limit = 5;

                // 测试数据
//                 $jsonData = '';

                break;

            default:
                // 默认
                $sTitle = '';
                break;
        }

        // 获取商城导航
        $navigation = $this->template->getNavigationData($page, $navigation_limit, $nav_position);

        // 获取分类导航相关数据
        $nav_category = $this->template->getNavCategoryData($page);

        // 获取首页焦点图
        $nav_banner = $this->template->getNavBannerData($page);

        // 获取装修主题列表 tpl_backup is_theme=1
        $tpl_backup_theme_where[] = ['shop_id', 0];
        $tpl_backup_theme_where[] = ['site_id', 0];
        $tpl_backup_theme_where[] = ['page', $page];
        $tpl_backup_theme_where[] = ['topic_id', $topic_id];
        $tpl_backup_theme_where[] = ['is_theme', 1]; // 主题模板
        $theme_list = TplBackup::where($tpl_backup_theme_where)->orderBy('back_id', 'asc')->get()->toArray();

        $title = sysconf('site_name').'-'.$sTitle.'装修设置';
        $is_design = true; // 是否装修模式



        $compact = compact('page', 'topic_id', 'title', 'jsonData', 'nav_banner', 'navigation', 'nav_category', 'theme_list', 'is_design', 'webStatic');

        return view('design.tpl-setting.'.$page, $compact);
    }

    /**
     * 选择装修模板
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Throwable
     */
    public function selectTemplate(Request $request)
    {
        // $id= 0, $code = '', $sort = 0, $page = '', $topic_id = 0
        $id = $request->get('id', 0);
        $code = $request->get('code', '');
        $sort = $request->get('sort', 0);
        $page = $request->get('page', '');
        $topic_id = $request->get('topic_id', 0);
        $tplInfo = $this->template->detail(['code'=>$code]);

        // PC端-1/手机端-2/APP端-3
        if (Str::contains($page, 'm_')) {
            $tpl_client = 2;
            $tpl_dir = 'mobile';
        } elseif ($page == 'app') {
            $tpl_client = 3;
            $tpl_dir = 'mobile';
        } else {
            $tpl_client = 1;
            $tpl_dir = 'pc';
        }
        // 判断是否超过模板数量
        if (in_array($page, ['site', 'm_site'])) {
            // 导航模板 最多只允许添加2个
            $navTplArr = $this->template->getTplList($tpl_client, 5, 'code');
            if (in_array($code, $navTplArr)) {
                $nav_tpl_count = TemplateItem::where('page', $page)
                    ->whereIn('code', $navTplArr)->count();
                if ($nav_tpl_count >= 2) {
                    return result(-1, '', '最多只能添加两个导航模板');
                }
            }

        }

        // 保存模板item信息
        $insert = [
            'id' => !empty($id) ? $id : 0,
            'uid' => make_uuid(),
            'code' => $code,
            'is_valid' => 1,
            'page' => $page,
            'topic_id' => $topic_id,
            'sort' => $sort,
        ];
        $ret = $this->templateItem->store($insert);
        if ($ret === false) {
            return result(-1, '', '添加失败');
        }

        if ($code == 'nav_quick_service') {
            // 快捷服务列表
            $nQSCondition = [
                'where' => [['is_show', 1]],
                'sortname' => 'sort',
                'sortorder' => 'asc'
            ];
            list($quickService, $total) = $this->navQuickService->getList($nQSCondition);
            view()->share('quickService', $quickService);
        }

        $params = [
            'tpl_name' => '',
            'tpl_type' => '', // 获取模板类型名称 如：广告模板
            'is_valid' => '',
            'uid' => $ret->uid,
            // todo 如何动态获取下面这些参数
            'cat_id' => 1,
            'number' => 1,
            'type' => 1,
            'is_design' => true, // 是否装修模式
        ];

        $render = view('design.templates.'.$tpl_dir.'.'.$tplInfo['type'].'.'.$code, $params)->render();
        return result(0, $render, '添加成功', ['uid' => $ret->uid]);
    }

    public function templateRefresh(Request $request)
    {
//        $page = 'topic', $uid = '1518927139SWHG1K'
        $page = $request->get('page');
        $uid = $request->get('uid', ''); // 当uid为空时 刷新页面的所有数据

        $data = [];
        // 判断uid是否为空
        if (empty($uid)) {
            // 为空 刷新页面的所有数据
            $uids = TemplateItem::where('page', $page)->select(['uid'])->pluck('uid');
            foreach ($uids as $uid) {
                $tplItem = $this->templateItem->detail(['uid'=>$uid]);

                $tplInfo = $this->template->detail(['code'=>$tplItem['code']]);

                $render = $this->templateItem->getTemplateItemHtml($uid, $page, true);

                $data[] = [
                    'code' => $tplItem['code'],
                    'data' => $tplItem['data'],
                    'ext_info' => $tplItem['ext_info'],
                    'file' => $render,
                    'format_is_valid' => $tplItem['is_valid'] ? '隐藏' : '显示',
                    'is_valid' => $tplItem['is_valid'],
                    'page' => $page,
                    'shop_id' => $tplItem['shop_id'],
                    'site_id' => $tplItem['site_id'],
                    'sort' => $tplItem['sort'],
                    'tpl_id' => null,
                    'tpl_name' => $tplInfo['tpl_name'],
                    'tpl_title' => null,
                    'type' => $tplInfo['type'],
                    'tpl_type' => design_tpl_type($tplInfo['type']),
                    'uid' => $uid
                ];
            }
        } else {
            // 不为空 刷新单个uid的数据
            $tplItem = $this->templateItem->detail(['uid'=>$uid]);

            $tplInfo = $this->template->detail(['code'=>$tplItem['code']]);

            $render = $this->templateItem->getTemplateItemHtml($uid, $page, true);

            $data = [
                [
                    'code' => $tplItem['code'],
                    'data' => $tplItem['data'],
                    'ext_info' => $tplItem['ext_info'],
                    'file' => $render,
                    'format_is_valid' => $tplItem['is_valid'] ? '隐藏' : '显示',
                    'is_valid' => $tplItem['is_valid'],
                    'page' => $page,
                    'shop_id' => $tplItem['shop_id'],
                    'site_id' => $tplItem['site_id'],
                    'sort' => $tplItem['sort'],
                    'tpl_id' => null,
                    'tpl_name' => $tplInfo['tpl_name'],
                    'tpl_title' => null,
                    'type' => $tplInfo['type'],
                    'tpl_type' => design_tpl_type($tplInfo['type']),
                    'uid' => $uid
                ]
            ];
        }


        return response($data);
    }

    public function validTpls(Request $request)
    {
        $uid = $request->get('uid');
        $ret = $this->templateItem->validTpls($uid);
        if (!$ret) {
            return result(-1, '', '设置失败');
        }

        // 查询设置过后的状态
        $isValid = $this->templateItem->checkIsValid($uid);
        $tplInfo = $this->templateItem->detail(['uid'=>$uid]);
        $data = [
            'is_valid' => $isValid,
            'page' => $tplInfo['page'],
            'uid' => $uid
        ];

        return result(0, $data, '设置成功');
    }

    /**
     * 批量设置模板模块显示/隐藏
     *
     * @param Request $request
     * @return array
     */
    public function batchValidTpls(Request $request)
    {
        $uids = $request->post('uids');
        $is_valid = $request->post('is_valid');
        $uids_str = implode(',', $uids);

        $ret = TemplateItem::whereIn('uid', $uids)->update(['is_valid'=>$is_valid]);
        if ($ret === false) {
            // Log
            admin_log('装修模块批量显示/隐藏失败。UID：'.$uids_str);
            return result(-1, '', '设置失败');
        }

        // Log
        admin_log('装修模块批量显示/隐藏成功。UID：'.$uids_str);
        return result(0, $uids, '设置成功');
    }

    public function addData(Request $request)
    {

        $params = $request->all();

        $length = !empty($params['data']['length']) ? $params['data']['length'] : 0;
        $type = $params['data']['type']; // 选择器
        $cat_id = !empty($params['data']['cat_id']) ? $params['data']['cat_id'] : 1; // 第几个
        $number = $params['data']['number']; // 最大数据数量
        $selectorInfo = $this->selector->detail(['id' => $type]);


        $params['page_id'] = make_uuid();
        $params['link_id'] = make_uuid();
        $templateItem = $this->templateItem->detail(['uid'=>$params['data']['uid']]);
        $params['tpl_item_data'] = unserialize($templateItem['data']);
        $params['ext_info'] = !empty($templateItem['ext_info']) ? unserialize($templateItem['ext_info']) : '';

        // 空的数据对象
        $selector_empty_data = [];
        for ($i = 0; $i < $number; $i++) {
            $selector_empty_data[$i]['td_link_id'] = make_uuid(); // 页面Td_Link_ID
        }

        // 选择器数据
        if (isset($params['tpl_item_data'][$type.'-'.$cat_id])) {
            // 有数据
            foreach ($params['tpl_item_data'][$type.'-'.$cat_id] as &$datum) {
                $datum['link_id'] = make_uuid(); // 页面Link_ID

                // 数据处理
                if ($type == 1) {
                    // 文章 文章标题相关信息
                    $articleInfo = Article::where('article_id', $datum['article_id'])->first();
                    $articleCatInfo = ArticleCat::where('cat_id', $articleInfo->cat_id)->first();
                    $datum['title'] = $articleInfo->title;
                    $datum['article_thumb'] = $articleInfo->article_thumb;
                    $datum['summary'] = $articleInfo->summary;
                    $datum['link'] = $articleInfo->link;
                    $datum['source'] = $articleInfo->source;
                    $datum['created_at'] = $articleInfo->created_at;
                    $datum['cat_id'] = $articleInfo->cat_id;
                    $datum['cat_name'] = $articleCatInfo->cat_name;
                } elseif ($type == 2) {
                    // 商品 商品名称相关信息
                    $goodsInfo = Goods::where('goods_id', $datum['goods_id'])->first();
                    $datum['goods_name'] = $goodsInfo->goods_name;
                    $datum['goods_image'] = $goodsInfo->goods_image;
                    $datum['goods_price'] = $goodsInfo->goods_price;
                } elseif ($type == 6) {
                    // 商品分类 分类名称
                    $datum['cat_name'] = Category::where('cat_id', $datum['cat_id'])->value('cat_name');
                } elseif ($type == 5) {
                    // 品牌 品牌名称相关信息
                    $brandInfo = Brand::where('brand_id', $datum['brand_id'])->first();
                    $datum['brand_name'] = $brandInfo->brand_name;
                    $datum['brand_logo'] = $brandInfo->brand_logo;
                } elseif ($type == 8) {
                    // 导航 导航数据
//                    $datum['path'] = get_image_url($datum['path']);
                } elseif ($type == 9) {
                    // 店铺 店铺名称相关信息
                    $shopInfo = Shop::where('shop_id', $datum['shop_id'])->first();
                    $shopCredit = (new ShopCreditRepository())->getCreditInfoByScore($shopInfo['credit']);

                    // 店铺信誉
                    $datum['shop_name'] = $shopInfo->shop_name;
                    $datum['shop_logo'] = get_image_url($shopInfo->shop_logo, 'shop_logo');
                    $datum['credit_img'] = $shopCredit->credit_img ?? '';
                } elseif ($type == 11) {
                    // 红包 红包名称相关信息
                    $bonusInfo = Bonus::where('bonus_id', $datum['bonus_id'])->first();
                    $datum['bonus_name'] = $bonusInfo->bonus_name;
                    $datum['bonus_amount'] = $bonusInfo->bonus_amount;
                    $datum['min_goods_amount'] = $bonusInfo->min_goods_amount;
                    $datum['start_time'] = format_time(strtotime($bonusInfo->start_time), 'Y-m-d');
                    $datum['end_time'] = format_time(strtotime($bonusInfo->end_time), 'Y-m-d');
                    $datum['shop_id'] = $bonusInfo->shop_id;
                } elseif ($type == 14) {
                    // 热点区
                }


            }
            $selector_data = $params['tpl_item_data'][$type.'-'.$cat_id];
        } else {
            // 无数据
            $selector_data = [];
        }
        $params['selector_data'] = $selector_data;
        $params['selector_empty_data'] = $selector_empty_data;
//        dd($params['selector_data']);
        $where = [
            ['tpl_code', $templateItem->code],
            ['selector_type', $type],
            ['cat_id', $cat_id],
        ];
        $templateCatInfo = TemplateCat::where($where)->first();
        $params['templateCat'] = $templateCatInfo;


        // 温馨提示 特殊处理
        $explain_panel = [];
        if (!empty($params['data']['title_is_floor'])) {
            // 楼层版式 - 标题选择器 温馨提示
            $explain_panel = [
                '楼层上方的标题，最佳长度为4~5个字'
            ];
        } elseif ($params['data']['type'] == 6) {
            // 商品分类选择器
            $explain_panel = [
                '为达到页面效果，建议上传'.$number.'个分类'
            ];
        } elseif ($params['data']['type'] == 2) {
            // 商品选择器
            $explain_panel = [
                '为达到页面效果，建议上传'.$number.'个商品，分类名称不超过'.$length.'个字'
            ];
        } elseif ($params['data']['type'] == 5) {
            // 品牌选择器
            $explain_panel = [
                '未上传品牌LOGO无法显示在品牌列表中，最多可以选择'.$number.'个品牌'
            ];
        } elseif ($params['data']['type'] == 8) {
            // 导航选择器
            $explain_panel = [
                '为达到页面效果，建议上传'.($number/10).'个或'.(($number/10)*2).'个菜单（图片尺寸为135*135像素），您可以点击下面的“＋”添加菜单',
                '导航名称最多不能超过'.$length.'个字，默认字体颜色为黑色'
            ];
        }

        $blocks = [
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $render = view('design.selectors.'.$selectorInfo['code'], $params)->render();

        return result(0, $render);

    }

    /**
     * 改变链接类型
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function changeLinkType(Request $request)
    {
        $link_type = $request->get('link_type', 0); // 链接类型
        $link = $request->get('link', '');
        $link_data = $this->linkType->getLinkTypeData($link_type);
        $render = view('design.tpl-setting.partials._link_list', compact('link_type', 'link', 'link_data'))->render();

        return result(0, $render);
    }

    public function linkGoodsPicker(Request $request)
    {
        $page_id = make_uuid();
        $id = $request->get('id');
        $goods_id = $request->get('goods_id');

        $goods_name = '';
        if ($goods_id) {
            $goods_name = Goods::where('goods_id', $goods_id)->value('goods_name');
        }

        $compact = compact('page_id','id','goods_id', 'goods_name');
        $render = view('design.tpl-setting.partials._link_goods_picker', $compact)->render();

        return result(0,$render);
    }

    public function setting(Request $request)
    {
        $page = $request->get('page', 'site');
        $topic_id = $request->get('topic_id', 0);

        // 保存模板数据 并生成html文件
        // 从 template_item 表中获取模板数据
        $where[] = ['page', $page];
        if ($topic_id > 0) {
            $where[] = ['topic_id', $topic_id];
        }
        $condition = [
            // data,shop_id,page,sort,ext_info,tpl_title,is_valid,site_id,code,file //这些字段从模板表取 tpl_name,icon,type
            'field' => ['uid', 'data', 'shop_id', 'page', 'sort', 'ext_info', 'tpl_title', 'is_valid', 'site_id', 'code', 'file'],
            'where' => $where,
            'limit' => 0, // 查询全部
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($templateItems, $itemCount) = $this->templateItem->getList($condition);

        $tplUpdate = [];
        foreach ($templateItems as &$item)
        {
            if (empty($item->data) || !$item->is_valid) {
                // 如果数据为空或者is_valid为0 直接跳出循环继续进行
                $render = "";
            } else {
                $render = $this->templateItem->getTemplateItemHtml($item->uid, $page);
            }

            $tplUpdate[] = [
                'uid' => $item->uid,
                'file' => $render
            ];
        }
        $ret = $this->templateItem->updateBatch($tplUpdate);
//        if ($ret === false) {
//            return result(-1, null, '保存失败');
//        }
        // TODO

        // 设置成功 跳转url地址
        if ($page == 'site') {
            $url = route('pc_home');
        } elseif ($page == 'm_site') {
            $url = route('mobile_home');
        } elseif ($page == 'app') {
            $url = '';
        } elseif ($page == 'topic') {
            $url = route('pc_show_topic', ['topic_id'=>$topic_id]);
        } elseif ($page == 'm_topic') {
            $url = ''; // route('mobile_show_topic', ['topic_id'=>$topic_id]);
        } elseif ($page == 'app_topic') {
            $url = '';
        } elseif ($page == 'news') {
            $url = route('pc_news_home');
        } elseif ($page == 'm_news') {
            $url = ''; //route('mobile_news_home');
        } else {
            $url = '';
        }

        $extra = [];
        if ($url != '') {
            $extra = [
                // 微商城首页二维码
                'qrcode' => '/design/tpl-setting/qrcode.html', // todo 'http://images.xxx.com/14719/gqrcode/site/qrcode_CD4B99D2C262AF1AA6E32E4861F3580B.png',
                'url' => $url // 设置成功 跳转url地址
            ];
        }

        return result(0, null, '保存成功', $extra);
    }

    /**
     * 生成二维码
     * @param Request $request
     * @return mixed
     */
    public function qrCode(Request $request)
    {
//        $shop_id = $request->get('id',0);
//        $shop_info = $this->shop->getById($shop_id);

        // todo 如何获取手机端商品详情url
        if (!is_mobile()) {
            $url = route('pc_home');
        } else {
            $url = route('mobile_home');
        }

        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(148)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
//            ->merge(get_image_url($shop_info->shop_image),.15) // 合并水印图片到二维码
            ->margin(2)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * 获取颜色样式url
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function colorStyleUrl(Request $request)
    {
        $group = $request->get('group');

        $url = '';

        if ($group == 'site_style') {
            if (sysconf('custom_style_enable') == 1) {
//                $url = 'http://lrw.oss-cn-beijing.aliyuncs.com/images/14719/css/custom/site-color-style-0.css';
                $url = request()->getScheme().'://'.config('lrw.frontend_domain').'/css/custom/site-color-style-0.css';
            } else {
                $url = request()->getScheme().'://'.config('lrw.frontend_domain').'/css/color-style.css';
            }
        } elseif ($group == 'mobile_site_style') {
            if (sysconf('custom_style_enable_m_site') == 1) {
                $url = request()->getScheme().'://'.config('lrw.mobile_domain').'/css/custom/m_site-color-style-0.css';
            } else {
                $url = request()->getScheme().'://'.config('lrw.mobile_domain').'/css/color-style.css';
            }
        }

        return result(0, $url);
    }

    /**
     * 删除模板模块
     *
     * @param Request $request
     * @return mixed
     */
    public function deleteTpls(Request $request)
    {
        // 执行删除模板模块
        $uid = $request->get('uid');
        $ret = TemplateItem::where('uid', $uid)->delete();

        if ($ret === false) {
            // Log
            admin_log('装修模块删除失败。UID：'.$uid);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('装修模块删除成功。UID：'.$uid);
        return result(0, '', '模块删除成功');
    }

    /**
     * 批量删除模板模块
     *
     * @param Request $request
     * @return array
     */
    public function batchDelete(Request $request)
    {
        $uids = $request->post('uids');
        $ret = TemplateItem::whereIn('uid', $uids)->delete();

        $uids_str = implode(',', $uids);

        if ($ret === false) {
            // Log
            admin_log('装修模块批量删除失败。UID：'.$uids_str);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('装修模块批量删除成功。UID：'.$uids_str);
        return result(0, $uids, '删除成功');
    }

    public function ajaxRender(Request $request)
    {
        $page = $request->get('page', 'site');
        $tpl = $request->get('tpl');
        $tpl = trim($tpl, '@,.tpl');

        if (empty($tpl)) {
            return result(-1, '', '模板不存在');
        }

        // 根据nav_page查询
        $where[] = ['nav_page', $page];
        $where[] = ['is_show', 1];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'nav_sort',
            'sortorder' => 'asc'
        ];
        list($navigation, $total) = $this->navigation->getList($condition);
        $is_design = true;
        $render = view($tpl, compact('navigation', 'is_design'))->render();
        return result(0, $render);
    }


    public function designSetting(Request $request)
    {
        $code = $request->get('code'); // design_m_goods_shop_is_show

        $data = 0;
        return result(0, $data, '设置成功');
    }


    /********************* post **********************/
    /**
     * @method post
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function templateSort(Request $request)
    {
        $tpl = $request->post('tpl');
        $ret = $this->templateItem->updateBatch($tpl);
        if ($ret === false) {
            return result(-1, null, '设置失败');
        }
        return result(0, null, '设置成功');
    }

    public function saveTpls(Request $request)
    {
        $params = $request->all();
        $uid = $params['uid'];
        $select_type = $params['type'];
        $cat_id = $params['cat_id'];

        $templateItem = $this->templateItem->detail(['uid'=>$uid]);
        $data = [
            'page' => $templateItem->page,
            'uid' => $uid
        ];
//        if (empty($params['chk_value'])) {
//            return result(0, $data, '设置成功');
//        }

        $tpl_data = !empty($templateItem->data) ? unserialize($templateItem->data) : [];
        $tpl_ext_info = !empty($templateItem->ext_info) ? unserialize($templateItem->ext_info) : [];

        if (!empty($params['chk_value'])) {
            if ($params['type'] == 8) {
                // 导航模板
                foreach ($params['chk_value'] as &$v) {
                    $v['path'] = get_image_url($v['path']);
                }
            }
            $tpl_data[$select_type.'-'.$cat_id] = $params['chk_value'];
            ksort($tpl_data);
        } else {
            $tpl_data[$select_type.'-'.$cat_id] = [];
        }

        // todo 此处好像有问题
        if (!empty($params['extend']['cat_id']) && !empty($params['extend']['cat_name'])) {
            // 扩展信息
            $tpl_ext_info['cat'][$params['extend']['cat_id']] = $params['extend']['cat_name'];
            ksort($tpl_ext_info);
        }

        $chk_values = serialize($tpl_data);

        $ext_info = serialize($tpl_ext_info);

        // 更新模板item data字段信息 序列化数据
        $ret = TemplateItem::where('uid', $uid)->update(['data' => $chk_values, 'ext_info' => $ext_info]);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }


        return result(0, $data, '设置成功');
    }

    /**
     * 开启/关闭静态页面
     *
     * @param Request $request
     * @return array
     */
    public function setStatic(Request $request)
    {
        $code = $request->post('code'); // site-PC首页 m_site-微信端首页 shop-店铺首页 m_shop-微信端店铺首页
        if ($code == 'site') {
            $ret = sysconf('site_web_static', sysconf('site_web_static') == 1 ? 0 : 1);
            $web_static = sysconf('site_web_static');
        } elseif ($code == 'm_site') {
            $ret = sysconf('m_site_web_static', sysconf('m_site_web_static') == 1 ? 0 : 1);
            $web_static = sysconf('m_site_web_static');
        } else {
            $ret = false;
            $web_static = 0;
        }

        if ($ret === false) {
            return result(-1, null, '设置失败');
        }

        return result(0, $web_static, '设置成功');
    }

    /**
     * 装修预览
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $page = $request->get('page'); // site m_site app
        $topic_id = $request->get('topic_id', 0);
        $is_preview = $request->get('is_preview', 0);
        $comstore_group_id = $request->get('comstore_group_id', 0);

        $url = "";
        $extra = [];
        if ($page == 'site') {
            $url = route('pc_preview');
        } elseif ($page == 'm_site') {
            $url = route('mobile_preview');
        } elseif ($page == 'app') {
            $url = route('mobile_preview');
            $extra['qrcode'] = ""; // todo 生成qrcode
        } elseif ($page == 'topic') {
            $url = route('pc_topic_preview')."?topic_id={$topic_id}";
        } elseif ($page == 'm_topic') {
            $url = route('mobile_topic_preview')."?topic_id={$topic_id}";
        } elseif ($page == 'app_topic') {
            $url = route('pc_topic_preview')."?topic_id={$topic_id}";
            $extra['qrcode'] = "";
        }

//        $qrcode = "http://xxxx/1737/gqrcode/site/qrcode_1AF88A6693AD1544F10A087A642D895C.png";
//        $url = "https://m.xxxx.com/mn7axs7/shop/index/preview.html?shop_id={$shop_id}";

        $extra['url'] = $url;
        return result(0, null, '', $extra);
    }
}
