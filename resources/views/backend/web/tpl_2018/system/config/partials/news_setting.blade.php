<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180702"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180702"></script>
<script type="text/javascript">
    $().ready(function() {
        var group = $("input[name='group']").val();
        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            $.loading.start();
            var data = $("#SystemConfigModel").serializeJson();
            $.post('/system/config/index', data, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    var modal = $.modal($("#{{ $uuid }}"));
                    if (modal) {
                        modal.hide();
                        $.msg(result.message);
                        window.location.reload();
                    }
                } else {
                    $.msg(result.message);
                }
            }, "json");
        });
    });
</script>


<!--选色插件-->
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=20180702"/>
<script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=20180702"></script>
<script type="text/javascript">
    $().ready(function() {
        $("#{{ $uuid }}").find('.bootstrap-switch [type="checkbox"]').bootstrapSwitch({
            radioAllOff: true,
            onSwitchChange: function(event, state) {
                $(event.target).prop("checked", state);
                $(event.target).change();
            }
        });

        $("[data-switch-toggle]").on("click", function() {
            var type = $(this).data("switch-toggle");
            return $("#switch-" + type).bootstrapSwitch("toggle" + type.charAt(0).toUpperCase() + type.slice(1));
        });

        $("#{{ $uuid }}").find(".szy-imagegroup").each(function() {
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
//选色
        $("#{{ $uuid }}").find(".colorpicker").colorpicker();
    });
</script>