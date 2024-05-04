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
        <form id="searchForm" action="/trade/delivery/list.html" method="GET">        <div class="simple-form-field">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <select id="keywords_type" name="keywords_type" class="form-control w100 m-r-5">
                            <option value="">请选择</option>
                            <option value="1">买家账号/买家姓名</option>
                            <option value="2">订单编号</option>
                            <option value="3">发货单编号</option>
                        </select>
                        <input type="text" id="keywords" class="form-control" name="keywords" placeholder="请输入关键字">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>发货单状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="delivery_status" class="form-control" name="delivery_status">
                            <option value="">全部</option>
                            <option value="unshipped">待发货</option>
                            <option value="shipped">已发货</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>配送方式：</span>
                    </label>
                    <div class="form-control-wrap"><select id="shipping_type" class="form-control" name="shipping_type">
                            <option value="">全部</option>
                            <option value="0">无需物流</option>
                            <option value="1-2">嗖嗖物流</option>
                            <option value="3">第三方快递</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>下单时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="add_time_begin" class="form-control form_datetime ipt" name="add_time_begin" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="add_time_end" class="form-control form_datetime ipt" name="add_time_end" placeholder="结束时间">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>发货时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="send_time_begin" class="form-control form_datetime ipt" name="send_time_begin" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="send_time_end" class="form-control form_datetime ipt" name="send_time_end" placeholder="结束时间">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />
                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>    </div>

    {{--引入列表--}}
    @include('trade.delivery.partials._list')


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
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        $().ready(function() {
            $("li[class^='tabs-']").click(function() {
                $("li[class^='tabs-']").removeClass('current');
                $(this).addClass('current');
                $("#delivery_status").val($(this).attr("id"));
                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load();
            });
            var url = '/trade/delivery/get-delivery-counts';
            var data = $("#searchForm").serializeJson();
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'POST',
                data: data,
                success: function(data) {
                    $("#delivery-all").html(data.all);
                    $("#delivery-unshipped").html(data.unshipped);
                    $("#delivery-shipped").html(data.shipped);
                }
            });
        });
        //
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
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // console.info(data);
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $("#btn_export").click(function() {
                var url = "/trade/delivery/export.html";
                url += "?keywords_type=" + $("#keywords_type").val();
                url += "&keywords=" + $("#keywords").val();
                url += "&delivery_status=" + $("#delivery_status").val();
                url += "&shipping_type=" + $("#shipping_type").val();
                url += "&add_time_begin=" + $("#add_time_begin").val();
                url += "&add_time_end=" + $("#add_time_end").val();
                url += "&send_time_begin=" + $("#send_time_begin").val();
                url += "&send_time_end=" + $("#send_time_end").val();
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, null, false);
            });
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                if (type == 'delivery') {
                    title = "修改运单";
                    width = 480;
                }
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        // 标题
                        title: title,
                        width: width,
                        trigger: $(this),
                        // ajax加载的设置
                        ajax: {
                            url: '/trade/delivery/edit-order?from=list',
                            data: {
                                type: type,
                                id: id
                            }
                        },
                    });
                }
            });
        });
        $("body").on("click", ".print-sheet", function() {
            var delivery_id = $(this).data("id");
            var shipping_code = $(this).data("code");
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/trade/delivery/check-print.html',
                data: {
                    delivery_id: delivery_id,
                    shipping_code: shipping_code
                },
                dataType: 'json',
                success: function(result) {
                    if (result.code == 0) {
                        $.go('/trade/delivery/print-sheet.html?did=' + delivery_id + '&code=' + shipping_code, '_blank');
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            }).always(function() {
                $.loading.stop();
            });
        });
        function batch_print() {
            var delivery_ids = document.getElementsByName("delivery_id_box");
            var delivery_id = "";
            for (var i = 0; i < delivery_ids.length; i++) {
                if (delivery_ids[i].checked == true) {
                    delivery_id += delivery_ids[i].value + ",";
                }
            }
            delivery_id = delivery_id.slice(0, -1);
            if (delivery_id.length <= 0) {
                $.msg("请勾选待打印发货单！");
                return false;
            }
            $.go('/trade/order/print.html?did=' + delivery_id, '_blank');
        }
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
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop