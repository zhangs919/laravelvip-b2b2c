<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use Illuminate\Http\Request;

class HomeController extends Mobile
{

    protected $template;
    protected $selector;
    protected $templateItem;
    protected $templateCat;
    protected $navBanner;
    protected $navigation;
    protected $navQuickService;

    public function __construct(TemplateRepository $template,
                                TemplateSelectorRepository $selector,
                                TemplateItemRepository $templateItem,
                                TemplateCatRepository $templateCatRepository,
                                NavBannerRepository $navBannerRepository,
                                NavigationRepository $navigationRepository,
                                NavQuickServiceRepository $navQuickServiceRepository)
    {
        parent::__construct();

        $this->template = $template;
        $this->selector = $selector;
        $this->templateItem = $templateItem;
        $this->templateCat = $templateCatRepository;
        $this->navBanner = $navBannerRepository;
        $this->navigation = $navigationRepository;
        $this->navQuickService = $navQuickServiceRepository;
    }

    public function home(Request $request)
    {
        dd($request->path());
        $seo_title = '乐融沃B2B2C商城演示站';
        $page = 'm_site';






        // 从 template_item 表中获取模板数据
        $where[] = ['page', $page];
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
            $navTpl = $this->template->getTplList(1, 5, 'code');
            if (in_array($item->code, $navTpl)) {
                // 如果是导航模板
                $navContainerHtml .= $item->file;
            }else {
                $tplHtml .= $item->file;
            }
        }

        $compact = compact('seo_title', 'page', 'topic_id', 'tplHtml', 'navContainerHtml', 'nav_banner');
//        dd($compact);
        return view('home.home', $compact);
    }
}