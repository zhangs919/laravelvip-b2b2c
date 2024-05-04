{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/table/css/jquery.treetable.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/table/css/jquery.treetable.theme.default.css?v=20180702"/>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20180710"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20180702"/>
    <script src="/assets/d2eace91/js/table/jquery.treetable.js?v=20180710"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
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
                    <span>节点标题：</span>
                </label>
                <div class="form-control-wrap">
                    <input type="text" id="node_title" name="node_title" class="form-control" />
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <input type="button" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
        </div>
    </div>


    <!-- 分类列表 -->
    @include('system.node.partials._list')

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
        function expandAll() {
            if ($(this).data("expandAll")) {
                $(".treetable").treetable("collapseAll");
                $(this).data("expandAll", false);
            } else {
                $(".treetable").treetable("expandAll");
                $(this).data("expandAll", true);
            }
        }

        function switch_callback(result, object, value) {
            if (result.code == 0) {
                var cat_ids = result.cat_ids;
                if ($.isArray(cat_ids)) {
                    for (var i = 1; i < cat_ids.length; i++) {
                        var target = $("#cat_" + cat_ids[i]).find(".ico-switch");
                        tablelist.changeSwitch(target, value);
                    }
                }
            }
        }

        $(".treetable").treetable({
            expandable: true,
        });

        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                callback: function() {
                    $(".treetable").treetable({
                        expandable: true,
                    });

                    $(".treetable").treetable("expandAll");

                    var name = $("#node_title").val();

                    if ($.trim(name) != "") {
                        $(".name").each(function() {
                            var html = $(this).html();
                            html = html.replace(name, "<span style='color: red; margin: 0px; padding: 0px;'>" + name + "</span>");
                            $(this).html(html);
                        });
                    }
                }
            });

            $("#btn_submit").click(function() {
                tablelist.load({
                    'name': $("#node_title").val()
                });
                return false;
            });

            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");

                $.confirm('您确定删除这条记录吗？', function() {
                    $.post('/system/node/delete', {
                        id: id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            $.go('/system/node/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            })
                        }
                    }, "json");
                })

            });

            // 导出
            $("#btn_export").click(function() {
                var url = "/system/node/export.html";
                url += "?name=" + $("#name").val();
                $.go(url, null, false);
            });
        });
    </script>

    <script type="text/javascript">
        $().ready(function() {
            $("input[name=name]").focus();
            //条形码扫描触发事件
            $("input[type=text]").bind("keypress", function(event) {
                if (event.keyCode == "13") {
                    $("#btn_submit").click();
                }
            });
        })
    </script>

    <script type='text/javascript'>
        $(document).ready(function() {
            // 排序
            $(".node-sort").editable({
                type: "text",
                url: "edit-info",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("id");
                    params.title = "sort";
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