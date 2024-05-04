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

    <div class="search-term m-b-10 pos-r">
        <form id="searchForm" action="/statistics/goods-analyse/industry.html" method="GET">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt pull-none"
                               name="from">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt pull-none"
                               name="to">
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
                        <span>商品分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control chosen-select" id="cat_id1" name="cat_id1">
                            <option value="0">所有分类</option>
                            @foreach($cat_list as $item)
                                <option value="{{ $item['cat_id'] }}">{{ $item['cat_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control-wrap show_cat_id2" style="display: none;">
                        <select class="form-control chosen-select" id="cat_id2" name="cat_id2">
                            <option value="0">所有分类</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出"/>
            </div>
        </form>
    </div>
    <div class="table-content m-t-30 clearfix">
        <h5 class="m-b-10 m-t-0">行业分析概况</h5>
        <div class="item-list-hd">
            <ul class="item-list-tabs">
                <li class="tabs-t current">
                    <a class="sel-t" data-tab="1" href="javascript:void(0);">下单金额</a>
                </li>
                <li class="tabs-t">
                    <a class="sel-t" data-tab="2" href="javascript:void(0);">下单量</a>
                </li>
                <li class="tabs-t last">
                    <a class="sel-t" data-tab="3" href="javascript:void(0);">下单商品数</a>
                </li>
            </ul>
        </div>
        <div class="module-content m-t-10 ">
            <div class="chart" id="canvas-order-amount" style="width: 100%; height: 600px;"></div>
        </div>
        <div class="module-content m-t-10">
            <div class="chart" id="canvas-order-count"
                 style="width: 100%; height: 600px; display: none;"></div>
        </div>
        <div class="module-content m-t-10">
            <div class="chart" id="canvas-goods-count"
                 style="width: 100%; height: 600px; display: none;"></div>
        </div>
        <script type="text/javascript">
            //
        </script>
        <h5 class="m-b-10 m-t-0">行业分析明细</h5>
    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>行业分析明细统计</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <div class="table-responsive">
        {{--引入列表--}}
        @include('statistics.goods-analyse.partials._industry')
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
        $().ready(function () {
            $(".sel-t").click(function () {
                $(".tabs-t").removeClass("current");
                $(this).parent().addClass("current");
                var tab = $(this).data("tab");
                $(".chart").hide();
                if (tab == 1) {
                    $("#canvas-order-amount").show();
                    init_order_amount();
                } else if (tab == 2) {
                    $("#canvas-order-count").show();
                    init_order_count();
                } else if (tab == 3) {
                    $("#canvas-goods-count").show();
                    init_goods_count();
                }
            });

            function init_order_amount() {
                var begin_date = $("#from").val();
                var end_date = $("#to").val();
                var url = "/statistics/goods-analyse/industry-data";
                url += '?type=order_amount';
                url += '&from=' + $("#from").val();
                url += '&to=' + $("#to").val();
                url += '&cat_id1=' + $("#cat_id1").val();
                url += '&cat_id2=' + $("#cat_id2").val();
                var myChart = echarts.init(document.getElementById('canvas-order-amount'));
                myChart.showLoading();
                $.ajax({
                    type: "post",
                    async: true,
                    url: url,
                    data: {},
                    dataType: "json",
                    success: function (result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    text: '',
                                },
                                tooltip: {
                                    trigger: 'axis',
                                    axisPointer: {
                                        type: 'shadow'
                                    }
                                },
                                legend: {
                                    data: []
                                },
                                grid: {
                                    left: '3%',
                                    right: '4%',
                                    bottom: '3%',
                                    containLabel: true
                                },
                                xAxis: {
                                    type: 'value',
                                    boundaryGap: [0, 0.01]
                                },
                                yAxis: {
                                    type: 'category',
                                    data: result.y
                                },
                                series: [{
                                    name: '销售总额',
                                    type: 'bar',
                                    data: result.x
                                }]
                            });
                        }
                    },
                    error: function (errorMsg) {
                        $.msg("图表请求数据失败！");
                        myChart.hideLoading();
                    }
                })
            }

            function init_order_count() {
                var begin_date = $("#from").val();
                var end_date = $("#to").val();
                var url = "/statistics/goods-analyse/industry-data";
                url += '?type=order_count';
                url += '&from=' + $("#from").val();
                url += '&to=' + $("#to").val();
                url += '&cat_id1=' + $("#cat_id1").val();
                url += '&cat_id2=' + $("#cat_id2").val();
                var myChart = echarts.init(document.getElementById('canvas-order-count'));
                myChart.showLoading();
                $.ajax({
                    type: "post",
                    async: true,
                    url: url,
                    data: {},
                    dataType: "json",
                    success: function (result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    text: '',
                                },
                                tooltip: {
                                    trigger: 'axis',
                                    axisPointer: {
                                        type: 'shadow'
                                    }
                                },
                                legend: {
                                    data: []
                                },
                                grid: {
                                    left: '3%',
                                    right: '4%',
                                    bottom: '3%',
                                    containLabel: true
                                },
                                xAxis: {
                                    type: 'value',
                                    boundaryGap: [0, 0.01]
                                },
                                yAxis: {
                                    type: 'category',
                                    data: result.y
                                },
                                series: [{
                                    name: '总下单量',
                                    type: 'bar',
                                    data: result.x
                                }]
                            });
                        }
                    },
                    error: function (errorMsg) {
                        $.msg("图表请求数据失败！");
                        myChart.hideLoading();
                    }
                })
            }

            function init_goods_count() {
                var begin_date = $("#from").val();
                var end_date = $("#to").val();
                var url = "/statistics/goods-analyse/industry-data";
                url += '?type=goods_count';
                url += '&from=' + $("#from").val();
                url += '&to=' + $("#to").val();
                url += '&cat_id1=' + $("#cat_id1").val();
                url += '&cat_id2=' + $("#cat_id2").val();
                var myChart = echarts.init(document.getElementById('canvas-goods-count'));
                myChart.showLoading();
                $.ajax({
                    type: "post",
                    async: true,
                    url: url,
                    data: {},
                    dataType: "json",
                    success: function (result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    text: '',
                                },
                                tooltip: {
                                    trigger: 'axis',
                                    axisPointer: {
                                        type: 'shadow'
                                    }
                                },
                                legend: {
                                    data: []
                                },
                                grid: {
                                    left: '3%',
                                    right: '4%',
                                    bottom: '3%',
                                    containLabel: true
                                },
                                xAxis: {
                                    type: 'value',
                                    boundaryGap: [0, 0.01]
                                },
                                yAxis: {
                                    type: 'category',
                                    data: result.y
                                },
                                series: [{
                                    name: '下单商品数',
                                    type: 'bar',
                                    data: result.x
                                }]
                            });
                        }
                    },
                    error: function (errorMsg) {
                        $.msg("图表请求数据失败！");
                        myChart.hideLoading();
                    }
                })
            }

            init_order_amount();
            // init_order_count();
            // init_goods_count();
            $("#searchForm").submit(function () {
                $.loading.start();
                init_order_amount();
                init_order_count();
                init_goods_count();
                return false;
            });
        });
        //
        $().ready(function () {
            $(".pagination-goto > .goto-input").keyup(function (e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function () {
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
        $().ready(function () {
            $("[data-toggle='popover']").popover();
            var tablelist = $("#table_list").tablelist({
                callback: function () {
                    // 重新渲染
                    $("[data-toggle='popover']").popover();
                }
            });
            $("#searchForm").submit(function () {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $("#btn_export").click(function () {
                var url = "/statistics/goods-analyse/industry-export";
                url += "?from=" + $("#from").val();
                url += "&to=" + $("#to").val();
                url += "&cat_id1=" + $("#cat_id1").val();
                url += "&cat_id2=" + $("#cat_id2").val();
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
            });
            $('body').on("change", "#cat_id1", function () {
                var cat_id1 = $(this).val();
                if (cat_id1 != 0) {
                    $(".show_cat_id2").show();
                } else {
                    $(".show_cat_id2").hide();
                }
                $.ajax({
                    url: "/statistics/goods-analyse/cat-list?cat_id1=" + cat_id1,
                    type: "post",
                    traditional: true,
                    success: function (data) {
                        $("#cat_id2").html(data);
                        $("#cat_id2").trigger("chosen:updated");
                    },
                    error: function (msg) {
                        $.msg("出错了！");
                    }
                });
            });
        });
        //
        $(function () {
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
            $('#from').datetimepicker().on('changeDate', function (ev) {
                $('#to').datetimepicker('setStartDate', ev.date);
            });
            $('#to').datetimepicker().on('changeDate', function (ev) {
                $('#from').datetimepicker('setEndDate', ev.date);
            });
            $(".date").click(function () {
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
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop