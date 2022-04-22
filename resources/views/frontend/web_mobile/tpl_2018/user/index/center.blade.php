@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20180702"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 设置背景图片 -->
    <div class="member-header-box">
        <div class="member-header-right">
            <a href="/user/profile.html" class="member-set"></a>
            <a href="/user/message/internal.html" class="member-message">

                <em class="color">5</em>

            </a>
        </div>
        <div class="member-header-hd">
            <div class="member-msg-wrap ub">
                <div class="avatar-img">

                    <img src="{{ get_image_url($user_info->headimg, 'headimg') }}">

                </div>
                <div class="member-msg ub-f1">
                    <div class="member-name">{{ $user_info->user_name }}</div>
                    <div class="member-grade">
					<span>
						
						{{ $user_rank_info['rank_name'] }}
					</span>

                    </div>
                </div>
            </div>
            <a class="membership-code" href="/user/scan-code/index.html">
                <i></i>
            </a>
        </div>
        <ul class="menber-header-bd ub">
            <li class="ub-f1">
                <a href="/user/collect/goods.html">
                    <strong>2</strong>
                    <span>收藏商品</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/collect/shop.html">
                    <strong>1</strong>
                    <span>关注店铺</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/history.html">
                    <strong>31</strong>
                    <span>足迹</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/evaluate/index.html">
                    <strong>0</strong>
                    <span>我的评价</span>
                </a>
            </li>
        </ul>
    </div>
    <!--我的资产-->
    <div class="wallet-list-box">
        <h3 class="wallet-list-title bdr-bottom">我的资产</h3>
        <ul class="ub">
            <li class="ub-f1">
                <a href="/user/capital-account.html">
                    <em id="surplus_div" class="color">{{ $user_info->user_money_limit ?? 0 }}元</em>
                    <span>余额</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/bonus.html">
                    <em class="color">3</em>
                    <span>红包</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/integral.html">
                    <em class="color SZY-PAY-POINT">0</em>
                    <span>积分</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/scan-code/index.html">
                    <em>
                        <i class="iconfont color">&#xe6a8;</i>
                    </em>
                    <span>付款</span>
                </a>
            </li>
        </ul>
        <div class="wallet-nav ub">
            <a href="/user/member-card.html" class="nav-item ub-f1">
                <i class="iconfont">&#xe6a9;</i>
                <span>我的权益</span>
            </a>
            <a href="/user/recharge-card.html" class="nav-item ub-f1">
                <i class="iconfont">&#xe6aa;</i>
                <span>我的储值卡</span>
            </a>
            <a href="/user/store-recharge-card.html" class="nav-item ub-f1">
                <i class="iconfont">&#xe6a5;</i>
                <span>我的购物卡</span>
            </a>
            <a href="/user/order/list.html?is_gift=1" class="nav-item ub-f1">
                <i class="iconfont">&#xe6a7;</i>
                <span>提货券</span>
            </a>
        </div>
    </div>
    <!--我的订单模块-->
    <div class="user-order-box">
        <dl>
            <a href="/user/order/list.html">
                <dt>
                    <strong>我的订单</strong>
                    <span>查看全部订单</span>
                </dt>
            </a>
        </dl>
        <ul class="bdr-top">
            <li>
                <a href="/user/order/list.html?order_status=unpayed">
                    <div class="user_order">
                        <i class="iconfont">&#xe6a4;</i>
                        <!-- -->
                    </div>
                    <span>待付款</span>
                </a>
            </li>
            <li>
                <a href="/user/order/list.html?order_status=unshipped">
                    <div class="user_order">
                        <i class="iconfont">&#xe675;</i>
                        <!-- -->
                        <!-- -->
                        <em class="bg-color">19</em>


                    </div>
                    <span>待发货</span>
                </a>
            </li>
            <li>
                <a href="/user/order/list.html?order_status=shipped">
                    <div class="user_order">
                        <i class="iconfont">&#xe671;</i>
                        <!-- -->
                        <!-- -->
                        <em class="bg-color">1</em>


                    </div>
                    <span>待收货</span>
                </a>
            </li>
            <li>
                <a href="/user/order/list.html?evaluate_status=unevaluate">
                    <div class="user_order">
                        <i class="iconfont">&#xe744;</i>
                        <!-- -->
                    </div>
                    <span>待评价</span>
                </a>
            </li>
            <li>
                <a href="/user/back.html">
                    <div class="user_order">
                        <i class="iconfont">&#xe6ac;</i>
                    </div>
                    <span>退款/售后</span>
                </a>
            </li>
        </ul>
    </div>
    <!--用户菜单-->
    <div class="member-nav">
        <h2 class="member-nav-title">我的工具箱</h2>
        <div class="member-nav-con bdr-top">




            <a href="/user/groupon.html" class="nav-item">
                <i class="iconfont groupon">&#xe6ad;</i>
                <span>我的拼团</span>
            </a>


            <a href="/user/bargain.html" class="nav-item">
                <i class="iconfont bargain">&#xe6b4;</i>
                <span>我的砍价</span>
            </a>


            <a href="/distrib.html" class="nav-item">
                <i class="iconfont distribution">&#xe6ae;</i>
                <span>我的公享会员</span>
            </a>



            <a href="/distributor/share.html?uid=2" class="nav-item">
                <i class="iconfont popularize">&#xe6b3;</i>
                <span>我的推广</span>
            </a>


            <a href="/user/recommend.html" class="nav-item">
                <i class="iconfont recommend">&#xe6b1;</i>
                <span>我的推荐</span>
            </a>



            <a href="/user/address.html" class="nav-item">
                <i class="iconfont address buylist">&#xe6bb;</i>
                <span>收货地址</span>
            </a>
            <a href="/user/order/bill-list.html" class="nav-item">
                <i class="iconfont buylist">&#xe6b2;</i>
                <span>常购清单</span>
            </a>

            <a href="/user/recommend-shop.html" class="nav-item">
                <i class="iconfont recommend-shop">&#xe6b5;</i>
                <span>推荐店铺</span>
            </a>

        </div>
    </div>
    <a href="javascript:logout()" class="member-logout bdr-top bdr-bottom">退出登录</a>
    <div class="blank-div"></div>

    
    
    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')

    
    <script type="text/javascript">
        $().ready(function() {
            //show_surplus('2');
            //ajax校验
            $.get('/integralmall/index/validate', function(result) {
                if (result.code == 0) {
                    $('.SZY-PAY-POINT').html(result.data);
                }
            }, 'json');
        });
        function logout() {
            $.confirm("您确定要退出登录吗?", function(sure) {
                if (sure) {
                    window.location.href = '/site/logout.html'
                }
            });

        }
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