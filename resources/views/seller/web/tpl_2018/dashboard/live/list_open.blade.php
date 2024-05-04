{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180703"/>
@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/live/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" name="keyword" class="form-control" value="" placeholder="直播标题/ID" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>直播状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="form-control" name="status">
                            <option value="-1">全部</option>
                            <option value="0">未开始</option>
                            <option value="1">直播中</option>
                            <option value="2">已结束</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>开播时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <!--时间这input 后新增form_datetime, 开始时间name="begin"，截止时间name="end"-->
                        <input type="text" id="begin" class="form-control form_datetime ipt pull-none" name="begin" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="end" class="form-control form_datetime ipt pull-none" name="end" placeholder="结束时间">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>分类：</span>
                    </label>
                    <div class="form-control-wrap"><select id="cat_id" class="form-control" name="cat_id">
                            <option value="">全部</option>
                            <option value="6">水果</option>
                            <option value="7">家居</option>
                            <option value="8">电子</option>
                            <option value="9">文玩</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
        </form>    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>直播列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    
    <!-- 分类列表 -->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('dashboard.live.partials._list')
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

    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>

    <script type="text/javascript">
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
        //popover弹框
        $("[data-toggle='popover']").popover();
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
            //开始直播
            $('body').on('click', '.change-is-finish', function() {
                var obj = $(this);
                var id = $(this).data('id');
                var status = $(this).data('status');
                var text = "确定要关闭这个直播吗？";
                if (status == 0) {
                    text = "确定要开始这个直播吗？";
                }
                $.confirm(text, function() {
                    $.post('change-status', {
                        id: id
                    }, function(result) {
                        if (result.code == 0) {
                            tablelist.load();
                        } else {
                            $.msg(result.message);
                        }
                    }, 'JSON');
                });
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
            $("body").on('click', '.address', function() {
                var id = $(this).data("id");
                $.open({
                    title: '直播推流地址',
                    width: '650px',
                    btn: ['重置', '取消'],
                    success: function(layero) {
                        layero.find('.layui-layer-btn').css('text-align', 'center')
                    },
                    ajax: {
                        url: '/dashboard/live/get-push-stream',
                        data: {
                            id: id
                        }
                    },
                    yes: function(index, container) {
                        $.post('/dashboard/live/get-push-stream', {
                            id: id
                        }, function(result) {
                            if (result.code == 0) {
                                $('body').find('.push-steam').html(result.data.push_stream);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }, "json");
                    }
                });
            });
        });
        //
        // $("body").on("click", ".upload-img", function() {
        //     var image = $(this).siblings("a");
        //     var span = $(this);
        //     $.imageupload({
        //         url: $(this).data("url"),
        //         data: {
        //             act_id: $(this).data("id")
        //         },
        //         callback: function(result) {
        //             if (result.code == 0) {
        //                 $(image).attr("ref", result.data.url);
        //                 $(span).attr("class", "btn btn-success btn-xs pos-r upload-img");
        //                 $.msg(result.message, {
        //                     time: 2000
        //                 });
        //             } else {
        //                 $.msg(result.message, {
        //                     time: 5000
        //                 });
        //             }
        //         }
        //     });
        // });
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
                $('#end').datetimepicker('setStartDate', ev.date);
            });
            $('#end').datetimepicker().on('changeDate', function(ev) {
                $('#begin').datetimepicker('setEndDate', ev.date);
            });
            $("body").on("click", "#btn_promote", function() {
                $.loading.start();
                $.open({
                    title: "直播推广码",
                    ajax: {
                        url: '/dashboard/promote/view?url=live',
                        data: {}
                    },
                    width: "300px",
                    end: function(index, object) {
                    }
                });
            });
        });
        //
        $().ready(function() {
            $(".live_sort").editable({
                type: "text",
                url: 'edit-live-info',
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("id");
                    params.title = 'sort';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '排序不能为空。';
                    } else if (!ex.test(value)) {
                        return '排序必须是0~9999的正整数。';
                    } else if (value > 9999) {
                        return '排序必须是0~9999的正整数。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">

    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop