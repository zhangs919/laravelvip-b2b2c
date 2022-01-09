<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Cart;
use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CartRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Frontend
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
    public function cartList(Request $request)
    {

        $this->getCartListData();

        $hide_right_sidebar = true; // 是否隐藏右边栏
        $footer_type = 1; // 底部类型 short_footer


        $compact = compact('hide_right_sidebar','footer_type');

        $this->show_seo('seo_index'); // SEO

        return view('cart.cart_list', $compact);
    }

    /**
     * 购物车盒子数据
     *
     * todo 待完成 购物车表需要重建 2018.11.25
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function boxGoodsList(Request $request)
    {
        if ($request->ajax()) {
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

        $compact = compact('seo_title');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [
                'count' => 2,
                'amount' => 23,
                'type' => 1,
                'cart_count' => 2,
                'select_goods_number' => 0,
                'select_goods_amount' => 0,
                'select_goods_amount_format' => '￥0',
                'amount_format' => '￥23',
                'cart_goods_list' => [],
                'start_price' => null,
                'start_price_format' => null,
                'dif_price' => null,
                'dif_price_format' => null
            ],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'brand.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
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

        $goods_info = $this->goods->getById($goods_id);

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
                // 默认sku
                $default_sku = GoodsSku::where('sku_id',$sku_id)->first();
                $default_sku['specs'] = unserialize($default_sku['specs']);
                if (!empty($default_sku['specs'])) {
                    $uuid = make_uuid();
                    // 商品sku列表
                    $sku_list = $this->goods->getFrontendSkuList($goods_id);
                    $sku_list = json_encode($sku_list);

                    // 规格列表
                    $spec_list = $this->goods->getGoodsSpecList($goods_info);

                    $selected_spec_ids = !empty($default_sku['specs']) ? array_column($default_sku['specs'], 'attr_vid') : null;
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
        $cart_ids = $request->post('cart_ids', '');

        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId(session()->getId());
        // 选中购物车商品
        $selectRet = $this->cart->cartSelect($cart_ids);
        if ($selectRet['code'] == -1) {
            return result(-1, '', $selectRet['message']);
        }

        // 获取购物车信息
        $this->getCartListData();

        $render = view('cart.partials._cart_list')->render();
        $extra = [
            'params' => $selectRet['data']
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
            $cart->goods_total = $cart->goods_price * $cart->goods_num;
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

    /**
     * 购物车购买
     * 跳转到提交订单页面
     *
     * @param Request $request
     * @return array
     */
    public function goCheckout(Request $request)
    {
        if (!$this->user_id) {
            return result(99, null, '需要登录');
        }


        session(['user_buy_'.$this->user_id => ['buy_type'=>0,'goods_id'=>0,'sku_id'=>0,'number'=>0]]); // 0-购物车购买 将用户购买类型存入session 方便checkout页面判断
        $data = '/checkout.html'; // 提交订单页面url

        return result(0, $data);
    }

    /**
     * 直接购买
     * 跳转到提交订单页面
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function quickBuy(Request $request)
    {
        if (!$this->user_id) {
            return result(99, null, '需要登录');
        }

        $sku_id = $request->post('sku_id');
        $goods_id = $this->goods->getGoodsId($sku_id);
        $number = $request->post('number');
        // todo 对商品进行判断
        // 商品不存在
//        return result(-1,null,'商品不存在');

//        return result(0,null,'请跳转到结算页！');

        session(['user_buy_'.$this->user_id => ['buy_type'=>1,'goods_id'=>$goods_id,'sku_id'=>$sku_id,'number'=>$number]]); // 1-直接购买 将用户购买类型存入session 方便checkout页面判断

        $data = '/checkout.html'; // 提交订单页面url
        return result(0, $data);
    }
}