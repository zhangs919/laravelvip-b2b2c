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
    [{"id": "systemconfigmodel-site_name", "name": "SystemConfigModel[site_name]", "attribute": "site_name", "rules": {"string":true,"messages":{"string":"网站名称必须是一条字符串。"}}},{"id": "systemconfigmodel-site_name", "name": "SystemConfigModel[site_name]", "attribute": "site_name", "rules": {"required":true,"messages":{"required":"网站名称不能为空。"}}},{"id": "systemconfigmodel-site_name", "name": "SystemConfigModel[site_name]", "attribute": "site_name", "rules": {"string":true,"messages":{"string":"网站名称必须是一条字符串。","maxlength":"网站名称只能包含至多30个字符。"},"maxlength":30}},{"id": "systemconfigmodel-site_index_topic", "name": "SystemConfigModel[site_index_topic]", "attribute": "site_index_topic", "rules": {"string":true,"messages":{"string":"专题页编号必须是一条字符串。"}}},{"id": "systemconfigmodel-site_index", "name": "SystemConfigModel[site_index]", "attribute": "site_index", "rules": {"string":true,"messages":{"string":"网站首页必须是一条字符串。"}}},{"id": "systemconfigmodel-favicon", "name": "SystemConfigModel[favicon]", "attribute": "favicon", "rules": {"string":true,"messages":{"string":"网站头像必须是一条字符串。"}}},{"id": "systemconfigmodel-backend_logo", "name": "SystemConfigModel[backend_logo]", "attribute": "backend_logo", "rules": {"string":true,"messages":{"string":"后台系统Logo必须是一条字符串。"}}},{"id": "systemconfigmodel-backend_logo", "name": "SystemConfigModel[backend_logo]", "attribute": "backend_logo", "rules": {"required":true,"messages":{"required":"后台系统Logo不能为空。"}}},{"id": "systemconfigmodel-site_icp", "name": "SystemConfigModel[site_icp]", "attribute": "site_icp", "rules": {"string":true,"messages":{"string":"ICP证书号必须是一条字符串。"}}},{"id": "systemconfigmodel-site_copyright", "name": "SystemConfigModel[site_copyright]", "attribute": "site_copyright", "rules": {"string":true,"messages":{"string":"版权信息必须是一条字符串。"}}},{"id": "systemconfigmodel-timezone", "name": "SystemConfigModel[timezone]", "attribute": "timezone", "rules": {"string":true,"messages":{"string":"默认时区必须是一条字符串。"}}},{"id": "systemconfigmodel-stats_code", "name": "SystemConfigModel[stats_code]", "attribute": "stats_code", "rules": {"string":true,"messages":{"string":"第三方流量统计代码(PC端)必须是一条字符串。"}}},{"id": "systemconfigmodel-stats_code_wap", "name": "SystemConfigModel[stats_code_wap]", "attribute": "stats_code_wap", "rules": {"string":true,"messages":{"string":"第三方流量统计代码(WAP端)必须是一条字符串。"}}},{"id": "systemconfigmodel-pc_site_status", "name": "SystemConfigModel[pc_site_status]", "attribute": "pc_site_status", "rules": {"string":true,"messages":{"string":"PC端状态必须是一条字符串。"}}},{"id": "systemconfigmodel-pc_site_close_image", "name": "SystemConfigModel[pc_site_close_image]", "attribute": "pc_site_close_image", "rules": {"string":true,"messages":{"string":"PC端关闭提示图片必须是一条字符串。"}}},{"id": "systemconfigmodel-site_status", "name": "SystemConfigModel[site_status]", "attribute": "site_status", "rules": {"string":true,"messages":{"string":"网站状态必须是一条字符串。"}}},{"id": "systemconfigmodel-close_comment", "name": "SystemConfigModel[close_comment]", "attribute": "close_comment", "rules": {"string":true,"messages":{"string":"关闭原因必须是一条字符串。"}}},{"id": "systemconfigmodel-upgrade_comment", "name": "SystemConfigModel[upgrade_comment]", "attribute": "upgrade_comment", "rules": {"string":true,"messages":{"string":"升级描述必须是一条字符串。"}}},]
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
                // host: "{{ get_oss_host() }}",
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