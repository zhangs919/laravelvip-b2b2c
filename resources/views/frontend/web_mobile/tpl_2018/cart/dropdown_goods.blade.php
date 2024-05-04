@if($cart_price_info['goods_number'] == 0)
    <div class="shop-cart-icon footer-cart-icon empty-footer-cart ">
        <a href="javascript:void(0)" class="">
            <em class="SZY-CART-COUNT color"></em>
            <i class="iconfont">&#xe60e;</i>
        </a>
    </div>
@else
    <div class="shop-cart-icon footer-cart-icon cart-icon ">
        <a href="javascript:void(0)" class="bg-color">
            <em class="SZY-CART-COUNT color">{{ $cart_price_info['goods_number'] }}</em>
            <i class="iconfont"></i>
        </a>
    </div>
@endif
<!--购物车弹出盒子-->
<div class="cartbox-layer hide">
    <div class="cartbox-con">
        <div class="shop-cart-icon cartbox bg-color shop-cart-layer">
            <a href="javascript:void(0)">
                <em class="SZY-CART-COUNT color">{{ $cart_price_info['goods_number'] }}</em>
                <i class="iconfont"></i>
            </a>
        </div>
        <div class="cartbox-hd">
            <div class="box-left">

                <span class="cart-checkbox toggle-checkbox goods-checkbox-all checked">全选</span>
                <p class="SZY-SELECT-GOODS-NUMBER">(已选{{ $cart_price_info['goods_number'] }}件)</p>
            </div>
            <span class="box-right SZY-DEL-ALL">
<i class="iconfont"></i>
清空全部
</span>
        </div>
        <div class="cartbox-bd cartbox-goods-list">

            <ul>
                @foreach($cart_goods_list as $v)
                    <li>

                        <span class="cart-checkbox goods-checkbox checked" data-cart_id="{{ $v['cart_id'] }}"></span>

                        <div class="inner">
                            <div class="goods-pic">
                                <img src="{{ $v['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" class="itempic">

                            </div>
                            <dl class="goods-info">
                                <dt class="goods-name">{{ $v['goods_name'] }}</dt>

                                <dd class="goods-attr">
                                    @if(!empty($v['spec_names']))
                                        @foreach($v['spec_names'] as $spec)
                                            <span>{{ $spec }}</span>
                                        @endforeach
                                    @endif
                                </dd>

                                <dd class="goods-price price-color">
                                    <em>{{ $v['goods_price_format'] }}</em>
                                </dd>
                                <div class="goods-num amount amount-btn ">
                                    <i class="cartbox-decrease amount-minus iconfont icon-jian2"></i>
                                    <input type="text" readonly="readonly" class="num SZY-GOODS-NUMBER" value="{{ $v['goods_number'] }}" data-goods_min_number="{{ $v['goods_min_number'] }}" data-goods_max_number="{{ $v['goods_max_number'] }}" data-sku_id="{{ $v['sku_id'] }}" data-goods_id="{{ $v['goods_id'] }}" data-cart_id="{{ $v['cart_id'] }}">
                                    <i class="cartbox-increase amount-plus iconfont icon-jia1"></i>
                                </div>
                            </dl>
                        </div>
                    </li>
                @endforeach

            </ul>

        </div>
    </div>
</div>
@if($cart_price_info['goods_number'] == 0)
    <div class="goods-total-price  empty-cart-num SZY-GOODS-AMOUNT">购物车为空</div>
@else
    <div class="goods-total-price price-color SZY-GOODS-AMOUNT">￥{{ $cart_price_info['select_goods_amount'] }}</div>
@endif