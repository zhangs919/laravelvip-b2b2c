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
            <div class="header-middle">@if($show_type){{ '我的红包' }}@else{{ '红包历史记录' }}@endif</div>
            <div class="header-right">
                <!-- 控制展示更多按钮 -->
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);">
                            <i class="iconfont">&#xe6cd;</i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </header>
    <ul class="bonus-nav tabmenu-new">
        <li class="selected tab_type" data-type="1">
            <a href="javascript:void(0)">
                店铺红包（
                <em class="SZY-SHOP-BONUS-COUNT">{{ $shop_bonus_count }}</em>
                ）
            </a>
        </li>
        <li class=" tab_type" data-type="0">
            <a href="javascript:void(0)">
                平台方红包（
                <em class="SZY-SYSTEM-BONUS-COUNT">{{ $system_bonus_count }}</em>
                ）
            </a>
        </li>
    </ul>

    {{--引入列表--}}
    @include('user.bonus.partials._list')




    <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
    <script type="text/javascript">
        //
    </script><div class="detail-dowm">
        <div class="operate">
            <a href="/user/bonus.html?show_type={{ $show_type ? 0 : 1 }}" class="btn-link  btn">@if($show_type){{ '我的红包' }}@else{{ '红包历史记录' }}@endif</a>
        </div>
        <div class="operate">
            <a href="/bonus-list.html" class="btn-link btn cur">红包集市</a>
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
        function refresh() {
            //侧滑显示删除按钮
            var expansion = null; //是否存在展开的coupon-item
            var container = document.querySelectorAll('.coupon-items .coupon-item');
            //alert(container.length);
            for (var i = 0; i < container.length; i++) {
                var x, y, X, Y, swipeX, swipeY;
                container[i].addEventListener('touchstart', function(event) {
                    x = event.changedTouches[0].pageX;
                    y = event.changedTouches[0].pageY;
                    swipeX = true;
                    swipeY = true;
                    if (expansion) { //判断是否展开，如果展开则收起
                        //    $(expansion).removeClass('swipeleft');
                    }
                });
                container[i].addEventListener('touchmove', function(event) {
                    X = event.changedTouches[0].pageX;
                    Y = event.changedTouches[0].pageY;
                    // 左右滑动
                    if (swipeX && Math.abs(X - x) - Math.abs(Y - y) > 0) {
                        // 阻止事件冒泡
                        event.stopPropagation();
                        if (X - x > 10) { //右滑
                            event.preventDefault();
                            //this.className = "coupon-item"; //右滑收起
                            $(this).removeClass('swipeleft');
                        }
                        if (x - X > 10) { //左滑
                            event.preventDefault();
                            $('.coupon-item').removeClass('swipeleft');
                            //this.className = "swipeleft"; //左滑展开
                            $(this).addClass('swipeleft');
                            expansion = this;
                        }
                        swipeY = false;
                    }
                    // 上下滑动
                    if (swipeY && Math.abs(X - x) - Math.abs(Y - y) < 0) {
                        swipeX = false;
                    }
                });
            }
        }
        //
        var tablelist = null;
        $().ready(function() {
            refresh();
            tablelist = $("#table_list").tablelist();
            /* 红包类型 */
            $("body").on("click", ".tab_type", function() {
                $(".tab_type").removeClass('selected');
                $(this).addClass('selected');
                tablelist.load({
                    page: {
                        cur_page: 1
                    },
                    type: $(this).data('type')
                }, refresh);
                $('html,body').scrollTop(0);
                //return false;
            });
            // 删除红包
            $("body").on("click", ".coupon-del", function() {
                var user_bonus_id = $(this).data('user-bonus-id');
                $.confirm("您确定要删除该红包吗？", function() {
                    $.post("/user/bonus/delete.html", {
                        user_bonus_id: user_bonus_id,
                        show_type: '0'
                    }, function(result) {
                        if (result.code == 0) {
                            $(".SZY-SYSTEM-BONUS-COUNT").html(result.system_bonus_count);
                            $(".SZY-SHOP-BONUS-COUNT").html(result.shop_bonus_count);
                            $.msg(result.message);
                            tablelist.load({}, refresh);
                            //$('this').parents('.coupon-item').remove();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "JSON");
                });
            })
        });
        //
        // 滚动加载数据
        $(window).on('scroll', function() {
            if (($(document).scrollTop() + $(window).height()) > ($(document).height() - 10)) {
                if ($.isFunction($.pagemore)) {
                    $.pagemore({
                        callback: function(result) {
                            refresh();
                        }
                    });
                }
            }
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
