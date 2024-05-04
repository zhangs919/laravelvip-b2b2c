@extends('layouts.buy_layout')

@section('header_css')
    <link rel="stylesheet" href="/css/flow.css"/>
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

                    @foreach($steps as $step)
                    <li class="finish @if($step['selected']){{ 'finish-0'.$step['step'] }}@endif">
                        <i>{{ $step['step'] }}</i>
                        <span>
						<a href="{{ $step['url'] ?? 'javascript:;' }}">{{ $step['name'] }}</a>
					</span>
                        <b></b>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

    <div class="content-bg">
        <div class="content-main w990">
            <div class="payment">

                @if($merge_pay)
                    <!-- 合并付款 start -->

                    <div class="payment-adjust-box">
                        <div class="title title-line">
                            <h2>您正在为以下{{ count($order_list) }}笔交易进行合并付款！</h2>
                            <div class="order">
                                总额：
                                <strong class="second-color">￥{{ $money_pay }}</strong>
                            </div>
                        </div>
                        <div class="payment-order-info">
                            <ul>

                                @foreach($order_list as $item)
                                <!--点击选中添加selected样式-->
                                <li>
                                    <div class="list-wrap">
                                        <a class="fl">
                                            <span>订单号：{{ $item['order_sn'] }}</span>
                                            <span>购买时间：{{ $item['add_time_format'] }}</span>
                                        </a>
                                        <span class="fr">
                                            <strong>{{ $item['money_paid_format'] }}</strong>
                                        </span>
                                        <a class="hasDetail">
                                            <i>ˇ</i>
                                        </a>
                                    </div>
                                    <div class="detail-table">
                                        <dl>
                                            <dt>配送时间：</dt>
                                            <dd>{{ $item['best_time'] }}</dd>
                                        </dl>
                                        <dl>
                                            <dt>收货信息：</dt>
                                            <dd>
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

                @else
                    <!-- 二次付款 start -->
                    <div>
                        <h2 class="title">最后一步，请尽快付款！</h2>
                        <div class="order-num">
                            <p>
                                订单提交成功，请您尽快完成付款！
                                <span>订单号：{{ $order_sn }}</span>
                            </p>
                        </div>
                        <div class="order-info">
                            <div class="fl price-box" id="pay_amount">
                                <span>应付金额：</span>
                                <span class="price second-color">￥{{ $money_pay }}</span>
                            </div>
                            <div class="fl deliver-info">
                                <p class="address">{!! $remark_list[0] !!}</p>
                                <p class="time">{!! $remark_list[1] !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- 二次付款 end -->
                @endif

                <input type="hidden" id="order_id" value="{{ $order_id }}" />
                <input type="hidden" id="order_sn" value="{{ $order_sn }}" />
                <input type="hidden" id="key" value="{{ $key }}" />
                <!-- 支付方式 -->


                <div id="pay_type" class="pay-type border-line">
                    <div class="main-content">
                        <h2 class="title">支付方式</h2>
                        <div class="pay-type-content">
                            <!-- 积分支付 start -->

                            <!-- 积分支付 end -->

                            @if($balance_enable){{--todo --}}
                            <!-- 余额支付 start -->


                            <!-- 余额支付后面显示的应付款信息 -->
                            <p class="surplus-pay" id="balance_money_pay" >
                                剩余应付金额
                                <strong class="second-color SZY-ORDER-MONEY-PAY">

                                    ￥{{ $money_pay }}

                                </strong>
                                请选择以下支付方式支付
                            </p>

                            @endif

                            <!-- 银行支付方式调用 start -->
                            <div class="pay-all" id="pay_bank">


                                <ul id="paylist" class="payment-tab" >

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


                            </div>
                            <!-- 银行支付方式调用 end -->
                        </div>
                    </div>
                </div>

                <div class="submit-pay">
                    <a href="javascript:void(0);" class="submit-btn gopay bg-color" data-order-id="{{ $order_id }}">立即付款</a>
                </div>
            </div>
            <script type="text/javascript">
                //批量支付点击展示详细信息
                $('.hasDetail').click(function() {
                    if ($(this).parents('.payment-order-info li').hasClass('selected')) {
                        $(this).parents('.payment-order-info li').removeClass('selected');
                        $(this).parents(".payment-order-info li").find(".detail-table").slideToggle(200);
                    } else {
                        $(this).parents('.payment-order-info li').addClass('selected');
                        $(this).parents(".payment-order-info li").find(".detail-table").slideToggle(200);
                    }
                })
            </script>
            <link rel="stylesheet" href="/assets/d2eace91/css/highslide.css"/>
            <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>

            <script type="text/javascript">
                //图片弹窗
                hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
                hs.align = 'center';
                hs.transitions = ['expand', 'crossfade'];
                hs.outlineType = 'rounded-white';
                hs.fadeInOut = true;
                hs.addSlideshow({
                    interval: 5000,
                    repeat: false,
                    useControls: true,
                    fixedControls: 'fit',
                    overlayOptions: {
                        opacity: .75,
                        position: 'bottom center',
                        hideOnMouseOut: true
                    }
                });
            </script>
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

                <a href="/checkout/result.html?key={{ $key }}" class="pay_result">已完成付款</a>
                <a href="/checkout/result.html?key={{ $key }}" class="m-l-10 pay_result">付款遇到问题</a>

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
    <script src="/js/checkout_repay.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js"></script>
    <script src="/js/tabs.js"></script>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script>
        //批量支付点击展示详细信息
        $('.hasDetail').click(function() {
            if ($(this).parents('.payment-order-info li').hasClass('selected')) {
                $(this).parents('.payment-order-info li').removeClass('selected');
                $(this).parents(".payment-order-info li").find(".detail-table").slideToggle(200);
            } else {
                $(this).parents('.payment-order-info li').addClass('selected');
                $(this).parents(".payment-order-info li").find(".detail-table").slideToggle(200);
            }
        })
        //
        $(function(){
            //图片弹窗
            hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
            hs.align = 'center';
            hs.transitions = ['expand', 'crossfade'];
            hs.outlineType = 'rounded-white';
            hs.fadeInOut = true;
            hs.addSlideshow({
                interval: 5000,
                repeat: false,
                useControls: true,
                fixedControls: 'fit',
                overlayOptions: {
                    opacity: .75,
                    position: 'bottom center',
                    hideOnMouseOut: true
                }
            });
        })
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
