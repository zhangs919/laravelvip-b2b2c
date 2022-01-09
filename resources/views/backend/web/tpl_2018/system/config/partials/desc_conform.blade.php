<script type="text/javascript">
    $().ready(function() {
        $("#btn_submit").click(function() {
            var data = $("#SystemConfigModel").serializeJson();
            $.post('', data, function(result) {
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
        });
    });
</script>