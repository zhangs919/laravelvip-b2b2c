{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/integral-mall/integral-bonus-list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" name="keywords" class="form-control" placeholder="请输入红包名称" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>有效期：</span>
                    </label>
                    <div class="form-control-wrap">
                        <!--时间这input 后新增form_datetime, 开始时间name="begin"，截止时间name="end"-->
                        <input type="text" class="form-control form_datetime ipt" id="start_time" name="start_time" placeholder='开始时间' />
                        <span class="ctime">至</span>
                        <input type="text" class="form-control form_datetime ipt" id="end_time" name="end_time" placeholder='结束时间' />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>状态：</span>
                    </label>
                    <div class="form-control-wrap"><select class="form-control" name="is_enable">
                            <option value="">全部</option>
                            <option value="1">正常</option>
                            <option value="0">已失效</option>
                        </select></div>
                </div>
            </div>
            <!-- <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>红包类型：</span>
                    </label>
                    <div class="form-control-wrap"><select class="form-control" name="bonus_type">

    </select></div>
                </div>
            </div> -->

            <div class="simple-form-field">
                <input type="button" id="btn_submit" class="btn btn-primary" value="搜索" />
            </div>
        </form>
    </div>

    <!--列表上面（列表名称、列表显示项设置）-->
    {{--引入列表--}}
    @include('dashboard.integral-mall.partials._integral_bonus_list')


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
    <!--设置无效内容弹框-->
    <div id="confirmModal" class="bonus-modal">
        <p class="prompt m-b-15"></p>
        <div class="content">
            <p class="content-msg"></p>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary">确定</button> -->
            <input type="button" class="btn btn-primary" value="" id="set_usable" data-dismiss="modal">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">取消</button> -->
        </div>
    </div>
    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=20181020"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20180027"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180027"></script>
    <!-- 时间插件引入 end -->
    <script type='text/javascript'>
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();

            $("#btn_submit").click(function() {
                var data = $("#searchForm").serializeJson();
                tablelist.load(data);
            });

            // 日期
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                todayBtn: 1,
                autoclose: 1,
                weekStart: 0,
                startView: 2,//显示的初始示图(1:hour;2:day;3:month;4:year)
                minView: 2,//日期时间选择器所能够提供的最精确的时间选择视图(1:hour;2:day;3:month;4:year)
                //maxView: 4,
                minuteStep: 5,//分钟的阶段范围
                format: 'yyyy-mm-dd'
            });

            // 作废
            $("body").on('click', '.enable', function() {

                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    ids = $(this).data("id");
                }

                if (ids == undefined || ids == null || ids.length == 0) {
                    $.msg("请选择您要作废的红包", {
                        time: 3000
                    });
                    return;
                }

                $.confirm("作废红包不会影响用户已经领取的红包，您确定要作废选中的红包吗？", function() {

                    $.loading.start();

                    $.post("/dashboard/bonus/enable.html", {
                        ids: ids
                    }, function(result) {
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
                    }, "JSON");
                });

            });

            //批量作废
            $("body").on('click', '#batch_status', function() {

                var ids = tablelist.checkedValues();

                if (ids == undefined || ids == null || ids.length == 0) {
                    $.msg("请选择您要批量作废的红包", {
                        time: 3000
                    });
                    return;
                }

                $.confirm("作废红包不会影响用户已经领取的红包，您确定要作废选中的红包吗？", function() {
                    $.post("/dashboard/bonus/enable.html", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "JSON");
                });
            });

            // 删除
            $("body").on('click', '.delete', function() {

                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    ids = $(this).data("id");
                }

                if (ids == undefined || ids == null || ids.length == 0) {
                    $.msg("请选择您要删除的红包", {
                        time: 3000
                    });
                    return;
                }

                $.confirm("删除后将无法恢复，您确定要删除选中的红包吗？", function() {

                    $.loading.start();

                    $.post("/dashboard/bonus/delete.html", {
                        ids: ids
                    }, function(result) {
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
                    }, "JSON").always(function() {
                        $.loading.stop();
                    });
                });

            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop