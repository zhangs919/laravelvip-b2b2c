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




                <!-- 所有店铺商品清单 -->
                <div class="goods-list border-line">
                    <div class="main-content">
                        <h2 class="title">商品清单</h2>
                        <div class="order-goods">
                            <!-- 根据店铺对商品进行拆单 每个table是一个店铺的商品 _star-->
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="order-goods-list">
                                <tr>
                                    <th class="goods-title" colspan="3">
                                        <div class="order-body">
                                            <div class="shop">
                                                <div class="shop-info">
									<span class="shop-icon">
										<img src="/frontend/images/shop-type/shop-icon1.png" />
									</span>
                                                    <span class="shop-name">店铺：</span>
                                                    <a href='http://www.b2b2c.yunmall.68mall.com/shop/1.html' target="_blank" title="" class="shop-info-name">东和MRO平台</a>
                                                    <span class="shop-customer">
										<!-- 客服 -->






                                                        <!-- s等于1时带文字，等于2时不带文字 -->
<a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=zlww26837&site=cntaobao&s=2&groupid=0&charset=utf-8">
	<img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=zlww26837&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
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
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <!-- 如果该商品有赠品，那么当前商品的tr的class="have-gift" _star-->
                                            <tr class="goods_178 ">
                                                <td class="goods-img">
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/871.html" title="" target="_blank" class="img">
                                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/08/01/15331135083409.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="50" height="50" />
                                                    </a>

                                                </td>
                                                <td class="goods-master">
                                                    <p class="item-title">
                                                        <a href="http://www.b2b2c.yunmall.68mall.com/871.html" target="_blank" title="古古怪怪">


                                                            <!-- 活动 -->



                                                            <em class="activity-tag activity-tag3">限时折扣</em>

                                                            古古怪怪
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
                                                    <p class="sku-line">颜色：均色</p>

                                                </td>
                                                <td class="goods-price"> ￥1.80 </td>
                                                <td class="goods-amount">1</td>
                                                <td class="goods-sum">

                                                    <p class="sum second-color">￥1.8</p>

                                                </td>
                                            </tr>
                                            <!-- 如果该商品有赠品，那么当前商品的tr的class="have-gift" _end-->
                                        </table>

                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="6" class="goods-postage"><div class="postage">















                                            <div class="postage-out-box">
                                                <div class="postage-box postage-box-1 active" id="postage-box-0-1" data-shop-id="1" data-id="0" data-name="普通快递 " data-price="6" data-price-format="￥6">
                                                    <label>普通快递 </label>
                                                </div>
                                            </div>


                                            <!-- -->




                                            <div class="postage-out-box">
                                                <div class="postage-box postage-box-1 " id="postage-box-1-1" data-shop-id="1" data-id="1" data-name="上门自提 " data-price="0" data-price-format="￥0">
                                                    <label>上门自提 </label>
                                                </div>
                                            </div>


                                            <!---->








                                            <!---->
                                        </div>
                                        <div class="pickup-address" >
                                            <label>
                                                自提点：
                                                <span id='pickup_name'></span>
                                                <a class="pickup-edit" data-shop-id=1>修改</a>
                                            </label>
                                        </div>


                                        <div class="postage-price postage-info-1" style="">

                                            ￥6


                                        </div></td>
                                </tr>

                                <tr>
                                    <td colspan="3" class="goods-annex">
                                        <div class="memo">
                                            <span>买家留言：</span>
                                            <div class="buyer-msg">
                                                <textarea class="text postscript" data-shop-id="1" placeholder="选填，可填写您与卖家达成一致的要求"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="3" class="goods-bill" id="shop_count_1"><div class="bill">
                                            <p class="order-pay-vice">



                                            </p>

                                            <div class="order-pay second-color">
                                                店铺合计（含运费）：<strong class="second-color SZY-SHOP-ORDER-AMOUNT-1" data-shop-id="1">￥7.8</strong>
                                            </div>


                                        </div></td>
                                </tr>
                            </table>

                            <!-- 新加 start  选择自提点 -->
                            <div class="bomb-box pickup-bomb-box logistics-choosen-1" style="display: none">
                                <div class="box-title">选择自提点</div>
                                <div class="box-oprate" data-name=普通快递  data-price=6 data-shop-id=1 data-id=0></div>
                                <div class="content-info">
                                    <form class="">
                                        <div class="logistics-search-box">
                                            <input class="logistics-search-input" placeholder="请输入自提点名称或自提点所在地" type="text" />
                                            <a class="btn btn-primary" data-shop_id=1>搜索</a>
                                        </div>
                                        <ul class="logistics-store-list logistics-store-list-1">

                                            <li class="logistics-item" >
                                                <label class="logistics-inner" >
                                                    <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="1" data-id="1" data-pickup_name="燕大门店" data-pickup_id="1">
                                                    <div class="logistics-info">
                                                        <p class="logistics-name">燕大门店</p>
                                                        <p class="logistics-address" title="白塔岭街道燕东路燕山大学">
                                                            <i></i>白塔岭街道燕东路燕山大学
                                                        </p>
                                                        <p class="logistics-tel">
                                                            <i></i>0335-7106712
                                                        </p>
                                                    </div>
                                                </label>
                                            </li>
                                            <!--   -->
                                            <li class="logistics-item" >
                                                <label class="logistics-inner" >
                                                    <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="1" data-id="1" data-pickup_name="太阳城门店" data-pickup_id="2">
                                                    <div class="logistics-info">
                                                        <p class="logistics-name">太阳城门店</p>
                                                        <p class="logistics-address" title="建设大街街道新华街18号江东路步行街">
                                                            <i></i>建设大街街道新华街18号江东路步行街
                                                        </p>
                                                        <p class="logistics-tel">
                                                            <i></i>0335-7106716
                                                        </p>
                                                    </div>
                                                </label>
                                            </li>
                                            <!--   -->
                                            <li class="logistics-item" >
                                                <label class="logistics-inner" >
                                                    <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="1" data-id="1" data-pickup_name="北戴河刘庄" data-pickup_id="3">
                                                    <div class="logistics-info">
                                                        <p class="logistics-name">北戴河刘庄</p>
                                                        <p class="logistics-address" title="东山街道联峰路育花2区">
                                                            <i></i>东山街道联峰路育花2区
                                                        </p>
                                                        <p class="logistics-tel">
                                                            <i></i>0335-8535668
                                                        </p>
                                                    </div>
                                                </label>
                                            </li>
                                            <!--   -->
                                            <li class="logistics-item" >
                                                <label class="logistics-inner" >
                                                    <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="1" data-id="1" data-pickup_name="123" data-pickup_id="7">
                                                    <div class="logistics-info">
                                                        <p class="logistics-name">123</p>
                                                        <p class="logistics-address" title="禅城区祖庙街道佛山禅城区祖庙街道气象服务站">
                                                            <i></i>禅城区祖庙街道佛山禅城区祖庙街道气象服务站
                                                        </p>
                                                        <p class="logistics-tel">
                                                            <i></i>13035887777
                                                        </p>
                                                    </div>
                                                </label>
                                            </li>
                                            <!--   -->
                                            <li class="logistics-item" >
                                                <label class="logistics-inner" style="height: 50px;">
                                                    <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="1" data-id="1" data-pickup_name="广场北路122号" data-pickup_id="8">
                                                    <div class="logistics-info">
                                                        <p class="logistics-name">广场北路122号</p>
                                                        <p class="logistics-address" title="甘肃兰州城关区广武门街道广场北路122号陆都嘉邸">
                                                            <i></i>甘肃兰州城关区广武门街道广场北路122号陆都嘉邸
                                                        </p>
                                                    </div>
                                                </label>
                                            </li>
                                            <!--   -->
                                            <li class="logistics-item" >
                                                <label class="logistics-inner" >
                                                    <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="1" data-id="1" data-pickup_name="鲜农乐一号门店" data-pickup_id="9">
                                                    <div class="logistics-info">
                                                        <p class="logistics-name">鲜农乐一号门店</p>
                                                        <p class="logistics-address" title="金沙街道中海金沙馨园">
                                                            <i></i>金沙街道中海金沙馨园
                                                        </p>
                                                        <p class="logistics-tel">
                                                            <i></i>13111111111
                                                        </p>
                                                    </div>
                                                </label>
                                            </li>
                                            <!--   -->
                                            <li class="logistics-item" style="border:none;">
                                                <label class="logistics-inner" style="height: 50px;">
                                                    <input class="logistics-radio" type="radio"   name="logistics" data-shop_id="1" data-id="1" data-pickup_name="西安" data-pickup_id="10">
                                                    <div class="logistics-info">
                                                        <p class="logistics-name">西安</p>
                                                        <p class="logistics-address" title="陕西西安新城区自强路街道联志路52号中国石油西安市销售分公司家属院">
                                                            <i></i>陕西西安新城区自强路街道联志路52号中国石油西安市销售分公司家属院
                                                        </p>
                                                    </div>
                                                </label>
                                            </li>

                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <!-- 新加 end  选择自提点 -->


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

                                    ￥7.8

                                </strong>
                                请选择以下支付方式支付
                            </p>

                            <!-- 银行支付方式调用 start -->
                            <div class="pay-all" id="pay_bank">


                                <ul id="paylist" class="payment-tab" >

                                    <!-- 货到付款特殊处理 -->
                                    <li class="clearfix" >
                                        <label>
                                            <input type="radio" id="pac_code_-1" name="pay_code" class="pay_code" value="cod" >
                                            <img src="/assets/d2eace91/images/payment/cod.jpg" alt="" class="pay-img" />
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
                                            <input type="radio" id="pac_code_2" name="pay_code" class="pay_code" value="union" checked>
                                            <img src="/assets/d2eace91/images/payment/union.jpg" alt="" class="pay-img" />
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
                                            <input type="radio" id="pac_code_3" name="pay_code" class="pay_code" value="weixin" >
                                            <img src="/assets/d2eace91/images/payment/weixin.jpg" alt="" class="pay-img" />
                                        </label>
                                        <div class="pay-tips" style="display: none;">
                                            <div class="pay-tips-name">
                                                <i></i>

                                            </div>
                                        </div>
                                    </li>

                                    <!-- 货到付款特殊处理 -->

                                </ul>
                                <div id="other_pay" >
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
				<span class="SZY-ORDER-AMOUNT">￥7.8</span>
			</span>
                            </div>
                            <div class="total-count-pay-info">
			<span>

				商品总额：

				<span class="SZY-GOODS-AMOUNT">￥1.8</span>
			</span>
                                <em>+</em>
                                <span>
				运费：
				<span class="SZY-SHIPPING-FEE-AMOUNT">￥6</span>
			</span>
                                <span class="SZY-ORDER-CASH-MORE-AMOUNT" style='display: none;'>
				<em>+</em>
				<span>
					货到付款加价：
					<span>￥0</span>
				</span>
			</span>
                                <em>-</em>
                                <span>
				红包：
				<span class="SZY-ORDER-BONUS-AMOUNT">￥0</span>
			</span>
                                <em>-</em>
                                <span>
				优惠：
				<span class="">￥0</span>
			</span>
                                <span class="SZY-ORDER-STORE-CARD" style='display: none;'>
				<em>-</em>
				<span>
					店铺购物卡：
					<span class="SZY-ORDER-STORE-CARD-AMOUNT">￥0</span>
				</span>
			</span>
                                <em>-</em>
                                <span>
				余额：
				<span class="SZY-ORDER-BALANCE">￥0</span>
			</span>
                                <em>=</em>
                                <span class="end second-color">
				应付款：
				<span class="SZY-ORDER-MONEY-PAY">￥7.8</span>
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


                            <li class="tab-nav-item disabled " data-invoice-type="1" data-invoice-name="增值税普通发票">
                                增值税普通发票
                                <b></b>
                            </li>


                            <li class="tab-nav-item disabled " data-invoice-type="2" data-invoice-name="增值税专用发票">
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

                    <!-- 增值税发票 _end -->

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