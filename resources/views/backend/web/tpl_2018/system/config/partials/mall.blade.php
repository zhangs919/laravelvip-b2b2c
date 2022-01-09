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
[{"id": "systemconfigmodel-mall_logo", "name": "SystemConfigModel[mall_logo]", "attribute": "mall_logo", "rules": {"string":true,"messages":{"string":"商城Logo必须是一条字符串。"}}},{"id": "systemconfigmodel-user_center_logo", "name": "SystemConfigModel[user_center_logo]", "attribute": "user_center_logo", "rules": {"string":true,"messages":{"string":"会员中心Logo必须是一条字符串。"}}},{"id": "systemconfigmodel-seller_center_logo", "name": "SystemConfigModel[seller_center_logo]", "attribute": "seller_center_logo", "rules": {"string":true,"messages":{"string":"卖家中心Logo必须是一条字符串。"}}},{"id": "systemconfigmodel-store_center_logo", "name": "SystemConfigModel[store_center_logo]", "attribute": "store_center_logo", "rules": {"string":true,"messages":{"string":"网点中心Logo必须是一条字符串。"}}},{"id": "systemconfigmodel-mall_phone", "name": "SystemConfigModel[mall_phone]", "attribute": "mall_phone", "rules": {"string":true,"messages":{"string":"平台方客服联系电话必须是一条字符串。"}}},{"id": "systemconfigmodel-mall_phone", "name": "SystemConfigModel[mall_phone]", "attribute": "mall_phone", "rules": {"match":{"pattern":/^((0[0-9]{2,3}-[0-9]{7,8})|([0-9]{2,4}-[0-9]{2,4}-[0-9]{2,4})|([0-9]{2,4}[0-9]{2,4}[0-9]{2,4})|(13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}))$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入有效电话号码。"}}},{"id": "systemconfigmodel-mall_email", "name": "SystemConfigModel[mall_email]", "attribute": "mall_email", "rules": {"string":true,"messages":{"string":"平台方客服电子邮件必须是一条字符串。"}}},{"id": "systemconfigmodel-mall_email", "name": "SystemConfigModel[mall_email]", "attribute": "mall_email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"请输入有效的邮箱地址。"}}},{"id": "systemconfigmodel-mall_qq", "name": "SystemConfigModel[mall_qq]", "attribute": "mall_qq", "rules": {"string":true,"messages":{"string":"QQ客服必须是一条字符串。"}}},{"id": "systemconfigmodel-mall_qq", "name": "SystemConfigModel[mall_qq]", "attribute": "mall_qq", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"请输入有效的QQ号。"}}},{"id": "systemconfigmodel-mall_wangwang", "name": "SystemConfigModel[mall_wangwang]", "attribute": "mall_wangwang", "rules": {"string":true,"messages":{"string":"旺旺客服必须是一条字符串。"}}},{"id": "systemconfigmodel-mall_region_code", "name": "SystemConfigModel[mall_region_code]", "attribute": "mall_region_code", "rules": {"string":true,"messages":{"string":"所在地区 必须是一条字符串。"}}},{"id": "systemconfigmodel-mall_region_code", "name": "SystemConfigModel[mall_region_code]", "attribute": "mall_region_code", "rules": {"required":true,"messages":{"required":"所在地区 不能为空。"}}},{"id": "systemconfigmodel-mall_region_code", "name": "SystemConfigModel[mall_region_code]", "attribute": "mall_region_code", "rules": {"region":{"min":3},"messages":{"region":"所在地区  不能小于3级"}}},{"id": "systemconfigmodel-mall_address", "name": "SystemConfigModel[mall_address]", "attribute": "mall_address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。"}}},{"id": "systemconfigmodel-mall_wx_qrcode", "name": "SystemConfigModel[mall_wx_qrcode]", "attribute": "mall_wx_qrcode", "rules": {"string":true,"messages":{"string":"商城微信二维码必须是一条字符串。"}}},{"id": "systemconfigmodel-user_protocol", "name": "SystemConfigModel[user_protocol]", "attribute": "user_protocol", "rules": {"string":true,"messages":{"string":"会员注册协议必须是一条字符串。"}}},{"id": "systemconfigmodel-seller_protocol", "name": "SystemConfigModel[seller_protocol]", "attribute": "seller_protocol", "rules": {"string":true,"messages":{"string":"商家入驻协议必须是一条字符串。"}}},]
</script>


<!-- 在线文本编辑器 -->
<script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=1.2"></script>
<!-- 创建KindEditor的脚本 必须设置editor_id属性-->

<script type="text/javascript">
    KindEditor.ready(function(K) {

        var extraFileUploadParams = [];
        extraFileUploadParams['CP6ZNQ_YUNMALL_68MALL_COM_BACKEND_PHPSESSID'] = '239ake8n3e2sb93j1c0c0ijgt1';

        window.editor = K.create('#systemconfigmodel-user_protocol', {
            width: '100%',
            height: '450px',
            items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
            themesPath: "/assets/d2eace91/js/editor/themes/",
            cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
            uploadJson: "/site/upload-image.html",
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
        extraFileUploadParams['CP6ZNQ_YUNMALL_68MALL_COM_BACKEND_PHPSESSID'] = '239ake8n3e2sb93j1c0c0ijgt1';

        window.editor = K.create('#systemconfigmodel-seller_protocol', {
            width: '100%',
            height: '450px',
            items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
            themesPath: "/assets/d2eace91/js/editor/themes/",
            cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
            uploadJson: "/site/upload-image.html",
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

<script src="/assets/d2eace91/js/jquery.region.js?v=1.2"></script>
<script type="text/javascript">
    $().ready(function() {
        $(".region-container").each(function() {
            var target = this;
            var id = $(this).data("id");
            var value = $("#" + id).val();
            var sale_scope = $(this).data("sale-scope");
            var min_level = $(this).data("min-level");
            sale_scope = sale_scope && (sale_scope == 1 || sale_scope == 'true') ? true : false;
            min_level = isNaN(min_level) ? 0 : min_level;
            $(this).regionselector({
                value: value,
                sale_scope: sale_scope,
                select_class: "form-control",
                change: function(value, names, is_last) {
                    $("#" + id).val(value);
                    $("#" + id).data("is_last", is_last);
                    $("#" + id).valid();
                }
            });
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
                host: '{{ get_oss_host() }}',//"http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/",
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
                host: '{{ get_oss_host() }}',//"http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/",
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