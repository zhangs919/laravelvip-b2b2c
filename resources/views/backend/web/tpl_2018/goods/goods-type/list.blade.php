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
        <form id="searchForm" action="query" method="GET">
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
                        <span>类型名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="type_name" name="type_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索">
            </div>
        </form>
    </div>
    <!-- 工具栏 -->

    <div class="common-title">
        <div class="ftitle">
            <h3>商品类型列表</h3>

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


            <span class="rline"></span>


            <div class="editTablebox">
                <a href="javascript:void(0);" class="editBtn">
                    <i class="fa fa-cogs"></i>
                </a>
                <div class="edit-table dropdown-menu animated fadeInDown">
                    <h5>设置表格显示项</h5>
                    <ul>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_type_id" class="checkBox" checked="checked">

                                <span> 编号 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_type_name" class="checkBox" checked="checked">

                                <span> 类型名称 </span>
                            </label>
                        </li>





                        <li>
                            <label>

                                <input type="checkbox" id="editColumn_type_desc" class="checkBox" checked="checked">

                                <span> 类型描述 </span>
                            </label>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>

    {{--引入列表--}}
    @include('goods.goods-type.partials._list')

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
            $("#searchForm").submit(function() {
                tablelist.load({
                    'type_name': $("#type_name").val()
                });
                return false;
            });
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).attr("object_id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // toggle `popup` / `inline` mode
            // $.fn.editable.defaults.mode = "popup";

            $(".type_sort").editable({
                type: "text",
                url: "/goods/goods-type/edit-sort",
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.type_id = $(this).data("type_id");
                    params.title = 'type_sort';
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
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop