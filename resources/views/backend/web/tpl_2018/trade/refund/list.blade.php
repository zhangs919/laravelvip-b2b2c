{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180027"></script>

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/trade/refund/list.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺名称：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="shop_name" class="form-control" name="shop_name" placeholder="店铺名称"></div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单编号：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="order_sn" class="form-control" name="order_sn" placeholder="订单编号"></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">

                    <label class="control-label">
                        <span>退款退货单编号：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="back_sn" class="form-control" name="back_sn" placeholder="退款退货单编号"></div>

                </div>
            </div>
            <div class="simple-form-field toggle hide">
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
                        {{--退换货单状态 0-待处理 1-同意申请 2-货物已发出 3-货物已收到 4-处理完成 5-被驳回 6-已失效 7-已撤销--}}
                        <select id="back_status" name="back_status" class="form-control">
                            <option value="null">全部</option>
                            <option value="wait">买家申请退款退货，等待卖家确认</option>
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
        </form>
    </div>



    <div class="common-title">
        <div class="ftitle">
            <h3>{{ $title }}</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
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


        {{--引入列表--}}
        @include('trade.refund.partials._list')



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
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180027"></script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            // 加载时加入即时查询搜索条件
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });

            $("#btn_export").click(function() {
                var url = "/trade/refund/export.html";
                url += "?order_sn=" + $("#order_sn").val();
                url += "&back_sn=" + $("#back_sn").val();
                url += "&user_name=" + $("#user_name").val();
                url += "&add_time=" + $("#add_time").val();
                url += "&disabled_time=" + $("#disabled_time").val();
                url += "&shop_name=" + $("#shop_name").val();

                if (typeof ($("#site_id").val()) != "undefined") {
                    url += "&site_id=" + $("#site_id").val();
                }
                if (typeof ($("#after_sale_status").val()) != "undefined") {
                    url += "&after_sale_status=" + $("#after_sale_status").val();
                }
                if (typeof ($("#back_type").val()) != "undefined") {
                    url += "&back_type=" + $("#back_type").val();
                }

                if (typeof ($("#back_status").val()) != "undefined" && $("#back_status").val() != "null") {
                    url += "&back_status=" + $("#back_status").val();
                }

                url += "&is_after_sale=0";
                url += "&type=0";

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
            });

            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                console.info(data);
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
        });
    </script>

    <script type='text/javascript'>
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

        $('#add_time').datetimepicker().on('changeDate', function(ev) {
            $('#disabled_time').datetimepicker('setStartDate', ev.date);
        });
        $('#disabled_time').datetimepicker().on('changeDate', function(ev) {
            $('#add_time').datetimepicker('setEndDate', ev.date);
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop