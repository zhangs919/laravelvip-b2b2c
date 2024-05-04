@extends('layouts.buy_layout')

@section('header_css')
    <link rel="stylesheet" href="/css/flow.css?v=20180702"/>
@stop

@section('content')


    <!-- 引入上方导航条文件 -->
    <div class="header">
        <div class="w990">
            <div class="logo-info">
                <a href="/" class="logo">
                    <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
                </a>
            </div>
            <div class="cart-progress ">
                <ul>


                    <li class="finish finish-01">
                        <i>1</i>
                        <span>
						<a href="/cart.html">我的购物车</a>
					</span>
                        <b></b>
                    </li>
                    <li class="finish finish-02">
                        <i>2</i>
                        <span>确认订单</span>
                        <b></b>
                    </li>
                    <li class="finish">
                        <i>3</i>
                        <span>付款</span>
                        <b></b>
                    </li>
                    <li class="finish">
                        <i>4</i>
                        <span>支付成功</span>
                        <b></b>
                    </li>


                </ul>
            </div>
        </div>
    </div>

    <div class="content-bg">
        <div class="content-main w990">
            <div class="content-info">
                <!-- 用户自定义信息 -->

                <!-- 收货地址 -->

                {{--引入收货地址列表--}}
                @include('buy.user_address')

                <!-- 送货时间 -->
                @if($send_time_show)
                    <div class="time-container border-line">
                        <div class="main-content">
                            <h2 class="title">
                                送货时间
                                <span>{!! $send_time_desc !!}</span>
                            </h2>
                            <div class="delivery-time clearfix">
                                <!-- 选中的送货时间 给下面的div增加class值"active" 也就是class="box active" _star-->

                                @foreach($send_time_list as $st_key=>$send_time)

                                    @if($send_time['set_time']){{--指定送货时间--}}
                                    <div class="box box-spe @if($send_time['checked'] == 'checked'){{ 'active2' }}@endif">
                                        <label>
                                            <input type="radio" data="{{ $st_key }}" name="best_time" value="{{ $st_key }}" id="set_best_time" @if($send_time['checked'] == 'checked'){{ 'checked' }}@endif />
                                            <span>{{ $send_time['value'] }}</span>
                                            <font class="best-time-desc color">@if($st_key == 4 && $send_time['checked'] == 'checked'){{ $best_time ?? '' }}@endif</font>
                                        </label>

                                        <!-- 指定送货具体时间 _star-->
                                        <div class="seltimebox" id="seltimebox">
                                            <table cellpadding=0 cellspacing=0 width="100%">
                                                <tr>
                                                    <td>
                                                        <span>时间段</span>
                                                    </td>
                                                    @foreach($send_time['best_time'] as $bt_value)
                                                    <td align=center>
                                                        <span>
                                                            {{ $bt_value['name'] }}
                                                            <br />
                                                            {{ $bt_value['week'] }}
                                                        </span>
                                                    </td>
                                                    @endforeach
                                                </tr>

                                                @foreach(array_first($send_time['best_time'])['time'] as $time_key=>$time_text)
                                                    <tr>
                                                        <td>
                                                            <span>{{ $time_text['text'] }}</span>
                                                        </td>

                                                        @foreach($send_time['best_time'] as $bt_value)
                                                        <td align=center>
                                                            @if($bt_value['time'][$time_key]['use'] == 1)
                                                                <a href="javascript:void(0);" data="{{ $bt_value['name'] }}{{ $bt_value['week'] }}:{{ $bt_value['time'][$time_key]['text'] }}"
                                                                   class="set_time @if($best_time == $bt_value['name'].$bt_value['week'].':'.$bt_value['time'][$time_key]['text']){{ 'current' }}@endif">
                                                                    可选
                                                                </a>
                                                            @else
                                                                &nbsp;
                                                            @endif
                                                        </td>
                                                        @endforeach

                                                    </tr>
                                                @endforeach

                                            </table>
                                        <!-- 指定送货具体时间 _end-->
                                        </div>
                                    </div>
                                    @else
                                        <div class="box @if($send_time['checked'] == 'checked'){{ 'active' }}@endif">
                                            <label>
                                                <input type="radio" data="{{ $st_key }}" class="best_time" name="best_time" value="{{ $st_key }}" @if($send_time['checked'] == 'checked'){{ 'checked' }}@endif />
                                                <span>{{ $send_time['value'] }}</span>
                                            </label>
                                        </div>
                                    @endif


                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif



                <!-- 所有店铺商品清单 -->
                <div class="goods-list border-line">
                    <div class="main-content">
                        <h2 class="title">商品清单</h2>
                        <div class="order-goods">
                            <!-- 根据店铺对商品进行拆单 每个table是一个店铺的商品 _star-->
                            @foreach($cart_info['shop_list'] as $shop_id=>$shop)
                                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="order-goods-list">
                                    <tr>
                                        <th class="goods-title" colspan="3">
                                            <div class="order-body">
                                                <div class="shop">
                                                    <div class="shop-info">
                                                        <span class="shop-icon">
                                                            <img src="/images/shop-type/shop-icon{{ $shop['shop_info']['shop_type'] }}.png" />
                                                        </span>
                                                        <span class="shop-name">店铺：</span>
                                                        <a href='{{ route('pc_shop_home', ['shop_id'=>$shop_id]) }}' target="_blank" title="" class="shop-info-name">{{ $shop['shop_info']['shop_name'] }}</a>
                                                        <span class="shop-customer">
                                                            <!-- 客服 -->
                                                            {{--客服工具 默认0 1QQ 2旺旺--}}
                                                            @if(!empty($customer = $shop['shop_info']['customer']))
                                                                @if($customer['customer_tool'] == 1){{--QQ--}}
                                                                    <!-- s等于1时带文字，等于2时不带文字 -->
                                                                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $customer['customer_account'] }}&site=qq&menu=yes" class="service-btn">
                                                                        <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $customer['customer_account'] }}:52" alt="QQ" title="{{ $customer['customer_name'] }}" style="height: 20px;" />
                                                                        <span>{{ $customer['customer_name'] }}</span>
                                                                    </a>

                                                                @elseif($customer['customer_tool'] == 2){{--旺旺--}}
                                                                    <!-- s等于1时带文字，等于2时不带文字 -->
                                                                    <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $customer['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                                                        <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $customer['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="{{ $customer['customer_name'] }}" title="" />
                                                                        <span></span>
                                                                    </a>
                                                                @else{{--默认客服--}}
                                                                    {{--todo --}}

                                                                @endif
                                                            @endif

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(!$shop['shop_info']['is_opening'])
                                                <!-- 店铺打烊标识 -->
                                                <div class="shop-closing-label color border-color">{{ $shop['shop_info']['close_tips'] }}</div>
                                            @endif
                                        </th>
                                        <th class="goods-price">单价（元）</th>
                                        <th class="goods-amount">数量</th>
                                        <th class="goods-sum">小计(元)</th>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="goods-content">
                                            @foreach($shop['goods_list'] as $goods)
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <!-- 如果该商品有赠品，那么当前商品的tr的class="have-gift" _star-->
                                                <tr class="goods_178 ">
                                                    <td class="goods-img">
                                                        <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" title="" target="_blank" class="img">
                                                            <img src="{{ get_image_url($goods['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="50" height="50" />
                                                        </a>

                                                    </td>
                                                    <td class="goods-master">
                                                        <p class="item-title">
                                                            <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" target="_blank" title="{{ $goods['goods_name'] }}">


                                                                <!-- 活动 -->


                                                                {{--todo 展示活动标识--}}
                                                                {{--<em class="activity-tag activity-tag3">限时折扣</em>--}}


                                                                {{ $goods['goods_name'] }}
                                                            </a>
                                                        </p>
                                                        <div class="item-other-info">
                                                            <div class="promo-logos"></div>
                                                            <div class="item-icon-list">
                                                                <div class="item-icons">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="goods-attr">
                                                        @if(!empty($goods['spec_names']))
                                                            @foreach($goods['spec_names'] as $spec_name)
                                                                <p class="sku-line">{{ $spec_name }}</p>
                                                            @endforeach
                                                        @endif

                                                    </td>
                                                    <td class="goods-price"> {{ $goods['goods_price_format'] }} </td>
                                                    <td class="goods-amount">{{ $goods['goods_number'] }}</td>
                                                    <td class="goods-sum">

                                                        <p class="sum second-color">{{ $goods['goods_amount_format'] }}</p>

                                                    </td>
                                                </tr>
                                                <!-- 如果该商品有赠品，那么当前商品的tr的class="have-gift" _end-->
                                            </table>
                                            @endforeach

                                        </td>

                                    </tr>

                                    <tr>
                                        <td colspan="6" class="goods-postage">
                                            <div class="postage">

                                                @foreach($shop['shipping_list'] as $shipping_info)
                                                <div class="postage-out-box">
                                                    <div class="postage-box postage-box-{{ $shop_id }} @if($shipping_info['selected'] == 'selected'){{ 'active' }}@endif" id="postage-box-{{ $shipping_info['id'] }}-1" data-shop-id="{{ $shop_id }}" data-id="{{ $shipping_info['id'] }}" data-name="{{ $shipping_info['name'] }} " data-price="{{ $shipping_info['price'] }}" data-price-format="{{ $shipping_info['price_format'] }}">
                                                        <label>{{ $shipping_info['name'] }} </label>
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                            <div class="pickup-address" >
                                                <label>
                                                    自提点：
                                                    <span id='pickup_name'></span>
                                                    <a class="pickup-edit" data-shop-id={{ $shop_id }}>修改</a>
                                                </label>
                                            </div>


                                            <div class="postage-price postage-info-{{ $shop_id }}" style="">

                                                {{ $shop['order']['shipping_fee_format'] }}


                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" class="goods-annex">
                                            <div class="memo">
                                                <span>买家留言：</span>
                                                <div class="buyer-msg">
                                                    <textarea class="text postscript" data-shop-id="{{ $shop_id }}" placeholder="选填，可填写您与卖家达成一致的要求"></textarea>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="3" class="goods-bill" id="shop_count_{{ $shop_id }}">
                                            <div class="bill">
                                                <p class="order-pay-vice">



                                                </p>

                                                <div class="order-pay second-color">
                                                    店铺合计（含运费）：<strong class="second-color SZY-SHOP-ORDER-AMOUNT-{{ $shop_id }}" data-shop-id="{{ $shop_id }}">￥{{ $shop['order']['order_amount'] }}</strong>
                                                </div>


                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <!-- 新加 start  选择自提点 -->
                                <div class="bomb-box pickup-bomb-box logistics-choosen-{{ $shop_id }}" style="display: none">
                                    <div class="box-title">选择自提点</div>
                                    <div class="box-oprate" data-name=普通快递  data-price={{ $shop['order']['shipping_fee'] }} data-shop-id={{ $shop_id }} data-id=0></div>
                                    <div class="content-info">
                                        <form class="">
                                            <div class="logistics-search-box">
                                                <input class="logistics-search-input" placeholder="请输入自提点名称或自提点所在地" type="text" />
                                                <a class="btn btn-primary" data-shop_id={{ $shop_id }}>搜索</a>
                                            </div>
                                            <ul class="logistics-store-list logistics-store-list-{{ $shop_id }}">

                                                @if(!empty($shop['shop_info']['pickup_list']))
                                                    @foreach($shop['shop_info']['pickup_list'] as $pickup)
                                                        <li class="logistics-item" @if($pickup == end($shop['shop_info']['pickup_list']))style="border: none;"@endif>
                                                            <label class="logistics-inner" >
                                                                <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="{{ $pickup['shop_id'] }}" data-id="{{ $pickup['shop_id'] }}" data-pickup_name="{{ $pickup['pickup_name'] }}" data-pickup_id="{{ $pickup['pickup_id'] }}">
                                                                <div class="logistics-info">
                                                                    <p class="logistics-name">{{ $pickup['pickup_name'] }}</p>
                                                                    <p class="logistics-address" title="{{ $pickup['pickup_address'] }}">
                                                                        <i></i>{{ $pickup['pickup_address'] }}
                                                                    </p>
                                                                    <p class="logistics-tel">
                                                                        <i></i>{{ $pickup['pickup_tel'] }}
                                                                    </p>
                                                                </div>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </form>
                                    </div>
                                </div>
                                <!-- 新加 end  选择自提点 -->
                            @endforeach

                            <!-- 根据店铺对商品进行拆单 每个table是一个店铺的商品 _end-->

                        </div>
                    </div>
                </div>

                <!-- 平台红包 -->
                @if(!empty($cart_info['bonus_list']))
                <div class="platform-box border-line" id="order_amount">
                    <div class="main-content">
                        <h2 class="title">
                            使用商城红包
                            <i class="arrow"></i>
                            <span class="slogan">
                                <span class="SZY-BONUS-AMOUNT-CONTAINER">
                                    <span class="SZY-BONUS-NAME">省￥2.50元，使用￥2.50元平台红包</span>
                                    <font class="second-color SZY-BONUS-AMOUNT">-￥2.50元</font>
                                </span>
                            </span>
                        </h2>
                        <ul class="platform-list">




                            <li class="platform current ">
                                <div class="platform-item system-bonus" data-user-bonus-id="2287">
                                    <div class="platform-info">
                                        <div class="item-info-msg">
                                            <p class="item-info-top"></p>
                                            <!--<span class="item-cancel hide" title="取消勾选">x</span>-->
                                            <span class="price">￥2.50元</span>
                                            <span class="limit">

								满3.00可用

							</span>
                                            <p class="time">有效期至&nbsp;2019-05-23 23:59:59</p>
                                        </div>
                                        <div class="platform-type">
							<span class="platform-type-l">

								[平台红包]

							</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- 满足使用条件的商品列表 _start -->
                                <div class="range-use">
                                    <span class="platform-type-r">




                                        [全场通用]




                                    </span>
                                    <div class="platform-type-tips hide">
                                        <div class="coupon-tit">该红包可用商品列表</div>
                                        <div class="coupon-con">
                                            <div class="coupon-item">
                                                <ul class="coupon-goods-list">

                                                    <li>
                                                        <a href="/goods-66.html" target="_blank" title="日本进口零食品 嘉娜宝Kracie玫瑰香体水果软糖果32g">
                                                            <img src="http://68test.oss-cn-beijing.aliyuncs.com/images/746/taobao-yun-images/2018/12/03/44879611506/TB1BGPLKFXXXXbyaXXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="50" height="50">
                                                        </a>
                                                        <span>日本进口零食品 嘉娜宝Kracie玫瑰香体水果软糖果32g</span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <span class="platform-arrow"></span>
                                    </div>
                                </div>
                                <!-- 满足使用条件的商品列表 _end -->
                            </li>


                        </ul>


                        <!--<select class="system-bonus">

                        <option value="0">不使用红包</option>

                        <option value="2287"selected>省￥2.50元，￥2.50元红包</option>

                        </select>-->
                        <!--<span class="color SZY-BONUS-AMOUNT">- ￥2.50元</span>-->
                    </div>
                </div>
                @endif

                <!--
            <div class="real-pay">
                <span class="hd">应付总额：</span>
                <span class="bd color SZY-ORDER-AMOUNT"></span>
            </div>
             -->
                <!-- <div class="obtain-point">
                    可获得积分：
                    <span>
                        <strong></strong>
                        点
                    </span>
                </div> -->

                <!-- 发票信息 -->
                @if($invoice_show)
                    <div class="invoice-info border-line">
                        <div class="main-content">
                            <h2 class="title">发票信息</h2>
                            <div class="invoice-content">
                                <!--
                                <label>
                                    <input type="checkbox" value="" id="invoice" checked="checked"/>
                                    <span>索要发票</span>
                                </label>
                                 -->
                                <!-- 发票详细信息 _star -->
                                <div class="inv-info">

                                    <span>{{ $invoice_desc }}</span>

                                    <a class="modify color" href="javascript:void(0);">修改</a>
                                </div>
                                <!-- 发票详细信息 _end -->
                            </div>
                        </div>
                    </div>
                @endif

                <!-- 支付方式 -->


                <div id="pay_type" class="pay-type border-line">
                    <div class="main-content">
                        <h2 class="title">支付方式</h2>
                        <div class="pay-type-content">
                            <!-- 积分支付 start -->

                            <!-- 积分支付 end -->

                            <!-- 余额支付 start -->
                            @if($cart_info['user_info']['balance'] > 0)
                            <div id="pay_balance" class="other-pay">


                                <div class="hd">
                                    <label>
                                        <input type="checkbox" id="balance_enable" class="other-pay-choose">
                                        <img src="/assets/d2eace91/images/payment/balance.jpg" alt="" class="pay-img">
                                        <span class="discharge">
			（当前可用账户余额：
			<strong class="second-color SZY-USER-BALANCE">{{ $cart_info['user_info']['balance_format'] }}</strong>
			）
		</span>
                                    </label>
                                </div>

                                <div class="bd SZY-BALANCE-INFO" style="display: none;">
                                    <span class="colon">：</span>
                                    <span class="txtBox">
		<input type="text" id="balance" class="tc-text SZY-ORDER-BALANCE" value="">
		元
	</span>
                                    <span class="discharge second-color">
		-
		<strong class="SZY-ORDER-BALANCE"></strong>
	</span>

                                </div>
                            </div>
                            <!-- 余额支付 end -->

                            <!-- 余额支付后面显示的应付款信息 -->
                            <p class="surplus-pay" id="balance_money_pay" >
                                剩余应付金额
                                <strong class="second-color SZY-ORDER-MONEY-PAY">

                                    {{ $cart_info['user_info']['pay_point_amount_format'] }}

                                </strong>
                                请选择以下支付方式支付
                            </p>
                            @endif


                            <!-- 银行支付方式调用 start -->
                            <div class="pay-all" id="pay_bank">


                                <ul id="paylist" class="payment-tab">

                                    @foreach($pay_list as $pay_info)
                                    <!-- 货到付款特殊处理 -->
                                    <li class="clearfix" @if($pay_info['disabled'] == 1)style="display: none;"@endif>
                                        <label>
                                            <input type="radio" id="pac_code_{{ $pay_info['id'] }}" name="pay_code" class="pay_code" value="{{ $pay_info['code'] }}" @if($pay_info['checked'] == 'checked'){{ 'checked' }}@endif>
                                            <img src="/assets/d2eace91/images/payment/{{ $pay_info['code'] }}.jpg" alt="" class="pay-img">
                                        </label>
                                        <div class="pay-tips" style="display: none;">
                                            <div class="pay-tips-name">
                                                <i></i>
                                                {!! $pay_info['tips'] !!}
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>

                                {{--todo 暂时关闭其他支付方式 后期做好该功能再展示--}}
                                {{--<div id="other_pay">
                                    <h2 class="title">其它支付</h2>
                                    <div class="other-pay">
                                        <div class="hd">
                                            <label>
                                                <input type="radio" id="pac_code_99" name="pay_code" class="pay_code" value="to_pay">
                                                <img src="/assets/d2eace91/images/payment/pay-another.jpg" alt="" class="pay-img">
                                            </label>
                                        </div>
                                    </div>
                                </div>--}}

                            </div>
                            <!-- 银行支付方式调用 end -->
                        </div>
                    </div>
                </div>
                <!-- 提交订单 -->
                <div class="confirm-pay " id="checkout_amount">

                    <div class="total-count">
                        <div class="total-count-pay">
                            <div class="total-count-pay-info">
			<span class="first">
				订单总额：
				<span class="SZY-ORDER-AMOUNT">{{ $cart_info['order']['order_amount_format'] }}</span>
			</span>
                            </div>
                            <div class="total-count-pay-info">
			<span>

				商品总额：

				<span class="SZY-GOODS-AMOUNT">{{ $cart_info['order']['goods_amount_format'] }}</span>
			</span>
                                <em>+</em>
                                <span>
				运费：
				<span class="SZY-SHIPPING-FEE-AMOUNT">{{ $cart_info['order']['shipping_fee_format'] }}</span>
			</span>
                                <span class="SZY-ORDER-CASH-MORE-AMOUNT" style='display: none;'>
				<em>+</em>
				<span>
					货到付款加价：
					<span>{{ $cart_info['order']['cash_more_format'] }}</span>
				</span>
			</span>
                                <em>-</em>
                                <span>
				红包：
				<span class="SZY-ORDER-BONUS-AMOUNT">{{ $cart_info['order']['total_bonus_amount_format'] }}</span>
			</span>
                                <em>-</em>
                                <span>
				优惠：
				<span class="">{{ $cart_info['order']['discount_fee_format'] }}</span>
			</span>
                                <span class="SZY-ORDER-STORE-CARD" style='display: none;'>
				<em>-</em>
				<span>
					店铺购物卡：
					<span class="SZY-ORDER-STORE-CARD-AMOUNT">{{ $cart_info['order']['shop_store_card_amount_format'] }}</span>
				</span>
			</span>
                                <em>-</em>
                                <span>
				余额：
				<span class="SZY-ORDER-BALANCE">{{ $cart_info['order']['balance_format'] }}</span>
			</span>
                                <em>=</em>
                                <span class="end second-color">
				应付款：
				<span class="SZY-ORDER-MONEY-PAY">{{ $cart_info['order']['money_pay_format'] }}</span>
			</span>
                            </div>
                        </div>
                    </div>

                    @if($cart_info['user_info']['balance_password_enable'])
                        <div class="balance-password">
                            <div class="form-group form-group-spe SZY-BALANCE-PASSWORD" style="display: none;">
                                <div class="form-control-box">
                                    <label class="input-left">
                                        <span>支付密码：</span>
                                    </label>
                                    <input type="password" id="balance_password" placeholder="请输入余额支付密码" class="form-control">
                                    <a href="/user/security/edit-surplus-password.html" target="_blank" title="忘记密码？" class="forget-password">忘记密码？</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="submit-box fr">
                        <!--<div class="price-box fl">
                            <span>应付总额：</span>
                            <span class="price color SZY-ORDER-AMOUNT">￥7.8</span>
                        </div>-->

                        <div class="fr">
                            <a href="javascript:void(0);" class="submit-btn gopay bg-color">确认交易</a>
                        </div>
                    </div>

                </div>

            </div>

            <!-- 新增地址弹框 -->
            <div class="bomb-box addr-box">
                <div class="box-title">使用新地址</div>
                <div class="box-oprate addr-box-oprate"></div>
                <div class="content-info" id="edit-address-div"></div>
            </div>

            <!-- 发票信息弹框 -->
            <div class="bomb-box invoice-box"><div class="box-title">发票信息</div>
                <div class="box-oprate invoice-box-oprate"></div>
                <div class="content-info">
                    <div class="tab-nav">
                        <ul>

                            @foreach($invoice_info as $k=>$v)
                            <li class="tab-nav-item  @if($v['selected'] == 'selected'){{ 'tab-item-selected' }}@endif"
                                data-invoice-type="{{ $k }}" data-invoice-name="{{ $v['name'] }}">
                                {{ $v['name'] }}
                                <b></b>
                            </li>
                            @endforeach

                        </ul>
                    </div>


                    @foreach($invoice_info as $k=>$v)
                        @if($k == 0)
                            <!-- 普通税发票 _star -->
                            <form id="invoice_type_0" action="" method="post" class="form-horizontal" @if($v['selected'] != 'selected')style="display: none;"@endif>
                                <div class="act">
                                    <input type="button" value="保存发票信息" class="inv_submit">
                                    <input type="button" value="取消" class="m-l-10 inv_cancle">
                                </div>
                            </form>
                            <!-- 普通税发票 _end -->

                        @elseif($k == 1)
                            <!-- 增值税发票 _end -->
                                <form id="invoice_type_1" action="" method="post" class="form-horizontal" @if($v['selected'] != 'selected')style="display: none;"@endif>
                                    <input type="hidden" name="inv_type" value="1">
                                    <input type="hidden" name="inv_name" value="增值税普通发票">
                                    <div class="form-group form-group-spe">
                                        <label class="input-left">
                                            <span>发票抬头：</span>
                                        </label>
                                        <div class="form-control-box">
                                            <div class="invoice-list invoice-tit-list" id="invoice-tit-list">
                                                <!-- 选中的发票抬头 给下面的 div 追加 class 值为 'invoice-item-selected' _star-->
                                                <div class="invoice-item invoice-title invoice-item-selected">
						<span class="fore2">
							<input type="radio" id="inv_title_0" name="inv_title" value="个人" readonly onFocus="javascript:$(this).blur();" style="display: none;" @if($v['contents']['inv_title'] == '个人' || empty($v['contents']['inv_title']))checked="checked"@endif>
							个人
							<b></b>
						</span>
                                                </div>
                                                <!-- 选中的发票抬头 给下面的 div 追加 class 值为 'invoice-item-selected' _end-->
                                                <div id="add-invoice" class="invoice-item invoice-title ">
						<span class="fore2">
							<input type="radio" id="inv_title_1" name="inv_title" value="单位" readonly onFocus="javascript:$(this).blur();" style="display: none;" @if($v['contents']['inv_title'] == '单位'))checked="checked"@endif>
							单位
							<b></b>
						</span>
                                                </div>
                                                <div id="save-invoice" class="@if($v['contents']['inv_title'] == '个人'){{ 'hide' }}@endif">
                                                    <div class="add-invoice-tit">
                                                        <input type="text" name="inv_company" value="{{ $v['contents']['inv_company'] ?? '' }}" class="add-invoice" placeholder="单位名称" />
                                                    </div>
                                                    <div class="add-invoice-tit" style="margin-top: 10px;">
                                                        <input type="text" id="inv_taxpayers" name="inv_taxpayers" value="{{ $v['contents']['inv_taxpayers'] ?? '' }}" class="add-invoice" placeholder="纳税人识别号" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-spe">
                                        <label class="input-left">
                                            <span>发票内容：</span>
                                        </label>
                                        <div class="form-control-box invoice-content">
                                            <div class="invoice-list">
                                                <ul>
                                                    <!-- invoice-item-selected -->
                                                    @foreach($v['content_list'] as $ck=>$cv)
                                                    <li class="invoice-item invoice-type @if($cv['checked']){{ 'invoice-item-selected' }}@endif"
                                                        data="{{ $cv['name'] }}" title="{{ $cv['name'] }}">
                                                        <label for="inv_content_{{ $ck }}">
                                                            <input type="radio" id="inv_content_{{ $ck }}" name="inv_content"
                                                                   value="{{ $ck }}" class="add-invoice" style="display: none;" @if($cv['checked'])checked="checked"@endif>
                                                            {{ $cv['name'] }}
                                                        </label>
                                                        <b></b>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="act">
                                        <input type="button" value="保存发票信息" class="inv_submit">
                                        <input type="button" value="取消" class="m-l-10 inv_cancle">
                                    </div>
                                </form>
                                <!-- 增值税发票 _end -->
                        @elseif($k == 2)
                            <!-- 增值税专用发票 _star -->
                                <form action="" id="invoice_type_2" method="post" class="form-horizontal" @if($v['selected'] != 'selected')style="display: none;"@endif>
                                    <input type="hidden" name="inv_type" value="2">
                                    <input type="hidden" name="inv_name" value="增值税专用发票">
                                    <input type="hidden" name="inv_content" value="明细">
                                    <div class="form-group form-group-spe form-control-box">
                                        <label class="input-left">
                                            <span class="spark">*</span>
                                            <span>单位名称：</span>
                                        </label>
                                        <div class="form-control-box">
                                            <input type="text" name="inv_company" value="{{ $v['contents']['inv_company'] ?? '' }}"
                                                   placeholder="请输入单位名称" class="" data-rule-required="true" data-msg-required="请输入单位名称">
                                        </div>
                                        <span class="form-control-error 2"></span>
                                    </div>
                                    <div class="form-group form-group-spe form-control-box">
                                        <label class="input-left">
                                            <span class="spark">*</span>
                                            <span>纳税人识别号：</span>
                                        </label>
                                        <div class="form-control-box">
                                            <input type="text" name="inv_taxpayers" value="{{ $v['contents']['inv_taxpayers'] ?? '' }}" placeholder="请输入纳税人识别号"
                                                   class="" data-rule-required="true" data-msg-required="请输入纳税人识别号">
                                        </div>
                                        <span class="form-control-error 2"></span>
                                    </div>
                                    <div class="form-group form-group-spe form-control-box">
                                        <label class="input-left">
                                            <span class="spark">*</span>
                                            <span>注册地址：</span>
                                        </label>
                                        <div class="form-control-box">
                                            <input type="text" name="inv_address" value="{{ $v['contents']['inv_address'] ?? '' }}" placeholder="请输入注册地址"
                                                   class="" data-rule-required="true" data-msg-required="请输入注册地址">
                                        </div>
                                        <span class="form-control-error 2"></span>
                                    </div>
                                    <div class="form-group form-group-spe form-control-box">
                                        <label class="input-left">
                                            <span class="spark">*</span>
                                            <span>注册电话：</span>
                                        </label>
                                        <div class="form-control-box">
                                            <input type="text" name="inv_tel" value="{{ $v['contents']['inv_tel'] ?? '' }}" placeholder="请输入注册电话" class="" data-rule-required="true" data-msg-required="请输入注册电话">
                                        </div>
                                        <span class="form-control-error 2"></span>
                                    </div>
                                    <div class="form-group form-group-spe form-control-box">
                                        <label class="input-left">
                                            <span class="spark">*</span>
                                            <span>开户银行：</span>
                                        </label>
                                        <div class="form-control-box">
                                            <input type="text" name="inv_account" value="{{ $v['contents']['inv_account'] ?? '' }}" placeholder="请输入开户银行" class="" data-rule-required="true" data-msg-required="请输入开户银行">
                                        </div>
                                        <span class="form-control-error 2"></span>
                                    </div>
                                    <div class="form-group form-group-spe form-control-box">
                                        <label class="input-left">
                                            <span class="spark">*</span>
                                            <span>银行账户：</span>
                                        </label>
                                        <div class="form-control-box">
                                            <input type="text" name="inv_bank" value="{{ $v['contents']['inv_bank'] ?? '' }}" placeholder="请输入银行账户" class="" data-rule-required="true" data-msg-required="请输入银行账户">
                                        </div>
                                        <span class="form-control-error 2"></span>
                                    </div>
                                    <div class="act">
                                        <input type="button" value="保存发票信息" class="inv_submit">
                                        <input type="button" value="取消" class="m-l-10 inv_cancle">
                                    </div>
                                </form>
                                <!-- 增值税专用发票 _end -->
                        @endif

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- 付款信息弹框 -->
    <div class="bomb-box payment-box">
        <div class="box-title">请付款</div>
        <div class="content-info">
            <p class="warning">
                <i></i>
                <span>请您在新打开的页面上完成付款。</span>
            </p>
            <p class="prompt">付款完成前请不要关闭此窗口</p>
            <p class="prompt">完成付款后请根据您的情况点击下面的按钮</p>
            <p class="btns">

                <a href="/checkout/result.html?key={{ $cart_info['key'] }}" class="pay_result">已完成付款</a>
                <a href="/checkout/result.html?key={{ $cart_info['key'] }}" class="m-l-10 pay_result">付款遇到问题</a>

            </p>
            <!-- <p class="back">
                <a href="/user/result/pay.html" title="返回选择其他的支付方式" class="color">&gt;&gt; 返回选择其他的支付方式</a>
            </p> -->
        </div>
    </div>

    <!-- 订单返现信息弹框 -->
    <!-- 	<div class="order-cashback">
            <div class="content-info">
                <i class="iconfont close">&#xe6f8;</i>
                <p class="warning">
                    <i class="warning-img"></i>
                    <span>恭喜您获得<em>10.00</em>元返现</span>
                </p>
                <div class="prompt">
                    <p class="title">备注</p>
                    <p class="order-info">
                        <span>20180806064306358800</span>，
                        注意：店铺名称限制显示字数 16 个
                        <span>美廉美超市</span>，
                        <span>返现：<em>2.00</em>元</span>
                    </p>
                    <p class="order-info">
                        <span>20180806064306358800</span>，
                        <span>美廉美超市美廉美超市美廉美超市</span>，
                        <span>返现：<em>10.00</em>元</span>
                    </p>
                </div>
            </div>
        </div> -->

@stop


{{--底部js--}}
@section('footer_js')
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder"></script>
    <!-- 表单验证 -->
    <!-- 鼠标滚轮 -->
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/js/checkout.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js"></script>
    <script src="/js/tabs.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script>
        //海关是否有误
        var cross_border_code="0";
        if(cross_border_code==-1){
            var cross_border_message="";
            $.msg(cross_border_message, {
                time: 5000
            }, function() {
                history.back(-1);
            });
        }
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
    </script>
@stop
