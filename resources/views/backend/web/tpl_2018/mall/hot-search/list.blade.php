{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20180726"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20180702"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="common-title">
        <div class="ftitle">
            <h3>热门搜索词列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
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

        @include('mall.hot-search.partials._list')

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
    <script src="/frontend/js/edit.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180726"></script>

    <script type="text/javascript">
        var tablelist;
        $().ready(function() {

            $(".object_sort").editable({
                type: "text",
                url: "/mall/hot-search/edit-sort",
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("id");
                    params.title = 'sort';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '排序不能为空。';
                    } else if (!ex.test(value)) {
                        return '排序必须是0~255的正整数。';
                    } else if (value > 255) {
                        return '排序必须是0~255的正整数。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });

            tablelist = $("#table_list").tablelist({

            });
            // 删除某条记录
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
            //批量删除
            $("body").on('click', '#btn_delete', function() {
                var data = tablelist.checkedValues();
                if (data.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定删除这些记录吗？',
                    url: 'batch-delete',
                    data: {
                        ids: data
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop