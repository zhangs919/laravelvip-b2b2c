
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta name="is_frontend" content="yes" />
    <meta name="is_web_mobile" content="yes" />
    {!! $lrw_tag ?? '' !!}
    <meta name="is_webp" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="m_main_color" content="" /><!-- ================== END BASE CSS STYLE ================== -->
    <!-- 购物车js -->
    <!--整站改色 _start-->
    <link href="/assets/d2eace91/css/swiper/swiper.min.css" rel="stylesheet" position="1">
    <link href="/css/iconfont/iconfont.css" rel="stylesheet">
    <link href="/css/app.frontend.mobile.min.css" rel="stylesheet">
    <link href="/css/shop_header.css" rel="stylesheet">
    <link href="/css/shop_coupon.css" rel="stylesheet">
    <link href="/css/bonus_message.css" rel="stylesheet">
    <link href="/css/dianpu.css" rel="stylesheet">
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif
    <link href="/css/dianpu_goods_two.css" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>

    {{--国家默哀日期--}}
    {!! $national_memorial_day_html ?? '' !!}
</head>
<body>
<!-- 引入头部文件 -->
<!-- -->
<!-- -->
<!-- -->
<!-- 内容 -->
<!-- 缓载图片 -->
<header class="shop-list-top">
    <div id="search-container" class="header-search-con">
        <div class="header-search-left">
            <a class="sb-back iconfont icon-fanhui1" href="javascript:history.back(-1)" title="返回"></a>
        </div>
        <div class="header-search-middle">
            <form name="searchForm" id="searchForm" method="get" action="">
                <div class="search-box">
                    <input type="search" name="keyword" class="text" value="" placeholder="搜索本店内的商品">
                    <input type="submit" class="submit" value="">
                </div>
            </form>
        </div>
        <div class="header-search-right">
            <!-- 控制展示更多按钮 -->
            <aside class="show-menu-btn">
                <div id="show_more" class="show-menu iconfont icon-gengduo3"></div>
            </aside>
        </div>
    </div>
</header>
<div class="container">
    <div class="new-goods-con">
        <div class="new-goods-con-left">
            <ul>
                @if(!empty($category))
                    @foreach($category as $v)
                        <li class="SZY-SHOP-GOODS-CAT item @if($cat_id == $v['cat_id']){{ 'current' }}@endif" data-cat_id="{{ $v['cat_id'] }}">
                            <span>{{ $v['cat_name'] }}</span>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="blank-div-left"></div>
        </div>
        <div id="ajax_cat_box" class="cat-box">
            <div class="right-category-box">
                <div class="swiper-container" id="swiper-container1">
                    <ul class="swiper-wrapper">
                        @foreach($chr_list as $item)
                            <li class="swiper-slide SZY-SHOP-GOODS-CHR @if($cat_id == $item['cat_id']){{ 'current' }}@endif" data-cat_id="{{ $item['cat_id'] }}">
                                {{ $item['cat_name'] }}</li>
                        @endforeach
                        <li class="swiper-slide"></li>
                    </ul>
                    <div class="down-more-btn">
                        <i class="iconfont">&#xe609;</i>
                    </div>
                </div>
                <ul class="second-goods-classify hide">
                    @foreach($chr_list as $item)
                        <li class="SZY-SHOP-GOODS-CHR @if($cat_id == $item['cat_id']){{ 'current' }}@endif" data-cat_id="{{ $item['cat_id'] }}">
                            {{ $item['cat_name'] }}</li>
                    @endforeach
                </ul>
                <div class="right-con-top">
                    <!-- 筛选 -->
                    <div class="filter-term">
                        <div class="record-info">
                            <em>全部</em>
                            ({{ $total }})
                        </div>
                        <ul>
                            <li class="SORT current" id="0-0-0-0-0-3-0-0">
                                <span>综合</span>
                            </li>
                            <!-- 点击销量排序由高到低 -->
                            <li class="SORT " id="0-0-0-0-1-3-0-0">
                                <span>销量</span>
                            </li>
                            <!-- 价格升降li增加样式：icon-DESC  icon-ASC -->
                            <li class="icon-sort-price icon SORT " id="0-0-0-0-4-3-0-0">
                                <span>
                                    价格
                                    <i></i>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="new-goods-con-right">
            <div class="right-con">

                {{--引入店铺商品列表--}}
                @include('shop.partials._shop_goods_1')
            </div>
        </div>
    </div>
</div>
<!--底部开始-->
<div class="mask-div"></div>
<footer class="fixed-bottom">
    <!-- 购物车盒子 -->
    <div class="cartbox">
        @if($cart_price_info['goods_number'] == 0)
            <div class="shop-cart-icon footer-cart-icon empty-footer-cart ">
                <a href="javascript:void(0)" class="">
                    <em class="SZY-CART-COUNT color">0</em>
                    <i class="iconfont">&#xe60e;</i>
                </a>
            </div>
        @else
            <div class="shop-cart-icon footer-cart-icon cart-icon ">
                <a href="javascript:void(0)" class="bg-color">
                    <em class="SZY-CART-COUNT color">{{ $cart_price_info['goods_number'] }}</em>
                    <i class="iconfont"></i>
                </a>
            </div>
        @endif
        <!--购物车弹出盒子-->
        <div class="cartbox-layer hide">
            <div class="cartbox-con">
                <div class="shop-cart-icon cartbox bg-color shop-cart-layer">
                    <a href="javascript:void(0)">
                        <em class="SZY-CART-COUNT color">{{ $cart_price_info['goods_number'] }}</em>
                        <i class="iconfont">&#xe60e;</i>
                    </a>
                </div>
                <div class="cartbox-hd">
                    <div class="box-left">
                    <span class="cart-checkbox toggle-checkbox goods-checkbox-all checked">
                        <i></i>
                        全选
                    </span>
                        <p class="SZY-SELECT-GOODS-NUMBER">(已选{{ $cart_price_info['goods_number'] }}件)</p>
                    </div>
                    <span class="box-right SZY-DEL-ALL">
                    <i class="iconfont">&#xe61b;</i>
                    清空全部
                </span>
                </div>
                <div class="cartbox-bd cartbox-goods-list">
                    <!-- 没有商品的展示形式 _start -->
                    <div class="no-data-div m-b-50">
                        <div class="no-data-img">
                            <img src="/images/bg_empty_data.png" />
                        </div>
                        <dl>
                            <dt>购物车还是空空的呢</dt>
                        </dl>
                        <a href="/" class="no-data-btn">逛一逛</a>
                    </div>
                    <!-- 没有商品的展示形式 _end-->
                </div>
            </div>
        </div>
        @if($cart_price_info['goods_number'] == 0)
            <div class="goods-total-price  empty-cart-num SZY-GOODS-AMOUNT">购物车为空</div>
        @else
            <div class="goods-total-price price-color SZY-GOODS-AMOUNT">￥{{ $cart_price_info['select_goods_amount'] }}</div>
        @endif
    </div>
    <script type="text/javascript">
        //
    </script>
    <div class="check-btn SZY-PAY">去结算</div>
</footer>
<script type="text/javascript">
    (function(){
        var url = location.href;
        if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {
            if (url.indexOf("?") == -1) {
                url += "?user_id=";
            } else {
                url += "&user_id=";
            }
        } else {
            url = location.href.split('#')[0];
        }
        var share_url = "";
        if (share_url == '') {
            share_url = url;
        }
        if (window.__wxjs_environment !== 'miniprogram') {
            window.history.replaceState(null, document.title, url);
        }
    })();
</script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script type="text/javascript">
    $().ready(function() {
        // $("body").append('<script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"><\/script>');
        var url = location.href;
        if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {
            if (url.indexOf("?") == -1) {
                url += "?user_id=";
            } else {
                url += "&user_id=";
            }
        } else {
            url = location.href.split('#')[0];
        }
        var share_url = "";
        if (share_url == '') {
            share_url = url;
        }
        //
        if (isWeiXin()) {
            $.ajax({
                url: "/site/get-weixinconfig.html",
                type: "POST",
                dataType: "json",
                data: {
                    url: url
                },
                success: function(result) {
                    if (result.code == 0) {
                        wx.config({
                            debug: false,
                            appId: result.data.appId,
                            timestamp: result.data.timestamp,
                            nonceStr: result.data.nonceStr,
                            signature: result.data.signature,
							jsApiList: result.data.jsApiList,
                            // jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'wx-open-launch-weapp'],
                            // openTagList: ['wx-open-launch-weapp']
                        });
                    }
                }
            });
        }
        //
        // 微信JSSDK开发
        wx && wx.ready(function() {
            // 分享给朋友
            wx.onMenuShareAppMessage({
                title: '{{ $seo_title }}', // 标题
                desc: '{{ $seo_description }}', // 描述
                imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                link: share_url,
                fail: function(res) {
                    alert(JSON.stringify(res));
                }
            });
            // 分享到朋友圈
            wx.onMenuShareTimeline({
                title: '{{ $seo_title }}', // 标题
                desc: '{{ $seo_description }}', // 描述
                imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                link: share_url,
                fail: function(res) {
                    alert(JSON.stringify(res));
                }
            });
            // window.history.replaceState(null, document.title, url);
        });
    });
</script>
<script type="text/javascript">
    $().ready(function() {
        setTimeout(function() {
            if (window.__wxjs_environment === 'miniprogram') {
                var share_info = {
                    title: '{{ $seo_title }}',
                    imgUrl: '{{ get_image_url($seo_image) }}'
                };
                wx.miniProgram.postMessage({
                    data: share_info
                });
            }
        }, 3000);
    });
</script>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<!-- 引底部文件 -->
<!-- -->
<!-- 隐藏菜单_start -->
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')
<!-- 隐藏菜单_end -->
<!-- 引底部文件 -->
<!-- -->
<script type="text/javascript">
    //
</script>
<!-- 积分提醒 -->
<!-- 消息提醒 -->
<script type="text/javascript">
    //
</script>    <!-- 第三方流量统计 -->
<div style="display: none;"></div>
<!-- 底部 _end-->
<script src="/assets/d2eace91/min/js/core.min.js"></script>
<script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
<script src="/js/app.frontend.mobile.min.js"></script>
<script src="/js/shop.js"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
<script src="/js/common.js"></script>
<script src="/assets/d2eace91/min/js/message.min.js"></script>
<script>

    $('#yikf-kefu').click(function(){
        $('#yikf-form').submit();
    })
    //
    //
    $(document).ready(function() {
        //添加
        var start_price = '{{ $shop_info['shop']['start_price'] }}';
        var eventclick; //防止重复点击
        $('body').on('click', '.cartbox-increase', function() {
            $('.SZY-PAY').addClass('wait-loading');
            var target = $(this);
            var sku_id = target.prev().data('sku_id');
            var goods_id = target.prev().data('goods_id');
            var cart_id = target.prev().data('cart_id');
            var goods_max_number = parseInt(target.prev().data('goods_max_number'));
            var step = target.prev().data('step');
            if (isNaN(step)) {
                step = 1;
            }
            if (parseInt(target.prev().val()) + parseInt(step) > goods_max_number) {
                $.msg("最多只能购买" + goods_max_number + "件");
                return false;
            }
            var number = parseInt(target.prev().val()) + parseInt(step);
            if (number > goods_max_number) {
                target.prev().val(goods_max_number);
            } else {
                target.prev().val(number);
            }
            $.cart.changeNumber(sku_id, number, cart_id, function(result) {
                if (result.code == 0) {
                    $('.SZY-NUMBER-' + goods_id).val(number);
                    <!--//解决线上bug先隐藏-->
                    //if(result.params.goods_price_format){
                    //    $(target).parents(".goods-info").find(".goods-price").find("em").html(result.params.goods_price_format);
                    //}
                    cartboxLoad({
                        count: result.params.count,
                        select_goods_number: result.params.select_goods_number,
                        select_goods_amount_format: result.params.select_goods_amount_format,
                        start_price: result.params.start_price,
                        start_price_format: result.params.start_price_format,
                        dif_price: result.params.dif_price,
                        dif_price_format: result.params.dif_price_format,
                        goods_price: result.params.goods_price,
                        goods_price_format: result.params.goods_price_format,
                    });
                } else {
                    if (result.data.max) {
                        target.prev().val(result.data.max);
                    }
                    $('.SZY-PAY').removeClass('wait-loading');
                }
            });
        });
        //减少
        $('body').on('click', '.cartbox-decrease', function() {
            $('.SZY-PAY').addClass('wait-loading');
            var target = $(this);
            var sku_id = target.next().data('sku_id');
            var cart_id = target.next().data('cart_id');
            var goods_id = target.next().data('goods_id');
            var step = target.next().data('step');
            if (isNaN(step)) {
                step = 1;
            }
            var number = parseInt(target.next().val()) - parseInt(step);
            if (number == 0) {
                target.next().val(step);
            } else {
                target.next().val(number);
            }
            if (eventclick != undefined) {
                clearTimeout(eventclick);
            }
            if (number < 1) {
                $.confirm("您确定从购物车中移除此商品吗？", function() {
                    $.loading.start();
                    $.cart.del({
                        cart_ids: cart_id
                    }, function() {
                        $.cartbox.load(function(res) {
                            if (res.count > 0) {
                                $.cartbox.open();
                            } else {
                                $.cartbox.close();
                                $("body").removeClass("visibly");
                            }
                        });
                        $('.SZY-NUMBER-' + goods_id).hide();
                        $('.SZY-NUMBER-' + goods_id).val(0);
                        $('.SZY-NUMBER-' + goods_id).next().hide();
                    }).always(function(){
                        $.loading.stop();
                    });
                }, function() {
                    $.loading.start();
                    $.cart.changeNumber(sku_id, 1, cart_id, function(result) {
                        if (result.code == 0) {
                            $('.SZY-NUMBER-' + goods_id).val(number);
                            <!--//解决线上bug先隐藏-->
                            //if(result.params.goods_price_format){
                            //    $(target).parents(".goods-info").find(".goods-price").find("em").html(result.params.goods_price_format);
                            //}
                            cartboxLoad({
                                count: result.params.count,
                                select_goods_number: result.params.select_goods_number,
                                select_goods_amount_format: result.params.select_goods_amount_format,
                                start_price: result.params.start_price,
                                start_price_format: result.params.start_price_format,
                                dif_price: result.params.dif_price,
                                dif_price_format: result.params.dif_price_format,
                                goods_price: result.params.goods_price,
                                goods_price_format: result.params.goods_price_format,
                            });
                        }else{
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }).always(function(){
                        $.loading.stop();
                    });
                });
            } else {
                eventclick = setTimeout(function() {
                    $.loading.start();
                    $.cart.changeNumber(sku_id, number, null, function(result) {
                        if (result.code == 0) {
                            $('.SZY-NUMBER-' + goods_id).val(number);
                            <!--//解决线上bug先隐藏-->
                            //if(result.params.goods_price_format){
                            //    $(target).parents(".goods-info").find(".goods-price").find("em").html(result.params.goods_price_format);
                            //}
                            cartboxLoad({
                                count: result.params.count,
                                select_goods_number: result.params.select_goods_number,
                                select_goods_amount_format: result.params.select_goods_amount_format,
                                start_price: result.params.start_price,
                                start_price_format: result.params.start_price_format,
                                dif_price: result.params.dif_price,
                                dif_price_format: result.params.dif_price_format,
                                goods_price: result.params.goods_price,
                                goods_price_format: result.params.goods_price_format,
                            });
                        }else{
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }).always(function(){
                        $.loading.stop();
                    });
                }, 500);
            }
            $('.SZY-PAY').removeClass('wait-loading');
        });
        //清空
        $('body').on('click', '.SZY-DEL-ALL', function() {
            $.confirm("您确定清空店铺购物车吗？", function() {
                var cart_ids = [];
                var goods_ids = [];
                $.each($('.SZY-GOODS-NUMBER'), function() {
                    cart_ids.push($(this).data('cart_id'));
                    goods_ids.push($(this).data('goods_id'));
                });
                $.cart.remove({
                    cart_ids: cart_ids
                }, function() {
                    $.each(goods_ids, function(i, goods_id) {
                        $('.SZY-NUMBER-' + goods_id).hide();
                        $('.SZY-NUMBER-' + goods_id).val(0);
                        $('.SZY-NUMBER-' + goods_id).next().hide();
                        $.cartbox.load(function(result) {
                            if (result.count > 0) {
                                $.cartbox.open();
                            } else {
                                $.cartbox.close();
                                $("body").removeClass("visibly");
                            }
                            if (result.select_goods_number == 0) {
                                $('.SZY-PAY').addClass('disabled');
                            }
                        });
                    });
                });
            });
        });
        $(".cartbox").on('click', '.cart-icon', function() {
            $("body").addClass("visibly");
        });
        //点击购物车关闭
        $(".cartbox").on('click', '.shop-cart-layer', function() {
            $.cartbox.close();
            $("body").removeClass("visibly");
        });
        //点击遮罩关闭
        $('body').on('click', '.mask-div', function() {
            $.cartbox.close();
            $("body").removeClass("visibly");
        });
        //选择
        $('body').on('click', '.goods-checkbox', function() {
            $('.SZY-PAY').addClass('wait-loading');
            var cart_ids = [];
            if ($(this).hasClass('checked')) {
                $(this).removeClass('checked');
            } else {
                $(this).addClass('checked')
            }
            $.each($('.goods-checkbox'), function(i, v) {
                if ($(v).hasClass('checked')) {
                    cart_ids.push($(v).data('cart_id'));
                }
            });
            if (cart_ids.length > 0 && cart_ids.length == $('.goods-checkbox').length) {
                $('.goods-checkbox-all').addClass('checked');
            } else {
                $('.goods-checkbox-all').removeClass('checked');
            }
            $.cart.select(cart_ids, {
                shop_id: shop_id
            }, function(result) {
                cartboxLoad({
                    count: result.params.count,
                    select_goods_number: result.params.select_goods_number,
                    select_goods_amount_format: result.params.select_goods_amount_format,
                    start_price: result.params.start_price,
                    start_price_format: result.params.start_price_format,
                    dif_price: result.params.dif_price,
                    dif_price_format: result.params.dif_price_format
                });
            });
        });
        //全选
        $('body').on('click', '.goods-checkbox-all', function() {
            $('.SZY-PAY').addClass('wait-loading');
            var cart_ids = [];
            if ($(this).hasClass('checked')) {
                $(this).removeClass('checked');
                $('.goods-checkbox').removeClass('checked');
            } else {
                $(this).addClass('checked');
                $('.goods-checkbox').addClass('checked');
            }
            $.each($('.goods-checkbox'), function(i, v) {
                if ($(v).hasClass('checked')) {
                    cart_ids.push($(v).data('cart_id'));
                }
            });
            $.cart.select(cart_ids, {
                shop_id: shop_id
            }, function(result) {
                cartboxLoad({
                    count: result.params.count,
                    select_goods_number: result.params.select_goods_number,
                    select_goods_amount_format: result.params.select_goods_amount_format,
                    start_price: result.params.start_price,
                    start_price_format: result.params.start_price_format,
                    dif_price: result.params.dif_price,
                    dif_price_format: result.params.dif_price_format
                });
            });
        });
        // 初始化盒子
        $.cartbox.load(function(result) {
            cartboxLoad({
                select_goods_number: result.select_goods_number,
                select_goods_amount_format: result.select_goods_amount_format,
                start_price: result.start_price,
                start_price_format: result.start_price_format,
                dif_price: result.dif_price,
                dif_price_format: result.dif_price_format
            });
        });
        function cartboxLoad(data) {
            var count = data.count;
            var select_goods_number = data.select_goods_number;
            var select_goods_amount_format = data.select_goods_amount_format;
            var start_price = data.start_price;
            var start_price_format = data.start_price_format;
            var dif_price = data.dif_price;
            var dif_price_format = data.dif_price_format;
            $('.SZY-CART-COUNT').html(count);
            $('.SZY-SELECT-GOODS-NUMBER').html('(已选' + select_goods_number + '件)');
            $('.SZY-GOODS-AMOUNT').html(select_goods_amount_format);
            if (start_price > 0) {
                if (select_goods_number == 0) {
                    $('.SZY-PAY').html(start_price_format + '起送');
                    $('.SZY-PAY').addClass('disabled');
                } else if (dif_price > 0) {
                    $('.SZY-PAY').html('还差' + dif_price_format + '起送');
                    $('.SZY-PAY').addClass('disabled');
                } else {
                    $('.SZY-PAY').html('去结算');
                    $('.SZY-PAY').removeClass('disabled');
                }
            } else {
                if (select_goods_number == 0) {
                    $('.SZY-PAY').html('去结算');
                    $('.SZY-PAY').addClass('disabled');
                } else {
                    $('.SZY-PAY').html('去结算');
                    $('.SZY-PAY').removeClass('disabled');
                }
            }
            $('.SZY-PAY').removeClass('wait-loading');
        }
    });
    //
    $('body').on('click', '.down-more-btn', function() {
        if ($('.second-goods-classify').hasClass('hide')) {
            $('.down-more-btn').addClass('show')
            $('.second-goods-classify').removeClass('hide')
        } else {
            $('.down-more-btn').removeClass('show')
            $('.second-goods-classify').addClass('hide')
        }
    })
    $('.container').on("tap", function() {
        $('.second-goods-classify').addClass('hide');
    });
    var session_storage_key = location.href.split('?')[0] + '_listData';
    var tablelist = null;
    var notStandardScroll = null;
    var mySwiper;
    var shop_id = '{{ $shop_info['shop']['shop_id'] }}';
    var cat_id = 0;
    $().ready(function() {
        tablelist = $("#table_list").tablelist();
        $(".submit").click(function() {
            var params = $("#searchForm").serializeJson();
            params.page = {
                cur_page: 1,
            };
            params.go = 1;
            tablelist.load(params,  $.imgloading.loading);
            return false;
        });
        //初始化消息
        setFilterInfoText();
        init('');
        // if(sessionStorage.getItem(session_storage_key)){
        //     $(".container").html(sessionStorage.getItem(session_storage_key));
        // }
        $.imgloading.loading();
        var title = $(document).attr("title");
        $('body').on('click', '.SZY-SHOP-GOODS-CAT', function() {
            $('.SORT').removeClass('current');
            $('.SORT:first').addClass('current');
            changePriceSort(this);
            $(this).addClass('current').siblings().removeClass('current');
            var cat_id = $(this).data('cat_id');
            tablelist.url = $.baseurl('/shop/' + shop_id + '/list.html?keyword=');
            tablelist.page.cur_page = 1;
            tablelist.load({
                go: 1,
                cat_id: cat_id,
                cat_ajax: 1,
                showloading: false
            }, function(result) {
                var html = result.data;
                init(html);
                $('html,body').scrollTop(0);
                $.imgloading.loading();
                setFilterInfoText();
                History.replaceState(null, title, $.baseurl('/shop-list-' + shop_id + '-' + cat_id + '.html?keyword='));
                saveLastPage();
            });
        });
        $('body').on('click', '.SZY-CAT-UL-2 li', function() {
            var cat_id = $(this).data('cat_id');
            if ($(this).hasClass('current')) {
                return;
            }
            $(this).addClass('current').siblings().removeClass('current');
            $('.SZY-CAT-UL-HIDE-2 li').removeClass('current');
            $('.SZY-CAT-UL-HIDE-2').find('.SZY-CAT-LI-2-' + cat_id).addClass('current');
            var sort = $('.filter-term ul .current').attr('id');
            tablelist.url = $.baseurl('/shop-list-' + shop_id + '-' + cat_id + '-' + sort + '.html');
            tablelist.page.cur_page = 1;
            tablelist.load({
                go: 1,
                cat_id: cat_id,
                showloading: false
            }, function(result) {
                var html = result.data;
                init(html);
                $('html,body').scrollTop(0);
                setFilterInfoText();
                $.imgloading.loading();
                url=bulidUrl(1);
                History.replaceState(null, title, url);
                saveLastPage();
            });
        });
        $('body').on('click', '.SZY-CAT-UL-HIDE-2 li', function() {
            var cat_id = $(this).data('cat_id');
            if ($(this).hasClass('current')) {
                return;
            }
            $(this).addClass('current').siblings().removeClass('current');
            $('.SZY-CAT-UL-2').find('.SZY-CAT-LI-2-' + cat_id).click();
        });
        $('body').on('click', '.share-goods', function() {
            var goods_id = $(this).data("goods_id");
            // 商品分享
            $(this).goodsshare({
                // 商品ID
                goods_id: goods_id,
            });
        });
    })
    //初始化
    function init(html) {
        $('#ajax_cat_box').html('');
        if (html.length > 0) {
            var list_height = $(html).find('input[class=list-height]').val();
            var cat_index = $(html).find('input[class=cat_index]').val();
        } else {
            var list_height = $('.list-height').val();
            var cat_index = $('.cat_index').val();
        }
        var cat_box = $('.hidden_cat');
        if (cat_box.length > 0) {
            $('#ajax_cat_box').html(cat_box.html());
            $('.new-goods-con-right').css('margin-top', list_height + 'rem')
            cat_box.remove();
        }
        //点击二级分类绑定
        $('.SZY-CAT-UL-HIDE-2 li').bind('click', function() {
            var cat_id = $(this).data('cat_id');
            if ($(this).hasClass('current')) {
                return;
            }
            $(this).addClass('current').siblings().removeClass('current');
            $('.SZY-CAT-UL-2').find('.SZY-CAT-LI-2-' + cat_id).click();
        });
        $('.SZY-CAT-UL-HIDE-2 li').unbind('click', tab);
        $('.SZY-CAT-UL-HIDE-2 li').bind('click', tab);
        //删除
        $('.SORT').off('click', SORT);
        $('.SORT').bind('click', SORT);
        // 滑动菜单
        mySwiper = new Swiper('#swiper-container1', {
            direction: 'horizontal', // 水平切换选项
            initialSlide: cat_index,
            // loop : true,
            slidesPerView: "auto",
            // centeredSlides : true,
            // slidesOffsetBefore : -200,
            slideToClickedSlide: true,
            //freeMode:true,
            onInit: function(swiper) {
                //Swiper初始化了
                // alert(swiper.activeIndex);//提示Swiper的当前索引
                swiper.activeIndex = cat_index;
                swiper.update();
            }
        });
    }
    function tab() {
        var cat_id = $(this).data('cat_id');
        if ($(this).hasClass('current')) {
            return;
        }
        $(this).addClass('current').siblings().removeClass('current');
        $('.SZY-CAT-UL-2').find('.SZY-CAT-LI-2-' + cat_id).click();
    }
    function SORT() {
        tablelist = $("#table_list").tablelist();
        var title = $(document).attr("title");
        if ($(this).hasClass('current') && !$(this).hasClass('icon-sort-price')) {
            return;
        }
        $('.SORT').removeClass('current');
        $(this).addClass('current');
        cat_id = $('.second-goods-classify .current').data('cat_id') ? $('.second-goods-classify .current').data('cat_id') : $('.new-goods-con-left ul .current').data('cat_id');
        // changePriceSort(this);
        var sort = $(this).attr('id');
        tablelist.url = $.baseurl('/shop-list-' + shop_id + '-' + cat_id + '-' + sort + '.html');
        tablelist.page.cur_page = 1;
        tablelist.load({
            go: 1,
            cat_id: cat_id,
            showloading: false
        }, function(result) {
            var html = result.data;
            init(html);
            $('.new-goods-con-right').scrollTop(0);
            setFilterInfoText();
            $.imgloading.loading();
            url=bulidUrl(1);
            History.replaceState(null, title,url);
            saveLastPage();
        });
    }
    //子分类切换
    function chr_cat() {
        var this_target = $(this);
        var sku_open = this_target.data('sku_open');
        if (sku_open) {
            $.msg('此商品有多个规格，请到购物车中移除');
            return;
        }
        $('.decrease').off('click');//防止连续点击
        var data = {};
        data.goods_id = this_target.data("goods_id");
        data.number = 1;
        $.cart.remove(data, function(result) {
            if (result.code == 0) {
                $numbtn = this_target.parent().find(".num");
                if (result.goods_number < 1) {
                    $numbtn.val(0);
                    $numbtn.css('display', 'none');
                    this_target.css('display', 'none');
                } else {
                    $numbtn.val(result.goods_number);
                }
            }
            $('.decrease').bind('click', decrease);
        });
    }
    function setFilterInfoText() {
        var sortText = $('.filter-term ul .current').text();
        var catId = $('.second-goods-classify .current').attr('id');
        var catText = '全部';
        if ($('.second-goods-classify .current').text() && $('.second-goods-classify .current').text() != '全部') {
            catText = $('.second-goods-classify .current').text();
        }
        if ($('.second-goods-classify .current').text() == '全部') {
            catText = $('.new-goods-con-left ul .current').text();
        }
        var text = sortText + '-' + catText;
        $('.filter-info').text(text);
    }
    // 滚动切换
    // tablelist = $("#table_list").tablelist();
    // 滚动切换
    $(window).scroll(function() {
        if (($(document).scrollTop() + $(window).height() + 500) > $(document).height()) {
            if ($.isFunction($.pagemore)) {
                $.pagemore({
                    callback: function(result) {
                        $.imgloading.loading();
                    }
                });
            }
        }
    });
    //
    //    var scrollheight = 0;
    //    $('.new-goods-con-left').on('touchmove',function(e) {
    //        $("body").css("top", "-" + scrollheight + "px");
    //        $('body').addClass('visibly');
    //    });
    //    $('.new-goods-con-right').on('touchmove',function(e) {
    //        $("body").css("top", "-" + scrollheight + "px");
    //        $('body').removeClass('visibly');
    //    });
    //    $('.new-goods-con-right').on('touchend',function(e) {
    //        scrollheight = $(document).scrollTop();
    //        $("body").css("top", "-" + scrollheight + "px");
    //        $('body').removeClass('visibly');
    //    });
    //修改价格状态
    function changePriceSort(obj) {
        if ($(obj).hasClass('icon')) {
            $(obj).removeClass('icon');
            $(obj).addClass('icon-DESC');
            $(obj).attr('id', '0-0-0-0-4-3-0-0');
            return;
        }
        if ($(obj).hasClass('icon-DESC')) {
            $(obj).removeClass('icon-DESC');
            $(obj).addClass('icon-ASC');
            $(obj).attr('id', '0-0-0-0-4-4-0-0');
            return;
        }
        if ($(obj).hasClass('icon-ASC')) {
            $(obj).removeClass('icon-ASC');
            $(obj).addClass('icon-DESC');
            $(obj).attr('id', '0-0-0-0-4-3-0-0');
            return;
        }
        $('.icon-sort-price').removeClass('icon-DESC');
        $('.icon-sort-price').removeClass('icon-ASC');
        $('.icon-sort-price').addClass('icon');
        return;
    }
    $('.header-search').click(function() {
        $('#search_content').addClass("show");
        $('#catalog_content').hide();
        $("input[name='keyword']").focus();
    });
    $('.sb-back').click(function() {
        $('#search_content').removeClass('show');
        $('#catalog_content').show();
        $("input[name='keyword']").blur();
    });
    $('.colse-search-btn').click(function() {
        $('#search_content').removeClass('show');
        $('#catalog_content').show();
        $("input[name='keyword']").blur();
    });
    //
    $(document).ready(function() {
        //加入购物车
        var fly_options = null;
        $('body').on('click', '.cart-box .add-cart', function(event) {
            var this_target = $(this);
            var image_url = $(this).data('image_url');
            var goods_id = $(this).data('goods_id');
            var shop_id = '{{ $shop_info['shop']['shop_id'] }}';
            var buy_enable = $(this).data("buy_enable");
            var max_number = $(this).data("max_number");
            if (buy_enable) {
                $.msg(buy_enable);
                return;
            }
            var step = $(this).data("step");
            if (isNaN(step)) {
                step = 1;
            }
            $.cart.add(goods_id, step, {
                shop_id: shop_id,
                image_url: image_url,
                event: event,
                is_sku: false,
                callback: function(result) {
                    if (result.code == 0) {
                        var numbtn = this_target.parents('.cart-box').find(".num");
                        if (parseInt(numbtn.val()) == 0) {
                            numbtn.show();
                            numbtn.removeClass('hide');
                            //减号的按钮动画显示
                            this_target.parents('.cart-box').find(".remove-cart").show();
                            this_target.parents('.cart-box').find(".remove-cart").removeClass('hide');
                        }
                        // 点击加入购物车相应的购买数量
                        numbtn.val(parseInt(numbtn.val()) + step);
                        if (numbtn.val() >= max_number) {
                            $(this_target).addClass('disabled');
                        }
                        //$('.SZY-PAY').removeClass('disabled');
                    }
                }
            });
            return false;
        });
        //减少购物车
        $('body').on('click', '.cart-box .remove-cart', function() {
            var this_target = $(this);
            var step = $(this).data("step");
            if (isNaN(step)) {
                step = 1;
            }
            var data = {};
            data.goods_id = this_target.data("goods_id");
            data.number = step;
            var sku_open = $(this).data("sku_open");
            if (sku_open) {
                $.msg('此商品有多个规格，请到购物车中移除');
                return false;
            }
            var numbtn = this_target.parents('.cart-box').find(".num");
            var number = parseInt(numbtn.val()) - step;
            numbtn.val(number);
            if (number <= 0) {
                numbtn.val(0);
                numbtn.addClass('hide');
                numbtn.hide();
                this_target.addClass('hide');
                this_target.hide();
            }
            $.cart.remove(data, function(result) {
                if (result.code == 0) {
                    this_target.parent().find(".increase").removeClass('disabled');
                    $.cartbox.load();
                }
            });
            return false;
        });
        $('.SZY-PAY').click(function() {
            if ($(this).hasClass('disabled') || $(this).hasClass('wait-loading')) {
                return;
            }
            $.loading.start();
            $.get("/cart/go-checkout", {
                shop_id: shop_id
            }, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    // 正常提交
                    $.go(result.data);
                } else if (result.code == 102) {
                    // 购物车中商品库存不足
                    $.msg(result.message, {
                        time: 5000
                    });
                } else {
                    // 没选择商品，或者没有登陆
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, 'json');
        });
    });
    $('body').on('click', '.GO-GOODS-INFO', function() {
        var url = $(this).data('goods_url');
        var go = $(this).data('cur_page');
        page_url=bulidUrl(go);
        history.replaceState(null, '货YOYO商城-云商城3333', page_url);
        saveLastPage();
        $.go($.baseurl(url));
    });
    function saveLastPage()
    {
        sessionStorage.setItem(session_storage_key, $(".container").html());
    }
    function bulidUrl(go)
    {
        var data = $('#searchForm').serializeJson();
        var params = '';
        $.each(data, function(i, v) {
            params = params + '&' + i + '=' + v;
        });
        var page_url = location.href;
        page_url = page_url.split('?')[0];
        if (page_url.indexOf("?") == -1) {
            params = params.replace(/&/, "?");
        }
        page_url = page_url + params;
        page_url = page_url + '&go=' + go;
        return page_url;
    }
    //
    if (window.__wxjs_environment == 'miniprogram') {
        $('.header-category').addClass('miniprogram-category');
    }
    //
    $().ready(function() {
        // 缓载图片
        $.imgloading.loading();
    });
    //图片预加载
    document.onreadystatechange = function() {
        if (document.readyState == "complete") {
            $.imgloading.setting({
                threshold: 1000
            });
            $.imgloading.loading();
        }
    }
    function currentUserId(){
        return '{{ $user_info['user_id'] ?? 0 }}';
    }
    function getIntegralName(){
        return '积分';
    }
    function addPoint(ob) {
        if (ob != null && ob != 'undefined') {
            if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == currentUserId()) {
                $.intergal({
                    point: ob.point,
                    name: getIntegralName()
                });
            }
        }
    }
    //
</script>
</body>
</html>
