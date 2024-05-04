<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Compare;
use App\Models\Goods;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\CompareRepository;
use App\Repositories\GoodsImageRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class CompareController extends UserCenter
{

    protected $compareRep;
    protected $goods;
    protected $goodsImage;

    public function __construct(
        CompareRepository $compareRep
        ,GoodsRepository $goods
        ,GoodsImageRepository $goodsImage
    )
    {
        parent::__construct();

        $this->compareRep = $compareRep;
        $this->goods = $goods;
        $this->goodsImage = $goodsImage;

    }

    /**
     * 加入对比
     *
     * @param Request $request
     * @return mixed
     */
    public function toggle(Request $request)
    {
        $goods_id = $request->post('goods_id');

        $ret = $this->compareRep->toggle($this->user_id, $goods_id);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }
        $message = $ret == 1 ? '已加入对比' : '已移除对比';
        return result(0, $ret, $message);
    }

    /**
     * 移除对比
     *
     * @param Request $request
     * @return array
     */
    public function remove(Request $request)
    {
        $goods_id = $request->post('goods_id');
        $ret = $this->compareRep->remove($this->user_id, $goods_id);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }

        return result(0, null, OPERATE_SUCCESS);
    }

    public function clear(Request $request)
    {
        $ret = $this->compareRep->clear($this->user_id);
        if ($ret === false) {
            return result(-1, null, OPERATE_FAIL);
        }

        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 右侧对比内容
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function boxGoodsList(Request $request)
    {

        $compare_goods = Compare::where('user_id', $this->user_id)->leftJoin('goods', function ($join){
            $join->on('goods.goods_id','=','compare.goods_id');
        })->select(['compare.goods_id','goods_name','goods_image'])
            ->get()->toArray();

        $compact = compact('compare_goods');

        if ($request->ajax()) {
            $render = view('compare.box_goods_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => ''
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function compare(Request $request)
    {

        $ids = $request->get('ids');
        $ids_arr = explode(',',$ids);
        $list = Goods::whereIn('goods_id', $ids_arr)
            ->leftJoin('shop', function ($join){
                $join->on('shop.shop_id','=','goods.shop_id');

            })
//            ->limit(3)
//            ->select(['compare.goods_id','goods_name','goods_image'])
            ->get()->toArray();
        $count = count($list);

        if (!empty($list)) {
            foreach ($list as &$v) {
                $sku_images = $this->goodsImage->getGoodsImages($v['goods_id']);
                $shopRep = new ShopRepository();
                $shop_info = $shopRep->shopInfo($v['shop_id']);
                $v['spec_ids'] = null;
                $v['g_goods_price'] = $v['goods_price'];
                $v['sku_images'] = $sku_images;
                $v['select'] = in_array($v['goods_id'], $ids_arr) ? 1 : 0;
                $v['customer_account'] = null;
                $v['customer_tool'] = null;
                $v['aliim_enable'] = "";
                $v['system_aliim_enable'] = "";
                $v['credit_img'] = $shop_info['credit']['credit_img'];
                $v['credit_name'] = $shop_info['credit']['credit_name'];
                $v['format_goods_price'] = $v['goods_price'];
                $v['complaint_count'] = 0;
                $v['complaint_num'] = "0";
                $v['evaluate'] = [
                    'middle_count' => "0",
                    'best_count' => "4",
                    'bad_count' => "1",
                    'count' => 5,
                    'per_best_one' => 80,
                ];
                $v['shop_time'] = 37;
                $v['price_show']['code'] = 1;
                $v['buy_enable'] = [
                    'code' => 1,
                    'button_content' => '请登录'
                ];

                $v['region_code'] = get_region_names_by_region_code($v['region_code']);
            }
        }

        $footer_type = 1; // 底部类型 short_footer

        $show_mall_search_right_ad = false;

//        dd($list);
        $compact = compact('ids','list','footer_type', 'show_mall_search_right_ad');
        $type = $request->get('type');
        if ($type == 1) {
            $render = view('compare.partials._compare_list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'count' => $count,
                'id' => $ids,
                'show_navigation' => false,
                'show_sidebar' => true,
                'show_service' => false,
                'show_article' => false,
                'show_cart' => false,
                'show_mall_search_right_ad' => $show_mall_search_right_ad,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'compare.compare'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function freight(Request $request)
    {
        $cid = $request->get('cid');
        $ids = $request->get('ids');
        $ids_arr = explode(',', $ids);

        $data = [];
        foreach ($ids_arr as $key=>$item) {
            if ($key < 3) {
                $data[] = '免运费';
            }
        }
//        $data = [
//            '￥6','免运费'
//        ];
        return result(0, $data);
    }


}