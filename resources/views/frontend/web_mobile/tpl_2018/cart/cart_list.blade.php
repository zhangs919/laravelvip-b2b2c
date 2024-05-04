@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/flow.css?v=20180702"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 引入头部文件 -->
    <div class="header">
        <div class="header-left">
            <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                <i class="iconfont">&#xe606;</i>
            </a>
        </div>
        <div class="header-middle">购物车</div>
        <div class="header-right text-align-right ">
            <!-- <a href="javascript:void(0)" class="batch_delet text" id="batch_delet" data-id="0"></a> -->
            <a href="javascript:void(0)" class="text" id="cart_manage_btn" data-type="0">管理</a>
        </div>
    </div>
    <!-- 待付款订单列表 start -->
    <!-- 待付款订单列表 end -->
    {{--引入列表--}}
    @include('cart.partials._cart_list')
    
    <section class="mask-div"></section>
    
    {{--猜你喜欢--}}
    @if(!empty($guess_like_goods))
    <div class="recommend-wrapper">
        <div class="recommend-title color"><i class="iconfont icon-xinshixin"></i>猜你喜欢</div>
        <ul class="product-list clearfix">
            @foreach($guess_like_goods as $v)
            <li class="item">
                <div class="inner GO-GOODS-LINK" data-goods_url="{{ route('mobile_show_goods', ['goods_id'=>$v['goods_id']]) }}">
                    <div class="item-pic">
                        <img class="" src="{{ get_image_url($v['goods_image']) }}" alt="{{ $v['goods_name'] }}">
                    </div>
                    <div class="item-info">
                        <h3 class="name">{{ $v['goods_name'] }}</h3>
                        <div class="price-box">
                            <div class="price">
                                <i class="price-color">￥{{ $v['goods_price'] }}</i>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div style="height: 2.2rem; line-height: 2.2rem; clear: both;"></div>


    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')

    <!-- 第三方流量统计 -->
    <div style="display: none;">
    </div>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/tabs.js"></script>
    <script src="/js/cart.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script>

        if ($("#cart_manage_btn").attr('data-type') == 1) {
            $("#cart_count").addClass('hide');
            $("#cart_manage").removeClass('hide');
        } else {
            $("#cart_count").removeClass('hide');
            $("#cart_manage").addClass('hide');
        }
        //
        var shop_id = '0';
        var num = $(".no_pay_list").height() + 180;
        $(".no-data-div").css('top', num);
        //
        $().ready(function() {
            $('body').on('click', '.num', function() {
                $(this).parent('.goods-num').find('.edit-quantity-mask').show();
                if ($(this).val() > 0) {
                    $(this).parent('.goods-num').find('.edit-quantity-mask').find('input[type="number"]').val($(this).val());
                }
                $(this).parent('.goods-num').find('.edit-quantity-mask').find('input[type="number"]').focus();
            });
            $('body').on('click', '.edit-quantity-mask', function() {
                $(this).hide();
            });
            $('body').on('touchmove', '.edit-quantity-mask', function(e) {
                event.stopPropagation();
            });
            $('body').on('click', '.edit-quantity-mask .edit-quantity-con', function(e) {
                e.stopPropagation();
            })
            $('body').on('click', '.GO-INFO', function() {
                var url = $(this).data('goods_url');
                $.go(url);
            });
            // 结算商品提示
            $('.select-goods-box .close-btn').click(function(){
                $('.select-goods-box').hide();
            })
        });
        //
        var scrollheight = 0;
        function select_coupon() {
            $("#select_coupon").animate({
                height: '80%'
            }, [10000]);
            var total = 0, h = $(window).height(), top = $('.discount-coupon h2').innerHeight() || 0, con = $('.coupon-list');
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
        //
    </script>
@stop