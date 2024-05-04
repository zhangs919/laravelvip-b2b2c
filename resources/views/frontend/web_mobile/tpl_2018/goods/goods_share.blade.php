<script type="text/javascript" src="/js/html2canvas.js"></script>
<div class="goods-code-layer" style="display: block;" id="goods_share_{{ $uuid }}">
    <div class="code-box">
        <div class="goods-code-con">
            <div class="pic">
                <img width="320px" src="{{ base64_encode_image(get_image_url($goods['goods_image'])) }}">
            </div>
            <div class="content-text clearfix">
                <div class="content-text-left">
                    <h3 class="goods-name">
                        {{--todo --}}
                        {{--<em class="act-type limited-discount">限时折扣</em>--}}
                        {{ $goods['goods_name'] }}
                    </h3>
                    <div class="goods-price">
                        <div class="now-prices">
                            <em class="price-color">￥{{ $goods['goods_price'] }}</em>
                            <del>￥{{ $goods['market_price'] }}</del>
                        </div>

                        <span class="sold-num">{{ $goods['sale_num'] }}人已经购买</span>

                    </div>
                </div>
                <div class="content-text-right">
                    <div class="code">
                        <img src="/goods/qrcode.html?id={{ $goods['goods_id'] }}">
                    </div>

                    <p>长按识别二维码</p>

                </div>
            </div>
        </div>
        <div class="colse-goods-code-layer">
            <img src="/images/colse-share-layer.png">
        </div>
    </div>
    <div class="goods-code-mask"></div>
</div>
<script type="text/javascript">
    function canvasShot(dom) {
        //$.loading.start();
        //此处可换body，或div等
        var width = $(dom).width();
        var heigth = $(dom).height();

        var canvas = document.createElement("canvas");
        var scale = 2;//放大倍数
        //将canvas画布放大若干倍，然后盛放在较小的容器内，就显得不模糊了
        canvas.width = width * scale;
        canvas.height = heigth * scale;
        canvas.style.width = width + "px";
        canvas.style.height = heigth + "px";
        var content = canvas.getContext("2d");
        content.scale(scale, scale);
        //获取元素相对于视察的偏移量
        var rect = $(dom).get(0).getBoundingClientRect();
        var left = rect.left + (725 - $(window).width()) / scale;
        var top = rect.top + (725 - $(window).height()) / scale;

        console.info(left + "/" + top);

        //设置context位置，值为相对于视窗的偏移量负值，让图片复位
        if ("" == 'goods_info') {
            content.translate(rect.left, top);
            //return;
        } else {
            content.translate(-rect.left, -rect.top);
        }

        //return

        html2canvas(dom, {
            // dpi: window.devicePixelRatio * 2,
            canvas: canvas,
            scale: scale,
            width: width,
            heigth: heigth,
        }).then(function (canvas) {
            $(dom).html('<img width="' + width + 'px" height="' + heigth + 'px" src="' + canvas.toDataURL() + '">');
            $.loading.stop();
        });
    }

    setTimeout(function () {
        canvasShot(document.querySelector('#goods_share_{{ $uuid }} .goods-code-con'));
    }, 100);

    $('#goods_share_{{ $uuid }} .colse-goods-code-layer').click(function () {
        $(this).parents('.goods-code-layer').hide();
    });
</script>