{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <!--订单详情信息-->
    <div class="order-info m-b-10 b-t-0">
        <!--订单信息-->
        <div class="order-details">
            <div class="title">商品信息</div>
            <div class="content">
                <dl>
                    <dt>商品名称：</dt>
                    <dd>{{ $order_info['goods_name'] }}</dd>
                </dl>
                <dl>
                    <dt>店铺价格：</dt>
                    <dd>￥{{ $order_info['goods_price'] }}</dd>
                </dl>
                <dl>
                    <dt>拼团价格：</dt>
                    <dd>￥{{ $order_info['act_price'] }}</dd>
                </dl>
            </div>
        </div>
        <!--其它信息-->
        <div class="order-details">
            <div class="title">其他信息</div>
            <div class="content">
                <div class="content-groups clearfix">
                    <dl>
                        <dt>所需人数：</dt>
                        <dd>{{ $order_info['fight_num'] }}</dd>
                    </dl>
                    <dl>
                        <dt>缺少人数：</dt>
                        <dd>{{ $order_info['diff_num'] }}</dd>
                    </dl>
                    @if($order_info['discount_price'] > 0)
                    <dl>
                        <dt>团长优惠：</dt>
                        <dd>￥{{ $order_info['discount_price'] }}</dd>
                    </dl>
                    @endif
                </div>
                <dl>
                    <dt>开团时间：</dt>
                    <dd>{{ $order_info['start_time'] }}</dd>
                </dl>
                <dl>
                    <dt>团结束时间：</dt>
                    <dd>{{ $order_info['end_time'] }}</dd>
                </dl>
                @if($order_info['status'] == 0)
                <dl>
                    <dt>剩余时间：</dt>
                    <dd id="counter_{{ $order_info['order_id'] }}" style="color: red"></dd>
                </dl>
                <script type="text/javascript">
                    //
                </script>
                @endif
                <dl>
                    <dt>交易状态：</dt>
                    <!--组团失败 span 标签的class 为“c-red”-->
                    <dd>
                        <span class="c-blue">{{ $order_info['groupon_status_format'] }}</span>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <!--参与信息-->
    <div class="table-responsive deliver">
        <table class="table">
            <thead>
            <tr>
                <th class="w80">用户头像</th>
                <th class="w80 text-c">标签</th>
                <th class="w120">用户名</th>
                <th class="w100">参与时间</th>
                <th class="text-c w100">拼团状态</th>
                <th class="w150">订单编号</th>
                <th class="text-c w120">订单状态</th>
                <th class="text-c w80">总金额</th>
                <th class="handle w100">操作</th>
                <th class="w100"></th>
            </tr>
            </thead>
            <tbody>
            <!--订单内容-->
            @foreach($list as $item)
            <tr class="order-item">
                <td class="item">
                    <div class="pic-info">
                        <a href="javascript:;" class="goods-thumb">
                            <img src="{{ $item['headimg'] }}" alt="用户头像"></img>
                        </a>
                    </div>
                </td>
                <td class="text-c">
                    @if($item['user_type'] == 0)
                        <span class="c-orange">团长</span>
                    @else
                        会员
                    @endif
                </td>
                <td>{{ $item['user_name'] }}</td>
                <td>{{ $item['created_at'] }}</td>
                <!--失败 td class为 c-red-->
                <td class="text-c c-blue">{{ $item['groupon_status_format'] }}</td>
                <td>{{ $item['order_sn'] }}</td>
                <!--失败 td class为 c-red-->
                <td class="text-c c-blue">{{ $item['order_status_format'] }}</td>
                <td class="text-c">￥{{ $item['order_amount'] }}</td>
                <td class="handle">
                    <a href="/trade/order/info.html?id={{ $item['order_id'] }}">订单详情</a>
                </td>
                @if($item['status'] == 0)
                    {{--todo 立即成团 暂时不做--}}
{{--                <td class="text-c" rowspan="1" style="border-left:1px solid #eee"><a href="javascript:;" class="btn btn-primary btn-sm c-fff finish" data-group_sn="{{ $item['group_sn'] }}">立即成团</a></td>--}}
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
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

{{--自定义css样式--}}
@section('style_css')

@stop


{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $(document).ready(function() {
            $("#counter_{{ $order_info['order_id'] }}").countdown({
                time: "{{ $order_info['end_time'] - time() }}",
                leadingZero: true,
                onComplete: function(event) {
                    $(this).html("已超时！");
                    // 超时事件，预留
                    $.ajax({
                        type: 'GET',
                        url: 'refund',
                        data: {
                            group_sn: '{{ $order_info['group_sn'] }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
        //
        $().ready(function() {
            $("body").on('click', '.finish', function() {
                var group_sn = $(this).data("group_sn");
                $.loading.start();
                $.ajax({
                    type: 'GET',
                    url: '/dashboard/groupon-order/finish-groupon',
                    data: {
                        group_sn: group_sn
                    },
                    dataType: 'json',
                    success: function(result) {
                        if(result.code == 0)
                        {
                            $.msg(result.message);
                            $.go('/dashboard/groupon-order/info?group_sn='+result.group_sn);
                        }
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        });
        //
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop