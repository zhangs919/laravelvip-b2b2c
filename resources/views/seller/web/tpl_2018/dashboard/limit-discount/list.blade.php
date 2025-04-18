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
        <form id="searchForm" action="/dashboard/limit-discount/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="act_name" class="form-control" value="" placeholder="请输入活动名称" />
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
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

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>活动状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="act_status" class="form-control" name="act_status">
                            <option value="-1">全部</option>
                            <option value="0">未开始</option>
                            <option value="1">进行中</option>
                            <option value="2">已结束</option>
                        </select></div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>限时折扣列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <!-- 列表 -->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('dashboard.limit-discount.partials._list')
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
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.1"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/activity.js?v=1.1"></script>
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
        var tablelist;
        $().ready(function() {
            //popover弹框
            $("[data-toggle='popover']").popover();
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
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
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
        });
        //
        $(function(){
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
            // 打包一口价排序
            $(".sort-edit").editable({
                type: "text",
                url: "/dashboard/limit-discount/edit-act-info",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.act_id = $(this).data("act_id");
                    params.title = 'sort';
                    return params;
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function(value, sourceData) {
                    // 显示整数
                    $(this).html((Number(value)).toFixed(0));
                }
            });
            $("body").on("click", "#btn_promote", function() {
                $.loading.start();
                $.open({
                    title: "限时折扣推广码",
                    ajax: {
                        url: '/dashboard/promote/view?url=limit-discount-list',
                        data: {}
                    },
                    width: "300px",
                    end: function(index, object) {
                    }
                });
            });
        })
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop