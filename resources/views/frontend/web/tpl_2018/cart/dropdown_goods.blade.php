@if(count($cart_list) > 0)
<div class="dropdown-title">
    <h4 class="fl">购物清单</h4>
</div>
<div class="dropdown-goods-list">
    <ul>

        @foreach($cart_list as $v)
        <!-- 如果商品已失效，给下面的div追加class "invalid" -->
        <li class=" ">
            <div class="p-img">
                <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank">
                    <img src="{{ get_image_url($v['goods']['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220"
                         width="50" height="50" alt="">
                </a>
            </div>
            <div class="p-name">
                <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}"
                   target="_blank">
                    <!-- 如果商品已失效，显示下面的font标签 _start -->

                    {{--<font>失效</font>--}}

                    <!-- 如果商品已失效，显示下面的font标签 _end -->
                    {{ $v['goods_name'] }}
                </a>
            </div>
            <div class="p-detail">
                <span class="p-price">
                <strong class="second-color">￥{{ $v['goods_price'] }}</strong>
                ×{{ $v['goods_number'] }}
                </span>
                <br>
                <a class="delete" href="javascript:void(0)" onClick="$.cart.remove('{{ $v['cart_id'] }}')">删除</a>
            </div>
        </li>
        @endforeach

    </ul>
</div>
<div class="dropdown-footer clearfix">
    <div class="p-total">
        共
        <b class="second-color">{{ $cart_price_info['goods_number'] }}</b>
        件商品 共计
        <strong class="second-color">￥{{ $cart_price_info['total_fee'] }}</strong>
    </div>
    <a href="/cart.html" title="去购物车" class="bg-color">去购物车</a>
</div>
@else
<!-- 购物车为空 -->
<div class="cart-type">
    <i class="cart-type-icon"></i>
    <div class="cart-type-text">
        您的购物车里什么都没有哦
        <br />
        <a class="color" href="{{ route('pc_home') }}" title="再去看看吧" target="_blank">再去看看吧</a>
    </div>
</div>
@endif