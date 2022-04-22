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

    <div class="table-content m-t-30 clearfix">
        <form id="TopicModel" class="form-horizontal" name="TopicModel" action="/topic/topic/add" method="post" enctype="multipart/form-data" novalidate="novalidate">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="topicmodel-topic_id" class="form-control" name="TopicModel[topic_id]" value="{{ $info->topic_id ?? '' }}">
            <!-- 活动名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="topicmodel-topic_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">活动名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="topicmodel-topic_name" class="form-control" name="TopicModel[topic_name]" value="{{ $info->topic_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入30个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 关键字 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="topicmodel-keywords" class="col-sm-4 control-label">

                        <span class="ng-binding">关键字：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="topicmodel-keywords" class="form-control" name="TopicModel[keywords]" value="{{ $info->keywords ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入50个字，请用英文半角逗号分隔，主要用于SEO推广优化</div></div>
                    </div>
                </div>
            </div>

            <!-- 头部样式-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="topicmodel-header_style" class="col-sm-4 control-label">

                        <span class="ng-binding">去除头部（PC端）：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="TopicModel[header_style]" value="">
                            <div id="topicmodel-header_style" class="extend_condition" name="TopicModel[header_style]" selection="[&quot;&quot;]">
                                @if(isset($info->topic_id))
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[header_style][]" value="1" @if(in_array(1, $info->header_style)) checked @endif> 商城顶部导航</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[header_style][]" value="2" @if(in_array(2, $info->header_style)) checked @endif> 头部信息</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[header_style][]" value="3" @if(in_array(3, $info->header_style)) checked @endif> 商城主导航</label>
                                @else
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[header_style][]" value="1"> 商城顶部导航</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[header_style][]" value="2"> 头部信息</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[header_style][]" value="3"> 商城主导航</label>
                                @endif
                            </div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">商城顶部导航指商城最顶部导航栏；头部信息指商城logo、搜索框、搜索框左右广告图</div></div>
                    </div>
                </div>
            </div>

            <!-- 底部样式-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="topicmodel-bottom_style" class="col-sm-4 control-label">

                        <span class="ng-binding">去除底部（PC端）：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="TopicModel[bottom_style]" value="">
                            <div id="topicmodel-bottom_style" class="extend_condition" name="TopicModel[bottom_style]" selection="[&quot;&quot;]">
                                @if(isset($info->topic_id))
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[bottom_style][]" value="1" @if(in_array(1, @$info->bottom_style)) checked @endif> 底部广告</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[bottom_style][]" value="2" @if(in_array(2, @$info->bottom_style)) checked @endif> 友情链接</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[bottom_style][]" value="3" @if(in_array(3, @$info->bottom_style)) checked @endif> 帮助中心</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[bottom_style][]" value="4" @if(in_array(4, @$info->bottom_style)) checked @endif> 底部信息</label>
                                @else
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[bottom_style][]" value="1"> 底部广告</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[bottom_style][]" value="2"> 友情链接</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[bottom_style][]" value="3"> 帮助中心</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="TopicModel[bottom_style][]" value="4"> 底部信息</label>
                                @endif
                            </div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">底部广告指帮助文章上方的广告图；帮助中心指商城底部的帮助文章；底部信息指帮助文章下方的所有内容</div></div>
                    </div>
                </div>
            </div>
            <!-- 描述 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="topicmodel-describe" class="col-sm-4 control-label">

                        <span class="ng-binding">描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="topicmodel-describe" class="form-control" name="TopicModel[describe]" rows="5">{{ $info->describe ?? '' }}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入100个字，请用英文半角逗号分隔，主要用于SEO推广优化</div></div>
                    </div>
                </div>
            </div>
            <!-- 分享推广图 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="topicmodel-share_image" class="col-sm-4 control-label">

                        <span class="ng-binding">分享推广图：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="imagegroup_container" class="szy-imagegroup" data-size="1">
                                <ul class="image-group">
                                    <li class="image-group-button" data-label-index="0" title="点击并选择上传的图片">
                                        <div class="image-group-bg"></div>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" id="topicmodel-share_image" class="form-control" name="TopicModel[share_image]" value="{{ $info->share_image ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">此推广图应用于分享功能处显示，建议上传正方形图片，最佳显示尺寸为80*80像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交">

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "topicmodel-topic_name", "name": "TopicModel[topic_name]", "attribute": "topic_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "topicmodel-keywords", "name": "TopicModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键字必须是一条字符串。","maxlength":"关键字只能包含至多50个字符。"},"maxlength":50}},{"id": "topicmodel-describe", "name": "TopicModel[describe]", "attribute": "describe", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多100个字符。"},"maxlength":100}},{"id": "topicmodel-add_time", "name": "TopicModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "topicmodel-update_time", "name": "TopicModel[update_time]", "attribute": "update_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"更新时间必须是整数。"}}},{"id": "topicmodel-is_delete", "name": "TopicModel[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Delete必须是整数。"}}},{"id": "topicmodel-site_id", "name": "TopicModel[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点id必须是整数。"}}},{"id": "topicmodel-shop_id", "name": "TopicModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺id必须是整数。"}}},{"id": "topicmodel-header_style", "name": "TopicModel[header_style]", "attribute": "header_style", "rules": {"string":true,"messages":{"string":"去除头部（PC端）必须是一条字符串。","maxlength":"去除头部（PC端）只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-bottom_style", "name": "TopicModel[bottom_style]", "attribute": "bottom_style", "rules": {"string":true,"messages":{"string":"去除底部（PC端）必须是一条字符串。","maxlength":"去除底部（PC端）只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-bg_image", "name": "TopicModel[bg_image]", "attribute": "bg_image", "rules": {"string":true,"messages":{"string":"背景图片必须是一条字符串。","maxlength":"背景图片只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-bg_color", "name": "TopicModel[bg_color]", "attribute": "bg_color", "rules": {"string":true,"messages":{"string":"背景颜色必须是一条字符串。","maxlength":"背景颜色只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-m_bg_image", "name": "TopicModel[m_bg_image]", "attribute": "m_bg_image", "rules": {"string":true,"messages":{"string":"手机端背景图片必须是一条字符串。","maxlength":"手机端背景图片只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-m_bg_color", "name": "TopicModel[m_bg_color]", "attribute": "m_bg_color", "rules": {"string":true,"messages":{"string":"手机端背景颜色必须是一条字符串。","maxlength":"手机端背景颜色只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-share_image", "name": "TopicModel[share_image]", "attribute": "share_image", "rules": {"string":true,"messages":{"string":"分享推广图必须是一条字符串。","maxlength":"分享推广图只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-topic_name", "name": "TopicModel[topic_name]", "attribute": "topic_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多30个字符。"},"maxlength":30}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#TopicModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#TopicModel").submit();

            });

            $("#imagegroup_container").imagegroup({
                // host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/",
                host: "{{ get_oss_host() }}",
                size: $(this).data("size"),
                values: $('#topicmodel-share_image').val().split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    console.info(data);
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#topicmodel-share_image').val(values);
                    $.validator.clearError($("#topicmodel-share_image"));
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $('#topicmodel-share_image').val(values);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop