<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\Request;

class PaymentController extends Frontend
{


    public function __construct()
    {
        parent::__construct();


    }

    public function payment(Request $request)
    {
        $order_sn = $request->get('order_sn');
        $seo_title = '结算页面';

        return view('payment.payment', compact('seo_title'));
    }

    public function checkIsPay(Request $request)
    {
        $order_sn = $request->get('order_sn');

        return result(1, null); // 未支付
    }
}