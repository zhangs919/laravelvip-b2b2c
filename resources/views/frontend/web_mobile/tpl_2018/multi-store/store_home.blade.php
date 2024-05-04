<!DOCTYPE html>
<!--[if IE 8]>
<html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta content="telephone=no,email=no,address=no" name="format-detection"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="wap-font-scale" content="no"/>
    <meta name="Keywords" content=""/>
    <meta name="Description" content=""/>
    <meta name="is_frontend" content="yes"/>
    <meta name="is_web_mobile" content="yes"/>
    <meta name="js_version" content="2.1"/>
    <meta name="is_frontend_multi_store_app" content="yes"/>
    {!! $lrw_tag ?? '' !!}
<!-- 网站头像 -->
    <meta name="m_main_color" content=""/>
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- 购物车js -->
    <!--整站改色 _start-->
    <link href="/assets/d2eace91/css/swiper/swiper.min.css?v=2.1" rel="stylesheet" position="1">
    <link href="/css/iconfont/iconfont.css?v=2.1" rel="stylesheet">
    <link href="/css/common.css?v=2.1" rel="stylesheet">
    <link href="/css/shop_header.css?v=2.1" rel="stylesheet">
    <link href="/css/shop_coupon.css?v=2.1" rel="stylesheet">
    <link href="/css/bonus_message.css?v=2.1" rel="stylesheet">
    <link href="/css/dianpu.css?v=2.1" rel="stylesheet">
    <link href="/css/template.css?v=2.1" rel="stylesheet">
    <link rel="stylesheet" href="//{{ config('lrw.mobile_domain') }}/css/color-style.css?v=1.2" id="site_style"/>
    <link href="/css/online.css?v=2.1" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/jquery.base64.js?v=2.1"></script>
</head>
<body>
{{--引入店铺头部--}}
@include('multi-store.partials._store_top_box')

<!-- 内容 start-->
<!-- #tpl_region_start -->
{!! $tplHtml !!}
<!-- #tpl_region_end -->
<!-- 分享 -->
<script type="text/javascript">
    (function () {
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
    $().ready(function () {
        // $("body").append('<script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"><\/script>');
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
        // 20201124 @author:lvjing bug#64361-店铺红包集市，打印代码去掉，注释下列三行打印代码
        //console.log(share_url);
        //console.log("");
        //console.log("------------------------")
        //
        if (isWeiXin()) {
            $.ajax({
                url: "/site/get-weixinconfig.html",
                type: "POST",
                dataType: "json",
                data: {
                    url: url
                },
                success: function (result) {
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
        wx && wx.ready(function () {
            var share_from = $("input[name=share_from]").val();
            // 分享给朋友
            wx.onMenuShareAppMessage({
                title: '{{ $seo_title }}', // 标题
                desc: '{{ $seo_description }}', // 描述
                imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                link: share_url,
                fail: function (res) {
                    alert(JSON.stringify(res));
                },
                success: function (res) {
                    if (share_from == 'gameplay') {
                        $.post("/user/gameplay/share", {
                            gameplay_id: '',
                            order_id: ''
                        }, function (result) {
                            // window.location.reload();
                        }, 'json')
                    }
                }
            });
            // 分享到朋友圈
            wx.onMenuShareTimeline({
                title: '{{ $seo_title }}', // 标题
                desc: '{{ $seo_description }}', // 描述
                imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                link: share_url,
                fail: function (res) {
                    alert(JSON.stringify(res));
                },
                success: function (res) {
                    if (share_from == 'gameplay') {
                        $.post("/user/gameplay/share", {
                            gameplay_id: '',
                            order_id: ''
                        }, function (result) {
                            // window.location.reload();
                        }, 'json')
                    }
                }
            });
            // 小程序分享
            wx && wx.miniProgram.getEnv(function (res) {
                if (res.miniprogram) {
                    if (share_from == 'gameplay') {
                        $.post("/user/gameplay/share", {
                            gameplay_id: '',
                            order_id: ''
                        }, function (result) {
                            // window.location.reload();
                        }, 'json')
                    }
                    wx.miniProgram.postMessage({
                        data: {
                            title: '包邮到家门店',
                            imgUrl: ''
                        }
                    });
                }
            });
            // window.history.replaceState(null, document.title, url);
        });
        // 返回定位选项卡历史位置——————————————————————————START
        $('body').on('click', ".tab-loction li", function (res) {
            var parent_id = $(this).parents('.tab-loction').parent().parent().prop('id');
            $('#' + parent_id + ' .tab-loction li').each(function (n, j) {
                if ($(this).hasClass('active')) {
                    localStorage.setItem("History_tab", [parent_id, n]);
                }
            })
        });
        var history_tab = localStorage.getItem('History_tab');
        if (history_tab && history_tab != '' && typeof (history_tab) != 'undefined' && typeof (history_tab) != 'null') {
            var history_arr = history_tab.split(',');
            var history_uid = history_arr[0];
            var history_li = history_arr[1];
            //;
            var obj = $("#" + history_uid + " .tab-loction li");
            console.log(obj)
            console.log(history_uid);
            console.log(history_li);
            if (obj.eq(history_li).length > 0) {
                obj.removeClass('active');
                var floor_li = $("#" + history_uid + " div.tab-con");
                localStorage.setItem("History_tab", '')
                floor_li.hide();
                floor_li.eq(history_li).show()
                console.log(history_li)
                obj.eq(history_li).addClass('active')
            }
        }
        //——————————————————————————END————————————————————————
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
	window._AMapSecurityConfig = {
		securityJsCode: "{{ sysconf('amap_js_security_code') }}",
	};
</script>
<script src="//webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}"></script>
<script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script type="text/javascript">
    //
</script>
<!-- 内容 end -->
<!-- -->
<!-- -->
<!--门店首页弹窗用url区分，首页必须是index.html--->
<!-- -->
{{--引入底部菜单--}}
@include('frontend.web_mobile.modules.library.store_footer_menu')

<a href='#' class="yikf-form" id="yikf-kefu"
   style='display: none;background:url({{ get_image_url(sysconf('m_aliim_icon')) }}) no-repeat; background-size: cover;'> </a>
<script type="text/javascript">
    //
</script>
<!-- 隐藏菜单_start -->
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')
<!-- 隐藏菜单_end -->
<script type="text/javascript">
    //
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
<!-- 底部 _end-->
<script src="/assets/d2eace91/min/js/core.min.js?v=2.1"></script>
<script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js?v=2.1"></script>
<script src="/js/app.frontend.mobile.min.js?v=2.1"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js?v=2.1"></script>
<script src="/js/multistore_position.js?v=2.1"></script>
<script src="/js/shop.js?v=2.1"></script>
<script src="/assets/d2eace91/js/geolocation/amap.js?v=2.1"></script>

@include('frontend.web_mobile.modules.library.mobile_design_scripts')

<script>
    //
    $().ready(function () {
        //首先将#back-to-top隐藏
        //$("#back-to-top").addClass('hide');
        //当滚动条的位置处于距顶部1000像素以下时，跳转链接出现，否则消失
        $(window).scroll(function () {
            if ($(window).scrollTop() > 600) {
                $('body').find(".back-to-top").removeClass('hide');
            } else {
                $('body').find(".back-to-top").addClass('hide');
            }
        });
        //当点击跳转链接后，回到页面顶部位置
        $(".back-to-top").click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });
    //
    $(document).ready(function () {
        //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
        $(function () {
            $(window).scroll(function () {
                if ($(window).scrollTop() > 300) {
                    $("#back-to-top").removeClass('hide');
                } else {
                    $("#back-to-top").addClass('hide');
                }
            });
            //当点击跳转链接后，回到页面顶部位置
            $("#back-to-top").click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        });
    });
    //
    $.templateloading();
    //
    $().ready(function () {
        $('body').on('click', '.add-cart', function (event) {
            var goods_id = $(this).data("goods_id");
            var image_url = $(this).data("image_url");
            $.cart.add(goods_id, 1, {
                is_sku: false,
                event: event,
                image_url: image_url
            });
            return false;
        });
    });
    //
    var is_opening = '{{ $is_opening }}';
    $().ready(function () {
        $.get('/multistore/index/info', {
            store_id: '{{ $store_id }}'
        }, function (result) {
            if (result.code == 0) {
                //是否正常营业
                if (!result.data.is_opening) {
                    if (!sessionStorage.is_opening_{{ $shop_id }}_{{ $store_id }}) {
                        is_opening = result.data.is_opening;
                        close_image = result.data.close_image;
                        if (close_image == null) {
                            $('body').append('<div class="shops-close-layer"><div class="shop-close-con"><div class="shop-close-top"><div class="shop-close-tip"><h3>本店打烊啦</h3><span>暂不发货</span></div></div><a href="javascript:void(0);" class="shop-close-btn"></a></div></div>');
                        } else {
                            //门店打烊提示自定义
                            $('body').append('<div class="shops-close-layer"><div class="shop-close-custom"><div class="shop-close-img"><img src="' + close_image + '"></div><a href="javascript:void(0);" class="shop-close-btn"></a></div></div>');
                        }
                    }
                }
            }
        }, 'json');
        $('body').on('click', '.shop-close-btn', function () {
            $('.shops-close-layer').remove();
            sessionStorage.is_opening_{{ $shop_id }}_{{ $store_id }} = is_opening;
        });
        //有经纬度后在请求弹窗
        var cookie = document.cookie;
        if (cookie.length == 0) {
            $.geolocation({
                callback: function (data) {
                    //  storeSelection();
                }
            });
        } else {
            // storeSelection();
        }
    });
    /**
     * 门店弹窗
     */
    /* function storeSelection() {
         $.get("/shop/index/multi-store-selection.html",  {
             is_scan: '',
         }, function(result) {
             if (result.code == 0) {
                 $.open({
                     type: 1,
                     content: result.data
                 });
             }
         }, "JSON");
     }*/
    //
    $().ready(function () {
        var shop_id = '{{ $shop_id }}';
        var goods_id = '0';
        $.get("/site/get-yikf.html", {
            shop_id: shop_id,
            goods_id: goods_id
        }, function (result) {
            if (result.code == 0) {
                if (result.type == 1) {
                    $('#yikf-kefu').attr('href', result.yikf_url);
                    $('#yikf-kefu').css('display', 'block');
                } else {
                    $('#yikf-kefu').attr('href', "tel:" + result.tel);
                    $('#yikf-kefu').css('display', 'block');
                }
            }
        }, "JSON");
    });
    //
    $().ready(function () {
        // 缓载图片
        $.imgloading.loading();
    });
    //图片预加载
    document.onreadystatechange = function () {
        if (document.readyState == "complete") {
            $.imgloading.setting({
                threshold: 1000
            });
            $.imgloading.loading();
        }
    }
    //
</script>
</body>
</html>
