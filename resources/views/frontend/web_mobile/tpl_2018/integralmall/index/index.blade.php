@extends('layouts.base')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
    <script src="/js/common.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180919"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180919"></script>
    <!-- 飞入购物车 -->
    <script src="/js/jquery.fly.min.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180919"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <link rel="stylesheet" href="/css/exchange.css?v=20180927"/>
        <header>
            <div class="tab_nav">
                <div class="header">
                    <div class="header-left">
                        <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                            <i class="iconfont"></i>
                        </a>
                    </div>
                    <div class="header-middle">积分商城</div>
                    <div class="header-right">
                        <aside class="show-menu-btn">
                            <div class="show-menu" id="show_more">
                                <a href="javascript:void(0)">
                                    <i class="iconfont"></i>
                                </a>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </header>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
        <!--轮播图-->

        <!--菜单-->
        <nav class="nav-list nav-col04-list">
            <ul>
                <li>
                    <a href="/">
                        <img src="/images/exchange/index_icon.png">
                        <span>商城首页</span>
                    </a>
                </li>
                <li>
                    <a href="/integralmall.html?sort=&order=&is_self=&can_exchange=1">
                        <img src="/images/exchange/exchange_icon.png">
                        <span>我可兑换</span>
                    </a>
                </li>
                <li>
                    <a href="/integralmall/index/bonus-list.html">
                        <img src="/images/exchange/coupons_icon.png">
                        <span>红包兑换</span>
                    </a>
                </li>
                <li>
                    <a href="/user/integral.html">
                        <img src="/images/exchange/user_exchange_icon.png">
                        <span>我的积分</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!--积分商品列表-->
        <div class="filter-nav ub">
            <a class="ub-f1 current" href="/integralmall.html?can_exchange=1">默认排序</a>
            <a class="ub-f1 " href="/integralmall.html?sort=1&order=desc&is_self=&can_exchange=">
                兑换量
                <b class="icon-order-DESCending"></b>
            </a>
            <a class="ub-f1 " href="/integralmall?sort=2&order=desc&is_self=&can_exchange=">
                积分值
                <b class="icon-order-DESCending"></b>
            </a>
            <a class="ub-f1 " href="/integralmall.html?sort=3&order=desc&is_self=&can_exchange=">
                上架时间
                <b class="icon-order-DESCending"></b>
            </a>
        </div>
        <div id="table_list">

            <ul class="list-grid tablelist-append">

                @foreach($list as $v)
                <li>
                    <div class="item">
                        <a class="item-pic" href="/integralmall/goods-{{ $v['goods_id'] }}.html" style="background: url() no-repeat center center" target="_blank">
                            <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">

                        </a>

                        <div class="item-info">
                            <a class="item-name" href="/integralmall/goods-{{ $v['goods_id'] }}.html">{{ $v['goods_name'] }}</a>
                            <p class="item-time">
                                @if($v['is_limit'] == 0)
                                    无时间条件限制
                                @elseif($v['is_limit'] == 1)
                                    有效期: {{ $v['start_time'] }} 至 {{ $v['end_time'] }}
                                @endif
                            </p>
                            <div class="item-exchange">
						<span class="sale-exchange">
							{{ $v['goods_integral'] }}
							<em>积分</em>
						</span>
                                <span class="sale-count">已兑换{{ $v['exchange_number'] }}次</span>
                            </div>
                            <div class="item-footer">

                                <a class="item-shop" href="/shop/{{ $v['shop_id'] }}.html">{{ $v['shop_name'] }}</a>

                                <a href="javascript:void(0)" data-goods_id="{{ $v['goods_id'] }}" data-goods_number="{{ $v['goods_number'] }}" data-diff="{{ $v['diff'] }}" class="on-exchange goods-exchange disabled">立即兑换</a>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
            <!-- 分页 -->
            <!-- 分页 -->
            <div id="pagination" class="page">
                <div class="more-loader-spinner">

                    <div class="is-loaded">
                        <div class="loaded-bg">我是有底线的</div>
                    </div>

                </div>
                <script data-page-json="true" type="text" id="page_json">
                    {!! $json_page !!}
                </script>
            </div>

        </div>

        {{--引入底部菜单--}}
        @include('frontend.web_mobile.modules.library.site_footer_menu')

        <script src="/assets/d2eace91/js/szy.page.more.js?v=20180919"></script>
        <script type="text/javascript">
            $().ready(function() {
                tablelist = $("#table_list").tablelist();

                // 立即兑换
                $("body").on("click", ".goods-exchange", function() {

                    $.go('/login.html');

                });

                //ajax校验
                $.get('/integralmall/index/validate', function(result) {

                    if (result.code == 0) {
                        // 校验成功
                    }
                }, 'json');
            });
        </script>
        <script type="text/javascript">
            // 滚动加载数据
            $(window).on('scroll', function() {
                if (($(document).scrollTop() + $(window).height() + 10) > $(document).height()) {
                    $.pagemore({
                        callback: function(result) {
                            $.imgloading.loading();
                        }
                    });
                }
            });
        </script>

    </div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
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