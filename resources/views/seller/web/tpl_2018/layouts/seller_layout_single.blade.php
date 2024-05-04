<!DOCTYPE html>
<!--[if IE 8]>
<html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title.' - ' : '' }}乐融沃 · 云商城卖家中心 - 店铺</title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive">
    <meta name="baidspider" content="noarchive">
    <meta name="googlebot" content="noarchive">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=2.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=2.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=2.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=2.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=2.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=2.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=2.0"/>
    <link rel="stylesheet" href="/css/seller.css?v=2.0"/>
    <!-- -->
    <link rel="stylesheet" href="/css/mj-style.css?v=2.0"/>
    <!-- ================== END BASE CSS STYLE ================== -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/assets/d2eace91/js/html5shiv.min.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/respond.min.js?v=3.0"></script>
    <![endif]-->
    <!-- ================== BEGIN BASE JS ================== -->
    <script type="text/javascript" src="/assets/d2eace91/js/jquery.js?v=3.0"></script>
	<script src="/assets/d2eace91/js/szy.head.js"></script>
    <!-- 加载Layer插件 -->
    <script type="text/javascript" src="/assets/d2eace91/js/layer/layer.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/jquery.method.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/jquery.modal.js?v=3.0"></script>
    <!-- -->

    <script type="text/javascript" src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=3.0"></script>
	<script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/table/jquery.tablelist.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/common.js?v=3.0"></script>
    <script type="text/javascript" src="/assets/d2eace91/js/jquery.cookie.js?v=3.0"></script>
    <!-- 加载Chosen插件 END-->
    <script type="text/javascript" src="/js/common.js?v=3.0"></script>
    <!-- 加载消息监听js-->
    <script type="text/javascript" src="/assets/d2eace91/js/message/message.js?v=3.0"></script>

    <script type="text/javascript">
        // 返回顶部js
        $(window).scroll(function () {
            var position = $(window).scrollTop();
            if (position > 0) {
                $('.totop').removeClass('bounceOut').addClass('animated bounceIn');
            } else {
                $('.totop').removeClass('bounceIn').addClass('animated bounceOut');
            }
        });

    </script>
    <!-- ================== END BASE JS ================== -->
    <script type="text/javascript">
        $().ready(function () {

        })
    </script>
</head>
<body class="style-seller">
<!--中间内容-->
<div class="seller-page">
    <!--在这里调用内容-->

    {{--css style--}}
    @section('style')@show

    <div class="page">

        {{--fixed_bar--}}
        @include('layouts.partials.fixed_bar')

        {{--title_bar--}}
        @include('layouts.partials.title_bar')

        {{--explain_panel--}}
        @include('layouts.partials.explain_panel')


        {{--content--}}
        @yield('content')

        {{--script--}}
        @section('script')@show

    </div>

    {{--extra html block--}}
    @section('extra_html')@show

    {{--helper_tool--}}
    @section('helper_tool')@show

	<script src="/assets/d2eace91/min/js/core.min.js?v={{ time() }}"></script>

	<script src="/assets/d2eace91/min/js/app.common.min.js?v={{ time() }}"></script>
	<script src="/assets/d2eace91/min/js/scrollBar.min.js?v={{ time() }}"></script>

	<script src="/assets/d2eace91/js/clipboard.min.js?v={{ time() }}"></script>
	<script src="/assets/d2eace91/js/lodop/LodopAuto.js?v={{ time() }}"></script>

	{{--footer_js--}}
	@section('footer_js')@show

	<script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v={{ time() }}"></script>
	<script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v={{ time() }}"></script>
	<script src="/assets/d2eace91/min/js/message.min.js?v=223"></script>

    {{--footer script--}}
    @section('footer_script')@show


</div>
<form id="__SZY_TO_URL_FORM__" method="GET"></form>
</body>

<style>
    .fixed-bar {
        position: absolute;
        left: 0px !important;
    }
</style>

<script type="text/javascript">
    function to(url, target) {

    }

    function clearCache() {
        // 缓载
        $.loading.start();
        $.post("/site/clear-cache", {}, function (result) {
            if (result.code == 0) {
                $.msg(result.message);
            } else {
                $.msg(result.message, {
                    time: 5000
                });
            }
        }).always(function () {
            $.loading.stop();
        });
    }

    // 登录成功关闭弹出框
    $.login.success = function () {
        // 关闭并销毁登录窗口
        $.login.close(true);
    }
</script>
</html>
