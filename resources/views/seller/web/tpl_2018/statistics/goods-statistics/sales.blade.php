{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/statistics/goods-statistics/sales.html" method="GET">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>下单时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt pull-none"
                               name="from">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt pull-none"
                               name="to">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <a class="inline-item date" href="javascript:void(0);">今天</a>
                <em class="ft-bar">|</em>
                <span class="inline-text">最近：</span>
                <a class="inline-item date" href="javascript:void(0);">1个月</a>
                <a class="inline-item date" href="javascript:void(0);">3个月</a>
                <a class="inline-item date" href="javascript:void(0);">1年</a>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单类型：</span>
                    </label>
                    <div class="form-control-wrap"><select id="order_type" class="form-control"
                                                           name="order_type">
                            <option value="">-- 请选择 --</option>
                            <option value="normal">普通订单</option>
                            <option value="freebuy">自由购订单</option>
                            <option value="reachbuy">堂内点餐订单</option>
                            <option value="fightgroup">拼团订单</option>
                            <option value="groupbuy">团购订单</option>
                            <option value="presale">预售订单</option>
                            <option value="bargain">砍价订单</option>
                            <option value="cash">线下收银订单</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单编号：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="order_sn" name="order_sn" class="form-control w180" type="text"
                               placeholder=""/>
                    </div>
                </div>
            </div>
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="keyword" name="keyword" class="form-control w180" type="text"
                               placeholder="商品名称/商品ID"/>
                    </div>
                </div>
            </div>
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品分类：</span>
                    </label>
                    <div class="form-control-wrap"><select id="searchmodel-scid"
                                                           class="form-control chosen-select" name="scid"
                                                           data-width="120">
                            <option value="">-- 请选择分类 --</option>
                            <option value="622"><span>◢</span>&nbsp;啊啊啊</option>
                            <option value="623">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;不不不</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <input type="button" id="btn_export" value="导出" class="btn btn-default m-r-5"/>
            </div>
        </form>
    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>单品销售统计</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <div class="table-responsive">
        {{--引入列表--}}
        @include('statistics.goods-statistics.partials._sales')
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html page元素同级下面--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js"></script>

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function () {
            $(".pagination-goto > .goto-input").keyup(function (e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function () {
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
        $().ready(function () {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
            $("#searchForm").submit(function () {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $("#btn_export").click(function () {
                var url = "/statistics/goods-statistics/export-sales.html";
                url += "?from=" + $("#from").val();
                url += "&to=" + $("#to").val();
                url += "&order_type=" + $("#order_type").val();
                url += "&order_sn=" + $("#order_sn").val();
                url += "&keyword=" + $("#keyword").val();
                url += "&scid=" + $("#searchmodel-scid").val();
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
            });
        });
        //
        $(function () {
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd'
            });
            $('#from').datetimepicker().on('changeDate', function (ev) {
                $('#to').datetimepicker('setStartDate', ev.date);
            });
            $('#to').datetimepicker().on('changeDate', function (ev) {
                $('#from').datetimepicker('setEndDate', ev.date);
            });
            $(".date").click(function () {
                $(".date").removeClass("active");
                $(this).addClass("active");
                if ($(this).text() == "今天") {
                    var myDate = new Date();
                    $('#from').val(myDate.Format("yyyy-MM-dd"));
                    $('#to').val('');
                } else if ($(this).text() == "1个月") {
                    var myDate = new Date();
                    myDate.setMonth(myDate.getMonth() - 1);
                    $('#from').val(myDate.Format("yyyy-MM-dd"));
                    $('#to').val('');
                } else if ($(this).text() == "3个月") {
                    var myDate = new Date();
                    myDate.setMonth(myDate.getMonth() - 3);
                    $('#from').val(myDate.Format("yyyy-MM-dd"));
                    $('#to').val('');
                } else if ($(this).text() == "1年") {
                    var myDate = new Date();
                    myDate.setYear(myDate.getFullYear() - 1);
                    $('#from').val(myDate.Format("yyyy-MM-dd"));
                    $('#to').val('');
                }
            });
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop