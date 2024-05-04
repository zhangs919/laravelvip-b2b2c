<div id="{{ $page_id }}">
    <!-- 温馨提示 -->

    <div class="table-content m-t-30 clearfix">
        <form id="TopicModel" class="form-horizontal" name="TopicModel" action="/topic/topic/bg-setting?page={{ $page }}&amp;topic_id={{ $info->topic_id }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf

            <!-- 背景颜色 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="topicmodel-bg_color" class="col-sm-4 control-label">

                        <span class="ng-binding">背景颜色：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div style="width:145px;" class="evo-cp-wrap">
                                <input type="text" id="topicmodel-bg_color" class="form-control colorpicker w100 colorPicker evo-cp0" name="TopicModel[bg_color]" value="{{ $info->bg_color ?? '#ffffff' }}">
                            </div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!--  背景图片 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="topicmodel-bg_image" class="col-sm-4 control-label">

                        <span class="ng-binding">背景图片：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="bg_image_imagegroup_container" class="szy-imagegroup" data-id="topicmodel-bg_image" data-size="1"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                            <input type="hidden" id="topicmodel-bg_image" class="form-control" name="TopicModel[bg_image]" value="{{ $info->bg_image }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请上传宽度为1920 像素的 jpg,gif,png格式的图片</div></div>
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
</div>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<!--选色插件-->
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=1.2">
<script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "topicmodel-topic_name", "name": "TopicModel[topic_name]", "attribute": "topic_name", "rules": {"required":true,"messages":{"required":"活动名称不能为空。"}}},{"id": "topicmodel-keywords", "name": "TopicModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键字必须是一条字符串。","maxlength":"关键字只能包含至多50个字符。"},"maxlength":50}},{"id": "topicmodel-describe", "name": "TopicModel[describe]", "attribute": "describe", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多100个字符。"},"maxlength":100}},{"id": "topicmodel-add_time", "name": "TopicModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "topicmodel-update_time", "name": "TopicModel[update_time]", "attribute": "update_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"更新时间必须是整数。"}}},{"id": "topicmodel-is_delete", "name": "TopicModel[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Delete必须是整数。"}}},{"id": "topicmodel-site_id", "name": "TopicModel[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点id必须是整数。"}}},{"id": "topicmodel-shop_id", "name": "TopicModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺id必须是整数。"}}},{"id": "topicmodel-header_style", "name": "TopicModel[header_style]", "attribute": "header_style", "rules": {"string":true,"messages":{"string":"去除头部（PC端）必须是一条字符串。","maxlength":"去除头部（PC端）只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-bottom_style", "name": "TopicModel[bottom_style]", "attribute": "bottom_style", "rules": {"string":true,"messages":{"string":"去除底部（PC端）必须是一条字符串。","maxlength":"去除底部（PC端）只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-bg_image", "name": "TopicModel[bg_image]", "attribute": "bg_image", "rules": {"string":true,"messages":{"string":"背景图片必须是一条字符串。","maxlength":"背景图片只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-bg_color", "name": "TopicModel[bg_color]", "attribute": "bg_color", "rules": {"string":true,"messages":{"string":"背景颜色必须是一条字符串。","maxlength":"背景颜色只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-m_bg_image", "name": "TopicModel[m_bg_image]", "attribute": "m_bg_image", "rules": {"string":true,"messages":{"string":"手机端背景图片必须是一条字符串。","maxlength":"手机端背景图片只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-m_bg_color", "name": "TopicModel[m_bg_color]", "attribute": "m_bg_color", "rules": {"string":true,"messages":{"string":"手机端背景颜色必须是一条字符串。","maxlength":"手机端背景颜色只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-share_image", "name": "TopicModel[share_image]", "attribute": "share_image", "rules": {"string":true,"messages":{"string":"分享推广图必须是一条字符串。","maxlength":"分享推广图只能包含至多225个字符。"},"maxlength":225}},{"id": "topicmodel-topic_name", "name": "TopicModel[topic_name]", "attribute": "topic_name", "rules": {"string":true,"messages":{"string":"活动名称必须是一条字符串。","maxlength":"活动名称只能包含至多30个字符。"},"maxlength":30}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#{{ $page_id }}").find("#TopicModel").validate();
        var topic_id = '{{ $topic_id }}';
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#{{ $page_id }}").find("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            //加载提示
            $.loading.start();
            var data = $("#TopicModel").serializeJson();

            $.post('/topic/topic/bg-setting?topic_id=' + topic_id, data, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    var modal = $.modal($("#{{ $page_id }}"));
                    if (modal) {
                        modal.hide();
                        $.msg(result.message);
                        window.location.reload();
                    }
                } else {
                    $.msg(result.message);
                }
            }, 'json');

            return false;
        });

        $("#{{ $page_id }}").find(".szy-imagegroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");

            var target = $("#" + id);
            var value = $(target).val();

            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
                values: value.split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
        });
        //选色
        $("#{{ $page_id }}").find(".colorpicker").colorpicker();
    });
</script>