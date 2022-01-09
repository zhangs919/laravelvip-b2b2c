{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20180919"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <div class="common-title">
        <div class="ftitle">
            <h3>易联云打印机</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.yly-printer.partials._list')

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

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            $("body").on("click", ".ico-switch", function() {
                var id = $(this).data("id");
                if (id == 0) {
                    return;
                }
                //加载提示
                $.loading.start();
                $.post("/shop/yly-printer/set-is-default", {
                    id: id
                }, function(result) {
                    if (result.code == 0) {
                        tablelist.load();
                    } else {
                        $.msg(result.message, {
                            time: 2000
                        });
                    }
                }, "json");
            })

            // 删除链接
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");
                tablelist.remove({
                    confirm: "您确定要删除此打印机吗？",
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop