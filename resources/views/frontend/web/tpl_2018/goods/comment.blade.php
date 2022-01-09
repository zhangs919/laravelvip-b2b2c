<div class="evaluate">
    <h3 class="color">商品评价</h3>
    <div class="comment-mod">
        <div class="comment-grade">
            <div class="rate-score">
                <h4>宝贝与描述相符</h4>
                <strong>5.00</strong>
                <p>
<span class="score-value-no">

<em style='width: 100%;'></em>
</span>
                </p>
            </div>
            <div class="rate-graph">
                <div class="graph-scroller">
<span style='width: 100%;'>
<em>
5.00
<i>▼</i>
</em>
</span>
                </div>
                <ul class="graph-desc">
                    <li>非常不满</li>
                    <li>不满意</li>
                    <li>一般</li>
                    <li>满意</li>
                    <li>非常满意</li>
                </ul>
            </div>
            <!-- -->
        </div>
        <div class="comment-type">
            <ul class="tab-nav">
                <li class="current" data-type="0">
                    <i class="icon cur"></i>
                    全部
                </li>
                <li data-type="1">
                    <i class="icon"></i>
                    图片
                    <em>（0）</em>
                </li>
                <li data-type="2">
                    <i class="icon"></i>
                    好评
                    <em>（0）</em>
                </li>
                <li data-type="3">
                    <i class="icon"></i>
                    中评
                    <em>（0）</em>
                </li>
                <li data-type="4">
                    <i class="icon"></i>
                    差评
                    <em>（0）</em>
                </li>
            </ul>
        </div>
        <!-- 有评论的的展示形式 _star -->

        <div id="comment_content">

            <div class="tip-box">
                <img src="/frontend/images/noresult.png" class="tip-icon" />
                <div class="tip-text">还没有任何评价哦</div>
            </div>
            <!-- -->

        </div>

    </div>
</div>

<link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=20180428"/>
<script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180528"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
<script type="text/javascript">
    $().ready(function() {
        $("#evaluate_count").html("累计评价(0)");
        $("#evaluate_num").html("0人评价");

    });
</script>
<script type="text/javascript">
    var tablelist = $(".tablelist").tablelist({
        url: '/goods/comment?sku_id=712'
    });

    $(".comment-type li").click(function() {
        var type = $(this).data("type");
        var target = $(this);

        $(".comment-type").find("li").removeClass("current");
        $(".comment-type").find("i").removeClass("cur");
        $(target).addClass("current");
        $(target).children().addClass("cur");

        tablelist.load({
            type: type
        }, function(result) {
            if (result.code == 0) {
                $("#comment_content").html(result.data);
// 重新初始化
                tablelist = $(".tablelist").tablelist({
                    url: '/goods/comment?sku_id=712'
                });
            }
        });
    })
</script>

<script type="text/javascript">
    //图片弹窗
    hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
    hs.align = 'center';
    hs.transitions = ['expand', 'crossfade'];
    hs.outlineType = 'rounded-white';
    hs.fadeInOut = true;

    hs.addSlideshow({
        interval: 5000,
        repeat: false,
        useControls: true,
        fixedControls: 'fit',
        overlayOptions: {
            opacity: .75,
            position: 'bottom center',
            hideOnMouseOut: true
        }
    });
</script>