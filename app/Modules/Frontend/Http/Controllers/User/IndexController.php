<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\CartRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class IndexController extends UserCenter
{

    protected $cart;
    protected $goods;

    public function __construct()
    {
        parent::__construct();

        $this->cart = new CartRepository();
        $this->goods = new GoodsRepository();

    }

    public function center(Request $request)
    {
        $seo_title = '用户中心';

        // 购物车列表
        $this->cart->setUserId($this->user_id);
        $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);
        $user_cart_list = $this->cart->getCartList(); // 购物车数据
        $user_cart_num = 0;
        foreach ($user_cart_list as $cart) {
            $user_cart_num += $cart['goods_number'];
        }

        // 我的足迹
        list($goods_history, $goods_history_total) = $this->goods->getGoodsHistory([], 6, [['user_id', $this->user_id]]);

        $compact = compact('seo_title', 'user_cart_list','user_cart_num', 'goods_history', 'goods_history_total');

        return view('user.index.center', $compact);
    }


}