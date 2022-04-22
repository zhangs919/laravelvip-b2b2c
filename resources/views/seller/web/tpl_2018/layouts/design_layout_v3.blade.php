<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/rangeSlider/css/ion.rangeSlider.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/rangeSlider/css/ion.rangeSlider.skinFlat.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=20180702"/>
    <!-- ================== END BASE CSS STYLE ================== -->
    <!--[if lt IE 9]>
    <script src="/assets/d2eace91/js/html5shiv.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/respond.min.js?v=1.2"></script>
    <![endif]-->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=20180710"></script>
    <!-- 加载Layer插件 -->
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180710"></script>
    <!-- -->
    <script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=20180710"></script>
    <script src="/assets/d2eace91/bootstrap/icheck/js/icheck.js?v=20180710"></script>
    <script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/chosen/chosen.jquery.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=20180710"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20180710"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180710"></script>
    <!-- -->
    <script src="/assets/d2eace91/js/common.js?v=20180710"></script>
    <!-- 加载Chosen插件 BEGIN-->
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=20180702"/>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=20180710"></script>
    <!-- 加载Chosen插件 END-->
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180710"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180710"></script>

    {{--BASE HEADER JS INCLUDE--}}
    @yield('header_js')
    <!-- ================== END BASE JS ================== -->
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
</head>
<body class="pace-done">

    @yield('content')


    {{--footer--}}
    @include('layouts.partials.shop_footer')

</body>

@yield('outside_body_script')
</html>