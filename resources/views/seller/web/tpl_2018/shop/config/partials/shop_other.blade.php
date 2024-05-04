<script id="client_rules" type="text">
[{"id": "shopconfigmodel-shop_index_topic", "name": "ShopConfigModel[shop_index_topic]", "attribute": "shop_index_topic", "rules": {"string":true,"messages":{"string":"专题页编号必须是一条字符串。"}}},{"id": "shopconfigmodel-shop_index_topic", "name": "ShopConfigModel[shop_index_topic]", "attribute": "shop_index_topic", "rules": {"required":true,"messages":{"required":"设置专题页为店铺首页时专题页不能为空！"}}},{"id": "shopconfigmodel-shop_index", "name": "ShopConfigModel[shop_index]", "attribute": "shop_index", "rules": {"string":true,"messages":{"string":"店铺首页必须是一条字符串。"}}},{"id": "shopconfigmodel-shop_index_show_goods_number", "name": "ShopConfigModel[shop_index_show_goods_number]", "attribute": "shop_index_show_goods_number", "rules": {"string":true,"messages":{"string":"店铺首页全部商品是否展示数量必须是一条字符串。"}}},{"id": "shopconfigmodel-goods_list_show_mode", "name": "ShopConfigModel[goods_list_show_mode]", "attribute": "goods_list_show_mode", "rules": {"string":true,"messages":{"string":"pc商品列表展示方式必须是一条字符串。"}}},{"id": "shopconfigmodel-m_shop_list_style", "name": "ShopConfigModel[m_shop_list_style]", "attribute": "m_shop_list_style", "rules": {"string":true,"messages":{"string":"店铺商品列表页样式必须是一条字符串。"}}},{"id": "shopconfigmodel-m_search_mode", "name": "ShopConfigModel[m_search_mode]", "attribute": "m_search_mode", "rules": {"string":true,"messages":{"string":"经典样式店铺商品分类页搜索机制必须是一条字符串。"}}},]
</script>


<script>
    $().ready(function() {
        /*商品添加页面右侧发布助手js*/
        $('.helper-icon').click(function() {
            $('.helper-icon').animate({
                'right': '-40px'
            }, 200, function() {
                $('.helper-wrap').animate({
                    'right': '0'
                }, 200);
            });
        });
        $('.help-header .fa-times-circle').click(function() {
            $('.helper-wrap').animate({
                'right': '-140px'
            }, 200, function() {
                $('.helper-icon').animate({
                    'right': '0'
                }, 200);
            });
        });
        //生成页面导航助手
        $("#helper_tool_nav").find("ul").html("");
        var count = 0;
        $("[data-anchor]").each(function() {
            var title = $(this).data("anchor");
            var element = $($.parseHTML("<li><a href='javascript:void(0);'>" + title + "</a></li>"));
            $("#helper_tool_nav").find("ul").append(element);
            var target = this;
            $(element).click(function() {
                $('html, body').animate({
                    scrollTop: $(target).offset().top - 100
                }, 500);
                if ($(target).is(":input")) {
                    $(target).focus();
                } else {
                    $(target).find(":input").first().focus();
                }
            });
            count++;
        });
        $("#helper_tool_nav").find(".count").html(count);
        $('.helper-icon').click();
    });
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