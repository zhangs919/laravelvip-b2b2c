@extends('layouts.buy_layout')

@section('header_css')
    <link rel="stylesheet" href="/frontend/css/flow.css?v=20180702"/>
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
                        <span>
						<a href="/checkout.html">确认订单</a>
					</span>
                        <b></b>
                    </li>

                    <li class="finish ">
                        <i>3</i>
                        <span>
						<a href="">付款</a>
					</span>
                        <b></b>
                    </li>

                    <li class="finish ">
                        <i>4</i>
                        <span>
						<a href="">支付成功</a>
					</span>
                        <b></b>
                    </li>


                </ul>
            </div>
        </div>
    </div>

    <div class="content-bg">
        <div class="content-main w990"><div class="payment-fail">
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
                            <li class="first">
					<span class="transaction">
						交易单号：
						<font class="color">
							<a href="/user/order/info.html?id=369" target="_blank" title="点击查看订单" class="color">20181003093704768950</a>
						</font>
					</span>
                                <span class="payable">
						应付金额：
						<font class="color">￥1200.00</font>
					</span>

                                <span class="delivery">
						由
						<font>
							<a href="/shop/14.html" target="_blank" title="点击进入店铺" class="color">安化电商技术服务旗舰店</a>
						</font>
						发货
					</span>

                                <span class="pay-btn hide" style="display: none">
						<a href="/checkout/pay.html?id=369" class="submit-btn">点击付款</a>
					</span>
                            </li>
                            <li class="first">
					<span class="transaction">
						交易单号：
						<font class="color">
							<a href="/user/order/info.html?id=368" target="_blank" title="点击查看订单" class="color">20181003085428239440</a>
						</font>
					</span>
                                <span class="payable">
						应付金额：
						<font class="color">￥680.00</font>
					</span>

                                <span class="delivery">
						由
						<font>
							<a href="/shop/40.html" target="_blank" title="点击进入店铺" class="color">安化县亦神芙蓉茶业有限公司</a>
						</font>
						发货
					</span>

                                <span class="pay-btn hide" style="display: none">
						<a href="/checkout/pay.html?id=368" class="submit-btn">点击付款</a>
					</span>
                            </li>

                        </ul>
                        <!-- 添加内容start -->
                        <div class="fail-order-summary">
                            <div class="fail-order-info">
                                <p class="first">
						<span>
							应付款金额：
							<span class="SZY-ORDER-AMOUNT">￥1880</span>
						</span>
                                </p>
                            </div>
                            <div class="fail-order-summary-btn">
                                <a href="/checkout/pay.html?id=369,368" class="submit-btn bg-color">点击付款</a>
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
                            <p>可能由于银行的数据没有即时传输，请不要担心，请稍后刷新页面查看。如较长时间仍显示未付款，可联系客服（023xxxxxxx）为您解决。</p>
                        </li>
                    </ul>
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

                <a href="/checkout/result.html?key=" class="pay_result">已完成付款</a>
                <a href="/checkout/result.html?key=" class="m-l-10 pay_result">付款遇到问题</a>

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
    <script src="/frontend/js/checkout.js?v=20180919"></script>
    <script src="/frontend/js/common.js?v=20180919"></script>
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