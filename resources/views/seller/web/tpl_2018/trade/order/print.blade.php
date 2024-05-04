
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title></title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive">
    <meta name="baidspider" content="noarchive">
    <meta name="googlebot" content="noarchive">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - ' : '' }}乐融沃 · 云商城卖家中心 - 店铺</title>
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- ================== BEGIN BASE  ================== -->
    <!-- ================== END BASE  ================== -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="@static/js/html5shiv.min.js" />
    <script type="text/javascript" src="@static/js/respond.min.js" />
    <![endif]-->
    <link href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/assets/d2eace91/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link href="/assets/d2eace91/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/app.common.min.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/print.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/common.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
    <link href="/assets/d2eace91/js/chosen/chosen.css" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js"></script>
    <script src="/assets/d2eace91/js/szy.head.js"></script>
</head>
<body>
<!-- 加载CSS -->
<!-- 加载JS -->
<div id="print">
    <!--A5-->
    <div class="print-page print-layout mm60">
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
                    @foreach($spec_list as $item)
                        <option value="{{ $item['print_spec'] }}" @if($item['is_default'])selected="selected"@endif>{{ $item['print_spec'] }}</option>
                    @endforeach
                </select>
                <p class="c-999 m-t-10">打印规格需店铺管理员在商家后台->店铺->打印设置中进行设置。</p>
                <p class="m-t-5">
                    <span class="c-red">点击按钮快去设置吧！</span>
                    </br>
                    <a class="btn btn-primary btn-sm m-t-5" href="/shop/print-spec/list" target="_blank">去设置</a>
                </p>
            </div>
            <div class="tip">
                <dl>
                    <dt>
                        <h1>{{ str_replace(['MM','纸张'],['',''], $default_spec['print_spec']) }}</h1>
                        <em>Size: {{ $default_spec['print_spec'] }}</em>
                    </dt>
                </dl>
            </div>
        </div>
        <div class="orderprint">
            <div id="printContent">
                @foreach($order_list as $item)
                <div class="print-panel"  style="width:57mm; padding:0 2mm 0 0; text-align: left;">
                    <div class="top pos-r" style="position: relative;">
                        <div class="text-c m-b-10" style="text-align: center;">
                            <img class="orderQRCode" src="{{ $qrcode_image }}" width="90" height="90">
                        </div>
                        <table style="width: 100%;">
                            <tr>
                                <td class="text-c"  style="width: 100%; text-align: center;">
                                    <img class="print-logo mallLogo" src="{{ $logo }}" height="40" />
                                </td>
                            </tr>
                            <tr>
                                <td class="text-c" style="color: #000; height: 60px; text-align: center;">
                                    <h3 style="width: 100%;">
                                        <div class="print-trim-div title">{{ $print_title }}</div>
                                    </h3>
                                </td>
                            </tr>
                        </table>
                        <div class="top-right-box" style="position: absolute; right: 10px; top: 55px;">
                            <img src="/assets/d2eace91/images/common/seal-state-express-small.png">
                        </div>
                        <div class="store-box">
                            <div class="store-logo" style="margin: 0px auto 10px; display: block; text-align: center; float: none;">
                                <img class="storeLogo store-logo-img" src="{{ $store_logo }}" style="max-width: 200px; max-height: 60px;">
                            </div>
                            <div class="bar-code orderBarCode" style="width: 200px; height: 60px; margin: 0px auto 20px; display: block;" data-sn="{{ $item['order_sn'] }}">
                            </div>
                            <div class="store-info">
                                <div class="print-model-text">
                                    <ul style="padding:0px; margin:0px;">
                                        <li class="storeName" style="display: block; color: #000; font-size:12px;">
                                            <div class="print-trim-div" data-id="storeName">
                                                <span>店铺名称：</span>
                                                {{ $item['order_sn'] }}
                                            </div>
                                        </li>
                                        <li class="storeNickname" style="display: block; color: #000; font-size:12px;">
                                            <div class="print-trim-div" data-id="storeNickname">
                                                <span>店主昵称：</span>
                                                {{ $item['shop_nickname'] }}
                                            </div>
                                        </li>
                                        <li class="storeTel" style="display: block; color: #000; font-size:12px;">
                                            <div class="print-trim-div" data-id="storeTel">
                                                <span>店铺联系电话：</span>
                                                {{ $item['user_mobile'] }}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--堂内点餐桌号-->
                        </div>
                    </div>
                    <div class="print-model-text" style="margin: 15px 10px 15px 0;  font-size:12px;">
                        <ul style="padding:0px; margin:0px;">
                            <li class="orderCode" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="orderCode">
                                    <span>订单编号：</span>
                                    {{ $item['order_sn'] }}
                                </div>
                            </li>
                            <li class="orderTime" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="orderTime">
                                    <span>订购时间：</span>
                                    {{ format_time($item['add_time']) }}
                                </div>
                            </li>
                            <li class="payTime" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="payTime">
                                    <span>付款时间：</span>
                                    {{ format_time($item['pay_time']) }}
                                </div>
                            </li>
                            <li class="nickname" style="display: block; color: #000; font-family: 微软雅黑;">
                                <div class="print-trim-div" data-id="nickname">
                                    <span>买家昵称：</span>
                                    {{ $item['nickname'] }}
                                </div>
                            </li>
                            <li class="consigneeName" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="consigneeName">
                                    <span>收货人姓名：</span>
                                    {{ $item['consignee'] }}
                                </div>
                            </li>
                            <li class="consigneeTel" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="consigneeTel">
                                    <span>收货人电话：</span>
                                    {{ $item['tel'] }}
                                </div>
                            </li>
                            <li class="orderUserCode" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="orderUserCode">
                                    <span>下单会员账户：</span>
                                    {{ $item['user_name'] }}
                                </div>
                            </li>
                            <li class="orderUserTel" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="orderUserTel">
                                    <span>下单会员手机号：</span>
                                    {{ $item['user_mobile'] }}
                                </div>
                            </li>
                            <li class="payMethod" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="payMethod">
                                    <span>支付方式：</span>
                                    {{ $item['pay_name'] }}
                                </div>
                            </li>
                            <li class="storeUserRank" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="storeUserRank">
                                    <span>店铺会员等级：</span>
                                    {{ $item['rank_name'] }}
                                </div>
                            </li>
                            <li class="ascriptionStore" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="ascriptionStore">
                                    <span>购买者隶属店铺名称：</span>
                                    {{ $item['u_shop_name'] }}
                                </div>
                            </li>
                            <li class="deliveryTime" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="deliveryTime">
                                    <span>送货时间：</span>
                                    {{ $item['best_time'] }}
                                </div>
                            </li>
                            <li class="orderAddress" style="display: block; color: #000">
                                <div class="print-trim-div" data-id="orderAddress">
                                    <span>收货地址：</span>
                                    {{ $item['region_name'] }} &nbsp; {!! $item['address'] !!}     
                                </div>
                            </li>
                        </ul>
                        <ul class="invoiceInfo" data-id="invoiceInfo"  style="padding:0px; margin:0px;">
                            <!--   -->
                            <!--   -->
                        </ul>
                    </div>
                    <!--商品信息 start-->
                    <table style="font-weight: 400; color: #000; width:55mm; font-size: 12px; margin: 15px 5px 15px 0;">
                        <thead>
                        <tr>
                            <th class="w250 text-l" style="font-weight: 400; border-bottom: 1px dashed #000; border-top: 1px dashed #000;">
                                <span class="print-trim-div goodsCode" data-id="goodsCode">编号\</span>
                                <span class="print-trim-div libraryCode" data-id="libraryCode">库位码\</span>
                                <span class="print-trim-div goodsBarCode" data-id="goodsBarCode">条形码\</span>
                                <span class="print-trim-div goodsName">品名</span>
                                <span class="print-trim-div goodsSpec">\规格</span>
                            </th>
                            <th class="goodsNum w50 text-r" style="font-weight: 400; border-bottom: 1px dashed #000; border-top: 1px dashed #000;">
                                <div class="print-trim-div" data-id="goodsNum">数量</div>
                            </th>
                            <th class="goodsPrice w50 text-r" style="font-weight: 400; border-bottom: 1px dashed #000; border-top: 1px dashed #000;">
                                <div class="print-trim-div" data-id="goodsPrice">单价</div>
                            </th>
                            <th class="goodsSubtotal w50 text-r" style="font-weight: 400; border-bottom: 1px dashed #000; border-top: 1px dashed #000;">
                                <div class="print-trim-div" data-id="goodsSubtotal">小计</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item['goods_list'] as $goods)
                        <tr>
                            <td class="text-l" colspan="4" style="word-spacing: -1px; letter-spacing: -1px; color: #000;">
                                <span class="print-trim-div goodsCode">{{ $goods['goods_id'] }}\</span>
                                <span class="print-trim-div libraryCode">{{ $goods['goods_stockcode'] }}</span>
                                <span class="print-trim-div goodsBarCode">{{ $goods['goods_barcode'] }}</span>
                                <span class="print-trim-div goodsName">{{ $goods['goods_name'] }}</span>
                                <span class="print-trim-div goodsSpec">\
                                    @if(!empty($goods['spec_info']))
                                        @foreach(explode(' ', $goods['spec_info']) as $spec)
                                            {{ $spec }}
                                        @endforeach
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="goodsNum w50 text-r" colspan="2" style="color: #000;">
                                <div class="print-trim-div">{{ $goods['goods_number'] }}</div>
                            </td>
                            <td class="goodsPrice w50 text-r" style="color: #000;">
                                <div class="print-trim-div">￥{{ $goods['goods_price'] }}</div>
                            </td>
                            <td class="goodsSubtotal w50 text-r" style="color: #000;">
                                <div class="print-trim-div">￥{{ $goods['goods_price_all'] }}</div>
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" class="text-r" style="height: 30px; border-top: 1px dashed #000; text-align:right; color: #000;">
                                <div class="goodsTotalPrice pull-right m-l-20" style="float:right;">
                                    <div class="print-trim-div" data-id="goodsTotalPrice">商品总金额：￥{{ $item['goods_amount'] }}</div>
                                </div>
                                <div class="goodsTotalNum pull-right" style="float:right">
                                    <div class="print-trim-div" data-id="goodsTotalNum">商品总数量：{{ $item['goods_number'] }}</div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="paymentDetails address-info text-r m-b-20" style="font-size:12px; margin-right:10px; ">
                        <div class="print-trim-div" data-id="paymentDetails">
                            <p class="m-b-5"  style="color: #000; margin-bottom:20px; text-align:right;">
                                <span>商品总金额：￥{{ $item['goods_amount'] }}</span>
                                <em class="operator">+</em>
                                <span>运费：￥{{ $item['shipping_fee'] }}</span>
                                <em class="operator">-</em>
                                <span>店铺红包：￥{{ $item['shop_bonus'] }}</span>
                                <em class="operator">-</em>
                                <span>平台红包：￥{{ $item['bonus'] }}</span>
                                <em class="operator">-</em>
                                <span>卖家优惠：￥{{ $item['discount_fee'] }}</span>
                                <em class="operator">-</em>
                                <span>积分抵扣：￥{{ $item['integral_money'] }}</span>
                                <em class="operator">=</em>
                            <div style="text-align:right;">
                                <strong>订单总金额：￥{{ $item['order_amount'] }}</strong>
                            </div>
                            </p>
                        </div>
                    </div>
                    <div class="paymentSummary address-info text-r m-b-20"  style="font-size:12px; margin-right:10px;">
                        <div class="print-trim-div" data-id="paymentSummary">
                            <p style="color: #000; margin-bottom:20px; text-align:right;">
                                <span>在线支付：￥{{ $item['money_paid'] }}</span>
                                <em class="operator">+</em>
                                <span>余额支付：￥{{ $item['surplus'] }}</span>
                                <em class="operator">=</em>
                            <div style="color: #C00; text-align:right; ">
                                <strong>实付款金额：￥{{ $item['money_paid'] }}</strong>
                            </div>
                            </p>
                            <!--p class="m-b-5" style="color: #000;">
                                <span>
                                    <strong>订单总积分：0</strong>
                                </span>
                            </p-->
                        </div>
                    </div>
                    <!--商品信息 end-->
                    <div class="print-model-text"  style="font-size:12px;">
                        <ul style="padding:0px; margin:0px;">
                            <!-- li class="storeAddress" style="display: block; color: #000;">
                                <div class="print-trim-div" data-id="storeAddress">
                                    <span>店铺发货地址：</span>
                                    北京-北京市-东城区水水水水
                                </div>
                            </li-->
                            <li class="sellerRemarks" style="display: block; color: #000;">
                                <div class="print-trim-div" data-id="sellerRemarks">
                                    <span>商家备注：</span>
                                    {!! $info['shop_remark'] ?? '无' !!}
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
                    <textarea class="printRemark form-control print-remark-edit" placeholder="请输入备注信息" rows="3" style="resize: none; display: none; width: 100%; height: auto; min-width: auto;"></textarea>
                    <p class="print-remark" style="display: none; cursor: pointer;" title="点击重新编辑"></p>
                    <div class="print-model-text"  style="font-size:12px; margin-bottom:30px;">
                        <ul style="padding:0px; margin:0px;">
                            <li class="auditSignature h80" style="display: block; color: #000;">
                                <div class="print-trim-div" data-id="auditSignature">
                                    <span>审核签字：</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="print-model-text w280" style="text-align: center; margin-top: 15px; margin-bottom:15px; font-size:12px;">
                        <ul  style="padding:0px; margin:0px;">
                            <li class="storeQRCode text-c m-b-10" style="margin-bottom: 10px; text-align: center; display: block; color: #000;">
                                <div class="print-trim-div" data-id="storeQRCode">店铺二维码</div>
                                <img class="m-t-5" src="{{ $shop_qrcode }}" width="90" height="90">
                            </li>
                            <li class="mallWeChat text-c m-b-10" style="margin-bottom: 10px; text-align: center; display: block; color: #000;">
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
        // 
    </script>
    <script type="text/javascript">
        // 
    </script>
    <script type="text/javascript">
        // 
    </script>
</div>
<script src="/assets/d2eace91/min/js/core.min.js"></script>
<script src="/assets/d2eace91/min/js/app.common.min.js"></script>
<script src="/assets/d2eace91/js/jquery-ui.js"></script>
<script src="/assets/d2eace91/js/lodop/LodopFuncs.js"></script>
<script src="/assets/d2eace91/js/jquery-barcode.min.js"></script>
<script src="/assets/d2eace91/js/chosen/jquery.chosen.js"></script>
<script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js"></script>
<script>
    var data = {!! $default_spec['tpl_data'] !!};
    init();
    $().ready(function() {
        $(".select-print-spec").change(function() {
            var print_spec = $(this).val();
            var order_id = "{{ $order_id }}";
            var delivery_id = "{{ $delivery_id }}";
            var buy_type = "{{ $buy_type }}";
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
        var title = "购物清单";
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
    // 
    $("#btnPrint").click(function() {
        $(".print-remark-edit").each(function() {
            $(this).hide();
            $(this).siblings(".print-remark").html($(this).val()).show();
        });
        var printer = "";
        if (printer == '' || printer == null) {
            alert("该打印规格还没有设置指定的打印机");
            return false;
        }
        var html = $("#printContent").html();
        var title = "购物清单";
        lodop_preview_html(title, html, printer);
    });
    $(".print-remark").click(function() {
        $(this).hide();
        $(this).siblings(".print-remark-edit").val($(this).html()).show();
    });
    // 
    $(".orderBarCode").each(function(){
        var order_sn = $(this).data("sn");
        $(this).barcode(order_sn, "code128", {
            barWidth: 1,
            barHeight: 60,
            showHRI: false
        });
    })
    // 
</script>
</body>
</html>
