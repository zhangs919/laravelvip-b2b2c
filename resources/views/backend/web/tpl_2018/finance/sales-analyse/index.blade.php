{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20180702"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=201807241613"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=201807241613"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js?v=201807241613"></script>
    {{--<script src="/js/chart.js?v=201807241613"></script>--}}
    {{--<script src="/js/chart-data.js?v=201807241613"></script>--}}
    <script src="/assets/d2eace91/js/echarts/echarts-all.js?v=201807241613"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/finance/sales-analyse/index.html" method="GET">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt pull-none" name="from">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt pull-none" name="to">
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
                <label class="control-label"></label>
                <div class="form-control-wrap">
                    <button class="btn btn-primary m-r-5">搜索</button>
                </div>
            </div>
        </form>
    </div>
    <div class="balance-bill column3 m-b-30">
        <dl>
            <dd class="m-b-5"><span id="sum_cnt" class="money">0</span></dd>
            <dd>
                <span>总销售量</span>
            </dd>
        </dl>
    </div>

    <div class="module-content m-t-10">
        <div id="canvas" style="width: 100%; height: 300px;"></div>
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
    <script type='text/javascript'>
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
    </script>

    <script type="text/javascript">
        $().ready(function() {

            function init_chart() {

                var begin_date = $("#from").val();
                var end_date = $("#to").val();

                var myChart = echarts.init(document.getElementById('canvas'));

                myChart.showLoading();

                $.ajax({
                    type: "post",
                    async: true,
                    url: '/finance/sales-analyse/get-data',
                    data: {
                        begin_date: begin_date,
                        end_date: end_date,
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            $("#sum_cnt").html(result.sum_cnt);
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    text: '销售量统计',
                                    x: "center"
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },

                                toolbox: {
                                    show : true,
                                    feature : {
                                        // mark : {show: true},
                                        // dataView : {show: true, readOnly: false},
                                        magicType : {show: true, type: ['line']},
                                        restore : {show: true},
                                        saveAsImage : {show: true}
                                    }
                                },

                                xAxis: {
                                    name: result.x_name,
                                    type: 'category',
                                    boundaryGap: false,
                                    data: result.x_data
                                },
                                yAxis: {
                                    name: '销售量',
                                    type: 'value',
                                    axisLabel: {}
                                },
                                series: [{
                                    name: '订单',
                                    type: 'line',
                                    data: result.y_data_cnt,
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

            init_chart();

            $("#searchForm").submit(function() {
                $.loading.start();
                init_chart();
                return false;
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop