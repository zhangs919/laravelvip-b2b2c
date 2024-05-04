@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link href="/css/photoswipe.css" rel="stylesheet">
@stop

@section('content')
    <!-- -->
    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">我的评价</div>
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
    <!--评价头部-->
    <form id="searchForm" class="screen-term" method="GET">
        <input type="hidden" name="comment_content" value="0">
        <input type="hidden" name="comment_level" value="{{ $comment_level }}">
    </form>
    <div class="user-comment-type">
        <ul class="tabmenu-new">
            <li @if($comment_level == 0)class="selected"@endif>
                <!-- <em>100</em> -->
                <a href="javascript:void(0)" class="comment-level" data-value="0">全部</a>
            </li>
            <li @if($comment_level == 1)class="selected"@endif>
                <a href="javascript:void(0)" class="comment-level" data-value="1">好评</a>
            </li>
            <li @if($comment_level == 2)class="selected"@endif>
                <a href="javascript:void(0)" class="comment-level" data-value="2">中评</a>
            </li>
            <li @if($comment_level == 3)class="selected"@endif>
                <a href="javascript:void(0)" class="comment-level" data-value="3">差评</a>
            </li>
            <!--
             <li>
                <a href="">晒图</a>
            </li>
             -->
        </ul>
    </div>

    {{--引入列表--}}
    @include('user.evaluate.partials._list')

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
    <script src="/js/klass.min.js"></script>
    <script src="/js/photoswipe.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 100) {
                if ($.isFunction($.pagemore)) {
                    $.pagemore({
                        callback: function(result) {
                            // 图片预览
                            if ($("#gallery a").length > 0) {
                                var options = {};
                                $("#gallery a").photoSwipe(options);
                            }
                        }
                    });
                }
            }
        });
        //
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $('.comment-level').click(function() {
                $(this).parents('ul').find('li').removeClass('selected');
                $(this).parent('li').addClass('selected');
                $('#searchForm').find("input[name='comment_level']").val($(this).data('value'));
                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load({}, function() {
                    if ($("#gallery a").length > 0) {
                        var options = {};
                        $("#gallery a").photoSwipe(options);
                    }
                    $('html,body').scrollTop(0);
                });
            });
        });
        //
        if ($("#gallery a").length > 0) {
            var options = {};
            $("#gallery a").photoSwipe(options);
        }
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
