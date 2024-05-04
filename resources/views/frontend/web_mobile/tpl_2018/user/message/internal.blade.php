@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link href="/css/message.css" rel="stylesheet">
@stop

@section('content')
    <div class="message-list-box">
        <header class="header-top-nav">
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">消息盒子</div>
                <div class="header-right">
                    <a class="text" href="javascript:void(0)">管理</a>
                </div>
            </div>
        </header>

        {{--引入列表--}}
        @include('user.message.partials._internal_message_list')

        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
    </div>
    <div class="mask-div"></div>
    <div class="message-info-box">
        <h4 class="message-info-title">
            <font></font>
            <span>红包到期提醒</span>
            <font></font>
        </h4>
        <div class="message-info">亲，您有一张价值11.00元的红包将在2019年05月21日过期，赶快去使用吧！[http://www.lrw.com/user/bonus.html]</div>
        <div class="message-info-close">
            <a class="close-btn">
                <i class="iconfont"></i>
            </a>
        </div>
    </div>
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
        var tablelist = null;
        $().ready(function() {
            refresh();
            tablelist = $("#table_list").tablelist();
        });
        //
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 100) {
                if ($.isFunction($.pagemore)) {
                    $.pagemore({
                        callback: function(result) {
                            refresh();
                            if ($('.message-footer .check-all').hasClass('checked')) {
                                $('.message-list li .agree-checkbox').addClass('checked');
                            }
                        }
                    });
                }
            }
        });
        //
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
        function read(id, _self) {
            $.loading.start();
            console.log(_self)
            $.get('/user/message/read', {
                id: id
            }, function(result) {
                if (result.code == 0) {
                    $.loading.stop();
                    $(_self).remove();
                    $('#message_tip_' + id).parents('.message-swiper').removeClass('message-swiper-read');
                    $('#message_tip_' + id).remove();
                } else {
                    $.msg(result.message);
                }
            }, 'json');
        }
        function del(id, _self) {
            $.loading.start();
            $.get('/user/message/delete', {
                id: id
            }, function(result) {
                if (result.code == 0) {
                    $.loading.stop();
                    $(_self).parent('div').parent('div').parent('li').remove();
                } else {
                    $.msg(result.message);
                }
            }, 'json');
        }
        $('.message-info-close').click(function() {
            close_message_info();
        });
        $('.mask-div').click(function() {
            close_message_info();
        });
        //标注为已读和删除
        function refresh() {
            var expansion = null; //是否存在展开的coupon-item
            var container = document.querySelectorAll('.message-list .message-swiper');
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
                        if (X - x > 15) { //右滑
                            event.preventDefault();
                            //this.className = "coupon-item"; //右滑收起
                            $(this).removeClass('swipeleft');
                        }
                        if (x - X > 15) { //左滑
                            event.preventDefault();
                            //this.className = "swipeleft"; //左滑展开
                            $(this).addClass('swipeleft');
                            $(this).parent('li').siblings().find('.message-swiper').removeClass('swipeleft');
                            //$(this).p.siblings().removeClass('swipeleft');
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
        // 批量删除
        $('.header .text').click(function() {
            $('.message-list-box').toggleClass('edit');
            $('.message-list').addClass('message-list-edit');
            $('.message-footer').toggleClass('hide');
            if ($('.message-list-box').hasClass('edit')) {
                $('.header-right a.text').html('完成');
            } else {
                $('.header-right a.text').html('管理');
                $('.message-list').removeClass('message-list-edit');
            }
        });
        $('body').on('click', '.message-list li .agree-checkbox', function() {
            $(this).toggleClass('checked');
        });
        // $('.message-list li .agree-checkbox').click(function(){
        //     $(this).toggleClass('checked');
        // });
        // 批量选中
        $('.message-footer .check-all').click(function() {
            $(this).toggleClass('checked');
            if ($(this).hasClass('checked')) {
                $('.message-list li .agree-checkbox').addClass('checked');
            } else {
                $('.message-list li .agree-checkbox').removeClass('checked');
            }
        });
        // 批量已读
        $("body").on("click", ".batch-read", function() {
            var ids = [];
            $('.message-list li .agree-checkbox.checked').each(function() {
                ids.push($(this).data('id'))
            });
            if (ids.length == 0) {
                $.msg("您没有选择任何待处理的数据！");
                return;
            }
            $.post('/user/message/read', {
                id: ids
            }, function(result) {
                if (result.code == 0) {
                    $.each(ids, function(i, id) {
                        $('.read[data-id="' + id + '"]').addClass('disabled');
                    });
                }
                $.msg(result.message);
            }, 'json');
        });
        // 批量删除
        $("body").on("click", ".batch-del", function() {
            var ids = [];
            $('.message-list li .agree-checkbox.checked').each(function() {
                ids.push($(this).data('id'))
            });
            console.info(ids.length);
            if (ids.length == 0) {
                $.msg("您没有选择任何待处理的数据！");
                return;
            }
            tablelist.remove({
                confirm: '您确定批量删除吗？',
                url: '/user/message/delete',
                data: {
                    id: ids
                }
            });
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
