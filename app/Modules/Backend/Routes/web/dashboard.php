<?php


Route::group(['domain' => config('lrw.backend_domain')], function ($router) {


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

        // 红包
        Route::group(['prefix' => 'bonus'], function () {
            Route::get('config', 'Dashboard\BonusController@config'); // config

            Route::get('list', 'Dashboard\BonusController@lists'); // lists
            Route::get('add', 'Dashboard\BonusController@add'); // add
            Route::post('add', 'Dashboard\BonusController@saveData'); // saveData
            Route::get('view', 'Dashboard\BonusController@view'); // view
            Route::get('push', 'Dashboard\BonusController@push'); // 推广
            Route::get('qrcode', 'Dashboard\BonusController@qrcode'); // 生成二维码
            Route::get('download-qcode', 'Dashboard\BonusController@downloadQcode'); // 下载二维码
            Route::get('download-push-picture', 'Dashboard\BonusController@downloadPushPicture'); // 下载推广图

            Route::post('enable', 'Dashboard\BonusController@enable'); // 作废红包
            Route::post('delete', 'Dashboard\BonusController@delete'); // delete
            Route::post('edit-sort', 'Dashboard\BonusController@editSort'); // editSort


        });

        // 用户红包
        Route::group(['prefix' => 'user-bonus'], function () {
            Route::get('list', 'Dashboard\UserBonusController@lists'); // lists
            Route::get('add', 'Dashboard\UserBonusController@add'); // add

        });

        // 团购活动 ok
        Route::group(['prefix' => 'group-buy'], function () {
            Route::get('list', 'Dashboard\GroupBuyController@lists'); // lists
            Route::get('view', 'Dashboard\GroupBuyController@view'); // view
            Route::get('slide-config', 'Dashboard\GroupBuyController@slideConfig'); //
            Route::post('delete', 'Dashboard\GroupBuyController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\GroupBuyController@batchDelete'); // batchDelete
            Route::post('change-sort', 'Dashboard\GroupBuyController@changeSort'); //
            Route::get('set-is-recommend', 'Dashboard\GroupBuyController@setIsRecommend'); //

        });

        // 团购分类
        Route::group(['prefix' => 'activity-category'], function () {
            Route::get('list', 'Dashboard\ActivityCategoryController@lists'); // lists
            Route::get('add', 'Dashboard\ActivityCategoryController@add'); // add
            Route::post('add', 'Dashboard\ActivityCategoryController@saveData'); // saveData
            Route::get('edit', 'Dashboard\ActivityCategoryController@edit'); // edit
            Route::post('edit', 'Dashboard\ActivityCategoryController@saveData'); // saveData
            Route::post('delete', 'Dashboard\ActivityCategoryController@delete'); // delete
            Route::post('edit-sort', 'Dashboard\ActivityCategoryController@editSort'); //
            Route::get('set-is-show', 'Dashboard\ActivityCategoryController@setShow'); //

        });

        // 搭配套餐
        Route::group(['prefix' => 'goods-mix'], function () {
            Route::get('list', 'Dashboard\GoodsMixController@lists'); // lists
            Route::get('check', 'Dashboard\GoodsMixController@check'); // check
            Route::post('delete', 'Dashboard\GoodsMixController@delete'); // delete

        });

        // 限时折扣 ok
        Route::group(['prefix' => 'limit-discount'], function () {
            Route::get('list', 'Dashboard\LimitDiscountController@lists'); // lists
            Route::get('view', 'Dashboard\LimitDiscountController@view'); //
            Route::post('delete', 'Dashboard\LimitDiscountController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\LimitDiscountController@batchDelete'); // batchDelete

        });

        // 赠品活动 ok
        Route::group(['prefix' => 'gift'], function () {
            Route::get('list', 'Dashboard\GiftController@lists'); // lists
//            Route::get('add', 'Dashboard\GiftController@add'); // add
//            Route::get('edit', 'Dashboard\GiftController@edit'); // edit
//            Route::post('add', 'Dashboard\GiftController@saveData'); // saveData
//            Route::post('edit', 'Dashboard\GiftController@saveData'); // saveData
            Route::post('delete', 'Dashboard\GiftController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\GiftController@batchDelete'); // batchDelete
//            Route::any('picker', 'Dashboard\GiftController@picker'); //
//            Route::post('goods-info', 'Dashboard\GiftController@goodsInfo');


        });

        // 满减/送 ok
        Route::group(['prefix' => 'full-cut'], function () {
            Route::get('list', 'Dashboard\FullCutController@lists'); // lists
//            Route::get('add', 'Dashboard\FullCutController@add'); // add
//            Route::get('edit', 'Dashboard\FullCutController@edit'); // edit
//            Route::post('add', 'Dashboard\FullCutController@saveData'); // saveData
//            Route::post('edit', 'Dashboard\FullCutController@saveData'); // saveData
//            Route::get('reload-list.html', 'Dashboard\FullCutController@reloadList'); // reloadList
            Route::post('delete', 'Dashboard\FullCutController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\FullCutController@batchDelete'); // batchDelete
//            Route::any('picker', 'Dashboard\FullCutController@picker'); // add


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

        // 自由购
        Route::group(['prefix' => 'freebuy'], function () {
            Route::get('list', 'Dashboard\FreebuyController@lists'); // 自由购订单

        });

        // 堂内点餐
        Route::group(['prefix' => 'reachbuy'], function () {
            Route::get('list', 'Dashboard\ReachbuyController@lists'); // 堂内点餐订单

        });
    });

});