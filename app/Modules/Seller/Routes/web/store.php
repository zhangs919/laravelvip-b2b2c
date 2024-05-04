<?php

Route::group(['domain' => config('lrw.seller_domain')], function ($router) {

    // 网点 Route
    Route::group(['prefix' => 'store'], function () {

        // 线下网点
        Route::group(['prefix' => 'default'], function () {
            Route::get('list', 'Store\DefaultController@lists'); // lists
            Route::get('add', 'Store\DefaultController@add'); // add
            Route::get('edit', 'Store\DefaultController@edit'); // add
            Route::post('add', 'Store\DefaultController@saveData'); // saveData
            Route::post('delete', 'Store\DefaultController@delete'); // delete
            Route::post('batch-delete', 'Store\DefaultController@batchDelete'); // batchDelete
            Route::get('group-list', 'Store\DefaultController@groupList'); // ajax加载网点分组列表
            Route::get('user-list', 'Store\DefaultController@userList'); // ajax加载管理员列表
            Route::get('region-picker', 'Store\DefaultController@regionPicker'); // ajax加载地区列表
            Route::get('set-is-enable', 'Store\DefaultController@setIsEnable'); //


        });

        // 网点分组
        Route::group(['prefix' => 'group'], function () {
            Route::get('list', 'Store\GroupController@lists'); // lists
            Route::get('add', 'Store\GroupController@add'); // add
            Route::get('edit', 'Store\GroupController@edit'); // add
            Route::post('add', 'Store\GroupController@saveData'); // saveData
            Route::post('edit', 'Store\GroupController@saveData'); // saveData
            Route::get('client-validate', 'Store\GroupController@clientValidate'); // clientValidate
            Route::post('edit-group-info', 'Store\GroupController@editGroupInfo'); // editGroupInfo
            Route::post('delete', 'Store\GroupController@delete'); // delete

        });

        // 网点销售统计
        Route::group(['prefix' => 'trade'], function () {
            Route::get('list', 'Store\TradeController@lists'); // lists
            Route::get('detail', 'Store\TradeController@detail'); //

        });

    });

});