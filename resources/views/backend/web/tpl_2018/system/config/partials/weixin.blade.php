<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180813"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180813"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180813"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-weixin_name", "name": "SystemConfigModel[weixin_name]", "attribute": "weixin_name", "rules": {"string":true,"messages":{"string":"名称必须是一条字符串。"}}},{"id": "systemconfigmodel-token", "name": "SystemConfigModel[token]", "attribute": "token", "rules": {"string":true,"messages":{"string":"Token(令牌)必须是一条字符串。"}}},{"id": "systemconfigmodel-token", "name": "SystemConfigModel[token]", "attribute": "token", "rules": {"required":true,"messages":{"required":"Token(令牌)不能为空。"}}},{"id": "systemconfigmodel-appid", "name": "SystemConfigModel[appid]", "attribute": "appid", "rules": {"string":true,"messages":{"string":"应用ID必须是一条字符串。"}}},{"id": "systemconfigmodel-appid", "name": "SystemConfigModel[appid]", "attribute": "appid", "rules": {"required":true,"messages":{"required":"应用ID不能为空。"}}},{"id": "systemconfigmodel-appsecret", "name": "SystemConfigModel[appsecret]", "attribute": "appsecret", "rules": {"string":true,"messages":{"string":"应用密钥必须是一条字符串。"}}},{"id": "systemconfigmodel-appsecret", "name": "SystemConfigModel[appsecret]", "attribute": "appsecret", "rules": {"required":true,"messages":{"required":"应用密钥不能为空。"}}},{"id": "systemconfigmodel-auth_verify", "name": "SystemConfigModel[auth_verify]", "attribute": "auth_verify", "rules": {"string":true,"messages":{"string":"授权验证码必须是一条字符串。"}}},{"id": "systemconfigmodel-auth_verify", "name": "SystemConfigModel[auth_verify]", "attribute": "auth_verify", "rules": {"required":true,"messages":{"required":"授权验证码不能为空。"}}},]
</script>
<script type="text/javascript">
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

        var validator = $("#SystemConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return false;
            }

            $.loading.start();
            $("#SystemConfigModel").submit();
        });

        $("body").on("click", ".clear", function() {
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/weixin/weixin-config/clear',
                dataType: 'json',
                success: function(result) {
                    $.go('/system/config/index?group=weixin');
                    $.msg(result.message);
                }
            }).always(function() {
                $.loading.stop();
            });
        })

    });
</script>