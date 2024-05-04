<title>打印订单</title>

<!-- 加载CSS -->
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=20181020"/>
<link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=20181020"/>
<link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
<!-- 加载JS -->
<script src="/assets/d2eace91/js/jquery.js?v=20180027"></script>
<script src="/assets/d2eace91/js/jquery-ui.js?v=20180027"></script>  <script src="/assets/d2eace91/js/lodop/LodopFuncs.js?v=20180027"></script>
<div id="print">

    <link rel="stylesheet" href="/assets/d2eace91/css/print.css?v=20181020"/>
    <!--A5-->
    <div class="print-page print-layout mm190mm140">
        <div class="print-fixed">
            <div class="print-btn">
                <a id="btnPrint">
                    <i></i>
                    打印
                </a>
            </div>
            <div class="print-spec">
                <label class="control-label">打印规格：</label>
                <select class="form-control w100 select-print-spec">

                    <option value="100MM" >100MM</option>

                    <option value="190MM*140MM" selected="selected">190MM*140MM</option>

                    <option value="120MM*93MM" >120MM*93MM</option>

                    <option value="80MM" >80MM</option>

                </select>
                <p class="c-999 m-t-10">打印规格需店铺管理员在商家后台->店铺->打印设置中进行设置。</p>
                <p class="m-t-5">
                    <span class="c-red">点击按钮快去设置吧！</span>
                    </br>
                    <a class="btn btn-primary btn-sm m-t-5" href=/shop/print-spec/list" target="_blank">去设置</a>
                </p>
            </div>
            <div class="tip">
                <dl>
                    <dt>
                        <h1>190</h1>
                        <em>Size: 190mm x 140mm</em>
                    </dt>
                </dl>
            </div>
            <div class="division-line" style="top: 222mm">
                <span>分页分割线</span>
            </div>
            {{--<div class="division-line" style="top: 268mm">
                <span>分页分割线</span>
            </div>
            <div class="division-line" style="top: 402mm">
                <span>分页分割线</span>
            </div>
            <div class="division-line" style="top: 536mm">
                <span>分页分割线</span>
            </div>
            <div class="division-line" style="top: 670mm">
                <span>分页分割线</span>
            </div>
            <div class="division-line" style="top: 804mm">
                <span>分页分割线</span>
            </div>
            <div class="division-line" style="top: 938mm">
                <span>分页分割线</span>
            </div>
            <div class="division-line" style="top: 1072mm">
                <span>分页分割线</span>
            </div>
            <div class="division-line" style="top: 1206mm">
                <span>分页分割线</span>
            </div>--}}

        </div>
        <div class="orderprint" style="padding: 0mm">
            <div id="printContent">
                <link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=20181020"/>
                <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=20181020"/>
                <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>

                @foreach($order_list as $v)
                <div class="print-panel" style="width: 190mm; padding: 5mm 8mm 3mm 8mm; min-height: 134mm; height: auto;">
                    <div class="top pos-r">
                        <table>
                            <tr>
                                <td style="width: 220px; height: 60px;">
                                    <img class="print-logo mallLogo" src="{{ $logo }}"
                                         style="max-height: 60px; max-width: 220px;" />
                                </td>
                                <td class="text-c w300" style="color: #000;">
                                    <h3>
                                        <div class="print-trim-div title">{{ $print_title }}</div>
                                    </h3>
                                </td>
                            </tr>
                        </table>
                        <div class="top-right-box" style="position: absolute; top: 0px; right: 0px;">

                            <img src="/assets/d2eace91/images/common/seal-state-express.png">

                            <img class="orderQRCode" src="{{ $shop_qrcode }}" width="90" height="90">
                        </div>
                        <div class="store-box" style="margin: 10px 0; overflow: hidden;">
                            <div class="store-logo" style="float: left; display: inline-block;margin-right: 20px;">
                                <img class="storeLogo store-logo-img" src="{{ $store_logo }}" style="max-width: 200px; max-height: 60px;">
                            </div>
                            <div class="store-info" style="float: left;">
                                <div class="print-model-text">
                                    <ul>
                                        <li class="storeName" style="display: block; color: #000;">
                                            <div class="print-trim-div" data-id="storeName">
                                                <span>店铺名称：</span>
                                                {{ $v['shop_name'] }}
                                            </div>
                                        </li>
                                        <li class="storeNickname" style="display: block; color: #000;">
                                            <div class="print-trim-div" data-id="storeNickname">
                                                <span>店主昵称：</span>
                                                {{ $v['shop_nickname'] }}
                                            </div>
                                        </li>
                                        <li class="storeTel" style="display: block; color: #000;">
                                            <div class="print-trim-div" data-id="storeTel">
                                                <span>店铺联系电话：</span>
                                                {{ $v['s_mobile'] }}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--堂内点餐桌号-->

                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="print-model-text average3" style="margin: 15px auto 15px;">
                        <ul style="overflow: hidden;">
                            <li class="orderCode" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="orderCode">
                                    <span>订单编号：</span>
                                    {{ $v['order_sn'] }}
                                </div>
                            </li>
                            <li class="orderCode" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="orderTime">
                                    <span>订购时间：</span>
                                    {{ format_time($v['add_time']) }}
                                </div>
                            </li>
                            <li class="payTime" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="payTime">
                                    <span>付款时间：</span>
                                    {{ format_time($v['pay_time']) }}
                                </div>
                            </li>
                            <li class="nickname" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="nickname">
                                    <span>买家昵称：</span>
                                    {{ $v['nickname'] }}
                                </div>
                            </li>

                            <li class="consigneeName" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="consigneeName">
                                    <span>收货人姓名：</span>
                                    {{ $v['consignee'] }}
                                </div>
                            </li>
                            <li class="consigneeTel" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="consigneeTel">
                                    <span>收货人电话：</span>
                                    {{ $v['tel'] }}
                                </div>
                            </li>

                            <li class="orderUserCode" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="orderUserCode">
                                    <span>下单会员账户：</span>
                                    {{ $v['user_name'] }}
                                </div>
                            </li>

                            <li class="orderUserTel" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="orderUserTel">
                                    <span>下单会员手机号：</span>
                                    {{ $v['user_mobile'] }}
                                </div>
                            </li>


                            <li class="payMethod" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="payMethod">
                                    <span>支付方式：</span>
                                    {{ $v['pay_name'] }}
                                </div>
                            </li>
                            <li class="storeUserRank" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="storeUserRank">
                                    <span>店铺会员等级：</span>
                                    {{ $v['rank_name'] }}
                                </div>
                            </li>
                            <li class="ascriptionStore" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="ascriptionStore">
                                    <span>购买者隶属店铺名称：</span>
                                    {{ $v['u_shop_name'] }}
                                </div>
                            </li>

                            <li class="deliveryTime" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="deliveryTime">
                                    <span>送货时间：</span>
                                    {{ $v['best_time'] }}
                                </div>
                            </li>


                            <li class="orderAddress" style="width: 100%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="orderAddress">
                                    <span>收货地址：</span>
                                    {{ $v['consignee_address'] }}
                                </div>
                            </li>


                            <li class="deliverCode" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="deliverCode">
                                    <span>发货单号：</span>
                                    20180413124664904
                                </div>
                            </li>
                            <!--li class="goodsTotalNum" style="width: 33%; display: inline-block; float: left; color: #000">
                                <div class="print-trim-div" data-id="goodsTotalNum">
                                    <span>商品数量：</span>
                                    1
                                </div>
                            </li-->
                        </ul>
                        <ul class="invoiceInfo" data-id="invoiceInfo">
                            <!--   -->
                            <!--   -->
                        </ul>
                    </div>

                    <!--商品信息 start-->
                    <table class="table table-bordered" style="border-color: #000; color: #000;">
                        <thead>
                        <tr>
                            <th class="libraryCode w90 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; border-right: 1px solid #000; font-weight: 200">
                                <div class="print-trim-div" data-id="libraryCode">库位码</div>
                            </th>
                            <th class="goodsCode w70 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; border-right: 1px solid #000; font-weight: 200">
                                <div class="print-trim-div" data-id="goodsCode">编号</div>
                            </th>
                            <th class="goodsName w300 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; border-right: 1px solid #000; font-weight: 200">
                                <div class="print-trim-div" data-id="goodsName">商品名称</div>
                            </th>
                            <th class="goodsSpec w150 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; border-right: 1px solid #000; font-weight: 200">
                                <div class="print-trim-div" data-id="goodsSpec">商品规格</div>
                            </th>
                            <th class="goodsBarCode w150 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; border-right: 1px solid #000; font-weight: 200">
                                <div class="print-trim-div" data-id="goodsBarCode">商品条形码</div>
                            </th>
                            <th class="goodsNum w50 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; border-right: 1px solid #000; font-weight: 200">
                                <div class="print-trim-div" data-id="goodsNum">数量</div>
                            </th>
                            <th class="goodsPrice w70 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; border-right: 1px solid #000; font-weight: 200">
                                <div class="print-trim-div" data-id="goodsPrice">单价</div>
                            </th>
                            <th class="goodsSubtotal w70 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; font-weight: 200">
                                <div class="print-trim-div" data-id="goodsSubtotal">小计</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($v['goods_list'] as $goods)
                        <tr>
                            <td class="libraryCode w90 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">{{ $goods['goods_stockcode'] }}</div>
                            </td>
                            <td class="goodsCode w70 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">{{ $goods['goods_id'] }}</div>
                            </td>
                            <td class="goodsName w300 text-l" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">{{ $goods['goods_name'] }}</div>
                            </td>
                            <td class="goodsSpec w150 text-l" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">{{ $goods['spec_info'] }}</div>
                            </td>
                            <td class="goodsBarCode w150 text-l" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">{{ $goods['goods_barcode'] }}</div>
                            </td>
                            <td class="goodsNum w50 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">{{ $goods['goods_number'] }}</div>
                            </td>
                            <td class="goodsPrice w70 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">￥{{ $goods['goods_price'] }}</div>
                            </td>
                            <td class="goodsSubtotal w70 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000">
                                <div class="print-trim-div">￥{{ $goods['goods_price_all'] }}</div>
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="8" class="text-r" style="color: #000; height: 40px; padding: 4px; border-color: #000; border-top: 1px solid #000;">
                                <!---->
                                <div class="goodsTotalPrice pull-right m-l-20">
                                    <div class="print-trim-div" data-id="goodsTotalPrice">商品总金额：￥{{ $v['final_amount'] }}</div>
                                </div>
                                <!---->
                                <!---->
                                <div class="goodsTotalNum pull-right">
                                    <div class="print-trim-div" data-id="goodsTotalNum">商品总数量：{{ $v['goods_number'] }}</div>
                                </div>
                                <!---->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="paymentDetails address-info text-r m-b-20">
                        <div class="print-trim-div" data-id="paymentDetails">
                            <p class="m-b-5" style="color: #000;">
                                <span>商品总金额：￥4.9</span>
                                <em class="operator">+</em>
                                <span>运费：￥0.00</span>

                                <em class="operator">-</em>
                                <span>店铺红包：￥0.00</span>
                                <em class="operator">-</em>
                                <span>平台红包：￥0.00</span>


                                <em class="operator">-</em>
                                <span>卖家优惠：￥0.00</span>

                                <em class="operator">=</em>
                                <span>
								<strong>订单总金额：￥4.90</strong>
							</span>
                            </p>
                        </div>
                    </div>
                    <div class="paymentSummary address-info text-r m-b-20">
                        <div class="print-trim-div" data-id="paymentSummary">

                            <p style="color: #000;">
                                <span>在线支付：￥0.00</span>
                                <em class="operator">+</em>
                                <span>余额支付：￥4.90</span>

                                <em class="operator">=</em>
                                <span style="color: #C00;">
								<strong>实付款金额：￥4.9</strong>
							</span>
                            </p>

                            <!--p class="m-b-5" style="color: #000;">
                                <span>
                                    <strong>订单总积分：0</strong>
                                </span>
                            </p-->
                        </div>
                    </div>
                    <!--商品信息 end-->
                    <div class="print-model-text">
                        <ul>
                            <!-- li class="storeAddress" style="display: block; color: #000;">
                                <div class="print-trim-div" data-id="storeAddress">
                                    <span>店铺发货地址：</span>
                                    河北省-秦皇岛市-海港区鲜农乐食品专营店
                                </div>
                            </li-->
                            <li class="sellerRemarks" style="display: block; color: #000;">
                                <div class="print-trim-div" data-id="sellerRemarks">
                                    <span>商家备注：</span>
                                    {!! $v['shop_remark'] ?? '无' !!}
                                </div>
                            </li>
                            <li class="printTime" style="display: block; color: #000;">
                                <div class="print-trim-div" data-id="printTime">
                                    <span>打印时间：</span>
                                    {{ format_time(time()) }}
                                </div>
                            </li>
                        </ul>
                    </div>
                    <textarea class="printRemark form-control print-remark-edit" placeholder="请输入备注信息" rows="3" style="resize: none; display: none"></textarea>
                    <p class="print-remark" style="display: none; cursor: pointer;" title="点击重新编辑"></p>
                    <div class="print-model-text">
                        <ul>
                            <li class="auditSignature h80" style="display: block; color: #000;">
                                <div class="print-trim-div" data-id="auditSignature">
                                    <span>审核签字：</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="print-model-text average3 w500" style="margin: 15px auto;">
                        <ul>
                            <li class="storeQRCode text-c" style="text-align: center; float: left; display: inline-block; color: #000; width: 33%">
                                <div class="print-trim-div" data-id="storeQRCode">店铺二维码</div>
                                <img class="m-t-5" src="{{ $shop_qrcode }}" width="90" height="90">
                            </li>
                            <li class="mallWeChat text-c" style="text-align: center; float: left; display: inline-block; color: #000; width: 33%">
                                <div class="print-trim-div" data-id="mallWeChat">商城微信公众号</div>
                                <img class="m-t-5" src="{{ $mall_wx_qrcode }}" width="90" height="90">
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <div class="clear"></div>
    </div>

    <script type="text/javascript">
        var data = {"mallLogo":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"orderCode":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"orderQRCode":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"orderTime":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"payTime":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"payMethod":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"mallWeChat":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"printTime":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"deliverCode":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"nickName":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"consigneeName":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"consigneeTel":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"orderUserCode":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"orderUserTel":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"deliveryTime":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"invoiceInfo":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"orderAddress":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"storeUserRank":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"ascriptionStore":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"buyerMessage":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"sellerRemarks":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"libraryCode":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsCode":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsName":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsSpec":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsBarCode":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsPrice":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsNum":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsSubtotal":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsTotalNum":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"goodsTotalPrice":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"paymentDetails":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"storeNickname":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"storeName":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"storeTel":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"storeAddress":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"storeQRCode":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"storeLogo":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"storeWeChat":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"printRemark":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"auditSignature":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"1"},"title":"","paymentSummary":{"font":"\u5fae\u8f6f\u96c5\u9ed1","size":"12","is_check":"0"}};

        init();

        $().ready(function() {
            $(".select-print-spec").change(function() {
                var print_spec = $(this).val();
                var order_id = "261";
                var delivery_id = "99,83,82,81,80,79,72,40,25";
                var buy_type = "0";
                $.ajax({
                    type: 'GET',
                    url: '/trade/order/select-spec',
                    data: {
                        print_spec: print_spec,
                        order_id: order_id,
                        delivery_id: delivery_id,
                        buy_type: buy_type
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#print").html(result.data);
                    }
                });
            });

        });

        function init()
        {
            var title = "发货清单";
            $.each(data,function(code,style) {
                initStyle(code,style);
                if(style.is_check == 1)
                {
                    $("." + code).show();
                }
                else
                {
                    $("." + code).hide();
                }
            });

            $(".title").show();

            if(data.title != '')
            {
                $(".title").html(data.title);
            }
            else
            {
                $(".title").html(title);
            }
        }

        function initStyle(code,style)
        {
            $("." + code).css("font-family", style.font);
            $("." + code).css("font-size", style.size);
            $("." + code).css("font-weight", style.blod);
            $("." + code).css("font-style", style.italic);
            $("." + code).css("text-decoration", style.underline);
        }
    </script>
    <script type="text/javascript">
        $("#btnPrint").click(function() {
            $(".print-remark-edit").each(function() {
                $(this).hide();
                $(this).siblings(".print-remark").html($(this).val()).show();
            });
            var printer = "zto-588";
            if (printer == '' || printer == null) {
                alert("该打印规格还没有设置指定的打印机");
                return false;
            }
            var html = $("#printContent").html();
            var title = "发货清单";
            lodop_preview_html(title, html, printer);
        });

        $(".print-remark").click(function() {
            $(this).hide();
            $(this).siblings(".print-remark-edit").val($(this).html()).show();
        });
    </script>

</div>