<?php


Route::group(['domain' => env('SELLER_DOMAIN')], function ($router) {


    // Dashboard Route 营销中心
    Route::group(['prefix' => 'dashboard'], function () {

        // 营销中心 Center
        Route::group(['prefix' => 'center'], function () {
            Route::get('index', 'Dashboard\CenterController@index'); // index

        });

        // 红包
        Route::group(['prefix' => 'bonus'], function () {
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

        });

        // 团购活动 ok
        Route::group(['prefix' => 'group-buy'], function () {
            Route::get('list', 'Dashboard\GroupBuyController@lists'); // lists
            Route::get('add', 'Dashboard\GroupBuyController@add'); // add
            Route::get('edit', 'Dashboard\GroupBuyController@edit'); // edit
            Route::post('add', 'Dashboard\GroupBuyController@saveData'); // saveData
            Route::post('edit', 'Dashboard\GroupBuyController@saveData'); // saveData
            Route::get('view', 'Dashboard\GroupBuyController@view'); // view
            Route::post('delete', 'Dashboard\GroupBuyController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\GroupBuyController@batchDelete'); // batchDelete
            Route::get('picker', 'Dashboard\ActivityGoodsController@picker'); // add
            Route::post('goods-info', 'Dashboard\GroupBuyController@goodsInfo');
            Route::post('upload-act_img', 'Dashboard\GroupBuyController@uploadActImg'); // 上传活动图片


        });

        // 活动商品选择器
        Route::group(['prefix' => 'activity-goods'], function () {
            Route::get('picker', 'Dashboard\ActivityGoodsController@picker'); //
        });

        // 赠品活动 ok
        Route::group(['prefix' => 'gift'], function () {
            Route::get('list', 'Dashboard\GiftController@lists'); // lists
            Route::get('add', 'Dashboard\GiftController@add'); // add
            Route::get('edit', 'Dashboard\GiftController@edit'); // edit
            Route::post('add', 'Dashboard\GiftController@saveData'); // saveData
            Route::post('edit', 'Dashboard\GiftController@saveData'); // saveData
            Route::post('delete', 'Dashboard\GiftController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\GiftController@batchDelete'); // batchDelete
            Route::get('picker', 'Dashboard\ActivityGoodsController@picker'); // add
            Route::post('goods-info', 'Dashboard\GiftController@goodsInfo');


        });

        // 搭配套餐
        Route::group(['prefix' => 'goods-mix'], function () {
            Route::get('list', 'Dashboard\GoodsMixController@lists'); // lists
            Route::get('add', 'Dashboard\GoodsMixController@add'); // add
            Route::get('check', 'Dashboard\GoodsMixController@check'); // check
            Route::post('add', 'Dashboard\GoodsMixController@saveData'); // saveData
            Route::post('delete', 'Dashboard\GoodsMixController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\GoodsMixController@batchDelete'); // batchDelete
            Route::get('picker', 'Dashboard\ActivityGoodsController@picker'); // add
            Route::get('sku-info', 'Dashboard\GoodsMixController@skuInfo'); // skuInfo
            Route::post('goods-info', 'Dashboard\GoodsMixController@goodsInfo');


        });

        // 限时折扣 ok
        Route::group(['prefix' => 'limit-discount'], function () {
            Route::get('list', 'Dashboard\LimitDiscountController@lists'); // lists
            Route::get('add', 'Dashboard\LimitDiscountController@add'); // add
            Route::get('edit', 'Dashboard\LimitDiscountController@edit'); // edit
            Route::post('add', 'Dashboard\LimitDiscountController@saveData'); // saveData
            Route::post('delete', 'Dashboard\LimitDiscountController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\LimitDiscountController@batchDelete'); // batchDelete
            Route::get('picker', 'Dashboard\ActivityGoodsController@picker'); // add
//            Route::get('sku-info', 'Dashboard\LimitDiscountController@skuInfo'); // skuInfo
            Route::post('goods-info', 'Dashboard\LimitDiscountController@goodsInfo');
            Route::post('edit-act-info', 'Dashboard\LimitDiscountController@editActInfo'); // editActInfo


        });

        // 满减/送 ok
        Route::group(['prefix' => 'full-cut'], function () {
            Route::get('list', 'Dashboard\FullCutController@lists'); // lists
            Route::get('add', 'Dashboard\FullCutController@add'); // add
            Route::get('edit', 'Dashboard\FullCutController@edit'); // edit
            Route::post('add', 'Dashboard\FullCutController@saveData'); // saveData
            Route::post('edit', 'Dashboard\FullCutController@saveData'); // saveData
            Route::get('reload-list.html', 'Dashboard\FullCutController@reloadList'); // reloadList
            Route::post('delete', 'Dashboard\FullCutController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\FullCutController@batchDelete'); // batchDelete
            Route::get('picker', 'Dashboard\ActivityGoodsController@picker'); // add


        });

        // 拼团
        Route::group(['prefix' => 'fight-group'], function () {
            Route::get('list', 'Dashboard\FightGroupController@lists'); // lists
            Route::get('add', 'Dashboard\FightGroupController@add'); // add
            Route::get('view', 'Dashboard\FightGroupController@view'); // view
            Route::post('add', 'Dashboard\FightGroupController@saveData'); // saveData
            Route::post('delete', 'Dashboard\FightGroupController@delete'); // delete
            Route::post('batch-delete', 'Dashboard\FightGroupController@batchDelete'); // batchDelete
            Route::get('picker', 'Dashboard\ActivityGoodsController@picker'); // add
            Route::get('change-mode', 'Dashboard\FightGroupController@changeMode'); // changeMode 更换优惠模式


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

            Route::get('integral-mall-set', 'Dashboard\IntegralMallController@integralMallSet'); // 积分商城设置

        });


        // 万能表单 ok
        Route::group(['prefix' => 'custom-form'], function () {
            Route::get('list', 'Dashboard\CustomFormController@lists'); // lists
            Route::get('list.html', 'Dashboard\CustomFormController@lists'); // lists
            Route::get('edit', 'Dashboard\CustomFormController@edit'); // 设计表单
            Route::get('add', 'Dashboard\CustomFormController@add'); // 添加万能表单
            Route::post('add', 'Dashboard\CustomFormController@saveData'); // saveData
            Route::post('add.html', 'Dashboard\CustomFormController@saveData'); // saveData
            Route::get('edit-form', 'Dashboard\CustomFormController@editForm'); // 修改万能表单
            Route::post('edit-form', 'Dashboard\CustomFormController@saveData'); // saveData
            Route::post('edit-form.html', 'Dashboard\CustomFormController@saveData'); // saveData
            Route::get('template', 'Dashboard\CustomFormController@template'); // 选择模板
            Route::get('template.html', 'Dashboard\CustomFormController@template'); // 选择模板
            Route::any('design', 'Dashboard\CustomFormController@design'); // 装修
            Route::any('design.html', 'Dashboard\CustomFormController@design'); // 装修
            Route::get('form-qrcode.html', 'Dashboard\CustomFormController@formQrcode'); // 生成表单二维码
            Route::post('preview', 'Dashboard\CustomFormController@preview'); // 预览
            Route::post('preview.html', 'Dashboard\CustomFormController@preview'); // 预览


            Route::get('del.html', 'Dashboard\CustomFormController@delete'); // delete


        });

        // 万能表单数据 ok
        Route::group(['prefix' => 'custom-form-data'], function () {
            Route::get('list', 'Dashboard\CustomFormDataController@lists'); // lists
            Route::get('view', 'Dashboard\CustomFormDataController@view'); // 统计视图
            Route::get('detail', 'Dashboard\CustomFormDataController@detail'); // 查看明细
        });
    });

});