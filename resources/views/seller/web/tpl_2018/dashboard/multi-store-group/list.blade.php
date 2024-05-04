{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2"/>
@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>门店分组列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
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
        @include('dashboard.multi-store-group.partials._list')

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

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        //
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
            function open(id) {
                if (id) {
                    url = '/dashboard/multi-store-group/edit?id=' + id;
                } else {
                    url = '/dashboard/multi-store-group/add';
                }
                $.loading.start();
                $.open({
                    type: 1,
                    title: id ? '编辑门店分组' : '添加门店分组',
                    area: ['600px', '280px'],
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
                }).always(function () {
                    $.loading.stop();
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
                    $.msg("请选择要删除门店分组");
                    return;
                }
                $.confirm("您确定要删除选择的门店分组吗？", function() {
                    $.loading.start();
                    $.post("/dashboard/multi-store-group/delete.html", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 1500
                            }, function () {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json").always(function () {
                        $.loading.stop();
                    });
                });
            });
            // 关联商品
            $("body").on("click", ".group_related_goods", function() {
                var url = "store-related-goods.html";
                var show_seller_goods = '';
                var group_id = $(this).data('groupid');
                var group_name = $(this).data('groupname');
                if (!group_id) {
                    $.msg("您没有选择待关联商品的门店分组");
                    return;
                }
                $.loading.start();
                $.open({
                    type: 1,
                    title: "为门店分组【" + group_name + "】 <b>增量式</b> 关联商品",
                    width: Math.min($(window).width() - 50, 900),
                    height: $(window).height() - 100,
                    ajax: {
                        url: url,
                        data: {
                            group_id: group_id,
                            show_seller_goods: show_seller_goods
                        }
                    },
                    success: function(layero, index) {
                        if ($(layero).find(":radio:checked").val() == 4) {
                            layer.style(index, {
                                height: $(window).height() - 100,
                                top: '50px'
                            });
                        } else {
                            layer.style(index, {
                                height: '250px',
                                top: '180px'
                            });
                        }
                        $(layero).find(":radio").click(function() {
                            var val = $(this).val();
                            if (val == 4) {
                                layer.style(index, {
                                    height: $(window).height() - 100,
                                    top: '50px'
                                });
                            } else {
                                layer.style(index, {
                                    height: '250px',
                                    top: '180px'
                                });
                            }
                        });
                    }
                });
            });
            //门店分组设置活动
            $("body").on("click", ".set_store_act", function() {
                var id = $(this).data('groupid');
                var name = $(this).data('groupname');
                if (!id) {
                    $.msg("您没有选择待设置活动的门店分组！");
                    return;
                }
                var visit_url = "/dashboard/multi-store-group/set-activity.html?group_id=" + id;
                activity_setting(id, visit_url, '门店分组【' + name + '】活动参与设置')
            });
            function activity_setting(ids, url, title) {
                $.open({
                    type: 1,
                    title: title,
                    width: '390px',
                    ajax: {
                        url: url
                    },
                    btn: ['确定', '取消'],
                    yes: function(index, obj) {
                        var data = $(obj).find("#act_form").serializeJson();
                        $.loading.start();
                        $.post("/dashboard/multi-store-group/set-activity.html", {
                            data: data,
                            group_ids: ids
                        }, function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 3000
                                }, function() {
                                    tablelist.load();
                                    $.closeAll();
                                });
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
            }
        });
        //
        $(document).ready(function() {
            $(".group_sort").editable({
                type: "text",
                url: "/dashboard/multi-store-group/edit-group-info",
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
                },
                error: function(response, newValue) {
                }
            });
        });

    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop