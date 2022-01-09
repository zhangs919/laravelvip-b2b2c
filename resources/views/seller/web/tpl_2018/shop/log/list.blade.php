{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>操作人：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="user_id" name="user_id">

                            <option value="-1">全部</option>

                            <option value="2">测试店铺</option>

                            <option value="5">test</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>内容：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="content" name="content" class="form-control" type="text">
                    </div>
                </div>
            </div>
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>日期：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="start_time" class="form-control form_datetime ipt pull-none" name="start_time">
                        <span class="ctime">至</span>
                        <input type="text" id="end_time" class="form-control form_datetime ipt pull-none" name="end_time">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>操作日志列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.log.partials._list')

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

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            // 删除操作
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");
                tablelist.remove({
                    confirm: '您确定删除这条操作日志吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });

            // 批量删除
            $("body").on("click", "#batch-delete", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量删除操作日志吗？',
                    url: 'batch-delete',
                    data: {
                        ids: ids
                    }
                });
            });

            // 删除旧日志
            $("body").on("click", "#delete-old-log", function() {
                tablelist.remove({
                    confirm: '您确定删除六个月前的操作日志吗？',
                    url: 'delete-old-log',
                    data: {}
                });
            });

            // 搜索
            $("#searchForm").submit(function() {
                tablelist.load({
                    // 操作人
                    'user_id': $("#user_id").val(),
                    // 操作内容
                    'content': $("#content").val(),
                    // 开始日期
                    'start_time': $("#start_time").val(),
                    // 结束日期
                    'end_time': $("#end_time").val(),
                });
                return false;
            });
        });
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
            format: 'yyyy-mm-dd',
        });

        $('#start_time').datetimepicker().on('changeDate', function(ev) {
            $('#end_time').datetimepicker('setStartDate', ev.date);
        });
        $('#end_time').datetimepicker().on('changeDate', function(ev) {
            $('#start_time').datetimepicker('setEndDate', ev.date);
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop