{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
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
                        <span>名称：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="layout_name" class="form-control" value="" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>位置：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="position" class="form-control">
                            <option value="">--全部--</option><option value="0">详情顶部</option><option value="1">详情底部</option><option value="2">包装清单</option><option value="3">售后保障</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
                <!-- <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" /> -->
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>详情版式列表</h3>

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
    <!-- 列表 -->
    <div class="table-responsive">

        @include('goods.layout.partials._list')

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
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
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
                if (id === undefined) {
                    var ids = tablelist.checkedValues();
                    if (ids.length == 0) {
                        $.msg("您没有选择任何待处理的数据！");
                        return;
                    }
                    id = ids.join(",");
                }
                if (id) {
                    $.confirm("您确定要删除选择的详情版式吗？", function() {
                        $.loading.start();
                        $.post("delete", {
                            id: id
                        }, function(result) {
                            $.msg(result.message, function(){
                                if (result.code == 0) {
                                    tablelist.load();
                                }
                            });
                        }, "JSON").always(function() {
                            $.loading.stop();
                        });
                    });
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop