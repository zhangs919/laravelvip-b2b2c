@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
@stop


@section('content')

    <header class="header-top-nav fixed-header">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">关注店铺（{{ $shop_collect_count }}）</div>
            <div class="header-right">
                <a class="shop-edit-btn text" href="javascript:void(0);">编辑</a>
            </div>
        </div>
    </header>
    <div class="content-info"></div>
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
    {{--@include('frontend.web_mobile.modules.library.copy_right')--}}
    
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
        $('.tabmenu ul li a').click(function() {
            $(this).parents('li').addClass('cur').siblings().removeClass('cur');
        });
        $(document).ready(function() {
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/user/collect/shop?tab=all_shop',
                dataType: 'json',
                success: function(result) {
                    $.loading.stop();
                    $(".content-info").html(result.data);
                }
            });
        })
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