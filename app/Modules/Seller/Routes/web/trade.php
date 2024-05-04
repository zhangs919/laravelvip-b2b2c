<?php

Route::group(['domain' => config('lrw.seller_domain')], function ($router) {

    // Trade route
    Route::group(['prefix' => 'trade'], function () {
        // Order route
        Route::group(['prefix' => 'order'], function () {
            Route::get('take-list', 'Trade\OrderController@takeList'); // 接单列表
            Route::get('list', 'Trade\OrderController@lists'); // 订单列表
            Route::get('list.html', 'Trade\OrderController@lists'); // 订单列表
            Route::get('info.html', 'Trade\OrderController@info'); // 订单详情

            Route::get('print.html', 'Trade\OrderController@print'); // 打印订单
            Route::get('select-spec', 'Trade\OrderController@selectSpec'); //

            Route::post('get-order-counts', 'Trade\OrderController@getOrderCounts'); // 获取订单数量

            Route::any('remark', 'Trade\OrderController@remark'); // 订单备注

            // 修改订单：修改订单价格、
            Route::get('edit-order', 'Trade\OrderController@editOrder'); //
            Route::get('edit-order.html', 'Trade\OrderController@editOrder'); //
            Route::post('edit-order', 'Trade\OrderController@editOrderSave'); //

            Route::post('edit.html', 'Trade\OrderController@edit'); //
            Route::any('audit.html', 'Trade\OrderController@audit'); // 审核取消订单
            Route::post('assign-cancel', 'Trade\OrderController@assignCancel'); //取消派单
            Route::post('delay', 'Trade\OrderController@delay'); //

            Route::get('calculate-order-freight-price.html', 'Trade\OrderController@calculateOrderFreightPrice'); //
            Route::get('quick-delivery.html', 'Trade\OrderController@quickDelivery'); // 一键发货


            Route::any('view', 'Trade\OrderController@view'); // 核销
            Route::any('get-order', 'Trade\OrderController@getOrder'); // 核销


        });

        // Delivery route
        Route::group(['prefix' => 'delivery'], function () {
            Route::get('list', 'Trade\DeliveryController@lists'); // 发货单列表
            Route::get('info', 'Trade\DeliveryController@info'); // 发货单详情
            Route::get('print', 'Trade\DeliveryController@print'); // 打印快递单
            Route::post('get-delivery-counts', 'Trade\DeliveryController@getDeliveryCounts'); //


            // 修改订单：修改订单价格、
            Route::get('edit-order', 'Trade\DeliveryController@editOrder'); //
            Route::get('edit-order.html', 'Trade\DeliveryController@editOrder'); //
            Route::post('edit-order', 'Trade\DeliveryController@editOrderSave'); //
            Route::post('edit-order.html', 'Trade\DeliveryController@editOrderSave'); //

            Route::get('to-shipping', 'Trade\DeliveryController@toShipping'); // 发货
            Route::get('to-shipping.html', 'Trade\DeliveryController@toShipping'); // 发货
            Route::post('cancel', 'Trade\DeliveryController@cancel'); // 取消发货单
            Route::get('search-express.html', 'Trade\DeliveryController@searchExpress'); //
            Route::get('get-sheet.html', 'Trade\DeliveryController@getSheet'); //
            Route::get('check-print.html', 'Trade\DeliveryController@checkPrint'); //
            Route::post('shipping-default.html', 'Trade\DeliveryController@shippingDefault'); //
        });

        // 退款/退货管理 售后管理 route
        Route::group(['prefix' => 'back'], function () {
            Route::get('list', 'Trade\BackController@lists'); // 列表
            Route::get('info', 'Trade\BackController@info'); // 详情
            Route::get('confirm-sys.html', 'Trade\BackController@confirmSys'); // 系统自动同意申请
            Route::get('export', 'Trade\BackController@export')->name('refund-export'); // export 导出excel
        });

        // 投诉管理
        Route::group(['prefix' => 'complaint'], function () {
            Route::get('list', 'Trade\ComplaintController@lists'); //
            Route::get('info', 'Trade\ComplaintController@info'); //
            Route::post('info.html', 'Trade\ComplaintController@saveInfo'); //
        });

        Route::group(['prefix' => 'service'], function () {
            Route::get('evaluate-buyer-list', 'Trade\ServiceController@evaluateBuyerList'); // 来自买家的评价
            Route::get('reply', 'Trade\ServiceController@reply'); // 卖家回复
            Route::get('evaluate-shop-list', 'Trade\ServiceController@evaluateShopList'); // 店铺动态评价
        });
    });


});