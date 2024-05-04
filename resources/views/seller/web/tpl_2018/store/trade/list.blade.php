{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2"/>
@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!-- 搜索 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>起止时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" name="start_time" class="form-control ipt form_datetime" />
                        <span class="ctime">至</span>
                        <input type="text" name="end_time" class="form-control ipt form_datetime" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>网点分组：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="group_id" class="form-control chosen-select">
                            <option value="">-- 全部 --</option>
                            @foreach($group_list as $item)
                                <option value="{{ $item['group_id'] }}">{{ $item['group_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>网点名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="store_name" class="form-control" type="text" placeholder="请输入网点名称" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <a id="btn_search" class="btn btn-primary m-r-5">搜索</a>
            </div>
        </form>
    </div>
    <!--列表上面（列表名称、列表显示项设置）-->
    <div class="common-title">
        <div class="ftitle">
            <h3>网点销售统计列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record">1</span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('store.trade.partials._list')

    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <div id="merge_result" style="display: none;">
        <div  class="modal-body p-b-10">
            <!--列表内容-->
            <div class="table-responsive">
                <table id="table_merge" class="table table-hover m-b-0">
                    <thead>
                    <tr>
                        <th class="text-c">支付宝</th>
                        <th class="text-c">微信</th>
                        <th class="text-c">银联</th>
                        <th class="text-c">余额</th>
                        <th class="text-c">购物卡</th>
                        <th class="text-c">货到付款</th>
                        <th class="text-c">红包金额</th>
                        <th class="text-c">红包数量</th>
                        <th class="text-c">赠品数量</th>
                        <th class="text-c">订单数</th>
                        <th class="text-c">订单总额</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="alipay text-c"></td>
                        <td class="weixin text-c"></td>
                        <td class="union text-c"></td>
                        <td class="balance text-c"></td>
                        <td class="store_card_amount text-c"></td>
                        <td class="cod text-c"></td>
                        <td class="bonus text-c"></td>
                        <td class="bonus_count text-c"></td>
                        <td class="gift_count text-c"></td>
                        <td class="order_count text-c"></td>
                        <td class="order_amount text-c"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=202003261806"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=202003261806"></script>

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        // 跳转到详情页面
        function go(store_id, start_time, end_time, pay_code, is_bonus, is_gift) {
            var url = "/store/trade/detail?store_id=" + store_id;
            url += "&start_time=" + start_time + "&end_time=" + end_time;
            if (pay_code) {
                url += "&pay_code=" + pay_code;
            }
            if (is_bonus) {
                url += "&is_bonus=" + 1;
            }
            if (is_gift) {
                url += "&is_gift=" + 1;
            }
            $.go(url);
        }
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                todayBtn: 1,
                autoclose: 1,
                weekStart: 0,
                startView: 2,//显示的初始示图(1:hour;2:day;3:month;4:year)
                minView: 2,//日期时间选择器所能够提供的最精确的时间选择视图(1:hour;2:day;3:month;4:year)
                //maxView: 4,
                minuteStep: 5,//分钟的阶段范围
                showMeridian: 1,
                forceParse: 0,
                format: 'yyyy-mm-dd',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });
            $("#btn_search").click(function() {
                var data = $("#searchForm").serializeJson();
                tablelist.load(data);
            })
            $("body").on("click", "#btn_merge", function() {
                var count = $("#table_list").find("input:checkbox:checked").size();
                if(count <= 0) {
                    $.msg('未选择任何数据。');
                    return false;
                }
                var list = [];
                $("#table_list").find("tbody tr").each(function() {
                    if ($(this).find("input:checkbox").is(":checked") || count == 0) {
                        $(this).find(".merge").each(function() {
                            var name = $(this).data("name");
                            var value = $(this).data("value");
                            if (list[name] == undefined) {
                                list[name] = 0;
                            }
                            list[name] += parseFloat(value);
                        });
                    }
                });
                for ( var name in list) {
                    var value = list[name];
                    if (isNaN(value)) {
                        value = 0;
                    }
                    if (name == 'bonus_count' || name == 'gift_count' || name == 'order_count') {
                        $("#table_merge").find("." + name).html(value);
                    } else {
                        $("#table_merge").find("." + name).html(value.toFixed(2));
                    }
                }
                $.open({
                    type: 1,
                    title: count == 0 ? "当前页全部合计结果" : "合计结果",
                    width: "680px",
                    height: "205px",
                    content: $("#merge_result").html(),
                    btn: ["确定"],
                    yes: function(index) {
                        $.closeDialog(index);
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop