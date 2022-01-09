<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-captcha_login_fail", "name": "SystemConfigModel[captcha_login_fail]", "attribute": "captcha_login_fail", "rules": {"string":true,"messages":{"string":"登录失败时显示图片验证码必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_login_fail", "name": "SystemConfigModel[captcha_login_fail]", "attribute": "captcha_login_fail", "rules": {"required":true,"messages":{"required":"登录失败时显示图片验证码不能为空。"}}},{"id": "systemconfigmodel-captcha_noise", "name": "SystemConfigModel[captcha_noise]", "attribute": "captcha_noise", "rules": {"string":true,"messages":{"string":"图片验证码干扰点必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_noise", "name": "SystemConfigModel[captcha_noise]", "attribute": "captcha_noise", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片验证码干扰点必须是整数。","min":"图片验证码干扰点必须不小于0。","max":"图片验证码干扰点必须不大于10。"},"min":0,"max":10}},{"id": "systemconfigmodel-captcha_curve", "name": "SystemConfigModel[captcha_curve]", "attribute": "captcha_curve", "rules": {"string":true,"messages":{"string":"图片验证码干扰线必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_curve", "name": "SystemConfigModel[captcha_curve]", "attribute": "captcha_curve", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片验证码干扰线必须是整数。","min":"图片验证码干扰线必须不小于0。","max":"图片验证码干扰线必须不大于3。"},"min":0,"max":3}},{"id": "systemconfigmodel-captcha_sms_max", "name": "SystemConfigModel[captcha_sms_max]", "attribute": "captcha_sms_max", "rules": {"string":true,"messages":{"string":"短信验证码控制必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_max", "name": "SystemConfigModel[captcha_sms_max]", "attribute": "captcha_sms_max", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"短信验证码控制必须是整数。","min":"短信验证码控制必须不小于1。"},"min":1}},{"id": "systemconfigmodel-captcha_sms_mobile_max", "name": "SystemConfigModel[captcha_sms_mobile_max]", "attribute": "captcha_sms_mobile_max", "rules": {"string":true,"messages":{"string":"每个手机号码地址短信验证码控制必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_mobile_max", "name": "SystemConfigModel[captcha_sms_mobile_max]", "attribute": "captcha_sms_mobile_max", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"每个手机号码地址短信验证码控制必须是整数。","min":"每个手机号码地址短信验证码控制必须不小于1。"},"min":1}},{"id": "systemconfigmodel-captcha_sms_mobile_max", "name": "SystemConfigModel[captcha_sms_mobile_max]", "attribute": "captcha_sms_mobile_max", "rules": {"compare":{"operator":"<","type":"number","compareAttribute":"systemconfigmodel-captcha_sms_mobile_time","skipOnEmpty":1},"messages":{"compare":"每个手机号码地址短信验证码控制的值必须小于\"时间范围\"。"}}},{"id": "systemconfigmodel-captcha_sms_mobile_time", "name": "SystemConfigModel[captcha_sms_mobile_time]", "attribute": "captcha_sms_mobile_time", "rules": {"string":true,"messages":{"string":"时间范围必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_mobile_time", "name": "SystemConfigModel[captcha_sms_mobile_time]", "attribute": "captcha_sms_mobile_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"时间范围必须是整数。","min":"时间范围必须不小于10。"},"min":10}},{"id": "systemconfigmodel-captcha_sms_mobile_interval", "name": "SystemConfigModel[captcha_sms_mobile_interval]", "attribute": "captcha_sms_mobile_interval", "rules": {"string":true,"messages":{"string":"限制发送间隔时间必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_mobile_interval", "name": "SystemConfigModel[captcha_sms_mobile_interval]", "attribute": "captcha_sms_mobile_interval", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限制发送间隔时间必须是整数。","min":"限制发送间隔时间必须不小于10。"},"min":10}},{"id": "systemconfigmodel-captcha_sms_ip_max", "name": "SystemConfigModel[captcha_sms_ip_max]", "attribute": "captcha_sms_ip_max", "rules": {"string":true,"messages":{"string":"每个IP地址短信验证码控制必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_ip_max", "name": "SystemConfigModel[captcha_sms_ip_max]", "attribute": "captcha_sms_ip_max", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"每个IP地址短信验证码控制必须是整数。","min":"每个IP地址短信验证码控制必须不小于1。"},"min":1}},{"id": "systemconfigmodel-captcha_sms_ip_max", "name": "SystemConfigModel[captcha_sms_ip_max]", "attribute": "captcha_sms_ip_max", "rules": {"compare":{"operator":"<","type":"number","compareAttribute":"systemconfigmodel-captcha_sms_ip_time","skipOnEmpty":1},"messages":{"compare":"每个IP地址短信验证码控制的值必须小于\"时间范围\"。"}}},{"id": "systemconfigmodel-captcha_sms_ip_time", "name": "SystemConfigModel[captcha_sms_ip_time]", "attribute": "captcha_sms_ip_time", "rules": {"string":true,"messages":{"string":"时间范围必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_ip_time", "name": "SystemConfigModel[captcha_sms_ip_time]", "attribute": "captcha_sms_ip_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"时间范围必须是整数。","min":"时间范围必须不小于10。"},"min":10}},{"id": "systemconfigmodel-captcha_sms_ip_interval", "name": "SystemConfigModel[captcha_sms_ip_interval]", "attribute": "captcha_sms_ip_interval", "rules": {"string":true,"messages":{"string":"限制发送间隔时间必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_ip_interval", "name": "SystemConfigModel[captcha_sms_ip_interval]", "attribute": "captcha_sms_ip_interval", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限制发送间隔时间必须是整数。","min":"限制发送间隔时间必须不小于10。"},"min":10}},{"id": "systemconfigmodel-captcha_sms_limit", "name": "SystemConfigModel[captcha_sms_limit]", "attribute": "captcha_sms_limit", "rules": {"string":true,"messages":{"string":"短信验证码发送频繁限制方式必须是一条字符串。"}}},]
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