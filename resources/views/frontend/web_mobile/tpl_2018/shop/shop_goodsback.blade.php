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
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />
    <!-- #is_wabp_end -->
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/css/common.css?v=20181217"/>
    <link rel="stylesheet" href="/css/shop_header.css?v=20181217"/>
    <link rel="stylesheet" href="/css/shop_coupon.css?v=20181217"/>
    <link rel="stylesheet" href="/css/bonus_message.css?v=20181217"/>
    <link rel="stylesheet" href="/css/swiper.min.css?v=20181217"/>
    <link rel="stylesheet" href="/css/swiper.3dmin.css?v=20181217"/>
    <!---->

    <!---->
    <link rel="stylesheet" href="/css/dianpu.css?v=20190327"/>
    <!---->

    <!-- ================== END BASE CSS STYLE ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=20190319"></script>
    <script src="/js/swiper.jquery.min.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/yii.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20190319"></script>
    <script src="/js/common.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20190319"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20190319"></script>
    <!--整站改色 _start-->
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif
</head>
<body>
<!-- 引入头部文件 -->
<!-- -->
<!-- -->
<!---->
<link rel="stylesheet" href="/css/dianpu_goods.css?v=20190327"/>
<div class="shop-goods-top">
    <header>
        <div class="header">
            <div class="category-left">
                <a href="javascript:history.back(-1)" class="sb-back" title="返回"></a>
            </div>
            <div class="header-middle">

                <div class="search-box">
                    <form name="searchForm" method="get" action="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html">
                        <div class="text-box">
                            <input type="text" name="keyword" class="text" value="{{ $keyword ?? '' }}" placeholder="搜索本店商品">
                            <input type="submit" class="submit" value="">
                        </div>
                    </form>
                </div>

            </div>
            <div class="header-right">
                <aside class="show-menu-btn">
                    <div id="show_more" class="show-menu">
                        <a href="javascript:void(0);"></a>
                    </div>
                </aside>
            </div>
        </div>
    </header>

    <div class="shop-nav ub SZY-SHOP-GOODS-SORT">
        <a class="ub-f1 " data-sort="0" href="javascript:void(0)">综合</a>
        <a class="ub-f1 " data-sort="1" href="javascript:void(0)">销量</a>

        <a class="ub-f1 " data-sort="3" href="javascript:void(0)">评价</a>


        <!--价格升序给a标签加price-up;降序加price-down-->
        <a class="ub-f1 " data-sort="4" href="javascript:void(0)">
            价格
            <i class="sort-icon"></i>
        </a>

    </div>
    <form id="shopGoodsForm" action="" method="post">
        <input type="hidden" value="0" name="cat_id">
        <input type="hidden" value="5" name="sort">
        <input type="hidden" value="DESC" name="order">
        <input type="hidden" value="" name="keyword">
    </form>
    <div class="mask-div" id="maskdiv"></div>
</div>
<script type="text/javascript">
    var scrollheight = 0;
    var loaded = false;
    var form = $("#shopGoodsForm");
    //头部滚动
    if (IsPC()) {
        $(window).scroll(function() {
            if ($(window).scrollTop() <= 50) {
                $(".shop-goods-top header").show();
                $(".filter-tag-box").css('top', "90px");
                $('.goods-list-box').css('margin-top', "100px");
            } else {
                $(".shop-goods-top header").hide();
                $(".filter-tag-box").css('top', "40px");
                $('.goods-list-box').css('margin-top', "50px");
            }
        })
    } else {

        $(document).bind("touchmove", function(event) {
            $(window).scroll(function() {
                if ($(window).scrollTop() <= 50) {
                    $(".shop-goods-top header").show();
                    $(".filter-tag-box").css('top', "90px");
                    $('.goods-list-box').css('margin-top', "100px");
                } else {
                    $(".shop-goods-top header").hide();
                    $(".filter-tag-box").css('top', "40px");
                    $('.goods-list-box').css('margin-top', "50px");
                }
            });
        });

    }
    function IsPC() {
        var userAgentInfo = navigator.userAgent;
        var Agents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
        var flag = true;
        for (var v = 0; v < Agents.length; v++) {
            if (userAgentInfo.indexOf(Agents[v]) > 0) {
                flag = false;
                break;
            }
        }
        return flag;
    }

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
        if (sort == 'filter') {
            if ($(".filter-tag-box").hasClass("hide")) {
                $(".filter-tag-box").removeClass("hide");
                $('.mask-div').show();
            } else {
                $(".filter-tag-box").addClass("hide");
                $('.mask-div').hide();
            }
            return;
        } else {
            $(".filter-tag-box").addClass("hide");
            $('.mask-div').hide();
        }
        var order = 'DESC';
        if (sort == '4') {
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

    //筛选
    $('.SZY-SHOP-GOODS-OTHER a').click(function() {
        if ($(this).hasClass('current')) {
            $(this).removeClass('current');
        } else {
            $(this).addClass('current');
        }
        var name = [];
        $.each($('.SZY-SHOP-GOODS-OTHER a'), function(i, obj) {
            if ($(obj).hasClass('current')) {
                name.push($(obj).data('name'));
                form.find("input[name='" + $(obj).data('value') + "']").val('1');
            } else {
                form.find("input[name='" + $(obj).data('value') + "']").val('');
            }
        });
        if (name.length > 0) {
            $('.shop-nav a').eq(4).html(name.join(','));
        } else {
            $('.shop-nav a').eq(4).html('筛选');
        }
    });

    //确认操作
    $('.confirm-btn').click(function() {
        var data = form.serializeJson();
        tablelist.load(data, function() {
            $.imgloading.loading();
        });
        $(this).parents('.filter-tag-box').addClass('hide');
        $('.shop-nav .nav-item').eq(2).removeClass('current');
        $(".mask-div").hide();
        $("body").css("top", "auto");
        $("body").removeClass("visibly");
    });

    //清空操作
    $('.clear-btn').click(function() {
        $('.SZY-SHOP-GOODS-OTHER a').removeClass('current');
        form.find("input[name='is_free']").val('');
        form.find("input[name='is_stock']").val('');
        var data = form.serializeJson();
        tablelist.load(data, function() {
            $.imgloading.loading();
        });
    });

    //显示弹出层
    function showSubmenu($this) {
        $this.addClass('current').siblings().removeClass('current');
        $('.shop-submenu').hide();
        $('.shop-submenu').eq($this.index() - 1).show();
        $(".mask-div").show();
        scrollheight = $(document).scrollTop();
        $("body").css("top", "-" + scrollheight + "px");
        $("body").addClass("visibly");
        if (scrollheight <= 50) {
            $(".shop-goods-top header").show();
            $(".shop-submenu").css('top', "90px");
            $('.goods-list-box').css('margin-top', "100px");
        } else {
            $(".shop-goods-top header").hide();
            $(".shop-submenu").css('top', "40px");
            $('.goods-list-box').css('margin-top', "50px");
        }
    }

    //隐藏弹出层
    function hideSubmenu($this) {
        $this.removeClass('current');
        $('.shop-submenu').eq($this.index()).hide();
        $(".mask-div").hide();
        $("body").css("top", "auto");
        $("body").removeClass("visibly");
        $(window).scrollTop(scrollheight);
    }
</script>
<!---->
<!-- 内容 -->
{{--引入店铺商品列表--}}
@include('shop.partials._shop_goods')

<!-- 默认缓载图片 -->
<!--主体内容开始-->


<div class="shopcar cartbox">
    <a href="/cart.html?shop_id={{ $shop_info['shop']['shop_id'] }}">
        <span class="flow-cartnum SZY-CART-COUNT bg-color">0</span>
    </a>
</div>
<!-- 分享 -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
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
                title: '鲜农乐食品专营店- · 云商城', // 标题
                desc: '', // 描述
                imgUrl: '', // 分享的图标
                link: share_url,
                fail: function(res) {
                    alert(JSON.stringify(res));
                }
            });

            // 分享到朋友圈
            wx.onMenuShareTimeline({
                title: '鲜农乐食品专营店- · 云商城', // 标题
                desc: '', // 描述
                imgUrl: '', // 分享的图标
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
            title: '鲜农乐食品专营店- · 云商城',
            imgUrl: ''
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
<a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
<script type="text/javascript">
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
</script>

<script type="text/javascript">
    var tablelist = null;
    $().ready(function() {
        tablelist = $("#table_list").tablelist();
    });
</script>

<script type="text/javascript">
    // 滚动加载数据
    var scroll = '2';
    $(window).on('scroll', function() {
        if (($(document).scrollTop() + $(window).height() + 500) > $(document).height()) {
            if ($.isFunction($.pagemore)) {
                $.pagemore({
                    cur_page: scroll,
                    page_count: '2',
                    page_size: '12',
                    callback: function(result) {
                        // 图片缓载
                        scroll++;
                        $.imgloading.loading();
                    }
                });
            }
        }
    });
</script>
<script type='text/javascript'>
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
            $.cart.add(this_target.data("goods_id"), "1", {
                shop_id: "1",
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
                        numbtn.val(parseInt(numbtn.val()) + 1);
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
            data.shop_id = this_target.data("shop_id");
            var numbtn = this_target.parents('.cart-box').find(".num");
            var number = parseInt(numbtn.val()) - 1;
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
            var scroll = $(this).data('scroll');
            var url = $(this).data('goods_url');
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
            page_url = page_url + '&scroll=' + scroll;
            history.pushState(null, '鲜农乐食品专营店- · 云商城', page_url);
            window.location.href = url;
        });

    });
</script>
<script type='text/javascript'>
    var scrollheight = 0;
    scrollheight = $(document).scrollTop() - 150;
    $(".choose-attribute-main").css("margin-top", "-" + scrollheight + "px");
</script>
<!-- 引底部文件 -->
<!---->
<!--底部菜单 start-->
<div style="height: 45px;"></div>
<div class="shop-footer">
    <div class="shop-footer-l">



        <a href="/shop/1.html">
            <i class="shop-nav-icon"></i>
            <span>首页</span>
        </a>

    </div>
    <ul>
        <!---->
        <li class="goods-category disabled">
            <a href="javascript:void(0)">
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
            <a href="/shop/1/info.html">
				<span>
					<i class="shop-index"></i>
					店铺详情
				</span>
            </a>
        </li>

        <!-- -->
        <li>
            <a href="/bonus/list/1.html">
				<span>
					<i class="shop-index"></i>
					店铺红包
				</span>
            </a>
        </li>

    </ul>
</div>
<div class="classify-content SZY-SHOP-CATEGORY-LIST hide"></div>
<script type="text/javascript">
    var scrollheight = 0;
    var loaded = false;
    var position = 'list';
    var shop_id = '1';
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
        if(sessionStorage.goods_category_1){
            $('.SZY-SHOP-CATEGORY-LIST').html(sessionStorage.goods_category_1);
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
                sessionStorage.goods_category_1 = result.data;
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
</script>
<link rel="stylesheet" href="/css/online.css?v=20190327"/>
<div class="yikf-form site_yikf_form" id="yikf-kefu" style='display:none;'>
    <form id='yikf-form'class="yikf-item" action="https://kf.yunmall.xxxx.com/index/index/home?business_id=eb5bf6642a5afe7621241a51842b901c&groupid=&shop_id=1&goods_id=0" method="post" >
        <input type="hidden" name="visiter_id" value=''>
        <input type="hidden" name="visiter_name" value=''>
        <input type="hidden" name="avatar" value=''>
        <input type="hidden" name="domain" value=''>

    </form>
</div>
<script type="text/javascript">

    $('#yikf-kefu').click(function(){
        $('#yikf-form').submit();
    })
</script>


<!-- 隐藏菜单_start -->
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')
<!-- 隐藏菜单_end -->
<!---->
<!-- 购物车js -->
<script src="/js/jquery.fly.min.js?v=20190319"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20190319"></script>


<script type="text/javascript">
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
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
<!-- 底部 _end-->

</body>
</html>
