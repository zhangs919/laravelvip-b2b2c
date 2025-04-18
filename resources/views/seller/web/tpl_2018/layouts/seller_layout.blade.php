
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - ' : '' }}{{ sysconf('site_name') }} · 云商城卖家中心 - 店铺</title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive">
    <meta name="baidspider" content="noarchive">
    <meta name="googlebot" content="noarchive">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <!-- ================== END BASE CSS STYLE ================== -->
    <!--[if lt IE 9]>
    <![endif]-->
    <!-- ================== BEGIN BASE JS ================== -->
    <!-- ================== END BASE JS ================== -->

    {{--header 内 css文件--}}
    @section('header_css')@show
    <link href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/assets/d2eace91/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link href="/assets/d2eace91/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/app.common.min.css?v=333" rel="stylesheet">
    <link href="/assets/d2eace91/css/styles.css?v=1.4" rel="stylesheet">
    <link href="/css/seller.css" rel="stylesheet">
    <link href="/css/mj-style.css" rel="stylesheet">
    @section('header_css_2')@show

    {{--自定义样式 整体改版--}}
    <link href="/css/custom.css?v={{ time() }}" rel="stylesheet">
    {{--自定义样式 整体改版--}}

    <link href="/assets/d2eace91/js/chosen/chosen.css" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>
    <script src="/assets/d2eace91/js/jquery.base64.js?v=1.1"></script>
    <script type="text/javascript">
        $().ready(function() {

            /*弹出消息*/
                    @if(!empty(session()->get('layerMsg')))
            var status = '{{ session()->get('layerMsg.status') }}';
            var msg = '{{ session()->get('layerMsg.msg') }}';
            switch (status) {
                case 'success':
                    $.msg(msg);
                    break;
                case 'error':
                    $.msg(msg, function () {
                        // 关闭后的操作
                    });
                    break;
                case 'info':
                    $.msg(msg)
                    break;
                case 'warning':
                    $.msg(msg, function () {
                        // 关闭后的操作
                    });
                    break;
            }
            // $.msg('设置成功');
            @endif
        });
    </script>
</head>
<body class="style-seller">
<!--[if IE]>
<div class="ie-warning">什么？您还在使用 Internet Explorer (IE) 浏览器？ 很遗憾，我们已不再支持IE浏览器。事实上，升级到以下支持HTML5的浏览器将获得更牛逼的操作体验：<a href="http://www.mozillaonline.com/">Firefox</a> / <a href="http://www.google.com/chrome/?hl=zh-CN">Chrome</a> / <a href="http://www.apple.com.cn/safari/">Safari</a> / <a href="http://www.operachina.com/">Opera</a>，
    赶紧升级浏览器，让操作效率提升80%-120%！
</div>
<style type="text/css">
    .style-seller .ie-warning{ position:fixed; top:0px; }
    .style-seller .seller-head{ top:38px;}
    .style-seller .seller-center,.style-seller .seller-left{ padding-top:38px}
</style>
<![endif]-->
<!--顶部导航-->
<div class="seller-head">
    <!--导航-->
    <div class="seller-nav first-sidebar">
        <div class="site-nav-content">
            <div class="seller-logo">
                <a href="/shop/shop-set/edit"  title="[&nbsp;店铺&nbsp;]&nbsp;{{ $shop->shop_name ?? '' }}">
                    <img src="{{ get_image_url(@$shop->shop_image, 'shop_image') }}" />
                </a>
            </div>
            <div class="seller-nav-list">
                <ul>
                @foreach(seller_top_menus() as $menu)
                    <!--   -->
                        <li data-param="{{ $menu['menus'] }}" class="@if(@$menu_select['action'] == explode('|',$menu['menus'])[0]) active @endif @if($menu['menus'] == 'dashboard'){{ 'activity' }}@elseif($menu['menus'] == 'account'){{ 'setting' }}@endif">
                            <a href="javascript:void(0);" target="_top" data-menus="{{ $menu['menus'] }}" onClick="toFirst(this)">
                                <i class="sidebar-icon  sidebar-icon-{{ $menu['menus'] }}"></i>
                                <em>{{ $menu['title'] }}</em>
                            </a>
                            @if(@$menu_select['action'] == explode('|',$menu['menus'])[0])
                                <b class="arrow"></b>
                            @endif
                            @if(!empty($menu['child']))
                                <div class="second-sidebar" @if($menu['menus'] == 'index')style="display: none;"@endif>
                                    <div class="second-sidebar-title">{{ $menu['title'] }}管理</div>
                                    <ul class="left-menu">

                                        @foreach($menu['child'] as $child)
                                            <li class="@if(@$menu_select['current'] == explode('|',$child['menus'])[1] || @$menu_select['current'] == get_seller_mac_by_url($child['url'])[1]){{ 'selected' }}@endif">
                                                <a href="{{ $child['url'] }}" data-menus="{{ $child['menus'] }}" onClick="to('{{ $child['url'] }}', this)" target="{{ @$child['target'] }}">{{ $child['title'] }}<i class="fa fa-caret-right icon pull-right"></i></a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <!--个人信息-->
            <div class="user-info">
					<span class="user-name">
                        {{ $seller->nickname ?? '' }}
                    </span>
                <div class="user-dropdown">
                    <div class="user-dropdown-meta">
                        <div class="name">[&nbsp;店铺&nbsp;]
                            {{ $seller->nickname ?? '' }}
                        </div>
                        <div class="">{{ $seller->mobile ?? '' }}</div>
                    </div>
                    <div class="user-dropdown-select">
                        {{--<a href="#" target="_blank">批发市场</a>--}}
                        <a  href='{{ route('pc_shop_home',['shop_id'=>$shop->shop_id ?? 0]) }}' target="_blank">前往店铺</a>
                        <a href="//{{ config('lrw.frontend_domain') }}/user/security/edit-password.html" >修改密码</a>
                        <a  onClick="clearCache()">清除缓存</a>
                        <a href="/site/logout" data-method="post" data-confirm="您确定要退出卖家中心吗？">安全退出</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容-->
<div class="seller-center">
    <!--右侧内容-->
    <div class="seller-rihgt">
        <div class="seller-page">
            <!--在这里调用内容-->
            <!-- ================== BEGIN BASE  ================== -->
            <!-- ================== END BASE  ================== -->

            {{--css style page元素同级上面--}}
            @section('style')@show

            <!--页面内容-->
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


            {{--extra html page元素同级下面--}}
            @section('extra_html')@show

            {{--helper_tool--}}
            @section('helper_tool')@show

            {{--自定义css样式--}}
            @section('style_css')@show


        </div>
    </div>
    <!--消息提醒-->
    <div id="message-box" class="notice-center">
        <div class="notice-nav">
            <a class="notice-nav-message"><span class="icon message-reminder"></span>消息<em id="message_logo" class="m-l-5" >{{ $message_logo_counts ?? 0 }}</em></a>
        </div>
        <div id="message-panel">

        </div>
    </div>

    <!-- 获取云客服一键登录地址 -->
{{--    <div id="message-box" class="notice-center">--}}
{{--        <div class="notice-nav">--}}
{{--            <a class="notice-nav-message">--}}
{{--                <span class="icon message-reminder"></span>--}}
{{--                消息<em id="message_logo" class="m-l-5" >{{ $messageCount ?? '' }}</em>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="noticePanel" style="display: none;">--}}
{{--            <div class="noticePanel-title">--}}
{{--                消息通知--}}
{{--                <span id="notice-close" class="icon-close">×</span>--}}
{{--            </div>--}}
{{--            <div id="message-panel" class="noticePanel-body"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--底部内容-->
    {{--footer--}}
    @include('layouts.partials.footer')

    <!--返回顶部-->
    <a class="totop animation hide" href="javascript:;">
        <i class="fa fa-angle-up"></i>
    </a>
    <form id="__SZY_TO_URL_FORM__" method="GET"></form>
    <!--右下角消息提醒弹窗-->
    <div id="message-container">
        <div class="message-pop-box small-message down">

            <a class="close" href="javascript:;"></a>

            <div class="message-data">
{{--                <div class="message-text-title">--}}
{{--                    新会员问卷--}}
{{--                </div>--}}

                <div class="message-text-content">
                    <span id="message-pop-text"></span>
                </div>
            </div>

            <div class="msg-operate-btn">
                <a class="message-btn" href="javascript:void(0);" target="_blank"></a>
{{--                <a id="message-pop-url" class="message-btn" href="/user/user-qs/list?type=wait_import"></a>--}}
            </div>
        </div>
    </div>

{{--    <div class="message-pop-box down">--}}
{{--        <div class="message-title">--}}
{{--            <h5>--}}
{{--                <i class="news-icon"></i>--}}
{{--                消息提醒--}}
{{--            </h5>--}}
{{--            <a class="close" href="javascript:void(0);">×</a>--}}
{{--        </div>--}}
{{--        <div class="message-info">--}}
{{--            <div class="message-icon"></div>--}}
{{--            <h5>--}}
{{--                <span id="message-pop-text"></span>--}}
{{--            </h5>--}}
{{--            <a class="btn btn-primary btn-sm message-btn" href="javascript:void(0);" target="_blank">立即处理</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- 店铺即将到期提醒弹框，宽度给600即可-->
    <div class="modal-body" style="display: none">
        <div class="f14 p-10">
            <p class="m-b-5">
                欢迎是用xxx商城系统，您的店铺服务将于
                <span class="c-red">2017-02-30</span>
                日到期/已过期，将影响您店铺的正常运营，建议尽快进行续费！
            </p>
            <p class="m-b-5">
                续费流程：前往
                <span class="c-red">
                        “店铺 -> 店铺信息 ->
                        <a href="../shop/shop-info/renew-list">续签列表</a>
                        ”
                    </span>
                进行线上提交续签申请，线下联系平台方管理员进行缴纳费用！
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
        </div>
    </div>
    <!--店铺关闭提示-->
    <div class="store-close-box hide">
        <a class="store-close">×</a>
        <span class="store-mark">店铺已关闭，请联系平台管理员</span>
    </div>
</div>
<!--
<script src="/assets/d2eace91/js/instantclick.min.js" data-no-instant></script>
<script data-no-instant>InstantClick.init('mousedown');</script>
 -->
@if(isset($shop->shop_type) && $shop->shop_type == 0 && empty($is_design))
<!-- 自营店铺 -->
<!--在线帮助客服-->
<div class="udesk-icon-con">
    <div class="udesk-label">在线客服</div>
</div>
<div class="udesk-container hide">
    <div class="udesk-content">
        <a class="udesk-close">×</a>
        <div class="udesk-con-item">
            <div class="tit" title="官方客服电话">
                <i class="tel"></i>
            </div>
            <div class="tel">{{ sysconf('mall_phone') }}</div>
        </div>
        <div class="udesk-con-item">
            <div class="tit" title="工作时间">
                <i class="time"></i>
            </div>
            <div class="time">早8:30-晚6:00</div>
        </div>
    </div>
</div>
@endif
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>

{{--<script src="/assets/d2eace91/js/jquery.lazyload.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/layer/layer.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/jquery.cookie.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/jquery.history.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/jquery.method.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/jquery.widget.js?v=2"></script>--}}
{{--<script src="/assets/d2eace91/js/jquery.modal.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/szy.page.more.js?v={{ time() }}"></script>--}}
<script src="/assets/d2eace91/min/js/core.min.js?v={{ time() }}"></script>

{{--<script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/common.js?v={{ time() }}"></script>--}}

<script src="/assets/d2eace91/min/js/app.common.min.js?v={{ time() }}"></script>
<script src="/assets/d2eace91/min/js/scrollBar.min.js?v={{ time() }}"></script>


<script src="/assets/d2eace91/js/clipboard.min.js?v={{ time() }}"></script>
<script src="/assets/d2eace91/js/lodop/LodopAuto.js?v={{ time() }}"></script>

{{--footer_js--}}
@section('footer_js')@show

<script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v={{ time() }}"></script>
<script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v={{ time() }}"></script>
<script src="/assets/d2eace91/min/js/message.min.js?v=223"></script>
{{--<script src="/assets/d2eace91/js/message/message.js?v={{ time() }}"></script>--}}
{{--<script src="/assets/d2eace91/js/message/messageWS.js?v={{ time() }}"></script>--}}



{{--<script src="/assets/d2eace91/js/html5shiv.min.js"></script>--}}
{{--<script src="/assets/d2eace91/js/respond.min.js"></script>--}}
{{--<script src="/assets/d2eace91/js/clipboard.min.js"></script>--}}
{{--<script src="/assets/d2eace91/js/lodop/LodopAuto.js"></script>--}}
{{--<script src="/assets/d2eace91/min/js/core.min.js"></script>--}}
{{--<script src="/assets/d2eace91/min/js/app.common.min.js"></script>--}}

{{--footer_js--}}
{{--@section('footer_js')@show--}}


{{--<script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js"></script>--}}
{{--<script src="/assets/d2eace91/js/chosen/jquery.chosen.js"></script>--}}
{{--<script src="/assets/d2eace91/min/js/message.min.js"></script>--}}


{{--footer script 页面script内容--}}
@section('footer_script')@show


<script>
    /*公共script start*/
    //
    $().ready(function() {
        $(".totop").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });
    //
    // 返回顶部js
    $(window).scroll(function() {
        var position = $(window).scrollTop();
        if (position >0) {
            $('.totop').removeClass('bounceOut').addClass('animated bounceIn');
        } else {
            $('.totop').removeClass('bounceIn').addClass('animated bounceOut');
        }
    });
    //
    /*在线帮助客服*/
    $('.udesk-icon-con').click(function() {
        $('.udesk-container').removeClass('hide');
    });
    $('.udesk-close').click(function() {
        $('.udesk-container').addClass('hide');
    });
    function toFirst(target){
        var url = $(target).parents("li").find(".left-menu").find("li:first").find("a").attr("href");
        $.go(url);
    }
    function to(url, target){
    }
    function clearCache(){
        // 缓载
        $.loading.start();
        $.post("/site/clear-cache", {}, function(result){
            if(result.code == 0){
                $.msg(result.message);
            }else{
                $.msg(result.message, {
                    time: 5000
                });
            }
        }).always(function(){
            $.loading.stop();
        });
    }
    // 登录成功关闭弹出框
    $.login.success = function(){
        // 关闭并销毁登录窗口
        $.login.close(true);
    }
    //
    // setInterval("auto_print()",1000);
    function auto_print(order_id)
    {
        $.ajax({
            type: "GET",
            url: "/site/auto-print",
            dataType: "json",
            data: {
                order_id: order_id
            },
            success: function(result) {
                if(result.code == 0) {
                    lodop_print_html(result.print_title, result.data, result.printer, {
                        width: result.print_spec_width,
                        height: result.print_spec_height
                    });
                }
            }
        });
    }
    //
    $(function(){
        //声音监听
        WS_AddUser({
            'user_id': 'shop_{{ $shop->shop_id ?? 0 }}',
            'url': "{{ get_ws_url('4431') }}",// 4431
            'type': "add_user"
        });
    })
    //右下角消息提醒弹窗js
    function open_message_box(data) {
        if (!data) {
            data = {};
        }
        var src = window.location.href;
        // 如果当前框架中的链接地址和弹框的链接地址一致则不弹框
        if(data.auto_refresh == 1 && data.link && src.indexOf(data.link) != -1){
            var contentWindow = window;
            if(contentWindow.tablelist){
                contentWindow.tablelist.load({
                    page: {
                        cur_page: 1
                    }
                });
            }else{
                contentWindow.location.reload();
            }
            return;
        }
        $('.message-pop-box').find('#message-pop-text').html(data.content);
        if(data.link){
            $('.message-pop-box').find('.message-btn').attr('href', data.link).show();
        }else{
            $('.message-pop-box').find('.message-btn').hide();
        }
        if(data.content || data.link){
            $('.message-pop-box').removeClass('down').addClass('up');
        }
        try {
            if(refresh_order && typeof(refresh_order) == "function") {
                refresh_order();
            }
        } catch(e) {}
    }
    $('.message-pop-box .close').click(function() {
        $('.message-pop-box').removeClass('up').addClass('down');
    });
    $('.message-btn').click(function() {
        $('.message-pop-box').removeClass('up').addClass('down');
    });
    //用户信息
    $(".admin").mouseenter(function() {
        window.focus();
        $("#admin-panel").show();
    }).mouseleave(function() {
        $("#admin-panel").hide();
    });
    //
    var clipboard = new Clipboard('.btn-copy');
    clipboard.on('success', function(e) {
        $.msg('复制成功');
    });
    clipboard.on('error', function(e) {
        $.msg('复制失败');
    });
    // 更新后台主框架消息弹窗
    function update_message() {
        // 是否重新获取数据
        if ($("#message-panel").html().length > 0) {
            // if (parseInt($("#counts_all").val()) != 0) {
            var time_step = 5; // 最小刷新间隔，单位：秒
            var this_time = new Date();
            if ((parseInt($("#counts_time").val()) + parseInt(time_step)) > parseInt(this_time.getTime() / 1000)) {
                return true;
            }
            // }
        }
        $.ajax({
            type: 'GET',
            url: '/site/update-message.html',
            data: {},
            dataType: 'json',
            success: function(result) {
                if (result.code == 0) {
                    $("#message-panel").html(result.data);
                } else if (result.code == 1) {
                } else {
                    $.msg(result.message);
                }
            }
        });
    }
    // 消息通知
    $("#message-box .notice-nav-message").click(function() {
        update_message();
        window.focus();
        $(".noticePanel").show();
    });
    $("#notice-close").click(function() {
        $(".noticePanel").hide();
    });
    //

    /*公共script end*/
</script>
</body>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
</html>
