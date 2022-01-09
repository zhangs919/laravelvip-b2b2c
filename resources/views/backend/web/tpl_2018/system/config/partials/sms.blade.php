<!-- 表单验证 -->
<script src="../../../assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
<!-- AJAX上传+图片预览 -->
<script src="../../../assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-sms_sign_name", "name": "SystemConfigModel[sms_sign_name]", "attribute": "sms_sign_name", "rules": {"string":true,"messages":{"string":"短信签名必须是一条字符串。"}}},{"id": "systemconfigmodel-sms_sign_name", "name": "SystemConfigModel[sms_sign_name]", "attribute": "sms_sign_name", "rules": {"required":true,"messages":{"required":"短信签名不能为空。"}}},{"id": "systemconfigmodel-sms_sign_name", "name": "SystemConfigModel[sms_sign_name]", "attribute": "sms_sign_name", "rules": {"string":true,"messages":{"string":"短信签名必须是一条字符串。","minlength":"短信签名应该包含至少2个字符。","maxlength":"短信签名只能包含至多8个字符。"},"minlength":2,"maxlength":8}},{"id": "systemconfigmodel-sms_api", "name": "SystemConfigModel[sms_api]", "attribute": "sms_api", "rules": {"string":true,"messages":{"string":"短信接口服务必须是一条字符串。"}}},{"id": "systemconfigmodel-sms_api", "name": "SystemConfigModel[sms_api]", "attribute": "sms_api", "rules": {"required":true,"messages":{"required":"短信接口服务不能为空。"}}},]
</script>
<!-- 手机号码验证规则 -->
<script id="mobile_rules" type="text">
[Array]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#SystemConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules(eval($("#client_rules").html()));
        $("#test_mobile").addRule($("#mobile_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            $("#SystemConfigModel").submit();
        });

        $("#btn_test").click(function() {

            var value = $("#test_mobile").val();

            // 清空错误
            $.validator.clearError($("#test_mobile"));

            if ($.trim(value) == '') {
                $.validator.showError($("#test_mobile"), "测试号码不能为空！");
                return;
            }

            var data = $("#SystemConfigModel").serializeJson();

            if ($("#test_mobile").valid()) {
                // 开始加载
                $.loading.start();
                $.post('/site/send-test-sms', {
                    mobile: value,
                    config: data.SystemConfigModel
                }, function(result) {
                    // 停止加载
                    $.loading.stop();
                    if (result.code == 0) {
                        //$.msg(result.message);
                        $.msg(result.message, {
                            time: 5000
                        });
                    } else {
                        //$.alert(result.message);
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, 'json');

            }

        });
    });
</script>