{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

     <!--统计-->
    <div class="balance-bill">
        <dl>
            <dt>累积销售总额</dt>
            <dd>
                <span class="money">{{ $calc_result['total_order_amount'] }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>待结算金额</dt>
            <dd>
                <span class="money">{{ $calc_result['total_wait_amount'] }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>已结算金额</dt>
            <dd>
                <span class="money">{{ $calc_result['total_finished_amount'] }}</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>店铺商家</dt>
            <dd>
                <span class="money">{{ $calc_result['shop_count'] }}</span>
                <span class="unit">家</span>
            </dd>
        </dl>
    </div>
    <!-- 温馨提示 -->
    <div class="explanation m-b-10">
        <div class="title">
            <i class="arrow-icon explain-checkZoom cur-p" title=""></i>
            <i class="fa fa-bullhorn"></i>
            <h4>温馨提示</h4>
        </div>
        <ul class="explain-panel">
            <li>
                <span>每个商家都有自己的结算周期，每个结算周期都会生成一个结算账单，周期内所有订单出账后，金额会自动打款到店铺的会员账户余额中，店铺可二次消费或者提现</span>
            </li>
            <li>
                <span>账单计算公式：平台应结金额=商品总金额-店铺红包-店铺优惠+运费-店铺储值卡支付金额-平台佣金-站点佣金 ；<span class="c-red">（如发现金额计算不准，是因为存在货到付款情况，请以本期应结金额为准）</span></span>
            </li>
            <li>
                <span>账单处理流程：系统自动出账 &gt; 系统自动打款到商家的会员账户余额中，共2个环节</span>
            </li>
            <li>
                <span>账单出账时间：当周期内的所有订单都已经确认收货，并不再发生退款退货时，即可出账，例如：订单在1号确认收货，商城设置“申请售后期限”为7天，那么此笔订单会在8号出账</span>
            </li>
            <li>
                <span>平台承担货款：是指由平台方发起的活动所产生的金额，此金额是由平台承担，例如：平台方红包</span>
            </li>
            <li>
                <span>累计销售总额：统计所有店铺已经确认收货的在线支付订单总金额+货到付款订单平台佣金。待结算金额：统计所有未给店铺结算的账单金额。已结算金额：统计所有已经给店铺结算的账单金额。</span>
            </li>

        </ul>
    </div>

    <!--搜索-->
    <div class="search-term m-b-10 pos-r">
        <form id="searchForm" action="/finance/bill/system-shop-bill.html" method="GET">
            <input type="hidden" name="order_status" id="order_status" value="">
            <input type="hidden" name="bill_status" id="bill_status" value="">

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="keywords" name="keywords" class="form-control" type="text" placeholder="店铺名称">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺类型：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="is_supply" name="is_supply" class="form-control">
                            <option value="0">全部</option>
                            <option value="1">零售商</option>
                            <option value="2">供货商</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <label class="control-label"></label>
                <div class="form-control-wrap">
                    <button class="btn btn-primary m-r-5">搜索</button>

                    <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出">

                </div>

            </div>

        </form>
    </div>

    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>店铺结算列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>

    <!--列表内容-->
    <div class="table-responsive">

        <input type="hidden" name="type" id="type" value="0">

        @include('finance.bill.partials._system_shop_bill')

    </div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
<script type="text/javascript">
    var tablelist;

    $('.form_datetime').datetimepicker({
        language: 'zh-CN',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,// 开始视图
        minView: 2, // 最小视图
        forceParse: 0,
        showMeridian: 1,
        format: 'yyyy-mm-dd H:i:s',
    });

    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson()
        });
        $("#searchForm").submit(function() {
            var params = $("#searchForm").serializeJson();
            tablelist.load(params);
            return false;
        });

        $("#btn_export").click(function() {
            var url = "/finance/bill/export.html";
            url += "?type=" + $("#type").val();
            url += "&keywords=" + $("#keywords").val();
            url += "&is_supply=" + $("#is_supply").val();

            if (tablelist.sortname != null && tablelist.sortorder != null) {
                url += "&sortname=" + tablelist.sortname;
                url += "&sortorder=" + tablelist.sortorder;
            }
            $.go(url, null, false);
        });

        // 删除记录
        $("body").on('click', '.del', function() {
            var id = $(this).data("id");
            tablelist.remove({
                confirm: '您确定删除这条记录吗？',
                url: 'delete',
                data: {
                    id: id
                }
            });
        });
        //批量统计
        $("body").on("click", ".apply_count", function() {
            var ids = $(".bill_info").data("id");

            if (!ids) {
                ids = tablelist.checkedValues();
                //ids = ids.join(",");
            }
            if (!ids) {
                $.msg("请选择要统计结算的订单");
                return;
            }

            var order_count = 0;
            var sum_goods_amount = 0;
            var sum_manager_money = 0;
            var sum_site_money = 0;
            var sum_shop_money = 0;
            var sum_activity_money = 0;
            var sum_shipping_fee = 0;

            $(".bill_info").each(function() {
                if ($(this).hasClass('active')) {
                    order_count += $(this).data("order_count");
                    sum_goods_amount += parseFloat($(this).data("order_amount"));
                    sum_manager_money += parseFloat($(this).data("system_money"));
                    sum_site_money += parseFloat($(this).data("site_money"));
                    sum_shop_money += parseFloat($(this).data("shop_money"));
                    sum_activity_money += parseFloat($(this).data("activity_money"));
                    sum_shipping_fee += parseFloat($(this).data("shipping_fee"));
                }
            });

            $("#count_order_id").html(order_count);
            $("#sum_goods_amount").html(sum_goods_amount.toFixed(2));
            $("#sum_manager_money").html(sum_manager_money.toFixed(2));
            $("#sum_site_money").html(sum_site_money.toFixed(2));
            $("#sum_shop_money").html(sum_shop_money.toFixed(2));
            $("#sum_activity_money").html(sum_activity_money.toFixed(2));
            $("#sum_shipping_fee").html(sum_shipping_fee.toFixed(2));
        })
    });

    //弹出模态框
    $("body").on("click", ".statement", function() {
        var id = $(this).data("id");
        // var shop_id = $(this).data("shop_id");
        // var group_time = $(this).data("group_time");
        // var type = $(this).data("type");
        if ($.modal($(this))) {
            $.modal($(this)).show();
        } else {
            $.modal({
                // 标题
                title: '结算',
                width: 550,
                trigger: $(this),
                // ajax加载的设置
                ajax: {
                    url: '/finance/bill/deposite',
                    data: {
                        // shop_id: shop_id,
                        // group_time: group_time,
                        // type: type
                    }
                },
            });
        }

    });

    $('.toggle-btn').each(function() {
        $(this).find('td:not(.tcheck,.handle)').click(function() {
            $(this).parents().addClass("active").siblings('.toggle-btn').removeClass('active');
            $(".toggle-panel").not($(this).parents().next(".toggle-panel")).hide();
            $(this).parents().next(".toggle-panel").slideToggle(300);
        })
    });
</script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop