<div class="bill-panel">

    @if(!empty($order_info))
        <table class="table">
            <thead>
            <tr>
                <th class="text-c w50">序号</th>
                <th class="text-c w150">商品图片</th>
                <th class="w300">商品信息</th>
                <th class="text-c w100">积分</th>
                <th class="text-c w100">数量</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order_info['goods_list'] as $item)
                <tr>
                    <td class="text-c">1</td>
                    <td class="text-c">
                        <img src="{{ get_image_url($item['goods_image']) }}"
                             style="width: 80px; height: 80px">
                    </td>
                    <td>{{ $item['goods_name'] }}</td>
                    <td class="text-c">{{ $item['goods_points'] }}</td>
                    <td class="text-c">{{ $item['goods_number'] }}</td>
                </tr>
                <tr>
                    <td class="text-r" colspan="6">
                        总积分：
                        <em class="m-l-5 m-r-5 f14">{{ $item['goods_integral'] }}积分</em>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        {{--已核销--}}
        @if($auto_revision == 2)
            <div class="p-10 text-r m-b-40 pos-r">
                <!--已完成核销finish，not未核销，unable无法核销-->
                <i class="state SZY-REVISION-STATUS finish"></i>
            </div>
            <div class="bottom-btn">
                <a class="btn btn-primary btn-lg submit-revision-btn disabled">已核销</a>
            </div>
        @endif

        {{--未核销--}}
        @if($auto_revision == 1)
            <div class="p-10 text-r m-b-40 pos-r">
                <!--已完成核销finish，not未核销，unable无法核销-->
                <i class="state SZY-REVISION-STATUS not"></i>
            </div>
            <div class="bottom-btn">
                <a class="btn btn-primary btn-lg submit-revision-btn ">确认核销</a>
            </div>
        @endif

        {{--无法核销--}}
        @if($auto_revision == 0)
            <div class="p-10 text-r m-b-40 pos-r">
                <!--已完成核销finish，not未核销，unable无法核销-->
                <i class="state SZY-REVISION-STATUS unable"></i>
            </div>
            <div class="bottom-btn">
                <a class="btn btn-primary btn-lg submit-revision-btn disabled">无法核销</a>
            </div>
        @endif

    @else
        <div class="no-data-page">
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <h5>没有订单信息</h5>
            <p>没有找到所符合的兑换单信息，换一个试试吧！</p>
        </div>
    @endif

</div>
<script type="text/javascript">
    $().ready(function () {
        $('.submit-revision-btn').click(function () {
            var target = $(this);
            if (target.hasClass('disabled')) {
                return false;
            }
            target.html('核销中...');
            target.addClass('disabled');
            $.post('/dashboard/integral-mall/revision', {
                order_id: "{{ $order_info['order_id'] }}"
            }, function (result) {
                if (result.code == 0) {
                    $('.SZY-REVISION-STATUS').addClass('finish');
                    countdown(target, "确认核销", result.message, result.code);
                } else {
                    $('.SZY-REVISION-STATUS').addClass('unable');
                    countdown(target, "确认核销", result.message, result.code);
                }
                $.msg(result.message);
            }, 'json');
        });

        var wait = 1;

        function countdown(obj, btn, msg, code) {
            obj = $(obj);
            if (wait <= 0) {
                obj.removeClass("disabled");
                obj.html(btn);
                if (code == 0) {
                    $('body').find('.SZY-ORDER-INFO').hide();
                    $('body').find('#scan-input').val('');
                    $("#scan-input").focus();
                }
                wait = 1;
            } else {
                if (msg == undefined || msg == null) {
                    msg = obj.html();
                }
                obj.addClass("disabled");
                obj.html(msg + "(" + wait + ")");
                wait--;
                setTimeout(function () {
                    countdown(obj, btn, msg, code)
                }, 1000)
            }
        }


        setTimeout(function () {
            $('.submit-revision-btn').click();
        }, 500);

    });
</script>