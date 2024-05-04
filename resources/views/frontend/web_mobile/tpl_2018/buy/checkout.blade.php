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
        <div class="content-info">
            <!-- 引入头部文件 -->
            <header>
                <div class="header">
                    <div class="header-left">
                        <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                            <i class="iconfont">&#xe606;</i>
                        </a>
                    </div>
                    <div class="header-middle">确认订单</div>
                    <div class="header-right">
                        <!-- 控制展示更多按钮 -->
                        <aside class="show-menu-btn">
                            <div class="show-menu" id="show_more">
                                <a href="javascript:;">
                                    <i class="iconfont">&#xe6cd;</i>
                                </a>
                            </div>
                        </aside>
                    </div>
                </div>
            </header>
            <!-- 用户自定义信息 -->
            <!-- 收货地址 -->
            <div class="address-container border-line" id="addressinfo">
                <div id="user_address_list">
                    <div id="address-content" class="main-content">
                        <!--存在自提点-->
                        <!--收货地址-->
                        @if(!empty($address_info))
                            <div class="address-info recive-address">
                                <dl>
                                    <dt>
                                        <p class="name-phone">
                                            <span class="name">{{ $address_info['consignee'] }}</span>
                                            <span class="phone">{{ $address_info['mobile_format'] }}</span>
                                        </p>
                                        <p class="address-address-detail">
                                            <span>收货地址：{{ $address_info['region_name'] }} {{ $address_info['address_detail'] }} {{ $address_info['address_house'] }}</span>
                                        </p>
                                        <i class="iconfont"></i>
                                    </dt>
                                </dl>
                                <!-- -->
                            </div>
                        @else
                            <div class="address-none">
                                <a href="javascript:void(0)" class="new-addr-add color">
                                    <span class="iconfont">
                                        <i class="bg-color row"></i>
                                        <i class="bg-color col"></i>
                                    </span>
                                    新建收货地址
                                    <span class="right-arrow-flow ">
                                        <i class="iconfont"></i>
                                    </span>
                                </a>
                            </div>
                            <script type="text/javascript">
                                $().ready(function() {
                                    $.confirm("您还没有收货地址，现在去添加收货地址吗？", function() {
                                        $.go('/user/address/add.html?back_url=/checkout.html');
                                    });
                                });
                            </script>
                        @endif

                    </div>
                    <!-- 地址容器 -->
                    <div class="addressmone" id="edit-address-div"></div>
                </div>

                <script type="text/javascript">
                    //
                </script>
            </div>

            <!-- 所有店铺商品清单 -->

            @foreach($cart_info['shop_list'] as $shop_id=>$shop)
                <div class="order-goods-box">
                    <!-- 商品清单 -->
                    <div class="order-list">
                        <h2>
                            <a href='javascript:void(0)'>
                                <i class="shop-icon"></i>
                                <span>
                        <font class="text-ellipsis">{{ $shop['shop_info']['shop_name'] }}</font>

                        <em class="self-employed-label">{{ str_replace([0,1,2],['自营','个人店铺','企业店铺'], $shop['shop_info']['shop_type']) }}</em>


                    </span>
                            </a>
                            <i>
                                <a href="/shop/{{ $shop_id }}.html"></a>
                            </i>
                        </h2>
                        <!-- 店铺打烊标识 -->

                        @foreach($shop['goods_list'] as $goods)
                        <a href="javascript:void(0)">
                            <div class="order-list-goods goods_16" id="sku_{{ $goods['sku_id'] }}">
                                <dl>
                                    <dt>
                                        <img src="{{ get_image_url($goods['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220">
                                    </dt>
                                    <dd>

                                        <div class="name">
                                            <strong>
                                                <!-- 活动色块 -->




                                                {{ $goods['goods_name'] }}
                                            </strong>
                                        </div>
                                        <span class="goods-attr">
                                            @if(!empty($goods['spec_names']))
                                                {{ implode(' ',$goods['spec_names']) }}
                                            @endif
                                        </span>
                                        <div class="goods-subtotal">
                                            <span class="goods-price price-color">
                                                <em>{{ $goods['goods_price_format'] }}</em>
                                            </span>
                                            <span class="goods-num">x{{ $goods['goods_number'] }}</span>
                                        </div>
                                    </dd>



                                </dl>
                            </div>
                        </a>
                        <!-- 赠品 -->

                        @endforeach

                    </div>
                    <!-- 預售信息 -->
                    <div class="order-detail">
                        <!-- 店铺优惠 -->
                        <!-- 配送方式 -->

                        <div class="goods-postage border-bottom-none ub">
                            <div class="goods-postage-title">配送方式</div>
                            <!-- -->
                            <ul class="shop-favorable-info clearfix shipping-select-box ub-f1" style="display: block;">
                                @foreach($shop['shipping_list'] as $shipping_info)
                                    <!---->

                                    <li class="@if($shipping_info['selected'] == 'selected'){{ 'active' }}@endif" id="postage-box-{{ $shipping_info['id'] }}-{{ $shop_id }}" data-shop-id="{{ $shop_id }}" data-id="{{ $shipping_info['id'] }}" data-name="{{ $shipping_info['name'] }}" data-price="{{ $shipping_info['price'] }}" data-price-format="{{ $shipping_info['price_format'] }}元">
                                        <span>{{ $shipping_info['name'] }}</span>
                                    </li>
                                @endforeach


                                <!---->
                            </ul>
                            <!---->
                        </div>
                        <div class="bdr-bottom">
                            <p class="postage-info postage-info-1">
                                <em class="price-color">{{ $shop['order']['shipping_fee_format'] }}</em>
                            </p>
                            <div class="pickup-address" id="pickup_address_{{ $shop_id }}" >
                                <label>
                                    自提点：
                                    <span id='pickup_name'></span>
                                    <a class="pickup-edit color" data-shop_id={{ $shop_id }}>修改</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="goods-annex goods-freebuy">
                        <div class="goods-message">
                            <span class="msg-title">买家留言：</span>
                            <div class="buyer-msg">
                                <textarea class="text postscript" onfocus="hideNav()" onblur="showNav()" data-shop-id="{{ $shop_id }}" placeholder="选填，可填写您与卖家达成一致的要求"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="checkbar" id="shop_count_{{ $shop_id }}">
                        <div class="bagging-con p-t-10">

                        </div>
                        <div class="real-pay">
                            <span class="hd">
                                店铺合计
                                （含运费）
                                ：
                            </span>
                            <span class="bd">
                                <em class="SZY-SHOP-ORDER-AMOUNT-{{ $shop_id }} price-color" data-shop-id="{{ $shop_id }}">￥{{ $shop['order']['order_amount'] }}元</em>
                            </span>
                        </div>

                    </div>
                </div>


                <!-- 新加 start  选择自提点 -->
                <div class="bomb-box pickup-bomb-box logistics-choosen-{{ $shop_id }} pickup-bomb-hide">
                    <div class="box-title bdr-bottom">选择自提点</div>
                    <!--<div class="box-oprate"></div>-->
                    <div class="content-info">
                        <form class="">
                            <ul class="logistics-store-list-{{ $shop_id }} logistics-store-list">

                                @if(!empty($shop['shop_info']['pickup_list']))
                                    @foreach($shop['shop_info']['pickup_list'] as $pickup)
                                        <li class="logistics-item">
                                            <label>
                                                <input class="logistics-radio" type="radio" name="logistics" data-shop_id={{ $pickup['shop_id'] }} data-id="{{ $pickup['shop_id'] }}" data-pickup_name={{ $pickup['pickup_name'] }} data-pickup_id={{ $pickup['pickup_id'] }} data-multi_store_id="{{ $pickup['multi_store_id'] ?? '' }}" >
                                                <div class="logistics-inner" data-id={{ $pickup['pickup_id'] }}>
                                                    <p class="logistics-name">{{ $pickup['pickup_name'] }}</p>
                                                    <p class="logistics-address">{{ $pickup['pickup_address'] }}</p>
                                                    <p class="logistics-tel">{{ $pickup['pickup_tel'] }}</p>
                                                </div>
                                            </label>
                                        </li>
                                        <!--   -->
                                    @endforeach
                                @endif

                            </ul>
                        </form>
                    </div>
                    <div class="pickup-bomb-btn"><a href="javascript:void(0)">关闭</a></div>
                </div>
                <div class="mask-div"></div>
                <!-- 新加 end  选择自提点 -->

            @endforeach

            <!-- 送货时间 -->
            <!--配送时间-->
            @if($send_time_show)
                <div class="order-detail delivery-time-box">
                    <div class=" order-blcok" id="set_time_blcok">
                        <div class="delivery-time">
                            配送时间
                            <span class="right-arrow-flow ">
                                <font id="best_time_message">
                                    {{ $best_time }}
                                </font>
                                <i class="iconfont">&#xe607;</i>
                            </span>
                        </div>
                        <div class="delivery-time-desc">送货时间仅供参考，快递公司会尽量满足您的要求</div>
                    </div>
                    <ul class="delivery-time-info">
                        <!-- 选中的送货时间 给下面的div增加class值"active" 也就是class="box active" _star-->
                        @foreach($send_time_list as $st_key=>$send_time)
                            @if($send_time['set_time']){{--指定送货时间--}}
                            <li class="box box-spe @if($send_time['checked'] == 'checked'){{ 'active2' }}@endif" id="set_best_time_box">

                                <input type="radio" id="set_best_time" class="time-seleted" data-set-time="{{ $send_time['value'] }}" name="best_time" value="{{ $st_key }}" @if($send_time['checked'] == 'checked'){{ 'checked' }}@endif />
                                <span>{{ $send_time['value'] }}</span>
                                <font class="best-time-desc color">{{ $best_time ?? '' }}</font>

                            </li>
                            @else
                                <li class="box @if($send_time['checked'] == 'checked'){{ 'active' }}@endif best-time-li">
                                    <label>
                                        <input type="radio" data-set-time="{{ $send_time['value'] }}" class="time-seleted best-time" name="best_time" value="{{ $st_key }}" @if($send_time['checked'] == 'checked'){{ 'checked' }}@endif />
                                        <span>{{ $send_time['value'] }}</span>
                                    </label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- 指定送货具体时间 _star-->

                    @if(isset($send_time_list[4])){{--指定送货时间--}}
                    <div class="f_block" id="seltimebox_coupon" style="height: 0;">
                        <div class="seltimebox-coupon">
                            <div class="seltimebox">
                                <div class="seltimebox-left">
                                    <ul>
                                        @foreach($send_time['best_time'] as $bt_key=>$bt_value)
                                            <li @if($bt_key == 0) class="cur" @endif onclick="show_best(this,{{ $bt_key }})">{{ $bt_value['name'] }} （{{ $bt_value['week'] }}）</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="seltimebox-right">
                                    <ul>
                                        @foreach(array_first($send_time['best_time'])['time'] as $time_key=>$time_text)
                                            @foreach($send_time['best_time'] as $bt_key=>$bt_value)
                                            <li id="show_best_{{ $time_key }}_{{ $bt_key }}"  @if($bt_key == 0)style="display: block;" @endif
                                                data-set-time="{{ $bt_value['name'] }}{{ $bt_value['week'] }}:{{ $time_text['text'] }}" class="set_time ">{{ $time_text['text'] }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="seltimebox-fooger">
                                <a href="javascript:void(0)" onclick="close_seltimebox_coupon();">取消</a>
                            </div>
                        </div>


                    </div>
                    @endif

                    <!-- 指定送货具体时间 _end-->

                </div>
                <!--指定时间弹出层-->
                <div class="mask-div" style="display: none;"></div>
                <script type="text/javascript">
                    //
                </script>
            @endif

            <!-- 平台红包 -->
            <!-- 发票信息 -->

            <!--发票类型-->
            @if($invoice_show)
            <div class="invoice-info clearfix">
                <div class="invoice_block ub">
                    <h3>发票信息</h3>
                    <!-- <input type="checkbox" value="" id="invoice" class="invoice-btn" /> -->
                    <div class="right-arrow-flow ub-f1 ub">
                        <div class="invoice-name inv-info text-ellipsis ub-f1" id="invoice">

                            不开发票&nbsp;&nbsp;

                        </div>
                        <i class="iconfont">&#xe607;</i>
                    </div>

                </div>
            </div>
            <!--不支持开发票商品弹出层-->

            <script>
                //
            </script>
            @endif


            <!-- 支付方式 -->
            <div class="pay-type-content">
                <!--支付详情-->
                <div class="total-count-pay-con">
                    <div class="total-count-pay-info">
			<span class="info-l">
				商品总额
			</span>
                        <span class="info-r SZY-GOODS-AMOUNT price-color">{{ $cart_info['order']['goods_amount_format'] }}</span>
                    </div>
                    <div class="total-count-pay-info">
                        <span class="info-l">运费</span>
                        <span class="info-r SZY-SHIPPING-FEE-AMOUNT price-color">+{{ $cart_info['order']['shipping_fee_format'] }}</span>
                    </div>
                    <div class="total-count-pay-info">
                        <span class="info-l">红包</span>
                        <span class="info-r SZY-ORDER-BONUS-AMOUNT price-color">{{ $cart_info['order']['total_bonus_amount_format'] }}</span>
                    </div>
                    <div class="total-count-pay-info">
                        <span class="info-l">优惠</span>
                        <span class="info-r price-color">-{{ $cart_info['order']['discount_fee_format'] }}</span>
                    </div>
                    <div class="total-count-pay-info SZY-ORDER-STORE-CARD" style='display: none;'>
                        <span class="info-l">店铺购物卡</span>
                        <span class="info-r SZY-ORDER-STORE-CARD-AMOUNT price-color">-{{ $cart_info['order']['shop_store_card_amount_format'] }}</span>
                    </div>
                    <div class="total-count-pay-info">
                        <span class="info-l">余额</span>
                        <span class="info-r SZY-ORDER-BALANCE price-color">{{ $cart_info['order']['balance_format'] }}</span>
                    </div>
                </div>
                <div class="blank-div"></div>
                <!--支付详情end-->
                <!-- 余额支付 -->
                <!--余额支付关闭状态 不显示-->
                @if($cart_info['user_info']['balance'] > 0)
                <div class="surplus-pay" id="balance_money_pay">
                    剩余应付金额
                    <em class="SZY-ORDER-MONEY-PAY price-color">

                        {{ $cart_info['user_info']['pay_point_amount_format'] }}

                    </em>
                    请选择以下支付方式支付
                </div>
                @else
                    <div class="surplus-pay" id="balance_money_pay">
                        应付金额
                        <em class="SZY-ORDER-MONEY-PAY price-color">

                            {{ $cart_info['order']['money_pay_format'] }}

                        </em>
                        请选择以下支付方式支付
                    </div>
                @endif
                <!--支付方式-->

                <!-- 银行支付方式调用 -->
                <div class="pay-all" id="pay_bank">
                    <ul class="payment-tab" id="paylist" style="display: none;">

                        @foreach($pay_list as $pay_info)
                            @if($pay_info['code'] == 'cod')
                                <li style="display: none;"  class="cash-on-delivery">
                                    <i class="iconfont"></i>
                                    <span>货到付款</span>
                                    <em>
                                        <s></s>
                                        加价{{ $cart_info['order']['cash_more_format'] }}元
                                    </em>
                                    <input type="radio" id="pac_code_-1" name="pay_code" class="pay-code pay-way-checkbox" value="cod">
                                    <div class="check-div">
                                        <label></label>
                                    </div>
                                </li>
                            @else
                                <li  class="{{ $pay_info['code'] }}">
                                    <i class="iconfont"></i>
                                    <span>{{ $pay_info['name'] }}</span>
                                    <em>
                                        <s></s>
                                        加价{{ $cart_info['order']['cash_more_format'] }}元
                                    </em>
                                    <input type="radio" id="pac_code_{{ $pay_info['id'] }}" name="pay_code"
                                           class="pay-code pay-way-checkbox" value="{{ $pay_info['code'] }}" @if($pay_info['checked'] == 'checked'){{ 'checked' }}@endif>
                                    <div class="check-div">
                                        <label></label>
                                    </div>
                                </li>
                            @endif
                        @endforeach

                    </ul>

                    {{--todo 暂时关闭其他支付方式--}}
                    <!--找人代付-->
                    <div class="blank-div"></div>
                    {{--<div id="other_pay" style="display: none;">
                        <h3 class="payment-title bdr-bottom">其它支付方式</h3>
                        <ul class="payment-tab">
                            <li class="to-pay">
                                <i class="iconfont"></i>
                                <span>找人代付</span>
                                <input type="radio" id="pac_code_99" name="pay_code" class="pay-code pay-way-checkbox" value="to_pay">
                                <div class="check-div">
                                    <label></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <script type='text/javascript'>
                        //
                    </script>--}}
                </div>
            </div>
            <input type="hidden" id="payment_key" value="">
            <script>
                //
            </script>
            <!-- 拼团玩法 -->
            <!-- 提交订单 -->
            <div class="confirm-pay" id="checkout_amount"><div class="blank-div-height"></div>
                <div class="confirm-pay-con ">
                    <div class="confirm-pay-address"> @if(!empty($address_info)){{ $address_info['region_name'] }} {{ $address_info['address_detail'] }} {{ $address_info['address_house'] }}@endif</div>
                    <div class="order-footer">
                        <div class="total">
                            <dl class="total-money">
                                <dt>总合计：</dt>
                                <dd class="SZY-ORDER-MONEY-PAY price-color">
                                    <em>{{ $cart_info['order']['order_amount_format'] }}元</em>
                                </dd>
                            </dl>
                        </div>
                        <div class="order-btn bg-color">
                            <a href="javascript:void(0)" class="gopay">提交订单</a>
                        </div>
                    </div>
                </div>
                <script>
                    //
                </script>
            </div>
        </div>
        <script>
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
                            @foreach($invoice_info as $k=>$v)
                                <li class="tab-nav-item  @if($v['selected'] == 'selected'){{ 'tab-item-selected' }}@endif"
                                    data-invoice-type="{{ $k }}" data-invoice-name="{{ $v['name'] }}">
                                    {{ $v['name'] }}
                                    <b></b>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            @foreach($invoice_info as $k=>$v)
                @if($k == 0)
                <!-- 普通税发票 _star -->
                <form id="invoice_type_0" action="" method="post" class="form-horizontal" @if($v['selected'] != 'selected')style="display: none;"@endif>
                    <div class="invoice-footer act">
                        <input type="button" value="保存发票信息" class="save inv_submit">
                        <input type="button" value="取消" class="m-l-10 cancle inv_cancle">
                    </div>
                </form>
                <!-- 普通税发票 _end -->

                @elseif($k == 1)
                <!-- 增值税发票 _star -->
                <form action="" id="invoice_type_1" method="post" class="form-horizontal" @if($v['selected'] != 'selected')style="display: none;"@endif>
                    <input type="hidden" name="inv_type" value="1">
                    <input type="hidden" name="inv_name" value="增值税普通发票">
                    <div class="invoice-header clearfix m-b-0 p-b-0">
                        <div class="invoice-header-mt">发票抬头</div>

                        <div class="form-control-box">
                            <div class="invoice-list invoice-tit-list" id="invoice-tit-list">
                                <!-- 选中的发票抬头 给下面的 div 追加 class 值为 'invoice-item-selected' _star-->
                                <div class="invoice-item invoice-title invoice-item-selected">
						<span class="fore2">
							<input type="radio" id="inv_title_0" name="inv_title" value="个人" onFocus="javascript:$(this).blur();" style="display: none;" @if($v['contents']['inv_title'] == '个人' || empty($v['contents']['inv_title']))checked="checked"@endif>
							个人
							<b></b>
						</span>
                                </div>
                                <!-- 选中的发票抬头 给下面的 div 追加 class 值为 'invoice-item-selected' _end-->
                                <div id="add-invoice" class="invoice-item invoice-title ">
						<span class="fore2">
							<input type="radio" id="inv_title_1" name="inv_title" value="单位" onFocus="javascript:$(this).blur();" style="display: none;" @if($v['contents']['inv_title'] == '单位'))checked="checked"@endif>
							单位
							<b></b>
						</span>
                                </div>
                                <div class="clearfix"></div>
                                <div id="save-invoice" class="@if($v['contents']['inv_title'] == '个人'){{ 'hide' }}@endif">
                                    <div class="form-group form-group-spe bdr-0">
                                        <div class="form-control-box add-invoice-tit">
                                            <input type="text" name="inv_company" value="{{ $v['contents']['inv_company'] ?? '' }}" class="add-invoice company-name " data-rule-required="true" placeholder="单位名称" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-spe border-bottom">
                                        <div class="form-control-box add-invoice-tit" style="margin-bottom: 10px;">
                                            <input type="text" name="inv_taxpayers" value="{{ $v['contents']['inv_taxpayers'] ?? '' }}" class="add-invoice" placeholder="纳税人识别号" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-content clearfix">
                        <div class="invoice-content-mt">发票内容</div>

                        <div class="form-control-box">
                            <div class="invoice-list">
                                <ul>
                                    <!-- invoice-item-selected -->
                                    @foreach($v['content_list'] as $ck=>$cv)
                                        <li class="invoice-item invoice-type @if($cv['checked']){{ 'invoice-item-selected' }}@endif" data="{{ $cv['name'] }}">
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
                    <div class="invoice-footer act">
                        <input type="button" value="保存发票信息" class="save inv_submit">
                        <input type="button" value="取消" class="m-l-10 cancle inv_cancle">
                    </div>

                </form>
                <!-- 增值税发票 _end -->

                @elseif($k == 2)
                <!-- 增值税专用发票 _star -->
                <form action="" id="invoice_type_2" method="post" class="form-horizontal" @if($v['selected'] != 'selected')style="display: none;"@endif>
                    <input type="hidden" name="inv_type" value="2">
                    <input type="hidden" name="inv_name" value="增值税专用发票">
                    <input type="hidden" name="inv_content" value="明细">
                    <div class="form-group-box">
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>单位名称：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="text" id="inv_field_inv_company" name="inv_company" value="{{ $v['contents']['inv_company'] ?? '' }}" placeholder="请输入单位名称" class="" data-rule-required="true" data-msg-required="请输入单位名称">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>纳税人识别号：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="text" id="inv_field_inv_taxpayers" name="inv_taxpayers" value="{{ $v['contents']['inv_taxpayers'] ?? '' }}" placeholder="请输入纳税人识别号" class="" data-rule-required="true" data-msg-required="请输入纳税人识别号">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>注册地址：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="text" id="inv_field_inv_address" name="inv_address" value="{{ $v['contents']['inv_address'] ?? '' }}" placeholder="请输入注册地址" class="" data-rule-required="true" data-msg-required="请输入注册地址">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>注册电话：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="text" id="inv_field_inv_tel" name="inv_tel" value="{{ $v['contents']['inv_tel'] ?? '' }}" placeholder="请输入注册电话" class="" data-rule-required="true" data-msg-required="请输入注册电话">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>开户银行：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="text" id="inv_field_inv_account" name="inv_account" value="{{ $v['contents']['inv_account'] ?? '' }}" placeholder="请输入开户银行" class="" data-rule-required="true" data-msg-required="请输入开户银行">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="form-group form-group-spe">
                            <dl>
                                <dt>
                                    <span>银行账户：</span>
                                </dt>
                                <dd>
                                    <div class="form-control-box">
                                        <input type="text" id="inv_field_inv_bank" name="inv_bank" value="{{ $v['contents']['inv_bank'] ?? '' }}" placeholder="请输入银行账户" class="" data-rule-required="true" data-msg-required="请输入银行账户">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="invoice-footer act">
                        <input type="button" value="保存发票信息" class="save inv_submit">
                        <input type="button" value="取消" class="m-l-10 cancle inv_cancle">
                    </div>

                </form>
                <!-- 增值税专用发票 _end -->
                @endif

            @endforeach
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
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        @if(!empty($address_list))
        var address_lng = '{{ $address_info['address_lng'] ?? '' }}';
        var address_lat = '{{ $address_info['address_lat'] ?? '' }}';
        var address_id = '{{ $address_info['address_id'] ?? 0 }}';
        var region_code_mode = '0';
        if ((address_lng == '' || address_lat == '') && region_code_mode == 0) {
            $.confirm("为了更快速、更精确的将商品送达您的手中，请编辑您选择的收货地址，并在详细地址列表中选择离您最近的位置", function() {
                $.go("/user/address/edit.html?address_id=" + address_id + "&back_url=/checkout.html");
            });
        }
        $('.recive-address').click(function() {
            $.go("/checkout/user-address.html");
        });
        @endif


        @if($invoice_show)
            var scrollheight = 0;
            function invoice_coupon() {
                $("#invoice_coupon_box").addClass('show');
                scrollheight = $(document).scrollTop();
                $("body").css("top","-" + scrollheight+"px");
                $("body").addClass("visibly");

            }
            function close_coupon_box() {

                $('#invoice_coupon_box').removeClass('show');
                $("body").css("top","auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            }
        @endif


        // 
        $().ready(function() {
            $('.store-shipping-select-box li').click(function() {
                var ind = $(this).index()
                $(this).addClass('active bg-color').siblings().removeClass('active bg-color');
                $(this).removeClass('color').siblings().addClass('color');
                $('.address-info').eq(ind).removeClass('hide').siblings().addClass('hide');
                var shop_id = $(this).data("shop-id");
                var shipping_id = $(this).data("id");
                var shipping_list = [{
                    shop_id: shop_id,
                    shipping_id: shipping_id,
                }];
                changePayment({
                    shipping_list: shipping_list,
                    refresh: 1
                });
            });
            $('.store-shipping-select-box li.active').click();
            $('.consignee-bg').click(function() {
                $('.consignee-bg').hide();
                $('.consignee-popup .choose-foot').hide()
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
                $('.consignee-popup').animate({
                    height: 0
                }, [10000]);
                $('.consignee-close').removeClass('show');
            })
            $('body').on('click', '.consignee-list li', function() {
                $(this).find($('.consignee-seleted')).prop('checked', true)
                $(this).siblings().find($('.consignee-seleted')).prop('checked', false)
            });
            $('body').on('click','.del-consignee',function(e){
                e.stopPropagation();
                var id = $(this).data('id');
                var target = $(this);
                $.confirm("确定要删除此提货人？", function() {
                    $.post('/user/address/del-consignee',{
                        id: id
                    },function(result){
                        if(result.code == 0){
                            if($(target).parents('li').find('input[type="radio"]').is(':checked')){
                                $.go();
                            }else{
                                $(target).parents("li[data-id='"+id+"']").remove();
                            }
                        }
                        $.msg(result.message);
                    },'JSON');
                });
                return false;
            });
            //编辑提货人
            $('body').on('click','.edit-consignee',function(){
                add_consignee($(this).data('id'));
                return false;
            })
            //新增提货人
            function add_consignee(consignee_id)
            {
                var url = '/user/address/consignee.html';
                if(typeof(consignee_id) != "undefined"){
                    url += '?consignee_id='+consignee_id;
                }
                $.open({
                    type: 1,
                    title: '新建提货人',
                    width: '390px',
                    ajax: {
                        url: url
                    },
                    btn: ['确定', '取消'],
                    yes: function(index, obj) {
                        $(obj).find("#btn_validate_consignee").trigger("click",[call_back]);
                    }
                });
            }
            function call_back(data) {
                $.post("/checkout/user-consignee.html", {}, function(result) {
                    if (result.code == 0) {
                        $(".consignee-list").html(result.data);
                        $(".consignee-list").find('li[data-id="' + data.id + '"]').trigger('click');
                    } else {
                        $.msg(result.message);
                    }
                    $.closeAll();
                }, "JSON");
            }
        });
        // 
        var scrollheight = 0;
        function show_best(obj,key){
            $(obj).addClass('cur').siblings().removeClass('cur');
            $('.seltimebox-right ul li').hide();
            for(var i = 0; i<'3'; i++){
                $('.seltimebox-right ul').find("#show_best_"+i+"_"+key).show();
            }
        }
        function seltimebox_coupon(){
            $('#seltimebox_coupon').animate({
                height:'15.5rem'
            },[10000]);
            $(".mask-div").show();
            scrollheight = $(document).scrollTop();
            $("body").css("top","-" + scrollheight+"px");
            $("body").addClass("visibly");
        }
        function close_seltimebox_coupon(){
            $(".mask-div").hide();
            $("body").css("top","auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
            $('#seltimebox_coupon').animate({
                height:'0'
            },[10000]);
        }
        // 
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
        //底部收货地址滚动显示
        if (IsPC()) {
            $(window).scroll(function() {
                if ($(window).scrollTop() > 50) {
                    $(".confirm-pay").addClass('pay-address-show');
                } else {
                    $(".confirm-pay").removeClass('pay-address-show');
                }
            })
        } else {
            $(document).bind("touchmove", function(event) {
                $(window).scroll(function() {
                    if ($(window).scrollTop() > 50) {
                        $(".confirm-pay").addClass('pay-address-show');
                    } else {
                        $(".confirm-pay").removeClass('pay-address-show');
                    }
                });
            });
        }
        function IsPC() {
            var userAgentInfo = navigator.userAgent;
            var Agents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
            var flag = true;
            for (var v = 0; v < Agents.length; v++) {
                if (userAgentInfo.indexOf(Agents[v]) > 0) {
                    flag = false;
                    break;
                }
            }
            return flag;
        }
        // 
        var shop_id = "0";
        var rc_id = "";
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