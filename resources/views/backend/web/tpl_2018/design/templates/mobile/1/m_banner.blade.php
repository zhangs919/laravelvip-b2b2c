<!-- 默认缓载图片 -->
<!-- 轮播广告模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id=''
     data-shop_id='{{ $shop_id ?? '' }}' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}'
     data-is_valid='{{ $is_valid }}'>

    <!-- 首页banner _star -->
    <div class="swiper-container  @if(!empty($data['99-1'])){{ 'swiper-banner-3d' }}@else{{ 'swiper-banner' }}@endif">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR"
               data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="10">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif
        @if(!empty($data['99-1']))
            <div class="swiper-bannner-bg"
                 style="@if(!empty($data['99-1'][0]['banner_bgcolor'])){{ 'background:'.$data['99-1'][0]['banner_bgcolor'] }}@endif @if(!empty($data['99-1'][0]['banner_bgimage'])) url({{ get_image_url($data['99-1'][0]['banner_bgimage']) }}) no-repeat top;background-size:100% 100% @endif"></div>
        @endif
        <div class="swiper-wrapper">
            @if(!empty($data['3-1']))
                @foreach($data['3-1'] as $k=>$v)
                    <div class="swiper-slide">
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}"
                           style="padding-top:{{ calc_padding_top($v['image_height'], $v['image_width']) }}%">
                            <img class="lazy" src="/assets/d2eace91/images/common/blank.png"
                                 data-original="{{ get_image_url($v['path']) }}"
                                 data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75"/>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="swiper-slide">
                    <a href="javascript:void(0)" style="padding-top:33.06%" class="example-text">
                        <span>此处添加轮播广告图片</span>
                    </a>
                </div>
            @endif
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- 首页banner _end -->
</div>

@if($is_design)
    <script type="text/javascript">
        $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_banner_roll="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
    </script>
@endif


<script type="text/javascript">
    @if(!empty($data['99-1']))
    var bannerSwiper;
    $().ready(function () {
        bannerSwiper = $('#{{ $uid }} .swiper-banner-3d').swiper({
            slidesPerView: "auto",
            lazyLoading: true,
            lazyLoadingInPrevNext: true,
            centeredSlides: !0,
            autoplay: 3000,
            loop: true,
            watchSlidesProgress: !0,
            onProgress: function (a) {
                var b, c, d;
                for (b = 0; b < a.slides.length; b++)
                    c = a.slides[b], d = c.progress, scale = 1 - Math.min(Math.abs(.2 * d), 1), es = c.style, es.opacity = 1 - Math.min(Math.abs(d / 2), 1), es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = "translate3d(0px,0," + -Math.abs(150 * d) + "px)"
            },
            onSetTransition: function (a, b) {
                for (var c = 0; c < a.slides.length; c++)
                    es = a.slides[c].style, es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = b + "ms"
            }
        });
    });
    @else
    var swiper;
    $().ready(function () {
        swiper = $('#{{ $uid }} .swiper-banner').swiper({
            pagination: '#{{ $uid }} .swiper-pagination',
            paginationClickable: true,
            autoplay: 3000,
            loop: true,
            autoplayDisableOnInteraction: false,
            lazyLoading: true,
            lazyLoadingInPrevNext: true,
        });
    });
    @endif

    $().ready(function () {
        $('.hot-space').each(function () {
            $(this).planetmap();
        });
    });
</script>
<script type="text/javascript">
    //
</script>


