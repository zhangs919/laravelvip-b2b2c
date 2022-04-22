@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20190215"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <link rel="stylesheet" href="/css/message.css?v=201900318"/>
    <div class="message-list-box">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
            </div>
            <div class="header-middle">消息盒子</div>
            <div class="header-right">
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);"></a>
                    </div>
                </aside>
            </div>
        </div>

        {{--引入列表--}}
        @include('user.message.partials._internal_message_list')
        
        <script type="text/javascript">
            var tablelist = null;
            $().ready(function() {
                tablelist = $("#table_list").tablelist();
            });
        </script>
        <!-- 滚动js -->
        <script src="/assets/d2eace91/js/szy.page.more.js?v=20190121"></script>
        <script type="text/javascript">
            // 滚动加载数据
            $(window).on('scroll', function() {
                if ($(document).scrollTop() + $(window).height() > $(document).height() - 10) {
                    if ($.isFunction($.pagemore)) {
                        $.pagemore();
                    }
                }
            });
        </script>
    </div>
    <div class="mask-div"></div>
    <div class="message-info-box">
        <h4 class="message-info-title">
            <font></font>
            <span></span>
            <font></font>
        </h4>
        <div class="message-info">

        </div>
        <div class="message-info-close">
            <a class="close-btn">
                <i class="iconfont"></i>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        function messageInfo(id) {
            $.loading.start();
            $.get('/user/message/message-info', {
                id: id
            }, function(result) {
                if (result.code == 0) {
                    $.loading.stop();
                    $('.message-info-box').show();
                    $('.mask-div').show();
                    $('.message-info-title span').html(result.data.title);
                    $('.message-info').html(result.data.content);
                    $('#message_tip_' + id).remove();
                    scrollheight = $(document).scrollTop();
                    $("body").css("top", "-" + scrollheight + "px");
                    $("body").addClass("visibly");
                } else {
                    $.msg(result.message);
                }
            }, 'json');

        };
        function close_message_info() {
            $(".mask-div").hide();
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
            $('.message-info-box').hide();
        }
        $('.message-info-close').click(function() {
            close_message_info();
        });
        $('.mask-div').click(function() {
            close_message_info();
        });
    </script>

    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')

    <script type="text/javascript">
        $().ready(function() {
        })
    </script>
    <script src="/js/jquery.fly.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20190121"></script>

    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>	<!-- 第三方流量统计 -->
    <div style="display: none;">

    </div>
    <!-- 底部 _end-->
@stop