<script src="/js/html2canvas.js?v=20190121"></script>
<div class="goods-code-layer" style="display: block;" id="goods_share_{{ $uuid }}">
    <div class="goods-code-mask"></div>
    <div class="goods-code-con">
        <div class="pic">
            <img width="320px" src="{{ base64_encode_image(get_image_url($goods['goods_image'])) }}">
        </div>
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
                    {{--<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHwAAAB8AQMAAACR0Eb9AAAABlBMVEX///8AAABVwtN+AAAA70lE
QVRIia2U0Q0DMQhD2YD9t/QG1DZtqn7GPVQl5J1EYyBUPWA9M4XWbjcC/LV8bnsKAE8Fbr1uChq6
3H+gABTFxUBMxx+1l2AUbe1k/RLYKGwU89gdcJGVoIEsAtSDpqcPLXEBYJGEZlDYi92Djzilpw+7
BJblVX4E2iu0W14EtkhMtLzKACU1toOdowx4CjDXJ+g1cKGhh/h+QAHQEFDLcIWTHAAK4p00UDwR
MqCjcqNCTQTezbvjYDLQG0szpR0zAZ/JXKKTAbcc2x8ueQ7Ks41ztnOgqIr5/Zc7sMosbSddAPb9
wkP2ZP0OPGAvJ7vcTyAHjZkAAAAASUVORK5CYII=
">--}}
                </div>

                长按识别二维码

            </div>
        </div>
    </div>
    <div class="colse-goods-code-layer">
        <img src="/images/colse-share-layer.png">
    </div>
</div>
<script type="text/javascript">
    function canvasShot(dom) {

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
//设置context位置，值为相对于视窗的偏移量负值，让图片复位
        content.translate("-" + rect.left, rect.top + (726 - $(window).height()) / 10 * 5);
        html2canvas(dom, {
            dpi: window.devicePixelRatio * 2,
            canvas: canvas,
            scale: scale,
            width: width,
            heigth: heigth,
        }).then(function(canvas) {
            $(dom).html('<img width="' + width + 'px" height="' + heigth + 'px" src="' + canvas.toDataURL() + '">');
        });
    }
    setTimeout(function() {
        canvasShot(document.querySelector('#goods_share_{{ $uuid }} .goods-code-con'));
    }, 100);

    $('#goods_share_{{ $uuid }} .colse-goods-code-layer').click(function() {
        $(this).parent().hide();
    });
</script>