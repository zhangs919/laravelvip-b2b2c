{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181019"/>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20180919"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20181019"/>
@stop

{{--content--}}
@section('content')

    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>网点分组列表</h3>

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

        {{--引入列表--}}
        @include('store.group.partials._list')

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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            function open(id) {

                if (id) {
                    url = '/store/group/edit?id=' + id;
                } else {
                    url = '/store/group/add';
                }

                $.open({
                    type: 1,
                    title: id ? '编辑网点分组' : '添加网点分组',
                    area: ['550px', '240px'],
                    ajax: {
                        url: url,
                    },
                    btn: ['确认提交', '取消'],
                    yes: function(index, obj) {
                        if (!validator.form()) {
                            return;
                        }

                        //加载提示
                        $.loading.start();

                        var data = $(obj).serializeJson();
                        $.post(url, data, function(result) {
                            if (result.code == 0) {
                                tablelist.load();
                                $.msg(result.message, {
                                    time: 3000
                                });
                                $.closeAll();
                            } else {
                                $.msg(result.message);
                            }
                        }, "JSON").always(function() {
                            $.loading.stop();
                        });
                    }
                });
            }

            // 添加
            $("#btn_add_store_group").click(function() {
                open();
            });

            // 编辑
            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");
                open(id);
            });

            // 删除
            $("body").on("click", ".del", function() {
                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择要删除网点分组");
                    return;
                }

                $.confirm("您确定要删除选择的网点分组吗？", function() {
                    $.post("/store/group/delete", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
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

    <script type='text/javascript'>
        $(document).ready(function() {
            $(".group_sort").editable({
                type: "text",
                url: "/store/group/edit-group-info",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("id");
                    params.title = "group_sort";
                    return params;
                },
                success: function(response, newValue) {
                    var response = eval("(" + response + ")");
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop