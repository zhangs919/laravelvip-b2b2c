

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh-CN">
<head>
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
    <meta name="is_frontend" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />
    <!-- #is_wabp_end -->
    <!--整站改色 _start-->
    <!--整站改色 _end-->
    <!-- 图片缓载js -->
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
    <link rel="stylesheet" href="/css/common.css?v=1.1"/>

    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.6" id="site_style"/>
    @endif


    {{--header_css--}}
    @section('header_css')@show


    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>

    {{--第三方登录验证代码--}}
    {!! sysconf('website_login_code') !!}

    {{--国家默哀日期--}}
    {!! $national_memorial_day_html ?? '' !!}
</head>
<body>
<!---商城公共头部--->
<!-- 引入头部文件 -->
<!-- 站点选择 -->

@include('layouts.partials.header_top')

{{--news header--}}
@include('layouts.partials.news_header')
{{--@include('design.templates.frontend.web.modules.library.news_index_nav')--}}


<div class="w1210">
    <!-- 当前位置 -->
    <div class="content clearfix">


        {{--content--}}
        @yield('content')


    </div>
</div>
<!-- 底部 _star-->

<!-- 底部 _start-->



@include('layouts/partials/common_footer')
<!-- 底部 _end-->


<!-- 底部 _end-->


{{--底部js--}}
@section('footer_js')@show


</body>

</html>
