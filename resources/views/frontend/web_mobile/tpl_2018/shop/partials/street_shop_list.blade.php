<div class="main" id="table_list">
    <div class="shops-box shops-box2">
        <div class="shops-list tablelist-append">

            @foreach($list as $item)
            <div class="shops-box-other valid SZY-IS-OPEN SZY-IS-STORE valid" data-shop_id="{{ $item['shop_id'] }}">
                <div class="shop-box-header">
                    <h3 class="shop-name">
                        <a href="/shop/{{ $item['shop_id'] }}.html">{{ $item['shop_name'] }}</a>
                    </h3>
                    <div class="shop-other-info ub">
                        <div class="ub-f1">
                            <span class="score color">{{ $item['score'] }}</span>
                            <span class="line">|</span>
                            <span class="start-price">起送价 {{ $item['start_price'] > 0 ? $item['start_price_format'] : '无' }}</span>
                        </div>
                        <div class="shop-time">
                            {{--65小时13分钟--}}
                        </div>
                    </div>

                    <div class="activity-tag">
                        {{--<span class="label-text">满2999减100</span>--}}
                        {{--<span class="label-text">满5000减200</span>--}}
                        <span class="label-text">包邮</span>
                        <span class="label-text blue">支持自提</span>
                        <span class="label-text bonus">送红包</span>
                    </div>

                </div>
                <div class="shop-box-body seamless-rolling-box swiper-container swiper-container-horizontal swiper-container-free-mode">
                    <ul class="swiper-wrapper">
                        @if(!empty($item['goods_list']))
                            @foreach($item['goods_list'] as $goods)
                                <li class="swiper-slide">
                                    <div class="goods-pic">
                                        <div class="goods-info-box">
                                            <div class="item-tag-box">
                                            </div>
                                            <a href="/goods-{{ $goods['goods_id'] }}.html" title="{{ $goods['goods_name'] }}" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }})">
                                                <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                                                <div class="price">￥{{ $goods['goods_price'] }}</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="goods-name"><a href="/goods-{{ $goods['goods_id'] }}.html">{{ $goods['goods_name'] }}</a></div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            {{--todo 预上线店铺--}}
            {{--<div class="shops-box-other pre-online-shop">
                <a href="/shop/support.html?shop_id={{ $item['shop_id'] }}" class="ub">
                    <div class="shop-logo">
                        <img src="/images/support_shop_logo.jpg" alt="{{ $item['shop_name'] }}">
                    </div>
                    <div class="ub-f1">
                        <h3 class="name ub">
                            <span class="ub-f1">{{ $item['shop_name'] }}</span>
                        </h3>
                        <span class="sold">支持热度：{{ $item['recommend_num'] }}</span>
                    </div>
                </a>
            </div>--}}
            @endforeach


        </div>
    </div>
    <!-- 分页 -->
    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner"><div class="is-loaded"><div class="loaded-bg">我是有底线的</div></div></div>
        <script data-page-json="true" type="text" id="page_json">
            {!! $page_json !!}
        </script>
    </div>
</div>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script><script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
<script>

    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson()
        });
    });

    //



    // 滚动加载数据
    $(window).on('scroll', function() {
        if (($(document).scrollTop() + $(window).height() + 50) > $(document).height()) {
            if ($.isFunction($.pagemore)) {
                $.pagemore({
                    callback: function(result) {
                        swiperInit();
                        is_opening();
                    }
                });
            }
        }
    });

    //



    function swiperInit() {
        var mySwiper = new Swiper('.seamless-rolling-box', {
            slidesPerView: 3,
            freeMode: true,
//preloadImages: true,
//lazyLoading: true,
            updateOnImagesReady: true,
            observer: true,//修改swiper自己或子元素时，自动初始化swiper
            observeParents: true,//修改swiper的父元素时，自动初始化swiper
//lazyLoadingInPrevNext: true,
            spaceBetween: 10,
        });
    }
    $(function(){
        swiperInit();
    });

    //
</script>