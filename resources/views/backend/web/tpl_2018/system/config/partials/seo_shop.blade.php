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
[{"id": "systemconfigmodel-seo_shop_title", "name": "SystemConfigModel[seo_shop_title]", "attribute": "seo_shop_title", "rules": {"string":true,"messages":{"string":"title必须是一条字符串。"}}},{"id": "systemconfigmodel-seo_shop_keywords", "name": "SystemConfigModel[seo_shop_keywords]", "attribute": "seo_shop_keywords", "rules": {"string":true,"messages":{"string":"keywords必须是一条字符串。"}}},{"id": "systemconfigmodel-seo_shop_discription", "name": "SystemConfigModel[seo_shop_discription]", "attribute": "seo_shop_discription", "rules": {"string":true,"messages":{"string":"description必须是一条字符串。"}}},{"id": "systemconfigmodel-seo_shop_street_title", "name": "SystemConfigModel[seo_shop_street_title]", "attribute": "seo_shop_street_title", "rules": {"string":true,"messages":{"string":"title必须是一条字符串。"}}},{"id": "systemconfigmodel-seo_shop_street_keywords", "name": "SystemConfigModel[seo_shop_street_keywords]", "attribute": "seo_shop_street_keywords", "rules": {"string":true,"messages":{"string":"keywords必须是一条字符串。"}}},{"id": "systemconfigmodel-seo_shop_street_discription", "name": "SystemConfigModel[seo_shop_street_discription]", "attribute": "seo_shop_street_discription", "rules": {"string":true,"messages":{"string":"description必须是一条字符串。"}}},{"id": "systemconfigmodel-seo_shop_street_image", "name": "SystemConfigModel[seo_shop_street_image]", "attribute": "seo_shop_street_image", "rules": {"string":true,"messages":{"string":"店铺街分享推广图必须是一条字符串。"}}},]
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