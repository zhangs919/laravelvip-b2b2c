<?php

Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {

    // Design route
    Route::group(['prefix' => 'design'], function () {
        // TplSetting 装修页面
        Route::group(['prefix' => 'tpl-setting'], function () {
            // 针对权限路由处理装修page参数
            $design_page = request()->get('page', 'site');

            if (is_array($design_page)) {
                $design_page = 'site';
            }
            if ($design_page == 'm_site') {
                $design_page = 'mobile';
            } elseif ($design_page == 'm_news') {
                $design_page = 'news';
            }

            Route::get('setup/{page?}/{topic_id?}', 'Design\TplSettingController@setup')->name($design_page.'-design'); // setup
            Route::get('select-template/{id?}/{code?}/{sort?}/{page?}/{topic_id?}', 'Design\TplSettingController@selectTemplate'); // selectTemplate
            Route::get('tpl-ref/{page?}/{uid?}', 'Design\TplSettingController@templateRefresh'); // templateRefresh
            Route::get('valid-tpls', 'Design\TplSettingController@validTpls'); // validTpls
            Route::post('batch-valid-tpls', 'Design\TplSettingController@batchValidTpls'); // 批量设置模板模块显示/隐藏
            Route::get('add-data', 'Design\TplSettingController@addData'); // addData
            Route::get('change-link-type', 'Design\TplSettingController@changeLinkType'); // changeLinkType
            Route::get('setting', 'Design\TplSettingController@setting'); // setting 发布
            Route::get('color-style-url', 'Design\TplSettingController@colorStyleUrl'); // colorStyleUrl
            Route::get('delete-tpls', 'Design\TplSettingController@deleteTpls'); // 删除模板模块
            Route::post('batch-delete', 'Design\TplSettingController@batchDelete'); // 批量删除模板模块
            Route::get('ajax-render', 'Design\TplSettingController@ajaxRender'); // ajaxRender ajax渲染模板
            Route::get('design-setting', 'Design\TplSettingController@designSetting'); // designSetting
            Route::get('qrcode.html', 'Design\TplSettingController@qrCode'); // 生成网站首页二维码

            Route::any('sort', 'Design\TplSettingController@templateSort'); // templateSort
            Route::post('save-tpls', 'Design\TplSettingController@saveTpls'); // saveTpls

            Route::post('set-static', 'Design\TplSettingController@setStatic'); // 开启/关闭静态页面

        });

        // NavCategory 分类导航
        Route::group(['prefix' => 'nav-category'], function () {
            Route::get('list', 'Design\NavCategoryController@lists'); // lists
            Route::get('setting', 'Design\NavCategoryController@setting'); // setting
            Route::get('add', 'Design\NavCategoryController@add'); // add
            Route::get('set-is-show', 'Design\NavCategoryController@setIsShow'); // setIsShow
            Route::post('edit-category-info', 'Design\NavCategoryController@editCategoryInfo'); // editCategoryInfo
            Route::get('get-cat-list', 'Design\NavCategoryController@getCatList'); // getCatList
            Route::get('select-icon', 'Design\NavCategoryController@selectIcon'); // selectIcon
            Route::get('edit', 'Design\NavCategoryController@edit'); // edit
            Route::post('delete', 'Design\NavCategoryController@delete'); // delete



        });

        // NavWords 分类推荐词
        Route::group(['prefix' => 'nav-words'], function () {
            Route::get('list', 'Design\NavWordsController@lists'); // lists
            Route::get('add', 'Design\NavWordsController@add'); // add
            Route::post('add', 'Design\NavWordsController@saveData'); // saveData
            Route::get('edit', 'Design\NavWordsController@edit'); // add
            Route::post('edit', 'Design\NavWordsController@saveData'); // saveData
            Route::get('set-is-show', 'Design\NavWordsController@setIsShow'); // setIsShow
            Route::get('set-new-open', 'Design\NavWordsController@setNewOpen'); // setNewOpen
            Route::post('delete', 'Design\NavWordsController@delete'); // delete
            Route::get('open-words-link', 'Design\NavWordsController@openWordsLink'); // openWordsLink

        });

        // NavBrand 分类推荐品牌
        Route::group(['prefix' => 'nav-brand'], function () {
            Route::get('list', 'Design\NavBrandController@lists'); // lists
            Route::get('add', 'Design\NavBrandController@add'); // add
            Route::post('add', 'Design\NavBrandController@saveData'); // saveData
            Route::get('edit', 'Design\NavBrandController@edit'); // add
            Route::post('edit', 'Design\NavBrandController@saveData'); // saveData
            Route::get('set-is-show', 'Design\NavBrandController@setIsShow'); // setIsShow
            Route::get('brand-search', 'Design\NavBrandController@brandSearch'); // brandSearch
            Route::get('brand-table-list', 'Design\NavBrandController@brandTableList'); // brandSearch
            Route::post('delete', 'Design\NavBrandController@delete'); // delete

        });

        // NavAd 分类推荐广告
        Route::group(['prefix' => 'nav-ad'], function () {
            Route::get('list', 'Design\NavAdController@lists'); // lists
            Route::get('add', 'Design\NavAdController@add'); // add
            Route::post('add', 'Design\NavAdController@saveData'); // saveData
            Route::get('edit', 'Design\NavAdController@edit'); // add
            Route::post('edit', 'Design\NavAdController@saveData'); // saveData
            Route::get('set-is-show', 'Design\NavAdController@setIsShow'); // setIsShow
            Route::post('delete', 'Design\NavAdController@delete'); // delete
        });

        // NavBanner 首页焦点图
        Route::group(['prefix' => 'nav-banner'], function () {
            Route::get('list', 'Design\NavBannerController@lists'); // lists
            Route::get('setting', 'Design\NavBannerController@setting'); // setting
            Route::get('add', 'Design\NavBannerController@add'); // add
            Route::post('add', 'Design\NavBannerController@saveData'); // saveData
            Route::get('edit', 'Design\NavBannerController@edit'); // add
            Route::post('edit', 'Design\NavBannerController@saveData'); // saveData
            Route::get('set-is-show', 'Design\NavBannerController@setIsShow'); // setIsShow
            Route::post('edit-banner-info', 'Design\NavBannerController@editBannerInfo'); // editBannerInfo
            Route::post('delete', 'Design\NavBannerController@delete'); // delete
            Route::post('batch-delete', 'Design\NavBannerController@batchDelete'); // batchDelete
        });

        // Navigation 商城导航
        Route::group(['prefix' => 'navigation'], function () {
            Route::get('list', 'Design\NavigationController@lists'); // lists
            Route::get('list.html', 'Design\NavigationController@lists'); // lists
            Route::get('setting', 'Design\NavigationController@setting'); // setting
            Route::get('add', 'Design\NavigationController@add'); // add
            Route::post('add', 'Design\NavigationController@saveData'); // saveData
            Route::get('edit', 'Design\NavigationController@edit'); // add
            Route::post('edit', 'Design\NavigationController@saveData'); // saveData
            Route::get('set-is-show', 'Design\NavigationController@setIsShow'); // setIsShow
            Route::get('set-new-open', 'Design\NavigationController@setNewOpen'); // setNewOpen
            Route::post('edit-nav-info', 'Design\NavigationController@editNavInfo'); // editNavInfo
            Route::post('delete', 'Design\NavigationController@delete'); // delete
            Route::post('batch-delete', 'Design\NavigationController@batchDelete'); // batchDelete

            Route::get('get-type-list', 'Design\NavigationController@getTypeList'); // getTypeList 功能选择列表
        });

        // NavQuickService 快捷服务
        Route::group(['prefix' => 'nav-quick-service'], function () {
            Route::get('list', 'Design\NavQuickServiceController@lists'); // lists
            Route::get('add', 'Design\NavQuickServiceController@add'); // add
            Route::post('add', 'Design\NavQuickServiceController@saveData'); // saveData
            Route::get('edit', 'Design\NavQuickServiceController@edit'); // add
            Route::post('edit', 'Design\NavQuickServiceController@saveData'); // saveData
            Route::get('set-is-show', 'Design\NavQuickServiceController@setIsShow'); // setIsShow
            Route::post('delete', 'Design\NavQuickServiceController@delete'); // delete
            Route::post('batch-delete', 'Design\NavQuickServiceController@batchDelete'); // batchDelete

        });
    });


});