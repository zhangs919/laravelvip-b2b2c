<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-nav_banner_code", "name": "SystemConfigModel[nav_banner_code]", "attribute": "nav_banner_code", "rules": {"string":true,"messages":{"string":"Nav Banner Code必须是一条字符串。"}}},{"id": "systemconfigmodel-site_nav_banner_bgimg_left", "name": "SystemConfigModel[site_nav_banner_bgimg_left]", "attribute": "site_nav_banner_bgimg_left", "rules": {"string":true,"messages":{"string":"背景图片（左）必须是一条字符串。"}}},{"id": "systemconfigmodel-site_nav_banner_bgimg_right", "name": "SystemConfigModel[site_nav_banner_bgimg_right]", "attribute": "site_nav_banner_bgimg_right", "rules": {"string":true,"messages":{"string":"背景图片（右）必须是一条字符串。"}}},{"id": "systemconfigmodel-site_nav_banner_link_left", "name": "SystemConfigModel[site_nav_banner_link_left]", "attribute": "site_nav_banner_link_left", "rules": {"string":true,"messages":{"string":"Site Nav Banner Link Left必须是一条字符串。"}}},{"id": "systemconfigmodel-site_nav_banner_link_right", "name": "SystemConfigModel[site_nav_banner_link_right]", "attribute": "site_nav_banner_link_right", "rules": {"string":true,"messages":{"string":"Site Nav Banner Link Right必须是一条字符串。"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        $("#btn_submit").click(function() {
            $.loading.start();
            $("#SystemConfigModel").submit();
        });

        $("body").on('click', '.clear', function() {
            var code = $(this).data("code");
            $.ajax({
                type: "POST",
                url: "/system/config/clear",
                dataType: "json",
                data: {
                    code: code,
                },
                success: function(result) {
                    $.msg(result.message, {
                        icon: 1
                    });
                    location.reload();
                }
            });
        });
    });
</script>