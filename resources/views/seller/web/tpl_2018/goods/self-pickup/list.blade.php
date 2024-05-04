{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
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

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/goods/self-pickup/list" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="keyword" id='keyword' class="form-control" type="text" placeholder="自提点名称/地址">
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>
                <!-- <button class="btn btn-default m-r-5">导出</button> -->

            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>自提点列表</h3>

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
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('goods.self-pickup.partials._list')

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
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
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
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                tablelist.load({
                    //问题名称
                    'keyword': $("#keyword").val(),
                });
                return false;
            });
        });
        // 删除记录
        $("body").on('click', '.del', function() {
            var id = $(this).attr("object_id");
            $.confirm('您确定删除这条记录吗？', function() {
                $.loading.start();
                $.post('/goods/self-pickup/delete', {
                    id: id
                }, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, function(){
                            $.go('list');
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        })
                    }
                }, "json").always(function(){
                    $.loading.stop();
                });
            })
        });
        //
        $(function(){
            // 排序
            $(".sort-edit").editable({
                type: "text",
                url: "/goods/self-pickup/edit-sort",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.pickup_id = $(this).data("pickup_id");
                    params.title = 'sort';
                    return params;
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function(value, sourceData) {
                    // 显示整数
                    $(this).html((Number(value)).toFixed(0));
                }
            });
        })
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop