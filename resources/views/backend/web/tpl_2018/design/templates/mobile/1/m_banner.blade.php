<!-- 默认缓载图片 -->
<!-- 轮播广告模板 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>
@endif


    <!-- 首页banner _star -->
    <div class="swiper-container swiper-banner ">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="10">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif
        <div class="swiper-wrapper">

            @if(!empty($data['3-1']))
                @foreach($data['3-1'] as $k=>$v)
                    <div class="swiper-slide">
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px; background-color: #fff; padding-top:{{ calc_padding_top($v['image_height'], $v['image_width']) }}%">
                            <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75"/>
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



@if($is_design)
</div>

<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_banner_roll="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif


<script type="text/javascript">
    var swiper = $('#{{ $uid }} .swiper-banner').swiper({
        pagination: '#{{ $uid }} .swiper-pagination',
        paginationClickable: true,
        autoplay: 3000,
        autoplayDisableOnInteraction: false
    });
</script>
<script type="text/javascript">
    $.imgloading.loading();
</script>