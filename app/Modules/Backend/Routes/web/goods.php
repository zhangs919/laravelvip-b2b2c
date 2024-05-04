<?php

Route::group(['domain' => config('lrw.backend_domain')], function ($router) {


// Goods Route
    Route::group(['prefix' => 'goods'], function () {

        // Category 商品分类
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', 'Goods\CategoryController@lists')->name('category-list'); // 分类列表
            Route::get('add', 'Goods\CategoryController@add')->name('category-manage'); // add
            Route::get('edit', 'Goods\CategoryController@edit')->name('category-manage'); // edit
            Route::post('add', 'Goods\CategoryController@saveData')->name('category-manage'); // saveData
            Route::post('edit', 'Goods\CategoryController@saveData')->name('category-manage'); // saveData
            Route::any('edit-brand', 'Goods\CategoryController@editBrand'); // editBrand
            Route::any('edit-filter', 'Goods\CategoryController@editFilter')->name('category-filter-manage'); // editFilter
            Route::any('edit-other', 'Goods\CategoryController@editOther')->name('category-other-manage'); // editOther
            Route::get('attr-table', 'Goods\CategoryController@attrTable'); // attrTable
            Route::get('spec-table', 'Goods\CategoryController@specTable'); // specTable

            Route::get('get-type-list', 'Goods\CategoryController@getTypeList'); // getTypeList
            Route::get('set-is-show', 'Goods\CategoryController@setShow'); // setShow
            Route::post('edit-category', 'Goods\CategoryController@editCategory'); // editCategory
            Route::post('is-change', 'Goods\CategoryController@isChange'); // isChange
            Route::post('upload-cat_image', 'Goods\CategoryController@uploadCatImage'); // uploadCatImage
            Route::get('picker', 'Goods\CategoryController@picker'); // picker

            Route::post('delete', 'Goods\CategoryController@delete')->name('category-delete'); // delete

        });

        // LibCategory 商品库商品分类
        Route::group(['prefix' => 'lib-category'], function () {
            Route::get('list', 'Goods\LibCategoryController@lists')->name('lib-category-manage'); // lists
            Route::get('add', 'Goods\LibCategoryController@add')->name('lib-category-manage'); // add
            Route::post('add', 'Goods\LibCategoryController@saveData')->name('lib-category-manage'); // saveData
            Route::get('edit', 'Goods\LibCategoryController@edit')->name('lib-category-manage'); // add
            Route::post('edit', 'Goods\LibCategoryController@saveData')->name('lib-category-manage'); // saveData
            Route::get('set-is-show', 'Goods\LibCategoryController@setShow')->name('lib-category-manage'); // setShow
            Route::post('edit-sort', 'Goods\LibCategoryController@editSort')->name('lib-category-manage'); // editSort
            Route::post('delete', 'Goods\LibCategoryController@delete')->name('lib-category-manage'); // delete

        });

        // Brand 商品品牌
        Route::group(['prefix' => 'brand'], function () {
            Route::get('list', 'Goods\BrandController@lists')->name('brand-list'); // lists
            Route::get('add', 'Goods\BrandController@add')->name('brand-manage'); // add
            Route::get('edit', 'Goods\BrandController@edit')->name('brand-manage'); // add
            Route::post('add', 'Goods\BrandController@saveData')->name('brand-manage'); // saveData
            Route::get('set-is-recommend', 'Goods\BrandController@setIsRecommend')->name('brand-manage'); // setIsRecommend
            Route::post('edit-sort', 'Goods\BrandController@editSort')->name('brand-manage'); // editSort
            Route::get('client-validate', 'Goods\BrandController@clientValidate')->name('brand-manage'); // clientValidate
            Route::post('upload-brand_logo', 'Goods\BrandController@uploadBrandLogo')->name('brand-manage'); // uploadBrandLogo
            Route::post('upload-promotion_image', 'Goods\BrandController@uploadPromotionImage')->name('brand-manage'); // uploadPromotionImage
            Route::post('delete', 'Goods\BrandController@delete')->name('brand-delete'); // delete
            Route::get('export', 'Goods\BrandController@export')->name('brand-export'); // export 导出excel
            Route::get('picker', 'Goods\BrandController@picker'); // picker
        });

        // GoodsType 商品类型
        Route::group(['prefix' => 'goods-type'], function () {
            Route::get('list', 'Goods\GoodsTypeController@lists')->name('goods-type-list'); // lists
            Route::get('add', 'Goods\GoodsTypeController@add')->name('goods-type-manage'); // add
            Route::get('edit', 'Goods\GoodsTypeController@edit')->name('goods-type-manage'); // edit
            Route::post('add', 'Goods\GoodsTypeController@saveData')->name('goods-type-manage'); // saveData
            Route::post('edit', 'Goods\GoodsTypeController@saveData')->name('goods-type-manage'); // saveData
            Route::post('edit-sort', 'Goods\GoodsTypeController@editSort')->name('goods-type-manage'); // editSort
            Route::get('client-validate', 'Goods\GoodsTypeController@clientValidate')->name('goods-type-manage'); // clientValidate
            Route::get('base-list', 'Goods\GoodsTypeController@baseList')->name('attr-list'); // baseList 属性列表
            Route::get('spec-list', 'Goods\GoodsTypeController@specList')->name('spec-list'); // specList 规格列表

            Route::post('delete', 'Goods\GoodsTypeController@delete')->name('goods-type-delete'); // delete
            Route::post('batch-delete', 'Goods\GoodsTypeController@batchDelete')->name('goods-type-delete'); // batchDelete

        });

        // Attribute 属性
        Route::group(['prefix' => 'attribute'], function () {
            Route::get('base-list', 'Goods\AttributeController@baseList')->name('attr-list'); // baseList 属性列表
            Route::get('spec-list', 'Goods\AttributeController@specList')->name('spec-list'); // specList 规格列表
            Route::get('add-base', 'Goods\AttributeController@addBase')->name('attr-manage'); // addBase 添加属性
            Route::get('edit-base', 'Goods\AttributeController@editBase')->name('attr-manage'); // editBase 编辑属性
            Route::post('add-base', 'Goods\AttributeController@saveData')->name('attr-manage'); // saveData
            Route::post('edit-base', 'Goods\AttributeController@saveData')->name('attr-manage'); // saveData

            Route::get('add-spec', 'Goods\AttributeController@addSpec')->name('spec-manage'); // addSpec 添加规格
            Route::get('edit-spec', 'Goods\AttributeController@editSpec')->name('spec-manage'); // editSpec 编辑规格
            Route::post('add-spec', 'Goods\AttributeController@saveData')->name('spec-manage'); // saveData
            Route::post('edit-spec', 'Goods\AttributeController@saveData')->name('spec-manage'); // saveData

            Route::post('edit-attr-info', 'Goods\AttributeController@editAttrInfo')->name('attr-manage'); // editAttrInfo

            Route::post('delete', 'Goods\AttributeController@delete')->name('attr-delete'); // delete

        });

        // Default 商品管理
        Route::group(['prefix' => 'default'], function () {
            Route::get('list', 'Goods\DefaultController@lists')->name('goods-list'); // lists
            Route::get('illegal', 'Goods\DefaultController@illegal')->name('goods-illegal-list'); // illegal
            Route::get('wait-audit', 'Goods\DefaultController@waitAudit')->name('goods-audit-list'); // waitAudit
//            Route::get('cat-list', 'Goods\LibGoodsController@catList'); // catList
//            Route::get('add', 'Goods\LibGoodsController@add'); // add
//            Route::post('add', 'Goods\LibGoodsController@saveData'); // saveData
//            Route::get('index', 'Goods\LibGoodsController@index'); // index
//            Route::get('add-images', 'Goods\LibGoodsController@addImages'); // addImages
//            Route::get('edit-images', 'Goods\LibGoodsController@editImages'); // editImages
//            Route::post('edit-images', 'Goods\LibGoodsController@saveImageData'); // saveImageData
//            Route::get('success', 'Goods\LibGoodsController@success'); // success
//            Route::get('edit', 'Goods\LibGoodsController@edit'); // edit
            Route::post('edit-goods-info', 'Goods\DefaultController@editGoodsInfo'); // editGoodsInfo
            Route::get('qrcode', 'Goods\DefaultController@qrcode'); // qrcode
            Route::get('sku-list', 'Goods\DefaultController@skuList'); // skuList

            Route::get('picker', 'Goods\DefaultController@picker'); // picker
            Route::post('picker', 'Goods\DefaultController@picker'); // picker

            Route::get('build-goods-region.html', 'Goods\DefaultController@buildGoodsRegion'); // 重建商品数据关联关系

        });

        Route::group(['prefix' => 'publish'], function () {
            Route::get('is-new', 'Goods\PublishController@isNew')->name('goods-manage'); // isNew
            Route::get('is-best', 'Goods\PublishController@isBest')->name('goods-manage'); // isBest
            Route::get('is-hot', 'Goods\PublishController@isHot')->name('goods-manage'); // isHot
            Route::any('illegal', 'Goods\PublishController@illegal')->name('goods-audit'); // illegal
            Route::post('onsale', 'Goods\PublishController@onsale')->name('goods-manage'); // onsale
            Route::any('audit', 'Goods\PublishController@audit')->name('goods-audit'); // audit
            Route::post('batch-illegal', 'Goods\PublishController@batchIllegal')->name('goods-audit'); // batchIllegal
            Route::post('batch-onsale', 'Goods\PublishController@batchOnsale')->name('goods-manage'); // batchOnsale


        });

        // LibGoods 商品
        Route::group(['prefix' => 'lib-goods'], function () {
            Route::get('list', 'Goods\LibGoodsController@lists')->name('lib-goods-manage'); // lists

            Route::get('add', 'Goods\LibGoodsController@add')->name('lib-goods-manage'); // add
            Route::get('index', 'Goods\LibGoodsController@add')->name('lib-goods-manage'); // index
            Route::get('index.html', 'Goods\LibGoodsController@add')->name('lib-goods-manage'); // index
            if (request()->get('cat_id',0)) {
                Route::get('index', 'Goods\LibGoodsController@index'); // index
                Route::get('index.html', 'Goods\LibGoodsController@index'); // index
            }
            Route::post('add', 'Goods\LibGoodsController@saveData')->name('lib-goods-manage'); // saveData
            Route::get('cat-list', 'Goods\LibGoodsController@catList')->name('lib-category--manage'); // catList
            Route::get('add-images', 'Goods\LibGoodsController@addImages')->name('lib-goods-manage'); // addImages
            Route::get('edit-images', 'Goods\LibGoodsController@editImages')->name('lib-goods-manage'); // editImages
            Route::post('edit-images', 'Goods\LibGoodsController@saveImageData')->name('lib-goods-manage'); // saveImageData
            Route::get('success', 'Goods\LibGoodsController@success')->name('lib-goods-manage'); // success
            Route::get('edit', 'Goods\LibGoodsController@edit')->name('lib-goods-manage'); // edit
            Route::post('edit', 'Goods\LibGoodsController@saveData')->name('lib-goods-manage'); // saveData
            Route::post('edit-lib-goods-info', 'Goods\LibGoodsController@editLibGoodsInfo')->name('lib-goods-manage');


            Route::any('add-excel-goods', 'Goods\LibGoodsController@addExcelGoods')->name('lib-goods-manage'); // 导入Excel商品
            Route::get('download-add', 'Goods\LibGoodsController@downloadAdd')->name('lib-goods-manage'); // 下载上传商品文件模板
            Route::any('import', 'Goods\LibGoodsController@import')->name('lib-goods-manage'); // 导入店铺商品
            Route::any('batch-upload', 'Goods\LibGoodsController@batchUpload')->name('lib-goods-manage'); // 导入ecshop商品
            Route::get('cat-search', 'Goods\LibGoodsController@catSearch'); // 搜索商品分类

            Route::get('sku-list', 'Goods\LibGoodsController@skuList'); // skuList

            Route::get('qrcode', 'Goods\LibGoodsController@qrcode'); // qrcode
            Route::get('download-qrcode', 'Goods\LibGoodsController@downloadQrCode'); // 下载商品二维码

        });

        // ImageDir 图片空间
        Route::group(['prefix' => 'image-dir'], function () {
            Route::get('list', 'Goods\ImageDirController@lists')->name('imagedir-list'); // lists
            Route::get('add', 'Goods\ImageDirController@add')->name('imagedir-manage'); // add
            Route::post('add', 'Goods\ImageDirController@saveData')->name('imagedir-manage'); // saveData

        });

        // Image 图片库
        Route::group(['prefix' => 'image'], function () {
            Route::get('list', 'Goods\ImageController@lists')->name('imagedir-manage'); // lists
            Route::post('delete', 'Goods\ImageController@delete')->name('->name(\'imagedir-manage\')'); // delete
            Route::get('edit-name', 'Goods\ImageController@editName')->name('imagedir-manage'); // editName
            Route::post('edit-name', 'Goods\ImageController@saveEditName')->name('imagedir-manage'); // saveEditName
            Route::post('cover', 'Goods\ImageController@cover')->name('imagedir-manage'); // cover
            Route::post('replace', 'Goods\ImageController@replace')->name('imagedir-manage'); // replace
            Route::get('move', 'Goods\ImageController@move')->name('imagedir-manage'); // move
            Route::post('move', 'Goods\ImageController@saveMoveData')->name('imagedir-manage'); // move

        });

        // Cloud 云端产品库
        Route::group(['prefix' => 'cloud'], function () {
            Route::get('list', 'Goods\CloudController@lists'); // lists
            Route::get('brand-import', 'Goods\CloudController@brandImport'); // brandImport
            Route::post('brand-import-ajax', 'Goods\CloudController@brandImportAjax'); // brandImportAjax

            Route::any('category-import', 'Goods\CloudController@categoryImport'); // categoryImport
            Route::post('category-import-ajax', 'Goods\CloudController@categoryImportAjax'); // categoryImportAjax

        });

        // Yun 云产品库采集
        Route::group(['prefix' => 'yun'], function () {
            Route::any('goods-list', 'Goods\YunController@goodsList'); // goodsList
            Route::post('ajax-scan', 'Goods\YunController@ajaxScan'); // ajaxScan
            Route::post('filter-barcodes', 'Goods\YunController@filterBarcodes'); // filterBarcodes
            Route::post('ajax-file', 'Goods\YunController@ajaxFile'); // ajaxFile
            Route::post('download', 'Goods\YunController@download'); // download
            Route::post('ajax-read-excel', 'Goods\YunController@ajaxReadExcel'); // ajaxReadExcel
            Route::post('ajax-collect-info', 'Goods\YunController@ajaxCollectInfo'); // ajaxCollectInfo
            Route::post('ajax-setting', 'Goods\YunController@ajaxSetting'); // 导入商品

        });

        // Collect 批量采集
        Route::group(['prefix' => 'collect'], function () {
            Route::any('show', 'Goods\CollectController@show'); // show
            Route::post('ajax-collect', 'Goods\CollectController@ajaxCollect'); //
            Route::any('list', 'Goods\CollectController@lists'); //
            Route::post('add-goods', 'Goods\CollectController@addGoods'); //
            Route::post('ajax-add', 'Goods\CollectController@ajaxAdd'); //

        });
    });

});