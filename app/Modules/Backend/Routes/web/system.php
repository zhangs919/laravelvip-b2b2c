<?php

Route::group(['domain' => config('lrw.backend_domain')], function ($router) {


    Route::group(['prefix' => 'system'], function () {

        // Config 网站设置控制器
        Route::group(['prefix' => 'config'], function () {
            Route::get('index/{group?}', 'System\ConfigController@index')->name('system-config-'.request()->get('group')); // index get请求
            Route::post('index/{group?}', 'System\ConfigController@updateConfig')->name('system-config-'.request()->get('group')); // index post请求 保存设置信息
            Route::post('clear', 'System\ConfigController@clear'); // 配置值清空数据
        });

        // System 网站配置管理控制器
        Route::group(['prefix' => 'system'], function () {
//            Route::get('index/{group?}', 'System\SystemController@index')->name(''); // index
            Route::get('index', 'System\SystemController@index')->name('system-system-list'); // index
            Route::get('add', 'System\SystemController@add')->name('system-system-manage'); // add
            Route::post('add', 'System\SystemController@saveData')->name('system-system-manage'); // saveData
            Route::get('edit/{id?}', 'System\SystemController@edit')->name('system-system-manage'); // edit
            Route::post('edit', 'System\SystemController@saveData')->name('system-system-manage'); // saveData
            Route::get('set-status', 'System\SystemController@setStatus')->name('system-system-manage'); // setStatus
            Route::post('edit-config-info', 'System\SystemController@editConfigInfo')->name('system-system-manage'); // editConfigInfo
            Route::post('delete', 'System\SystemController@delete')->name('system-system-delete'); // delete
            Route::post('batch-delete', 'System\SystemController@batchDelete')->name('system-system-delete'); // batchDelete
        });

        // ShopConfig 店铺中心配置管理控制器
        Route::group(['prefix' => 'shop-config-field'], function () {
//            Route::get('index/{group?}', 'System\ShopConfigFieldController@index'); // index
            Route::get('index', 'System\ShopConfigFieldController@index')->name('system-shop-config-field-list'); // index
            Route::get('add', 'System\ShopConfigFieldController@add')->name('system-shop-config-field-manage'); // add
            Route::post('add', 'System\ShopConfigFieldController@saveData')->name('system-shop-config-field-manage'); // saveData
            Route::get('edit/{id?}', 'System\ShopConfigFieldController@edit')->name('system-shop-config-field-manage'); // edit
            Route::post('edit', 'System\ShopConfigFieldController@saveData')->name('system-shop-config-field-manage'); // saveData
            Route::get('set-status', 'System\ShopConfigFieldController@setStatus')->name('system-shop-config-field-manage'); // setStatus
            Route::post('edit-config-info', 'System\ShopConfigFieldController@editConfigInfo')->name('system-shop-config-field-manage'); // editConfigInfo
            Route::post('delete', 'System\ShopConfigFieldController@delete')->name('system-shop-config-field-delete'); // delete
            Route::post('batch-delete', 'System\ShopConfigFieldController@batchDelete')->name('system-shop-config-field-delete'); // batchDelete
        });

        // ClearData 清测试数据控制器
        Route::any('clear-data/index', 'System\ClearDataController@index')->name('system-clear-data'); // index

        // 清理缓存
        Route::any('cache/clear', 'System\CacheController@clear')->name('system-clear-cache'); // 清理缓存
        Route::any('cache/depth-clear', 'System\CacheController@depthClear')->name('system-depth-clear-cache'); // 深度清理缓存

        // Admin 管理员设置控制器
        Route::group(['prefix' => 'admin'], function () {
            Route::get('list', 'System\AdminController@lists')->name('system-admin-list'); // 管理员列表

            Route::get('add', 'System\AdminController@add')->name('system-admin-manage'); // 管理员创建/编辑
            Route::get('edit', 'System\AdminController@edit')->name('system-admin-manage'); // edit
            Route::post('add', 'System\AdminController@saveData')->name('system-admin-manage'); // saveData
            Route::post('edit', 'System\AdminController@saveData')->name('system-admin-manage'); // saveData
            Route::get('role-list', 'System\AdminController@roleList')->name('system-admin-manage'); // 异步加载角色列表
            Route::get('client-validate', 'System\AdminController@clientValidate')->name('system-admin-manage'); // clientValidate


            Route::get('auth-set', 'System\AdminController@authSet')->name('system-admin-auth'); // 分派权限
            Route::post('auth-set', 'System\AdminController@authSetSave')->name('system-admin-auth'); // 分派权限保存数据
            Route::any('edit-password', 'System\AdminController@editPassword')->name('system-admin-manage'); // editPassword

            Route::get('set-status', 'System\AdminController@setStatus')->name('system-admin-manage'); // setStatus
            Route::get('delete', 'System\AdminController@delete')->name('system-admin-delete'); // delete


        });

        // 数据库管理
        Route::group(['prefix' => 'backup'], function () {
            Route::get('list', 'System\BackupController@lists')->name('system-backup-list'); // lists
            Route::get('delete', 'System\BackupController@delete')->name('system-backup-delete'); // delete
            Route::get('store', 'System\BackupController@store')->name('system-backup-store'); // store
            Route::get('optimize', 'System\BackupController@optimize')->name('system-backup-optimize'); // optimize
//            Route::get('recover', 'System\BackupController@recover')->name('system-backup-recover'); // recover
            Route::get('download', 'System\BackupController@download')->name('system-backup-download'); // download

        });

        // 系统菜单
        Route::group(['prefix' => 'menu'], function () {
            Route::get('list', 'System\MenuController@lists')->name('system-menu-list'); // lists
            Route::get('add', 'System\MenuController@add')->name('system-menu-manage'); // add
            Route::get('edit', 'System\MenuController@edit')->name('system-menu-manage'); // edit
            Route::post('add', 'System\MenuController@saveData')->name('system-menu-manage'); // saveData
            Route::post('edit', 'System\MenuController@saveData')->name('system-menu-manage'); // saveData
            Route::get('set-is-show', 'System\MenuController@setIsShow')->name('system-menu-manage'); // setIsShow
            Route::post('edit-info', 'System\MenuController@editInfo')->name('system-menu-manage'); // editInfo
            Route::post('delete', 'System\MenuController@delete')->name('system-menu-delete'); // delete
        });

        // 权限节点
        Route::group(['prefix' => 'node'], function () {
            Route::get('list', 'System\NodeController@lists')->name('system-node-list'); // lists
            Route::get('add', 'System\NodeController@add')->name('system-node-manage'); // add
            Route::get('edit', 'System\NodeController@edit')->name('system-node-manage'); // edit
            Route::post('add', 'System\NodeController@saveData')->name('system-node-manage'); // saveData
            Route::post('edit', 'System\NodeController@saveData')->name('system-node-manage'); // saveData
            Route::get('set-is-show', 'System\NodeController@setIsShow')->name('system-node-manage'); // setIsShow
            Route::post('edit-info', 'System\NodeController@editInfo')->name('system-node-manage'); // editInfo
            Route::post('delete', 'System\NodeController@delete')->name('system-node-delete'); // delete
        });

        // Role 角色控制器
        Route::group(['prefix' => 'role'], function () {
            Route::get('list', 'System\RoleController@lists')->name('system-role-list'); // 角色列表
            Route::get('add', 'System\RoleController@add')->name('system-role-manage'); // 角色创建/编辑
            Route::get('edit', 'System\RoleController@edit')->name('system-role-manage'); // edit
            Route::post('add', 'System\RoleController@saveData')->name('system-role-manage'); // saveData
            Route::post('edit', 'System\RoleController@saveData')->name('system-role-manage'); // saveData
            Route::get('client-validate', 'System\RoleController@clientValidate')->name('system-role-manage'); // clientValidate
            Route::post('delete', 'System\RoleController@delete')->name('system-role-delete'); // delete


        });

        // Region 地区管理控制器
        Route::group(['prefix' => 'region'], function () {
            Route::get('list', 'System\RegionController@lists')->name('system-region-list'); // 地区列表
            Route::get('setting', 'System\RegionController@setting')->name('system-region-manage'); // setting
            Route::get('add', 'System\RegionController@add')->name('system-region-manage'); // add
            Route::post('add', 'System\RegionController@saveData')->name('system-region-manage'); // 新增Save
            Route::get('edit/{id?}', 'System\RegionController@edit')->name('system-region-manage'); // edit
//        Route::post('edit', 'System\RegionController@saveData'); // 编辑Save
            Route::post('set-enable', 'System\RegionController@setEnable')->name('system-region-manage'); // setEnable
            Route::post('set-scope', 'System\RegionController@setScope')->name('system-region-manage'); // setScope
            Route::get('client-validate', 'System\RegionController@clientValidate')->name('system-region-manage'); // clientValidate

            Route::get('application-service', 'System\RegionController@applicationService')->name('system-setting-application-service'); // 应用服务

        });

        // Log 系统日志控制器
        Route::group(['prefix' => 'log'], function () {
            Route::get('list', 'System\LogController@lists')->name('system-log-list'); // 日志列表
            Route::get('set', 'System\LogController@set')->name('system-config-log'); // 日志设置
            Route::post('delete', 'System\LogController@delete')->name('system-log-delete'); // delete
            Route::post('batch-delete', 'System\LogController@batchDelete')->name('system-log-delete'); // batchDelete
            Route::post('delete-old-log', 'System\LogController@deleteOldLog')->name('system-log-delete'); // deleteOldLog
        });

        // Seo Seo控制器
        Route::group(['prefix' => 'seo'], function () {
            Route::get('sitemap', 'System\SeoController@sitemap'); // sitemap
            Route::post('sitemap', 'System\SeoController@saveData'); // saveData

        });

        // SeoCategory 商品分类seo设置控制器
        Route::group(['prefix' => 'seo-category'], function () {
            Route::get('list', 'System\SeoCategoryController@lists'); // lists
            Route::get('seo-edit', 'System\SeoCategoryController@seoEdit'); // seoEdit
            Route::post('seo-save', 'System\SeoCategoryController@seoSave'); // saveData

        });

        // SubSite 站点管理控制器
        Route::group(['prefix' => 'subsite'], function () {
            Route::get('list', 'System\SubSiteController@lists')->name('system-site-list'); // lists
            Route::get('add', 'System\SubSiteController@add')->name('system-site-manage'); // 创建/编辑
            Route::get('edit', 'System\SubSiteController@edit')->name('system-site-manage'); // edit
            Route::post('add', 'System\SubSiteController@saveData')->name('system-site-manage'); // saveData
            Route::post('edit', 'System\SubSiteController@saveData')->name('system-site-manage'); // saveData
            Route::get('client-validate', 'System\SubSiteController@clientValidate')->name('system-site-manage'); // clientValidate
            Route::post('delete', 'System\SubSiteController@delete')->name('system-site-manage'); // delete
        });

        // SiteAdmin 站点管理员控制器
        Route::group(['prefix' => 'subsite-admin'], function () {
//            Route::get('list', 'System\SubSiteAdminController@lists')->name('system-site-list'); // lists
//            Route::get('add', 'System\SubSiteAdminController@add')->name('system-site-manage'); // 创建/编辑
//            Route::get('edit', 'System\SubSiteAdminController@edit')->name('system-site-manage'); // edit
//            Route::post('add', 'System\SubSiteAdminController@saveData')->name('system-site-manage'); // saveData
//            Route::post('edit', 'System\SubSiteAdminController@saveData')->name('system-site-manage'); // saveData
//            Route::get('client-validate', 'System\SubSiteAdminController@clientValidate')->name('system-site-manage'); // clientValidate
//            Route::post('delete', 'System\SubSiteAdminController@delete')->name('system-site-manage'); // delete
        });

    });
});