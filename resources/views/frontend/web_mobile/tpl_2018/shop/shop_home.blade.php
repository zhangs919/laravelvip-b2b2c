
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
    {!! $lrw_tag ?? '' !!}
    <meta name="is_webp" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="m_main_color" content="" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- 购物车js -->
    <!--整站改色 _start-->
    <link href="/assets/d2eace91/css/swiper/swiper.min.css" rel="stylesheet" position="1">
    <link href="/css/iconfont/iconfont.css" rel="stylesheet">
    <link href="/css/app.frontend.mobile.min.css" rel="stylesheet">
    <link href="/css/shop_header.css" rel="stylesheet">
    <link href="/css/shop_coupon.css" rel="stylesheet">
    <link href="/css/bonus_message.css" rel="stylesheet">
    <link href="/css/dianpu.css" rel="stylesheet">
    @if(shopconf('custom_style_enable_m_shop',false,$shop_info['shop']['shop_id']) == 1)
        <link rel="stylesheet" href="http://{{ config('lrw.mobile_domain') }}/css/custom/m_shop-color-style-{{ $shop_info['shop']['shop_id'] }}.css?csv=67&v={{ date('Ymd') }}"/>
    @else
        <link rel="stylesheet" href="http://{{ config('lrw.mobile_domain') }}/css/color-style.css?v=1.2" id="site_style"/>
    @endif
    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>

    {{--国家默哀日期--}}
    {!! $national_memorial_day_html ?? '' !!}
</head>
<body>
<!-- 引入头部文件 -->
{{--引入店铺头部--}}
@include('shop.partials._shop_top_box')

<div class="shop-nav clearfix">
    <ul class="nav-ul">
        <li class="current">
            <a href="{{ shop_prefix_url($shop_info['shop']['shop_id']) }}">
                <i class="iconfont">&#xe601;</i>
                <span>店铺首页</span>
            </a>
        </li>
        <li >
            <a href="{{ shop_prefix_url($shop_info['shop']['shop_id'],'mobile_shop_goods_list') }}">
                <i class="SZY-SHOP-GOODS-COUNT">0</i>
                <span>全部商品</span>
            </a>
        </li>
        <li >
            <a href="/bonus/list/{{ $shop_info['shop']['shop_id'] }}.html">
                <i class="SZY-SHOP-BONUS-COUNT">0</i>
                <span>店铺红包</span>
            </a>
        </li>
    </ul>
</div>
<!--微信分享弹出层-->
<div class="give-share-popup hide colse-bdshare-popup">
    <img src="/images/give-share-popup.png">
</div>
<!--小程序分享弹出层-->
<div class="mini-program-share-popup hide">
    <img src="/images/mini-program-share-popup.png">
</div>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<!-- -->
<div class="shops-info-layer hide">
    <div class="shops-info-con">
        <h3 class="shop-info-tiite">{{ $shop_info['shop']['shop_name'] }}</h3>

        <div class="shop-comment">
            <img src="{{ get_image_url($shop_info['credit']['credit_img']) }}" title="{{ $shop_info['credit']['credit_name'] }}" />
        </div>

        <div class="shops-rate">描述{{ $shop_info['shop']['desc_score'] }}&nbsp;&nbsp;|&nbsp;&nbsp;服务{{ $shop_info['shop']['service_score'] }}&nbsp;&nbsp;|&nbsp;&nbsp;发货{{ $shop_info['shop']['send_score'] }}</div>
    </div>
    <div class="shop-notice-con">
        <div class="shop-notice-title">
            <font></font>
            <span>商家公告</span>
            <font></font>
        </div>
        <div class="shop-notice-info">{!! $shop_info['shop']['detail_introduce'] !!}</div>
        <a href="javascript:void(0);" class="shops-close-btn"></a>
    </div>
</div>
<script type="text/javascript">
    //
</script>
<!-- -->
<!-- 内容 -->
<!--模块内容-->
<!-- #tpl_region_start -->

{!! $tplHtml !!}

<!-- #tpl_region_end -->
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
<script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script type="text/javascript">
    $().ready(function() {
        // $("body").append('<script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"><\/script>');
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
<!--购物车-->
<div class="shopcar cartbox">
    <a href="/cart.html">
        <span class="flow-cartnum SZY-CART-COUNT bg-color">0</span>
    </a>
</div>
<a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
<script type="text/javascript">
    //
</script><script type="text/javascript">
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
        <a href="{{ shop_prefix_url($shop_info['shop']['shop_id']) }}">
            <i class="shop-nav-icon"></i>
            <span>首页</span>
        </a>
    </div>
    <ul>
        <!-- -->
        @if(shopconf('m_shop_list_style', false, $shop_info['shop']['shop_id']) == 0){{--0-默认样式--}}
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
        @else{{-- 1-经典模式--}}
            <li>
                <a href="{{ shop_prefix_url($shop_info['shop']['shop_id'],'mobile_shop_goods_list') }}">
                <span>
                    <i class="shop-index"></i>
                    全部商品
                </span>
                </a>
            </li>
        @endif

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
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
<!-- 底部 _end-->
<script src="/assets/d2eace91/min/js/core.min.js"></script>
<script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
<script src="/js/app.frontend.mobile.min.js"></script>
<script src="/js/shop.js"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
<script src="/js/common.js"></script>
<script src="/assets/d2eace91/min/js/message.min.js"></script>

{{--todo 以下script是页面装修模板用到的，从页面装修数据中判断，独立放到一个地方，后面再改--}}
@include('frontend.web_mobile.modules.library.mobile_design_scripts')

<script>
    $().ready(function() {

    });
    //
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
    $(document).ready(function() {
        //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
        $(function() {
            $(window).scroll(function() {
                if ($(window).scrollTop() > 300) {
                    $("#back-to-top").removeClass('hide');
                } else {
                    $("#back-to-top").addClass('hide');
                }
            });
            //当点击跳转链接后，回到页面顶部位置
            $("#back-to-top").click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        });
    });
    //
    @if(!$webStatic){{--静态页面关闭时 显示--}}
        $.templateloading();
    @endif
    //
    $().ready(function() {
        $('body').on('click', '.add-cart', function(event) {
            var goods_id = $(this).data("goods_id");
            var image_url = $(this).data("image_url");
            var step = $(this).data("step");
            if(isNaN(step)){
                step = 1;
            }
            $.cart.add(goods_id, step, {
                is_sku: false,
                event: event,
                image_url: image_url
            });
            return false;
        });
    });
    //
    //店铺公告
    function comments_scroll() {
        var liLen = $('.shop-notice ul li').length;
        var num3 = 0;
        $('.shop-notice ul').append($('.shop-notice ul').html());
        function autoplay() {
            if (num3 > liLen) {
                num3 = 1;
                $('.shop-notice ul').css('top', 0);
            }
            $('.shop-notice ul').stop().animate({
                'top': -18 * num3
            }, 500);
            num3++;
        }
        var mytime = setInterval(autoplay, 3000)
    }
    //
    var is_opening = '';
    var SYS_FREEBUY_ENABLE = '1';
    $(document).ready(function() {
        $.get('/shop/index/info', {
            'shop_id': '{{ $shop_info['shop']['shop_id'] }}'
        }, function(result) {
            $(".SZY-SHOP-COLLENT-COUNT").html(result.data.collect_count);
            if (result.data.is_collect == null || result.data.is_collect == false) {
                $(".SZY-SHOP-IS-COLLENT").find('span').html('关注');
                $(".SZY-SHOP-IS-COLLENT").removeClass("is-collect");
            } else {
                $(".SZY-SHOP-IS-COLLENT").find('span').html('已关注');
                $(".SZY-SHOP-IS-COLLENT").addClass("is-collect");
            }
            //数量统计
            $('.SZY-SHOP-GOODS-COUNT').html(result.data.goods_count);
            $('.SZY-SHOP-BONUS-COUNT').html(result.data.bonus_count);
            //店铺公告
            /* if (result.data.shop_info.shop.detail_introduce == null || result.data.shop_info.shop.detail_introduce == '') {
                $(".SZY-SHOP-ARTICLE").html('<li><a href="javascript:void(0)">暂无公告</a></li>');
            } else {
                $(".SZY-SHOP-ARTICLE").html('<li><a href="javascript:void(0)">'+result.data.shop_info.shop.detail_introduce+'</a></li>');
                //comments_scroll();
            }
            */
            //是否正常营业
            if(! result.data.is_opening){
                if(! sessionStorage.is_opening_{{ $shop_info['shop']['shop_id'] }}){
                    is_opening = result.data;
                    $('body').append('<div class="shops-close-layer"><div class="shop-close-con"><div class="shop-close-top"><div class="shop-close-tip"><h3>本店打烊啦</h3><span>暂不发货</span></div></div><a href="javascript:void(0);" class="shop-close-btn"></a></div></div>');
                }
            }
        }, "json");
        $('body').on('click','.shop-close-btn',function(){
            $('.shops-close-layer').remove();
            sessionStorage.is_opening_{{ $shop_info['shop']['shop_id'] }} = is_opening;
        });
        $('body').on('click', '.SZY-SHOP-SHARE',function(){
            if(isWeiXin()){
                $(".give-share-popup").removeClass('hide');
                scrollheight = $(document).scrollTop();
                $("body").css("top", "-" + scrollheight + "px");
                $("body").addClass("visibly");
            }else{
                $.msg('请在微信中使用');
            }
        });
        $('body').on('click','.colse-bdshare-popup',function(){
            $(".give-share-popup").addClass('hide');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        });
        $(".SZY-SHOP-IS-COLLENT").click(function(){
            $.loading.start();
            var obj = $(this);
            var shop_id = obj.data('shop_id');
            $.collect.toggleShop(shop_id, function(callback) {
                if (callback.code == 0) {
                    if (obj.find('span').html() == "关注") {
                        obj.find('span').html("已关注");
                        obj.addClass("is-collect");
                    } else {
                        obj.find('span').html("关注");
                        obj.removeClass("is-collect");
                    }
                }
                $.loading.stop();
            }, true);
        });
        if (isWeiXin()) {
            $('.SZY-SHOP-HEADER').addClass('header-middle-freebuy');
            $('.freebuy-scan').removeClass('hide');
        }else{
            $('.SZY-SHOP-HEADER').removeClass('header-middle-freebuy');
            $('.freebuy-scan').addClass('hide');
        }
    });
    //
    $('body').on('click','.SZY-SHOP-ARTICLE',function(){
        $('.shops-info-layer').show();
    });
    $('.shops-close-btn').click(function() {
        $('.shops-info-layer').hide();
    });
    //
    var scrollheight = 0;
    var loaded = false;
    var position = 'index';
    var shop_id = '{{ $shop_info['shop']['shop_id'] }}';
    var cat_id = '';
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
        if(sessionStorage.goods_category_{{ $shop_info['shop']['shop_id'] }}){
            $('.SZY-SHOP-CATEGORY-LIST').html(sessionStorage.goods_category_{{ $shop_info['shop']['shop_id'] }});
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
                sessionStorage.goods_category_{{ $shop_info['shop']['shop_id'] }} = result.data;
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
            url: "{{ get_ws_url('7272') }}",
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
