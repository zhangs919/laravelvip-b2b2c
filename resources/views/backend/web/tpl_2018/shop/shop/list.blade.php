{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/shop/shop/index" method="GET">
            <input type="hidden" name="is_supply" value="0">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="key_word" name="key_word" class="form-control w180" type="text" value="" placeholder="店铺ID/店铺名称/店主账号">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺类型：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="shop_type" name="shop_type" class="form-control">
                            <option value="0">全部</option>
                            <option value="1">个人店铺</option>
                            <option value="2">企业店铺</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="shop_status" name="shop_status" class="form-control">
                            <option value="-1">全部</option>
                            <option value="1">开启</option>
                            <option value="0">关闭</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>开店时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="start_from" class="form-control form_datetime ipt pull-none" name="start_from">
                        <span class="ctime">至</span>
                        <input type="text" id="start_to" class="form-control form_datetime ipt pull-none" name="start_to">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>到期时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="end_from" class="form-control form_datetime ipt" name="end_from">
                        <span class="ctime">至</span>
                        <input type="text" id="end_to" class="form-control form_datetime ipt" name="end_to">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺信誉：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="credit_from" name="credit_from" class="form-control ipt" type="text" onkeyup="this.value=this.value.replace(/\D/gi,&quot;&quot;)">
                        <span class="ctime">至</span>
                        <input id="credit_to" name="credit_to" class="form-control ipt" type="text" onkeyup="this.value=this.value.replace(/\D/gi,&quot;&quot;)">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">

                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出">

                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>店铺列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>

    <div class="table-responsive">



        {{--引入列表--}}
        @include('shop.shop.partials._list')

        <script type="text/javascript">
            $(document).ready(function() {
                // toggle `popup` / `inline` mode
                // $.fn.editable.defaults.mode = "popup";

                $(".shop_sort").editable({
                    type: "text",
                    url: "/shop/shop/edit-shop-info",
                    pk: 1,
                    // title: "排序",
                    ajaxOptions: {
                        type: "post"
                    },
                    params: function(params) {
                        params.shop_id = $(this).data("shop_id");
                        params.title = 'shop_sort';
                        return params;
                    },
                    /* validate: function(value) {
                        value = $.trim(value);
                        var ex = /^\d+$/;
                        if (!value) {
                            return '排序不能为空。';
                        } else if (!ex.test(value)) {
                            return '排序必须是0~255的正整数。';
                        } else if(value > 255) {
                            return '排序必须是0~255的正整数。';
                        }
                    }, */
                    success: function(response, newValue) {
                        var response = eval('(' + response + ')');
                        if (response.code == -1) {
                            return response.message;
                        }
                    }
                });
            });
        </script>


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
        $().ready(function() {
            $("[data-toggle='popover']").popover();
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
                url: 'list'		});

            // 删除
            $("body").on('click', '.del', function() {
                var id = $(this).data("shop-id");
                var name = $(this).data("shop-name");
                $.confirm("店铺删除后将同时删除店铺下所有商品和网点且无法恢复，您确定删除店铺【"+ name +"】吗？", function() {
                    $.loading.start();
                    $.ajax({
                        cache: false,
                        type: "POST",
                        data: {
                            id: id
                        },
                        url: "delete",
                        success: function(result) {
                            var result = eval('(' + result + ')');
                            if (result.code == 0) {
                                $.alert(result.message, {
                                    icon: 1
                                }, function() {
                                    $.go("list?is_supply=0");
                                });
                            } else {
                                $.alert(result.message, {
                                    icon: 2
                                });
                            }
                        },
                        error: function(result) {
                            $.alert("异常", {
                                icon: 2
                            });
                        }
                    });
                });
            });

            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

            $("#btn_export").click(function() {
                var url = "/shop/shop/export.html?is_supply=0";
                url += "&renew=";
                url += "&key_word=" + $("#key_word").val();
                url += "&shop_type=" + $("#shop_type").val();
                url += "&shop_status=" + $("#shop_status").val();
                url += "&start_from=" + $("#start_from").val();
                url += "&start_to=" + $("#start_to").val();
                url += "&end_from=" + $("#end_from").val();
                url += "&end_to=" + $("#end_to").val();
                url += "&credit_from=" + $("#credit_from").val();
                url += "&credit_to=" + $("#credit_to").val();
                if(typeof($("#site_id").val()) != "undefined") {
                    url += "&site_id=" + $("#site_id").val();
                }

                if(tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, null, false);
            });
        });
    </script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2, // 只选年月日
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd'
        });

        $("body").on("mouseover", ".QR-code", function() {
            if ($(this).data("loading")) {
                return;
            }
            var target = $(this).find("img");
            var src = $(target).data("src");
            var img = new Image();
            img.src = src;
            img.onload = function() {
                $(target).attr("src", src);
            };
            $(this).data("loading", true);
        });

        $('#start_from').datetimepicker().on('changeDate', function(ev) {
            $('#start_to').datetimepicker('setStartDate', ev.date);
        });
        $('#start_to').datetimepicker().on('changeDate', function(ev) {
            $('#start_from').datetimepicker('setEndDate', ev.date);
        });
        $('#end_from').datetimepicker().on('changeDate', function(ev) {
            $('#end_to').datetimepicker('setStartDate', ev.date);
        });
        $('#end_to').datetimepicker().on('changeDate', function(ev) {
            $('#end_from').datetimepicker('setEndDate', ev.date);
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop