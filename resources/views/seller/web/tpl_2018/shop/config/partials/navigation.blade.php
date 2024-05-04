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
            //$("#ShopConfigModel").submit();
            var data = $("#ShopConfigModel").serializeJson();
            $.post('/shop/config/index', data, function(result) {
                $.msg(result.message);
            }, "json").always(function(){
                $.loading.stop();
            });
        });
        //选色
        $(".colorpicker").colorpicker();
    });
</script>




