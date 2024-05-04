@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
@stop

@section('content')

    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">订单详情</div>
            <div class="header-right">
                <!-- 控制展示更多按钮 -->
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);">
                            <i class="iconfont">&#xe6cd;</i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </header>
    <div class="order-info-box">
        <div class="order-info-detail">
            <h3>
                <i class="iconfont">&#xe612;</i>
                交易状态
            </h3>
            <div class="order-state color">
                {{ $order_info['order_status_format'] }}
            </div>
            @if($order_info['countdown'] <= 0)
            <div class="order-qrcode-con">
                <div class="order-qrcode SZY-ORDER-QRCODE"></div>
                <div class="bar-code-img">
                    <div class="SZY-BARCODE-SMALL"></div>
                </div>
                <div class="order-qrcode-text">
                    <p>订单编号：{{ $order_info['order_sn'] }}</p>
                    <p>可截屏保存二维码出示给商家</p>
                </div>
            </div>
            @endif

        </div>
        <!-- 待付款 -->
        @if($order_info['countdown'] > 0)
            <div class="order-info-detail m-t-10 clearfix">
                <dl class="p-t-0">
                    <dd>
                        <i class="iconfont">&#xe624;</i>
                        还有
                        <em id="counter_{{ $order_info['order_id'] }}" class="color">00时00分00秒</em>
                        来付款，超时订单将自动关闭
                    </dd>
                </dl>
            </div>
            <script type="text/javascript">
                //
            </script>
        @endif

        <!-- 待收货 -->
        <div class="order-info-detail">
            <dl>
                <dt>
                    <span>{{ $order_info['consignee'] }}</span>
                    <span>{{ $order_info['tel'] }}</span>
                </dt>
                <dd>
                    <i class="iconfont icon-dizhi2"></i>
                    {{ $order_info['region_name'] }} {{ $order_info['address'] }}
                </dd>
            </dl>
        </div>
        <!--订单中商品-->
        <div class="order-item">
            <h2>待发货商品</h2>
            @foreach($order_info['goods_list'] as $goods)
                <div class="order-good-list clearfix">
                    <a href="/{{ $goods['sku_id'] }}.html" class="clearfix">
                        <div class="goods-pic">
                            <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                        </div>
                        <dl class="goods-info">
                            <dt class="goods-name">
                                <!-- -->
                                {{ $goods['goods_name'] }}
                            </dt>
                            <dd class="goods-attr">
                                {{ $goods['spec_info'] }}
                            </dd>
                            <dd class="goods-price price-color">
                                <em>￥{{ $goods['goods_price'] }}</em>
                                <span class="goods-num">x{{ $goods['goods_number'] }}</span>
                            </dd>
                        </dl>
                    </a>
                    <div class="order-bottom-con order-info-con">

                        @if(get_order_operate_state('buyer_complaint', $order_info))
                        <div class="order-bottom-btn">
                            <a class="edit-order" data-url="/user/complaint/add?order_id={{ $order_info['order_id'] }}&sku_id={{ $goods['sku_id'] }}">投诉商家</a>
                        </div>
                        @endif

                    </div>
                </div>

            @endforeach
        </div>
        <!-- 退款完成的商品 -->
        <!-- 包裹start -->
        <!-- 包裹end -->
        <!--支付方式-->
        <div class="goods-subtotle">
            <div class="order-reality-pic">
                <div class="pic-info">
                    <p class="clearfix">
                        <span class="order-text small">商品总价</span>
                        <span class="order-pic price-color">
                        <em class="small">{{ $order_info['goods_amount_format'] }}</em>
                    </span>
                    </p>
                    <p class="clearfix">
                        <span class="order-text small">运费</span>
                        <span class="order-pic price-color">
                        <em class="small">{{ $order_info['shipping_fee_format'] }}</em>
                    </span>
                    </p>
                    <p class="clearfix">
                        <span class="order-text small">包装费</span>
                        <span class="order-pic price-color">
                        <em class="small">￥{{ $order_info['packing_fee'] }}</em>
                    </span>
                    </p>
                </div>
                <p class="clearfix">
                    <span class="order-text">订单总价</span>
                    <span class="order-pic price-color">
                    <em>￥{{ $order_info['order_amount'] }}</em>
                </span>
                </p>
            </div>
            <div class="order-reality-pic border-top">
                <div class="pic-info">
                    <p class="clearfix">
                        <span class="order-text small">余额支付</span>
                        <span class="order-pic">
                        <em class="small">￥{{ $order_info['surplus'] }}</em>
                    </span>
                    </p>
                </div>
                <p class="clearfix">
                    <span class="order-text">待付款金额</span>
                    <span class="order-pic price-color">
                    <em>￥{{ $order_info['money_paid'] }}</em>
                </span>
                </p>
            </div>
        </div>
        <div class="order-info-detail nav-content">
            <ul>
                <li>
                    <span>订单编号：</span>
                    <span>{{ $order_info['order_sn'] }}</span>
                    <a class="input-copy-button" data-clipboard-text="{{ $order_info['order_sn'] }}">复制</a>
                </li>
                @foreach($order_schedules as $key=>$schedule)
                    @if($schedule['status'])
                        <li>
                            <span>{{ $schedule['title'] }}：</span>
                            <span>{{ format_time($schedule['time']) }}</span>
                        </li>
                    @endif
                @endforeach
                {{--<li>--}}
                    {{--<span>成交时间：</span>--}}
                    {{--<span>{{ format_time($order_info['add_time']) }}</span>--}}
                {{--</li>--}}
                <li>
                    <span>支付方式：</span>
                    <span>{{ $order_info['pay_name'] }}</span>
                </li>
                <li>
                    <span>买家留言：</span>
                    <span>{!! $order_info['postscript'] ?? '无' !!}</span>
                </li>
                <li>
                    <span>送货时间：</span>
                    <span>{{ $order_info['best_time'] ?? '无' }}</span>
                </li>
            </ul>
        </div>
    </div>
    <!-- 操作按钮 -->
    <div class="detail-dowm order-handle">

        @if(get_order_operate_state('buyer_delete', $order_info))
            <div class="operate">
                <a onclick="order_delete('{{ $order_info['order_id'] }}',1)" class="btn-link  btn">删除订单</a>
            </div>
        @endif

        <!-- 取消订单 -->
        @if(get_order_operate_state('buyer_cancel', $order_info))
            <div class="operate">
                <a class="btn-link edit-order btn" data-id="{{ $order_info['order_id'] }}" data-type="cancel">取消订单</a>
            </div>
        @endif

        {{--确认收货--}}
        @if(get_order_operate_state('buyer_confirm_receipt', $order_info))
            <div class="operate">
                <a class="btn-link edit-order btn" data-id="{{ $order_info['order_id'] }}" data-type="confirm">确认收货</a>
            </div>
        @endif

        @if($order_info['order_cancel'] == 1)
        <div class="operate">
            <span>商家审核取消订单申请</span>
        </div>
        @endif

        @if(get_order_operate_state('buyer_view_logistics', $order_info))
            <div class="operate">
                <a href="/user/order/express.html?id={{ $order_info['order_id'] }}" class="btn-link  btn">查看物流</a>
            </div>
        @endif

        @if(get_order_operate_state('buyer_payment', $order_info))
            <div class="operate">
                <a href="/checkout/pay.html?id={{ $order_info['order_id'] }}" class="on-payment btn cur">立即付款</a>
            </div>
        @endif
            
        {{--todo--}}
        {{--<div class="operate">
            <a class="btn-link to-pay btn" data-id="{{ $order_info['order_sn'] }}">朋友代付</a>
        </div>--}}
            
        <!-- 已付款，待发货 -->
        @if(get_order_operate_state('buyer_evaluate', $order_info))
            <div class="operate">
                <a href="/user/evaluate/info.html?order_id={{ $order_info['order_id'] }}" class="evaluate btn cur">评价晒单</a>
            </div>
        @endif
        @if($order_info['evaluate_status'] == 1)
            <div class="operate">
                <a class="evaluate btn">已评价</a>
            </div>
        @endif

        @if(in_array($order_info['order_status'], [1,2,3,4]))
        <!-- 再次购买 -->
            <div class="operate">
                <a class="again-buy btn cur" data-order_id="{{ $order_info['order_id'] }}">再次购买</a>
            </div>
        @endif
    </div>
    <!-- 再次购买弹出层_start -->
    <!--订单再次购买无货弹出框-->
    <div id="again_buy_container" class="layer-order-soldout">
        <div class="order-soldou-mask"></div>
        <div class="order-soldout-con">
            <p class="title">以下商品库存不足，先将其他有货的商品加入购物车</p>
            <ul>
                <!-- <li>
                    <div class="good-pic"><img src="" /></div>
                    <div class="good-info"><div class="good-name">【闪电发货服务】虚拟服务 非实物 勿拍 红色【闪电发货服务】虚拟服务 非实物 勿拍 红色</div></div>
                </li> -->
            </ul>
            <div class="order-soldout-bottom ub bdr-top">
                <a class="btn cancel">取消</a>
                <a class="btn bg-color again-buy" data-order_id="" data-sku_ids="">确定</a>
            </div>
        </div>
    </div><!-- 再次购买弹出层_end -->
    <script type="text/javascript">
        //
    </script>
    <!--点击取消按钮弹出框-->
    <div class="mask-div" style="display: none;"></div>
    <div class="f-block-box" id="affirm_info" style="height: 0; overflow: hidden;">加载中...</div>
    <script type="text/javascript">
        //
    </script>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    
    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/js/jquery.qrcode.min.js"></script>
    <script src="/assets/d2eace91/js/jquery-barcode.min.js"></script>
    <script src="/assets/d2eace91/js/clipboard.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        @if($order_info['countdown'] > 0)
        $(document).ready(function() {
            $("#counter_{{ $order_info['order_id'] }}").countdown({
                // 时间间隔
                time: "{{ $order_info['countdown']*1000 }}",
                leadingZero: true,
                onComplete: function(event) {
                    $(this).parent().html("已超时,订单将自动关闭");
                    // 超时事件，预留
                    $.ajax({
                        type: 'GET',
                        url: '/user/order/cancel-sys',
                        data: {
                            order_id: '{{ $order_info['order_id'] }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            if(data.code == 0){
                                window.location.reload();
                            }
                            //tablelist.load();
                        }
                    });
                }
            });
        });
        @endif

        //
        if($('.order-handle').find('.operate').length == 0){
            $('.handle-spacing').hide();
        }
        //
        var scrollheight = 0;
        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var url = $(this).data("url");
                if(url){
                    $.go(url);
                }else{
                    var type = $(this).data("type");
                    var id = $(this).data("id");
                    $.ajax({
                        url: '/user/order/edit-order?from=info',
                        dataType:'json',
                        data: {
                            type: type,
                            id: id,
                        },
                        success:function(result){
                            if(result.message){
                                $.msg(result.message);
                            }
                            if(result.code==0){
                                $("#affirm_info").html(result.data);
                                $("#affirm_info").show();
                                $(".mask-div").show();
                                $('.pop-up-content').show();
                                scrollheight = $(document).scrollTop();
                                var yScroll = $(document).scrollTop()-103;
                                $("body").css("top", "-" + scrollheight + "px");
                                $('.pop-up-content').css('margin-top',yScroll);
                                $("body").css("top","-" + scrollheight+"px");
                                $("body").addClass("visibly");
                            }
                        }
                    });
                }
            });
            $("body").on("click", ".to-pay", function() {
                var order_id = $(this).data("id");
                $.ajax({
                    type: 'POST',
                    url: '/user/order/to-pay.html',
                    data: {
                        order_id: order_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0)
                        {
                            $.go(result.url);
                        }
                    }
                });
            });
            //延迟收货
            /*$("body").on("click", ".extend-time", function() {
                var order_id = $(this).data("id");
                $.ajax({
                    type: 'POST',
                    url: '/user/order/edit_delay.html',
                    data: {
                        order_id: order_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        $(".mask-div").show();
                        scrollheight = $(document).scrollTop();
                        $("body").css("top", "-" + scrollheight + "px");
                        $("body").addClass("visibly");
                    }
                });
            });
            */
            var clipboard = new Clipboard('.input-copy-button');
            clipboard.on('success', function(e) {
                $.msg("复制成功！",1)
            });
            clipboard.on('error', function(e) {
                $.msg("复制失败！请手动复制",1)
            });
            // 点击再次购买
            $('body').on('click','.again-buy',function(){
                if($(this).hasClass('disable')){
                    return false;
                }
                var order_id = $(this).data('order_id');
                var sku_ids =  $(this).data('sku_ids')
                $.post('/user/order/again-buy.html',{
                    order_id : order_id,
                    sku_ids : sku_ids
                },function(result){
                    if(result.message){
                        $.msg(result.message);
                    }
                    if(result.code == 0){
                        $.go('/cart.html');
                    }else{
                        if(result.invalid_list != undefined && result.invalid_list.length > 0){
                            $('#again_buy_container ul').html('');
                            $('#again_buy_container .title').html(result.title);
                            $.each(result.invalid_list,function(i,v){
                                $('#again_buy_container ul').append('<li data-sku_id='+v.sku_id+'><div class="good-pic"><img src="'+v.goods_image+'" /></div><div class="good-info"><div class="good-name">'+v.sku_name+'</div></div></li>');
                            });
                            $('#again_buy_container').find('.again-buy').attr('data-order_id',order_id);
                            $('#again_buy_container').find('.again-buy').attr('data-sku_ids',result.sku_ids);
                            if(result.sku_list == null){
                                $('#again_buy_container').find('.again-buy').addClass('disable');
                            }else{
                                $('#again_buy_container').find('.again-buy').removeClass('disable');
                            }
                            $('#again_buy_container').addClass('show');
                        }
                    }
                },'JSON');
            });
            // 再次购买取消
            $('#again_buy_container').find('.cancel').click(function(){
                $('#again_buy_container').removeClass('show');
            });
            // 再次购买商品链接跳转
            $('#again_buy_container ul').on('click', 'li', function(){
                $.go('/'+$(this).data('sku_id'));
            });
            // 订单二维码
            $('.SZY-ORDER-QRCODE').qrcode({
                width:140,
                height:140,
                text: '{{ $order_info['order_sn'] }}'
            });
            $(".SZY-BARCODE-SMALL").barcode('{{ $order_info['order_sn'] }}', "code128", {
                barWidth: 2,
                barHeight: 80,
                showHRI: false
            });
        });
        $('.mask-div').click(function(){
            $(".mask-div").hide();
            $(".order-box").removeAttr("style");
            $('#affirm_info').hide();
            $('.pop-up-content').hide();
            $('.pop-up-content').removeAttr('style');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        });
        function close_choose() {
            $(".mask-div").hide();
            $(".order-box").removeAttr("style");
            $('#affirm_info').hide();
            $('.pop-up-content').hide();
            $('.pop-up-content').removeAttr('style');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        }
        function order_delete(order_id, type)
        {
            $.confirm("您确定要删除该订单吗？", function() {
                $.loading.start();
                $.ajax({
                    type: 'POST',
                    url: '/user/order/delete.html',
                    data: {
                        order_id: order_id,
                        type: type,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $.loading.stop();
                        $.msg(data.message);
                        if (data.code == 0)
                        {
                            $.go('/user/order/list.html');
                        }
                    }
                });
            });
        }
        //
        $().ready(function () {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('7272') }}",
                type: "add_point_set"
            });
        });
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        //
    </script>

@stop