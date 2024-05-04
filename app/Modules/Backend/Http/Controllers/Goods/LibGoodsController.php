<?php

namespace App\Modules\Backend\Http\Controllers\Goods;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\LibGoodsSku;
use App\Models\LibGoodsSpec;
use App\Modules\Base\Http\Controllers\Backend;
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
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LibGoodsController extends Backend
{

    private $links = [];

    private $edit_links = [
        ['url' => 'goods/lib-goods/edit', 'text' => '编辑商品'],
        ['url' => 'goods/lib-goods/edit-images', 'text' => '编辑图片'],
    ];

    protected $category;
    protected $shop;
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

    public function __construct(
        CategoryRepository $category
        ,ShopRepository $shop
        ,LibGoodsRepository $libGoods
        ,AttributeRepository $attribute
        ,AttrValueRepository $attrValue
        ,GoodsLayoutRepository $goodsLayout
        ,LibGoodsImageRepository $libGoodsImage
        ,LibGoodsAttrRepository $libGoodsAttr
        ,LibGoodsSpecRepository $libGoodsSpec
        ,LibGoodsSkuRepository $libGoodsSku
        ,LibSpecAliasRepository $libSpecAlias
        ,LibCategoryRepository $libCategory
    )
    {
        parent::__construct();

        $this->category = $category;
        $this->shop = $shop;
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
    }


    public function lists(Request $request)
    {
        $title = '所有商品';
        $fixed_title = '本地商品库 - '.$title;

        $action_span = [
            [
                'url' => '/goods/lib-goods/batch-upload',
                'icon' => 'fa-cloud-upload',
                'text' => '导入ecshop商品'
            ],
            [
                'url' => '/goods/lib-goods/import',
                'icon' => 'fa-plus',
                'text' => '导入店铺商品'
            ],
            [
                'id' => 'add-excel-goods',
                'url' => '',
                'icon' => 'fa-plus',
                'text' => '导入excel商品'
            ],
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '发布商品'
            ],
            [
                'url' => '/goods/yun/goods-list',
                'icon' => 'fa-plus',
                'text' => '数据采集'
            ]
        ];

        $explain_panel = [
            '本地商品库：为了解决商城不同商家售卖的商品相同，每个商家要单独发布商品问题，本地商品库应运而生，本地商品库发布的商品不在商城前台展示，仅用于供商家导入使用'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['goods_barcode','keyword', 'cat_id','goods_status','brand_id','lib_cat_id'];
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
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->libGoods->getList($condition);

        if (!empty($list)) {
            foreach ($list as $item) {
                $isSku = LibGoodsSku::where('goods_id',$item->goods_id)->count() > 1 ? true : false;
                $item->is_sku = $isSku;
                $item->goods_remark = unserialize($item->goods_remark);
            }
        }

        $pageHtml = pagination($total);

        $brand_list = Brand::where([['is_show',1]])->get();
        $lib_category_list = $this->libCategory->getFormatCategory();
        $compact = compact('title', 'list', 'total', 'pageHtml', 'brand_list', 'lib_category_list');
        if ($request->ajax()) {
            $render = view('goods.lib-goods.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.lib-goods.list', $compact);
    }

    /**
     * 第一步 - 选择商品分类
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '选择商品分类';
        $fixed_title = '本地商品库 - '.$title;

        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $condition = [
            'where' => [['parent_id', 0]],
            'sortname' => 'cat_id',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total)= $this->category->getList($condition);

        return view('goods.lib-goods.add', compact('title', 'cat_list'));
    }

    /**
     * 第二步 - 填写商品详情 - 新增
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = '填写商品详情';
        $fixed_title = '本地商品库 - '.$title;
        $cat_id = $request->get('cat_id');

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];

        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        // model
        $model = [
            'mobile_price' => 0,
            'cost_price' => 0,
            'market_price' => 0,
            'invoice_type' => 0,
            'is_repair' => 0,
            'user_discount' => 0,
            'stock_mode' => 0,
            'top_layout_id' => 0,
            'bottom_layout_id' => 0,
            'warn_number' => 0,
            'goods_number' => 0,
            'goods_sort' => 255,
            'freight_id' => 0,
            'pricing_mode' => 0,
            'sales_model' => 0,
            'goods_status' => 1,
            'shop_id' => 0,
            'cat_id' => $cat_id,
            'mobile_desc' => null,
            'other_attrs' => null,
        ];

        // 获取分类名称 cat_names 如：个护化妆 > 美发护发 > 护发
        $cat_arr = $this->category->getCategoryBread($cat_id);
        $cat_names = '';
        foreach ($cat_arr as $v) {
            $cat_names .= $v->cat_name.' &gt; ';
        }
        $cat_names = rtrim($cat_names, ' &gt; ');

        // 属性列表 attr_list
        $attr_list = $this->attribute->getAttrList($cat_id);

        // 规格列表 spec_list
        $spec_list = $this->attribute->getSpecList($cat_id);

        // 分类列表
//        $cat_list = $this->category->getFormatCategory();

        $other_cat_ids = null;

        // 属性值列表
        $attr_values = $this->attrValue->getAttrValueList($cat_id);

        // 商品规格值列表 新增为null
        $attr_ids_arr = array_column($spec_list, 'attr_id');
        $spec_values = [];
        if (!empty($attr_ids_arr)) {
            foreach ($attr_ids_arr as $attr_id) {
                $spec_values[$attr_id] = null;
            }
        }

        // 商品主图
        $goods_image = get_image_url(sysconf('default_goods_image'));

        // 最近15天日期数组
        $date_list = [];
        for ($i = 0; $i <= 15; $i++) {
            $date_list[date("Y-m-d",strtotime("-".$i." day"))] = date("Y年m月d",strtotime("-".$i." day"));
        }
        $hour_list = range(0, 23);

        $minute_list = [];
        foreach (range(0, 59, 5) as $item) {
            $minute_list[$item] = $item;
        }

        // 详情版式
//        $top_layouts = $this->goodsLayout->goodsLayoutByPosition(0); // 顶部模板
//        $bottom_layouts = $this->goodsLayout->goodsLayoutByPosition(1); // 底部模板
//        $packing_layouts = $this->goodsLayout->goodsLayoutByPosition(2); // 包装清单版式
//        $service_layouts = $this->goodsLayout->goodsLayoutByPosition(3); // 售后保证版式

        // 关联品牌
        $brands = BrandCategory::where('cat_id', $cat_id)->select(['brand_id'])->get();
        $brand_list = [
            [
                'brand_id' => 0,
                'brand_name' => '-- 请选择品牌 --'
            ]
        ];
        if (!empty($brands)) {
            foreach ($brands as $item) {
                $brand_name = Brand::where('brand_id', $item->brand_id)->value('brand_name');
                $brand_list[] = [
                    'brand_id' => $item->brand_id,
                    'brand_name' => $brand_name
                ];
            }
        }

        // 系统商品库商品分类
        $lib_category_list = $this->libCategory->getFormatCategory();

        $compact = compact('title', 'cat_names', 'attr_list', 'spec_list', 'other_cat_ids','attr_values','spec_values',
            'goods_image','date_list','hour_list','minute_list','cat_id',
//            'top_layouts','bottom_layouts','packing_layouts','service_layouts',
            'brand_list', 'lib_category_list');

        return view('goods.lib-goods.index', $compact);
    }

    /**
     * 新增商品第二步 保存商品信息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function saveData(Request $request)
    {
        $goods_id = $request->get('id', 0); // 商品id 如果为0 则是新增商品 否则是编辑商品
        $postData = json_decode($request->post('data'), true);

        if ($goods_id){
            // 编辑商品
            $ret = $this->libGoods->modifyGoods($postData, $goods_id);
        } else {
            $ret = $this->libGoods->addGoods($postData);
        }
        if ($ret === false) {
            return result(-1, '', '保存失败');
        }

        return result(0, $ret->goods_id, '保存成功');
    }


    /**
     * 添加商品图片
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function addImages(Request $request)
    {
        $title = '上传商品图片';
        $fixed_title = '本地商品库 - '.$title;
        $goods_id = $request->get('id', 0);
        if (!$goods_id) {
            return redirect('/goods/lib-goods/list');
        }

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $goods_images = $this->libGoodsImage->getGoodsImages($goods_id);

        $first_attr_id = LibGoodsSpec::where([['goods_id',$goods_id],['is_checked',1]])->select(['attr_id'])->orderBy('spec_sort','asc')->value('attr_id');
        $spec_name = Attribute::where('attr_id', $first_attr_id)->value('attr_name');
        if (empty($spec_name)) {
            $spec_name = '规格';
        }

        $spec_list = LibGoodsSpec::where([['goods_id',$goods_id],['is_checked',1],['attr_id',$first_attr_id]])
            ->select(['spec_id','goods_id','attr_id','attr_vid','cat_id','attr_value','attr_desc','is_checked','spec_sort'])
            ->orderBy('spec_sort','asc')->get()->toArray();
        if (empty($spec_list)) { // 无规格
            $spec_list = [
                [
                    'spec_id' => 'default',
                    'attr_value' => '无'
                ]
            ];
        }

        // model
        $model = $this->libGoods->getGoodsModelInfo($goods_id);
        $is_publish = 1;

        $compact = compact('title','goods_images','spec_name','spec_list','model','is_publish');

        return view('goods.lib-goods.add_images', $compact);
    }

    /**
     * 编辑商品图片
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function editImages(Request $request)
    {
        $title = '编辑';
        $fixed_title = '本地商品库 - '.$title;
        $goods_id = $request->get('id', 0);
        if (!$goods_id) {
            return redirect('/goods/lib-goods/list');
        }
        $extra = '?id='.$goods_id;
        $this->sublink($this->edit_links, 'edit-images', '', $extra,'success');

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $goods_images = $this->libGoodsImage->getGoodsImages($goods_id);

        $first_attr_id = LibGoodsSpec::where([['goods_id',$goods_id],['is_checked',1]])->select(['attr_id'])->orderBy('spec_sort','asc')->value('attr_id');
        $spec_name = Attribute::where('attr_id', $first_attr_id)->value('attr_name');
        if (empty($spec_name)) {
            $spec_name = '规格';
        }

        $spec_list = LibGoodsSpec::where([['goods_id',$goods_id],['is_checked',1],['attr_id',$first_attr_id]])
            ->select(['spec_id','goods_id','attr_id','attr_vid','cat_id','attr_value','attr_desc','is_checked','spec_sort'])
            ->orderBy('spec_sort','asc')->get()->toArray();
        if (empty($spec_list)) { // 无规格
            $spec_list = [
                [
                    'spec_id' => 'default',
                    'attr_value' => '无'
                ]
            ];
        }

        // model
        $model = $this->libGoods->getGoodsModelInfo($goods_id);

        $is_publish = 0;

        $compact = compact('title','goods_images','spec_name','spec_list','model','is_publish');

        return view('goods.lib-goods.add_images', $compact);
    }

    /**
     * 保存商品图片
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function saveImageData(Request $request)
    {
        $goods_id = $request->get('id');
        $goodsImages = $request->post('goods_images');

        $ret = $this->libGoodsImage->addGoodsImage($goodsImages, $goods_id);

        if ($ret === false) {
            return result(-1, '', OPERATE_FAIL);
        }
        return result(0, '', OPERATE_SUCCESS);
    }

    /**
     * 发布成功
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success(Request $request)
    {
        $title = '发布成功';
        $fixed_title = '本地商品库 - '.$title;
        $goods_id = $request->get('id');

        $this->sublink($this->edit_links, 'success', '', '?id='.$goods_id);
        $action_span = [
            [
                'url' => '/goods/lib-goods/list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $is_publish = 0;
        $compact = compact('title','is_publish','goods_id');

        return view('goods.lib-goods.success', $compact);
    }

    /**
     * 第二步 - 填写商品详情 - 编辑
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = '编辑';
        $fixed_title = '本地商品库 - '.$title;

        $goods_id = $request->get('id');
        $cat_id = $request->get('cat_id', 0);  // 重新选择商品分类后的商品分类id

        $extra = '?id='.$goods_id;
        $this->sublink($this->edit_links, 'edit', '', $extra, 'success');
        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];

        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        // model
        $model = $this->libGoods->getGoodsModelInfo($goods_id);

        if (!$cat_id) {
            $cat_id = $model['cat_id'];
        }

        // 获取分类名称 cat_names 如：个护化妆 > 美发护发 > 护发
        $cat_arr = $this->category->getCategoryBread($cat_id);

        $cat_names = '';
        foreach ($cat_arr as $v) {
            $cat_names .= $v->cat_name.' &gt; ';
        }
        $cat_names = rtrim($cat_names, ' &gt; ');

        // 属性列表 attr_list
        $attr_list = $this->attribute->getAttrList($cat_id);

        // 规格列表 spec_list
        $spec_list = $this->attribute->getSpecList($cat_id);

        // 分类列表
//        $cat_list = $this->category->getFormatCategory();

        // 属性值列表
        $attr_values = $this->attrValue->getAttrValueList($cat_id);

        // 商品规格值列表 新增为null
        $attr_ids_arr = array_column($spec_list, 'attr_id');
        $spec_values = [];
        if (!empty($attr_ids_arr)) {
            foreach ($attr_ids_arr as $attr_id) {
                $spec_values[$attr_id] = null;
            }
        }

        // 商品属性
        $goods_attrs = $this->libGoodsAttr->getGoodsAttrs($goods_id);

        // 商品规格
        $goods_specs = $this->libGoodsSpec->getGoodsSpecs($goods_id);

        // 选中商品规格
        $goods_checked_specs = Arr::collapse(array_values($goods_specs));

        // 商品规格描述
        $goods_specs_desc = $this->libGoodsSpec->getGoodsSpecsDesc($goods_id);

        // 商品扩展规格 todo 暂时不知道数据来源
        $goods_other_specs = null;

        // 商品规格别名
        $spec_alias = $this->libSpecAlias->getSpecAlias($goods_id);

        // 商品SKU列表
        $goods_sku_list = $this->libGoodsSku->getSellerSkuList($goods_id);

        // 商品主图
        $goods_image = get_image_url(sysconf('default_goods_image'));

        // 最近15天日期数组
        $date_list = [];
        for ($i = 0; $i <= 15; $i++) {
            $date_list[date("Y-m-d",strtotime("-".$i." day"))] = date("Y年m月d",strtotime("-".$i." day"));
        }
        $hour_list = range(0, 23);

        $minute_list = [];
        foreach (range(0, 59, 5) as $item) {
            $minute_list[$item] = $item;
        }

        // 关联品牌
        $brands = BrandCategory::where('cat_id', $cat_id)->select(['brand_id'])->get();
        $brand_list = [
            [
                'brand_id' => 0,
                'brand_name' => '-- 请选择品牌 --'
            ]
        ];
        if (!empty($brands)) {
            foreach ($brands as $item) {
                $brand_name = Brand::where('brand_id', $item->brand_id)->value('brand_name');
                $brand_list[] = [
                    'brand_id' => $item->brand_id,
                    'brand_name' => $brand_name
                ];
            }
        }

        $edit_enable = 1;

        $back_url = null; // todo
        $third_goods_url = null;
        $third_id = null;
        $scid = $request->get('sc_id',0);
        $step_price = null; // todo
        $cat_edit = 1; // 是否允许编辑分类

        // 系统商品库商品分类
        $lib_category_list = $this->libCategory->getFormatCategory();
        $goods_info = $model;
        $compact = compact('title','goods_info', 'cat_names', 'attr_list', 'spec_list','attr_values','spec_values',
            'goods_attrs','goods_specs','goods_checked_specs','goods_specs_desc','goods_other_specs','spec_alias','goods_sku_list',
            'goods_image','date_list','hour_list','minute_list','cat_id','brand_list',
            'edit_enable', 'third_goods_url', 'third_id', 'scid', 'step_price', 'cat_edit','lib_category_list');

        return view('goods.lib-goods.edit', $compact);
    }

    /**
     * 编辑商品信息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function editLibGoodsInfo(Request $request)
    {
        $id = $request->post('goods_id');
        $title = $request->post('title');
        $value = $request->post('value');

        $ret = $this->libGoods->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, null, '编辑失败');
        }
        return result(0, null);
    }

    public function catList(Request $request)
    {
        $parent_id = $request->get('id', 0); // 父id
        $condition = [
            'where' => [['parent_id', $parent_id]],
            'sortname' => 'cat_id',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total)= $this->category->getList($condition);
        $render = view('goods.lib-goods.partials._cat_list', compact('cat_list'))->render();
        return $render;
    }

    /**
     * 搜索商品分类
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function catSearch(Request $request)
    {
        $cat_name = $request->get('cat_name', ''); // 搜索分类关键词

        list($cat_list, $total) = $this->_cat_search($cat_name);
        $render = view('goods.lib-goods.cat_search', compact('cat_list', 'total'))->render();

        return result(0, $render);
    }

    /**
     * 根据分类名称关键词搜索结果
     *
     * @param string $cat_name 分类名称关键词
     * @return array
     */
    private function _cat_search($cat_name = '')
    {
        $cat_ids = Category::select(['cat_id'])->where([['cat_name', 'like', "%{$cat_name}%"]])->pluck('cat_id');
        $count = count($cat_ids);
        $cat_arr = [];
        if (!empty($cat_ids)) {
            foreach ($cat_ids as $cat_id) {
                // 根据分类id获取该分类及子分类
                $cat_obj = $this->category->getCategoryBread($cat_id);
                $cat_items = [];
                if (!empty($cat_obj)) {
                    foreach ($cat_obj as $item) {
                        $cat_items[] = [
                            'cat_id' => $item->cat_id,
                            'parent_id' => $item->parent_id,
                            'cat_level' => $item->cat_level,
                            'cat_name' => $item->cat_name,
                            'cat_name_pinyin_short' => pinyin_abbr($item->cat_name), // 拼音首字母简写
                            'cat_name_pinyin' => pinyin_permalink($item->cat_name, '') // 拼音全拼
                        ];
                    }
                }
                $cat_arr[] = $cat_items;
            }
        }

        return [$cat_arr, $count];
    }

    /**
     * 导入Excel商品
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function addExcelGoods(Request $request)
    {
        $render = view('goods.lib-goods.add_excel_goods')->render();

        return result(0, $render);
    }

    /**
     * 下载上传商品文件模板
     *
     * @param Request $request
     */
    public function downloadAdd(Request $request)
    {

    }

    public function import(Request $request)
    {
        $title = '导入店铺商品';
        $fixed_title = '本地商品库 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ]
        ];

        $explain_panel = [
            '为了丰富本地商品库商品数据，帮助新开店铺有更多的商品选择，系统推出了导入店铺商品数据功能',
            '导入店铺商品数据：将店铺内商品导入到本地商品库（店铺内从商品库导入的商品除外）；如果导入的店铺内商品的条形码与本地商品库商品条形码一致，则需要判断本地商品库商品是否有图片，如果本地商品库商品有图片，则无需覆盖，如果本地商品库商品没有图片，则店铺内商品将覆盖本地商品库商品；如果导入的店铺内商品的条形码未在本地商品库有对应的商品，则导入的店铺商品将新添加入本地商品库中',
            '导入店铺商品，是将店铺内所有具有商品图片的商品进行导入到本地商品库',
            '商品库商品分类将自动根据店铺内商品分类名称进行匹配，名称相同，商品库商品分类自动被选中',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取店铺列表
        $where[] = ['shop_status', 1];
        $condition = [
            'where' => $where,
            'sortname' => 'shop_sort',
            'sortorder' => 'asc',
            'field' => ['shop_id', 'shop_name']
        ];
        list($shop_list, $total) = $this->shop->getList($condition);

        $import_type = $request->get('import_type'); // 导入模式 1全部导入 0单一导入
        $goods_id = $request->get('goods_id', 0); // 商品id  单一导入才有该参数

        if ($request->method() == 'POST') {
            $key = $request->post('key'); // key: build-lib-goods-import


            // 导入成功
            return result(0, null, '成功导入了1个商品');
        }

        return view('goods.lib-goods.import', compact('title', 'shop_list'));
    }

    public function skuList(Request $request)
    {
        $goods_id = $request->get('goods_id', 0);
        if (!$goods_id) {
            return result(-1, null, 'SKU ID 错误');
        }

        $skuList = $this->libGoods->getSkuList($goods_id);

        $compact = compact('skuList', 'goods_id');
        $render = view('goods.lib-goods.sku_list', $compact)->render();

        return result(0, $render);
    }

    public function batchUpload()
    {

    }

    /**
     * 生成二维码
     * @param Request $request
     * @return mixed
     */
    public function qrCode(Request $request)
    {
        $id = $request->get('id',0);
        return $this->libGoods->generateGoodsQrCode($id);
    }

    /**
     * 下载商品二维码
     * todo 还有问题 不能下载
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadQrCode(Request $request)
    {
//        ob_clean();
        $qrCode = $this->qrCode($request);
        $download_name = '二维码_'.$request->get('id');
        return response()->download($qrCode, $download_name);
    }
}