<?php


Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {


    // Dashboard Route 营销中心
    Route::group(['prefix' => 'dashboard'], function () {

        // 营销中心 Center
        Route::group(['prefix' => 'center'], function () {
            Route::get('index', 'Dashboard\CenterController@index'); // index

        });

        // 店铺营销权限 ShopAuth
        Route::group(['prefix' => 'shop-auth'], function () {
            Route::get('index', 'Dashboard\ShopAuthController@index')->name('shop-auth'); // index
            Route::get('view', 'Dashboard\ShopAuthController@view')->name('shop-auth'); // view
            Route::any('set-auth', 'Dashboard\ShopAuthController@setAuth')->name('shop-auth'); // setAuth
            Route::get('all-auth', 'Dashboard\ShopAuthController@allAuth')->name('shop-auth'); // allAuth

        });

        // 积分商城
        Route::group(['prefix' => 'integral-mall'], function () {
            Route::get('revision', 'Dashboard\IntegralMallController@revision'); // 核销
            Route::post('revision', 'Dashboard\IntegralMallController@doRevision'); // 开始核销
            Route::get('get-order', 'Dashboard\IntegralMallController@getOrder'); // 扫码订单二维码核销 搜索

            Route::get('integral-goods-list', 'Dashboard\IntegralMallController@integralGoodsList'); // 积分兑换商品
            Route::get('add-integral-goods', 'Dashboard\IntegralMallController@addIntegralGoods'); // 添加积分兑换商品
            Route::post('add-integral-goods', 'Dashboard\IntegralMallController@saveIntegralGoods'); // 保存数据
            Route::get('edit-integral-goods', 'Dashboard\IntegralMallController@editIntegralGoods'); // 编辑积分兑换商品
            Route::post('edit-integral-goods', 'Dashboard\IntegralMallController@saveIntegralGoods'); // 保存数据
            Route::post('set-goods-status', 'Dashboard\IntegralMallController@setGoodsStatus'); // 积分商品 上架/下架
            Route::post('edit-integral-goods-info', 'Dashboard\IntegralMallController@editIntegralGoodsInfo'); // 列表更新字段信息
            Route::post('del-integral-goods', 'Dashboard\IntegralMallController@delIntegralGoods'); // 删除积分商品

            /*上面的ok*/

            Route::get('integral-order-list', 'Dashboard\IntegralMallController@integralOrderList'); // 积分兑换列表
            Route::get('integral-bonus-list', 'Dashboard\IntegralMallController@integralBonusList'); // 积分兑换红包
            Route::get('integral-mall-index-set', 'Dashboard\IntegralMallController@integralMallIndexSet'); // 积分商城首页设置
            Route::get('integral-mall-set', 'Dashboard\IntegralMallController@integralMallSet'); // 积分商城设置

        });

        // 数据导出
        Route::group(['prefix' => 'data-export'], function () {
            Route::get('index', 'Dashboard\DataExportController@index');
        });

        // 万能表单
        Route::group(['prefix' => 'custom-form'], function () {
            Route::get('list', 'Dashboard\CustomFormController@lists'); // lists
            Route::get('list.html', 'Dashboard\CustomFormController@lists'); // lists
            Route::get('edit', 'Dashboard\CustomFormController@edit'); // 设计表单
            Route::get('add', 'Dashboard\CustomFormController@add'); // 添加万能表单
            Route::post('add', 'Dashboard\CustomFormController@saveData'); // saveData
            Route::get('edit-form', 'Dashboard\CustomFormController@editForm'); // 修改万能表单
            Route::post('edit-form', 'Dashboard\CustomFormController@saveData'); // saveData
            Route::get('template', 'Dashboard\CustomFormController@template'); // 选择模板
            Route::any('design', 'Dashboard\CustomFormController@design'); // 装修
            Route::any('design.html', 'Dashboard\CustomFormController@design'); // 装修
            Route::get('form-qrcode.html', 'Dashboard\CustomFormController@formQrcode'); // 生成表单二维码
            Route::post('preview', 'Dashboard\CustomFormController@preview'); // 预览
            Route::post('preview.html', 'Dashboard\CustomFormController@preview'); // 预览


            Route::get('del.html', 'Dashboard\CustomFormController@delete'); // delete


        });

        // 万能表单数据
        Route::group(['prefix' => 'custom-form-data'], function () {
            Route::get('list', 'Dashboard\CustomFormDataController@lists'); // lists
            Route::get('view', 'Dashboard\CustomFormDataController@view'); // 统计视图
            Route::get('detail', 'Dashboard\CustomFormDataController@detail'); // 查看明细
        });

    });

});