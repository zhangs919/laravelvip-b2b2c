@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')
@stop


@section('content')


    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">积分兑换</div>
            <div class="header-right">
                <i class="search-btn iconfont">&#xe600;</i>
            </div>
        </div>
    </header>
    <div class="order-box">
        <ul class="exchange-list-top ub tabmenu-new">
            <li class="ub-f1">
                <a href="/user/integral/detail.html">积分明细</a>
            </li>
            <li class="ub-f1">
                <a href="/user/integral/order-list.html" class="active">积分兑换</a>
            </li>
        </ul>

        @include('user.integral.partials._order_list')

        <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
        <script type="text/javascript">
            //
        </script></div>
    <!--点击取消按钮弹出框-->
    <div class="mask-div" style="display: none;"></div>
    <div class="f-block-box" id="affirm_info" style="height: 0; overflow: hidden;">加载中...</div>
    <div id="search-orderList">
        <div class="user-search-header ub">
            <div class="search-left">
                <a href="javascript:void(0)" class="sb-back" title="返回"></a>
            </div>
            <div class="order-search  ub-f1">
                <form id="searchForm" name="searchForm" action="/user/integral/order-list.html" method="GET">
                    <input id='name' type="search" name="name" value="" placeholder='输入商品标题或订单号'>
                    <input id='order_status' type='hidden' value='' name='order_status'>
                    <span class="num-clear hide">
                <i class="iconfont">&#xe621;</i>
            </span>
                </form>        </div>
            <div class="search-right">
                <a href="javascript:void(0)" class="search-btn submit SZY-SEARCH-BTN" style="display: block;">搜索</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
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
    <script type="text/javascript">
        //
    </script>
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=1.1"></script>
    <script src="/js/common.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/js/placeholder.js?v=1.1"></script>
    <script src="/js/user.js?v=1.1"></script>
    <script src="/js/address.js?v=1.1"></script>
    <script src="/js/center.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/message.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/messageWS.js?v=1.1"></script>
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
        var scrollheight = 0;
        function close_choose() {
            $(".mask-div").hide();
            $('#affirm_info').hide();
            $('.pop-up-content').hide();
            $('.pop-up-content').removeAttr('style');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        }
        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                $.loading.start();
                $.ajax({
                    url: '/user/integral/edit-order.html?from=list',
                    dataType: 'json',
                    data: {
                        type: type,
                        id: id,
                    },
                    success: function(result) {
                        $("#affirm_info").html(result.data);
                        $("#affirm_info").show();
                        $(".mask-div").show();
                        $('.pop-up-content').show();
                        var h = $('.prompt-choose').height(), top = $('.prompt-choose-title').height(), bottom = $('.prompt-choose-bottom').height();
                        $('.prompt-choose-reason').height(h - top - bottom - 20 + 'px');
                        $('.prompt-choose').css('margin-top', "-" + h / 2 + "px");
                        scrollheight = $(document).scrollTop();
                        var yScroll = $(document).scrollTop() - 103;
                        $("body").css("top", "-" + scrollheight + "px");
                        $('.pop-up-content').css('margin-top', yScroll);
                        $("body").css("top", "-" + scrollheight + "px");
                        $("body").addClass("visibly");
                        $.loading.stop();
                    }
                });
            });
        });
        //滑动触发
        try {
            document.createEvent("TouchEvent");
            document.getElementById("maskdiv").addEventListener('touchmove', function(event) {
                close_choose();
            }, false);
            $('.mask-div').click(function() {
                close_choose();
            });
        } catch (e) {
            $('.mask-div').click(function() {
                close_choose();
            });
        }
        //
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
        });
        $(".SZY-SEARCH-BTN").click(function() {
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
        /**
         $().ready(function(){
        WS_AddUser({
            user_id: 'user_{{ $user_info['user_id'] ?? 0 }}',
            url: "{{ get_ws_url('4431') }}",
            type: "add_user"
        });
    });
         **/
        function currentUserId(){
            return "{{ $user_info['user_id'] ?? 0 }}";
        }
        function getIntegralName(){
            return '积分';
        }
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == currentUserId()) {
                    $.intergal({
                        point: ob.point,
                        name: getIntegralName()
                    });
                }
            }
        }
        //
        function go_laravelvip() {
            if (window.__wxjs_environment !== 'miniprogram') {
                window.location.href = 'http://m.laravelvip.com/statistics.html?product_type=shop&domain=http://{{ config('lrw.mobile_domain') }}';
            } else {
                window.location.href = 'http://{{ config('lrw.mobile_domain') }}';
            }
        }
        function GetUrlRelativePath(){
            var url = document.location.toString();
            var arrUrl = url.split("//");
            var start = arrUrl[1].indexOf("/");
            var relUrl = arrUrl[1].substring(start);
            if(relUrl.indexOf("?") != -1){
                relUrl = relUrl.split("?")[0];
            }
            if(relUrl.indexOf(".htm") != -1){
                relUrl = relUrl.split(".htm")[0];
            }
            return relUrl;
        }
        var hide_list = ['/bill','/bill.html','/user/order/bill-list','/user/scan-code/index','/user/sign-in/info'];
        if($.inArray(GetUrlRelativePath(), hide_list) == -1){
            $('.copyright').removeClass('hide');
        }
        //
    </script>
@stop
