@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">
@stop

@section('content')

    <!-- 搜索条件 -->
    <div class="search-term  m-b-10">
        <form id="searchForm" action="index" method="GET">

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>是否启用：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="status" class="form-control">
                            <option value="">请选择</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field" id="group_list">
                <div class="form-group">
                    <label class="control-label">
                        <span>配置分组：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="group" class="form-control chosen-select" id="select_group" style="display: none;">

                            <option value="">所有分组</option>

                            @foreach($configGroups as $vo)
                                <option value="{{ $vo['name'] }}" @if(!empty(request('group')) && request('group') == $vo['name'])selected="true"@endif>{{ $vo['title'] }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>配置标题：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="title" class="form-control" type="text" placeholder="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>配置code：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="code" class="form-control" type="text" placeholder="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
                <!-- <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" /> -->
            </div>
        </form>
    </div>
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>配置列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true"></span>
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


            <span class="rline"></span>


            <div class="editTablebox">
                <a href="javascript:void(0);" class="editBtn">
                    <i class="fa fa-cogs"></i>
                </a>
                <div class="edit-table dropdown-menu animated fadeInDown">
                    <h5>设置表格显示项</h5>
                    <ul>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_article_cat" class="checkBox" checked="checked">

                                <span> 文章分类 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_article_title" class="checkBox" checked="checked">

                                <span> 文章标题 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_add_time" class="checkBox" checked="checked">

                                <span> 发布时间 </span>
                            </label>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- 列表 -->

    @include('system.shop-config-field.partials.config_list')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        var tablelist;
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

            // 批量删除
            $("body").on("click", "#batch-delete", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量删除吗？',
                    url: 'batch-delete',
                    data: {
                        ids: ids
                    }
                });
            });

            $("#select_group_model").change(function() {
                var cat_model = $(this).children('option:selected').val();
                $.post("select-cat-type", {
                    cat_model: cat_model
                }, function(result) {
                    $('#group_list').html(result.data);
                }, "json");
            });
            $('#select_group_chosen').css("cssText", "width:" + $("#select_group").width() + "px !important;");
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $(".config-sort").editable({
                type: "text",
                url: 'edit-config-info',
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
                        return '排序必须是0~255的正整数。';
                    } else if (value > 255) {
                        return '排序必须是0~255的正整数。';
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
@stop