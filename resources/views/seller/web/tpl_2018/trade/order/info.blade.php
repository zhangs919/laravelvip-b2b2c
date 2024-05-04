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

    @php
        $format_order_status_seller = format_order_status_seller($info['order_status'],$info['shipping_status'],$info['pay_status'], $info['order_cancel'])
    @endphp

    <!--步骤-->
    <div class="order-step">
        <!--完成步骤为dl添加current样式，完成操作内容后会显示完成时间-->

        @foreach($order_schedules as $key=>$schedule)
            <dl class="@if($schedule['status']){{ 'current' }}@endif @if($key == 0){{ 'step-first' }}@endif">
                <dt>{{ $schedule['title'] }}</dt>
                <dd class="bg"></dd>
                <dd class="date" title="{{ $schedule['title_sub'] ?? '' }}">{{ format_time($schedule['time']) }}</dd>
            </dl>
        @endforeach

    </div>
    <!--订单详情信息-->
    <div class="order-info m-b-10">
        <!--操作部分-->
        <div class="order-handle">
            <div class="order-operate">
                <ul>
                    <li class="operate-steps">
                        <i class="fa fa-check-circle-o"></i>
                        <span>当前订单状态：{{ $info['order_status_format'] }}</span>
                    </li>

                    <!-- 待付款 -->
                    @if($format_order_status_seller == 'unpayed' && $info['countdown'] > 0)
                        <li class="operate-prompt">
                            <p>
                                买家（{{ $info['user_name'] }}）还有
                                <span>
                                <i class="fa fa-clock-o"></i>
                                <span id="counter">00 天 00 小时 00 分 00 秒</span>
                            </span>
                                来付款，超时订单将自动关闭。
                            </p>
                        </li>
                        <script type="text/javascript">
                            //
                        </script>
                    @endif

                    <!-- 买家已付款，卖家待接单 -->


                    <!-- 买家已付款，待发货 -->

                    <!-- 待收货 -->
                    @if($format_order_status_seller == 'shipped' && $info['countdown'] > 0)
                    <li class="operate-prompt">
                        <p>
                            买家（{{ $info['consignee'] }}）还有
                            <span>
                                <i class="fa fa-clock-o"></i>
                                <span id="counter">00 天 00 小时 00 分 00 秒</span>
                            </span>
                            来完成本次交易的“确认收货”。如果期间买家（{{ $info['consignee'] }}）没有“确认收货”，也没有“申请退款”，本交易将自动结束，平台将把货款支付给您。
                            <br>
                            如果买家表示未收到货或者收到的货物有问题，请及时联系买家积极处理，友好协商。
                        </p>
                    </li>
                    @endif
                    <li class="operate-button">

                        @if(get_order_operate_state('shop_edit_order_price', $info))
                            <button class="btn btn-operate edit-order" data-id="{{ $info['order_id'] }}" data-type="order">修改订单价格</button>
                        @endif

                        @if(get_order_operate_state('shop_cancel', $info))
                            <button class="btn btn-operate edit-order" data-id="{{ $info['order_id'] }}" data-type="close">关闭订单</button>
                        @endif

                        @if(get_order_operate_state('shop_edit_address', $info))
                            <button class="btn btn-operate edit-order" data-id="{{ $info['order_id'] }}" data-type="address">修改收货人信息</button>
                        @endif

                        @if(get_order_operate_state('shop_assign', $info))
                            <!--订单指派网点或门店  -->
                            <a class="btn btn-operate edit-order" href="javascript:;" data-id="{{ $info['order_id'] }}" data-type="assign">
                                订单指派网点
                            </a>
                        @endif

                        @if(get_order_operate_state('shop_delivery', $info))
                            <button class="btn btn-operate edit-order" data-id="{{ $info['order_id'] }}" data-type="delivery">拆单发货</button>
                        @endif

                        @if(get_order_operate_state('shop_delay', $info))
                            <button class="btn btn-operate edit-order" data-id="{{ $info['order_id'] }}" data-type="delay">延长收货时间</button>
                        @endif

                        <!-- 货到付款订单或者已付款订单 -->
                        <!-- 防止重复出现拆单发货按钮 -->
                        <!-- <button class="btn btn-operate" data-toggle="modal">开具发票</button> -->


                    </li>
                    <li class="operate-prompt">




                        @foreach(format_order_status_reminder($info['order_status'],$info['shipping_status'],$info['pay_status'], $info['close_reason'], 1) as $reminderMsg)
                            <p>{!! $reminderMsg !!}</p>
                        @endforeach

                        {{--<p>--}}

                            {{--关闭类型：系统取消订单--}}

                        {{--</p>--}}
                        {{--<p>关闭原因：订单超时未支付，系统自动取消订单!</p>--}}
                    </li>

                </ul>
            </div>
        </div>
        <!--下单时间等-->
        <div class="order-infor">
            <h3>商家：{{ $info['shop_name'] }}</h3>
            <div class="order-infor-center">
                <dl>
                    <dt>
                        <span>订单编号：</span>
                    </dt>
                    <dd>
                        <span>{{ $info['order_sn'] }}</span>
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
                    <dd>{{ $info['consignee'] }}，{{ $info['tel'] }}</dd>
                </dl>
                <dl>
                    <dt>收货地址：</dt>
                    <dd>{{ $info['region_name'] }} {{ $info['address'] }}</dd>
                </dl>
                <dl>
                    <dt>支付方式：</dt>
                    <dd>{{ $info['pay_name'] }}</dd>
                </dl>
                <dl>
                    <dt>配送时间：</dt>
                    <dd>{{ $info['best_time'] }}</dd>
                </dl>
                <dl>
                    <dt>配送方式：</dt>
                    <dd>{{ $info['shipping_type'] }}@if($info['shipping_fee'] <= 0)（ 免邮 ）@endif</dd>
                </dl>
            </div>
        </div>


        <!--其它信息-->
        <div class="order-details">
            <div class="title">其它信息</div>
            <div class="content">

                <dl>
                    <dt>买家留言：</dt>
                    <dd>{!! $info['postscript'] !!}</dd>
                </dl>
            </div>
        </div>

    </div>
    <!--商品信息-->
    <div class="table-responsive deliver">
        <table class="table">

            <thead>
            <tr>
                <th class="w300">商品</th>
                <th class="w100">商品条码</th>
                <th class="w100">属性</th>
                <th class="w70">单价（元）</th>
                <th class="w50">数量</th>
                <th class="w50">库存</th>
                <th class="w60 text-c">状态</th>
                <th class="w50">服务</th>
                <th class="w70">优惠</th>
                <th class="w70">积分抵扣</th>
            </tr>
            </thead>
            <tbody>
            <!--订单内容-->
            @foreach($info['goods_list'] as $goods)
            <tr class="order-item">
                <td class="item">
                    <div class="pic-info">
                        <a href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                            <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情" />
                        </a>
                    </div>
                    <div class="txt-info w200">
                        <div class="desc m-b-5">
                            <a class="goods-name" href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" target="_blank" title="查看商品详情">
                                {{ $goods['goods_name'] }}
                            </a>
                            <!-- -->
                            <!-- <a class="snap">【交易快照】</a> -->
                            <div class="icon">
                            </div>
                        </div>

                        {{--商品活动标识--}}
                        @if($goods['goods_type'] > 0)
                            <div class="goods-active {{ format_order_goods_type($goods['goods_type'],1) }}">
                                <a>{{ format_order_goods_type($goods['goods_type']) }}</a>
                            </div>
                        @endif


                    </div>
                </td>
                <td>{{ $goods['goods_barcode'] }}</td>
                <td class="order-type">
                    <div class="ng-binding order-type-info">
                        @if(!empty($goods['spec_info']))
                            @foreach(explode(' ', $goods['spec_info']) as $spec)
                                <span>{{ $spec }}</span>
                            @endforeach
                        @endif
                    </div>
                </td>
                <td class="price">￥{{ $goods['goods_price'] }}</td>
                <td class="num">{{ $goods['goods_number'] }}</td>
                <td class="stock">{{ $goods['goods_stock'] }}</td>
                <td class="state text-c">{{ $goods['goods_status_format'] }}</td>
                <td class="service">
                    <span class="c-green">正常</span>
                </td>
                <td class="order-discount">
                    ￥ {{ $goods['discount'] }}
                </td>
                <td class="order-type text-c">￥{{ $goods['integral_money'] }}</td>

            </tr>
            <!-- 订单满赠 -->
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="messageBox tfoot-info">
        <div class="address-info text-r">
            <p class="m-b-5">
                <span>商品总金额：￥{{ $info['goods_amount'] }}</span>
                <em class="operator">+</em>
                <span>运费：￥{{ $info['shipping_fee'] }}</span>
                <em class="operator">-</em>
                <span>店铺红包：￥{{ $info['shop_bonus'] }}</span>
                <em class="operator">-</em>
                <span>平台红包：￥{{ $info['bonus'] }}</span>
                <em class="operator">-</em>
                <span>积分抵扣：￥{{ $info['integral_money'] }}</span>
                <em class="operator">-</em>
                <span>卖家优惠：￥{{ $info['discount_fee'] }}</span>
                <em class="operator">=</em>
                <span>
                    <strong>订单总金额：￥{{ $info['order_amount'] }}</strong>
                </span>
            </p>
        </div>
    </div>

    @if(!empty($info['delivery_list']))
        <div class="tabmenu m-t-20" id="logistics">
            <ul class="tab">
                @foreach($info['delivery_list'] as $key=>$item)
                <li class="@if($key == 0){{ 'active' }}@endif">
                    <a href="#texpress{{ $key+1 }}" data-sn="{{ $item['delivery_sn'] }}" data-toggle="tab">发货单物流（{{ $item['send_number'] }}）</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="tab-content">
            @foreach($info['delivery_list'] as $key=>$item)
                <div id="texpress{{ $key+1 }}" class="order-info logistics tab-pane fade in @if($key == 0){{ 'active' }}@endif">
                    <div class="order-details">
                        <div class="content">
                            <dl>
                                <dt>订单商品：</dt>
                                <dd>
                                    <div class="log-goods-list">
                                        <ul>
                                            <li>
                                                <a title="{{ $item['goods_name'] }} * {{ $item['send_number'] }}" data-toggle="tooltip" data-placement="auto bottom" href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}" target="_blank">
                                                    <img class="gift-thumb" src="{{ $item['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </dd>
                            </dl>
                            <dl>
                                <dt>物流方式：</dt>
                                <dd>@if(in_array($item['shipping_type'], [1,2]))嗖嗖物流@else普通快递@endif</dd>
                            </dl>
                            @if($item['shipping_type'] == 3){{--第三方物流--}}
                            <dl>
                                <dt>物流公司：</dt>
                                <dd>{{ $item['shipping_name'] }}</dd>
                            </dl>
                            <dl>
                                <dt>物流编号：</dt>
                                <dd>{{ $item['delivery_sn'] }}</dd>
                            </dl>
                            <dl>
                                <dt>运单号码：</dt>
                                <dd>{{ $item['express_sn'] }}</dd>
                            </dl>
                            <dl>
                                <dt>物流跟踪：</dt>
                                <dd>
                                    <ul class="express-log m-t-0">
                                        <li>暂未查到物流信息</li>
                                    </ul>
                                </dd>
                            </dl>
                            @elseif($item['shipping_type'] == 2){{--众包--}}
                                {{--todo--}}
                            @elseif($item['shipping_type'] == 1){{--指派--}}
                                {{--todo--}}
                            @else
                                {{--无需物流--}}
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <!-- 运费弹窗 -->
    <div class="table-content m-t-30 clearfix" id="layer-logistics" style="display: none;">
        <form class="form-horizontal">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="fee" class="col-sm-4 control-label">
                        <span class="ng-binding">物流配送费：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="fee" class="form-control ipt m-r-10" name="fee">
                            元，是否进行发货？
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /运费弹窗 -->
    <script type="text/javascript">
        //
    </script>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}"></script>
    <script type="text/javascript">
        //
    </script>
    <!-- 引入地区三级联动js -->
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>

        @if($info['countdown'] > 0)
            $(document).ready(function() {
                $("#counter").countdown({
                    // 时间间隔
                    time: "{{ $info['countdown']*1000 }}",
                    leadingZero: true,
                    onComplete: function(event) {
                        $(this).html("已超时！");
                        // 超时事件，预留
                        $.ajax({
                            type: 'GET',
                            url: '/trade/order/cancel-sys',
                            data: {
                                order_id: '{{ $info['order_id'] }}'
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.code == 0)
                                {
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
            });
        @endif

        var map;
        //
        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                var oid = null;
                var url = '/trade/order/edit-order.html';
                var shop_address_count = "1";
                var print = false;
                if(type == "take-print"){
                    type = "take";
                    print = true;
                }
                title = width = '';
                if (type == 'order') {
                    title = "修改订单价格";
                    width = 860;
                }
                else if (type == 'delivery') {
                    if(shop_address_count == 0) {
                        $.msg("请先前往交易设置->发/退货地址库维护发货地址，再进行发货！");
                        return false;
                    }
                    title = "拆单发货";
                    width = 840;
                }
                else if (type == 'delay') {
                    title = "延长收货时间";
                }
                else if (type == 'close') {
                    title = "关闭订单";
                }
                else if (type == 'assign') {
                    title = "订单指派";
                    width = 800;
                }
                else if (type == 'address') {
                    title = "收货人信息";
                    width = '720px';
                    height = '430px';
                    url = "/trade/delivery/edit-order";
                    oid = id;
                    id = '';
                }
                if(type == "take"){
                    // 接单
                    $.post("/trade/order/edit-order.html", {
                        type: type,
                        id: id
                    }, function(result){
                        if(result.code == 0){
                            $.msg(result.message, {
                                time: 1000
                            }, function(){
                                // 打印订单
                                if(print){
                                    $.alert("是否立即打印订单！", {
                                        btn: ['去打印', '取消'],
                                        // 关闭刷新当前页面
                                        end: function(){
                                            $.go();
                                        }
                                    }, function(){
                                        $.go('/trade/order/print.html?id=' + id, "_blank");
                                    });
                                }else{
                                    $.go();
                                }
                            });
                        }else{
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                        console.info(result);
                    }, "JSON");
                }else{
                    if ($.modal($(this))) {
                        $.modal($(this)).show();
                    } else {
                        $.modal({
                            // 标题
                            title: title,
                            trigger: $(this),
                            width: width,
                            // ajax加载的设置
                            ajax: {
                                url: url,
                                data: {
                                    type: type,
                                    id: id,
                                    oid: oid,
                                    from: "order-info"
                                }
                            },
                        });
                    }
                }
            });
            // 审核
            $("body").on("click", ".audit", function() {
                var id = $(this).data("id");
                $.open({
                    title: "审核取消订单申请",
                    ajax: {
                        url: '/trade/order/audit',
                        data: {
                            id: id
                        }
                    },
                    width: "600px",
                    btn: ['确定', '取消'],
                    yes: function(index, container) {
                        var data = $(container).serializeJson();
                        var order_cancel = $("input[name='order_cancel']:checked").val();
                        var refuse_reason = $("#refuse_reason").val().trim();
                        if (order_cancel == "3") {
                            $("#error").hide();
                            $("#error2").hide();
                            if (refuse_reason == "") {
                                $("#error").show();
                                return;
                            } else if (refuse_reason.length > 200) {
                                $("#error2").show();
                                return;
                            }
                        }
                        $.loading.start();
                        $.post('/trade/order/audit', data, function(result) {
                            if (result.code == 0) {
                                layer.close(index);
                                $.msg(result.message, function(){
                                    parent.location.reload();
                                });
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }, "json").always(function(){
                            $.loading.stop();
                        });
                    }
                });
            });
            // 核销
            $("body").on("click", ".revision", function() {
                var buy_type  = $(this).data('buy_type');
                var order_id = $(this).data('order_id');
                var url = '/trade/order/revision';
                $.confirm("一键核销会强制核销订单，请确认好订单信息后使用此功能", function() {
                    $.confirm("你确定要核销此订单吗？", function() {
                        $.loading.start();
                        $.post(url, {
                            order_id: order_id,
                            buy_type: buy_type
                        }, function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, function(){
                                    window.location.reload();
                                });
                            } else {
                                $.msg(result.message);
                            }
                        }, 'json').always(function(){
                            $.loading.stop();
                        });
                    });
                });
            });
        });
        function getReceived(order_id)
        {
            layer.confirm('请确认收到货款后，再点击收到货款！否则您可能钱货两空！',function(){
                $.loading.start();
                $.post('/trade/order/edit-order', {
                    id: order_id,
                    type: 'received',
                }, function(result) {
                    $.msg(result.message, function(){
                        if (result.code == 0) {
                            $.go("/trade/order/info?id=" + "{{ $info['order_id'] }}");
                        }
                    });
                }, 'json').always(function(){
                    $.loading.stop();
                });
            });
        }
        function assignCancel(order_id){
            $.loading.start();
            layer.confirm('确定要取消此派单吗？',function(){
                $.post('/trade/order/assign-cancel', {
                    id: order_id,
                }, function(result) {
                    $.msg(result.message, function(){
                        if (result.code == 0) {
                            $.go("/trade/order/info?id=" + "{{ $info['order_id'] }}");
                        }
                    });
                }, 'json').always(function(){
                    $.loading.stop();
                });
            });
        }
        $("#btn_print").click(function(){
            var order_id = "{{ $info['order_id'] }}";
            $.go('/trade/order/print.html?id=' + order_id, '_blank');
        });
        $("#btn_upload_hisense").click(function(){
            var order_id = "{{ $info['order_id'] }}";
            $.post('/trade/order/upload-hisense', {
                id: order_id,
            }, function(result) {
                $.msg(result.message, function(){
                    if (result.code == 0) {
                        // $.go("/trade/order/info?id=" + "{{ $info['order_id'] }}");
                    }
                });
            }, 'json').always(function(){
                $.loading.stop();
            });
        });
        // 发货单tab切换事件
        $('#logistics').find('.tab').on('click', 'li', function() {
            var that = $(this);
            // 当前的索引值 从1 开始
            var idx = (that.index()) + 1;
            // 获取当前map 区域
            var $obj = $('#texpress' + idx).find('.express-log').nextAll('.map_'+ idx);
            // 获取发货单编号
            var sn = that.find('a').data('sn');
            // 获取当前tab中发货单的状态 如果是已发货不再显示
            var status = $obj.data('status');
            if ($obj.length == 1 && status != 1)
            {
                // 如果地图已经被打开则不再重复打开操作
                if ($obj.is(":visible"))
                {
                    return;
                }
                var $nowContainer = $('#container_'+idx);
                // 达达物流
                if ($nowContainer.hasClass('dada'))
                {
                    /**
                     var delivery_lon = $nowContainer.data('lng');
                     var delivery_lat = $nowContainer.data('lat');
                     var position = [];
                     position.push((parseFloat(delivery_lon).toFixed(6)));
                     position.push((parseFloat(delivery_lat).toFixed(6)));
                     //加载地图
                     map = new AMap.Map('container_' + idx, {
                    resizeEnable: true,
                    zoom: 16
                });
                     var img_src = "/assets/d2eace91/images/common/map-postmen-r.png";
                     // 快递员标注marker
                     marker = new AMap.Marker({
                    map: map,
                    position: position,
                    offset: new AMap.Pixel(    -37, -83),
                    icon: new AMap.Icon({
                        size: new AMap.Size(63, 81),  //图标大小
                        image: img_src,
                    })
                })
                     map.panTo(position);
                     // 显示地图区域
                     $obj.show();
                     **/
                }
                else
                {
                    // 加载数据
                    $.get('/trade/order/postmen-info.html', {
                        delivery_sn: sn
                    }, function(data) {
                        if ( 0 == data.code)
                        {
                            // 快递员坐标
                            var delivery_point = data.data.deliver_point;
                            var delivery_arr = delivery_point.split(',');
                            var delivery_lon = parseFloat(delivery_arr[0]);
                            var delivery_lat = parseFloat(delivery_arr[1]);
                            // 快递员坐标成数组参数
                            var position = [];
                            position.push(delivery_lon);
                            position.push(delivery_lat);
                            // 收货坐标
                            var end_lon = (parseFloat(data.data.end_longitude)).toFixed(6);
                            var end_lat = (parseFloat(data.data.end_latitude)).toFixed(6);
                            // 定义一个坐标点
                            var lnglatXY = new AMap.LngLat(delivery_lon, delivery_lat);
                            var geolocation, marker;
                            //加载地图
                            map = new AMap.Map('container_' + idx, {
                                resizeEnable: true,
                                zoom: 16
                            });
                            // 加载缩放条
                            map.plugin(["AMap.ToolBar"], function() {
                                map.addControl(new AMap.ToolBar());
                            });
                            // 快递员的方位图 人朝向左/人朝向右
                            var img_src = "/assets/d2eace91/images/common/map-postmen-r.png";
                            if (delivery_lon > end_lon) {
                                img_src = "/assets/d2eace91/images/common/map-postmen-l.png";
                            }
                            // 快递员标注marker
                            marker = new AMap.Marker({
                                map: map,
                                position: position,
                                offset: new AMap.Pixel(    -37, -83),
                                icon: new AMap.Icon({
                                    size: new AMap.Size(63, 81),  //图标大小
                                    image: img_src,
                                })
                            })
                            // 送货点
                            var lnglat = new AMap.LngLat(end_lon, end_lat);
                            // 地图平移到快递员的位置
                            map.panTo(position);
                            var distance;
                            var unit;
                            // 查看嗖嗖物流是否传递距离
                            if (data.data.deliver_distance.code == 0) {
                                distance = data.data.deliver_distance.distance;
                                unit = 'km';
                            } else {
                                unit = 'm';
                                distance = Math.round(lnglat.distance(position));
                            }
                            // 顶部tip距离提示
                            openInfo(distance, unit);
                            // 在指定位置打开信息窗体
                            // @params distance 距离
                            // @params unit 单位 m/km
                            function openInfo(distance, unit) {
                                unit = unit || 'm';
                                //实例化信息窗体
                                content = "距离收货地址<span style='font-weight: bold; color: #d97a4a; padding-left: 3px;'>"+ distance + unit + "</span>";
                                var infoWindow = new AMap.InfoWindow({
                                    isCustom: true,  //使用自定义窗体
                                    content: createInfoWindow(content),
                                    offset: new AMap.Pixel(0, -90)
                                });
                                infoWindow.open(map, marker.getPosition());
                                //构建自定义信息窗体
                                function createInfoWindow( content) {
                                    var info = document.createElement("div");
                                    info.className = 'm-map-tip';
                                    info.style.backgroundColor = 'rgba(255, 255, 255, .9)';
                                    info.style.padding= '2px 5px';
                                    info.style.borderRadius= '3px';
                                    info.style.fontFamily = 'Microsoft Yahei';
                                    info.style.position = 'relative';
                                    info.innerHTML = content;
                                    return info;
                                }
                            }
                            // 显示地图区域
                            $obj.show();
                        }
                    }, 'JSON');
                }
            }
        });
        $("body").on("click", ".quick-delivery", function() {
            var shop_address_count = "1";
            var id = $(this).data("id");
            if(shop_address_count > 0) {
                // 判断是否对接物流
                $.loading.start();
                var calculate_url = '/trade/order/calculate-order-freight-price.html?order_id=' + id;
                // 计算订单价格
                $.get(calculate_url, function(res) {
                    if (res.code == 0)
                    {
                        var is_no_use = res.no_use;
                        if (is_no_use != 1) {
                            var price = res.data;
                            // 1 可以修改 - 0 不可修改
                            var writable = res.is_update_price
                            // 写入运费
                            var $fee = $('#fee');
                            $fee.val(price);
                            // 是否可以编辑
                            $fee.attr('readonly', (0 == writable));
                            $.open({
                                type: 1,
                                width: "500px",
                                title: "信息",
                                content: $('#layer-logistics'),
                                btn: ['确定', '取消'],
                                yes: function(index, object) {
                                    // 校验运费
                                    var fee = $.trim($fee.val());
                                    // 计算运费的价格
                                    var pattern = /^([1-9]\d*|0)(\.\d{1,2})?$/;
                                    if (!pattern.test(fee)) {
                                        $.tips('请输入正确的运费', $fee);
                                        return false;
                                    }
                                    $.go("/trade/order/quick-delivery.html?order_id="+id+'&price=' + fee);
                                }
                            });
                        } else {
                            $.go("/trade/order/quick-delivery.html?order_id="+id);
                        }
                    } else {
                        $.alert('一键发货失败，请稍后重试或者拆单发货');
                    }
                }, 'JSON').always(function () {
                    $.loading.stop();
                });
            } else {
                $.msg("请先前往交易设置->发/退货地址库维护发货地址，再进行发货！");
            }
        });
        // 页面初始化加载一个tab下的地图
        $('#logistics .tab li:first').trigger('click');
        //
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
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
