<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180710"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180710"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180710"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180710"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180710"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=20180710"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "shopconfigmodel-freight_fee", "name": "ShopConfigModel[freight_fee]", "attribute": "freight_fee", "rules": {"string":true,"messages":{"string":"店铺统一运费必须是一条字符串。"}}},{"id": "shopconfigmodel-freight_fee", "name": "ShopConfigModel[freight_fee]", "attribute": "freight_fee", "rules": {"required":true,"messages":{"required":"店铺统一运费不能为空。"}}},{"id": "shopconfigmodel-freight_fee", "name": "ShopConfigModel[freight_fee]", "attribute": "freight_fee", "rules": {"required":true,"messages":{"required":"店铺统一运费不能为空。"}}},{"id": "shopconfigmodel-freight_fee", "name": "ShopConfigModel[freight_fee]", "attribute": "freight_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺统一运费必须是一个数字。","decimal":"店铺统一运费必须是一个不大于2位小数的数字。","min":"店铺统一运费必须不小于0。","max":"店铺统一运费必须不大于1000。"},"decimal":2,"min":0,"max":1000}},{"id": "shopconfigmodel-freight_cod_enable", "name": "ShopConfigModel[freight_cod_enable]", "attribute": "freight_cod_enable", "rules": {"string":true,"messages":{"string":"是否支持货到付款必须是一条字符串。"}}},{"id": "shopconfigmodel-freight_cod_enable", "name": "ShopConfigModel[freight_cod_enable]", "attribute": "freight_cod_enable", "rules": {"required":true,"messages":{"required":"是否支持货到付款不能为空。"}}},{"id": "shopconfigmodel-freight_cash_more", "name": "ShopConfigModel[freight_cash_more]", "attribute": "freight_cash_more", "rules": {"string":true,"messages":{"string":"货到付款加价必须是一条字符串。"}}},{"id": "shopconfigmodel-freight_cash_more", "name": "ShopConfigModel[freight_cash_more]", "attribute": "freight_cash_more", "rules": {"required":true,"messages":{"required":"货到付款加价不能为空。"}}},{"id": "shopconfigmodel-freight_cash_more", "name": "ShopConfigModel[freight_cash_more]", "attribute": "freight_cash_more", "rules": {"required":true,"messages":{"required":"货到付款加价不能为空。"}}},{"id": "shopconfigmodel-freight_cash_more", "name": "ShopConfigModel[freight_cash_more]", "attribute": "freight_cash_more", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"货到付款加价必须是一个数字。","decimal":"货到付款加价必须是一个不大于2位小数的数字。","min":"货到付款加价必须不小于0。"},"decimal":2,"min":0}},]
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
                host: "{{ get_oss_host() }}",
                size: size,
                mode: mode,
                labels: labels,
                options: options,
                values: value.split("|"),
                // 改变事件
                change: function(values, type){
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