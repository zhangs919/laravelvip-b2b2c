<?php


Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {


    // Finance Route
    Route::group(['prefix' => 'finance'], function () {

        // 资金-商城账户
        Route::group(['prefix' => 'mall-account'], function () {

        });

        // 资金-会员账户
        Route::group(['prefix' => 'user-account'], function () {

        });

        // 资金-充值管理
        Route::group(['prefix' => 'recharge'], function () {

        });

        // 资金-提现管理
        Route::group(['prefix' => 'deposit'], function () {

        });

        // 资金-神马统计
        Route::group(['prefix' => 'cashier'], function () {

        });

        // 账单-店铺账单
        Route::group(['prefix' => 'bill'], function () {

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

        });

        // 统计-会员统计
        Route::group(['prefix' => 'users-statistics'], function () {
            Route::get('index', 'Finance\UsersStatisticsController@index'); // index
            Route::post('get-data', 'Finance\UsersStatisticsController@getData'); // getData

            Route::get('ranks-list', 'Finance\UsersStatisticsController@ranksList'); // ranksList


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
            Route::get('index', 'Finance\FinanceStatisticsController@index'); // index

        });

    });

});