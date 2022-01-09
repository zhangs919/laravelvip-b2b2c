{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <!-- 工具栏（列表名称、列表显示项设置） -->

    <div class="common-title">
        <div class="ftitle">
            <h3>商品列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true>0</span>
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
        @include('goods.lib-goods.partials._scan_preview')

    </div>
    <div class="col-sm-12 m-t-10 p-b-30 text-c">
        <a class="btn btn-primary btn-lg import" href="javascript:void(0);">确认导入</a>
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


{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script type='text/javascript'>
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            $("#btn_search").click(function() {
                var data = $("#SearchModel").serializeJson();
                tablelist.load(data);
            });

            $("body").on("click", ".import", function() {

                var hasrecord = $("#hasrecord").val();

                if (typeof (hasrecord) == "undefined") {
                    $.msg("没有需要导入的商品");
                    return;
                }

                $.open({
                    title: "商品导入",
                    ajax: {
                        url: '/goods/lib-goods/import',
                        data: {
                            ids: 0
                        }
                    },
                    width: "560px",
                    btn: ['确定导入', '取消'],
                    yes: function(index, container) {
                        if (!validator.form()) {
                            return;
                        }

                        var data = $(container).serializeJson();
                        $.loading.start();
                        $.post('/goods/lib-goods/import', data, function(result) {
                            $.loading.stop();
                            if (result.code == 0) {
                                // tablelist.load();
                                $.go("/goods/list/index.html");
                                $.msg(result.message);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }, "json");
                    }
                });
            });

            $("body").on("click", ".del", function() {
                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择要取消导入的商品");
                    return;
                }

                tablelist.remove({
                    confirm: '确认取消导入？',
                    url: '/goods/lib-goods/delete',
                    data: {
                        ids: ids
                    }
                });
            });
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop