<?php
//
//
//Route::group(['domain' => env('MOBILE_DOMAIN')], function ($router) {
//
//
//    // Integralmall Route
//    Route::get('integralmall.html', 'Integralmall\IndexController@index'); // index
//    Route::group(['prefix' => 'integralmall'], function () {
//
//        Route::get('goods-{goods_id}.html', 'Integralmall\IndexController@showGoods'); // showGoods
//
//        Route::group(['prefix' => 'index'], function () {
//            Route::get('bonus-list.html', 'Integralmall\IndexController@bonusList'); // bonusList
//            Route::get('validate', 'Integralmall\IndexController@validates'); // validates
//            Route::post('bonus-exchange', 'Integralmall\IndexController@bonusExchange'); // bonusExchange
//
//        });
//
//    });
//
//});