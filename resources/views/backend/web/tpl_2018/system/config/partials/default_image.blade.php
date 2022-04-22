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
[{"id": "systemconfigmodel-default_goods_image", "name": "SystemConfigModel[default_goods_image]", "attribute": "default_goods_image", "rules": {"string":true,"messages":{"string":"默认商品图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_goods_image", "name": "SystemConfigModel[default_goods_image]", "attribute": "default_goods_image", "rules": {"required":true,"messages":{"required":"默认商品图片不能为空。"}}},{"id": "systemconfigmodel-default_shop_logo", "name": "SystemConfigModel[default_shop_logo]", "attribute": "default_shop_logo", "rules": {"string":true,"messages":{"string":"默认店铺Logo必须是一条字符串。"}}},{"id": "systemconfigmodel-default_shop_logo", "name": "SystemConfigModel[default_shop_logo]", "attribute": "default_shop_logo", "rules": {"required":true,"messages":{"required":"默认店铺Logo不能为空。"}}},{"id": "systemconfigmodel-default_shop_image", "name": "SystemConfigModel[default_shop_image]", "attribute": "default_shop_image", "rules": {"string":true,"messages":{"string":"默认店铺头像必须是一条字符串。"}}},{"id": "systemconfigmodel-default_user_portrait", "name": "SystemConfigModel[default_user_portrait]", "attribute": "default_user_portrait", "rules": {"string":true,"messages":{"string":"默认用户头像必须是一条字符串。"}}},{"id": "systemconfigmodel-default_micro_shop_image", "name": "SystemConfigModel[default_micro_shop_image]", "attribute": "default_micro_shop_image", "rules": {"string":true,"messages":{"string":"默认微店头像必须是一条字符串。"}}},{"id": "systemconfigmodel-default_article_cat_image", "name": "SystemConfigModel[default_article_cat_image]", "attribute": "default_article_cat_image", "rules": {"string":true,"messages":{"string":"默认文章分类图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_lazyload", "name": "SystemConfigModel[default_lazyload]", "attribute": "default_lazyload", "rules": {"string":true,"messages":{"string":"PC端默认缓载图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_lazyload_mobile", "name": "SystemConfigModel[default_lazyload_mobile]", "attribute": "default_lazyload_mobile", "rules": {"string":true,"messages":{"string":"手机端默认缓载图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_noresult", "name": "SystemConfigModel[default_noresult]", "attribute": "default_noresult", "rules": {"string":true,"messages":{"string":"无记录默认图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_video_image", "name": "SystemConfigModel[default_video_image]", "attribute": "default_video_image", "rules": {"string":true,"messages":{"string":"默认视频封面图必须是一条字符串。"}}},{"id": "systemconfigmodel-idcard_demo_image", "name": "SystemConfigModel[idcard_demo_image]", "attribute": "idcard_demo_image", "rules": {"string":true,"messages":{"string":"实名认证示例图片必须是一条字符串。"}}},{"id": "systemconfigmodel-company_demo_image", "name": "SystemConfigModel[company_demo_image]", "attribute": "company_demo_image", "rules": {"string":true,"messages":{"string":"企业认证示例图片必须是一条字符串。"}}},]
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
                // host: "{{ get_oss_host() }}",
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