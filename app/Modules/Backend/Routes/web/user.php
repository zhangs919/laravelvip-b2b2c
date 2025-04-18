<?php


Route::group(['domain' => config('lrw.backend_domain')], function ($router) {


    // User Route
    Route::group(['prefix' => 'user'], function () {

        Route::group(['prefix' => 'user'], function () {
            Route::get('list', 'User\UserController@lists')->name('user-list'); // lists
            Route::get('add', 'User\UserController@add')->name('user-add'); // add
            Route::post('add', 'User\UserController@saveData')->name('user-add'); // saveData
            Route::get('edit', 'User\UserController@edit')->name('user-edit'); // edit
            Route::post('edit', 'User\UserController@saveData')->name('user-edit'); // saveData
            Route::any('real-info', 'User\UserController@realInfo')->name('user-list'); // 实名认证信息
            Route::get('card-search', 'User\UserController@cardSearch')->name('user-list'); // 在线查询身份证
            Route::get('address-info', 'User\UserController@addressInfo')->name('user-list'); // 收货地址信息
            Route::any('edit-desc', 'User\UserController@editDesc')->name('user-list'); // 编辑会员备注信息

            Route::get('set-status', 'User\UserController@setStatus')->name('user-list'); // setStatus
            Route::get('client-validate', 'User\UserController@clientValidate')->name('user-list'); // clientValidate
            Route::get('del', 'User\UserController@delete')->name('user-delete'); // delete
            Route::post('update-user-rank', 'User\UserController@updateUserRank')->name('user-list'); // 重建会员等级关联关系
            Route::get('export', 'User\UserController@export')->name('user-export'); // 导出数据
            Route::any('batch-add', 'User\UserController@batchAdd')->name('user-list'); // 批量导入会员
            Route::any('user-batch-upload', 'User\UserController@userBatchUpload')->name('user-list'); // 上传ecshop数据源
            Route::get('download', 'User\UserController@download')->name('user-list'); // 下载上传会员文件模板


        });


        // 会员等级 Route
        Route::group(['prefix' => 'user-rank'], function () {
            Route::get('list', 'User\UserRankController@lists')->name('user-rank-list'); // lists
            Route::get('index', 'User\UserRankController@lists')->name('user-rank-list'); // lists
            Route::get('add', 'User\UserRankController@add')->name('user-rank-add'); // add
            Route::post('add', 'User\UserRankController@saveData')->name('user-rank-add'); // saveData
            Route::get('edit', 'User\UserRankController@edit')->name('user-rank-edit'); // edit
            Route::post('edit', 'User\UserRankController@saveData')->name('user-rank-edit'); // saveData
            Route::get('client-validate', 'User\UserRankController@clientValidate')->name('user-rank-list'); // clientValidate
            Route::get('delete', 'User\UserRankController@delete')->name('user-rank-delete'); // delete
            Route::post('upload-rank-image', 'User\UserRankController@uploadRankImage')->name('user-rank-list'); // uploadRankImage
        });

        // 店铺会员等级
        Route::group(['prefix' => 'shop'], function () {
            Route::get('list', 'User\ShopController@lists')->name('shop-user-rank-list'); // lists
            Route::get('add', 'User\ShopController@add')->name('shop-user-rank-add'); // add
            Route::post('add', 'User\ShopController@saveData')->name('shop-user-rank-add'); // saveData
            Route::get('edit', 'User\ShopController@edit')->name('shop-user-rank-edit'); // edit
            Route::post('edit', 'User\ShopController@saveData')->name('shop-user-rank-edit'); // saveData
            Route::get('client-validate', 'User\ShopController@clientValidate')->name('shop-user-rank-list'); // clientValidate
            Route::post('delete', 'User\ShopController@delete')->name('shop-user-rank-delete'); // delete
        });

        // 社交 主播认证申请列表
        Route::group(['prefix' => 'live-user'], function () {
            Route::get('list', 'User\LiveUserController@lists')->name('user-live-user-list'); // lists
            Route::get('audit-list', 'User\LiveUserController@auditList')->name('user-live-user-audit-list'); // lists
            Route::any('audit', 'User\LiveUserController@audit')->name('user-live-user-audit'); //
        });
    });

});