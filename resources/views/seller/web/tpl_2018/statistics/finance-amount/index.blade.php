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
        <form id="searchForm" action="/statistics/finance-amount/index" method="GET">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                    <span>
                        时间：
                    </span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt" name="from" placeholder="">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt" name="to" placeholder="">
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
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />
            </div>
        </form>    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>{{ $title }}</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">
        {{--引入列表--}}
        @include('statistics.finance-amount.partials._index')
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
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.treetable.js"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js"></script>
    <script src="/assets/d2eace91/js/jquery.base64.js"></script>
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
        var is_backend_app = "";
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            if (is_backend_app) {
                var shopselector = $("#shop_selector").shopselector({
                    size: 0,
                    data: {
                        deep: 3
                    },
                    addCallback: function(id, name, node) {
                        // this.hide();
                        var shop_id = $("#shop_id").val();
                        if (shop_id == "") {
                            $("#shop_id").val(id);
                        } else {
                            $("#shop_id").val(shop_id + "," + id);
                        }
                        //alert($("#shop_id").val())
                        // $("#btn_submit").click();
                    },
                    removeCallback: function(id) {
                        // this.hide();
                        var shop_id = $("#shop_id").val();
                        shop_id = shop_id.replace(id, "");
                        $("#shop_id").val(shop_id);
                        //alert($("#shop_id").val())
                        if ($("#shop_id").val() == "") {
                            // $("#btn_submit").click();
                        }
                    }
                });
                shopselector.load();
            }
        });
        //
        var type = "0";
        if (type == 0) {
            var view = 2;
            var format = 'yyyy-mm-dd';
        } else if (type == 1) {
            var view = 3;
            var format = 'yyyy-mm';
        } else if (type == 2) {
            var view = 4;
            var format = 'yyyy';
        }
        $(function() {
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: view,
                minView: view,
                forceParse: 0,
                showMeridian: 1,
                format: format
            });
            $('#from').datetimepicker().on('changeDate', function(ev) {
                $('#to').datetimepicker('setStartDate', ev.date);
            });
            $('#to').datetimepicker().on('changeDate', function(ev) {
                $('#from').datetimepicker('setEndDate', ev.date);
            });
        });
        $(".date").click(function() {
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
        $("#btn_export").click(function() {
            var is_backend_app = "";
            if (is_backend_app) {
                var url = "/finance/finance-amount/export.html";
            } else {
                var url = "/statistics/finance-amount/export.html";
            }
            url += "?from=" + $("#from").val();
            url += "&to=" + $("#to").val();
            url += "&type=0";
            if (tablelist.sortname != null && tablelist.sortorder != null) {
                url += "&sortname=" + tablelist.sortname;
                url += "&sortorder=" + tablelist.sortorder;
            }
            $.go('/site/export?url=' + encodeURIComponent($.base64.encode(url)) + '&title=导出销售统计列表', '_blank', false);
        });
        // var myDate = new Date();
        // $('#from').val(myDate.Format("yyyy-MM-dd"));
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop