
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
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />
    <!-- #is_wabp_end -->
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
    <link rel="stylesheet" href="/frontend/css/common.css?v=1.1"/>
    {{--header_css--}}
    @section('header_css')@show
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/frontend/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/frontend/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    {{--header_js--}}
    @section('header_js')@show

    <script src="/frontend/js/common.js?v=1.1"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>

</head>
<body class="pace-done">




<!-- 站点头部 -->

<!-- 判断url链接 -->




<!-- 引入头部文件 -->

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')@show


@if(!empty(sysconf('mall_top_ad_image')) && request()->path() == '/')
<!-- 头部广告 _start 注意：此广告只在网站首页展示 -->

<div class="top-active" style="background-color: {{ sysconf('mall_top_ad_bg_color') }};">
    <div class="top-active-wrap">
        <a href="{{ sysconf('mall_top_ad_url') }}" target="_blank">
            <img src="{{ get_image_url(sysconf('mall_top_ad_image')) }}" />
        </a>
        <a href="javascript:void(0);" title="关闭" class="top-active-close"></a>
    </div>
</div>
<!-- 头部广告 _end 注意：此广告只在网站首页展示 -->
@endif

{{--header_top--}}
@section('header_top')
    @include('layouts.partials.header_top')
@show

{{--header--}}
@section('header')
    @include('layouts.partials.header')
@show


<!-- 站点导航 -->



<!-- 内容 -->
<!--顶部topbar-->
<!-- #nav_region_start -->
<!-- #nav_region_end -->

{{--页面css/js--}}
@section('style_js')@show

<!-- 分类导航设置  _start -->
<!-- 分类导航设置  _end -->

{{--引入顶部分类box列表--}}
@section('category_box')
    @include('layouts.partials.category_box')
@show

{{--content--}}
@yield('content')


<!-- 站点底部-->




{{-- include right_sidebar --}}
@section('right_sidebar')
    @if(!@$hide_right_sidebar)
        {{--是否显示--}}
        @include('layouts.partials.right_sidebar')
    @endif
@show



{{-- include common footer --}}
@section('common_footer')
    @if(@$footer_type == 1)
        {{--short_footer--}}
        @include('layouts.partials.short_footer')
    @elseif(@$footer_type == 2)
        {{--other--}}
    @else
        {{--default common_footer--}}
        @include('layouts.partials.common_footer')
    @endif
@show





<!-- JS -->
<script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
<script src="/frontend/js/jquery.fly.min.js?v=1.1"></script>
<script src="/assets/d2eace91/js/szy.cart.js?v=1.1"></script>


{{--底部js--}}
@section('footer_js')@show


<!--[if lte IE 9]>
<script src="/frontend/js/requestAnimationFrame.js?v=1.1"></script>
<![endif]-->
<script type="text/javascript">
    // 缓载图片
    $().ready(function(){
        $.imgloading.loading();
        //图片预加载
        document.onreadystatechange = function() {
            if (document.readyState == "complete") {
                $.imgloading.setting({
                    threshold: 1000
                });
                $.imgloading.loading();
            }
        }
    });
</script>

<script>
    /* TODO 设置 Ajax LARAVEL 419 POST error */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>
</html>