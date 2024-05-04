<div id="{{ $uuid }}">

    <div class="modal-box-con confirm-receipt-info">
        <p class="warning color">请收到货后，再确认收货！否则您可能钱货两空！</p>
        <p class="prompt">提示：如果本笔订单中存在申请退款的商品，您“确认收货”后会取消退款申请</p>
        <p class="prompt">我已收到货，同意付款给商家</p>
    </div>

    <div class="modal-footer modal-footer-order">
        <input id='order_id' type='hidden' value='{{ $order_id }}' />
        <button id="btn_submit" type="button" class="btn btn-primary">确认</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
    </div>
</div>
<script type="text/javascript">
    $().ready(function() {
        $("#{{ $uuid }}").find("#btn_submit").click(function() {

            var order_id = $("#{{ $uuid }}").find("#order_id").val();
            var is_exchange = "";
            var url = "/user/order/list.html";
            if (is_exchange) {
                url = "/user/order/list.html?is_exchange=1"
            }

// 设置无效
            $(this).prop("disabled", true);

            $.loading.start();

            $.post('/user/order/confirm.html', {
                id: order_id,
            }, function(result) {
                if (result.code == 0) {
                    $.msg(result.message, {
                        time: 2000
                    }, function() {
                        $.go(url);
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    }, function() {
                        $.go(url);
                    });
                }
            }, 'json');
        });
    });
</script>
