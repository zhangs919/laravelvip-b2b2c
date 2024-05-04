<div class="table-content m-t-30 clearfix">
    <form id="SheetConfigModel" class="form-horizontal" name="SheetConfigModel" action="/mall/shipping/sheet-config?shipping_code={{ $shipping_code }}" method="post">
        @csrf
        <!-- 隐藏域 -->
        <input type="hidden" id="sheetconfigmodel-shipping_code" class="form-control" name="SheetConfigModel[shipping_code]" value="{{ $shipping_code }}">
        <!-- 商户号 -->

        <div class="simple-form-field" >
            <div class="form-group">
                <label for="sheetconfigmodel-customer_name" class="col-sm-4 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">商家ID：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="sheetconfigmodel-customer_name" class="form-control" name="SheetConfigModel[customer_name]" value="{{ $sheet_config->customer_name ?? '' }}">


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>

        <!-- 密钥 -->

        <div class="simple-form-field" >
            <div class="form-group">
                <label for="sheetconfigmodel-customer_pwd" class="col-sm-4 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">商家接口密码：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="sheetconfigmodel-customer_pwd" class="form-control" name="SheetConfigModel[customer_pwd]" value="{{ $sheet_config->customer_pwd ?? '' }}">


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>

        <!-- 月结号 -->

        <!-- 网点名称 -->

        <!-- 快递单号 -->


    </form>
</div>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "sheetconfigmodel-customer_name", "name": "SheetConfigModel[customer_name]", "attribute": "customer_name", "rules": {"required":true,"messages":{"required":"商家ID不能为空。"}}},{"id": "sheetconfigmodel-customer_pwd", "name": "SheetConfigModel[customer_pwd]", "attribute": "customer_pwd", "rules": {"required":true,"messages":{"required":"商家接口密码不能为空。"}}},]
</script>
<script type="text/javascript">
    var validator = null;
    $().ready(function() {
        validator = $("#SheetConfigModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
    });
</script>