<?php
//
//
//Route::group(['domain' => env('MOBILE_DOMAIN')], function ($router) {
//
//
//    // User Route 用户中心路由
//    Route::get('user.html', 'User\IndexController@center'); // index
//
//
//    Route::group(['prefix' => 'user'], function () {
//        Route::get('center.html', 'User\IndexController@center')->name('user_center'); // index
//        Route::get('profile.html', 'User\ProfileController@index'); // profile
////        Route::get('security.html', 'User\SecurityController@security'); // security
////        Route::get('bind.html', 'User\BindController@index'); // index
//        Route::get('address.html', 'User\AddressController@index'); // index
////        Route::get('growth-value.html', 'User\RankController@growthValue'); // 会员成长值
//
//        // 个人资料
//        Route::group(['prefix' => 'profile'], function () {
//            Route::get('index.html', 'User\ProfileController@index'); // index
//
//            Route::get('client-validate', 'User\ProfileController@clientValidate'); // clientValidate
//            Route::post('edit-profile-info', 'User\ProfileController@editProfileInfo'); // 修改会员信息
//            Route::post('edit-base', 'User\ProfileController@editBase'); // 修改基本信息
//            Route::post('edit-real', 'User\ProfileController@editReal'); // 修改实名认证信息
//        });
//
//        // 账户安全
//        Route::group(['prefix' => 'security'], function () {
//            Route::get('security.html', 'User\SecurityController@security'); // security
//        });
//
//        // 账号绑定
////        Route::group(['prefix' => 'bind'], function () {
////            Route::get('bind.html', 'User\BindController@index'); // index
////        });
//
//        // 我的收藏
//        Route::group(['prefix' => 'collect'], function () {
//            Route::post('toggle', 'User\CollectController@toggle'); // 商品收藏/取消收藏
//        });
//
//        // 收货地址
//        Route::group(['prefix' => 'address'], function () {
//            Route::get('index.html', 'User\AddressController@index'); // index
//            Route::get('add.html', 'User\AddressController@add'); // add
//            Route::get('edit.html', 'User\AddressController@edit'); // edit
//            Route::post('add.html', 'User\AddressController@saveData'); // saveData
//            Route::post('edit.html', 'User\AddressController@saveData'); // saveData
//            Route::get('set-default', 'User\AddressController@setDefault'); // setDefault
//            Route::get('del', 'User\AddressController@delete'); // 删除
//
//
//        });
//
//    });
//
//});