<?php


Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {


    // Mall Route
    Route::group(['prefix' => 'mall'], function () {

        Route::group(['prefix' => 'payment'], function () {
            Route::get('list', 'Mall\PaymentController@lists')->name('payment-list'); // 支付设置
            Route::get('config-payment', 'Mall\PaymentController@configPayment')->name('payment-config'); // configPayment
            Route::post('config-payment', 'Mall\PaymentController@saveData')->name('payment-config'); // saveData

            Route::get('set-is-enable', 'Mall\PaymentController@setIsEnable')->name('payment-config'); // setIsEnable
            Route::post('edit-payment-info', 'Mall\PaymentController@editPaymentInfo')->name('payment-config'); // editPaymentInfo


        });

        // 默认搜索
        Route::group(['prefix' => 'search'], function () {
            Route::get('default-search', 'Mall\SearchController@defaultSearch')->name('default-search-list'); //
            Route::get('add', 'Mall\SearchController@add')->name('default-search-manage'); // add
            Route::get('edit', 'Mall\SearchController@edit')->name('default-search-manage'); // edit
            Route::post('add', 'Mall\SearchController@saveData')->name('default-search-manage'); // saveData
            Route::post('edit', 'Mall\SearchController@saveData')->name('default-search-manage'); // saveData
            Route::get('set-is-show', 'Mall\SearchController@setIsShow')->name('default-search-manage'); // setIsShow
            Route::post('del', 'Mall\SearchController@delete')->name('default-search-delete'); // delete
        });

        // 热门搜索
        Route::group(['prefix' => 'hot-search'], function () {
            Route::get('list', 'Mall\HotSearchController@lists')->name('hot-search-list'); // lists
            Route::get('add', 'Mall\HotSearchController@add')->name('hot-search-manage'); // add
            Route::get('edit', 'Mall\HotSearchController@edit')->name('hot-search-manage'); // edit
            Route::post('add', 'Mall\HotSearchController@saveData')->name('hot-search-manage'); // saveData
            Route::post('edit', 'Mall\HotSearchController@saveData')->name('hot-search-manage'); // saveData
            Route::get('set-is-show', 'Mall\HotSearchController@setIsShow')->name('hot-search-manage'); // setIsShow
            Route::post('edit-sort', 'Mall\HotSearchController@editSort')->name('hot-search-manage'); // editSort
            Route::post('delete', 'Mall\HotSearchController@delete')->name('hot-search-delete'); // delete
            Route::post('batch-delete', 'Mall\HotSearchController@batchDelete')->name('hot-search-delete'); // batchDelete
        });

        // 消息模板
        Route::group(['prefix' => 'message-template'], function () {
            Route::get('list', 'Mall\MessageTemplateController@lists')->name('message-template-manage'); // 消息模板管理
            Route::get('add', 'Mall\MessageTemplateController@add')->name('message-template-manage'); // add
            Route::post('add', 'Mall\MessageTemplateController@saveData')->name('message-template-manage'); // saveData
            Route::get('edit', 'Mall\MessageTemplateController@edit')->name('message-template-manage'); // edit
            Route::post('edit', 'Mall\MessageTemplateController@saveData')->name('message-template-manage'); // saveData
            Route::get('set-sys-open', 'Mall\MessageTemplateController@setSysOpen')->name('message-template-manage'); // 站内信开关
            Route::get('set-sms-open', 'Mall\MessageTemplateController@setSmsOpen')->name('message-template-manage'); // 短信开关
            Route::get('set-email-open', 'Mall\MessageTemplateController@setEmailOpen')->name('message-template-manage'); // 邮件开关
            Route::get('set-wx-open', 'Mall\MessageTemplateController@setWxOpen')->name('message-template-manage'); // 微信开关
            Route::any('set', 'Mall\MessageTemplateController@set')->name('message-template-manage'); // 设置短信模板
            Route::any('sms-test', 'Mall\MessageTemplateController@smsTest')->name('message-template-manage'); // 测试短信模板
            Route::get('client-validate', 'Mall\MessageTemplateController@clientValidate')->name('message-template-manage'); // clientValidate

//            Route::post('delete', 'Mall\MessageTemplateController@delete'); // 删除
        });

        // 快递公司
        Route::group(['prefix' => 'shipping'], function () {
            Route::get('list', 'Mall\ShippingController@lists')->name('shipping-list'); // 快递公司列表
            Route::get('add', 'Mall\ShippingController@add')->name('mall-shipping-manage'); // 快递公司管理
            Route::get('edit-shipping', 'Mall\ShippingController@editShipping')->name('shipping-edit'); // 快递公司编辑
            Route::any('edit', 'Mall\ShippingController@edit')->name('shipping-waybill-set'); // 设置运单模板/测试打印
            Route::post('add', 'Mall\ShippingController@saveData'); // saveData
            Route::post('edit-shipping', 'Mall\ShippingController@saveData'); // saveData
            Route::get('print', 'Mall\ShippingController@prints')->name('shipping-waybill-set'); // 设置运单模板/测试打印
            Route::get('set-is-show', 'Mall\ShippingController@setIsShow')->name('mall-shipping-manage'); // 是否启用
            Route::any('sheet-config', 'Mall\ShippingController@sheetConfig')->name('mall-shipping-manage'); // 电子面单参数配置
        });

        // 消费保障
        Route::group(['prefix' => 'contract'], function () {
            Route::get('audit-list', 'Mall\ContractController@auditList')->name('contract-apply'); // 保障服务申请
            Route::any('to-audit', 'Mall\ContractController@toAudit')->name('contract-audit'); // 审核
            Route::post('batch-access', 'Mall\ContractController@batchAccess')->name('contract-audit'); // 批量审核通过
            Route::post('batch-refuse', 'Mall\ContractController@batchRefuse')->name('contract-audit'); // 批量审核拒绝
            Route::post('delete', 'Mall\ContractController@delete')->name('contract-delete'); // delete

            Route::post('batch-open', 'Mall\ContractController@batchOpen')->name('contract-manage'); // 批量开启使用
            Route::post('forbidden', 'Mall\ContractController@forbidden')->name('contract-manage'); // 禁止使用
            Route::post('batch-forbidden', 'Mall\ContractController@batchForbidden')->name('contract-manage'); // 批量禁止使用
            Route::post('enabled', 'Mall\ContractController@enabled')->name('contract-manage'); // 开启使用

            Route::get('audit-access-list', 'Mall\ContractController@auditAccessList')->name('shop-contract-list'); // 店铺保障服务
            Route::get('list', 'Mall\ContractController@lists')->name('contract-list'); // 保障服务管理
            Route::get('add', 'Mall\ContractController@add')->name('contract-manage'); // add
            Route::post('add', 'Mall\ContractController@saveData')->name('contract-manage'); // saveData
            Route::get('edit', 'Mall\ContractController@edit')->name('contract-manage'); // edit
            Route::post('edit', 'Mall\ContractController@saveData')->name('contract-manage'); // saveData
            Route::get('set-is-open', 'Mall\ContractController@setIsOpen')->name('shop-contract-use'); // setIsOpen
            Route::post('edit-contract-info', 'Mall\ContractController@editContractInfo')->name('contract-manage'); // editContractInfo
        });

        // CopyrightAuth route
        Route::group(['prefix' => 'copyright-auth'], function () {
            Route::get('list', 'Mall\CopyrightAuthController@lists')->name('copyright-auth'); // lists
            Route::get('add', 'Mall\CopyrightAuthController@add')->name('copyright-auth'); // add
            Route::get('edit', 'Mall\CopyrightAuthController@edit')->name('copyright-auth'); // edit
            Route::post('add', 'Mall\CopyrightAuthController@saveData')->name('copyright-auth'); // saveData
            Route::post('edit', 'Mall\CopyrightAuthController@saveData')->name('copyright-auth'); // saveData
            Route::get('set-is-show', 'Mall\CopyrightAuthController@setIsShow')->name('copyright-auth'); // setIsShow
            Route::post('edit-auth-info', 'Mall\CopyrightAuthController@editAuthInfo')->name('copyright-auth'); // editAuthInfo
            Route::post('delete', 'Mall\CopyrightAuthController@delete')->name('copyright-auth'); // delete
        });

        // 自提点
        Route::group(['prefix' => 'self-pickup'], function () {
            Route::get('list', 'Mall\SelfPickupController@lists'); // lists
            Route::get('add', 'Mall\SelfPickupController@add'); // add
            Route::post('add', 'Mall\SelfPickupController@saveData'); // saveData
            Route::get('edit', 'Mall\SelfPickupController@edit'); // edit
            Route::post('edit', 'Mall\SelfPickupController@saveData'); // saveData
            Route::get('set-is-show', 'Mall\SelfPickupController@setIsShow'); // setIsShow
            Route::post('delete', 'Mall\SelfPickupController@delete'); // delete
        });

        // 友情链接
        Route::group(['prefix' => 'links'], function () {
            Route::get('list', 'Mall\LinksController@lists')->name('setting-links'); // lists
            Route::get('add', 'Mall\LinksController@add')->name('setting-links'); // add
            Route::post('add', 'Mall\LinksController@saveData')->name('setting-links'); // saveData
            Route::get('edit', 'Mall\LinksController@edit')->name('setting-links'); // edit
            Route::post('edit', 'Mall\LinksController@saveData')->name('setting-links'); // saveData
            Route::get('set-is-show', 'Mall\LinksController@setIsShow')->name('setting-links'); // setIsShow
            Route::post('edit-links-info', 'Mall\LinksController@editLinksInfo')->name('setting-links'); // editLinksInfo
            Route::post('delete', 'Mall\LinksController@delete')->name('setting-links'); // delete
        });
    });

});