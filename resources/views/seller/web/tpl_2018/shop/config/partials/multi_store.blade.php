<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "shopconfigmodel-multi_store_open_enable", "name": "ShopConfigModel[multi_store_open_enable]", "attribute": "multi_store_open_enable", "rules": {"string":true,"messages":{"string":"是否开启连锁门店必须是一条字符串。"}}},{"id": "shopconfigmodel-multi_store_back_manage", "name": "ShopConfigModel[multi_store_back_manage]", "attribute": "multi_store_back_manage", "rules": {"string":true,"messages":{"string":"审核取消订单/退款退货管理必须是一条字符串。"}}},{"id": "shopconfigmodel-multi_store_comment_management", "name": "ShopConfigModel[multi_store_comment_management]", "attribute": "multi_store_comment_management", "rules": {"string":true,"messages":{"string":"评论管理必须是一条字符串。"}}},{"id": "shopconfigmodel-multi_store_sellout_recommend", "name": "ShopConfigModel[multi_store_sellout_recommend]", "attribute": "multi_store_sellout_recommend", "rules": {"string":true,"messages":{"string":"商品售罄推荐必须是一条字符串。"}}},{"id": "shopconfigmodel-multi_store_select_store", "name": "ShopConfigModel[multi_store_select_store]", "attribute": "multi_store_select_store", "rules": {"string":true,"messages":{"string":"自动进门店必须是一条字符串。"}}},{"id": "shopconfigmodel-is_show_guide_recomm", "name": "ShopConfigModel[is_show_guide_recomm]", "attribute": "is_show_guide_recomm", "rules": {"string":true,"messages":{"string":"是否展示引导推荐门店必须是一条字符串。"}}},{"id": "shopconfigmodel-multi_store_check_enable", "name": "ShopConfigModel[multi_store_check_enable]", "attribute": "multi_store_check_enable", "rules": {"string":true,"messages":{"string":"跨门店核销必须是一条字符串。"}}},{"id": "shopconfigmodel-shop_place_order_enable", "name": "ShopConfigModel[shop_place_order_enable]", "attribute": "shop_place_order_enable", "rules": {"string":true,"messages":{"string":"是否允许店铺下单必须是一条字符串。"}}}]
</script> 
<script type="text/javascript">
    // 
    $().ready(function() {
        $("[data-toggle='popover']").popover();
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
            if (!validator.form()) {
                return;
            }
            $("body").trigger("config.submit");
            var result = $("body").data("config.submit.result");
            if (result === false){
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
                gallery: true,
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

