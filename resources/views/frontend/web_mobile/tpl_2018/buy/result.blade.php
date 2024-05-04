@extends('layouts.buy_layout')

{{--header_css--}}
@section('header_css')
    <link href="/css/flow.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <div class="content-main">
        <header>
            <div class="tab_nav">
                <div class="header">
                    <div class="header-left">
                        <!-- -->
                        <a class="sb-back" href="/user/order/list.html" title="返回">
                            <i class="iconfont">&#xe606;</i>
                        </a>
                    </div>
                    <div class="header-middle">支付结果</div>
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
            </div>
        </header>

        @if($order['is_pay']){{--支付成功--}}
            <div class="succcess-info payment-info-box">
                <div class="pay-info">
                    <div class="finish-note finish-note-freebuy"></div>
                    <ul class="order-info-list">
                        <li class="order-info-list-item ">
                    <span class="title-main">
                        感谢您，支付成功！
                    </span>
                        </li>
                        <li class="order-info-list-item ">
                            <span class="title-main">支付金额：</span>
                            <span class="order-info price-color">{{ $order['order_amount_format'] }}</span>
                        </li>
                    </ul>
                </div>
                <div class="pay-order-freebuy">
                    <div class="order-succeed-qrcode">
                        <div class="SZY-ORDER-QRCODE" data-order_sn="{{ $order['order_sn'] }}"></div>
                        <p>{{ $order['order_sn'] }}</p>
                        <p>{{ format_time($order['add_time']) }}</p>
                    </div>
                    <ul class="pay-order-btn clearfix">
                        <li class="button-group-item">
                            <a class="btn-link order-query" href="/user/order/list.html">查看订单</a>
                        </li>
                        <li class="button-group-item">
                            <a href="/" class="btn-link primary-handle-btn">继续购物</a>
                        </li>
                    </ul>
                </div>
            </div>

            @if($order['cash_back_amount'] > 0){{--订单返现--}}
                <div class="return-cash-box return-cash-layer">
                    <div class="return-cash-header bg-color">
                        <h2>恭喜您获得</h2>
                    </div>
                    <div class="cash-list">
                        <div class="cash-item bg-color">
                            <p class="amount">返现：<em>27.8元</em></p>
                            <p class="shop-name">吃子之心零食店</p>
                            <p class="order-num">20191220021254776970</p>
                        </div>
                    </div>
                    <p class="notice">“订单返现”已放入“我的-我的资产”</p>
                    <a href="/user/capital-account.html" class="btn bg-color">立即查看</a>
                </div>
                <script type="text/javascript">
                    //
                </script>
            @endif
        @else{{--支付失败--}}
        <div class="paymeny-result">
            <div class="result-box">
                <div class="result-icon bg-color">
                    <i class="iconfont icon-cuohao"></i>
                </div>
            </div>
            <p class="result-des">支付失败</p>
            <p class="result-price">
                应付款金额：
                <span class="price-color">{{ $order['order_amount_format'] }}</span>
            </p>
            <ul class="handle-btn clearfix">
                <li class="button-group-item">
                    <a href="/user/order/list.html?order_status=unpayed" class="btn-link order-query">点击付款</a>
                </li>
                <li class="button-group-item">
                    <a class="btn-link finish-index primary-handle-btn" href="/">返回首页</a>
                </li>
            </ul>
        </div>
        @endif

        <script type="text/javascript">
            //
        </script>
    </div>
    <!-- 发票信息弹框 -->
    <!--发票弹出层-->
    <div id="invoice_coupon_box">
        <header>
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" onclick="close_coupon_box();">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">设置发票信息</div>
                <div class="header-right"></div>
            </div>
        </header>
        <!--发票弹出层-->
        <div class="invoice-coupon">
            <div class="invoice-type m-b-0 p-b-0">
                <div class="invoice-type-mt">发票类型</div>
                <div class="invoice-type-mc">
                    <div class="tab-nav">
                        <ul>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- 普通税发票 _star -->
        </div>
    </div>
    <!-- 微信里支付宝弹出层 -->
    <div class="alipay-mark hide">
        <div class="alipay-share-con">
            <div class="box-tip">
                <div class="alipay-tip">
                    <p>点击右上角，</p>
                    <p>选择在浏览器打开</p>
                    <p>完成支付宝支付！</p>
                </div>
            </div>
            <div class="icon-logo"></div>
            <i class="alipay-star1"></i>
            <i class="alipay-star2"></i>
            <i class="alipay-star3"></i>
        </div>
        <div class="arrow-pointing"></div>
    </div>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')


    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        // 
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/checkout.js"></script>

    <script src="/assets/d2eace91/js/jquery.qrcode.min.js"></script>

    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>

        @if($order['cash_back_amount'] > 0)
        $().ready(function () {
            layer.open({
                type: 1,
                title: false,
                area: ['80%'],
                skin: 'layui-layer-return-cash',
                content: $('.return-cash-layer')
            })
        })
        @endif

        {{--支付成功展示--}}
        @if($order['is_pay'])
        $().ready(function () {
            // 订单二维码
            $.each($('.SZY-ORDER-QRCODE'), function () {
                var order_sn = $(this).data('order_sn');
                $(this).qrcode({
                    width: 140,
                    height: 140,
                    text: order_sn
                });
            });
        });
        @endif
        {{--支付成功展示--}}


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