{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190319"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190319"/>
@stop

{{--content--}}
@section('content')

    <!--步骤-->
    <div class="order-step">
        <!--完成步骤为dl添加current样式，完成操作内容后会显示完成时间-->
        <dl class="current step-first">
            <dt>下单时间</dt>
            <dd class="bg"></dd>
            <dd class="date" title="">{{ $info['created_at'] }}</dd>
        </dl>
        <dl class="current">
            <dt>关闭时间</dt>
            <dd class="bg"></dd>
            <dd class="date" title="">{{ format_time($info['end_time']) }}</dd>
        </dl>
    </div>


    <!--订单详情信息-->
    <div class="order-info m-b-10">
        <!--操作部分-->
        <div class="order-handle">
            <div class="order-operate">
                <ul>
                    <li class="operate-steps">
                        <i class="fa fa-check-circle-o"></i>
                        <span>当前订单状态：交易关闭</span>
                    </li>

                    <!-- 待付款 -->

                    <!-- 买家已付款，卖家待接单 -->


                    <!-- 买家已付款，待发货 -->

                    <!-- 待收货 -->
                    <li class="operate-button">
























                    </li>
                    <li class="operate-prompt">






                        <p>

                            关闭类型：系统取消订单

                        </p>
                        <p>关闭原因：订单超时未支付，系统自动取消订单!</p>
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

                <dl>
                    <dt>
                        <span>下单时间：</span>
                    </dt>
                    <dd>
                        <span>{{ format_time($info['add_time']) }}</span>
                    </dd>
                </dl>


                <dl>
                    <dt>
                        <span>关闭时间：</span>
                    </dt>
                    <dd>
                        <span>{{ format_time($info['end_time']) }}</span>
                    </dd>
                </dl>

            </div>
        </div>



        <!--订单信息-->
        <div class="order-details">
            <div class="title">订单信息</div>
            <div class="content">

                <dl>
                    <!---->
                    <dt>&nbsp;收&nbsp;货&nbsp;人：</dt>
                    <dd>{{ $info['consignee'] }}，{{ $info['tel'] }}， {{ $info['region_name'] }} {{ $info['address'] }}</dd>
                    <!---->
                </dl>


                <dl>
                    <dt>支付方式：</dt>
                    <dd>{{ $info['pay_name'] }} </dd>
                </dl>



                <dl>
                    <dt>配送时间：</dt>
                    <dd>无</dd>
                </dl>


                <dl>
                    <dt>配送方式：</dt>
                    <!---->
                    <dd>普通快递（ 免邮 ）</dd>

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
                <th class="w200">商品</th>

                <th class="w100">商品条码</th>
                <th class="w100">属性</th>


                <th class="w70">单价（元）</th>

                <th class="w50">数量</th>


                <th class="w50">库存</th>

                <th class="w60 text-c">状态</th>

                <th class="w50">服务</th>
                <th class="w70">优惠</th>


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
                        @if($goods['goods_type'] == 3){{--团购商品--}}
                            <div class="goods-active group-buy">
                                <a>团购</a>
                            </div>
                        @elseif($goods['goods_type'] == 2){{--预售--}}
                            <div class="goods-active pre-sale">
                                <a>预售</a>
                            </div>
                        @elseif($goods['goods_type'] == 5){{--积分兑换--}}
                            <div class="goods-active exchange">
                                <a>积分兑换</a>
                            </div>
                        @elseif($goods['goods_type'] == 8){{--砍价--}}
                            <div class="goods-active bargain">
                                <a>砍价</a>
                            </div>
                        @else
                            {{--todo 其他活动标识--}}


                        @endif













                    </div>
                </td>

                <td>

                    {{ $goods['goods_barcode'] }}

                </td>
                <td class="order-type">
                    <div class="ng-binding order-type-info">
                        <span>{!! $goods['spec_info'] !!}</span>
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


                </td>


            </tr>
            @endforeach
            <!-- 订单满赠 -->
            </tbody>
        </table>
    </div>

    <div class="messageBox tfoot-info">
        <div class="address-info text-r">

            <p class="m-b-5">
                <span>商品总金额：￥48.9</span>

                <em class="operator">+</em>
                <span>运费：￥0</span>


                <em class="operator">-</em>
                <span>店铺红包：￥0</span>
                <em class="operator">-</em>
                <span>平台红包：￥5</span>


                <em class="operator">-</em>
                <span>卖家优惠：￥0</span>

                <em class="operator">=</em>
                <span>
					<strong>订单总金额：￥43.9</strong>
				</span>
            </p>


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


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script> var map; </script>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}"></script>
    <script type="text/javascript">
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
                    title = "订单指派网点";
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
                            $.go("/trade/order/info?id=" + '31');
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
                            $.go("/trade/order/info?id=" + '31');
                        }
                    });
                }, 'json').always(function(){
                    $.loading.stop();
                });
            });
        }

        $("#btn_print").click(function(){
            var order_id = "31";
            $.go('/trade/order/print.html?id=' + order_id, '_blank');
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
					offset: new AMap.Pixel(	-37, -83),
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
            if(shop_address_count > 0) {
                $.go("/trade/order/quick-delivery.html?order_id=31");
            } else {
                $.msg("请先前往交易设置->发/退货地址库维护发货地址，再进行发货！");
            }
        });

        // 页面初始化加载一个tab下的地图
        $('#logistics .tab li:first').trigger('click');
    </script>
    <link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=20190319"/>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20190319"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190319"></script>
    <!-- 引入地区三级联动js -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20190319"></script>
    <script type="text/javascript">
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
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop