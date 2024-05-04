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
                        <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                            <i class="iconfont">&#xe606;</i>
                        </a>
                    </div>
                    <div class="header-middle">结算页面</div>
                    <div class="h-right"></div>
                </div>
            </div>
        </header>
        <div class="payment">

        @if($merge_pay)
            <!-- 合并付款 start -->
            <div class="payment-adjust-box">
                <div class="title title-line clearfix">
                    <h2>合并付款订单{{ count($order_list) }}笔</h2>
                    <span class="order">
        总额：
        <em class="color">￥{{ $money_pay }}</em>
    </span>
                </div>
                <div class="payment-order-info">
                    <ul>
                    @foreach($order_list as $item)
                        <!--点击选中添加selected样式-->
                        <li class="bdr-bottom">
                            <div class="list-wrap ub">
                                <a class="ub-f1">
                                    <span>订单号：{{ $item['order_sn'] }}</span>
                                    <span>购买时间：{{ $item['add_time_format'] }}</span>
                                </a>
                                <span class="fr color">{{ $item['money_paid_format'] }}</span>
                            </div>
                            <div class="detail-table">
                                <dl class="ub">
                                    <dt>配送时间：</dt>
                                    <dd class="ub-f1">{{ $item['best_time'] }}</dd>
                                </dl>
                                <dl class="ub">
                                    <dt>收货信息：</dt>
                                    <dd class="ub-f1">
                                        <span class="name">{{ $item['consignee'] }}</span>
                                        <span class="tel">{{ $item['tel'] }}</span>
                                        <span class="address">{{ $item['address'] }} </span>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- 合并付款 end -->
                <div class="pay-type-box">
                    <div class="pay-type-content">
                        <!--支付详情-->
                        <!--支付详情end-->

                    @if($balance_enable){{--todo --}}
                    <!-- 余额支付 -->
                        <div class="other-pay-box" id="pay_balance">
                            <div class="hd">
                                <div class="other-pay">
                                    <div class="other-pay-l">账户余额<span>共&nbsp;<em
                                                    class="price-color SZY-USER-BALANCE">￥{{ $user_info['balance'] }}</em></span><span
                                                class="SZY-BALANCE-INFO" style=" display:none">,使用&nbsp;<em
                                                    class="price-color"></em></span></div>
                                    <input type="checkbox" class="other-pay-choose" id="balance_enable"/>
                                    <label for="balance_enable"></label>
                                </div>
                            </div>
                            <input type="text" id="balance" class="tc-text SZY-ORDER-BALANCE" value=""
                                   style="display:none"/>
                        </div>
                        <!--余额支付关闭状态 不显示-->
                        <div class="surplus-pay" id="balance_money_pay">
                            剩余应付金额
                            <em class="SZY-ORDER-MONEY-PAY price-color">
                                ￥{{ $money_pay }}
                            </em>
                            请选择以下支付方式支付
                        </div>
                    @endif

                    <!--支付方式-->
                        <!-- 银行支付方式调用 -->
                        <div class="pay-all" id="pay_bank">
                            <ul class="payment-tab" id="paylist">

                                @foreach($pay_list as $pay_info)
                                    <li class="{{ $pay_info['code'] }}" @if($pay_info['disabled'] == 1)style="display: none;" @endif>
                                        <i class="iconfont"></i>
                                        <span>{{ $pay_info['name'] }}</span>
                                        <em>
                                            <s></s>
                                            加价
                                        </em>
                                        <input type="radio" id="pac_code_{{ $pay_info['id'] }}" name="pay_code"
                                               class="pay-code pay-way-checkbox"
                                               value="{{ $pay_info['code'] }}" @if($pay_info['checked'] == 'checked'){{ 'checked' }}@endif>
                                        <div class="check-div">
                                            <label></label>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                            <script type="text/javascript">
                                //
                            </script>
                        </div>
                    </div>
                    <input type="hidden" id="payment_key" value="{{ $key }}">
                    <script type="text/javascript">
                        //
                    </script>
                    <div class="pay-again-bottom">
                        <a href="javascript:void(0);" class="submit-btn gopay pay-again-btn"
                           data-order-id="{{ $order_id }}">立即付款</a>
                    </div>
                </div>
        @else
            <div class="payment-con">
                <div class="payment-msg">
                    <h3>最后一步，请尽快付款！</h3>
                    <p>订单号：{{ $order_sn }}</p>
                    <input type="hidden" id="order_id" value="{{ $order_id }}"/>
                    <p>应付金额：<em>￥{{ $money_pay }}</em></p>
                </div>
            </div>
            <div class="pay-type-box">
                <div class="pay-type-content">
                    <!--支付详情-->
                    <!--支付详情end-->

                @if($balance_enable){{--todo --}}
                <!-- 余额支付 -->
                    <div class="other-pay-box" id="pay_balance">
                        <div class="hd">
                            <div class="other-pay">
                                <div class="other-pay-l">账户余额<span>共&nbsp;<em
                                                class="price-color SZY-USER-BALANCE">￥{{ $user_info['balance'] }}</em></span><span
                                            class="SZY-BALANCE-INFO" style=" display:none">,使用&nbsp;<em
                                                class="price-color"></em></span></div>
                                <input type="checkbox" class="other-pay-choose" id="balance_enable"/>
                                <label for="balance_enable"></label>
                            </div>
                        </div>
                        <input type="text" id="balance" class="tc-text SZY-ORDER-BALANCE" value=""
                               style="display:none"/>
                    </div>
                    <!--余额支付关闭状态 不显示-->
                    <div class="surplus-pay" id="balance_money_pay">
                        剩余应付金额
                        <em class="SZY-ORDER-MONEY-PAY price-color">
                            ￥{{ $money_pay }}
                        </em>
                        请选择以下支付方式支付
                    </div>
                @endif

                <!--支付方式-->
                    <!-- 银行支付方式调用 -->
                    <div class="pay-all" id="pay_bank">
                        <ul class="payment-tab" id="paylist">

                            @foreach($pay_list as $pay_info)
                                <li class="{{ $pay_info['code'] }}" @if($pay_info['disabled'] == 1)style="display: none;" @endif>
                                    <i class="iconfont"></i>
                                    <span>{{ $pay_info['name'] }}</span>
                                    <em>
                                        <s></s>
                                        加价
                                    </em>
                                    <input type="radio" id="pac_code_{{ $pay_info['id'] }}" name="pay_code"
                                           class="pay-code pay-way-checkbox"
                                           value="{{ $pay_info['code'] }}" @if($pay_info['checked'] == 'checked'){{ 'checked' }}@endif>
                                    <div class="check-div">
                                        <label></label>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                        <script type="text/javascript">
                            //
                        </script>
                    </div>
                </div>
                <input type="hidden" id="payment_key" value="{{ $key }}">
                <script type="text/javascript">
                    //
                </script>
                <div class="pay-again-bottom">
                    <a href="javascript:void(0);" class="submit-btn gopay pay-again-btn"
                       data-order-id="{{ $order_id }}">立即付款</a>
                </div>
            </div>
        @endif

        </div>
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
    <div style="display: none;">
    </div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/checkout_repay.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            changePayment({
                show_msg: false
            });
        });
        //
        $('.other-pay .on-off-div').click(function() {
            $(this).toggleClass('selected');
            $(this).parents('.other-pay').next('.surplus-pay').toggle();
        });
        //
        //批量支付点击展示详细信息
        $('.list-wrap').click(function() {
            if ($(this).parents('.payment-order-info li').hasClass('selected')) {
                $(this).parents('.payment-order-info li').removeClass('selected');
                $(this).parents(".payment-order-info li").find(".detail-table").slideToggle(200);
            } else {
                $(this).parents('.payment-order-info li').addClass('selected');
                $(this).parents(".payment-order-info li").find(".detail-table").slideToggle(200);
            }
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