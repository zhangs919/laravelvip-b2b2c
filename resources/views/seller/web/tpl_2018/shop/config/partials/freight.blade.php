<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "shopconfigmodel-freight_fee", "name": "ShopConfigModel[freight_fee]", "attribute": "freight_fee", "rules": {"string":true,"messages":{"string":"店铺统一运费必须是一条字符串。"}}},{"id": "shopconfigmodel-freight_fee", "name": "ShopConfigModel[freight_fee]", "attribute": "freight_fee", "rules": {"required":true,"messages":{"required":"店铺统一运费不能为空。"}}},{"id": "shopconfigmodel-freight_fee", "name": "ShopConfigModel[freight_fee]", "attribute": "freight_fee", "rules": {"required":true,"messages":{"required":"店铺统一运费不能为空。"}}},{"id": "shopconfigmodel-freight_fee", "name": "ShopConfigModel[freight_fee]", "attribute": "freight_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺统一运费必须是一个数字。","decimal":"店铺统一运费必须是一个不大于2位小数的数字。","min":"店铺统一运费必须不小于0。","max":"店铺统一运费必须不大于1000。"},"decimal":2,"min":0,"max":1000}},{"id": "shopconfigmodel-freight_cod_enable", "name": "ShopConfigModel[freight_cod_enable]", "attribute": "freight_cod_enable", "rules": {"string":true,"messages":{"string":"是否支持货到付款必须是一条字符串。"}}},{"id": "shopconfigmodel-freight_cod_enable", "name": "ShopConfigModel[freight_cod_enable]", "attribute": "freight_cod_enable", "rules": {"required":true,"messages":{"required":"是否支持货到付款不能为空。"}}},{"id": "shopconfigmodel-freight_cash_more", "name": "ShopConfigModel[freight_cash_more]", "attribute": "freight_cash_more", "rules": {"string":true,"messages":{"string":"货到付款加价必须是一条字符串。"}}},{"id": "shopconfigmodel-freight_cash_more", "name": "ShopConfigModel[freight_cash_more]", "attribute": "freight_cash_more", "rules": {"required":true,"messages":{"required":"货到付款加价不能为空。"}}},{"id": "shopconfigmodel-freight_cash_more", "name": "ShopConfigModel[freight_cash_more]", "attribute": "freight_cash_more", "rules": {"required":true,"messages":{"required":"货到付款加价不能为空。"}}},{"id": "shopconfigmodel-freight_cash_more", "name": "ShopConfigModel[freight_cash_more]", "attribute": "freight_cash_more", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"货到付款加价必须是一个数字。","decimal":"货到付款加价必须是一个不大于2位小数的数字。","min":"货到付款加价必须不小于0。"},"decimal":2,"min":0}},{"id": "shopconfigmodel-packing_fee", "name": "ShopConfigModel[packing_fee]", "attribute": "packing_fee", "rules": {"string":true,"messages":{"string":"包装费必须是一条字符串。"}}},{"id": "shopconfigmodel-packing_fee", "name": "ShopConfigModel[packing_fee]", "attribute": "packing_fee", "rules": {"required":true,"messages":{"required":"包装费不能为空。"}}},{"id": "shopconfigmodel-packing_fee", "name": "ShopConfigModel[packing_fee]", "attribute": "packing_fee", "rules": {"required":true,"messages":{"required":"包装费不能为空。"}}},{"id": "shopconfigmodel-packing_fee", "name": "ShopConfigModel[packing_fee]", "attribute": "packing_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"包装费必须是一个数字。","decimal":"包装费必须是一个不大于2位小数的数字。","min":"包装费必须不小于0。"},"decimal":2,"min":0}},{"id": "shopconfigmodel-shipping_time", "name": "ShopConfigModel[shipping_time]", "attribute": "shipping_time", "rules": {"string":true,"messages":{"string":"额外配送费必须是一条字符串。"}}},{"id": "shopconfigmodel-shipping_time", "name": "ShopConfigModel[shipping_time]", "attribute": "shipping_time", "rules": {"required":true,"messages":{"required":"额外配送费不能为空。"}}},{"id": "shopconfigmodel-other_shipping_fee", "name": "ShopConfigModel[other_shipping_fee]", "attribute": "other_shipping_fee", "rules": {"string":true,"messages":{"string":"额外配送费必须是一条字符串。"}}},{"id": "shopconfigmodel-other_shipping_fee", "name": "ShopConfigModel[other_shipping_fee]", "attribute": "other_shipping_fee", "rules": {"required":true,"messages":{"required":"额外配送费不能为空。"}}},{"id": "shopconfigmodel-other_shipping_fee", "name": "ShopConfigModel[other_shipping_fee]", "attribute": "other_shipping_fee", "rules": {"required":true,"messages":{"required":"额外配送费不能为空。"}}},{"id": "shopconfigmodel-other_shipping_fee", "name": "ShopConfigModel[other_shipping_fee]", "attribute": "other_shipping_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"额外配送费必须是一个数字。","decimal":"额外配送费必须是一个不大于2位小数的数字。","min":"额外配送费必须不小于0。"},"decimal":2,"min":0}},]
</script>
<script type="text/javascript">
    //
</script>


<script>
    $().ready(function() {
        //悬浮显示上下步骤按钮
        window.onscroll = function() {
            $(window).scroll(function() {
                var scrollTop = $(document).scrollTop();
                var height = $(".page").height();
                var wHeight = $(window).height();
                if (scrollTop > (height - wHeight)) {
                    $(".bottom-btn").removeClass("bottom-btn-fixed");
                } else {
                    $(".bottom-btn").addClass("bottom-btn-fixed");
                }
            });
        };
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
        });
    });
</script>