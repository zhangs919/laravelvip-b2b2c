{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180428"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20180428"/>
    <!-- 日历控件-->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180528"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180528"></script>
    <!-- -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180528"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/reachbuy/list.html" method="GET">

            <input type="hidden" id="uid" class="form-control" name="uid">

            <input type="hidden" id="activity_id" class="form-control" name="activity_id">

            <input type="hidden" id="buy_type" class="form-control" name="buy_type" value="5">
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
                            <option value="unshipped">等待卖家发货</option>
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
                        <input type="text" id="add_time_begin" class="form-control form_datetime ipt pull-none" name="add_time_begin" value="{{ date('Y-m-d') }}" placeholder="开始时间">
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


            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>


                <a id="searchMore" class="btn-link">更多筛选条件</a>

            </div>
        </form>
    </div>


    <div id="table_list">


        <div class="common-title">
            <div class="ftitle">
                <h3>订单列表</h3>

                <h5>
                    (&nbsp;共
                    <span data-total-record="true" class="pagination-total-record"></span>
                    条记录&nbsp;)
                </h5>

            </div>
            <div class="operate m-l-20">

                <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                    <i class="fa fa-refresh"></i>
                </a>
                <script type="text/javascript">
                    function reload() {

                    }
                </script>



            </div>
        </div>


        <!--列表内容-->
        <!-- 不要格式化！！！ -->
        <div class="item-list-hd">
            <ul class="item-list-tabs">
                <li id="all" class="tabs-t current">
                    <a>全部订单（<span id="order-all"></span>）</a>
                </li>

                <li id="unpayed" class="tabs-t">
                    <a>等待买家付款（<span id="order-unpayed"></span>）</a>
                </li>

                <li id="unshipped" class="tabs-t ">
                    <a>待发货（<span id="order-unshipped"></span>）</a>
                </li>


                <li id="finished" class="tabs-b last">
                    <a>交易成功（<span id="order-finished"></span>）</a>
                </li>

                <li id="closed" class="tabs-b">
                    <a>
                        交易关闭（<span id="order-closed"></span>）
                    </a>
                </li>
                <li id="cancel" class="tabs-b last">
                    <a>
                        取消订单申请（<span id="order-cancel"></span>）
                    </a>
                </li>

            </ul>
        </div>

        <script type="text/javascript">
            $().ready(function() {
                $("li[class^='tabs-']").click(function() {
                    $("li[class^='tabs-']").removeClass('current');
                    $(this).addClass('current');

                    $("#order_status").val($(this).attr("id"));

                    tablelist = $("#table_list").tablelist({
                        params: $("#searchForm").serializeJson()
                    });
                    tablelist.load();
                });

                var url = '/trade/order/get-order-counts';
                var data = $("#searchForm").serializeJson();
                $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        $("#order-all").html(data.all);

                        $("#order-unpayed").html(data.unpayed);

                        $("#order-unshipped").html(data.unshipped);


                        $("#order-backing").html(data.backing);

                        $("#order-finished").html(data.finished);

                        $("#order-closed").html(data.closed);
                        $("#order-cancel").html(data.cancel);

                    }
                });
            });
        </script>

        {{--引入列表--}}
        @include('dashboard.reachbuy.partials._list')
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
                var url = "/trade/order/export.html";
                url += "?name=" + $("#name").val();
                url += "&order_status=" + $("#order_status").val();
                url += "&service_type=" + $("#service_type").val();
                url += "&shop_name=" + $("#shop_name").val();
                url += "&evaluate_status=" + $("#evaluate_status").val();
                url += "&pay_type=" + $("#pay_type").val();
                url += "&add_time_begin=" + $("#add_time_begin").val();
                url += "&add_time_end=" + $("#add_time_end").val();
                url += "&pickup=" + $("#pickup").val();
                url += "&user_mobile=" + $("#user_mobile").val();
                url += "&consignee_name=" + $("#consignee_name").val();
                url += "&consignee_mobile=" + $("#consignee_mobile").val();
                url += "&consignee_address=" + $("#consignee_address").val();
                url += "&uid=" + $("#uid").val();

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
    </script>

    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=20180528"></script>
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