<!DOCTYPE html><!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]--><html lang="zh-CN"><head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive">
    <meta name="baidspider" content="noarchive">
    <meta name="googlebot" content="noarchive">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- laravel app.js --}}
    {{--<script src="/js/app.js"></script>--}}

    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}">
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=1.2">
    {{--商家后台copy 后期检查样式冲突问题--}}
{{--    <link href="/assets/d2eace91/css/app.common.min.css?v=3" rel="stylesheet">--}}

    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/loading/loaders.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2">
    <!-- ================== END BASE CSS STYLE ================== -->
    <!--[if lt IE 9]>
    <script src="/assets/d2eace91/js/html5shiv.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/respond.min.js?v=1.2"></script>
    <![endif]-->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
    <!-- 加载Layer插件 -->
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script><link rel="stylesheet" href="/assets/d2eace91/js/layer/skin/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=202003261806"></script>

    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
    <!-- -->
    <script src="/assets/d2eace91/bootstrap/js/bootstrap.merge.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=1.2"></script>
    <!-- -->
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/common.js?v=1.2"></script>
    <!-- 加载Chosen插件 BEGIN-->
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2">
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.2"></script>
    <!-- 加载Chosen插件 END-->
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.2"></script>
    {{--BASE HEADER JS INCLUDE--}}
    @section('header_js')@show
    <!-- ================== END BASE JS ================== -->
    <script type="text/javascript">
        $().ready(function() {



            var theme_style = $.cookie('theme_style');
            theme_style = (theme_style == "false" || theme_style == false) ? false : true;
            if (theme_style) {
                $("body").removeClass("style-original");
            } else {
                $("body").addClass("style-original");
            };

            $(".scroll-to-top").click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });

            // 停止顶部缓载
            if(top.loading != undefined && $.isFunction(top.loading.stop)){
                top.loading.stop();
            }

            //数据采集中查看商家采集信息
            $("body").on("click", "#shopcollectinfo",function(){
                $.loading.start();
                $.post('/goods/yun/ajax-collect-info', {}, function(result) {
                    if (result.code == 0) {
                        $.open({
                            type: 1,
                            title: '采集信息', //样式类名
                            closeBtn: 1, //不显示关闭按钮
                            shadeClose: false, //开启遮罩关闭
                            area: ['600px', '300px'], //宽高
                            //scrollbar: false,
                            content: result.data
                        });

                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON");
            })

        })
    </script>
    @section('header_style')@show
</head>
<body class="pace-done {{ $body_class ?? ''}}" {!! $body_style ?? '' !!}>

    {{--css style--}}
    @section('style')@show

    {{--自定义样式 整体改版--}}
    <link href="/css/custom.css?v={{ time() }}" rel="stylesheet">
    {{--自定义样式 整体改版--}}

    {{--post 提交 错误提示信息--}}
    @if(count($errors) > 0)
        <script>
            var msg = '@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach';
            layer.msg(msg);
        </script>
    @endif
    @if(!empty(session('layerMsg')))
        <script>
            var status = '{{ session()->get('layerMsg.status') }}';
            var msg = '{{ session()->get('layerMsg.msg') }}';

            switch (status) {
                case 'success':
                    layer.msg(msg);
                    break;
                case 'error':
                    layer.msg(msg, function () {
                        // 关闭后的操作
                    });
                    break;
                case 'info':
                    layer.msg(msg)
                    break;
                case 'warning':
                    layer.msg(msg, function () {
                        // 关闭后的操作
                    });
                    break;
            }
        </script>
    @endif

    {{--alet message--}}
    @section('alert_msg')@show


    <div class="page" @if(isset($page_style))style="{{ $page_style }}"@endif>

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

    {{--自定义css样式--}}
    @section('style_css')@show

    {{--footer js--}}
    @section('footer_js')@show

    {{--footer script--}}
    @section('footer_script')@show

    {{--footer--}}
    @include('layouts.partials.footer')

</body>
    {{--outside_body_script--}}
    @yield('outside_body_script')
</html>
