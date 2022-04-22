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
[{"id": "systemconfigmodel-shipping_1", "name": "SystemConfigModel[shipping_1]", "attribute": "shipping_1", "rules": {"string":true,"messages":{"string":"1分必须是一条字符串。"}}},{"id": "systemconfigmodel-shipping_2", "name": "SystemConfigModel[shipping_2]", "attribute": "shipping_2", "rules": {"string":true,"messages":{"string":"2分必须是一条字符串。"}}},{"id": "systemconfigmodel-shipping_3", "name": "SystemConfigModel[shipping_3]", "attribute": "shipping_3", "rules": {"string":true,"messages":{"string":"3分必须是一条字符串。"}}},{"id": "systemconfigmodel-shipping_4", "name": "SystemConfigModel[shipping_4]", "attribute": "shipping_4", "rules": {"string":true,"messages":{"string":"4分必须是一条字符串。"}}},{"id": "systemconfigmodel-shipping_5", "name": "SystemConfigModel[shipping_5]", "attribute": "shipping_5", "rules": {"string":true,"messages":{"string":"5分必须是一条字符串。"}}},]
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