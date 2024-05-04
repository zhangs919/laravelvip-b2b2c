{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/mall/contract/audit-access-list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" name="contract_name" placeholder="店铺名称/保障服务 " class="form-control" value="" />
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
                            <option value="1">高级服务</option>
                            <option value="0">初级服务</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="status" class="form-control">
                            <option value="">全部</option>
                            <option value="2">启用</option>
                            <option value="4">禁用</option>
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
            <h3>店铺保障服务列表</h3>

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

        @include('mall.contract.partials._audit_access_list')

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
            // 删除记录
            /* $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            }); */
            //批量开启使用
            $("body").on('click', '#batch_open', function() {
                var data = tablelist.checkedValues();
                if (data.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量开启使用吗？',
                    url: 'batch-open',
                    data: {
                        data: data
                    }
                });
            });
            //批量禁止使用
            $("body").on('click', '#batch_forbidden', function() {
                var data = tablelist.checkedValues();
                if (data.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量禁止使用吗？',
                    url: 'batch-forbidden',
                    data: {
                        data: data
                    }
                });
            });
        });
        // 禁止店铺使用此保障服务
        function forbidden(id, shop, name) {
            tablelist.remove({
                confirm: "您确定要禁止使用" + shop + name + "吗？",
                url: 'forbidden',
                data: {
                    id: id
                }
            });
        }
        // 开启店铺使用此保障服务
        function enabled(id, shop, name) {
            tablelist.remove({
                confirm: "您确定要开启使用 " + shop + name + "吗？",
                url: '/mall/contract/enabled',
                data: {
                    id: id
                }
            });
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop