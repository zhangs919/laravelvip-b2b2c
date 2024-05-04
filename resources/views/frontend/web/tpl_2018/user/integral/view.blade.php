<div class="see-content" style="max-height: none ">
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th align="left" width="70%">线下商家信息</th>
            <th align="left">线下账户积分</th>
            <!-- <th align="left">操作</th> -->
        </tr>
        </thead>
        <tbody class="balance-points">
        <tr>
            <td align="center" colspan="3">
                @if(!empty($list))
{{--                    todo --}}
                @else
                    <div class="tip-box">
                        <img src="{{ get_image_url(sysconf('default_noresult'), 'default_noresult') }}" class="tip-icon" />
                        <div class="tip-text">您还没有任何数据记录</div>
                    </div>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    // 
</script><script>

    $().ready(function() {
        $("body").on("click", "#get-points", function() {
            var app_token = $(this).data("id");
            var balance = $(this).data("points");
            $.confirm("您确定将此商家的线下积分转入商城吗？", function() {
                $.loading.start();
                $.post('/user/integral/get-balance-points.html', {
                    app_token: app_token,
                    balance: balance,
                    type: 2
                }, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message);
                        $(".balance-points").html(result.data);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        })
                    }
                }, "json");
            });
        });
    });

    //
</script>