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
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="is_frontend" content="yes" />
    <meta name="is_web_mobile" content="yes" />
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />
    <!-- #is_wabp_end -->
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/css/common.css?v=20190327"/>
    <link rel="stylesheet" href="/css/shop_header.css?v=20190327"/>
    <link rel="stylesheet" href="/css/shop_coupon.css?v=20190327"/>
    <link rel="stylesheet" href="/css/bonus_message.css?v=20190327"/>
    <link rel="stylesheet" href="/css/swiper.min.css?v=20190327"/>
    <link rel="stylesheet" href="/css/iconfont/iconfont.css?v=20190327"/>
    <!---->
    <link rel="stylesheet" href="/css/dianpu.css?v=20190327"/>
    <!---->

    <!-- ================== END BASE CSS STYLE ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=20190319"></script>
    <script src="/js/zepto.min.js?v=20190319"></script>
    <script src="/js/zepto.waypoints.js?v=20190319"></script>
    <script src="/js/swiper.jquery.min.js?v=20190319"></script>
    <script src="/js/shop.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/yii.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20190319"></script>
    <script src="/js/common.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20190319"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20190319"></script>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif

</head>
<body>
<div class="show-menu-info" id="menu">
    <ul>
        <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
        <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
        <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
        <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
    </ul>
</div>

<link rel="stylesheet" href="/css/dianpu_take_out.css?v=20190327"/>
<link rel="stylesheet" href="/css/iconfont/iconfont.css?v=20190327"/>
<div class="take-out-top-box">
    <div class="shop-top-bg">

        <img src="/images/shop_top_bg.jpg" />

    </div>
    <header class="takeout-header">
        <div class="takeout-header-bcak">
            <a class="sb-back iconfont icon-fanhui1" href="javascript:history.back(-1)" title="返回"></a>
        </div>
        <!-- 如果有自由购功能，给下面标签添加class,'header-middle-freebuy' -->
        <div class="takeout-header-middle @if($freebuy_enable){{ 'header-middle-freebuy' }}@endif SZY-SHOP-HEADER">
            <div class="header-middle-con">
                <form method="GET" name="listform" action="/theme/takeout/{{ $shop_info['shop']['shop_id'] }}">
                    <div class="header-search">
                        <i class="search-icon"></i>
                        <input name="keyword" id="keyword" type="search" placeholder="搜索店铺内商品" class="search-input" value="{{ $keyword ?? '' }}">
                    </div>
                </form>
                <a href="/freebuy/scan/{{ $shop_info['shop']['shop_id'] }}.html" class="freebuy-scan" title="扫码"></a>
                <a class="shop-collect take-out-icon @if($is_collect){{ 'shop-collect-select' }}@endif"></a>
            </div>
        </div>
        <!-- 如果有自由购功能，给下面标签添加class,'header-right-freebuy'，然后扫码的a标签显示 -->
        <div class="takeout-header-right">
            <aside class="top_bar">
                <div class="show-menu iconfont icon-gengduo3" id="show_more"></div>
            </aside>
        </div>
    </header>
    <div class="shop-info">
        <div class="shop-logo">
            <img src="{{ get_image_url($shop_info['shop']['shop_image'], 'shop_image') }}" alt="{{ $shop_info['shop']['shop_name'] }}">
        </div>
        <div class="shop-info-right">
            <div class="shop-name">{{ $shop_info['shop']['shop_name'] }}</div>
            <div class="shop-notice">公告：{!! $shop_info['shop']['detail_introduce'] !!}</div>

            <div class="shop-tag">

                <em>
                    <s></s>
                    支持自提
                </em>

                <em>
                    <s></s>
                    送红包
                </em>

            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // 收藏
        $('body').on('click', '.shop-collect', function(event) {
            var target = $(this);
            var shop_id = "{{ $shop_info['shop']['shop_id'] }}";
            $.loading.start();
            $.collect.toggleShop(shop_id, function(result) {
                $.loading.stop();
                if (result.data == 1) {
                    $(target).addClass('shop-collect-select');
                } else {
                    $(target).removeClass('shop-collect-select');
                }

            }, 1);
        });

        $('.search-icon').click(function() {
            var keyword = $.trim($('#keyword').val());
            if (keyword == '') {
                return;
            }
            $(this).parents('form').submit();
        });

    });
</script>
<script src="/js/szy_rotate.js?v=20190319"></script>
<!--主体内容开始-->
<div class="goods-list-content" id="con">
    <ul class="nav-tab-con bdr-bottom">
        <li>
            <a href="javascript:void(0)" class="current">商品</a>
        </li>
        <li>
            <a href="/theme/takeout/comment.html?shop_id={{ $shop_info['shop']['shop_id'] }}" class="">评价</a>
        </li>
        <li>
            <a href="/theme/takeout/info.html?shop_id={{ $shop_info['shop']['shop_id'] }}" class="">商家</a>
        </li>
    </ul>
    <!--商品-->
    <div class="shop-con-tab clearfix" id="not-standard">
        <!--左侧内容开始-->
        <div class="left" id="second-category">
            <ul class="mainmenu">
                <li class="item @if($cat_id == 0){{ 'active' }}@endif SZY-SHOP-GOODS-CAT" data-cat_id="0">
                    <img class="menu-category-icon" src="/images/goods_hot_icon.png">
                    <span>热销</span>
                </li>

                @if(!empty($shop_category))
                @foreach($shop_category as $v)
                <li class="SZY-SHOP-GOODS-CAT item @if($parent_id == $v->cat_id){{ 'active' }}@endif" data-cat_id="{{ $v->cat_id }}">
                    <span>{{ $v->cat_name }}</span>
                </li>
                @endforeach
                @endif

            </ul>
        </div>
        <!--左侧内容结束-->
        <!--右侧内容开始-->
        <div class="right scroll goods-list-wrap" id="list-wrap">


            {{--引入商品列表--}}
            @include('theme.takeout.partials._list')

        </div>
        <!--右侧内容结束-->
    </div>
</div>
<!-- 分享 -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
<script type="text/javascript">
    $().ready(function() {

        // $("body").append('<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><\/script>');

        var url =  location.href;

        if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState){
            if(url.indexOf("?") == -1){
                url += "?user_id=" + "";
            }else{
                url += "&user_id=" + "";
            }
        }else{
            url = location.href.split('#')[0];
        }

        var share_url = "";

        if (share_url == '') {
            share_url = url;
        }

        $.ajax({
            type: "GET",
            url: "/index/information/get-weixinconfig.html",
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
                        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
                    });

                    history.replaceState(null, document.title, url);
                }
            }
        });

        // 微信JSSDK开发
        wx.ready(function() {

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
        });
    });
</script>

<script type="text/javascript">
    function miniprogramready() {
        var share_info = {
            title: '{{ $seo_title }}',
            imgUrl: '{{ get_image_url($seo_image) }}'
        };
        wx.miniProgram.postMessage({
            data: share_info
        });
    }
    if (!window.WeixinJSBridge || !WeixinJSBridge.invoke) {
        document.addEventListener('WeixinJSBridgeReady', miniprogramready, false);
    } else {
        miniprogramready();
    }
</script>
<!-- 底部_START -->
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

                        <span class="cart-checkbox toggle-checkbox goods-checkbox-all checked">全选</span>
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
            <div class="goods-total-price price-color SZY-GOODS-AMOUNT">￥{{ $cart_price_info['total_fee'] }}</div>
        @endif

    </div>
    <script type='text/javascript'>
        $(document).ready(function() {
            //添加
            var start_price = '0.00';
            var eventclick; //防止重复点击
            $('body').on('click', '.cartbox-increase', function() {
                $('.SZY-PAY').addClass('wait-loading');
                var targer = $(this);
                var sku_id = targer.prev().data('sku_id');
                var goods_id = targer.prev().data('goods_id');
                var goods_max_number = parseInt(targer.prev().data('goods_max_number'));
                var number = parseInt(targer.prev().val()) + 1;
                if (number > goods_max_number) {
                    targer.prev().val(goods_max_number);
                } else {
                    targer.prev().val(number);
                }
                $.cart.changeNumber(sku_id, number, null, function(result) {
                    if (result.code == 0) {
                        $('.SZY-NUMBER-' + goods_id).val(number);
                        cartboxLoad({
                            count: result.params.count,
                            select_goods_number: result.params.select_goods_number,
                            select_goods_amount_format: result.params.select_goods_amount_format,
                            start_price: result.params.start_price,
                            start_price_format: result.params.start_price_format,
                            dif_price: result.params.dif_price,
                            dif_price_format: result.params.dif_price_format
                        });
                    } else {
                        if (result.data.max) {
                            targer.prev().val(result.data.max);
                        }
                    }
                });
            });

            //减少
            $('body').on('click', '.cartbox-decrease', function() {
                $('.SZY-PAY').addClass('wait-loading');
                var targer = $(this);
                var sku_id = targer.next().data('sku_id');
                var cart_id = targer.next().data('cart_id');
                var goods_id = targer.next().data('goods_id');
                var number = parseInt(targer.next().val()) - 1;
                if (number == 0) {
                    targer.next().val(1);
                } else {
                    targer.next().val(number);
                }
                if (eventclick != undefined) {
                    clearTimeout(eventclick);
                }
                if (number < 1) {

                    $.confirm("您确定从购物车中移除此商品吗？", function() {

                        $.cart.del({
                            cart_ids: cart_id
                        }, function() {
                            $.cartbox.load(function(res) {
                                if (res.count > 0) {
                                    $.cartbox.open();
                                } else {
                                    $.cartbox.close();
                                }
                            });
                            $('.SZY-NUMBER-' + goods_id).hide();
                            $('.SZY-NUMBER-' + goods_id).val(0);
                            $('.SZY-NUMBER-' + goods_id).next().hide();
                            $('.SZY-PAY').removeClass('wait-loading');
                        });
                    }, function() {
                        $.cart.changeNumber(sku_id, 1, null, function(result) {
                            $('.SZY-NUMBER-' + goods_id).val(number);
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
                } else {
                    eventclick = setTimeout(function() {
                        $.cart.changeNumber(sku_id, number, null, function(result) {
                            $('.SZY-NUMBER-' + goods_id).val(number);
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
                    }, 500);
                }
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
    </script>
    <div class="check-btn bg-color @if($cart_price_info['goods_number'] == 0){{ 'disabled' }}@endif SZY-PAY">@if($shop_info['shop']['start_price'] > 0)￥{{ $shop_info['shop']['start_price'] }}起送@else{{ '去结算' }}@endif</div>

</footer>


<a href="javascript:void(0);" id="back-to-top" class="gotop hide">
    <img src="/images/topup.png" />
</a><!-- 底部_END -->
<script src="/assets/d2eace91/js/jquery.history.js?v=20190319"></script>
<script type="text/javascript">
    var windowHeight = $(window).height();
    var topheight = $('.take-out-top-box').height();
    $('body').css('min-height', $(window).height() + topheight - 44);
    $('.goods-list-content').css('min-height', $(window).height() - 94)
    $('#second-category').height(windowHeight - 90 - topheight);
    $(window).scroll(function() {
        var scrollTopHeight = $(document).scrollTop();
        if (scrollTopHeight > 0) {
            $('.takeout-header').addClass('fixed-header');
        } else {
            $('.takeout-header').removeClass('fixed-header');
        }
        if (scrollTopHeight >= (topheight - 44)) {
            $('.nav-tab-con').css({
                'position': 'fixed',
                'top': '44px',
                'background': '#fafafa',
                'z-index': '21'
            });
            $('.goods-list-content').css({
                'top': '40px'
            });
            $('#second-category').css({
                'position': 'fixed',
                'top': '84px',
                'height': windowHeight - 134
            });
            $('#list-wrap').css('margin-left', '25%');
            $('.fixed-classify-box').removeClass('hide');
            $('.blank-lump').removeClass('hide');
        } else {
            $('.nav-tab-con').css({
                'position': 'relative',
                'top': '0',
                'background': '#fafafa'
            })
            $('#second-category').removeAttr("style");
            $('#list-wrap').removeAttr("style");
            $('.goods-list-content').css({
                'top': 'auto'
            })
            $('.fixed-classify-box').addClass('hide');
            $('.blank-lump').addClass('hide');
        }
    });
    var tablelist = null;
    var shop_id = '{{ $shop_info['shop']['shop_id'] }}';

    $().ready(function() {
        var array = new Array();
        $('#second-category li').each(function() {
            array.push($(this).position().top);
        });
        tablelist = $("#table_list").tablelist();
        $('.SZY-SHOP-GOODS-CAT').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            var cat_id = $(this).data('cat_id');

            $('.chr-item').addClass('hide');
            $('#chr_' + cat_id).removeClass('hide');

            $('.SZY-SHOP-GOODS-CHR').removeClass('current');
            $('.SZY-SHOP-GOODS-CHR[data-cat_id="' + cat_id + '"]').addClass('current');
            $('.SZY-SHOP-GOODS-CHR-MORE').removeClass('current');
            $('.SZY-SHOP-GOODS-CHR-MORE[data-cat_id="' + cat_id + '"]').addClass('current');

            tablelist.url = '/theme/takeout/' + shop_id + '.html';
            var scrolltop = topheight - 44;
            $('html,body').animate({
                scrollTop: scrolltop
            }, 800);
            tablelist.page.cur_page = 1;
            tablelist.load({
                cat_id: cat_id,
                showloading: false
            }, function() {
                $.imgloading.loading();
                History.replaceState(null, '鲜农乐食品专营店-商之翼1', '/theme/takeout/' + shop_id + '.html?cat_id=' + cat_id);
            });
        });

        $('body').on('click', '.SZY-SHOP-GOODS-CHR', function() {
            if ($(this).hasClass('current')) {
                return;
            }
            $('.down-more-btn').removeClass('show')
            $('.fixed-second-classify').addClass('hide')
            $('.SZY-SHOP-GOODS-CHR').removeClass('current');
            $(this).addClass('current');
            var cat_id = $(this).data('cat_id');
            $('.SZY-SHOP-GOODS-CHR-MORE').removeClass('current');
            $('.SZY-SHOP-GOODS-CHR-MORE[data-cat_id="' + cat_id + '"]').addClass('current');
            tablelist.url = '/theme/takeout/' + shop_id + '.html';
            tablelist.page.cur_page = 1;
            tablelist.load({
                cat_id: cat_id,
                showloading: false
            }, function() {
                $("#list-wrap").scrollTop(0);
                $.imgloading.loading();
                History.replaceState(null, '鲜农乐食品专营店-商之翼1', '/theme/takeout/' + shop_id + '.html?cat_id=' + cat_id);
            });
        });

        $('body').on('click', '.SZY-SHOP-GOODS-CHR-MORE', function() {
            var cat_id = $(this).data('cat_id');
            $('.SZY-SHOP-GOODS-CHR[data-cat_id="' + cat_id + '"]').click();
        });

    });
</script>

<script type='text/javascript'>
    $().ready(function() {
        //加入购物车
        var fly_options = null;
        $('body').on('click', '.cart-box .add-cart', function(event) {
            var this_target = $(this);
            var image_url = $(this).data('image_url');
            var goods_id = $(this).data('goods_id');
            var shop_id = '{{ $shop_info['shop']['shop_id'] }}';
            var buy_enable = $(this).data("buy-enable");
            if (buy_enable) {
                $.msg(buy_enable);
                return false;
            }
            $.cart.add(goods_id, 1, {
                shop_id: shop_id,
                image_url: image_url,
                event: event,
                is_sku: false,
                callback: function(result) {
                    if (result.code == 0) {
                        var numbtn = this_target.parent().find(".num");
                        if (parseInt(numbtn.val()) == 0) {
                            numbtn.removeClass('hide');
                            //减号的按钮动画显示
                            this_target.parent().find(".decrease").removeClass('hide');
                        }
                        // 点击加入购物车相应的购买数量
                        numbtn.val(parseInt(numbtn.val()) + 1);
                        //$('.SZY-PAY').removeClass('disabled');
                    }
                }
            });
            return false;
        });

        //减少购物车
        $('body').on('click', '.cart-box .remove-cart', function() {
            var this_target = $(this);
            var sku_open = this_target.data('sku_open');
            if (sku_open) {
                $.msg('此商品有多个规格，请到购物车中移除');
                return false;
            }
            var data = {};
            data.goods_id = this_target.data("goods_id");
            data.shop_id = shop_id;
            var numbtn = this_target.parent().find(".num");
            var number = parseInt(numbtn.val()) - 1;
            numbtn.val(number);
            if (number <= 0) {
                numbtn.val(0);
                numbtn.addClass('hide');
                this_target.addClass('hide');
            }
            $.cart.remove(data, function(result) {
                if (result.code == 0) {
                    $.cartbox.load();

                }
            });
            return false;
        });

        $('.SZY-PAY').click(function() {
            if ($(this).hasClass('disabled') || $(this).hasClass('wait-loading')) {
                return;
            }
            $.ajax({
                type: "GET",
                data: {
                    shop_id: shop_id
                },
                url: "/cart/go-checkout",
                dataType: "json",
                success: function(result) {
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
                }
            });
        });

    });
</script>

<script type="text/javascript">
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
</script>

<script type="text/javascript">
    $('.down-more-btn').click(function() {
        if ($('.fixed-second-classify').hasClass('hide')) {
            $('.down-more-btn').addClass('show')
            $('.fixed-second-classify').removeClass('hide')
        } else {
            $('.down-more-btn').removeClass('show')
            $('.fixed-second-classify').addClass('hide')
        }

    });
    // 滑动菜单
    mySwiper = new Swiper('.horizontal-scrolling-classify', {
        direction: 'horizontal', // 水平切换选项
        initialSlide: 0,
        slidesPerView: "auto",
        slideToClickedSlide: true,
        observer: true,//修改swiper自己或子元素时，自动初始化swiper
        observeParents: true,//修改swiper的父元素时，自动初始化swiper
        onInit: function(swiper) {
            //Swiper初始化了
            // alert(swiper.activeIndex);//提示Swiper的当前索引
            swiper.activeIndex = 0;
            swiper.update();
        }
    });
</script>


<script src="/js/jquery.fly.min.js?v=20190319"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20190319"></script>


<script type="text/javascript">
    $().ready(function() {
        // 缓载图片
        $.imgloading.loading();
    });
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
<!-- 底部 _end-->
</body>
</html>