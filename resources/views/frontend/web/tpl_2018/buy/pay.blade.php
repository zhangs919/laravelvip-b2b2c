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
                        <span>
						<a href="/checkout.html">确认订单</a>
					</span>
                        <b></b>
                    </li>

                    <li class="finish finish-03">
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
        <div class="content-main w990"><div class="payment">
                <!-- 合并付款 start -->

                <div class="payment-adjust-box">
                    <div class="title title-line">
                        <h2>您正在为以下2笔交易进行合并付款！</h2>
                        <div class="order">
                            总额：
                            <strong class="second-color">￥1880</strong>
                        </div>
                    </div>
                    <div class="payment-order-info">
                        <ul>

                            <!--点击选中添加selected样式-->
                            <li>
                                <div class="list-wrap">
                                    <a class="fl">
                                        <span>订单号：20181003085428239440</span>
                                        <span>购买时间：2018-10-03 16:54:28</span>
                                    </a>
                                    <span class="fr">
							<strong>￥680.00</strong>
						</span>
                                    <a class="hasDetail">
                                        <i>ˇ</i>
                                    </a>
                                </div>
                                <div class="detail-table">
                                    <dl>
                                        <dt>配送时间：</dt>
                                        <dd>无</dd>
                                    </dl>
                                    <dl>
                                        <dt>收货信息：</dt>
                                        <dd>
                                            <span class="address">学府路 </span>
                                            <span class="name">宝贝</span>
                                            <span class="tel">13333333333</span>
                                        </dd>
                                    </dl>
                                </div>
                            </li>

                            <!--点击选中添加selected样式-->
                            <li>
                                <div class="list-wrap">
                                    <a class="fl">
                                        <span>订单号：20181003093704768950</span>
                                        <span>购买时间：2018-10-03 17:37:04</span>
                                    </a>
                                    <span class="fr">
							<strong>￥1200.00</strong>
						</span>
                                    <a class="hasDetail">
                                        <i>ˇ</i>
                                    </a>
                                </div>
                                <div class="detail-table">
                                    <dl>
                                        <dt>配送时间：</dt>
                                        <dd>无</dd>
                                    </dl>
                                    <dl>
                                        <dt>收货信息：</dt>
                                        <dd>
                                            <span class="address">学府路 </span>
                                            <span class="name">宝贝</span>
                                            <span class="tel">13333333333</span>
                                        </dd>
                                    </dl>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- 合并付款 end -->

                <input type="hidden" id="order_id" value="368,369" />
                <input type="hidden" id="order_sn" value="MP201810031143313406098" />
                <input type="hidden" id="key" value="d3fee3249f0a7d2c1f5222e159c18a2e" />
                <!-- 支付方式 -->


                <div id="pay_type" class="pay-type border-line">
                    <div class="main-content">
                        <h2 class="title">支付方式</h2>
                        <div class="pay-type-content">
                            <!-- 积分支付 start -->

                            <!-- 积分支付 end -->

                            <!-- 余额支付 start -->


                            <!-- 余额支付后面显示的应付款信息 -->
                            <p class="surplus-pay" id="balance_money_pay" >
                                剩余应付金额
                                <strong class="second-color SZY-ORDER-MONEY-PAY">

                                    ￥1880

                                </strong>
                                请选择以下支付方式支付
                            </p>

                            <!-- 银行支付方式调用 start -->
                            <div class="pay-all" id="pay_bank">


                                <ul id="paylist" class="payment-tab" >

                                    <!-- 货到付款特殊处理 -->
                                    <li class="clearfix" >
                                        <label>
                                            <input type="radio" id="pac_code_3" name="pay_code" class="pay_code" value="weixin" checked>
                                            <img src="/assets/d2eace91/images/payment/weixin.jpg" alt="" class="pay-img" />
                                        </label>
                                        <div class="pay-tips" style="display: none;">
                                            <div class="pay-tips-name">
                                                <i></i>

                                            </div>
                                        </div>
                                    </li>

                                    <!-- 货到付款特殊处理 -->
                                    <li class="clearfix" >
                                        <label>
                                            <input type="radio" id="pac_code_1" name="pay_code" class="pay_code" value="alipay" >
                                            <img src="/assets/d2eace91/images/payment/alipay.jpg" alt="" class="pay-img" />
                                        </label>
                                        <div class="pay-tips" style="display: none;">
                                            <div class="pay-tips-name">
                                                <i></i>

                                            </div>
                                        </div>
                                    </li>

                                </ul>


                            </div>
                            <!-- 银行支付方式调用 end -->
                        </div>
                    </div>
                </div>

                <div class="submit-pay">
                    <a href="javascript:void(0);" class="submit-btn gopay bg-color" data-order-id="368,369">立即付款</a>
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
            <link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=20180927"/>
            <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180919"></script>

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
            </script></div>
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

                <a href="/checkout/result.html?key=d3fee3249f0a7d2c1f5222e159c18a2e" class="pay_result">已完成付款</a>
                <a href="/checkout/result.html?key=d3fee3249f0a7d2c1f5222e159c18a2e" class="m-l-10 pay_result">付款遇到问题</a>

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
    <script src="/js/checkout_repay.js?v=20180919"></script>
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