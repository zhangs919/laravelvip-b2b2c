<script id="client_rules" type="text">
[{"id": "shopconfigmodel-integral_validity", "name": "ShopConfigModel[integral_validity]", "attribute": "integral_validity", "rules": {"string":true,"messages":{"string":"积分有效期必须是一条字符串。"}}},{"id": "shopconfigmodel-integral_validity", "name": "ShopConfigModel[integral_validity]", "attribute": "integral_validity", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"积分有效期必须是整数。","min":"积分有效期必须不小于0。","max":"积分有效期必须不大于100。"},"min":0,"max":100}},{"id": "shopconfigmodel-give_integral_confirm", "name": "ShopConfigModel[give_integral_confirm]", "attribute": "give_integral_confirm", "rules": {"string":true,"messages":{"string":"主动确认收货送积分必须是一条字符串。"}}},{"id": "shopconfigmodel-give_integral_confirm", "name": "ShopConfigModel[give_integral_confirm]", "attribute": "give_integral_confirm", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"主动确认收货送积分必须是整数。","min":"主动确认收货送积分必须不小于0。","max":"主动确认收货送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "shopconfigmodel-give_integral_comment", "name": "ShopConfigModel[give_integral_comment]", "attribute": "give_integral_comment", "rules": {"string":true,"messages":{"string":"评价好评送积分必须是一条字符串。"}}},{"id": "shopconfigmodel-give_integral_comment", "name": "ShopConfigModel[give_integral_comment]", "attribute": "give_integral_comment", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"评价好评送积分必须是整数。","min":"评价好评送积分必须不小于0。","max":"评价好评送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "shopconfigmodel-give_integral_consume", "name": "ShopConfigModel[give_integral_consume]", "attribute": "give_integral_consume", "rules": {"string":true,"messages":{"string":"消费金额送积分必须是一条字符串。"}}},{"id": "shopconfigmodel-give_integral_consume", "name": "ShopConfigModel[give_integral_consume]", "attribute": "give_integral_consume", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"消费金额送积分必须是整数。","min":"消费金额送积分必须不小于0。","max":"消费金额送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "shopconfigmodel-give_integral_out_line_balance", "name": "ShopConfigModel[give_integral_out_line_balance]", "attribute": "give_integral_out_line_balance", "rules": {"string":true,"messages":{"string":"线下消费余额送积分必须是一条字符串。"}}},{"id": "shopconfigmodel-give_integral_out_line_balance", "name": "ShopConfigModel[give_integral_out_line_balance]", "attribute": "give_integral_out_line_balance", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"线下消费余额送积分必须是整数。","min":"线下消费余额送积分必须不小于0。","max":"线下消费余额送积分必须不大于9999。"},"min":0,"max":9999}},{"id": "shopconfigmodel-integral_shipping", "name": "ShopConfigModel[integral_shipping]", "attribute": "integral_shipping", "rules": {"required":true,"messages":{"required":"积分兑换配送方式不能为空。"}}},{"id": "shopconfigmodel-integral_qrcode", "name": "ShopConfigModel[integral_qrcode]", "attribute": "integral_qrcode", "rules": {"string":true,"messages":{"string":"店铺积分收款码必须是一条字符串。"}}},]
</script>


<script>
    $().ready(function() {
        var integral_shipping_valid = true;
        if ($("input[name='ShopConfigModel[integral_shipping][]']").is(':checked') == false) {
            $.validator.showError($("#shopconfigmodel-integral_shipping"), '请选择一个积分兑换配送方式');
            integral_shipping_valid = false;
        }
        $("input[name='ShopConfigModel[integral_shipping][]']").change(function() {
            if ($("input[name='ShopConfigModel[integral_shipping][]']").is(':checked') == false) {
                integral_shipping_valid = false;
                $.validator.showError($("#shopconfigmodel-integral_shipping"), '请选择一个积分兑换配送方式');
            } else {
                integral_shipping_valid = true;
                $.validator.clearError($("#shopconfigmodel-integral_shipping"));
            }
        });
        var validator = $("#ShopConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            validator.form();
            if (!validator.form()) {
                return false;
            }
            if (integral_shipping_valid == false) {
                return false
            }
            $.loading.start();
            $("#ShopConfigModel").submit();
        });
        $("body").on("mouseover", ".QR-code", function() {
            if ($(this).data("loading")) {
                return;
            }
            var target = $(this).find("img");
            var src = $(target).data("src");
            var img = new Image();
            img.src = src;
            img.onload = function() {
                $(target).attr("src", src);
            };
            $(this).data("loading", true);
        });
    });
</script>