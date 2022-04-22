<div class="modal-body">
    <form id="form" class="form-horizontal" name="GoodsUnit" action="/goods/goods-unit/add" method="post">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix">
            <input type="hidden" id="goodsunit-unit_id" class="form-control" name="GoodsUnit[unit_id]" value="{{ $info->unit_id ?? '' }}">

            <input type="hidden" id="goodsunit-shop_id" class="form-control" name="GoodsUnit[shop_id]" value="{{ $shop_info->shop_id }}">
            <!-- 商品单位 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="goodsunit-unit_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">单位名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="goodsunit-unit_name" class="form-control" name="GoodsUnit[unit_name]" value="{{ $info->unit_name ?? '' }}" onKeyDown="if(event.keyCode==13) return false;">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
@if(isset($info->unit_id))
    [{"id": "goodsunit-shop_id", "name": "GoodsUnit[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop ID不能为空。"}}},{"id": "goodsunit-unit_name", "name": "GoodsUnit[unit_name]", "attribute": "unit_name", "rules": {"required":true,"messages":{"required":"单位名称不能为空。"}}},{"id": "goodsunit-shop_id", "name": "GoodsUnit[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shop ID必须是整数。"}}},{"id": "goodsunit-unit_name", "name": "GoodsUnit[unit_name]", "attribute": "unit_name", "rules": {"string":true,"messages":{"string":"单位名称必须是一条字符串。","maxlength":"单位名称只能包含至多10个字符。"},"maxlength":10}},{"id": "goodsunit-unit_name", "name": "GoodsUnit[unit_name]", "attribute": "unit_name", "rules": {"ajax":{"url":"/goods/goods-unit/client-validate","model":"Y29tbW9uXG1vZGVsc1xHb29kc1VuaXQ=","attribute":"unit_name","params":["GoodsUnit[unit_id]","GoodsUnit[shop_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
@else
    [{"id": "goodsunit-shop_id", "name": "GoodsUnit[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop ID不能为空。"}}},{"id": "goodsunit-unit_name", "name": "GoodsUnit[unit_name]", "attribute": "unit_name", "rules": {"required":true,"messages":{"required":"单位名称不能为空。"}}},{"id": "goodsunit-shop_id", "name": "GoodsUnit[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shop ID必须是整数。"}}},{"id": "goodsunit-unit_name", "name": "GoodsUnit[unit_name]", "attribute": "unit_name", "rules": {"string":true,"messages":{"string":"单位名称必须是一条字符串。","maxlength":"单位名称只能包含至多10个字符。"},"maxlength":10}},{"id": "goodsunit-unit_name", "name": "GoodsUnit[unit_name]", "attribute": "unit_name", "rules": {"ajax":{"url":"/goods/goods-unit/client-validate","model":"Y29tbW9uXG1vZGVsc1xHb29kc1VuaXQ=","attribute":"unit_name","params":["GoodsUnit[shop_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
@endif
</script>
<script id="client_rules" type="text">
</script>
<script type="text/javascript">
    var validator = null;
    $().ready(function() {
        validator = $("#form").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
    });
</script>