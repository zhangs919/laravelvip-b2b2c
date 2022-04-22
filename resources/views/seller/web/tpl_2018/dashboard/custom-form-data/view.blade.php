{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/echarts/echarts-all.js?v=20190121"></script>
@stop

{{--content--}}
@section('content')

    <div class="table-responsive">

        @if(!empty($statistics_form_data))
            @foreach($statistics_form_data as $k=>$v)
                <div class="panel panel-default">
                    <div class="panel-heading">您想要参加哪些环节？</div>
                    <div class="panel-body" id="{{ $k }}" style="height: 350px;">
                        <script>
                            // 标题
                            var title = '{{ $v['title'] }}';
                            // 列表
                            var items = {!! json_encode($v['items']) !!};
                            // 列表名称
                            var fields = [];
                            // 列表名称和值
                            var datas = [];
                            var sum = 0;
                            // 遍历列表内容
                            for(var i in items)
                            {
                                fields.push(i);
                                var tmp = {};
                                tmp['value'] = items[i];
                                tmp['name'] = i;
                                sum += parseInt(items[i]);
                                datas.push(tmp);
                            }

                            //datas = computedPercent(datas, sum);
                            /**
                             * 计算百分比  - 由于text和 datas里数据不一致就会导致侧边的文本灰色
                             * @param array datas 数据
                             * @param int sum 获取的总数
                             */
                            function computedPercent(datas, sum)
                            {
                                var len = datas.length;
                                if(len > 0)
                                {
                                    for(var i = 0; i < len; i ++)
                                    {
                                        var data = datas[i];
                                        var value = parseInt(data.value);
                                        var percent = (value / sum).toFixed(2) * 100;
                                        data.name = data.name + ' ' + percent + '%';
                                        datas[i] = data;
                                    }
                                }
                                return datas;

                            }
                            var myChart = echarts.init(document.getElementById('{{ $k }}'));
                            //
                            option = {
                                title: {
                                    text: title,
                                    x: 'center'
                                },
                                tooltip: {
                                    trigger: 'item',
                                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                                },
                                legend: {
                                    orient: 'vertical',
                                    x: 'left',
                                    data: fields
                                },
                                toolbox: {
                                    show: true,
                                    feature: {
                                        saveAsImage: {
                                            show: true
                                        }
                                    }
                                },
                                calculable: true,
                                series: [{
                                    name: title,
                                    type: 'pie',
                                    radius: '55%',
                                    center: ['50%', '60%'],
                                    data: datas
                                }]
                            };

                            myChart.setOption(option);
                        </script>

                    </div>
                </div>
            @endforeach
        @else
            <table id="table_list" class="table table-hover">
                <tbody>
                <tr>
                    <td class="no-data" colspan="8">
                        <i class="fa fa-exclamation-circle"></i>
                        暂无统计视图
                    </td>
                </tr>
                </tbody>
            </table>
        @endif
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop