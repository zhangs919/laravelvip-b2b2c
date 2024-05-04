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

            @if($order['is_pay']){{--支付成功--}}
                <div class="payment-success">
                    <div class="payment-success-con">
                        <i></i>
                        <div class="payment-success-msg">
                            <h3 class="color">
                                感谢您，购买成功！
                            </h3>
                            <p>
                                共计支付
                                <a href="" class="color">{{ $order['order_amount_format'] }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="payment-success-order">
                        <p>购买商品已在处理中，我们将尽快为您发货！</p>
                        <p class="warn">
                            <span class="color">重要提醒：</span>
                            该商城不会以订单异常、系统升级等为由，要求您点击任何链接进行退款、重新付款、额外付款操作。请认准该网站唯一官方电话 400-078-5269 。
                        </p>
                        <div class="success-order-list">
                            <ul>
                                @foreach($order_list as $item)
                                    <li class="first">
                                        <span class="transaction">
                                            购买单号：
                                            <font class="color">
                                                <a href="/user/order/info.html?id={{ $item['order_id'] }}" target="_blank" title="点击查看订单" class="color">{{ $item['order_sn'] }}</a>
                                            </font>
                                        </span>
                                        <span class="payable">
                                            {{ $item['pay_name'] }}：
                                            <font class="color">￥{{ $item['order_amount_format'] }}</font>
                                        </span>
                                        <span class="delivery">
                                            由
                                            <font>
                                                <a href="/shop/{{ $item['shop_id'] }}.html" target="_blank" title="点击进入店铺" class="color">{{ $item['shop_name'] }}</a>
                                            </font>
                                            发货
                                        </span>
                                        <span class="pay-btn">
                                            <a href="/user/order/info.html?id={{ $item['order_id'] }}" class="color">查看详情</a>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="go-shop">
                            <a href="/" class="go-shop-btn bg-color">继续购物</a>
                        </div>
                    </div>
                </div>

                @if($order['cash_back_amount'] > 0){{--todo 订单返现--}}
                    <!-- 订单返现信息弹框 -->
                    <div class="full-reduction" style="display: block">
                        <h3>订单返现</h3>
                        <div class="content-info">
                            <i class="iconfont close">&#xe6f8;</i>
                            <div style="margin-top: -20px;">
                                <p class="warning">
                        <span>
                            恭喜您获得
                        </span>
                                </p>
                                <div class="prompt">
                                    <p class="order-info">
                                        <span>20191220021254776970</span>
                                        <span>吃子之心零食店，</span>
                                        <span>
                                返现：
                                <em>27.8</em>
                                元
                            </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        //
                    </script>
                @endif

            @else{{--支付失败--}}
            <div class="payment-fail">
                <div class="payment-fail-con">
                    <i></i>
                    <div class="payment-fail-msg">
                        <h3 class="color">尚未支付成功！</h3>
                        <p>如果您已付款，可能因交易量激增导致交易单延迟处理（最长数秒至数分钟）</p>
                        <p>
                            您可稍后
                            <a href="" class="color">刷新本页面</a>
                            或前往
                            <a href="/user/order.html" class="color">我的订单</a>
                            查看支付情况
                        </p>
                    </div>
                </div>
                <div class="payment-fail-order">
                    <p>以下交易单尚未支付成功，请您尽快完成支付！</p>
                    <div class="fail-order-list">
                        <ul>
                            @foreach($order_list as $item)
                            <li class="first">
					<span class="transaction">
						交易单号：
						<font class="color">
							<a href="/user/order/info.html?id={{ $item['order_id'] }}" target="_blank" title="点击查看订单" class="color">{{ $item['order_sn'] }}</a>
						</font>
					</span>
                                <span class="payable">
						应付金额：
						<font class="color">{{ $item['order_amount_format'] }}</font>
					</span>

                                <span class="delivery">
						由
						<font>
							<a href="/shop/{{ $item['shop_id'] }}.html" target="_blank" title="点击进入店铺" class="color">{{ $item['shop_name'] }}</a>
						</font>
						发货
					</span>

                                <span class="pay-btn hide" style="display: none">
						<a href="/checkout/pay.html?id={{ $item['order_id'] }}" class="submit-btn">点击付款</a>
					</span>
                            </li>
                            @endforeach

                        </ul>
                        <!-- 添加内容start -->
                        <div class="fail-order-summary">
                            <div class="fail-order-info">
                                <p class="first">
						<span>
							应付款金额：
							<span class="SZY-ORDER-AMOUNT">{{ $order['order_amount_format'] }}</span>
						</span>
                                </p>
                            </div>
                            <div class="fail-order-summary-btn">
                                <a href="/checkout/pay.html?id={{ implode(',',$order['order_id']) }}" class="submit-btn bg-color">点击付款</a>
                            </div>
                        </div>
                        <!-- 添加内容end -->
                    </div>


                </div>
                <div class="payment-fail-reason">
                    <h2>付款遇到问题了，先看看是不是由于下面的原因：</h2>
                    <ul>
                        <li>
                            <h3>所需支付金额超过了银行支付限额</h3>
                            <p>建议您登录网上银行提高上限额度，或是分若干次充值到您的账户余额，即能使用账户余额轻松支付。</p>
                        </li>
                        <li>
                            <h3>支付宝、百度钱包或者网银页面显示错误或者空白</h3>
                            <p>部分网银对不同浏览器的兼容性有限，导致无法正常支付，建议您使用IE浏览器进行支付操作。</p>
                        </li>
                        <li>
                            <h3>网上银行已扣款，交易单仍显示“未付款”</h3>
                            <p>可能由于银行的数据没有即时传输，请不要担心，请稍后刷新页面查看。如较长时间仍显示未付款，可联系客服（{{ sysconf('mall_phone') }}）为您解决。</p>
                        </li>
                    </ul>
                </div>
            </div>
            @endif



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
        $().ready(function () {
        });
        //
        $(document).ready(function () {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function () {
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
        $().ready(function () {
            $('.site_to_yikf').click(function () {
                $(this).parent('form').submit();
            })
        });
        //
    </script>
@stop
