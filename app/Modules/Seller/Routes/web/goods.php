<?php

Route::group(['domain' => env('SELLER_DOMAIN')], function ($router) {

    // Goods Route
    Route::group(['prefix' => 'goods'], function () {

        // Default 商品管理
        Route::group(['prefix' => 'default'], function () {
            Route::get('qrcode', 'Goods\DefaultController@qrcode'); // qrcode
            Route::get('download-qrcode', 'Goods\DefaultController@downloadQrCode'); // 下载商品二维码
            Route::get('picker', 'Goods\DefaultController@picker'); // picker
            Route::post('picker', 'Goods\DefaultController@picker'); // picker
        });

        // 商品列表
        Route::group(['prefix' => 'list'], function () {
            Route::get('index', 'Goods\ListController@index')->name('shop-goods-list'); // index
            Route::get('sku-list', 'Goods\ListController@skuList'); // skuList
            Route::any('sku-member', 'Goods\ListController@skuMember'); // skuMember
            Route::post('edit-goods-info', 'Goods\ListController@editGoodsInfo'); // editGoodsInfo
            Route::post('edit-goods-sku-info', 'Goods\ListController@editGoodsSkuInfo'); // editGoodsSkuInfo
            Route::any('remark', 'Goods\ListController@remark'); // 商品备注

            Route::get('trash', 'Goods\ListController@trash'); // trash 商品回收站

            // 批量操作
            Route::get('set-goods-unit', 'Goods\ListController@setGoodsUnit'); // 设置商品单位
            Route::get('move-goods-cat', 'Goods\ListController@moveGoodsCat'); // 转移商城商品分类
            Route::get('show-shop-goods-cat', 'Goods\ListController@showShopGoodsCat'); // 转移店铺商品分类
            Route::get('set-goods-pricing-mode', 'Goods\ListController@setGoodsPricingMode'); // 计价方式设置
            Route::get('set-goods-moq-modal', 'Goods\ListController@setGoodsMoqModal'); // 最小起订量设置
            Route::get('set-goods-invoice-type', 'Goods\ListController@setGoodsInvoiceType'); // 开具发票设置
            Route::get('set-goods-layout', 'Goods\ListController@setGoodsLayout'); // 详情版式
            Route::get('set-goods-contract', 'Goods\ListController@setGoodsContract'); // 服务保障
            Route::get('batch-sku-member', 'Goods\ListController@batchSkuMember'); // 自定义会员价
            Route::get('set-goods-freight', 'Goods\ListController@setGoodsFreight'); // 运费设置

        });

        // 发布商品
        Route::group(['prefix' => 'publish'], function () {
            Route::get('add', 'Goods\PublishController@add'); // add
            Route::get('index', 'Goods\PublishController@add'); // add
            Route::get('index.html', 'Goods\PublishController@add'); // add
            if (request()->get('cat_id',0)) {
                Route::get('index', 'Goods\PublishController@index'); // index
                Route::get('index.html', 'Goods\PublishController@index'); // index
            }
            Route::post('add', 'Goods\PublishController@saveData'); // saveData
            Route::get('cat-list', 'Goods\PublishController@catList'); // catList
            Route::post('delete', 'Goods\PublishController@delete'); // delete 将商品移入回收站
            Route::post('recover', 'Goods\PublishController@recover'); // recover 还原商品
            Route::post('forever-delete', 'Goods\PublishController@foreverDelete'); // foreverDelete 将商品彻底删除


            Route::get('add-images', 'Goods\PublishController@addImages'); // addImages
            Route::get('edit-images', 'Goods\PublishController@editImages'); // editImages
            Route::post('edit-images', 'Goods\PublishController@saveImageData'); // saveImageData
            Route::get('success', 'Goods\PublishController@success'); // success
            Route::get('edit', 'Goods\PublishController@edit'); // edit
            Route::post('edit', 'Goods\PublishController@saveData'); // saveData
            Route::any('edit-gift', 'Goods\PublishController@editGift'); // editGift
            Route::any('add-spec', 'Goods\PublishController@addSpec'); // addSpec ajax添加店铺规格
            Route::any('add-spec.html', 'Goods\PublishController@addSpec'); // addSpec ajax添加店铺规格

            Route::get('layouts', 'Goods\PublishController@layouts'); // layouts 详情版式

            Route::get('cat-search', 'Goods\PublishController@catSearch'); // 搜索商品分类
            Route::get('reload-goods-unit', 'Goods\PublishController@reloadGoodsUnit'); // 搜索商品分类
            Route::get('freights', 'Goods\PublishController@freights'); // 刷新运费模板

            // 批量操作
            Route::post('onsale', 'Goods\PublishController@onsale'); // 商品上架
            Route::post('offsale', 'Goods\PublishController@offsale'); // 商品下架

        });

        // Brand 商品品牌
        Route::group(['prefix' => 'brand'], function () {
            Route::get('picker', 'Goods\BrandController@picker'); // picker
        });

        // 店铺商品分类
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', 'Goods\CategoryController@lists'); // lists
            Route::get('add', 'Goods\CategoryController@add'); // add
            Route::get('edit', 'Goods\CategoryController@edit'); // edit
            Route::post('add', 'Goods\CategoryController@saveData'); // saveData
            Route::get('set-is-show', 'Goods\CategoryController@setIsShow'); // setIsShow
            Route::post('edit-cat-info', 'Goods\CategoryController@editCatInfo'); // editCatInfo
            Route::post('delete', 'Goods\CategoryController@delete'); // delete

            Route::get('picker', 'Goods\CategoryController@picker'); // picker
        });

        // 商品规格
        Route::group(['prefix' => 'spec'], function () {
            Route::get('list', 'Goods\SpecController@lists'); // lists
            Route::get('add', 'Goods\SpecController@add'); // add
            Route::get('edit', 'Goods\SpecController@edit'); // edit
            Route::post('add', 'Goods\SpecController@saveData'); // saveData
            Route::post('edit-attr-info', 'Goods\SpecController@editAttrInfo'); // editAttrInfo
            Route::post('delete', 'Goods\SpecController@delete'); // delete
            Route::post('batch-delete', 'Goods\SpecController@batchDelete'); // batchDelete


        });

        // ImageDir 图片空间
        Route::group(['prefix' => 'image-dir'], function () {
            Route::get('list', 'Goods\ImageDirController@lists'); // lists
            Route::get('add', 'Goods\ImageDirController@add'); // add
            Route::get('edit', 'Goods\ImageDirController@edit'); // add
            Route::post('add', 'Goods\ImageDirController@saveData'); // saveData
            Route::post('delete', 'Goods\ImageDirController@delete'); // delete

        });

        // Image 图片库
        Route::group(['prefix' => 'image'], function () {
            Route::get('list', 'Goods\ImageController@lists'); // lists
            Route::post('delete', 'Goods\ImageController@delete'); // delete
            Route::get('edit-name', 'Goods\ImageController@editName'); // editName
            Route::post('edit-name', 'Goods\ImageController@saveEditName'); // saveEditName
            Route::post('cover', 'Goods\ImageController@cover'); // cover
            Route::post('replace', 'Goods\ImageController@replace'); // replace
            Route::get('move', 'Goods\ImageController@move'); // move
            Route::post('move', 'Goods\ImageController@saveMoveData'); // move
            /*回收站*/
            Route::get('trash', 'Goods\ImageController@trash'); // trash
            Route::post('recover', 'Goods\ImageController@recover'); // recover
            Route::post('destroy', 'Goods\ImageController@destroy'); // destroy

        });

        // 商品设置
        Route::get('goods-set/index', 'Goods\GoodsSetController@index'); // index

        // 商品标签
        Route::group(['prefix' => 'goods-tag'], function () {
            Route::get('list', 'Goods\GoodsTagController@lists'); // lists
            Route::get('add', 'Goods\GoodsTagController@add'); // add
            Route::get('edit', 'Goods\GoodsTagController@edit'); // edit
            Route::post('add', 'Goods\GoodsTagController@saveData'); // saveData
            Route::post('edit', 'Goods\GoodsTagController@saveData'); // saveData
            Route::post('delete', 'Goods\GoodsTagController@delete'); // delete
        });

        // 商品单位
        Route::group(['prefix' => 'goods-unit'], function () {
            Route::get('list', 'Goods\GoodsUnitController@lists'); // lists
            Route::get('add', 'Goods\GoodsUnitController@add'); // add
            Route::get('edit', 'Goods\GoodsUnitController@edit'); // edit
            Route::post('add', 'Goods\GoodsUnitController@saveData'); // saveData
            Route::post('edit', 'Goods\GoodsUnitController@saveData'); // saveData
            Route::get('client-validate', 'Goods\GoodsUnitController@clientValidate'); // clientValidate
            Route::post('delete', 'Goods\GoodsUnitController@delete'); // delete
            Route::post('batch-delete', 'Goods\GoodsUnitController@batchDelete'); // batchDelete


        });

        // 商品详情版式
        Route::group(['prefix' => 'layout'], function () {
            Route::get('list', 'Goods\LayoutController@lists'); // lists
            Route::get('add', 'Goods\LayoutController@add'); // add
            Route::get('edit', 'Goods\LayoutController@edit'); // edit
            Route::post('add', 'Goods\LayoutController@saveData'); // saveData
            Route::post('edit', 'Goods\LayoutController@saveData'); // saveData
            Route::get('client-validate', 'Goods\LayoutController@clientValidate'); // clientValidate
            Route::post('delete', 'Goods\LayoutController@delete'); // delete
        });

        // 常见问题
        Route::group(['prefix' => 'questions'], function () {
            Route::get('list', 'Goods\QuestionsController@lists'); // lists
            Route::get('add', 'Goods\QuestionsController@add'); // add
            Route::get('edit', 'Goods\QuestionsController@edit'); // edit
            Route::post('add', 'Goods\QuestionsController@saveData'); // saveData
            Route::post('edit', 'Goods\QuestionsController@saveData'); // saveData
            Route::post('edit-question-info', 'Goods\QuestionsController@editQuestionInfo'); // editQuestionInfo
            Route::post('delete', 'Goods\QuestionsController@delete'); // delete
        });

        // 品牌选择器
        Route::get('brand/picker', 'Goods\BrandController@picker'); // picker

        // 上门自提
        Route::group(['prefix' => 'self-pickup'], function () {
            Route::get('list', 'Goods\SelfPickupController@lists'); // lists
            Route::get('add', 'Goods\SelfPickupController@add'); // add
            Route::get('edit', 'Goods\SelfPickupController@edit'); // edit
            Route::post('add', 'Goods\SelfPickupController@saveData'); // saveData
            Route::post('edit', 'Goods\SelfPickupController@saveData'); // saveData
            Route::get('set-is-show', 'Goods\SelfPickupController@setIsShow'); // setIsShow
            Route::post('delete', 'Goods\SelfPickupController@delete'); // delete
        });

        // Cloud 云端产品库
        Route::group(['prefix' => 'cloud'], function () {
            Route::get('cloud-manage', 'Goods\CloudController@cloudManage'); // cloudManage
            Route::any('goods-list', 'Goods\CloudController@goodsList'); // goodsList
            Route::post('ajax-collect-info', 'Goods\CloudController@ajaxCollectInfo');
            Route::post('ajax-setting', 'Goods\CloudController@ajaxSetting'); // 导入商品
            Route::post('import', 'Goods\CloudController@import'); // 导入商品 执行

        });

        // 批量采集
        Route::group(['prefix' => 'collect'], function () {
            Route::get('show', 'Goods\CollectController@show'); // 批量采集 商品

        });

        // 采集评论
        Route::group(['prefix' => 'collect-comment'], function () {
            Route::get('goods-list', 'Goods\CollectCommentController@goodsList'); // 批量采集 评论
            Route::post('ajax-setting', 'Goods\CollectCommentController@ajaxSetting'); // 采集评论设置
            Route::post('ajax-collect', 'Goods\CollectCommentController@ajaxCollect'); // 开始采集评论

        });

        // 商品库采集
        Route::group(['prefix' => 'lib-goods'], function () {
            Route::get('index', 'Goods\LibGoodsController@index'); // index
            Route::get('index.html', 'Goods\LibGoodsController@index'); // index
            Route::get('import', 'Goods\LibGoodsController@import');
            Route::get('sku-list', 'Goods\LibGoodsController@skuList');
            Route::get('auto', 'Goods\LibGoodsController@auto'); // 批量智能导入
            Route::any('file.html', 'Goods\LibGoodsController@file'); // 文件导入
            Route::get('scan.html', 'Goods\LibGoodsController@scan'); // 扫码导入
            Route::post('scan.html', 'Goods\LibGoodsController@scanPreview'); // 扫码导入预览

        });
    });

});