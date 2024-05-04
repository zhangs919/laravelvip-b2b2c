{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="ArticleCatModel" class="form-horizontal" name="ArticleCatModel" action="/article/article-cat/edit-category" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="articlecatmodel-cat_id" class="form-control" name="ArticleCatModel[cat_id]" value="{{ $cat_info->cat_id }}">
            <!-- 分类名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlecatmodel-cat_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">分类名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="articlecatmodel-cat_name" class="form-control" name="ArticleCatModel[cat_name]" value="{{ $cat_info->cat_name }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            {{--上级分类--}}
            <section id="cat_list">
                <script src="/assets/d2eace91/js/common.js?v=20180428"></script>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="articlecatmodel-parent_id" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">上级分类：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">{{ $cat_info->parent_cat_name ?? '顶级分类' }}</label><input type="hidden" name="ArticleCatModel[parent_id]" value="{{ $cat_info->parent_id }}">

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $().ready(function() {
                        $("#select_cat_id").change(function() {
                            var cat_id = $(this).children('option:selected').val();
                            $.ajax({
                                url : 'select-cat-type',
                                dataType : 'json',
                                async : false,
                                data : {
                                    cat_id : cat_id,
                                },
                                success : function(result) {
                                    $('#cat_type').html(result.data);
                                }
                            });
                        });
                    });
                </script>
            </section>

            {{--展示形式--}}
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlecatmodel-cat_model" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding"> 展示形式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label">@if($cat_info->cat_model == 1)单网页展示@elseif($cat_info->cat_model == 2)普通展示@endif</label>
                            <input type="hidden" name="ArticleCatModel[cat_model]" value="{{ $cat_info->cat_model }}">

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">单网页展示：此类型文章分类只能添加一篇文章；普通展示：此类型文章分类可添加多篇文章 </div></div>
                    </div>
                </div>
            </div>

            <!-- 分类类型 -->
            <section id="cat_type">	<script src="/assets/d2eace91/js/common.js?v=20180428"></script>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="articlecatmodel-cat_type" class="col-sm-4 control-label">

                            <span class="ng-binding">分类类型：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <label class="control-label">{{ article_cat_type($cat_info->cat_type) }}</label>
                                <input type="hidden" name="ArticleCatModel[cat_type]" value="{{ $cat_info->cat_type }}">

                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">不同分类类型的文章分类，添加的文章控制前台不同页面展示 </div></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 分类图片 -->

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlecatmodel-cat_image" class="col-sm-4 control-label">

                        <span class="ng-binding">分类图片：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="imagegroup_container" class="szy-imagegroup" data-size="1">
                                <ul class="image-group">
                                    <li data-label-index="0" title="点击预览图片"><span title="删除图片" class="image-group-remove">删除图片</span>
                                        <a href="javascript:void(0);" data-value="{{ get_image_url(sysconf('default_article_cat_image')) }}" data-url="{{ get_image_url(sysconf('default_article_cat_image')) }}">
                                            <img src="{{ get_image_url(sysconf('default_article_cat_image')) }}" data-value="{{ get_image_url(sysconf('default_article_cat_image')) }}" data-url="{{ get_image_url(sysconf('default_article_cat_image')) }}">
                                        </a>
                                    </li>
                                    <li class="image-group-button" data-label-index="0" title="点击并选择上传的图片" style="display: none;">
                                        <div class="image-group-bg"></div>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" id="articlecatmodel-cat_image" class="form-control" name="ArticleCatModel[cat_image]" value="{{ sysconf('default_article_cat_image') }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">图片请使用100 * 100像素jpg、gif、png格式的图片，并且图片大小不得超过2M，仅分类类型为普通分类、商城公告、分销帮助中心、信息公告的文章分类需设置</div></div>
                    </div>
                </div>
            </div>
            <!-- 分类描述 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlecatmodel-cat_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">分类描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="articlecatmodel-cat_desc" class="form-control" name="ArticleCatModel[cat_desc]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>


            <!-- 是否显示 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlecatmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ArticleCatModel[is_show]" value="0"><label>
                                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-id-articlecatmodel-is_show bootstrap-switch-animate" style="width: 54px;">
                                            <div class="bootstrap-switch-container" style="width: 78px; margin-left: 0px;">
                                                <input type="checkbox" id="articlecatmodel-is_show" class="form-control b-n" name="ArticleCatModel[is_show]" value="1" checked="" data-on-text="是" data-off-text="否">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制分类是否在前台显示</div></div>
                    </div>
                </div>
            </div>

            <section id="seo_setting"> </section>
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="articlecatmodel-cat_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="articlecatmodel-cat_sort" class="form-control small" name="ArticleCatModel[cat_sort]" value="255">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交">
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
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    [{"id": "articlecatmodel-cat_name", "name": "ArticleCatModel[cat_name]", "attribute": "cat_name", "rules": {"required":true,"messages":{"required":"分类名称不能为空。"}}},{"id": "articlecatmodel-cat_model", "name": "ArticleCatModel[cat_model]", "attribute": "cat_model", "rules": {"required":true,"messages":{"required":" 展示形式不能为空。"}}},{"id": "articlecatmodel-parent_id", "name": "ArticleCatModel[parent_id]", "attribute": "parent_id", "rules": {"required":true,"messages":{"required":"上级分类不能为空。"}}},{"id": "articlecatmodel-cat_sort", "name": "ArticleCatModel[cat_sort]", "attribute": "cat_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "articlecatmodel-parent_id", "name": "ArticleCatModel[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级分类必须是整数。"}}},{"id": "articlecatmodel-cat_type", "name": "ArticleCatModel[cat_type]", "attribute": "cat_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"分类类型必须是整数。"}}},{"id": "articlecatmodel-is_show", "name": "ArticleCatModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "articlecatmodel-cat_level", "name": "ArticleCatModel[cat_level]", "attribute": "cat_level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"分类等级必须是整数。"}}},{"id": "articlecatmodel-cat_image", "name": "ArticleCatModel[cat_image]", "attribute": "cat_image", "rules": {"string":true,"messages":{"string":"分类图片必须是一条字符串。","maxlength":"分类图片只能包含至多255个字符。"},"maxlength":255}},{"id": "articlecatmodel-cat_name", "name": "ArticleCatModel[cat_name]", "attribute": "cat_name", "rules": {"string":true,"messages":{"string":"分类名称必须是一条字符串。","maxlength":"分类名称只能包含至多10个字符。"},"maxlength":10}},{"id": "articlecatmodel-cat_desc", "name": "ArticleCatModel[cat_desc]", "attribute": "cat_desc", "rules": {"string":true,"messages":{"string":"分类描述必须是一条字符串。","maxlength":"分类描述只能包含至多100个字符。"},"maxlength":100}},{"id": "articlecatmodel-cat_sort", "name": "ArticleCatModel[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
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

            var validator = $("#ArticleCatModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ArticleCatModel").submit();

            });

            $("#imagegroup_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: $(this).data("size"),
                values: $('#articlecatmodel-cat_image').val().split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#articlecatmodel-cat_image').val(values);
                    $.validator.clearError($("#articlecatmodel-cat_image"));
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#articlecatmodel-cat_image').val(values);
                }
            });

            $("#select_cat_model").change(function() {
                var cat_model = $(this).children('option:selected').val();
                $.ajax({
                    url: 'select-cat-model',
                    dataType: 'json',
                    async: false,
                    data: {
                        cat_model: cat_model,
                        act: 'add'
                    },
                    success: function(result) {
                        $('#cat_list').html(result.data[0]);
                        $('#seo_setting').html(result.data[1]);
                        $("#cat_type").html(result.data[2]);
                    }
                });
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop