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
[{"id": "systemconfigmodel-mall_service", "name": "SystemConfigModel[mall_service]", "attribute": "mall_service", "rules": {"string":true,"messages":{"string":"商城底部广告必须是一条字符串。"}}},{"id": "systemconfigmodel-mall_service_right", "name": "SystemConfigModel[mall_service_right]", "attribute": "mall_service_right", "rules": {"string":true,"messages":{"string":"商城底部右侧广告必须是一条字符串。"}}},]
</script>


<!-- 在线文本编辑器 -->
<script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=1.2"></script>
<!-- 创建KindEditor的脚本 必须设置editor_id属性-->

<script type="text/javascript">
    KindEditor.ready(function(K) {

        var extraFileUploadParams = [];
        extraFileUploadParams['CP6ZNQ_YUNMALL_LARAVELVIP_COM_BACKEND_PHPSESSID'] = '239ake8n3e2sb93j1c0c0ijgt1';

        window.editor = K.create('#systemconfigmodel-mall_service', {
            width: '100%',
            height: '450px',
            items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
            themesPath: "/assets/d2eace91/js/editor/themes/",
            cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
            uploadJson: "/site/upload-image",
            extraFileUploadParams: extraFileUploadParams,
            allowImageUpload: true,
            allowFlashUpload: false,
            allowMediaUpload: false,
            allowFileManager: true,
            syncType: "form",
            // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
            pasteType: 2,
            afterCreate: function() {
                var self = this;
                self.sync();
            },
            afterChange: function() {
                var self = this;
                self.sync();
            },
            afterBlur: function() {
                var self = this;
                self.sync();
            }
        });
    });
</script>

<script type="text/javascript">
    KindEditor.ready(function(K) {

        var extraFileUploadParams = [];
        extraFileUploadParams['CP6ZNQ_YUNMALL_LARAVELVIP_COM_BACKEND_PHPSESSID'] = '239ake8n3e2sb93j1c0c0ijgt1';

        window.editor = K.create('#systemconfigmodel-mall_service_right', {
            width: '100%',
            height: '450px',
            items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
            themesPath: "/assets/d2eace91/js/editor/themes/",
            cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
            uploadJson: "/site/upload-image",
            extraFileUploadParams: extraFileUploadParams,
            allowImageUpload: true,
            allowFlashUpload: false,
            allowMediaUpload: false,
            allowFileManager: true,
            syncType: "form",
            // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
            pasteType: 2,
            afterCreate: function() {
                var self = this;
                self.sync();
            },
            afterChange: function() {
                var self = this;
                self.sync();
            },
            afterBlur: function() {
                var self = this;
                self.sync();
            }
        });
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
