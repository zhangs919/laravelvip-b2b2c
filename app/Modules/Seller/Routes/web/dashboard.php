<?php


Route::group(['domain' => env('SELLER_DOMAIN')], function ($router) {


    // Dashboard Route 营销中心
    Route::group(['prefix' => 'dashboard'], function () {

        // 营销中心 Center
        Route::group(['prefix' => 'center'], function () {
            Route::get('index', 'Dashboard\CenterController@index'); // index

        });

        Route::group(['prefix' => 'group-buy'], function () {
            Route::get('list', 'Dashboard\GroupBuyController@lists'); // lists
            Route::get('add', 'Dashboard\GroupBuyController@add'); // add
            Route::get('edit', 'Dashboard\GroupBuyController@edit'); // add
            Route::post('add', 'Dashboard\GroupBuyController@saveData'); // saveData
            Route::post('delete', 'Dashboard\GroupBuyController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\GroupBuyController@batchDelete'); // batchDelete
            Route::get('picker', 'Dashboard\GroupBuyController@picker'); // add
            Route::post('goods-info', 'Dashboard\GroupBuyController@goodsInfo');


        });

        Route::group(['prefix' => 'activity-goods'], function () {
            Route::get('picker', 'Dashboard\ActivityGoodsController@picker'); //
        });


        // 积分商城
        Route::group(['prefix' => 'integral-mall'], function () {
            Route::get('revision', 'Dashboard\IntegralMallController@revision'); // 核销
            Route::post('revision', 'Dashboard\IntegralMallController@doRevision'); // 开始核销
            Route::get('get-order', 'Dashboard\IntegralMallController@getOrder'); // 扫码订单二维码核销 搜索

            Route::get('integral-goods-list', 'Dashboard\IntegralMallController@integralGoodsList'); // 积分兑换商品
            Route::get('add-integral-goods', 'Dashboard\IntegralMallController@addIntegralGoods'); // 添加积分兑换商品
            Route::post('add-integral-goods', 'Dashboard\IntegralMallController@saveIntegralGoods'); // 保存数据
            Route::get('edit-integral-goods', 'Dashboard\IntegralMallController@editIntegralGoods'); // 编辑积分兑换商品
            Route::post('edit-integral-goods', 'Dashboard\IntegralMallController@saveIntegralGoods'); // 保存数据
            Route::post('set-goods-status', 'Dashboard\IntegralMallController@setGoodsStatus'); // 积分商品 上架/下架
            Route::post('edit-integral-goods-info', 'Dashboard\IntegralMallController@editIntegralGoodsInfo'); // 列表更新字段信息
            Route::post('del-integral-goods', 'Dashboard\IntegralMallController@delIntegralGoods'); // 删除积分商品

            /*上面的ok*/

            Route::get('integral-order-list', 'Dashboard\IntegralMallController@integralOrderList'); // 积分兑换列表

            Route::get('integral-bonus-list', 'Dashboard\IntegralMallController@integralBonusList'); // 积分兑换红包

            Route::get('integral-mall-set', 'Dashboard\IntegralMallController@integralMallSet'); // 积分商城设置

        });
    });

});