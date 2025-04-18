
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ sysconf('site_name') }}</title>
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
    <meta name="Keywords" content="{{ sysconf('site_name') }}" />
    <meta name="Description" content="{{ sysconf('site_name') }}" />
    <meta name="is_frontend" content="yes" />
    <meta name="is_web_mobile" content="yes" />
    <meta name="is_webp" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="m_main_color" content="" />
    <link href="/assets/d2eace91/css/swiper/swiper.min.css" rel="stylesheet" position="1">
    <link href="/css/iconfont/iconfont.css" rel="stylesheet">
{{--    <link href="/css/app.frontend.mobile.min.css" rel="stylesheet">--}}
    <link href="/css/common.css" rel="stylesheet">

    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css"/>
    @endif
    <!--整站改色 _end-->
    <link href="/css/common.css" rel="stylesheet">
    <link href="/css/error.css" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>

    {{--国家默哀日期--}}
    {!! $national_memorial_day_html ?? '' !!}
</head>
<body>
<!-- 内容 -->
<div id="index_content">
    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">系统提示</div>
            <div class="header-right"></div>
        </div>
    </header>
    <div class="no-data-div">
        <div class="error-tip-img"></div>
        <dl>
            {{--手机端暂不支持帮助中心--}}
            <dt>@if($exception->getMessage() != '' && env('APP_DEBUG') === true){{ $exception->getMessage()}}@else页面未找到。@endif</dt>
        </dl>
        <a href="javascript:window.history.go(-1);" class="no-data-btn">返回上一页</a>
    </div>
    <!--底部菜单 start-->
    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')
</div>
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')
<!-- 底部 _end-->
<script type="text/javascript">
    // 
</script>
<!-- 积分提醒 -->
<!-- 消息提醒 -->
<script type="text/javascript">
    // 
</script>    <!-- 第三方流量统计 -->
<div style="display: none;"></div>
<script src="/assets/d2eace91/min/js/core.min.js"></script>
<script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
<script src="/js/app.frontend.mobile.min.js"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
<script src="/assets/d2eace91/min/js/message.min.js"></script>
<script>
    $().ready(function() {
        // 缓载图片
        $.imgloading.loading();
    });
    //
    $().ready(function () {
        WS_AddPoint({
            user_id: '{{ $user_info['user_id'] ?? 0 }}',
            url: "{{ get_ws_url('7272') }}",
            type: "add_point_set"
        });
    });

    function addPoint(ob) {
        if (ob != null && ob != 'undefined') {
            if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                $.intergal({
                    point: ob.point,
                    name: '积分'
                });
            }
        }
    }
    // 
</script>
</body>
</html>