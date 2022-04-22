<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use Illuminate\Http\Request;

class ScanCodeController extends UserCenter
{

    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $seo_title = '用户中心';

        $compact = compact('seo_title');

        return view('user.scan-code.index', $compact);
    }

    /**
     * 监听支付状态
     *
     * @param Request $request
     * @return array
     */
    public function listening(Request $request)
    {
        $id = $request->get('id');

        $data = [
            'amount' => '0.00',
            'code' => '801550381084222222',
            'id' => $id,
            'order_sn' => null,
            'pay_user_id' => 0,
            'shop_id' => '55',
            'status' => 0,
            'type' => 0,
            'user_id' => 2,
            'valid_time' => 1550381204
        ];

        return result(0, $data, '未支付');
    }

    public function getCode(Request $request)
    {
        $status = $request->post('status');
        $amount = $request->post('amount');

        $data = [
            'amount' => '0.00',
            'code' => '901550381084222222',
            'code_format' => '9015********1112',
            'id' => 921,
            'order_sn' => null,
            'pay_user_id' => 0,
            'shop_id' => '55',
            'status' => 0,
            'type' => 0,
            'user_id' => 2,
            'valid_time' => 1550381204
        ];

        return result(0, $data);
    }

}