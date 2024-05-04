
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
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- ================== BEGIN BASE  ================== -->
    <!-- ================== END BASE  ================== -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="@static/js/html5shiv.min.js" />
    <script type="text/javascript" src="@static/js/respond.min.js" />
    <![endif]-->
    <link href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/animate.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/loading/loaders.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/common.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/styles.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/css/print.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=2.0" rel="stylesheet">
    <link href="/assets/d2eace91/js/chosen/chosen.css?v=2.0" rel="stylesheet">
    <script src="/assets/d2eace91/js/jquery.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=202003261806"></script>
</head>
<body>
<div class="print-admin-top">
    <div class="admin-top">
        <div class="admin-btn-r">
            <a class="save save-a" title="保存">
                <i class="icon-save"></i>
                保存
            </a>
        </div>
    </div>
</div>
<div id="template">
    {{--<div id="printContent" class="print-module_wrap">
        <!--批量打印页循环 start-->
        <div class="print-paper m210m145" style="height: auto;">
            <div class="print-paper-inner">
                <div class="print-panel">
                    <div class="top">
                        <table>
                            <tr>
                                <td style="width: 220px; height: 60px; text-align: center;">
                                    <img class="print-logo mallLogo" src="{{ $logo }}" style="max-height: 60px; max-width: 220px;" />
                                </td>
                                <td class="text-c w300" style="color: #000; text-align: center; font-size: 24px;">
                                    <h3  style="position: relative;">
                                        <div class="print-trim-div title"></div>
                                        <div class="top-right-box" style="position: absolute; right: -30px; top:5px;">
                                            <img src="/assets/d2eace91/images/common/seal-state-express-small.png">
                                        </div>
                                    </h3>
                                </td>
                            </tr>
                        </table>
                        <div class="m-b-10 m-t-10" style="margin:auto; display: flex;">
                            <div style="flex: 1;"></div>
                            <div  class="orderBarCode" style="text-align: center; width: 170px; flex: 1;">
                                <div class="bar-code " style="width: 170px; height: 60px; margin: auto; display: block;" data-sn=""></div>
                                <div class="print-trim-div" style="margin-top: 5px; text-align: center; display: block; color: #000; font-size:12px; font-family: 微软雅黑;">订单条形码</div>
                            </div>
                            <div class="orderQRCode" style="text-align: center; flex: 1; min-width: 80px;">
                                <img  src="/assets/d2eace91/images/design/app.jpg" width="60" height="60">
                                <div class="print-trim-div" style="margin-top: 5px; text-align: center; display: block; color: #000; font-size:12px; font-family: 微软雅黑;">订单二维码</div>
                            </div>
                            <div style="flex: 1;"></div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
                    <div class="store-box"  style="margin: 10px 0; overflow: hidden;">
                        <div class="storeLogo store-logo" style="float: left; display: inline-block; margin-right: 20px;" data-id="storeLogo">
                            <img class="store-logo-img" src="{{ $store_logo }}" style="max-width: 200px; max-height: 60px;">
                        </div>
                        <div class="store-info" style="float: left; max-width: 250px;">
                            <div class="print-model-text">
                                <ul>
                                    <li class="storeName">
                                        <div class="print-trim-div" data-id="storeName">
                                            <span>店铺名称：</span>
                                            xxx官方旗舰店
                                        </div>
                                    </li>
                                    <li class="storeNickname">
                                        <div class="print-trim-div" data-id="storeNickname">
                                            <span>店主昵称：</span>
                                            李某某
                                        </div>
                                    </li>
                                    <li class="storeTel">
                                        <div class="print-trim-div" data-id="storeTel">
                                            <span>店铺联系电话：</span>
                                            18900000000
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="print-model-text average3" style="margin: 15px auto 15px;">
                        <ul style="overflow: hidden;">
                            <li class="deliverCode">
                                <div class="print-trim-div" data-id="deliverCode">
                                    <span>发货单号：</span>
                                    1234567890
                                </div>
                            </li>
                            <li class="orderID">
                                <div class="print-trim-div" data-id="orderCode">
                                    <span>订单ID：</span>
                                    10000
                                </div>
                            </li>
                            <li class="orderCode">
                                <div class="print-trim-div" data-id="orderCode">
                                    <span>订单编号：</span>
                                    1234567890
                                </div>
                            </li>
                            <li class="orderTime">
                                <div class="print-trim-div" data-id="orderTime">
                                    <span>订购时间：</span>
                                    9999-01-01 12:00:00
                                </div>
                            </li>
                            <li class="payTime">
                                <div class="print-trim-div" data-id="payTime">
                                    <span>付款时间：</span>
                                    9999-01-01 12:00:00
                                </div>
                            </li>
                            <li class="nickname" style="display: none;">
                                <div class="print-trim-div" data-id="nickname">
                                    <span>买家昵称：</span>
                                    张某某
                                </div>
                            </li>
                            <li class="consigneeName">
                                <div class="print-trim-div" data-id="consigneeName">
                                    <span>收货人姓名：</span>
                                    王某某
                                </div>
                            </li>
                            <li class="consigneeTel">
                                <div class="print-trim-div" data-id="consigneeTel">
                                    <span>收货人电话：</span>
                                    1900000000
                                </div>
                            </li>
                            <li class="orderUserCode">
                                <div class="print-trim-div" data-id="orderUserCode">
                                    <span>下单会员账户：</span>
                                    123456
                                </div>
                            </li>
                            <li class="orderUserTel" style="display: none;">
                                <div class="print-trim-div" data-id="orderUserTel">
                                    <span>下单会员手机号：</span>
                                    1900000000
                                </div>
                            </li>
                            <li class="payMethod">
                                <div class="print-trim-div" data-id="payMethod">
                                    <span>支付方式：</span>
                                    余额支付
                                </div>
                            </li>
                            <li class="storeUserRank" style="display: none;">
                                <div class="print-trim-div" data-id="storeUserRank">
                                    <span>店铺会员等级：</span>
                                    普通会员
                                </div>
                            </li>
                            <li class="ascriptionStore" style="display: none">
                                <div class="print-trim-div" data-id="ascriptionStore">
                                    <span>购买者隶属店铺名称：</span>
                                    无
                                </div>
                            </li>
                            <li class="deliveryTime" style="display:block; width:100%">
                                <div class="print-trim-div" data-id="deliveryTime">
                                    <span>送货时间：</span>
                                    9999-01-01 12:00:00
                                </div>
                            </li>
                            <li class="orderAddress" style="display:block; width:100%">
                                <div class="print-trim-div" data-id="orderAddress">
                                    <span>收货地址：</span>
                                    xx省xx市xx区xx街xx号xx栋xx室
                                </div>
                            </li>
                            <li class="pickupName" stype="display:block; width:100%">
                                <div class="print-trim-div" data-id="pickupName">
                                    <span>自提点名称:</span>
                                    自提点名称
                                </div>
                            </li>
                            <li class="buyerMessage" style="display:block; width:100%">
                                <div class="print-trim-div" data-id="buyerMessage">
                                    <span>买家留言：</span>
                                    买家留言内容
                                </div>
                            </li>
                            <!--li class="goodsTotalNum">
                                <div class="print-trim-div" data-id="goodsTotalNum">
                                    <span>商品数量：</span>
                                    1件
                                </div>
                            </li-->
                        </ul>
                        <ul>
                            <li class="invoiceInfo">
                                <div class="print-trim-div" data-id="invoiceInfo">
                                    <span>发票信息：</span>
                                    发票信息
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--商品信息 start-->
                    <table class="table table-bordered" style="border-color: #000; color: #000; margin-bottom: 20px;">
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
                            <th class="goodsSn w150 text-c" style="color: #000; background: #fff; padding: 4px; border-color: #000; border-right: 1px solid #000; font-weight: 200">
                                <div class="print-trim-div" data-id="goodsSn">商品货号</div>
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
                        <tr>
                            <td class="libraryCode w90 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">1001</div>
                            </td>
                            <td class="goodsCode w70 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">1</div>
                            </td>
                            <td class="goodsName w300 text-l" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">商品名称</div>
                            </td>
                            <td class="goodsSpec w150 text-l" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">商品规格</div>
                            </td>
                            <td class="goodsBarCode w150 text-l" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">1234567890</div>
                            </td>
                            <td class="goodsSn w150 text-l" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">234567890</div>
                            </td>
                            <td class="goodsNum w50 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">1</div>
                            </td>
                            <td class="goodsPrice w70 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                                <div class="print-trim-div">￥1.00</div>
                            </td>
                            <td class="goodsSubtotal w70 text-c" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000">
                                <div class="print-trim-div">￥1.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-r" style="color: #000; height: 40px; padding: 4px; border-color: #000; border-top: 1px solid #000;">
                                <div class="goodsTotalPrice pull-right m-l-20">
                                    <div class="print-trim-div" data-id="goodsTotalPrice">商品总金额：￥1.00</div>
                                </div>
                                <div class="goodsTotalNum pull-right">
                                    <div class="print-trim-div" data-id="goodsTotalNum">商品总数量：1</div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="paymentSummary address-info text-r m-b-20">
                        <div class="print-trim-div" data-id="paymentSummary">
                            <p style="color: #000;">
                                <span>在线支付：￥0</span>
                                <em class="operator">+</em>
                                <span>店铺购物卡：￥0</span>
                                <em class="operator">+</em>
                                <span>余额支付：￥0</span>
                                <em class="operator">=</em>
                                <span style="color: #C00;">
                                <strong>实付款金额：￥0</strong>
                            </span>
                            </p>
                        </div>
                    </div>
                    <div class="paymentDetails address-info text-r m-b-20">
                        <div class="print-trim-div" data-id="paymentDetails">
                            <p class="m-b-5" style="color: #000;">
                                <span>商品总金额：￥1.00</span>
                                <em class="operator">+</em>
                                <span>运费：￥0</span>
                                <em class="operator">+</em>
                                <span>货到付款加价：￥0</span>
                                <em class="operator">-</em>
                                <span>店铺红包：￥0</span>
                                <em class="operator">-</em>
                                <span>平台红包：￥0</span>
                                <em class="operator">-</em>
                                <span>优惠：￥0</span>
                                <em class="operator">=</em>
                                <span>
                                <strong>订单总金额：￥1.00</strong>
                            </span>
                            </p>
                            <p style="color: #000;">
                                <span>订单总金额：￥1.00</span>
                                <em class="operator">-</em>
                                <span>余额：0</span>
                                <em class="operator">=</em>
                                <span class="order-amount">
                                <strong>待付款金额：￥1.00</strong>
                            </span>
                            </p>
                        </div>
                    </div>
                    <!--商品信息 end-->
                    <div class="print-model-text">
                        <ul>
                            <li class="storeAddress" style="display: none;">
                                <div class="print-trim-div" data-id="storeAddress">
                                    <span>店铺发货地址：</span>
                                    xx省xx市xx区xx街xx号xx栋xx室
                                </div>
                            </li>
                            <li class="sellerRemarks" style="display: none;">
                                <div class="print-trim-div" data-id="sellerRemarks">
                                    <span>商家备注：</span>
                                    商家备注内容
                                </div>
                            </li>
                            <li class="printTime" style="display: none;">
                                <div class="print-trim-div" data-id="printTime">
                                    <span>打印时间：</span>
                                    9999-01-01 12:00:00
                                </div>
                            </li>
                        </ul>
                    </div>
                    <textarea class="printRemark form-control print-remark-edit" placeholder="请输入备注信息" rows="3" style="resize: none; display: none; width: 100%; height: auto; min-width: auto;"></textarea>
                    <p class="print-remark" style="display: none; cursor: pointer;" title="点击重新编辑"></p>
                    <div class="print-model-text">
                        <ul>
                            <li class="auditSignature h80" style="display: none;">
                                <div class="print-trim-div" data-id="auditSignature">
                                    <span>审核签字：</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="print-model-text average3">
                        <ul style="display: flex;">
                            <li style="flex: 1;"></li>
                            <li class="storeQRCode text-c m-b-10" style="flex: 1; margin-right:10px; width: 100px;">
                                <img class="m-b-5" src="{{ $shop_qrcode }}" width="80" height="80">
                                <div class="print-trim-div" data-id="storeQRCode">店铺二维码</div>
                            </li>
                            <li class="storeWeChat text-c m-b-10" style="flex: 1; margin-right:10px; width: 100px;">
                                <img class="m-b-5" src="/assets/d2eace91/images/design/app.jpg" width="80" height="80">
                                <div class="print-trim-div" data-id="storeWeChat">店铺微信公众号</div>
                            </li>
                            <li class="mallWeChat text-c m-b-10" style="flex: 1; width: 100px;">
                                <img class="m-b-5" src="{{ $mall_wx_qrcode }}" width="80" height="80">
                                <div class="print-trim-div" data-id="mallWeChat">商城微信公众号</div>
                            </li>
                            <li style="flex: 1;"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="division-line" style="top: 139mm">
                <span>分页分割线</span>
            </div>
        </div>
        <!--批量打印页循环 end-->
    </div>
    <!--打印模板设置-->
    <div class="toolbar-fun-wrap r" style="display: block;">
        <div class="toolbar-fun-inner">
            <div class="toolbar-fun-head">
                <strong>打印模板设置</strong>
            </div>
            <div class="toolbar-fun-body">
                <div class="group-list-title">
                    <strong>字体样式</strong>
                    <span>默认字体为微软雅黑，大小为12像素</span>
                </div>
                <div class="group-list-panel">
                    <div class="group-control-wrap">
                        <span>字体：</span>
                        <select id="d_font" class="page-type-select" onchange="fontSelect()">
                            <option value="0">请选择</option>
                            <option value="宋体">宋体</option>
                            <option value="微软雅黑" selected="selected">微软雅黑</option>
                            <option value="黑体">黑体</option>
                            <option value="楷体">楷体</option>
                            <option value="隶书">隶书</option>
                            <option value="方正兰亭超细黑简体">方正兰亭超细黑简体</option>
                            <option value="等线">等线</option>
                            <option value="arial">arial</option>
                            <option value="impact">impact</option>
                        </select>
                    </div>
                    <div class="group-control-wrap">
                        <span>大小：</span>
                        <input id="d_size" onchange="fontSize();" value="12" type="text" maxlength="2" />
                    </div>
                    <div class="group-control-wrap last">
                        <!--当点击的内容所用到下面选项时，则为下面的选项添加selected样式-->
                        <a id="d_blod" class="text-button">
                            <span>B</span>
                        </a>
                        <a id="d_italic" class="text-button">
                            <span>I</span>
                        </a>
                        <a id="d_underline" class="text-button">
                            <span>U</span>
                        </a>
                    </div>
                </div>
                <div class="group-list-title">
                    <strong>纸张信息</strong>
                    <span>（单位为毫米），打印时按此处设置的纸张大小打印</span>
                </div>
                <div class="group-list-panel">
                    <select class="form-control w100 select-print-spec">
                        @foreach($spec_list as $item)
                            <option value="{{ $item['print_spec'] }}" @if($item['is_default'])selected="selected"@endif>{{ $item['print_spec'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="group-list-title">
                    <strong>打印项</strong>
                    <span>自动获取订单、商品、店铺、买家等信息进行打印</span>
                </div>
                <div class="group-list-panel">
                    <!--这里点击添加模板打印项，点击添加或已添加的打印项增加selected选中样式，移出则还原-->
                    <h5 class="small-title">
                        <span>头部</span>
                    </h5>
                    <div class="print-project">
                        <ul class="head">
                            <li>
                                <label>
                                    <input data-id="mallLogo" name="mallLogo" class="ck" type="checkbox">
                                    商城logo
                                </label>
                            </li>
                        </ul>
                        <div class="group-control-wrap">
                            <span>头部名称：</span>
                            <input class="input-text w180" maxlength="6" id="title" name="title" type="text" />
                        </div>
                    </div>
                    <h5 class="small-title">
                        <span>订单主体</span>
                    </h5>
                    <div class="print-project">
                        <ul>
                            <li>
                                <label>
                                    <input data-id="orderID" name="orderID" class="ck" type="checkbox">
                                    订单ID
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="orderCode" name="orderCode" class="ck" type="checkbox">
                                    订单编号
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="orderQRCode" name="orderQRCode" class="ck" type="checkbox">
                                    订单二维码
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="deliveryImage" name="deliveryImage" class="ck" type="checkbox">
                                    发货单二维码
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="orderBarCode" name="orderBarCode" class="ck" type="checkbox">
                                    订单条形码
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="orderTime" name="orderTime" class="ck" type="checkbox">
                                    订购时间
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="payTime" name="payTime" class="ck" type="checkbox">
                                    付款时间
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="payMethod" name="payMethod" class="ck" type="checkbox">
                                    支付方式
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="mallWeChat" name="mallWeChat" class="ck" type="checkbox">
                                    商城微信公众号
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="printTime" name="printTime" class="ck" type="checkbox">
                                    打印时间
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="deliverCode" name="deliverCode" class="ck" type="checkbox">
                                    发货单号
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="pickupName" name="pickupName" class="ck" type="checkbox">
                                    自提点名称
                                </label>
                            </li>
                        </ul>
                    </div>
                    <h5 class="small-title">
                        <span>收货人</span>
                    </h5>
                    <div class="print-project">
                        <ul>
                            <li>
                                <label>
                                    <input data-id="nickName" name="nickName" class="ck" type="checkbox">
                                    买家昵称
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="consigneeName" name="consigneeName" class="ck" type="checkbox">
                                    收货人姓名
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="consigneeTel" name="consigneeTel" class="ck" type="checkbox">
                                    收货人电话
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="orderUserCode" name="orderUserCode" class="ck" type="checkbox">
                                    下单会员账户
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="orderUserTel" name="orderUserTel" class="ck" type="checkbox">
                                    下单会员手机号
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="deliveryTime" name="deliveryTime" class="ck" type="checkbox">
                                    送货时间
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="invoiceInfo" name="invoiceInfo" class="ck" type="checkbox">
                                    发票信息
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="orderAddress" name="orderAddress" class="ck" type="checkbox">
                                    收货地址
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="storeUserRank" name="storeUserRank" class="ck" type="checkbox">
                                    店铺会员等级
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="ascriptionStore" name="ascriptionStore" class="ck" type="checkbox">
                                    购买者隶属店铺名称
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="buyerMessage" name="buyerMessage" class="ck" type="checkbox">
                                    买家留言
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="sellerRemarks" name="sellerRemarks" class="ck" type="checkbox">
                                    商家备注
                                </label>
                            </li>
                        </ul>
                    </div>
                    <h5 class="small-title">
                        <span>商品信息</span>
                    </h5>
                    <div class="print-project">
                        <ul>
                            <li>
                                <label>
                                    <input data-id="libraryCode" name="libraryCode" class="ck" type="checkbox">
                                    库位码
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsCode" name="goodsCode" class="ck" type="checkbox">
                                    商品编号
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsName" name="goodsName" class="ck" type="checkbox">
                                    商品名称
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsSpec" name="goodsSpec" class="ck" type="checkbox">
                                    商品规格
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsBarCode" name="goodsBarCode" class="ck" type="checkbox">
                                    商品条形码
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsSn" name="goodsSn" class="ck" type="checkbox">
                                    商品货号
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsPrice" name="goodsPrice" class="ck" type="checkbox">
                                    单价
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsNum" name="goodsNum" class="ck" type="checkbox">
                                    数量
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsSubtotal" name="goodsSubtotal" class="ck" type="checkbox">
                                    小计
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsTotalNum" name="goodsTotalNum" class="ck" type="checkbox">
                                    商品总数量
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="goodsTotalPrice" name="goodsTotalPrice" class="ck" type="checkbox">
                                    商品总金额
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="paymentDetails" name="paymentDetails" class="ck" type="checkbox">
                                    支付明细
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="paymentSummary" name="paymentSummary" class="ck" type="checkbox">
                                    支付汇总
                                </label>
                            </li>
                        </ul>
                    </div>
                    <h5 class="small-title">
                        <span>店铺信息</span>
                    </h5>
                    <div class="print-project">
                        <ul>
                            <li>
                                <label>
                                    <input data-id="storeNickname" name="storeNickname" class="ck" type="checkbox">
                                    店主昵称
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="storeName" name="storeName" class="ck" type="checkbox">
                                    店铺名称
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="storeTel" name="storeTel" class="ck" type="checkbox">
                                    店铺联系电话
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="storeAddress" name="storeAddress" class="ck" type="checkbox">
                                    店铺发货地址
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="storeQRCode" name="storeQRCode" class="ck" type="checkbox">
                                    店铺二维码
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="storeLogo" name="storeLogo" class="ck" type="checkbox">
                                    店铺logo
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="storeWeChat" name="storeWeChat" class="ck" type="checkbox">
                                    店铺微信公众号
                                </label>
                            </li>
                        </ul>
                    </div>
                    <h5 class="small-title">
                        <span>其它</span>
                    </h5>
                    <div class="print-project">
                        <ul>
                            <li>
                                <label>
                                    <input data-id="printRemark" name="printRemark" class="ck" type="checkbox">
                                    打印备注
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input data-id="auditSignature" name="auditSignature" class="ck" type="checkbox">
                                    审核签字
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>--}}

    @include('shop.print-spec.select_spec')

</div>
<script type="text/javascript">
    // 
</script>
<style type="text/css">
    .layui-layer.layui-layer-dialog.layui-layer-hui{ top: 50% !important;}
    .layui-layer-hui .layui-layer-content{ height: auto !important;}
    .layui-layer-content .loader-inner.ball-clip-rotate > div { margin-left: -18px; margin-top: -18px;}
</style>
<script src="/assets/d2eace91/js/jquery.lazyload.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.cookie.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.history.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/szy.page.more.js?v=202003261806"></script>
<script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/common.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/jquery-barcode.min.js?v=202003261806"></script>
<script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=202003261806"></script>
<script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=202003261806"></script>
<script>
    var current_code = null;
    var data = {!! $data !!};
    init();
    data.id = "{{ $model['id'] }}";
    $("body").on("click", ".print-trim-div", function() {
        $('.print-trim-div').removeClass('print-trim-selected');
        $(this).addClass('print-trim-selected');
        current_code = $(this).data("id");
        var style = getStyle(current_code);
        changeStyle(current_code, style);
    });
    $('#title').bind('input propertychange', function() {
        var val = $("#title").val();
        if (val == '') {
            $(".title").html('打印标题');
        } else {
            $(".title").html(val);
        }
    });
    $("body").on("click", ".ck", function() {
        var code = $(this).data("id");
        var ck = $(this).is(":checked");
        var style = getStyle(code);
        if (ck == true) {
            $("." + code).show();
            current_code = code;
        } else {
            $("." + code).hide();
            if (current_code == code) {
                current_code = null;
            }
            style = '';
        }
        setStyle(code, style);
    });
    //为字体添粗,为选中的框增加 font-weight: bold;
    $('#d_blod').click(function() {
        var style = getStyle(current_code);
        if ($(this).hasClass('selected')) {
            style.blod = 'normal';
        } else {
            style.blod = 'bold';
        }
        setStyle(current_code, style);
    });
    //为字体加倾斜,为选中的框增加 font-style: italic;
    $('#d_italic').click(function() {
        var style = getStyle(current_code);
        if ($(this).hasClass('selected')) {
            style.italic = 'normal';
        } else {
            style.italic = 'italic';
        }
        setStyle(current_code, style);
    });
    //为字体加下划线,为选中的框增加 text-decoration: underline;
    $('#d_underline').click(function() {
        var style = getStyle(current_code);
        if ($(this).hasClass('selected')) {
            style.underline = 'none';
        } else {
            style.underline = 'underline';
        }
        setStyle(current_code, style);
    });
    $('body').on('change','.select-print-spec',function(){
        var print_spec = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/shop/print-spec/select-spec',
            data: {
                print_spec: print_spec
            },
            dataType: 'json',
            success: function(result) {
                $("#template").html(result.data);
            }
        });
    })
    //为字体添加字体样式，为选中的框增加 font-family:"";默认是微软雅黑
    function fontSelect() {
        var style = getStyle(current_code);
        style.font = $("#d_font").val();
        setStyle(current_code, style);
    }
    //为字体设置大小，为选中的框增加font-size:;默认12px
    function fontSize() {
        var style = getStyle(current_code);
        style.size = $("#d_size").val();
        setStyle(current_code, style);
    }
    //初始化数据
    function init()
    {
        if($.isEmptyObject(data))
        {
            $(".ck").each(function() {
                if($(this).attr("name")!="nickName" && $(this).attr("name")!="orderUserTel" && $(this).attr("name")!="storeUserRank" && $(this).attr("name")!="storeAddress" && $(this).attr("name")!="sellerRemarks" && $(this).attr("name")!="printTime" && $(this).attr("name")!="auditSignature" && $(this).attr("name")!="printRemark" && $(this).attr("name")!="ascriptionStore")
                {
                    $(this).attr("checked", !$(this).attr("checked"));
                }
            });
        }
        else
        {
            $.each(data,function(code,style) {
                if (code != 'title') {
                    initStyle(code,style);
                    if(style.is_check == 1)
                    {
                        $("." + code).show();
                        $("input[type=checkbox][name='"+code+"']").prop('checked', true);
                    }
                    else
                    {
                        $("." + code).hide();
                        $("input[type=checkbox][name='"+code+"']").removeProp('checked');
                    }
                }

            });
            $(".title").show();
            if(data.title != '')
            {
                $(".title").html(data.title);
                $("#title").val(data.title);
            }
            else
            {
                $(".title").html("打印标题");
            }
        }
    }
    // 获取样式
    function getStyle(code) {
        if (!code) {
            code = current_code;
        }
        if (!data[code]) {
            data[code] = {
                font: '微软雅黑',
                size: 12,
            };
        }
        return data[code];
    }
    function setStyle(code, style) {
        data[code] = style;
        changeStyle(code, style);
    }
    function initStyle(code,style)
    {
        $("." + code).css("font-family", style.font);
        $("." + code).css("font-size", style.size);
        $("." + code).css("font-weight", style.blod);
        $("." + code).css("font-style", style.italic);
        $("." + code).css("text-decoration", style.underline);
    }
    // 切换样式
    function changeStyle(code, style) {
        if (!style) {
            style = getStyle(code);
        }
        $("#d_font").val(style.font);
        $("#d_size").val(style.size);
        $("." + code).find(".print-trim-selected").css("font-family", style.font);
        $("." + code).find(".print-trim-selected").css("font-size", style.size);
        $("." + code).find(".print-trim-selected").css("font-weight", style.blod);
        $("." + code).find(".print-trim-selected").css("font-style", style.italic);
        $("." + code).find(".print-trim-selected").css("text-decoration", style.underline);
        if (style.blod == 'bold') {
            $("#d_blod").addClass('selected');
        } else {
            $("#d_blod").removeClass('selected');
        }
        if (style.italic == 'italic') {
            $("#d_italic").addClass('selected');
        } else {
            $("#d_italic").removeClass('selected');
        }
        if (style.underline == 'underline') {
            $("#d_underline").addClass("selected");
        } else {
            $("#d_underline").removeClass("selected");
        }
    }
    // 
    $(".orderBarCode .bar-code").barcode("20190320033931899330", "code128", {
        barWidth: 1,
        barHeight: 60,
        showHRI: false
    });
    //
    $("body").on("click", ".save", function() {
        $(".ck").each(function() {
            var code = $(this).data("id");
            var ck = $(this).is(":checked");
            var style = getStyle(code);
            if (ck == true) {
                style.is_check = 1;
            } else {
                style.is_check = 0;
            }
            setStyle(code, style);
        });
        data.title = $("#title").val();
        $.loading.start();
        $.post('/shop/print-spec/set', data, function(result) {
            if (result.code == 0) {
                $.msg(result.message, {
                    time: 3000
                });
                // 停止加载
                $.loading.stop();
            } else {
                $.msg(result.message, {
                    time: 5000
                });
            }
        }, 'json');
    });
    // 
</script>
</body>
</html>
