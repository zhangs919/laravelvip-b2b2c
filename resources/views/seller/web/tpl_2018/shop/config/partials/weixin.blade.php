<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190221"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190221"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190221"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190221"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190221"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=20190221"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "shopconfigmodel-appid", "name": "ShopConfigModel[appid]", "attribute": "appid", "rules": {"string":true,"messages":{"string":"应用ID必须是一条字符串。"}}},{"id": "shopconfigmodel-appid", "name": "ShopConfigModel[appid]", "attribute": "appid", "rules": {"required":true,"messages":{"required":"应用ID不能为空。"}}},{"id": "shopconfigmodel-appsecret", "name": "ShopConfigModel[appsecret]", "attribute": "appsecret", "rules": {"string":true,"messages":{"string":"应用密钥必须是一条字符串。"}}},{"id": "shopconfigmodel-appsecret", "name": "ShopConfigModel[appsecret]", "attribute": "appsecret", "rules": {"required":true,"messages":{"required":"应用密钥不能为空。"}}},{"id": "shopconfigmodel-auth_verify", "name": "ShopConfigModel[auth_verify]", "attribute": "auth_verify", "rules": {"string":true,"messages":{"string":"授权验证码必须是一条字符串。"}}},{"id": "shopconfigmodel-auth_verify", "name": "ShopConfigModel[auth_verify]", "attribute": "auth_verify", "rules": {"required":true,"messages":{"required":"授权验证码不能为空。"}}},{"id": "shopconfigmodel-shop_wechat", "name": "ShopConfigModel[shop_wechat]", "attribute": "shop_wechat", "rules": {"string":true,"messages":{"string":"必须是一条字符串。"}}},]
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
        });

        $(".szy-imagegroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");

            var target = $("#" + id);
            var value = $(target).val();

            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
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

        $("body").on("click", ".clear", function() {
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/shop/weixin-config/clear',
                dataType: 'json',
                success: function(result) {
                    $.msg(result.message, function(){
                        $.go('/shop/weixin-config/index.html');
                    });
                }
            }).always(function() {
                $.loading.stop();
            });
        })
    });
</script>