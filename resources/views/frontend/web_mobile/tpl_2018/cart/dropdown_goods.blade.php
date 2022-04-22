<div class="shop-cart-icon footer-cart-icon cart-icon">
    <a href="javascript:void(0)" class="bg-color">
        <em class="SZY-CART-COUNT color">{{ $cart_price_info['goods_number'] }}</em>
        <i class="iconfont"></i>
    </a>
</div>
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
                @foreach($cart_list as $v)
                    <li>

                        <span class="cart-checkbox goods-checkbox checked" data-cart_id="{{ $v['cart_id'] }}"></span>

                        <div class="inner">
                            <div class="goods-pic">
                                <img src="{{ get_image_url($v['goods']['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" class="itempic">

                            </div>
                            <dl class="goods-info">
                                <dt class="goods-name">{{ $v['goods_name'] }}</dt>

                                <dd class="goods-attr">
                                    <span>口味：原味</span>
                                </dd>

                                <dd class="goods-price price-color">
                                    <em>￥{{ $v['goods_price'] }}</em>
                                </dd>
                                <div class="goods-num amount amount-btn ">
                                    <i class="cartbox-decrease amount-minus iconfont icon-jian2"></i>
                                    <input type="text" readonly="readonly" class="num SZY-GOODS-NUMBER" value="{{ $v['goods_number'] }}" data-goods_min_number="1" data-goods_max_number="11111" data-sku_id="{{ $v['sku_id'] }}" data-goods_id="{{ $v['goods_id'] }}" data-cart_id="{{ $v['cart_id'] }}">
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
<div class="goods-total-price price-color SZY-GOODS-AMOUNT">￥{{ $cart_price_info['total_fee'] }}</div>