<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

		// 系统安装
		'/install/databases',
        // 平台后台
        'ueditor/serve',
        'upgrade', // 在线升级
        'site/logout',
        'site/upload-image',
        'site/upload-goods-image',
        'site/upload-mobile-image',
        'site/upload-goods-desc-image',
        'site/image-gallery',
        'site/video-gallery',
//        'design/nav-category/edit-category-info',
//        'design/navigation/edit-nav-info',
        'goods/category/upload-cat_image',
        'goods/brand/upload-brand_logo',
        'goods/brand/upload-promotion_image',
        'goods/image/replace',
        'goods/image/delete',
        'goods/yun/filter-barcodes',
        'login',
        'shop/shop-class/upload-cls_image',
        'shop/shop-credit/upload-credit_img',
        'user/user-rank/upload-rank-image',
        'goods/collect/ajax-collect', // 批量采集商品
        'goods/collect/add-goods', // 批量采集商品
        'goods/collect/ajax-add', // 批量采集商品
        'dashboard/custom-form/design', // 万能表单-设计
        'dashboard/custom-form/design.html', // 万能表单-设计
        'dashboard/custom-form/preview', // 万能表单-预览
        'dashboard/custom-form/preview.html', // 万能表单-预览
        'dashboard/activity-category/edit-sort',
        'design/tpl-setting/save-tpls',
        'design/tpl-setting/sort',
        'system/clear-data/index',

        // 商家后台
        'goods/publish/add',
        'dashboard/custom-form/design', // 万能表单-设计
        'dashboard/custom-form/design.html', // 万能表单-设计
        'dashboard/custom-form/preview', // 万能表单-预览
        'dashboard/custom-form/preview.html', // 万能表单-预览
        'site/image-selector.html', // 图片选择器
        'site/video-selector.html', // 视频选择器
        'dashboard/group-buy/upload-act_img', // 上传团购活动图片
        'trade/order/get-order-counts',
        'shop/print-spec/set',

        // PC前端
        'register.html',
        'register/sms-captcha',
        'register/check-sms-captcha.html',
        'register/email-captcha',
        'site/logout.html',
        'site/sms-captcha',
        'site/gitee-web-hooks',
        'integralmall/index/bonus-exchange',
        '*/cart/quick-buy.html',
        'cart/add.html',
        'cart/remove.html',
        'activity/bonus/index.html', // 领取红包
        'website/login.html',
        'notify/front-alipay', // 支付宝异步通知
        'shop/apply/pay.html', // 开店申请在线付款

        // 微信端
        'wxapi/index', // 微信公众号服务端
        'user/profile/up-load',
        'user/profile/edit-profile-info',
        'cart/select',
        '*/cart/add',
        '*/cart/delete',
        '*/cart/remove',
        'cart/change-number',
        'cart/change-number.html',
        'goods/search-pickup.html',
        'user/find-password/sms-captcha', // 找回密码 发送短信验证码
        '*/user/collect/toggle',
        'user/message/read',
        'user/message/delete',
        'user/collect/toggle.html',
        'user/sign-in/go.html', // 开始签到
        'user/order/cancel.html',
        'user/order/delete.html',
        '*/login.html',
        'user/bonus/receive.html', // 领取红包
        'activity/bonus/index.html', // 领取红包
        'cart/go-checkout.html', // 去结算订单
        'checkout/change-payment',
        'checkout/change-address',
        'checkout/change-best-time',
        'checkout/submit',
        'checkout/resubmit',
        'checkout/resubmit.html',
        'checkout/change-invoice',
        'checkout/set-payment.html',
        'multistore/help/get-exhibition',
        'live/index/edit-online-number',
        'user/security/cancel.html',
        'user/address/edit.html',
        '/user/history/del',
        '*/activity/bonus/index.html',
        '*/site/get-weixinconfig.html',
        '/index/information/get-weixinconfig.html',
		'/user/scan-code/get-code',
        '/',

    ];
}
