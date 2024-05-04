<div class="bill-panel">
    @if(!empty($order_data))
        <table class="table">
            <thead>
            <tr>
                <th class="text-c w50">序号</th>
                <th class="text-c w150">商品图片</th>
                <th class="w300">商品信息</th>
                <th class="w150">商品条形码</th>
                <th class="text-c w100">单价</th>
                <th class="text-c w100">数量</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-c">1</td>
                <td class="text-c">
                    <img src="https://img.alicdn.com/imgextra/i2/110928240/O1CN012Ajy3JLWZdit6Mq_!!110928240.jpg" style="width: 80px; height: 80px">
                </td>
                <td>ipad钢化膜2018新款air2苹果mini4平板pro9.7英寸10.5电脑11新12.9版</td>
                <td>暂无</td>
                <td class="text-c">29.90</td>
                <td class="text-c">1</td>
            </tr>
            <tr>
                <td class="text-r" colspan="6">
                    总数量：
                    <em class="m-l-5 m-r-5 f14">1</em>
                    件
                </td>
            </tr>
            </tbody>
        </table>
        <div class="p-10 text-r m-b-40 pos-r">
            <p class="m-b-5 c-666">
                <span>商品总金额：￥29.90</span>
                <em class="operator">+</em>
                <span>运费：￥0.00</span>
                <em class="operator">+</em>
                <span>额外配送费：￥0.00</span>
                <em class="operator">+</em>
                <span>包装费：￥0.00</span>
                <em class="operator">-</em>
                <span>红包：￥0.00</span>
                <em class="operator">-</em>
                <span>卖家优惠：￥0.00</span>
                <em class="operator">=</em>
                <span>订单总金额：￥29.90</span>
            </p>
            <p class="c-666">
                <span>在线支付：￥0.00</span>
                <em class="operator">+</em>
                <span>余额支付：￥29.90</span>
                <em class="operator">=</em>
                <span class="order-amount c-red">
                <strong>实付款金额：￥29.90</strong>
            </span>
            </p>
            <p class="m-t-5 c-666">
                <span class="c-red">订单已发货，不能核销</span>
            </p>
            <!--已完成核销finish，not未核销，unable无法核销-->
            <i class="state SZY-REVISION-STATUS finish"></i>
        </div>


        {{--已核销--}}
        <div class="bottom-btn">
            <a class="btn btn-primary btn-lg submit-revision-btn disabled">已核销</a>
        </div>

        {{--未核销--}}
        {{--<div class="bottom-btn">--}}
            {{--<a class="btn btn-primary btn-lg submit-revision-btn ">确认核销</a>--}}
        {{--</div>--}}

        {{--无法核销--}}
        {{--<div class="bottom-btn">--}}
            {{--<a class="btn btn-primary btn-lg submit-revision-btn disabled">无法核销</a>--}}
        {{--</div>--}}
    @else
        <div class="no-data-page">
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <h5>没有订单信息</h5>
            <p>没有找到所符合的订单信息，换一个试试吧！</p>
        </div>
    @endif
</div>
<script type="text/javascript">
    //
</script>
<script>

    $().ready(function() {
        $('.submit-revision-btn').click(function() {
            var target = $(this);
            if (target.hasClass('disabled')) {
                return false;
            }
            target.html('核销中...');
            target.addClass('disabled');
            $.post('/trade/order/revision', {
                order_id: ''
            }, function(result) {
                if (result.code == 0) {
                    $('.SZY-REVISION-STATUS').addClass('finish');
                    countdown(target, "确认核销", result.message, result.code);
                } else {
                    $('.SZY-REVISION-STATUS').addClass('unable');
                    countdown(target, "确认核销", result.message, result.code);
                }
                $.msg(result.message, {
                    time: 1000
                });
            }, 'json');
        });

        var wait = 1;

        function countdown(obj, btn, msg, code) {
            obj = $(obj);
            if (wait <= 0) {
                obj.removeClass("disabled");
                obj.html(btn);
                if (code == 0) {
                    $('body').find('.SZY-FREEBUY-AD').show();
                    $('body').find('.SZY-FREEBUY-AD').html($('#freebuy_ad_html').html());
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
                setTimeout(function() {
                    countdown(obj, btn, msg, code)
                }, 1000)
            }
        }

        <!--  -->
    });

    //
</script>