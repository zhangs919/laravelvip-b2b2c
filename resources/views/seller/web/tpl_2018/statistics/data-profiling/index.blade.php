{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

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
        <h5 class="m-b-10 m-t-0">
            今日实时
            <span class="f12 c-999 m-l-5">（更新时间：{{ format_time($context['current_time']) }}）</span>
            <i class="fa fa-question-circle f16 c-ddd pull-right" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="今日实时数据的统计时间均为今日零时截至当前更新时间。 "></i>
        </h5>
        <div class="balance-bill column5">
            <!-- <dl>
                <dd class="m-b-5">
                    <span class="money">12</span>
                </dd>
                <dd>
                    <span>访客数</span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money">103</span>
                </dd>
                <dd>
                    <span>浏览量</span>
                </dd>
            </dl> -->
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="today_payed_count">&nbsp;</span>
                </dd>
                <dd>
                    <span>付款订单数<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="付款订单数：统计今日成功付款的线上普通订单、自由购订单、堂内点餐订单、提货券订单、线下订单数，一个订单对应唯一一个订单号（拼团订单付款后计入付款订单；货到付款在确认收货后计入付款订单）"></i></span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="today_payed_money">&nbsp;</span>
                </dd>
                <dd>
                    <span>付款金额（元）<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="付款金额(元)：统计的是付过款的订单的总金额，订单包括：普通订单、货到付款确认收货订单、自由购订单、堂内点餐订单、线下订单，不包括付款成功后，取消订单或申请退款退货成功交易关闭的订单金额，预售未支付尾款的订单金额"></i></span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="today_payed_goods_count">&nbsp;</span>
                </dd>
                <dd>
                    <span>付款商品件数<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="付款商品件数：统计今日，所有线上、线下付款订单的商品件数之和（货到付款在确认收货后计入总数量）"></i></span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="today_back_count">&nbsp;</span>
                </dd>
                <dd>
                    <span>退款订单数<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="退款订单数：统计今日，所有线上、线下退款完成的订单数"></i></span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="today_back_money">&nbsp;</span>
                </dd>
                <dd>
                    <span>退款金额（元）<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="退款金额（元）：统计今日，所有线上、线下退款完成的订单金额之和"></i></span>
                </dd>
            </dl>
        </div>
        <h5 class="m-b-10">
            昨日经营概况
        </h5>
        <div class="balance-bill column4">
            <!-- <dl>
                <dd class="m-b-5">
                    <span class="money">12</span>
                </dd>
                <dd>
                    <span>访客数</span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money">103</span>
                </dd>
                <dd>
                    <span>浏览量</span>
                </dd>
            </dl> -->
            <dl class="bottom-line">
                <dd class="m-b-5">
                    <span class="money" id="yesterday_order_count">&nbsp;</span>
                </dd>
                <dd>
                    <span>下单数量<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="下单数：统计昨日普通订单、自由购订单、堂内点餐订单、提货券订单、线下订单量，包含各种状态的订单。"></i></span>
                </dd>
            </dl>
            <dl class="bottom-line">
                <dd class="m-b-5">
                    <span class="money" id="yesterday_payed_count">&nbsp;</span>
                </dd>
                <dd>
                    <span>付款订单数量<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="付款订单数量：统计昨日成功付款的线上普通订单、自由购订单、堂内点餐订单、提货券订单、线下订单数，一个订单对应唯一一个订单号（拼团订单付款后计入付款订单；货到付款在确认收货后计入付款订单），交易关闭的订单除外。"></i></span>
                </dd>
            </dl>
            <dl class="bottom-line">
                <dd class="m-b-5">
                    <span class="money" id="yesterday_payed_money">&nbsp;</span>
                </dd>
                <dd>
                    <span>付款金额（元）<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="付款金额(元)：统计昨日，所有线上、线下已付款、交易成功的订单金额之和。"></i></span>
                </dd>
            </dl>
            <dl class="bottom-line">
                <dd class="m-b-5">
                    <span class="money" id="yesterday_send_count">&nbsp;</span>
                </dd>
                <dd>
                    <span>发货订单数<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="发货订单数：统计昨日发货订单数量，昨日的订单，今日发货，此处统计的数量不增加，只统计发货时间是昨日的数量。"></i></span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="yesterday_back_count">&nbsp;</span>
                </dd>
                <dd>
                    <span>退款订单数<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="退款订单数：只统计昨日退款成功的订单数量。"></i></span>
                </dd>
            </dl>
            <dl>
                <dd class="m-b-5">
                    <span class="money" id="yesterday_back_money">&nbsp;</span>
                </dd>
                <dd>
                    <span>退款金额（元）<i class="fa fa-question-circle f16 c-ddd m-l-10" data-toggle="popover" data-trigger="hover" data-placement="right" data-html="true" data-content="退款金额：统计昨日退款成功的退款金额总和。"></i></span>
                </dd>
            </dl>
        </div>
        <h5 class="m-b-30">
            近7天订单趋势
            <i class="fa fa-question-circle f16 c-ddd pull-right" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="总订单量统计的订单包括：普通订单、自由购订单、堂内点餐订单、提货券订单、拼团订单（包括开团）、线下订单，包括所有状态的订单"></i>
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
                    // text: '近7天订单趋势'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['总订单', '已成功', '已发货', '未发货', '未付款', '已关闭']
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
                    data: {!! $xAxis_data !!}
                },
                yAxis: {
                    type: 'value'
                },
                series: {!! $series !!}
            };
            // 为echarts对象加载数据
            myChart.setOption(option);
        });
        //
        $().ready(function() {
            $.ajax({
                url:'/statistics/data-profiling/get-data',
                dataType:'json',
                success:function(data) {
                    // 今日付款订单数
                    $("#today_payed_count").html(data.today_payed_count);
                    // 今日付款金额（元）
                    $("#today_payed_money").html(data.today_payed_money);
                    // 今日付款商品件数
                    $("#today_payed_goods_count").html(data.today_payed_goods_count);
                    // 今日退款订单数
                    $("#today_back_count").html(data.today_back_count);
                    // 今日退款金额（元）
                    $("#today_back_money").html(data.today_back_money);
                    // 昨日下单数量
                    $("#yesterday_order_count").html(data.yesterday_order_count);
                    // 昨日付款订单数
                    $("#yesterday_payed_count").html(data.yesterday_payed_count);
                    // 昨日付款金额（元）
                    $("#yesterday_payed_money").html(data.yesterday_payed_money);
                    // 昨日发货订单数
                    $("#yesterday_send_count").html(data.yesterday_send_count);
                    // 昨日退款订单数
                    $("#yesterday_back_count").html(data.yesterday_back_count);
                    // 昨日退款金额（元）
                    $("#yesterday_back_money").html(data.yesterday_back_money);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop