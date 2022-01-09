<?php

Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {

    // Activity
    Route::group(['prefix' => 'activity'], function () {
        // TplSetting 装修页面
        Route::group(['prefix' => 'activity'], function () {
            Route::any('picker', 'Activity\ActivityController@picker'); // picker
        });
    });





});