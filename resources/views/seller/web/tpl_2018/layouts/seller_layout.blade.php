
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title.' - ' : '' }}乐融沃 · 云商城卖家中心 - 店铺</title>
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
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2"/>
    <link rel="stylesheet" href="/seller/css/seller.css?v=1.2"/>
    <!-- -->
    <link rel="stylesheet" href="/seller/css/mj-style.css?v=1.2"/>
    <!-- ================== END BASE CSS STYLE ================== -->
    <!--[if lt IE 9]>
    <script src="/assets/d2eace91/js/html5shiv.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/respond.min.js?v=1.2"></script>
    <![endif]-->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
    <!-- 加载Layer插件 -->
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
    <!-- -->
    <script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/common.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/clipboard.min.js?v=1.2"></script>
    <!-- 加载Chosen插件 END-->
    <script src="/seller/js/common.js?v=1.2"></script>
    {{--todo 暂时注释--}}
    <script src="/assets/d2eace91/js/lodop/LodopFuncs.js?v=1.2"></script>
    <script type="text/javascript">
        // 返回顶部js
        $(window).scroll(function() {
            var position = $(window).scrollTop();
            if (position >0) {
                $('.totop').removeClass('bounceOut').addClass('animated bounceIn');
            } else {
                $('.totop').removeClass('bounceIn').addClass('animated bounceOut');
            }
        });

    </script>
    <!-- ================== END BASE JS ================== -->
    <script type="text/javascript">
        $().ready(function() {

            /*弹出消息*/
            @if(!empty(session('layerMsg')))
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

            $(".totop").click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        });
    </script>

    {{--BASE HEADER JS INCLUDE--}}
    @section('header_js')@show

    @section('header_style')@show

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

{{--post 提交 错误提示信息--}}
{{--@if(count($errors) > 0)--}}
    {{--<script>--}}
        {{--var msg = '@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach';--}}
        {{--layer.msg(msg);--}}
    {{--</script>--}}
{{--@endif--}}
@if(!empty(session('layerMsg')))
    <script>
        {{--var status = '{{ session()->get('layerMsg.status') }}';--}}
        {{--var msg = '{{ session()->get('layerMsg.msg') }}';--}}

        {{--switch (status) {--}}
            {{--case 'success':--}}
                {{--layer.msg(msg);--}}
                {{--break;--}}
            {{--case 'error':--}}
                {{--layer.msg(msg, function () {--}}
                    {{--// 关闭后的操作--}}
                {{--});--}}
                {{--break;--}}
            {{--case 'info':--}}
                {{--layer.msg(msg)--}}
                {{--break;--}}
            {{--case 'warning':--}}
                {{--layer.msg(msg, function () {--}}
                    {{--// 关闭后的操作--}}
                {{--});--}}
                {{--break;--}}
        {{--}--}}
    </script>
@endif

<!--顶部导航-->
<div class="seller-head">
    <!--导航-->
    <div class="seller-nav first-sidebar">
        <div class="site-nav-content">
            <div class="seller-logo">
                <a href="/shop/shop-set/edit"  title="[&nbsp;店铺&nbsp;]&nbsp;{{ $shop_info->shop_name ?? '' }}">
                    <img src="{{ get_image_url($shop_info->shop_image) ?? '' }}" />
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
                                            <li class="@if($menu_select['current'] == explode('|',$child['menus'])[1] || @$menu_select['current'] == get_seller_mac_by_url($child['url'])[1]){{ 'selected' }}@endif">
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

                        <a  href='{{ route('pc_home') }}' target="_blank">前往店铺</a> <a href="http://{{ env('FRONTEND_DOMAIN') }}/user/security/edit-password.html" >修改密码</a> <a  onClick="clearCache()">清除缓存</a> <a href="/site/logout.html" data-method="post" data-confirm="您确定要退出卖家中心吗？">安全退出</a> </div>
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

            {{--footer script--}}
            @section('footer_script')@show



        </div>




    </div>
    <!--消息提醒-->
    <!-- 获取翼客服一键登录地址 -->

    <div id="message-box" class="notice-center">
        <div class="notice-nav">
            <a class="notice-nav-service" href="https://kf.yunmall.68mall.com/admin/login/witchAccount.html?url=UmIEawE2AjRQOFUfCGpQN1MRBGwDUFEtBC9SJFF6BHBcTVQVUG4HJ1tsAXFcJwZLBzdTKQFVUDsBNQZMBTVSB1JGBH0BKwI%2FUHdVdAhxUChTIgRiAz1RZQR%2BUiJRcwRmXH1UC1BqBzBbMwE0" target='_blank'><span class="icon customer-service"></span>客服消息</a><a class="notice-nav-message"><span class="icon message-reminder"></span>消息<em id="message_logo" class="m-l-5" >1</em></a>
        </div>
        <div class="noticePanel" style="display: none;">
            <div class="noticePanel-title">消息通知<span id="notice-close" class="icon-close">×</span></div>
            <div id="message-panel" class="noticePanel-body">

            </div>
        </div>
    </div>

    <!--底部内容-->
    {{--footer--}}
    @include('layouts.partials.footer')

    <!--返回顶部-->
    <a class="totop animation" href="javascript:;">
        <i class="fa fa-angle-up"></i>
    </a>

    <form id="__SZY_TO_URL_FORM__" method="GET"></form>

    <!--右下角消息提醒弹窗-->
    <div class="message-pop-box down">
        <div class="message-title">
            <h5>
                <i class="news-icon"></i>
                消息提醒
            </h5>
            <a class="close" href="javascript:void(0);">×</a>
        </div>
        <div class="message-info">
            <div class="message-icon"></div>
            <h5>
                <span id="message-pop-text"></span>
            </h5>
            <a class="btn btn-primary btn-sm message-btn" href="javascript:void(0);" target="_blank">立即处理</a>
        </div>
    </div>
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
</body>

<script type="text/javascript">
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
</script>

<script type="text/javascript">
    // setInterval("auto_print()",10000);
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
                if(result.code == 0)
                {
                    lodop_print_html(result.print_title, result.data,result.printer);
                }
            }
        });
    }
</script>

<!-- 加载消息监听js-->
<script src="/assets/d2eace91/js/message/message.js?v=20180710"></script>
<script src="/assets/d2eace91/js/message/messageWS.js?v=20180710"></script>
<script type="text/javascript">

    /*todo 暂时注释*/
    {{--WS_AddUser({--}}
        {{--'user_id': 'shop_2',--}}
        {{--'url': "ws://{{ env('PUSH_DOMAIN') }}:7272",--}}
        {{--'type': "add_user"--}}
    {{--});--}}
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
</script>
<script type="text/javascript">
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
</script>

</html>

