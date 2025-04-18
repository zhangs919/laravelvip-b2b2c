{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/groupon-order/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="keyword" class="form-control" type="text" placeholder="商品名称/团编号">
                    </div>
                </div>
            </div>
            <div class="simple-form-field" style="display: none">
                <div class="form-group">
                    <label class="control-label">
                        <span>状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="status" name="status">
                            <option value="groupon_all">全部订单</option>
                            <option value="groupon_active">组团中</option>
                            <option value="groupon_success">组团成功</option>
                            <option value="groupon_fail">组团失败</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
        </form>    </div>
    <!--列表上面（列表名称、列表显示项设置）-->
    <div class="common-title">
        <div class="ftitle">
            <h3>拼团订单列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record=true class="pagination-total-record">1</span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <li id="groupon_all" class="tabs-t current">
                <a>全部订单</a>
            </li>
            <li id="groupon_active" class="tabs-t">
                <a>组团中</a>
            </li>
            <li id="groupon_success" class="tabs-t">
                <a>组团成功</a>
            </li>
            <li id="groupon_fail" class="tabs-t last">
                <a>组团失败</a>
            </li>
        </ul>
    </div>
    <div class="table-responsive order">
        {{--引入列表--}}
        @include('dashboard.groupon-order.partials._list')
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
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            var page_id = "pagination";
            $("#"+page_id+" > .pagination-goto > .goto-input").keyup(function(e) {
                $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $("#"+page_id+" > .pagination-goto > .goto-link").click();
                }
            });
            $("#"+page_id+" > .pagination-goto > .goto-button").click(function() {
                var page = $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page", page);
                $("#"+page_id+" > .pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                if ($("#status").val() != '') {
                    $("li[class^='tabs-']").removeClass('current');
                    $("li[id='" + $("#status").val() + "']").addClass('current');
                } else {
                    $("li[class^='tabs-']").removeClass('current');
                    $("li[id='groupon_all']").addClass('current');
                }
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $("li[class^='tabs-']").click(function() {
                $("li[class^='tabs-']").removeClass('current');
                $(this).addClass('current');
                $("#status").val($(this).attr("id"));
                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load();
            });
        });
        //
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop