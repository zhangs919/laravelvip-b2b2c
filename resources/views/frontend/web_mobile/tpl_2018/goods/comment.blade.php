<script src="/mobile/js/klass.min.js?v=20180813"></script>
<link rel="stylesheet" href="/mobile/css/photoswipe.css?v=20180702"/>
<script src="/mobile/js/photoswipe.js?v=20180813"></script>
<div class="comment-type">
    <ul class="tab">
        <li class="cur" data-type="0">
            <em>1</em>
            <a href="javascript:void(0)">全部评价</a>
        </li>
        <li data-type="2">
            <em>1</em>
            <a href="javascript:void(0)">好评</a>
        </li>
        <li data-type="3">
            <em>0</em>
            <a href="javascript:void(0)">中评</a>
        </li>
        <li data-type="4">
            <em>0</em>
            <a href="javascript:void(0)">差评</a>
        </li>
        <li data-type="1">
            <em>0</em>
            <a href="javascript:void(0)">晒图</a>
        </li>
    </ul>
</div>
<!--有商品评价时-->
<div class="comment-content" id="tablelist">

    <div class="tablelist-append">

        <div class="blank-div"></div>
        <div class="goods-comment">
            <div class="user-info">
<span class="face">
<img src="http://lanse31.oss-cn-beijing.aliyuncs.com/images/system/config/default_image/default_user_portrait_0.png" class="user_img">
</span>
                <span class="user-name">

明**(匿名)

</span>

                <span class="user-level">
<img alt="铜牌会员" src="http://images.68mall.com/user/rank/2016/07/01/14673587916141.jpg">
</span>

            </div>
            <!---->
            <!-- -->
            <!-- -->

            <!---->
            <div class="goods-comment-text">小时候都是盖的这种,夏天凉快又舒服</div>
            <!---->
            <div class="goods-comment-time">2018-07-18 10:46:02</div>
            <!---->
            <!-- -->

            <!-- -->
            <!-- -->


        </div>

    </div>

    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner">

            <div class="is-loaded">
                <div class="loaded-bg">我是有底线的</div>
            </div>

        </div>
        <script data-page-json="true" type="text" id="page_json">
{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":1,"page_count":1,"offset":0,"url":null,"sql":null}
</script>
    </div>
</div>
<!-- more.js -->
<script src="/assets/d2eace91/js/szy.page.more.js?v=20180813"></script>
<script type="text/javascript">
    // 滚动加载数据
    $(window).on('scroll', function() {
        if ($(document).scrollTop() + $(window).height() > $(document).height() - 10) {
            $.pagemore({
                callback: function(result) {
// 图片缓载
                    $.imgloading.loading();
// 图片预览
                    if ($("#gallery a").length > 0) {
                        var options = {};
                        $("#gallery a").photoSwipe(options);
                    }
                }
            });
        }
    });
</script>
<script type="text/javascript">
    var tablelist = null;
    tablelist = $("#tablelist").tablelist({
        url: '/goods/comment?sku_id={{ $sku_id }}'
    });

    $(".comment-type li").click(function() {
        var type = $(this).data("type");
        var target = $(this);
        $(target).siblings('li').removeClass("cur");
        $(target).addClass("cur");
        tablelist.page.cur_page = 1;
        $(window).scrollTop(0);
        tablelist.load({
            type: type
        }, function(result) {
            if (result.code == 0) {
                if ($("#gallery a").length > 0) {
                    var options = {};
                    $("#gallery a").photoSwipe(options);
                }
            }
        });

    })
</script>