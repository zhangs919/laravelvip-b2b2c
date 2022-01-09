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
    <script src="/mobile/js/common.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180919"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180919"></script>
    <!-- 飞入购物车 -->
    <script src="/mobile/js/jquery.fly.min.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180919"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <link rel="stylesheet" href="/mobile/css/exchange.css?v=20180927"/>
        <header>
            <div class="tab_nav">
                <div class="header">
                    <div class="header-left">
                        <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
                    </div>
                    <div class="header-middle">积分商城</div>
                    <div class="header-right">
                        <aside class="show-menu-btn">
                            <div class="show-menu" id="show_more">
                                <a href="javascript:void(0)"></a>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </header>
        <div class="show-menu-info" id="menu">
            <ul>
                <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
                <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
                <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
                <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
            </ul>
        </div>
        <!--轮播图-->

        <!--菜单-->
        <nav class="nav-list nav-col04-list">
            <ul>
                <li>
                    <a href="/index.html">
                        <img src="/mobile/images/exchange/index_icon.png">
                        <span>商城首页</span>
                    </a>
                </li>
                <li>
                    <a href="/integralmall.html?sort=&order=&is_self=&can_exchange=1">
                        <img src="/mobile/images/exchange/exchange_icon.png">
                        <span>我可兑换</span>
                    </a>
                </li>
                <li>
                    <a href="/integralmall/index/bonus-list.html">
                        <img src="/mobile/images/exchange/coupons_icon.png">
                        <span>红包兑换</span>
                    </a>
                </li>
                <li>
                    <a href="/user/integral.html">
                        <img src="/mobile/images/exchange/user_exchange_icon.png">
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

                <li>
                    <div class="item">
                        <a class="item-pic" href="/integralmall/goods-11.html" style="background: url() no-repeat center center" target="_blank">
                            <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/15/gallery/2018/04/17/15239490849627.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">

                        </a>

                        <div class="item-info">
                            <a class="item-name" href="/integralmall/goods-11.html">积分兑换测试商品</a>
                            <p class="item-time">无时间条件限制</p>
                            <div class="item-exchange">
						<span class="sale-exchange">
							30
							<em>积分</em>
						</span>
                                <span class="sale-count">已兑换1次</span>
                            </div>
                            <div class="item-footer">

                                <a class="item-shop" href="/shop/15.html">阿迪达斯旗舰店</a>

                                <a href="javascript:void(0)" data-goods_id="11" data-goods_number="99" data-diff="-1" class="on-exchange goods-exchange disabled">立即兑换</a>
                            </div>
                        </div>
                    </div>
                </li>

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
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":1,"page_count":1,"offset":0,"url":null,"sql":null}
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