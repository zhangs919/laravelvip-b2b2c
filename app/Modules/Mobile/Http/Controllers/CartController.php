<?php

namespace App\Modules\Mobile\Http\Controllers;

use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\CartRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class CartController extends Mobile
{

    protected $goods; // 商品模型

    protected $cart;


    public function __construct()
    {
        parent::__construct();

        $this->goods = new GoodsRepository();
        $this->cart = new CartRepository();

    }

    /**
     * 购物车列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $seo_title = '购物车 - '.sysconf('site_name');
        $this->getCartListData();

        $compact = compact('seo_title');

        return view('cart.index', $compact);
    }

    public function boxGoodsList(Request $request)
    {
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId(session()->getId());
        $cart_list = $this->cart->getCartList(); // 购物车数据
        $cart_price_info = $this->cart->getCartPriceInfo($cart_list);
        $renderTop = view('cart.dropdown_goods', compact('cart_list', 'cart_price_info'))->render(); // 顶部购物车
        $renderRight = view('cart.cart_pannel', compact('cart_list', 'cart_price_info'))->render(); // 右侧购物车
        $data = [
            $renderTop,
            $renderRight
        ];
        $extra = [
            'amount' => $cart_price_info['total_fee'],
            'count' => $this->cart_goods_num
        ];
        return result(0, $data,'', $extra);
    }

    /**
     * 加入购物车
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function add(Request $request)
    {
        $goods_id = $request->post('goods_id', 0);
        $sku_id = $request->post('sku_id', 0);
        $number = $request->post('number');

        // 设置页面传入的参数
        $this->cart->setGoodsBuyNum($number);
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId(session()->getId());

        if ($sku_id) {
            // 有规格 选择了规格加入购物车操作
            $goods_id = $this->goods->getGoodsId($sku_id);
            $this->cart->setGoodsModel($goods_id);
            $this->cart->setGoodsSkuModel($sku_id);
            $data = [
                'sku_open' => 0
            ];
        } else {
            $this->cart->setGoodsModel($goods_id);
            $sku_id = $this->goods->getSkuId($goods_id);
            // 判断 如果有库存id 则弹出选择规格框
            if ($sku_id) {
                $uuid = make_uuid();
                // 商品sku列表
                $sku_list = $this->goods->getFrontendSkuList($goods_id);
                $sku_list = json_encode($sku_list);

                // 规格列表
                $spec_list = $this->goods->getGoodsSpecList($goods_id);

                // 默认sku
                $default_sku = GoodsSku::where('sku_id',$sku_id)->first();
                $default_sku['specs'] = unserialize($default_sku['specs']);
                $selected_spec_ids = array_column($default_sku['specs'], 'attr_vid');
                $selected_spec_id = $selected_spec_ids[0];
                $goods_images = $this->goods->getGoodsImages($goods_id, $selected_spec_id);
                $default_sku['goods_image'] = $goods_images[0]['path'];

                $compact = compact('uuid', 'default_sku', 'sku_list', 'spec_list', 'selected_spec_ids');
                $render = view('cart.choose_sku', $compact)->render();
                return result(98, $render);
            } else {
                // 无规格 加入购物车操作
                $data = null;
            }
        }

        $result = $this->cart->addGoodsToCart();

        if ($result['code'] < 0) {
            return result(-1, $data, $result['message']);
        }

        return result(0, $data, $result['message']);
    }

    /**
     * 移除购物车
     *
     * @param Request $request
     * @return array
     */
    public function remove(Request $request)
    {
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId(session()->getId());

        $cart_ids = $request->input('cart_ids', 0);
        if (!$cart_ids) {
            return result(-1, null, '购物车编号错误');
        }
        $ret = $this->cart->delete($cart_ids);

        if ($ret === false) {
            return result(-1, null, '删除失败！');
        }
        $data = [
            'count' => 3,
            'goods_amount' => 5,
            'goods_number' => 1,
            'goods_price' => "5.00",
            'goods_price_format' => "￥0",
            'select_goods_amount' => 0,
            'select_goods_amount_format' => "￥0",
            'select_goods_number' => 0,
            'shop_delivery_enable' => [
                36 =>1
            ],
            'submit_enable' => 1
        ];
        return result(0, $data, '删除成功！');
    }

    public function delete(Request $request)
    {
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId(session()->getId());

        $cart_ids = $request->input('cart_ids', 0);
        if (!$cart_ids) {
            return result(-1, null, '购物车编号错误');
        }
        $ret = $this->cart->delete($cart_ids);

        if ($ret === false) {
            return result(-1, null, '删除失败！');
        }
        $this->getCartListData();

        $render = view('cart.partials._cart_list')->render();
        return result(0, $render, '删除成功！');
    }

    /**
     * 选中/取消选中购物车商品
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function select(Request $request)
    {

        $this->getCartListData();

        $render = view('cart.partials._cart_list')->render();
        $extra = [
            'params' => [
                'count' => 6,
                'dif_price' => -101,
                'dif_price_format' => "￥-101",
                'goods_amount' => 264,
                'goods_number' => 6,
                'goods_price' => "150.00",
                'goods_price_format' => "￥0",
                'select_goods_amount' => 150,
                'select_goods_amount_format' => "￥150",
                'select_goods_number' => 1,
                'select_shop_amount' => [
                    1 => 150,
                ],
                'shop_delivery_enable' => [
                    1 => 1
                ],
                'start_price' => "49.00",
                'start_price_format' => "￥49.00",
                'submit_enable' => 1
            ]
        ];

        return result(0, $render, '', $extra);
    }

    /**
     * 获取购物车列表数据
     */
    private function getCartListData() {
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId(session()->getId());
        $cart_list = $this->cart->getCartList(); // 购物车数据
        // 购物车商品以店铺ID分组显示
        $shop_cart_list = [];
        foreach ($cart_list as $cart) {
            $cart->goods_total = $cart->goods_price * $cart->goods_number;
            $shop_cart_list[$cart->shop_id][] = $cart;
        }
        $cart_price_info = $this->cart->getCartPriceInfo($cart_list);
        view()->share('shop_cart_list',$shop_cart_list);
        view()->share('cart_price_info',$cart_price_info);

    }

    /**
     * 修改购物车商品数量
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function changeNumber(Request $request)
    {
        $sku_id = $request->input('sku_id');
        $number = $request->input('number');
        $cart_id = $request->input('cart_id');

        $ret = $this->cart->changeCartNum($sku_id, $number, $cart_id);
        if ($ret['code'] < 0) {
            $data = null;
        }
        $this->getCartListData();

        $data = view('cart.partials._cart_list')->render();
        return result($ret['code'], $data, $ret['message']);
    }
}