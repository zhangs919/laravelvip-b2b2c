@if(!empty($cart['shop_list']))
    <div class="content">

        <div id="cart_list" class="flow-goods-list ">
            @foreach($cart['shop_list'] as $item)
                <div id="cart_shop_{{ $item['shop_info']['shop_id'] }}" class="order-body">
                    <div class="folw-shop-main">
                        <div class="shop">
                            <div class="shop-info">
                                {{--选中状态 加class "select"--}}
                                <div class="cart-checkbox shop-checkbox "
                                     data-shop-id="{{ $item['shop_info']['shop_id'] }}">
                                    <label><i></i></label>
                                </div>
                                <div class="shop-title-content">
                                <span class="shop-title-icon">
                                    <img src="/images/flow/icon_shop.png"/>
                                </span>
                                    <a class="shop-title-name"
                                       href='{{ route('mobile_shop_home', ['shop_id'=>$item['shop_info']['shop_id']]) }}'
                                       title="{{ $item['shop_info']['shop_name'] }}">{{ $item['shop_info']['shop_name'] }} </a>

                                    {{--todo 判断是否有红包--}}
                                    <div class="shop-coupon-trigger color"
                                         data-shop-id="{{ $item['shop_info']['shop_id'] }}">领红包
                                    </div>
                                    <section class="f_block select-coupon"
                                             id="select_coupon_{{ $item['shop_info']['shop_id'] }}">
                                        <div class="discount-coupon">
                                            <h2>
                                                领取红包
                                                <a class="choose-attribute-close coupon_close" href="javascript:void(0)"
                                                   data-shop-id="{{ $item['shop_info']['shop_id'] }}"></a>
                                            </h2>
                                            <div class="coupon-list">
                                                <ul class="coupon-item-ing">
                                                    <!--  ￥10.00元 -->
                                                    <li>
                                                        <div class="coupon-info">
                                                            <div class="coupon-item-left bg-color">
                                                                <div class="coupon-item-left-inner">
                                                                    <div class="coupon-money"><span>￥</span><em>10</em>
                                                                    </div>
                                                                    <h3>满45元使用</h3>
                                                                </div>
                                                            </div>
                                                            <div class="coupon-item-right">
                                                                <div class="coupon-left-top">
                                                                    <p class="coupon-name">
                                                                        红包
                                                                    </p>
                                                                </div>
                                                                <div class="coupon-left-bottom">
                                                                    <span class="coupon-time"> 2019.05.20-2019.05.27 </span>
                                                                    <div class="op-btns">

                                                                        <!-- 未领取的红包 _start -->
                                                                        <a href="javascript:void(0);" title="点击领取红包"
                                                                           data-bonus-id="402"
                                                                           class="bonus-receive bg-color coupon-btn">立即领取</a>
                                                                        <!-- 未领取的红包 _end -->

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                        </div>
                                    </section>

                                </div>
                            </div>
                        </div>
                        <!--起送价提示-->
                        <div class="start-price-con clearfix SHOP-DELIVERY-{{ $item['shop_info']['shop_id'] }}"
                             style="display: none;">
                            <a class="shp-cart-conditions-link"
                               href="{{ route('mobile_shop_home', ['shop_id'=>$item['shop_info']['shop_id']]) }}">
                            <span class="icon-condition color">
                                <span>去凑单</span>
                                <em class="promotion-down-arrow-icon"></em>
                            </span>
                                <span class="condition-description">
                                <span>尚未达到起送价，起送价为：￥{{ $item['shop_info']['start_price'] }}，再去挑选一下店铺心仪的商品吧！</span>
                            </span>
                                <span class="condition-description-tips">
                                <i class="color">去店铺</i>
                            </span>
                            </a>
                        </div>
                        <ul class="item-list item-holder" id="cartid">
                            <!--宝贝失效后给li标签增加item-invalid样式-->
                            @foreach($item['goods_list'] as $v)
                                <li class=' SZY-INVALID-LI cart-item ' data-cart-id="{{ $v['cart_id'] }}">
                                    <div class="cart-checkbox goods-checkbox @if($v['select'] == 1){{ 'select' }}@endif"
                                         data-shop-id="{{ $v['shop_id'] }}">
                                        <input type="checkbox" name="checkbox" value="{{ $v['cart_id'] }}"
                                               @if($v['select'] == 1) checked="checked" @endif>
                                        <label>
                                            <i></i>
                                        </label>
                                    </div>
                                    <div class="inner">
                                        <div class="goods-pic GO-INFO"
                                             data-goods_url="{{ route('mobile_show_goods',['goods_id'=>$v['goods_id']]) }}">
                                            <img src="{{ $v['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180"
                                                 class="itempic">
                                            <span class="invalid-pic"></span>
                                        </div>
                                        <dl class="goods-info">
                                            <!--此处商品名称需要控制显示字数-->
                                            <dt class="goods-name">
                                                <a href="{{ route('mobile_show_goods',['goods_id'=>$v['goods_id']]) }}"
                                                   class="item-title">
                                                    <!-- 活动色块 -->
                                                    {{ $v['goods_name'] }}
                                                </a>
                                            </dt>
                                            <dd class="goods-attr">
                                                @if(!empty($v['spec_names']))
                                                    @foreach($v['spec_names'] as $spec)
                                                        <span>{{ $spec }}</span>
                                                    @endforeach
                                                @endif
                                            </dd>
                                            <dd class="good-info-bottom ub">
                                                <em class="goods-price price-color ub-f1">￥{{ $v['goods_price'] }}</em>
                                                <div class="goods-num amount amount-btn">
                                                    <i class="decrease amount-minus iconfont icon-jian2"></i>
                                                    <input type="text" class="num" value="{{ $v['goods_number'] }}"
                                                           data-goods-number="{{ $v['goods_number'] }}"
                                                           data-cart-id="{{ $v['cart_id'] }}"
                                                           data-sku-id="{{ $v['sku_id'] }}"
                                                           id="number{{ $v['cart_id'] }}" data-amount-step="1"
                                                           data-amount-min="1" data-amount-max="{{ $v['sku_number'] }}"
                                                           maxlength="8" title="请输入购买量">
                                                    <i class="increase amount-plus iconfont icon-jia1"></i>
                                                    <div class="edit-quantity-mask hide"
                                                         id="quantity_{{ $v['sku_id'] }}">
                                                        <div class="edit-quantity-con">
                                                            <div class="edit-quantity-hd">修改购买数量</div>
                                                            <div class="edit-quantity-bd">
                                                                <div class="quantity-info">
                                                                    <a class="quantity-decrease"></a>
                                                                    <input type="number" size="4"
                                                                           value="{{ $v['goods_number'] }}"
                                                                           data-step="1" data-min="1"
                                                                           data-max="{{ $v['sku_number'] }}"
                                                                           class="quantity">
                                                                    <a class="quantity-increase"></a>
                                                                </div>
                                                            </div>
                                                            <div class="edit-quantity-ft">
                                                                <button id="btn_cancel" type="button"
                                                                        class="btn btn-default">取消
                                                                </button>
                                                                <button id="btn_submit" type="button"
                                                                        class="btn btn-primary bg-color">确定
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script type="text/javascript">
                                                        //
                                                    </script>
                                                </div>
                                            </dd>
                                        </dl>
                                        <!--会员专享价 start-->
                                        <!--会员专享价 end-->
                                    </div>
                                </li>
                                <!-- 赠品 -->
                                <!-- -->
                            @endforeach
                        </ul>
                    </div>
                    <!-- 多门店商品展示  -->
                </div>
            @endforeach

            {{--无效商品列表 todo --}}
            @if(!empty($invalid_list))
                <div class="flow-invalid-list" id="invalid-list">
                    <h3 class="flow-invalid-title">以下商品无法一起进行购买</h3>
                    <ul class="item-list item-holder">


                        <li class=' item-invalid  SZY-INVALID-LI' data-cart-id="4833">

                            <div class="cart-checkbox">
                                <span>失效</span>
                            </div>

                            <div class="inner">
                                <div class="goods-pic GO-INFO" data-goods_url="/842.html">
                                    <img src="http://wwwng.aliyuncs.com/images/746/taobao-yun-images/2018/12/04/45489822629/TB1w3BTNXXXXXX2XFXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220"
                                         class="itempic">


                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">
                                        <a href="/842.html" class="item-title">
                                            <!-- 活动色块 -->


                                            打包一口价50起
                                        </a>
                                    </dt>
                                    <dd class="goods-attr">

                                    </dd>
                                    <dd class="good-info-bottom ub">
                                        <em class="goods-price price-color ub-f1">￥98.00元</em>
                                    </dd>
                                </dl>
                            </div>

                        </li>
                        <!-- 赠品 -->
                        <!-- -->
                        <ul class="cart-fixed-goods">

                            <li class="ub bdr-top">
                                <p class="p-name">诺心蛋糕LECAKE草莓拿破仑蛋糕水果蛋糕 上海北京等同城配送 150*180cm 香辣味</p>
                                <p class="p-num">x0</p>
                            </li>

                            <li class="ub bdr-top">
                                <p class="p-name">12</p>
                                <p class="p-num">x0</p>
                            </li>

                        </ul>


                    </ul>
                    <div class="flow-invalid-bottom">
                        <a href="javascript:void(0)" class="del-invalid border-color color">清空失效商品</a>
                    </div>
                </div>
            @endif

            <!-- 多门店商品展示  -->
{{--            <div class="store-goods-con" style="display: none;">--}}
{{--                <a class="store-title-name" href='https://m.lrw.com/mapacp5hv/cart.html' title="非直播门店">--}}
{{--                    <span>非直播门店</span>--}}
{{--                </a>--}}
{{--                <div class="goods-list">--}}
{{--                    <ul class="clearfix">--}}
{{--                        <li onClick="javascript:$.go('https://m.lrw.com/mapacp5hv/goods/71760.html')">--}}
{{--                            <div class="pic">--}}
{{--                                <img src="https://wwwncs.com/taobao-yun-images/537022948931/TB1kCRJLpXXXXbuapXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220"--}}
{{--                                     alt="">--}}
{{--                            </div>--}}
{{--                            <p class="price price-color">￥58.8</p>--}}
{{--                        </li>--}}
{{--                        <li onClick="javascript:$.go('https://m.lrw.com/mapacp5hv/goods/71761.html')">--}}
{{--                            <div class="pic">--}}
{{--                                <img src="https://wwwaobao-yun-images/43751135960/TB1ucBzHpXXXXaAXpXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220"--}}
{{--                                     alt="">--}}
{{--                            </div>--}}
{{--                            <p class="price price-color">￥14.9</p>--}}
{{--                        </li>--}}
{{--                        <li onClick="javascript:$.go('https://m.lrw.com/mapacp5hv/goods/71762.html')">--}}
{{--                            <div class="pic">--}}
{{--                                <img src="https://wwwaobao-yun-images/537566763339/TB1uqQAMVXXXXX1XpXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220"--}}
{{--                                     alt="">--}}
{{--                            </div>--}}
{{--                            <p class="price price-color">￥25.9</p>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <!-- 结算提示 -->
{{--        <div class="select-goods-box" style="display: none;">--}}
{{--            <div class="select-goods">--}}
{{--                <div class="title bdr-bottom">选择结算商品</div>--}}
{{--                <div class="container">--}}
{{--                    <p class="tips">不同配送方式的商品暂不支持同时销售，请分开下单</p>--}}
{{--                    <div class="item">--}}
{{--                        <div class="goods-list">--}}
{{--                            <span>快递发货</span>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;">--}}
{{--                                        <img src="https://wwwng.aliyuncs.com/images/746/taobao-yun-images/2018/12/11/562546245666/TB2Vk7PbQfb_uJkSmRyXXbWxVXa_!!744669255.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp"--}}
{{--                                             alt="">--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;">--}}
{{--                                        <img src="http://wwwaobao-yun-images/39242043992/TB1ld2zNFXXXXboaXXXXXXXXXXX_!!2-item_pic.png?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp"--}}
{{--                                             alt="">--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;">--}}
{{--                                        <img src="https://wwwng.aliyuncs.com/images/746/taobao-yun-images/2018/12/20/538704657972/TB1pPJAOXXXXXcOapXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp"--}}
{{--                                             alt="">--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;">--}}
{{--                                        <img src="http://wwwaobao-yun-images/39242043992/TB1ld2zNFXXXXboaXXXXXXXXXXX_!!2-item_pic.png?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp"--}}
{{--                                             alt="">--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;">--}}
{{--                                        <img src="https://wwwng.aliyuncs.com/images/746/taobao-yun-images/2018/12/20/538704657972/TB1pPJAOXXXXXcOapXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp"--}}
{{--                                             alt="">--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="bottom">--}}
{{--                            <p>共<span class="price-color">3</span>件，合计<span class="price-color">300</span>元</p>--}}
{{--                            <a href="javascript:;" class="check-btn bg-color">去结算</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <div class="goods-list">--}}
{{--                            <span>门店自提</span>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;">--}}
{{--                                        <img src="https://wwwng.aliyuncs.com/images/746/taobao-yun-images/2018/12/11/562546245666/TB2Vk7PbQfb_uJkSmRyXXbWxVXa_!!744669255.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp"--}}
{{--                                             alt="">--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="bottom">--}}
{{--                            <p>共<span class="price-color">1</span>件，合计<span class="price-color">100</span>元</p>--}}
{{--                            <a href="javascript:;" class="check-btn bg-color">去结算</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <a href="javascript:;" class="close-btn">--}}
{{--                <i class="iconfont"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
        <!--底部-->
        <div class="flow-bottom">
            <div class="cart-checkbox all-checkbox ">
                <label for="">
                    <i></i>
                </label>
                <span>全选</span>
            </div>
            <div class="cart-handle-btn hide" id="cart_manage">
                <a class="btn" href="javascript:void(0)" id="cart_clear">清理</a>
                <a class="btn" href="javascript:void(0)" id="batch_collect">移入收藏夹</a>
                <a class="btn" href="javascript:void(0)" id="batch_delet">删除</a>
            </div>
            <div id="cart_count" class=""><div class="total">
                    <dl class="total-money">
                        <dt>合计：</dt>
                        <dd>
                            <em class="SZY-CART-SELECT-GOODS-AMOUNT price-color">{{ $cart['select_goods_amount_format'] }}</em>
                        </dd>
                    </dl>
                </div>
                <div class="check-btn bg-color wait-loading SZY-CART-SUBMIT-LOADING" style="display:none"><i></i></div>
                <div class="submit-btn bg-color check-btn SZY-CART-SUBMIT ">去结算</div>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
        <!--底部菜单 end-->
    </div>
@else
    <div class="content">
        <!--没有数据时-->
        <div class="no-data-div m-b-50">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png"/>
            </div>
            <dl>
                <dt>购物车还是空空的呢</dt>
                <dd>先去挑选自己喜欢的宝贝吧！</dd>
            </dl>
            <a href="/" class="no-data-btn">逛一逛</a>
        </div>
    </div>
    <script>
        @foreach($cart['shop_list'] as $item)
        @foreach($item['goods_list'] as $v)

        $().ready(function () {

            var container = $('#quantity_{{ $v['sku_id'] }}');

            $(container).find('.quantity-decrease').click(function () {
                var target = $(this).parent().find('.quantity');
                var goods_number = parseInt($(target).val());
                var step = $(target).data("step");
                var min = $(target).data("min");
                if (goods_number - step >= min) {
                    $(target).val(goods_number - step);
                } else {
                    $.msg("商品数量必须大于" + (min - 1));
                }
            });
            $(container).find('.quantity-increase').click(function () {
                var target = $(this).parent().find('.quantity');
                var goods_number = parseInt($(target).val());
                var max = $(target).data("max");
                var step = $(target).data("step");
                if (goods_number + step <= max) {
                    $(target).val(goods_number + step);
                } else {
                    $.msg("最多只能购买" + max + "件");
                }
            });

            $(container).find('#btn_cancel').click(function () {
                $(container).hide();
            });

            $(container).find('#btn_submit').click(function () {
                $('.SZY-CART-SUBMIT-LOADING').show();
                $('.SZY-CART-SUBMIT').hide();
                var number = parseInt($(container).find('.quantity').val());

// <!--  -->
                var sku_id = '{{ $v['sku_id'] }}';
// <!--  -->

// <!--  -->
                var cart_id = '{{ $v['cart_id'] }}';
// <!--  -->

                $.loading.start();
                $.cart.changeNumber(sku_id, number, cart_id, function (result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $(".content").replaceWith(result.data);
// 重新初始化
                        init();
                    }
                }).always(function () {
                    $('.SZY-CART-SUBMIT-LOADING').hide();
                    $('.SZY-CART-SUBMIT').show();
                });
            });
        });
        @endforeach
                @endforeach




        //
    </script>
@endif

<script>
    if ($("#cart_manage_btn").attr('data-type') == 1) {
        $("#cart_count").addClass('hide');
        $("#cart_manage").removeClass('hide');
    } else {
        $("#cart_count").removeClass('hide');
        $("#cart_manage").addClass('hide');
    }
</script>

