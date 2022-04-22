<!-- 表单验证 -->
<script src="../../../assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
<!-- AJAX上传+图片预览 -->
<script src="../../../assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<script src="../../../assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-yunsms_accounts", "name": "SystemConfigModel[yunsms_accounts]", "attribute": "yunsms_accounts", "rules": {"string":true,"messages":{"string":"云短信服务帐号必须是一条字符串。"}}},{"id": "systemconfigmodel-yunsms_accounts", "name": "SystemConfigModel[yunsms_accounts]", "attribute": "yunsms_accounts", "rules": {"required":true,"messages":{"required":"云短信服务帐号不能为空。"}}},{"id": "systemconfigmodel-yunsms_password", "name": "SystemConfigModel[yunsms_password]", "attribute": "yunsms_password", "rules": {"string":true,"messages":{"string":"云短信服务密码必须是一条字符串。"}}},{"id": "systemconfigmodel-yunsms_password", "name": "SystemConfigModel[yunsms_password]", "attribute": "yunsms_password", "rules": {"required":true,"messages":{"required":"云短信服务密码不能为空。"}}},{"id": "systemconfigmodel-yunsms_phones", "name": "SystemConfigModel[yunsms_phones]", "attribute": "yunsms_phones", "rules": {"string":true,"messages":{"string":"平台手机号码必须是一条字符串。"}}},{"id": "systemconfigmodel-yunsms_phones", "name": "SystemConfigModel[yunsms_phones]", "attribute": "yunsms_phones", "rules": {"required":true,"messages":{"required":"平台手机号码不能为空。"}}},{"id": "systemconfigmodel-yunsms_phones", "name": "SystemConfigModel[yunsms_phones]", "attribute": "yunsms_phones", "rules": {"match":{"pattern":/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|199[0-9]{8}$|198[0-9]{8}$|166[0-9]{8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"平台手机号码是无效的。"}}},]
</script>




<script type="text/javascript">
    $().ready(function() {
        var validator = $("#SystemConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            validator.form();
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            $("#SystemConfigModel").submit();
            /**
             var data = $("#SystemConfigModel").serializeJson();
             $.post('/system/config/index', data, function(result) {
				if (result.code == 0) {
					$.msg(result.message, {
						icon: 1
					});
				} else {
					$.alert(result.message, {
						icon: 2
					});
				}
			}, "json");
             **/
        });

        $(".szy-imagegroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");
            var mode = $(this).data("mode");
            var labels = $(this).data("labels");
            var target = $("#" + id);
            var value = $(target).val() ;
            var options = $(this).data("options") ? $(this).data("options") : [];
            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
                mode: mode,
                labels: labels,
                options: options,
                gallery: true,
                values: value.split("|"),
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

        $(".szy-videogroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");
            var mode = $(this).data("mode");
            var labels = $(this).data("labels");

            var target = $("#" + id);
            var value = $(target).val() ;

            var options = $(this).data("options") ? $(this).data("options") : [];

            $(this).videogroup({
                host: "{{ get_oss_host() }}",
                size: size,
                mode: mode,
                labels: labels,
                options: options,
                values: value.split("|"),
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
    });
</script>