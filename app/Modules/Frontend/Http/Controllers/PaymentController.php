<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\OrderInfo;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CheckoutRepository;
use App\Repositories\OrderInfoRepository;
use App\Repositories\PaymentLogicRepository;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yansongda\Pay\Pay;

class PaymentController extends Frontend
{

    protected $orderInfo;

    protected $paymentLogic;

    protected $checkout;



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
     * 支付页面
     *
     * @param Request $request
     * @return mixed
     */
    public function payment(Request $request)
    {
        // 合并支付单号：MP202001041512549732598 或 订单编号：202001041512549732592
        $order_sn = $request->get('order_sn');
        $area_tag = $request->get('area_tag');

        // todo 判断order_sn 如果是合并支付订单号
        // 则通过合并支付订单号获取系统中真实的order_sn编号，并通过该订单编号查询订单信息

        $seo_title = '微信支付';

        // 获取数据

        if (!preg_match('/^\d{20}$/',$order_sn)){
            abort(200, '无效的订单');
        }

        $order_info = OrderInfo::where([
            ['order_sn', $order_sn],
            ['user_id',$this->user_id]
        ])->with(['shop'])->first();

        if (empty($order_info)) {
            abort(200, '无效的订单');
        }

        $order_info = $order_info->toArray();


        // 第三方支付逻辑方法
        $payResult = $this->paymentLogic->toPay($order_info);

        if (!is_array($payResult) && $order_info['pay_code'] != 'weixin') {
            return $payResult;
        }
        // 余额支付 跳转支付结果页
        if ($order_info['money_paid'] <= 0 || $order_info['surplus'] > 0) {
            $redirect_url =url('/checkout/result.html?order_sn='.$order_sn);
            return redirect($redirect_url);
        }
        if ($order_info['pay_code'] == 'weixin') {
            if (is_weixin()) {
                // 微信端
                $app_prefix_data = [];
                $compact = compact('seo_title','payResult','order_sn');
            } else {
                // PC
                $subject = $payResult['subject'];
                $total_fee = $payResult['total_fee'];

                // 微信扫码支付
                $wxpay_code_url = $payResult['pay']['code_url']; // 'weixin://wxpay/bizpayurl?pr=zU16z6U';
                $pay_info = '<img src="'.route('pc_qrcode', ['url'=>$wxpay_code_url]).'" alt="扫码支付">';
                $pay_type = 0;

                // 根据不同支付方式 返回不同的 app_prefix_data
                $app_prefix_data = [
                    'pay_info' => $pay_info,
                    'subject' => $subject,
                    'total_fee' => $total_fee,
                    'order_sn' => $order_sn,
                    'order_info' => $order_info,
                    'pay_type' => $pay_type
                ];

                $compact = compact('seo_title','pay_info','subject','total_fee','order_sn','order_info','pay_type');
            }
        } else {
            $app_prefix_data = [];
            $compact = compact('seo_title','payResult','order_sn');
        }


        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'payment.payment'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 检查支付状态
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function checkIsPay(Request $request)
    {
        $order_sn = $request->get('order_sn');
        $payment_source = $request->get('payment_source', 0); // 支付来源

        // 检查支付状态 当支付成功 则返回支付成功
        $is_paid = $this->paymentLogic->checkIsPay($order_sn, $payment_source); // 是否已完成支付
        if (!$is_paid) {
            return result(1, null); // 未支付
        }

        // 完成支付 跳转到支付结果页面
        // key 订单信息加密后的key todo ??
        $key = md5('abc');
//        $key = $this->checkout->getCheckoutData('key');
        $redirect_url = url('/checkout/result.html?key='.$key);
        return result(0, null, '支付成功', ['url'=>$redirect_url]);

    }

    /**
     * 生成支付二维码
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function qrCode(Request $request)
    {

        $url = $request->get('url');
        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(124)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
            ->margin(0)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }
}