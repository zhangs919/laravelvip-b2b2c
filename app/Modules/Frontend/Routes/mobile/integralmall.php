<?php


Route::group(['domain' => config('lrw.mobile_domain')], function ($router) {


    // Integralmall Route
    Route::get('integralmall.html', 'Integralmall\IndexController@index'); // index
    Route::group(['prefix' => 'integralmall'], function () {

        Route::get('goods-{goods_id}.html', 'Integralmall\IndexController@showGoods')->name('mobile_show_integral_goods');

        Route::group(['prefix' => 'index'], function () {
            Route::get('bonus-list.html', 'Integralmall\IndexController@bonusList'); // bonusList
            Route::get('validate', 'Integralmall\IndexController@validates'); // validates
            Route::post('bonus-exchange', 'Integralmall\IndexController@bonusExchange'); // bonusExchange

        });

    });

});