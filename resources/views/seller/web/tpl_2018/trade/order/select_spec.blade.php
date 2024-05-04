<link href="/assets/d2eace91/css/print.css?v=2.0" rel="stylesheet">
<link href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=2.0" rel="stylesheet">
<link href="/assets/d2eace91/css/common.css?v=2.0" rel="stylesheet">
<link href="/assets/d2eace91/css/styles.css?v=2.0" rel="stylesheet">
<!--A5-->
<div class="print-page print-layout mm241mm280">
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
                <option value="A4纸张" >A4纸张</option>
                <option value="100MM" >100MM</option>
                <option value="241MM*280MM" selected="selected">241MM*280MM</option>
                <option value="190MM*280MM" >190MM*280MM</option>
                <option value="60MM" >60MM</option>
                <option value="210MM*145MM" >210MM*145MM</option>
            </select>
            <p class="c-999 m-t-10">打印规格需店铺管理员在商家后台->店铺->打印设置中进行设置。</p>
            <p class="m-t-5">
                <span class="c-red">点击按钮快去设置吧！</span>
                </br>
                <a class="btn btn-primary btn-sm m-t-5" href="../../shop/print-spec/list" target="_blank">去设置</a>
            </p>
        </div>
        <div class="tip">
            <dl>
                <dt>
                    <h1>241</h1>
                    <em>Size: 241mm x 280mm</em>
                </dt>
            </dl>
        </div>
        <div class="division-line" style="top: 274mm">
            <span>分页分割线</span>
        </div>
    </div>
    <div class="orderprint" style="padding: 0mm">
        <div id="printContent">
            <div class="print-panel" style="width: 241mm; padding: 5mm 8mm 3mm 8mm; min-height: 272mm; margin: auto; height: auto; box-sizing:border-box;">
                <div class="top">
                    <table style="width:100%">
                        <tr>
                            <td style="width: 220px; height: 60px; text-align: center;">
                                <img class="print-logo mallLogo" src="http://xxxx/images/" style="max-height: 60px; max-width: 220px;" />
                            </td>
                            <td class="text-c w400">
                                <h3  style="position: relative;  width:400px;">
                                    <div class="print-trim-div title" style="color: #000; text-align: center; font-size: 24px;">购物清单</div>
                                    <div class="top-right-box" style="position: absolute; right: -30px; top:-5px;">
                                        <img src="/assets/d2eace91/images/common/seal-state-express-small.png">
                                    </div>
                                </h3>
                            </td>
                            <td style="width:200px;"></td>
                        </tr>
                    </table>
                    <div class="m-b-10 m-t-10" style="margin:auto; display: flex;">
                        <div style="flex: 1;"></div>
                        <div  class="orderBarCode" style="text-align: center; width: 170px; flex: 1;">
                            <div class="bar-code" style="width: 170px; height: 60px; margin: auto; display: block;" data-sn="20200319073158923230"></div>
                            <div class="print-trim-div" style="margin-top: 5px; text-align: center; display: block; color: #000; font-size:12px; font-family: 微软雅黑;">订单条形码</div>
                        </div>
                        <div class="orderQRCode" style="text-align: center; flex: 1; min-width: 80px;">
                            <img  src="http://xxxx/1737/oqrcode/26/qrcode_5889.png" width="60" height="60">
                            <div class="print-trim-div" style="margin-top: 5px; text-align: center; display: block; color: #000; font-size:12px; font-family: 微软雅黑;">订单二维码</div>
                        </div>
                        <div style="flex: 1;"></div>
                        <div style="clear:both"></div>
                    </div>
                </div>
                <div class="store-box" style="margin: 5px 0; overflow: hidden;">
                    <div class="store-logo" style="float: left; display: inline-block; margin-right: 20px;">
                        <img class="storeLogo store-logo-img" src="http://xxxx/images/" style="max-width: 200px; max-height: 60px;">
                    </div>
                    <div class="store-info" style="float: left;">
                        <div class="print-model-text">
                            <ul style="padding:0px; margin:0px;">
                                <li class="storeName" style="list-style: none;display: block; color: #000;font-size:12px;">
                                    <div class="print-trim-div" data-id="storeName">
                                        <span>店铺名称：</span>
                                        123445
                                    </div>
                                </li>
                                <li class="storeNickname" style="list-style: none;display: block; color: #000;font-size:12px;">
                                    <div class="print-trim-div" data-id="storeNickname">
                                        <span>店主昵称：</span>
                                    </div>
                                </li>
                                <li class="storeTel" style="list-style: none;display: block; color: #000;font-size:12px;">
                                    <div class="print-trim-div" data-id="storeTel">
                                        <span>店铺联系电话：</span>
                                        15001059007
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--堂内点餐桌号-->
                    <div style="clear:both"></div>
                </div>
                <div class="print-model-text average3" style="margin: 5px auto 15px;font-size:12px;">
                    <ul style="overflow: hidden; padding:0px;margin:0">
                        <li class="orderID" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="orderID">
                                <span>订单ID：</span>
                                5889
                            </div>
                        </li>
                        <li class="orderCode" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="orderCode">
                                <span>订单编号：</span>
                                20200319073158923230
                            </div>
                        </li>
                        <li class="orderCode" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="orderTime">
                                <span>订购时间：</span>
                                2020-03-19 15:31:58
                            </div>
                        </li>
                        <li class="payTime" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="payTime">
                                <span>付款时间：</span>
                                2020-03-19 15:31:58                             </div>
                        </li>
                        <li class="nickname" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="nickname" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <span>买家昵称：</span>
                            </div>
                        </li>
                        <li class="consigneeName" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="consigneeName" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <span>收货人姓名：</span>
                                qq
                            </div>
                        </li>
                        <li class="consigneeTel" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="consigneeTel">
                                <span>收货人电话：</span>
                                15555555586
                            </div>
                        </li>
                        <li class="orderUserCode" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="orderUserCode">
                                <span>下单会员账户：</span>
                                qqq
                            </div>
                        </li>
                        <li class="orderUserTel" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="orderUserTel">
                                <span>下单会员手机号：</span>
                                15555555555
                            </div>
                        </li>
                        <li class="payMethod" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="payMethod">
                                <span>支付方式：</span>
                                余额支付
                            </div>
                        </li>
                        <li class="storeUserRank" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="storeUserRank">
                                <span>店铺会员等级：</span>
                                普通会员VIP1
                            </div>
                        </li>
                        <li class="ascriptionStore" style="list-style: none; width: 33%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="ascriptionStore">
                                <span>购买者隶属店铺名称：</span>
                                无
                            </div>
                        </li>
                        <li class="deliveryTime" style="list-style: none; width:100%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="deliveryTime">
                                <span>送货时间：</span>
                                立即配送
                            </div>
                        </li>
                        <li class="orderAddress" style="list-style: none; width: 100%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="orderAddress">
                                <span>收货地址：</span>
                                河北省-秦皇岛市-海港区   人民公园                             </div>
                        </li>
                        <li class="pickupName" style="list-style: none; width: 100%; display: inline-block; float: left; color: #000">
                            <div class="print-trim-div" data-id="pickupName">
                                <span>自提点名称：</span>
                            </div>
                        </li>
                    </ul>
                    <ul class="invoiceInfo" data-id="invoiceInfo" style="padding:0px;margin:0">
                        <!--   -->
                        <!--   -->
                    </ul>
                </div>
                <!--商品信息 start-->
                <table class="table table-bordered" style="border-collapse:collapse; font-size:12px; width:100%; border:1px solid #000; border-color: #000; color: #000;">
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
                        <td class="libraryCode w90 text-c" style="text-align:center; color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                            <div class="print-trim-div"></div>
                        </td>
                        <td class="goodsCode w70 text-c" style="text-align:center; color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                            <div class="print-trim-div">48038</div>
                        </td>
                        <td class="goodsName w300 text-l" style="color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                            <div class="print-trim-div">ipad钢化膜2018新款air2苹果mini4平板pro9.7英寸10.5电脑11新12.9版</div>
                        </td>
                        <td class="goodsSpec w150 text-l" style="text-align:center; color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                            <div class="print-trim-div">颜色分类：iPad mini1/2/3【高清款HZ68】9H耐磨防刮◆裸机手感</div>
                        </td>
                        <td class="goodsBarCode w150 text-l" style="text-align:center; color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                            <div class="print-trim-div"></div>
                        </td>
                        <td class="goodsSn w150 text-l" style="text-align:center; color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                            <div class="print-trim-div"></div>
                        </td>
                        <td class="goodsNum w50 text-c" style="text-align:center; color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                            <div class="print-trim-div">1</div>
                        </td>
                        <td class="goodsPrice w70 text-c" style="text-align:center; color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000; border-right: 1px solid #000;">
                            <div class="print-trim-div">￥29.90</div>
                        </td>
                        <td class="goodsSubtotal w70 text-c" style="text-align:center; color: #000; padding: 4px; border-color: #000; border-top: 1px solid #000">
                            <div class="print-trim-div">￥29.90</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" class="text-r" style="color: #000; height: 40px; padding: 4px; border-color: #000; border-top: 1px solid #000;">
                            <div class="goodsTotalPrice pull-right m-l-20" style="float:right; margin-left:20px;">
                                <div class="print-trim-div" data-id="goodsTotalPrice">商品总金额：￥29.90</div>
                            </div>
                            <div class="goodsTotalNum pull-right" style="float:right;">
                                <div class="print-trim-div" data-id="goodsTotalNum">商品总数量：1</div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="paymentDetails address-info text-r m-b-20" style="font-size:12px; margin-right:5px; ">
                    <div class="print-trim-div" data-id="paymentDetails">
                        <p class="m-b-5" style="color: #000; text-align:right;">
                            <span>商品总金额：￥29.90</span>
                            <em class="operator">+</em>
                            <span>运费：￥0.00</span>
                            <em class="operator">-</em>
                            <span>店铺红包：￥0.00</span>
                            <em class="operator">-</em>
                            <span>平台红包：￥0.00</span>
                            <em class="operator">-</em>
                            <span>卖家优惠：￥0.00</span>
                            <em class="operator">-</em>
                            <span>积分抵扣：￥0.00</span>
                            <em class="operator">=</em>
                            <span>
                                <strong>订单总金额：￥29.90</strong>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="paymentSummary address-info text-r m-b-20" style="font-size:12px; margin-right:5px; ">
                    <div class="print-trim-div" data-id="paymentSummary">
                        <p style="color: #000; text-align:right;">
                            <span>在线支付：￥0.00</span>
                            <em class="operator">+</em>
                            <span>余额支付：￥29.90</span>
                            <em class="operator">=</em>
                            <span style="color: #C00;">
                                <strong>实付款金额：￥29.90</strong>
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
                <div class="print-model-text" style="font-size:12px;">
                    <ul style="padding:0px;margin:0">
                        <li class="storeAddress" style="display: block; color: #000;">
                            <div class="print-trim-div" data-id="storeAddress">
                                <span>店铺发货地址：</span>
                                北京-北京市-东城区水水水水
                            </div>
                        </li>
                        <li class="sellerRemarks" style="list-style: none; display: block; color: #000;">
                            <div class="print-trim-div" data-id="sellerRemarks">
                                <span>商家备注：</span>
                                无
                            </div>
                        </li>
                        <li class="printTime" style="list-style: none; display: block; color: #000;">
                            <div class="print-trim-div" data-id="printTime">
                                <span>打印时间：</span>
                                2020-04-04 16:38:40
                            </div>
                        </li>
                    </ul>
                </div>
                <textarea class="printRemark form-control print-remark-edit" placeholder="请输入备注信息" rows="3" style="resize: none; display: none"></textarea>
                <p class="print-remark" style="display: none; cursor: pointer;" title="点击重新编辑"></p>
                <div class="print-model-text" style="font-size:12px;">
                    <ul style="padding:0px;margin:0">
                        <li class="auditSignature h80" style="list-style: none; display: block; color: #000;">
                            <div class="print-trim-div" data-id="auditSignature">
                                <span>审核签字：</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="print-model-text average3" style="text-align: center; margin-top: 15px; margin-bottom:15px; font-size:12px;">
                    <ul style="padding:0px; margin:0; display: flex;">
                        <li style="flex: 1;"></li>
                        <li class="storeQRCode text-c" style="flex: 1; list-style: none; text-align: center; float: left; display: inline-block; color: #000;  margin-right:10px; width: 100px;">
                            <img class="m-b-5" src="{{ $shop_qrcode }}" width="90" height="90">
                            <div class="print-trim-div" data-id="storeQRCode">店铺二维码</div>
                        </li>
                        <li class="mallWeChat text-c" style="flex: 1; list-style: none; text-align: center; float: left; display: inline-block; color: #000; width: 100px;">
                            <img class="m-b-5" src="{{ $mall_wx_qrcode }}" width="90" height="90">
                            <div class="print-trim-div" data-id="mallWeChat">商城微信公众号</div>
                        </li>
                        <li style="flex: 1;"></li>
                    </ul>
                </div>
            </div>
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
<script src="/assets/d2eace91/js/jquery-barcode.min.js?v=202003261806"></script>
<script>

    var data = {};

    init();

    $().ready(function() {
        $(".select-print-spec").change(function() {
            var print_spec = $(this).val();
            var order_id = "5889";
            var delivery_id = "0";
            var buy_type = "1";

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



    $(".orderBarCode .bar-code").each(function(){
        var order_sn = $(this).data("sn");
        $(this).barcode(order_sn, "code128", {
            barWidth: 1,
            barHeight: 60,
            showHRI: false
        });
    })

    //
</script>
