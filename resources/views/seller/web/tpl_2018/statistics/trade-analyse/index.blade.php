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
        <!-- 交易概况 -->
        <h5 class="m-b-10" style="margin-top: 0px !important;">交易概况</h5>
        <div class="search-term m-b-10">
            <form id="searchForm" action="/statistics/trade-analyse/index.html" method="GET">
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
            </form></div>
        <div class="funnel">
            <!-- <div class="funnel-block">
                <div class="cell">
                    <div class="cell-header">
                        <span class="lable">
                            访客数
                            <i class="fa fa-question-circle f16 c-ddd  m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="访客数：统计时间内，店铺所有页面（包括店铺首页、店铺商品详情页、店铺专题页、店铺商品列表页）被访问的去重人数，一个人在统计时间范围内访问多次只记为一个"></i>
                        </span>
                    </div>
                    <div class="cell-body">
                        <span class="number">2</span>
                    </div>
                </div>
            </div> -->
            <div class="funnel-block">
                <div class="cell">
                    <div class="cell-header">
                        <span class="lable">下单买家数</span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="user_count">&nbsp;</span>
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header">
                        <span class="lable">下单笔数</span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="order_count">&nbsp;</span>
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header">
                        <span class="lable">下单金额（元）</span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="order_amount">&nbsp;</span>
                    </div>
                </div>
            </div>
            <div class="funnel-block">
                <div class="cell">
                    <div class="cell-header">
                <span class="lable">
                    付款买家数
                    <i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="统计的是付过款的会员数量"></i>
                </span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="pay_user_count">&nbsp;</span>
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header">
                <span class="lable">
                    付款订单数
                    <i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="统计的是付过款的订单数，订单包括：普通订单、货到付款确认收货订单、自由购订单、堂内点餐订单、线下订单、提货券订单，不包括付款成功后，取消订单或申请退款退货成功交易关闭的订单，预售未支付尾款订单"></i>
                </span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="pay_order_count">&nbsp;</span>
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header">
                <span class="lable">
                    付款金额（元）
                    <i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="统计的是付过款的订单的总金额，订单包括：普通订单、货到付款确认收货订单、自由购订单、堂内点餐订单、线下订单，不包括付款成功后，取消订单或申请退款退货成功交易关闭的订单金额，预售未支付尾款的订单金额"></i>
                </span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="pay_order_amount">&nbsp;</span>
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header">
                <span class="lable">
                    付款件数
                    <i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="统计的是付过款的订单中的商品的总数量，订单包括：普通订单、货到付款确认收货订单、自由购订单、堂内点餐订单、线下订单，不包含付款成功后，取消订单或申请退款退货成功交易关闭的订单中的商品数量，预售未支付尾款的订单中的商品数量"></i>
                </span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="pay_goods_count">&nbsp;</span>
                    </div>
                </div>
                <!-- <div class="cell">
                    <div class="cell-header">
                        <span class="lable">
                            客单价（元）
                            <i class="fa fa-question-circle f16 c-ddd  m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="客单价=付款买家数/访客数"></i>
                        </span>
                    </div>
                    <div class="cell-body">
                        <span class="number">2</span>
                    </div>
                </div> -->
            </div>
            <!-- <div class="funnel-rate clearfix">
                <div class="pic"></div>
                <div class="region region-order-rate">
                    <p class="title">下单转化率</p>
                    <p class="num">0%</p>
                </div>
                <i class="fa fa-question-circle f16 c-ddd  m-l-10" style="position: absolute; right: 10px; top: 62px;" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="下单转化率=下单买家数/访客数"></i>
                <div class="region region-shop-rate">
                    <p class="title">全店转化率</p>
                    <p class="num">0%</p>
                </div>
                <i class="fa fa-question-circle f16 c-ddd  m-l-10" style="position: absolute; right: 24px; bottom: 109px;" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="全店转化率=付款买家数/访客数"></i>
                <div class="region region-pay-rate">
                    <p class="title">付款转化率</p>
                    <p class="num">0%</p>
                </div>
                <i class="fa fa-question-circle f16 c-ddd  m-l-10" style="position: absolute; right: 43px; bottom: 49px;" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="付款转化率=付款买家数/下单买家数"></i>
            </div> -->
            <div class="funnel-block">
                <div class="cell">
                    <div class="cell-header">
                <span class="lable">
                    有效订单量
                    <i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="指交易成功、已付款未发生退款或退款未完成、货到付款并且交易成功的订单数、线下订单未退款数，包含普通在线支付订单、自由购订单、堂内点餐订单、线下订单、货到付款订单、提货券订单"></i>
                </span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="order_count_valid">&nbsp;</span>
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header">
                        <span class="lable"> 有效订单金额（元） </span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="order_amount_valid">&nbsp;</span>
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header">
                        <span class="lable"> 退款数量 </span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="back_count">&nbsp;</span>
                    </div>
                </div>
                <div class="cell">
                    <div class="cell-header">
                        <span class="lable"> 退款金额（元） </span>
                    </div>
                    <div class="cell-body">
                        <span class="number" id="back_amount">&nbsp;</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="module-content m-t-10">
            <div id="canvas" style="width: 100%; height: 300px;"></div>
        </div>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <!-- 交易构成 -->
        <h5 class="m-b-10 m-t-0">交易构成</h5>
        <div class="search-term m-b-10">
            <form id="searchForm2" action="/statistics/trade-analyse/index" method="GET">
                <div class="simple-form-field ">
                    <div class="form-group">
                        <label class="control-label">
                            <span>时间：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" id="from2" class="form-control form_datetime ipt pull-none" name="from2">
                            <span class="ctime">至</span>
                            <input type="text" id="to2" class="form-control form_datetime ipt pull-none" name="to2">
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <a class="inline-item date2 active" href="javascript:void(0);">今天</a>
                    <em class="ft-bar">|</em>
                    <span class="inline-text">最近：</span>
                    <a class="inline-item date2" href="javascript:void(0);">1个月</a>
                    <a class="inline-item date2" href="javascript:void(0);">3个月</a>
                    <a class="inline-item date2" href="javascript:void(0);">1年</a>
                </div>
                <div class="simple-form-field">
                    <label class="control-label"></label>
                    <div class="form-control-wrap">
                        <button class="btn btn-primary m-r-5">搜索</button>
                    </div>
                </div>
            </form></div>
        <div class="customer clearfix">
            <h2 class="title">成交客户构成</h2>
            <div class="customer-pie" style="width:400px;">
                <div class="customer-pie-label"><span class="bg-green"></span>新成交客户<i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="新成交客户是指统计时间内来店铺付款成功的买家，且在统计时间之前没有在本店成功付款过的买家。"></i></div>
                <div class="customer-pie-label"><span class="bg-red"></span>老成交客户<i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="老成交客户是指在统计时间内到店铺付款成功的买家，且在统计时间之前已经在本店至少成功付款成功过一次。"></i></div>
            </div>
            <div class="table-wrapper">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="handle"></th>
                        <th class="text-c">付款金额（元）<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="统计的是付过款的订单的总金额，订单包括：普通订单、货到付款确认收货订单、自由购订单、堂内点餐订单、线下订单，不包括付款成功后，取消订单或申请退款退货成功交易关闭的订单金额，预售未支付尾款的订单金额"></i></th>
                        <th class="text-c">付款人数</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-c">新成交客户</td>
                        <td class="text-c" id="new_amount">&nbsp;</td>
                        <td class="text-c" id="new_count">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-c">老成交客户</td>
                        <td class="text-c" id="old_amount">&nbsp;</td>
                        <td class="text-c" id="old_count">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
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
        })
        //
        $().ready(function() {
            function init() {
                $.ajax({
                    url: '/statistics/trade-analyse/index?begin_date=' + $("#from").val() + '&end_date=' + $("#to").val(),
                    dataType: 'json',
                    success: function(data) {
                        // 下单买家数
                        $("#user_count").html(data.user_count);
                        // 下单笔数
                        $("#order_count").html(data.order_count);
                        // 下单金额
                        $("#order_amount").html(data.order_amount);
                        // 付款买家数
                        $("#pay_user_count").html(data.pay_user_count);
                        // 付款订单数
                        $("#pay_order_count").html(data.pay_order_count);
                        // 付款金额
                        $("#pay_order_amount").html(data.pay_order_amount);
                        // 付款件数
                        $("#pay_goods_count").html(data.pay_goods_count);
                        // 有效订单量
                        $("#order_count_valid").html(data.order_count_valid);
                        // 有效订单金额
                        $("#order_amount_valid").html(data.order_amount_valid);
                        // 退款数量
                        $("#back_count").html(data.back_count);
                        // 退款金额
                        $("#back_amount").html(data.back_amount);
                    }
                });
            }
            init();
            $("#searchForm").submit(function() {
                $.loading.start();
                init();
                return false;
            });
        });
        //
        $().ready(function() {
            function init_chart() {
                var begin_date = $("#from").val();
                var end_date = $("#to").val();
                var myChart = echarts.init(document.getElementById('canvas'));
                myChart.showLoading();
                $.ajax({
                    type: "post",
                    async: true,
                    url: '/statistics/trade-analyse/index-data?begin_date=' + $("#from").val() + '&end_date=' + $("#to").val(),
                    data: {},
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            myChart.hideLoading();
                            myChart.setOption({
                                title: {
                                    text: '',
                                },
                                tooltip: {
                                    trigger: 'axis'
                                },
                                legend: {
                                    data: ['付款金额', '付款人数', '付款件数']
                                },
                                xAxis: {
                                    type: 'category',
                                    boundaryGap: false,
                                    data: result.x
                                },
                                yAxis: [{
                                    name: '金额',
                                    type: 'value',
                                    position: 'left',
                                    axisLabel: {}
                                }, {
                                    name: '人数 / 件数',
                                    type: 'value',
                                    position: 'right',
                                    axisLabel: {}
                                }],
                                series: [{
                                    name: '付款金额',
                                    type: 'line',
                                    yAxis: 1,
                                    data: result.y1,
                                }, {
                                    name: '付款人数',
                                    type: 'line',
                                    yAxisIndex: 1,
                                    data: result.y2,
                                }, {
                                    name: '付款件数',
                                    type: 'line',
                                    yAxisIndex: 1,
                                    data: result.y3,
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
        //
        $(function(){
            $("[data-toggle='popover']").popover();
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
            $('#from2').datetimepicker().on('changeDate', function(ev) {
                $('#to2').datetimepicker('setStartDate', ev.date);
            });
            $('#to2').datetimepicker().on('changeDate', function(ev) {
                $('#from2').datetimepicker('setEndDate', ev.date);
            });
            $(".date2").click(function() {
                $(".date2").removeClass("active");
                $(this).addClass("active");
                if ($(this).text() == "今天") {
                    var myDate = new Date();
                    $('#from2').val(myDate.Format("yyyy-MM-dd"));
                    $('#to2').val('');
                } else if ($(this).text() == "1个月") {
                    var myDate = new Date();
                    myDate.setMonth(myDate.getMonth() - 1);
                    $('#from2').val(myDate.Format("yyyy-MM-dd"));
                    $('#to2').val('');
                } else if ($(this).text() == "3个月") {
                    var myDate = new Date();
                    myDate.setMonth(myDate.getMonth() - 3);
                    $('#from2').val(myDate.Format("yyyy-MM-dd"));
                    $('#to2').val('');
                } else if ($(this).text() == "1年") {
                    var myDate = new Date();
                    myDate.setYear(myDate.getFullYear() - 1);
                    $('#from2').val(myDate.Format("yyyy-MM-dd"));
                    $('#to2').val('');
                }
            });
            var myDate = new Date();
            $('#from2').val(myDate.Format("yyyy-MM-dd"));
        })
        //
        $().ready(function() {
            function init_part() {
                $.ajax({
                    url: '/statistics/trade-analyse/users-data?begin_date=' + $("#from2").val() + '&end_date=' + $("#to2").val(),
                    dataType: 'json',
                    success: function(data) {
                        $("#new_amount").html(data.new_amount);
                        $("#new_count").html(data.new_count);
                        $("#old_amount").html(data.old_amount);
                        $("#old_count").html(data.old_count);
                    }
                });
            }
            init_part();
            $("#searchForm2").submit(function() {
                $.loading.start();
                init_part();
                return false;
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