{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <link rel="stylesheet" href="/css/mj-style.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <!--列表上面（列表名称、列表显示项设置）-->

    {{--引入列表--}}
    @include('goods.image-dir.partials._list')

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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180710"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "imagedir-shop_id", "name": "ImageDir[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺编号不能为空。"}}},{"id": "imagedir-dir_name", "name": "ImageDir[dir_name]", "attribute": "dir_name", "rules": {"required":true,"messages":{"required":"目录名称不能为空。"}}},{"id": "imagedir-add_time", "name": "ImageDir[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"创建时间不能为空。"}}},{"id": "imagedir-dir_sort", "name": "ImageDir[dir_sort]", "attribute": "dir_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "imagedir-shop_id", "name": "ImageDir[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "imagedir-dir_sort", "name": "ImageDir[dir_sort]", "attribute": "dir_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "imagedir-dir_type", "name": "ImageDir[dir_type]", "attribute": "dir_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"相册类型必须是整数。"}}},{"id": "imagedir-add_time", "name": "ImageDir[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "imagedir-dir_name", "name": "ImageDir[dir_name]", "attribute": "dir_name", "rules": {"string":true,"messages":{"string":"目录名称必须是一条字符串。","maxlength":"目录名称只能包含至多60个字符。"},"maxlength":60}},{"id": "imagedir-cover_image", "name": "ImageDir[cover_image]", "attribute": "cover_image", "rules": {"string":true,"messages":{"string":"封面图片必须是一条字符串。","maxlength":"封面图片只能包含至多255个字符。"},"maxlength":255}},{"id": "imagedir-dir_desc", "name": "ImageDir[dir_desc]", "attribute": "dir_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多255个字符。"},"maxlength":255}},{"id": "imagedir-dir_sort", "name": "ImageDir[dir_sort]", "attribute": "dir_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
    <script type="text/javascript">
        $().ready(function() {

            var tablelist = $("#table_list").tablelist();

            var validator = null;

            function resetValidator(form) {
                validator = $(form).validate();
                // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                $.validator.addRules($("#client_rules").html(), {
                    form: $(form)
                });
            }

            // 上传图片
            $("#btn_upload_image").click(function() {
                $.loading.start();
                //重置验证器
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        title: "上传图片",
                        trigger: $(this),
                        params: {
                            tablelist: tablelist
                        },
                        ajax: {
                            url: 'upload-image',
                        },
                        onshow: function() {
                            $.loading.stop();
                        }
                    });
                }
                return false;
            });

            // 新建相册
            $("#btn_add_dir").click(function() {
                $.loading.start();
                //重置验证器
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        title: "创建图片相册",
                        width:550,
                        trigger: $(this),
                        params: {
                            tablelist: tablelist
                        },
                        ajax: {
                            url: 'add',
                        },
                        onshow: function() {
                            $.loading.stop();
                        }
                    });
                }
                return false;
            });

            // 批量新建相册
            $("#btn_batch_add_dir").click(function() {
                $.loading.start();
                //重置验证器
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        title: "创建图片相册",
                        width:550,
                        trigger: $(this),
                        params: {
                            tablelist: tablelist
                        },
                        ajax: {
                            url: 'add',
                            data: {
                                is_batch: 1
                            }
                        },
                        onshow: function() {
                            $.loading.stop();
                        }
                    });
                }
                return false;
            });

            // 编辑
            $("body").on("click", ".edit", function() {
                $.loading.start();
                var id = $(this).data("id");
                //重置验证器
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        title: "编辑图片相册",
                        width:550,
                        trigger: $(this),
                        params: {
                            tablelist: tablelist
                        },
                        ajax: {
                            url: 'edit',
                            data: {
                                id: id
                            }
                        },
                        onshow: function() {
                            $.loading.stop();
                        }
                    });
                }
                return false;
            });

            // 删除
            $("body").on("click", ".delete", function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: "您确定要删除这条记录吗？",
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