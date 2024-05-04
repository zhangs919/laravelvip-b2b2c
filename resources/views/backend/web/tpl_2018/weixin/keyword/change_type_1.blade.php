<!-- ================== BEGIN BASE  ================== -->
<!-- ================== END BASE  ================== -->
<!-- 标题 -->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="weixinkeyword-key_title" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">标题：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <input type="text" id="weixinkeyword-key_title" class="form-control" name="WeixinKeyword[key_title]" value="{{ $model['key_title'] ?? '' }}">
            </div>
            <div class="help-block help-block-t"></div>
        </div>
    </div>
</div><!-- 图片 -->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="weixinkeyword-key_img" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">图片：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <div id="key_img_container"></div>
                <input type="hidden" id="weixinkeyword-key_img" class="form-control" name="WeixinKeyword[key_img]" value="{{ $model['key_img'] ?? '' }}">
            </div>
            <div class="help-block help-block-t"></div>
        </div>
    </div>
</div><!-- 链接地址 -->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="weixinkeyword-key_link" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">链接地址：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <input type="text" id="weixinkeyword-key_link" class="form-control" name="WeixinKeyword[key_link]" value="{{ $model['key_link'] ?? '' }}">
            </div>
            <div class="help-block help-block-t"></div>
        </div>
    </div>
</div><!-- 描述 -->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="weixinkeyword-key_desc" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">描述：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <textarea id="weixinkeyword-key_desc" class="form-control" name="WeixinKeyword[key_desc]" rows="5">{!! $model['key_desc'] ?? '' !!}</textarea>
            </div>
            <div class="help-block help-block-t"></div>
        </div>
    </div>
</div>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "weixinkeyword-key_img", "name": "WeixinKeyword[key_img]", "attribute": "key_img", "rules": {"required":true,"messages":{"required":"图片不能为空。"}}},{"id": "weixinkeyword-key_title", "name": "WeixinKeyword[key_title]", "attribute": "key_title", "rules": {"required":true,"messages":{"required":"标题不能为空。"}}},{"id": "weixinkeyword-key_link", "name": "WeixinKeyword[key_link]", "attribute": "key_link", "rules": {"required":true,"messages":{"required":"链接地址不能为空。"}}},{"id": "weixinkeyword-key_desc", "name": "WeixinKeyword[key_desc]", "attribute": "key_desc", "rules": {"required":true,"messages":{"required":"描述不能为空。"}}},{"id": "weixinkeyword-key_link", "name": "WeixinKeyword[key_link]", "attribute": "key_link", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"链接地址不是一条有效的URL。"}}},{"id": "weixinkeyword-key_name", "name": "WeixinKeyword[key_name]", "attribute": "key_name", "rules": {"required":true,"messages":{"required":"关键词名称不能为空。"}}},{"id": "weixinkeyword-key_type", "name": "WeixinKeyword[key_type]", "attribute": "key_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"关键词类型必须是整数。"}}},{"id": "weixinkeyword-shop_id", "name": "WeixinKeyword[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "weixinkeyword-key_name", "name": "WeixinKeyword[key_name]", "attribute": "key_name", "rules": {"string":true,"messages":{"string":"关键词名称必须是一条字符串。","maxlength":"关键词名称只能包含至多60个字符。"},"maxlength":60}},{"id": "weixinkeyword-key_content", "name": "WeixinKeyword[key_content]", "attribute": "key_content", "rules": {"string":true,"messages":{"string":"关键词回复内容必须是一条字符串。","maxlength":"关键词回复内容只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_img", "name": "WeixinKeyword[key_img]", "attribute": "key_img", "rules": {"string":true,"messages":{"string":"图片必须是一条字符串。","maxlength":"图片只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_link", "name": "WeixinKeyword[key_link]", "attribute": "key_link", "rules": {"string":true,"messages":{"string":"链接地址必须是一条字符串。","maxlength":"链接地址只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_desc", "name": "WeixinKeyword[key_desc]", "attribute": "key_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_title", "name": "WeixinKeyword[key_title]", "attribute": "key_title", "rules": {"string":true,"messages":{"string":"标题必须是一条字符串。","maxlength":"标题只能包含至多20个字符。"},"maxlength":20}},]
</script>
<script type="text/javascript">
    //
</script>
<script src="/assets/d2eace91/min/js/validate.min.js?v=20200805"></script>
<script src="/assets/d2eace91/min/js/upload.min.js?v=20200805"></script>
<script>

    $().ready(function() {
        var validator = $("#WeixinKeyword").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        $("#key_img_container").imagegroup({
            host: '{{ get_oss_host() }}',
            size: 1,
            values: ["{{ $model['key_img'] ?? '' }}"],
            callback: function(data) {
                $("#weixinkeyword-key_img").val(data.path);
            },
            remove: function(value, values) {
                $("#weixinkeyword-key_img").val('');
            }
        });
    });

    //
</script>