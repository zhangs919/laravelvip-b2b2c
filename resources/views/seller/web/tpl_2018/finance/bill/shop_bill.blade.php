{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
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

    <!--搜索-->
    <div class="search-term m-b-10 pos-r">
        <form id="searchForm" action="/finance/bill/shop-bill" method="GET">
        <div class="simple-form-field">
            <div class="form-group">
                <label class="control-label">
                    <span>结算状态：</span>
                </label>
                <div class="form-control-wrap">
                    <select id="shop_status" name="chargeoff_status" class="form-control">
                        <option value="">全部</option>
                        <option value="0">未出账</option>
                        <option value="1">已出账</option>
                        <option value="2">账单结束</option>
                        <option value="3">关闭账单</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group">
                <label class="control-label">
                    <span>店铺欠款：</span>
                </label>
                <div class="form-control-wrap">
                    <select id="shop_money_lt_zero" name="shop_money_lt_zero" class="form-control">
                        <option value="">全部</option><option value="1">是</option><option value="0">否</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <label class="control-label"></label>
            <div class="form-control-wrap">
                <button class="btn btn-primary m-r-5">搜索</button>
            </div>
        </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>店铺对账列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('finance.bill.partials._shop_bill')

    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        var tablelist;
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
                var url = "/finance/bill/export-shop.html";
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, null, false);
            });
            // 删除记录
            $("body").on('click', '.statement', function() {
                var shop_id = $(this).data("shop_id");
                var group_time = $(this).data("group_time");
                var type = $(this).data("type");
                tablelist.remove({
                    confirm: '您确定要确认此笔账单吗？',
                    url: '/finance/bill/confirm-orders',
                    data: {
                        shop_id: shop_id,
                        group_time: group_time,
                        type: type
                    }
                });
            });
        });
        //批量统计
        $("body").on("click", ".apply_count", function() {
            var ids = $(this).data("id");
            if (!ids) {
                ids = tablelist.checkedValues();
                ids = ids.join(",");
            }
            if (!ids) {
                $.msg("请选择要统计结算的订单");
                return;
            }
            $.post('/finance/bill/apply-count', {
                orders: ids
            }, function(result) {
                if (result.code == 0) {
                    $("#count_order_id").html(result.data.count_order_id);
                    $("#sum_cod_order").html(result.data.sum_cod_order);
                    $("#sum_goods_amount").html(result.data.sum_goods_amount);
                    $("#sum_manager_money").html(result.data.sum_manager_money);
                    $("#sum_site_money").html(result.data.sum_site_money);
                    $("#sum_shop_money").html(result.data.sum_shop_money);
                }
            }, "json");
        })
        //查询列表
        function serachList() {
            var params = $("#searchForm").serializeJson();
            tablelist.load(params);
            return false;
        }
        //订单状态
        function orderStatus(status) {
            $("#order_status").val(status);
            $(".order_status").removeClass("active");
            $("#order_status_" + status).addClass("active");
            serachList();
        }
        //账单状态
        function billStatus(status) {
            $("#bill_status").val(status);
            $(".bill_status").removeClass("active");
            $("#bill_status_" + status).addClass("active");
            serachList();
        }
        $('.toggle-btn').each(function() {
            $(this).find('td:not(.tcheck,.handle)').click(function() {
                $(this).parents().addClass("active").siblings('.toggle-btn').removeClass('active');
                $(".toggle-panel").not($(this).parents().next(".toggle-panel")).hide();
                $(this).parents().next(".toggle-panel").slideToggle(300);
            })
        });
        $("body").on("click", ".show_panel", function() {
            $(this).parents().addClass("active").siblings('.toggle-btn').removeClass('active');
            $(".toggle-panel").not($(this).parents().next(".toggle-panel")).hide();
            $(this).parents().next(".toggle-panel").slideToggle(300);
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop