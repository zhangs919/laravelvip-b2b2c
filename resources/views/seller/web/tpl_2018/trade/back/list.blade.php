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
        <form id="searchForm" action="/trade/back/list.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单编号：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="order_sn" class="form-control" name="order_sn" placeholder="订单编号"></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>退款退货单编号：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="back_sn" class="form-control" name="back_sn" placeholder="退款退货单编号"></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>买家账号：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="user_name" class="form-control" name="user_name" placeholder="买家账号"></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>申请时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <!--时间这input 后新增form_datetime, 开始时间name="begin"，截止时间name="end"-->
                        <input type="text" id="add_time" class="form-control form_datetime ipt" name="begin" placeholder="不限">
                        <span class="ctime">至</span>
                        <input type="text" id="disabled_time" class="form-control form_datetime ipt" name="end" placeholder="不限">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>退款状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="back_status" name="back_status" class="form-control">
                            <option value="null">全部</option>
                            <option value="wait" >买家申请退款退货，等待卖家确认</option>
                            <option value="dismiss">卖家不同意协议，等待买家修改</option>
                            <option value="refund">退款申请达成，等待买家发货</option>
                            <option value="shipping">买家已退货，等待卖家确认收货</option>
                            <option value="backing">卖家已确认，等待平台退款</option>
                            <option value="shipped">卖家已收货，等待平台方退款</option>
                            <option value="close">退款关闭</option>
                            <option value="finished">退款成功</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />
                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>退款列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record">0</span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">
        {{--引入列表--}}
        @include('trade.back.partials._list')
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
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
        var tablelist = null;
        $().ready(function() {
            // 加载时加入即时查询搜索条件
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $("#btn_export").click(function() {
                var back_type = $("#back_type").val();
                var back_status = $("#back_status").val();
                var after_sale_status = $("#after_sale_status").val();
                if (typeof (back_type) == 'undefined') {
                    back_type = '';
                }
                if (typeof (back_status) == 'undefined') {
                    back_status = '';
                }
                if (typeof (after_sale_status) == 'undefined') {
                    after_sale_status = '';
                }
                var url = "/trade/back/export.html";
                url += "?order_sn=" + $("#order_sn").val();
                url += "&back_sn=" + $("#back_sn").val();
                url += "&user_name=" + $("#user_name").val();
                url += "&begin=" + $("#add_time").val();
                url += "&end=" + $("#disabled_time").val();
                url += "&back_status=" + back_status;
                url += "&after_sale_status=" + after_sale_status;
                url += "&back_type=" + back_type;
                url += "&is_after_sale=0";
                url += "&type=0";
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, null, false);
            });
            // 同步线下按钮
            $('body').on('click', '.sync-erp', function() {
                var id = $(this).data('id');
                $.confirm('确认要同步线下么？', function() {
                    $.loading.start();
                    $.post('/trade/back/sync-erp', {
                        id: id
                    }, function(res) {
                        if (res.code == 0) {
                            // 同步成功，刷新列表
                            tablelist.reload();
                        } else {
                            $.alert(res.message);
                        }
                    }, 'JSON').always(function() {
                        $.loading.stop();
                    });
                })
            });
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
                minView: 2, // 精确度：默认为时分秒，2：年月日
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd',
            });
        });
    </script>
@stop
