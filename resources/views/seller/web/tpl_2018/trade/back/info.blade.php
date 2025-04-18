{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/highslide.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')


    <div class="order-info">
        <div class="order-left">
            <h3>相关商品交易信息</h3>
            <div class="order-goods">
                <div class="goodsPicBox pull-left m-r-10">
                    <a href="{{ route('pc_show_goods',['goods_id'=>$goods_info['goods_id']]) }}" target="_blank">
                        <img src="{{ get_image_url($goods_info['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
                    </a>
                </div>
                <div class="ng-binding refund-message w200">
                    <div class="name">
                        <a href="{{ route('pc_show_goods',['goods_id'=>$goods_info['goods_id']]) }}" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="{{ $goods_info['goods_name'] }}" class="c-blue">{{ $goods_info['goods_name'] }}</a>
                    </div>
                    @if(!empty($goods_info['spec_info']))
                        <div class="goods-attr">
                            @foreach(explode(' ', $goods['spec_info']) as $spec)
                                <span>{{ $spec }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="refund-info">
                <dl>
                    <dt>
                        <span class="letter-spacing">买家</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $order_info['user']['user_name'] ?? '' }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>订单编号</span>
                        ：
                    </dt>
                    <dd>
                        <span>
                            <a href="/trade/order/info?id={{ $back_info['order_id'] }}" data-toggle="tooltip" data-placement="auto bottom" title="点击进入订单详情" class="c-blue">{{ $order_info['order_sn'] }}</a>
                        </span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">单价</span>
                        ：
                    </dt>
                    <dd>
                        <span>￥{{ $goods_info['goods_price'] }} * {{ $goods_info['goods_number'] }}（数量）</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">快递</span>
                        ：
                    </dt>
                    <dd>
                        <span>￥{{ $order_info['shipping_fee'] }}</span>
                    </dd>
                </dl>
            </div>
            <div class="refund-info border-none">
                <dl>
                    <dt>
                        <span>退款编号</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $back_info['back_sn'] }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>退款金额</span>
                        ：
                    </dt>
                    <dd>
                        <span>￥{{ $back_info['refund_money'] }} </span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>退款方式</span>
                        ：
                    </dt>
                    <dd>
                        <span>
                            {{ format_refund_type($back_info['refund_type']) }}
                                                    </span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>退款原因</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ format_refund_reason($back_info['back_reason']) }}
</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>退款要求</span>
                        ：
                    </dt>
                    <dd>
                        <span>
                            退款退货
                                                    </span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">说明</span>
                        ：
                    </dt>
                    <dd>
                        <span>{!! $back_info['back_desc'] !!} </span>
                        <div class="refund-img">
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="order-right">
            <h3>退款服务</h3>
            <div class="refund-operate">
                <ul>
                    <li class="operate-steps">
                        <i class="fa fa-check-circle-o"></i>
                        <span>退款单状态：{{ $back_info['back_status_format'] }}</span>
                    </li>
                    <li class="operate-prompt">
                        @if(back_order_operate_state('shop_confirm', $order_info, $back_info))
                            <button class="btn btn-operate" onclick="_confirm('{{ $back_info['back_id'] }}', 0)">同意申请</button>
                        @endif
                        @if(back_order_operate_state('shop_dismiss', $order_info, $back_info))
                            <button class="btn btn-operate edit-order" data-id="{{ $back_info['back_id'] }}" data-type="dismiss">拒绝申请</button>
                        @endif
                    </li>

                    @if($back_info['back_type'] == 3 && back_order_operate_state('buyer_wait', $order_info, $back_info))
                    <li class="operate-prompt">换货收货地址：{{ $back_info['user_address'] }}</li>
                    <li class="operate-prompt">如果同意，请发送收货地址给买家，买家会根据您提供的地址寄回</li>
                    @endif

                    <li class="operate-prompt">

                        @if(in_array($back_info['back_type'], [1,2]))
                            <!-- 退款申请生成/修改 -->
                            @if(back_order_operate_state('buyer_wait', $order_info, $back_info))
                            买家发起了{{ $service_name }}申请，请及时联系买家友好处理
                            <span>
                                <i class="fa fa-clock-o"></i>
                                <strong id="counter_confirm" class="color"></strong>
                            </span>
                            后系统将自动同意退款申请。
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $("#counter_confirm").countdown({
                                        time: "{{ $back_info['counter'] }}",
                                        leadingZero: true,
                                        onComplete: function(event) {
                                            $(this).html("已超时！");

                                            // 超时事件，预留
                                            $.ajax({
                                                type: 'GET',
                                                url: '/trade/back/confirm-sys.html',
                                                data: {
                                                    back_id: '{{ $back_info['back_id'] }}'
                                                },
                                                dataType: 'json',
                                                success: function(result) {
                                                    if (result.code == 0){
                                                        window.location.reload();
                                                    }else{

                                                    }
                                                }
                                            });
                                        }
                                    });
                                });
                            </script>
                                @if($back_info['back_type'] == 1)
                                    并将退款信息提交至平台方，平台方有权处理退款。
                                @endif
                            @endif
                            <!-- 退款退货 货物已发出 -->
                            <!-- 等待退款 -->
                            <!-- 退款退货处理完成 -->
                            @if($back_info['back_status'] == 4 && $back_info['back_type'] == 2)
                            退款金额： ￥{{ $back_info['refund_money'] }}。平台方已将款项退至买家账户，本次退款申请已成功处理。
                            @endif

                            <!-- 退款退货 撤销 -->
                            @if($back_info['back_status'] == 7)
                                因买家取消退款申请，退款已关闭，交易将正常进行
                            @endif
                            <!-- 退款退货 失效 -->
                            @if($back_info['back_status'] == 6)
                                因卖家超时未处理退款申请，退款已关闭，交易将正常进行
                            @endif
                            <!-- 退款退货 被驳回 -->
                            @if($back_info['back_status'] == 5)
                                <p>您拒绝了买家的退款申请，等待买家修改退款信息。</p>
                                在
                                <span>
                                <i class="fa fa-clock-o"></i>
                                <strong id="counter_dismiss" class="color"></strong>
                            </span>
                                前，买家未处理退款信息，系统将自动取消退款申请。
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#counter_dismiss").countdown({
                                            time: "{{ $back_info['counter'] }}",
                                            leadingZero: true,
                                            onComplete: function(event) {
                                                $(this).html("已超时！");

                                                // 超时事件，预留
                                                $.ajax({
                                                    type: 'GET',
                                                    url: '/trade/refund/cancel-sys.html',
                                                    data: {
                                                        back_id: '{{ $back_info['back_id'] }}'
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        if (data.code == 0){
                                                            window.location.reload();
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    });
                                </script>
                            @endif
                        @elseif($back_info['back_type'] == 3)
                            <!-- 等待卖家确认 -->
                            @if(back_order_operate_state('buyer_wait', $order_info, $back_info))
                                如果
                                <span>
							<i class="fa fa-clock-o"></i>
							<strong id="counter_confirm" class="color"></strong>
						</span>
                                后，卖家未处理售后申请，系统将自动同意售后申请。
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#counter_confirm").countdown({
                                            time: "{{ $back_info['counter'] }}",
                                            leadingZero: true,
                                            onComplete: function(event) {
                                                $(this).html("已超时！");

                                                // 超时事件，预留
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'confirm-sys.html',
                                                    data: {
                                                        back_id: '{{ $back_info['back_id'] }}'
                                                    },
                                                    dataType: 'json',
                                                    success: function(result) {
                                                        if (result.code == 0){
                                                            window.location.reload();
                                                        }else{

                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    });
                                </script>
                            @endif

                            @if($back_info['back_status'] == 4)
                                成功时间：{{ $back_info['updated_at'] }}
                            @endif
                        @elseif($back_info['back_type'] == 4)
                            <!-- 等待卖家确认 -->
                            如果
                            <span>
							<i class="fa fa-clock-o"></i>
							<strong id="counter_confirm" class="color"></strong>
						</span>
                            后，卖家未处理售后申请，系统将自动同意售后申请。
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $("#counter_confirm").countdown({
                                        time: "{{ $back_info['counter'] }}",
                                        leadingZero: true,
                                        onComplete: function(event) {
                                            $(this).html("已超时！");

                                            // 超时事件，预留
                                            $.ajax({
                                                type: 'GET',
                                                url: 'confirm-sys.html',
                                                data: {
                                                    back_id: '{{ $back_info['back_id'] }}'
                                                },
                                                dataType: 'json',
                                                success: function(result) {
                                                    if (result.code == 0){
                                                        window.location.reload();
                                                    }else{

                                                    }
                                                }
                                            });
                                        }
                                    });
                                });
                            </script>


                            @if($back_info['back_status'] == 4)
                                成功时间：{{ $back_info['updated_at'] }}
                            @endif
                        @endif
                    </li>
                </ul>
            </div>
            <h3>协商记录</h3>
            <div class="order-message">
                <ul>
                    @if(!empty($back_logs))
                        @foreach($back_logs as $log)
                            <li class="b-n">
                                <div class="buyer-head">
                                    <img src="{{ get_image_url($log['headimg']) }}"></img>
                                </div>
                                <div class="message-content">
                                    <div class="message-info">
                                        <p>
                                            <span class="name">{{ $log['title'] }}</span>
                                            <span class="time">{{ format_time($log['add_time']) }}</span>
                                        </p>
                                        <p>{!! $log['contents'] !!}</p>
                                        @if(!empty($log['images']))
                                            <ul>
                                                <li>
                                                    <div class="dd">
                                                        <div class="voucher">
                                                            @foreach($log['images'] as $image)
                                                                <a href="{{ $image }}" onclick="return hs.expand(this)">
                                                                    <img src="{{ $image }}" class="goods-thumb" />
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
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

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        $(function(){
            //图片弹窗
            hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
            hs.align = 'center';
            hs.transitions = ['expand', 'crossfade'];
            hs.outlineType = 'rounded-white';
            hs.fadeInOut = true;
            hs.addSlideshow({
                interval: 5000,
                repeat: false,
                useControls: true,
                fixedControls: 'fit',
                overlayOptions: {
                    opacity: .75,
                    position: 'bottom center',
                    hideOnMouseOut: true
                }
            });
        })
        //
        function _confirm(back_id, sys){
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/trade/back/confirm-sys.html',
                data: {
                    back_id: back_id,
                    no_sys: sys
                },
                dataType: 'json',
                success: function(result) {
                    if (result.code == 0){
                        $.msg(result.message, {
                            time: 2000
                        }, function(){
                            $.go("/trade/back/info?id=" + back_id);
                        });
                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            }).always(function(){
                $.loading.stop();
            });
        }
        function _notify(back_id){
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/trade/back/notify-backend.html',
                data: {
                    back_id: back_id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.code == 0){
                        $.msg(result.message, {
                            time: 2000
                        }, function(){
                            $.go('/trade/back/info?id=' + back_id);
                        });
                    }else{
                        $.msg(data.message, {
                            time: 5000
                        });
                    }
                }
            }).always(function(){
                $.loading.stop();
            });
        }
        $(document).ready(function() {
            $("#counter").countdown({
                time: "{{ $back_info['counter'] }}",
                onComplete: function(event) {
                    $(this).html("已超时！");
                    // 超时事件，预留
                    _confirm(448, 1);
                }
            });
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                if (type == 'confirm') {
                    title = "同意申请，发送退货地址";
                }
                if (type == 'shipped') {
                    title = "确认收到货物";
                }
                if (type == 'dismiss') {
                    title = "拒绝申请";
                }
                if($.modal($(this))){
                    $.modal($(this)).show();
                }else{
                    $.modal({
                        // 标题
                        title: title,
                        trigger: $(this),
                        // ajax加载的设置
                        ajax: {
                            url: '/trade/back/edit-order.html',
                            data: {
                                type: type,
                                id: id
                            }
                        },
                    });
                }
            });
        });
    </script>
@stop
