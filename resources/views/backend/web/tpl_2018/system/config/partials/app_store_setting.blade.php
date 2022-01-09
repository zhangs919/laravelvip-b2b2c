<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.3"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.3"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.3"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.3"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.3"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=1.3"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-app_store_ios_is_open", "name": "SystemConfigModel[app_store_ios_is_open]", "attribute": "app_store_ios_is_open", "rules": {"string":true,"messages":{"string":"iOS状态必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_ios_use_version", "name": "SystemConfigModel[app_store_ios_use_version]", "attribute": "app_store_ios_use_version", "rules": {"string":true,"messages":{"string":"iOS使用版本必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_android_is_open", "name": "SystemConfigModel[app_store_android_is_open]", "attribute": "app_store_android_is_open", "rules": {"string":true,"messages":{"string":"Android状态必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_android_use_version", "name": "SystemConfigModel[app_store_android_use_version]", "attribute": "app_store_android_use_version", "rules": {"string":true,"messages":{"string":"Android使用版本必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_close_reason", "name": "SystemConfigModel[app_store_close_reason]", "attribute": "app_store_close_reason", "rules": {"string":true,"messages":{"string":"APP关闭原因必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_ios_version", "name": "SystemConfigModel[app_store_ios_version]", "attribute": "app_store_ios_version", "rules": {"string":true,"messages":{"string":"iOS应用版本号必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_ios_update_url", "name": "SystemConfigModel[app_store_ios_update_url]", "attribute": "app_store_ios_update_url", "rules": {"string":true,"messages":{"string":"iOS客户端下载地址必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_ios_update_url", "name": "SystemConfigModel[app_store_ios_update_url]", "attribute": "app_store_ios_update_url", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"iOS客户端下载地址不是一条有效的URL。"}}},{"id": "systemconfigmodel-app_store_ios_update_content", "name": "SystemConfigModel[app_store_ios_update_content]", "attribute": "app_store_ios_update_content", "rules": {"string":true,"messages":{"string":"iOS更新内容必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_android_version", "name": "SystemConfigModel[app_store_android_version]", "attribute": "app_store_android_version", "rules": {"string":true,"messages":{"string":"Android应用版本号必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_android_update_url", "name": "SystemConfigModel[app_store_android_update_url]", "attribute": "app_store_android_update_url", "rules": {"string":true,"messages":{"string":"Android客户端下载地址必须是一条字符串。"}}},{"id": "systemconfigmodel-app_store_android_update_url", "name": "SystemConfigModel[app_store_android_update_url]", "attribute": "app_store_android_update_url", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"Android客户端下载地址不是一条有效的URL。"}}},{"id": "systemconfigmodel-app_store_android_update_content", "name": "SystemConfigModel[app_store_android_update_content]", "attribute": "app_store_android_update_content", "rules": {"string":true,"messages":{"string":"Android更新内容必须是一条字符串。"}}},]
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
                host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
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
                host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
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