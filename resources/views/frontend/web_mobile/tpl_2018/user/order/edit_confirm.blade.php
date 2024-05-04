<div class="prompt-choose" id="{{ $uuid }}">

    <div class="prompt-choose-bottom clearfix">
        <input id='order_id' type='hidden' value='{{ $order_id }}' />
        <button type="button" class="btn btn-default" onclick="close_choose()">取消</button>
        <button id="btn_submit" type="button" class="btn btn-primary">确定</button>
    </div>
</div>
<script type="text/javascript">
    // 
</script><script>

    $().ready(function() {

        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            var order_id = $("#{{ $uuid }}").find("#order_id").val();
            $.loading.start();
            $.post('/user/order/confirm.html', {
                id: order_id,
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