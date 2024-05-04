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
        <form id="searchForm" action="/statistics/trade-analyse/area" method="GET">
            <div class="simple-form-field ">
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
            </div>
        </form>
    </div>
    <div class="table-content m-t-30 clearfix">
        <h5 class="m-b-10 m-t-0">地区下单会员数统计</h5>
        <div class="module-content m-t-10">
            <div id="canvas-user" style="width: 100%; height: 300px;"></div>
        </div>
        <h5 class="m-b-10 m-t-0">地区下单金额统计</h5>
        <div class="module-content m-t-10">
            <div id="canvas-amount" style="width: 100%; height: 300px;"></div>
        </div>
        <h5 class="m-b-10 m-t-0">地区下单量统计</h5>
        <div class="module-content m-t-10">
            <div id="canvas-count" style="width: 100%; height: 300px;"></div>
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
    <script src="/assets/d2eace91/js/echarts/echarts-all.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
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
            var myDate = new Date();
            $('#from').val(myDate.Format("yyyy-MM-dd"));
        });
        // 
        $().ready(function() {
            // 地区下单会员数统计
            function init_user() {
                var add_time_begin = $("#from").val();
                var add_time_end = $("#to").val();
                var order_status = $("#order_status").val();
                var myChart = echarts.init(document.getElementById('canvas-user'));
                myChart.showLoading();
                $.ajax({
                    type: "get",
                    async: true,
                    url: "/statistics/trade-analyse/get-area-data?type=user&add_time_begin=" + add_time_begin + "&add_time_end=" + add_time_end + "&order_status=" + order_status,
                    data: {},
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    //    text: '',
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },
                                legend: {
                                    data: []
                                },
                                toolbox: {
                                    show: true,
                                    feature: {
                                        magicType: {
                                            show: false,
                                            type: ['bar']
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
                                    data: result.x
                                }],
                                yAxis: [{
                                    type: 'value'
                                }],
                                series: [{
                                    name: '下单会员数',
                                    type: 'bar',
                                    data: result.y,
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
            // 地区下单金额统计
            function init_amount() {
                var add_time_begin = $("#from").val();
                var add_time_end = $("#to").val();
                var order_status = $("#order_status").val();
                var myChart = echarts.init(document.getElementById('canvas-amount'));
                myChart.showLoading();
                $.ajax({
                    type: "get",
                    async: true,
                    url: "/statistics/trade-analyse/get-area-data?type=amount&add_time_begin=" + add_time_begin + "&add_time_end=" + add_time_end + "&order_status=" + order_status,
                    data: {},
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    //    text: '',
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },
                                legend: {
                                    data: []
                                },
                                toolbox: {
                                    show: true,
                                    feature: {
                                        magicType: {
                                            show: false,
                                            type: ['bar']
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
                                    data: result.x
                                }],
                                yAxis: [{
                                    type: 'value'
                                }],
                                series: [{
                                    name: '下单金额',
                                    type: 'bar',
                                    data: result.y,
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
            // 地区下单金额统计
            function init_count() {
                var add_time_begin = $("#from").val();
                var add_time_end = $("#to").val();
                var order_status = $("#order_status").val();
                var myChart = echarts.init(document.getElementById('canvas-count'));
                myChart.showLoading();
                $.ajax({
                    type: "get",
                    async: true,
                    url: "/statistics/trade-analyse/get-area-data?type=count&add_time_begin=" + add_time_begin + "&add_time_end=" + add_time_end + "&order_status=" + order_status,
                    data: {},
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    //    text: '',
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },
                                legend: {
                                    data: []
                                },
                                toolbox: {
                                    show: true,
                                    feature: {
                                        magicType: {
                                            show: false,
                                            type: ['bar']
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
                                    data: result.x
                                }],
                                yAxis: [{
                                    type: 'value'
                                }],
                                series: [{
                                    name: '下单量',
                                    type: 'bar',
                                    data: result.y,
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
            init_user();
            init_amount();
            init_count();
            $("#searchForm").submit(function() {
                $.loading.start();
                init_user();
                init_amount();
                init_count();
                return false;
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop