<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.2"/>
    <link rel="stylesheet" href="/frontend/css/common.css?v=1.2"/>

    <link rel="stylesheet" href="/frontend/css/apply.css?v=1.2"/>

    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/frontend/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/frontend/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
    <script src="/frontend/js/common.js?v=1.2"></script>

</head>
<body style="background: #eee">
{{-- include header_top --}}
@include('layouts/partials/header_top')

{{--content--}}
@yield('content')


<!--底部信息-->

{{-- include short_footer --}}
@include('layouts/partials/short_footer')


{{--footer js--}}
@section('footer_js')@show

</body>
<script src="/assets/d2eace91/js/szy.cart.js?v=1.2"></script>
</html>
