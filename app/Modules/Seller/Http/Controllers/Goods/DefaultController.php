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
// | Description:
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class DefaultController extends Seller
{

    protected $goods;
    protected $category;
    protected $brand;

    public function __construct(
        GoodsRepository $goods
        ,CategoryRepository $category
        ,BrandRepository $brand
    )
    {
        parent::__construct();

        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;
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
        $where[] = ['shop_id', seller_shop_info()->shop_id];
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
            'sku_ids', 'goods_ids', 'category_list',
            'brand_list');
        $render = view('goods.default.'.$tpl, $compact)->render();
        return result(0, $render);
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