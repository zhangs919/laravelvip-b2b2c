<div class="table-content m-t-30 clearfix">
    <form id="PrintSpecModel" class="form-horizontal" name="PrintSpecModel" action="/shop/print-spec/config-printer?id={{ $info->id }}" method="post">
        @csrf
        <!-- 隐藏域 -->
        <input type="hidden" id="printspecmodel-id" class="form-control" name="PrintSpecModel[id]" value="{{ $info->id }}">
        <!-- 打印机 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="printspecmodel-printer" class="col-sm-4 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">打印机名称：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="printspecmodel-printer" class="form-control" name="PrintSpecModel[printer]" value="{{ $info->printer ?? '' }}">


                    </div>

                    <div class="help-block help-block-t"><div class="help-block help-block-t">请正确填写打印机名称，如果设置的打印机名称与实际打印机名称不符，将无法打印！</div></div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "printspecmodel-print_spec", "name": "PrintSpecModel[print_spec]", "attribute": "print_spec", "rules": {"required":true,"messages":{"required":"打印规格不能为空。"}}},{"id": "printspecmodel-shop_id", "name": "PrintSpecModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "printspecmodel-printer", "name": "PrintSpecModel[printer]", "attribute": "printer", "rules": {"required":true,"messages":{"required":"打印机名称不能为空。"}}},{"id": "printspecmodel-is_default", "name": "PrintSpecModel[is_default]", "attribute": "is_default", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否默认必须是整数。"}}},{"id": "printspecmodel-shop_id", "name": "PrintSpecModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "printspecmodel-print_spec", "name": "PrintSpecModel[print_spec]", "attribute": "print_spec", "rules": {"string":true,"messages":{"string":"打印规格必须是一条字符串。","maxlength":"打印规格只能包含至多20个字符。"},"maxlength":20}},{"id": "printspecmodel-printer", "name": "PrintSpecModel[printer]", "attribute": "printer", "rules": {"string":true,"messages":{"string":"打印机名称必须是一条字符串。","maxlength":"打印机名称只能包含至多255个字符。"},"maxlength":255}},]
</script>
<script type="text/javascript">
    var validator = null;
    $.stopEnterEvent('form');//表单提交元素为一个时 禁止回车事件
    $().ready(function() {
        validator = $("#PrintSpecModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
    });
</script>