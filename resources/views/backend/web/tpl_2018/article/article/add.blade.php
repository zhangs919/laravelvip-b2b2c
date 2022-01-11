{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link href="/assets/d2eace91/js/editor/themes/default/default.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 隐藏域 -->
    <input type="hidden" id="articlemodel-article_id" class="form-control" name="ArticleModel[article_id]">
    <div class="table-content m-t-30 clearfix">
        <form id="ArticleModel" class="form-horizontal" name="ArticleModel" action="/article/article/add?cat_model={{ $cat_model }}&amp;show_cat_type={{ $show_cat_type }}" method="post" novalidate="novalidate">
            {{ csrf_field() }}
            <!-- 文章分类 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-cat_id" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">文章分类：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            {{--<div class="chosen-container chosen-container-single" title="">
                                <a class="chosen-single" tabindex="-1">
                                    <span>-- 请选择分类 --</span>
                                    <div>
                                        <b></b>
                                    </div>
                                </a>
                                <div class="chosen-drop">
                                    <div class="chosen-search">
                                        <input type="text" autocomplete="off" class="valid" aria-invalid="false">
                                    </div>
                                    <ul class="chosen-results"></ul>
                                </div>
                            </div>--}}
                            <select name="ArticleModel[cat_id]" class="form-control chosen-select" style="display: none;">

                                <option value="0" selected="true">-- 请选择分类 --</option>

                                @if(!empty($cat_list))
                                @foreach($cat_list as $v)
                                    <option value="{{ $v['cat_id'] }}" @if(!$v['active']) disabled="true" @endif>{!! $v['title_show'] !!}</option>
                                @endforeach
                                @endif

                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 文章标题 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-title" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">文章标题：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-title" class="form-control" name="ArticleModel[title]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入40个字</div></div>
                    </div>
                </div>
            </div>

            <!-- 关键字 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-keywords" class="col-sm-3 control-label">

                        <span class="ng-binding">关键字：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-keywords" class="form-control" name="ArticleModel[keywords]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入50个字，多关键词之间用空格或者“,”隔开</div></div>
                    </div>
                </div>
            </div>

            <!-- 发布时间 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-add_time" class="col-sm-3 control-label">

                        <span class="ng-binding">发布时间：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">



                            <input type="text" id="start_date" class="form-control form_datetime" name="ArticleModel[add_time]" value="{{ date('Y-m-d H:i:s', time()) }}">



                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如果设置了发布时间，则会定时发布；如果未设置，则立即发布</div></div>
                    </div>
                </div>
            </div>

            <!-- 文章来源 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-source" class="col-sm-3 control-label">

                        <span class="ng-binding">来源：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-source" class="form-control" name="ArticleModel[source]">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 缩略图 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-article_thumb" class="col-sm-4 control-label">

                        <span class="ng-binding">文章缩略图：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="imagegroup_container" class="szy-imagegroup" data-size="1"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                            <input type="hidden" id="articlemodel-article_thumb" class="form-control" name="ArticleModel[article_thumb]" value="">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">文章缩略图展示在PC和手机端的资讯频道文章列表页面，建议上传260*150像素的图片</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否显示 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ArticleModel[is_show]" value="0">
                                    <label>
                                    @if(isset($info->is_show))
                                        <input type="checkbox" id="articlemodel-is_show" class="form-control b-n"
                                               name="ArticleModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                               data-off-text="否">
                                    @else
                                        <input type="checkbox" id="articlemodel-is_show" class="form-control b-n"
                                               name="ArticleModel[is_show]" value="1" checked data-on-text="是"
                                               data-off-text="否">
                                    @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制文章是否在PC前台资讯频道文章列表显示</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否推荐 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-is_recommend" class="col-sm-4 control-label">

                        <span class="ng-binding">是否推荐：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ArticleModel[is_recommend]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="articlemodel-is_show" class="form-control b-n"
                                                   name="ArticleModel[is_recommend]" value="1" @if($info->is_recommend == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="articlemodel-is_recommend" class="form-control b-n"
                                                   name="ArticleModel[is_recommend]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制文章是否在前台文章列表推荐位上展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 文章摘要 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-summary" class="col-sm-3 control-label">

                        <span class="ng-binding">文章摘要：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <textarea id="articlemodel-summary" class="form-control" name="ArticleModel[summary]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入100个字</div></div>
                    </div>
                </div>
            </div>

            <!-- 文章内容 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-content" class="col-sm-3 control-label">

                        <span class="ng-binding">文章内容：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <div class="form-control-box">
                                <!-- 文本编辑器 -->
                                <textarea id="content" class="form-control" name="ArticleModel[content]" rows="5" style="width: 700px; height: 350px; display: none;"></textarea>
                            </div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlemodel-sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="articlemodel-sort" class="form-control small" name="ArticleModel[sort]" value="255">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围0~9999，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <button id="btn_submit" class="btn btn-primary btn-lg">确认提交</button>
            </div>
        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
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
    <!-- 时间插件引入 start -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=1.2">
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
    <!-- 时间插件引入 end -->
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>

    <!-- 验证规则 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180528"></script>
    <script id="client_rules" type="text">
    [{"id": "articlemodel-cat_id", "name": "ArticleModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"文章分类不能为空。"}}},{"id": "articlemodel-title", "name": "ArticleModel[title]", "attribute": "title", "rules": {"required":true,"messages":{"required":"文章标题不能为空。"}}},{"id": "articlemodel-sort", "name": "ArticleModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "articlemodel-article_id", "name": "ArticleModel[article_id]", "attribute": "article_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"文章ID必须是整数。"}}},{"id": "articlemodel-cat_id", "name": "ArticleModel[cat_id]", "attribute": "cat_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"文章分类必须是整数。"}}},{"id": "articlemodel-is_comment", "name": "ArticleModel[is_comment]", "attribute": "is_comment", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许评论必须是整数。"}}},{"id": "articlemodel-click_number", "name": "ArticleModel[click_number]", "attribute": "click_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"点击量必须是整数。"}}},{"id": "articlemodel-is_show", "name": "ArticleModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "articlemodel-user_id", "name": "ArticleModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发布人ID必须是整数。"}}},{"id": "articlemodel-status", "name": "ArticleModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核状态必须是整数。"}}},{"id": "articlemodel-is_recommend", "name": "ArticleModel[is_recommend]", "attribute": "is_recommend", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否推荐必须是整数。"}}},{"id": "articlemodel-content", "name": "ArticleModel[content]", "attribute": "content", "rules": {"string":true,"messages":{"string":"文章内容必须是一条字符串。"}}},{"id": "articlemodel-goods_ids", "name": "ArticleModel[goods_ids]", "attribute": "goods_ids", "rules": {"string":true,"messages":{"string":"Goods Ids必须是一条字符串。"}}},{"id": "articlemodel-source", "name": "ArticleModel[source]", "attribute": "source", "rules": {"string":true,"messages":{"string":"来源必须是一条字符串。"}}},{"id": "articlemodel-extend_cat", "name": "ArticleModel[extend_cat]", "attribute": "extend_cat", "rules": {"string":true,"messages":{"string":"附加分类必须是一条字符串。"}}},{"id": "articlemodel-link", "name": "ArticleModel[link]", "attribute": "link", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"转向连接不是一条有效的URL。"}}},{"id": "articlemodel-title", "name": "ArticleModel[title]", "attribute": "title", "rules": {"string":true,"messages":{"string":"文章标题必须是一条字符串。","maxlength":"文章标题只能包含至多40个字符。"},"maxlength":40}},{"id": "articlemodel-keywords", "name": "ArticleModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键字必须是一条字符串。","maxlength":"关键字只能包含至多50个字符。"},"maxlength":50}},{"id": "articlemodel-summary", "name": "ArticleModel[summary]", "attribute": "summary", "rules": {"string":true,"messages":{"string":"文章摘要必须是一条字符串。","maxlength":"文章摘要只能包含至多100个字符。"},"maxlength":100}},{"id": "articlemodel-article_thumb", "name": "ArticleModel[article_thumb]", "attribute": "article_thumb", "rules": {"string":true,"messages":{"string":"文章缩略图必须是一条字符串。","maxlength":"文章缩略图只能包含至多255个字符。"},"maxlength":255}},{"id": "articlemodel-sort", "name": "ArticleModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于9999。"},"min":0,"max":9999}},]
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
            var validator = $("#ArticleModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ArticleModel").submit();

            });

            $("#imagegroup_container").imagegroup({
                // host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
                host: "{{ get_oss_host() }}",
                size: $(this).data("size"),
                values: $('#articlemodel-article_thumb').val().split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#articlemodel-article_thumb').val(values);
                    $.validator.clearError($("#articlemodel-article_thumb"));
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#articlemodel-article_thumb').val(values);
                }
            });

        });
    </script>

    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd hh:ii:ss',
        });
    </script>


    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
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