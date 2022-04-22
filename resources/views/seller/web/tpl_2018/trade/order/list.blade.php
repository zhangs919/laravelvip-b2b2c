{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190319"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20190319"/>
    <!-- 日历控件-->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20190319"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190319"></script>
    <!-- -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/jquery.base64.js?v=20190319"></script>
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/trade/order/list.html" method="GET">
            <input type="hidden" id="uid" class="form-control" name="uid">

            <input type="hidden" id="buy_type" class="form-control" name="buy_type" value="0">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>

                    <div class="form-control-wrap"><input type="text" id="name" class="form-control w180" name="name" placeholder="商品名称/订单编号/买家账号"></div>

                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="order_status" class="form-control" name="order_status">
                            <option value="">全部</option>
                            <option value="unpayed">等待买家付款</option>
                            <option value="unshipped">待发货未指派</option>
                            <option value="assign">待发货已指派</option>
                            <option value="shipped_part">发货中</option>
                            <option value="shipped">已发货</option>
                            <option value="finished">交易成功</option>
                            <option value="closed">交易关闭</option>
                            <option value="backing">退款中的订单</option>
                            <option value="cancel">取消订单申请</option>
                        </select></div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>下单时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="add_time_begin" class="form-control form_datetime ipt" name="add_time_begin" value="2019-02-19" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="add_time_end" class="form-control form_datetime ipt" name="add_time_end" placeholder="结束时间">
                    </div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>评价状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="evaluate_status" class="form-control" name="evaluate_status">
                            <option value="">全部</option>
                            <option value="unevaluate">待评价</option>
                            <option value="evaluate">已评价</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>付款方式：</span>
                    </label>
                    <div class="form-control-wrap"><select id="pay_type" class="form-control" name="pay_type">
                            <option value="">全部</option>
                            <option value="alipay">支付宝</option>
                            <option value="union">银联支付</option>
                            <option value="weixin">微信支付</option>
                            <option value="balance">余额支付</option>
                            <option value="cod">货到付款</option>
                            <option value="store_card">店铺购物卡</option>
                        </select></div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>售后服务：</span>
                    </label>
                    <div class="form-control-wrap"><select id="service_type" class="form-control" name="service_type">
                            <option value="">全部</option>
                            <option value="refunding">退款中</option>
                            <option value="replacement">换货中</option>
                            <option value="repairing">维修中</option>
                        </select></div>
                </div>
            </div>



            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>配送方式：</span>
                    </label>
                    <div class="form-control-wrap"><select id="pickup" class="form-control" name="pickup">
                            <option value="0">全部</option>
                            <option value="1">普通快递</option>
                            <option value="2">上门自提</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单类型：</span>
                    </label>
                    <div class="form-control-wrap"><select id="order_type" class="form-control" name="order_type">
                            <option value="">全部</option>
                            <option value="0">普通订单</option>
                            <option value="2">预售订单</option>
                            <option value="6">拼团订单</option>
                            <option value="8">砍价订单</option>
                            <option value="3">团购订单</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>会员绑定手机号：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="user_mobile" class="form-control" name="user_mobile" placeholder=""></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>收货人姓名：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="consignee_name" class="form-control" name="consignee_name" placeholder=""></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>收货人手机号：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="consignee_mobile" class="form-control" name="consignee_mobile" placeholder=""></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>收货人地址：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="consignee_address" class="form-control" name="consignee_address" placeholder=""></div>
                </div>
            </div>



            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>


                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />



                <a id="searchMore" class="btn-link">更多筛选条件</a>

            </div>
        </form>
    </div>


    {{--引入列表--}}
    @include('trade.order.partials._list')


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
                            <input type="text" id="fee" class="form-control ipt m-r-10" name="fee">元，是否进行发货？
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /运费弹窗 -->
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190319"></script>
    <!-- 引入地区三级联动js -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20190319"></script>
    <script type="text/javascript">
        //悬浮显示上下步骤按钮
        window.onscroll = function() {
            $(window).scroll(function() {
                var scrollTop = $(document).scrollTop();
                var height = $(".page").height();
                var wHeight = $(window).height();
                if (scrollTop > (height - wHeight)) {
                    $("#order-item-page").removeClass("order-page-fixed");
                } else {
                    $("#order-item-page").addClass("order-page-fixed");
                }
            });

        };
    </script>
    <script type="text/javascript">
        var tablelist = null;
        var buy_type = '0';

        $().ready(function() {

            // 下拉框选中
            $("#order_status").val("");

            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });

            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // console.info(data);
                // Ajax加载数据
                tablelist.load(data);

                // 阻止表单提交
                return false;
            });

            $("#btn_export").click(function() {
                var url = "/trade/order/export.html";
                url += "?name=" + $("#name").val();
                url += "&order_status=" + $("#order_status").val();
                url += "&evaluate_status=" + $("#evaluate_status").val();
                url += "&pay_type=" + $("#pay_type").val();
                url += "&add_time_begin=" + $("#add_time_begin").val();
                url += "&add_time_end=" + $("#add_time_end").val();

                var service_type = $("#service_type").val();
                var pickup = $("#pickup").val();
                var user_mobile = $("#user_mobile").val();
                var consignee_name = $("#consignee_name").val();
                var consignee_mobile = $("#consignee_mobile").val();
                var consignee_address = $("#consignee_address").val();
                if (service_type != undefined) {
                    url += "&service_type=" + $("#service_type").val();
                }
                if (user_mobile != undefined) {
                    url += "&pickup=" + $("#pickup").val();
                }
                if (user_mobile != undefined) {
                    url += "&user_mobile=" + $("#user_mobile").val();
                }
                if (consignee_name != undefined) {
                    url += "&consignee_name=" + $("#consignee_name").val();
                }
                if (consignee_mobile != undefined) {
                    url += "&consignee_mobile=" + $("#consignee_mobile").val();
                }
                if (consignee_address != undefined) {
                    url += "&consignee_address=" + $("#consignee_address").val();
                }
                url += "&buy_type=0";

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }

                $.go('/site/export?url=' + encodeURIComponent($.base64.encode(url)) + '&title=导出订单列表', '_blank', false);
            });
        });

        // 

        function getReceived(order_id) {
            // 批量收到货款
            if(order_id == 0) {
                var order_ids = document.getElementsByName("order_id_box");
                var order_id = "";

                for (var i = 0; i < order_ids.length; i++) {
                    if (order_ids[i].checked == true) {
                        order_id += order_ids[i].value + ",";
                    }
                }

                order_id = order_id.slice(0, -1);

                if (order_id.length <= 0) {
                    $.msg("请勾选订单！");
                    return;
                }
            }

            layer.confirm('请确认收到货款后，再点击收到货款！否则您可能钱货两空！', function() {
                $.loading.start();
                $.post('/trade/order/edit-order', {
                    id: order_id,
                    type: 'received',
                }, function(result) {
                    $.msg(result.message, function(){
                        if (result.code == 0) {
                            $.go("/trade/order/list.html");
                        }
                    });
                }, 'json').always(function(){
                    $.loading.stop();
                });
            });
        }

        // 

        function assignCancel(order_id) {
            layer.confirm('确定要取消此派单吗？', function() {
                $.post('/trade/order/assign-cancel', {
                    id: order_id,
                }, function(result) {
                    $.msg(result.message, {
                        time: 1500
                    }, function(){
                        if (result.code == 0) {
                            if(tablelist){
                                tablelist.load();
                            }else{
                                $.go("/trade/order/list.html");
                            }
                        }
                    });
                }, 'json');
            });
        }

        function order_print(order_id) {
            $.go('/trade/order/print.html?id=' + order_id, '_blank');
        }

        function prePage() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
            tablelist.prePage();
        }

        function nextPage() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
            tablelist.nextPage();
        }

        $("body").on("click", ".edit-order", function() {
            var shop_address_count = "1";
            var type = $(this).data("type");
            var id = $(this).data("id");
            var from = 'list';
            var print = false;
            if(type == "take-print"){
                type = "take";
                print = true;
            }

            title = width = '';
            if (type == 'order') {
                title = "修改订单价格";
                width = 860;

            } else if (type == 'delivery') {
                if(shop_address_count == 0) {
                    $.msg("请先前往交易设置->发/退货地址库维护发货地址，再进行发货！");
                    return false;
                }
                title = "发货";
                width = 840;

            } else if (type == 'delay') {
                title = "延长收货时间";

            } else if (type == 'close') {
                title = "关闭订单";

            } else if (type == 'assign') {
                title = "指派订单";
                width = 800;
            }
            if(type == "take"){
                // 接单
                $.post("/trade/order/edit-order.html?from="+from, {
                    type: type,
                    id: id
                }, function(result){
                    if(result.code == 0){
                        $.msg(result.message, {
                            time: 1000
                        }, function(){
                            // 打印订单
                            if(print){
                                tablelist.load({
                                    params: $("#searchForm").serializeJson(),
                                }, {
                                    callback: function(){
                                        $.alert("是否立即打印订单！", {
                                            btn: ['去打印', '取消']
                                        }, function(){
                                            $.go('/trade/order/print.html?id=' + id, '_blank');
                                        });
                                    }
                                });
                            }else{
                                tablelist.load();
                            }
                        });
                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON");
            }else{
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {

                    $.loading.start();

                    $.modal({
                        // 标题  
                        title: title,
                        trigger: $(this),
                        width: width,
                        // ajax加载的设置  
                        ajax: {
                            url: '/trade/order/edit-order.html?from=' + from,
                            data: {
                                type: type,
                                id: id
                            }
                        },
                    });
                }
            }
        });

        $("body").on("click", ".edit-address", function() {
            var id = $(this).data("id");
            // 加载
            $.loading.start();

            $.open({
                title: "收货人信息",
                ajax: {
                    url: '/trade/delivery/edit-order',
                    data: {
                        type: "address",
                        oid: id,
                        from: "order-list"
                    }
                },
                width: "720px",
                height: "430px",
                btn: ['确定', '取消'],
                success: function(){
                    $.loading.stop();
                },
                yes: function(index, container) {

                    var data = $(container).serializeJson();

                    $.loading.start();

                    $.post('/trade/delivery/edit-order', data, function(result) {
                        if (result.code == 0) {
                            tablelist.load({
                                order_status: ""
                            });
                            $.msg(result.message, {
                                time: 1500
                            }, function(){
                                layer.close(index);
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json").always(function(){
                        $.loading.stop();
                    });
                }
            });
        });

        function batch_print() {
            var order_ids = document.getElementsByName("order_id_box");
            var order_id = "";

            for (var i = 0; i < order_ids.length; i++) {
                if (order_ids[i].checked == true) {
                    order_id += order_ids[i].value + ",";
                }
            }

            order_id = order_id.slice(0, -1);

            if (order_id.length <= 0) {
                $.msg("请勾选待打印订单！");
                return false;
            }

            $.go('/trade/order/print.html?id=' + order_id, '_blank');
        }

        function batch_delivery(type) {
            var order_ids = document.getElementsByName("order_id_box");
            var order_id = "";
            var order_ids = document.getElementsByName("order_id_box");
            var order_id = "";

            for (var i = 0; i < order_ids.length; i++) {
                if (order_ids[i].checked == true) {
                    order_id += order_ids[i].value + ",";
                }
            }

            var shop_address_count = "1";
            if(shop_address_count == 0) {
                $.msg("请先前往交易设置->发/退货地址库维护发货地址，再进行发货！");
                return false;
            }

            order_id = order_id.slice(0, -1);

            if (order_id.length <= 0) {
                $.msg("请勾选发货订单！");
                return false;
            }

            $.go('/trade/order/batch-delivery.html?id=' + order_id + '&type=' + type);
        }
        // 批量接单
        function batch_take(){

            var order_ids = [];

            $(".table-list-checkbox").each(function(){
                if($(this).is(":checked")){
                    order_ids.push($(this).val());
                }
            });

            if(order_ids.length == 0){
                $.msg("请选择您要批量处理订单！");
                return;
            }

            var ids = order_ids.join(",");

            $.loading.start();

            // 接单
            $.post("/trade/order/batch-take.html", {
                ids: ids
            }, function(result){
                if(result.code == 0){
                    $.msg(result.message, {
                        time: 1000
                    }, function(){
                        tablelist.load();
                    });
                }else{
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON").always(function(){
                $.loading.stop();
            });
        }
    </script>

    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20190319"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=20190319"></script>
    <script type='text/javascript'>
        (function($) {
            $(window).load(function() {
                $(".edit-table ul").mCustomScrollbar();
            });
        })(jQuery);

        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2, // 精确度：默认为时分秒，2：年月日
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd',
        });

        $('#add_time_begin').datetimepicker().on('changeDate', function(ev) {
            $('#add_time_end').datetimepicker('setStartDate', ev.date);
        });
        $('#add_time_end').datetimepicker().on('changeDate', function(ev) {
            $('#add_time_begin').datetimepicker('setEndDate', ev.date);
        });

        // 备注
        $("body").on("click", "#remark", function() {
            var id = $(this).data("id");
            var tablelist = $("#table_list").tablelist();
            $.open({
                title: "备注",
                ajax: {
                    url: '/trade/order/remark',
                    data: {
                        id: id
                    }
                },
                width: "600px",
                btn: ['确定', '取消'],
                yes: function(index, container) {

                    var data = $(container).serializeJson();
                    var value = $("#shop_remark").val().trim();
                    if (value == "") {
                        $("#error").show();
                        return;
                    }
                    $.loading.start();
                    $.post('/trade/order/remark', data, function(result) {
                        if (result.code == 0) {
                            layer.close(index);
                            $.msg(result.message, function(){
                                tablelist.load({
                                    order_status: ""
                                });
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

        // 审核
        $("body").on("click", ".audit", function() {
            var id = $(this).data("id");

            $.open({
                title: "审核取消订单申请",
                ajax: {
                    url: '/trade/order/audit.html?buy_type=' + buy_type,
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

                    $.post('/trade/order/audit.html', data, function(result) {
                        if (result.code == 0) {

                            layer.close(index);

                            $.msg(result.message, {
                                time: 1500
                            }, function(){
                                tablelist.load({
                                    order_status: ""
                                });
                            });
                        } else {
                            layer.close(index);
                            $.msg(result.message, {
                                time: 5000
                            }, function(){
                                tablelist.load({
                                    order_status: ""
                                });
                            });
                        }
                    }, "json").always(function(){
                        $.loading.stop();
                    });
                }
            });
        });

        // 核销
        $("body").on("click", ".revision", function() {
            var buy_type = $(this).data('buy_type');
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

        $("body").on("click", ".quick-delivery", function() {
            var shop_address_count = "1";
            var id = $(this).data("id");
            if(shop_address_count > 0) {
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
                                        $.msg('请输入正确的运费');
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
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop