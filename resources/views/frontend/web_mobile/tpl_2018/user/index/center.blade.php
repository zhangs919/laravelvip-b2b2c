@extends('layouts.user_layout')



@section('content')

    <!-- 设置背景图片 -->
    <div class="member-header-box">
        <div class="member-header-right">
            <a href="/user/profile.html" class="member-set"></a>
            <a href="/user/message/internal.html" class="member-message">

                <em class="color">{{ $no_read_count }}</em>

            </a>
        </div>
        <div class="member-header-hd">
            <div class="member-msg-wrap ub">
                <div class="avatar-img">

                    <img src="{{ get_image_url($info['user_info']['headimg'], 'headimg') }}">

                </div>
                <div class="member-msg ub-f1">
                    <div class="member-name">{{ $info['user_info']['user_name']  }}</div>
                    <div class="member-grade">
					<span>

						{{ $user_rank['rank_name'] }}
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
                    <strong>{{ $goods_collect_count }}</strong>
                    <span>收藏商品</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/collect/shop.html">
                    <strong>{{ $shop_collect_count }}</strong>
                    <span>关注店铺</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/collect/used.html">
                    <strong>0</strong>
                    <span>收藏信息</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/history.html">
                    <strong>{{ $goods_history_total }}</strong>
                    <span>足迹</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/evaluate/index.html">
                    <strong>{{ $goods_comment_count }}</strong>
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
                    <em id="surplus_div" class="color">{{ $info['user_info']['user_money_limit'] }}元</em>
                    <span>余额</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/bonus.html">
                    <em class="color">{{ $bonus_count }}</em>
                    <span>红包</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/integral.html">
                    <em class="color SZY-PAY-POINT">{{ $info['user_info']['pay_point'] }}</em>
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
<!--        <div class="wallet-nav ub">
            <a href="/user/rights-card/index.html" class="nav-item ub-f1">
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
        </div>-->
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
                        @if($order_counts['unpayed'] > 0)
                            <em class="bg-color">{{ $order_counts['unpayed'] }}</em>
                        @endif
                    </div>
                    <span>待付款</span>
                </a>
            </li>
            <li>
                <a href="/user/order/list.html?order_status=unshipped">
                    <div class="user_order">
                        <i class="iconfont">&#xe675;</i>
                        <!-- -->
                        @if($order_counts['unshipped'] > 0)
                            <em class="bg-color">{{ $order_counts['unshipped'] }}</em>
                        @endif

                    </div>
                    <span>待发货</span>
                </a>
            </li>
            <li>
                <a href="/user/order/list.html?order_status=shipped">
                    <div class="user_order">
                        <i class="iconfont">&#xe671;</i>
                        <!-- -->
                        @if($order_counts['shipped'] > 0)
                            <em class="bg-color">{{ $order_counts['shipped'] }}</em>
                        @endif

                    </div>
                    <span>待收货</span>
                </a>
            </li>
            <li>
                <a href="/user/order/list.html?evaluate_status=unevaluate">
                    <div class="user_order">
                        <i class="iconfont">&#xe744;</i>
                        <!-- -->
                        @if($order_counts['unevaluate'] > 0)
                            <em class="bg-color">{{ $order_counts['unevaluate'] }}</em>
                        @endif
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


<!--            <a href="/user/sign-in/info.html" class="nav-item">
                <i class="iconfont sign-in-icon">&#xe6dc;</i>
                <span>签到</span>
            </a>

            <a href="/user/groupon.html" class="nav-item">
                <i class="iconfont groupon">&#xe6ad;</i>
                <span>我的拼团</span>
            </a>


            <a href="/user/bargain.html" class="nav-item">
                <i class="iconfont bargain">&#xe6b4;</i>
                <span>我的砍价</span>
            </a>



            <a href="/distributor/apply/check.html" class="nav-item">
                <i class="iconfont distribution">&#xe6ae;</i>
                <span>申请分销商</span>
            </a>


            <a href="/distributor/share.html?uid=2" class="nav-item">
                <i class="iconfont popularize">&#xe6b3;</i>
                <span>我的推广</span>
            </a>


            <a href="/user/recommend.html" class="nav-item">
                <i class="iconfont recommend">&#xe6b1;</i>
                <span>我的推荐</span>
            </a>-->


            <a href="/user/address.html" class="nav-item">
                <i class="iconfont address buylist">&#xe6bb;</i>
                <span>收货地址</span>
            </a>
<!--            <a href="/user/order/bill-list.html" class="nav-item">
                <i class="iconfont buylist">&#xe6b2;</i>
                <span>常购清单</span>
            </a>

            <a href="/user/recommend-shop.html" class="nav-item">
                <i class="iconfont recommend-shop">&#xe6b5;</i>
                <span>推荐店铺</span>
            </a>

            <a href="/user/store-card/list.html" class="nav-item">
                <i class="iconfont shopcard">&#xe6c7;</i>
                <span>我的卡包</span>
            </a>-->
        </div>
    </div>

    {{--todo--}}
    <!--我的同城 -->
    {{--<div class="member-nav">
        <h2 class="member-nav-title">我的同城</h2>
        <div class="member-nav-con bdr-top">

            <a href="/user/used-goods.html" class="nav-item">
                <i class="iconfont used-goods">&#xe6b9;</i>
                <span>二手物品</span>
            </a>


            <a href="/user/used-car.html" class="nav-item">
                <i class="iconfont used-car">&#xe6b8;</i>
                <span>二手车</span>
            </a>


            <a href="/user/used-house.html" class="nav-item">
                <i class="iconfont used-house">&#xe6ba;</i>
                <span>房屋租售</span>
            </a>

        </div>
    </div>--}}
    <a href="javascript:logout()" class="member-logout">退出登录</a>


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

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->

    {{--引入底部版权--}}
    @include('frontend.web_mobile.modules.library.copy_right')


    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=1.1"></script>
    <script src="/js/common.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/js/placeholder.js?v=1.1"></script>
    <script src="/js/user.js?v=1.1"></script>
    <script src="/js/address.js?v=1.1"></script>
    <script src="/js/center.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/message.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/messageWS.js?v=1.1"></script>
    <script>
        $().ready(function() {
            show_surplus('{{ $user_info['user_id'] ?? 0 }}');
            //ajax校验
            $.get('/integralmall/index/validate', function(result) {
                if (result.code == 0) {
                    $('.SZY-PAY-POINT').html(result.data);
                }
            }, 'json');
            $("body").on('click', ".apply_comstore", function() {
                var url = $(this).data("url");
                var mobile = $(this).data("mobile");
                if (mobile == '') {
                    //显示绑定手机号弹框
                    $.confirm("您的账号尚未绑定手机号，请绑定手机号后再申请团长！", function() {
                        $.go('/user/security/edit-mobile.html');
                    });
                } else {
                    $.go(url);
                }
            });
        });
        function logout() {
            $.confirm("您确定要退出登录吗?", function(sure) {
                if (sure) {
                    $.go('/site/logout.html');
                }
            });
        }
        //

        function currentUserId(){
            return '{{ $user_info['user_id'] ?? 0 }}';
        }
        function getIntegralName(){
            return '积分';
        }
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == currentUserId()) {
                    $.intergal({
                        point: ob.point,
                        name: getIntegralName()
                    });
                }
            }
        }
        //
        //
        function go_laravelvip() {
            if (window.__wxjs_environment !== 'miniprogram') {
                window.location.href = 'http://m.laravelvip.com/statistics.html?product_type=shop&domain=http://{{ config('lrw.mobile_domain') }}';
            } else {
                window.location.href = 'http://{{ config('lrw.mobile_domain') }}';
            }
        }
        function GetUrlRelativePath(){
            var url = document.location.toString();
            var arrUrl = url.split("//");
            var start = arrUrl[1].indexOf("/");
            var relUrl = arrUrl[1].substring(start);
            if(relUrl.indexOf("?") != -1){
                relUrl = relUrl.split("?")[0];
            }
            if(relUrl.indexOf(".htm") != -1){
                relUrl = relUrl.split(".htm")[0];
            }
            return relUrl;
        }
        var hide_list = ['/bill','/bill.html','/user/order/bill-list','/user/scan-code/index','/user/sign-in/info'];
        if($.inArray(GetUrlRelativePath(), hide_list) == -1){
            $('.copyright').removeClass('hide');
        }
    </script>
@stop
