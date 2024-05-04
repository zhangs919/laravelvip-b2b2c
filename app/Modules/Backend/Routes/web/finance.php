<?php


Route::group(['domain' => config('lrw.backend_domain')], function ($router) {


    // Finance Route
    Route::group(['prefix' => 'finance'], function () {

        // 资金-商城账户
        Route::group(['prefix' => 'mall-account'], function () {
            Route::get('list', 'Finance\MallAccountController@lists'); // lists

        });

        // 资金-会员账户
        Route::group(['prefix' => 'user-account'], function () {
            Route::get('list', 'Finance\UserAccountController@lists'); // lists

        });

        // 资金-充值管理
        Route::group(['prefix' => 'recharge'], function () {
            Route::get('list', 'Finance\RechargeController@lists'); // lists

        });

        // 资金-提现管理
        Route::group(['prefix' => 'deposit'], function () {
            Route::get('list', 'Finance\DepositController@lists'); // lists
            Route::get('export.html', 'Finance\DepositController@export'); // export
            Route::get('deposit-config', 'Finance\DepositController@depositConfig'); // lists
            Route::any('examine', 'Finance\DepositController@examine'); // examine
            Route::any('finish', 'Finance\DepositController@finish'); // finish

        });

        // 资金-神马统计
        Route::group(['prefix' => 'cashier'], function () {
//            Route::get('list', 'Finance\CashierController@lists'); // lists

        });

        // 账单-店铺账单
        Route::group(['prefix' => 'bill'], function () {
            Route::get('system-shop-bill', 'Finance\BillController@systemShopBill'); //
            Route::get('shop-orders-info', 'Finance\BillController@shopOrdersInfo'); //

        });

        // 统计-数据概况
        Route::group(['prefix' => 'data-profiling'], function () {
            Route::get('index', 'Finance\DataProfilingController@index'); // index
            Route::get('get-data', 'Finance\DataProfilingController@getData'); // getData

        });

        // 统计-店铺统计
        Route::group(['prefix' => 'shops-statistics'], function () {
            Route::get('index', 'Finance\ShopsStatisticsController@index'); // index
            Route::post('get-data', 'Finance\ShopsStatisticsController@getData'); // getData
            Route::get('sales-list', 'Finance\ShopsStatisticsController@salesList');
            Route::get('areas-list', 'Finance\ShopsStatisticsController@areasList');


        });

        // 统计-会员统计
        Route::group(['prefix' => 'users-statistics'], function () {
            Route::get('index', 'Finance\UsersStatisticsController@index'); // index
            Route::post('get-data', 'Finance\UsersStatisticsController@getData'); // getData
            Route::get('users-list', 'Finance\UsersStatisticsController@usersList'); // usersList
            Route::get('areas-list', 'Finance\UsersStatisticsController@areasList'); // areasList
            Route::get('ranks-list', 'Finance\UsersStatisticsController@ranksList'); // ranksList
            Route::get('sales-list', 'Finance\UsersStatisticsController@salesList'); // salesList


        });

        // 统计-销售分析
        Route::group(['prefix' => 'sales-analyse'], function () {
            Route::get('index', 'Finance\SalesAnalyseController@index'); // index
            Route::get('amount', 'Finance\SalesAnalyseController@amount'); // amount
            Route::get('order', 'Finance\SalesAnalyseController@order'); // order
            Route::post('get-data', 'Finance\SalesAnalyseController@getData'); // getData
            Route::get('get-order-data', 'Finance\SalesAnalyseController@getOrderData'); // getOrderData

        });

        // 统计-行业分析
        Route::group(['prefix' => 'industry-analyse'], function () {
            Route::get('index', 'Finance\IndustryAnalyseController@index'); // index
            Route::post('industry-data', 'Finance\IndustryAnalyseController@industryData'); // industryData

        });

        // 统计-财务统计
        Route::group(['prefix' => 'finance-statistics'], function () {
//            Route::get('index', 'Finance\FinanceStatisticsController@index'); // index

        });

    });

});