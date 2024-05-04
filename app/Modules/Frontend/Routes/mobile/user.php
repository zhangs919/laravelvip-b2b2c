<?php

$prefix = '';
$lrw_tag = get_lrw_tag();
if (strlen($lrw_tag) == 7) {
    $prefix = $lrw_tag;
}

Route::group(['domain' => config('lrw.mobile_domain'), 'prefix' => $prefix], function ($router) {


    // User Route 用户中心路由
    Route::get('user.html', 'User\IndexController@center')->name('mobile_user_center'); // index


    Route::group(['prefix' => 'user'], function () {

        // 找回密码
        Route::any('find-password.html', 'User\FindPasswordController@findPassword'); //
        Route::any('find-password/validate.html', 'User\FindPasswordController@validates'); //
        Route::any('find-password/validate', 'User\FindPasswordController@validates'); //
        Route::any('find-password/sms-captcha', 'User\FindPasswordController@smsCaptcha'); //


        Route::get('center.html', 'User\IndexController@center')->name('user_center'); // index
        Route::get('center/get-surplus', 'User\IndexController@getSurplus');
        Route::get('profile.html', 'User\ProfileController@profile'); // profile
        Route::get('security.html', 'User\SecurityController@security'); // security
        Route::get('bind.html', 'User\BindController@index'); // index
        Route::get('address.html', 'User\AddressController@index'); // index
        Route::get('growth-value.html', 'User\RankController@growthValue'); // 会员成长值
        Route::get('history.html', 'User\HistoryController@index'); // 我的足迹
        Route::get('order.html', 'User\OrderController@index'); // 我的订单
        Route::get('integral.html', 'User\IntegralController@detail'); // 我的积分
        Route::get('bonus.html', 'User\BonusController@lists'); // 我的红包
        Route::get('complaint.html', 'User\ComplaintController@lists'); // 我的投诉
        Route::get('member-card.html', 'User\MemberCardController@lists'); // 我的会员卡 后期废弃掉
        Route::get('rights-card.html', 'User\RightsCardController@index'); // 我的会员卡 新的样式
        Route::get('back.html', 'User\BackOrderController@lists'); // 退款退货、换货维修
        Route::get('capital-account.html', 'User\CapitalAccountController@lists'); // 我的资金账户


        Route::group(['prefix' => 'scan-code'], function () {
            Route::get('index.html', 'User\ScanCodeController@index'); // 会员专属码
            Route::get('listening.html', 'User\ScanCodeController@listening'); // listening
            Route::post('get-code', 'User\ScanCodeController@getCode'); // getCode

        });

        // 个人资料
        Route::group(['prefix' => 'profile'], function () {
            Route::get('client-validate', 'User\ProfileController@clientValidate'); // clientValidate
            Route::post('edit-profile-info', 'User\ProfileController@editProfileInfo'); // 修改会员信息
            Route::post('edit-base', 'User\ProfileController@editBase'); // 修改基本信息
            Route::post('edit-real', 'User\ProfileController@editReal'); // 修改实名认证信息
            Route::post('up-load', 'User\ProfileController@upload'); // 修改头像信息
        });

        // 账户安全
        Route::group(['prefix' => 'security'], function () {
            Route::get('security.html', 'User\SecurityController@security'); // security
            Route::get('edit-password.html', 'User\SecurityController@editPassword')->name('edit-password'); // editPassword
            Route::post('edit-password', 'User\SecurityController@editPasswordSave'); // editPassword
            Route::get('edit-mobile.html', 'User\SecurityController@editMobile')->name('edit-mobile'); // editMobile
            Route::post('edit-mobile', 'User\SecurityController@editMobileSave'); // editMobile
            Route::get('edit-email.html', 'User\SecurityController@editEmail')->name('edit-email'); //
            Route::post('edit-email', 'User\SecurityController@editEmailSave'); //
            Route::post('sms-captcha.html', 'User\SecurityController@smsCaptcha'); // 发送短信验证码
            Route::any('validate.html', 'User\SecurityController@validateData'); // validate
            Route::get('client-validate', 'User\SecurityController@clientValidate'); // clientValidate
            Route::get('edit-surplus-password.html', 'User\SecurityController@editSurplusPassword'); //
            Route::post('edit-surplus-password', 'User\SecurityController@editSurplusPasswordSave'); //
            Route::get('close-surplus-password.html', 'User\SecurityController@closeSurplusPassword'); //
            Route::post('cancel.html', 'User\SecurityController@cancel'); // 注销账户 将账户设置为禁止登陆状态


        });

        // 账号绑定
        Route::group(['prefix' => 'bind'], function () {
            Route::get('bind.html', 'User\BindController@index'); // index
            Route::get('remove', 'User\BindController@remove'); //
        });

        // 我的消息
        Route::get('message.html', 'User\MessageController@message'); // 系统公告
        Route::group(['prefix' => 'message'], function () {
            Route::get('internal.html', 'User\MessageController@internal'); // 站内信
            Route::post('read', 'User\MessageController@read'); // 标为已读
            Route::post('delete', 'User\MessageController@delete'); // 删除
            Route::get('message-info', 'User\MessageController@messageInfo'); // 站内信查看
        });

        // 我的收藏
        Route::group(['prefix' => 'collect'], function () {
            Route::get('goods.html', 'User\CollectController@index'); //
            Route::get('goods', 'User\CollectController@index'); //
            Route::get('shop.html', 'User\CollectController@shop'); //
            Route::get('shop', 'User\CollectController@shop'); //
            Route::post('toggle', 'User\CollectController@toggle'); // 商品收藏/取消收藏
            Route::get('delete-collect', 'User\CollectController@deleteCollect'); // 删除收藏

            Route::get('goods-list.html', 'SiteController@goodsCollectList'); // PC端 异步加载收藏商品列表
        });

        // 收货地址
        Route::group(['prefix' => 'address'], function () {
            Route::get('index.html', 'User\AddressController@index'); // index
            Route::get('add', 'User\AddressController@add'); // add
            Route::get('add.html', 'User\AddressController@add'); // add
            Route::get('edit', 'User\AddressController@edit'); // edit
            Route::get('edit.html', 'User\AddressController@edit'); // edit
            Route::post('add.html', 'User\AddressController@saveData'); // saveData
            Route::post('edit.html', 'User\AddressController@saveData'); // saveData
            Route::get('set-default', 'User\AddressController@setDefault'); // setDefault
            Route::get('del', 'User\AddressController@delete'); // delete
            Route::get('del.html', 'User\AddressController@delete'); // delete

        });

        // 我的足迹
        Route::group(['prefix' => 'history'], function () {
            Route::get('del-all', 'User\HistoryController@delAll'); // 清空历史记录
            Route::get('del', 'User\HistoryController@delete'); // 删除历史记录
            Route::post('del', 'User\HistoryController@delete'); // 删除历史记录

        });

        // 我的订单
        Route::group(['prefix' => 'order'], function () {
            Route::get('list.html', 'User\OrderController@lists'); // 订单列表
            Route::get('list', 'User\OrderController@lists'); // 订单列表
            Route::get('info', 'User\OrderController@info'); // 订单详情
            Route::get('info.html', 'User\OrderController@info'); // 订单详情
            Route::get('edit-order', 'User\OrderController@editOrder'); //
            Route::get('edit-order.html', 'User\OrderController@editOrder'); //
            Route::post('cancel.html', 'User\OrderController@cancel'); // 取消订单
            Route::post('confirm', 'User\OrderController@confirm'); // 确认收货
            Route::post('delete.html', 'User\OrderController@delete'); // 删除订单
            Route::get('express.html', 'User\OrderController@express'); // 查看物流

        });

        // 我的积分
        Route::group(['prefix' => 'integral'], function () {
            Route::get('detail.html', 'User\IntegralController@detail'); // 积分明细
            Route::get('view', 'User\IntegralController@view'); // 查看各商家账户积分
            Route::get('order-list.html', 'User\IntegralController@orderList'); // 积分兑换
            Route::get('order-info.html', 'User\IntegralController@orderInfo'); // 积分兑换详情
            Route::post('get-balance-points.html', 'User\IntegralController@getBalancePoints'); // 将商家的线下积分转入商城

        });

        // 我的红包
        Route::group(['prefix' => 'bonus'], function () {
            Route::post('receive.html', 'User\BonusController@receive'); // 领取红包

        });

        // 我的投诉
        Route::group(['prefix' => 'complaint'], function () {
            Route::get('list.html', 'User\ComplaintController@lists'); // 列表
            Route::get('list', 'User\ComplaintController@lists'); // 列表
            Route::get('view.html', 'User\ComplaintController@view'); // 详情

        });

        // 我的评价
        Route::group(['prefix' => 'evaluate'], function () {
            Route::get('index.html', 'User\EvaluateController@lists'); // 列表
            Route::get('list.html', 'User\EvaluateController@lists'); // 列表
            Route::get('list', 'User\EvaluateController@lists'); // 列表
            Route::get('info.html', 'User\EvaluateController@info'); // 详情

        });

        // 我的提货券
        Route::group(['prefix' => 'gift-card'], function () {
            Route::get('index.html', 'User\GiftCardController@index'); //

        });

        // 退款退货、换货维修
        Route::group(['prefix' => 'back'], function () {
            Route::get('info', 'User\BackOrderController@info'); //
            Route::get('info.html', 'User\BackOrderController@info'); //
            Route::get('apply.html', 'User\BackOrderController@apply'); // 申请售后
            Route::post('apply.html', 'User\BackOrderController@applySave'); // 申请售后提交
            Route::get('edit.html', 'User\BackOrderController@edit'); //
            Route::post('edit.html', 'User\BackOrderController@editSave'); // 修改申请售后提交
            Route::post('cancel', 'User\BackOrderController@cancel'); // 取消售后申请
            Route::get('confirm-sys.html', 'User\BackOrderController@confirmSys'); // 系统自动同意申请

        });

        // 我的资金账户
        Route::group(['prefix' => 'capital-account'], function () {
            Route::get('get-data', 'User\CapitalAccountController@getData'); //
            Route::get('view', 'User\CapitalAccountController@view'); // 查看各商家账户资金

        });

        // 我的会员卡
        Route::group(['prefix' => 'rights-card'], function () {
            Route::get('index.html', 'User\RightsCardController@index'); // 我的会员卡 新的样式
            Route::get('info', 'User\RightsCardController@info'); // 我的会员卡
            Route::get('buy-list.html', 'User\RightsCardController@buyList'); // 付费卡购卡记录
        });

        // 签到
        Route::group(['prefix' => 'sign-in'], function () {
            Route::get('info.html', 'User\SignInController@info'); // 签到页面
            Route::post('go.html', 'User\SignInController@go'); // 开始签到
        });
    });

});
