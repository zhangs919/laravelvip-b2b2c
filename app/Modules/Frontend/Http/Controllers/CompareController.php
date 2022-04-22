<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Compare;
use App\Models\Goods;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\CompareRepository;
use App\Repositories\GoodsImageRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class CompareController extends UserCenter
{

    protected $compareRep;
    protected $goods;
    protected $goodsImage;

    public function __construct()
    {
        parent::__construct();

        $this->compareRep = new CompareRepository();
        $this->goods = new GoodsRepository();
        $this->goodsImage = new GoodsImageRepository();

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
        $insert = [
            'user_id' => $this->user_id,
            'goods_id' => $goods_id
        ];
        $ret = $this->compareRep->store($insert);
        if (!$ret) {
            return result(-1, null, '操作失败');
        }
        return result(0, null, '操作成功');
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
        $ret = Compare::where([['user_id',$this->user_id],['goods_id',$goods_id]])->delete();
        if ($ret === false) {
            return result(-1, null, '操作失败');
        }

        return result(0, null, '操作成功');
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
//            ->select(['compare.goods_id','goods_name','goods_image'])
            ->get()->toArray();
        $count = count($list);

        if (!empty($list)) {
            foreach ($list as &$v) {
                $sku_images = $this->goodsImage->getGoodsImages($v['goods_id']);
                $v['spec_ids'] = null;
                $v['g_goods_price'] = $v['goods_price'];
                $v['sku_images'] = $sku_images;
                $v['select'] = in_array($v['goods_id'], $ids_arr) ? 1 : 0;
                $v['customer_account'] = null;
                $v['customer_tool'] = null;
                $v['aliim_enable'] = "";
                $v['system_aliim_enable'] = "";
                $v['credit_img'] = "";
                $v['credit_name'] = "旗舰店";
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
            }
        }

        $footer_type = 1; // 底部类型 short_footer


        $compact = compact('ids','list','footer_type');

        if ($request->ajax()) {
            $type = $request->get('type');
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
                'show_mall_search_right_ad' => false,
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
        $data = [
            '￥6','免运费'
        ];
        return result(0, $data);
    }


}