{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=2.0" rel="stylesheet">
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20190319"/>

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/fight-group/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" name="act_name" class="form-control" value="" placeholder="请输入活动名称/活动id" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品信息：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="goods_type" class="form-control w120 m-r-2">
                            <option value="1">商品名称</option>
                            <option value="2">商品ID</option>
                            <option value="3">商品货号</option>
                            <option value="4">商品条码</option>
                        </select>
                        <input type="text" name="goods_name" class="form-control" value="" placeholder="商品关键词" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>活动有效期：</span>
                    </label>
                    <div class="form-control-wrap">
                        <!--时间这input 后新增form_datetime, 开始时间name="begin"，截止时间name="end"-->
                        <input type="text" id="begin" class="form-control form_datetime ipt pull-none" name="begin">
                        <span class="ctime">至</span>
                        <input type="text" id="end" class="form-control form_datetime ipt pull-none" name="end">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>活动状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="activity_status" class="chosen-select" name="activity_status">
                            <option value="0">请选择</option>
                            <option value="1">未开始</option>
                            <option value="2">进行中</option>
                            <option value="3">已结束</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>审核状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="chosen-select" name="status">
                            <option value="0">请选择</option>
                            <option value="1">待审核</option>
                            <option value="2">审核通过</option>
                            <option value="3">审核不通过</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>拼团类型：</span>
                    </label>
                    <div class="form-control-wrap"><select id="groupon_type" class="chosen-select" name="groupon_type">
                            <option value="0">请选择</option>
                            <option value="1">普通拼团</option>
                            <option value="2">老带新拼团</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>活动创建人：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" name="user_id">
                            <option value="0">全部</option>
                            <option value="15">创宇云自营店铺</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>拼团列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record=true class="pagination-total-record">1</span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!-- 分类列表 -->
    <div class="table-responsive" style="overflow: visible;">
        {{--引入列表--}}
        @include('dashboard.fight-group.partials._list')
    </div>
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

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/activity.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.qrcode.min.js?v=1.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            var page_id = "pagination";
            $("#"+page_id+" > .pagination-goto > .goto-input").keyup(function(e) {
                $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $("#"+page_id+" > .pagination-goto > .goto-link").click();
                }
            });
            $("#"+page_id+" > .pagination-goto > .goto-button").click(function() {
                var page = $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page", page);
                $("#"+page_id+" > .pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        var tablelist;
        $().ready(function() {
            $(".goods-qrcode").each(function () {
                $(this).qrcode({
                    render: "canvas",
                    width: 120,
                    height: 120,
                    text: encodeURI($(this).data("url"))
                });
            });
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson(),
                // 回调
                callback: function() {
                    // 重载必要渲染
                    activityList.reload();
                    $(".goods-qrcode").each(function () {
                        $(this).qrcode({
                            render: "canvas",
                            width: 120,
                            height: 120,
                            text: encodeURI($(this).data("url"))
                        });
                    });
                }
            });
            // 初始化活动列表
            var activityList = $.activityList({
                tablelist: tablelist,
                // 推广码设置
                promote: {
                    selector: "#btn_promote",
                    title: "拼团推广码",
                    url: "groupon"
                }
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
            $("body").on("mouseover", ".reason", function() {
                $.tips($(this).data("reason"), $(this));
            });
            $("body").on("mouseout", ".reason", function() {
                $.closeAll("tips");
            });
        });
        //
        $(function(){
            $('.form_datetime').datetimepicker({
                format: 'yyyy-mm-dd',
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
            });
            $('#begin').datetimepicker().on('changeDate', function(ev) {
                $('#end').datetimepicker('setStartDate', new Date(ev.date.getTime() + (ev.date.getTimezoneOffset() * 60000)));
            });
            $('#end').datetimepicker().on('changeDate', function(ev) {
                $('#begin').datetimepicker('setEndDate', new Date(ev.date.getTime() + (ev.date.getTimezoneOffset() * 60000)));
            });
        });
        //
        $("body").on("click", ".upload-img", function() {
            var image = $(this).siblings("a");
            var span = $(this);
            $.imageupload({
                url: $(this).data("url"),
                data: {
                    act_id: $(this).data("id")
                },
                callback: function(result) {
                    if (result.code == 0) {
                        $(image).attr("ref", result.data.url);
                        $(span).attr("class", "btn btn-success btn-xs pos-r upload-img");
                        $.msg(result.message, {
                            time: 2000
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        });
        //
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop