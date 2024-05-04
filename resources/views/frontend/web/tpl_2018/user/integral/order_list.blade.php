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
            <span class="user-statu">
                <a href="/user/integral/detail.html">
                    <span>积分明细</span>
                    <span class="vertical-line">|</span>
                </a>
            </span>
                    <span class="user-statu active" class="color">
                <a href="javascript:void(0)">
                    <span>积分兑换</span>
                </a>
            </span>
                </div>
            </div>
            <div class="content-info">
                <div class="content-list order-list">
                    <form id="searchForm" name="searchForm" action="/user/integral/order-list.html" method="GET">            <div class="content-search order-search"></div>
                        <div class="order-screen-term">
                            <label style="width: 30%;">
                                <span>商品名称/兑换单号：</span>
                                <input type="text" id="name" class="form-control" name="name" placeholder="输入兑换商品名称/兑换单号">
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
                            <label style="width: 10%;">
                                <input type="submit" value="搜索" class="search" id="searchFormSubmit" />
                            </label>
                        </div>
                    </form>

                    @include('user.integral.partials._order_list')

                </div>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
		<script type="text/javascript">
			window._AMapSecurityConfig = {
				securityJsCode: "{{ sysconf('amap_js_security_code') }}",
			};
		</script>
        <script type="text/javascript" src="//webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
        <script type="text/javascript">
            //
        </script>
    </div>


@stop

{{--底部js--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=1.1"></script>
    <script src="/js/common.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/js/placeholder.js?v=1.1"></script>
    <script src="/js/user.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/common.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/message.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/messageWS.js?v=1.1"></script>
    <script>
        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
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
                            url: '/user/integral/edit-order.html?from=list',
                            data: {
                                type: type,
                                id: id,
                            }
                        },
                    });
                }
            });
        });
        //
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
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
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
        function order_delete(order_id, type)
        {
            var text = "";
            var is_exchange = "";
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
            var is_exchange = "";
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
        //
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $().ready(function() {
            $('.site_to_yikf').click(function() {
                $(this).parent('form').submit();
            })
        });
        //
        $().ready(function() {
        })
        //
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
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
