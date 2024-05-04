<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190105"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190105"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190105"></script>

<!-- 验证规则 -->
<script id="client_rules" type="text">
[]
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