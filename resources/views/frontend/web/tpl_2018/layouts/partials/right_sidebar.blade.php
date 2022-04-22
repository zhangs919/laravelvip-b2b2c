<!-- 右侧边栏 _start -->
<div class="right-sidebar-con">
    <div class="right-sidebar-main">
        <div class="right-sidebar-panel">
            <div id="quick-links" class="quick-links">
                <ul>
                    <li class="quick-area quick-login sidebar-user-trigger">
                        <!-- 用户 -->
                        <a href="javascript:void(0);" class="quick-links-a">
                            <i class="iconfont">&#xe6cc;</i>
                        </a>
                        <div class="sidebar-user quick-sidebar">
                            <i class="arrow-right"></i>
                            <div class="sidebar-user-info">
                                <!-- 没有登录的情况 _start -->
                                <div class="SZY-USER-NOT-LOGIN" style="display: none;">
                                    <div class="user-pic">
                                        <div class="user-pic-mask"></div>
                                        <img src="{{ get_image_url(sysconf('default_user_portrait')) }}" />
                                    </div>
                                    <br />
                                    <p>
                                        你好！请
                                        <a href="javascript:void(0);" class="quick-login-a color ajax-login">登录</a>
                                        |
                                        <a href="/register.html" class="color">注册</a>
                                    </p>
                                </div>
                                <!-- 没有登录的情况 _end -->
                                <!-- 有登录的情况 _start -->
                                <div class="SZY-USER-ALREADY-LOGIN" style="display: none;">
                                    <div class="user-have-login">
                                        <div class="user-pic">
                                            <div class="user-pic-mask"></div>
                                            <img src="{{ get_image_url(sysconf('default_user_portrait')) }}" class="SZY-USER-PIC" />
                                        </div>
                                        <div class="user-info">
                                            <p>
                                                用&nbsp;&nbsp;&nbsp;户：
                                                <span class="SZY-USER-NAME"></span>
                                            </p>
                                            <p class="SZY-USER-RANK" style="display: none;">
                                                等&nbsp;&nbsp;&nbsp;级：
                                                <img class="SZY-USER-RANK-IMG" />
                                                <span class="SZY-USER-RANK-NAME"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="m-t-10">
				<span class="prev-login">
					上次登录时间：
					<span class="SZY-USER-LAST-LOGIN"></span>
				</span>
                                        <a href="/user.html" class="btn account-btn" target="_blank">个人中心</a>
                                        <a href="/user/order.html" class="btn order-btn" target="_blank">订单中心</a>
                                    </p>
                                </div>
                                <!-- 有登录的情况 _end -->
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-tabs">
                        <!-- 购物车 -->
                        <div class="cart-list quick-links-a sidebar-cartbox-trigger">
                            <i class="iconfont">&#xe6c5;</i>
                            <div class="span">购物车</div>
                            <span class="ECS_CARTINFO">
								<span class="cart_num SZY-CART-COUNT"></span>
								<div class="sidebar-cart-box">
									<h3 class="sidebar-panel-header">
										<a href="javascript:void(0);" class="title">
											<i class="cart-icon"></i>
											<em class="title">购物车</em>
										</a>
										<span class="close-panel"></span>
									</h3>
								</div>
							</span>
                        </div>
                    </li>
                    <li class="sidebar-tabs">
                        <a href="javascript:void(0);" class="mpbtn_history quick-links-a sidebar-historybox-trigger">
                            <i class="iconfont">&#xe76a;</i>
                        </a>
                        <div class="popup">
                            <font id="mpbtn_histroy">我看过的</font>
                            <i class="arrow-right"></i>
                        </div>
                    </li>
                    <!-- 如果当前页面有对比功能 则显示对比按钮 _start-->
                    <li class="sidebar-tabs">
                        <a href="javascript:void(0);" class="mpbtn-contrast quick-links-a sidebar-comparebox-trigger">
                            <i class="iconfont">&#xe8f8;</i>
                        </a>
                        <div class="popup">
                            对比商品
                            <i class="arrow-right"></i>
                        </div>
                    </li>
                    <!-- 如果当前页面有对比功能 则显示对比按钮 _end-->
                    <li>
                        <a href="/user/collect/shop.html" target="_blank" class="mpbtn_stores quick-links-a">
                            <i class="iconfont">&#xe6c8;</i>
                        </a>
                        <div class="popup">
                            我收藏的店铺
                            <i class="arrow-right"></i>
                        </div>
                    </li>
                    <li id="collectGoods">
                        <a href="/user/collect/goods.html" target="_blank" class="mpbtn_collect quick-links-a">
                            <i class="iconfont">&#xe6b3;</i>
                        </a>
                        <div class="popup">
                            我的收藏
                            <i class="arrow-right"></i>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="quick-toggle">
                <ul>

                    <li class="quick-area">
                        <a class="quick-links-a" href="javascript:void(0);">
                            <i class="iconfont">&#xe6ad;</i>
                        </a>
                        <div class="sidebar-service quick-sidebar">
                            <i class="arrow-right"></i>

                            <div class="customer-service">
                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ sysconf('mall_qq') }}&site=qq&menu=yes">
                                    <i class="iconfont color">&#xe6cd;</i>
                                    QQ
                                </a>
                            </div>


                            <div class="customer-service">
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ sysconf('mall_wangwang') }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <i class="iconfont color">&#xe6c4;</i>
                                    旺旺
                                </a>
                            </div>


                            <div class="customer-service">
                                <a href="javascript:void(0);" class="service-online">
                                    <i class="iconfont color">&#xe6ad;</i>
                                    在线客服
                                </a>
                            </div>

                        </div>
                    </li>


                    <li class="quick-area">
                        <a class="quick-links-a" href="javascript:void(0);">
                            <i class="iconfont qr-code">&#xe6bc;</i>
                        </a>
                        <div class="sidebar-code quick-sidebar">
                            <i class="arrow-right"></i>
                            <img src="{{ get_image_url(sysconf('mall_wx_qrcode')) }}" />
                        </div>
                    </li>

                    <li class="returnTop">
                        <a href="javascript:void(0);" class="return_top quick-links-a">
                            <i class="iconfont">&#xe6cb;</i>
                        </a>
                        <div class="popup">
                            返回顶部
                            <i class="arrow-right"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="">
            <!--红包 start-->
            <!--红包 end-->
            <!--购物车 start-->

            <div class="right-sidebar-panels sidebar-cartbox">
                <div class="sidebar-cart-box">
                    <h3 class="sidebar-panel-header">
                        <a href="javascript:void(0);" class="title" target="_blank">
                            <i class="cart-icon"></i>
                            <em class="title">购物车</em>
                        </a>
                        <span class="close-panel"></span>
                    </h3>
                    <div class="sidebar-cartbox-goods-list">

                        <div class="cart-panel-main">
                            <div class="cart-panel-content">

                                <!-- 没有商品的展示形式 _start -->
                                <div class="tip-box">
                                    <img src="/images/noresult.png" class="tip-icon" />
                                    <div class="tip-text">
                                        您的购物车里什么都没有哦
                                        <br />
                                        <a class="color" href="" title="再去看看吧" target="_blank">再去看看吧</a>
                                    </div>
                                </div>
                                <!-- 没有商品的展示形式 _end-->

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--购物车 end-->
            <!--浏览历史 start-->
            <!---->
            <div class="right-sidebar-panels sidebar-historybox">
                <h3 class="sidebar-panel-header">
                    <a href="javascript:;" class="title">
                        <i></i>
                        <em class="title">我的足迹</em>
                    </a>
                    <span class="close-panel"></span>
                </h3>
                <div class="sidebar-panel-main">
                    <div class="sidebar-panel-content sidebar-historybox-goods-list">
                        <!---->
                        <!---->
                        <!-- 没有浏览历史的展示形式 _start -->
                        <div class="tip-box">
                            <img src="/images/noresult.png" class="tip-icon" />
                            <div class="tip-text">
                                您还没有在商城留下任何足迹哦
                                <br />
                                <a class="color" href="./">赶快去看看吧</a>
                            </div>
                        </div>
                        <!-- 没有浏览历史的展示形式 _end-->
                        <!---->
                        <!---->
                    </div>
                </div>
            </div>
            <!---->
            <!--浏览历史 end-->
            <!--对比列表 start-->

            <!--对比列表 start-->
            <div class="right-sidebar-panels sidebar-comparebox">
                <h3 class="sidebar-panel-header">
                    <a href="javascript:void(0);" class="title">
                        <i class="compare-icon"></i>
                        <em class="title">宝贝对比</em>
                    </a>
                    <span class="close-panel"></span>
                </h3>
                <div>
                    <div class="sidebar-panel-main sidebar-comparebox-goods-list">

                        <div class="sidebar-panel-content compare-panel-content">

                            <!-- 没有对比商品的展示形式 _start -->
                            <div class="tip-box">
                                <img src="/images/noresult.png" class="tip-icon" />
                                <div class="tip-text">
                                    您还没有选择任何的对比商品哦
                                    <br />
                                    <a class="color" href="./">再去看看吧</a>
                                </div>
                            </div>
                            <!-- 没有对比商品的展示形式 _end-->

                        </div>
                    </div>


                </div>
            </div>
            <!--对比列表 end-->

            <!--对比列表 end-->
        </div>
    </div>
</div>
<!-- 右侧边栏 _end -->