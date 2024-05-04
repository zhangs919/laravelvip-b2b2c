<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>

<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-is_show_site_nav_category", "name": "SystemConfigModel[is_show_site_nav_category]", "attribute": "is_show_site_nav_category", "rules": {"string":true,"messages":{"string":"是否显示分类导航必须是一条字符串。"}}},{"id": "systemconfigmodel-site_nav_category_style", "name": "SystemConfigModel[site_nav_category_style]", "attribute": "site_nav_category_style", "rules": {"string":true,"messages":{"string":"导航样式必须是一条字符串。"}}},]
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
    });
</script>