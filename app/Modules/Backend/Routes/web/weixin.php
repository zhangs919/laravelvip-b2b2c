<?php

Route::group(['domain' => config('lrw.backend_domain')], function ($router) {

    Route::group(['prefix' => 'weixin'], function () {
        /**
         * 微信自定义菜单
         */
        Route::group(['prefix' => 'menu'], function () {
            Route::get('list', 'Weixin\MenuController@lists'); // lists
            Route::get('add', 'Weixin\MenuController@add'); // add
            Route::get('edit', 'Weixin\MenuController@edit'); // edit
            Route::post('add', 'Weixin\MenuController@saveData'); // saveData
            Route::get('change-type', 'Weixin\MenuController@changeType'); //
            Route::post('change-sort', 'Weixin\MenuController@changeSort'); // editInfo
            Route::post('sync-to-weixin', 'Weixin\MenuController@syncToWeixin'); // 同步到微信
            Route::post('delete', 'Weixin\MenuController@delete'); // delete
        });

        /**
         * 微信关键词回复
         */
        Route::group(['prefix' => 'keyword'], function () {
            Route::get('list', 'Weixin\KeywordController@lists'); // lists
            Route::get('add', 'Weixin\KeywordController@add'); // add
            Route::get('edit', 'Weixin\KeywordController@edit'); // edit
            Route::post('add', 'Weixin\KeywordController@saveData'); // saveData
            Route::get('change-type', 'Weixin\KeywordController@changeType'); //
            Route::post('delete', 'Weixin\KeywordController@delete'); // delete
        });

        /**
         * 小程序码
         */
        Route::group(['prefix' => 'programs-qrcode'], function () {
            Route::get('list', 'Weixin\ProgramsQrcodeController@lists'); // lists
            Route::get('add', 'Weixin\ProgramsQrcodeController@add'); // add
            Route::get('edit', 'Weixin\ProgramsQrcodeController@edit'); // edit
            Route::post('add', 'Weixin\ProgramsQrcodeController@saveData'); // saveData
            Route::get('download-file', 'Weixin\ProgramsQrcodeController@downloadFile'); //
            Route::post('delete', 'Weixin\ProgramsQrcodeController@delete'); // delete
        });

        /**
         * 微信粉丝
         */
        Route::group(['prefix' => 'user'], function () {
            Route::get('list', 'Weixin\UserController@lists'); // lists
        });

        /**
         * 二维码管理
         */
        Route::group(['prefix' => 'qcode'], function () {
            Route::get('list', 'Weixin\QcodeController@lists'); // lists
            Route::get('add', 'Weixin\QcodeController@add'); // add
            Route::get('edit', 'Weixin\QcodeController@edit'); // edit
            Route::post('add', 'Weixin\QcodeController@saveData'); // saveData
            Route::post('delete', 'Weixin\QcodeController@delete'); // delete
        });

        /**
         * 微信图文素材
         */
        Route::group(['prefix' => 'material'], function () {
            Route::get('list', 'Weixin\MaterialController@lists'); // lists
            Route::get('add', 'Weixin\MaterialController@add'); // add
            Route::get('edit', 'Weixin\MaterialController@edit'); // edit
            Route::post('add', 'Weixin\MaterialController@saveData'); // saveData

            Route::get('more-list', 'Weixin\MaterialController@moreLists'); // lists
            Route::get('more-add', 'Weixin\MaterialController@moreAdd'); // add
            Route::get('more-edit', 'Weixin\MaterialController@moreEdit'); // edit
            Route::post('more-add', 'Weixin\MaterialController@saveMoreData'); // saveData
            Route::post('more-edit', 'Weixin\MaterialController@saveMoreData'); // saveData

            Route::post('delete', 'Weixin\MaterialController@delete'); // delete
        });

        /**
         * 微信图文 - 消息推送
         */
        Route::group(['prefix' => 'push'], function () {
            Route::any('index', 'Weixin\PushController@index'); //
            Route::any('select-material', 'Weixin\PushController@selectMaterial'); //
            Route::get('add-material', 'Weixin\PushController@addMaterial'); //
        });

    });
    
    


});