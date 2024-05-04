<div class="prompt-choose" id="{{ $uuid }}">
    <div class="prompt-choose-title">请选择取消订单的理由</div>
    <ul class="prompt-choose-reason">
        @foreach($close_trad_reason as $k=>$item)
            <li data-reason="{{ $item }}" @if($k == 0)class="seleted"@endif>{{ $item }}</li>
        @endforeach
    </ul>
    <div class="prompt-choose-bottom clearfix">
        <input id='order_id' type='hidden' value='{{ $order_id }}' />
        <input id='reason' type='hidden' value='我不想买了
' />
        <button type="button" class="btn btn-default" onclick="close_choose()">取消</button>
        <button id="btn_submit" type="button" class="btn btn-primary">确定</button>
    </div>
</div>
<script type="text/javascript">
    // 
</script><script>

    $().ready(function() {
//$(".prompt-choose").css('margin-top',$(".prompt-choose").height());
        $("#{{ $uuid }}").find(".prompt-choose-reason li").click(function() {
            $(this).addClass("seleted").siblings().removeClass("seleted");
            $("#{{ $uuid }}").find("#reason").val($(this).data("reason"));
        });

        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            var order_id = $("#{{ $uuid }}").find("#order_id").val();
            var reason = $("#{{ $uuid }}").find("#reason").val();
            if (reason == '') {
                $.msg("请选择取原因");
                return false;
            }
            $.loading.start();
            $.post('/user/order/cancel.html', {
                id: order_id,
                reason: reason,
                type: 'list.html',
            }, function(result) {
                if(result.code == 0){
                    $.msg(result.message, {
                        time: 2000,
                        icon_type: 1
                    }, function() {
                        <!--  -->
                        $.go("/user/order/list.html");
                        <!--  -->
                    });
                }else{
                    $.msg(result.message,{
                        time: 3000
                    });
                }

            }, 'json');

        });
    });

    // 
</script>