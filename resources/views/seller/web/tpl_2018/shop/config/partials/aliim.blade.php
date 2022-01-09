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
[{"id": "shopconfigmodel-aliim_enable", "name": "ShopConfigModel[aliim_enable]", "attribute": "aliim_enable", "rules": {"string":true,"messages":{"string":"是否启用必须是一条字符串。"}}},{"id": "shopconfigmodel-aliim_app_key", "name": "ShopConfigModel[aliim_app_key]", "attribute": "aliim_app_key", "rules": {"string":true,"messages":{"string":"阿里云旺AppKey必须是一条字符串。"}}},{"id": "shopconfigmodel-aliim_app_key", "name": "ShopConfigModel[aliim_app_key]", "attribute": "aliim_app_key", "rules": {"required":true,"messages":{"required":"阿里云旺AppKey不能为空。"}}},{"id": "shopconfigmodel-aliim_secret_key", "name": "ShopConfigModel[aliim_secret_key]", "attribute": "aliim_secret_key", "rules": {"string":true,"messages":{"string":"阿里云旺AppSecrect必须是一条字符串。"}}},{"id": "shopconfigmodel-aliim_secret_key", "name": "ShopConfigModel[aliim_secret_key]", "attribute": "aliim_secret_key", "rules": {"required":true,"messages":{"required":"阿里云旺AppSecrect不能为空。"}}},{"id": "shopconfigmodel-aliim_main_customer", "name": "ShopConfigModel[aliim_main_customer]", "attribute": "aliim_main_customer", "rules": {"string":true,"messages":{"string":"在线主客服账户必须是一条字符串。"}}},{"id": "shopconfigmodel-aliim_main_customer", "name": "ShopConfigModel[aliim_main_customer]", "attribute": "aliim_main_customer", "rules": {"required":true,"messages":{"required":"在线主客服账户不能为空。"}}},{"id": "shopconfigmodel-aliim_customer_logo", "name": "ShopConfigModel[aliim_customer_logo]", "attribute": "aliim_customer_logo", "rules": {"string":true,"messages":{"string":"在线客服头像Logo必须是一条字符串。"}}},]
</script>





<script type="text/javascript">
    $().ready(function() {

        var validator = $("#ShopConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            validator.form();
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            $("#ShopConfigModel").submit();
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
                host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/",
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