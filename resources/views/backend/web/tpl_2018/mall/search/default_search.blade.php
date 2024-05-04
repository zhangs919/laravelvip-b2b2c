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

    <!--搜索-->
    <!--<div class="search-term m-b-10">
        <form action="javascript:searchGoods()" name="searchForm">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>所属类型：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control">
                        <option value="0">全部</option>
                        <option value="1">默认</option>
                        <option value="2">商品分类</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input class="form-control" type="text" value="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>

            </div>
        </form>
    </div>-->

    <div class="common-title">
        <div class="ftitle">
            <h3>默认搜索词列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
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
    <div class="table-responsive">

        @include('mall.search.partials._list')

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
        $().ready(function() {

            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });

            // 删除某条记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'del',
                    data: {
                        id: id
                    }
                });
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
                    url: 'delall',
                    data: {
                        data: data
                    }
                });
            });

            $("#searchForm").submit(function() {

                return false;
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop