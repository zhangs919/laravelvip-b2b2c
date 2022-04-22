<div class="content">
    @if(count($shop_cart_list) > 0)
        <div id="cart_list" class="flow-goods-list ">

            @foreach($shop_cart_list as $shop_id=>$cart_list)
            <div id="cart_shop_{{ $shop_id }}" class="order-body">
                <div class="folw-shop-main">

                    <div class="shop">
                        <div class="shop-info">
                            {{--选中状态 加class "select"--}}
                            <div class="cart-checkbox shop-checkbox " data-shop-id="{{ $shop_id }}">
                                <label></label>
                            </div>
                            <div class="shop-title-content">
                                <span class="shop-title-icon">
                                    <img src="/images/flow/icon_shop.png" />
                                </span>
                                <a class="shop-title-name" href='{{ route('mobile_shop_home', ['shop_id'=>$shop_id]) }}' title="{{ $cart_list[0]['shop']['shop_name'] }}">{{ $cart_list[0]['shop']['shop_name'] }} </a>

                            </div>
                        </div>
                    </div>
                    <!--起送价提示-->
                    <div class="start-price-con clearfix SHOP-DELIVERY-{{ $shop_id }}"  style="display: none;" >
                        <a class="shp-cart-conditions-link" href="{{ route('mobile_shop_home', ['shop_id'=>$shop_id]) }}">
                            <span class="icon-condition color">
                                <span>去凑单</span>
                                <em class="promotion-down-arrow-icon"></em>
                            </span>
                            <span class="condition-description">
                                <span>尚未达到起送价，起送价为：￥0.00，再去挑选一下店铺心仪的商品吧！</span>
                            </span>
                            <span class="condition-description-tips">
                                <i class="color">去店铺</i>
                            </span>
                        </a>
                    </div>
                    <ul class="item-list item-holder" id="cartid">
                        <!--宝贝失效后给li标签增加item-invalid样式-->


                        @foreach($cart_list as $v)
                        <li class="item-other-activity">
                            <div class="cart-checkbox goods-checkbox @if($v['select'] == 1){{ 'select' }}@endif" data-shop-id="{{ $v['shop']['shop_id'] }}">


                                <input type="checkbox" name="checkbox" value="{{ $v['cart_id'] }}" @if($v['select'] == 1) checked="checked" @endif>
                                <label></label>
                            </div>
                            <div class="inner">
                                <div class="goods-pic">
                                    <img src="{{ get_image_url($v['goods']['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180" class="itempic">
                                </div>


                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">
                                        <a href="{{ route('mobile_show_goods',['goods_id'=>$v['goods']['goods_id']]) }}" class="item-title">{{ $v['goods']['goods_name'] }}</a>
                                    </dt>
                                    <dd class="goods-attr">


                                        {{--todo 暂时注释规格--}}
                                        {{--<span>电压：60V</span>--}}

                                        {{--<span>颜色分类：60V20A 1000W空车</span>--}}


                                    </dd>
                                    <dd class="good-info-bottom ub">
                                        <em class="goods-price price-color ub-f1">￥{{ $v['goods']['goods_price'] }}</em>
                                        <div class="goods-num amount amount-btn">
                                            <span class="decrease amount-minus"><i></i></span>
                                            <input type="text" class="num" value="{{ $v['goods_number'] }}" data-goods-number="{{ $v['goods_number'] }}"
                                                   data-sku-id="{{ $v['goods']['sku_id'] }}" id="number{{ $v['cart_id'] }}"
                                                   data-amount-min="1" data-amount-max="{{ $v['goods']['goods_number'] }}" maxlength="8" title="请输入购买量">
                                            <span class="increase amount-plus"><i></i></span>
                                            <div class="edit-quantity-mask hide" id="quantity_{{ $v['goods']['sku_id'] }}">
                                                <div class="edit-quantity-con">
                                                    <div class="edit-quantity-hd">修改购买数量</div>
                                                    <div class="edit-quantity-bd">
                                                        <div class="quantity-info">
                                                            <a class="quantity-decrease"></a>
                                                            <input type="number" size="4" value="{{ $v['goods_number'] }}" class="quantity">
                                                            <a class="quantity-increase"></a>
                                                        </div>
                                                    </div>
                                                    <div class="edit-quantity-ft">
                                                        <button id="btn_cancel" type="button" class="btn btn-default">取消</button>
                                                        <button id="btn_submit" type="button" class="btn btn-primary bg-color">确定</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <script type="text/javascript">
                                                $().ready(function() {
                                                    $('#quantity_{{ $v['goods']['sku_id'] }}').find('.quantity-decrease').click(function() {
                                                        var goods_number = parseInt($(this).parent().find('.quantity').val());
                                                        if (goods_number > 1) {
                                                            $(this).parent().find('.quantity').val(goods_number - 1);
                                                        }
                                                    });
                                                    $('#quantity_{{ $v['goods']['sku_id'] }}').find('.quantity-increase').click(function() {
                                                        var goods_number = parseInt($(this).parent().find('.quantity').val());
                                                        $(this).parent().find('.quantity').val(goods_number + 1);

                                                    });

                                                    $('#quantity_{{ $v['goods']['sku_id'] }}').find('#btn_cancel').click(function() {
                                                        $('#quantity_{{ $v['goods']['sku_id'] }}').hide();
                                                    });

                                                    $('#quantity_{{ $v['goods']['sku_id'] }}').find('#btn_submit').click(function() {
                                                        $('.SZY-CART-SUBMIT-LOADING').show();
                                                        $('.SZY-CART-SUBMIT').hide();
                                                        var number = parseInt($('#quantity_{{ $v['goods']['sku_id'] }}').find('.quantity').val());
                                                        var sku_id = '{{ $v['goods']['sku_id'] }}';
                                                        $.cart.changeNumber(sku_id, number, null, function(result) {
                                                            if (result.code == 0) {
                                                                $(".content").replaceWith(result.data);
                                                                // 重新初始化
                                                                init();

                                                            }
                                                        });
                                                    });
                                                });
                                            </script>

                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                        @endforeach
                        <!-- 赠品 -->








                    </ul>
                </div>

            </div>
            @endforeach

        </div>
        <script>
            var scrollheight = 0;
            function select_coupon() {
                $("#select_coupon").animate({
                    height: '80%'
                }, [10000]);
                var total = 0, h = $(window).height(), top = $('.discount-coupon h2').height() || 0, con = $('.coupon-list');
                total = 0.8 * h;
                con.height(total - top + 'px');
                $(".mask-div").show();
                scrollheight = $(document).scrollTop();
                $("body").css("top", "-" + scrollheight + "px");
                $("body").addClass("visibly");
                $(".flow-goods-list").height($(window).height() - 100);
                $(".flow-goods-list").css({
                    margin: "0"
                });
                $(".flow-goods-list").css({
                    overflow: "hidden"
                });
            }
            function close_choose_attr() {
                $(".mask-div").hide();
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
                $(".flow-goods-list").removeAttr("style");
                $('#select_coupon').animate({
                    height: '0'
                }, [10000]);
            }
        </script>
        <!--底部-->
        <div style="height: 48px; line-height: 48px; clear: both;"></div>
        <div class="flow-bottom">
            <div class="cart-checkbox all-checkbox ">
                <label for=""></label>
                <span>全选</span>
            </div>
            <div id="cart_count"><div class="total">
                    <dl class="total-money">
                        <dt>合计:</dt>
                        <dd>
                            <em class="SZY-CART-SELECT-GOODS-AMOUNT price-color">￥{{ $v['goods_total'] }}</em>
                        </dd>
                    </dl>
                </div>
                <div class="check-btn bg-color wait-loading SZY-CART-SUBMIT-LOADING" style="display:none"><i></i></div>
                <div class="submit-btn check-btn bg-color SZY-CART-SUBMIT ">去结算</div>
            </div>
        </div>
        <div class="flow-bottom-handle" style="display:none">
            <div class="cart-checkbox">
                <label for=""></label>
                <span>全选</span>
            </div>
            <div class="cart-handle-btn">
                <a class="btn">移入关注</a>
                <a class="btn">删除</a>
            </div>
        </div>
        <!--底部菜单 end-->
    @else
        <!--没有收藏店铺时-->
        <div class="no-data-div m-b-50">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png" />
            </div>
            <dl>
                <dt>购物车还是空空的呢</dt>
                <dd>先去挑选自己喜欢的宝贝吧！</dd>
            </dl>
            <a href="/" class="no-data-btn">逛一逛</a>
        </div>
    @endif

</div>