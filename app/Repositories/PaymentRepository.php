<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Common\BaseRepository as Base;

class PaymentRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Payment();
    }

	/**
	 * 根据支付方式code获取支付方式配置 格式：key-value
	 *
	 * @param string $pay_code 支付方式code
	 * @return array
	 */
	public function getPayConfig($pay_code)
	{
		$res = $this->model->getByField('pay_code', $pay_code);
		$pay_config = unserialize($res->pay_config);
		$list = [];
		foreach ($pay_config as $item) {
			$list[$item['pay_name']] = $item['config_value'];
		}

		return $list;
	}

    /**
     * 根据支付方式code获取支付方式id
     *
     * @param string $pay_code 支付方式code
     * @return null
     */
    public function getPayIdByPayCode($pay_code)
    {
        if ($pay_code == 'cod') { // 货到付款
            return '-1';
        }
        $pay_id = $this->model->where('pay_code', $pay_code)->value('pay_id');
        if (empty($pay_id)) {
            return null;
        }
        return $pay_id;
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
                    continue;
                }
            }
            // todo WAP端支付
            // todo 微信端支付
            // todo APP端支付


            $checked = $v->pay_code == $checked_pay_code ? "checked" : "";
            if ($client == 'pc') {
                if (empty($checked_pay_code) && array_first($list) == $v) {
                    // 默认选中第一个
                    $checked = "checked";
                }
            }
            $payment_list[] = [
                'checked' => $checked,
                'code' => $v->pay_code,
                'disabled' => $v->is_enable == 1 ? 0 : 1,
                'id' => $v->pay_id,
                'name' => $v->pay_name,
                'tips' => "" //本次订单此支付方式需要额外支付￥2。
            ];
        }

        // todo 货到付款是受商品影响决定是否展示，余额支付受账户是否有余额影响决定是否展示
        $offpay = [
            'checked' => $checked_pay_code == 'cod' ? "checked" : "",
            'code' => "cod",
            'disabled' => 1,  // todo 暂时不展示货到付款方式 后期做好了该功能再展示
            'id' => -1,
            'name' => "货到付款",
            'tips' => ""
        ];

        array_unshift($payment_list, $offpay);

        return $payment_list;
    }

    /**
     * 取得支付方式id列表
     * @param bool $is_cod 是否货到付款
     * @return  array
     */
    public function paymentIdList($is_cod)
    {
        $res = Payment::select('pay_id')->whereRaw(1);

//        if ($is_cod) {
//            $res = $res->where('is_cod', 1);
//        } else {
//            $res = $res->where('is_cod', 0);
//        }

        $res = Base::getToArrayGet($res);
        $res = Base::getKeyPluck($res, 'pay_id');

        return $res;
    }

}
