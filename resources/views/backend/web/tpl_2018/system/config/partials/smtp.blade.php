<!-- 表单验证 -->
<script src="../../../assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
<!-- AJAX上传+图片预览 -->
<script src="../../../assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-mail_service", "name": "SystemConfigModel[mail_service]", "attribute": "mail_service", "rules": {"string":true,"messages":{"string":"邮件服务必须是一条字符串。"}}},{"id": "systemconfigmodel-mail_service", "name": "SystemConfigModel[mail_service]", "attribute": "mail_service", "rules": {"required":true,"messages":{"required":"邮件服务不能为空。"}}},{"id": "systemconfigmodel-smtp_ssl", "name": "SystemConfigModel[smtp_ssl]", "attribute": "smtp_ssl", "rules": {"string":true,"messages":{"string":"邮件服务器是否要求加密连接(SSL)必须是一条字符串。"}}},{"id": "systemconfigmodel-smtp_ssl", "name": "SystemConfigModel[smtp_ssl]", "attribute": "smtp_ssl", "rules": {"required":true,"messages":{"required":"邮件服务器是否要求加密连接(SSL)不能为空。"}}},{"id": "systemconfigmodel-smtp_host", "name": "SystemConfigModel[smtp_host]", "attribute": "smtp_host", "rules": {"string":true,"messages":{"string":"发送邮件服务器地址(SMTP)必须是一条字符串。"}}},{"id": "systemconfigmodel-smtp_host", "name": "SystemConfigModel[smtp_host]", "attribute": "smtp_host", "rules": {"required":true,"messages":{"required":"发送邮件服务器地址(SMTP)不能为空。"}}},{"id": "systemconfigmodel-smtp_port", "name": "SystemConfigModel[smtp_port]", "attribute": "smtp_port", "rules": {"string":true,"messages":{"string":"服务器端口必须是一条字符串。"}}},{"id": "systemconfigmodel-smtp_port", "name": "SystemConfigModel[smtp_port]", "attribute": "smtp_port", "rules": {"required":true,"messages":{"required":"服务器端口不能为空。"}}},{"id": "systemconfigmodel-smtp_user", "name": "SystemConfigModel[smtp_user]", "attribute": "smtp_user", "rules": {"string":true,"messages":{"string":"邮件发送帐号必须是一条字符串。"}}},{"id": "systemconfigmodel-smtp_user", "name": "SystemConfigModel[smtp_user]", "attribute": "smtp_user", "rules": {"required":true,"messages":{"required":"邮件发送帐号不能为空。"}}},{"id": "systemconfigmodel-smtp_pass", "name": "SystemConfigModel[smtp_pass]", "attribute": "smtp_pass", "rules": {"string":true,"messages":{"string":"帐号密码必须是一条字符串。"}}},{"id": "systemconfigmodel-smtp_pass", "name": "SystemConfigModel[smtp_pass]", "attribute": "smtp_pass", "rules": {"required":true,"messages":{"required":"帐号密码不能为空。"}}},{"id": "systemconfigmodel-smtp_mail", "name": "SystemConfigModel[smtp_mail]", "attribute": "smtp_mail", "rules": {"string":true,"messages":{"string":"邮件回复地址必须是一条字符串。"}}},{"id": "systemconfigmodel-smtp_mail", "name": "SystemConfigModel[smtp_mail]", "attribute": "smtp_mail", "rules": {"required":true,"messages":{"required":"邮件回复地址不能为空。"}}},{"id": "systemconfigmodel-mail_charset", "name": "SystemConfigModel[mail_charset]", "attribute": "mail_charset", "rules": {"string":true,"messages":{"string":"邮件编码必须是一条字符串。"}}},{"id": "systemconfigmodel-mail_charset", "name": "SystemConfigModel[mail_charset]", "attribute": "mail_charset", "rules": {"required":true,"messages":{"required":"邮件编码不能为空。"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#SystemConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            $("#SystemConfigModel").submit();
        });

        $("#btn_test").click(function() {

            var value = $("#test_mail_address").val();

            // 清空错误
            $.validator.clearError($("#test_mail_address"));

            if ($.trim(value) == '') {
                $.validator.showError($("#test_mail_address"), "测试邮件不能为空！");
                return;
            }

            var data = $("#SystemConfigModel").serializeJson();

            if ($("#test_mail_address").valid()) {
                // 开始加载
                $.loading.start();
                $.post('/site/send-test-mail', {
                    email: value,
                    config: data.SystemConfigModel
                }, function(result) {
                    // 停止加载
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message);
                    } else {
                        $.alert(result.message);
                    }
                }, 'json');
            }

        });
    });
</script>