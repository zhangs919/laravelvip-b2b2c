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
[{"id": "systemconfigmodel-username_prefix", "name": "SystemConfigModel[username_prefix]", "attribute": "username_prefix", "rules": {"string":true,"messages":{"string":"会员用户名前缀必须是一条字符串。"}}},{"id": "systemconfigmodel-username_prefix", "name": "SystemConfigModel[username_prefix]", "attribute": "username_prefix", "rules": {"string":true,"messages":{"string":"用户名前缀必须为0~3个大写英文字母","minlength":"会员用户名前缀应该包含至少0个字符。","maxlength":"会员用户名前缀只能包含至多3个字符。"},"minlength":0,"maxlength":3}},{"id": "systemconfigmodel-username_prefix", "name": "SystemConfigModel[username_prefix]", "attribute": "username_prefix", "rules": {"match":{"pattern":/^[A-Z]{0,3}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"用户名前缀必须为0~3个大写英文字母"}}},{"id": "systemconfigmodel-register_close_reason", "name": "SystemConfigModel[register_close_reason]", "attribute": "register_close_reason", "rules": {"string":true,"messages":{"string":"关闭注册原因必须是一条字符串。"}}},{"id": "systemconfigmodel-show_rank_price", "name": "SystemConfigModel[show_rank_price]", "attribute": "show_rank_price", "rules": {"string":true,"messages":{"string":"等级价格必须是一条字符串。"}}},{"id": "systemconfigmodel-show_rank_price", "name": "SystemConfigModel[show_rank_price]", "attribute": "show_rank_price", "rules": {"required":true,"messages":{"required":"等级价格不能为空。"}}},{"id": "systemconfigmodel-user_validate_password", "name": "SystemConfigModel[user_validate_password]", "attribute": "user_validate_password", "rules": {"string":true,"messages":{"string":"登录密码身份验证必须是一条字符串。"}}},{"id": "systemconfigmodel-user_validate_password", "name": "SystemConfigModel[user_validate_password]", "attribute": "user_validate_password", "rules": {"required":true,"messages":{"required":"登录密码身份验证不能为空。"}}},{"id": "systemconfigmodel-monetary_rate", "name": "SystemConfigModel[monetary_rate]", "attribute": "monetary_rate", "rules": {"string":true,"messages":{"string":"消费金额与赠送成长值比例必须是一条字符串。"}}},{"id": "systemconfigmodel-monetary_rate", "name": "SystemConfigModel[monetary_rate]", "attribute": "monetary_rate", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"消费金额与赠送成长值比例必须是整数。","min":"消费金额与赠送成长值比例必须不小于1。","max":"消费金额与赠送成长值比例必须不大于100。"},"min":1,"max":100}},{"id": "systemconfigmodel-max_growth_value", "name": "SystemConfigModel[max_growth_value]", "attribute": "max_growth_value", "rules": {"string":true,"messages":{"string":"每笔订单最多赠送成长值必须是一条字符串。"}}},{"id": "systemconfigmodel-max_growth_value", "name": "SystemConfigModel[max_growth_value]", "attribute": "max_growth_value", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"每笔订单最多赠送成长值必须是整数。","min":"每笔订单最多赠送成长值必须不小于0。"},"min":0}},{"id": "systemconfigmodel-auth_enable", "name": "SystemConfigModel[auth_enable]", "attribute": "auth_enable", "rules": {"string":true,"messages":{"string":"是否启用必须是一条字符串。"}}},]
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