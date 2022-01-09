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
        <form id="searchForm" action="/goods/brand/list" method="GET">
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
                        <span>商品品牌：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="brand_name" name="brand_name" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">

                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出">

            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>品牌列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true"></span>
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
    @include('goods.brand.partials._list')

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

    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                var params = $("#searchForm").serializeJson();
                tablelist.load(params);
                return false;
            });
            // 删除记录
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

            $("#btn_export").click(function() {
                var url = "/goods/brand/export?brand_name=" + $("#brand_name").val();
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
            });
        });
    </script>
    <script type="text/javascript">
        $("body").on("click", ".upload-img", function() {
            var image = $(this).siblings("a");
            var span = $(this);
            $.imageupload({
                url: $(this).data("url"),
                data: {
                    id: $(this).data("id")
                },
                callback: function(result) {
                    if (result.code == 0) {
                        $(image).attr("ref", result.data.url);
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(".brand_sort").editable({
                type: "text",
                url: "/goods/brand/edit-sort",
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.brand_id = $(this).data("brand_id");
                    params.title = 'brand_sort';
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