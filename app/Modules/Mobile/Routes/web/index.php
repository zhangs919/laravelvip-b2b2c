<?php
//
//use \Illuminate\Http\Request;
//use \App\Modules\Frontend\Http\Controllers;
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
//    Route::group(['prefix' => 'index'], function () {
//
//        Route::group(['prefix' => 'information'], function () {
//            Route::get('is-weixin.html', 'Index\InformationController@isWeixin'); // isWeixin
//            Route::get('is-follow.html', 'Index\InformationController@isFollow'); // isFollow
//            Route::get('search-record', 'Index\InformationController@searchRecord'); // searchRecord
//            Route::get('get-weixinconfig.html', 'Index\InformationController@getWeiXinConfig'); // getWeiXinConfig
//        });
//    });
//
//
//});
