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

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/finance/bill/store-bill.html" method="GET">        <input type="hidden" name="order_status" id="order_status" value="">
            <input type="hidden" name="bill_status" id="bill_status" value="">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>网点名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="keywords" name="keywords" class="form-control" type="text" placeholder="网点名称">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <label class="control-label"></label>
                <div class="form-control-wrap">
                    <button class="btn btn-primary m-r-5">搜索</button>
                    <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />
                </div>
            </div>
        </form>    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>网点对账列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>

    <!--列表内容-->
    <div class="table-responsive">
        <input type="hidden" name="type" id="type" value="0">

        {{--引入列表--}}
        @include('finance.bill.partials._store_bill')

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
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>

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
            $("#searchForm").submit(function() {
                var params = $("#searchForm").serializeJson();
                tablelist.load(params);
                return false;
            });
            $("#btn_export").click(function() {
                var url = "/finance/bill/export-store.html";
                url += "?type=" + $("#type").val();
                url += "&keywords=" + $("#keywords").val();
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
        });
        //弹出模态框
        $("body").on("click", ".statement", function() {
            var store_id = $(this).data("store_id");
            var group_time = $(this).data("group_time");
            var type = $(this).data("type");
            if ($.modal($(this))) {
                $.modal($(this)).show();
            } else {
                $.modal({
                    // 标题
                    title: '结算',
                    width: 450,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/finance/bill/deposite',
                        data: {
                            store_id: store_id,
                            group_time: group_time,
                            type: type
                        }
                    },
                });
            }
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
        //订单时间
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop