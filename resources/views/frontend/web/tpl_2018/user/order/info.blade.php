@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">订单详情</li>
                </ul>
            </div>
            <div class="content-info">
                <div class="order-step">
                    <!--完成步骤为dl添加current样式，完成操作内容后会显示完成时间-->
                    @foreach($order_schedules as $key=>$schedule)
                        <dl class="@if($schedule['status']){{ 'current' }}@endif @if($key == 0){{ 'step-first' }}@endif">
                            <dt>{{ $schedule['title'] }}</dt>
                            <dd class="step-bg"></dd>
                            <dd class="date" title="{{ $schedule['title_sub'] ?? '' }}">{{ format_time($schedule['time']) }}</dd>
                        </dl>
                    @endforeach

                </div>
                <div class="trade-details">
                    <table class="trade-details-table" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td class="table-td trade-imfor">
                                <div class="trade-imfor-title">
                                    <h3>订单信息</h3>
                                </div>
                                <ul>
                                    <li class="table-list">
                                        <div class="trade-imfor-dt">收货地址：</div>
                                        <div class="trade-imfor-dd">
                                            <div class="address-detail">{{ $order_info['consignee'] }}，{{ $order_info['tel'] }}， {{ $order_info['region_name'] }} {{ $order_info['address'] }}</div>
                                        </div>
                                    </li>

                                    <li class="table-list">
                                        <div class="trade-imfor-dt">买家留言：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">{!! $order_info['postscript'] ?? '无' !!}</span>
                                        </div>
                                    </li>
                                    <li class="table-list">
                                        <div class="trade-imfor-dt">送货时间：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">{{ $order_info['best_time'] ?? '无' }}</span>
                                        </div>
                                    </li>
                                    <li class="table-list separate-top">
                                        <div class="trade-imfor-dt">订单编号：</div>
                                        <div class="trade-imfor-dd imfor-short-dd">{{ $order_info['order_sn'] }}</div>
                                        <div class="drop-down-container order-number">
                                            <span class="more-detail">更多</span>
                                            <div class="small-drop-down">
                                                <div class="drop-down-content trade-detail-list">
                                                    <div class="list-pointer"></div>
                                                    <table class="trade-dropdown-table">
                                                        <tbody>

                                                        @foreach($order_schedules as $key=>$schedule)
                                                            @if($schedule['status'])
                                                                <tr>
                                                                    <td class="trade-dropdown-title">{{ $schedule['title'] }}：</td>
                                                                    <td class="trade-dropdown-data">{{ format_time($schedule['time']) }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach





                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="table-list">
                                        <div class="trade-imfor-dt">支付方式：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">{{ $order_info['pay_name'] }}</span>
                                        </div>
                                    </li>

                                    <li class="table-list">
                                        <div class="trade-imfor-dt">商家信息：</div>
                                        <div class="trade-imfor-dd imfor-short-dd imfor-customer-dd">
                                            <span title="{{ $order_info['shop_name'] }}" class="btn-link">{{ $order_info['shop_name'] }}</span>

                                            {{--客服工具 默认0 0无客服 1QQ 2旺旺--}}
                                            @if($order_info['customer_tool'] == 2)
                                                <span class="ww-light">
                                <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                                                    <!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $order_info['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $order_info['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                    <span></span>
                                </a>

                            </span>
                                            @elseif($order_info['customer_tool'] == 1)
                                            <!-- s等于1时带文字，等于2时不带文字 -->
                                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $order_info['customer_account'] }}&site=qq&menu=yes" class="service-btn">
                                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $order_info['customer_account'] }}:52" alt="QQ" title="" style="height: 20px;" />
                                                    <span></span>
                                                </a>
                                            @else{{--默认 平台客服--}}
                                            <a href='{{ $order_info['yikf_url'] ?? 'javascript:;' }}' class="ww-light  color" target="_blank" title="点击联系在线客服">
                                                <i class="iconfont">&#xe6ad;</i>
                                            </a>
                                            @endif
                                        </div>
                                        <div class="drop-down-container merchant-detail-panel">
                                            <span class="more-detail">更多</span>
                                            <div class="small-drop-down">
                                                <div class="drop-down-content trade-detail-list">
                                                    <div class="list-pointer"></div>
                                                    <table class="trade-dropdown-table">
                                                        <tbody>

                                                        <tr>
                                                            <td class="trade-dropdown-title">真实姓名：</td>
                                                            <td class="trade-dropdown-data">{{ $order_info['shop_real']['real_name'] }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="trade-dropdown-title">城市：</td>
                                                            <td class="trade-dropdown-data">{{ $order_info['shop_real']['address'] }}</td>
                                                        </tr>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td class="table-td">
                                <dl class="user-status-imfor">
                                    <dt class="imfor-icon">
                                        <!-- 订单完成的图标 -->
                                        @if($order_info['order_status'] == 1)
                                            <img src="/images/common/success.png">
                                        @else
                                            <img src="/images/common/warning.png">
                                        @endif
                                    </dt>
                                    <dd class="imfor-title">
                                        <h3>订单状态：{{ $order_info['order_status_format'] }}</h3>
                                    </dd>
                                </dl>
                                <ul class="user-status-prompt">
                                    <!-- 待付款 -->
                                    @if(get_order_operate_state('buyer_payment', $order_info))
                                        <li>
                                    <span>
                                        还有
                                        <strong class="second-color" id="counter_{{ $order_info['order_id'] }}">00 天 00 小时 00 分 00 秒</strong>
                                        来付款，超时订单将自动关闭
                                    </span>
                                        </li>
                                    @endif

                                    <!-- 待收货 -->
                                    @if(format_order_status_seller($order_info['order_status'],$order_info['shipping_status'],$order_info['pay_status'], $order_info['order_cancel']) == 'shipped' && $order_info['countdown'] > 0)
                                        <li>
                                            <span>
                                                还有
                                                <strong class="second-color" id="counter_{{ $order_info['order_id'] }}"></strong>
                                                来确认收货，超时订单将自动确认收货
                                            </span>
                                        </li>
                                    @endif

                                    {{--todo 如果有物流 判断是否显示--}}
                                    <!-- 物流 -->
                                    @if($order_info['shipping_status'] == 1)
                                    {{--<li>
                                        <span>物流：</span>
                                        <div class="user-status-logistic">

                                            <span class="package-detail">顺丰快递</span>
                                            <span class="package-detail">运单号:</span>
                                            <span>456789</span>

                                            <div class="logistic-detail">
                                                <span>2016-12-04 15:13:19</span>
                                                <span class="package-detail package-address-detail">快件被快递员13333333333取出，请等待快递员与您联系，电话13333333333。</span>
                                            </div>
                                        </div>
                                    </li>--}}
                                    @endif


                                    <!-- 交易关闭 -->
                                    @if(in_array($order_info['order_status'], [2,3,4]))
                                        <li>
                                            <div class="user-status-logistic">
                                        <span class="package-detail">
                                            关闭类型：{{ $order_info['order_status_format'] }}
                                        </span>
                                            </div>
                                            <div class="user-status-logistic">
                                                <span class="package-detail"> 关闭原因：{{ $order_info['close_reason'] }}</span>
                                            </div>
                                        </li>
                                    @endif
                                </ul>

                                <dl class="user-status-operate">

                                    <!-- 不同的交易状态 -->
                                    {{--<dt>您可以</dt>--}}

                                    @if(get_order_operate_state('buyer_payment', $order_info))
                                        <dd>
                                            <a href="/checkout/pay.html?id={{ $order_info['order_id'] }}" class="on-payment">立即付款</a>
                                        </dd>
                                    @endif

                                    {{--todo--}}
                                    {{--<dd>
                                        <a class="btn-link to-pay" data-id="6026">找朋友帮忙付</a>
                                    </dd>--}}


                                    @if(get_order_operate_state('buyer_cancel', $order_info))
                                        <dd>
                                            <a class="btn-link edit-order" data-id="{{ $order_info['order_id'] }}" data-type="cancel">取消订单</a>
                                        </dd>
                                    @endif

                                    {{--确认收货--}}
                                    @if(get_order_operate_state('buyer_confirm_receipt', $order_info))
                                        <dd>
                                            <a href="javascript:void(0);" class="confirm-receipt edit-order" data-id="{{ $order_info['order_id'] }}" data-type="confirm">确认收货</a>
                                        </dd>
                                    @endif

                                    {{--延长收货时间--}}
                                    @if(get_order_operate_state('buyer_delay', $order_info))
                                        <dd>
                                            <a href="javascript:void(0);" class="extend-time btn-link edit-order" data-id="{{ $order_info['order_id'] }}" data-type="delay">延长收货时间</a>
                                        </dd>
                                    @endif




                                    <!-- 已付款，已收货 -->
                                    @if(get_order_operate_state('buyer_evaluate', $order_info))
                                        <dd>
                                            <a href="/user/evaluate/info.html?order_id={{ $order_info['order_id'] }}" class="evaluate">评价晒单</a>
                                        </dd>
                                    @endif

                                    @if($order_info['evaluate_status'] == 1)
                                    <dd>
                                        <a class="evaluate">已评价</a>
                                    </dd>
                                    @endif



                                </dl>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bought-listform">
                    <dl class="bought-listform-header ">
                        <dd class="header-item">商品</dd>
                        <dd class="header-price">单价（元）</dd>
                        <dd class="header-count">数量</dd>

                        <dd class="header-favorable">优惠（元）</dd>

                        <dd class="header-status">状态</dd>

                        <dd class="header-logistics">运费（元）</dd>

                    </dl>
                    <table class="bought-goods-list " cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td class="header-content-detail">
                                <ul>
                                    <li class="bought-listform-content ">
                                        {{--<div class="content-package">
                                            <span class="package-header"> 待发货商品 </span>
                                        </div>--}}
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>

                                            {{--todo 以下代码重写--}}
                                            @if(!empty($order_info['delivery_list']))
                                            @foreach($order_info['delivery_list']['goods_list'] as $goods)
                                            <tr>
                                                <td class="header-item">
                                                    <div class="item-container clearfix">
                                                        <div class="item-img">
                                                            <a class="pic s50" href="{{ route('pc_show_goods', ['goods_id' => $goods['goods_id']]) }}" title="查看宝贝详情" target="_blank">
                                                                <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                                                            </a>
                                                        </div>
                                                        <div class="item-meta">
                                                            <a class="item-link" href="{{ route('pc_show_goods', ['goods_id' => $goods['goods_id']]) }}" title="查看宝贝详情" target="_blank">

                                                                {{ $goods['goods_name'] }}
                                                            </a>
                                                            <span class="icon-lists">
																<span class="icon-group">

																</span>
															</span>
                                                            <div class="item-props">
																<span class="sku">
                                                                    @foreach(explode(' ', $goods['spec_info']) as $spec)
                                                                        <span>{{ $spec }}</span>
                                                                    @endforeach
																</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="header-price font-high-light">￥{{ $goods['goods_price'] }}</td>
                                                <td class="header-count font-high-light">{{ $goods['goods_number'] }}</td>

                                                <td class="header-favorable font-high-light">
                                                    <div class="favorable-hight-light">卖家优惠 ￥{{ $goods['discount'] ?? 0 }}</div>
                                                </td>

                                                <td class="header-status font-high-light">
                                                    <div class="font-black">



                                                        待发货



                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif

                                            </tbody>
                                        </table>
                                    </li>
                                </ul>
                            </td>
                            <!---->

                            <td class="header-content-logistics" rowspan="@if(!empty($order_info['delivery_list'])){{ count($order_info['delivery_list']) }}@else{{ 0 }}@endif">
                                @if($order_info['shipping_fee'] > 0)

                                    <div class="font-high-light">￥{{ $order_info['shipping_fee'] }}</div>

                                    <div class="font-high-light">( 快递 )</div>
                                @else
                                    <div class="font-high-light">( 免邮 )</div>
                                @endif

                            </td>

                        </tr>


                        {{--todo 卖家发货中 判断是否显示--}}
                        <tr>
                            <td class="header-content-detail">
                                <ul>
                                    <li class="bought-listform-content ">
                                        {{--<div class="content-package">
                                            <span class="package-header"> 包裹1 </span>
                                            <div class="package-message">
                                                <span class="package-detail">  顺丰快递  </span>
                                                <span class="package-detail">
												    运单号:<span>456789</span>
                                                    <span class="package-detail package-address-detail">
                                                         2016-12-04 15:13:19
                                                        <span class="package-more" title="快件被快递员13333333333取出，请等待快递员与您联系，电话13333333333。">
                                                            <span>快件被快递员13333333333取出，...</span>
                                                        </span>
                                                        <span class="drop-down-container">
                                                            <span class="more-detail">更多</span>
                                                            <span class="small-drop-down">
                                                                <div class="drop-down-content package-detail-list">
                                                                    <div class="list-pointer"></div>
                                                                    <ul>

                                                                                                                                            <li class="status-current">
                                                                            <span>2016-12-04 15:13:19</span>
                                                                            <span class="package-address" title="快件被快递员13333333333取出，请等待快递员与您联系，电话13333333333。">快件被快递员13333333333取出，请等待快递员与您联系，电话13333333333。</span>
                                                                        </li>
                                                                                                                                            <li class="status-done">
                                                                            <span>2016-12-04 12:59:36</span>
                                                                            <span class="package-address" title="快件已被HB恒大雅苑C区格格货栈【自提柜】代收，如有问题请联系派件员">快件已被HB恒大雅苑C区格格货栈【自提柜】代收，如有问题请联系派件员</span>
                                                                        </li>
                                                                                                                                        </ul>
                                                                </div>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </span>

                                            </div>
                                        </div>--}}
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>

                                            @foreach($order_info['goods_list'] as $goods)
                                            <tr>
                                                <td class="header-item">
                                                    <div class="item-container clearfix">
                                                        <div class="item-img">
                                                            <a class="pic s50" href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" title="查看宝贝详情" target="_blank">
                                                                <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                                                            </a>
                                                        </div>
                                                        <div class="item-meta">
                                                            <a class="item-link" href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" title="查看宝贝详情" target="_blank">
                                                                @if(!empty($goods['act_labels']))
                                                                    @foreach($goods['act_labels'] as $act_label)
                                                                        <!-- 活动标签 -->
                                                                        <em class="act-type {{ $act_label['code'] }}">{{ $act_label['name'] }}</em>
                                                                    @endforeach
                                                                @endif
                                                                {{ $goods['goods_name'] }}
                                                            </a>

                                                            <span class="icon-lists">

                                                                 @if(!empty($goods['saleservice']))
                                                                    <span class="item-group">
                                                                        @foreach($goods['saleservice'] as $service)
                                                                            <a href="javascript:;" title="【{{ $service['contract_name'] }}】{{ $service['contract_desc'] }}"
                                                                               data-toggle="tooltip" data-placement="auto bottom">
                                                                                <img src="{{ get_image_url($service['contract_image']) }}" />
                                                                            </a>
                                                                        @endforeach
                                                                    </span>
                                                                @endif

															</span>
                                                            <div class="item-props">
																<span class="sku">
                                                                    @foreach(explode(' ', $goods['spec_info']) as $spec)
                                                                        <span>{{ $spec }}</span>
                                                                    @endforeach
																</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="header-price font-high-light">￥{{ $goods['goods_price'] }}</td>
                                                <td class="header-count font-high-light">{{ $goods['goods_number'] }}</td>
                                                <td class="header-favorable font-high-light">
                                                    <div class="favorable-hight-light">￥{{ $goods['discount'] }}</div>
                                                </td>
                                                <td class="header-status font-high-light">
                                                    <div class="font-black">


                                                        {{ $goods['goods_status_format'] }}


                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </li>
                                </ul>
                            </td>

                            <!-- -->
                            <td class="header-content-logistics">&nbsp;</td>
                            <!---->
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="order-total">
                    <!--<td class="total-favorable">
                                    <ul>
                                        <li class="obtain-point">
                                            <div>返 积分0点</div>
                                        </li>
                                    </ul>
                                </td>-->
                    <div class="total-count">
                        <!--<div class="total-count-pay">
                            <div class="count-title-pay">实付款：</div>
                            <div class="total-count-num color">
                                <strong>￥0</strong>
                            </div>
                                            </div>-->
                        <div class="total-count-pay">
                            <div class="total-count-pay-info">
                                <span>商品总额：{{ $order_info['goods_amount_format'] }}</span>

                                <em>+</em>
                                <span>运费：{{ $order_info['shipping_fee_format'] }}</span>






                                <em class="operator">-</em>
                                <span>卖家优惠：￥{{ $order_info['discount_fee'] }}</span>

                                <em>=</em>
                                <span class="end second-color">订单总金额：￥{{ $order_info['order_amount'] }}</span>
                            </div>


                            <div class="total-count-pay-info">
                                {{--todo 待付款 显示--}}
                                {{--<span> 订单总金额： {{ $order_info['order_amount_format'] }} </span>--}}


                                {{--<em>-</em>--}}
                                {{--<span>余额支付：￥0.00</span>--}}
                                {{--<em>=</em>--}}

                                {{--<span class="end second-color">待付款金额：{{ $order_info['order_amount_format'] }}</span>--}}


                                {{--todo 已付款 显示--}}
                                <span>

                                    在线支付

                                    ：￥{{ $order_info['money_paid'] }}
                                </span>

                                <em>+</em>
                                <span>余额支付：￥{{ $order_info['surplus'] }}</span>
                                <em>=</em>
                                <span class="end second-color">实付款金额：￥{{ $order_info['order_amount'] }}</span>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            //
        </script>
    </div>

@stop

{{--底部js--}}
@section('footer_js')
    <script src="/js/common.js"></script>
    <script src="/js/user.js"></script>
    <script src="/assets/d2eace91/js/yii.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/common.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        @if($order_info['countdown'] > 0)
        $(document).ready(function() {
            $("#counter_{{ $order_info['order_id'] }}").countdown({
                // 时间间隔
                time: "{{ $order_info['countdown']*1000 }}",
                leadingZero: true,
                onComplete: function(event) {
                    $(this).html("已超时！");
                    // 超时事件，预留
                    $.ajax({
                        type: 'GET',
                        url: '/user/order/@if($order_info['pay_status'] == 0){{ 'cancel-sys' }}@else{{ 'confirm-sys' }}@endif',
                        data: {
                            order_id: '{{ $order_info['order_id'] }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 0)
                            {
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        });
        //
        @endif

        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                title = '';
                if (type == 'delay') {
                    title = "延长确认收货时间";
                }
                if (type == 'confirm') {
                    title = "确认收货";
                }
                if (type == 'cancel') {
                    title = "取消订单";
                }
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        // 标题
                        title: title,
                        trigger: $(this),
                        // ajax加载的设置
                        ajax: {
                            url: '/user/order/edit-order?from=info',
                            data: {
                                type: type,
                                id: id
                            }
                        },
                    });
                }
            });
            $("body").on("click", ".to-pay", function() {
                var order_id = $(this).data("id");
                $.ajax({
                    type: 'POST',
                    url: '/user/order/to-pay.html',
                    data: {
                        order_id: order_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0)
                        {
                            $.go(result.url);
                        }
                    }
                });
            });
        });
        //
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $().ready(function() {
        })
        //
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
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
