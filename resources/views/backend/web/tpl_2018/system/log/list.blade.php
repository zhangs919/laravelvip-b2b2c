{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

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
                        <div class="chosen-container chosen-container-single" title="" id="user_id_chosen"><a class="chosen-single" tabindex="-1"><span>全部</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div><select class="form-control chosen-select" id="user_id" name="user_id" style="display: none;">

                            <option value="-1">全部</option>

                            <option value="1">18669035369</option>

                            <option value="2">test</option>

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
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>操作日志列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true">{{ $total }}</span>
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

    {{--引入列表--}}
    @include('system.log.partials._list')

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--自定义css样式 page元素内--}}
@section('style_css')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

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