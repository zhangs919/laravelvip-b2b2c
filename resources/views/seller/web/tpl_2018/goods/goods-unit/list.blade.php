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
        <form id="searchForm" action="/goods/goods-unit/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>单位名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="unit_name" id='unit_name' class="form-control" type="text" placeholder="名称">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>商品单位列表</h3>

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
    <!--列表内容-->
    <div class="table-responsive">

        @include('goods.goods-unit.partials._list')

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

            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                tablelist.load({
                    //问题名称
                    'unit_name': $("#unit_name").val(),
                });
                return false;
            });

            $("body").on("click", "#btn-add", function() {
                $.open({
                    title: "添加商品单位",
                    ajax: {
                        url: '/goods/goods-unit/add'
                    },
                    width: "500px",
                    btn: ['确定', '取消'],
                    yes: function(index, container) {
                        if (!validator.form()) {
                            return;
                        }
                        var data = $(container).serializeJson();
                        $.loading.start();
                        $.post('/goods/goods-unit/add', data, function(result) {
                            $.loading.stop();
                            if (result.code == 0) {
                                tablelist.load();
                                $.msg(result.message);
                                $.closeDialog(index);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }, "json");
                    }
                });
            });

            $("body").on("click", ".btn-edit", function() {
                var id = $(this).data("id");
                $.open({
                    title: "编辑商品单位",
                    ajax: {
                        url: '/goods/goods-unit/edit',
                        data: {
                            id: id
                        }
                    },
                    width: "500px",
                    btn: ['确定', '取消'],
                    yes: function(index, container) {
                        if (!validator.form()) {
                            return;
                        }
                        var data = $(container).serializeJson();
                        $.loading.start();
                        $.post('/goods/goods-unit/edit?id=' + id, data, function(result) {
                            $.loading.stop();
                            if (result.code == 0) {
                                tablelist.load();
                                $.msg(result.message);
                                $.closeDialog(index);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }, "json");
                    }
                });
            });

            // 删除
            $("body").on('click', '.del', function() {
                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择要删除的记录！");
                    return;
                }

                $.confirm("您确定要删除选择的记录吗？", function() {
                    $.post("/goods/goods-unit/batch-delete", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            tablelist.load();
                            $.msg(result.message);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json");
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop