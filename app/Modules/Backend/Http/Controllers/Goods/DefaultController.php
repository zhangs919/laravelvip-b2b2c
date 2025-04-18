<?php

namespace App\Modules\Backend\Http\Controllers\Goods;

use App\Models\Brand;
use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefaultController extends Backend
{

    private $links = [
        ['url' => 'goods/default/list', 'text' => '所有商品'],
        ['url' => 'goods/default/illegal', 'text' => '违规下架'],
        ['url' => 'goods/default/wait-audit', 'text' => '等待审核'],
    ];

    protected $goods;
    protected $shop;
    protected $category;
    protected $brand;

    public function __construct(
        GoodsRepository $goods
        ,ShopRepository $shop
        ,CategoryRepository $category
        ,BrandRepository $brand
    )
    {
        parent::__construct();

        $this->goods = $goods;
        $this->shop = $shop;
        $this->category = $category;
        $this->brand = $brand;
    }

    public function lists(Request $request, $type = 'list')
    {
        $title = '所有商品';
        $fixed_title = '商品管理 - '.$title;
        $this->sublink($this->links, $type);

        $action_span = [];
        if ($type == 'list') {
            $action_span = [
//                [
//                    'id' => 'btn_build_goods_region',
//                    'url' => '',
//                    'icon' => 'fa-cloud-upload',
//                    'text' => '重建商品数据关联关系'
//                ],
            ];
        }


        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['goods_barcode','keyword', 'cat_id','goods_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'goods_barcode') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 查询条件
        if ($type == 'illegal') {
            // 查询违规下架的商品列表
            $where[] = ['goods_audit', 2];
        }elseif ($type == 'wait-audit') {
            // 查询待审核商品列表
            $where[] = ['goods_audit', 0];
        }

        // 列表
        $condition = [
            'with' => ['shop'],
            'where' => $where,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->goods->getList($condition);

        if (!empty($list)) {
            foreach ($list as $item) {
                $item->shop_name = DB::table('shop')->where('shop_id', $item->shop_id)->value('shop_name');
//                $item->mobile_desc = unserialize($item->mobile_desc);
            }
        }

        $pageHtml = pagination($total);
        $brand_list = Brand::where([['is_show',1]])->get();

        $compact = compact('title', 'list', 'total', 'pageHtml', 'type', 'brand_list');
        if ($request->ajax()) {
            $render = view('goods.default.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.default.list', $compact);
    }

    public function illegal(Request $request)
    {
        return $this->lists($request, 'illegal');
    }

    public function waitAudit(Request $request)
    {
        return $this->lists($request, 'wait-audit');
    }

    public function editGoodsInfo(Request $request)
    {
        $id = $request->post('goods_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if (in_array($title, ['goods_sort'])) {
            $value = intval($value);
        }
        $ret = $this->goods->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 生成二维码
     * @param Request $request
     * @return mixed
     */
    public function qrCode(Request $request)
    {
        $id = $request->get('id',0);
        return $this->goods->generateGoodsQrCode($id);
    }

    public function skuList(Request $request)
    {
        $goods_id = $request->get('goods_id', 0);
        if (!$goods_id) {
            return result(-1, null, 'SKU ID 错误');
        }

        $skuList = $this->goods->getSkuList($goods_id);

        $compact = compact('skuList', 'goods_id');
        $render = view('goods.default.sku_list', $compact)->render();

        return result(0, $render);
    }

    /**
     * 商品选择器
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function picker(Request $request)
    {
        $page_id = make_uuid();
        $pagination_id = $request->get('page')['page_id'];
        $output = $request->get('output');
        $left = $request->get('left');
        $right = $request->get('right');
        $goods_status = $request->get('goods_status', 1); // 商品状态
        $is_sku = $request->get('is_sku', 0); //
        $is_supply = $request->get('is_supply', null); //
        $show_store = $request->get('show_store', 0); //
        $is_enable = $request->get('is_enable', 1); //
        $goods_audit = $request->get('goods_audit', 1); //
        $goods_ids = $request->get('goods_ids');
        $goods_ids = $goods_ids ? explode(',', $goods_ids) : [];
        $sku_ids = $request->get('sku_ids');
        $sku_ids = $sku_ids ? explode(',', $sku_ids) : [];

        // 商品列表
        $where[] = ['goods_status', $goods_status];
//        $where[] = ['is_sku', $is_sku];
//        $where[] = ['show_store', $show_store];
//        $where[] = ['is_enable', $is_enable];
        $where[] = ['goods_audit', $goods_audit];

        $whereIn = [];

        $tpl = 'picker';
        if (/*$request->method() == 'POST' &&*/ !$output) {
            $tpl = 'partials._picker_goods_list';
            $show_selected = $request->post('show_selected');
            $goods_ids = $request->post('goods_ids', '');
            $goods_ids = explode(',', $goods_ids);

            if (!empty($goods_ids) && $show_selected) {

                $whereIn = [
                    'field' => 'goods_id',
                    'condition' => $goods_ids
                ];
            }

        }


        $condition = [
            'where' => $where,
            'in' => $whereIn,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->goods->getList($condition);
        $pageHtml = short_pagination($total, 5);
        if (!$list->isEmpty()) {
            foreach ($list as $item) {
                // 默认sku
                $default_sku = GoodsSku::where('sku_id',$item->sku_id)->first()->toArray();
                $item->sku_image = get_image_url($default_sku['sku_image']);
                $selected_spec_names = $default_sku['spec_names'];
                $spec_attr_value = [];
                $sku_name = $item->goods_name;
                $item->sku_name = $sku_name;
                if (!empty($selected_spec_names)) {
                    foreach (explode(' ', $selected_spec_names) as $spec) {
                        $spec_attr_value[] = explode(':', $spec)[1];
                    }
                    $spec_attr_value = implode(' ', $spec_attr_value);
                    $item->sku_name .=' '.$spec_attr_value;
                }
            }
        }

        // 查询店铺列表
        $where = [];
        $where[] = ['shop_status', 1];
        $condition = [
            'where' => $where,
            'sortname' => 'shop_id',
            'sortorder' => 'desc',
            'field' => ['shop_id', 'shop_name']
        ];
        list($shop_list, $shop_total) = $this->shop->getList($condition);

        // 查询商品分类列表（树形）
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc',
        ];
        list($category_list, $category_total) = $this->category->getList($condition, '', false, true);

        // 查询品牌
        $where = [];
        $where[] = ['is_show',1];
        $condition = [
            'where' => $where,
            'sortname' => 'brand_id',
            'sortorder' => 'desc',
            'field' => ['brand_id', 'brand_name']
        ];
        list($brand_list, $brand_total) = $this->brand->getList($condition);

        $compact = compact(
            'page_id', 'pagination_id', 'list', 'pageHtml',
            'sku_ids', 'goods_ids', 'shop_list', 'category_list',
            'brand_list');
        $render = view('goods.default.'.$tpl, $compact)->render();
        return result(0, $render);
    }

    /**
     * 重建商品数据关联关系
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function buildGoodsRegion(Request $request)
    {
        return result(1,'','正在进行中...');
    }

}