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
[{"id": "systemconfigmodel-login_bg_image", "name": "SystemConfigModel[login_bg_image]", "attribute": "login_bg_image", "rules": {"string":true,"messages":{"string":"登录页面主题图片必须是一条字符串。"}}},{"id": "systemconfigmodel-login_bg_url", "name": "SystemConfigModel[login_bg_url]", "attribute": "login_bg_url", "rules": {"string":true,"messages":{"string":"登录页面主题图片链接必须是一条字符串。"}}},{"id": "systemconfigmodel-register_bg_image", "name": "SystemConfigModel[register_bg_image]", "attribute": "register_bg_image", "rules": {"string":true,"messages":{"string":"注册页面主题图片必须是一条字符串。"}}},{"id": "systemconfigmodel-admin_login_bg_mode", "name": "SystemConfigModel[admin_login_bg_mode]", "attribute": "admin_login_bg_mode", "rules": {"string":true,"messages":{"string":"后台登录页面主题图片风格必须是一条字符串。"}}},{"id": "systemconfigmodel-admin_login_bg_image", "name": "SystemConfigModel[admin_login_bg_image]", "attribute": "admin_login_bg_image", "rules": {"string":true,"messages":{"string":"后台登录页面主题图片必须是一条字符串。"}}},{"id": "systemconfigmodel-loading_style", "name": "SystemConfigModel[loading_style]", "attribute": "loading_style", "rules": {"string":true,"messages":{"string":"缓载样式必须是一条字符串。"}}},{"id": "systemconfigmodel-loading_color", "name": "SystemConfigModel[loading_color]", "attribute": "loading_color", "rules": {"string":true,"messages":{"string":"缓载颜色必须是一条字符串。"}}},{"id": "systemconfigmodel-cart_loading_image", "name": "SystemConfigModel[cart_loading_image]", "attribute": "cart_loading_image", "rules": {"string":true,"messages":{"string":"购物车缓载和提交结算缓载图片必须是一条字符串。"}}},]
</script>

<!--选色插件-->
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=1.2">
<script src="/assets/d2eace91/js/jquery-ui.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=1.2"></script>
<script type="text/javascript">
    $().ready(function() {
        $(".colorpicker").colorpicker();
    });
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