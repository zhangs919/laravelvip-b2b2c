<?php


Route::group(['domain' => config('lrw.backend_domain')], function ($router) {


    // App Route
    Route::group(['prefix' => 'app'], function () {

        // 设置-消息推送
        Route::group(['prefix' => 'push-message'], function () {
            Route::any('index', 'App\PushMessageController@index')->name('app-push-message');

        });

        // 商家-消息推送
        Route::group(['prefix' => 'seller-push-message'], function () {
            Route::any('index', 'App\SellerPushMessageController@index')->name('app-seller-push-message');

        });

        // 网点-消息推送
        Route::group(['prefix' => 'store-push-message'], function () {
            Route::any('index', 'App\StorePushMessageController@index')->name('app-store-push-message');

        });

    });

});