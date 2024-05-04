{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/statistics/goods-analyse/sales-chart" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="keyword" name="keyword" class="form-control" type="text" placeholder="商品名称/商品ID">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="scid" class="form-control chosen-select" name="scid" data-width="120">
                            @foreach($shop_cat_list as $key=> $item)
                                <option value="{{ $key }}">{!! $item !!}</option>
                            @endforeach
                            {{--<option value="">-- 请选择分类 --</option>--}}
                            {{--<option value="622"><span>◢</span>&nbsp;啊啊啊</option>--}}
                            {{--<option value="623">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;不不不</option>--}}
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />
            </div>
        </form>
    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>商品销售排行</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <div class="table-responsive">
        {{--引入列表--}}
        @include('statistics.goods-analyse.partials._sales_chart')
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html page元素同级下面--}}
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
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $("#btn_export").click(function() {
                var url = "/statistics/goods-analyse/sales-chart-export";
                url += "?keyword=" + $("#keyword").val();
                url += "&scid=" + $("#scid").val();
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop