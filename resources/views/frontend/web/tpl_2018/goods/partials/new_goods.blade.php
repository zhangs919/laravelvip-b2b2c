@if(!$new_goods->isEmpty())
        <div class="aside-con">
        <h2 class="aside-tit">新品推荐</h2>
        <ul class="aside-list">

            @foreach($new_goods as $v)
            <li>
                <!--售罄-->
                @if($v->goods_number <= 0)
                    <a href="/goods-{{ $v->goods_id }}.html" class="sell-out"></a>
                @endif
                <div class="p-img">
                    <a target="_blank" title="{{ $v->goods_name }}" href="/goods-{{ $v->goods_id }}.html" style="">
                        <img class="lazy" alt="" src="/images/common/blank.png" data-original="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450">
                    </a>
                </div>
                <div class="p-name">
                    <a target="_blank" title="{{ $v->goods_name }}" href="/goods-{{ $v->goods_id }}.html">{{ $v->goods_name }}</a>
                </div>
                <div class="p-price">
                    <span class="sale-price second-color">￥{{ $v->goods_price }}</span>
                    <span class="market-price">
                        <del>￥{{ $v->market_price }}</del>
                    </span>
                </div>
            </li>
            @endforeach

        </ul>
    </div>
@endif