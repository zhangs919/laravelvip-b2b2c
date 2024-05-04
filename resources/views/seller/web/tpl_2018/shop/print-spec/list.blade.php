{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="common-title">
        <div class="ftitle">
            <h3>打印规格列表</h3>

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
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.print-spec.partials._list')

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
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>

    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
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
                $.post("/shop/print-spec/set-is-default", {
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

            $("body").on("click", ".config-printer", function() {
                var id = $(this).data("id");

                $.open({
                    title: '配置打印机',
                    type: 1,
                    width: '500px',
                    height: '300px',
                    ajax: {
                        url: 'config-printer',
                        data: {
                            id: id
                        }
                    },
                    btn: '提交',
                    yes: function(index, container) {
                        var data = $(container).serializeJson();
                        if(data.PrintSpecModel.printer.length == 0 || $.trim(data.PrintSpecModel.printer) == '')
                        {
                            $.msg("请填写打印机名称！");
                            return;
                        }
                        $.loading.start();
                        $.post('/shop/print-spec/config-printer', data, function(result) {
                            $.loading.stop();
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 2000
                                });
                                $.go('list');
                            } else {
                                $.msg(result.message, {
                                    time: 2000
                                })
                            }
                        }, "json");
                    }
                });
            });

            // 删除链接
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");
                tablelist.remove({
                    confirm: "您确定要删除此条规格吗？",
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