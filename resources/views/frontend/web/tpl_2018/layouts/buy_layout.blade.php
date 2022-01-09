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
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=20180927"/>
    <link rel="stylesheet" href="/frontend/css/common.css?v=20180927"/>

    {{--header_css--}}
    @section('header_css')@show

    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/frontend/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/frontend/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
</head>
<body class="pace-done">
<div id="bg" class="bg" style="display: none;"></div>
<!-- 引入头部文件 -->

@include('layouts.partials.header_top')


{{--content--}}
@yield('content')





<!-- 引入底部文件 -->

<!-- 底部 _start-->



@include('layouts/partials/short_footer')
<!-- 底部 _end-->


</body>
{{--outside_body_script--}}
@section('outside_body_script')@show

<script>
    /* TODO 设置 Ajax LARAVEL 419 POST error */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</html>