<?php

Route::group(['domain' => config('lrw.seller_domain')], function ($router) {

    // Activity
    Route::group(['prefix' => 'activity'], function () {
        // TplSetting 装修页面
        Route::group(['prefix' => 'activity'], function () {
            Route::any('picker', 'Activity\ActivityController@picker'); // picker
        });

        // Bonus
        Route::group(['prefix' => 'bonus'], function () {
            Route::any('picker', 'Activity\BonusController@picker'); // picker
        });
    });





});