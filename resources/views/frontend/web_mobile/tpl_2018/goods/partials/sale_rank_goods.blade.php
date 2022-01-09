<section class="sale-goods-box">
    <div class="sale-goods-list sale-top-list">
        <div class="tempWrap swiper-container sale-collect swiper-container-horizontal">
            <div class="bd swiper-wrapper">

                @foreach(array_chunk($sale_top_list, 3) as $v)
                <ul class="swiper-slide swiper-slide-active">
                    @foreach($v as $vv)
                    <li>
                        <div class="goods-info-box">
                            <div class="goods-pic">
                                <a href="{{ route('mobile_show_sku_goods', ['sku_id'=>$vv['sku_id']]) }}" title="{{ $vv['goods_name'] }}">
                                    <img src="{{ get_image_url($vv['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                                </a>
                            </div>
                            <div class="goods-name">
                                <a href="{{ route('mobile_show_sku_goods', ['sku_id'=>$vv['sku_id']]) }}" title="{{ $vv['goods_name'] }}">{{ $vv['goods_name'] }}</a>
                            </div>
                            <div class="price">
                                <span class="price-color">￥{{ $vv['goods_price'] }}</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endforeach

            </div>
            <div class="hd pagination sale-pagination"></div>
        </div>
    </div>
</section>