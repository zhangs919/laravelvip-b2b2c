{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
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
                    <span>关键词：</span>
                </label>
                <div class="form-control-wrap">
                    <input type="text" id="keywords" class="form-control" placeholder="请输入规格名称或者描述">
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <input type="button" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
        </div>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>规格列表</h3>

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

    {{--引入列表--}}
    @include('goods.attribute.partials._spec_list')

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
            // 搜索
            $("#btn_submit").click(function() {
                tablelist.load({
                    'type_name': $("#type_name").val(),
                    'keywords': $("#keywords").val(),
                });
                return false;
            });
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");
                tablelist.remove({
                    confirm: '您确定删除这条规格记录以及规格所关联的规格值吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });

            //批量删除
            $("body").on("click", ".delete-spec", function() {

                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids) {
                    $.msg("请选择要删除的规格");
                    return;
                }

                $.confirm("您确定要删除吗？", function() {
                    $.loading.start();
                    $.post('/goods/attribute/batch-delete', {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.loading.stop();
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.loading.stop();
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json");
                });
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".attr_sort").editable({
                type: "text",
                url: "/goods/attribute/edit-attr-info",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.id = $(this).data("id");
                    params.title = "attr_sort";
                    return params;
                },
                success: function(response, newValue) {
                    var response = eval("(" + response + ")");
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop