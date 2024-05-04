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
// | Date:2021-12-21
// | Description: 门店控制器
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\DefaultSearch;
use App\Models\TplBackup;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CollectRepository;
use App\Repositories\MultiStoreRepository;
use App\Repositories\ShopRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;


class MultiStoreController extends Frontend
{

    protected $tools;
    protected $shop;
    protected $template;
    protected $selector;
    protected $templateItem;
    protected $templateCat;
    protected $collect;
    protected $multiStore;


    public function __construct(
        ToolsRepository $tools
        , ShopRepository $shop
        , TemplateRepository $template
        , TemplateSelectorRepository $selector
        , TemplateItemRepository $templateItem
        , TemplateCatRepository $templateCat
        , CollectRepository $collect
        , MultiStoreRepository $multiStore
    )
    {
        parent::__construct();

        $this->tools = $tools;
        $this->shop = $shop;
        $this->template = $template;
        $this->selector = $selector;
        $this->templateItem = $templateItem;
        $this->templateCat = $templateCat;
        $this->collect = $collect;
        $this->multiStore = $multiStore;
    }


    /**
     * 门店首页
     *
     * @param Request $request
     * @return mixed
     */
    public function storeHome(Request $request, $tpl_name = 'store_home')
    {
        $lrw_tag = get_lrw_tag();
        // 解密门店id
        $store_id = lrw_tag_decrypt($lrw_tag);
        // 获取门店信息
        $store_info = $this->multiStore->getById($store_id);
        if (empty($store_info)) {
            return result(404, null, '门店信息不存在');
        }
        $store_info = $store_info->toArray();

        if (is_app()) {
            $page = 'app_multistore';
        } elseif (is_mobile() || (request()->getHost() == config('lrw.mobile_domain'))) {
            $page = 'm_multistore';
            if (!$store_info['is_diy']) {
                // 门店未开启自定义装修 或装修内容为空时 使用店铺装修
                $page = 'm_shop';
            }
        } else { // pc 无门店页面
            abort(404, '暂不支持PC端访问');
        }
        $shop_id = $store_info['shop_id'];

        $this->setLrwTag();

        // 店铺信息
        $shop_info = $this->shop->shopInfo($shop_id);

        $region_name = get_region_names_by_region_code($shop_info['shop']['region_code'], ' ');

        // 开店时长
        $duration_time = calc_shop_duration($shop_info['shop']['open_time'], $shop_info['shop']['end_time']);

        // 是否收藏店铺
        $is_collect = false;
        if ($this->collect->checkIsCollected($this->user_id, 1, $shop_id)) {
            // 已收藏
            $is_collect = true;
        }

        $collect_count = $shop_info['shop']['collect_num'];

        $template = $this->templateItem->getTplItems($page, $shop_id); // app端模板数据

        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page, $shop_id); // 模板Html数据

        // 判断首页静态页面开启状态
        $webStatic = (is_mobile() && !is_app()) ? shopconf('m_shop_web_static', false, $shop_id) : shopconf('shop_web_static', false, $shop_id);

        $is_design = false;

        $app_prefix_data = [
            'shop_id' => $shop_id,
            'shop_info' => $shop_info,// 店铺信息对象
            'duration_time' => $duration_time, //'1年 4个月 8天',
            'region_name' => $region_name,
            'is_collect' => $is_collect,
            'collect_count' => $collect_count,
            'goods_count' => 2,
            'bonus_count' => '0',
            'article' => null,
            'is_opening' => true,
            'template' => $template,
            'position' => 'index',
            'name' => null,
            'keywords' => null,
            'description' => null,
            'store_id' => $store_id,
            'app_main_color' => '',
            'app_second_color' => '',
            'yikf_url' => ''
        ];
        $compact_data = $app_prefix_data;
        $compact_data['seo_title'] = '';
        $compact_data['page'] = $page;
        $compact_data['tplHtml'] = $tplHtml;
        $compact_data['navContainerHtml'] = $navContainerHtml;
        $compact_data['webStatic'] = $webStatic;
        $compact_data['is_design'] = $is_design;
        $compact_data['store_info'] = $store_info;

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact_data,
            'tpl_view' => 'multi-store.' . $tpl_name
        ];

        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function storeInfo(Request $request)
    {
        $store_id = $request->get('store_id');
        $store_info = $this->multiStore->getById($store_id);
        if (empty($store_info)){
            return result(-1, null, '门店信息不存在');
        }
        $store_info->is_opend = 1;
        $data = [
            'close_image' => null,
            'is_opening' => true,
            'shop_tag' => get_lrw_tag(),
        ];
        $extra = [
            'store_info' => $store_info
        ];
        return result(0, $data, '', $extra);

    }
}