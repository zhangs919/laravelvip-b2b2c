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
    <link rel="stylesheet" href="/css/common.css?v=20190327"/>
    <link rel="stylesheet" href="/css/iconfont/iconfont.css?v=20190327"/>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif
    <script src="/assets/d2eace91/js/jquery.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190319"></script>
    <script src="/js/common.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20190319"></script>
    <script src="/js/swiper.jquery.min.js?v=20190319"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20190319"></script>
    <!-- 飞入购物车 -->
    <script src="/js/jquery.fly.min.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20190319"></script>

    <!-- GPS获取坐标 -->
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script src="http://webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js?v=20190319"></script>
    <script type="text/javascript">
        function geolocation() {
            if (!sessionStorage.geolocation) {
                setTimeout(function() {
                    $.geolocation();
                }, 500);
            }
        }
        geolocation();
    </script>

</head>
<body>
<!-- 内容 -->
<div id="index_content">
    <link rel="stylesheet" href="/css/bonus_message.css?v=20190327"/>
    <div class="fixed-bonus-layer">
        <img src="/images/bonus_extend_bg1.png" class="fixed-bonus-bg1">
        <img src="/images/bonus_extend_bg2.png" class="fixed-bonus-bg2">
        <div class="fixed-img-con">
            <img src="/images/bonus_extend.png" class="bonus-img">
            <div class="fixed-con">
                <div class="bonus-top">
                    <p>恭喜您获得</p>
                    <p class="shop-name">{{ $bonus_info->shop_name }}</p>
                    <p class="bonus-amount"><em>{{ $bonus_info->bonus_amount }}</em>元红包</p>
                </div>

                <a href="javascript:void(0)" class="btn-receive receive">立即领取</a>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        //立即领取
        $('body').on('click', '.receive', function() {
            var bonus_id = '{{ $bonus_info->bonus_id }}';
            $.post("activity/bonus/index.html", {
                bonus_id: bonus_id
            }, function(result) {
                if (result.code == 0) {
                    $.msg(result.message);
                } else {
                    $.msg(result.message);
                }
                $.go(result.data.url);
            }, 'json')

        });
    </script></div>
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')

<!-- 底部 _end-->
<script type="text/javascript">
    $().ready(function() {
        // 缓载图片
        $.imgloading.loading();
    });
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
</body>
</html>
