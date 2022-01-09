<div class="cart-panel-main">
    <div class="cart-panel-content">

        @if(count($cart_list) > 0)
        <!-- 有商品的展示形式 _start -->
        <div class="cart-list">

            @foreach($cart_list as $v)
            <!-- 如果商品已失效，给下面的div追加class "invalid" -->
            <div class="cart-item ">
                <div class="item-goods">
                    <span class="p-img">
                        <a href="{{ route('pc_show_goods',['goods_id'=>$v->goods_id]) }}">
                        <img src="{{ get_image_url($v->goods->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220"
                             width="50" height="50" alt="{{ $v->goods_name }}">
                        </a>
                    </span>
                    <div class="p-name">
                        <a href="{{ route('pc_show_goods',['goods_id'=>$v->goods_id]) }}"
                           title="{{ $v->goods_name }}">
                            <!-- 如果商品已失效，显示下面的font标签 _start -->

                            {{--<font>失效</font>--}}

                            <!-- 如果商品已失效，显示下面的font标签 _end -->
                            {{ $v->goods_name }}
                        </a>
                    </div>
                    <div class="p-price">
                        <strong class="second-color">￥{{ $v->goods_price }}</strong>
                        ×{{ $v->goods_num }}
                    </div>
                    <a href="javascript:void(0);" class="p-del" onClick="$.cart.remove('{{ $v->cart_id }}')">删除</a>
                </div>
            </div>
            @endforeach

        </div>
        <!-- 有商品的展示形式 _end-->
        @else
        <!-- 没有商品的展示形式 _start -->
            <div class="tip-box">
                <img src="/frontend/images/noresult.png" class="tip-icon">
                <div class="tip-text">
                    您的购物车里什么都没有哦
                    <br>
                    <a class="color" href="{{ route('pc_home') }}" title="再去看看吧" target="_blank">再去看看吧</a>
                </div>
            </div>
            <!-- 没有商品的展示形式 _end-->
        @endif

    </div>
</div>

<!-- 有商品的展示形式 _start -->
<div class="cart-panel-footer">
    <div class="cart-footer-checkout">
        <div class="number">
            共
            <strong class="count second-color">{{ $cart_price_info['goods_num'] }}</strong>
            件商品
        </div>
        <div class="sum">
            共计：
            <strong class="total second-color">￥{{ $cart_price_info['total_fee'] }}</strong>
        </div>
        <a class="btn bg-color" href="/cart.html" target="_blank">去购物车结算</a>
    </div>
</div>
<!-- 有商品的展示形式 _end-->