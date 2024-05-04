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
    <div id="index_content"><link rel="stylesheet" href="/css/swiper.min.css?v=20180927"/>
        <link rel="stylesheet" href="/css/goods.css?v=20180927"/>
        <link rel="stylesheet" href="/css/bonus_message.css?v=20180927"/>
        <!-- 地区选择器 -->
        <script src="/assets/d2eace91/js/jquery.region.mobile.js?v=20180919"></script>
        <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
        <script src="/js/goods.js?v=20180919"></script>
        <script src="/js/swiper.jquery.min.js?v=20180919"></script>
        <div class="goods-header">
            <div class="goods-header-left">
                <a href="javascript:history.back(-1)" class=" iconfont icon-fanhui1"></a>
            </div>
            <ul class="goods-header-nav ub ">
                <li class="cur ub-f1 ">商品</li>
                <li class="ub-f1">详情</li>
            </ul>
            <div class="goods-header-right">
                <a class="cart-btn cartbox" href="/cart.html">
                    <em class="SZY-CART-COUNT bg-color">0</em>
                </a>
                <aside class="show-menu-btn">
                    <div class="show-menu iconfont icon-gengduo3" id="show_more"></div>
                </aside>
            </div>
        </div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
        <!--商品-->
        <div class="goods-content user-goods-ka">
            <div class="swiper-container swiper-container-horizontal" id="goods_pic">
                <div class="swiper-wrapper">

                    @foreach($goods['goods_images'] as $v)
                        <div class="swiper-slide">
                            <a href="javascript:void(0)">
                                <img width="100%" src="{{ $v[1] }}">
                            </a>
                        </div>
                    @endforeach

                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="goods-info bdr-bottom">
                <div class="goods-price">
                    <div class="now-prices">
                        <em class="SZY-GOODS-PRICE price-color m-l-0">{{ $goods['goods_integral'] }}积分</em>
                    </div>
                    <p class="sold">兑换销量：{{ $goods['exchange_number'] }}件</p>
                </div>
                <div class="goods-info-top">
                    <h3 class="SZY-GOODS-NAME">{{ $goods['goods_name'] }}</h3>

                </div>
            </div>
            <div class="integralmall-time">
                <dt>兑换时间</dt>
                <dd>

                    @if($goods['is_limit'] == 0)
                        无时间条件限制
                    @elseif($goods['is_limit'] == 1)
                        有效期: {{ $goods['start_time'] }} 至 {{ $goods['end_time'] }}
                    @endif

                </dd>
            </div>

            <!-- 自提点 -->
            <div class="pickup">
                <dt>自提点</dt>
                <dd>
                    上门自提
                    <span class="more">
				<i class="iconfont">&#xe607;</i>
			</span>
                </dd>
            </div>


        </div>
        <!--详情-->
        <div class="blank-div"></div>
        <!-- 店铺信息 _star-->
        <div class="store-info">
            <div class="store-top">
                <a href="/shop/{{ $goods['shop_id'] }}.html">
                    <div class="store-logo">
                        <img src="{{ get_image_url($shop_info['shop']['shop_logo'], 'shop_logo') }}">
                    </div>
                    <div class="store-item">
                        <div class="store-name">
                            <span>
                                {{ $shop_info['shop']['shop_name'] }}
                            </span>

                        </div>
                        <p class="score-sum">综合评分：5.00</p>
                    </div>
                </a>
            </div>
            <ul class="score-detail">
                <li>
                    <a href="/shop/{{ $goods['shop_id'] }}/list.html">
                        <span class="num">4</span>
                        <span class="text">全部宝贝</span>
                    </a>
                </li>

                <li>
                    <span class="num SZY-COLLECT-COUNT">{{ $goods['collect_num'] }}</span>
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
                    <a href="/shop/{{ $goods['shop_id'] }}.html">
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
                var shop_id = "{{ $goods['shop_id'] }}";
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
        <div class="goods-desc-main user-goods-ka">
            <div class="integralmall-title">商品详情</div>
            <div class="product_images product_desc goods-details-tab" id="product_desc">
                <div class="detail-content goods-detail-content product_tab_chr">

                    @if(!empty($goods['mobile_desc']))
                        {!! $goods['mobile_desc'] !!}
                    @else
                        {!! $goods['pc_desc'] !!}
                    @endif

                </div>
                <div class="tip-space-box">
                    <div class="tip-space">
                        <div class="loaded-bg">我是有底线的</div>
                    </div>
                    <div class="blank-div"></div>
                </div>
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
                            <input class="search-input logistics-search-input" placeholder="请输入自提点名称/所在地" type="text" name="logistics-search" data-shop_id='{{ $goods['shop_id'] }}' onkeydown='logistics(event);' />
                            <span class="search-icon"></span>
                        </div>
                        <span class="search-btn js-search-btn" data-shop_id='{{ $goods['shop_id'] }}'>搜索</span>
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
                <img src="/images/goods/share_popup_top.png">
            </div>
            <div class="bdshare-popup-bottom">
                <img src="/images/goods/share_popup_bottom.png">
            </div>
        </div>

        <script type="text/javascript">
            var swiper = new Swiper('#goods_pic', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                autoplay: 3000,
                lazyLoading: true,
                autoplayDisableOnInteraction: true,
                // paginationType: 'fraction',
                onTouchEnd: function(swiper, event) {
                    if (swiper.isEnd && (swiper.touches.startX - swiper.touches.currentX) > 150) {
                        $('.goods-header-nav li').eq(1).click();
                    }
                }
            });

            $(window).on('scroll', function() {
                if (scrollTop() > 300) {
                    $('.goods-header-nav li').removeClass('cur');
                    $('.goods-desc-main').removeClass('fixed');
                    $('.goods-header-nav li').eq(1).addClass('cur');
                } else {
                    $('.goods-header-nav li').removeClass('cur');
                    $('.goods-header-nav li').eq(0).addClass('cur');
                }

            });

            //获取滚动高度
            function scrollTop() {
                return Math.max(
                    //chrome
                    document.body.scrollTop,
                    //document.getElementsByTagName('goods-content').scrollTop
                    //firefox/IE
                    document.documentElement.scrollTop);
            }
            //获取页面文档的总高度
            function documentHeight() {
                //现代浏览器（IE9+和其他浏览器）和IE8的document.body.scrollHeight和document.documentElement.scrollHeight都可以
                return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
            }
            //获取页面浏览器视口的高度
            function windowHeight() {
                //document.compatMode有两个取值。BackCompat：标准兼容模式关闭。CSS1Compat：标准兼容模式开启。
                return (document.compatMode == "CSS1Compat") ? document.documentElement.clientHeight : document.body.clientHeight;
            }

            $('.goods-header-nav li').click(function() {
                $('html,body').scrollTop(0);
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.user-goods-ka').eq($(this).index()).show().siblings('.user-goods-ka').hide();
                if ($(this).index() == 1) {
                    $('.goods-desc-main').addClass('fixed');
                }
            });
            $('.goods-details-nav li').click(function() {
                //$(this).parents('.goods-details-nav').addClass('fixed');
                $(this).addClass('current').siblings().removeClass('current');
                //$('.goods-desc-main').css('top','95px');
                $('.goods-details-tab').eq($(this).index()).show().siblings('.goods-details-tab').hide();
            });

            //点击跳转详情
            $('.scroll-tips').click(function() {
                $('html,body').scrollTop(0);
                $('.goods-header-nav li').removeClass('cur');
                $('.goods-header-nav li').eq(1).addClass('cur');
                $('.user-goods-ka').eq(1).show().siblings('.user-goods-ka').hide();
            });
        </script>


        <div style="height: 50px;"></div>
        <div class="goods-footer-nav exchange-goods-footer">

            <a href="/" class="nav-button">
                <em class="goods-index-nav"></em>
                <span>首页</span>
            </a>

            <!-- 	 -->
            <a href="javascript:void(0);" class="nav-button service-btn service-online">
                <em class="goods-message-nav"></em>
                <span>客服</span>
            </a>

            <div class="btn-group">
                <dl class="ub">


                    <dd class="btn">
                        <a href="javascript:void(0)" class="button bg-color" onclick="$.msg('该商品已下架！');">立即兑换</a>
                    </dd>


                </dl>
            </div>
        </div>
        <div class="choose-attribute-mask"></div>
        <div class="choose-attribute-main" id="choose_attr">
            <div class="choose-attribute-header">
                <img src="{{ get_image_url($goods['goods_image'],'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" />
                <div class="attribute-header-right">
                    <span class="goodprice price-color choose-result-price"> {{ $goods['goods_integral'] }}积分 </span>
                    <span>
				<i>

					库存：{{ $goods['goods_number'] }}件 &nbsp;

				</i>
			</span>
                    <span>
				        兑换时间：

                        @if($goods['is_limit'] == 0)
                            无时间条件限制
                        @elseif($goods['is_limit'] == 1)
                            有效期: {{ $goods['start_time'] }} 至 {{ $goods['end_time'] }}
                        @endif

			        </span>
                </div>
                <a class="choose-attribute-close" href="javascript:close_choose_spec();" title="关闭"></a>
            </div>
            <div class="choose-attribute-content">
                <div class="attr-list choose SZY-GOODS-SPEC-ITEMS">


                    <div class="goods-buy-number">
                        <div class="title1">购买数量</div>
                        <div class="item1">
                            <div class="goods-num amount amount-btn cart-box">
                                <span class="decrease amount-minus"><i class="iconfont">&#xe661;</i></span>
                                <input type="text" class="amount-input num" value="1" data-amount-min="1" data-amount-max="{{ $goods['goods_number'] }}" maxlength="8" title="请输入购买量" onFocus="this.blur()">
                                <span class="increase amount-plus"><i class="iconfont">&#xe662;</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="choose-foot">
                <a href="javascript:void(0)" class="bg-color SZY-BUY-BUTTON exchange-goods disabled" data-message="{{ $can_exchange_msg }}" data-goods_number="{{ $goods['goods_number'] }}">确定</a>
            </div>
        </div>

        <script type="text/javascript">
            $().ready(function() {
                // 步进器
                var amount = $(".amount-input").amount({
                    value: 1,
                    min: 1,
                    max: "99",
                    change: function(element, value) {
                        if (value >= amount.max) {
                            $.msg("您最多可以购买" + amount.max + "件");
                        }
                    },
                    max_callback: function() {
                        $.msg("最多只能购买" + this.max + "件");
                    },
                    min_callback: function() {
                        $.msg("商品数量必须大于" + (this.min - 1));
                    }
                });

                $('body').on('click', '.SZY-EXCHANGE', function() {
                    $("#choose_attr .choose-foot .SZY-BUY-BUTTON").show();
                    $("#choose_attr .choose-foot .SZY-BUY-SELECT").hide();
                    $(".mask-div").show();
                    $('#choose_attr').show();
                    $('#choose_attr').removeClass('spec-menu-hide').addClass('spec-menu-show');
                    scrollheight = $(document).scrollTop();
                    $("body").css("top", "-" + scrollheight + "px");
                    $("body").addClass("visibly");
                });

                // 立即兑换
                $('body').on('click', '.exchange-goods', function(event) {

                    if ($(this).hasClass("disabled")) {
                        var message = $(this).data('message');
                        $.msg(message);
                        return;
                    }
                    var goods_id = '11';
                    var number = $(".amount-input").val();
                    $.loading.start()
                    $.post('/integralmall/cart/quick-buy.html', {
                        goods_id: goods_id,
                        number: number
                    }, function(result) {
                        if (result.code == 0) {
                            $.go(result.data);
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "json").always(function() {
                        $.loading.stop()
                    });
                })
            });
        </script>
        <section class="mask-div" style="display: none;"></section>
        <!-- 分享 -->
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript">
            $().ready(function() {
                var url = location.href.split('#')[0];

                var share_url = "";

                if (share_url == '') {
                    share_url = url;
                }

                if (isWeiXin()) {
                    $.ajax({
                        url: "/site/get-weixinconfig.html",
                        type: "POST",
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
									jsApiList: result.data.jsApiList,
                                    // jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'wx-open-launch-weapp'],
                                    // openTagList: ['wx-open-launch-weapp']
                                });
                            }
                        }
                    });
                }

                // 微信JSSDK开发
                wx && wx.ready(function() {
                    // 分享给朋友
                    wx.onMenuShareAppMessage({
                        title: '', // 标题
                        desc: '', // 描述
                        imgUrl: '', // 分享的图标
                        link: share_url,
                        fail: function(res) {
                            alert(JSON.stringify(res));
                        }
                    });

                    // 分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: '', // 标题
                        desc: '', // 描述
                        imgUrl: '', // 分享的图标
                        link: share_url,
                        fail: function(res) {
                            alert(JSON.stringify(res));
                        }
                    });
                });
            });
        </script>

        <!-- 返回顶部 -->
        <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
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
