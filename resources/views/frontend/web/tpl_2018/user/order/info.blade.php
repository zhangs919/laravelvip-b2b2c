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
                        <dd class="date" title="下单时间">{{ format_time($order_info['add_time'], 'Y-m-d H:i:s') }}</dd>
                    </dl>
                    <dl class="current">
                        <dt>商家发货</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="商家发货时间">{{ format_time($order_info['shipping_time'], 'Y-m-d H:i:s') }}</dd>
                    </dl>
                    <dl class="current">
                        <dt>买家付款</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="买家付款时间">{{ format_time($order_info['pay_time'], 'Y-m-d H:i:s') }}</dd>
                    </dl>
                    <dl class="current">
                        <dt>买家评价</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="完成时间">{{ format_time($order_info['confirm_time'], 'Y-m-d H:i:s') }}</dd>
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
                                            <div class="address-detail">{{ $order_info['consignee'] }}，{{ $order_info['tel'] }}， {{ $order_info['region_name'] }} {{ $order_info['address'] }}</div>
                                        </div>
                                    </li>

                                    <li class="table-list">
                                        <div class="trade-imfor-dt">买家留言：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">{!! $order_info['postscript'] !!}</span>
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
                                        <div class="trade-imfor-dd imfor-short-dd">{{ $order_info['order_sn'] }}</div>
                                        <div class="drop-down-container order-number">
                                            <span class="more-detail">更多</span>
                                            <div class="small-drop-down">
                                                <div class="drop-down-content trade-detail-list">
                                                    <div class="list-pointer"></div>
                                                    <table class="trade-dropdown-table">
                                                        <tbody>

                                                        <tr>
                                                            <td class="trade-dropdown-title">成交时间：</td>
                                                            <td class="trade-dropdown-data">{{ format_time($order_info['add_time'], 'Y-m-d H:i:s') }}</td>
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
                                            <span class="no-content">{{ $order_info['pay_name'] }}</span>
                                        </div>
                                    </li>

                                    <li class="table-list">
                                        <div class="trade-imfor-dt">商家信息：</div>
                                        <div class="trade-imfor-dd imfor-short-dd imfor-customer-dd">
                                            <span title="{{ $order_info['shop_name'] }}" class="btn-link">{{ $order_info['shop_name'] }}</span>

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
                                        <img src="/images/common/warning.png">
                                    </dt>
                                    <dd class="imfor-title">
                                        <h3>订单状态：{{ $order_info['order_status_format'] }}</h3>
                                    </dd>
                                </dl>
                                <ul class="user-status-prompt">
                                    <!-- 待付款 -->
                                    <!-- 待收货 -->

                                    {{--todo 如果有物流 判断是否显示--}}
                                    <!-- 物流 -->

                                    <li>
                                        <span>物流：</span>
                                        <div class="user-status-logistic">

                                            <span class="package-detail">顺丰快递</span>
                                            <span class="package-detail">运单号:</span>
                                            <span>456789</span>

                                            <div class="logistic-detail">
                                                <span>2016-12-04 15:13:19</span>
                                                <span class="package-detail package-address-detail">快件被快递员13313013072取出，请等待快递员与您联系，电话13313013072。</span>
                                            </div>
                                        </div>
                                    </li>



                                    <!-- 交易关闭 -->

                                </ul>

                                <dl class="user-status-operate">

                                    <!-- 不同的交易状态 -->







                                    {{--todo 判断是否显示--}}
                                    <dt>您可以</dt>

                                    <dd>
                                        <a class="btn-link edit-order" data-id="{{ $order_info['order_id'] }}" data-type="cancel">取消订单</a>
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

                                            @if(!empty($order_info['delivery_list']))
                                            @foreach($order_info['delivery_list'] as $og)
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
                                            @endif

                                            </tbody>
                                        </table>
                                    </li>
                                </ul>
                            </td>
                            <!---->

                            <td class="header-content-logistics" rowspan="{{ count($order_info['delivery_list']) }}">
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
                                        <div class="content-package">
                                            <span class="package-header"> 包裹1 </span>
                                            <div class="package-message">
                                                <span class="package-detail">  顺丰快递  </span>
                                                <span class="package-detail">
												    运单号:<span>456789</span>
                                                    <span class="package-detail package-address-detail">
                                                         2016-12-04 15:13:19
                                                        <span class="package-more" title="快件被快递员13313013072取出，请等待快递员与您联系，电话13313013072。">
                                                            <span>快件被快递员13313013072取出，...</span>
                                                        </span>
                                                        <span class="drop-down-container">
                                                            <span class="more-detail">更多</span>
                                                            <span class="small-drop-down">
                                                                <div class="drop-down-content package-detail-list">
                                                                    <div class="list-pointer"></div>
                                                                    <ul>

                                                                                                                                            <li class="status-current">
                                                                            <span>2016-12-04 15:13:19</span>
                                                                            <span class="package-address" title="快件被快递员13313013072取出，请等待快递员与您联系，电话13313013072。">快件被快递员13313013072取出，请等待快递员与您联系，电话13313013072。</span>
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
                                        </div>
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>

                                            <tr>
                                                <td class="header-item">
                                                    <div class="item-container clearfix">
                                                        <div class="item-img">
                                                            <a class="pic s50" href="http://www.b2b2c.yunmall.68mall.com/goods-11.html" title="查看宝贝详情" target="_blank">
                                                                <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                                                            </a>
                                                        </div>
                                                        <div class="item-meta">
                                                            <a class="item-link" href="http://www.b2b2c.yunmall.68mall.com/goods-11.html" title="查看宝贝详情" target="_blank">


                                                                高山红富士苹果新鲜脆甜多汁水果批发
                                                            </a>



                                                            <div class="goods-active group-buy">
                                                                <a>团购</a>
                                                            </div>





                                                            <span class="icon-lists">
																<span class="icon-group">
																																		<a href="javascript:;" title="【破损补寄】卖家就该商品签收状态作出承诺，自商品签收之日起至卖家承诺保障时间内，如发现商品在运输途中出现破损，买家可申请破损部分商品补寄。" data-toggle="tooltip" data-placement="auto bottom">
																		<img src="http://images.68mall.com/contract/2016/06/07/14653028611314.jpg" />
																	</a>
																																		<a href="javascript:;" title="【品质承诺】卖家就该商品品质向买家作出承诺，承诺商品为正品。" data-toggle="tooltip" data-placement="auto bottom">
																		<img src="http://images.68mall.com/contract/2016/06/07/14653028223253.png" />
																	</a>

																</span>
															</span>
                                                            <div class="item-props">
																<span class="sku">
																																		<span></span>

																</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="header-price font-high-light">￥1.00</td>
                                                <td class="header-count font-high-light">1</td>
                                                <td class="header-favorable font-high-light">
                                                    <div class="favorable-hight-light">￥0</div>
                                                </td>
                                                <td class="header-status font-high-light">
                                                    <div class="font-black">


                                                        已发货


                                                    </div>
                                                </td>
                                            </tr>

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
                                <span>卖家优惠：￥0.00</span>

                                <em>=</em>
                                <span class="end second-color">订单总金额：{{ $order_info['order_amount_format'] }}</span>
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

                                    ：￥0.00
                                </span>

                                <em>+</em>
                                <span>余额支付：￥19.60</span>
                                <em>=</em>
                                <span class="end second-color">实付款金额：￥19.6</span>

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