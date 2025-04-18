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
// | Date:2024-04-18
// | Description: 店铺入驻控制器
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\PaymentLogicRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ShopApplyRepository;
use App\Repositories\ShopClassRepository;
use App\Repositories\ShopPaymentRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ShopApplyController extends Frontend
{

    protected $shop;
    protected $shopClass;
    protected $shopApply;
    protected $shopPayment;
    protected $payment;
    protected $paymentLogic;

	protected $need_auth = true;

    public function __construct(
        ShopRepository $shop
        ,ShopClassRepository $shopClass
        ,ShopApplyRepository $shopApply
        ,ShopPaymentRepository $shopPayment
        ,PaymentRepository $payment
        ,PaymentLogicRepository $paymentLogic
    )
    {
        parent::__construct();

        $this->shop = $shop;
        $this->shopClass = $shopClass;
        $this->shopApply = $shopApply;
        $this->shopPayment = $shopPayment;
        $this->payment = $payment;
        $this->paymentLogic = $paymentLogic;
    }

    /**
     * 入驻申请首页
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apply(Request $request)
    {
        $seo_title = '入驻申请-首页';

        // 获取数据

        /*
         * 入驻进度
         * 0未进行任何店铺入驻步骤
         * 1
         * 2开店申请已提交,等待平台审核通过
         * 3
         * 4 支付开店款项
         * 5 开店成功
         */
        $progress = $this->shop->checkShopApplyProcess($this->user_id); //

        if ($progress > 0 && !is_app()) {
            return redirect('/shop/apply/result.html');
        }

        // PC端数据
        // 入驻轮播图（pc端）
        $shop_apply_banner_img = explode('|', sysconf('shop_apply_banner_img'));
        $pc_shop_guest_list_asc = $this->article->getShopApplyArticles(23, 2, 'asc'); // 入驻指南顺序排列
        $pc_shop_guest_list_desc = $this->article->getShopApplyArticles(23, 4, 'desc'); // 入驻指南倒序排列

        // APP端数据
        $shop_guest_list_asc = $this->article->getShopApplyArticles(23, 5, 'asc'); // 入驻指南顺序排列
        $shop_guest_list_desc = $this->article->getShopApplyArticles(23, 5, 'desc'); // 入驻指南倒序排列
        $info_notice_list = $this->article->getShopApplyArticles(24, 5, 'asc',['article_id','title']); // 信息公告
        // 入驻背景图（wap端）
        $banner_img = [sysconf('m_shop_apply_banner_img')];
        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);
        $seller_protocol = sysconf('seller_protocol'); // 店铺入驻协议

        $compact = compact('seo_title','progress','shop_apply_banner_img','pc_shop_guest_list_asc','pc_shop_guest_list_desc','info_notice_list');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'progress' => $progress,
                'shop_guest_list_asc' => $shop_guest_list_asc,
                'shop_guest_list_desc' => $shop_guest_list_desc,
                'info_notice_list' => $info_notice_list,
                'banner_img' => $banner_img,
                'cat_list' => $cat_list,
                'seller_protocol' => $seller_protocol,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.apply'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function agreement(Request $request)
    {
        $seo_title = '入驻申请-入驻协议';

        // 获取数据
        $seller_protocol = sysconf('seller_protocol'); // 店铺入驻协议

        $compact = compact('seo_title', 'seller_protocol');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'seller_protocol' => $seller_protocol,
                'title' => $seo_title
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.agreement'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 入驻申请-手机认证
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function register(Request $request)
    {
        $seo_title = '入驻申请-手机认证';


        // 获取数据
        $user_info = $this->user;

        $compact = compact('seo_title','user_info');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'user_info' => $user_info,
                'title' => $seo_title
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.register'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 入驻申请-开店类型选择
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function agreementType1(Request $request)
    {
        $seo_title = '入驻申请-开店类型选择';
        // 店铺入驻 缓存信息
        $shop_cache = Cache::get('shop_apply_info_'.$this->user_id);
		if (empty($shop_cache)) {
			$shop_cache = [
				'shop' => [
					'user_id' => $this->user_id,
					'is_supply' => 0,
					'shop_type' => 1
				],
				'shop_field_value' => [

				]
			];
		}
        $is_supply = isset($shop_cache['shop']['is_supply']) ? $shop_cache['shop']['is_supply'] : 0;
        $shop_type = isset($shop_cache['shop']['shop_type']) ? $shop_cache['shop']['shop_type'] : 1;
        // 获取数据

        $compact = compact('seo_title', 'shop_cache');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'is_supply' => $is_supply,
                'ongoing' => 1,
                'title' => $seo_title
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.agreement_type1'
        ];

        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据

    }

    /**
     * 入驻申请-填写个人/企业信息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function authInfo(Request $request)
    {
        $is_supply = $request->get('is_supply',0); // 是否入驻供货商 0零售商 1供货商
        $shop_type = $request->get('shop_type',2); // 开店类型 1个人店铺 2企业店铺
        $seo_title = '';

        // 将信息写入cache
        $cacheData = [
            'shop' => [
                'user_id' => $this->user_id,
                'is_supply' => (int)$is_supply,
                'shop_type' => (int)$shop_type
            ],
            'shop_field_value' => [

            ]
        ];
        Cache::put('shop_apply_info_'.$this->user_id, $cacheData, 30);

        if ($request->method() == 'POST') {
            $shopFieldValueInsert = $request->post();

            $shopInsert['user_id'] = $this->user_id;
            $shopInsert['shop_type'] = $shop_type;
            $shopInsert['is_supply'] = $is_supply;

            if (is_app()) {
                $shopApplyModel = $request->post('ShopApplyModel');
                $cat_ids = $shopApplyModel['cat_ids'] ?? [];
                if (empty($cat_ids)) {
                    return result(-1, [], '请选择店铺分类');
                }
                $duration = $shopApplyModel['duration'] ?? '1-year-0';
                $shopApplyModel['cat_ids'] = implode(',', $cat_ids);
                $shopApplyModel['cat_id'] = $shopApplyModel['cat_ids'][0] ?? 0;
                $duration_arr = explode('-', $duration);
                $shopApplyModel['duration'] = $duration_arr[0];
                $shopApplyModel['unit'] = str_replace(['year','month','day'],[0,1,2], $duration_arr[1]);
                $shopApplyModel['system_fee'] = isset($duration_arr[2]) ? $duration_arr[2] : '0.00';
                $shopApplyModel['insure_fee'] = sysconf('base_fee'); // 平台保证金
                $shopApplyModel['user_id'] = $this->user_id;
                $ret = $this->shopApply->apply($shopInsert,$shopFieldValueInsert,$shopApplyModel);
                if (!$ret) {
                    return result(-1, '', '店铺信息保存失败2');
                }

                return result(0, [], '提交成功');
            } else {
                $ret = $this->shop->addShop($shopInsert, $shopFieldValueInsert);
                if (!$ret) {
                    flash('error', '店铺信息保存失败');
                    return back();
                }
                return redirect('/shop/apply/shop-info.html');
            }
        }

        // 获取数据
        $user_info = $this->user;
        $idcard_demo_image = explode('|', sysconf('idcard_demo_image'));
        $company_demo_image = explode('|', sysconf('company_demo_image'));

        $app_prefix_data['user_info'] = $user_info;

        if ($shop_type == 2) {
            $seo_title = '入驻申请-填写个人信息';
            $model = [
                'real_name' => null,
                'card_no' => null,
                'special_aptitude' => null,
                'special_aptitude1' => null,
                'special_aptitude2' => null,
                'hand_card' => null,
                'card_side_a' => null,
                'card_side_b' => null,
                'address' => null,
            ];
            $app_prefix_data['model'] = $model;
            $app_prefix_data['idcard_demo_image'] = $idcard_demo_image;

        } elseif ($shop_type == 1) {
            $seo_title = '入驻申请-填写企业信息';
            $model = [
                'company_name' => null,
                'unified_social_credi' => null,
                'artificial_person' => null,
                'card_no' => null,
                'license' => null,
                'special_aptitude' => null,
                'special_aptitude1' => null,
                'special_aptitude2' => null,
                'card_type' => null,
                'card_side_a' => null,
                'card_side_b' => null,
            ];
            $app_prefix_data['model'] = $model;
            $app_prefix_data['idcard_demo_image'] = $idcard_demo_image;
            $app_prefix_data['company_demo_image'] = $company_demo_image;
        }
        $app_prefix_data['title'] = $seo_title;



        $pc_data = $app_prefix_data;
        $compact = compact('seo_title', 'is_supply', 'shop_type', 'pc_data');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.auth_info'.$shop_type
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 入驻申请-完善店铺信息
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function shopInfo(Request $request)
    {
        $seo_title = '入驻申请-完善店铺信息';

        // 获取店铺分类列表
        $where = [];
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($cat_list, $total) = $this->shopClass->getList($condition, '', false, true);
        $use_fee_value = unserialize(sysconf('use_fee_value'));

        if ($request->method() == 'POST') {
            $shopApplyModel = $request->post('ShopApplyModel');
            $shopApplyModel['cat_ids'] = implode(',', $request->post('cat_ids'));
            $duration_arr = explode('-', $shopApplyModel['duration']);
            $shopApplyModel['duration'] = $duration_arr[0];
            $shopApplyModel['unit'] = str_replace(['year','month','day'],[0,1,2], $duration_arr[1]);
            $shopApplyModel['system_fee'] = isset($duration_arr[2]) ? $duration_arr[2] : '0.00';
            $shopApplyModel['insure_fee'] = sysconf('base_fee'); // 平台保证金
            $shopApplyModel['user_id'] = $this->user_id;
            $ret = $this->shopApply->addData($shopApplyModel);
            if (!$ret) {
                return result(-1, '', '店铺信息保存失败');
            }
            return redirect('/shop/apply/result.html');
        }

        // 获取店铺信息
        $shop_info = $this->shop->getByField('user_id', $this->user_id);

        if (empty($shop_info)) {
            abort(200, '店铺申请信息不存在。');
        }

        $compact = compact('seo_title', 'cat_list', 'use_fee_value', 'shop_info');

        return view('shop.shop_info', $compact);
    }

    /**
     * 入驻申请-提示页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function result(Request $request)
    {
        $seo_title = '入驻申请-提示页';
        $shop = $this->shop->getByField('user_id', $this->user_id);
        if (empty($shop)) {
            return redirect('/shop/apply/index.html');
        }

        $type = $request->get('type');

        // 获取数据
        /*
         * 开店进度
         * 0未申请开店
         * 1
         * 2开店申请已提交,等待平台审核通过
         * 3
         * 4平台审核通过,等待支付开店款项
         * 5开店成功
         */
        $progress = $this->shop->checkShopApplyProcess($this->user_id);

        $shop = $shop->toArray();
        $pay_list = $this->payment->getPaymentList();

        $compact = compact('seo_title','type','progress','shop','pay_list');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'progress' => $progress,
                'shop' => $shop,
                'is_result' => true,
                'title' => $seo_title,
                'ad_image' => '',
                'ad_url' => '',
                'pay_list' => $pay_list
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.result'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 撤销开店申请
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function cancel(Request $request)
    {
        $user_id = $this->user_id;
        $ret = $this->shopApply->cancelShopApply($user_id);
        if (!$ret) {
            flash('error','撤销开店申请失败！');
            return back();
        }

        // 撤销开店申请成功
        flash('success','撤销开店申请成功！');
        return redirect('/shop/apply/index.html');
    }

    // 开店申请 付款
    public function pay(Request $request)
    {
        $amount = $request->post('amount'); // 付款金额
        $paycode = $request->post('paycode'); // 付款方式

        if (empty($paycode)) {
            return result(-1, null, '请选择支付方式');
        }

        // 验证付款金额正确性 取shoppApply信息
        $shopApplyInfo = DB::table('shop_apply')
            ->where([['pay_status',0],['user_id',$this->user_id]])
//            ->where('user_id',$this->user_id)
            ->first();
        if (empty($shopApplyInfo)) {
            return result(-1,null,INVALID_PARAM);
        }
        if ($amount != ($shopApplyInfo->system_fee + $shopApplyInfo->insure_fee)) {
            return result(-1,null,'非法金额');
        }

        $shopPaymentInfo = DB::table('shop_payment')->where([
            ['shop_id', $shopApplyInfo->shop_id]
        ])->first();
        if (!empty($shopPaymentInfo)) { // 存在支付订单
            if ($shopPaymentInfo->pay_status == 1) {
                // 请勿重复支付
                return redirect('/shop/apply/result.html');
            }
            $pay_id = $shopPaymentInfo->pay_id;

            // 更新支付方式
            $this->shopPayment->update($pay_id, ['pay_code' => $paycode, 'pay_name' => format_pay_type($paycode),]);
        } else {
            //
            $begin_time = format_time(time());
            if ($shopApplyInfo->unit == 2) {
                // 天
                $end_time = Carbon::parse('+'.$shopApplyInfo->duration.' days')->toDateTimeString();
            } elseif ($shopApplyInfo->unit == 1) {
                // 月
                $end_time = Carbon::parse('+'.$shopApplyInfo->duration.' months')->toDateTimeString();
            } else {
                // 年
                $end_time = Carbon::parse('+'.$shopApplyInfo->duration.' year')->toDateTimeString();
            }

            // 生成付款单信息
            $post = [
                'shop_id' => $shopApplyInfo->shop_id,
                'apply_time' => time(),
                'pay_code' => $paycode,
                'pay_name' => format_pay_type($paycode),
                'begin_time' => $begin_time,
                'end_time' => $end_time,
                'duration' => $shopApplyInfo->duration,
                'unit' => $shopApplyInfo->unit,
                'system_fee' => $shopApplyInfo->system_fee,
                'insure_fee' => $shopApplyInfo->insure_fee,
                'is_frozen' => 1,
                'remark' => null,
            ];

            $ret = $this->shopPayment->addShopPayment($post);
            if ($ret['code'] != 0) {
                return result($ret['code'], $ret['data'], $ret['message']);
            }

            $pay_id = $ret['data']['pay_id'];
        }

        $data = 'http://'.config('lrw.frontend_domain').'/shop/apply/payment.html?pay_id='.$pay_id; // 支付页面url
        $extra = [
            'pay_id' => $pay_id
        ];
        // 跳转支付页面
        return result(0, $data, '提交订单成功', $extra);
    }

    // 参考订单支付 payment方法
    public function payment(Request $request)
    {
        $seo_title = '微信支付';

        $pay_id = $request->get('pay_id');
        $shopPaymentInfo = DB::table('shop_payment')->where([
            ['pay_id', $pay_id]
        ])->first();
        if (empty($shopPaymentInfo)) {
            abort(200, INVALID_PARAM);
        }
        if ($shopPaymentInfo->pay_status == 1) {
            // 已完成支付
            abort(200,'请勿重复支付！');
        }

        // 第三方支付逻辑方法
        $order_sn = $shopPaymentInfo->pay_id;
        $order_info = [
            'order_sn' => $order_sn,
            'order_amount' => ($shopPaymentInfo->system_fee + $shopPaymentInfo->insure_fee),
            'pay_code' => str_replace(['支付宝','微信支付'],['alipay','weixin'], $shopPaymentInfo->pay_code),
        ];
        $payResult = $this->paymentLogic->toPay($order_info, 1);
        if (!is_array($payResult) && $order_info['pay_code'] != 'weixin') {
            return $payResult;
        }
        if ($order_info['pay_code'] == 'weixin') {
            if (is_weixin() && !is_app()) {
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
            'tpl_view' => 'shop.payment'
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

        // 检查支付状态 当支付成功 则返回支付成功
        $pay_id = $request->get('pay_id');
        $shopPaymentInfo = DB::table('shop_payment')->where([
            ['pay_id', $pay_id]
        ])->first();
        if (empty($shopPaymentInfo)) {
            return result(-1,null, INVALID_PARAM);
        }
        if ($shopPaymentInfo->pay_status == 1) {
            // 已完成支付
            return result(1, null); // 未支付
        }

        // 完成支付 跳转到支付结果页面
        $redirect_url = url('/shop/apply/result.html');
        return result(0, null, '支付成功', ['url'=>$redirect_url]);
    }


    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->shop->clientValidate($request, 'ShopApplyModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

}
