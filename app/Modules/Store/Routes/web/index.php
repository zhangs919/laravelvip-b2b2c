<?php

Route::group(['domain' => env('STORE_DOMAIN')], function ($router) {



    // Index Route
    Route::get('/', 'Goods\ListController@lists'); // 首页/商品列表
    Route::get('/index', 'Goods\ListController@lists')->name('store_home'); // 网点中心首页
    Route::get('/index.html', 'Goods\ListController@lists')->name('store_home'); // 网点中心首页

});
