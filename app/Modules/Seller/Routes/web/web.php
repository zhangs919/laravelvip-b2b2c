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


Route::group(['domain' => config('lrw.seller_domain')], function ($router) {

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
        Route::get('cat-list', 'SiteController@catList'); // 异步加载商品分类
        Route::get('cat-list.html', 'SiteController@catList'); // 异步加载商品分类
        Route::get('shop-cat-list.html', 'SiteController@shopCatList'); // 异步加载店铺分类列表
        Route::any('video-selector', 'SiteController@videoSelector'); // videoSelector
        Route::any('video-selector.html', 'SiteController@videoSelector'); // videoSelector
        Route::any('image-selector', 'SiteController@imageSelector'); // imageSelector
        Route::any('image-selector.html', 'SiteController@imageSelector'); // imageSelector
        Route::any('tpl-backup', 'SiteController@tplBackup'); // tplBackup 模板备份
        Route::any('tpl-backup.html', 'SiteController@tplBackup'); // tplBackup 模板备份
        Route::get('tpl-data', 'SiteController@tplData'); // tplData ajax 渲染模板数据


        Route::get('get-qrcode-login-key', 'SiteController@getQrcodeLoginKey'); // 获取二维码登录key信息
//        Route::get('qrcode-login.html', 'SiteController@qrcodeLogin'); //

        Route::get('update-message', 'SiteController@updateMessage'); // updateMessage
        Route::get('update-message.html', 'SiteController@updateMessage'); // updateMessage
        Route::post('message-update', 'SiteController@messageUpdate'); // messageUpdate

        Route::get('sale-region-list.html', 'SiteController@regionList'); // regionList 售卖地区列表

        Route::post('clear-cache', 'SiteController@clearCache')->name('system-clear-cache'); // 清理缓存

        Route::get('image-hot-link', 'SiteController@imageHotLink'); //
        Route::get('spec-list.html', 'SiteController@specList'); //
        Route::get('prop-list', 'SiteController@propList'); //
        Route::get('spec-value-list.html', 'SiteController@specValueList'); //
        Route::get('progress.html', 'SiteController@progress'); // 导入数据执行进度

        Route::get('auto-print', 'SiteController@autoPrint'); //


    });

    // Passport Route
    $router->get('login', 'PassportController@showLoginForm')->name('seller.login'); // showLoginForm
    $router->get('login.html', 'PassportController@showLoginForm')->name('seller.login'); // showLoginForm
    $router->post('login', 'PassportController@login'); // login
    $router->any('site/logout', 'PassportController@logout')->name('seller.logout'); // logout

    // WorkerMan Route
    $router->get('workerman/test', 'WorkerManController@test');
    $router->get('workerman/test_view', 'WorkerManController@test_view');

});
