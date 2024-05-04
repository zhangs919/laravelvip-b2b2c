{{--<script id="client_rules" type="text">--}}
{{--[{"id": "shopconfigmodel-bonus_img1", "name": "ShopConfigModel[bonus_img1]", "attribute": "bonus_img1", "rules": {"string":true,"messages":{"string":"滚动图片1必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_img2", "name": "ShopConfigModel[bonus_img2]", "attribute": "bonus_img2", "rules": {"string":true,"messages":{"string":"滚动图片2必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_img3", "name": "ShopConfigModel[bonus_img3]", "attribute": "bonus_img3", "rules": {"string":true,"messages":{"string":"滚动图片3必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_img4", "name": "ShopConfigModel[bonus_img4]", "attribute": "bonus_img4", "rules": {"string":true,"messages":{"string":"滚动图片4必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_link1", "name": "ShopConfigModel[bonus_link1]", "attribute": "bonus_link1", "rules": {"string":true,"messages":{"string":"Bonus Link1必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_link2", "name": "ShopConfigModel[bonus_link2]", "attribute": "bonus_link2", "rules": {"string":true,"messages":{"string":"Bonus Link2必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_link3", "name": "ShopConfigModel[bonus_link3]", "attribute": "bonus_link3", "rules": {"string":true,"messages":{"string":"Bonus Link3必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_link4", "name": "ShopConfigModel[bonus_link4]", "attribute": "bonus_link4", "rules": {"string":true,"messages":{"string":"Bonus Link4必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_img1", "name": "ShopConfigModel[m_bonus_img1]", "attribute": "m_bonus_img1", "rules": {"string":true,"messages":{"string":"滚动图片1必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_img2", "name": "ShopConfigModel[m_bonus_img2]", "attribute": "m_bonus_img2", "rules": {"string":true,"messages":{"string":"滚动图片2必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_img3", "name": "ShopConfigModel[m_bonus_img3]", "attribute": "m_bonus_img3", "rules": {"string":true,"messages":{"string":"滚动图片3必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_img4", "name": "ShopConfigModel[m_bonus_img4]", "attribute": "m_bonus_img4", "rules": {"string":true,"messages":{"string":"滚动图片4必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_link1", "name": "ShopConfigModel[m_bonus_link1]", "attribute": "m_bonus_link1", "rules": {"string":true,"messages":{"string":"M Bonus Link1必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_link2", "name": "ShopConfigModel[m_bonus_link2]", "attribute": "m_bonus_link2", "rules": {"string":true,"messages":{"string":"M Bonus Link2必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_link3", "name": "ShopConfigModel[m_bonus_link3]", "attribute": "m_bonus_link3", "rules": {"string":true,"messages":{"string":"M Bonus Link3必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_link4", "name": "ShopConfigModel[m_bonus_link4]", "attribute": "m_bonus_link4", "rules": {"string":true,"messages":{"string":"M Bonus Link4必须是一条字符串。"}}},{"id": "shopconfigmodel-guide_ad", "name": "ShopConfigModel[guide_ad]", "attribute": "guide_ad", "rules": {"string":true,"messages":{"string":"pc端引导广告图必须是一条字符串。"}}},{"id": "shopconfigmodel-m_guide_ad", "name": "ShopConfigModel[m_guide_ad]", "attribute": "m_guide_ad", "rules": {"string":true,"messages":{"string":"手机端引导广告图必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_share_name", "name": "ShopConfigModel[bonus_share_name]", "attribute": "bonus_share_name", "rules": {"string":true,"messages":{"string":"红包集市页面名称必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_share_name", "name": "ShopConfigModel[bonus_share_name]", "attribute": "bonus_share_name", "rules": {"string":true,"messages":{"string":"红包集市页面名称必须是一条字符串。","maxlength":"红包集市页面名称只能包含至多15个字符。"},"maxlength":"15"}},{"id": "shopconfigmodel-bonus_share_title", "name": "ShopConfigModel[bonus_share_title]", "attribute": "bonus_share_title", "rules": {"string":true,"messages":{"string":"红包集市分享标题必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_share_title", "name": "ShopConfigModel[bonus_share_title]", "attribute": "bonus_share_title", "rules": {"string":true,"messages":{"string":"红包集市分享标题必须是一条字符串。","maxlength":"红包集市分享标题只能包含至多40个字符。"},"maxlength":"40"}},{"id": "shopconfigmodel-bonus_share_desc", "name": "ShopConfigModel[bonus_share_desc]", "attribute": "bonus_share_desc", "rules": {"string":true,"messages":{"string":"红包集市分享内容必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_share_desc", "name": "ShopConfigModel[bonus_share_desc]", "attribute": "bonus_share_desc", "rules": {"string":true,"messages":{"string":"红包集市分享内容必须是一条字符串。","maxlength":"红包集市分享内容只能包含至多100个字符。"},"maxlength":"100"}},{"id": "shopconfigmodel-bonus_share_image", "name": "ShopConfigModel[bonus_share_image]", "attribute": "bonus_share_image", "rules": {"string":true,"messages":{"string":"分享推广图必须是一条字符串。"}}},]--}}
{{--</script>--}}


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
        //图片上传组件
        $(".imagegroup_container").each(function() {
            var id = $(this).data("id");
            var target = $("#" + id);
            var value = $(target).val();
            var options = $(this).data("options") ? $(this).data("options") : [];
            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: 1,
                options: options,
                values: value.split("|"),
                // 改变事件
                change: function(values, type) {
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
        });
        //提交
        $("#btn_submit").click(function() {
            validator.form();
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            $("#ShopConfigModel").submit();
        });
        $("body").on('click', '.clear', function() {
            var code = $(this).data("code");
            $.ajax({
                type: "POST",
                url: "/shop/config/clear",
                dataType: "json",
                data: {
                    code: code
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