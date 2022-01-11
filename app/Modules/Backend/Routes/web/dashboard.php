<?php


Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {


    // Dashboard Route 营销中心
    Route::group(['prefix' => 'dashboard'], function () {

        // 营销中心 Center
        Route::group(['prefix' => 'center'], function () {
            Route::get('index', 'Dashboard\CenterController@index'); // index

        });

        // 店铺营销权限 ShopAuth
        Route::group(['prefix' => 'shop-auth'], function () {
            Route::get('index', 'Dashboard\ShopAuthController@index')->name('shop-auth'); // index
            Route::get('view', 'Dashboard\ShopAuthController@view')->name('shop-auth'); // view
            Route::any('set-auth', 'Dashboard\ShopAuthController@setAuth')->name('shop-auth'); // setAuth
            Route::get('all-auth', 'Dashboard\ShopAuthController@allAuth')->name('shop-auth'); // allAuth

        });

        // 积分商城
        Route::group(['prefix' => 'integral-mall'], function () {
            Route::get('revision', 'Dashboard\IntegralMallController@revision'); // 核销
            Route::get('get-order', 'Dashboard\IntegralMallController@getOrder'); // 扫码订单二维码核销 搜索

            Route::get('integral-goods-list', 'Dashboard\IntegralMallController@integralGoodsList'); // 积分兑换商品
            Route::get('add-integral-goods', 'Dashboard\IntegralMallController@addIntegralGoods'); // 添加积分兑换商品
            Route::post('add-integral-goods', 'Dashboard\IntegralMallController@saveIntegralGoods'); // 保存数据
            Route::get('edit-integral-goods', 'Dashboard\IntegralMallController@editIntegralGoods'); // 编辑积分兑换商品
            Route::post('edit-integral-goods', 'Dashboard\IntegralMallController@saveIntegralGoods'); // 保存数据
            Route::post('set-goods-status', 'Dashboard\IntegralMallController@setGoodsStatus'); // 积分商品 上架/下架
            Route::get('del-integral-goods', 'Dashboard\IntegralMallController@delIntegralGoods'); // 删除积分商品
            Route::post('edit-integral-goods-info', 'Dashboard\IntegralMallController@editIntegralGoodsInfo'); // 列表更新字段信息

            Route::get('integral-order-list', 'Dashboard\IntegralMallController@integralOrderList'); // 积分兑换列表

            Route::get('integral-bonus-list', 'Dashboard\IntegralMallController@integralBonusList'); // 积分兑换红包

            Route::get('integral-mall-index-set', 'Dashboard\IntegralMallController@integralMallIndexSet'); // 积分商城首页设置

            Route::get('integral-mall-set', 'Dashboard\IntegralMallController@integralMallSet'); // 积分商城设置

        });
    });

});