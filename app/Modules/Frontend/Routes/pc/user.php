<?php


Route::group(['domain' => env('FRONTEND_DOMAIN')], function ($router) {


    // User Route 用户中心路由
    Route::get('user.html', 'User\IndexController@center'); // index


    Route::group(['prefix' => 'user'], function () {
        Route::get('center.html', 'User\IndexController@center')->name('user_center'); // index
        Route::get('profile.html', 'User\ProfileController@profile'); // profile
        Route::get('security.html', 'User\SecurityController@security'); // security
        Route::get('bind.html', 'User\BindController@index'); // index
        Route::get('address.html', 'User\AddressController@index'); // index
        Route::get('growth-value.html', 'User\RankController@growthValue'); // 会员成长值
        Route::get('history.html', 'User\HistoryController@index'); // 我的足迹
        Route::get('order.html', 'User\OrderController@index'); // 我的订单

        // 个人资料
        Route::group(['prefix' => 'profile'], function () {
            Route::get('client-validate', 'User\ProfileController@clientValidate'); // clientValidate
            Route::post('edit-base', 'User\ProfileController@editBase'); // 修改基本信息
            Route::post('edit-real', 'User\ProfileController@editReal'); // 修改实名认证信息
            Route::post('up-load', 'User\ProfileController@upload'); // 修改头像信息
        });

        // 账户安全
        Route::group(['prefix' => 'security'], function () {
            Route::get('security.html', 'User\SecurityController@security'); // security
        });

        // 账号绑定
        Route::group(['prefix' => 'bind'], function () {
            Route::get('bind.html', 'User\BindController@index'); // index
        });

        // 我的收藏
        Route::group(['prefix' => 'collect'], function () {
            Route::get('goods.html', 'User\CollectController@index'); //
            Route::get('goods', 'User\CollectController@index'); //
            Route::get('shop.html', 'User\CollectController@shop'); //
            Route::get('shop', 'User\CollectController@shop'); //
            Route::post('toggle.html', 'User\CollectController@toggle'); // 商品收藏/取消收藏
            Route::get('goods-list.html', 'SiteController@goodsCollectList'); // PC端 异步加载收藏商品列表
        });

        // 收货地址
        Route::group(['prefix' => 'address'], function () {
            Route::get('index.html', 'User\AddressController@index'); // index
            Route::get('add', 'User\AddressController@add'); // add
            Route::get('edit', 'User\AddressController@edit'); // edit
            Route::get('edit.html', 'User\AddressController@edit'); // edit
            Route::post('add.html', 'User\AddressController@saveData'); // saveData
            Route::post('edit.html', 'User\AddressController@saveData'); // saveData
            Route::get('set-default', 'User\AddressController@setDefault'); // setDefault
            Route::get('del', 'User\AddressController@delete'); // delete
            Route::get('del.html', 'User\AddressController@delete'); // delete

        });

        // 我的足迹
        Route::group(['prefix' => 'history'], function () {
            Route::get('del-all', 'User\HistoryController@delAll'); // 清空历史记录
            Route::get('del', 'User\HistoryController@delete'); // 删除历史记录

        });

        // 我的订单
        Route::group(['prefix' => 'order'], function () {
            Route::get('list.html', 'User\OrderController@lists'); // 订单详情
            Route::get('info.html', 'User\OrderController@info'); // 订单详情
            Route::get('edit-order.html', 'User\OrderController@editOrder'); // 订单详情
            Route::post('cancel.html', 'User\OrderController@orderCancel'); // 取消订单

        });
    });

});