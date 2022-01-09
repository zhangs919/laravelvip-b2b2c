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

        // 平台后台
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
        'goods/yun/filter-barcodes',
        'login',
        'shop/shop-class/upload-cls_image',
        'shop/shop-credit/upload-credit_img',
        'user/user-rank/upload-rank-image',
        'goods/collect/ajax-collect', // 批量采集商品
        'goods/collect/add-goods', // 批量采集商品
        'goods/collect/ajax-add', // 批量采集商品


        // 商家后台
        'goods/publish/add',

        // PC前端
        'register.html',
        'register/sms-captcha',
        'register/email-captcha',
        'site/logout.html',
        'integralmall/index/bonus-exchange',
        'cart/quick-buy.html',

        // 微信端
        'user/profile/edit-profile-info',
        'cart/select',
        'cart/change-number',
        'goods/search-pickup.html',
        'user/collect/toggle',
        'login.html',


    ];
}
