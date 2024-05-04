@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
@stop

@section('content')
    <header>
        <div class="tab_nav">
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">退款/售后</div>
                <div class="header-right">
                    <i class="search-btn iconfont">&#xe600;</i>
                </div>
            </div>
        </div>
    </header>
    <ul class="bonus-nav back-nav">
        <li class="tab_type">
            <a href="/user/back.html">退款退货</a>
        </li>
        <li class="tab_type">
            <a href="/user/back.html?type=1">换货维修</a>
        </li>
        <li class="selected tab_type">
            <a href="javascript:void(0)">我的投诉</a>
        </li>
    </ul>
    <div id="search-orderList">
        <div class="user-search-header ub">
            <div class="search-left">
                <a href="javascript:void(0)" class="sb-back" title="返回"></a>
            </div>
            <div class="order-search ub-f1">
                <form id="searchForm" name="searchForm" action="/user/complaint.html" method="GET">
                    <input id='order_id' type="search" name="order_id" placeholder='输入订单编号'>
                    <span class="num-clear hide">
                <i class="iconfont">&#xe621;</i>
            </span>
                </form>        </div>
            <div class="search-right">
                <a href="javascript:void(0)" class="clear_input submit" id="searchFormSubmit" style="display: block;" type="submit">搜索</a>
            </div>
            <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
            <script type="text/javascript">
                // 
            </script>    </div>
    </div>

    <div class="order-box">
        {{--引入列表--}}
        @include('user.complaint.partials._list')
    </div>

    <!--底部菜单 start-->
    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')
    
    <script type="text/javascript">
        // 
    </script>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        // 
    </script>    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    {{--引入版权信息--}}
{{--    @include('frontend.web_mobile.modules.library.copy_right')--}}
    
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function(){
            //首先将#back-to-top隐藏
            //$("#back-to-top").addClass('hide');
            //当滚动条的位置处于距顶部1000像素以下时，跳转链接出现，否则消失
            $(function ()
            {
                $(window).scroll(function()
                {
                    if ($(window).scrollTop()>600)
                    {
                        $('body').find(".back-to-top").removeClass('hide');
                    }
                    else
                    {
                        $('body').find(".back-to-top").addClass('hide');
                    }
                });
                //当点击跳转链接后，回到页面顶部位置
                $(".back-to-top").click(function()
                {
                    $('body,html').animate(
                        {
                            scrollTop:0
                        }
                        ,600);
                    return false;
                });
            });
        });
        // 
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 100) {
                if ($.isFunction($.pagemore)) {
                    $.pagemore();
                }
            }
        });
        // 
        var tablelist = null;
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
        });
        $("#searchFormSubmit").click(function() {
            $("#searchForm").submit();
        });
        $('.search-btn').click(function() {
            $('#search-orderList').addClass("show");
            $('#order-box').hide();
            $("input[name='keyword']").focus();
        });
        $('.sb-back').click(function() {
            $('#search-orderList').removeClass('show');
            $('#order-box').show();
            $("input[name='keyword']").blur();
        });
        $('.colse-search-btn').click(function() {
            $('#search-orderList').removeClass('show');
            $('#order-box').show();
            $("input[name='keyword']").blur();
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
    
@stop