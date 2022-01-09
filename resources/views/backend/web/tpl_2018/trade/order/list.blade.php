{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <!-- 日历控件-->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
    <!-- -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/trade/order/list" method="GET">

            <input type="hidden" id="uid" class="form-control" name="uid">

            <input type="hidden" id="activity_id" class="form-control" name="activity_id">

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
                        <span>交易状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="order_status" class="form-control" name="order_status">
                            <option value="">全部</option>
                            <option value="unpayed">等待买家付款</option>
                            <option value="pending">待接单</option>
                            <option value="unshipped">待发货</option>
                            <option value="shipped">已发货</option>
                            <option value="backing">退款中的订单</option>
                            <option value="finished">交易成功</option>
                            <option value="closed">交易关闭</option>
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
                        <input type="text" id="add_time_begin" class="form-control form_datetime ipt pull-none" name="add_time_begin" value="2018-09-22" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="add_time_end" class="form-control form_datetime ipt pull-none" name="add_time_end" placeholder="结束时间">
                    </div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="shop_name" class="form-control" name="shop_name" placeholder="店铺名称"></div>
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
                    <div class="form-control-wrap"><input type="text" id="user_mobile" class="form-control w180" name="user_mobile" placeholder=""></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>收货人姓名：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="consignee_name" class="form-control w180" name="consignee_name" placeholder=""></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>收货人手机号：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="consignee_mobile" class="form-control w180" name="consignee_mobile" placeholder=""></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>收货人地址：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="consignee_address" class="form-control w180" name="consignee_address" placeholder=""></div>
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
    <script type="text/javascript">
        var tablelist = null;

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
                var url = "/trade/order/export";
                url += "?name=" + $("#name").val();
                url += "&order_status=" + $("#order_status").val();
                url += "&service_type=" + $("#service_type").val();
                url += "&shop_name=" + $("#shop_name").val();
                url += "&evaluate_status=" + $("#evaluate_status").val();
                url += "&pay_type=" + $("#pay_type").val();
                url += "&add_time_begin=" + $("#add_time_begin").val();
                url += "&add_time_end=" + $("#add_time_end").val();

                var pickup = $("#pickup").val();
                var user_mobile = $("#user_mobile").val();
                var consignee_name = $("#consignee_name").val();
                var consignee_mobile = $("#consignee_mobile").val();
                var consignee_address = $("#consignee_address").val();
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
                url += "&uid=" + $("#uid").val();
                url += "&buy_type=0";

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
            });
        });

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

        function order_print(order_id) {
            $.go('/trade/order/print?id=' + order_id, '_blank');
        }

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

            $.go('/trade/order/print?id=' + order_id, '_blank');
        }
    </script>

    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=20180919"></script>
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
                    var value = $("#mall_remark").val().trim();
                    if (value == "") {
                        $("#error").show();
                        return;
                    }
                    $.loading.start();
                    $.post('/trade/order/remark', data, function(result) {
                        $.loading.stop();
                        if (result.code == 0) {
                            tablelist.load();
                            layer.close(index);
                            $.msg(result.message);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            })
                        }
                    }, "json");
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop