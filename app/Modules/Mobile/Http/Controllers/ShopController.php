<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\ShopApplyRepository;
use App\Repositories\ShopClassRepository;
use App\Repositories\ShopRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShopController extends Mobile
{

    protected $tools;

    protected $shop;

    protected $shopClass;

    protected $shopApply;

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

        $this->tools = new ToolsRepository();
        $this->shop = new ShopRepository();
        $this->shopClass = new ShopClassRepository();
        $this->shopApply = new ShopApplyRepository();

        $this->template = new  TemplateRepository();
        $this->selector = new TemplateSelectorRepository();
        $this->templateItem = new TemplateItemRepository();
        $this->templateCat = new TemplateCatRepository();
        $this->navBanner = new NavBannerRepository();
        $this->navigation = new NavigationRepository();
        $this->navQuickService = new NavQuickServiceRepository();

    }

    public function street(Request $request)
    {

        $output = $request->get('output', 0);

        // 筛选条件
        $cls_id = $request->get('cls_id', 0); // 店铺分类id
        $cls_id_arr = explode('_', $cls_id);
        $child_class_list = [];
        $query_parent_cls_id = 0;

        if (count($cls_id_arr) == 3) {
            // 有效cls_id参数
            if ($cls_id_arr[0] == 1) {
                // 一级分类
                $query_parent_cls_id = $cls_id_arr[1];
            } elseif ($cls_id_arr[0] == 2) {
                // 二级分类
                $query_parent_cls_id = $cls_id_arr[2];
            }

            // 获取店铺分类列表
            $where = [];
            $where[] = ['is_show', 1];
            $where[] = ['parent_id', $query_parent_cls_id];
            $condition = [
                'where' => $where,
                'limit' => 0, // 不分页
                'sortname' => 'cls_sort',
                'sortorder' => 'asc'
            ];

            list($child_class_list, $total) = $this->shopClass->getList($condition);
        }

        // 获取店铺分类列表
        $where = [];
        $where[] = ['is_show', 1];
        $where[] = ['parent_id', 0];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'cls_sort',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition);

        $where = [];
        $where[] = ['shop_status',1];
        $where[] = ['show_in_street',1];
        $condition = [
            'where' => $where,
            'sortname' => 'shop_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->shop->getList($condition);

        $pageArr = frontend_pagination($total, true);
        $page_count = $pageArr['page_count'];
        $cur_page = $pageArr['cur_page'];
        $page_json = json_encode($pageArr);


        if ($request->ajax()) {
            if ($output) {
                $tpl = 'street_output';
            } else {
                $tpl = 'street_shop_list';
            }
//            dd($tpl);
            $render = view('shop.partials.'.$tpl, compact('page_json', 'list'))->render();
            return result(0, $render);
        }


        $compact = compact('page_json', 'list', 'cat_list', 'child_class_list', 'query_parent_cls_id', 'cls_id', 'cls_id_arr');

        $this->show_seo('seo_shop_street'); // SEO

        return view('shop.street', $compact);
    }

    public function openList(Request $request)
    {
        $ids = $request->get('ids');
        $where = [];
        $where[] = ['shop_status',1];
        $where[] = ['show_in_street',1];

        $list = Shop::where($where)->orderBy('shop_sort', 'asc')->whereIn('shop_id', $ids)->select(['shop_id', 'opening_hour'])->get();

        $is_opening = true; // todo
        $data = [];

        if (!empty($list)) {
            foreach ($list as $v) {
                $data[] = [
                    'shop_id' => $v->shop_id,
                    'is_opening' => $is_opening
                ];
            }
        }

        return result(0, $data);
    }

    public function shopHome(Request $request, $shop_id)
    {
        $page = 'm_shop';

        // 从 template_item 表中获取模板数据
        $where[] = ['page', $page];
        $where[] = ['shop_id', $shop_id];
        $condition = [
            // data,shop_id,page,sort,ext_info,tpl_title,is_valid,site_id,code,file //这些字段从模板表取 tpl_name,icon,type
            'field' => ['uid', 'data', 'shop_id', 'page', 'sort', 'ext_info', 'tpl_title', 'is_valid', 'site_id', 'code', 'file'],
            'where' => $where,
            'limit' => 0, // 查询全部
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($templateItems, $itemCount) = $this->templateItem->getList($condition);
//        dd($templateItems);
        $tplHtml = $navContainerHtml = "";
        foreach ($templateItems as &$item)
        {
            $navTpl = $this->template->getTplList(2, 5, 'code');
            if (in_array($item->code, $navTpl)) {
                // 如果是导航模板
                $navContainerHtml .= $item->file;
            }else {
                $tplHtml .= $item->file;
            }
        }

        $shop_info = $this->shop->getById($shop_id);

        $compact = compact('shop_info', 'page', 'topic_id', 'tplHtml', 'navContainerHtml');

        $this->show_seo('seo_shop',['name'=>$shop_info->shop_name]); // SEO

        return view('shop.shop_home', $compact);
    }

    public function info(Request $request)
    {

    }

}