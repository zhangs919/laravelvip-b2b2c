
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <!-- ================== END BASE CSS STYLE ================== -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/assets/d2eace91/js/html5shiv.min.js"/>
    <script type="text/javascript" src="/assets/d2eace91/js/respond.min.js"/>
    <![endif]-->
    <!-- ================== BEGIN BASE JS ================== -->
    <!-- -->
    <!-- ================== END BASE JS ================== -->
    <link href="/assets/d2eace91/css/design/moduleEditTool.css?v=2.1" rel="stylesheet">
    <link href="/assets/d2eace91/css/jquery-ui.css?v=2.1" rel="stylesheet">
    <link href="/assets/d2eace91/css/swiper/swiper.min.css?v=2.1" rel="stylesheet" position="1">
    <link href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=2.1" rel="stylesheet">
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=2.1" rel="stylesheet">
    <link href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=2.1" rel="stylesheet">
    <link href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=2.1" rel="stylesheet">
    <link href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=2.1" rel="stylesheet">
    <link href="/assets/d2eace91/css/app.common.min.css?v=2.1" rel="stylesheet">

    {{--引入头部样式--}}
    @yield('header_css')

    <script src="/assets/d2eace91/js/jquery.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/jquery.base64.js?v=2.1"></script>

</head>
<body class="shop-index">

{{--内容--}}
@yield('content')


<!--底部内容-->
{{--shop_footer--}}
@include('layouts.partials.shop_footer')


@yield('footer_script')


</body>

@yield('outside_body_script')
<script type="text/javascript">
    //
</script>

</html>
