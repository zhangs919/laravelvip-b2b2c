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

Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {
    Route::get('/', 'MainController@index'); // main
    Route::get('main', 'MainController@index'); // main

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
        Route::any('video-selector', 'SiteController@videoSelector'); // videoSelector
        Route::any('video-selector.html', 'SiteController@videoSelector'); // videoSelector
        Route::any('image-selector', 'SiteController@imageSelector'); // imageSelector
        Route::any('image-selector.html', 'SiteController@imageSelector'); // imageSelector
        Route::any('tpl-backup', 'SiteController@tplBackup'); // tplBackup 模板备份
        Route::get('tpl-data', 'SiteController@tplData'); // tplData ajax 渲染模板数据

        Route::get('update-message', 'SiteController@updateMessage'); // updateMessage
        Route::post('message-update', 'SiteController@messageUpdate'); // messageUpdate
        Route::post('send-test-mail', 'SiteController@sendTestMail'); // sendTestMail 邮件设置 发送测试邮件
        Route::post('send-test-sms', 'SiteController@sendTestSms'); // sendTestSms 短信设置 发送测试短信

        Route::get('progress.html', 'SiteController@progress'); // 导入数据执行进度


    });

    // Passport Route
    $router->get('login', 'PassportController@showLoginForm')->name('admin.login'); // showLoginForm
    $router->get('login.html', 'PassportController@showLoginForm'); // showLoginForm
    $router->post('login', 'PassportController@login'); // login
    $router->post('login.html', 'PassportController@login'); // login
    $router->post('site/logout', 'PassportController@logout')->name('admin.logout'); // logout



    // Main Route
//    Route::get('main', 'MainController@index')->name('index'); // main

    /**** Index Module Route****/

    /**** Article Module Route****/

    /**** System Module Route****/

    /**** Design Module Route****/

    /**** Topic Module Route****/

});


Route::group(['domain' => env('PUSH_DOMAIN')], function ($router) {

    Route::get('/', 'PushController@index');
});
