<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="wap-font-scale" content="no">
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
</head>
<link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=20180702"/>
<link rel="stylesheet" href="/css/swiper.min.css?v=20180702"/>
<link rel="stylesheet" href="/css/common.css?v=20180702"/>
<link rel="stylesheet" href="/css/article.css?v=20180702"/>
<!--整站改色 _start-->
@if(sysconf('custom_style_enable_m_site') == 1)
    <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
@else
    <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
@endif
<script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
<script src="/js/common.js?v=20180813"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
<link rel="stylesheet" href="/css/news.css?v=20180702"/>
<!-- 图片缓载js -->
<script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
<script src="/js/swiper.jquery.min.js?v=20180813"></script>
<script src="/js/iscroll-probe.min.js?v=20180813"></script>
<script src="/js/index.js?v=20180813"></script>
<script src="/js/news.js?v=20180813"></script>
<body>


{{--content--}}
@yield('content')



</body>
</html>
