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

$domain = $goodsDetailDomain = $shopDomain = config('lrw.frontend_domain');
$goodsDetailDomainState = false; // 是否开启商品详情二级域名
$shopDomainState = false; // 是否开启店铺个性域名 todo 还有问题

if (\request()->getHost() == config('lrw.goods_detail_domain')) {
    $domain = config('lrw.goods_detail_domain');
}
if ($goodsDetailDomainState) {
    $goodsDetailDomain = config('lrw.goods_detail_domain');
}

if ($shopDomainState) {
    $subDomain = 'pingoucha';
    $shopDomain = $subDomain.'.'.config('lrw.root_domain');
}

if (is_app()) { // 接口域名
    $domain = $goodsDetailDomain = $shopDomain;
}

Route::group(['domain' => $domain], function ($router) use ($goodsDetailDomain, $shopDomain) {

	// 系统安装
    Route::get('/install/seeder', 'InstallController@seeder'); // 系统安装时填充数据

	Route::any('/install/index.html', 'InstallController@index')->name('system_install');
	Route::any('/install/check.html', 'InstallController@check')->name('system_install');
	Route::any('/install/setting.html', 'InstallController@setting')->name('system_install');
	Route::any('/install/databases', 'InstallController@databases')->name('system_install');
	Route::any('/install/success.html', 'InstallController@success')->name('system_install_success');


	// 首页
    Route::get('/index.html', 'HomeController@home')->name('pc_home');
    Route::get('/', 'HomeController@home')->name('pc_home');
    Route::get('/preview.html', 'HomeController@preview')->name('pc_preview'); // 装修预览


    // 商品全部分类
    Route::get('/category.html', 'CategoryController@index')->name('pc_category');

    // Search Route
    Route::get('/search.html', 'SearchController@index')->name('pc_global_search'); // 全站搜索（商品/店铺）
//    Route::get('/search.html', 'GoodsController@lists')->name('pc_global_search'); // 全站搜索（商品/店铺）

    Route::post('/search/delete-record.html', 'SearchController@deleteRecord'); // 删除关键词搜索记录

    Route::get('/brand.html', 'BrandController@index'); // 品牌库

    // Site Route
    Route::group(['prefix' => 'site'], function () {

        Route::get('user', 'SiteController@user');
        Route::get('user.html', 'SiteController@user');
        Route::post('sms-captcha', 'SiteController@smsCaptcha'); // 发送短信验证码

        Route::get('captcha.html', 'SiteController@captcha'); // 图片验证码
        Route::get('region-list', 'SiteController@regionList'); // 异步加载地区
        Route::get('region-list.html', 'SiteController@regionList'); // 异步加载地区
        Route::post('upload-image', 'SiteController@uploadImage'); // 用户上传图片

        Route::get('ajax-render.html', 'SiteController@ajaxRender'); // 异步加载模板内容
        Route::get('get-qrcode-login-key', 'SiteController@getQrcodeLoginKey'); // 获取二维码登录key信息
//        Route::get('qrcode-login.html', 'SiteController@qrcodeLogin'); //

        Route::get('alioss.html', 'SiteController@alioss'); // 阿里云oss 文件上传
        Route::post('address-parse.html', 'SiteController@addressParse'); // 收货地址信息解析

        Route::get('app-guide', 'SiteController@appGuide'); // App引导页
        Route::get('app-info', 'SiteController@appInfo'); // App全局数据



        Route::post('gitee-web-hooks', 'SiteController@giteeWebHooks'); // Git Web hooks 自动拉取代码

    });

	Route::get('history/box-goods-list.html', 'User\HistoryController@boxGoodsList'); // 顶部和右边我看过的商品盒子



    // 购物车 Route
    Route::get('/cart.html', 'CartController@cartList')->name('pc_cart_list'); // 购物车结算列表
    Route::group(['prefix' => 'cart'], function () {

        Route::get('box-goods-list.html', 'CartController@boxGoodsList'); // 顶部和右边购物车盒子
        Route::post('add.html', 'CartController@add'); // 添加购物车
        Route::post('remove.html', 'CartController@remove'); // 移除购物车
        Route::post('delete.html', 'CartController@delete'); // 移除购物车
        Route::post('select.html', 'CartController@select'); // 选择购物车商品
        Route::post('change-number.html', 'CartController@changeNumber'); // 更改购物车商品数量
        Route::post('go-checkout', 'CartController@goCheckout'); // 购物车下单 跳转到提交订单页面

        Route::post('quick-buy.html', 'CartController@quickBuy'); // 直接购买 跳转到提交订单页面

        Route::get('get-cart-goods-num.html', 'CartController@getCartGoodsNum'); // 获取购物车商品数量

    });

    // 文章 Route
    Route::group(['prefix' => 'help'], function () {
        Route::get('default/info', 'ArticleController@showHelp'); // defaultInfo 帮助中心 文章详情
        Route::get('{article_id}.html', 'ArticleController@showHelp')->name('pc_show_help')->where('article_id', '[0-9]+'); // showHelp

        Route::get('default/search', 'ArticleController@defaultSearch'); // defaultSearch 帮助中心 文章搜索
        Route::post('default/search', 'ArticleController@defaultSearch'); // defaultSearch 帮助中心 文章搜索

//        Route::get('shop/list/{cat_id}.html', 'ArticleController@showShopList')->name('show_shop_list'); // showShopList
//        Route::get('shop/{article_id}.html', 'ArticleController@showShop')->name('show_shop'); // showShop
        Route::get('article/{article_id}.html', 'ArticleController@showShop')->name('pc_show_shop')->where('article_id', '[0-9]+'); // showShop

    });
    Route::group(['prefix' => 'article'], function () {
        Route::get('{article_id}.html', 'ArticleController@showArticle')->name('pc_show_article')->where('article_id', '[0-9]+'); // 所有文章分类中的文章详情
        Route::get('list.html', 'ArticleController@showArticleList')->name('pc_show_article_list'); // showArticleList
        Route::get('list/{cat_id}.html', 'ArticleController@showArticleList')->name('pc_show_article_list')->where('cat_id', '[0-9]+'); // showArticleList

    });



    /*旧的路由写法 增加一个方法就需要写一条路由*/
    // /shop-list-1.html /shop-list-1-0.html /shop-list-1-549.html
    Route::get('shop-list-{filter_str}.html', 'ShopController@shopGoodsList')->name('pc_shop_goods_list'); // 店铺内商品列表 第一个参数是店铺id 第二个参数是店铺内分类id

	Route::get('shops', 'ShopController@shops'); // 店铺列表

    Route::group(['domain' => $shopDomain, 'prefix'=>'shop'], function ($router) {
        Route::get('qrcode.html', 'ShopController@qrCode'); // 店铺二维码

        // 店铺入驻路由
        Route::get('apply.html', 'ShopController@apply');
        Route::get('apply/index.html', 'ShopController@apply');
        Route::get('apply/agreement.html', 'ShopController@agreement');
        Route::get('apply/register.html', 'ShopController@register');
        Route::get('apply/progress.html', 'ShopController@apply'); // 店铺入驻进度
        Route::get('apply/result.html', 'ShopController@result'); // 店铺入驻结果
        Route::get('apply/agreement-type1.html', 'ShopController@agreementType1');
        Route::any('apply/auth-info.html', 'ShopController@authInfo');
        Route::any('apply/shop-info.html', 'ShopController@shopInfo');
        Route::get('apply/client-validate', 'ShopController@clientValidate'); // clientValidate
        Route::post('apply/pay.html', 'ShopController@pay');
        Route::get('apply/payment.html', 'ShopController@payment');
        Route::get('apply/check-is-pay', 'ShopController@checkIsPay');

        // 店铺街/店铺首页/店铺商品信息路由
//        Route::get('street/ref-distance', 'ShopController@refDistance'); //
        Route::get('street/index.html', 'ShopController@shops')->name('pc_shop_street'); // 店铺街
        Route::get('{shop_id}.html', 'ShopController@shopHome')->name('pc_shop_home')->where('shop_id', '[0-9]+'); // 店铺首页
        Route::get('{shop_id}/info.html', 'ShopController@shopDetail')->name('pc_shop_info')->where('shop_id', '[0-9]+'); // 店铺详情
        Route::get('{shop_id}/list.html', 'ShopController@shopGoodsList')->where('shop_id', '[0-9]+'); // 店铺商品列表
        Route::get('{shop_id}/search.html', 'ShopController@shopSearch')->name('pc_shop_search')->where('shop_id', '[0-9]+'); // 店铺内搜索

        Route::get('index/license.html', 'ShopController@license')->name('pc_shop_license'); // 店铺营业执照查询
        Route::get('index/info.html', 'ShopController@shopDetail'); // 店铺信息 异步加载

		Route::get('index/preview.html', 'ShopController@preview')->name('pc_shop_preview'); // 装修预览
		Route::get('index/out-openhour-order-enable.html', 'ShopController@outOpenhourOrderEnable');


	});

    /*新的路由写法 只需要对每个控制器写一条路径即可*/
    // 店铺 todo 后期改造成常规写法 否则无法缓存路由
//    Route::any('/shop/apply/{action}.html', function ($action, Request $request) {
//        $class = App::make(Controllers\ShopController::class);
//        return $class->$action($request);
//    });



    // Passport Route
    $router->any('login.html', 'PassportController@showLoginForm')->name('user.login'); // showLoginForm
    $router->any('login', 'PassportController@login'); // login
    $router->any('register.html', 'PassportController@showRegisterForm'); // showRegisterForm
    $router->any('register/mobile.html', 'PassportController@showRegisterForm'); // showRegisterForm

    $router->any('register/email.html', 'PassportController@showRegisterForm'); // showRegisterForm
    $router->get('register/client-validate', 'PassportController@clientValidate'); // clientValidate
    $router->post('register/sms-captcha', 'PassportController@smsCaptcha'); // 发送短信验证码
    $router->post('register/email-captcha', 'PassportController@emailCaptcha'); // 发送邮箱验证码

    $router->any('site/logout.html', 'PassportController@logout')->name('user.logout'); // logout

    $router->get('/website/login', 'WebSiteController@login'); // 第三方登录
    $router->post('/website/login.html', 'WebSiteController@login'); // 第三方登录
    $router->get('/website/act-login.html', 'WebSiteController@actLogin'); // 执行登录

    $router->get('/bind', 'BindController@index'); // 账号绑定 已有账号
    $router->post('/bind.html', 'BindController@index'); // 账号绑定 已有账号
    $router->get('/bind/bind/{type}', 'BindController@bind'); // 账号绑定 没有账号
    $router->post('/bind/bind/{type}.html', 'BindController@bind'); // 账号绑定 没有账号




    // 专题活动 Route
    $router->get('/topic/{topic_id}.html', 'TopicController@show')->name('pc_show_topic')
        ->where('topic_id', '[0-9]+');

    // 资讯 Route
    Route::get('/news.html', 'NewsController@home')->name('pc_news_home'); // index
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@home')->name('pc_news_home'); // index
        Route::get('list/{cat_id}.html', 'NewsController@lists')->name('pc_news_list')
            ->where('cat_id', '[0-9]+'); // lists
        Route::get('{article_id}.html', 'NewsController@show')->name('pc_show_news')
            ->where('article_id', '[0-9]+'); // show

    });

    // 购买下单
    Route::get('/checkout.html', 'BuyController@checkout'); // 购物车/直接购买 确认交易
    Route::group(['prefix' => 'checkout'], function () {
        Route::get('user-address', 'BuyController@userAddress'); // 用户收货地址
        Route::post('change-address', 'BuyController@changeAddress'); // 修改收货地址
        Route::post('change-best-time', 'BuyController@changeBestTime'); // 修改送货时间
        Route::post('change-invoice', 'BuyController@changeInvoice'); // 修改发票信息
        Route::post('change-payment', 'BuyController@changePayment'); // 修改支付订单信息
        Route::post('search-pickup.html', 'BuyController@searchPickup'); // 搜索自提点
        Route::post('submit.html', 'BuyController@submit'); // 提交订单
        Route::post('resubmit.html', 'BuyController@resubmit'); // 重新提交订单
        Route::get('result.html', 'BuyController@result'); // 付款结果查询
        Route::get('pay.html', 'BuyController@pay'); // 付款页面
        Route::post('set-payment.html', 'BuyController@setPayment'); // 付款页面 设置支付方式

    });

    // 订单支付
    Route::get('/payment.html', 'PaymentController@payment')->name('payment'); // 订单支付 支付宝/微信
    Route::group(['prefix' => 'payment'], function () {
        Route::get('check-is-pay', 'PaymentController@checkIsPay'); // ajax检查订单是否支付
        Route::get('qr-code', 'PaymentController@qrCode')->name('pc_qrcode'); // ajax检查订单是否支付

    });

//    dd($router->routePrefix);
    // 商品
    Route::get('/list-{filter_str?}.html', 'GoodsController@lists')->name('pc_goods_list'); // goodsList
    Route::get('/list.html', 'GoodsController@lists'); // goodsList
//    Route::get('/list-{cat_id}-{p1?}-{p2?}-{is_platform?}-{is_free_shipping?}-{is_offpay?}-{has_goods_number?}-{sort_type?}-{p9?}-{area_code?}-{p11?}-{brand_id?}-{min_price?}-{max_price?}.html', 'GoodsController@goodsList')->name('goods_list'); // 商品列表 筛选条件


    // 商品详情二级域名解析 后期在平台后台做一个开关,是否开启商品详情二级域名解析
    Route::group(['domain' => $goodsDetailDomain], function ($router) {
        Route::get('/goods-{goods_id}.html', 'GoodsController@showGoods')->name('pc_show_goods')
            ->where('goods_id', '[0-9]+'); // showGoods
        Route::get('/{sku_id}.html', 'GoodsController@showGoods')->name('pc_show_sku_goods')
            ->where('sku_id', '[0-9]+'); // showSkuGoods

        Route::get('/lib-goods-{goods_id}.html', 'GoodsController@showLibGoods')->name('pc_show_lib_goods')
            ->where('goods_id', '[0-9]+'); // showLibGoods

        Route::group(['prefix' => 'goods'], function () {
            Route::get('sku.html', 'GoodsController@sku'); // sku
            Route::get('sku', 'GoodsController@sku'); // sku

            Route::get('desc.html', 'GoodsController@desc'); // goods_desc
            Route::get('qrcode.html', 'GoodsController@qrcode'); // qrcode
            Route::get('comment.html', 'GoodsController@comment'); // comment
            Route::get('comment', 'GoodsController@comment'); // comment
            Route::get('change-location.html', 'GoodsController@changeLocation'); // changeLocation
            Route::get('pickup-info.html', 'GoodsController@pickupInfo'); // 自提点详情
            Route::post('search-pickup.html', 'GoodsController@searchPickup'); // 搜索自提点

        });
    });




    // 商品对比
    Route::get('/user/compare.html', 'CompareController@compare')->name('pc_compare'); // 对比商品页面
    Route::get('/compare', 'CompareController@compare')->name('pc_compare'); // 对比商品页面
    Route::group(['prefix' => 'compare'], function () {
//        Route::post('add', 'CompareController@add'); // add
        Route::post('add', 'CompareController@toggle'); // 加入对比
        Route::post('toggle', 'CompareController@toggle'); // 加入对比
        Route::post('remove', 'CompareController@remove'); //
        Route::post('clear', 'CompareController@clear'); //
        Route::get('box-goods-list', 'CompareController@boxGoodsList'); // 对比商品列表
        Route::get('freight', 'CompareController@freight'); //
        Route::get('goods-list.html', 'SiteController@goodsCompareList'); // PC端 异步加载对比商品列表

    });

    // 猜你喜欢
    Route::group(['prefix' => 'guess'], function () {
        Route::get('like', 'GuessController@like'); // like

    });

    // 站点
    Route::get('/subsite/index.html', 'SubSiteController@index'); // 跳转站点域名
    Route::get('/subsite/selector.html', 'SubSiteController@selector'); // 站点选择弹出框


    // 万能表单
    Route::get('/form/{form_id}.html', 'CustomFormController@show')->name('show_form')->where('form_id', '[0-9]+'); // 万能表单
    Route::get('/customform/form/form-qrcode.html', 'CustomFormController@formQrcode'); // 生成表单二维码
    Route::post('/customform/form/add.html', 'CustomFormController@add'); // 提交表单


	// 支付同步回调地址
	Route::any('respond/front-alipay', 'RespondController@frontAlipay'); // 支付宝同步通知
	Route::any('respond/front-weixin', 'RespondController@frontWeixin'); // 微信同步通知
	Route::any('respond/front-unipay', 'RespondController@frontUnipay'); // unipay同步通知

	// 支付异步回调地址
	Route::any('notify/front-alipay', 'NotifyController@frontAlipay'); // 支付宝异步通知
	Route::any('notify/front-weixin', 'NotifyController@frontWeixin'); // 微信异步通知
	Route::any('notify/front-unipay', 'NotifyController@frontUnipay'); // unipay异步通知

    // 直播
    Route::get('live/index/list.html', 'LiveController@live')->name('live.live'); // 直播列表
    Route::get('live.html', 'LiveController@live')->name('live.live'); // 直播列表
    Route::post('live/index/edit-online-number', 'LiveController@editOnlineNumber'); // 更新直播间在线人数
    Route::group(['prefix' => 'live'], function () {
        Route::get('{id}.html', 'LiveController@detail')->name('live.pc_show')->where('id', '[0-9]+'); // 直播详情
    });

    Route::get('/bonus-list-{filter_str?}.html', 'BonusController@lists')->name('pc_bonus_list');
    Route::get('/bonus-list.html', 'BonusController@lists'); // 红包集市

    Route::post('activity/bonus/index.html', 'Activity\BonusController@index');  // 领取红包


    // 积分商城 购买下单
    Route::get('/integralmall/checkout.html', 'Integralmall\BuyController@checkout'); // 直接购买 确认交易
    Route::group(['prefix' => 'integralmall/checkout'], function () {
        Route::get('user-address', 'Integralmall\BuyController@userAddress'); // 用户收货地址
        Route::post('change-address', 'Integralmall\BuyController@changeAddress'); // 修改收货地址
        Route::post('change-best-time', 'Integralmall\BuyController@changeBestTime'); // 修改送货时间
        Route::post('search-pickup.html', 'Integralmall\BuyController@searchPickup'); // 搜索自提点
        Route::post('submit.html', 'Integralmall\BuyController@submit'); // 提交订单
        Route::post('resubmit.html', 'Integralmall\BuyController@resubmit'); // 重新提交订单
        Route::get('result.html', 'BuyController@result'); // 付款结果查询
//        Route::get('pay.html', 'Integralmall\BuyController@pay'); // 付款页面
//        Route::post('set-payment.html', 'Integralmall\BuyController@setPayment'); // 付款页面 设置支付方式

    });



    // 测试路由
    Route::get('send', 'HomeController@send');
    Route::get('amap', 'HomeController@amap');
    Route::get('collect-goods', 'HomeController@collectGoods'); // 测试 商品采集
    Route::get('pusher-test', 'HomeController@pusherTest');
    Route::get('jpush', 'HomeController@jpush'); // 测试 极光推送（手动推送）


	Route::post('openai/chat-gpt', 'OpenaiController@chatGpt');


});


