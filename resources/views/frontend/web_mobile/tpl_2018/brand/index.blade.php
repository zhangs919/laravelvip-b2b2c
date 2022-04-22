@extends('layouts.base')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20181123"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20181123"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20181123"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20181123"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20181123"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20181123"></script>
    <script src="/js/common.js?v=20181123"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20181123"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20181123"></script>
    <!-- 飞入购物车 -->
    <script src="/js/jquery.fly.min.js?v=20181123"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20181123"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <link rel="stylesheet" href="/css/swiper.min.css?v=2018112301"/>
        <link rel="stylesheet" href="/css/brand.css?v=2018112301"/>
        <script src="/js/jquery-1.9.1.min.js?v=20181123"></script>
        <script src="/js/swiper.jquery.min.js?v=20181123"></script>
        <div class="sort-menu ">
            <ul class="all-brands swiper-wrapper">
                <li class="active swiper-slide"><a href="javascript:void(0);">全部品牌</a></li>

                @foreach($cat_list as $v)
                    <li class="swiper-slide"><a href="javascript:void(0);">{{ $v['cat_name'] }}</a></li>
                @endforeach

            </ul>
        </div>
        <div class="brand-floor-con">

            @foreach($cat_list as $v)
                <div class="brand-floor">
                    <a href="{{ route('mobile_goods_list', ['cat_id'=>$v['cat_id']]) }}" class="brand-floor-title">{{ $v['cat_name'] }}</a>
                    <ul>

                        @foreach($v['brand_list'] as $brand)
                        <li>
                            <a href="{{ route('mobile_goods_list', ['filter_str' => $v['cat_id'].'-0-0-0-0-0-0-0-0-0-0-'.$brand['brand_id']]) }}" class="brand-con">
                                <div class="brand-img">
                                    <img src="{{ $brand['brand_logo'] }}">
                                </div>
                                <div class="brand-name">{{ $brand['brand_name'] }}</div>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>
            @endforeach

        </div>
        <script src="/js/brand.js?v=20181123"></script>

        {{--引入底部菜单--}}
        @include('frontend.web_mobile.modules.library.site_footer_menu')

    </div>
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
    <script type="text/javascript">
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
    </script>

@stop