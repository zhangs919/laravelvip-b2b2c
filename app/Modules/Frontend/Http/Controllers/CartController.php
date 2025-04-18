<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CartRepository;
use App\Repositories\CheckoutRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\GoodsSkuRepository;
use Illuminate\Http\Request;

class CartController extends Frontend
{

    protected $goods; // 商品模型

    protected $cart;

    protected $checkout; // 购买逻辑


    public function __construct(
        GoodsRepository $goods
        ,CartRepository $cart
        ,CheckoutRepository $checkout
    )
    {
        parent::__construct();

        $this->goods = $goods;
        $this->cart = $cart;
        $this->checkout = $checkout;

    }

    /**
     * 购物车列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cartList(Request $request)
    {

        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId($this->session_id);
        $hide_right_sidebar = true; // 是否隐藏右边栏
        $footer_type = 1; // 底部类型 short_footer

        // 猜你喜欢
        list($guess_goods_list, $guess_goods_list_total) = $this->goods->getGuessLikeGoods(1, 12);
        $guess_goods_list = array_chunk($guess_goods_list->toArray(), 4);

        if ($this->user_id) {
            // 先清空购买信息
            (new CheckoutRepository())->clearCheckoutData($this->user_id);
        }

        $this->show_seo('seo_index'); // SEO

        $cart = $this->cart->getShopCartData();
        $app_prefix_data = [
            'cart' => $cart,
            'shop_id' => 0,
            'user_id' => $this->user_id,
            'unpayed_list' => [],
            'guess_goods_list' => $guess_goods_list,
            'unpayed_count' => 0,
            'cross_border_identity' => '',
            'mini_cart_ids' => null,
            'select_cart_ids' => [],
        ];
        $compact_data = $app_prefix_data;
        $compact_data['hide_right_sidebar'] = $hide_right_sidebar;
        $compact_data['footer_type'] = $footer_type;
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact_data,
            'tpl_view' => 'cart.cart_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 购物车盒子数据
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function boxGoodsList(Request $request)
    {
    	$seo_title = '';
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId($this->session_id);
        $cart_goods_list = $this->cart->getCartGoodsList();

        $cart_price_info = $this->cart->getCartPriceInfo($cart_goods_list);
        if (is_pc_domain()) { // PC 端

            $renderTop = view('cart.dropdown_goods', compact('cart_goods_list', 'cart_price_info'))->render(); // 顶部购物车
            $renderRight = view('cart.cart_pannel', compact('cart_goods_list', 'cart_price_info'))->render(); // 右侧购物车
            $data = [
                $renderTop,
                $renderRight
            ];
            $extra = [
                'amount' => $cart_price_info['select_goods_amount'],
                'count' => $cart_price_info['count'],
            ];

            return result(0, $data,'', $extra);
        } elseif (is_mobile_domain()) { // h5端

            $extra = [
                'amount' => $cart_price_info['select_goods_amount'],
                'count' => $cart_price_info['count'],
                'cross_border_identity' => '',
                'dif_price' => null, //'-22221',
                'dif_price_format' => null, //'￥-22221.00',
                'select_goods_number' => $cart_price_info['goods_number'],
                'start_price' => '1.00',
                'start_price_format' => '￥1.00'
            ];
            $render = view('cart.dropdown_goods', compact('cart_goods_list', 'cart_price_info'))->render();


            return result(0, $render, '', $extra);
        } elseif (is_app()) {
			$app_extra_data = [
				'count' => $cart_price_info['count'],
				'amount' => $cart_price_info['goods_amount'],
				'type' => 1,
				'cart_count' => $cart_price_info['count'],
				'select_goods_number' => $cart_price_info['goods_number'],
				'select_goods_amount' => $cart_price_info['select_goods_amount'],
				'select_goods_amount_format' => '￥'.$cart_price_info['select_goods_amount'],
				'amount_format' => '￥'.$cart_price_info['goods_amount'],
				'cart_goods_list' => $cart_goods_list,
				'start_price' => null,
				'start_price_format' => null,
				'dif_price' => null,
				'dif_price_format' => null
			];

			$compact = compact('seo_title');
			$webData = []; // web端（pc、mobile）数据对象
			$data = [
				'app_extra_data' => $app_extra_data,
				'web_data' => $webData,
				'compact_data' => $compact,
				'tpl_view' => ''
			];
			$this->setData($data); // 设置数据
			return $this->displayData(); // 模板渲染及APP客户端返回数据
		}
    }

    /**
     * 加入购物车
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function add(Request $request)
    {
        // 验证登录
        if (!auth($this->getAuthType())->check()) {
            return result(99, null, '需要登录');
        }

        $goods_id = $request->post('goods_id', 0);
        $sku_id = $request->post('sku_id', 0);
        $number = $request->post('number');

        // 设置页面传入的参数
        $this->cart->setGoodsBuyNum($number);
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId($this->session_id);

        if ($goods_id) {
            $goods_info = $this->goods->getById($goods_id);
        }

        if ($sku_id) {
            // 有规格 选择了规格加入购物车操作
            $goods_id = $this->goods->getGoodsId($sku_id);
            $goods_info = $this->goods->getById($goods_id);
            $this->cart->setGoodsModel($goods_id);
            $this->cart->setGoodsSkuModel($sku_id);
            $cartTotal = $this->cart->getUserCartGoodsNum();
            $data = [
                'goods_number' => $number,
                'goods_price' => $goods_info->goods_price,
                'miniprogram_live_room_id' => null,
                'cart_total' => $cartTotal
            ];
        } else {
            $this->cart->setGoodsModel($goods_id);
            $sku_id = $this->goods->getSkuId($goods_id);

            // 判断 如果有库存id 则弹出选择规格框
            if ($sku_id) {
                // 默认sku
                // 商品规格列表
//                $spec_list = $this->goods->getGoodsSpecList($goods_info);
//                $sku = GoodsSku::where('sku_id',$sku_id)->first();
//                $sku = !empty($sku) ? $sku->toArray() : null;
//                $default_sku['specs'] = unserialize($default_sku['specs']);

                // 店铺信息
//                $shopRep = new ShopRepository();
//                $shop_info = $shopRep->shopInfo($goods_info->shop_id);
                // 商品SKU信息
                $goodsSkuRep = new GoodsSkuRepository();
                $sku = $goodsSkuRep->getCartGoodsSkuInfo($sku_id);

                if (!empty($sku['spec_ids'])) {
                    $uuid = make_uuid();
                    // 商品sku列表
                    $sku_list = $this->goods->getCartSkuList($goods_id);

                    // 规格列表
                    $spec_list = $this->goods->getGoodsSpecList($goods_info);
                    $goods_image = get_image_url($goods_info->goods_image)."?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320";
                    $app_data = [
                        'goods_number' => 1,
                        'miniprogram_live_room_id' => null,
                        'top_id' => '0',
                        'prop_open' => $goods_info->prop_open,
                        'prop_list' => null, // todo
                        'goods_id' => $goods_id,
                        'sku_list' => $sku_list,
                        'sku'=>$sku,
                        'spec_list'=>$spec_list,
                        'goods_image' =>$goods_image,
                        'shop_id'=>$goods_info->shop_id,
                        'sku_open'=>$goods_info->sku_open,
                        'goods_moq'=>$goods_info->goods_moq,
                        'show_goods_stock'=>'1',
                    ];
                    $web_compact = $app_data;
                    $web_compact['uuid'] = $uuid;
                    $web_compact['sku_list'] = json_encode($sku_list);

                    if (is_app()) {
                        return result(0, $app_data);
                    }

                    $render = view('cart.choose_sku', $web_compact)->render();
                    return result(98, $render);
                } else {
                    // 无规格 加入购物车操作
                    $data = [
                        'goods_number' => $number,
                        'goods_price' => $goods_info->goods_price,
                        'miniprogram_live_room_id' => null,
                        'prop_list' => [],
                        'prop_open' =>0,
                        'sku_open' => 0,
                        'top_id' => 0
                    ];
                }
            } else {
                // 无规格 加入购物车操作
                $data = [
                    'goods_number' => $number,
                    'goods_price' => $goods_info->goods_price,
                    'miniprogram_live_room_id' => null,
                    'prop_list' => [],
                    'prop_open' =>0,
                    'sku_open' => 0,
                    'top_id' => 0
                ];
            }
        }

        $result = $this->cart->addGoodsToCart();

        if ($result['code'] != 0) {
            return result($result['code'], $data, $result['message']);
        }

        return result($result['code'], $data, $result['message']);
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
        $this->cart->setUniqueId($this->session_id);

        $post = $request->input();
        $cart_ids = $post['cart_ids'];
        $goods_id = $post['goods_id'];
        if (isset($cart_ids) && !$cart_ids) {
            return result(-1, null, '购物车编号错误');
        }
        if (isset($goods_id) && !$goods_id) {
            return result(-1, null, '商品编号错误');
        }
        $ret = $this->cart->delete($cart_ids, $goods_id);
        if ($goods_id) {
            $goods_info = $this->goods->getById($goods_id);
        }

        if ($ret === false) {
            return result(-1, null, '删除失败！');
        }
        $data = [
            'count' => 0,
//            'goods_amount' => 0,
            'goods_number' => $this->cart->getUserCartGoodsNum(),
            'goods_price' => $goods_info->goods_price ?? 0,
            'goods_price_format' => "￥".($goods_info->goods_price ?? 0),
            'select_goods_amount' => 0,
            'select_goods_amount_format' => "￥0",
            'select_goods_number' => 0,
//            'shop_delivery_enable' => [
//                36 =>1
//            ],
            'submit_enable' => 1
        ];
        return result(0, $data, '删除成功！');
    }

    public function delete(Request $request)
    {
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId($this->session_id);

        $post = $request->input();
        $cart_ids = $post['cart_ids'];
        $goods_id = $post['goods_id'];
        if (isset($cart_ids) && !$cart_ids) {
            return result(-1, null, '购物车编号错误');
        }
        if (isset($goods_id) && !$goods_id) {
            return result(-1, null, '商品编号错误');
        }
        $ret = $this->cart->delete($cart_ids, $goods_id);

        if ($ret === false) {
            return result(-1, null, '删除失败！');
        }
        $cart = $this->cart->getShopCartData();
        $render = view('cart.partials._cart_list', compact('cart'))->render();
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
        $this->cart->setUniqueId($this->session_id);
        // 选中购物车商品
        $selectRet = $this->cart->cartSelect($cart_ids);
        if ($selectRet['code'] == -1) {
            return result(-1, '', $selectRet['message']);
        }
        $cart = $this->cart->getShopCartData();
        $render = view('cart.partials._cart_list', compact('cart'))->render();
        $extra = [
            'params' => $selectRet['data']
        ];

        return result(0, $render, '', $extra);
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
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId($this->session_id);
        $cart = $this->cart->getShopCartData();
        $data = [];
        if (!is_app()) {
            $data = view('cart.partials._cart_list', compact('cart'))->render();
        }

        if ($request->getHost() == config('lrw.mobile_domain') || is_app()) {
            // 手机端访问
            $goods_id = $this->goods->getGoodsId($sku_id);
            $goods_info = $this->goods->getById($goods_id);
            $params = [
                'count' => $cart['goods_number'],
                'goods_amount' => $cart['goods_amount'],
                'goods_number' => $cart['goods_number'],
                'goods_price' => $goods_info->goods_price ?? 0,
                'goods_price_format' => "￥".($goods_info->goods_price ?? 0),
                'select_goods_amount' => $cart['select_goods_amount'],
                'select_goods_amount_format' => "￥".$cart['select_goods_amount'],
                'select_goods_number' => $cart['select_goods_number'],
                'shop_delivery_enable' => [
                    36 =>1
                ],
                'submit_enable' => 1
            ];
            return result($ret['code'], $data, $ret['message'], [
//                'cart'=>$cart,
                'params'=>$params]);
        }
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
        // 先清空购买信息
        $this->checkout->clearCheckoutData($this->user_id);

        // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货
        // 将用户购买类型等信息存入session 方便checkout页面判断
        // 从购物车表中取当前登录用户的选中购物车商品列表
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId($this->session_id);
        $cart_list = $this->cart->getCartGoodsList(1); // 购物车数据
//        $cart_price_info = $this->cart->getCartPriceInfo($cart_list);
        $cart_id = [];
//        dd($cart_list);

        foreach ($cart_list as $v) {
            $cart_id[$v['shop_id']][] = $v['cart_id'].'|'.$v['sku_id'].'|'.$v['goods_number'];
        }

        $checkoutData = [
            'buy_type' => 0,
            'cart_id' => $cart_id
        ];
//        session(['user_buy_'.$this->user_id => $checkoutData]);
        $ret = $this->checkout->setCheckoutData($this->user, $checkoutData);
//        dd($ret);
        if (isset($ret['code']) && $ret['code'] == -1) {
            return result(-1, null, $ret['message']);
        }
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
        $goods_info = $this->goods->getOnSaleGoodsInfo($goods_id, $sku_id, $number);

        if (empty($goods_info)) {
            // 商品不存在
            return result(-1,null,'商品不存在');
        }

//        return result(0,null,'请跳转到结算页！');

        // 先清空购买信息
        $this->checkout->clearCheckoutData($this->user_id);


        // 设置购买信息
        $cart_id[$goods_info['shop_id']] = [$goods_id.'|'.$sku_id.'|'.$number];
        $checkoutData = [
            'buy_type' => 1,
            'cart_id' => $cart_id
        ];
        $ret = $this->checkout->setCheckoutData($this->user, $checkoutData);
        if (isset($ret['code']) && $ret['code'] == -1) {
            return result(-1, null, $ret['message']);
        }

        // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货
        // 将用户购买类型等信息存入session 方便checkout页面判断
//        session(['user_buy_'.$this->user_id => $userBuy]);

        $data = '/checkout.html'; // 提交订单页面url
        return result(0, $data);
    }

    /**
     * 将打包一口价商品加入到购物车
     * /frontend/web/index.php
     * /frontend/web_mobile/index.php
     *
     * @param Request $request
     * @return array
     */
    public function fixedPriceAdd(Request $request)
    {
        $goods_id_list = $request->post('goods_ids', []);
        $act_id = $request->post('act_id', null);
        if (empty($act_id) || empty($goods_id_list)) {
            abort(500, '无效的活动！');
        }
        $sku_ids = [];
        foreach ($goods_id_list as &$item) {
            $temp_list = explode(',', $item);
            foreach ($temp_list as &$value) {
                $temp_goods = explode('-', $value);
                $sku_ids[] = $temp_goods[1];
            }
        }

        $data = [
            'act_id' => $act_id,
            'sku_ids' => $sku_ids
        ];

        return result(0, $data, '加入购物车成功');
    }

    /**
     * 获取购物车商品数量
     *
     * @return array
     */
    public function getCartGoodsNum()
    {
        return result(0, $this->cart_goods_num);
    }
}
