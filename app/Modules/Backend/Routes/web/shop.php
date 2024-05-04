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
// | Date:2018-08-10
// | Description:商城模块路由
// +----------------------------------------------------------------------

Route::group(['domain' => config('lrw.backend_domain')], function ($router) {


    // Shop Module
    Route::group(['prefix' => 'shop'], function () {

        // Shop Route
        Route::group(['prefix' => 'shop'], function () {
            Route::get('picker', 'Shop\ShopController@picker'); // picker 店铺选择器
            Route::get('list', 'Shop\ShopController@lists')->name('shop-third-list'); // lists
            Route::get('index', 'Shop\ShopController@lists')->name('shop-third-list'); // lists

            Route::get('apply-list', 'Shop\ShopController@applyList')->name('shop-third-apply-list'); // 开店申请
            Route::get('renew-list', 'Shop\ShopController@renewList'); // 待续费店铺
            Route::get('renew-apply-list', 'Shop\ShopController@renewApplyList'); // 续签申请店铺
            Route::get('pre-line-list', 'Shop\ShopController@preLineList')->name('shop-third-pre-line'); // 预上线店铺
            Route::get('view-message', 'Shop\ShopController@viewMessage'); // 预上线店铺 查看留言

            Route::get('export', 'Shop\ShopController@export')->name('shop-third-export'); // 导出数据

            Route::get('search-user', 'Shop\ShopController@searchUser'); // ajax 搜索会员
            Route::get('add', 'Shop\ShopController@add')->name('shop-third-manage'); // add
            Route::post('add', 'Shop\ShopController@saveData')->name('shop-third-manage'); // saveData
            Route::get('edit', 'Shop\ShopController@edit')->name('shop-third-manage'); // edit
            Route::post('edit', 'Shop\ShopController@saveData')->name('shop-third-manage'); // saveData
            Route::any('shop-auth-info', 'Shop\ShopController@shopAuthInfo')->name('shop-third-manage'); // shopAuthInfo

            Route::get('client-validate', 'Shop\ShopController@clientValidate'); // clientValidate
            Route::get('set-status', 'Shop\ShopController@setStatus')->name('shop-third-manage'); // setStatus
            Route::get('set-show-credit', 'Shop\ShopController@setShowCredit')->name('shop-third-manage'); // setShowCredit
            Route::get('set-goods-is-show', 'Shop\ShopController@setGoodsIsShow')->name('shop-third-manage'); // setGoodsIsShow
            Route::get('set-show-in-street', 'Shop\ShopController@setShowInStreet')->name('shop-third-manage'); // setShowInStreet
            Route::post('edit-shop-info', 'Shop\ShopController@editShopInfo')->name('shop-third-manage'); // editShopInfo
            Route::post('delete', 'Shop\ShopController@delete')->name('shop-third-delete'); // delete
            Route::get('export', 'Shop\ShopController@export')->name('shop-third-export'); // export

            Route::any('apply-edit', 'Shop\ShopController@applyEdit')->name('shop-third-apply-manage'); // applyEdit
            Route::get('audit', 'Shop\ShopController@audit')->name('shop-third-apply-manage'); // audit
            Route::post('batch-pass', 'Shop\ShopController@batchPass')->name('shop-third-apply-manage'); // audit


            Route::get('pay-list', 'Shop\ShopController@payList'); // 付款信息列表
            Route::get('pay-add', 'Shop\ShopController@payAdd'); // payAdd
            Route::post('pay-add', 'Shop\ShopController@savePayData'); // paySaveData
            Route::get('pay-edit', 'Shop\ShopController@payEdit'); // payAdd
            Route::post('pay-edit', 'Shop\ShopController@savePayData'); // paySaveData

            Route::get('qrcode', 'Shop\ShopController@qrcode'); // qrcode
            Route::post('delete', 'Shop\ShopController@delete'); // 删除店铺


        });

        // SelfShop Route
        Route::group(['prefix' => 'self-shop'], function () {
            Route::get('list', 'Shop\SelfShopController@lists')->name('shop-self-list'); // lists
            Route::get('index', 'Shop\SelfShopController@lists')->name('shop-self-list'); // lists
            Route::get('search-user', 'Shop\SelfShopController@searchUser')->name('shop-self-manage'); // ajax 搜索会员
            Route::get('add', 'Shop\SelfShopController@add')->name('shop-self-manage'); // add
            Route::post('add', 'Shop\SelfShopController@saveData')->name('shop-self-manage'); // saveData
            Route::get('edit', 'Shop\SelfShopController@edit')->name('shop-self-manage'); // edit
            Route::post('edit', 'Shop\SelfShopController@saveData')->name('shop-self-manage'); // saveData

            Route::get('client-validate', 'Shop\SelfShopController@clientValidate')->name('shop-self-manage'); // clientValidate
            Route::get('set-status', 'Shop\SelfShopController@setStatus')->name('shop-self-manage'); // setStatus
            Route::get('set-show-credit', 'Shop\SelfShopController@setShowCredit')->name('shop-self-manage'); // setShowCredit
            Route::get('set-goods-is-show', 'Shop\SelfShopController@setGoodsIsShow')->name('shop-self-manage'); // setGoodsIsShow
            Route::get('set-show-in-street', 'Shop\SelfShopController@setShowInStreet')->name('shop-self-manage'); // setShowInStreet
            Route::post('edit-shop-info', 'Shop\SelfShopController@editShopInfo')->name('shop-self-manage'); // editShopInfo
            Route::post('delete', 'Shop\SelfShopController@delete')->name('shop-self-delete'); // delete
            Route::get('export', 'Shop\SelfShopController@export')->name('shop-self-export'); // export


        });

        // 推荐开店 Route
        Route::group(['prefix' => 'recommend-shop'], function () {
            Route::get('list', 'Shop\RecommendShopController@lists')->name('shop-recommend-list'); // lists
            Route::any('remark', 'Shop\SelfShopController@remark')->name('shop-recommend-remark'); // remark
            Route::post('delete', 'Shop\SelfShopController@delete')->name('shop-recommend-delete'); // delete

        });

        // 预上线店铺留言 Route
        Route::group(['prefix' => 'recommend-msg'], function () {
            Route::get('list', 'Shop\RecommendMsgController@lists')->name('shop-recommend-msg-list'); // lists
            Route::post('delete', 'Shop\RecommendMsgController@delete')->name('shop-recommend-msg-delete'); // delete

        });

        // ShopSetting Route
        Route::group(['prefix' => 'shop-setting'], function () {

            Route::get('index', 'Shop\ShopSettingController@index')->name('system-config-open_shop'); // index
            Route::get('basic-set', 'Shop\ShopSettingController@index')->name('system-config-open_shop'); // index
            Route::get('banner-set', 'Shop\ShopSettingController@bannerSet')->name('system-config-shop_apply_banner'); // bannerSet
        });

        // ShopClass Route
        Route::group(['prefix' => 'shop-class'], function () {
            Route::get('list', 'Shop\ShopClassController@lists')->name('shop-class-list'); // lists
            Route::get('index', 'Shop\ShopClassController@lists')->name('shop-class-list'); // lists
            Route::get('add', 'Shop\ShopClassController@add')->name('shop-class-manage'); // add
            Route::post('add', 'Shop\ShopClassController@saveData')->name('shop-class-manage'); // saveData
            Route::get('edit', 'Shop\ShopClassController@edit')->name('shop-class-manage'); // edit
            Route::post('edit', 'Shop\ShopClassController@saveData')->name('shop-class-manage'); // saveData
            Route::get('set-is-show', 'Shop\ShopClassController@setIsShow')->name('shop-class-manage'); // setIsShow
            Route::get('set-is-hot', 'Shop\ShopClassController@setIsHot')->name('shop-class-manage'); // setIsHot
            Route::post('edit-shop-class-info', 'Shop\ShopClassController@editShopClassInfo')->name('shop-class-manage'); // editShopClassInfo
            Route::post('delete', 'Shop\ShopClassController@delete')->name('shop-class-delete'); // delete
            Route::post('upload-cls_image', 'Shop\ShopClassController@uploadClsImage')->name('shop-class-manage'); // uploadClsImage
        });

        // ShopCredit Route
        Route::group(['prefix' => 'shop-credit'], function () {
            Route::get('list', 'Shop\ShopCreditController@lists')->name('shop-credit-list'); // lists
            Route::get('index', 'Shop\ShopCreditController@lists')->name('shop-credit-list'); // lists
            Route::get('add', 'Shop\ShopCreditController@add')->name('shop-credit-manage'); // add
            Route::post('add', 'Shop\ShopCreditController@saveData')->name('shop-credit-manage'); // saveData
            Route::get('edit', 'Shop\ShopCreditController@edit')->name('shop-credit-manage'); // edit
            Route::post('edit', 'Shop\ShopCreditController@saveData')->name('shop-credit-manage'); // saveData
            Route::get('client-validate', 'Shop\ShopCreditController@clientValidate')->name('shop-credit-manage'); // clientValidate

            Route::post('delete', 'Shop\ShopCreditController@delete')->name('shop-credit-delete'); // delete
            Route::post('batch-delete', 'Shop\ShopCreditController@batchDelete')->name('batch-delete')->name('shop-credit-delete'); // batchDelete

            Route::post('upload-credit_img', 'Shop\ShopCreditController@uploadCreditImg')->name('shop-credit-manage'); // uploadCreditImg
        });

        // 采集控制
        Route::group(['prefix' => 'collect'], function () {
            Route::get('list', 'Shop\CollectController@lists')->name('shop-collect-list'); // lists
            Route::get('add', 'Shop\CollectController@add')->name('shop-collect-manage'); // add
            Route::post('add', 'Shop\CollectController@saveData')->name('shop-collect-manage'); // saveData
            Route::get('edit', 'Shop\CollectController@edit')->name('shop-collect-manage'); // edit
            Route::post('edit', 'Shop\CollectController@saveData')->name('shop-collect-manage'); // saveData
            Route::get('set', 'Shop\CollectController@set')->name('system-config-shop_collect'); // 设置


        });

        // 网点控制
        Route::group(['prefix' => 'store'], function () {
            Route::get('list', 'Shop\StoreController@lists')->name('shop-store-list'); // lists
            Route::get('add', 'Shop\StoreController@add')->name('shop-store-manage'); // add
            Route::post('add', 'Shop\StoreController@saveData')->name('shop-store-manage'); // saveData
            Route::get('edit', 'Shop\StoreController@edit')->name('shop-store-manage'); // edit
            Route::post('edit', 'Shop\StoreController@saveData')->name('shop-store-manage'); // saveData


        });

    });

});