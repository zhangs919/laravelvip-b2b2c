{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2"/>
@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!--列表上面（列表名称、列表显示项设置）-->
    <div class="common-title">
        <div class="ftitle">
            <h3>网点销售统计详情列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record">1</span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">
        {{--引入列表--}}
        @include('store.trade.partials._detail')
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
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=202003261806"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=202003261806"></script>

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
        // 跳转到详情页面
        function go(store_id, start_time, end_time) {
            var url = "/store/trade/detail.html?store_id=" + store_id;
            if ($.trim(start_time) != "") {
                url += "&start_time=" + start_time;
            }
            if ($.trim(end_time) != "") {
                url += "&start_time=" + end_time;
            }
            $.go(url);
        }
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd',
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop