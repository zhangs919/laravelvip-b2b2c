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
// | Date:2018-11-01
// | Description: 系统商品库采集
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Models\Brand;
use App\Models\Freight;
use App\Models\Goods;
use App\Models\LibGoodsSku;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\AttributeRepository;
use App\Repositories\AttrValueRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsLayoutRepository;
use App\Repositories\LibCategoryRepository;
use App\Repositories\LibGoodsAttrRepository;
use App\Repositories\LibGoodsImageRepository;
use App\Repositories\LibGoodsRepository;
use App\Repositories\LibGoodsSkuRepository;
use App\Repositories\LibGoodsSpecRepository;
use App\Repositories\LibSpecAliasRepository;
use App\Repositories\ShopCategoryRepository;
use Illuminate\Http\Request;

class LibGoodsController extends Seller
{

    private $links = [
        ['url' => 'goods/lib-goods/index', 'text' => '手动导入'],
        ['url' => 'goods/lib-goods/auto', 'text' => '批量智能导入'],
        ['url' => 'goods/lib-goods/file', 'text' => '文件导入'],
        ['url' => 'goods/lib-goods/scan', 'text' => '扫码导入'],

    ];

    protected $libGoods;
    protected $attribute;
    protected $attrValue;
    protected $goodsLayout;
    protected $libGoodsImage;
    protected $libGoodsAttr;
    protected $libGoodsSpec;
    protected $libGoodsSku;
    protected $libSpecAlias;
    protected $libCategory;
    protected $category;
    protected $shopCategory;


    public function __construct(
        LibGoodsRepository $libGoods
        ,AttributeRepository $attribute
        ,AttrValueRepository $attrValue
        ,GoodsLayoutRepository $goodsLayout
        ,LibGoodsImageRepository $libGoodsImage
        ,LibGoodsAttrRepository $libGoodsAttr
        ,LibGoodsSpecRepository $libGoodsSpec
        ,LibGoodsSkuRepository $libGoodsSku
        ,LibSpecAliasRepository $libSpecAlias
        ,LibCategoryRepository $libCategory
        ,CategoryRepository $category
        ,ShopCategoryRepository $shopCategory
    )
    {
        parent::__construct();

        $this->libGoods = $libGoods;
        $this->attribute = $attribute;
        $this->attrValue = $attrValue;
        $this->goodsLayout = $goodsLayout;
        $this->libGoodsImage = $libGoodsImage;
        $this->libGoodsAttr = $libGoodsAttr;
        $this->libGoodsSpec = $libGoodsSpec;
        $this->libGoodsSku = $libGoodsSku;
        $this->libSpecAlias = $libSpecAlias;
        $this->libCategory = $libCategory;
        $this->category = $category;
        $this->shopCategory = $shopCategory;

        $this->set_menu_select('goods', 'goods-cloud-manage');

    }

    public function index(Request $request)
    {
        return $this->list($request);
    }

    public function list(Request $request)
    {
        $title = '列表';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'index', '', '', 'file,scan');

        $action_span = [
            [
                'url' => '/goods/cloud/cloud-manage',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回数据采集'
            ],
        ];

        $explain_panel = [
            '产品库拥有最全的产品信息，店铺和供货商均可直接从产品库中复制商品上架至自己的店铺，从而省去发布商品的繁琐步骤',
            '产品库里的产品信息是公开的，由平台方添加'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
//        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = [
            'goods_barcode', // 条形码
            'keyword', // 关键字 商品ID/货号/名称
            'cat_id', // 分类id
            'brand_id', // 品牌id
            'sales_model', // 销售模式
        ];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'goods_barcode') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->libGoods->getList($condition);

        if (!empty($list)) {
            foreach ($list as $item) {
                $isSku = LibGoodsSku::where('goods_id',$item->goods_id)->count() > 1 ? true : false;
                $item->is_sku = $isSku;
                $item->goods_remark = unserialize($item->goods_remark);
                //是否已导入
                $item->has_imported = false;
                if (Goods::where('shop_id', seller_shop_info()->shop_id)->where('lib_goods_id', $item->goods_id)->count() > 0) {
                    $item->has_imported = true;
                }
            }
        }

        $pageHtml = pagination($total);

        $brand_list = Brand::where([['is_show',1]])->get();
        $lib_category_list = $this->libCategory->getFormatCategory();
        $category_list = $this->category->getFormatCategory();
        $compact = compact('title', 'list', 'total', 'pageHtml', 'brand_list', 'lib_category_list','category_list');
        if ($request->ajax()) {
            $render = view('goods.lib-goods.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.lib-goods.list', $compact);
    }

    /**
     * 商品导入
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function import(Request $request)
    {
        if ($request->method() == 'POST') {

//            dd($request->);
        }
        $ids = $request->get('ids');
        $shop_freight_fee = !empty(shopconf('freight_fee',false,seller_shop_info()->shop_id)) ? shopconf('freight_fee',false,seller_shop_info()->shop_id) : '0.00'; // 店铺统一运费

        // 运费模板列表
        $freight_list = Freight::where('shop_id', seller_shop_info()->shop_id)
            ->orderBy('freight_id', 'desc')
            ->select(['freight_id','title'])
            ->get()->toArray();

        $shop_category_list = $this->shopCategory->getShopCategoryList(seller_shop_info()->shop_id);


        $compact = compact('ids', 'shop_freight_fee', 'freight_list', 'shop_category_list');

        $render = view('goods.lib-goods.import', $compact)->render();
        return result(0, $render);
    }

    public function skuList(Request $request)
    {
        $goods_id = $request->get('goods_id', 0);

        $sku_list = $this->libGoods->getSkuList($goods_id);
        $compact = compact('sku_list', 'goods_id');
        $render = view('goods.lib-goods.partials._sku_list', $compact)->render();
        return result(0, $render);
    }

    public function auto(Request $request)
    {
        $title = '选择导入类型';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'auto', '', '', 'file,scan');

        $action_span = [
            [
                'url' => '/goods/cloud/cloud-manage',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回数据采集'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block


        return view('goods.lib-goods.auto', compact('title'));
    }

    public function file(Request $request)
    {
        $title = '文件导入';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'file', '', '', 'index,scan');

        $action_span = [
            [
                'url' => 'auto',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回批量智能导入'
            ],
        ];

        $explain_panel = [
            '上传商品库文件，点击预览，即可查看要导入的商品。',
            '通过上传文件获得的商品库商品，商家可自行决定删除或导入，"已导入"色块标记该商品库商品已经被导入到自己店铺了，不会重复导入。'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {

            //
            flash('error', '您未上传文件或上传了一个空文件');
            return redirect('/goods/lib-goods/file.html');
        }


        return view('goods.lib-goods.file', compact('title'));
    }

    public function scan(Request $request)
    {
        $title = '扫码导入';
        $fixed_title = '数据采集 - '.$title;

        $this->sublink($this->links, 'san', '', '', 'index,file');

        $action_span = [
            [
                'url' => 'auto',
                'id' => '',
                'icon' => 'fa-reply',
                'text' => '返回批量智能导入'
            ],
        ];

        $explain_panel = [
            '使用扫码枪扫描系统商品库商品条形码，或直接输入系统商品库条形码，回车换行输入，点击预览，即可查看要导入的系统商品库商品。',
            '下载预览结果：可将系统商品库中未有对应条形码的商品标记出来，方便提供给平台管理员进行维护无条形码的商品。',
            '通过扫描获得的系统商品库商品，商家可自行决定是否导入，"已导入"色块标记该商品已经被导入到店铺，不会重复导入。'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.lib-goods.scan', compact('title'));
    }

    public function scanPreview(Request $request)
    {
        $title = '预览';
        $fixed_title = '数据采集 - '.$title;

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = [
            'goods_barcode', // 条形码
            'keyword', // 关键字 商品ID/货号/名称
            'cat_id', // 分类id
            'brand_id', // 品牌id
            'sales_model', // 销售模式
        ];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keyword') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = [[1], 1]; //$this->goodsUnit->getList($condition);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('goods.lib-goods.partials._scan_preview', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.lib-goods.scan_preview', compact('title', 'list', 'pageHtml'));
    }
}