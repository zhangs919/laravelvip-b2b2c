<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '用户中心' }}</title>
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
    <link rel="stylesheet" href="/css/common.css"/>
    <link rel="stylesheet" href="/css/iconfont/iconfont.css?v=20190215"/>
    <link rel="stylesheet" href="/css/user.css?v=20190528"/>
    <!-- ================== END BASE CSS STYLE ================== -->

    {{--header_js--}}
    @section('header_js')@show

    <script src="/assets/d2eace91/js/jquery.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/yii.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20190121"></script>
    <script src="/js/common.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20190121"></script>
    <script src="/js/user.js?v=20190121"></script>
    <script src="/js/address.js?v=20190121"></script>
    <script src="/js/center.js?v=20190121"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20190121"></script>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif


</head>
<body>


{{--content--}}
@yield('content')



{{--引入底部版权--}}
@include('frontend.web_mobile.modules.library.copy_right')

<div style="height: 54px; line-height: 54px" class="handle-spacing"></div>

</body>
</html>
