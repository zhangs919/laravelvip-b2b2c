
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
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
    <meta name="is_frontend" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!--整站改色 _start-->
    <!--整站改色 _end-->
    <link href="/assets/d2eace91/iconfont/iconfont.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">

    {{--header_css--}}
    @section('header_css')@show




    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->

    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>
</head>
<body class="pace-done">
<!-- 站点头部 -->
<!-- 内容 -->
<!-- 背景设置 -->
<!-- 引入头部文件 -->
<!-- 站点选择 -->
{{-- include header_top --}}
@include('layouts.partials.header_top')

{{-- include shop_header --}}
@section('shop_header')
    @include('layouts.partials.shop_header')
@show

{{--content--}}
@yield('content')


{{-- include right_sidebar --}}
@include('layouts.partials.right_sidebar')

{{-- include common footer --}}
@section('common_footer')
    @include('layouts.partials.common_footer')
@show

<!-- 图片缓载js -->
<!--[if lte IE 9]>
<![endif]-->
<script type="text/javascript">
    // 
</script>
<!-- 第三方流量统计 -->
<div style="display: none;"></div>
<!-- 底部 _end-->

@yield('footer_script')

</body>
</html>
