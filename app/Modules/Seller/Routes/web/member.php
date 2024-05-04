<?php

Route::group(['domain' => config('lrw.seller_domain')], function ($router) {

    // 会员
    Route::group(['prefix' => 'member'], function () {

        // 会员管理
        Route::group(['prefix' => 'member'], function () {
            Route::get('user-list', 'Member\MemberController@userList'); // 会员列表
            Route::get('add', 'Member\MemberController@add'); // 手工录入会员
            Route::post('add', 'Member\MemberController@saveData'); // saveData
            Route::get('batch-add', 'Member\MemberController@batchAdd'); // 批量导入会员
            Route::get('user-info', 'Member\MemberController@userInfo'); // 会员详情
            Route::post('user-info', 'Member\MemberController@userInfoSave'); // 更新会员信息
            Route::get('user-address', 'Member\MemberController@userAddress'); // 会员收货地址
            Route::post('add-to-erp', 'Member\MemberController@addToErp'); // 添加到erp
            Route::any('edit-desc', 'Member\MemberController@editDesc'); // 编辑会员备注

        });

        Route::group(['prefix' => 'rank'], function () {
            Route::get('list', 'Member\RankController@lists'); // lists
            Route::get('add', 'Member\RankController@add'); // add
            Route::get('edit', 'Member\RankController@edit'); // add
            Route::post('add', 'Member\RankController@saveData'); // saveData
            Route::get('get-level-name', 'Member\RankController@getLevelName'); // 获取会员等级名称
            Route::get('client-validate', 'Member\RankController@clientValidate'); // clientValidate
            Route::get('set-is-enable', 'Member\RankController@setIsEnable'); // 设置是否启用
            Route::post('delete', 'Member\RankController@delete'); // delete

        });
    });

});