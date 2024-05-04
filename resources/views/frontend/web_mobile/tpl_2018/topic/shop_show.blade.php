
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    {{--<meta name="szy_tag" content="mn7axs7" />--}}
    <meta name="szy_tag" content="" />
    <meta name="is_webp" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="m_main_color" content="" />
    <!--整站改色 _start-->
    <link href="/assets/d2eace91/css/swiper/swiper.min.css" rel="stylesheet" position="1">
    <link href="/css/iconfont/iconfont.css" rel="stylesheet">
    <link href="/css/app.frontend.mobile.min.css" rel="stylesheet">
    <link href="/css/topic_activity.css" rel="stylesheet">
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif
    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>
</head>
<body>
<!-- 内容 -->
<script type="text/javascript">
	window._AMapSecurityConfig = {
		securityJsCode: "{{ sysconf('amap_js_security_code') }}",
	};
</script>
<script src="https://webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<div class="topic-box">
    <!-- #tpl_region_start -->

    @if(!empty($tplHtml))
        {!! $tplHtml !!}
    @else
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png" />
            </div>
            <dl>
                <dt>促销专场尚未装修哦~</dt>
            </dl>
        </div>
    @endif

    <!-- #tpl_region_end -->
</div>
<script type="text/javascript">
    //
</script>
<!--底部菜单 start-->
<div style="height: 48px; line-height: 48px; clear: both; "></div>
<div class="footer-nav">
    <ul>
        <li>
            <a href="/">
                <i style="background: url('/images/tab_home_normal.png'); background-size: contain;"></i>
                <span>首页</span>
            </a>
        </li>
        <li>
            <a href="/category.html">
                <i style="background: url('/images/tab_category_normal.png'); background-size: contain;"></i>
                <span>分类</span>
            </a>
        </li>
        <li>
            <a href="/cart.html" class="cartbox">
                <i style="background: url('/images/tab_cart_normal.png'); background-size: contain;">
                    <em class="cart-num SZY-CART-COUNT">0</em>
                </i>
                <span>购物车</span>
            </a>
        </li>
        <li>
            <a href="/user.html">
                <i style="background: url('/images/tab_user_normal.png'); background-size: contain;"></i>
                <span>我的</span>
            </a>
        </li>
    </ul>
</div>
<!-- 扫码设置 -->
<!-- 如果微信浏览器开启扫码功能 -->
<script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script type="text/javascript">
    //
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
<!-- 底部 _end-->
<script type="text/javascript">
    //
</script>
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')
<script src="/assets/d2eace91/min/js/core.min.js"></script>
<script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
<script src="/js/app.frontend.mobile.min.js"></script>
<script src="/js/index.js"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
<script src="/assets/d2eace91/js/geolocation/amap.js"></script>
<script>
    $(function(){
        $.imgloading.loading();
    });
    //
    $.templateloading();
    //
    //获取微信配置信息
    var url = location.href.split('#')[0];
    $(function(){
        if (isWeiXin()) {
            if ($('.SZY-SCANQRCODE-LEFT')) {
                $('.SZY-SCANQRCODE-LEFT').html('<a href="javascript:void(0)" class="SZY-SCAN-QR-CODE"><em class="top-icon"></em><span class="bottom-nav">扫码</span></a>');
            }
            if ($('.SZY-SCANQRCODE-RIGHT')) {
                $('.SZY-SCANQRCODE-RIGHT').html('<a href="javascript:void(0)" class="SZY-SCAN-QR-CODE"><em class="top-icon"></em><span class="bottom-nav">扫码</span></a>');
            }
            $.ajax({
                url: "/site/get-weixinconfig.html",
                type:"POST",
                data: {
                    url: url
                },
                dataType: 'json',
                success: function(result) {
                    if (result.code == 0) {
                        wx.config({
                            debug: false,
                            appId: result.data.appId,
                            timestamp: result.data.timestamp,
                            nonceStr: result.data.nonceStr,
                            signature: result.data.signature,
							jsApiList: result.data.jsApiList,
                            // jsApiList: [
                            //     // 所有要调用的 API 都要加到这个列表中
                            //     "onMenuShareTimeline", "onMenuShareAppMessage", "scanQRCode"]
                        });
                        wx.ready(function() {
                            // 分享给朋友
                            wx.onMenuShareAppMessage({
                                title: '{{ $topic['topic_name'] }}', // 标题
                                desc: '{{ $topic['describe'] }}', // 描述
                                imgUrl: '{{ get_image_url($topic['share_image']) }}', // 分享的图标
                                link: url,
                                fail: function(res) {
                                    alert(JSON.stringify(res));
                                }
                            });
                            // 分享到朋友圈
                            wx.onMenuShareTimeline({
                                title: '{{ $topic['topic_name'] }}', // 标题
                                desc: '{{ $topic['describe'] }}', // 描述
                                imgUrl: '{{ get_image_url($topic['share_image']) }}', // 分享的图标
                                link: url,
                                fail: function(res) {
                                    alert(JSON.stringify(res));
                                }
                            });
                            // 在这里调用 API
                            $(".SZY-SCAN-QR-CODE").click(function() {
                                if (result.errCode != 0) {
                                    $.msg("扫码功能需要去后台微信设置里填写正确的信息");
                                    return false;
                                }
                                wx.scanQRCode({
                                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                                    scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                                    success: function(res) {
                                        //alert(JSON.stringify(res));
                                        //过滤结果,非本站的二维码不可以扫描
                                        $.get('/index/information/go', {
                                            url: res.resultStr
                                        }, function(result) {
                                            if (result.code == 0) {
                                                $.go(result.data.url);
                                            } else {
                                                $.msg(result.message);
                                            }
                                        }, 'json');
                                    }
                                });
                            });
                        });
                    }
                }
            });
        } else {
            if ($('.SZY-SCANQRCODE-LEFT')) {
                $('.SZY-SCANQRCODE-LEFT').html('<a href="/category.html"><em class="top-left"></em><span class="bottom-nav">分类</span></a>');
            }
            if ($('.SZY-SCANQRCODE-RIGHT')) {
                $('.SZY-SCANQRCODE-RIGHT').html('');
            }
            $(".SZY-SCAN-QR-CODE").click(function() {
                $.msg('请在微信下使用扫码');
            });
        }
    });
    //
    $().ready(function(){
        // 缓载图片
        $.imgloading.loading();
    });
    //图片预加载
    document.onreadystatechange = function() {
        if (document.readyState == "complete") {
            $.imgloading.setting({
                threshold: 1000
            });
        }
    }
    //
</script>
</body>
</html>
