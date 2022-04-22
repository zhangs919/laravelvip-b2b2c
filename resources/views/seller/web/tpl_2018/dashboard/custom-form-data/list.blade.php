{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=201900316"/>
@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/custom-form-data.html" method="GET" autocomplete="off">
            <input type="hidden" name="form_id" value="5">
            <div class="simple-form-field simple-form-search">
                <div class="form-group">
                    <label class="control-label">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>提交时间：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="start_time" class="form-control form_datetime" value="" />
                        ~
                        <input type="text" name="end_time" class="form-control form_datetime" value="" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索" />
                <!-- <input type="submit" id="btn_submit" class="btn btn-default" value="导出" /> -->
            </div>
        </form>	</div>
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>数据收集列表</h3>

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

    <!-- 表单列表 -->
    {{--引入列表--}}
    @include('dashboard.custom-form-data.partials._list')

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


{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单复制 -->
    <div class="form-horizontal" id="copy_dialog" style="display: none;">
        <div class="simple-form-field m-t-10">
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    <span class="ng-binding">新表单标题：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">
                        <input type="text" id="copy_title" class="form-control">
                    </div>
                    <div class="help-block help-block-t">最多输入60个字</div>
                </div>
            </div>
        </div>
    </div>
    <!-- 日历控件-->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190121"></script>
    <!-- -->
    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                var $self = $(this);
                // 开始日期， 结束日期
                var $start_time = $self.find('input[name="start_time"]');
                var $end_time = $self.find('input[name="end_time"]');
                var start_time = $start_time.val();
                var end_time = $end_time.val();

                // 开始时间，结束时间都存在的情况，结束时间不可大于开时间
                if (start_time && end_time) {
                    if (end_time < start_time) {
                        $.msg('结束时间不能早于开始时间');
                        return false;
                    }
                }

                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

        });
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
            format: 'yyyy-mm-dd',

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop