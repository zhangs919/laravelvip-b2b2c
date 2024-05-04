{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180027"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/trade/service/evaluate-shop-list.html" method="GET">
            <input type="hidden" name="status" value="1">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单编号：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="order_sn" class="form-control" type="text" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="shop_name" class="form-control" type="text" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle">
                <div class="form-group">
                    <label class="control-label">
                        <span>评价时间：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="comment_time" class="form-control form_datetime" name="comment_time"></div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索">
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>评价列表</h3>

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
    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <a  href="javascript:void(0);" data-url="/trade/service/evaluate-shop-list?type=un&status=1" class="evaluate-list">
                <li name="un" class="tabs-t current">待审核的评价</li>
            </a>
            <a  href="javascript:void(0);" data-url="/trade/service/evaluate-shop-list?type=del&status=1" class="evaluate-list">
                <li name="del" class="tabs-t last">已删除的评价</li>
            </a>
            <a  href="javascript:void(0);" data-url="/trade/service/evaluate-shop-list?type=all&status=1" class="evaluate-list">
                <li name="all" class="tabs-t">全部评价</li>
            </a>
            <!--当前选中样式current，并且现只有“等待买家确认”，“等待发货”，“退款中”需要有个数提醒，其它没有；默认为近三个月订单-->
        </ul>
    </div>
    <!--列表内容-->
    <div class="table-responsive" style="overflow: visible;">
        <colgroup>
            <col class="w10" />
            <!--被评店铺-->
            <col class="w100" />

            <!--评价人-->
            <col class="w120" />
            <!--卖家的服务态度-->
            <col class="w100" />


            <!--卖家的发货速度-->
            <col class="w100" />

            <!--物流公司的服务-->
            <col class="w100" />

            <!--评价订单-->
            <col class="w100" />

            <!--评价时间-->
            <col class="w100" />

            <!--操作-->
            <col class="w100" />
        </colgroup>

        {{--引入列表--}}
        @include('trade.service.partials._evaluate_shop_list')
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

    <script src="/assets/d2eace91/js/jquery.method.js?v=20180027"></script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                console.info(data);
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            // ajax加载列表
            $(".evaluate-list").click(function() {
                tablelist = $("#table_list").tablelist({
                    url: $(this).data("url")
                });

                var data = $("#searchForm").serializeJson()

                tablelist.load(data);

                $(".item-list-tabs").find("li").removeClass("current");
                $(this).find("li").addClass("current");
            });
        });
    </script>
    <script type='text/javascript'>
        $("body").on("click", ".hiddens,.refuse,.is_pass,.is_show", function() {
            var tip = "";
            var btn = "";
            switch ($(this).attr("class")) {
                case "hiddens del":
                    tip = "删除";
                    btn = "hidden";
                    break;
                case "refuse del":
                    tip = "拒绝";
                    btn = "refuse";
                    break;
                case "is_pass":
                    tip = "通过";
                    btn = "pass";
                    break;
                case "is_show":
                    tip = "显示";
                    btn = "show";
                    break;
            }
            var id = $(this).data("id");
            $.confirm("是否" + tip + "该内容？", function(s) {
                $.loading.start();

                $.ajax({
                    type: 'GET',
                    url: '/trade/service/shop-operation?btn=' + btn + '&type=un&id=' + id,
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 1500
                            }, function() {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        })
    </script>
    <script type='text/javascript'>
        //批量
        $(function() {
            $("body").on("click", "button[class='btn btn-danger mr5']", function() {
                var tip = "";
                var select = $(this).attr("id");
                switch (select) {
                    case "hiddens":
                        tip = "删除";
                        break;
                    case "shows":
                        tip = "显示";
                        break;
                    case "refuse":
                        tip = "拒绝";
                        break;
                }

                var ids = [];
                $("#table_list").children("tbody").children("tr").each(function() {
                    if ($(this).hasClass("active")) {
                        ids.push($(this).attr("name"));
                    }
                });

                if (ids.length == 0) {
                    $.msg("至少选择一个评价进行操作");
                    return;
                }

                $.confirm("是否批量" + tip + "该内容？", function(s) {
                    $.loading.start();

                    var tab;
                    $(".item-list-tabs").children("a").each(function() {
                        if ($(this).children().hasClass("current")) {
                            tab = $(this).children().attr("name");
                        }
                    })

                    $.ajax({
                        type: 'GET',
                        url: '/trade/service/shop-batch-operation?btn=' + select + '&type=un&id=' + ids.join(","),
                        dataType: 'json',
                        success: function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 1500
                                }, function() {
                                    tablelist.load();
                                });
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }
                    }).always(function() {
                        $.loading.stop();
                    });
                })
            })
        })
    </script>
    <script type='text/javascript'>
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
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop