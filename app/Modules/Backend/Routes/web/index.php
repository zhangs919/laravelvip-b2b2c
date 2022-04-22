<?php

Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {

    // Index Route
    Route::get('index/index/index', 'Index\IndexController@index')->name('welcome'); // index
    Route::get('index/index/show-message', 'Index\IndexController@showMessage'); // showMessage
    Route::get('index/index/update', 'Index\IndexController@update'); // update
    Route::get('index/index/one-key-upgrade', 'Index\IndexController@OneKeyUpgrade'); // OneKeyUpgrade 一键升级

    Route::get('index/index/get-data', 'Index\IndexController@getData'); // getData
    Route::get('index/index/guide-show', 'Index\IndexController@guideShow')->name('guide'); // 新手向导
    Route::get('index/index/operation-flow/{type?}', 'Index\IndexController@operationFlow')->name('operation-flow'); // 业务流程
    Route::get('index/index/control-panel', 'Index\IndexController@controlPanel')->name('system-control-panel'); // 控制面板
    Route::post('index/index/commit-domain', 'Index\IndexController@commitDomain'); // commitDomain

});