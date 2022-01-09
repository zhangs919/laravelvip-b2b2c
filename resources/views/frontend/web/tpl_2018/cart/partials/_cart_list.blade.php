<div class="content">
    @if(count($shop_cart_list) > 0)
        <div class="cart-filter-bar">
            <div class="switch-cart" id="cart_num">
                <!-- 购物车数量 -->

                <span class="color">
                            我的购物车
                            <em class="color">{{ $cart_price_info['goods_num'] }}</em>
                        </span>


            </div>
        </div>
        <div class="cart-main">
            <div class="cart-table-th">
                <div class="wp">
                    <div class="th th-chk">
                        <div class="select-all">
                            <div class="cart-checkbox all-checkbox">
                                <!-- <input type="checkbox" name="" value="true"> -->
                                <label for="">勾选购物车内所有商品</label>
                                <span>&nbsp;&nbsp;全选</span>
                            </div>
                        </div>
                    </div>
                    <div class="th th-item">
                        <div class="td-inner">商品信息</div>
                    </div>
                    <div class="th th-info">
                        <div class="td-inner">&nbsp;</div>
                    </div>
                    <div class="th th-price">
                        <div class="td-inner">单价（元）</div>
                    </div>
                    <div class="th th-amount">
                        <div class="td-inner">数量</div>
                    </div>
                    <div class="th th-sum">
                        <div class="td-inner">金额（元）</div>
                    </div>
                    <div class="th th-op">
                        <div class="td-inner">操作</div>
                    </div>
                </div>
            </div>

            <div id="cart_list">
                <!-- 各个店铺下的信息 -->

                @foreach($shop_cart_list as $shop_id=>$cart_list)
                    <div id="cart_shop_{{ $shop_id }}" class="order-body">

                        <div class="shop">
                            <div class="shop-info">
                                <div class="cart-checkbox shop-checkbox " data-shop-id="{{ $shop_id }}">
                                    <!-- <input type="checkbox" name="" value=""> -->
                                    <label for="">勾选此店铺下所有商品</label>
                                </div>
                                &nbsp;&nbsp;

                                <span class="shop-icon">
                                        <img src="/frontend/images/shop-type/shop-icon1.png" />
                                    </span>
                                <span class="shop-name">店铺：</span>
                                <a href='{{ route('pc_shop_home', ['shop_id'=>$shop_id]) }}' target="_blank" title="{{ $cart_list[0]->shop->shop_name }}" class="shop-info-name">{{ $cart_list[0]->shop->shop_name }}</a>
                                <!-- 客服 -->
                                <span class="shop-customer">






                                        <!-- s等于1时带文字，等于2时不带文字 -->
                                        <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                            <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                            <span></span>
                                        </a>


                                    </span>
                                <!-- 促销活动红包 -->

                                <span class="start-price SHOP-DELIVERY-1"  style="display: none;" >
                                        <i>起送价：49.00</i>
                                        （尚未达到起送价，再去挑选一下店铺心仪的商品吧！）
                                        <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_id]) }}" target='_blank' title="去{{ $cart_list[0]->shop->shop_name }}店铺">去店铺 &gt;</a>
                                    </span>


                            </div>
                        </div>
                        <div class="order-content">
                            <div class="item-list">
                                <div class="bundle bundle-last">
                                    <!-- 购物车中商品列表 -->
                                    @foreach($cart_list as $v)
                                        <div class="item-holder" id="cartid{{ $v->cart_id }}">




                                            <div class="item-body ">
                                                <ul class="item-content clearfix goods_{{ $v->cart_id }}_{{ $v->goods->sku_id }}">

                                                    <li class="td td-chk">
                                                        <div class="td-inner">
                                                            <div class="cart-checkbox goods-checkbox @if($v->selected == 1) select @endif" data-shop-id="{{ $v->shop->shop_id }}">


                                                                <input type="checkbox" name="checkbox" value="{{ $v->cart_id }}" @if($v->selected == 1) checked="checked" @endif>
                                                                <label for="">勾选商品</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="td td-item">
                                                        <div class="td-inner">
                                                            <div class="item-pic">
                                                                <a href="{{ route('pc_show_goods',['goods_id'=>$v->goods->goods_id]) }}" target="_blank" class="">
                                                                    <img src="{{ get_image_url($v->goods->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" class="itempic">
                                                                </a>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="item-basic-info">
                                                                    <a href="{{ route('pc_show_goods',['goods_id'=>$v->goods->goods_id]) }}" target="_blank" title="{{ $v->goods->goods_name }}" class="item-title">


                                                                        {{ $v->goods->goods_name }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="td td-info">
                                                    </li>
                                                    <li class="td td-price">
                                                        <div class="td-inner">
                                                            <div class="item-price">
                                                                <div class="price-content">
                                                                    <div class="price-line">
                                                                        <em class="price-original">￥{{ $v->goods->market_price }}</em>
                                                                    </div>
                                                                    <div class="price-line price-line1">
                                                                        <em class="price-now">￥{{ $v->goods->goods_price }}</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="td td-amount">
                                                        <div class="td-inner">
                                                            <div class="amount-wrapper">
                                                                <div class="item-amount">
                                                                    <!--   -->
                                                                    <span class="amount-widget amount">
                                                                        <input type="text" class="amount-input" value="{{ $v->goods_num }}"
                                                                               data-cart-id="{{ $v->cart_id }}" data-goods-number="{{ $v->goods_num }}" data-sku-id="{{ $v->goods->sku_id }}"
                                                                               id="number{{ $v->cart_id }}" data-amount-min="1" data-amount-max="{{ $v->goods->goods_number }}" maxlength="8" title="请输入购买量">
                                                                        <span class="amount-btn">
                                                                            <span class="amount-plus">
                                                                                <i>+</i>
                                                                            </span>
                                                                            <span class="amount-minus">
                                                                                <i>-</i>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                    <!-- <a href="javascript:void(0)" class="minus" id="minus" data="">-</a>
                                                                    <input type="text" id="number" value="" class="text text-amount" data="" data-max="1406" data-now="1" autocomplete="off">
                                                                    <a href="javascript:void(0)" class="no-plus" id="plus" data="">+</a> -->

                                                                </div>


                                                                <div class="amount-msg" style="display:none">


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="td td-sum">
                                                        <div class="td-inner">
                                                            <em class="number second-color">￥{{ $v->goods_total }}</em>
                                                        </div>
                                                    </li>
                                                    <li class="td td-op">
                                                        <div class="td-inner">
                                                            <a href="javascript:void(0);" class="del" data-cart-id="{{ $v->cart_id }}">删除</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- 赠品 -->



                                        </div>
                                    @endforeach



                                </div>
                            </div>
                        </div>




                    </div>
                @endforeach

            </div>
        </div>

        <!-- 购物车统计 -->
        <div class="cart-foot">
            <div class="cart-foot-wrapper">
                <div class="select-all">
                    <div class="cart-checkbox all-checkbox">
                        <!-- <input type="checkbox" name="" value=""> -->
                        <label for="">勾选所有商品</label>
                        <span>&nbsp;&nbsp;全选</span>
                    </div>
                </div>
                <div class="operations">
                    <a href="javascript:void(0)" class="del">删除</a>
                    <!-- <a href="">分享</a> -->
                </div>
                <div class="cart-bar-right" id="cart_count">
                    <!-- 购物车金额 -->
                    <div class="amount-sum">
                        <span class="txt">已选商品</span>
                        <em class="second-color SZY-CART-SELECT-GOODS-NUMBER">{{ $cart_price_info['goods_num'] }}</em>
                        <span class="txt">件</span>
                    </div>
                    <div class="price-sum">
                        <span class="txt">合计（不含运费）:</span>
                        <strong class="price second-color SZY-CART-SELECT-GOODS-AMOUNT">￥{{ $cart_price_info['total_fee'] }}</strong>
                    </div>
                    <div class="btn-area">
                        <a href="javascript:void(0)" class="submit-btn SZY-CART-SUBMIT">
                            <span>结 算</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    @else
        <div class="cart-empty">
            <div class="message">
                <ul>
                    <li class="txt">购物车还是空空的呢，快去看看心仪的商品吧~</li>
                    <li>
                        <a href="{{ route('pc_home') }}" class="btn-link" title="去购物">去购物></a>
                    </li>
                </ul>
            </div>
        </div>
    @endif



</div>
<script type="text/javascript">
    var shop_id = '';
    /*鼠标滑过切换tab*/
    function mouseover_tabs(a,b,c){
        $(a).mouseover(function(){
            $(this).addClass(c).siblings().removeClass(c);
            $(b).eq($(this).index()).show().siblings().hide();
        })
    }
    mouseover_tabs(".interested-title ul li",".interested-main .interested-panel",'selected');
    mouseover_tabs(".products-item1 .focus-tab a",".products-item1 .goods-list-panel ul",'selected');
    mouseover_tabs(".products-item2 .focus-tab a",".products-item2 .goods-list-panel ul",'selected');
    mouseover_tabs(".products-item3 .focus-tab a",".products-item3 .goods-list-panel ul",'selected');
    mouseover_tabs(".products-item4 .focus-tab a",".products-item4 .goods-list-panel ul",'selected');
</script>