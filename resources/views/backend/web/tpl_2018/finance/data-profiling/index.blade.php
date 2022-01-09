{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    {{--<script src="/backend/js/chart.js?v=1.2"></script>--}}
    {{--<script src="/backend/js/chart-data.js?v=1.2"></script>--}}
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <h5 class="m-b-10 m-t-0">
            今日实时
            <span class="f12 c-999 m-l-5">（更新时间：2018-07-24 21:26:52）</span>
        </h5>
        <div class="general clearfix">
            <ul>
                <li class="general-region">
                    <h4>下单金额</h4>
                    <p>有效订单的总金额(元)</p>
                    <span class="count-number" id="today_order_amount">0.00</span>
                </li>
                <li class="general-region">
                    <h4>下单会员数</h4>
                    <p>有效订单的下单会员总数</p>
                    <span class="count-number" id="today_order_users_count">0</span>
                </li>
                <li class="general-region">
                    <h4>下单量</h4>
                    <p>有效订单的总数量</p>
                    <span class="count-number" id="today_order_count">0</span>
                </li>
                <li class="general-region">
                    <h4>下单商品数</h4>
                    <p>有效订单包含的商品总数量</p>
                    <span class="count-number" id="today_order_goods_count">0</span>
                </li>
                <li class="general-region">
                    <h4>平均价格</h4>
                    <p>有效订单包含商品的平均单价（元）</p>
                    <span class="count-number" id="today_order_goods_average_price">0.00</span>
                </li>
                <li class="general-region">
                    <h4>平均客单价</h4>
                    <p>有效订单的平均每单的金额（元）</p>
                    <span class="count-number" id="today_order_user_average_amount">0.00</span>
                </li>
                <li class="general-region">
                    <h4>新增会员</h4>
                    <p>今日新注册会员总数</p>
                    <span class="count-number" id="today_new_users_count">0</span>
                </li>
                <li class="general-region">
                    <h4>会员数量</h4>
                    <p>平台所有会员的数量</p>
                    <span class="count-number" id="users_count">0</span>
                </li>
                <li class="general-region">
                    <h4>新增店铺</h4>
                    <p>今日新注册店铺总数</p>
                    <span class="count-number" id="today_new_shops_count">0</span>
                </li>
                <li class="general-region">
                    <h4>店铺数量</h4>
                    <p>平台所有店铺的数量</p>
                    <span class="count-number" id="shops_count">0</span>
                </li>
                <li class="general-region">
                    <h4>新增商品</h4>
                    <p>今日新增商品总数</p>
                    <span class="count-number" id="today_new_goods_count">0</span>
                </li>
                <li class="general-region">
                    <h4>商品数量</h4>
                    <p>平台所有商品的数量</p>
                    <span class="count-number" id="goods_count">0</span>
                </li>
            </ul>
        </div>
        <h5 class="m-b-10 m-t-0">
            今日销售走势
            <span class="f12 c-999 m-l-5">（更新时间：2018-07-24 21:26:52）</span>
        </h5>
        <!--此为统计图-->
        <div class="module-content m-t-10">
            <div id="canvas" style="width: 100%; height: 300px;"></div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h5 class="m-b-10 m-t-0">7日内店铺销售TOP10</h5>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="w60 text-c">编号</th>
                        <th class="text-c w70">店铺ID</th>
                        <th class="w150">店铺名称</th>
                        <th class="text-c w150">有效订单总金额（元）</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td class="text-c">1</td>
                        <td class="text-c">1</td>
                        <td>九尘教</td>
                        <td class="text-c">1.00</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <h5 class="m-b-10 m-t-0">7日内商品销售TOP10</h5>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="text-c w60">编号</th>
                        <th class="text-c w80">商品ID</th>
                        <th class="w200">商品名称</th>
                        <th class="text-c w100">销量</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td class="text-c">1</td>
                        <td class="text-c">125</td>
                        <td>荷美尔Hormel 经典一口香热狗肠 250g</td>
                        <td class="text-c">1</td>
                    </tr>

                    </tbody>
                </table>
            </div>
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
    <!-- ECharts单文件引入 -->
    <script src="/assets/d2eace91/js/echarts/echarts-all.js?v=201807241613"></script>
    <script type="text/javascript">
        $().ready(function() {

            var myChart = echarts.init(document.getElementById('canvas'));

            var option = {
                title: {
                    // text: '今日销售走势'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['昨天', '当天']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
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
                    name: '时间点',
                    type: 'category',
                    boundaryGap: false,
                    data: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]
                },
                yAxis: {
                    name: '有效销售额',
                    type: 'value'
                },
                series: [{
                    name: '昨天',
                    type: 'line',
                    data: ["0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"]
                }, {
                    name: '当天',
                    type: 'line',
                    data: ["0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"]
                }]
            };

            // 为echarts对象加载数据
            myChart.setOption(option);
        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
            $.ajax({
                url: '/finance/data-profiling/get-data',
                dataType: 'json',
                success: function(data) {
                    $("#today_order_amount").html(data.today_order_amount);
                    $("#today_order_users_count").html(data.today_order_users_count);
                    $("#today_order_count").html(data.today_order_count);
                    $("#today_order_goods_count").html(data.today_order_goods_count);
                    $("#today_order_goods_average_price").html(data.today_order_goods_average_price);
                    $("#today_order_user_average_amount").html(data.today_order_user_average_amount);
                    $("#today_new_users_count").html(data.today_new_users_count);
                    $("#users_count").html(data.users_count);
                    $("#today_new_shops_count").html(data.today_new_shops_count);
                    $("#shops_count").html(data.shops_count);
                    $("#today_new_goods_count").html(data.today_new_goods_count);
                    $("#goods_count").html(data.goods_count);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop