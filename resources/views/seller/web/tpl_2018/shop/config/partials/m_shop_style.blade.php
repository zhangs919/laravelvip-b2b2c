{{--<link href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css" rel="stylesheet">--}}
<link href="/assets/d2eace91/js/colour/css/spectrum.css" rel="stylesheet">

{{--<script src="/assets/d2eace91/min/js/upload.min.js"></script>--}}
{{--<script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js"></script>--}}
<script src="/assets/d2eace91/js/colour/js/spectrum.js"></script>
<script src="/assets/d2eace91/js/colour/js/docs.js"></script>


<script>
    $().ready(function() {
        var group = $("input[name='group']").val();
        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            $.loading.start();
            var data = $("#ShopConfigModel").serializeJson();
            $.post('/shop/config/index', data, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    var modal = $.modal($("#{{ $uuid }}"));
                    if (modal) {
                        modal.hide();
                        $.msg(result.message);
                        $.get('color-style-url',{
                            group: group
                        },function(result){
                            console.info(result.data);
                            $('#site_style').attr('href', result.data + '?uid=' + new Date().getTime());
                        },'json');
                    }
                } else {
                    $.msg(result.message);
                }
            }, "json");
        });
    });
    // 
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
                gallery: true,
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
{{--        $("#{{ $uuid }}").find(".colorpicker").colorpicker();--}}
    });
</script>