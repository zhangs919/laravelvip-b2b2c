<!-- 关键词回复内容 -->
<div class="simple-form-field" >
    <div class="form-group">
        <label for="weixinkeyword-key_content" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">关键词回复内容：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <textarea id="weixinkeyword-key_content" class="form-control" name="WeixinKeyword[key_content]" rows="5">{!! $model['key_content'] ?? '' !!}</textarea>
            </div>
            <div class="help-block help-block-t"></div>
        </div>
    </div>
</div>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "weixinkeyword-key_content", "name": "WeixinKeyword[key_content]", "attribute": "key_content", "rules": {"required":true,"messages":{"required":"关键词回复内容不能为空。"}}},{"id": "weixinkeyword-key_name", "name": "WeixinKeyword[key_name]", "attribute": "key_name", "rules": {"required":true,"messages":{"required":"关键词名称不能为空。"}}},{"id": "weixinkeyword-key_type", "name": "WeixinKeyword[key_type]", "attribute": "key_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"关键词类型必须是整数。"}}},{"id": "weixinkeyword-shop_id", "name": "WeixinKeyword[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "weixinkeyword-key_name", "name": "WeixinKeyword[key_name]", "attribute": "key_name", "rules": {"string":true,"messages":{"string":"关键词名称必须是一条字符串。","maxlength":"关键词名称只能包含至多60个字符。"},"maxlength":60}},{"id": "weixinkeyword-key_content", "name": "WeixinKeyword[key_content]", "attribute": "key_content", "rules": {"string":true,"messages":{"string":"关键词回复内容必须是一条字符串。","maxlength":"关键词回复内容只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_img", "name": "WeixinKeyword[key_img]", "attribute": "key_img", "rules": {"string":true,"messages":{"string":"图片必须是一条字符串。","maxlength":"图片只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_link", "name": "WeixinKeyword[key_link]", "attribute": "key_link", "rules": {"string":true,"messages":{"string":"链接地址必须是一条字符串。","maxlength":"链接地址只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_desc", "name": "WeixinKeyword[key_desc]", "attribute": "key_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinkeyword-key_title", "name": "WeixinKeyword[key_title]", "attribute": "key_title", "rules": {"string":true,"messages":{"string":"标题必须是一条字符串。","maxlength":"标题只能包含至多20个字符。"},"maxlength":20}},]
</script>
<script type="text/javascript">
    //
</script>