<script id="client_rules" type="text">
[{"id": "shopconfigmodel-take_enable", "name": "ShopConfigModel[take_enable]", "attribute": "take_enable", "rules": {"string":true,"messages":{"string":"是否启用接单模式必须是一条字符串。"}}},{"id": "shopconfigmodel-trade_enable", "name": "ShopConfigModel[trade_enable]", "attribute": "trade_enable", "rules": {"string":true,"messages":{"string":"是否启用自动打印订单必须是一条字符串。"}}},{"id": "shopconfigmodel-trade_mode", "name": "ShopConfigModel[trade_mode]", "attribute": "trade_mode", "rules": {"string":true,"messages":{"string":"打印模式必须是一条字符串。"}}},{"id": "shopconfigmodel-order_notice_enable", "name": "ShopConfigModel[order_notice_enable]", "attribute": "order_notice_enable", "rules": {"string":true,"messages":{"string":"语音提醒是否开启必须是一条字符串。"}}},{"id": "shopconfigmodel-order_refresh", "name": "ShopConfigModel[order_refresh]", "attribute": "order_refresh", "rules": {"string":true,"messages":{"string":"订单列表自动刷新必须是一条字符串。"}}},{"id": "shopconfigmodel-notice_count", "name": "ShopConfigModel[notice_count]", "attribute": "notice_count", "rules": {"string":true,"messages":{"string":"声音提醒频率必须是一条字符串。"}}},]
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
