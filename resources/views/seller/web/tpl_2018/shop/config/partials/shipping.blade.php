<script src="/assets/d2eace91/min/js/validate.min.js"></script>

<script id="client_rules" type="text">
[{"id": "shopconfigmodel-zxps_open", "name": "ShopConfigModel[zxps_open]", "attribute": "zxps_open", "rules": {"string":true,"messages":{"string":"是否开启必须是一条字符串。"}}},]
</script>


<script>
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