<?php

Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {

    // Trade route
    Route::group(['prefix' => 'trade'], function () {
        // Order route
        Route::group(['prefix' => 'order'], function () {
            Route::get('list', 'Trade\OrderController@lists'); // 订单列表
            Route::get('print.html', 'Trade\OrderController@print'); // 打印订单
            Route::post('get-order-counts', 'Trade\OrderController@getOrderCounts'); // 获取订单数量

        });
    });


});