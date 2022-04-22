{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="key_word" name="key_word" class="form-control" type="text" value="" placeholder="网点名称/网点ID">
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
            <h3>线下网点列表</h3>

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

        @include('store.default.partials._list')

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
            // 删除网点
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");

                $.confirm('您确定删除这个网点吗？', function() {
                    $.loading.start();
                    $.post("/store/default/delete", {
                        id: id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "JSON").always(function() {
                        $.loading.stop();
                    });
                });
            });
            // 搜索
            $("#searchForm").submit(function() {
                tablelist.load({
                    // 关键字
                    'key_word': $("#key_word").val()
                });
                return false;
            });

            // 批量删除
            $("body").on("click", "#batch-delete", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }

                $.confirm('您确定删除选择的网点吗？', function() {
                    $.loading.start();
                    $.post("/store/default/batch-delete", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "JSON").always(function() {
                        $.loading.stop();
                    });
                });
            });

            // 批量删除
            $("body").on("click", "#btn_set_group", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择待设置分组的网点！");
                    return;
                }

                $.open({
                    type: 1,
                    title: '批量设置网点分组',
                    width: '450px',
                    height: '200px',
                    ajax: {
                        url: '/store/default/group-list'
                    },
                    btn: ['确定', '取消'],
                    yes: function(index, obj) {
                        var group_id = $(obj).find("#group_id").val();

                        $.loading.start();

                        $.post("/store/default/set-group", {
                            group_id: group_id,
                            store_ids: ids
                        }, function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 3000
                                });
                                tablelist.load();
                                $.closeAll();
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }, "JSON").always(function() {
                            $.loading.stop();
                        });
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop