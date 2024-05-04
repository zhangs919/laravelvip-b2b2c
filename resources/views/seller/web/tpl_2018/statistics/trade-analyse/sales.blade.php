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
        <form id="searchForm" action="/statistics/trade-analyse/sales.html" method="GET">
            <input type="hidden" name="add_time_begin" value="2019-02-02">
            <input type="hidden" name="add_time_end" value="">
            <input type="hidden" name="order_status" value="">
            <input type="hidden" name="page[page_id]" value="#pagination">
            <input type="hidden" name="page[cur_page]" value="1">
            <input type="hidden" name="page[page_size]" value="10">
            <input type="hidden" name="showloading" value="true">                <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt" name="add_time_begin" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt" name="add_time_end" placeholder="结束时间">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <a class="inline-item date active" href="javascript:void(0);">今天</a>
                <em class="ft-bar">|</em>
                <span class="inline-text">最近：</span>
                <a class="inline-item date" href="javascript:void(0);">1个月</a>
                <a class="inline-item date" href="javascript:void(0);">3个月</a>
                <a class="inline-item date" href="javascript:void(0);">1年</a>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="order_status" class="form-control" name="order_status">
                            <option value="">全部</option>
                            <option value="unpayed">等待买家付款</option>
                            <option value="unshipped">待发货未指派</option>
                            <option value="assign">待发货已指派</option>
                            <option value="shipped">卖家已发货</option>
                            <option value="finished">交易成功</option>
                            <option value="closed">交易关闭</option>
                            <option value="backing">退款中的订单</option>
                            <option value="cancel">取消订单申请</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />
            </div>
        </form>        </div>
    <div class="table-content clearfix">
        <div class="balance-bill column3">
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="sum-amount">&nbsp;</span>
                </dd>
                <dd>
                    <span>总下单金额<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="统计所有线上、线下订单总金额，包括各种状态的订单，订单包括：普通订单、自由购订单、堂内点餐订单、提货券订单、线下订单"></i></span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="sum-count">&nbsp;</span>
                </dd>
                <dd>
                    <span>总下单量<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="统计所有线上、线下订单数量，包括各种状态的订单，订单包括：普通订单、自由购订单、堂内点餐订单、提货券订单、线下订单"></i></span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="sum-back">&nbsp;</span>
                </dd>
                <dd>
                    <span>退款金额<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="统计所有线上、线下退款订单金额，包括各种状态的订单，订单包括：普通订单、自由购订单、堂内点餐订单、线下订单"></i></span>
                </dd>
            </dl>
        </div>
        <!-- 下单金额 -->
        <h5 class="m-b-10 m-t-0" style="margin-top: 0px !important;">下单金额统计</h5>
        <div class="module-content m-t-10">
            <div id="canvas-amount" style="width: 100%; height: 300px;"></div>
        </div>
        <script type="text/javascript">
            // 
        </script>        <!-- 下单量 -->
        <h5 class="m-b-10 m-t-0">下单量统计</h5>
        <div class="module-content m-t-10">
            <div id="canvas-count" style="width: 100%; height: 300px;"></div>
        </div>
        <script type="text/javascript">
            // 
        </script>
        <h5 class="m-b-10 m-t-0">订单明细</h5>
    </div>
    <!-- 订单明细 -->
    <div class="common-title">
        <div class="ftitle">
            <h3>订单明细</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <div class="table-responsive">
        {{--引入列表--}}
        @include('statistics.trade-analyse.partials._sales')
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
    <script src="/assets/d2eace91/js/echarts/echarts-all.js"></script>

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            function init_amount() {
                var add_time_begin = $("#from").val();
                var add_time_end = $("#to").val();
                var order_status = $("#order_status").val();
                var myChart = echarts.init(document.getElementById('canvas-amount'));
                myChart.showLoading();
                $.ajax({
                    type: "get",
                    async: true,
                    url: "/statistics/trade-analyse/get-data?type=amount&add_time_begin=" + add_time_begin + "&add_time_end=" + add_time_end + "&order_status=" + order_status,
                    data: {},
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    // text: '下单金额统计',
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },
                                toolbox: {
                                    show: true,
                                    feature: {
                                        magicType: {
                                            show: false,
                                            type: ['line']
                                        },
                                        restore: {
                                            show: false
                                        },
                                        saveAsImage: {
                                            show: false
                                        }
                                    }
                                },
                                calculable: true,
                                xAxis: [{
                                    type: 'category',
                                    boundaryGap: false,
                                    data: result.x
                                }],
                                yAxis: [{
                                    type: 'value'
                                }],
                                series: [{
                                    name: '下单金额',
                                    type: 'line',
                                    stack: '总量',
                                    data: result.y,
                                    markPoint: {
                                        data: [{
                                            type: 'max',
                                            name: '最大值'
                                        }, {
                                            type: 'min',
                                            name: '最小值'
                                        }]
                                    },
                                }]
                            });
                        }
                    },
                    error: function(errorMsg) {
                        $.msg("图表请求数据失败！");
                        myChart.hideLoading();
                    }
                })
            }
            init_amount();
            $("#searchForm").submit(function() {
                init_amount();
                return false;
            });
        });
        //
        $().ready(function() {
            function init_count() {
                var add_time_begin = $("#from").val();
                var add_time_end = $("#to").val();
                var order_status = $("#order_status").val();
                var myChart = echarts.init(document.getElementById('canvas-count'));
                myChart.showLoading();
                $.ajax({
                    type: "get",
                    async: true,
                    url: "/statistics/trade-analyse/get-data?type=count&add_time_begin=" + add_time_begin + "&add_time_end=" + add_time_end + "&order_status=" + order_status,
                    data: {},
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    // text: '下单金额统计',
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },
                                toolbox: {
                                    show: true,
                                    feature: {
                                        magicType: {
                                            show: false,
                                            type: ['line']
                                        },
                                        restore: {
                                            show: false
                                        },
                                        saveAsImage: {
                                            show: false
                                        }
                                    }
                                },
                                calculable: true,
                                xAxis: [{
                                    type: 'category',
                                    boundaryGap: false,
                                    data: result.x
                                }],
                                yAxis: [{
                                    type: 'value'
                                }],
                                series: [{
                                    name: '下单量',
                                    type: 'line',
                                    stack: '总量',
                                    data: result.y,
                                    markPoint: {
                                        data: [{
                                            type: 'max',
                                            name: '最大值'
                                        }, {
                                            type: 'min',
                                            name: '最小值'
                                        }]
                                    },
                                }]
                            });
                        }
                    },
                    error: function(errorMsg) {
                        $.msg("图表请求数据失败！");
                        myChart.hideLoading();
                    }
                })
            }
            init_count();
            $("#searchForm").submit(function() {
                init_count();
                return false;
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
        var myDate = new Date();
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
            $('#from').val(myDate.Format("yyyy-MM-dd"));
        })
        //
        $().ready(function() {
            $("[data-toggle='popover']").popover();
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                getData();
                // 阻止表单提交
                return false;
            });
            function getData() {
                var url = "/statistics/trade-analyse/get-data";
                url += "?add_time_begin=" + $("#from").val();
                url += "&add_time_end=" + $("#to").val();
                url += "&order_status=" + $("#order_status").val();
                url += "&type=sum"
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $("#sum-amount").html(data.sum_amount);
                        $("#sum-count").html(data.sum_count);
                        $("#sum-back").html(data.sum_back);
                    }
                });
            }
            getData();
            $("#btn_export").click(function() {
                var url = "/statistics/trade-analyse/export.html";
                url += "?add_time_begin=" + $("#from").val();
                url += "&add_time_end=" + $("#to").val();
                url += "&order_status=" + $("#order_status").val();
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
            });
        });
        //
        (function($) {
            $(window).load(function() {
                $("[data-toggle='popover']").popover();
            });
        })(jQuery);
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop