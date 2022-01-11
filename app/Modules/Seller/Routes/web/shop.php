<?php

Route::group(['domain' => env('SELLER_DOMAIN')], function ($router) {

    // Shop block
    Route::group(['prefix' => 'shop'], function () {

        // 系统消息
        Route::group(['prefix' => 'message'], function () {
            Route::get('index', 'Shop\MessageController@internalMessageList'); // 站内信
            Route::get('internal-message-list', 'Shop\MessageController@internalMessageList'); // 站内信
            Route::post('delete', 'Shop\MessageController@internalMessageDelete'); // 站内信删除
            Route::post('batch-delete', 'Shop\MessageController@internalMessageBatchDelete'); // 站内信批量删除
            Route::get('system-message-list', 'Shop\MessageController@systemMessageList'); // 系统公告
            Route::any('message-set', 'Shop\MessageController@messageSet'); // 消息接收设置
            Route::get('view', 'Shop\MessageController@view'); // 查看消息
            Route::get('set-is-open', 'Shop\MessageController@setIsOpen'); // 设置开启状态
        });

        // 运费设置
        Route::group(['prefix' => 'freight'], function () {
            Route::get('list', 'Shop\FreightController@lists'); // lists 运费模板列表
            Route::get('add', 'Shop\FreightController@globeAdd'); // 添加全国运费模板
            Route::get('edit', 'Shop\FreightController@edit'); // 编辑
            Route::post('add', 'Shop\FreightController@saveData'); // saveData
            Route::post('edit', 'Shop\FreightController@saveData'); // saveData
            Route::get('map-add', 'Shop\FreightController@mapAdd');
            Route::post('map-add', 'Shop\FreightController@saveData'); // saveData

            Route::get('copy-add', 'Shop\FreightController@copyAdd');

            Route::get('region-picker', 'Shop\FreightController@regionPicker'); // ajax加载地区列表

            Route::get('default', 'Shop\FreightController@default'); // default 店铺统一运费
            Route::get('calculate', 'Shop\FreightController@calculate'); // calculate 运费模拟计算

            Route::get('desc', 'Shop\FreightController@desc'); // desc
        });

        // Config 网站设置控制器
        Route::group(['prefix' => 'config'], function () {
            Route::get('index/{group?}', 'Shop\ConfigController@index'); // index get请求
            Route::post('index/{group?}', 'Shop\ConfigController@updateConfig'); // index post请求 保存设置信息
            Route::any('auto-delivery', 'Shop\ConfigController@autoDelivery'); // 交易设置 - 自动发货设置

        });


        // Navigation 店铺导航
        Route::group(['prefix' => 'navigation'], function () {
            Route::get('list', 'Shop\NavigationController@lists'); // lists
            Route::get('setting', 'Shop\NavigationController@setting'); // setting
            Route::get('add', 'Shop\NavigationController@add'); // add
            Route::post('add', 'Shop\NavigationController@saveData'); // saveData
            Route::get('edit', 'Shop\NavigationController@edit'); // add
            Route::post('edit', 'Shop\NavigationController@saveData'); // saveData
            Route::get('set-is-show', 'Shop\NavigationController@setIsShow'); // setIsShow
            Route::get('set-new-open', 'Shop\NavigationController@setNewOpen'); // setNewOpen
            Route::post('edit-nav-info', 'Shop\NavigationController@editNavInfo'); // editNavInfo
            Route::post('delete', 'Shop\NavigationController@delete'); // delete
            Route::post('batch-delete', 'Shop\NavigationController@batchDelete'); // batchDelete

            Route::get('get-type-list', 'Shop\NavigationController@getTypeList'); // getTypeList 功能选择列表
        });

        // ShopSet 店铺设置
        Route::group(['prefix' => 'shop-set'], function () {
            Route::get('edit', 'Shop\ShopSetController@edit'); // edit
            Route::post('edit', 'Shop\ShopSetController@edit'); // edit
            Route::get('client-validate', 'Shop\ShopSetController@clientValidate'); // clientValidate
            Route::get('other', 'Shop\ShopSetController@other'); // other
        });

        // 店铺信息
        Route::group(['prefix' => 'shop-info'], function () {
            Route::get('shop-info', 'Shop\ShopInfoController@shopInfo'); // shopInfo
            Route::get('renew-list', 'Shop\ShopInfoController@renewList'); // renewList
            Route::get('renew-add', 'Shop\ShopInfoController@renewAdd'); // renewAdd
        });

        // 保障服务
        Route::group(['prefix' => 'contract'], function () {
            Route::get('list', 'Shop\ContractController@lists'); //
            Route::post('audit', 'Shop\ContractController@audit'); // 加入
            Route::post('audit-info', 'Shop\ContractController@auditInfo'); //
            Route::post('exit', 'Shop\ContractController@exit'); // 退出保障服务
        });

        // 账号管理
        Route::group(['prefix' => 'account'], function () {
            Route::get('list', 'Shop\AccountController@lists'); // lists
            Route::get('add', 'Shop\AccountController@add'); // add
            Route::get('edit', 'Shop\AccountController@edit'); // add
            Route::post('add', 'Shop\AccountController@saveData'); // saveData
            Route::get('client-validate', 'Shop\AccountController@clientValidate'); // clientValidate
            Route::get('role-list', 'Shop\AccountController@roleList'); // 异步加载角色列表
            Route::get('set-status', 'Shop\AccountController@setStatus'); // setStatus
            Route::post('delete', 'Shop\AccountController@delete'); // delete
            Route::get('auth-set', 'Shop\AccountController@authSet'); // authSet
            Route::post('auth-set', 'Shop\AccountController@authSetSave'); // authSetSave

        });

        // Role 角色控制器
        Route::group(['prefix' => 'role'], function () {
            Route::get('list', 'Shop\RoleController@lists'); // 角色列表
            Route::get('add', 'Shop\RoleController@add'); // 角色创建
            Route::get('edit', 'Shop\RoleController@edit'); // 角色编辑
            Route::post('add', 'Shop\RoleController@saveData'); // saveData
            Route::post('edit', 'Shop\RoleController@saveData'); // saveData
//            Route::get('client-validate', 'Shop\RoleController@clientValidate'); // clientValidate
            Route::post('delete', 'Shop\RoleController@delete'); // delete
        });

        // Log 操作日志控制器
        Route::group(['prefix' => 'log'], function () {
            Route::get('list', 'Shop\LogController@lists')->name('shop-log-list'); // 日志列表
            Route::post('delete', 'Shop\LogController@delete')->name('shop-log-delete'); // delete
            Route::post('batch-delete', 'Shop\LogController@batchDelete')->name('shop-log-delete'); // batchDelete
            Route::post('delete-old-log', 'Shop\LogController@deleteOldLog')->name('shop-log-delete'); // deleteOldLog
        });

        /**
         * 打印设置
         */
        Route::group(['prefix' => 'print-spec'], function () {
            Route::get('list', 'Shop\PrintSpecController@lists'); // lists
            Route::get('add', 'Shop\PrintSpecController@add'); // add
            Route::get('edit', 'Shop\PrintSpecController@edit'); // add
            Route::post('add', 'Shop\PrintSpecController@saveData'); // saveData
            Route::post('set-is-default', 'Shop\PrintSpecController@setIsDefault'); // 设置默认打印机
            Route::post('delete', 'Shop\PrintSpecController@delete'); // delete
            Route::get('config-printer', 'Shop\PrintSpecController@configPrinter'); // 配置打印机
            Route::post('config-printer', 'Shop\PrintSpecController@configPrinterSave'); // 配置打印机保存数据

        });

        /**
         * 配送方式
         */
        Route::group(['prefix' => 'shipping'], function () {
            Route::get('self', 'Shop\ShippingController@self'); // 自行配送
            Route::get('list', 'Shop\ShippingController@lists'); // 第三方快递
            Route::any('edit', 'Shop\ShippingController@edit'); // 设置运单模板/测试打印
            Route::post('add', 'Shop\ShippingController@saveData'); // saveData
            Route::post('edit-shipping', 'Shop\ShippingController@saveData'); // saveData
            Route::get('print', 'Shop\ShippingController@prints'); // 设置运单模板/测试打印
            Route::get('set-is-show', 'Shop\ShippingController@setIsShow'); // 是否启用
        });

        /**
         * 易联云打印机
         */
        Route::group(['prefix' => 'yly-printer'], function () {
            Route::get('list', 'Shop\YlyPrinterController@lists'); // lists
            Route::get('add', 'Shop\YlyPrinterController@add'); // add
            Route::post('add', 'Shop\YlyPrinterController@saveData'); // saveData
            Route::get('edit', 'Shop\YlyPrinterController@edit'); // add
            Route::post('edit', 'Shop\YlyPrinterController@saveData'); // saveData
            Route::get('set-is-default', 'Shop\YlyPrinterController@setIsDefault'); // 设置默认打印机
            Route::post('delete', 'Shop\YlyPrinterController@delete'); // delete
        });

        /**
         * 发/退货地址库
         */
        Route::group(['prefix' => 'shop-address'], function () {
            Route::get('list', 'Shop\ShopAddressController@lists'); // lists
            Route::get('add', 'Shop\ShopAddressController@add'); // add
            Route::post('add', 'Shop\ShopAddressController@saveData'); // saveData
            Route::get('edit', 'Shop\ShopAddressController@edit'); // add
            Route::post('edit', 'Shop\ShopAddressController@saveData'); // saveData
            Route::get('set-is-default', 'Shop\ShopAddressController@setIsDefault'); // 设置默认地址 todo 不确定有没设置功能
            Route::post('delete', 'Shop\ShopAddressController@delete'); // delete
            Route::post('batch-delete', 'Shop\ShopAddressController@batchDelete'); // 批量删除
        });

        /**
         * 客服类型
         */
        Route::group(['prefix' => 'customer-type'], function () {
            Route::get('list', 'Shop\CustomerTypeController@lists'); // lists
            Route::get('add', 'Shop\CustomerTypeController@add'); // add
            Route::post('add', 'Shop\CustomerTypeController@saveData'); // saveData
            Route::get('edit', 'Shop\CustomerTypeController@edit'); // add
            Route::post('edit', 'Shop\CustomerTypeController@saveData'); // saveData
            Route::get('client-validate', 'Shop\CustomerTypeController@clientValidate'); // clientValidate
            Route::post('edit-customer-info', 'Shop\CustomerTypeController@editCustomerInfo');
            Route::get('set-is-show', 'Shop\CustomerTypeController@setIsShow'); // 是否启用
            Route::post('delete', 'Shop\CustomerTypeController@delete'); // delete
            Route::post('batch-delete', 'Shop\CustomerTypeController@batchDelete'); // 批量删除
        });

        /**
         * 客服
         */
        Route::group(['prefix' => 'customer'], function () {
            Route::get('list', 'Shop\CustomerController@lists'); // lists
            Route::get('add', 'Shop\CustomerController@add'); // add
            Route::post('add', 'Shop\CustomerController@saveData'); // saveData
            Route::get('edit', 'Shop\CustomerController@edit'); // add
            Route::post('edit', 'Shop\CustomerController@saveData'); // saveData
            Route::post('edit-customer-info', 'Shop\CustomerController@editCustomerInfo');
            Route::get('set-is-main', 'Shop\CustomerController@setIsMain'); // 是否主客服
            Route::get('set-is-show', 'Shop\CustomerController@setIsShow'); // 是否启用
            Route::post('delete', 'Shop\CustomerController@delete'); // delete
            Route::post('batch-delete', 'Shop\CustomerController@batchDelete'); // 批量删除
            Route::any('customer-set', 'Shop\CustomerController@customerSet'); // 客服设置

        });
    });


});
