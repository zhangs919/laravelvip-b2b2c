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
        <form id="searchForm" action="/mall/contract/audit-list" method="GET">

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="contract_name" placeholder="店铺名称/保障服务 " class="form-control" value="">
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
                        <span>审核状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="status" class="form-control">
                            <option value="">全部</option>
                            <option value="1">待审核</option>
                            <option value="3">审核未通过</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索">
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>保障服务申请列表</h3>

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



        </div>
    </div>
    <!-- 分类列表 -->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('mall.contract.partials._audit_list')

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
            //批量审核通过
            $("body").on('click', '#audit_access', function() {
                var data = tablelist.checkedValues();
                if (data.length == 0){
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量审核通过这些记录吗？',
                    url: 'batch-access',
                    data: {
                        data: data
                    }
                });
            });
            //批量审核拒绝
            $("body").on('click', '#audit_refuse', function() {
                var data = tablelist.checkedValues();
                if (data.length == 0){
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量审核拒绝这些记录吗？',
                    url: 'batch-refuse',
                    data: {
                        data: data
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop