<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CheckoutRepository;
use App\Repositories\OrderInfoRepository;
use App\Repositories\PaymentLogicRepository;


/**
 * 支付异步回调
 *
 * Class RespondController
 * @package App\Modules\Frontend\Http\Controllers
 */
class NotifyController extends Frontend
{

    protected $orderInfo;

    protected $paymentLogic;

    protected $checkout;

    protected $payCode;


    public function __construct(
        OrderInfoRepository $orderInfo
        , PaymentLogicRepository $paymentLogic
        , CheckoutRepository $checkout)
    {
        parent::__construct();


        $this->orderInfo = $orderInfo;
        $this->paymentLogic = $paymentLogic;
        $this->checkout = $checkout;
    }

    /**
     * 支付宝异步通知
     */
    public function frontAlipay()
    {
        $this->payCode = 'alipay';

        $this->paymentLogic->notify($this->payCode);
    }

	/**
	 * 微信异步通知
	 */
	public function frontWeixin()
	{
		$this->payCode = 'weixin';

		$this->paymentLogic->notify($this->payCode);
	}

	/**
	 * unipay异步通知
	 */
	public function frontUnipay()
	{
		$this->payCode = 'unipay';

		$this->paymentLogic->notify($this->payCode);
	}

}
