<?php

use \Illuminate\Http\Request;
use \App\Modules\Frontend\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

$prefix = '';
$lrw_tag = get_lrw_tag();
if ((strlen($lrw_tag) == 7 || strlen($lrw_tag) == 9) && !in_array($lrw_tag, ['article', 'website', 'respond', 'dashboard'])) {
    $prefix = $lrw_tag;
}
Route::group(['domain' => config('lrw.mobile_domain'), 'prefix' => $prefix], function ($router) {
    Route::get('/subsite/index.html', 'SubSiteController@index');
    Route::get('/subsite/change.html', 'SubSiteController@change');

    // 首页
    Route::get('/index.html', 'HomeController@home')->name('mobile_home'); // todo ok
    Route::get('/', 'HomeController@home')->name('mobile_home'); // todo ok
    Route::get('/preview.html', 'HomeController@preview')->name('mobile_preview'); // 装修预览

    // 店铺红包推广
    Route::get('bonus-success-{bonus_id}', 'HomeController@bonusSuccess')->where('bonus_id', '[0-9]+'); // 红包领取成功页面
    Route::get('bonus-{bonus_id}', 'HomeController@bonusPush')
        ->where('bonus_id', '[0-9]+')->name('mobile_bonus_push'); // 店铺红包推广

    Route::post('activity/bonus/index.html', 'Activity\BonusController@index'); // 领取红包

    // 商品全部分类
    Route::get('/category.html', 'CategoryController@index')->name('mobile_category'); // todo ok

    // Search Route
    Route::get('/search.html', 'SearchController@index')->name('mobile_global_search'); // 全站搜索（商品/店铺）
    Route::post('/search/delete-record.html', 'SearchController@deleteRecord'); // 删除关键词搜索记录

    Route::get('/brand.html', 'BrandController@index')->name('mobile_brand'); // 品牌库 // todo ok

    // Site Route
    Route::group(['prefix' => 'site'], function () {

        Route::get('user', 'SiteController@user');
        Route::get('user.html', 'SiteController@user');
		Route::post('sms-captcha', 'SiteController@smsCaptcha'); // 发送短信验证码
        Route::get('subsite-location.html', 'SiteController@subSiteLocation'); //

        Route::get('get-session-id', 'SiteController@getSessionId');
        Route::get('get-new-order-list.html', 'SiteController@getNewOrderList');

        Route::get('captcha.html', 'SiteController@captcha'); // 图片验证码
        Route::get('region-list', 'SiteController@regionList'); // 异步加载地区
        Route::get('region-list.html', 'SiteController@regionList'); // 异步加载地区
        Route::post('upload-image', 'SiteController@uploadImage'); // 用户上传图片
        Route::get('tpl-data', 'SiteController@tplData'); // 异步加载模板数据

        Route::get('ajax-render.html', 'SiteController@ajaxRender'); // 异步加载模板内容
        Route::any('qrcode-login.html', 'SiteController@qrcodeLogin'); //


        Route::get('alioss.html', 'SiteController@alioss'); // 阿里云oss 文件上传
        Route::get('get-yikf.html', 'SiteController@getYikf');
        Route::post('get-weixinconfig.html', 'SiteController@getWeiXinConfig'); // getWeiXinConfig
        Route::get('region-gps', 'SiteController@regionGps');


    });


    // 购物车 Route
    Route::get('/cart.html', 'CartController@cartList')->name('mobile_cart_list'); // 购物车结算列表
    Route::group(['prefix' => 'cart'], function () {

        Route::get('box-goods-list.html', 'CartController@boxGoodsList'); // 顶部和右边购物车盒子
        Route::post('add.html', 'CartController@add'); // 添加购物车
        Route::post('add', 'CartController@add'); // 添加购物车
        Route::post('remove.html', 'CartController@remove'); // 移除购物车
        Route::post('remove', 'CartController@remove'); // 移除购物车
        Route::post('delete.html', 'CartController@delete'); // 移除购物车
        Route::post('delete', 'CartController@delete'); // 移除购物车
        Route::post('select.html', 'CartController@select'); // 选择购物车商品
        Route::post('select', 'CartController@select'); // 选择购物车商品
        Route::post('change-number.html', 'CartController@changeNumber'); // 更改购物车商品数量
        Route::post('change-number', 'CartController@changeNumber'); // 更改购物车商品数量
        Route::any('go-checkout', 'CartController@goCheckout'); // 购物车下单 跳转到提交订单页面
        Route::any('go-checkout.html', 'CartController@goCheckout'); // 购物车下单 跳转到提交订单页面

        Route::post('quick-buy.html', 'CartController@quickBuy'); // 直接购买 跳转到提交订单页面


    });

    // 文章 Route
    Route::group(['prefix' => 'help'], function () {
        Route::get('default/info', 'ArticleController@showHelp'); // defaultInfo 帮助中心 文章详情 // todo ok
        Route::get('{article_id}.html', 'ArticleController@showHelp')->name('mobile_show_help')->where('article_id', '[0-9]+'); // showHelp // todo ok

        Route::get('default/search', 'ArticleController@defaultSearch'); // defaultSearch 帮助中心 文章搜索 // todo ok
        Route::post('default/search', 'ArticleController@defaultSearch'); // defaultSearch 帮助中心 文章搜索 // todo ok

//        Route::get('shop/list/{cat_id}.html', 'ArticleController@showShopList')->name('show_shop_list'); // showShopList
//        Route::get('shop/{article_id}.html', 'ArticleController@showShop')->name('show_shop'); // showShop
        Route::get('article/{article_id}.html', 'ArticleController@showShop')->name('mobile_show_shop')->where('article_id', '[0-9]+'); // showShop // todo ok

    });
    Route::group(['prefix' => 'article'], function () {
        Route::get('{article_id}.html', 'ArticleController@showArticle')->name('mobile_show_article')->where('article_id', '[0-9]+'); // 所有文章分类中的文章详情 // todo ok
        Route::get('list/{cat_id}.html', 'ArticleController@showArticleList')->name('mobile_show_article_list')->where('cat_id', '[0-9]+'); // showArticleList // todo ok

    });


    // 外卖风格店铺首页
    Route::get('theme/takeout/{shop_id}.html', 'Theme\TakeoutController@shopHome')->where('shop_id', '[0-9]+');
    Route::get('theme/takeout/{shop_id}', 'Theme\TakeoutController@shopHome')->where('shop_id', '[0-9]+');

    // 自由购
    Route::get('freebuy/scan/{shop_id}.html', 'Freebuy\ScanController@scan')->where('shop_id', '[0-9]+'); // 自由购扫码


    /*旧的路由写法 增加一个方法就需要写一条路由*/
    // /shop-list-1.html /shop-list-1-0.html /shop-list-1-549.html
    Route::get('shop-list-{filter_str}.html', 'ShopController@shopGoodsList')->name('mobile_shop_goods_list'); // 店铺内商品列表 第一个参数是店铺id 第二个参数是店铺内分类id

    Route::get('shops', 'ShopController@shops')->name('mobile_shop_street'); // 店铺街/附近商家

    Route::get('index.html', 'MultiStoreController@storeHome')->name('mobile_store_home'); // 门店首页
//    Route::get('{lrw_tag}/index.html', 'MultiStoreController@storeHome')->name('mobile_store_home')->where('lrw_tag', '\.w{9}'); // 门店首页
    Route::group(['prefix' => 'multistore'], function () {
        Route::get('index.html', 'MultiStoreController@storeHome')->name('mobile_store_home'); // 门店首页
        Route::get('location.html', 'MultiStoreController@location')->name('mobile_store_location'); //
        Route::get('index/info', 'MultiStoreController@storeInfo')->name('mobile_store_info');
    });

    Route::get('shop/{shop_id}.html', 'ShopController@shopHome')->name('mobile_shop_home')->where('shop_id', '[0-9]+'); // 店铺首页
    Route::group(['prefix'=>'shop'], function () {
        Route::get('qrcode.html', 'ShopController@qrCode'); // 店铺二维码

        // 店铺入驻路由
        Route::get('apply.html', 'ShopApplyController@apply');
        Route::get('apply/index.html', 'ShopApplyController@apply');
        Route::get('apply/agreement.html', 'ShopApplyController@agreement');
        Route::get('apply/register.html', 'ShopApplyController@register');
        Route::get('apply/progress.html', 'ShopApplyController@apply'); // 店铺入驻进度
        Route::get('apply/result.html', 'ShopApplyController@result'); // 店铺入驻结果
        Route::get('apply/agreement-type1.html', 'ShopApplyController@agreementType1');
        Route::any('apply/auth-info.html', 'ShopApplyController@authInfo');
        Route::any('apply/shop-info.html', 'ShopApplyController@shopInfo');
        Route::get('apply/client-validate', 'ShopApplyController@clientValidate'); // clientValidate
        Route::post('apply/pay.html', 'ShopApplyController@pay');
        Route::get('apply/payment.html', 'ShopApplyController@payment');
        Route::get('apply/check-is-pay', 'ShopApplyController@checkIsPay');

//        Route::get('street/index.html', 'ShopController@street')->name('mobile_shop_street'); // 店铺街
//        Route::get('street/index', 'ShopController@street')->name('mobile_shop_street'); // 店铺街
        Route::get('street/ref-distance', 'ShopController@refDistance'); //
        Route::get('street/index.html', 'ShopController@shops')->name('mobile_shop_street'); // 店铺街
        Route::get('street/index', 'ShopController@shops')->name('mobile_shop_street'); // 店铺街
        Route::get('street/open-list', 'ShopController@openList'); //

        Route::get('{shop_id}.html', 'ShopController@shopHome')->name('mobile_shop_home')->where('shop_id', '[0-9]+'); // 店铺首页

        /*if (isset($is_takeout_mode) && $is_takeout_mode) { // 是否是外卖模式
            Route::get('{shop_id}.html', 'Theme\TakeoutController@shopHome')->name('mobile_shop_home');
        } else {
            Route::get('{shop_id}.html', 'ShopController@shopHome')->name('mobile_shop_home'); // 店铺首页
        }*/
        Route::get('{shop_id}/info.html', 'ShopController@shopDetail')->name('mobile_shop_info')->where('shop_id', '[0-9]+'); // 店铺详情
        Route::get('{shop_id}/list.html', 'ShopController@shopGoodsList')->name('mobile_shop_goods_list')->where('shop_id', '[0-9]+'); // 店铺内商品列表
        Route::get('{shop_id}/list', 'ShopController@shopGoodsList')->name('mobile_shop_goods_list')->where('shop_id', '[0-9]+'); // 店铺内商品列表
        Route::get('{shop_id}/search.html', 'ShopController@shopSearch')->name('mobile_shop_search')->where('shop_id', '[0-9]+'); // 店铺内搜索
        Route::get('index/info', 'ShopController@shopDetail')->name('mobile_shop_index_info'); // 店铺信息 异步加载
        Route::any('index/license.html', 'ShopController@license'); // 经营者营业执照信息
        Route::get('index/shop-cat-list', 'ShopController@shopCatList'); // 店铺内分类

        Route::get('index/preview.html', 'ShopController@preview')->name('mobile_shop_preview'); // 装修预览


    });

    /*新的路由写法 只需要对每个控制器写一条路径即可*/
    // 店铺
//    Route::any('/shop/apply/{action}.html', function ($action, Request $request) {
//        $class = App::make(Controllers\ShopController::class);
//        return $class->$action($request);
//    });



    // Passport Route
    $router->get('login', 'PassportController@showLoginForm')->name('user.login'); // showLoginForm
    $router->get('login.html', 'PassportController@showLoginForm')->name('user.login'); // showLoginForm
    $router->post('login', 'PassportController@login'); // login
    $router->post('login.html', 'PassportController@login'); // login
    $router->any('register.html', 'PassportController@showRegisterForm'); // showRegisterForm
    $router->any('register/mobile.html', 'PassportController@showRegisterForm'); // showRegisterForm

    $router->any('register/email.html', 'PassportController@showRegisterForm'); // showRegisterForm
    $router->get('register/client-validate', 'PassportController@clientValidate'); // clientValidate
    $router->post('register/sms-captcha', 'PassportController@smsCaptcha'); // 发送短信验证码
    $router->post('register/check-sms-captcha.html', 'PassportController@checkSmsCaptcha'); // 验证短信验证码
    $router->post('register/email-captcha', 'PassportController@emailCaptcha'); // 发送邮箱验证码

    $router->any('site/logout.html', 'PassportController@logout')->name('user.logout'); // logout

//    $router->get('/website/login', 'WebSiteController@login'); // 第三方登录
//    $router->post('/website/login.html', 'WebSiteController@login'); // 第三方登录
//    $router->get('/website/act-login.html', 'WebSiteController@actLogin'); // 执行登录
    $router->get('/login/website-login', 'WebSiteController@login'); // 第三方登录
    $router->post('/login/website-login.html', 'WebSiteController@login'); // 第三方登录
	$router->get('/website/act-login.html', 'WebSiteController@actLogin'); // 执行登录
	$router->get('/oauth', 'WebSiteController@oauth'); // 微信免登陆授权

	$router->get('/bind', 'BindController@index'); // 账号绑定 已有账号
	$router->post('/bind.html', 'BindController@index'); // 账号绑定 已有账号
	$router->get('/bind/bind/{type}', 'BindController@bind'); // 账号绑定 没有账号
	$router->post('/bind/bind/{type}.html', 'BindController@bind'); // 账号绑定 没有账号

//	$router->get('/bind/bind/mobile-bind.html', 'BindController@mobileBind'); // 微信授权后 绑定手机号


    // 专题活动 Route
    $router->get('/topic/{topic_id}.html', 'TopicController@show')->name('mobile_show_topic')->where('topic_id', '[0-9]+');

    // 资讯 Route
    Route::get('/news.html', 'NewsController@home')->name('mobile_news_home'); // index
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@home')->name('mobile_news_home'); // index
        Route::get('list/{cat_id}.html', 'NewsController@lists')->name('mobile_news_list')->where('cat_id', '[0-9]+'); // lists
        Route::get('{article_id}.html', 'NewsController@show')->name('mobile_show_news')->where('article_id', '[0-9]+'); // show

    });

    // 购买下单
    Route::get('/checkout.html', 'BuyController@checkout')->name('pc-checkout'); // 购物车/直接购买 确认交易
    Route::group(['prefix' => 'checkout'], function () {
        Route::get('user-address', 'BuyController@userAddress'); // 用户收货地址
        Route::get('user-address.html', 'BuyController@userAddress'); // 用户收货地址
        Route::post('change-address', 'BuyController@changeAddress'); // 修改收货地址
        Route::post('change-best-time', 'BuyController@changeBestTime'); // 修改送货时间
        Route::post('change-invoice', 'BuyController@changeInvoice'); // 修改发票信息
        Route::post('change-payment', 'BuyController@changePayment'); // 修改支付订单信息
        Route::post('search-pickup.html', 'BuyController@searchPickup'); // 搜索自提点
        Route::post('submit', 'BuyController@submit'); // 提交订单
        Route::post('submit.html', 'BuyController@submit'); // 提交订单
        Route::post('resubmit', 'BuyController@resubmit'); // 重新提交订单
        Route::post('resubmit.html', 'BuyController@resubmit'); // 重新提交订单
        Route::get('result.html', 'BuyController@result'); // 付款结果查询
        Route::get('pay.html', 'BuyController@pay'); // 付款页面
        Route::post('set-payment.html', 'BuyController@setPayment'); // 付款页面 设置支付方式

    });

    // 订单支付
    Route::get('/payment.html', 'PaymentController@payment')->name('payment'); // 订单支付 支付宝/微信
    Route::group(['prefix' => 'payment'], function () {
        Route::get('check-is-pay', 'PaymentController@checkIsPay'); // ajax检查订单是否支付

    });

//    dd($router->routePrefix);
    // 商品
    Route::get('goods-{goods_id}.html', 'GoodsController@showGoods')->name('mobile_show_goods')
        ->where('goods_id', '[0-9]+'); // showGoods
    Route::get('/list-{filter_str?}.html', 'GoodsController@lists')->name('mobile_goods_list'); // goodsList
    Route::get('/list.html', 'GoodsController@lists'); // goodsList
//    Route::get('/list-{filter_str}.html', 'GoodsController@lists'); // goodsList
//    Route::get('/list.html', 'GoodsController@lists')->name('mobile_goods_list'); // goodsList
//    Route::get('/list-{cat_id}-{p1?}-{p2?}-{is_platform?}-{is_free_shipping?}-{is_offpay?}-{has_goods_number?}-{sort_type?}-{p9?}-{area_code?}-{p11?}-{brand_id?}-{min_price?}-{max_price?}.html', 'GoodsController@goodsList')->name('goods_list'); // 商品列表 筛选条件
    Route::get('/{sku_id}.html', 'GoodsController@showGoods')->name('mobile_show_sku_goods')
        ->where('sku_id', '[0-9]+'); // showSkuGoods

    Route::get('/lib-goods-{goods_id}.html', 'GoodsController@showLibGoods')->name('mobile_show_lib_goods')
        ->where('goods_id', '[0-9]+'); // showLibGoods

    Route::group(['prefix' => 'goods'], function () {
        Route::get('sku.html', 'GoodsController@sku'); // sku
        Route::get('sku', 'GoodsController@sku'); // sku

        Route::get('desc', 'GoodsController@desc'); // goods_desc
        Route::get('qrcode.html', 'GoodsController@qrcode'); // qrcode
        Route::get('goods-share', 'GoodsController@goodsShare'); // goodsShare
        Route::get('comment', 'GoodsController@comment'); // comment
        Route::get('change-location.html', 'GoodsController@changeLocation'); // changeLocation
        Route::get('pickup-info.html', 'GoodsController@pickupInfo'); // 自提点详情
        Route::post('search-pickup.html', 'GoodsController@searchPickup'); // 搜索自提点
        Route::get('set-default-card', 'GoodsController@setDefaultCard'); // setDefaultCard

    });

    // 商品对比
    Route::get('/compare', 'CompareController@compare')->name('mobile_compare'); // 对比商品页面
    Route::group(['prefix' => 'compare'], function () {
//        Route::post('add', 'CompareController@add'); // add
        Route::post('add', 'CompareController@toggle'); // 加入对比
        Route::get('box-goods-list', 'CompareController@boxGoodsList'); // 对比商品列表
        Route::get('freight', 'CompareController@freight'); //

    });

    // 猜你喜欢
    Route::group(['prefix' => 'guess'], function () {
        Route::get('like', 'GuessController@like'); // like

    });

    // 万能表单
    Route::get('/form/{form_id}.html', 'CustomFormController@show')->name('show_form')->where('form_id', '[0-9]+'); // 万能表单
//    Route::get('/customform/form/form-qrcode.html', 'CustomFormController@formQrcode'); // 生成表单二维码
    Route::post('/customform/form/add.html', 'CustomFormController@add'); // 提交表单

    // 自提点
    Route::get('pickup/{shop_id}.html', 'PickupController@pickup')->where('shop_id', '[0-9]+'); // 自提点列表


    // 微信公众号开发
    Route::any('wxapi/index', 'WxApiController@index'); // 微信配置 URL



    // 支付同步回调地址
    Route::any('respond/front-alipay', 'RespondController@frontAlipay'); // 支付宝同步通知
	Route::any('respond/front-weixin', 'RespondController@frontWeixin'); // 微信同步通知
	Route::any('respond/front-unipay', 'RespondController@frontUnipay'); // unipay同步通知

    // 支付异步回调地址
    Route::any('notify/front-alipay', 'NotifyController@frontAlipay'); // 支付宝异步通知
    Route::any('notify/front-weixin', 'NotifyController@frontWeixin'); // 微信异步通知
    Route::any('notify/front-weixin-refund', 'NotifyController@frontWeixinRefund'); // 微信退款异步通知
    Route::any('notify/front-unipay', 'NotifyController@frontUnipay'); // unipay异步通知


    Route::post('multistore/help/get-exhibition', 'SiteController@getExhibition');

    // 直播
    Route::get('live/index/list.html', 'LiveController@live')->name('live.live'); // 直播列表
    Route::get('live.html', 'LiveController@live')->name('live.live'); // 直播列表
    Route::post('live/index/edit-online-number', 'LiveController@editOnlineNumber'); // 更新直播间在线人数
    Route::group(['prefix' => 'live'], function () {
        Route::get('{id}.html', 'LiveController@detail')->name('live.show')->where('id', '[0-9]+'); // 直播详情
    });

    Route::get('/bonus-list-{filter_str?}.html', 'BonusController@lists')->name('pc_bonus_list');
    Route::get('/bonus-list.html', 'BonusController@lists'); // 红包集市

    // 拼团-参团详情
    Route::get('activity/groupon/join.html', 'Activity\GrouponController@join'); // 领取红包

    // 测试路由
    Route::get('send', 'HomeController@send');
    Route::get('collect-goods', 'HomeController@collectGoods'); // 测试 商品采集

});

// 商品详情二级域名解析 后期在平台后台做一个开关,是否开启商品详情二级域名解析
//Route::group(['domain' => config('lrw.mobile_goods_detail_domain')], function ($router) {
//    Route::get('/goods-{goods_id}.html', 'GoodsController@showGoods')->name('mobile_show_goods'); // showGoods
//});
