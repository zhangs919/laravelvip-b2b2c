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
[{"id": "systemconfigmodel-image_dir_type", "name": "SystemConfigModel[image_dir_type]", "attribute": "image_dir_type", "rules": {"string":true,"messages":{"string":"图片存放方式必须是一条字符串。"}}},{"id": "systemconfigmodel-image_max_filesize", "name": "SystemConfigModel[image_max_filesize]", "attribute": "image_max_filesize", "rules": {"string":true,"messages":{"string":"图片/附件大小必须是一条字符串。"}}},{"id": "systemconfigmodel-image_max_filesize", "name": "SystemConfigModel[image_max_filesize]", "attribute": "image_max_filesize", "rules": {"required":true,"messages":{"required":"图片/附件大小不能为空。"}}},{"id": "systemconfigmodel-image_max_filesize", "name": "SystemConfigModel[image_max_filesize]", "attribute": "image_max_filesize", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片/附件大小必须是整数。","min":"图片/附件大小必须不小于1。","max":"图片/附件大小必须不大于4194304。"},"min":1,"max":4194304}},{"id": "systemconfigmodel-video_max_filesize", "name": "SystemConfigModel[video_max_filesize]", "attribute": "video_max_filesize", "rules": {"string":true,"messages":{"string":"视频大小必须是一条字符串。"}}},{"id": "systemconfigmodel-video_max_filesize", "name": "SystemConfigModel[video_max_filesize]", "attribute": "video_max_filesize", "rules": {"required":true,"messages":{"required":"视频大小不能为空。"}}},{"id": "systemconfigmodel-video_max_filesize", "name": "SystemConfigModel[video_max_filesize]", "attribute": "video_max_filesize", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"视频大小必须是整数。","min":"视频大小必须不小于1。","max":"视频大小必须不大于4194304。"},"min":1,"max":4194304}},]
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