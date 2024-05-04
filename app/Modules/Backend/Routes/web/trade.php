<?php

Route::group(['domain' => config('lrw.backend_domain')], function ($router) {

    // Trade route
    Route::group(['prefix' => 'trade'], function () {
        // Order route
        Route::group(['prefix' => 'order'], function () {
            Route::get('list', 'Trade\OrderController@lists'); // 订单列表
            Route::get('info', 'Trade\OrderController@info'); // 订单详情

            Route::get('print', 'Trade\OrderController@print'); // 打印订单
            Route::post('get-order-counts', 'Trade\OrderController@getOrderCounts'); // 获取订单数量

            Route::any('remark', 'Trade\OrderController@remark'); // 订单备注
        });

        // 退款管理/售后管理 route
        Route::group(['prefix' => 'refund'], function () {
            Route::get('list', 'Trade\RefundController@lists'); // 列表
            Route::get('info', 'Trade\RefundController@info'); // 详情
            Route::get('confirm-sys.html', 'Trade\RefundController@confirmSys'); // 系统自动同意申请
            Route::get('export', 'Trade\RefundController@export')->name('refund-export'); // export 导出excel
        });

        // 投诉管理 route
        Route::group(['prefix' =>'complaint'], function (){
            Route::get('list','Trade\ComplaintController@lists'); // 列表
            Route::get('info','Trade\ComplaintController@info');  // 详情
            Route::get('edit','Trade\ComplaintController@edit'); // 裁决
            Route::post('edit','Trade\ComplaintController@editPost'); // 裁决提交
        });

        // 评价管理
        Route::group(['prefix'=>'service'],function (){
            Route::get('evaluate-buyer-list', 'Trade\ServiceController@evaluateBuyerList'); // 来自买家的评价
            Route::get('evaluate-shop-list', 'Trade\ServiceController@evaluateShopList'); // 店铺动态评价
            Route::post('ajax-replace', 'Trade\ServiceController@ajaxReplace'); // 替换文字
            Route::post('replace', 'Trade\ServiceController@replace'); // 替换文字提交
            Route::get('shop-operation', 'Trade\ServiceController@shopOperation'); //

        });
    });


});