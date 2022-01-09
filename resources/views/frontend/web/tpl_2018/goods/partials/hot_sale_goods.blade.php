@if(count($hot_sale_goods) > 0)
<div id="hotsale">
    <div class="hd bg-color">热卖推荐</div>
    <div class="mc">

        @foreach($hot_sale_goods as $v)
        <dl>
            <dt>
                <a target="_blank" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" title="{{ $v->goods_name }} " style="">
                    <img class="lazy" src="/frontend/images/common/blank.png" data-original="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="">
                </a>
            </dt>
            <dd>
                <div class="p-name">
                    <a target="_blank" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" title="{{ $v->goods_name }} ">{{ $v->goods_name }} </a>
                </div>
                <div class="p-price">
                    特价：
                    <font class="shop-price second-color"> ￥{{ $v->goods_price }} </font>
                </div>
                <div class="btns">
                    <a target="_blank" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" class="bg-color">查看详情</a>
                </div>
            </dd>
        </dl>
        @endforeach

    </div>
</div>
@endif