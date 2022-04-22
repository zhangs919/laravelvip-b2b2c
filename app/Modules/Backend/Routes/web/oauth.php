<?php


Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {


    // 对接周边系统
    Route::group(['prefix' => 'oauth'], function () {

        Route::group(['prefix' => 'oauth'], function () {
            Route::get('index', 'Oauth\OauthController@index'); // index
            Route::get('to-oauth', 'Oauth\OauthController@toOauth'); // 去授权
            Route::post('del-oauth', 'Oauth\OauthController@delOauth'); // 删除授权

        });

    });

});