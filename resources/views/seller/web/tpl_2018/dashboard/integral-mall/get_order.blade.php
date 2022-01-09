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

            <tr>
                <td class="text-c">1</td>
                <td class="text-c">
                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/15/gallery/2018/04/17/15239490849627.jpg" style="width: 80px; height: 80px">
                </td>
                <td>积分兑换测试商品</td>
                <td class="text-c">30</td>
                <td class="text-c">1</td>
            </tr>

            <tr>
                <td class="text-r" colspan="6">
                    总积分：
                    <em class="m-l-5 m-r-5 f14">30积分</em>

                </td>
            </tr>
            </tbody>
        </table>


        {{--已核销--}}
        {{--<div class="p-10 text-r m-b-40 pos-r">
            <!--已完成核销finish，not未核销，unable无法核销-->
            <i class="state SZY-REVISION-STATUS finish"></i>
        </div>
        <div class="bottom-btn">
            <a class="btn btn-primary btn-lg submit-revision-btn disabled">已核销</a>
        </div>--}}

        {{--未核销--}}
        <div class="p-10 text-r m-b-40 pos-r">
            <!--已完成核销finish，not未核销，unable无法核销-->
            <i class="state SZY-REVISION-STATUS not"></i>
        </div>
        <div class="bottom-btn">
            <a class="btn btn-primary btn-lg submit-revision-btn ">确认核销</a>
        </div>

        {{--无法核销--}}
        {{--<div class="p-10 text-r m-b-40 pos-r">
            <!--已完成核销finish，not未核销，unable无法核销-->
            <i class="state SZY-REVISION-STATUS unable"></i>
        </div>
        <div class="bottom-btn">
            <a class="btn btn-primary btn-lg submit-revision-btn disabled">无法核销</a>
        </div>--}}

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
    $().ready(function() {
        $('.submit-revision-btn').click(function() {
            var target = $(this);
            if (target.hasClass('disabled')) {
                return false;
            }
            target.html('核销中...');
            target.addClass('disabled');
            $.post('/dashboard/integral-mall/revision', {
                order_id: '31'
            }, function(result) {
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
                setTimeout(function() {
                    countdown(obj, btn, msg, code)
                }, 1000)
            }
        }


        setTimeout(function(){
            $('.submit-revision-btn').click();
        },500);

    });
</script>