{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/statistics/sales-statistics/index" method="GET">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt" name="from">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt" name="to">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <a class="inline-item date" href="javascript:void(0);">今天</a>
                <em class="ft-bar">|</em>
                <span class="inline-text">最近：</span>
                <a class="inline-item date" href="javascript:void(0);">1个月</a>
                <a class="inline-item date" href="javascript:void(0);">3个月</a>
                <a class="inline-item date" href="javascript:void(0);">1年</a>
            </div>
            <div class="simple-form-field">
                <label class="control-label"></label>
                <div class="form-control-wrap">
                    <button class="btn btn-primary m-r-5">搜索</button>
                </div>
            </div>
        </form>    </div>
    <div class="table-content m-t-30 clearfix">
        <h5 class="m-b-10 m-t-0">营业总览</h5>
        <div class="balance-bill column3">
            <dl class="p-l-0 p-r-0">
                <dd class="text-l">
                    <span class="f14 m-r-5 m-l-20">
                        营业额
                        <i class="fa fa-question-circle f16 c-ddd  m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="营业额：选择的时间内的有效订单总金额。"></i>
                    </span>
                </dd>
                <dd class="m-b-5">
                    <span class="money" id="sales_amount">&nbsp;</span>
                </dd>
                <dd class="m-auto m-t-10">
                    <p class="text-c">
                        <span class="l-h-18">线上：在线支付：</span>
                        <span class="m-r-10 l-h-18">
                            实付：
                            <span id="online_payment">&nbsp;</span>
                            元
                        </span>
                        <span class="l-h-18">
                            货到付款：
                            <span id="cash_on_delivery">&nbsp;</span>
                            元
                        </span>
                    </p>
                    <p class="text-c">
                        <span class="l-h-18 m-r-15 ">
                            线下：
                            <span id="offline_payment">&nbsp;</span>
                            元
                        </span>
                        <span class="l-h-18">
                            神码收银：
                            <span id="cashier_payment">&nbsp;</span>
                            元
                        </span>
                    </p>
                </dd>
            </dl>
            <dl class="p-l-0 p-r-0">
                <dd class="text-l">
                    <span class="f14 m-r-5 m-l-20">
                        支出
                        <i class="fa fa-question-circle f16 c-ddd  m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="支出：选择的时间内的所有支出金额总价；</br>提示：店铺优惠=卖家人为调整优惠的金额+卖家活动优惠金额<br>计算公式：店铺红包+店铺优惠+平台佣金+购买短信。"></i>
                    </span>
                </dd>
                <dd class="m-b-5">
                    <span class="money" id="payment">&nbsp;</span>
                </dd>
                <dd class="m-t-10">
                    <p class="text-c">
                        <span class="m-r-15 l-h-18">
                            店铺红包：
                            <span id="shop_bonus">&nbsp;</span>
                            元
                        </span>
                        <span class="l-h-18">
                            店铺优惠：
                            <span id="shop_discount">&nbsp;</span>
                            元
                        </span>
                    </p>
                    <p class="text-c">
                        <span class="m-r-15 l-h-18">
                            平台佣金：
                            <span id="commission">&nbsp;</span>
                            元
                        </span>
                        <span class="l-h-18">
                            神码收银佣金：
                            <span id="cashier_commission">&nbsp;</span>
                            元
                        </span>
                    </p>
                    <p class="text-c">
                        <span class="l-h-18">
                            购买短信：
                            <span id="buy_sms">&nbsp;</span>
                            元
                        </span>
                    </p>
                </dd>
            </dl>
            <dl class="p-l-0 p-r-0" style="height: 170px;">
                <dd class="text-l">
                    <span class="f14 m-r-5 m-l-20">
                        预计净收入
                        <i class="fa fa-question-circle f16 c-ddd  m-l-10" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-html="true" data-content="线上预计净收入：选择的时间内店铺净收入金额；</br>计算公式：营业额-支出</br>线下预计净收入：选择的时间内店铺线上收银台收入金额"></i>
                    </span>
                </dd>
                <dd class="m-b-5">
                    <span class="money" id="income">&nbsp;</span>
                </dd>
                <dd class="m-t-10">
                    <p class="text-c">
                        <span class="m-r-15 l-h-18">
                            线上预计净收入：
                            <span id="online_income">&nbsp;</span>
                            元
                        </span>
                    </p>
                    <p class="text-c">
                        <span class="m-r-15 l-h-18">
                            线下预计净收入：
                            <span id="offline_income">&nbsp;</span>
                            元
                        </span>
                    </p>
                </dd>
            </dl>
        </div>
        <h5 class="m-b-10">订单数据</h5>
        <div class="balance-bill column3">
            <dl class="p-l-0 p-r-0">
                <dd class="text-l">
                    <span class="f14 m-r-5 m-l-20">
                        有效订单数
                        <i class="fa fa-question-circle f16 c-ddd  m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content=" 有效订单数：选择的时间内交易成功、已付款未发生退款或退款未完成、货到付款并且交易成功的订单数、线下订单未退款数，包含普通在线支付订单、自由购订单、堂内点餐订单、线下订单、货到付款订单，预售订单在尾款支付后才统计"></i>
                    </span>
                </dd>
                <dd class="m-b-5">
                    <span class="money" id="payment_count">&nbsp;</span>
                </dd>
                <dd class="m-auto m-t-10">
                    <p class="text-c">
                        <span class="m-r-15 l-h-18">
                            线上：在线支付：
                            <span id="online_payment_count">&nbsp;</span>
                            单
                        </span>
                        <span class="l-h-18">
                            货到付款：
                            <span id="cash_on_delivery_count">&nbsp;</span>
                            单
                        </span>
                    </p>
                    <p class="text-c">
                        <span class="l-h-18">
                            线下：
                            <span id="offline_payment_count">&nbsp;</span>
                            单
                        </span>
                    </p>
                </dd>
            </dl>
            <dl class="p-l-0 p-r-0">
                <dd class="text-l">
                    <span class="f14 m-r-5 m-l-20">
                        无效订单数
                        <i class="fa fa-question-circle f16 c-ddd  m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="无效订单数：选择的时间内交易关闭的订单数"></i>
                    </span>
                </dd>
                <dd class="m-b-5">
                    <span class="money" id="cancel_count">&nbsp;</span>
                </dd>
                <dd class="m-t-10">
                    <p class="text-c">
                        <span class="m-r-15 l-h-18">
                            线上：消费者取消
                            <span id="user_cancel_count">&nbsp;</span>
                            单
                        </span>
                        <span class="l-h-18">
                            商家取消
                            <span id="seller_cancel_count">&nbsp;</span>
                            单
                        </span>
                    </p>
                    <p class="text-c">
                        <span class="m-r-15 l-h-18">
                            系统自动取消
                            <span id="system_cancel_count">&nbsp;</span>
                            单
                        </span>
                        <span class="l-h-18">
                            线下：退款
                            <span id="user_offline_cancel_count">&nbsp;</span>
                            单
                        </span>
                    </p>
                </dd>
            </dl>
            <dl class="p-l-0 p-r-0">
                <dd class="text-l">
                    <span class="f14 m-r-5 m-l-20">
                        预计损失
                        <i class="fa fa-question-circle f16 c-ddd  m-l-10" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-html="true" data-content="线上预计损失：选择的时间内无效订单给商家带来的损失；</br>计算公式：无效订单金额累计；</br>线下预计损失：选择的时间内线下退款订单给商家带来的损失；</br>计算公式：线下退款金额累计。"></i>
                    </span>
                </dd>
                <dd class="m-b-5">
                    <span class="money" id="losses">&nbsp;</span>
                </dd>
                <dd class="m-t-10">
                    <p class="text-c">
                        <span class="l-h-18">
                            线上预计损失：
                            <span id="online_losses">&nbsp;</span>
                            元
                        </span>
                    </p>
                    <p class="text-c">
                        <span class="l-h-18">
                            线下预计损失：
                            <span id="offline_losses">&nbsp;</span>
                            元
                        </span>
                    </p>
                </dd>
            </dl>
        </div>
        <h5 class="m-b-10">有效订单数据明细</h5>
        <div class="balance-bill column4">
            <dl class="bottom-line">
                <dt>在线支付普通订单</dt>
                <dd>
                    <span class="money" id="online_normal_count">&nbsp;</span>
                    <span class="unit">单</span>
                </dd>
            </dl>
            <dl class="bottom-line">
                <dt>线上货到付款普通订单</dt>
                <dd>
                    <span class="money" id="online_cod_count">&nbsp;</span>
                    <span class="unit">单</span>
                </dd>
            </dl>
            <dl class="bottom-line">
                <dt>自由购订单</dt>
                <dd>
                    <span class="money" id="online_freebuy_count">&nbsp;</span>
                    <span class="unit">单</span>
                </dd>
            </dl>
            <dl class="bottom-line">
                <dt>堂内点餐订单</dt>
                <dd>
                    <span class="money" id="online_reachbuy_count">&nbsp;</span>
                    <span class="unit">单</span>
                </dd>
            </dl>
            <dl>
                <dt>线下收银订单</dt>
                <dd>
                    <span class="money" id="offline_cash_count">&nbsp;</span>
                    <span class="unit">单</span>
                </dd>
            </dl>
            <dl>
                <dt>神码收银订单</dt>
                <dd>
                    <span class="money" id="online_cashier_count">&nbsp;</span>
                    <span class="unit">单</span>
                </dd>
            </dl>
            <dl>
                <dt>提货券订单</dt>
                <dd>
                    <span class="money" id="gift_card_count">&nbsp;</span>
                    <span class="unit">单</span>
                </dd>
            </dl>
        </div>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html page元素同级下面--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                $.loading.start();
                init();
                $.loading.stop();
                // 阻止表单提交
                return false;
            });
            function init() {
                var url = '/statistics/sales-statistics/get-data';
                url += "?from=" + $("#from").val();
                url += "&to=" + $("#to").val();
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $("#sales_amount").html(data.sales_amount);
                        $("#online_payment").html(data.online_payment);
                        $("#cash_on_delivery").html(data.cash_on_delivery);
                        $("#offline_payment").html(data.offline_payment);
                        $("#payment").html(data.payment);
                        $("#shop_bonus").html(data.shop_bonus);
                        $("#shop_discount").html(data.shop_discount);
                        $("#commission").html(data.commission);
                        $("#buy_sms").html(data.buy_sms);
                        $("#income").html(data.income);
                        $("#online_income").html(data.online_income);
                        $("#offline_income").html(data.offline_income);
                        $("#payment_count").html(data.payment_count);
                        $("#online_payment_count").html(data.online_payment_count);
                        $("#cash_on_delivery_count").html(data.cash_on_delivery_count);
                        $("#offline_payment_count").html(data.offline_payment_count);
                        $("#cancel_count").html(data.cancel_count);
                        $("#user_cancel_count").html(data.user_cancel_count);
                        $("#seller_cancel_count").html(data.seller_cancel_count);
                        $("#system_cancel_count").html(data.system_cancel_count);
                        $("#user_offline_cancel_count").html(data.user_offline_cancel_count);
                        $("#losses").html(data.losses);
                        $("#online_losses").html(data.online_losses);
                        $("#offline_losses").html(data.offline_losses);
                        $("#online_normal_count").html(data.online_normal_count);
                        $("#online_cod_count").html(data.cash_on_delivery_count);
                        $("#online_freebuy_count").html(data.online_freebuy_count);
                        $("#online_reachbuy_count").html(data.online_reachbuy_count);
                        $("#offline_cash_count").html(data.offline_payment_count);
                        $("#online_cashier_count").html(data.online_cashier_count);
                        $("#cashier_payment").html(data.cashier_payment);
                        $("#cashier_commission").html(data.cashier_commission);
                        $("#gift_card_count").html(data.gift_card_count);
                    }
                });
            }
            init();
        });
        //
        $(function(){
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd'
            });
            $('#from').datetimepicker().on('changeDate', function(ev) {
                $('#to').datetimepicker('setStartDate', ev.date);
            });
            $('#to').datetimepicker().on('changeDate', function(ev) {
                $('#from').datetimepicker('setEndDate', ev.date);
            });
            $(".date").click(function() {
                $(".date").removeClass("active");
                $(this).addClass("active");
                if ($(this).text() == "今天") {
                    var myDate = new Date();
                    $('#from').val(myDate.Format("yyyy-MM-dd"));
                    $('#to').val('');
                } else if ($(this).text() == "1个月") {
                    var myDate = new Date();
                    myDate.setMonth(myDate.getMonth() - 1);
                    $('#from').val(myDate.Format("yyyy-MM-dd"));
                    $('#to').val('');
                } else if ($(this).text() == "3个月") {
                    var myDate = new Date();
                    myDate.setMonth(myDate.getMonth() - 3);
                    $('#from').val(myDate.Format("yyyy-MM-dd"));
                    $('#to').val('');
                } else if ($(this).text() == "1年") {
                    var myDate = new Date();
                    myDate.setYear(myDate.getFullYear() - 1);
                    $('#from').val(myDate.Format("yyyy-MM-dd"));
                    $('#to').val('');
                }
            });
            $("[data-toggle='popover']").popover();
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop