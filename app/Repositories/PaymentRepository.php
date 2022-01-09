<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Payment();
    }

    /**
     * PC 获取支付方式列表
     *
     * @param string $checked_pay_code 选中的支付方式代码 $checked_pay_code
     * @return array
     */
    public function getPaymentList($checked_pay_code = '', $client = 'pc')
    {
        $condition = [
            'where' => [],
            'limit' => 0
        ];
        list($list, $total) = $this->getList($condition);
        $payment_list = [];
        foreach ($list as $k=>$v) {
            if ($client == 'pc') {
                // PC端支付 alipay union weixin
                if (!in_array($v->pay_code,['alipay','union','weixin'])) {
                    unset($list[$k]);
                    break;
                }
            }
            // todo WAP端支付
            // todo 微信端支付
            // todo APP端支付

            $payment_list[] = [
                'checked' => $v->pay_code == $checked_pay_code ? "checked" : "",
                'code' => $v->pay_code,
                'disabled' => $v->is_enable == 1 ? 0 : 1,
                'id' => $v->pay_id,
                'name' => $v->pay_name,
                'tips' => ""
            ];
        }

        $offpay = [
            'checked' => $checked_pay_code == 'cod' ? "checked" : "",
            'code' => "cod",
            'disabled' => 0,
            'id' => -1,
            'name' => "货到付款",
            'tips' => ""
        ];

        array_unshift($payment_list, $offpay);

        return $payment_list;
    }
}