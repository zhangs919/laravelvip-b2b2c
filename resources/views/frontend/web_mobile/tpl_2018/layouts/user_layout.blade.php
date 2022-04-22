<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>{{ $seo_title ?? '用户中心' }}</title>
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="{{ $seo_keywords ?? '用户中心' }}" />
    <meta name="Description" content="{{ $seo_description ?? '用户中心' }}" />

    <meta name="is_webp" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/common.css"/>
    <link rel="stylesheet" href="/css/iconfont/iconfont.css?v=20190215"/>

    {{--header_css--}}
    @section('header_css')@show
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
    <!-- GPS获取坐标 -->
    <script src="http://webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js?v=20190121"></script>
    <script type="text/javascript">
        function geolocation() {
            if (!sessionStorage.geolocation) {
                setTimeout(function() {
                    $.geolocation();
                }, 500);
            }
        }
        geolocation();
    </script>

</head>
<body>


{{--content--}}
@yield('content')


</body>
</html>
