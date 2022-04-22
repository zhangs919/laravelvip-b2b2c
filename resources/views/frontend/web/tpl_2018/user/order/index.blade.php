@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">

            <div class="tabmenu">
                <div class="user-status">
			<span class="user-statu active">
				<a id='order_all' class="tabs- color">
					<span>所有订单</span>
					<em class="tag-em">{{ $order_counts['all'] }}</em>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="user-statu">
				<a id='order_unpayed' class="tabs-">
					<span>待付款</span>
					<em class="tag-em">{{ $order_counts['unpayed'] }}</em>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="user-statu">
				<a id='order_unshipped' class="tabs-">
					<span>待发货</span>
					<em class="tag-em">{{ $order_counts['unshipped'] }}</em>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="user-statu">
				<a id='order_shipped' class="tabs-">
					<span>待收货</span>
					<em class="tag-em">{{ $order_counts['shipped'] }}</em>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="user-statu">
				<a id='order_unevaluate' class="tabs- tp-tag-a">
					<span>待评价</span>
					<em class="tag-em">{{ $order_counts['unevaluate'] }}</em>
				</a>
			</span>
                </div>
                <div class="user-tab-right">
                    <a href="/user/order/list.html?is_delete=1">订单回收站</a>
                </div>
            </div>

            <div class="content-info">
                <div class="content-list order-list">
                    <form id="searchForm" name="searchForm" action="/user/order.html" method="GET">
                        <div class="content-search order-search"></div>
                        <div class="order-screen-term">
                            <label style="width: 30%;">

                                <span>商品标题/订单号：</span>
                                <input type="text" id="name" class="form-control" name="name" placeholder="输入商品标题或订单号">

                            </label>
                            <label style="width: 30%;">
                                <span>交易状态：</span>
                                <span class="select">
                                    <select id="order_status" class="form-control" name="order_status">
                                        @foreach($order_status_list as $k=>$v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </label>
                            <label style="width: 30%;">
                                <span>成交时间：</span>
                                <span class="select">
                                    <select id="order_time" class="form-control" name="order_time">
                                        @foreach($order_time_list as $k=>$v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </label>

                            <label style="width: 30%;">
                                <span>物流方式：</span>
                                <span class="select">
                                    <select id="pickup" class="form-control" name="pickup">
                                        @foreach($pickup_list as $k=>$v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </label>
                            <label style="display: none">
                                <span>评价状态：</span>
                                <span class="select">
                                    <select id="evaluate_status" class="form-control" name="evaluate_status">
                                        @foreach($evaluate_status_list as $k=>$v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </label>

                            <label style="width: 10%;">
                                <input type="submit" value="搜索" class="search" id="searchFormSubmit" />
                            </label>
                        </div>
                    </form>



                    {{--引入列表--}}
                    @include('user.order.partials._list')


                </div>

                <div class="operat-tips">
                    <h4>订单注意事项</h4>
                    <ul class="operat-panel">
                        <li>
                            <span>下单后订单会为您保留1天，如1天内未付款，系统将自动取消您的订单</span>
                        </li>
                        </li>
                        <li>
                            <span>如买家下单后长时间未付款，卖家将有可能关闭您的订单</span>
                        </li>
                        <li>
                            <span>卖家发货后，“确认收货”倒计时自动开启，到期系统将自动确认收货，您可在小于三天时手动“延长收货时间”</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <script>
            $().ready(function() {
                $("body").on("click", ".edit-order", function() {
                    var type = $(this).data("type");
                    var id = $(this).data("id");
                    var is_exchange = "0";

                    title = '';
                    if (type == 'delay') {
                        title = "延长确认收货时间";
                    }
                    if (type == 'confirm') {
                        title = "确认收货";
                    }
                    if (type == 'cancel') {
                        title = "取消订单";
                    }

                    if ($.modal($(this))) {
                        $.modal($(this)).show();
                    } else {
                        $.modal({
                            // 标题
                            title: title,
                            trigger: $(this),
                            // ajax加载的设置
                            ajax: {
                                url: '/user/order/edit-order.html?from=list',
                                data: {
                                    type: type,
                                    id: id,
                                    is_exchange: is_exchange
                                }
                            },
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

            });

        </script>
        <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
        <script type="text/javascript">
            var tablelist = null;
            $().ready(function() {

                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson(),
                    callback: function(){
                        $.loading.stop();

                        if ($(".con-right").height() != $(".con-left").height()) {
                            $(".con-left").height($(".con-right").height());
                        }
                    }
                });

                $("#searchForm").submit(function() {
                    $.loading.start();

                    var is_exchange = "{{ $is_exchange }}";
                    if(!is_exchange) {
                        // 控制下方快速选择tab样式
                        if ($("#order_status").val() != '') {
                            $("a[class^='tabs-']").removeClass('color');
                            $("a[id='order_" + $("#order_status").val() + "']").addClass('color');
                            $(".user-statu").removeClass('active');
                            $("a[id='order_" + $("#order_status").val() + "']").parent(".user-statu").addClass('active');
                        } else if ($("#evaluate_status").val() == 'unevaluate') {
                            $("a[class^='tabs-']").removeClass('color');
                            $("a[id='order_unevaluate']").addClass('color');
                            $(".user-statu").removeClass('active');
                            $("a[id='order_unevaluate']").parent(".user-statu").addClass('active');
                        } else {
                            $("a[class^='tabs-']").removeClass('color');
                            $("a[id='order_all']").addClass('color');
                            $(".user-statu").removeClass('active');
                            $("a[id='order_all']").parent(".user-statu").addClass('active');
                        }
                    }

                    // 序列化表单为JSON对象
                    var data = $(this).serializeJson();
                    // Ajax加载数据
                    tablelist.load(data);
                    // 阻止表单提交
                    return false;
                });

            });

            $("#searchFormSubmit").click(function(){
                $("#searchForm").submit();
            });

            $("a[class^='tabs-']").click(function() {
                $.loading.start();

                $("a[class^='tabs-']").removeClass('color');
                $(".user-statu").removeClass('active');
                $(this).addClass('color');
                $(this).parent(".user-statu").addClass('active');

                if ($(this).attr("id") == "order_all")
                {
                    $("#order_status").val("");
                    $("#evaluate_status").val("");
                } else if ($(this).attr("id") == "order_unevaluate") {
                    $("#evaluate_status").val($(this).attr("id").substr(6));
                    $("#order_status").val("");
                } else {
                    $("#order_status").val($(this).attr("id").substr(6));
                    $("#evaluate_status").val("");
                }

                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson(),
                    callback: function(){
                        $.loading.stop();

                        if ($(".con-right").height() != $(".con-left").height()) {
                            $(".con-left").height($(".con-right").height());
                        }
                    }
                });
                tablelist.load();
            });

            function order_delete(order_id, type)
            {
                var text = "";
                var is_exchange = "{{ $is_exchange }}";
                var url = "/user/order/list.html?is_exchange=" + is_exchange;
                if (type == 2)
                {
                    text = "您确定要彻底删除该订单吗？";
                    url += "&is_delete=1";
                }
                else if (type == 1)
                {
                    text = "您确定要删除该订单吗？";
                }
                else
                {
                    text = "您确定要还原该订单吗？";
                    url += "&is_delete=1";
                }

                layer.alert(text, {
                    icon: 3,
                    skin: 'layer-ext-moon',
                    btn:['确定','取消']
                },function(){
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
                                $.go(url);
                            }
                        }
                    });
                },function(index){
                    layer.close(index);
                });
            }

            function order_deletes(type) {
                var order_ids = document.getElementsByName("order_delete");
                var order_id = new Array();
                var is_exchange = "{{ $is_exchange }}";

                for (var i = 0; i < order_ids.length; i++) {
                    if (order_ids[i].checked == true) {
                        order_id[i] = order_ids[i].value;
                    }
                }

                if (order_id.length <= 0) {
                    $.msg("请勾选待删除订单！");
                    return false;
                }

                $.loading.start();
                $.ajax({
                    type: 'POST',
                    url: '/user/order/delete.html',
                    data: {
                        order_id: order_id,
                        type: 3,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $.loading.stop();

                        var text = "";
                        var url = "/user/order/list.html?is_exchange=" + is_exchange;
                        if (type == 2)
                        {
                            text = "您确定要批量彻底删除这些订单吗？";
                            url += "&is_delete=1";
                        }
                        else if (type == 1)
                        {
                            text = data.message;
                        }
                        else
                        {
                            text = "您确定要批量还原这些订单吗？";
                            url += "&is_delete=1";
                        }

                        layer.alert(text, {
                            icon: 3,
                            skin: 'layer-ext-moon',
                            btn: ['确定','取消']
                        },function(index){
                            if (data.code == 0)
                            {
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

                                        if (data.code == 0)
                                        {
                                            $.go(url);
                                        }
                                        $.msg(data.message);
                                    }
                                });
                            }
                            else{
                                layer.close(index);
                            }
                        },function(index){
                            layer.close(index);
                        });
                    }
                });
            }
        </script>
        <script type="text/javascript">
            $().ready(function(){
                $(".pickup-address").click(function(){
                    var id = $(this).data("id");
                    $.loading.start();
                    $.open({
                        type: 1,
                        title: '自提点地址', //样式类名
                        area: ['702px', '445px'], //宽高
                        ajax: {
                            url: '/user/order/get-pickup-address',
                            data: {
                                id:id
                            },
                            function(result) {
                                $.loading.stop();
                            }

                        }
                    });
                });
            });
            //
        </script>
    </div>

@endsection