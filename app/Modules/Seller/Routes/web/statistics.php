<?php

Route::group(['domain' => config('lrw.seller_domain')], function ($router) {

    // Statistics Route
    Route::group(['prefix' => 'statistics'], function () {
        // DataProfiling
        Route::group(['prefix' => 'data-profiling'], function () {
            Route::get('index', 'Statistics\DataProfilingController@index'); // 数据概况
            Route::get('get-data', 'Statistics\DataProfilingController@getData'); //
        });

        // SalesStatistics
        Route::group(['prefix' => 'sales-statistics'], function () {
            Route::get('index', 'Statistics\SalesStatisticsController@index'); // 营业统计
            Route::get('get-data', 'Statistics\SalesStatisticsController@getData'); //
        });

        // GoodsAnalyse
        Route::group(['prefix' => 'goods-analyse'], function () {
            Route::get('index', 'Statistics\GoodsAnalyseController@index'); // 商品概况
            Route::get('get-data', 'Statistics\GoodsAnalyseController@getData'); //
            Route::get('sales-chart', 'Statistics\GoodsAnalyseController@salesChart'); // 商品销量排行
            Route::get('sales-chart-export', 'Statistics\GoodsAnalyseController@salesChartExport'); // 导出
            Route::get('industry', 'Statistics\GoodsAnalyseController@industry'); // 行业分析
            Route::post('industry-data', 'Statistics\GoodsAnalyseController@industryData'); //
            Route::get('industry-export', 'Statistics\GoodsAnalyseController@industryExport'); //
            Route::post('cat-list', 'Statistics\GoodsAnalyseController@catList'); // 异步加载分类
            Route::get('purchase-rate', 'Statistics\GoodsAnalyseController@purchaseRate'); // 访问购买率
            Route::get('purchase-rate-export', 'Statistics\GoodsAnalyseController@purchaseRateExport'); //
        });

        Route::group(['prefix' => 'goods-statistics'], function () {
            Route::get('sales', 'Statistics\GoodsStatisticsController@sales'); // 单品销售明细统计
        });

        Route::group(['prefix' => 'trade-analyse'], function () {
            Route::get('index', 'Statistics\TradeAnalyseController@index'); // 交易概况
            Route::post('index-data', 'Statistics\TradeAnalyseController@indexData'); //
            Route::get('users-data', 'Statistics\TradeAnalyseController@usersData'); //

            Route::get('sales', 'Statistics\TradeAnalyseController@sales'); // 销售统计
            Route::get('get-data', 'Statistics\TradeAnalyseController@getData'); //

            Route::get('area', 'Statistics\TradeAnalyseController@area'); // 地域分布
            Route::get('get-area-data', 'Statistics\TradeAnalyseController@getAreaData'); //
        });

        Route::group(['prefix' => 'sales-amount'], function () {
            Route::get('index', 'Statistics\SalesAmountController@index'); // 销售统计
        });

        Route::group(['prefix' => 'finance-amount'], function () {
            Route::get('index', 'Statistics\FinanceAmountController@index'); // 财务统计
        });
    });

});