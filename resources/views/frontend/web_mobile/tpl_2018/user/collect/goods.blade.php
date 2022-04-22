@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <script src="/js/jquery.rotate.min.js?v=20190121"></script>

    <div class="fixed-header">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="/user.html" title="返回"></a>
            </div>
            <div class="header-middle">收藏商品</div>

            <div class="header-right">
                <a class="goods_edit_btn text" href="javascript:void(0);">编辑</a>
            </div>

        </div>
        <div class="tabmenu">
            <ul>
                <li class="cur">
                    <a href="/user/collect/goods.html" class="SYZ_COLLECT_GOODS_COUNT">商品({{ $goods_collect_count }})</a>
                </li>
                <li>
                    <a href="/user/collect/shop.html" class="SYZ_COLLECT_SHOP_COUNT">店铺({{ $shop_collect_count }})</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="content-info"></div>

    <div class="shopcar cartbox">
        <a href="/cart.html">
            <span class="flow-cartnum SZY-CART-COUNT bg-color">0</span>
        </a>
    </div>


    <script type='text/javascript'>
        $('.tabmenu ul li a').click(function() {
            $(this).parents('li').addClass('cur').siblings().removeClass('cur');
        });
        $(document).ready(function() {
            $.loading.start();
            $.ajax({
                type: 'GET',
                url: '/user/collect/goods?tab=goods_list',
                dataType: 'json',
                success: function(result) {
                    $.loading.stop();
                    $(".content-info").html(result.data);
                }
            });
        })
    </script>

    <script type="text/javascript">
        $().ready(function() {
        })
    </script>
    <script src="/js/jquery.fly.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20190121"></script>

    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->

@stop