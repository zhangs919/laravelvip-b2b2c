{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20180809"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20180702"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/mall/contract/list" method="GET">

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="contract_name" placeholder="保障服务名称 " class="form-control" value="" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>是否启用：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="is_open" class="form-control">
                            <option value="">请选择</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>保障类型：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="contract_type" class="form-control">
                            <option value="">请选择</option>
                            <option value="0">初级服务</option>
                            <option value="1">高级服务</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索" />
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>保障服务管理列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>
    <!-- 分类列表 -->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('mall.contract.partials._list')

    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
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
            //批量删除
            $("body").on('click', '#btn_delete', function() {
                var data = tablelist.checkedValues();
                if (data.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定删除这些记录吗？',
                    url: 'deletepl',
                    data: {
                        data: data
                    }
                });
            });

        });
        // 删除某条记录
        function del(id) {
            $.confirm("您确定要删除吗？", {}, function() {
                var url = '/mall/contract/delete';
                $.post(url, {
                    id: id
                }, function(result) {
                    if (result.code == 0) {
                        $.msg('删除成功！', {}, function() {
                            $.loading.start();
                            $.go('/mall/contract/list');
                        });
                    } else {
                        $.alert(result.message);
                    }
                }, 'json');
            });
        }
    </script>

    <script type='text/javascript'>
        $(document).ready(function() {
            $(".contract_sort").editable({
                type: "text",
                url: "/mall/contract/edit-contract-info",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("id");
                    params.title = "contract_sort";
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