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

$prefix = '';
$lrw_tag = get_lrw_tag();
if (strlen($lrw_tag) == 7) {
    $prefix = $lrw_tag;
}

Route::group(['domain' => config('lrw.mobile_domain'), 'prefix' => $prefix], function ($router) {


    Route::group(['prefix' => 'index'], function () {

        Route::group(['prefix' => 'information'], function () {
            Route::get('is-weixin.html', 'Index\InformationController@isWeixin'); // isWeixin
            Route::get('is-follow.html', 'Index\InformationController@isFollow'); // isFollow
            Route::get('search-record', 'Index\InformationController@searchRecord'); // searchRecord
            Route::post('get-weixinconfig.html', 'Index\InformationController@getWeiXinConfig'); // getWeiXinConfig
            Route::get('amap', 'Index\InformationController@amap'); // 高德地图
            Route::get('go', 'Index\InformationController@go'); //

        });
    });


});
