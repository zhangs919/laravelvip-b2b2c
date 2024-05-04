
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
    <link href="/css/dianpu_goods.css" rel="stylesheet">
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
<div class="shop-goods-top">
    <div class="header-search-con">
        <div class="header-search-left">
            <a href="javascript:history.back(-1)" class="sb-back iconfont icon-fanhui1" title="返回"></a>
        </div>
        <div class="header-search-middle">
            <div class="search-box">
                <form name="searchForm" method="get" action="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html">
                    <input type="search" name="keyword" class="text" value="{{ $keyword ?? '' }}" placeholder="搜索本店商品">
                    <input type="submit" class="submit" value="">
                </form>
            </div>
        </div>
        <div class="header-search-right">
            <!-- 控制展示更多按钮 -->
            <aside class="show-menu-btn">
                <div id="show_more" class="show-menu  iconfont icon-gengduo3"></div>
            </aside>
        </div>
    </div>
    <div class="shop-nav ub SZY-SHOP-GOODS-SORT">
        <a class="ub-f1 current" data-sort="0" href="javascript:void(0)">综合</a>
        <a class="ub-f1 " data-sort="1" href="javascript:void(0)">销量</a>
        <a class="ub-f1 " data-sort="3" href="javascript:void(0)">评论</a>
        <!--价格升序给a标签加price-up;降序加price-down-->
        <a class="ub-f1 icon-sort-price " data-sort="4" href="javascript:void(0)">
            价格
            <i class="sort-icon"></i>
        </a>
    </div>
    <form id="shopGoodsForm" action="" method="post">
        <input type="hidden" value="0" name="cat_id">
        <input type="hidden" value="0" name="sort">
        <input type="hidden" value="ASC" name="order">
        <input type="hidden" value="" name="keyword">
    </form>
    <div class="mask-div" id="maskdiv"></div>
</div>
<script type="text/javascript">
    //
</script>
<!-- 内容 -->
<!-- 默认缓载图片 -->
<!--主体内容开始-->
{{--引入店铺商品列表--}}
@include('shop.partials._shop_goods_0')

<div class="shopcar cartbox">
    <a href="/cart.html?shop_id={{ $shop_info['shop']['shop_id'] }}">
        <span class="flow-cartnum SZY-CART-COUNT bg-color">0</span>
    </a>
</div>
<!-- 分享 -->
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
<a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
<script type="text/javascript">
    //
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
<script type="text/javascript">
    //
</script>
<!-- 引底部文件 -->
<!--底部菜单 start-->
<div style="height: 45px;"></div>
<div class="shop-footer">
    <div class="shop-footer-l">
        <a href="/shop/{{ $shop_info['shop']['shop_id'] }}.html">
            <i class="shop-nav-icon"></i>
            <span>首页</span>
        </a>
    </div>
    <ul>
        <li class="goods-category">
            <a href="javascript:void(0)" szy_tag_compiled="1">
                <span>
                    <i class="shop-index"></i>
                    <div class="loader-img">
                        <div></div>
                    </div>
                    商品分类
                </span>
            </a>
        </li>
        <li>
            <a href="{{ shop_prefix_url($shop_info['shop']['shop_id'],'mobile_shop_info') }}">
                <span>
                    <i class="shop-index"></i>
                    店铺详情
                </span>
            </a>
        </li>
        <li>
            <!-- 微商城客服调用qq -->
            <a href="javascript:void(0)" onClick="$.msg('卖家没有设置联系电话')">
                <span>
                    <i class="shop-index"></i>
                    联系客服
                </span>
            </a>
        </li>
    </ul>
</div>
<div class="classify-content SZY-SHOP-CATEGORY-LIST hide"></div>
<script type="text/javascript">
    //
</script>
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
    $().ready(function(){
        //首先将#back-to-top隐藏
        //$("#back-to-top").addClass('hide');
        //当滚动条的位置处于距顶部1000像素以下时，跳转链接出现，否则消失
        $(function ()
        {
            $(window).scroll(function()
            {
                if ($(window).scrollTop()>600)
                {
                    $('body').find(".back-to-top").removeClass('hide');
                }
                else
                {
                    $('body').find(".back-to-top").addClass('hide');
                }
            });
            //当点击跳转链接后，回到页面顶部位置
            $(".back-to-top").click(function()
            {
                $('body,html').animate(
                    {
                        scrollTop:0
                    }
                    ,600);
                return false;
            });
        });
    });
    //
    var tablelist = null;
    $().ready(function() {
        tablelist = $("#table_list").tablelist();
    });
    //
    // 当滚动条的位置距顶部一定高度时，将分类固定
    $(function() {
        $(window).bind('scroll', function() {
            var len = $(this).scrollTop()
            if (len >= 44) {
                $('.shop-goods-top').css({
                    "transform": "translate3d(0px, -44px, 0px)"
                });
            } else {
                $('.shop-goods-top').css({
                    'transform': 'translate3d(0, 0, 0)'
                });
            }
        })
    })
    // 滚动加载数据
    $(window).on('scroll', function() {
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
    $(document).ready(function() {
        //加入购物车
        var fly_options = null;
        $('body').on('click', '.cart-box .add-cart', function(event) {
            var this_target = $(this);
            var image_url = $(this).data('image_url');
            var buy_enable = $(this).data("buy_enable");
            if (buy_enable) {
                $.msg(buy_enable);
                return;
            }
            var step = $(this).data("step");
            if (isNaN(step)) {
                step = 1;
            }
            $.cart.add(this_target.data("goods_id"), step, {
                shop_id: "{{ $shop_info['shop']['shop_id'] }}",
                image_url: image_url,
                event: event,
                is_sku: false,
                callback: function(result) {
                    if (result.code == 0) {
                        var numbtn = this_target.parents('.cart-box').find(".num");
                        if (parseInt(numbtn.val()) == 0) {
                            numbtn.show();
                            //减号的按钮动画显示
                            this_target.parents('.cart-box').find(".remove-cart").show();
                        }
                        // 点击加入购物车相应的购买数量
                        numbtn.val(parseInt(numbtn.val()) + step);
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
            var step = $(this).data("step");
            if (isNaN(step)) {
                step = 1;
            }
            var data = {};
            data.goods_id = this_target.data("goods_id");
            data.shop_id = this_target.data("shop_id");
            data.number = step;
            var numbtn = this_target.parents('.cart-box').find(".num");
            var number = parseInt(numbtn.val()) - step;
            numbtn.val(number);
            if (number <= 0) {
                numbtn.val(0);
                numbtn.hide();
                this_target.hide();
            }
            $.cart.remove(data, function(result) {
                if (result.code == 0) {
                    $('.SZY-CART-COUNT').html(result.data.goods_number);
                }
            });
            return false;
        });
        $('body').on('click', '.GO-GOODS-INFO', function() {
            var url = $(this).data('goods_url');
            var go = $(this).data('cur_page');
            var data = $('#shopGoodsForm').serializeJson();
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
            history.pushState(null, '{{ $seo_title }}', page_url);
            $.go($.baseurl(url));
        });
    });
    //
    var scrollheight = 0;
    scrollheight = $(document).scrollTop() - 150;
    $(".choose-attribute-main").css("margin-top", "-" + scrollheight + "px");
    //
    var scrollheight = 0;
    var loaded = false;
    var form = $("#shopGoodsForm");
    //滑动触发
    try {
        document.createEvent("TouchEvent");
        document.getElementById("maskdiv").addEventListener('touchmove', function(event) {
            $(".shop-submenu").hide();
            $('.mask-div').hide();
            $('.shop-nav .nav-item').removeClass('current');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        }, false);
        $('.mask-div').click(function() {
            $(".shop-submenu").hide();
            $('.mask-div').hide();
            $('.shop-nav .nav-item').removeClass('current');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        });
    } catch (e) {
        $('.mask-div').click(function() {
            $(".shop-submenu").hide();
            $('.mask-div').hide();
            $('.shop-nav .nav-item').removeClass('current');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        });
    }
    //排序
    $('.SZY-SHOP-GOODS-SORT a').click(function() {
        var sort = $(this).data('sort');
        $(this).addClass('current');
        $(this).siblings().removeClass('current').removeClass('price-down').removeClass('price-up');
        var order = 'DESC';
        if ($(this).find('i').length > 0) {
            if ($(this).hasClass('price-down')) {
                $(this).addClass('price-up').removeClass('price-down');
                order = 'ASC';
            } else if ($(this).hasClass('price-up')) {
                $(this).addClass('price-down').removeClass('price-up');
                order = 'DESC';
            } else {
                $(this).addClass('price-down');
                order = 'DESC';
            }
        }
        form.find("input[name='sort']").val(sort);
        form.find("input[name='order']").val(order);
        scroll = 2;
        var data = form.serializeJson();
        data.page = {
            cur_page: 1
        };
        data.go = 1;
        tablelist.load(data, function() {
            $.imgloading.loading();
        });
        $('.shop-nav .nav-item').eq(1).html(name);
        $('.shop-nav .nav-item').eq(1).removeClass('current');
        $(".mask-div").hide();
        $("body").css("top", "auto");
        $("body").removeClass("visibly");
    });
    //
    var scrollheight = 0;
    var loaded = false;
    var position = 'list';
    var shop_id = '{{ $shop_info['shop']['shop_id'] }}';
    var cat_id = '0';
    var parent_id = '';
    $().ready(function() {
        $('.goods-category').click(function() {
            var $this = $(this);
            if ($this.hasClass('disabled')) {
                return;
            }
            if ($(".classify-content").hasClass('hide')) {
                if (loaded) {
                    showClassifyContent($this);
                    return;
                }
                $.get('/shop/index/shop-cat-list', {
                    'shop_id': shop_id,
                    'cat_id': cat_id
                }, function(result) {
                    $('.SZY-SHOP-CATEGORY-LIST').html(result.data);
                    showClassifyContent($this);
                }, "json");
            } else {
                hideClassifyContent($this);
            }
        });
        $('.shop-submenu-left li').click(function() {
            $(this).addClass('current').siblings().removeClass('current');
            $('#cat_chr_' + $(this).data("cid")).removeClass('hide').siblings().addClass('hide');
        });
        //滑动触发
        try {
            document.createEvent("TouchEvent");
            document.getElementById("maskdiv").addEventListener('touchmove', function(event) {
                $(".classify-content").addClass('hide');
                $(".classify-content").animate({
                    height: '0'
                }, [10000]);
                $('.mask-div').hide();
                $('.goods-category').removeClass('goods-category-after');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            }, false);
            $('.mask-div').click(function() {
                $(".classify-content").addClass('hide');
                $(".classify-content").animate({
                    height: '0'
                }, [10000]);
                $('.mask-div').hide();
                $('.goods-category').removeClass('goods-category-after');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            });
        } catch (e) {
            $('.mask-div').click(function() {
                $(".classify-content").addClass('hide');
                $(".classify-content").animate({
                    height: '0'
                }, [10000]);
                $('.mask-div').hide();
                $('.goods-category').removeClass('goods-category-after');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            });
        }
        if(sessionStorage.goods_category_511){
            $('.SZY-SHOP-CATEGORY-LIST').html(sessionStorage.goods_category_511);
            $("li[id^='cat_item']").removeClass('current');
            if(cat_id == parent_id){
                $('#cat_item_'+cat_id).addClass('current');
            }else{
                $('#cat_item_'+parent_id).addClass('current');
                $('#cat_item_'+cat_id).addClass('current');
            }
            $('.SZY-SHOP-GOODS-CHR ul').addClass('hide');
            $('#cat_item_'+cat_id).parent('ul').removeClass('hide');
            $('.goods-category').removeClass('disabled');
            $(".classify-content").addClass('hide');
            loaded = true;
            return;
        }else{
            $.get('/shop/index/shop-cat-list', {
                'shop_id': shop_id,
                'cat_id': cat_id
            }, function(result) {
                $('.SZY-SHOP-CATEGORY-LIST').html(result.data);
                sessionStorage.goods_category_511 = result.data;
                $('.goods-category').removeClass('disabled');
                $(".classify-content").addClass('hide');
                loaded = true;
            }, "json");
        }
    });
    //显示弹出层
    function showClassifyContent($this) {
        $(".classify-content").removeClass('hide');
        $(".classify-content").animate({
            height: '70%'
        }, [10000]);
        $('.mask-div').show();
        $this.addClass('goods-category-after');
        scrollheight = $(document).scrollTop();
        $("body").css("top", "-" + scrollheight + "px");
        $("body").css("top", "-" + scrollheight + "px");
        $("body").addClass("visibly");
    }
    //隐藏弹出层
    function hideClassifyContent($this) {
        if ($this.hasClass('disabled')) {
            $this.removeClass('disabled');
        }
        $(".classify-content").addClass('hide');
        $(".classify-content").animate({
            height: '0'
        }, [10000]);
        $('.mask-div').hide();
        $this.removeClass('goods-category-after');
        $("body").css("top", "auto");
        $("body").removeClass("visibly");
        $(window).scrollTop(scrollheight);
    }
    $('#yikf').click(function (){
        $('#shop_footer_yikf').submit();
    })
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
    //
    $().ready(function(){
        WS_AddPoint({
            user_id: '{{ $user_info['user_id'] ?? 0 }}',
            url: "{{ get_ws_url('4431') }}",
            type: "add_point_set"
        });
    });
    function addPoint(ob) {
        if (ob != null && ob != 'undefined') {
            if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '2711') {
                $.intergal({
                    point: ob.point,
                    name: '积分'
                });
            }
        }
    }
    //
</script>
</body>
</html>
