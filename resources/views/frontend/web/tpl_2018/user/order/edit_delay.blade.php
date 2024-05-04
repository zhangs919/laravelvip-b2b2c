<div id="{{ $uuid }}">
    <div class="modal-box-con extend-time-info m-b-10">
        <p class="prompt m-b-5">您可以延长该订单收货时间，延长收货时间可以让买家有更多时间来“确定收货”，而不会急于去申请退款。</p>
        <p class="prompt prompt-choose m-b-5">
            延长本交易的”确认收货“期限为：
            <select id="delay_days" class="form-control w100">
                @foreach($extend_receiving_days as $item)
                    <option value="{{ $item }}">{{ $item }}天</option>
                @endforeach
            </select>
        </p>
        <p class="prompt prompt-spe c-red">注意：收货时间只能延长一次！</p>
    </div>
    <div class="modal-footer">
        <input id='order_id' type='hidden' value='{{ $order_id }}' />
        <button id="btn_submit" type="button" class="btn btn-primary">确认</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
    </div>
</div>
<script type="text/javascript">
    // 
</script><script>

    $().ready(function() {
        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            var order_id = $("#{{ $uuid }}").find("#order_id").val();
            var delay_days = $("#{{ $uuid }}").find("#delay_days").val();

            if (delay_days == '') {
                $.msg("请选择延长期限");
                return false;
            }

            $.loading.start();

            $.post('/user/order/delay', {
                id: order_id,
                delay_days: delay_days,
            }, function(result) {
// 关闭对话框
                $("#{{ $uuid }}").parents(".modal").find(".close").click();
// 显示信息
                if (result.code == 0) {
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
                        if (typeof(tablelist) != "undefined" && tablelist) {
                            tablelist.load();
                        } else if ('list' == 'list') {
                            $.go("/user/order/list.html");
                        } else {
                            $.go("/user/order/info?id=" + order_id);
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, 'json').always(function() {
                $.loading.stop();
            });
        });
    });

    // 
</script>