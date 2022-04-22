<div class="evaluate">
    <h3 class="color">商品评价</h3>
    <div class="comment-mod">
        <div class="comment-grade">
            <div class="rate-score">
                <h4>宝贝与描述相符</h4>
                <strong>{{ $desc_mark_avg }}</strong>
                <p>
<span class="score-value-no">

<em style='width: {{ $desc_mark_avg*20 }}%;'></em>
</span>
                </p>
            </div>
            <div class="rate-graph">
                <div class="graph-scroller">
<span style='width: {{ $desc_mark_avg*20 }}%;'>
<em>
{{ $desc_mark_avg }}
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
                    <em>（{{ $comment_counts[1] }}）</em>
                </li>
                <li data-type="2">
                    <i class="icon"></i>
                    好评
                    <em>（{{ $comment_counts[2] }}）</em>
                </li>
                <li data-type="3">
                    <i class="icon"></i>
                    中评
                    <em>（{{ $comment_counts[3] }}）</em>
                </li>
                <li data-type="4">
                    <i class="icon"></i>
                    差评
                    <em>（{{ $comment_counts[4] }}）</em>
                </li>
            </ul>
        </div>
        <!-- 有评论的的展示形式 _star -->

        <div id="comment_content">

            {{--引入商品评价列表--}}
            @include('goods.partials._comment_list')

        </div>

    </div>
</div>

<link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=20180428"/>
<script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180528"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
<script type="text/javascript">
    $().ready(function() {
        $("#evaluate_count").html("累计评价({{ $comment_counts[0] }})");
        $("#evaluate_num").html("{{ $comment_counts[0] }}人评价");

    });
</script>
<script type="text/javascript">
    var tablelist = $(".tablelist").tablelist({
        url: '/goods/comment?sku_id={{ $sku_id }}'
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
                    url: '/goods/comment?sku_id={{ $sku_id }}'
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