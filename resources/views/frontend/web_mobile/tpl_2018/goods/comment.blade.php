<script src="/js/klass.min.js?v=20190413"></script>
<link rel="stylesheet" href="/css/photoswipe.css?v=20190413"/>
<script src="/js/photoswipe.js?v=20190413"></script>
<div class="comment-type">
    <ul class="tab">
        <li class="cur" data-type="0">
            <em>{{ $comment_counts[0] }}</em>
            <a href="javascript:void(0)">全部评价</a>
        </li>
        <li data-type="2">
            <em>{{ $comment_counts[2] }}</em>
            <a href="javascript:void(0)">好评</a>
        </li>
        <li data-type="3">
            <em>{{ $comment_counts[3] }}</em>
            <a href="javascript:void(0)">中评</a>
        </li>
        <li data-type="4">
            <em>{{ $comment_counts[4] }}</em>
            <a href="javascript:void(0)">差评</a>
        </li>
        <li data-type="1">
            <em>{{ $comment_counts[1] }}</em>
            <a href="javascript:void(0)">晒图</a>
        </li>
    </ul>
</div>
<!--有商品评价时-->
{{--引入商品评价列表--}}
@include('goods.partials._comment_list')

<!-- more.js -->
<script src="/assets/d2eace91/js/szy.page.more.js?v=20190413"></script>
<script type="text/javascript">
    // 滚动加载数据
    $(window).on('scroll', function() {
        if ($(document).scrollTop() + $(window).height() > $(document).height() - 10) {
            if ($.isFunction($.pagemore)) {
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


{{--<script src="/js/klass.min.js?v=20180813"></script>--}}
{{--<link rel="stylesheet" href="/css/photoswipe.css?v=20180702"/>--}}
{{--<script src="/js/photoswipe.js?v=20180813"></script>--}}
{{--<div class="comment-type">--}}
    {{--<ul class="tab">--}}
        {{--<li class="cur" data-type="0">--}}
            {{--<em>1</em>--}}
            {{--<a href="javascript:void(0)">全部评价</a>--}}
        {{--</li>--}}
        {{--<li data-type="2">--}}
            {{--<em>1</em>--}}
            {{--<a href="javascript:void(0)">好评</a>--}}
        {{--</li>--}}
        {{--<li data-type="3">--}}
            {{--<em>0</em>--}}
            {{--<a href="javascript:void(0)">中评</a>--}}
        {{--</li>--}}
        {{--<li data-type="4">--}}
            {{--<em>0</em>--}}
            {{--<a href="javascript:void(0)">差评</a>--}}
        {{--</li>--}}
        {{--<li data-type="1">--}}
            {{--<em>0</em>--}}
            {{--<a href="javascript:void(0)">晒图</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</div>--}}

{{--<!--有商品评价时-->--}}
{{--引入商品评价列表--}}
{{--@include('goods.partials._comment_list')--}}


{{--<!-- more.js -->--}}
{{--<script src="/assets/d2eace91/js/szy.page.more.js?v=20180813"></script>--}}
{{--<script type="text/javascript">--}}
    {{--// 滚动加载数据--}}
    {{--$(window).on('scroll', function() {--}}
        {{--if ($(document).scrollTop() + $(window).height() > $(document).height() - 10) {--}}
            {{--$.pagemore({--}}
                {{--callback: function(result) {--}}
{{--// 图片缓载--}}
                    {{--$.imgloading.loading();--}}
{{--// 图片预览--}}
                    {{--if ($("#gallery a").length > 0) {--}}
                        {{--var options = {};--}}
                        {{--$("#gallery a").photoSwipe(options);--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}
    {{--});--}}
{{--</script>--}}
{{--<script type="text/javascript">--}}
    {{--var tablelist = null;--}}
    {{--tablelist = $("#tablelist").tablelist({--}}
        {{--url: '/goods/comment?sku_id={{ $sku_id }}'--}}
    {{--});--}}

    {{--$(".comment-type li").click(function() {--}}
        {{--var type = $(this).data("type");--}}
        {{--var target = $(this);--}}
        {{--$(target).siblings('li').removeClass("cur");--}}
        {{--$(target).addClass("cur");--}}
        {{--tablelist.page.cur_page = 1;--}}
        {{--$(window).scrollTop(0);--}}
        {{--tablelist.load({--}}
            {{--type: type--}}
        {{--}, function(result) {--}}
            {{--if (result.code == 0) {--}}
                {{--if ($("#gallery a").length > 0) {--}}
                    {{--var options = {};--}}
                    {{--$("#gallery a").photoSwipe(options);--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}

    {{--})--}}
{{--</script>--}}