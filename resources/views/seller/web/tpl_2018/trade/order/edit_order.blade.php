<div id="{{ $uuid }}">
    <form id="eidt_order_form" class="form-horizontal" action="/trade/order/edit-order.html?from=list&type=order&id={{ $info['order_id'] }}" method="POST" onsubmit="return false">
        @csrf
        <h5 class="m-b-10">
            <strong>订单原价</strong>
            （包含运费）：￥{{ $info['order_amount'] }}
        </h5>
        <div class="content">
            <div class="alert alert-info br-0 m-b-10">
                <p>1. 商家直接修改最终价格即可</p>
                <p>2. 邮费为0时货到付款服务费将由卖家承担</p>
                <p>3. 买家实付金额不可为0元以下。</p>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="w250">商品信息</th>
                        <th class="w70">单价</th>
                        <th class="text-c w50">数量</th>
                        <th class="w70">原价</th>
                        <th class="w120 text-c">改价后金额</th>
                        <th class="text-c w100">邮费</th>
                        <!-- -->
                        <th class="text-c w100">额外配送费</th>
                        <th class="text-c w100">包装费</th>
                    </tr>
                    </thead>
                    <!--统一走一个的情况-->
                    <tbody>
                    @foreach($info['goods_list'] as $key=>$goods)
                        <tr class="order-item">
                            <td class="item">
                                <div class="pic-info">
                                    <a href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                                        <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情" />
                                    </a>
                                </div>
                                <div class="txt-info w120">
                                    <div class="desc">
                                        <a class="goods-name" href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" target="_blank" title="查看商品详情">
                                            {{ $goods['goods_name'] }}
                                        </a>
                                        <!-- <a class="snap">【交易快照】</a> -->
                                    </div>
                                    <div class="props">
                                        {{--<span>尺寸：S</span>--}}
                                        {{--<span>内存：4G</span>--}}
                                        <span>{!! $goods['spec_info'] !!}</span>


                                    </div>
                                </div>
                            </td>
                            <td class="price">{{ $goods['goods_price'] }}</td>
                            <td class="num text-c">{{ $goods['goods_number'] }}</td>
                            <td class="price">{{ $goods['goods_price']*$goods['goods_number'] }}</td>
                            <td class="text-c p-r-5">
                                <input type="text" name="change_amount[{{ $goods['record_id'] }}]" class="form-control w80 other-price" value="{{ $goods['goods_price']*$goods['goods_number'] }}" data-rule-number="true" data-rule-min="0" />
                            </td>

                            @if($key == 0)
                                <td class="postage" rowspan="{{ count($info['goods_list']) }}" sumrows="{{ count($info['goods_list']) }}">
                                    <div class="ng-binding">
                                        <span>快递：</span>
                                        <span>
                                    <input id="shipping_fee" name="shipping_fee" class="form-control w80" type="text" value="{{ $info['shipping_fee'] ?? '0.00' }}" data-rule-min="0" />
                                </span>
                                        <span>
                                    <a href="javascript:shipping_free();" class="c-blue">免运费</a>
                                </span>
                                    </div>
                                </td>
                                <td class="postage" rowspan="{{ count($info['goods_list']) }}" sumrows="{{ count($info['goods_list']) }}">
                                    <div class="ng-binding">
                                        <span>额外配送费：</span>
                                        <span>
                                    <input id="other_shipping_fee" name="other_shipping_fee" class="form-control w80" type="text" value="{{ $info['other_shipping_fee'] ?? '0.00' }}" data-rule-min="0" />
                                </span>
                                        <span>
                                    <a href="javascript:other_shipping_fee();" class="c-blue">免额外配送费</a>
                                </span>
                                    </div>
                                </td>
                                <td class="postage" rowspan="{{ count($info['goods_list']) }}" sumrows="{{ count($info['goods_list']) }}">
                                    <div class="ng-binding">
                                        <span>包装费：</span>
                                        <span>
                                    <input id="packing_fee" name="packing_fee" class="form-control w80" type="text" value="{{ $info['packing_fee'] ?? '0.00' }}" data-rule-min="0" />
                                </span>
                                        <span>
                                    <a href="javascript:packing_fee();" class="c-blue">免包装费</a>
                                </span>
                                    </div>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <p class="m-b-5">收货地址：{{ $info['region_name'] }} {{ $info['address'] }} </p>
            <p class="m-b-5">
                买家实付：
                ￥{{ $info['goods_amount'] }}（商品价格）
                + ￥{{ $info['shipping_fee'] }}（运费）
                - ￥{{ $info['store_card_price'] }}（店铺购物卡）
                - ￥{{ $info['surplus'] }}（余额已付）=
                <strong class="order-amount">
                    <span class="SZY-MONEY-PAID">￥{{ $info['money_paid'] }}</span>
                </strong>
            </p>
        </div>
        <div class="modal-footer">
            <input name="order_id" type="hidden" value="{{ $info['order_id'] }}" />
            <button id="btn_submit" type="submit" class="btn btn-primary">确定</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
    </form>
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
<!-- 表单验证 -->
<!-- 折扣输入验证 -->
<script type="text/javascript">
    // 
</script><script src="/assets/d2eace91/min/js/validate.min.js"></script>
<script>

    function shipping_free() {
        $("#{{ $uuid }}").find("#shipping_fee").val('0');
    }

    // 



    function other_shipping_fee() {
        $("#{{ $uuid }}").find("#other_shipping_fee").val('0');
    }

    // 



    function packing_fee() {
        $("#{{ $uuid }}").find("#packing_fee").val('0');
    }

    // 



    $().ready(function() {

        $("#{{ $uuid }}").find("#delivery_enable").on("change", function() {
            if (!$(this).is(':checked')) {
                $("#{{ $uuid }}").find('#cs_delivery_fee').attr("disabled", true);
                $("#{{ $uuid }}").find('#cs_delivery_fee').val('0.00');
            } else {

                $("#{{ $uuid }}").find('#cs_delivery_fee').attr("disabled", false);
            }
        });
        /**
         * 初始化validator默认值
         */
        /* $.validator.setDefaults({
        errorPlacement: function(error, element) {
        var error_id = $(error).attr("id");
        var error_msg = $(error).text();
        var element_id = $(error).attr("for");
        
        if ($.trim(error_msg) == 0) {
        return;
        }
        
        $.msg(error_msg);
        },
        // 失去焦点验证
        onfocusout: function(element) {
        $(element).valid();
        },
        // 成功后移除错误提示
        success: function(error) {
        }
        }); */

// 验证
        var validator = $("#eidt_order_form").validate();

        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }

            var data = $("#{{ $uuid }}").find("#eidt_order_form").serializeJson();

            $.loading.start();

            $.post('/trade/order/edit.html', data, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".modal").find(".close").click();
// 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
                        if (typeof (tablelist) != "undefined" && tablelist) {
                            tablelist.load();
                        } else if ('list' == 'list') {
                            $.go("/trade/order/list.html");
                        } else if ('list' == 'freebuy_list') {
                            $.go("/dashboard/free-buy/list.html");
                        } else {
                            $.go("/trade/order/info.html?id={{ $order_id }}");
                        }
                    });
                } else if (result.code == 55) {
// 刷新页面
                    $.msg(result.message, {
                        time: 5000
                    }, function() {
                        $.go("/trade/order/list.html");
                    });
                } else {
                    $.msg(result.message);
                    return false;
                }
            }, 'json').always(function() {
                $.loading.stop();
            });
        });

        var price_format = "￥#0#";

        /* $(".other-price").keyup(function() {
        var other_amount = 0;
        
        $(".other-price").each(function() {
        if ($(this).valid()) {
        other_amount += parseFloat($(this).val());
        }
        });
        
        if (isNaN(other_amount)) {
        other_amount = 0;
        }
        
        if (other_amount > 0) {
        $(".SZY-OTHER-PRICE").html("+ " + price_format.replace(/#0#/g, Math.abs(other_amount)));
        } else {
        $(".SZY-OTHER-PRICE").html("- " + price_format.replace(/#0#/g, Math.abs(other_amount)));
        }
        
        var money_paid = parseFloat("100") + other_amount;
        money_paid = price_format.replace(/#0#/g, (Math.abs(money_paid)).toFixed(2));
        $(".SZY-MONEY-PAID").html(money_paid);
        }); */

        /* $("body").on("mouseover", ".other-price-desc", function() {
        $.tips("正数代表涨价，负数代表降价", $(this));
        });
        
        $("body").on("mouseout", ".other-price-desc", function() {
        $.closeAll("tips");
        }); */
    });

    // 
</script>