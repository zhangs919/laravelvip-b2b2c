<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Route;


//Route::group(['domain' => 'a.laravelmall.cc'], function () {
//   Route::get('/', function () {
//       return 123;
//   });
//});


Route::group(['domain' => config('lrw.store_domain')], function ($router) {

    // Site Route
    Route::group(['prefix' => 'site'], function () {
        Route::any('image-gallery', 'SiteController@imageGallery'); // imageGallery
        Route::any('video-gallery', 'SiteController@videoGallery'); // videoGallery
        Route::post('upload-image', 'SiteController@uploadImage'); // uploadImage
        Route::post('upload-goods-desc-image', 'SiteController@uploadGoodsDescImage'); // uploadGoodsDescImage 上传PC端商品描述图片
        Route::post('upload-mobile-image', 'SiteController@uploadMobileImage'); // uploadMobileImage 上传Mobile端商品描述图片
        Route::post('upload-goods-image', 'SiteController@uploadGoodsImage'); // uploadGoodsImage 上传商品图片
        Route::get('region-list', 'SiteController@regionList'); // regionList
        Route::get('region-list.html', 'SiteController@regionList'); // regionList
        Route::get('cat-list', 'SiteController@catList'); // catList
        Route::post('video-selector', 'SiteController@videoSelector'); // videoSelector
        Route::any('image-selector', 'SiteController@imageSelector'); // imageSelector
        Route::any('tpl-backup', 'SiteController@tplBackup'); // tplBackup 模板备份
        Route::get('update-message', 'SiteController@updateMessage'); // updateMessage
        Route::post('message-update', 'SiteController@messageUpdate'); // messageUpdate



    });

    // Passport Route
    $router->get('login', 'PassportController@showLoginForm')->name('store.login'); // showLoginForm
    $router->get('login.html', 'PassportController@showLoginForm')->name('store.login'); // showLoginForm
    $router->post('login', 'PassportController@login'); // login
    $router->post('site/logout', 'PassportController@logout')->name('store.logout'); // logout


    // Index Route
    Route::get('/', 'Goods\ListController@lists'); // 首页/商品列表
    Route::get('/index', 'Goods\ListController@lists')->name('store_home'); // 网点中心首页
    Route::get('/index.html', 'Goods\ListController@lists')->name('store_home'); // 网点中心首页
    Route::get('/goods/list', 'Goods\ListController@lists')->name('store_home'); // 网点中心首页

});
