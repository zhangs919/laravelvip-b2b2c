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

    <!--订单详情信息-->
    <div class="order-info m-b-10">
        <!--操作部分-->
        <div class="order-handle">
            <div class="order-operate">
                <ul>

                    @if(in_array($order_info['order_status'], [2,3,4]))
                        交易关闭
                    @else
                        <li class="operate-steps">
                            <i class="fa fa-check-circle-o"></i>
                            <span>当前发货单状态：{{ format_delivery_status($delivery_info['delivery_status']) }}</span>
                        </li>
                        <li class="operate-button">
                            @if(get_order_operate_state('shop_to_shipping', $order_info))
                                <a href="to-shipping?id={{ $delivery_info['delivery_id'] }}">
                                    <button class="btn btn-operate">去发货</button>
                                </a>
                            @endif
                            @if(get_order_operate_state('shop_delivery_cancel',$order_info,$delivery_info))
                                <button class="btn btn-default" onclick="_cancel({{ $delivery_info['delivery_id'] }})">取消发货单</button>
                            @endif
                        </li>
                        <!-- -->
                        <li class="operate-prompt">
                            @if($delivery_info['delivery_status'])
                                <p class="m-b-5">如果买家表示未收到货或者收到的货物有问题，请及时联系买家积极处理，友好协商</p>
                            @else
                                <p class="m-b-5">1.买家已付款，请尽快发货，否则买家有权申请退款。</p>
                                <p class="m-b-5">2.如果无法发货，请及时与买家联系并说明情况。</p>
                                <p>3.买家申请退款后，卖家须征得买家同意后再操作发货，否则买家有权拒收货物。</p>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!--下单时间等-->
        <div class="order-infor">
            <h3>商家：{{ $shop_info['shop_name'] }}</h3>
            <div class="order-infor-center">
                <dl>
                    <dt>
                        <span>订单编号：</span>
                    </dt>
                    <dd>
                        <span>{{ $order_info['order_sn'] }}</span>
                    </dd>
                </dl>

                @foreach($order_schedules as $key=>$schedule)
                    @if($schedule['status'])
                        <dl>
                            <dt>
                                <span>{{ $schedule['title'] }}：</span>
                            </dt>
                            <dd>
                                <span>{{ format_time($schedule['time']) }}</span>
                            </dd>
                        </dl>
                    @endif
                @endforeach

            </div>
        </div>
        <!--订单信息-->
        <div class="order-details">
            <div class="title">订单信息</div>
            <div class="content">
                <dl>
                    <dt>&nbsp;收&nbsp;货&nbsp;人：</dt>
                    <dd>{{ $order_info['consignee'] }}，{{ $order_info['tel'] }}， {{ $order_info['region_name'] }} {{ $order_info['address'] }} </dd>
                </dl>
                <dl>
                    <dt>支付方式：</dt>
                    <dd>
                        {{ $order_info['pay_name'] }}
                    </dd>
                </dl>
                <dl>
                    <dt>配送时间：</dt>
                    <dd>{{ $order_info['best_time'] }}</dd>
                </dl>
                <dl>
                    <dt>配送方式：</dt>
                    <dd>{{ $order_info['shipping_type'] }}@if($order_info['shipping_fee'] <= 0)（ 免邮 ）@endif</dd>
                </dl>
            </div>
        </div>
        <!--其它信息-->
        <div class="order-details">
            <div class="title">其它信息</div>
            <div class="content">
                <!-- <dl>
    <dt>发&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;票：</dt>
    <dd>无需开票</dd>
</dl> -->
                <dl>
                    <dt>买家留言：</dt>
                    <dd>{!! $order_info['postscript'] !!}</dd>
                </dl>
            </div>
        </div>
    </div>
    <!--商品信息-->
    <div class="table-responsive deliver">
        <table class="table">
            <colgroup>
            </colgroup>
            <thead>
            <tr>
                <th class="w200">商品</th>
                <th class="w100">商品条码</th>
                <th class="w100">属性</th>
                <th class="w70">发货数量</th>
                <th class="w50">库存</th>
            </tr>
            </thead>
            <tbody>
            <!--订单内容-->
            @foreach($delivery_info['goods_list'] as $goods)
            <tr class="order-item">
                <td class="item">
                    <div class="pic-info">
                        <a href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                            <img src="{{ $goods['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情"/>
                        </a>
                    </div>
                    <div class="txt-info">
                        <div class="desc">
                            <a class="goods-name" href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" target="_blank" title="查看商品详情">
                                {{ $goods['goods_name'] }}
                            </a>
                            <!-- <a class="snap">【交易快照】</a> -->
                        </div>
                    </div>
                </td>
                <td>
                    {{ $goods['goods_barcode'] }}
                </td>
                <td class="order-type">
                    <div class="ng-binding order-type-info">
                        @if(!empty($goods['spec_info']))
                            @foreach(explode(' ', $goods['spec_info']) as $spec)
                                <span>{{ $spec }}</span>
                            @endforeach
                        @endif
                    </div>
                </td>
                <td class="num">{{ $goods['send_number'] }}</td>
                <td class="stock">{{ $goods['goods_stock'] }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{--发货单物流--}}
    @if($delivery_info['delivery_status'] == 1)
        <div class="tabmenu m-t-20" id="logistics">
            <ul class="tab">
                <li class="active">
                    <a href="#texpress1" data-toggle="tab">发货单物流</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div id="texpress1" class="order-info logistics tab-pane fade in active">
                <div class="order-details">
                    <div class="content">
                        @if($delivery_info['shipping_type'] == 3){{--第三方物流--}}
                        <dl>
                            <dt>物流方式：</dt>
                            <dd>{{ format_shipping_type($delivery_info['shipping_type']) }}</dd>
                        </dl>
                        <dl>
                            <dt>物流公司：</dt>
                            <dd>{{ $delivery_info['shipping_name'] }}</dd>
                        </dl>
                        <dl>
                            <dt>物流编号：</dt>
                            <dd>{{ $delivery_info['delivery_sn'] }}</dd>
                        </dl>
                        <dl>
                            <dt>运单号码：</dt>
                            <dd>{{ $delivery_info['express_sn'] }}</dd>
                        </dl>
                        <dl>
                            <dt>物流跟踪：</dt>
                            <dd>
                                <ul class="express-log m-t-0">

                                    @if($express_trace['error'] == 1)
                                    <li>
                                        抱歉，查询出错，请重试或点击快递公司官网地址进行查询。
                                    </li>
                                    @else
                                        @foreach($express_trace['data'] as $item)
                                            <li>{{ $item['time'] }} {{ $item['context'] }}</li>
                                        @endforeach
                                    @endif

                                    {{--<li>2018-10-15 13:50:29 【长沙市】 快件已被 【丰巢的麓阳和景小区(丰巢智能快递柜)】 代收, 如有问题请电联（17388979968 / 4000633333,17388979968）, 感谢使用中通快递, 期待再次为您服务!</li>--}}
                                    {{--<li>2018-10-15 13:59:11 【长沙市】 快件已被 【丰巢的长沙市一中岳麓中学(丰巢智能快递柜)】 代收, 如有问题请电联（15974118919 / 4000633333,15974118919）, 感谢使用中通快递, 期待再次为您服务!</li>--}}
                                    {{--<li>2018-10-15 16:13:45 【长沙市】 快件已在 【岳麓西中心】 签收, 签收人: 丰巢, 如有疑问请电联:17388979968 / 15387312373, 您的快递已经妥投, 如果您对我们的服务感到满意, 请给个五星好评, 鼓励一下我们【请在评价快递员处帮忙点亮五颗星星哦~】</li>--}}
                                    {{--<li>2018-10-15 16:13:45 [丰巢的麓阳和景小区(丰巢智能快递柜)]【长沙市】 已签收, 签收人凭取货码签收, 如有疑问请电联: 17388979968 / 4000633333,17388979968, 您的快递已经妥投, 如果您对我们的服务感到满意, 请给个五星好评, 鼓励一下我们【请在评价快递员处帮忙点亮五颗星星哦~】</li>--}}
                                    {{--<li>2018-10-15 22:01:22 【长沙市】 快件已被 【丰巢的长沙市一中岳麓中学(丰巢智能快递柜)】 代收, 如有问题请电联（15974118919 / 4000633333,15974118919）, 感谢使用中通快递, 期待再次为您服务!</li>--}}
                                    {{--<li>2018-10-15 22:04:39 [丰巢的长沙市一中岳麓中学(丰巢智能快递柜)]【长沙市】 已签收, 签收人凭取货码签收, 如有疑问请电联: 15974118919 / 4000633333,15974118919, 您的快递已经妥投, 如果您对我们的服务感到满意, 请给个五星好评, 鼓励一下我们【请在评价快递员处帮忙点亮五颗星星哦~】</li>--}}
                                    {{--<li>2018-10-22 13:03:35 【长沙市】 快件已被 【丰巢的麓阳和景小区(丰巢智能快递柜)】 代收, 如有问题请电联（17388979968 / 4000633333,17388979968）, 感谢使用中通快递, 期待再次为您服务!</li>--}}
                                    {{--<li>2018-10-22 21:30:54 [丰巢的麓阳和景小区(丰巢智能快递柜)]【长沙市】 已签收, 签收人凭取货码签收, 如有疑问请电联: 17388979968 / 4000633333,17388979968, 您的快递已经妥投, 如果您对我们的服务感到满意, 请给个五星好评, 鼓励一下我们【请在评价快递员处帮忙点亮五颗星星哦~】</li>--}}
                                    {{--<li>2018-10-26 15:42:37 【长沙市】 快件已被 【丰巢的达美美立方(丰巢智能快递柜)】 代收, 如有问题请电联（18216460860 / 4000633333,18216460860）, 感谢使用中通快递, 期待再次为您服务!</li>--}}
                                    {{--<li>2018-10-26 22:08:22 [丰巢的达美美立方(丰巢智能快递柜)]【长沙市】 已签收, 签收人凭取货码签收, 如有疑问请电联: 18216460860 / 4000633333,18216460860, 您的快递已经妥投, 如果您对我们的服务感到满意, 请给个五星好评, 鼓励一下我们【请在评价快递员处帮忙点亮五颗星星哦~】</li>--}}
                                    {{--<li>2018-11-09 20:14:11 【合肥市】 快件已被 【丰巢的周谷堆小区(丰巢智能快递柜)】 代收, 如有问题请电联（15805609527 / 4000633333,15551195562）, 感谢使用中通快递, 期待再次为您服务!</li>--}}
                                    {{--<li>2018-11-09 20:35:28 [丰巢的周谷堆小区(丰巢智能快递柜)]【合肥市】 已签收, 签收人凭取货码签收, 如有疑问请电联: 15805609527 / 4000633333,15551195562, 您的快递已经妥投, 如果您对我们的服务感到满意, 请给个五星好评, 鼓励一下我们【请在评价快递员处帮忙点亮五颗星星哦~】</li>--}}

                                </ul>
                            </dd>
                        </dl>
                        @else{{--无需物流、指派、众包--}}
                        <dl>
                            <dt>物流方式：</dt>
                            <dd>{{ format_shipping_type($delivery_info['shipping_type']) }}</dd>
                        </dl>
                        <dl>
                            <dt>物流编号：</dt>
                            <dd>{{ $delivery_info['delivery_sn'] }}</dd>
                        </dl>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
    @endif

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>

        $("body").on("click", ".edit-order", function() {
            var type = $(this).data("type");
            var id = $(this).data("id");
            if (type == 'delivery') {
                title = "修改运单";
                width = 480;
            }
            if ($.modal($(this))) {
                $.modal($(this)).show();
            } else {
                $.modal({
                    // 标题
                    title: title,
                    width: width,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/trade/delivery/edit-order',
                        data: {
                            type: type,
                            id: id
                        }
                    },
                });
            }
        });
        function _cancel(delivery_id)
        {
            layer.confirm('确定要取消此发货单吗？',function(){
                $.loading.start();
                $.post('/trade/delivery/cancel', {
                    id: delivery_id,
                }, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, function(){
                            $.go("/trade/delivery/list");
                        });
                    }else {
                        $.msg(result.message);
                    }
                }, 'json').always(function(){
                    $.loading.stop();
                });
            });
        }
        $("#btn_print").click(function(){
            $.go('/trade/order/print.html?did={{ $delivery_info['delivery_id'] }}', '_blank');
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop