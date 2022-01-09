@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/mobile/css/user.css?v=20180702"/>
@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/yii.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/mobile/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <script src="/mobile/js/user.js?v=20180813"></script>
    <script src="/mobile/js/address.js?v=20180813"></script>
    <script src="/mobile/js/center.js?v=20180813"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20180813"></script>
@stop

@section('content')

    <div class="member-header-box" @if(!empty(sysconf('m_user_center_bgimage')))style=" background: url({{ get_image_url(sysconf('m_user_center_bgimage')) }}) center bottom no-repeat; background-size: cover;"@endif>
        <div class="member-header-hd ub">
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
        <div class="member-header-right">
            <a href="/user/profile.html" class="member-set"></a>
            <a href="/user/message/internal.html" class="member-message"></a>
        </div>
        <a class="membership-code" href="/user/scan-code/index.html">
            <i></i>
        </a>
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
                        <i class="iconfont">&#xe673;</i>
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
                    </div>
                    <span>待发货</span>
                </a>
            </li>
            <li>
                <a href="/user/order/list.html?order_status=shipped">
                    <div class="user_order">
                        <i class="iconfont">&#xe671;</i>
                        <!-- -->
                    </div>
                    <span>待收货</span>
                </a>
            </li>
            <li>
                <a href="/user/order/list.html?evaluate_status=unevaluate">
                    <div class="user_order">
                        <i class="iconfont">&#xe672;</i>
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
    <!--我的资产-->
    <div class="wallet-list-box">
        <h3 class="wallet-list-title">我的钱包</h3>
        <ul class="bdr-top ub">
            <li class="ub-f1">
                <a href="/user/capital-account.html">
                    <em id="surplus_div" class="color">{{ $user_info->user_money_limit ?? 0 }}元</em>
                    <span>余额</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/integral.html">
                    <em class="color SZY-PAY-POINT">0</em>
                    <span>积分</span>
                </a>
            </li>
            <li class="ub-f1">
                <a href="/user/bonus.html">
                    <em class="color">4</em>
                    <span>红包</span>
            </li>
            <li class="ub-f1">
                <a href="/user/scan-code/index.html">
                    <em>
                        <img src="/mobile/images/user/btn_payment.png">
                    </em>
                    <span>付款</span>
                </a>
            </li>
        </ul>
        <div class="wallet-ft bdr-bottom ub">
            <a class="ub-f1 bdr-r" href="/user/recharge-card.html"><em class="icon"></em><span>储值卡</span></a>
            <a class="ub-f1" href="/user/order/list.html?is_gift=1"><em class="icon"></em><span>提货券</span></a>
        </div>
    </div>
    <!--用户菜单-->
    <div class="member-nav">
        <h2 class="member-nav-title">我的工具箱</h2>
        <div class="member-nav-con bdr-top">
            <a href="/user/member-card.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_membership_card.png">
                </div>
                <p class="nav-text">我的权益</p>
            </a>


            <a href="/user/history.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_history_record.png">
                </div>
                <p class="nav-text">我的足迹</p>
            </a>
            <a href="/user/collect/goods.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_goods_collection.png">
                </div>
                <p class="nav-text">我的收藏</p>
            </a>

            <a href="/user/groupon.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_groupon.png">
                </div>
                <p class="nav-text">我的拼团</p>
            </a>

            <a href="/user/order/bill-list.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_user_buylist.png">
                </div>
                <p class="nav-text">常购清单</p>
            </a>
            <a href="/user/evaluate/index.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_review.png">
                </div>
                <p class="nav-text">我的评价</p>
            </a>

            <a href="/user/bargain.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_bargain.png">
                </div>
                <p class="nav-text">我的砍价</p>
            </a>


            <a href="/distributor/share.html?uid=26" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_popularize.png">
                </div>
                <p class="nav-text">我的推广</p>
            </a>


            <a href="/user/recommend.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_recommend.png">
                </div>
                <p class="nav-text">我的推荐</p>
            </a>



            <a href="/distributor/apply/check.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_distribution.png">
                </div>
                <p class="nav-text">申请微店主</p>
            </a>


            <a href="/shop/apply.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_bussiness_settled.png">
                </div>
                <p class="nav-text">商家入驻</p>
            </a>


            <a href="/user/recommend-shop.html" class="nav-item">
                <div class="nav-icon">
                    <img src="/mobile/images/user/btn_user_recommend.png">
                </div>
                <p class="nav-text">推荐店铺</p>
            </a>

        </div>
    </div>
    <a href="javascript:logout()" class="member-logout bdr-top bdr-bottom">退出登录</a>
    <div class="blank-div"></div>



    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')


    <script type="text/javascript">
        $().ready(function() {
            //show_surplus('26');
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
    <script src="/mobile/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>

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