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
        <form id="searchForm" action="/trade/complaint/list.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单编号：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="order_id" id='order_id' class="form-control" type="text" placeholder="订单编号">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>投诉编号：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="complaint_id" id="complaint_id" class="form-control" type="text" placeholder="投诉编号">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="shop_name" id="shop_name" class="form-control" type="text" placeholder="店铺名称">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>投诉原因：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="complaint_type" name="complaint_type">
                            <option value="-1">全部</option>
                            @foreach($complaint_item as $key=>$item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>投诉状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="complaint_status" name="complaint_status">
                            <option value="-1">全部</option>
                            @foreach($complaint_status_list as $key=>$item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>申请时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <!--时间这input 后新增form_datetime, 开始时间name="begin"，截止时间name="end"-->
                        <input type="text" id="begin" class="form-control form_datetime ipt pull-none" name="begin">
                        <span class="ctime">至</span>
                        <input type="text" id="end" class="form-control form_datetime ipt pull-none" name="end">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <!-- <a id="outExcel" class="btn btn-default  m-r-5">导出</a> -->
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

    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <li id='complaint_all' class="tabs-t current">
                <a>所有投诉</a>
            </li>
            <li id='complaint_wait' class="tabs-t">
                <a>等待卖家处理</a>
            </li>
            <li id='complaint_involve' class="tabs-t last">
                <a>平台方处理中</a>
            </li>
            <!--当前选中样式current，并且现只有“等待买家确认”，“等待发货”，“退款中”需要有个数提醒，其它没有；默认为近三个月订单-->
        </ul>
    </div>
    <!--列表内容-->
    <div class="table-responsive">
        {{--引入列表--}}
        @include('trade.complaint.partials._list')
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


    <script type="text/javascript">
        $().ready(function() {

            $('.btn-primary').click(function() {
                var order_id = $('#order_id').val();
                var complaint_id = $('#complaint_id').val();
                var shop_name = $('#shop_name').val();
                var complaint_type = $('#complaint_type').val();
                var complaint_status = $('#complaint_status').val();
                var begin = $('#begin').val();
                var end = $('#end').val();
                $url = '/trade/complaint/out?order_id=' + order_id + '&complaint_id=' + complaint_id + '&shop_name=' + shop_name + '&complaint_type=' + complaint_type + '&complaint_status=' + complaint_status + '&begin=' + begin + '&end=' + end;
                $('#outExcel').attr('href', $url);
            })

            $("li[class^='tabs-']").click(function() {
                $("li[class^='tabs-']").removeClass('current');
                $(this).addClass('current');

                if ($(this).attr("id") == "complaint_wait") {
                    $("#complaint_status").val(0);
                } else if ($(this).attr("id") == "complaint_involve") {
                    $("#complaint_status").val(3);
                } else {
                    $("#complaint_status").val(-1);
                }

                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load();
            });

            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                tablelist.load({
                    // 订单编号
                    'order_id': $("#order_id").val(),
                    // 投诉编号
                    'complaint_id': $("#complaint_id").val(),
                    //商家名称
                    'shop_name': $("#shop_name").val(),
                    //投诉原因
                    'complaint_type': $("#complaint_type").val(),
                    //投诉状态
                    'complaint_status': $("#complaint_status").val(),
                    //申请开始时间
                    'begin': $("#begin").val(),
                    // 申请结束时间
                    'end': $("#end").val(),
                });
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
            minView: 2, // 只选年月日
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd ',
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop