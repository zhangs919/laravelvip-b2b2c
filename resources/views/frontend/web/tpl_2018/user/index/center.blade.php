@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <!-- 动态登录，设置密码 star -->
        <script src="/frontend/js/user_center.js?v=20180528"></script>
        <div class="set-password" style="display: none">
            您尚未设置登录密码，赶快去
            <a href="/user/security/edit-password" target="_self" title="前往去设置登录密码">设置密码</a>
            吧！
        </div>
        <!-- 动态登录，设置密码 end -->
        <div class="con-right-left fl">
            <div class="user-info">
                <!-- 我的账户相关信息 star -->
                <div class="myInfo">
                    <!-- 弹出 star -->
                    <div class="tipsBox">
                        <div class="myGrade">
                            <h3>我的等级信息</h3>
                            <p>当前等级：{{ $user_rank_info['rank_name'] }}</p>
                            <p>
						<span>
							我的成长值：
							<a href="/user/growth-value" class="second-color" target="_self">{{ $user_info->rank_points ?? 0 }}</a>
						</span>

                                <span>
							再积累
							<font class="second-color">{{ $user_rank_info['less_exppoints'] }}</font>
							成长值即可升级至 {{ $user_rank_info['downrank_name'] }}
						</span>

                            </p>
                        </div>
                        <div class="myAccount">
                            <h3>我的账户信息</h3>
                            <p>
                                个人信息：未完善，请
                                <a href="/user/profile" target="_self" class="btn-link">尽快完善</a>
                            </p>
                            <p>
                                实名认证：未完善，请
                                <a href="/user/profile" target="_self" class="btn-link">尽快完善</a>
                            </p>
                            <p>
                                @if(!empty($user_info->mobile_validated))
                                    <span>手机：{{ hide_tel($user_info->mobile) }}</span>
                                @endif
                                @if(!empty($user_info->surplus_password))
                                    <span>支付密码：已开启<a href="/user/security/edit-surplus-password" target="_self" class="btn-link">修改密码</a></span>
                                @else
                                    <span>支付密码：<a href="/user/security/edit-surplus-password" target="_self" class="btn-link">立即开启</a></span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- 弹出 end -->

                    <div class="myInfoFront">
                        <div class="imgHeaderBox">
                            <a href="" class="headerImg">

                                <img src="{{ get_image_url(sysconf('default_user_portrait')) }}">

                            </a>
                            <div class="updateInfo">
                                <div class="opacityBox"></div>
                                <a href="/user/profile" class="realBox">修改资料</a>
                            </div>
                        </div>
                        <p class="name">
                            <a href="">

                                <!---->
                                {{ $user_info->user_name }}
                                <!---->

                            </a>
                        </p>
                        <p class="VIP">
                            <a href="/user/growth-value.html" target="_blank" class="imgVip imgVip{{ $user_rank_info['level'] }}">
                                <img src="{{ get_image_url($user_rank_info['rank_img']) }}" />
                            </a>
                            <a href="/user/growth-value.html" target="_blank" class="txtExplain">{{ $user_rank_info['rank_name'] }}</a>
                        </p>
                        <a href="/user/security.html" class="safeText">账户安全</a>
                        <span class="safeGrade">低</span>
                        <div class="progressBar">
                            <span class="progress progress{{ $user_info->security_level ?? 1 }}"></span>
                        </div>
                        <p class="safe-grade-info">
                            {{--邮箱绑定--}}
                            @if(!empty($user_info->email))
                                <span class="email">
                                    <a href="/user/security/edit-email.html" title="邮箱已绑定">
                                        <i class="iconfont">&#xe6bd;</i>
                                        已绑定
                                    </a>
                                </span>
                            @else
                                <span class="email">
                                    <a href="/user/security/edit-email.html" title="邮箱未绑定">
                                        <i class="iconfont">&#xe6bd;</i>
                                        未绑定
                                    </a>
                                </span>
                            @endif

                            {{--手机绑定--}}
                            @if(!empty($user_info->mobile))
                                <span class="phone">
                                    <a href="/user/security/edit-mobile.html" title="手机已绑定">
                                        <i class="iconfont">&#xe692;</i>
                                        已绑定
                                    </a>
                                </span>
                            @else
                                <span class="phone">
                                    <a href="/user/security/edit-mobile.html" title="手机未绑定">
                                        <i class="iconfont">&#xe692;</i>
                                        未绑定
                                    </a>
                                </span>
                            @endif
                            {{--支付密码--}}
                            @if(!empty($user_info->surplus_password))
                                <span class="pay-password">
                                    <a href="/user/security/edit-surplus-password.html" title="支付密码已开启">
                                        <i class="iconfont">&#xe6be;</i>
                                        已开启
                                    </a>
                                </span>
                            @else
                                <span class="pay-password">
                                    <a href="/user/security/edit-surplus-password.html" title="支付密码未开启">
                                        <i class="iconfont">&#xe6be;</i>
                                        未开启
                                    </a>
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- 我的账户相关信息 end -->
                <!-- 我的账户财产以及订单 star -->
                <div class="myCapital">
                    <div class="money">
                        <ul class="clearfix">
                            <li class="first">
                                <div class="title">
                                    <span>我的余额</span>
                                </div>

                                <div class="pic">
                                    <a href="/user/capital-account.html" title="我的余额">
                                        <i class="user_bg"></i>
                                    </a>
                                </div>
                                <p>
                                    <!-- <a href="javascript:show_surplus(26)">
                                        <span id="surplus_div">显示余额</span>
                                    </a> -->
                                    <a href="/user/capital-account.html">￥0.00</a>
                                </p>
                            </li>
                            <li class="second">
                                <div class="title">
                                    <span>我的成长值</span>
                                </div>
                                <div class="pic">
                                    <a href="/user/growth-value.html" title="我的成长值">
                                        <i class="user_bg"></i>
                                    </a>
                                </div>
                                <p>

                                    <a href="/user/growth-value.html">{{ $user_info->rank_points }}</a>
                                </p>
                            </li>
                            <li class="third">
                                <div class="title">
                                    <span>我的红包</span>
                                </div>
                                <div class="pic">
                                    <a href="/user/bonus.html" title="我的红包">
                                        <i class="user_bg"></i>
                                    </a>
                                </div>
                                <p>
                                    <a href="/user/bonus.html">2张</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="pending">
                        <ul>
                            <li class="first">
                                <a href="/user/order/list?type=unpayed" target="_self">
                                    待付款
                                    <font class="second-color">0</font>
                                </a>
                            </li>
                            <li>
                                <a href="/user/order/list?order_status=unshipped" target="_self">
                                    待发货
                                    <font class="second-color">0</font>
                                </a>
                            </li>
                            <li>
                                <a href="/user/order/list?order_status=shipped" target="_self">
                                    待收货
                                    <font class="second-color">0</font>
                                </a>
                            </li>
                            <li>
                                <a href="/user/order/list?evaluate_status=unevaluate" target="_self">
                                    待评价
                                    <font class="second-color">0</font>
                                </a>
                            </li>
                            <li>
                                <a href="/user/order/list?order_status=backing" target="_self">
                                    退款
                                    <font class="second-color">0</font>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- 我的账户财产以及订单 end -->
            </div>
            <div class="container">
                <ul class="tabs">
                    <li>
                        <h3>
                            <a href="#tab1">商品收藏</a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="#tab2">店铺收藏</a>
                        </h3>
                    </li>
                </ul>
                <!-- 根据tab切换来判断查看更多的href,title的值 star -->
                <a href="/user/collect/goods.html" target="_self" title="查看全部收藏的商品" class="more">查看更多</a>
                <!-- 根据tab切换来判断查看更多的href,title的值 end -->
                <div class="tab-container">
                    <div id="tab1" class="model tab-con collect-goods">
                        <div class="model-con">


                            <!-- *商品收藏数量为0时 start-->
                            <div class="empty">
                                <i class="collect-goods-bg"></i>
                                <span>
                                    您还没有收藏任何商品，赶快
                                    <a href="{{ route('pc_home') }}" title="网站首页" target="_blank">去看看</a>
                                    吧！
                                </span>
                            </div>
                            <!-- *商品收藏数量为0时 end-->

                            <!-- -->
                        </div>
                    </div>
                    <div id="tab2" class="model tab-con collect-shop">
                        <div class="model-con">

                            <!-- *店铺收藏数量为0时 start-->
                            <div class="empty">
                                <i class="collect-shop-bg"></i>
                                <span>
                                    您还没有收藏任何店铺，赶快
                                    <a href="{{ route('pc_shop_street') }}" title="店铺街" target="_blank">去看看</a>
                                    吧！
                                </span>
                            </div>
                            <!-- *店铺收藏数量为0时 end-->
                            <!-- -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- 根据浏览，猜您喜欢 star -->
            <!-- 根据浏览，猜您喜欢 end -->
        </div>
        <div class="con-right-right fr">
            <!-- 商城公告 star -->
            <div class="model shop-notice" style="display: none">
                <h3>
                    <i class="bg-color"></i>
                    <span>商城公告</span>
                </h3>
                <div class="notice-con">用户中心公告！双十一大促销！因可能存在系统缓存、页面更新导致价格变动异常等不确定性情况出现，如您发现活动商品标价或促销信息有异常，请您立即联系我们，以便我们及时补正！</div>
            </div>
            <!-- 商城公告 end -->
            <!-- 我的购物车 star -->
            <div class="model model-spe cart">
                <h3>
                    <i class="bg-color"></i>
                    <span>我的购物车</span>
                </h3>
                <div class="model-con">
                    @if(!$user_cart_list->isEmpty())
                        <div>
                            <ul>

                                @foreach($user_cart_list as $v)
                                    <!-- -->
                                    <li>

                                        <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" title="{{ $v->goods_name }}" target="_blank" class="img">
                                            <img src="{{ get_image_url($v->goods->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="{{ $v->goods_name }}" />
                                        </a>
                                        <p class="price">￥{{ $v->goods_price }}</p>
                                    </li>
                                @endforeach


                            </ul>
                            <div class="see-all">
                                <a href="/cart.html" target="_blank">
                                    查看购物车(
                                    <em class="second-color">{{ $user_cart_num }}</em>
                                    )
                                </a>
                            </div>
                        </div>
                    @else
                    <!-- *购物城中商品数量为0时 start-->
                        <div class="empty">
                            <i class="cart-bg"></i>
                            <span>
                                您的购物车中还没有商品，赶快
                                <a href="{{{ route('pc_home') }}}" title="网站首页" target="_blank">去看看</a>
                                吧！
                            </span>
                        </div>
                        <!-- *购物城中商品数量为0时 end-->
                    @endif

                </div>
            </div>
            <!-- 我的购物车 end -->
            <!-- 我的足迹 star -->
            <div class="model model-spe history">
                <h3>
                    <i class="bg-color"></i>
                    <span>我的足迹</span>
                </h3>
                <div class="model-con">
                    <!---->
                    <!-- *积分兑换的商品数量为0时 end-->

                    @if(!$goods_history->isEmpty())
                        <div>
                            <ul>
                                @foreach($goods_history as $v)
                                    <li>
                                        <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" title="{{ $v->goods_name }}" target="_blank" class="img">
                                            <img src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="{{ $v->goods_name }}" />
                                        </a>
                                        <p class="price">￥{{ $v->goods_price }}</p>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="see-all">
                                <a href="/user/history.html" target="_blank">
                                    查看全部(
                                    <em class="second-color">{{ $goods_history_total }}</em>
                                    )
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="empty">
                            <i class="history-bg"></i>
                            <span>
                                还没有留下任何足迹，赶快
                                <a href="{{ route('pc_home') }}" title="去逛逛" target="_blank">去逛逛</a>
                                吧！
                            </span>
                        </div>
                    @endif

                    <!---->
                </div>
            </div>
            <!-- 我的足迹 end-->
        </div></div>

@endsection