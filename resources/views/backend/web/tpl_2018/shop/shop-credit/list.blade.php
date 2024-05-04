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

    <div class="common-title">
        <div class="ftitle">
            <h3>店铺信誉列表</h3>

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


        {{--引入列表--}}
        @include('shop.shop-credit.partials._list')


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
            var tablelist = $("#table_list").tablelist();
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("credit-id");
                var name = $(this).data("credit-name");
                tablelist.remove({
                    confirm: '您确定删除店铺信誉【' + name + '】吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });

            // 批量删除
            $("body").on("click", "#batch-delete", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量删除吗？',
                    url: 'batch-delete',
                    data: {
                        ids: ids
                    }
                });
            });
        });
    </script>

    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script type="text/javascript">
        $("body").on("click", ".upload-img", function() {
            var image = $(this).siblings("img");
            var span = $(this);
            $.imageupload({
                url: $(this).data("url"),
                data: {
                    id: $(this).data("id")
                },
                callback: function(result) {
                    if (result.code == 0) {
                        $(image).attr("src", result.data.url);
                        $(span).html("更换");
                        $(span).attr("class", "btn btn-success btn-xs pos-r upload-img");
                        $.msg(result.message, {
                            time: 2000
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop