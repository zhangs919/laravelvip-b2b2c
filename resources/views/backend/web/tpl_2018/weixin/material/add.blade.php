{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link href="/assets/d2eace91/js/editor/themes/default/default.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/d2eace91/css/mobile-styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--左侧内容start-->
    <div class="col-sm-3">
        <div class="graphic-material m-t-30 m-l-30">
            <div class="graphic-material-title">
                <h1>高级图文</h1>
            </div>
            <!--中间内容-->
            <div class="graphic-material-con">
                <div class="graphic-material-info">
                    <!--头部封面设置 start-->
                    <div class="graphic-con single-graphic">
                        <h4 class="graphic-title">{{ $info->items[0]->title ?? '标题' }}</h4>
                        <div class="graphic-time">@if(isset($info->id)){{ $info->items[0]->created_at->format('m月d日') }}@else 02月15日 @endif</div>
                        <div class="graphic-wrap">
                            @if(isset($info->items[0]->cover))
                                <img src="{{ get_image_url($info->items[0]->cover) }}" id="cover_img">
                            @else
                                <p>封面图片</p>
                            @endif
                        </div>
                        <div class="graphic-digest">{!! $info->items[0]->abstract ?? '此处显示摘要' !!}</div>
                        <div class="graphic-view">
                            <span>查看全文</span>
                        </div>
                    </div>
                    <!--头部封面设置 eng-->
                </div>
            </div>
        </div>
    </div>
    <!--左侧内容end-->
    <!--右侧内容 start-->
    <div class="table-content m-t-30 col-sm-9">
        <form id="MaterialModel" class="form-horizontal" name="MaterialModel" action="/weixin/material/add" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf
            <input type="hidden" value="{{ $info->id ?? '' }}" name="id">
            <input type="hidden" value="{{ $info->items[0]->id ?? '' }}" name="MaterialModel[id]">
            <!-- 标题 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="materialmodel-title" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">标题：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="materialmodel-title" class="form-control" name="MaterialModel[title]" value="{{ $info->items[0]->title ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 作者 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="materialmodel-author" class="col-sm-4 control-label">

                        <span class="ng-binding">作者：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="materialmodel-author" class="form-control" name="MaterialModel[author]" value="{{ $info->items[0]->author ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 封面 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="materialmodel-cover" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">封面：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="cover_container" class="img-container"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                            <input type="hidden" id="materialmodel-cover" class="form-control" name="MaterialModel[cover]" value="{{ $info->items[0]->cover ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t"> 封面大图-图片建议尺寸：900px*500px，封面小图-图片建议尺寸：200px*200px</div></div>
                    </div>
                </div>
            </div>
            <!-- 摘要 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="materialmodel-abstract" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">摘要：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="materialmodel-abstract" class="form-control" name="MaterialModel[abstract]" rows="5">{!! $info->items[0]->abstract ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 转向链接 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="materialmodel-link" class="col-sm-4 control-label">

                        <span class="ng-binding">转向链接：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="materialmodel-link" class="form-control" name="MaterialModel[link]" value="{{ $info->items[0]->link ?? '' }}" placeholder="http://">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 内容  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="materialmodel-content" class="col-sm-4 control-label">

                        <span class="ng-binding">内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <div class="form-control-box">
                                <!-- 文本编辑器 -->
                                <textarea id="content" class="form-control" name="MaterialModel[content]" rows="5" style="width: 350px; height: 250px; display: none;">{!! $info->items[0]->content ?? '' !!}</textarea>
                            </div>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
            </div>

        </form>
    </div>
    <!--右侧内容 end-->

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
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <!-- AJAX上传 -->
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script id="client_rules" type="text">
[{"id": "materialmodel-title", "name": "MaterialModel[title]", "attribute": "title", "rules": {"required":true,"messages":{"required":"标题不能为空。"}}},{"id": "materialmodel-cover", "name": "MaterialModel[cover]", "attribute": "cover", "rules": {"required":true,"messages":{"required":"封面不能为空。"}}},{"id": "materialmodel-abstract", "name": "MaterialModel[abstract]", "attribute": "abstract", "rules": {"required":true,"messages":{"required":"摘要不能为空。"}}},{"id": "materialmodel-author", "name": "MaterialModel[author]", "attribute": "author", "rules": {"string":true,"messages":{"string":"作者必须是一条字符串。"}}},{"id": "materialmodel-content", "name": "MaterialModel[content]", "attribute": "content", "rules": {"string":true,"messages":{"string":"内容必须是一条字符串。"}}},{"id": "materialmodel-link", "name": "MaterialModel[link]", "attribute": "link", "rules": {"string":true,"messages":{"string":"转向链接必须是一条字符串。"}}},{"id": "materialmodel-title", "name": "MaterialModel[title]", "attribute": "title", "rules": {"string":true,"messages":{"string":"标题必须是一条字符串。","maxlength":"标题只能包含至多30个字符。"},"maxlength":30}},{"id": "materialmodel-link", "name": "MaterialModel[link]", "attribute": "link", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"转向链接不是一条有效的URL。"}}},]
</script>

    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };

            var validator = $("#MaterialModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                if ("" == "") {
                    $.post('/weixin/material/add', $("#MaterialModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/weixin/material/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                } else {
                    $.post('/weixin/material/edit?id=', $("#MaterialModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            $.loading.start();
                            $.go('/weixin/material/list');
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                }
            });

            $("#cover_container").imagegroup({
                host: '{{ get_oss_host() }}',
                size: 1,
                values: ['{{ $info->items[0]->cover ?? '' }}'],
                callback: function(data) {
                    var img = "{{ get_oss_host() }}" + data.path;
                    var src = "<img src='" + img + "'>";
                    src = src.replace("/backend", "backend");
                    $(".graphic-wrap").html(src);
                    $("#materialmodel-cover").val(data.path);
                },
                remove: function(value, values) {
                    var src = '<p>封面图片</p>';
                    $(".graphic-wrap").html(src);
                    $("#materialmodel-cover").val('');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $('#materialmodel-title').bind('input propertychange', function() {
                var val = $("#materialmodel-title").val();
                if (val == '') {
                    $(".graphic-title").html('标题');
                } else {
                    $(".graphic-title").html(val);
                }
            });

            $('#materialmodel-abstract').bind('input propertychange', function() {
                var val = $("#materialmodel-abstract").val();
                if (val == '') {
                    $(".graphic-digest").html('此处显示摘要');
                } else {
                    $(".graphic-digest").html(val);
                }
            });
        });
    </script>

    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=1.2"></script>
    <script type="text/javascript">
        KindEditor.ready(function(K) {
            window.editor = K.create('#content', {
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                uploadJson: "/site/upload-image",
                allowImageUpload: true,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileManager: true,
                syncType: "form",
                afterCreate: function() {
                    var self = this;
                    self.sync();
                },
                afterChange: function() {
                    var self = this;
                    self.sync();
                },
                afterBlur: function() {
                    var self = this;
                    self.sync();
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop