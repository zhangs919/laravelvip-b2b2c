<div id="{{ $uuid }}">
    <form method="post" action="close" class="form-horizontal">
        <h5 class="m-b-10">
            请您在与买家达成一致的前提下，使用关闭交易这个功能！
        </h5>
        <div class="content m-b-10">
            <div class="alert alert-info br-0 m-t-10">
                <p>1. 买家已付款订单，卖家有权关闭订单，关闭订单后，买家红包、商品费用等全部退回。</p>
                <p>2. 拍下减库存的商品，在交易关闭后，系统会自动恢复商品库存，但不会影响已下架的商品状态。</p>
            </div>
            <p>
                <strong>请选择关闭该交易的理由：</strong>
                <select id='reason' name="reason" class="form-control" style="width: 160px;">
                    <option value="">请选择关闭的理由</option>
                    @foreach($close_trad_reason as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </p>
        </div>
        <div class="modal-footer">
            <input id='order_id' type='hidden' value='{{ $order_id }}' />
            <button id="btn_submit" type="button" class="btn btn-primary">确定</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    // 
</script><script>

    $().ready(function() {
        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            var order_id = $("#{{ $uuid }}").find("#order_id").val();
            var reason = $("#{{ $uuid }}").find("#reason").val();

            if (reason == '') {
                $.msg("请选择关闭原因");
                return false;
            }

            $.loading.start();

            $.post('/trade/order/edit-order', {
                id: order_id,
                reason: reason,
                type: 'close'
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
                            return;
                        }
                        var is_exchange = "";
                        if (is_exchange) {
                            $.go("/dashboard/exchange/list.html");
                        } else if ('list' == 'list') {
                            $.go("/trade/order/list.html");
                        } else {
                            $.go("/trade/order/info?id=" + order_id);
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