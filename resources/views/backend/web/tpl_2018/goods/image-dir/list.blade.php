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

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/goods/image-dir/list.html" method="GET">
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
                        <span>相册名称：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="dir_name" name="dir_name" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>相册分组：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="dir_group" class="form-control" name="dir_group">
                            <option value="0">--全部--</option>
                            @foreach(image_dir_group() as $key=>$group)
                            <option value="{{ $key }}">{{ $group }}相册</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>相册列表</h3>

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
    @include('goods.image-dir.partials._list')

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

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "imagedir-shop_id", "name": "ImageDir[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺编号不能为空。"}}},{"id": "imagedir-dir_name", "name": "ImageDir[dir_name]", "attribute": "dir_name", "rules": {"required":true,"messages":{"required":"目录名称不能为空。"}}},{"id": "imagedir-add_time", "name": "ImageDir[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"创建时间不能为空。"}}},{"id": "imagedir-shop_id", "name": "ImageDir[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "imagedir-dir_sort", "name": "ImageDir[dir_sort]", "attribute": "dir_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "imagedir-dir_type", "name": "ImageDir[dir_type]", "attribute": "dir_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"相册类型必须是整数。"}}},{"id": "imagedir-add_time", "name": "ImageDir[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "imagedir-dir_name", "name": "ImageDir[dir_name]", "attribute": "dir_name", "rules": {"string":true,"messages":{"string":"目录名称必须是一条字符串。","maxlength":"目录名称只能包含至多60个字符。"},"maxlength":60}},{"id": "imagedir-cover_image", "name": "ImageDir[cover_image]", "attribute": "cover_image", "rules": {"string":true,"messages":{"string":"封面图片必须是一条字符串。","maxlength":"封面图片只能包含至多255个字符。"},"maxlength":255}},{"id": "imagedir-dir_desc", "name": "ImageDir[dir_desc]", "attribute": "dir_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多255个字符。"},"maxlength":255}},{"id": "imagedir-dir_sort", "name": "ImageDir[dir_sort]", "attribute": "dir_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
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

            // 新建相册
            $("#btn_add_dir").click(function() {
                $.loading.start();
                $.open({
                    title: "新建平台方相册",
                    width: "650px",
                    height: "380px",
                    params: {
                        tablelist: tablelist
                    },
                    ajax: {
                        url: 'add',
                    },
                    onshow: function() {
                        $.loading.stop();
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });

            // 编辑
            $("body").on("click", ".edit", function() {
                $.loading.start();
                var id = $(this).data("id");
                $.open({
                    title: "编辑相册信息",
                    width: "650px",
                    height: "380px",
                    params: {
                        tablelist: tablelist
                    },
                    ajax: {
                        url: '/goods/image-dir/edit.html',
                        data: {
                            id: id
                        }
                    },
                    onshow: function() {
                        $.loading.stop();
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });

            $("#sync_to_oss").click(function() {
                $.confirm("您确定要将服务器本地图片同步到阿里云OSS上面吗？当前操作可能会花费很长时间而且请勿中断！", function() {
                    $.progress({
                        url: '/goods/image-dir/sync-to-oss.html',
                        key: 'sync-to-oss',
                        type: 'POST',
                        end: function(){
                            tablelist.load();
                        }
                    });
                });
            });
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop