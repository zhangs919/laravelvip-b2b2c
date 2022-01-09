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

// 判断请求来源客户端
//dd(request()->getHost());
//if (is_mobile() && !is_app() && request()->getHost() == env('MOBILE_DOMAIN')) { // 微信端
//    $domain = env('MOBILE_DOMAIN');
//    $routePrefix = 'mobile_';
//} else { // pc端和app端
//    $domain = env('FRONTEND_DOMAIN');
//    $routePrefix = 'pc_';
//}


Route::group(['domain' => env('FRONTEND_DOMAIN')], function ($router) {

    // 首页
    Route::get('/index.html', 'HomeController@home')->name('pc_home'); // todo ok
    Route::get('/', 'HomeController@home')->name('pc_home'); // todo ok

    // 商品全部分类
    Route::get('/category.html', 'CategoryController@index')->name('pc_category'); // todo ok

    // Search Route
    Route::get('/search.html', 'SearchController@index')->name('pc_global_search'); // 全站搜索（商品/店铺）
//    Route::get('/search.html', 'GoodsController@lists')->name('pc_global_search'); // 全站搜索（商品/店铺）

    Route::post('/search/delete-record.html', 'SearchController@deleteRecord'); // 删除关键词搜索记录

    Route::get('/brand.html', 'BrandController@index'); // 品牌库 // todo ok

    // Site Route
    Route::group(['prefix' => 'site'], function () {

        Route::get('user', 'SiteController@user');
        Route::get('user.html', 'SiteController@user');
        Route::get('captcha.html', 'SiteController@captcha'); // 图片验证码
        Route::get('region-list', 'SiteController@regionList'); // 异步加载地区
        Route::get('region-list.html', 'SiteController@regionList'); // 异步加载地区
        Route::post('upload-image', 'SiteController@uploadImage'); // 用户上传图片

    });


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


    });

    // 文章 Route
    Route::group(['prefix' => 'help'], function () {
        Route::get('default/info', 'ArticleController@showHelp'); // defaultInfo 帮助中心 文章详情 // todo ok
        Route::get('{article_id}.html', 'ArticleController@showHelp')->name('pc_show_help'); // showHelp // todo ok

        Route::get('default/search', 'ArticleController@defaultSearch'); // defaultSearch 帮助中心 文章搜索 // todo ok
        Route::post('default/search', 'ArticleController@defaultSearch'); // defaultSearch 帮助中心 文章搜索 // todo ok

//        Route::get('shop/list/{cat_id}.html', 'ArticleController@showShopList')->name('show_shop_list'); // showShopList
//        Route::get('shop/{article_id}.html', 'ArticleController@showShop')->name('show_shop'); // showShop
        Route::get('article/{article_id}.html', 'ArticleController@showShop')->name('pc_show_shop'); // showShop // todo ok

    });
    Route::group(['prefix' => 'article'], function () {
        Route::get('{article_id}.html', 'ArticleController@showArticle')->name('pc_show_article'); // 所有文章分类中的文章详情 // todo ok
        Route::get('list/{cat_id}.html', 'ArticleController@showArticleList')->name('pc_show_article_list'); // showArticleList // todo ok

    });



    /*旧的路由写法 增加一个方法就需要写一条路由*/
    // /shop-list-1.html /shop-list-1-0.html /shop-list-1-549.html
    Route::get('shop-list-{filter_str}.html', 'ShopController@shopGoodsList')->name('pc_shop_goods_list'); // 店铺内商品列表 第一个参数是店铺id 第二个参数是店铺内分类id
    Route::group(['prefix'=>'shop'], function () {
        // 店铺入驻路由
        Route::get('apply.html', 'ShopController@apply');
        Route::get('apply/index.html', 'ShopController@apply');
        Route::get('apply/progress.html', 'ShopController@apply'); // 店铺入驻进度
        Route::get('apply/result.html', 'ShopController@result'); // 店铺入驻结果
        Route::get('apply/agreement-type1.html', 'ShopController@agreementType1');
        Route::any('apply/auth-info.html', 'ShopController@authInfo');
        Route::any('apply/shop-info.html', 'ShopController@shopInfo');
        Route::get('apply/client-validate', 'ShopController@clientValidate'); // clientValidate



        // 店铺街/店铺首页/店铺商品信息路由
        Route::get('street/index.html', 'ShopController@street')->name('pc_shop_street'); // 店铺街
        Route::get('{shop_id}.html', 'ShopController@shopHome')->name('pc_shop_home'); // 店铺首页
        Route::get('{shop_id}/info.html', 'ShopController@shopDetail')->name('pc_shop_info'); // 店铺详情
        Route::get('{shop_id}/search.html', 'ShopController@shopSearch')->name('pc_shop_search'); // 店铺内搜索

        Route::get('index/license.html', 'ShopController@license')->name('pc_shop_license'); // 店铺营业执照查询
        Route::get('index/info.html', 'ShopController@shopDetail'); // 店铺信息 异步加载


    });

    /*新的路由写法 只需要对每个控制器写一条路径即可*/
    // 店铺
    Route::any('/shop/apply/{action}.html', function ($action, Request $request) {
        $class = App::make(Controllers\ShopController::class);
        return $class->$action($request);
    });



    // Passport Route
    $router->get('login.html', 'PassportController@showLoginForm')->name('user.login'); // showLoginForm
    $router->post('login', 'PassportController@login'); // login
    $router->any('register.html', 'PassportController@showRegisterForm'); // showRegisterForm
    $router->any('register/mobile.html', 'PassportController@showRegisterForm'); // showRegisterForm

    $router->any('register/email.html', 'PassportController@showRegisterForm'); // showRegisterForm
    $router->get('register/client-validate', 'PassportController@clientValidate'); // clientValidate
    $router->post('register/sms-captcha', 'PassportController@smsCaptcha'); // 发送短信验证码
    $router->post('register/email-captcha', 'PassportController@emailCaptcha'); // 发送邮箱验证码

    $router->post('site/logout.html', 'PassportController@logout')->name('user.logout'); // logout


    // 专题活动 Route
    $router->get('/topic/{topic_id}.html', 'TopicController@show')->name('pc_show_topic');

    // 资讯 Route
    Route::get('/news.html', 'NewsController@home')->name('pc_news_home'); // index
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@home')->name('pc_news_home'); // index
        Route::get('list/{cat_id}.html', 'NewsController@lists')->name('pc_news_list'); // lists
        Route::get('{article_id}.html', 'NewsController@show')->name('pc_show_news'); // show

    });

    // 购买下单
    Route::get('/checkout.html', 'BuyController@checkout'); // 购物车/直接购买 确认交易
    Route::group(['prefix' => 'checkout'], function () {
        Route::get('user-address', 'BuyController@userAddress'); // 用户收货地址
        Route::post('change-address', 'BuyController@changeAddress'); // 修改收货地址
        Route::post('change-payment', 'BuyController@changePayment'); // 修改支付订单信息
        Route::post('search-pickup.html', 'BuyController@searchPickup'); // 搜索自提点
        Route::post('submit.html', 'BuyController@submit'); // 提交订单
        Route::post('resubmit.html', 'BuyController@resubmit'); // 重新提交订单
        Route::get('result.html', 'BuyController@result'); // 付款结果查询
        Route::get('pay.html', 'BuyController@pay'); // 付款页面
        Route::post('set-payment.html', 'BuyController@setPayment'); // 付款页面 设置支付方式

    });

    // 订单支付
    Route::get('/payment.html', 'PaymentController@payment')->name('pc_payment'); // 订单支付 支付宝/微信
    Route::group(['prefix' => 'payment'], function () {
        Route::get('check-is-pay', 'PaymentController@checkIsPay'); // ajax检查订单是否支付

    });

//    dd($router->routePrefix);
    // 商品
    Route::get('/goods-{goods_id}.html', 'GoodsController@showGoods')->name('pc_show_goods'); // showGoods
    Route::get('/list-{filter_str?}.html', 'GoodsController@lists')->name('pc_goods_list'); // goodsList
    Route::get('/list.html', 'GoodsController@lists'); // goodsList
//    Route::get('/list-{cat_id}-{p1?}-{p2?}-{is_platform?}-{is_free_shipping?}-{is_offpay?}-{has_goods_number?}-{sort_type?}-{p9?}-{area_code?}-{p11?}-{brand_id?}-{min_price?}-{max_price?}.html', 'GoodsController@goodsList')->name('goods_list'); // 商品列表 筛选条件
    Route::get('/{sku_id}.html', 'GoodsController@showGoods')->name('pc_show_sku_goods'); // showSkuGoods

    Route::group(['prefix' => 'goods'], function () {
        Route::get('sku.html', 'GoodsController@sku'); // sku
        Route::get('sku', 'GoodsController@sku'); // sku

        Route::get('desc.html', 'GoodsController@desc'); // goods_desc
        Route::get('qrcode.html', 'GoodsController@qrcode'); // qrcode
        Route::get('comment.html', 'GoodsController@comment'); // comment
        Route::get('change-location.html', 'GoodsController@changeLocation'); // changeLocation
        Route::get('pickup-info.html', 'GoodsController@pickupInfo'); // 自提点详情
        Route::post('search-pickup.html', 'GoodsController@searchPickup'); // 搜索自提点

    });

    // 商品对比
    Route::get('/user/compare.html', 'CompareController@compare')->name('pc_compare'); // 对比商品页面
    Route::group(['prefix' => 'compare'], function () {
//        Route::post('add', 'CompareController@add'); // add
        Route::post('add', 'CompareController@toggle'); // 加入对比
        Route::post('remove', 'CompareController@remove'); // 加入对比
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




    // 测试路由
    Route::get('send', 'HomeController@send');
    Route::get('collect-goods', 'HomeController@collectGoods'); // 测试 商品采集

});
