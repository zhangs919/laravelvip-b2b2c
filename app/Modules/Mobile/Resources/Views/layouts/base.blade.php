<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />
    <!-- #is_wabp_end -->
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/mobile/css/common.css?v=20180428"/>

    {{--header_css--}}
    @section('header_css')@show

    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/mobile/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/mobile/css/color-style.css?v=1.2" id="site_style"/>
    @endif

    <script src="/assets/d2eace91/js/jquery.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>
    <script src="/mobile/js/common.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180528"></script>
    <!-- 飞入购物车 -->
    <script src="/mobile/js/jquery.fly.min.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180528"></script>

    {{--header_js--}}
    @section('header_js')@show




</head>
<body>
<!-- 站点 -->


{{--content--}}
@yield('content')




</body>
</html>