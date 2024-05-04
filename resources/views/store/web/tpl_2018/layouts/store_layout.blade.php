
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title.' - ' : '' }}乐融沃 · 云商城网点管理中心</title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive">
    <meta name="baidspider" content="noarchive">
    <meta name="googlebot" content="noarchive">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- 公共样式 -->
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2"/>
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- 卖家中心 -->
    <link rel="stylesheet" href="/css/store.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
    <!-- 公共脚本 -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=1.2"></script>
    <!-- 加载Layer插件 -->
    <script src="/assets/d2eace91/js/yii.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.2"></script>
    <!-- -->
    <script src="/assets/d2eace91/js/common.js?v=1.2"></script>
    <!--[if lt IE 9]>
    <script src="/assets/d2eace91/js/html5shiv.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/respond.min.js?v=1.2"></script>
    <![endif]-->
    <!-- ================== END BASE JS ================== -->

    {{--BASE HEADER JS INCLUDE--}}
    @section('header_js')@show

    @section('header_style')@show

</head>
<body class="pace-done">
<!--[if IE]>
<div class="ie-warning">什么？您还在使用 Internet Explorer (IE) 浏览器？ 很遗憾，我们已不再支持IE浏览器。事实上，升级到以下支持HTML5的浏览器将获得更牛逼的操作体验：<a href="http://www.mozillaonline.com/">Firefox</a> / <a href="http://www.google.com/chrome/?hl=zh-CN">Chrome</a> / <a href="http://www.apple.com.cn/safari/">Safari</a> / <a href="http://www.operachina.com/">Opera</a>，
    赶紧升级浏览器，让操作效率提升80%-120%！
</div>
<![endif]-->
<!--顶部内容-->
<div class="head-layout">
    <div class="store-wrapper">
        <div class="store-logo">
            <a href="/index">
                <img src="{{ get_image_url(sysconf('store_center_logo')) }}" />
            </a>
            <h1 class="hide">网点管理</h1>
        </div>
        <div class="store-nav">
            <ul>


                @foreach(store_top_menus() as $v)
                <li data-param="{{ $v['menus'] }}" @if(request()->routeIs($v['menus']))class="selected"@endif>
                    <a href="{{ $v['url'] }}">{{ $v['title'] }}</a>
                </li>
                @endforeach


            </ul>
        </div>

        <div class="store-admin">
            <dl class="admin-info">
                <dt class="admin-avatar">
                    <img src="/images/default_user_portrait.gif">
                </dt>
                <dd class="admin-permission">当前用户</dd>
                <dd class="admin-name"  title="鲜农乐一号门店管理员" >鲜农乐一号门店管理员</dd>
            </dl>

        </div>
        <!--右侧菜单-->
        <div class="right-menu">
            <ul>
                <li>
                    <a class="go-store" href='http://{{ env('FRONTEND_DOMAIN') }}' title="前往首页" target="_blank">
                        <i></i>
                        <span>首页</span>
                    </a>
                </li>
                <li>
                    <a id="clear-cache" class="wipe-cache" title="清除缓存">
                        <i></i>
                        <span>清缓存</span>
                    </a>
                </li>
                <li>
                    <a class="edit-pwd" href="javascript:void(0);" title="修改密码">
                        <i></i>
                        <span>修改密码</span>
                    </a>
                </li>
                <li>
                    <a class="login-out" href="/site/logout" data-method="post" data-confirm="您确定要退出系统吗？" title="安全退出">
                        <i></i>
                        <span>退出</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="main-content">

    {{--css style--}}
    @section('style')@show

    <div class="page">
        <!--当前位置-->
        <div class="path">
            <i class="fa fa-desktop"></i>
            <a href="javascript:;">网点管理中心</a>
            <i class="fa fa-angle-right"></i>
            <a href="javascript:;">网点商品库存</a>
        </div>

        {{--fixed_bar--}}
        @include('layouts.partials.fixed_bar')

        {{--explain_panel--}}
        @include('layouts.partials.explain_panel')

        {{--content--}}
        @yield('content')

        {{--script--}}
        @section('script')@show

    </div>

    {{--extra html block--}}
    @section('extra_html')@show

    {{--footer script--}}
    @section('footer_script')@show



</div>


<!--底部内容-->
{{--footer--}}
@include('layouts.partials.footer')


<script type="text/javascript">
    $().ready(function() {
        //$(".edit-table ul").mCustomScrollbar();

        $("#clear-cache").click(function(){
            $.loading.start();
            $.post('/site/clear-cache', {}, function(data) {
                $.loading.stop();
                $.msg(data.message);
            }, 'json');
        });



        $(".totop").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    })
</script>
<a class="totop animation" href="javascript:;">
    <i class="fa fa-angle-up"></i>
</a>
<!--右下角消息提醒弹窗-->
<div class="message-pop-box down">
    <div class="message-title">
        <h5>
            <i class="news-icon"></i>
            消息提醒
        </h5>
        <a class="close" href="javascript:;">×</a>
    </div>
    <div class="message-info">
        <div class="message-icon"></div>
        <h5>
            <span id="message-pop-text"></span>
        </h5>
        <a class="btn btn-primary btn-sm message-btn" href="" target="_blank">立即处理</a>
    </div>
</div>
</body>
<!-- 加载消息监听js-->
<script src="/assets/d2eace91/js/message/message.js?v=1.2"></script>
<script src="/assets/d2eace91/js/message/messageWS.js?v=1.2"></script>
<script type="text/javascript">

    WS_AddUser({
        'user_id': 'store_4',
        {{--'url': "ws://{{ config('lrw.push_domain') }}:8181",--}}
        'url': "{{ get_ws_url('8181') }}",
        'type': "add_user"
    });

    //右下角消息提醒弹窗js
    function open_message_box(message,href) {
        if (typeof message == "undefined") {
            message = "";
        }
        $('#message-pop-text').html(message.content);
        $(".message-btn").attr("href",href);
        $('.message-pop-box').removeClass('down').addClass('up');

        try {
            if(refresh_order&&typeof(refresh_order)=="function") {
                refresh_order();
            }
        } catch(e) {}

    }
    $('.message-pop-box .close').click(function() {
        $('.message-pop-box').removeClass('up').addClass('down');
    });
    //用户信息
    $(".admin").mouseenter(function() {
        window.focus();
        $("#admin-panel").show();
    }).mouseleave(function() {
        $("#admin-panel").hide();
    });

    $("body").on("click", ".edit-pwd", function() {
        $.loading.start();
        $.open({
            // 标题
            title: "修改密码",
            width: "450px",
            // ajax加载的设置
            ajax: {
                url: '/site/edit-password',
            },
        }).always(function(){
            $.loading.stop();
        });
    });
</script>
</html>