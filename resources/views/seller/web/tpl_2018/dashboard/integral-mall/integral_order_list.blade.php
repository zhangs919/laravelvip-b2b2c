{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <!-- 日历控件-->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180027"></script>
    <!-- -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180027"></script>
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/integral-mall/integral-order-list.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="name" class="form-control w180" name="name" placeholder="商品名称/兑换单号/买家姓名"></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>交易状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="order_status" class="form-control" name="order_status">
                            @foreach($order_status_list as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>下单时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="add_time_begin" class="form-control form_datetime ipt pull-none" name="add_time_begin" value="" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="add_time_end" class="form-control form_datetime ipt pull-none" name="add_time_end" placeholder="结束时间">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
            </div>
        </form>
    </div>


    {{--引入列表--}}
    @include('dashboard.integral-mall.partials._integral_order_list')


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

            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '确定删除此兑换单？如果未发货积分会退还给用户。',
                    url: 'delete-order',
                    data: {
                        id: id
                    }
                });
            });

            // 批量删除
            $("body").on("click", "#batch-delete", function() {
                var ids = [];

                $.each($('.checkBox'), function() {
                    if ($(this).data('id') > 0 && $(this).parents('tr.order-hd').hasClass('active')) {
                        ids.push($(this).data('id'));
                    }
                });
                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量删除吗？',
                    url: 'delete-order',
                    data: {
                        id: ids
                    }
                });
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

    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=20180027"></script>
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
        $("body").on("click", ".edit-remark", function() {
            var id = $(this).data("id");
            var tablelist = $("#table_list").tablelist();
            $.open({
                title: "备注",
                ajax: {
                    url: '/dashboard/integral-mall/remark',
                    data: {
                        id: id
                    }
                },
                width: "600px",
                btn: ['确定', '取消'],
                yes: function(index, container) {

                    var data = $(container).serializeJson();
                    var value = $("#remark").val().trim();
                    if (value == "") {
                        $("#error").show();
                        return;
                    }
                    $.loading.start();
                    $.post('/dashboard/integral-mall/remark', data, function(result) {
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