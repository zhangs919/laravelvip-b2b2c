{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="key_name" name="key_name" class="form-control" value="" />
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
            <h3>关键词回复列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!-- 列表 -->
    <div class="table-responsive">
        @include('shop.weixin-keyword.partials._list')

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
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params : $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                var params = $("#searchForm").serializeJson();
                tablelist.load(params);
                return false;
            });
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm : '您确定删除这条记录吗？',
                    url : 'delete',
                    data : {
                        id : id
                    }
                });
            });
        });

    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop