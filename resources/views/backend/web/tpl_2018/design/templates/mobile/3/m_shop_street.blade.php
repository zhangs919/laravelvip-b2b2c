<!-- 手机端首页店铺模板 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!--店铺推荐 start-->
    <section class="store-wall">
        <div class="store-wall-content">
            <div class="findshop"></div>
            <div class="shop-container mySwiper">

                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="shop-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="9" data-number="24" data-show_bgimage="1">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                <ul class="swiper-wrapper">


                    @if(!empty($data['9-1']))
                        @foreach(array_chunk($data['9-1'], 2) as $v)
                            <li class="swiper-slide image ">

                                @foreach($v as $vv)
                                    <a href="{{ route('mobile_shop_home', ['shop_id'=>$vv['shop_id']], false) }}" title="{{ $vv['shop_name'] }}">
                                        <img src="{{ $vv['shop_logo'] }}" alt="{{ $vv['shop_name'] }}">
                                    </a>
                                @endforeach

                            </li>
                        @endforeach
                    @else
                        @for($i=1; $i <= 6; $i++)
                            <li class="swiper-slide image">

                                <a href="javascript:void(0)">
                                    <img src="/assets/d2eace91/images/design/example/shop_img_90_45.jpg">
                                </a>



                                <a href="javascript:void(0)">
                                    <img src="/assets/d2eace91/images/design/example/shop_img_90_45.jpg">
                                </a>

                            </li>
                        @endfor
                    @endif


                </ul>
            </div>
        </div>
    </section>
    <!--店铺推荐 end-->

@if($is_design)
</div>
@endif

<script type="text/javascript">
    var mySwiper = new Swiper('.shop-container', {
//loop : true,
        slidesPerView: 'auto',
// loopedSlides :8,
        touchRatio: 1,
    })
</script>