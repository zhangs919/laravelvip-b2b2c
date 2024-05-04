<?php

Route::group(['domain' => config('lrw.seller_domain')], function ($router) {

    // Finance Route
    Route::group(['prefix' => 'finance'], function () {
        // SellerAccount
        Route::group(['prefix' => 'seller-account'], function () {
            Route::get('list', 'Finance\SellerAccountController@lists'); // lists
            Route::get('list.html', 'Finance\SellerAccountController@lists'); // lists

        });

        // AccountDetail
        Route::group(['prefix' => 'account-detail'], function () {
            Route::get('list', 'Finance\AccountDetailController@lists'); // lists
            Route::get('list.html', 'Finance\AccountDetailController@lists'); // lists

        });

        // Bill
        Route::group(['prefix' => 'bill'], function () {
            Route::get('shop-bill', 'Finance\BillController@shopBill'); //
            Route::get('store-bill', 'Finance\BillController@storeBill'); //
            Route::get('shop-orders-info', 'Finance\BillController@shopOrdersInfo'); //

            Route::get('export-shop.html', 'Finance\BillController@exportShop'); //
            Route::get('export-store.html', 'Finance\BillController@exportStore'); //

        });
    });

});