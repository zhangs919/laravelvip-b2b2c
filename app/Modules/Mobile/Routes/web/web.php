<?php
//
//// +----------------------------------------------------------------------
//// | laravelvip 乐融沃B2B2C商城系统
//// +----------------------------------------------------------------------
//// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
//// +----------------------------------------------------------------------
//// | Notice: This code is not open source, it is strictly prohibited
//// |         to distribute the copy, otherwise it will pursue its
//// |         legal responsibility.
//// +----------------------------------------------------------------------
//// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
//// | 网站地址: http://www.laravelvip.com
//// +----------------------------------------------------------------------
//// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
//// | 如需使用，请移步官网购买正版授权。
//// +----------------------------------------------------------------------
//// | Author: 雲溪荏苒 <290648237@qq.com>
//// | Date:2018-08-17
//// | Description:
//// +----------------------------------------------------------------------
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| This file is where you may define all of the routes that are handled
//| by your module. Just tell Laravel the URIs it should respond
//| to using a Closure or controller method. Build something great!
//|
//*/
//
//Route::group(['domain' => env('MOBILE_DOMAIN')], function ($router) {
//
//
//
//
//    // 首页
//    Route::get('/', 'HomeController@home')->name('mobile_home');
//    Route::get('/index.html', 'HomeController@home')->name('mobile_home');
//
//    // 商品全部分类
//    Route::get('/category.html', 'CategoryController@index')->name('m_category');
//
//    // 购物车
//    Route::get('/cart.html', 'CartController@index')->name('m_cart');
//    Route::group(['prefix' => 'cart'], function () {
////        Route::get('box-goods-list.html', 'CartController@boxGoodsList'); // 顶部和右边购物车盒子
//        Route::post('add.html', 'CartController@add'); // 添加购物车
//        Route::post('remove.html', 'CartController@remove'); // 移除购物车
//        Route::post('delete.html', 'CartController@delete'); // 移除购物车
//        Route::post('select', 'CartController@select'); // 选择购物车商品
//        Route::post('change-number', 'CartController@changeNumber'); // 更改购物车商品数量
//    });
//
//
//    // Site Route
//    Route::group(['prefix' => 'site'], function () {
//
//        Route::get('user', 'SiteController@user');
//        Route::get('user.html', 'SiteController@user');
//        Route::get('get-session-id', 'SiteController@getSessionId');
//        Route::get('get-new-order-list.html', 'SiteController@getNewOrderList');
//
//
//
//        Route::get('captcha.html', 'SiteController@captcha');
//        Route::get('region-list', 'SiteController@regionList'); // regionList
//        Route::post('upload-image', 'SiteController@uploadImage'); // 用户上传图片
//        Route::get('tpl-data', 'SiteController@tplData'); // tplData ajax 渲染模板数据
//
//    });
//
//    // Passport Route
//    $router->get('login.html', 'PassportController@showLoginForm'); // showLoginForm
//    $router->post('login', 'PassportController@login'); // login
//    $router->post('login.html', 'PassportController@login'); // login
//    $router->any('register.html', 'PassportController@showRegisterForm'); // showRegisterForm
//    $router->any('register/mobile.html', 'PassportController@showRegisterForm'); // showRegisterForm
//
//    $router->any('register/email.html', 'PassportController@showRegisterForm'); // showRegisterForm
//    $router->get('register/client-validate', 'PassportController@clientValidate'); // clientValidate
//    $router->post('register/sms-captcha', 'PassportController@smsCaptcha'); // smsCaptcha
//
//    $router->get('site/logout.html', 'PassportController@logout'); // logout
//
//
//    // Topic Route
//    $router->get('/topic/{topic_id}.html', 'TopicController@show')->name('show_m_topic');
//
//
//    // News Route
//    Route::get('/news.html', 'NewsController@home')->name('m_news_home'); // index
//    Route::group(['prefix' => 'news'], function () {
//        Route::get('/', 'NewsController@home')->name('m_news_home'); // index
//        Route::get('list/{cat_id}.html', 'NewsController@lists')->name('m_news_list'); // lists
//        Route::get('{article_id}.html', 'NewsController@show')->name('m_show_news'); // show
//
//    });
//
//
//    // 商品
//    Route::get('/goods-{goods_id}.html', 'GoodsController@showGoods')->name('show_m_goods'); // showGoods
//    Route::get('/list-{filter_str}.html', 'GoodsController@goodsList')->name('m_goods_list'); // goodsList
//    Route::get('/{sku_id}.html', 'GoodsController@showGoods')->name('show_m_sku_goods'); // showSkuGoods
//
//    Route::group(['prefix' => 'goods'], function () {
//        Route::get('sku.html', 'GoodsController@sku'); // sku
//        Route::get('sku', 'GoodsController@sku'); // sku
//
//        Route::get('desc', 'GoodsController@desc'); // goods_desc
//        Route::get('qrcode.html', 'GoodsController@qrcode'); // qrcode
//        Route::get('comment', 'GoodsController@comment'); // comment
//        Route::get('change-location.html', 'GoodsController@changeLocation'); // changeLocation
//        Route::post('search-pickup.html', 'GoodsController@searchPickup'); // 搜索自提点
//    });
//    Route::get('/index/information/amap', 'IndexController@amap'); // 高德地图查看详情
//
//    Route::group(['prefix'=>'shop'], function () {
//        Route::get('street/index.html', 'ShopController@street')->name('m_shop_street'); // 店铺街
//        Route::get('street/index', 'ShopController@street');
//        Route::get('street/open-list', 'ShopController@openList');
//
//        Route::get('{shop_id}.html', 'ShopController@shopHome')->name('mobile_shop_home'); // 店铺首页
//        Route::get('{shop_id}/list.html', 'ShopController@shopGoods')->name('m_shop_goods'); // 店铺内所有商品
//        Route::get('{shop_id}/info.html', 'ShopController@shopInfo')->name('m_shop_info'); // 店铺详情
//        Route::get('index/info', 'ShopController@info');
//
//
//
//    });
//});
