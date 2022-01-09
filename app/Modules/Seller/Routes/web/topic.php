<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-08-13
// | Description:
// +----------------------------------------------------------------------

Route::group(['domain' => env('SELLER_DOMAIN')], function ($router) {

    // Topic Route
    Route::group(['prefix' => 'topic'], function () {
        // Topic
        Route::group(['prefix' => 'topic'], function () {
            Route::get('list', 'Topic\TopicController@lists'); // lists
            Route::get('add', 'Topic\TopicController@add'); // add
            Route::post('add', 'Topic\TopicController@saveData'); // saveData
            Route::get('edit', 'Topic\TopicController@edit'); // edit
            Route::post('edit', 'Topic\TopicController@saveData'); // saveData
            Route::post('delete', 'Topic\TopicController@delete')->name('delete'); // delete
            Route::post('batch-delete', 'Topic\TopicController@batchDelete')->name('batch-delete'); // batchDelete

            Route::get('design', 'Topic\TopicController@design'); // 专题装修


        });
    });

});