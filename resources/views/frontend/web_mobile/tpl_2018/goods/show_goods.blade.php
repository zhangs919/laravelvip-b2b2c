@extends('layouts.base')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/mobile/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <!-- 飞入购物车 -->
    <script src="/mobile/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <link rel="stylesheet" href="/mobile/css/swiper.min.css?v=20180702"/>
        <link rel="stylesheet" href="/mobile/css/goods.css?v=20180702"/>
        <link rel="stylesheet" href="/mobile/css/bonus_message.css?v=20180702"/>
        <!-- 地区选择器 -->
        <script src="/assets/d2eace91/js/jquery.region.mobile.js?v=20180813"></script>
        <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
        <script src="/mobile/js/goods.js?v=20180813"></script>
        <script src="/mobile/js/swiper.jquery.min.js?v=20180813"></script>
        <div class="goods-header">
            <div class="goods-header-left">
                <a href="javascript:history.back(-1)"></a>
            </div>
            <ul class="goods-header-nav ub">
                <li class="cur ub-f1">商品</li>
                <li class="ub-f1">详情</li>

                <li class="ub-f1">评价</li>

            </ul>

            <div class="goods-header-right">

                <a class="cart-btn cartbox" href="/cart.html">
                    <em class="SZY-CART-COUNT bg-color">0</em>
                </a>
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0)"></a>
                    </div>
                </aside>
            </div>
        </div>
        <div class="show-menu-info" id="menu">
            <ul>
                <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
                <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
                <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
                <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
            </ul>
        </div>
        <!--商品-->
        <div class="goods-content user-goods-ka">
            <div class="swiper-container swiper-container-horizontal" id="goods_pic">
                <div class="swiper-wrapper SZY-GOODS-IMAGE">

                    @foreach($sku['sku_images'] as $v)
                    <div class="swiper-slide">
                        <a href="javascript:void(0)">
                            <img data-src="{{ $v[1] }}" class="swiper-lazy">
                            <div class="swiper-lazy-preloader"></div>
                        </a>
                    </div>
                    @endforeach

                </div>
                <div class="swiper-pagination"></div>

                <a href="javascript:void(0)" class="qr-code" onclick="code_coupon()">
                    <i></i>
                </a>


            </div>
            <!-- 商品团购倒计时 -->

            <!--团购未开始样式-->



            <!-- 批发商品 -->

            <div class="goods-info bdr-bottom">
                <div class="goods-info-top">
                    <h3 class="SZY-GOODS-NAME">{{$sku['sku_name'] }}</h3>

                </div>
                <span class="goods-depict color"></span>

                <div class="goods-price">
                    <div class="now-prices">
                        <em class="SZY-GOODS-PRICE price-color">￥{{ $sku['goods_price'] }}</em>
                        <del class="SZY-MARKET-PRICE" style="display: none;">￥{{ $sku['market_price'] }}</del>
                    </div>

                </div>

                <!-- 商品赠品 -->
                <div class="SZY-GIFT-LIST">

                </div>
                <!-- 红包 -->


                <!-- 促销 -->
                <div class="prom-box" >
                    <div class="prom-content" onClick="select_proms()">
                        <dt>促销</dt>
                        <div class="prom-lists">
                            <!--会员特价-->



                            <!-- 满减、满折 _start -->

                            <dd>
                                <div class="pro-item">

                                    <div class="pro-type">
                                        <span class="pro-type-name">满减</span>
                                    </div>


                                    <div class="pro-type">
                                        <span class="pro-type-name">包邮</span>
                                    </div>


                                </div>
                            </dd>

                            <!-- 满减、满折 _end -->

                            <!--搭配套餐-->

                        </div>
                        <span class="more">
                            <i class="iconfont">&#xe607;</i>
                        </span>
                    </div>
                </div>


                <!-- 促销活动弹出层 _start -->
                <div class="f_block" id="proms_coupon">
                    <div class="prom-coupon">
                        <h2>
                            促销
                            <a class="c-close-attr1" href="javascript:void(0)" onclick="close_choose_proms();">×</a>
                        </h2>
                        <ul class="coupon-list">


                            <li class="items SZY-RANK-PRICES" style="display: none;">
                                <div class="pro-item more-member-info">
                                    <div class="pro-type">
                                        <span class="pro-type-name">会员特价</span>
                                    </div>
                                    <div class="pro-info">
                                        <span class="SZY-RANK-MESSAGE"></span>
                                    </div>
                                    <span class="more">
                                        <i class="iconfont">&#xe607;</i>
                                    </span>
                                </div>
                            </li>
                            <!-- <li class="items hide">
                                <div class="pro-item">
                                    <div class="pro-type">
                                        <span class="pro-type-name">限购</span>
                                    </div>
                                    <div class="pro-info">
                                        <p>购买1~2件时享受折扣，超出数量以结算为准</p>
                                    </div>
                                </div>
                            </li> -->
                            <li class="items hide">
                                <div class="pro-item">
                                    <div class="pro-type">
                                        <span class="pro-type-name">满减</span>
                                    </div>
                                    <div class="pro-info">

                                        <p>满100元，减10元、包邮；</p>

                                        <p>满200元，减20元、包邮；</p>

                                        <p>满500元，减30元、包邮；</p>

                                    </div>
                                </div>
                            </li>
                            <!-- 搭配套餐弹出层 _start -->
                            <!-- 搭配套餐弹出层 _end -->
                            <!--会员等级价格-->
                            <script>
                                $('.more-member-info').click(function() {
                                    $('.member-section').addClass('show');
                                });
                                $('.member-section-back').click(function() {
                                    $('.member-section').removeClass('show');
                                });
                            </script>
                            <link rel="stylesheet" href="/mobile/css/shop_member.css?v=20180702"/>
                            <div class="member-section">
                                <div class="header">
                                    <div class="header-left">
                                        <a class="sb-back member-section-back" href="javascript:void(0)" title="返回"></a>
                                    </div>
                                    <div class="header-middle">会员特价</div>
                                    <div class="header-right"></div>
                                </div>
                                <!-- <div class="member-info">
                                    <div class="member-info-box">
                                        <div class="member-info-left">
                                            <span class="avatar-img">
                                                <img src="http://lrw.oss-cn-beijing.aliyuncs.com/images/15164/">
                                            </span>
                                        </div>
                                        <div class="cell member-info-center">
                                            <p class="info-m-hd">您好，</p>
                                            <div class="info-m-bd">
                                                <span class="level-no">您还不是本店会员</span>
                                            </div>
                                            <p class="info-m-ft">完成首单即可成为V1会员</p>
                                        </div>
                                    </div>
                                </div> -->
                                <!---会员价规则-->
                                <div class="member-rules">
                                    <div class="member-rules-bd">

                                    </div>
                                </div>
                            </div>
                            <!--会员等级价格-->
                            <script>
                                $('.member-section-back').click(function() {
                                    $('.member-section').removeClass('show');
                                });
                            </script>


                        </ul>
                    </div>
                </div>
                <!-- 促销活动弹出层 _end -->
            </div>

            <div class="blank-div"></div>
            <!--已选-->
            {{--判断 是否显示--}}
            @if(!empty($goods['spec_list']))
            <div class="selected-attr SZY-GOODS-SPEC" onClick="select_spec('select')">
                规格
                <i class="i_dd">


                    {{ $sku['spec_attr_value'] }}



                </i>
                <span class="more">
                    <i class="iconfont">&#xe607;</i>
                </span>
            </div>
            @endif

            {{--判断 是否显示--}}
            <div class="send-to region-box">
                <dt>送至</dt>
                <dd class="ub">
                    <em></em>
                    <div class="region-chooser-container region-chooser ub-f1"></div>
                </dd>
                <span class="more">
                    <i class="iconfont">&#xe607;</i>
                </span>

            </div>
            <div class="freight freight-info"></div>


            <!-- 自提点 -->
            @if(sysconf('goods_info_pickup'))
            <div class="pickup">
                <dt>自提点</dt>
                <dd>
                    上门自提
                    <span class="more">
                        <i class="iconfont">&#xe607;</i>
                    </span>
                </dd>
            </div>
            @endif





            <!-- 拼团活动_start -->



            <!-- 拼团活动_end -->

            <!-- 砍价活动_start -->



            <!-- 砍价活动_end -->




            <!-- 店铺信息 _star-->

            <div class="blank-div"></div>
            <div class="store-info">
                <div class="store-top">
                    <a href="{{ route('mobile_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}">
                        <div class="store-logo">
                            <img src="{{ get_image_url($shop_info['shop']['shop_logo'], 'shop_logo') }}">
                        </div>
                        <div class="store-item">
                            <div class="store-name">
                                <span>{{ $shop_info['shop']['shop_name'] }}</span>

                            </div>
                            <p class="score-sum">综合评分：5.00</p>
                        </div>
                    </a>
                </div>
                <ul class="score-detail">
                    <li>
                        <a href="{{ route('mobile_shop_goods_list', ['shop_id'=>$shop_info['shop']['shop_id']]) }}">
                            <span class="num">{{ $shop_goods_count }}</span>
                            <span class="text">全部宝贝</span>
                        </a>
                    </li>

                    <li>
                        <span class="num SZY-COLLECT-COUNT">{{ $shop_collect_count }}</span>
                        <span class="text">关注人数</span>
                    </li>

                    <li>
                        <p>
                            <em>描述相符</em>
                            <i class="color">{{ $shop_info['shop']['desc_score'] }}</i>
                        </p>
                        <p>
                            <em>服务态度</em>
                            <i class="color">{{ $shop_info['shop']['service_score'] }}</i>
                        </p>
                        <p>
                            <em>发货速度</em>
                            <i class="color">{{ $shop_info['shop']['send_score'] }}</i>
                        </p>
                    </li>
                </ul>

                <div class="store-btn">
                    <!-- 收藏店铺 -->
                    <div class="store-btn-item">
                        <a href="javascript:void(0);" class="collect-shop">

                            @if($goods['shop_collect'])
                                {{--已收藏--}}
                                <i class="store-btn-icon collected-shop-icon">&nbsp;</i>
                                <span class="store-btn-text">取消收藏</span>
                            @else
                                {{--未收藏--}}
                                <i class="store-btn-icon collect-shop-icon">&nbsp;</i>
                                <span class="store-btn-text">收藏本店</span>
                            @endif

                        </a>
                    </div>
                    <!-- 进入店铺 -->
                    <div class="store-btn-item">
                        <a href="{{ route('mobile_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}">
                            <i class="store-btn-icon goto-shop-icon">&nbsp;</i>
                            <span class="store-btn-text">进入店铺</span>
                        </a>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                // 添加收藏
                $('body').on('click', '.collect-shop', function(event) {
                    var target = $(this);
                    var shop_id = "{{ $shop_info['shop']['shop_id'] }}";
                    $.loading.start();
                    $.collect.toggleShop(shop_id, function(result) {
                        $.loading.stop();
                        if (result.data == 1) {
                            $(target).html("<i class='store-btn-icon collected-shop-icon'>&nbsp;</i><span class='store-btn-text'>取消收藏</span>");
                        } else {
                            $(target).html("<i class='store-btn-icon collect-shop-icon'>&nbsp;</i><span class='store-btn-text'>收藏本店</span>");
                        }
                        $('.SZY-COLLECT-COUNT').html(result.collect_count);
                    }, 1);
                });
            </script>
            <!-- 店铺信息 _end-->
            <div class="scroll-tips" style="display: none">
                <div class="line"></div>
                <span class="text">
                    <i class="icon"></i>
                    点击进入商品详情
                </span>
            </div>

            <!--销量/收藏切换-->
            <div class="blank-div"></div>
            <div class="sale-collect-box">
                <ul class="sale-collect-nav">
                    <li class="current">销售量</li>
                    <li>收藏数</li>
                </ul>
                <!--销售量-->
                <div class="sale-collect-tab">

                    {{--引入商品销量排行列表--}}
                    @include('goods.partials.sale_rank_goods')

                </div>
                <!--收藏数-->
                <div class="sale-collect-tab" style="display: none;">

                    {{--引入商品收藏排行列表--}}
                    @include('goods.partials.collect_rank_goods')

                </div>
            </div>

        </div>
        <!--详情-->
        <div class="blank-div"></div>
        <div class="goods-desc-main user-goods-ka" style="display: none;">
            <ul class="goods-details-nav clearfix">
                <li class="current">商品详情</li>
                <li>规格参数</li>
            </ul>
            <div class="product_images product_desc goods-details-tab" id="product_desc">
                <div class="detail-content goods-detail-content product_tab_chr">
                    <div class="more-loader-spinner">
                        <img src="/mobile/images/loading.gif" width="20" height="20">
                        数据加载中...
                    </div>
                </div>
                <div class="tip-space-box hide">
                    <div class="tip-space">
                        <div class="loaded-bg">我是有底线的</div>
                    </div>
                    <div class="blank-div"></div>
                </div>
            </div>
            <div class="goods-details-tab" style="display: none">
                <!-- 商品规格参数 -->
                <table class="attribute-table">
                    <tbody>
                    <tr>
                        <td>商品名称</td>
                        <td>{{ $goods['goods_name'] }}</td>
                    </tr>
                    <tr>
                        <td>商品编号</td>
                        <td>{{ $goods['goods_id'] }}</td>
                    </tr>
                    <tr>
                        <td>店铺</td>
                        <td>{{ $shop_info['shop']['shop_name'] }}</td>
                    </tr>

                    <!-- 商品规格 -->
                    @if(!empty($goods['spec_list']))
                        @foreach($goods['spec_list'] as $v)
                            <tr>
                                <td>{{ $v['attr_name'] }}</td>
                                <td>

                                    {{ implode(' ', array_column($v['attr_values'], 'attr_value')) }}

                                </td>
                            </tr>
                        @endforeach
                    @endif


                    {{--商品属性--}}
                    @if(!empty($goods['attr_list']))
                        @foreach($goods['attr_list'] as $v)
                            <tr>
                                <td>{{ $v['attr_name'] }}</td>
                                <td>

                                    {{ $v['attr_values'] }}

                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!--用户评价-->
        <div class="goods-evaluate user-goods-ka" id="goods-evaluate" style="display: none"></div>
        <!--红包弹出层-->
        <div class="f_block" id="select_coupon">
            <div class="discount-coupon">
                <h2>
                    领取红包
                    <a class="c-close-attr1" href="javascript:void(0)" onclick=" close_choose_coupon();">x</a>
                </h2>
                <ul class="coupon-list">


                </ul>
            </div>
        </div>

        <!-- 自提点弹框 _start-->
        <!-- 自提点 _start -->
        <div id="goods_pickup" class="goods-pickup-layer">
            <div class="content-info">
                <form method="post" onSubmit="return false;">
                    <div class="goods-pickup-header clearfix">
                        <div class="back-goods-info">
                            <a href="javascript:void(0);" class="sb-back" title="返回"></a>
                        </div>
                        <div class="search-form">
                            <input class="search-input logistics-search-input" placeholder="请输入自提点名称/所在地" type="text" name="logistics-search" data-shop_id='1' onkeydown='logistics(event);' />
                            <span class="search-icon"></span>
                        </div>
                        <span class="search-btn js-search-btn" data-shop_id='1'>搜索</span>
                    </div>
                    <ul class="logistics-store-list">


                        {{--引入自提点--}}
                        @include('goods.partials._self_pickup_list')


                    </ul>

                </form>
            </div>
        </div>
        <script type="text/javascript">
            $(".search-btn").click(function() {
                var keyword = $(".logistics-search-input").val();
                var shop_id = $(this).data('shop_id');
                $.post("/goods/search-pickup.html", {
                    "keyword": keyword,
                    "shop_id": shop_id
                }, function(result) {
                    if (result.code == 0) {
                        $(".logistics-store-list").html(result.data);

                    }
                }, "json");
            });
            function logistics(e) {
                if (e.keyCode == 13) {
                    var keyword = $(".logistics-search-input").val();
                    var shop_id = $('.logistics-search-input').data('shop_id');
                    $.post("/goods/search-pickup.html", {
                        "keyword": keyword,
                        "shop_id": shop_id
                    }, function(result) {
                        if (result.code == 0) {
                            $(".logistics-store-list").html(result.data);

                        }
                    }, "json");
                }
            }
        </script>
        <!-- 自提点 _end -->
        <!-- 自提点弹框 _end-->
        <!--分享弹出层-->
        <div class="bdshare-popup-box" onclick="colse_bdshare_popup()">
            <div class="bdshare-popup-top">
                <img src="/mobile/images/goods/share_popup_top.png">
            </div>
            <div class="bdshare-popup-bottom">
                <img src="/mobile/images/goods/share_popup_bottom.png">
            </div>
        </div>

        <!-- 二维码弹出层 start-->
        <div class="code-bg" onclick="close_coupon();"></div>
        <div class="code-mask">
            <div class="code-box">
                <div class="code-close" onclick="close_code_coupon();"></div>
                <div class="code-logo">
                    <img src="{{ get_image_url(sysconf('mall_logo')) }}">
                </div>
                <div class="code-img">
                    <div id="qrcode">
                        <img src="/goods/qrcode.html?id={{ $goods['goods_id'] }}" />
                    </div>
                </div>
                <h3>截屏保存二维码到手机，分享给好友</h3>
                <div class="code-footer">
                    <img src="{{ get_image_url($goods['goods_image']) }}">
                    <div class="code-footer-fr">
                        <p>{{ $goods['goods_name'] }}</p>
                        <span>￥{{ $goods['goods_price'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- 二维码弹出层 end-->
        <script type="text/javascript">
            $('.procedure-tip-btn').click(function(){
                $('.pre-sale-rule-box').addClass('show');
                $('.pre-sale-rule-close').addClass('show');
            });
            $('.pre-sale-rule-close,.pre-sale-rule-box,.rule-footer-btn').click(function(){
                $('.pre-sale-rule-box').removeClass('show');
                $('.pre-sale-rule-close').removeClass('show');
            });
        </script>
        <!-- 预售规则弹出层end -->
        <script type="text/javascript">
            $('.SZY-RANK-PRICE').click(function(){
                //return;
                $('.mask-div').show();
                $('.rank-price-content').removeClass('rank-price-back').addClass('rank-price-show');
                scrollheight = $(document).scrollTop();
                $("body").css("top", "-" + scrollheight + "px");
                $("body").addClass("visibly");
            });
            $('.rank-price-btn a').click(function(){
                $('.mask-div').hide();
                $('.rank-price-content').removeClass('rank-price-show').addClass('rank-price-back');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            });
            //获取滚动高度
            function scrollTop(){
                return Math.max(
                    //chrome
                    document.body.scrollTop,
                    //document.getElementsByTagName('goods-content').scrollTop
                    //firefox/IE
                    document.documentElement.scrollTop
                );
            }
            //获取页面文档的总高度
            function documentHeight(){
                //现代浏览器（IE9+和其他浏览器）和IE8的document.body.scrollHeight和document.documentElement.scrollHeight都可以
                return Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);
            }
            //获取页面浏览器视口的高度
            function windowHeight(){
                //document.compatMode有两个取值。BackCompat：标准兼容模式关闭。CSS1Compat：标准兼容模式开启。
                return (document.compatMode == "CSS1Compat")? document.documentElement.clientHeight : document.body.clientHeight;
            }

            $('.goods-header-nav li').click(function(){
                $('html,body').scrollTop(0);
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.user-goods-ka').eq($(this).index()).show().siblings('.user-goods-ka').hide();
                if($(this).index() == 1){
                    $('.goods-details-nav').addClass('fixed');
                    $('.goods-details-tab').css('margin-top','84px');
                }
            });
            $('.goods-details-nav li').click(function(){
                //$(this).parents('.goods-details-nav').addClass('fixed');
                $(this).addClass('current').siblings().removeClass('current');
                //$('.goods-desc-main').css('top','95px');
                $('.goods-details-tab').eq($(this).index()).show().siblings('.goods-details-tab').hide();
            });

            //销量和收藏数切换
            $('.sale-collect-nav li').click(function(){
                $(this).addClass('current').siblings().removeClass('current');
                $('.sale-collect-tab').eq($(this).index()).show().siblings('.sale-collect-tab').hide();
            });
            //点击跳转详情
            $('.scroll-tips').click(function() {
                $('html,body').scrollTop(0);
                $('.goods-header-nav li').removeClass('cur');
                $('.goods-header-nav li').eq(1).addClass('cur');
                $('.user-goods-ka').eq(1).show().siblings('.user-goods-ka').hide();
            });

            //点击跳转到评价详情
            $('.SZY-ALL-COMMENT').click(function(){
                $('html,body').scrollTop(0);
                $('.goods-header-nav li').removeClass('cur');
                $('.goods-header-nav li').eq(2).addClass('cur');
                $('.user-goods-ka').eq(2).show().siblings('.user-goods-ka').hide();
            });
        </script>
        <!--底部菜单 start-->

        <div style="height: 50px;"></div>
        <div class="goods-footer-nav bdr-top">





            <a href="{{ route('mobile_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" class="nav-button">
                <em class="goods-index-nav"></em>
                <span>店铺</span>
            </a>
            <!--商品已收藏时给em标签添加selected样式-->

            <a href="javascript:void(0);" class="nav-button goods-col right collect-goods" data-goods-id="{{ $goods['goods_id'] }}">
                @if($goods['is_collect'])
                    <em class="goods-collect-nav selected"></em>
                    <span>已收藏</span>
                @else
                    <em class="goods-collect-nav"></em>
                    <span>收藏</span>
                @endif
            </a>

            <!-- 是否配置了云旺客服 -->


            <!-- 微商城客服调用qq -->







            <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=xxxxx&amp;site=qq&amp;menu=yes" class="nav-button customer">
                <em class="goods-qq-nav"></em>
                <span>客服</span>
            </a>





            <dl class="ub-f1 ub">



                <dd class="flow">
                    <a href="javascript:void(0)" class="button" onclick="select_spec('add-cart')">加入购物车</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" class="button" onclick="select_spec('buy-goods')">立即购买</a>
                </dd>



            </dl>
        </div>

        <div class="choose-attribute-mask"></div>
        <div class="choose-attribute-main" id="choose_attr">
            <div class="choose-attribute-header">
                <img class="SZY-GOODS-IMAGE-THUMB" src="{{ get_image_url($sku['sku_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" />
                <div class="attribute-header-right">
                    <span class="goodprice price-color choose-result-price SZY-GOODS-PRICE"> ￥{{ $sku['goods_price'] }} </span>
                    <p>

                        <i class="SZY-GOODS-NUMBER">库存：{{ $sku['goods_number'] }}件</i>


                    </p>

                </div>
                <a class="choose-attribute-close show" href="javascript:close_choose_spec();" title="关闭">

                </a>
            </div>
            <div class="choose-attribute-content">
                <div class="attr-list choose SZY-GOODS-SPEC-ITEMS">

                    {{--商品规格--}}
                    @if(!empty($goods['spec_list']))
                        @foreach($goods['spec_list'] as $k=>$v)
                        <dl class="attr">
                            <dt class="dt">{{ $v['attr_name'] }}</dt>
                            <dd class="dd">
                                <ul>

                                @foreach($v['attr_values'] as $kk=>$vv)
                                    <!-- 属性值被选中的状态 _start-->
                                    <li class="@if(in_array($vv['spec_id'], $sku['spec_ids'])) selected @endif"
                                        data-spec-id="{{ $vv['spec_id'] }}" data-attr-id="{{ $v['attr_id'] }}" data-is-default="{{ $v['is_default'] }}" data-points-goods="0">
                                        <a href="javascript:void(0);">{{ $vv['attr_value'] }}</a>
                                    </li>
                                    <!-- 属性值被选中的状态 _end-->
                                @endforeach

                                </ul>
                            </dd>
                        </dl>
                        @endforeach
                    @endif

                    <div class="goods-buy-number">
                        <div class="title1">购买数量</div>
                        <div class="item1">
                            <div class="goods-num amount amount-btn cart-box">
                                <span class="decrease amount-minus disabled">
                                    <i class="iconfont"></i>
                                </span>
                                <input type="number" class="amount-input num" value="1" data-amount-min="1" data-amount-max="{{ $sku['goods_number'] }}" maxlength="8" title="请输入购买量" onclick="$(this).select();">
                                <span class="increase amount-plus">
                                    <i class="iconfont"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($goods['goods_moq'] > 0)
                    <div class="purchase-msg color">
                        起订量：
                        <i>{{ $goods['goods_moq'] }}&nbsp;件</i>
                    </div>
                    @endif

                    <div style="height: 10px"></div>

                </div>
            </div>
            <div class="choose-foot">

                <a href="javascript:void(0)" class="SZY-BUY-BUTTON bg-color">确定</a>
                <a href="javascript:void(0)" class="SZY-BUY-SELECT button-attr buy-goods">立即购买</a>
                <a href="javascript:void(0)" class="SZY-BUY-SELECT button-attr add-cart">加入购物车</a>

            </div>
        </div>
        <script type="text/javascript">
            $().ready(function() {
                // 步进器
                var goods_number_amount = $(".amount-input").amount({
                    value: '1',
                    min: '1',
                    max: '{{ $goods['goods_number'] }}',
                    change: function(element, value) {

                    },
                    max_callback: function() {
                        $.msg("最多只能购买" + this.max + "件");
                    },
                    min_callback: function() {
                        $.msg("商品数量必须大于" + (this.min - 1));
                    }
                });

                // 立即购买
                $('body').on('click', '.buy-goods', function() {
                    if ($(this).hasClass("disabled")) {
                        return;
                    }
                    var sku_id = getSkuId();
                    var number = $(".goods-num").find('.num').val();
                    $.cart.quickBuy(sku_id, number);
                });

                // 添加购物车
                $('body').on('click', '.add-cart', function(event) {
                    if ($(this).hasClass("disabled")) {
                        return;
                    }
                    //var image_url = $(".SZY-GOODS-IMAGE-THUMB").attr("src");
                    var number = $(".goods-num").find('.num').val();
                    var sku_id = getSkuId();
                    $.cart.add(sku_id, number, {
                        is_sku: true,

                        //image_url: image_url,
                        //event: event,
                        callback: function(result) {
                            if (result.code == 0) {
                                close_choose_spec();
                            }
                        }
                    });
                    return false;
                });

                // 立即兑换
                $('body').on('click', '.exchange-goods', function(event) {

                    if ($(this).hasClass("disabled")) {
                        var goods_number = "";
                        if (goods_number == 0) {
                            $.msg('库存不足');
                        } else {
                            $.msg('积分不足');
                        }
                        return;
                    }
                    var sku_id = getSkuId();
                    var number = $(".goods-num").find('.num').val();
                    var data = {};
                    data.exchange = true;
                    $.cart.quickBuy(sku_id, number, data);
                });

                // 小程序控制客服
                if (window.__wxjs_environment === 'miniprogram') {
                    var service_tel = '';
                    if (service_tel != '' || service_tel != null) {
                        $('.customer').attr('href', 'tel:' + service_tel);
                        $('.customer').attr('class', 'nav-button customer');
                        $('.customer').html('<em class="goods-phone-nav"></em><span>电话</span>');
                    } else {
                        $('.customer').attr('href', 'javascript:void(0)');
                        $('.customer').attr('onClick', '$.msg("卖家没有设置联系电话")');
                        $('.customer').attr('class', 'nav-button customer');
                    }
                }
            });
        </script>
        <!--底部菜单 end-->
        <section class="mask-div" style="display: none;" onclick="close_coupon();"></section>
        <!-- 分享 -->
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript">
            $().ready(function() {
                $.get("/index/information/is-weixin.html", function(result) {
                    if (result.code == 0) {
                        var url = location.href.split('#')[0];

                        var share_url = "";

                        if (share_url == '') {
                            share_url = url;
                        }

                        $.ajax({
                            type: "GET",
                            url: "/site/index",
                            dataType: "json",
                            data: {
                                url: url
                            },
                            success: function(result) {
                                if (result.code == 0) {
                                    wx.config({
                                        debug: false,
                                        appId: result.data.appId,
                                        timestamp: result.data.timestamp,
                                        nonceStr: result.data.nonceStr,
                                        signature: result.data.signature,
                                        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
                                    });

                                }
                            }
                        });

                        // 微信JSSDK开发
                        wx.ready(function() {
                            // 分享给朋友
                            wx.onMenuShareAppMessage({
                                title: '{{ $seo_title }}', // 标题
                                desc: '{{ $seo_description }}', // 描述
                                imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                                link: share_url,
                                fail: function(res) {
                                    alert(JSON.stringify(res));
                                }
                            });

                            // 分享到朋友圈
                            wx.onMenuShareTimeline({
                                title: '{{ $seo_title }}', // 标题
                                desc: '{{ $seo_description }}', // 描述
                                imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                                link: share_url,
                                fail: function(res) {
                                    alert(JSON.stringify(res));
                                }
                            });
                        });
                    }
                }, 'json');
            });
        </script>

        <!-- 返回顶部 -->
        <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/mobile/images/topup.png"></a>
        <script type="text/javascript">
            $().ready(function(){
                //首先将#back-to-top隐藏
                //$("#back-to-top").addClass('hide');
                //当滚动条的位置处于距顶部1000像素以下时，跳转链接出现，否则消失
                $(function ()
                {
                    $(window).scroll(function()
                    {
                        if ($(window).scrollTop()>600)
                        {
                            $('body').find(".back-to-top").removeClass('hide');
                        }
                        else
                        {
                            $('body').find(".back-to-top").addClass('hide');
                        }
                    });
                    //当点击跳转链接后，回到页面顶部位置
                    $(".back-to-top").click(function()
                    {
                        $('body,html').animate(
                            {
                                scrollTop:0
                            }
                            ,600);
                        return false;
                    });
                });
            });
        </script>
        <!--身份验证-->
        <link rel="stylesheet" href="/mobile/css/login.css?v=20180702"/>
        <!--pop-login-main增加show样式为显示状态-->
        <div class="pop-login-main">
            <header id="header" class="header">
                <div class="header-left">
                    <a href="javascript:void(0)" class="sb-back "></a>
                </div>
                <div class="header-middle">身份验证</div>
                <div class="header-right"></div>
            </header>
            <div class="middle-content m-t-0">
                <div class="form-group-box">
                    <!--  用户名  -->
                    <div class="form-group form-group-spe">
                        <dl>
                            <dt> <span>手机号：</span> </dt>
                            <dd>
                                <div class="form-control-box">
                                    <input type="text" class="form-control error"  value="" placeholder="" autocomplete="off" aria-invalid="true">
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <!--  验证码  -->
                    <div class="form-group captcha">
                        <dl class="form-group-spe captcha" id="o-authcode">
                            <dt>验证码</dt>
                            <dd>
                                <div class="form-control-box input_box">
                                    <i class="icon"></i>
                                    <input type="text" id="captcha_sms" name="SmsLoginModel[captcha]" class="text" tabindex="2" placeholder="验证码" />
                                    <label class="captcha"> </label>
                                </div>
                                <span id="captcha-error" data-error-id="captcha" class="form-control-error">
							<i class="fa fa-warning"></i>
						</span>
                            </dd>
                        </dl>
                    </div>
                    <!--  动态验证码  -->
                    <div class="form-group form-group-spe">
                        <dl>
                            <dt> <span>动态密码：</span> </dt>
                            <dd>
                                <div class="form-control-box">
                                    <input type="number"  class="text" tabindex="3" placeholder="动态密码" pattern="[0-9]*">
                                    <a id="btn_send_sms_code" href="javascript:void(0);" class="phonecode phonecode1">获取验证码</a> </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="submit-btn">
                        <input type="submit" class="btn-submit" id="login_btn" value="确定">
                    </div>
                </div>
            </div>
        </div>


        <!-- 预售倒计时 -->

        <script type="text/javascript">
            var swiper = new Swiper('#goods_pic', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                autoplay: 3000,
                lazyLoading : true,
                lazyLoadingInPrevNext: true,
                autoplayDisableOnInteraction: true,
                // paginationType: 'fraction',
                onTouchEnd: function(swiper, event){
                    if(swiper.isEnd && (swiper.touches.startX-swiper.touches.currentX) > 150){
                        $('.goods-header-nav li').eq(1).click();
                    }
                }
            });
        </script>
        <script id="SZY_SKU_LIST" type="text">
            {{--sku list--}}
            {!! json_encode($goods['sku_list']) !!}
        </script>
        <script type="text/javascript">
            var sku_freights = [];
            $().ready(function() {
                //加载图文详情
                loadDesc();

                loadComment();
                //在线客服
                $(".service-online").click(function() {
                    var goods_id = '{{ $goods['goods_id'] }}';
                    $.openim({
                        goods_id:goods_id
                    });
                })


            });

            //加载图文详情
            function loadDesc() {
                $.ajax({
                    type: "get",
                    url: "/goods/desc",
                    dataType: 'json',
                    data: {
                        sku_id: "{{ $sku['sku_id'] }}",
                        is_lib_goods: ""
                    },
                    success: function(result) {
                        if(result.desc_type == 0){
                            $(".goods-detail-content").html(result.pc_desc);
                        }
                        if(result.desc_type == 1){
                            var mobile_desc = '';
                            $.each(result.mobile_desc,function(i,desc){
                                if(desc.type==1){
                                    var img = '<img src = '+desc.content+'>';
                                    mobile_desc =  mobile_desc + img;
                                }else{

                                    mobile_desc =  mobile_desc + '<div>'+desc.content+'</div>';
                                }
                            });
                            $(".goods-detail-content").html(mobile_desc);
                        }
                        if($('.user-goods-ka').eq(0).css('display') != 'none'){
                            $('.user-goods-ka').eq(1).show();
                            $('.tip-space-box').show();
                        }
                    }
                });
            }

            //加载评论
            function loadComment() {
                $.ajax({
                    type: "get",
                    url: '/goods/comment',
                    dataType: 'json',
                    data: {
                        sku_id: '{{ $sku['sku_id'] }}',
                        output: 1,
                    },
                    success: function(result) {
                        $("#goods-evaluate").html(result.data);
                        if($("#gallery a").length>0){
                            var options = {

                            };
                            $("#gallery a").photoSwipe(options);
                        }
                    }
                });
            }

        </script>
        <script src="/assets/d2eace91/js/jquery.history.js?v=20180813"></script>

        <script type="text/javascript">
            var main_image_size = "1";
            var sku_ids = $.parseJSON($("#SZY_SKU_LIST").html());
            function getSkuId() {
                var spec_ids = [];
                $(".choose").find(".attr").each(function() {
                    var spec_id = $(this).find(".selected").data("spec-id");
                    spec_ids.push(spec_id);
                });
                var sku_id = $.cart.getSkuId(spec_ids, sku_ids);
                return sku_id;
            }

            function getSkuInfo(sku_id, is_default, callback) {

                if(sku_id == null || sku_id == undefined){
                    // 回调
                    if ($.isFunction(callback)) {
                        callback.call({}, null);
                    }
                    return;
                }
                if ($(document).data("SZY-SKU-" + sku_id)) {
                    var sku = $(document).data("SZY-SKU-" + sku_id);
                    sku.is_default = is_default;
                    // 回调
                    if ($.isFunction(callback)) {
                        callback.call({}, sku);
                    }
                } else {

                    $.get('/goods/sku', {
                        sku_id: sku_id
                    }, function(result) {
                        if (result.code == 0) {
                            var sku = result.data;
                            sku.is_default = is_default;
                            $(document).data("SZY-SKU-" + sku_id, sku);
                            // 回调
                            if ($.isFunction(callback)) {
                                callback.call({}, sku);
                            }
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json");
                }
            }

            // 设置SKU信息
            function setSkuInfo(sku) {
                if (sku == undefined || sku == null || sku == false) {
                    $(".SZY-BUY-BUTTON").addClass("disabled");
                    $('.SZY-BUY-BUTTON').text('库存不足');
                    $(".SZY-GOODS-NUMBER").html("库存不足");
                    return;
                }

                var is_original = $("body").data("is-original");
                var goods_number = sku.goods_number;

                if (goods_number > 0) {
                    if (sku_freights[local_region_code]) {
                        if (sku_freights[local_region_code].limit_sale == 1) {
                            goods_number = sku_freights[local_region_code].goods_number;
                        }
                    } else {
                        changeLocation(local_region_code).always(function(result) {
                            if (result.code == 0 && result.data.limit_sale == 1) {
                                setSkuInfo(sku);
                            }
                        });
                        return;
                    }
                }
                // 会员特价
                if (sku.member_price_message) {
                    $(".SZY-RANK-PRICES").show();
                    $(".SZY-RANK-MESSAGE").html(sku.member_price_message);
                    // 展示促销
                    show_activity = true;
                } else {
                    $(".SZY-RANK-PRICES").hide();
                }
                // 商品规格
                $(".SZY-GOODS-SPEC").html("已选：<i class='i_dd'>"+sku.spec_attr_value+"</i>	<span class='more'><i class='iconfont'>&#xe607;</i></span>");
                // 商品名称
                $(".SZY-GOODS-NAME").html(sku.sku_name);

                if (sku.is_default == 1) {
                    $(".SZY-GOODS-IMAGE-THUMB").attr("src", sku.sku_images[0][1]);
                    $(".SZY-GOODS-IMAGE").html("");
                    $.each(sku.sku_images, function(i, v) {
                        $(".SZY-GOODS-IMAGE").append("<div class='swiper-slide'><a href='javascript:void(0)'><img width='100%' src='" + v[main_image_size] + "'></a></div>");
                    });
                }

                // 售价
                if(is_original == 0 && sku.activity){
                    $(".SZY-GOODS-PRICE").html(sku.activity.act_price_format);
                }else{
                    $(".SZY-GOODS-PRICE").html(sku.goods_price_format);
                }


                // 市场价
                $(".SZY-MARKET-PRICE").html(sku.market_price_format);

                if (parseFloat(sku.market_price) == 0) {
                    $(".SZY-MARKET-PRICE").hide();
                } else {
                    $(".SZY-MARKET-PRICE").show();
                }

                // 预售定金显示
                if (parseFloat(sku.earnest_money) > 0 && $('.SZY-EARNST-MONEY').length > 0) {
                    $('.SZY-EARNST-MONEY').html(sku.earnest_money_format);
                    $('.SZY-TAIL-MONEY').html(sku.tail_money_format);
                }

                // 库存

                if(is_original == 1){
                    goods_number = sku.original_number;
                }

                if (goods_number > 0) {
                    if ("1" == 1) {
                        $(".SZY-GOODS-NUMBER").html("库存：" + goods_number + "件");
                    }else{
                        $(".SZY-GOODS-NUMBER").html("");
                    }
                } else {
                    $(".SZY-GOODS-NUMBER").html("库存不足");
                }
                if (goods_number == 0) {
                    $(".SZY-BUY-BUTTON").addClass("disabled");
                    $(".SZY-BUY-SELECT").addClass("disabled");
                    $('.SZY-BUY-BUTTON').text('库存不足');
                } else {
                    $(".SZY-BUY-BUTTON").removeClass("disabled");
                    $(".SZY-BUY-SELECT").removeClass("disabled");
                    $('.SZY-BUY-BUTTON').text('确定');
                }


                $(".amount-input").data("amount-min", 1);
                $(".amount-input").data("amount-max", goods_number);
                if (goods_number > 0 && $(".amount-input").val() == 0) {
                    $(".amount-input").val(1);
                } else if (goods_number == 0 && $(".amount-input").val() != 0) {
                    $(".amount-input").val(0);
                }
                var goods_number_input = parseInt($(".amount-input").val());

                if (goods_number_input > goods_number) {
                    $(".amount-input").val(goods_number);
                }

                // 运费信息
                if (sku.freight) {
                    $(".freight-info").html(sku.freight.freight_info);
                }

                // 处理赠品
                if (sku.gift_list && sku.gift_list.length > 0) {
                    $(".SZY-GIFT-LIST").html('');
                    var element = $($.parseHTML('<div class="prom-gift"></div>'));
                    element.append('<div class="dt">赠品</div><div class="dd"></div>');
                    for (var i = 0; i < sku.gift_list.length; i++) {
                        var gift = sku.gift_list[i];
                        element.find('.dd').append('<div class="prom-gift-list"><a href="/'+ gift.gift_sku_id +'.html" title="'+gift.sku_name+'"><img src="'+gift.goods_image_thumb+'" width="20" height="20" class="gift-img" /></a></div>')
                        element.find('.dd').find('.prom-gift-list').append('<em class="gift-number color">× '+gift.gift_number+'</em>');
                    }
                    $(".SZY-GIFT-LIST").append($(element));
                } else {
                    $(".SZY-GIFT-LIST").html('');
                }
                swiper.updateSlidesSize();
                swiper.updatePagination();
                swiper.slideTo(0, 1000, false);
                swiper.startAutoplay();
            }

            $().ready(function() {

                // 检查SKU组合
                $.cart.checkSkus($(".SZY-GOODS-SPEC-ITEMS"), sku_ids);

                // 绑定规格事件
                $.cart.checkSpecs($(".SZY-GOODS-SPEC-ITEMS"), sku_ids, $(".SZY-GOODS-SPEC-ITEMS").find("li"), function(sku) {

                    // 是否为默认规格
                    var is_default = $(this).data("is-default");

                    // SKU存在
                    getSkuInfo(sku.sku_id, is_default, function(sku) {
                        setSkuInfo(sku);
                        $("title").html(sku.sku_name);
                    });
                }, function() {
                    // SKU不存在
                    setSkuInfo(false);

                    $("title").html("{{ $goods['goods_name'] }}");
                });


                // 添加收藏
                $(".collect-goods").click(function(event) {
                    var target = $(this);
                    var goods_id = $(this).data("goods-id");
                    var sku_id = getSkuId();
                    $.loading.start();
                    $.collect.toggleGoods(goods_id, sku_id, function(result) {
                        $.loading.stop();
                        if (result.data == 1) {
                            target.find('.goods-collect-nav').addClass("selected");
                            target.children().next().html("已收藏");
                        } else {
                            target.find('.goods-collect-nav').removeClass("selected");
                            target.children().next().html("收藏");
                        }
                    }, true);
                });

                // 领取红包
                $("body").on("click", ".bonus-receive", function() {
                    var bonus_id = $(this).data("bonus-id");
                    var target = $(this);
                    $.bonus.receive(bonus_id, function(result) {
                        if (result.code == 0) {
                            $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                            $.msg(result.message);
                            return;
                        } else if (result.code == 130) {
                            $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                        } else if (result.code == 131) {
                            $(target).html("已抢光").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                        }
                        $.msg(result.message, {
                            time: 5000
                        });
                    });
                });

                //立即砍价
                $('body').on('click', '.cut-money', function() {
                    var goods_id = $(this).data('goods_id');
                    var openid = $(this).data('open_id');
                    $.ajax({
                        type: 'GET',
                        url: '/goods/bargain',
                        data: {
                            goods_id: goods_id,
                            openid: openid
                        },
                        dataType: 'json',
                        success: function(result) {
                            if(result.code == 0){
                                /* $('#act_bargain').html(result.bar_data);
                                $('#act_bargain_footer').html(result.bar_foot_data);
                                $('#act_bargain_info').html(result.bar_info_data); */
                                $('.mask-div').show();
                                $('.cut-money-info').show();
                                $('.bar-amount').html(result.bar_info.bar_amount);
                                replaceUrl('bar_id', result.bar_info.bar_id);
                            }else{
                                $.msg(result.message);
                            }
                        }
                    })
                });
                //立即砍价
                $('body').on('click', '.help-cut-money', function() {
                    var bar_id = $(this).data('bar_id');
                    var openid = $(this).data('open_id');
                    $.ajax({
                        type: 'GET',
                        url: '/goods/help-bargain',
                        data: {
                            bar_id: bar_id,
                            openid: openid
                        },
                        dataType: 'json',
                        success: function(result) {
                            if(result.code == 0){
                                /* $('#act_bargain').html(result.bar_data);
                                $('#act_bargain_footer').html(result.bar_foot_data); */
                                $('.mask-div').show();
                                $('.cut-money-info').show();
                                $('.bar-amount').html(result.bar_amount);
                            }else{
                                $.msg(result.message);
                            }
                        }
                    })
                });
            });

            function replaceUrl(name, value) {
                var obj = new Object();
                obj[name] = value;
                History.replaceState(obj, '', '?' + name + '=' + value);
            }
        </script>
        <!-- 定位 -->
        <script type="text/javascript">
            var local_region_code = '0';
            function changeLocation(region_code) {
                if (region_code == undefined || region_code == null || region_code.length == 0) {
                    return;
                }
                var sku_id = getSkuId();
                $.get("/goods/change-location.html", {
                    "sku_id": sku_id,
                    "region_code": region_code,

                }, function(result) {
                    if (result.code == 0) {
                        local_region_code = region_code;
                        sku_freights[region_code] = result.data;
                        if (result.data.limit_sale == 1 && result.data.is_last == 0) {
                            return;
                        }
                        $(".freight-info").html(result.data.freight_info);
                        if ($(document).data("SZY-SKU-" + sku_id)) {
                            var sku = $(document).data("SZY-SKU-" + sku_id);
                            setSkuInfo(sku);
                        } else {
                            $(".freight-info").html(result.data.freight_info);

                            if (result.data.goods_number > 0) {
                                if ("1" == "1") {
                                    $(".SZY-GOODS-NUMBER").html("库存：" + result.data.goods_number + "件");
                                }else{
                                    $(".SZY-GOODS-NUMBER").html("");
                                }
                                $('.SZY-BUY-BUTTON').text('确定');
                            } else {
                                $(".SZY-GOODS-NUMBER").html("库存不足");
                                $(".SZY-BUY-BUTTON").addClass("disabled");
                                $('.SZY-BUY-BUTTON').text('库存不足');
                            }

                        }

                    }
                }, "json");
            }

            function getRegionChooser() {
                var region_chooser = $(".region-chooser-container").regionchooser({
                    change: function(value, names, is_last) {
                        if (!is_last) {
                            return;
                        }
                        changeLocation(value);
                    }
                });
            }
        </script>

        <script src="http://webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script src="/assets/d2eace91/js/geolocation/amap.js?v=20180813"></script>
        <script type="text/javascript">
            $().ready(function() {
                if (sessionStorage.geolocation) {
                    var data = $.parseJSON(sessionStorage.geolocation);
                    loadRegionList(data);
                    return;
                } else {
                    $.geolocation({
                        callback: function(data) {
                            loadRegionList(data);
                        }
                    });
                }

                function loadRegionList(data) {
                    if (data.region_code && data.region_code.length > 0) {
                        local_region_code = data.region_code;
                    }
                    //第一次进入需要进行一次运费计算
                    if (local_region_code && local_region_code.length > 0) {
                        changeLocation(local_region_code);
                    }

                    // 变更配送地址
                    var region_chooser = $(".region-chooser-container").regionchooser({
                        value: local_region_code,
                        change: function(value, names, is_last) {
                            if (!is_last) {
                                return;
                            }
                            changeLocation(value);
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
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <!-- 底部 _end-->
    <script type="text/javascript">
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
    </script>

@stop