{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/shop/shipping/list" method="GET">
            <div class="simple-form-field simple-form-search">
                <div class="form-group">
                    <label class="control-label">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>快递公司名称：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="shipping_name" class="form-control" value="" />
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
            <h3>快递公司列表</h3>

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
    <!-- 列表 -->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.shipping.partials._list')

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

            // 删除打印规格
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