{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180927"/>
    <!-- 图片弹窗  star-->
    <link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=20180927"/> <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180919"></script>
    <script>
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
    </script>
    <!-- 图片弹窗  end-->
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="order-info">
        <div class="order-left">
            <h3>相关商品交易信息</h3>
            <div class="order-goods">
                <div class="goodsPicBox pull-left m-r-10">
                    <a href="{{ route('pc_show_goods',['goods_id'=>$complaint_info['goods_id']]) }}" target="_blank">
                        <img src="{{ $complaint_info['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"/>
                    </a>
                </div>
                <div class="ng-binding refund-message w200">
                    <div class="name">
                        <a href="{{ route('pc_show_goods',['goods_id'=>$complaint_info['goods_id']]) }}" target="_blank"
                           data-toggle="tooltip" data-placement="auto bottom" title="{{ $complaint_info['goods_name'] }}" class="c-blue">{{ $complaint_info['goods_name'] }}</a>
                    </div>
                    <div class="goods-attr">
                        @if(!empty($complaint_info['spec_info']))
                            @foreach(explode(' ', $complaint_info['spec_info']) as $spec)
                                <span>{{ $spec }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="refund-info">
                <dl>
                    <dt>
                        <span class="letter-spacing">{{ str_replace([0,1,2],['买家','卖家','平台'], $complaint_info['role_type']) }}</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['user_name'] }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>订单编号</span>
                        ：
                    </dt>
                    <dd>
                        <span>
                            <a href="/trade/order/info?id={{ $complaint_info['order_id'] }}" target="_blank"
                               data-toggle="tooltip" data-placement="auto bottom" title="点击进入订单详情" class="c-blue">{{ $complaint_info['order_sn'] }}</a>
                        </span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">单价</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['goods_price'] }}元 * {{ $complaint_info['goods_number'] }}（数量）</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">快递</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['shipping_fee'] }} 元</span>
                    </dd>
                </dl>
            </div>
            <div class="refund-info border-none">
                <dl>
                    <dt>
                        <span>商家名称</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['shop_name'] }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span>投诉编号</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['complaint_sn'] }}</span>
                    </dd>
                </dl>

                <dl>
                    <dt>
                        <span>投诉原因</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ format_complaint_type($complaint_info['complaint_type']) }}</span>
                    </dd>
                </dl>

                <dl>
                    <dt>
                        <span>货物状态</span>
                        ：
                    </dt>
                    <dd>
                        <span>{{ $complaint_info['cargo_status']['seller'] }}</span>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <span class="letter-spacing">说明</span>
                        ：
                    </dt>
                    <dd>
                        <span>{!! $complaint_info['complaint_desc'] !!}</span>
                        <div class="refund-img">
                            @if(!empty($complaint_info['images']))
                                @foreach($complaint_info['images'] as $image)
                                    <a href="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" class="highslide" onclick="return hs.expand(this)">
                                        <img src="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="order-right">
            <h3>投诉服务</h3>
            <div class="refund-operate">
                <ul>
                    <li class="operate-steps">
                        <i class="fa fa-check-circle-o"></i>
                        <span>投诉状态：{{ format_complaint_status($complaint_info['complaint_status'],1) }}</span>
                    </li>

                    <li class="operate-prompt">买家已申请平台方介入处理，请尽可能向买家和卖家索取更多的凭证，以便公正裁决</li>
                    <li class="operate-button">
                        <button class="btn btn-operate" data-id="{{ $complaint_info['complaint_id'] }}">裁决</button>
                    </li>

                </ul>

                <!--   -->


            </div>
            <h3>协商记录</h3>
            <div class="order-message">
                <ul>
                    @foreach($complaint_reply as $key=>$item)
                        <li @if($key == 0)class="b-n"@endif>
                            <div class="buyer-head">
                                <img src="{{ get_image_url($item['headimg']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"/>
                            </div>
                            <div class="message-content">
                                <div class="message-info">
                                    <p>
                                        <span class="name">{{ $item['user_name'] }} - {{ str_replace([0,1,2],['买家','卖家','平台'], $item['role_type']) }}</span>
                                        <span class="time">{{ format_time($item['add_time']) }}</span>
                                    </p>
                                    <p>{!! $item['complaint_desc'] !!}</p>
                                    <div class="voucher">
                                        @if(!empty($item['images']))
                                            @foreach($item['images'] as $image)
                                                <a href="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" class="highslide" onclick="return hs.expand(this)">
                                                    <img src="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                    <!--<p class="message-answer"><a href="" class="c-blue">回复</a></p>-->
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <script type="text/javascript">
        $().ready(function() {

            $("body").on("click", ".btn-operate", function() {

                var id = $(this).data("id");
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        // 标题
                        title: '裁决',
                        width: 550,
                        trigger: $(this),
                        // ajax加载的设置
                        ajax: {
                            url: '/trade/complaint/edit',
                            data: {
                                id: id
                            }
                        },
                    });
                }

            });

        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop