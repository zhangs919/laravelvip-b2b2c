<?php

namespace App\Modules\Seller\Http\Controllers\Index;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;

class IndexController extends Seller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 欢迎页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome(Request $request)
    {
        $title = '欢迎页';
        $shop_info = seller_shop_info();
        return view('index.index.welcome', compact('title', 'shop_info'));
    }

    public function getData()
    {

        $data = [
            'after_sale_order_count'=> '6',
            'backing_order_count' => '2',
            'exchange_order_count'=> '0',
            'illegal_goods_count' => '10',
            'involve_complaint_count' => '0',
            'live_enable' => false,
            'offsale_goods_count' => '221',
            'onsale_goods_count' => '5',
            'today_gains' => 0,
            'today_order_count' => '0',
            'today_users_count' => '0',
            'unevaluate_order_count' => '43',
            'unpayed_order_count' => '0',
            'unshipping_order_count' => '11',
            'wait_audit_goods_count' => '0',
            'wait_complaint_count' => '0',
        ];
        return $data;
    }

    public function showMessage()
    {

        return result(0, 1);
    }

    public function expirationReminding()
    {
        return result(1);

    }

    public function guide()
    {
        $title = '新手向导';
        $fixed_title = '新手向导';
        $blocks = [
            'fixed_title' => $fixed_title,
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('index.index.guide', compact('title'));
    }

    public function sellerGuide(Request $request)
    {
        $render = view('index.index.seller_guide')->render();
        return result(0, $render);
    }

    public function guideShow(Request $request)
    {
        $data = $request->get('data');
        if ($data == 1) {
            // todo 店铺指引 设置不显示

        } else {
            // data = 0 店铺指引 设置显示

        }
    }
}