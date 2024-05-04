{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

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

    <!-- 订单详情信息 -->
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
                        </script>
                    @endif

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
                    <li class="operate-prompt">
                        @foreach(format_order_status_reminder($info['order_status'],$info['shipping_status'], $info['pay_status'],$info['close_reason'], 1) as $reminderMsg)
                            <p>{!! $reminderMsg !!}</p>
                        @endforeach
                    </li>

                </ul>
            </div>
        </div>
        <!--下单时间等-->
        <div class="order-infor">
            <h3>
                商家：
                <span title="{{ $info['shop_name'] }}">{{ $info['shop_name'] }}</span>
            </h3>
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
                    <dd>{{ $info['pay_name'] }} </dd>
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
                            <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情">
                        </a>
                    </div>
                    <div class="txt-info">
                        <div class="desc m-b-5">
                            <a class="goods-name" href="{{ route('pc_show_goods', ['goods_id'=>$goods['goods_id']]) }}" target="_blank" title="查看商品详情">

                                {{ $goods['goods_name'] }}
                            </a>
                            <!-- <a class="snap">【交易快照】</a> -->
                        </div>

                        {{--商品活动标识--}}
                        @if($goods['goods_type'] > 0)
                            <div class="goods-active {{ format_order_goods_type($goods['goods_type'],1) }}">
                                <a>{{ format_order_goods_type($goods['goods_type']) }}</a>
                            </div>
                        @endif


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


            <p>
                <span>订单总金额：￥{{ $info['order_amount'] }}</span>
                <em class="operator">-</em>
                <span>余额：￥{{ $info['surplus'] }}</span>
                <em class="operator">=</em>
                <span class="order-amount">
					<strong>待付款金额：￥{{ $info['money_paid'] }}</strong>
				</span>
            </p>


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
    <script> var map; </script>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}"></script>
    <script type="text/javascript">

        // 发货单tab切换事件
        $('#logistics').find('.tab').on('click', 'li', function() {
            var that = $(this);
            var idx = (that.index()) + 1;
            var $obj = $('#texpress' + idx).find('.express-log').nextAll('.map_'+ idx);
            var sn = that.find('a').data('sn');
            var shop = that.find('a').data('shop');
            if ($obj.length == 1)
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
                        offset: new AMap.Pixel(	-37, -83),
                        icon: new AMap.Icon({
                            size: new AMap.Size(63, 81),  //图标大小
                            image: img_src,
                        })
                    })
                    map.panTo(position);
                    // 显示地图区域
                    $obj.show();
                }
                else // 众包/指派
                {
                    // 加载数据
                    $.get('/trade/order/postmen-info.html', {
                        delivery_sn: sn,
                        shop_id: shop
                    }, function(data) {
                        if ( 0 == data.code && data.data && data.data.deliver_point && data.data.receive_point)
                        {
                            console.log(data.data.deliver_point)
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
                            var end_point = data.data.receive_point;
                            console.log(end_point)
                            var end_arr = end_point.split(',');
                            console.log(end_arr)
                            var end_lon = (parseFloat(end_arr[0])).toFixed(6);
                            var end_lat = (parseFloat(end_arr[1])).toFixed(6);

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
                                offset: new AMap.Pixel(	-37, -83),
                                icon: new AMap.Icon({
                                    size: new AMap.Size(63, 81),  //图标大小
                                    image: img_src,
                                })
                            })

                            // 送货点
                            var lnglat = new AMap.LngLat(end_lon, end_lat);
                            // 地图平移到快递员的位置
                            map.panTo(position);
                            // 快递员位置距离送货点的距离
                            var distance = Math.round(lnglat.distance(position));
                            // 顶部tip距离提示
                            openInfo(distance);

                            // 在指定位置打开信息窗体
                            function openInfo(distance) {
                                //实例化信息窗体
                                content = "距离商家<span style='font-weight: bold; color: #d97a4a; padding-left: 3px;'>"+ distance +"m</span>";
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
        // 页面初始化加载一个tab下的地图
        $('#logistics .tab li:first').trigger('click');
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
