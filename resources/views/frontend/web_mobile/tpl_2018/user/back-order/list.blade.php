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
            <div class="header-middle">退款/售后</div>
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
    <ul class="bonus-nav back-nav">
        <li class="@if(!$type){{ 'selected' }}@endif tab_type">
            <a href="@if(!$type){{ 'javascript:void(0)' }}@else{{ '/user/back.html' }}@endif">退款退货</a>
        </li>
        <li class="@if($type){{ 'selected' }}@endif tab_type">
            <a href="@if($type){{ 'javascript:void(0)' }}@else{{ '/user/back.html?type=1' }}@endif">换货维修</a>
        </li>
        <li class="tab_type">
            <a href="/user/complaint.html">我的投诉</a>
        </li>
    </ul>

    <div class="order-box">
        {{--引入列表--}}
        @include('user.back-order.partials._list')
    </div>

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
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    {{--引入版权信息--}}
{{--    @include('frontend.web_mobile.modules.library.copy_right')--}}
    
    <script type="text/javascript">
        // 
    </script>
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
            // 加载时加入即时查询搜索条件
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
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
    </script>

@stop