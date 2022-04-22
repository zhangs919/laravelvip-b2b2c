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
                                            <input type="radio" data="1" name="best_time" value="{{ $st_key }}" id="set_best_time" @if($send_time['checked'] == 'checked'){{ 'checked' }}@endif />
                                            <span>{{ $send_time['value'] }}</span>
                                            <font class="best-time-desc color">{{ $best_time ?? '' }}</font>
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
                                                <input type="radio" data="0" class="best_time" name="best_time" value="{{ $st_key }}" @if($send_time['checked'] == 'checked'){{ 'checked' }}@endif />
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
										<img src="/images/shop-type/shop-icon1.png" />
									</span>
                                                    <span class="shop-name">店铺：</span>
                                                    <a href='{{ route('pc_shop_home', ['shop_id'=>$shop_id]) }}' target="_blank" title="" class="shop-info-name">{{ $shop['shop_info']['shop_name'] }}</a>
                                                    <span class="shop-customer">
										<!-- 客服 -->






                                                        <!-- s等于1时带文字，等于2时不带文字 -->
<a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxxxx&site=cntaobao&s=2&groupid=0&charset=utf-8">
	<img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxxxx&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
	<span></span>
</a>


									</span>
                                                </div>
                                            </div>
                                        </div>
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



                                                            <em class="activity-tag activity-tag3">限时折扣</em>

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
                                    <td colspan="6" class="goods-postage"><div class="postage">

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

                                            ￥6


                                        </div></td>
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
                                    <td colspan="3" class="goods-bill" id="shop_count_{{ $shop_id }}"><div class="bill">
                                            <p class="order-pay-vice">



                                            </p>

                                            <div class="order-pay second-color">
                                                店铺合计（含运费）：<strong class="second-color SZY-SHOP-ORDER-AMOUNT-{{ $shop_id }}" data-shop-id="{{ $shop_id }}">￥{{ $shop['order']['order_amount'] }}</strong>
                                            </div>


                                        </div></td>
                                </tr>
                            </table>

                            <!-- 新加 start  选择自提点 -->
                            <div class="bomb-box pickup-bomb-box logistics-choosen-1" style="display: none">
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
                                                            <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="{{ $pickup['shop_id'] }}" data-id="1" data-pickup_name="{{ $pickup['pickup_name'] }}" data-pickup_id="{{ $pickup['pickup_id'] }}">
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

                                    <span>不开发票</span>

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
                                <div id="other_pay">
                                    <h2 class="title">其它支付</h2>
                                    <div class="other-pay">
                                        <div class="hd">
                                            <label>
                                                <input type="radio" id="pac_code_99" name="pay_code" class="pay_code" value="to_pay">
                                                <img src="/assets/d2eace91/images/payment/pay-another.jpg" alt="" class="pay-img">
                                            </label>
                                        </div>
                                    </div>
                                </div>

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

                            <li class="tab-nav-item  tab-item-selected" data-invoice-type="0" data-invoice-name="不开发票">
                                不开发票
                                <b></b>
                            </li>


                            <li class="tab-nav-item  " data-invoice-type="1" data-invoice-name="增值税普通发票">
                                增值税普通发票
                                <b></b>
                            </li>


                            <li class="tab-nav-item  " data-invoice-type="2" data-invoice-name="增值税专用发票">
                                增值税专用发票
                                <b></b>
                            </li>

                        </ul>
                    </div>
                    <!-- 普通税发票 _star -->




                    <form id="invoice_type_0" action="" method="post" class="form-horizontal">
                        <div class="act">
                            <input type="button" value="保存发票信息" class="inv_submit">
                            <input type="button" value="取消" class="m-l-10 inv_cancle">
                        </div>
                    </form>
                    <!-- 增值税发票 _end -->




                    <form id="invoice_type_1" action="" method="post" class="form-horizontal" style="display: none;">
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
							<input type="radio" id="inv_title_0" name="inv_title" value="个人" readonly onFocus="javascript:$(this).blur();" style="display: none;" checked="checked">
							个人
							<b></b>
						</span>
                                    </div>
                                    <!-- 选中的发票抬头 给下面的 div 追加 class 值为 'invoice-item-selected' _end-->
                                    <div id="add-invoice" class="invoice-item invoice-title ">
						<span class="fore2">
							<input type="radio" id="inv_title_1" name="inv_title" value="单位" readonly onFocus="javascript:$(this).blur();" style="display: none;" >
							单位
							<b></b>
						</span>
                                    </div>
                                    <div id="save-invoice" class="hide">
                                        <div class="add-invoice-tit">
                                            <input type="text" name="inv_company" value="" class="add-invoice" placeholder="单位名称" />
                                        </div>
                                        <div class="add-invoice-tit" style="margin-top: 10px;">
                                            <input type="text" id="inv_taxpayers" name="inv_taxpayers" value="" class="add-invoice" placeholder="纳税人识别号" />
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
                                        <li class="invoice-item invoice-type invoice-item-selected" data="明细" title="明细">
                                            <label for="inv_content_0">
                                                <input type="radio" id="inv_content_0" name="inv_content" value="0" class="add-invoice" style="display: none;" checked="checked">
                                                明细
                                            </label>
                                            <b></b>
                                        </li>
                                        <li class="invoice-item invoice-type " data="办公用品" title="办公用品">
                                            <label for="inv_content_1">
                                                <input type="radio" id="inv_content_1" name="inv_content" value="1" class="add-invoice" style="display: none;" >
                                                办公用品
                                            </label>
                                            <b></b>
                                        </li>
                                        <li class="invoice-item invoice-type " data="电脑配件" title="电脑配件">
                                            <label for="inv_content_2">
                                                <input type="radio" id="inv_content_2" name="inv_content" value="2" class="add-invoice" style="display: none;" >
                                                电脑配件
                                            </label>
                                            <b></b>
                                        </li>
                                        <li class="invoice-item invoice-type " data="耗材" title="耗材">
                                            <label for="inv_content_3">
                                                <input type="radio" id="inv_content_3" name="inv_content" value="3" class="add-invoice" style="display: none;" >
                                                耗材
                                            </label>
                                            <b></b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="act">
                            <input type="button" value="保存发票信息" class="inv_submit">
                            <input type="button" value="取消" class="m-l-10 inv_cancle">
                        </div>
                    </form>
                    <!-- 普通税发票 _end -->
                    <!-- 增值税发票 _end -->





                    <!-- 增值税发票 _star -->
                    <form action="" id="invoice_type_2" method="post" class="form-horizontal" style="display: none;">
                        <input type="hidden" name="inv_type" value="2">
                        <input type="hidden" name="inv_name" value="增值税专用发票">
                        <input type="hidden" name="inv_content" value="明细">
                        <div class="form-group form-group-spe form-control-box">
                            <label class="input-left">
                                <span class="spark">*</span>
                                <span>单位名称：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="text" name="inv_company" value="" placeholder="请输入单位名称" class="" data-rule-required="true" data-msg-required="请输入单位名称">
                            </div>
                            <span class="form-control-error 2"></span>
                        </div>
                        <div class="form-group form-group-spe form-control-box">
                            <label class="input-left">
                                <span class="spark">*</span>
                                <span>纳税人识别号：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="text" name="inv_taxpayers" value="" placeholder="请输入纳税人识别号" class="" data-rule-required="true" data-msg-required="请输入纳税人识别号">
                            </div>
                            <span class="form-control-error 2"></span>
                        </div>
                        <div class="form-group form-group-spe form-control-box">
                            <label class="input-left">
                                <span class="spark">*</span>
                                <span>注册地址：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="text" name="inv_address" value="" placeholder="请输入注册地址" class="" data-rule-required="true" data-msg-required="请输入注册地址">
                            </div>
                            <span class="form-control-error 2"></span>
                        </div>
                        <div class="form-group form-group-spe form-control-box">
                            <label class="input-left">
                                <span class="spark">*</span>
                                <span>注册电话：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="text" name="inv_tel" value="" placeholder="请输入注册电话" class="" data-rule-required="true" data-msg-required="请输入注册电话">
                            </div>
                            <span class="form-control-error 2"></span>
                        </div>
                        <div class="form-group form-group-spe form-control-box">
                            <label class="input-left">
                                <span class="spark">*</span>
                                <span>开户银行：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="text" name="inv_account" value="" placeholder="请输入开户银行" class="" data-rule-required="true" data-msg-required="请输入开户银行">
                            </div>
                            <span class="form-control-error 2"></span>
                        </div>
                        <div class="form-group form-group-spe form-control-box">
                            <label class="input-left">
                                <span class="spark">*</span>
                                <span>银行账户：</span>
                            </label>
                            <div class="form-control-box">
                                <input type="text" name="inv_bank" value="" placeholder="请输入银行账户" class="" data-rule-required="true" data-msg-required="请输入银行账户">
                            </div>
                            <span class="form-control-error 2"></span>
                        </div>
                        <div class="act">
                            <input type="button" value="保存发票信息" class="inv_submit">
                            <input type="button" value="取消" class="m-l-10 inv_cancle">
                        </div>
                    </form>
                    <!-- 增值税发票 _end -->
                </div></div>
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

                <a href="/checkout/result.html?key=49142abae9d288f53c81e29fa1181fe3" class="pay_result">已完成付款</a>
                <a href="/checkout/result.html?key=49142abae9d288f53c81e29fa1181fe3" class="m-l-10 pay_result">付款遇到问题</a>

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


@section('outside_body_script')
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder"></script>
    <script src="/js/checkout.js?v=20180919"></script>
    <script src="/js/common.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180919"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <!-- 鼠标滚轮 -->
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20180919"></script>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
@stop