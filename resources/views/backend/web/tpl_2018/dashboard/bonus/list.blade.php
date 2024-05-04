{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190319"/>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20190319"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20190319"/>
    <script src="/assets/d2eace91/js/clipboard.min.js?v=20190319"></script>
@stop

{{--alert message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/bonus/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" name="keywords" class="form-control" placeholder="请输入红包名称">
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
                        <input type="text" class="form-control form_datetime ipt" id="start_time" name="start_time">
                        <span class="ctime">至</span>
                        <input type="text" class="form-control form_datetime ipt" id="end_time" name="end_time">
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
    <option value="">全部</option>
    <option value="4">会员送红包</option>
    <option value="9">推荐送红包</option>
    <option value="6">注册送红包</option>
    <option value="10">积分兑换红包</option>
    </select></div>
                </div>
            </div> -->

            <div class="simple-form-field">
                <input type="button" id="btn_submit" class="btn btn-primary" value="搜索">
            </div>
        </form>
    </div>

    {{--引入列表--}}
    @include('dashboard.bonus.partials._list')

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
        <p class="prompt m-b-15">手动设置红包作废后，买家将不能继续领取红包，但是已经领取的红包仍然可以使用。</p>
        <div class="content">
            <p class="content-msg">您确认要作废红包？</p>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary">确定</button> -->
            <input type="button" class="btn btn-primary" value="确定" id="set_usable" data-dismiss="modal">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="取消">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">取消</button> -->
        </div>
    </div>

    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=20190319"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190319"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190319"></script>
    <!-- 时间插件引入 end -->
    <script type='text/javascript'>
        var tablelist;
        $().ready(function() {
            $("[data-toggle='popover']").popover();
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

                    $.post("/dashboard/bonus/enable", {
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

                    $.post("/dashboard/bonus/delete", {
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
    <script type="text/javascript">
        //推广红包
        $(".extend-btn").click(function() {
            var bonus_id = $(this).data('id');
            $.open({
                title: "红包推广二维码",
                ajax: {
                    url: 'push',
                    data: {
                        bonus_id: bonus_id,
                    }
                },
                width: "350px",
                height: "500px",
                resize: false,
                /* btn: ['确定', '取消'],
                yes: function(index, container) {

                    $.closeDialog(index);
                }, */
            });
        });

        // 红包排序
        $(".bonus_sort").editable({
            type: "text",
            url: "edit-sort",
            pk: 1,
            // title: "商品库存",
            ajaxOptions: {
                type: "post"
            },
            params: function(params) {
                params.bonus_id = $(this).data("bonus_id");
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
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop