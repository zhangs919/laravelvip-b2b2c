<div id='{{ $uuid }}'>
    <div class="table-content">
        <!-- 搜索 -->

        <div class="no-data" style="padding: 50px 0;"><i class="fa fa-exclamation-circle"></i>尚未申请任何服务保障，请先申请服务保障</div>

    </div>
</div>
<script type='text/javascript'>
    //点击下一步
    $().ready(function() {
        $("#{{ $uuid }}").find("#btn_next_step").click(function() {
            var goods_ids = $("#goods_ids").val();
            var data = $("#Goods").serializeJson();
            $.post('/goods/list/set-contract', data, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".modal").find(".close").click();
// 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
                        if (typeof (tablelist) != "undefined" && tablelist) {
                            tablelist.load();
                        } else {
                            $.go('/goods/list');
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json");
        })
    });
</script>