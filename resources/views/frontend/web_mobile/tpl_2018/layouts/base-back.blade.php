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
    <meta name="is_webp" content="@if(sysconf('is_webp')){{ 'yes' }}@else{{ 'no' }}@endif" />
    <!-- #is_wabp_end -->
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="m_main_color" content="" />
    {{--<link rel="stylesheet" href="/css/common.css?v=20190422"/>--}}

    

    <link rel="stylesheet" href="/css/iconfont/iconfont.css?v=20190422"/>


    <link href="/assets/d2eace91/css/swiper/swiper.min.css" rel="stylesheet" position="1">
    <link href="/css/iconfont/iconfont.css" rel="stylesheet">
    <link href="/css/app.frontend.mobile.min.css" rel="stylesheet">

    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css" id="site_style"/>
    @endif
    
    <link href="/css/index.css" rel="stylesheet">
    <link href="/css/swiper.min.css" rel="stylesheet">
    <link href="/css/online.css" rel="stylesheet">

    {{--header_css--}}
    @section('header_css')@show
    
    
    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>

    {{--header_js--}}
    @section('header_js')@show

    

    {{--第三方登录验证代码--}}
    {!! sysconf('website_login_code') !!}

</head>
<body>
<!-- 站点 -->


{{--content--}}
@yield('content')






</body>
</html>