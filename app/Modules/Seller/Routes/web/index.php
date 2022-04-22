<?php

Route::group(['domain' => env('SELLER_DOMAIN')], function ($router) {



// Index Route
    Route::get('/', 'Index\IndexController@welcome')->name('seller_home'); // welcome
    Route::get('/index', 'Index\IndexController@welcome')->name('seller_home'); // welcome
    Route::get('index/index/seller-guide', 'Index\IndexController@sellerGuide'); // sellerGuide
    Route::get('index/index/guide-show', 'Index\IndexController@guideShow'); // guideShow

    Route::get('index/index/get-data', 'Index\IndexController@getData'); // getData
    Route::get('index/index/show-message', 'Index\IndexController@showMessage'); // showMessage
    Route::get('index/index/expiration-reminding', 'Index\IndexController@expirationReminding'); // expirationReminding
    Route::get('index/index/guide', 'Index\IndexController@guide'); // guide

});
