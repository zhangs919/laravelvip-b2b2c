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
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="key_word" name="key_word" class="form-control w180" type="text" placeholder="店铺ID/店铺名称/店主账号">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>企业/个人：</span>
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
                        <span>续签开始时间：</span>
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
                        <span>续签结束时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="end_from" class="form-control form_datetime ipt pull-none" name="end_from">
                        <span class="ctime">至</span>
                        <input type="text" id="end_to" class="form-control form_datetime ipt pull-none" name="end_to">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>续签申请店铺列表</h3>

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
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.shop.partials._renew_apply_list')

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
            var tablelist = $("#table_list").tablelist({
                url: 'renew-apply-list'
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
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