
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh-CN">
<head>
    <title>{{ $seo_title ?? '用户中心' }}</title>
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
    <!-- ================== END BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=20180428"/>
    <link rel="stylesheet" href="/css/common.css?v=20180428"/>
    <link rel="stylesheet" href="/css/user.css?v=20180428"/>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->

    {{--header_css--}}
    @section('header_css')@show

    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>

    {{--header_js--}}
    @section('header_js')@show

    {{--国家默哀日期--}}
    {!! $national_memorial_day_html ?? '' !!}
</head>
<body>
<!-- 引入头部文件 -->
<!-- 引入头部文件 -->
<!-- 站点选择 -->
{{--header top 网站公共头部top--}}
@include('layouts.partials.header_top')


{{--user_nav 用户中心顶部导航栏--}}
@include('user.partials.user_nav')

<div id="content">
    <div class="content w1210 clearfix">
        {{--左侧导航菜单--}}
        @include('user.partials.user_left_menu')

        {{--content--}}
        @yield('content')

    </div>
</div>

<!-- 引入底部文件 -->
@include('layouts.partials.short_footer')



{{--底部js--}}
@section('footer_js')@show

<script type="text/javascript">
    {{--$().ready(function() {--}}

        {{--/*弹出消息*/--}}
        {{--@if(!empty(session('layerMsg')))--}}
        {{--var status = '{{ session()->get('layerMsg.status') }}';--}}
        {{--var msg = '{{ session()->get('layerMsg.msg') }}';--}}
        {{--switch (status) {--}}
            {{--case 'success':--}}
                {{--$.msg(msg);--}}
                {{--break;--}}
            {{--case 'error':--}}
                {{--$.msg(msg, function () {--}}
                    {{--// 关闭后的操作--}}
                {{--});--}}
                {{--break;--}}
            {{--case 'info':--}}
                {{--$.msg(msg)--}}
                {{--break;--}}
            {{--case 'warning':--}}
                {{--$.msg(msg, function () {--}}
                    {{--// 关闭后的操作--}}
                {{--});--}}
                {{--break;--}}
        {{--}--}}
        {{--// $.msg('设置成功');--}}
        {{--@endif--}}
    {{--})--}}
</script>
{{--<script src="/js/jquery.fly.min.js?v=20180528"></script>--}}
{{--<script src="/assets/d2eace91/js/szy.cart.js?v=20180528"></script>--}}
</body>
</html>