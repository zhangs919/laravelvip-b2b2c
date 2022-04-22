<div id="goods_share_{{ $uuid }}" class="goods-code-layer" style="display: block;">
    <div class="goods-code-mask"></div>
    <div class="goods-code-con goods-code-con2">
        {{--<img src="{{ base64_encode_image(get_image_url($goods['goods_image'])) }}" class="code">--}}
        <img src="{{ base64_encode_image(get_image_url($goods['goods_image'])) }}">
        <div class="content-text clearfix">
            <div class="content-text-left">
                <h3 class="goods-name">{{ $goods['goods_name'] }}</h3>
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

                长按识别二维码

            </div>
        </div>

        <img src="/images/goods-code-tip.png" class="tip">
        <div class="colse-goods-code-layer">
            <img src="/images/colse-share-layer.png">
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#goods_share_{{ $uuid }} .colse-goods-code-layer').click(function() {
        $(this).parents('.goods-code-layer').hide();
    });
</script>