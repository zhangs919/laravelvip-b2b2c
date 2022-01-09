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
                    <dl class="current step-first">
                        <dt>拍下商品</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="下单时间">{{ format_time($info->add_time, 'Y-m-d H:i:s') }}</dd>
                    </dl>
                    <dl class="">
                        <dt>商家发货</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="商家发货时间">{{ format_time($info->shipping_time, 'Y-m-d H:i:s') }}</dd>
                    </dl>
                    <dl class="">
                        <dt>买家付款</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="买家付款时间">{{ format_time($info->pay_time, 'Y-m-d H:i:s') }}</dd>
                    </dl>
                    <dl class="">
                        <dt>买家评价</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="完成时间">{{ format_time($info->confirm_take_time, 'Y-m-d H:i:s') }}</dd>
                    </dl>

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
                                            <div class="address-detail">{{ $info->consignee_name }}，{{ $info->consignee_mobile }}， {{ $info->consignee_address }}</div>
                                        </div>
                                    </li>

                                    <li class="table-list">
                                        <div class="trade-imfor-dt">买家留言：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">{{ $info->order_message }}</span>
                                        </div>
                                    </li>
                                    <li class="table-list">
                                        <div class="trade-imfor-dt">送货时间：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">无</span>
                                        </div>
                                    </li>
                                    <li class="table-list separate-top">
                                        <div class="trade-imfor-dt">订单编号：</div>
                                        <div class="trade-imfor-dd imfor-short-dd">{{ $info->order_sn }}</div>
                                        <div class="drop-down-container order-number">
                                            <span class="more-detail">更多</span>
                                            <div class="small-drop-down">
                                                <div class="drop-down-content trade-detail-list">
                                                    <div class="list-pointer"></div>
                                                    <table class="trade-dropdown-table">
                                                        <tbody>

                                                        <tr>
                                                            <td class="trade-dropdown-title">成交时间：</td>
                                                            <td class="trade-dropdown-data">{{ format_time($info->add_time, 'Y-m-d H:i:s') }}</td>
                                                        </tr>




                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="table-list">
                                        <div class="trade-imfor-dt">支付方式：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">{{ format_pay_type($info->pay_type) }}</span>
                                        </div>
                                    </li>

                                    <li class="table-list">
                                        <div class="trade-imfor-dt">商家信息：</div>
                                        <div class="trade-imfor-dd imfor-short-dd imfor-customer-dd">
                                            <span title="{{ $info->shop_name }}" class="btn-link">{{ $info->shop_name }}</span>

                                            <span class="ww-light">
											<!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                                                <!-- s等于1时带文字，等于2时不带文字 -->
                                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                                    <span></span>
                                                </a>

										    </span>
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
                                                            <td class="trade-dropdown-data">鲜农乐食品专营店</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="trade-dropdown-title">城市：</td>
                                                            <td class="trade-dropdown-data">秦皇植物园</td>
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
                                        <img src="/frontend/images/common/warning.png">
                                    </dt>
                                    <dd class="imfor-title">
                                        <h3>订单状态：商品已拍下，等待卖家发货</h3>
                                    </dd>
                                </dl>
                                <ul class="user-status-prompt">
                                    <!-- 待付款 -->
                                    <!-- 待收货 -->


                                    <!-- 交易关闭 -->

                                </ul>

                                <dl class="user-status-operate">

                                    <!-- 不同的交易状态 -->








                                    <dt>您可以</dt>

                                    <dd>
                                        <a class="btn-link edit-order" data-id="{{ $info->order_id }}" data-type="cancel">取消订单</a>
                                    </dd>





                                    <!-- 已付款，待发货 -->



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
                                        <div class="content-package">
                                            <span class="package-header"> 待发货商品 </span>
                                        </div>
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>

                                            @foreach($info->order_goods as $og)
                                            <tr>
                                                <td class="header-item">
                                                    <div class="item-container clearfix">
                                                        <div class="item-img">
                                                            <a class="pic s50" href="{{ route('pc_show_goods', ['goods_id' => $og->goods_id]) }}" title="查看宝贝详情" target="_blank">
                                                                <img src="{{ get_image_url($og->goods->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                                                            </a>
                                                        </div>
                                                        <div class="item-meta">
                                                            <a class="item-link" href="{{ route('pc_show_goods', ['goods_id' => $og->goods_id]) }}" title="查看宝贝详情" target="_blank">

                                                                {{ $og->goods_name }}
                                                            </a>












                                                            <span class="icon-lists">
																<span class="icon-group">

																</span>
															</span>
                                                            <div class="item-props">
																<span class="sku">
																																		<span>电压：60V</span>
																																		<span>颜色分类：60V20A 1000W空车</span>

																</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="header-price font-high-light">￥{{ $og->goods_price }}</td>
                                                <td class="header-count font-high-light">{{ $og->goods_number }}</td>

                                                <td class="header-favorable font-high-light">
                                                    <div class="favorable-hight-light">卖家优惠 ￥0.00</div>
                                                </td>

                                                <td class="header-status font-high-light">
                                                    <div class="font-black">



                                                        待发货



                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </li>
                                </ul>
                            </td>
                            <!---->

                            <td class="header-content-logistics" rowspan="{{ count($info->order_goods) }}">
                                @if($info->shipping_fee > 0)

                                    <div class="font-high-light">￥{{ $info->shipping_fee }}</div>

                                    <div class="font-high-light">( 快递 )</div>
                                @else
                                    <div class="font-high-light">( 免邮 )</div>
                                @endif

                            </td>

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
                                <span>商品总额：￥{{ $info->goods_amount }}</span>

                                <em>+</em>
                                <span>运费：￥{{ $info->shipping_fee }}</span>






                                <em class="operator">-</em>
                                <span>卖家优惠：￥0.00</span>

                                <em>=</em>
                                <span class="end second-color">订单总金额：￥{{ $info->order_amount }}</span>
                            </div>


                            <div class="total-count-pay-info">
                                <span> 订单总金额： ￥{{ $info->order_amount }} </span>


                                <em>-</em>
                                <span>余额支付：￥0.00</span>
                                <em>=</em>

                                <span class="end second-color">待付款金额：￥{{ $info->order_amount }}</span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $().ready(function() {
                $("body").on("click", ".edit-order", function() {
                    var type = $(this).data("type");
                    var id = $(this).data("id");
                    var is_exchange = "";
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
                                url: '/user/order/edit-order.html?from=info',
                                data: {
                                    type: type,
                                    id: id,
                                    is_exchange: is_exchange
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
        </script></div>

@endsection