<?php

// +----------------------------------------------------------------------
// | Laravelvip 乐融沃B2B2C商城系统
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
// | Date:2018-07-26
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Models\Brand;
use App\Models\Freight;
use App\Models\GoodsSku;
use App\Models\GoodsTag;
use App\Models\GoodsUnit;
use App\Models\ShopRank;
use App\Models\ShopShipper;
use App\Models\Store;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsLayoutRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\GoodsSkuRepository;
use App\Repositories\GoodsSpecRepository;
use App\Repositories\GoodsTagRepository;
use App\Repositories\ShopCategoryRepository;
use Illuminate\Http\Request;


class ListController extends Seller
{

    private $upload_set_sku_member_links = [
        ['url' => 'goods/list/upload-set-sku-member', 'text' => '批量自定义会员价'],
    ];

    private $batch_add_links = [
        ['url' => 'goods/list/batch-add', 'text' => '批量excel上传商品'],
//        ['url' => 'goods/upload/add', 'text' => '批量导入ECShop数据'],
    ];

    protected $goods;
    protected $goodsSpec;
    protected $goodsSku;
    protected $category;
    protected $shopCategory;
    protected $goodsLayout;

    public function __construct(
        GoodsRepository $goods
        , GoodsSpecRepository $goodsSpec
        , GoodsSkuRepository $goodsSku
        , CategoryRepository $category
        , ShopCategoryRepository $shopCategory
        , GoodsLayoutRepository $goodsLayout
    )
    {
        parent::__construct();

        $this->goods = $goods;
        $this->goodsSpec = $goodsSpec;
        $this->goodsSku = $goodsSku;
        $this->category = $category;
        $this->shopCategory = $shopCategory;
        $this->goodsLayout = $goodsLayout;

        $this->set_menu_select('goods', 'goods-list');

        if (\request()->path() == 'goods/list/trash') {
            $this->set_menu_select('goods', 'goods-pictures-recover');
        }
    }

    public function index(Request $request)
    {
        $title = '列表';
        $fixed_title = '商品管理 - 列表';

        $action_span = [
            [
                'url' => '/goods/list/batch-edit',
                'icon' => 'fa-refresh',
                'text' => '批量更新商品价格、库存'
            ],
            [
                'url' => '/goods/list/batch-edit-message',
                'icon' => 'fa-refresh',
                'text' => '批量更新商品信息'
            ],
            [
                'url' => '/goods/list/batch-add',
                'icon' => 'fa-cloud-upload',
                'text' => '批量上传商品'
            ],
            [
                'url' => '/goods/list/upload-set-sku-member',
                'icon' => 'fa-cubes',
                'text' => '批量自定义会员价'
            ],
            [
                'url' => '/goods/list/batch-set-pickup-timeout',
                'icon' => 'fa-cubes',
                'text' => '批量设置商品自提超时期限'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();


        // 获取数据
        // 商品分类 只适用于PC端
//        $pc_cat_list = $this->category->getFormatCategory();

        // 商品分类 app
        $condition = [
            'where' => [],
            'limit' => 0, // 不分页
            'relation' => 'goods', // 关联查询分类下商品数量
            'sortname' => 'created_at',
            'sortorder' => 'asc'
        ];
        list($cat_list, $cat_total) = $this->category->getList($condition, '', false, true);

        $where = [];
        $where[] = ['shop_id', session('shop_info')->shop_id];
        $where[] = ['is_delete', 0]; // 查询删除状态为0的商品
        // 搜索条件
        $search_arr = ['goods_barcode', 'keyword', 'cat_id'];
		$keyword_type = $params['keyword_type'] ?? 0; // 搜索类型：0-商品名称 1-商品ID 2-商品货号
		$keyword_field = str_replace([0,1,2], ['goods_name', 'goods_id', 'goods_sn'], $keyword_type);

        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'goods_barcode') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } elseif ($v == 'keyword' ) {
					$where[] = [$keyword_field, 'like', "%{$params[$v]}%"];
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
            'with' => ['shop', 'goodsUnit', 'goodsTag']
        ];
        list($list, $total) = $this->goods->getList($condition);
        $list = $list->toArray();
        if (!empty($list)) {
            foreach ($list as &$item) { // todo 后期此处代码可以进行优化
                $shop = $item['shop'];
                $item['shop_name'] = $shop['shop_name'];
                $item['shop_type'] = $shop['shop_type'];
                $item['is_supply'] = $shop['is_supply'];
                $item['shop_status'] = $shop['shop_status'];
                $item['unit_name'] = $item['goods_unit'];
                $item['goods_total_sale_num'] = $item['sale_num'] + $item['multi_store_sale_num'];
                $item['m_id'] = null;
                $item['member_value'] = null;
                $item['source'] = null;
                $item['third_id'] = null;
                $item['goods_url'] = null;
                $item['source_name'] = null;
                $item['source_url'] = null;
                $item['goods_image_mid'] = null;
                $item['goods_image_thumb'] = null;
                $item['remark_array'] = unserialize($item['goods_remark']);
                $item['shipper'] = null;
                $item['tag_name'] = $item['goods_tag']['tag_name'] ?? '';
            }
        }
        $pageHtml = pagination($total);

        $tag_list = GoodsTag::where('shop_id', seller_shop_info()->shop_id)->pluck('tag_name', 'tag_id')->toArray();
        $tag_list = array_merge(["0" => "请选择"], $tag_list);
        $goods_audit['items'] = [
            "" => '全部',
            '待审核',
            '审核通过',
            '审核未通过',
        ];
        $sales_model['items'] = [
            "" => '全部',
            '零售',
            '批发',
        ];
        $goods_status['items'] = [
            "" => '全部',
            '已下架',
            '出售中',
            '违规下架',
        ];
        $pricing_mode['items'] = [
            "" => '全部',
            '计件',
            '计重',
        ];
        $status['items'] = [
            "" => '全部',
            1 => '已下架',
            2 => '出售中',
            3 => '待审核',
            4 => '审核未通过',
            5 => '违规下架',
        ];
        // 隶属网点
        $store_list = Store::where('shop_id', seller_shop_info()->shop_id)->pluck('store_name', 'store_id')->toArray();
        $store_list = array_merge(["" => "全部"], $store_list);
        $page = frontend_pagination($total, true);
        $searchModel = null;
        $action = 'index';
        $on_sale_count = 0;
        $off_sale_count = 0;
        $audit_sale_count = 0;
        $scid = 0;
        $brand_list = Brand::where('is_show', 1)->pluck('brand_name', 'brand_id')->toArray();
        $brand_list = array_merge(["" => "请选择"], $brand_list);
        $goods_mix_ids = null;
        $search_status = '';
        $freight_id = $request->get('freight_id', 0);
        $show_erp_goods_id = false;
        $shipper_list = null;
        $freight_list = Freight::where('shop_id', seller_shop_info()->shop_id)->pluck('title', 'freight_id')->toArray();
        $freight_list = array_merge(["0" => "请选择"], $freight_list);


        // 店铺内分类列表
        $shop_cat_list = $this->shopCategory->getShopCategoryList(seller_shop_info()->shop_id);

        $app_prefix_data = [
            'cat_list' => $cat_list,
            'tag_list' => $tag_list,
            'goods_audit' => $goods_audit,
            'sales_model' => $sales_model,
            'goods_status' => $goods_status,
            'pricing_mode' => $pricing_mode,
            'status' => $status,
            'store_list' => $store_list,
            'page' => $page,
            'list' => $list,
            'searchModel' => $searchModel,
            'action' => $action,
            'on_sale_count' => $on_sale_count,
            'off_sale_count' => $off_sale_count,
            'audit_sale_count' => $audit_sale_count,
            'scid' => $scid,
            'brand_list' => $brand_list,
            'goods_mix_ids' => $goods_mix_ids,
            'search_status' => $search_status,
            'freight_id' => $freight_id,
            'show_erp_goods_id' => $show_erp_goods_id,
            'shipper_list' => $shipper_list,
            'freight_list' => $freight_list
        ];

        // web html 数据
        $compact_data = $app_prefix_data;
        $compact_data['title'] = $title;
        $compact_data['pageHtml'] = $pageHtml;
        $compact_data['total'] = $total;
        $compact_data['shop_cat_list'] = $shop_cat_list;

        if ($request->ajax()) { // 此处可以不用全部变量
            $render = view('goods.list.partials._list', compact('list', 'pageHtml'))->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => $app_prefix_data,
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact_data,
            'tpl_view' => 'goods.list.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    public function skuList(Request $request)
    {
        $goods_id = $request->get('goods_id', 0);

        $sku_list = $this->goods->getSkuList($goods_id);
        $compact = compact('sku_list', 'goods_id');
        $render = view('goods.list.partials._sku_list', $compact)->render();

        return result(0, $render);
    }

    /**
     * 设置会员价
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function skuMember(Request $request)
    {
        $goods_id = $request->get('goods_id', 0);
        $uuid = make_uuid();

        $goods_info = $this->goods->getGoodsModelInfo($goods_id);
        if (empty($goods_info)) {
            return result(-1, '', '商品ID无效');
        }

        // 商品SKU列表
        $sku_list = $this->goods->getSkuList($goods_id);
        $sku_list = $sku_list->toArray();
//        dd($sku_list);
        // 商品规格值列表
        $goods_spec_values = $this->goodsSpec->getGoodsSpecValues($goods_id);
//        dd($goods_spec_values);

        // 商品规格
        $goods_specs = $this->goodsSpec->getGoodsSpecs($goods_id);
//        dd($goods_specs);
        // 店铺会员等级列表
        $shop_rank_list = ShopRank::where([['shop_id', seller_shop_info()->shop_id]])->select(['rank_id', 'rank_name'])->get()->toArray();

        // 商品会员价数据
        $sku_member_data = []; // todo 从sku_member表中获取

        $compact = compact('sku_list', 'goods_id', 'uuid', 'goods_info', 'goods_spec_values', 'goods_specs', 'shop_rank_list', 'sku_member_data');

        if ($request->method() == 'POST') {

            return result(0, null, OPERATE_SUCCESS);
        }
        $render = view('goods.list.sku_member', $compact)->render();
        return result(0, $render);
    }

    public function editGoodsInfo(Request $request)
    {
        $ret = $this->goods->editInfo($request);
        if ($ret === false) {
            return result(-1, null);
        }
        return result(0, null);
    }

    public function editGoodsSkuInfo(Request $request)
    {
        $ret = $this->goods->editGoodsSkuInfo($request);
        if ($ret === false) {
            return result(-1, null);
        }
        return result(0, null);
    }

    /**
     * 添加商品备注信息
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function remark(Request $request)
    {
        $id = $request->get('id'); // 商品id
        $goods_info = $this->goods->getById($id);
        $goods_remark = !empty($goods_info->goods_remark) ? unserialize($goods_info->goods_remark) : [];

        $render = view('goods.list.remark', compact('id', 'goods_remark'))->render();

        if ($request->method() == 'POST') {
            $insert = [
                'goods_id' => $request->post('id'),
                'admin_id' => auth('seller')->id(),
                'admin_name' => auth('seller')->user()->user_name,
                'content' => $request->post('remark'),
                'created_at' => format_time(time())
            ];
            $newGoodsRemarkInsert = array_merge([$insert], $goods_remark); // 将新的备注信息与原来的合并
            $newGoodsRemarkInsert = serialize($newGoodsRemarkInsert);
            $ret = $this->goods->update($id, ['goods_remark' => $newGoodsRemarkInsert]);

            if ($ret === false) {
                return result(-1, null, '商品备注设置失败！');
            }
            return result(0, null, '商品备注设置成功！');
        }

        return result(0, $render);
    }

    public function trash(Request $request)
    {
        $title = '列表';
        $fixed_title = '回收站 - 列表';

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', session('shop_info')->shop_id];
        $where[] = ['is_delete', 1]; // 查询删除状态为1的商品
        // 搜索条件
        $search_arr = ['goods_barcode', 'keyword', 'cat_id'];
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
        list($list, $total) = $this->goods->getList($condition);

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('goods.list.partials._trash_list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        $goods_audit['items'] = [
            "" => '全部',
            '待审核',
            '审核通过',
            '审核未通过',
        ];
        $sales_model['items'] = [
            "" => '全部',
            '零售',
            '批发',
        ];
        $goods_status['items'] = [
            "" => '全部',
            '已下架',
            '出售中',
            '违规下架',
        ];
        $pricing_mode['items'] = [
            "" => '全部',
            '计件',
            '计重',
        ];
        $status['items'] = [
            "" => '全部',
            1 => '已下架',
            2 => '出售中',
            3 => '待审核',
            4 => '审核未通过',
            5 => '违规下架',
        ];
        $brand_list = [];
        // 店铺内分类列表
        $shop_cat_list = $this->shopCategory->getShopCategoryList(seller_shop_info()->shop_id);

        $compact = compact('title', 'list', 'pageHtml', 'goods_audit', 'sales_model', 'goods_status', 'pricing_mode',
            'status', 'brand_list', 'shop_cat_list');
        return view('goods.list.trash', $compact);
    }


    /**************************** 批量操作 ****************************/


    /**
     * 转移商城商品分类
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function moveGoodsCat(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $condition = [
            'where' => [['parent_id', 0]],
            'sortname' => 'cat_id',
            'sortorder' => 'asc'
        ];
        list($cat_list, $total) = $this->category->getList($condition);

        $render = view('goods.list.batch.move_goods_cat', compact('goods_ids', 'uuid', 'cat_list'))->render();

        return result(0, $render);
    }

    /**
     * 转移商城商品分类-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function move(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $cat_id = $request->post('cat_id');

        $cat_arr = $this->category->getCatIds($cat_id);

        $update = [
            'cat_id' => $cat_id,
            'cat_id1' => $cat_arr['cat_id1'],
            'cat_id2' => $cat_arr['cat_id2'],
            'cat_id3' => $cat_arr['cat_id3'],
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, '转移失败！');
        }
        return result(0, null, '转移成功！');
    }

    /**
     * 商品定时出售
     * todo 待完善
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function setRegularTimeSale(Request $request)
    {
        if ($request->method() == 'POST') { // 提交
            //start_time: 2021-12-15 22:45:56
            //timepicker: 1
            //ids: 72176,72174
            $start_time = $request->post('start_time');
            $timepicker = $request->post('timepicker');
            $ids = $request->post('ids');

            $update = [];
            $ret = true; // $this->goods->batchUpdate('goods_id', explode(',', $ids), $update);
            if ($ret === false) {
                return result(-1, null, '操作失败！');
            }
            return result(0, null, '操作成功！');
        }
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_regular_time_sale', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 转移店铺商品分类
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function showShopGoodsCat(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        // 店铺内分类列表
        $shop_cat_list = $this->shopCategory->getShopCategoryList(seller_shop_info()->shop_id);

        $render = view('goods.list.batch.show_shop_goods_cat', compact('goods_ids', 'uuid', 'shop_cat_list'))->render();

        return result(0, $render);
    }

    /**
     * 转移店铺商品分类-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function moveShopGoodsCat(Request $request)
    {
        $data = $request->post('data');
        $goods_ids = $data['goods_ids'];
        $shop_cat_ids = $data['shop_cat_ids'];

        $update = [
            'shop_cat_ids' => implode(',', $shop_cat_ids),
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, '转移失败！');
        }
        return result(0, null, '转移成功！');
    }

    /**
     * 打标签
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsTag(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $goods_tag = GoodsTag::where('shop_id', seller_shop_info()->shop_id)->get()->toArray();

        $render = view('goods.list.batch.set_goods_tag', compact('goods_ids', 'uuid', 'goods_tag'))->render();

        return result(0, $render);
    }

    /**
     * 打标签-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setTag(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $tag_id = $goodsModel['tag_id'];

        $update = [
            'tag_id' => $tag_id,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 商品单位设置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsUnit(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $goods_unit = GoodsUnit::where('shop_id', seller_shop_info()->shop_id)->get()->toArray();

        $render = view('goods.list.batch.set_goods_unit', compact('goods_ids', 'uuid', 'goods_unit'))->render();

        return result(0, $render);
    }

    /**
     * 商品单位设置-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setUnit(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $goods_unit = $goodsModel['goods_unit'];

        $update = [
            'goods_unit' => $goods_unit,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 计价方式设置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsPricingMode(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_goods_pricing_mode', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 计价方式设置-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setPricingMode(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $pricing_mode = $goodsModel['pricing_mode'];

        $update = [
            'pricing_mode' => $pricing_mode,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 库存计数设置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsStockMode(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_goods_stock_mode', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 库存计数设置-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setStockMode(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $stock_mode = $goodsModel['stock_mode'];

        $update = [
            'stock_mode' => $stock_mode,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 最小起订量设置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsMoqModal(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_goods_moq_modal', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 最小起订量设置-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setGoodsMoq(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $goods_moq = $goodsModel['goods_moq'];

        $update = [
            'goods_moq' => $goods_moq,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 开具发票设置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsInvoiceType(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_goods_invoice_type', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 开具发票设置-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setInvoiceType(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $invoice_type = $goodsModel['invoice_type'];

        $update = [
            'invoice_type' => $invoice_type,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 详情板式设置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsLayout(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        // 详情版式
        $top_layouts = $this->goodsLayout->goodsLayoutByPosition(0); // 顶部模板
        $bottom_layouts = $this->goodsLayout->goodsLayoutByPosition(1); // 底部模板
        $packing_layouts = $this->goodsLayout->goodsLayoutByPosition(2); // 包装清单版式
        $service_layouts = $this->goodsLayout->goodsLayoutByPosition(3); // 售后保证版式

        $render = view('goods.list.batch.set_goods_layout', compact('goods_ids', 'uuid', 'top_layouts', 'bottom_layouts', 'packing_layouts', 'service_layouts'))->render();

        return result(0, $render);
    }

    /**
     * 详情板式设置-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setLayout(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');

        $update = [
            'top_layout_id' => $goodsModel['top_layout_id'],
            'bottom_layout_id' => $goodsModel['bottom_layout_id'],
            'packing_layout_id' => $goodsModel['packing_layout_id'],
            'service_layout_id' => $goodsModel['service_layout_id'],
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 服务保障
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsContract(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_goods_contract', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 服务保障-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setContract(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $invoice_type = $goodsModel['invoice_type'];

        $update = [
            'invoice_type' => $invoice_type,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 会员打折
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setUserDiscount(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_user_discount', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 会员打折-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setDiscount(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $invoice_type = $goodsModel['invoice_type'];

        $update = [
            'invoice_type' => $invoice_type,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 自定义会员价
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function batchSkuMember(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.batch_sku_member', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 自定义会员价-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function batchSkuMemberSaveData(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $invoice_type = $goodsModel['invoice_type'];

        $update = [
            'invoice_type' => $invoice_type,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 批量自定义会员价
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadSetSkuMember(Request $request)
    {
        $title = '批量自定义会员价';
        $this->sublink($this->upload_set_sku_member_links, 'upload-set-sku-member');

        $fixed_title = '商品管理 - ' . $title;

        $action_span = [
            [
                'url' => 'index',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ],
        ];

        $explain_panel = [
            '系统根据条形码做唯一标识判断，多规格商品条码不同，需分别设置，如果多规格商品条码相同，则上传文件模板中只需填写一条记录',
            '导入的自定义会员价商品文件，请提前确定导入文件中的店铺会员等级在店铺中真实存在，否则无法导入',
            '同一个商品，多个规格，设置优惠类型必须是一致的，否则无法上传',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $filename = $request->file('uploadfile'); // 导入文件
            $importRes = $this->goods->uploadSetSkuMemberImport($filename);
            if ($importRes['code'] == -1) {
                flash('error', $importRes['message']);
                return redirect('/goods/list/upload-set-sku-member');
            }

            flash('success', $importRes['message']);
            return redirect('/goods/list/index');
        }

        return view('goods.list.batch.upload_set_sku_member', compact('title'));
    }

    /**
     * 批量excel上传商品
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function batchAdd(Request $request)
    {
        $title = '批量excel上传商品';
        $this->sublink($this->batch_add_links, 'batch_add');

        $fixed_title = '商品管理 - ' . $title;

        $action_span = [
            [
                'url' => 'index',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ],
        ];

        $explain_panel = [
            '系统根据条形码做唯一标识进行去重判断，新上传的商品将替换原有的商品信息',
            '批量导入商品，商品未上传主图及商品详情，所以导入的商品默认是下架状态，需手动维护商品数据后，才可上架',
            '导入的商品文件，请提前确定导入文件中的平台方商品分类在商城系统中真实存在，否则商品将无法导入',
            '导入的商品文件，请提前确定导入文件中的店铺商品分类在店铺中真实存在，否则导入的商品的店铺内商品分类将为空'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $filename = $request->file('uploadfile'); // 导入文件
            $importRes = $this->goods->uploadSetSkuMemberImport($filename);
            if ($importRes['code'] == -1) {
                flash('error', $importRes['message']);
                return redirect('/goods/list/batch-add');
            }

            flash('success', $importRes['message']);
            return redirect('/goods/list/index');
        }

        return view('goods.list.batch.batch_add', compact('title'));
    }

    public function batchEdit(Request $request)
    {
        $title = '批量更新商品价格、库存';
//        $this->sublink($this->batch_add_links, 'batch_add');

        $fixed_title = '商品管理 - ' . $title;

        $action_span = [
            [
                'url' => 'index',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ],
        ];

        $explain_panel = [
            '根据条形码批量更新商品价格、库存，解决了如何快速修改商品价格以及库存问题',
            '商品批量更新商品文件，点击预览，即可查看要更新的商品信息',
            '导入的商品如果满足“无主图商品是否下架”为“是”或“商品库存为0是否下架”为”是”其中任何一个条件时，导入的商品即会被下架',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
//            $filename = $request->file('uploadfile'); // 导入文件
//            $importRes = $this->goods->uploadSetSkuMemberImport($filename);
//            if ($importRes['code'] == -1) {
//                flash('error', $importRes['message']);
//                return redirect('/goods/list/batch-add');
//            }
//
//            flash('success', $importRes['message']);
//            return redirect('/goods/list/index');
        }

        return view('goods.list.batch.batch_edit', compact('title'));
    }

    public function batchEditMessage(Request $request)
    {
        $title = '批量更新商品信息';
//        $this->sublink($this->batch_add_links, 'batch_add');

        $fixed_title = '商品管理 - ' . $title;

        $action_span = [
            [
                'url' => 'index',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ],
        ];

        $explain_panel = [
            '根据条形码批量更新商品信息，解决了快速修改商品信息问题',
            '商品批量更新商品文件,点击预览,即可查看要更新的商品信息',
            '批量更新文件中，展示列为空，代表不更新，如果填写值或填写0，均代表更新列值',
            '一个商品多个规格，规格条码不同，上传的excle文件中，同一个商品不同规格设置的最小起订量、会员打折、库存计数、商品状态不同的话，均按照excel文件中最上方的规格记录中设置的值进行更新]'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
//            $filename = $request->file('uploadfile'); // 导入文件
//            $importRes = $this->goods->uploadSetSkuMemberImport($filename);
//            if ($importRes['code'] == -1) {
//                flash('error', $importRes['message']);
//                return redirect('/goods/list/batch-add');
//            }
//
//            flash('success', $importRes['message']);
//            return redirect('/goods/list/index');
        }

        return view('goods.list.batch.batch_edit_message', compact('title'));
    }

    public function batchSetPickupTimeout(Request $request)
    {
        $title = '批量设置商品自提超时期限';
//        $this->sublink($this->batch_add_links, 'batch_add');

        $fixed_title = '商品管理 - ' . $title;

        $action_span = [
            [
                'url' => 'index',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ],
        ];

        $explain_panel = [
            '按分类设置分类下的所有商品的自提未取货超时期限，订单中商品超过设置的自提未取货期限，商品自动退款成功，退款金额原路退回',
            '自提未取货超时期限，要求必须是数字+分钟/小时/天，比如3天、4小时、5分钟',
            '填写的末级分类，是平台方末级商品分类',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
//            $filename = $request->file('uploadfile'); // 导入文件
//            $importRes = $this->goods->uploadSetSkuMemberImport($filename);
//            if ($importRes['code'] == -1) {
//                flash('error', $importRes['message']);
//                return redirect('/goods/list/batch-add');
//            }
//
//            flash('success', $importRes['message']);
//            return redirect('/goods/list/index');
        }

        return view('goods.list.batch.batch_set_pickup_timeout', compact('title'));
    }

    /**
     * 运费设置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setGoodsFreight(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_goods_freight', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 运费设置-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setFreight(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $invoice_type = $goodsModel['invoice_type'];

        $update = [
            'invoice_type' => $invoice_type,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 调整价格
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setPrice(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.set_price', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 调整价格-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setPriceSaveData(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $invoice_type = $goodsModel['invoice_type'];

        $update = [
            'invoice_type' => $invoice_type,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 调整库存
     * todo
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function batchEditGoodsNumber(Request $request)
    {
        if ($request->method() == 'POST') { // 提交
            //data[Goods][adj_mec]: 0
            //data[Goods][goods_number]: 1
            //goods_ids: 72174

            $update = [];
            $ret = true; // $this->goods->batchUpdate('goods_id', explode(',', $ids), $update);
            if ($ret === false) {
                return result(-1, null, '操作失败！');
            }
            return result(0, null, '操作成功！');
        }
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.batch_edit_goods_number', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 调整关键词
     * todo
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function setKeywords(Request $request)
    {
        if ($request->method() == 'POST') { // 提交
            //goods_ids: 72176,72174
            //keywords: 啊啊啊
            //change_mech: 1
            $goods_ids = $request->post('goods_ids');
            $keywords = $request->post('keywords');
            $change_mech = $request->post('change_mech');

            $update = [];
            $ret = true; // $this->goods->batchUpdate('goods_id', explode(',', $ids), $update);
            if ($ret === false) {
                return result(-1, null, '操作失败！');
            }
            return result(0, null, '操作成功！');
        }
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_keywords', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 调整自提超时期限
     * todo
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function setPickupTimeout(Request $request)
    {
        if ($request->method() == 'POST') { // 提交
            //goods_ids: 72174
            //pickup_timeout: 20
            //pickup_timeout_type: 0

            $update = [];
            $ret = true; // $this->goods->batchUpdate('goods_id', explode(',', $ids), $update);
            if ($ret === false) {
                return result(-1, null, '操作失败！');
            }
            return result(0, null, '操作成功！');
        }
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $render = view('goods.list.batch.set_pickup_timeout', compact('goods_ids', 'uuid'))->render();

        return result(0, $render);
    }

    /**
     * 设置发货方
     * 废弃
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function setShipper(Request $request)
    {
        $goods_ids = $request->get('ids');
        $uuid = make_uuid();

        $ship_shipper = ShopShipper::orderBy('sort', 'asc')->select(['id', 'name', 'image'])->get()->toArray();
        if (!empty($ship_shipper)) {
            foreach ($ship_shipper as &$item) {
                $item['clientRuleCache'] = 'cache';
            }
        }

        $render = view('goods.list.batch.set_shipper', compact('goods_ids', 'uuid', 'ship_shipper'))->render();

        return result(0, $render);
    }

    /**
     * 设置发货方-提交保存
     *
     * @param Request $request
     * @return array
     */
    public function setShipperSaveData(Request $request)
    {
        $goods_ids = $request->post('goods_ids');
        $goodsModel = $request->post('GoodsModel');
        $shipper_id = $goodsModel['shipper_id'];

        $update = [
            'shipper_id' => $shipper_id,
        ];
        $ret = $this->goods->batchUpdate('goods_id', explode(',', $goods_ids), $update);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 下载文件
     * todo 使用Excel Export功能实现从数据库读取相关信息并导出到excel文件 sku-member-demo.xlsx
     * todo 以下从本地读取文件的方式后期再修改
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request)
    {
        $type = $request->get('type');
        $filename = '';
        $redirect_url = '';
        if ($type == 'sku_member') { // 批量自定义会员价-上传商品文件
            $filename = 'sku-member-demo.xlsx'; // todo 此处不能从本地读取excel文件，而是从数据库读取数据并导出到excel文件
            $redirect_url = '/goods/list/upload-set-sku-member';
        } elseif ($type == 'add') { // 批量excel上传商品
            $filename = 'goods-add-demo1.xlsx';
            $redirect_url = '/goods/list/batch-add';
        } elseif ($type == 'edit') { // 批量更新商品价格、库存
            $filename = 'goods-update-demo.xlsx';
            $redirect_url = '/goods/list/batch-edit';
        } elseif ($type == 'edit_message') { // 批量更新商品信息
            $filename = '批量更新商品信息模板.xlsx';
            $redirect_url = '/goods/list/batch-edit-message';
        } elseif ($type == 'pickup_timeout') { // 批量设置商品自提超时期限
            $filename = 'batch-set-pickup-timeout-demo.xlsx';
            $redirect_url = '/goods/list/batch-set-pickup-timeout';
        }
        if (!$filename) {
            flash('error', '文件不存在');
            return redirect($redirect_url);
        }
        $file_path = public_path('seller/web/files/' . $filename);
        if (!file_exists($file_path)) {
            flash('error', '文件不存在');
            return redirect($redirect_url);
        }

        return response()->download($file_path);
    }

    public function getFreightList(Request $request)
    {
        $freight_id = $request->get('freight_id', 0);
        $freight_fee = shopconf('freight_fee', false, seller_shop_info()->shop_id);

        $freight_list = Freight::where('shop_id', seller_shop_info()->shop_id)->pluck('title', 'freight_id')->toArray();
        $freight_list = array_merge(["0" => "请选择", '-1' => '店铺统一运费'], $freight_list);
        return view('goods.list.freight_list', compact('freight_list', 'freight_id', 'freight_fee'))->render();
    }
}
