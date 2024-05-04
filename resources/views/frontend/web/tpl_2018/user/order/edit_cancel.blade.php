<div id="{{ $uuid }}">
    <div class="modal-box-con cancel-payment-info">
        <p class="warning color">您确定要取消该订单吗？取消订单后，不能恢复！</p>
        <p class="prompt prompt-choose">
            请选择取消订单的理由：
            <select id="reason">
                <option value="">请选择取消原因</option>
                @foreach($close_trad_reason as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach

            </select>
        </p>
    </div>
    <div class="modal-footer modal-footer-order">
        <input id='order_id' type='hidden' value='{{ $order_id }}' />
        <button id="btn_submit" type="button" class="btn btn-primary">确认</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    </div>
</div>
<script type="text/javascript">
    $().ready(function() {
        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            var order_id = $("#{{ $uuid }}").find("#order_id").val();
            var reason = $("#{{ $uuid }}").find("#reason").val();

            if (reason == '') {
                $.msg("请选择取原因");
                return false;
            }

// 设置无效
            $(this).prop("disabled", true);

            $.loading.start();

            $.post('/user/order/cancel.html', {
                id: order_id,
                reason: reason,
                type: 'list.html',
            }, function(result) {
                if (result.code == 0) {
                    $.msg(result.message, {
                        time: 2000
                    }, function() {
                        $.go("/user/order/list.html");
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    }, function() {
                        $.go("/user/order/list.html");
                    });
                }
            }, 'json');
        });
    });
</script>