<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2020-01-04
// | Description: 订单支付逻辑处理
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\OrderInfo;
use App\Models\ShopPayment;
use App\Services\Enum\AccountProcessTypeEnum;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yansongda\Pay\Pay;

class PaymentLogicRepository
{
    use BaseRepository;

    protected $config = [];
	protected $domain = '';

    public function __construct()
    {
		$payment = new PaymentRepository();
		$alipay_config = $payment->getPayConfig('alipay');
		$weixin_config = $payment->getPayConfig('weixin');
		$this->domain = request()->getSchemeAndHttpHost();

		$config = [
			'alipay' => [
				'default' => [
					// 必填-支付宝分配的 app_id
					'app_id' => '9021000133640369', // TODO 暂时固定
					// 必填-应用私钥 字符串或路径
					// 在 https://open.alipay.com/develop/manage 《应用详情->开发设置->接口加签方式》中设置
					'app_secret_cert' => $alipay_config['private_key'],
					// 必填-应用公钥证书 路径
					// 设置应用私钥后，即可下载得到以下3个证书
					'app_public_cert_path' => Storage::disk('local')->path('certs/pay/appPublicCert.crt'),
					// 必填-支付宝公钥证书 路径
					'alipay_public_cert_path' => Storage::disk('local')->path('certs/pay/alipayPublicCert.crt'),
					// 必填-支付宝根证书 路径
					'alipay_root_cert_path' => Storage::disk('local')->path('certs/pay/alipayRootCert.crt'),
					'return_url' => $this->domain.'/respond/front-alipay',
					'notify_url' => $this->domain.'/notify/front-alipay',
					// 选填-第三方应用授权token
					'app_auth_token' => '',
					// 选填-服务商模式下的服务商 id，当 mode 为 Pay::MODE_SERVICE 时使用该参数
					'service_provider_id' => '',
					// 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SANDBOX, MODE_SERVICE
					'mode' => Pay::MODE_SANDBOX, // TODO 暂时固定
				]
			],
			'wechat' => [
				'default' => [
					// 必填-商户号，服务商模式下为服务商商户号
					// 可在 https://pay.weixin.qq.com/ 账户中心->商户信息 查看
					'mch_id' => $weixin_config['mchid'],
					// 选填-v2商户私钥
					'mch_secret_key_v2' => '',
					// 必填-v3 商户秘钥
					// 即 API v3 密钥(32字节，形如md5值)，可在 账户中心->API安全 中设置
					'mch_secret_key' => $weixin_config['key'],
					// 必填-商户私钥 字符串或路径
					// 即 API证书 PRIVATE KEY，可在 账户中心->API安全->申请API证书 里获得
					// 文件名形如：apiclient_key.pem
					'mch_secret_cert' => $weixin_config['apiclient_key'],
					// 必填-商户公钥证书路径
					// 即 API证书 CERTIFICATE，可在 账户中心->API安全->申请API证书 里获得
					// 文件名形如：apiclient_cert.pem
					'mch_public_cert_path' => $weixin_config['apiclient_cert'],
					// 必填-微信回调url
					// 不能有参数，如?号，空格等，否则会无法正确回调
					'notify_url' => $this->domain.'/notify/front-weixin',
					// 选填-公众号 的 app_id
					// 可在 mp.weixin.qq.com 设置与开发->基本配置->开发者ID(AppID) 查看
					'mp_app_id' => '',
					// 选填-小程序 的 app_id
					'mini_app_id' => '',
					// 选填-app 的 app_id
					'app_id' => $weixin_config['appid'],
					// 选填-合单 app_id
					'combine_app_id' => '',
					// 选填-合单商户号
					'combine_mch_id' => '',
					// 选填-服务商模式下，子公众号 的 app_id
					'sub_mp_app_id' => '',
					// 选填-服务商模式下，子 app 的 app_id
					'sub_app_id' => '',
					// 选填-服务商模式下，子小程序 的 app_id
					'sub_mini_app_id' => '',
					// 选填-服务商模式下，子商户id
					'sub_mch_id' => '',
					// 选填-微信平台公钥证书路径, optional，强烈建议 php-fpm 模式下配置此参数
					'wechat_public_cert_path' => [
						'45F59D4DABF31918AFCEC556D5D2C6E376675D57' => Storage::disk('local')->path('wechatPublicKey.crt'),//__DIR__.'/Cert/wechatPublicKey.crt',
					],
					// 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SERVICE
					'mode' => Pay::MODE_NORMAL,
				]
			],
			'unipay' => [
				'default' => [
					// 必填-商户号
					'mch_id' => '777290058167151',
					// 必填-商户公私钥
					'mch_cert_path' => Storage::disk('local')->path('unipayAppCert.pfx'),//__DIR__.'/Cert/unipayAppCert.pfx',
					// 必填-商户公私钥密码
					'mch_cert_password' => '000000',
					// 必填-银联公钥证书路径
					'unipay_public_cert_path' => Storage::disk('local')->path('unipayCertPublicKey.cer'),//__DIR__.'/Cert/unipayCertPublicKey.cer',
					// 必填
					'return_url' => $this->domain.'/respond/front-unipay',
					// 必填
					'notify_url' => $this->domain.'/notify/front-unipay',
				],
			],
			'logger' => [
				'enable' => false,
				'file' => './logs/pay.log',
				'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
				'type' => 'single', // optional, 可选 daily.
				'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
			],
			'http' => [ // optional
				'timeout' => 5.0,
				'connect_timeout' => 5.0,
				// 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
			],
		];
		$this->config = $config;
    }

    /**
     * 去支付
     *
     * @param $orderInfo
     * @param int $payment_source 支付来源 0-商品订单 1-商家入驻支付订单 ***
     * @return mixed
     */
    public function toPay($orderInfo, $payment_source = 0)
    {

        $subject = sysconf('site_name') . '-' . (PAYMENT_SOURCE[$payment_source] ?? '订单支付');
        $order_sn = $orderInfo['order_sn'];
        $total_amount = $orderInfo['order_amount'];

        // pay_info:"<img src='http://qr.liantu.com/api.php?text=weixin://wxpay/bizpayurl?pr=q0uPrZb' alt='扫码支付'>"

		try {
			$pay_code = $orderInfo['pay_code'];
			switch ($pay_code) {
				case 'alipay': //支付宝
                    if ($payment_source == 1) {
                        $this->config['alipay']['default']['return_url'] = request()->getSchemeAndHttpHost().'/shop/apply/result.html';
                    }
					// todo 需要写一个方法 判断支付方式参数
//        abort(200, '银联支付参数错误：商户号不能为空！');
					Pay::config($this->config);

					$order = [
						'_config' => 'default', // 注意这一行
						'out_trade_no' => $order_sn,
						'total_amount' => $total_amount, // ** 微信支付的单位：分** **其他支付的单位：元**
						'subject' => $subject,
						'passback_params' => urlencode("payment_source={$payment_source}") // 额外参数 异步回调使用
					];
					// 判断客户端
					if (is_mobile_domain()) {
						// mobile 访问
						$alipay = Pay::alipay()->wap($order);
					} elseif (is_pc_domain()) {
						if (is_app()) {
							// app客户端
							$alipay = Pay::alipay()->app($order);
						} else {
							// pc端
							$alipay = Pay::alipay()->web($order);
						}
					}

					return $alipay;// laravel 框架中请直接 `return $alipay`


				case 'union'://银联支付

					break;

				case 'weixin'://微信支付
					Pay::config($this->config);

					$order = [
						'_config' => 'default', // 注意这一行
						'out_trade_no' => $order_sn,
						'total_fee' => $total_amount * 100, // ** 微信支付的单位：分** **其他支付的单位：元**
						'body' => $subject,
						'openid' => 'o4Kp800BMtwNp8K7fc84c0ypdlqs', // 云 我的微信
					];

					// 判断客户端
					if (request()->getHost() == config('lrw.mobile_domain')) {
						// m.lrw.com 访问
						$pay = Pay::wechat()->mp($order);
						return $pay;
					} elseif (request()->getHost() == config('lrw.frontend_domain')) {
						// pc端
						$pay = Pay::wechat()->scan($order);

						$result = [
							'pay' => $pay,
							'subject' => $subject,
							'total_fee' => $total_amount
						];
						return $result;
					}

					break;

				case 'app_weixin'://APP微信支付
					Pay::config($this->config);

					$order = [
						'_config' => 'default', // 注意这一行
						'out_trade_no' => $order_sn,
						'total_fee' => $total_amount * 100, // ** 微信支付的单位：分** **其他支付的单位：元**
						'body' => $subject,
						'openid' => 'o4Kp800BMtwNp8K7fc84c0ypdlqs', // 云 我的微信
					];
					$pay = Pay::wechat()->app($order);
					return $pay;
                case '0': // 余额支付-全部用余额支付
                    if ($orderInfo['money_paid'] > 0 || $orderInfo['surplus'] <= 0) {
                        // 金额异常
                        return arr_result(-1, null, '余额支付金额异常');
                    }
                    // 直接余额扣款
                    $result = $this->balancePay($orderInfo);
                    if (!$result) {
                        return arr_result(-1, null, '余额支付失败');
                    }
                    return arr_result(0, null, '余额支付成功');
				default:
					break;
			}

			// // 微信支付
			//        /**
			//         * // 微信公众号支付 ok
			//         * "appId" => "wxccf534554adf5313"
			//            "timeStamp" => "1552402566"
			//            "nonceStr" => "B6On3S5btRWRKeqG"
			//            "package" => "prepay_id=wx12225610573212f85f517c8f2497436640"
			//            "signType" => "MD5"
			//            "paySign" => "9FF0E87371F17EC55F8DBF104DA73DE5"
			//         */
			////        $pay = Pay::wechat($this->config['wechat'])->mp($order);
			//
			////        dd($pay);
			//
			//        // $pay->appId
			//        // $pay->timeStamp
			//        // $pay->nonceStr
			//        // $pay->package
			//        // $pay->signType
		} catch (\Exception $e) {
			abort(200, $e->getMessage());
		}



    }

    /**
     * 余额支付
     *
     * @param array $orderInfo 订单信息
     * @return mixed
     */
    private function balancePay($orderInfo)
    {
        try {
            // 更新订单状态
            $this->_updateOrder($orderInfo['order_sn']);
            return true;
        } catch (\Exception $e) {

            return false;
        }
    }

    /**
     * 检查是否已支付
     *
     * @param $order_sn
     * @param int $payment_source 支付来源
     * @return bool
     */
    public function checkIsPay($order_sn, $payment_source = 0)
    {
        switch ($payment_source) {
            case 1: // 商家入驻缴费支付
                $orderInfo = ShopPayment::where('pay_id', $order_sn)
                    ->orderBy('pay_id', 'desc')->first();
                if ($orderInfo['pay_status'] == 1) {
                    return true;
                }
                return false;
                break;

            default: // 订单支付
                $orderInfo = OrderInfo::where('order_sn', $order_sn)
                    ->select(['order_id', 'order_sn', 'order_status', 'pay_status', 'order_amount', 'money_paid'])
                    ->first();
                if ($orderInfo['order_status'] == OS_CONFIRMED && $orderInfo['pay_status'] == PS_PAYED) {
                    return true;
                }
                return false;
                break;
        }
    }

	/**
	 * 支付异步通知
	 *
	 * @param $pay_code
	 * @return \Psr\Http\Message\ResponseInterface
	 * @throws \Yansongda\Pay\Exception\ContainerException
	 */
    public function notify($pay_code)
    {
		Log::stack(['api'])->info("---notify0 ".$pay_code);

        switch ($pay_code) {
            case 'alipay':
				Pay::config($this->config);
				Log::stack(['api'])->info("---notify2 ".$pay_code);

				Pay::alipay($this->config['alipay']);
				Log::stack(['api'])->info("---notify3 ".$pay_code);

                try {
                    $data = Pay::alipay()->callback(); // 是的，验签就这么简单！
                    // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
                    // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
                    // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
                    // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
                    // 4、验证app_id是否为该商户本身。
                    // 5、其它业务逻辑情况

                    $params = $data->all();
					Log::stack(['api'])->info("---notify33 ".json_encode($data));

                    $out_trade_no = $params['out_trade_no']; // 商户订单号
                    $trade_no = $params['trade_no']; // 支付宝交易号

                    // 额外参数解析成数组 格式：a=1&b=2
                    Log::stack(['api'])->info("---notify0 ".urldecode($params['passback_params']));

                    parse_str(urldecode($params['passback_params']), $passback_params);
                    Log::stack(['api'])->info("---notify ".json_encode($passback_params));

                    $payment_source = $passback_params['payment_source'] ?? 0; // 支付来源 默认为：0-订单支付
                    Log::stack(['api'])->info("---notify $payment_source");
                    $res = $this->_updateOrder($out_trade_no, $trade_no, $payment_source);

                    if (!$res) {
                        throw new \Exception('订单状态修改失败');
                    }

                } catch (\Exception $e) {
                    // $e->getMessage();
					Log::stack(['api'])->info("---notify0 ".$e->getMessage());
					throw new \Exception($e->getMessage());
                }

                return Pay::alipay()->success();// laravel 框架中请直接 `return $alipay->success()

            case 'weixin':
				// todo

                break;

			case 'unipay':

				break;

            default:

                break;
        }


    }

	/**
	 * 支付同步通知
	 *
	 * @param $pay_code
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function return($pay_code)
	{
		switch ($pay_code) {
			case 'alipay':
				Pay::config($this->config);
				Pay::alipay($this->config['alipay']);
				try {
					// 获取数据
					$data = Pay::alipay()->callback(); // 是的，验签就这么简单！

					return $data;
				} catch (\Exception $e) {
					// $e->getMessage();
				}
				break;

			case 'weixin':

				break;

			case 'unipay':

				break;

			default:

				break;
		}


	}

    /**
     * 更新订单信息
     * @param string $out_trade_no 商户订单号
     * @param string $trade_no 支付宝交易号
     * @param int $payment_source 支付来源
     * @return bool
     */
    private function _updateOrder($out_trade_no, $trade_no = '', $payment_source = 0)
    {
        switch ($payment_source) {
            case 1: // 商家入驻缴费支付
                $orderInfo = ShopPayment::where('pay_id', $out_trade_no)
                    ->orderBy('pay_id', 'desc')->first();
                // 防止重复支付
                if ($orderInfo['pay_status'] == 1) {
                    return true;
                }
                // 修改订单状态
                $orderInfo->pay_time = time();
                $orderInfo->pay_status = 1;
                $result = $orderInfo->update();
                Log::stack(['api'])->info("---notify2 $result");

                if ($result) {
                    // 推送APP消息

                }

                return $result;
                break;

            default: // 订单支付
                // 验证订单信息
                $order_info = OrderInfo::where('order_sn', $out_trade_no)
//            ->select(['order_id','order_sn','order_status','pay_status','order_amount','money_paid'])
                    ->first();
                if (empty($order_info)) {
                    return false;
                }
                $order_info = $order_info->toArray();

                // 防止重复支付
                if ($order_info['order_status'] == OS_UNCONFIRMED && $order_info['pay_status'] == PS_PAYED) {
                    return true;
                }

                $post = [
                    'trade_no' => $trade_no
                ];

                // 修改订单状态
                $orderInfoLogic = new OrderInfoLogicRepository();
                $result = $orderInfoLogic->changeOrderReceivePay($order_info, 'buyer', 'system', $post);

                if ($result) {
                    // 推送APP消息

                }

                return $result;
                break;
        }


    }

}
