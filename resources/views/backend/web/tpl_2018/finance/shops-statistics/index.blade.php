{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js"></script>
    <script src="/js/chart.js"></script>
    <script src="/js/chart-data.js"></script>
    <script src="/assets/d2eace91/js/echarts/echarts-all.js"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-15 clearfix">
        <div class="search-term m-b-10">
            <form id="searchForm" action="/finance/shops-statistics/index" method="GET">
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
                    <div class="form-group">
                        <label class="control-label">
                            <span>店铺分类：</span>
                        </label>
                        <div class="form-control-wrap">
                            <select id="cat_id" class="form-control chosen-select" name="cat_ids[]">
                                <option value="">-- 请选择 --</option>
                                @foreach($cat_list as $cat)
                                    <option value="{{ $cat['cls_id'] }}">{!! $cat['level_show'] !!}{{ $cat['cls_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>店铺类型：</span>
                        </label>
                        <div class="form-control-wrap">
                            <select id="shop_type" name="shop_type" class="form-control">
                                <option value="">-- 请选择 --</option>
                                <option value="1">自营店铺</option>
                                <option value="2">入驻店铺</option>
                                <option value="3">自营供货商</option>
                                <option value="4">入驻供货商</option>
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
        <div class="module-content m-t-30">
            <div id="canvas" style="width: 100%; height: 300px;"></div>
        </div>
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
                var cat_id = $("#cat_id").val();
                var shop_type = $("#shop_type").val();

                var myChart = echarts.init(document.getElementById('canvas'));

                myChart.showLoading();

                $.ajax({
                    type: "post",
                    async: true,
                    url: '/finance/shops-statistics/get-data',
                    data: {
                        begin_date: begin_date,
                        end_date: end_date,
                        cat_id: cat_id,
                        shop_type: shop_type,
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    text: '新增店铺统计',
                                    x: "center"
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },
                                legend: {
                                    x: 'center',
                                    y: 'bottom',
                                    data: ['昨天', '今天']
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
                                    name: '店铺数量',
                                    type: 'value',
                                    axisLabel: {}
                                },
                                series: [{
                                    name: '昨天',
                                    type: 'line',
                                    data: result.y_data_yesterday,
                                },{
                                    name: '今天',
                                    type: 'line',
                                    data: result.y_data_today,
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