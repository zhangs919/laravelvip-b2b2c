
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
    {{--<script src="/assets/d2eace91/js/lodop/LodopFuncs.js?v=1.2"></script> --}}
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
    <div class="seller-nav">
        <div class="site-nav-content wrapper">
            <div class="seller-logo">
                <a href="/index" target="_blank">
                    <img src="{{ get_image_url(sysconf('seller_center_logo')) }}">
                </a>
                <h1 class="hide">卖家中心</h1>
            </div>
            <div class="seller-nav-list">
                <ul>

                @foreach(seller_top_menus() as $menu)
                    <!--   -->

                        <li data-param="{{ $menu['menus'] }}" class="@if(@$menu_select['action'] == explode('|',$menu['menus'])[0]) active @endif">
                            <a href="javascript:void(0);" target="_top" data-menus="{{ $menu['menus'] }}" onClick="toFirst(this)">
                                <em>{{ $menu['title'] }}</em>
                            </a>
                            @if(@$menu_select['action'] == explode('|',$menu['menus'])[0])
                                <b class="arrow"></b>
                            @endif
                            @if(!empty($menu['child']))
                                <div class="sub-list">
                                    <ul>

                                        @foreach($menu['child'] as $child)
                                            <li>
                                                <a href="{{ $child['url'] }}" data-menus="{{ $child['menus'] }}" onClick="to('{{ $child['url'] }}', this)" target="{{ @$child['target'] }}">{{ $child['title'] }}</a>
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
            <div class="admin">
                <a class="dropdown-toggle">
                    <div class="pic" title="[&nbsp;店铺&nbsp;]&nbsp;{{ $seller->nickname ?? '' }}">
                        <img src="{{ get_image_url(sysconf('default_user_portrait')) }}">
                    </div>
                </a>
                <ul id="admin-panel" class="dropdown-menu dropdown-list right animated fadeInUp">
                    <li class="top-dropdown-bg"></li>
                    <li class="user-title">
                        <h5>
                            <span class="user-role m-r-2">[&nbsp;店铺&nbsp;]</span>
                            <span class="user-name" title="{{ $seller->nickname ?? '' }}">

                                {{ $seller->nickname ?? '' }}

                            </span>
                        </h5>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('pc_home') }}" target="_blank">
                            <i class="fa fa-home"></i>
                            商城首页
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('user_center') }}" target="_blank">
                            <i class="fa fa-user"></i>
                            用户中心
                        </a>
                    </li>
                    <li>
                        <a href="http://{{ env('FRONTEND_DOMAIN') }}/user/security/edit-password" target="_blank">
                            <i class="fa fa-lock"></i>
                            修改密码
                        </a>
                    </li>
                    <li>
                        <a href="/site/logout" data-method="post" data-confirm="您确定要退出卖家中心吗？">
                            <i class="fa fa-sign-out"></i>
                            退出
                        </a>
                    </li>
                </ul>
            </div>
            <!--右侧菜单-->
            <div class="right-menu">
                <ul>
                    <li class="we-chat">
                        <a class="go-store dropdown-toggle" href="{{ route('pc_shop_home', ['shop_id'=>session('seller')['shop_id']]) }}" title="前往店铺" target="_blank">
                            <i></i>
                            <span>店铺</span>
                        </a>
                        <div class="we-chat-box dropdown-menu dropdown-list animated fadeInUp">
                            <div class="top-dropdown-bg"></div>
                            <h5>微信扫码访问</h5>
                            <img class="we-chat-img" src="http://images.68mall.com/15164/gqrcode/shop/C4/qrcode_1.png">
                            <div class="we-chat-btn" style="position: relative;">
                                <a class="m-r-10 btn-copy" href="#" data-clipboard-text="{{ route('mobile_shop_home', ['shop_id'=>session('seller')['shop_id']]) }}">复制页面链接</a>
                                <a class="" href="{{ route('pc_shop_home', ['shop_id'=>session('seller')['shop_id']]) }}" target="_blank">电脑上查看</a>
                            </div>
                        </div>
                    </li>

                    <li id="message-box" class="top-menu">
                        <a class="message-alert" data-toggle="dropdown" title="查看待处理事项">
                            <i></i>
                            <span>提醒</span>
                            <em id="message_logo" style="display: none">0</em>
                        </a>
                        <!-- 消息提醒 -->
                        <div id="message-panel" class="manager-menu right dropdown-menu animated fadeInDown" style="display: none;"><span class="top-dropdown-bg"></span>
                            <div class="message-title">
                                <h5>
                                    <i class="news-icon"></i>
                                    消息通知（0）
                                    <input id="counts_time" type="hidden" value="1532252602">
                                </h5>
                                <!--<a class="close" href="javascript:;"></a>-->
                            </div>
                            <div class="message-info">


                                <div class="no-data-page">
                                    <div class="icon">
                                        <i class="fa fa-bell-o"></i>
                                    </div>
                                    <h5>暂无消息内容</h5>
                                    <p>暂时没有消息提醒，稍后再来看看吧！</p>
                                </div>


                            </div>
                            <script>
                                function message_click(object_type) {
                                    $.ajax({
                                        type: 'POST',
                                        url: '/site/message-update',
                                        data: {
                                            'object_type': object_type
                                        },
                                        dataType: 'json',
                                        success: function(result) {
                                            if (result.code == 0) {
                                                if (result.data.message_logo_counts <= 0) {
                                                    $("#message_logo").hide();
                                                }
                                                $("#message_logo").html(result.data.message_logo_counts);
                                                window.location.href = result.data.url;
                                            } else {
                                                $.msg(result.message);
                                            }
                                        }
                                    });
                                }
                            </script>
                        </div>
                    </li>
                    <li>
                        <a class="wipe-cache" onclick="clearCache()" title="清除缓存">
                            <i></i>
                            <span>清缓存</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--中间内容-->
<div class="seller-center">
    <div class="wrapper">

        <!--左侧部分-->
        <div class="seller-left">
            <!--搜索-->
            <div class="search">
                <div class="search-bar">
                    <!--这里搜索-->
                    <form action="/goods/list/index" method="GET" target="_blank">
                        <input class="search-input-text" placeholder="商城商品搜索" type="text" name="keyword" />
                        <a class="search-input-btn" href="javascript:void(0);" title="点击进行搜索" onClick="$(this).parents('form').submit();")">
                        <i class="fa fa-search"></i>
                        </a>
                    </form>
                </div>
            </div>

            <!--左侧导航-->
            <ul class="left-menu">
                <!--当首页选中的时候，这块显示添加常用功能菜单按钮，点击弹出选择常用功能菜单,最多可选择10个；选择完毕后，以下面的li标签内容显示，添加按钮则隐藏-->
                <div class="add-quickmenu" style="display: none">
                    <a href="javascript:;" title="添加常用功能菜单" data-toggle="modal" data-target="#allModal">
                        <i class="fa fa-plus"></i>
                        添加常用功能菜单
                    </a>
                </div>


                @if(!empty(seller_top_menus()[@$menu_select['action']]['child']))
                @foreach(seller_top_menus()[@$menu_select['action']]['child'] as $menu)

                <li class="@if(@$menu_select['current'] == explode('|',$menu['menus'])[1] || @$menu_select['current'] == get_seller_mac_by_url($menu['url'])[1]) selected @endif">

                    <a href="{{ $menu['url'] }}" data-menus="{{ $menu['menus'] }}" onClick="to('{{ $menu['url'] }}', this)">{{ $menu['title'] }}</a>

                </li>

                @endforeach
                @endif


                <!--分割线-->
                <!--      <li class="line"></li> -->
            </ul>
        </div>

        <!--右侧内容-->
        <div class="seller-rihgt">
            <div class="seller-page">
                <div class="seller-page-bg"></div>
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

                <a class="totop animation" href="javascript:;"><i class="fa fa-angle-up"></i></a>






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
</div>



<form id="__SZY_TO_URL_FORM__" method="GET"></form>

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
        <a class="btn btn-primary btn-sm message-btn" href="/trade/order/list" target="_blank">立即处理</a>
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




</body>

<script type="text/javascript">
    function toFirst(target){
        var url = $(target).parents("li").find(".sub-list").find("li:first").find("a").attr("href");
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
    function open_message_box(message, url) {
        if (typeof message == "undefined") {
            message = "";
        }
        $('#message-pop-text').html(message.content);
        // 判断订单类型
        var go_url = '/trade/order/list.html';
        if(message.buy_type == 4){
            go_url = '/dashboard/free-buy/list.html';
        }else if(message.buy_type == 5){
            go_url = '/dashboard/reachbuy/list.html';
        }else if(message.buy_type == 6){
            go_url = '/dashboard/gift-card/order-list.html';
        }else if(message.type == 'new_take_order'){
            go_url = '/trade/order/take-list.html';
        }else {
            go_url = '/trade/order/list.html';
        }
        $('.message-pop-box').find('.message-btn').attr('href',go_url);
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
            url: '/site/update-message',
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
    $("#message-box").mouseenter(function() {
        update_message();
        window.focus();
        $("#message-panel").show();
    }).mouseleave(function() {
        $("#message-panel").hide();
    }).find(".close").click(function() {
        $("#message-panel").hide();
    });
</script>
</html>

