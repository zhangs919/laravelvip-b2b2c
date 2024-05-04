{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <!-- 图表 -->
    {{--<script src="/js/chart.js?v=201807241613"></script>--}}
    {{--<script src="/js/chart-data.js?v=201807241613"></script>--}}
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-c w300">会员等级概况</th>
                <th class="text-c w100">会员等级</th>
                <th class="text-c w100">数量</th>
                <th class="text-c w100">占比</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-c" rowspan="{{ count($user_rank_data['user_ranks']) + 1 }}" style="border-right: 1px solid #e9e9e9;">
                    <!--会员等级概括统计图-->
                    <div class="module-content m-t-10">
                        <div id="canvas" style="width: 100%; height: 300px;"></div>
                    </div>
                </td>
            </tr>

            @if(!empty($user_rank_data['user_ranks']))
                @foreach($user_rank_data['user_ranks'] as $item)
                    <tr>
                        <td class="text-c">{{ $item['rank_name'] }}</td>
                        <td class="text-c">{{ $item['user_num'] }}</td>
                        <td class="text-c">{{ $item['percent'] }}%</td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
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

            option = {
                title: {
                    text: '',
                    subtext: '',
                    x: 'center'
                },
                tooltip: {
                    trigger: 'item',

                    formatter: "{a} <br/>{b} : {c} ({d}%)"

                },
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: {!! json_encode($user_rank_data['text']) !!}
                },
                calculable: true,
                series: [{
                    name: '会员比例',
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '60%'],
                    data: {!! json_encode($user_rank_data['list']) !!}
                }]
            };

            myChart.setOption(option);
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop