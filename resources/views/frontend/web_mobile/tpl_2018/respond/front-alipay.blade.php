@extends('layouts.buy_layout')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
            <title>Document</title>
            <link rel="stylesheet" href="/css/color-style.css?v={{ time() }}">
            <link rel="stylesheet" href="/css/common.css?v={{ time() }}">
        </head>
        <body>
        <div class="wechat-layer">
            <div class="item bdr-bottom title-label">请确认支付宝支付是否完成</div>
            <a href="//{{ config('lrw.mobile_domain') }}/checkout/result.html?order_sn={{ $order['order_sn'] ?? '' }}" class="item bdr-bottom link-label">已完成支付</a>
            <a href="//{{ config('lrw.mobile_domain') }}/checkout/result.html?order_sn={{ $order['order_sn'] ?? '' }}" class="item bdr-bottom">支付遇到问题，重新支付</a>
        </div>
        <div class="mask-div" style="display: block;"></div>
        </body>
        </html>
    </div>


    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')


    <!-- 积分提醒 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>    
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        
    </div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            // 缓载图片
            $.imgloading.loading();
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