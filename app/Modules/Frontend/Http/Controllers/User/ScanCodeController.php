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

		$params = $request->all();


		// 获取数据
		$user_info = $this->user;
		$model = [
			'id' => 61,
			'code' => '891542002812999713',
			'type' => 0,
			'amount' => 0,
			'valid_time' => 1542002932,
			'user_id' => 0,
			'status' => 0,
			'pay_user_id' => 0,
			'order_sn' => '',
		];
		$scan_code_bgcolor = '';
		$scan_code_bgimage = '';

		$compact = compact('seo_title','user_info', 'model', 'scan_code_bgcolor', 'scan_code_bgimage');

		$webData = []; // web端（pc、mobile）数据对象
		$data = [
			'app_prefix_data' => [
				'user_info' => $user_info,
				'model' => $model,
				'scan_code_bgcolor' => $scan_code_bgcolor,
				'scan_code_bgimage' => $scan_code_bgimage
			],
			'app_suffix_data' => [],
			'web_data' => $webData,
			'compact_data' => $compact,
			'tpl_view' => 'user.scan-code.index'
		];
		$this->setData($data); // 设置数据
		return $this->displayData(); // 模板渲染及APP客户端返回数据
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
