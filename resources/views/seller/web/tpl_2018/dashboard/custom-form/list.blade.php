{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190215"/>
@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/custom-form/list.html" method="GET">		<div class="simple-form-field simple-form-search">
                <div class="form-group">
                    <label class="control-label">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>表单标题：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="name" class="form-control" value="" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索" />
            </div>
        </form>	</div>
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>万能表单列表</h3>

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

    <!-- 表单列表 -->
    {{--引入列表--}}
    @include('dashboard.custom-form.partials._list')

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


{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单复制 -->
    <div class="form-horizontal" id="copy_dialog" style="display: none;">
        <div class="table-content m-t-30">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding">新表单标题：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <input type="text" id="copy_title" class="form-control">
                        </div>
                        <div class="help-block help-block-t">最多输入30个字</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        });

        // 按钮点击
        $('body').on('click', '.view', function() {
        }).on('click', '.copy', function() {
            // 复制表单
            var self = $(this);
            var o_copy_dialog = $('#copy_dialog');
            $.open({
                title: '复制表单',
                area: ['500px', '210px'],
                type: 1,
                content: o_copy_dialog,
                shade: false,
                btn: '创建',
                yes: function() {
                    var o_copy_title = o_copy_dialog.find('#copy_title');
                    var title = $.trim(o_copy_title.val());
                    if (title == '') {
                        $.msg('请输入表单标题');
                        return false;
                    }
                    // 不能大于三个字
                    if (title.length > 30) {
                        $.msg('表单标题最多30个字');
                        return false;
                    }
                    // 表单提交
                    $.loading.start();
                    var form_id = self.data('id');
                    $.post('/dashboard/custom-form/copy.html', {
                        form_id: form_id,
                        title: title
                    }, function(res) {
                        if (res.code == 0) {
                            $.msg(res.message, {
                                time: 1500
                            }, function() {
                                o_copy_title.val('');
                                $.closeAll();
                                tablelist.load();
                            });
                        } else {
                            $.msg(res.message);
                        }
                    }, 'JSON').always(function() {
                        $.loading.stop();
                    });
                }
            });
        }).on('click', '.del', function() {
            var self = $(this);
            var id = self.data('id');
            // 删除
            $.confirm('删除表单，表单收集数据将丢失，您确定删除这条记录吗？', function() {
                $.loading.start();
                $.getJSON('del.html', {
                    'form_id': id
                }, function(res) {
                    if (res.code == 0) {
                        $.msg(res.message, {
                            time: 1500
                        }, function() {
                            // 重新加载当前列表
                            tablelist.load();
                        });
                    } else {
                        $.msg(res.message);
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        }).on('click', '#batch-delete', function() {
            var checked = $('#table_list').find('.checkBox').filter(':checked');
            var len = checked.length;
            if (len == 0) {
                $.msg('请选择要删除的内容');
                return false;
            }
            // 删除
            $.confirm('删除表单，表单收集数据将丢失，您确定删除这些记录吗？', function() {
                $.loading.start();
                // 组装ID数组
                var ids = [];
                checked.each(function() {
                    var val = $(this).val();
                    ids.push(val)
                })

                $.getJSON('del.html', {
                    form_id: ids
                }, function(res) {
                    if (res.code == 0) {
                        $.msg(res.message, {
                            time: 1500
                        }, function() {
                            // 重新加载当前列表
                            tablelist.load();
                        });
                    } else {
                        $.msg(res.message);
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop