<script>
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