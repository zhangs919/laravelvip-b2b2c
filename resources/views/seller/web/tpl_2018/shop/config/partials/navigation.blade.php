<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>

<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "shopconfigmodel-nav_bgcolor", "name": "ShopConfigModel[nav_bgcolor]", "attribute": "nav_bgcolor", "rules": {"string":true,"messages":{"string":"导航背景色必须是一条字符串。"}}},]
</script>

<!--选色插件-->
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=1.2"/>
<script src="/assets/d2eace91/js/jquery-ui.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=1.2"></script>
<script type="text/javascript">
    $().ready(function() {
        $(".colorpicker").colorpicker();
    });
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
            //$("#ShopConfigModel").submit();
            var data = $("#ShopConfigModel").serializeJson();
            $.post('/shop/config/index', data, function(result) {
                $.msg(result.message);
                $.loading.stop();
            }, "json");

        });
    });
</script>