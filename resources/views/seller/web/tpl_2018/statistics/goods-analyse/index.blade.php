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

    <div class="table-content m-t-15 clearfix">
        <h5 class="m-b-10 m-t-0">商品概况</h5>
        <div class="search-term m-b-10">
            <form id="searchForm" action="/statistics/goods-analyse/index" method="GET">
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
                    <a class="inline-item date" href="javascript:void(0);">今天</a>
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
        <div class="matrix">
            <ul>
                <li>
                    <div class="matrix-name">商品发布</div>
                    <div class="matrix-block">
                        <p class="name">出售中商品数</p>
                        <p class="count" id="onsale">&nbsp;</p>
                    </div>
                    <div class="matrix-block">
                        <p class="name">下架商品数</p>
                        <p class="count" id="offsale">&nbsp;</p>
                    </div>
                    <div class="matrix-block">
                        <p class="name">待审核商品数</p>
                        <p class="count" id="waitaudit">&nbsp;</p>
                    </div>
                </li>
            </ul>
        </div>
        <h5 class="m-b-10">
            商品销售趋势
            <span class="f12 c-999 m-l-5">（前30天数据）</span>
            <i class="fa fa-question-circle f16 c-ddd pull-right" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="支付数：统计日期内付款的商品数量，订单在哪天付款的，支付数就统计在哪天，对已付款的订单取消订单，交易关闭后，此处统计的支付数会相应减少（包含的订单有普通订单、自由购订单、堂内点餐订单、线下订单、提货券订单）。</br>下单数：统计日期内店铺下单的非交易关闭的订单中的商品数量（包含的订单有普通订单、自由购订单、堂内点餐订单、线下订单、提货券订单）。" ></i>
        </h5>
        <div class="module-content m-t-10">
            <div id="canvas" style="width: 100%; height: 300px;"></div>
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
    <script src="/js/chart.js"></script>
    <script src="/js/chart-data.js"></script>
    <script src="/assets/d2eace91/js/echarts/echarts-all.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            $("[data-toggle='popover']").popover();
            var myChart = echarts.init(document.getElementById('canvas'));
            var option = {
                title: {
                    // text: '商品销售趋势'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['支付数', '下单数']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: {!! $x_axis !!}
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                    name: '支付数',
                    type: 'line',
                    data: {!! $y_axis['payed'] !!}
                }, {
                    name: '下单数',
                    type: 'line',
                    data: {!! $y_axis['all'] !!}
                }]
            };
            // 为echarts对象加载数据
            myChart.setOption(option);
        });
        //
        $().ready(function() {
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                $.loading.start();
                init();
                $.loading.stop();
                // 阻止表单提交
                return false;
            });
            function init() {
                var url = '/statistics/goods-analyse/get-data';
                url += "?from=" + $("#from").val();
                url += "&to=" + $("#to").val();
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $("#onsale").html(data.onsale);
                        $("#offsale").html(data.offsale);
                        $("#waitaudit").html(data.waitaudit);
                    }
                });
            }
            init();
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
            $("[data-toggle='popover']").popover();
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop