<!-- 站点选择 -->
<div class="header-top">
    <div class="header-box">






        <!-- 站点 -->
        @if(sysconf('site_open'))
            <!--站点 start-->
            <div class="SZY-SUBSITE"><!--站点 start-->
                <div class="SZY-SUBSITE">


                    <ul class="fl">
                        <li class="dorpdown" id="city-choice">
                            <dt class="sc-icon">
                                <div class="sc-choie">
                                    <i class="iconfont color"></i>
                                    <span class="ui-areamini-text" data-id="2" title="">开州区&nbsp;&nbsp;&nbsp;</span>
                                </div>
                                <div class="dd-spacer"></div>
                            </dt>
                            <dd class="dorpdown-layer">
                                <div class="ui-areamini-content-wrap" id="ui-content-wrap">
                                    <!--当站点少的活，以dl下展示形式展示，如果展示多的话，以ul下的li展示形式展示-->

                                    <dl>
                                        <dt>站点</dt>


                                        <dd>
                                            <a href="/subsite/index.html?site_id=1">北京站</a>
                                        </dd>

                                        <dd>
                                            <a href="/subsite/index.html?site_id=2">开州区</a>
                                        </dd>


                                    </dl>

                                </div>
                            </dd>
                        </li>
                    </ul>

                </div>
                <!--站点 end-->
            </div>
            <!--站点 end-->
        @endif


        <!-- 登录信息 -->
        <font id="login-info" class="login-info SZY-USER-NOT-LOGIN" style="@if(auth('user')->check())display: none;@endif">
            <!--<em>欢迎来到测试站点! </em>-->
            <a class="login color" href="/login.html" target="_top">请登录</a>
            <a class="register" href="/register.html" target="_top">免费注册</a>
        </font>
        <font id="login-info" class="login-info SZY-USER-ALREADY-LOGIN" style="@if(!auth('user')->check())display: none;@endif">
            <em>
                <a href="/user.html" target="_blank" class="color SZY-USER-NAME"></a>
                <!--欢迎您回来!-->
            </em>
            <a href="/site/logout.html" data-method="post">退出</a>
        </font>

        <ul>
            <li>
                <a class="menu-hd home" href="/" target="_top">
                    <i class="iconfont color">&#xe6a3;</i>
                    商城首页
                </a>
            </li>
            <li class="menu-item">
                <div class="menu">
                    <a class="menu-hd myinfo" href="/user.html" target="_blank">
                        <i class="iconfont color">&#xe6a5;</i>
                        我的商城
                        <b></b>
                    </a>
                    <div id="menu-2" class="menu-bd">
                        <span class="menu-bd-mask"></span>
                        <div class="menu-bd-panel">
                            <a href="/user/order.html" target="_blank">已买到的宝贝</a>
                            <a href="/user/address.html" target="_blank">我的地址管理</a>
                            <a href="/user/collect/goods.html" target="_blank">我收藏的宝贝</a>
                            <a href="/user/collect/shop.html" target="_blank">我收藏的店铺</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="menu-item cartbox">
                <div class="menu">
                    <a class="menu-hd cart" href="/cart.html" target="_top">
                        <i class="iconfont color">&#xe6a8;</i>
                        购物车
                        <span class="SZY-CART-COUNT">0</span>
                        <b></b>
                    </a>
                    <div id="menu-4" class="menu-bd cart-box-main">
                        <span class="menu-bd-mask"></span>
                        <div class="dropdown-layer">
                            <div class="spacer"></div>
                            <div class="dropdown-layer-con cartbox-goods-list">


                                <!-- 正在加载 -->
                                <div class="cart-type">
                                    <i class="cart-type-icon"></i>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a class="menu-hd" href="{{ route('seller_home') }}" target="_blank">卖家中心</a>
            </li>

            <li class="menu-item">
                <div class="menu">
                    <a class="menu-hd we-chat" href="javascript:;" target="_top">
                        <i class="iconfont color">&#xe6a4;</i>
                        关注商城
                        <b></b>
                    </a>
                    <div id="menu-5" class="menu-bd we-chat-qrcode">
                        <span class="menu-bd-mask"></span>
                        <a target="_top">
                            <img src="{{ get_image_url(sysconf('mall_wx_qrcode')) }}" alt="官方微信" />
                        </a>
                        <p class="font-14">关注官方微信</p>
                    </div>
                </div>
            </li>


            <li class="menu-item">
                <div class="menu">
                    <a class="menu-hd mobile" href="javascript:;" target="_top">
                        <i class="iconfont color">&#xe60b;</i>
                        手机版
                        <b></b>
                    </a>
                    <div id="menu-6" class="menu-bd qrcode">
                        <span class="menu-bd-mask"></span>
                        <a target="_top">
                            <img src="{{ get_image_url(sysconf('mall_wx_qrcode')) }}" alt="手机客户端" />
                        </a>
                        <p>手机客户端</p>
                    </div>
                </div>
            </li>


            <li class="menu-item">
                <div class="menu">
                    <a href="javascript:;" class="menu-hd site-nav">
                        商家支持
                        <b></b>
                    </a>
                    <div id="menu-7" class="menu-bd site-nav-main">
                        <span class="menu-bd-mask"></span>
                        <div class="menu-bd-panel">
                            <div class="site-nav-con">

                                <a href="/article/list/1.html" target="_blank"  title="新手上路">新手上路</a>

                                <a href="/article/list/3.html" target="_blank"  title="配送服务">配送服务</a>

                                <a href="/article/list/5.html" target="_blank"  title="商家合作">商家合作</a>

                                <a href="/shop/street/index.html" target="_blank"  title="店铺街">店铺街</a>

                            </div>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
    //         if ($(".search-li-top.curr").attr('num') == 0) {
    //             var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
    //
    //             var keywords = $(keyword_obj).val();
    //             if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
    //                 keywords = $(keyword_obj).data("searchwords");
    //             }
    //             $(keyword_obj).val(keywords);
    //         }
    //         $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
    //     });
    // });
</script>