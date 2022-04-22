@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/iconfont/iconfont.css?v=20190231"/>
@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <!-- 飞入购物车 -->
    <script src="/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <link rel="stylesheet" href="/css/swiper.min.css?v=20180702"/>
        <link rel="stylesheet" href="/css/goods.css?v=20180702"/>
        <link rel="stylesheet" href="/css/bonus_message.css?v=20180702"/>
        <link rel="stylesheet" href="/css/distributor-reg-check.css?v=20190231"/>
        <!-- 地区选择器 -->
        <script src="/assets/d2eace91/js/jquery.region.mobile.js?v=20180815"></script>
        <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
        <script src="/js/goods.js?v=20180813"></script>
        <script src="/js/swiper.jquery.min.js?v=20180813"></script>



        <div class="goods-header fixed-header">
            <div class="goods-header-left">
                <a href="javascript:history.back(-1)">
                    <i class="iconfont">&#xe606;</i>
                </a>
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
                    <div class="show-menu iconfont icon-gengduo3" id="show_more"></div>
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
                            <img data-src="{{ $v[1] }}" src="/images/m_blank.png" class="swiper-lazy">
                            <div class="swiper-lazy-preloader"></div>
                        </a>
                    </div>
                    @endforeach

                </div>
                <div class="swiper-pagination"></div>


            </div>

            <!-- 商品团购倒计时 -->
            {{--todo 判断 团购商品展示 后期再做促销功能--}}
            {{--<div class="goods-promotion-box clearfix">
                <div class="goods-promotion-left">
                    <dt>
                        <em>￥40.00</em>
                    </dt>
                    <dd>
                        <p>
                            <del>￥50.00</del>
                        </p>
                        <span>
					100
					<em>件已售</em>
				</span>
                    </dd>
                </div>
                <div class="goods-promotion-right">
                    <div class="goods-promotion-text">距结束仅剩</div>
                    <div class="goods-promotion-time" id="groupbuy_countdown">
                        <span class="time">00</span>
                        <span class="separator">:</span>
                        <span class="time">00</span>
                        <span class="separator">:</span>
                        <span class="time">00</span>
                        <span class="separator">:</span>
                        <span class="time">00</span>
                    </div>
                </div>
            </div>--}}
            <!--团购未开始样式-->



            <!-- 批发商品 -->

            <div class="goods-info bdr-bottom">
                <div class="goods-info-top">
                    <h3 class="SZY-GOODS-NAME">{{$sku['sku_name'] }}</h3>

                </div>
                <span class="goods-depict color">{{ $goods['goods_subname'] }}</span>

                <div class="goods-price">
                    <div class="now-prices">
                        <em class="SZY-GOODS-PRICE price-color">￥{{ $sku['goods_price'] }}</em>
                        <del class="SZY-MARKET-PRICE" @if(empty($sku['market_price']))style="display: none;"@endif>￥{{ $sku['market_price'] }}</del>
                    </div>

                    <span class="sold">销量：{{ $goods['sale_num'] }}件</span>

                </div>

                {{--todo 判断显示 限时折扣标签 后期再做促销功能--}}
                {{--<div class="limit-discount-con">
                    <span class="limit-discount-tag">
                        <i class="label-icon-div">
                            <i class="label-icon"></i>
                            <span class="label-text">标签</span>
                        </i>
                    </span>
                    <span class="activity-text">
                        <em class="discount"> 减5元 </em>
                        <span id="limit_discount_countdown" class="promotion-time">
                            <span class="time">00</span>
                            <span class="separator">:</span>
                            <span class="time">00</span>
                            <span class="separator">:</span>
                            <span class="time">00</span>
                            <span class="separator">:</span>
                            <span class="time">00</span>
                        </span>
                        后结束，请尽快购买！
                    </span>
                </div>--}}

                <!-- 商品赠品 -->
                <div class="SZY-GIFT-LIST">

                    {{--todo 判断是否显示 商品赠品 后期再做促销功能--}}
                    <!--买即送-->
                    {{--<div class="prom-gift ub">
                        <div class="dt">赠品</div>
                        <div class="dd ub-f1">

                            <div class="prom-gift-list">
                                <a href="/1112.html" title="彩椒  C之王">
                                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2019/01/15/15475140324781.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="20" height="20" class="gift-img" />
                                </a>
                                <em class="gift-number color">× 1</em>
                            </div>

                            <div class="prom-gift-list">
                                <a href="/1127.html" title="彩椒 123 1">
                                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2019/01/11/15472021222241.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="20" height="20" class="gift-img" />
                                </a>
                                <em class="gift-number color">× 1</em>
                            </div>

                        </div>
                    </div>--}}



                </div>
                <!-- 红包 -->
                {{--todo 判断是否显示 红包--}}
                @if(!empty($bonus_list))
                    <div class="shop-prom" onclick="select_coupon()">
                        <div class="shop-prom-title ub">
                            <dt>领红包</dt>
                            <div class="coupons ub-f1">
                                <!-- -->

                                @foreach($bonus_list as $bonus)
                                <span>满{{ $bonus['min_goods_amount'] }}减{{ $bonus['bonus_amount_format'] }}</span>

                                <!-- -->
                                @endforeach


                            </div>
                            <span class="more">
                                <i class="iconfont">&#xe607;</i>
                            </span>
                        </div>
                    </div>
                @endif

                <!-- 促销 -->
                <div class="prom-box" >
                    <div class="prom-content" onClick="select_proms()">
                        <dt>促销</dt>
                        <div class="prom-lists">
                            <!--会员特价-->
                            {{--todo 有会员特价时显示--}}
                            {{--<dd class="SZY-RANK-PRICES">
                                <div class="pro-item">
                                    <div class="pro-type">
                                        <span class="pro-type-name">会员特价</span>
                                    </div>
                                    <div class="pro-info">
                                        <span class="SZY-RANK-MESSAGE">@if(!empty($user))成为店铺会员，可享受更多优惠价格@else请登录，确认是否享受优惠@endif</span>
                                    </div>
                                </div>
                            </dd>--}}


                            <!-- 满减、满折 _start -->
                            {{--todo 有满减、满折时显示 后期再做促销功能--}}
                            {{--<dd>
                                <div class="pro-item">

                                    <div class="pro-type">
                                        <span class="pro-type-name">满减</span>
                                    </div>


                                    <div class="pro-type">
                                        <span class="pro-type-name">包邮</span>
                                    </div>


                                </div>
                            </dd>--}}

                            <!-- 满减、满折 _end -->

                            <!--搭配套餐-->
                            {{--todo 有搭配套餐时显示--}}

                        </div>
                        <span class="more">
                            <i class="iconfont">&#xe607;</i>
                        </span>
                    </div>
                </div>


                <!-- 促销活动弹出层 _start -->
                <div class="f_block" id="proms_coupon">
                    <div class="prom-coupon">
                        <div class="discount-coupon-header">
                            <h2>促销</h2>
                            <a class="choose-attribute-close" href="javascript:void(0)" onclick="close_choose_proms();"></a>
                        </div>
                        <ul class="coupon-list">


                            <li class="items SZY-RANK-PRICES" style="display: none;">
                                <div class="pro-item more-member-info">
                                    <div class="pro-type">
                                        <span class="pro-type-name">会员特价</span>
                                    </div>
                                    <div class="pro-info">
                                        <span class="SZY-RANK-MESSAGE"></span>
                                        <div class="member-rules-bd">

                                        </div>
                                    </div>
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

                            <!-- -->
                            <li class="items hide">
                                <div class="pro-item">
                                    <div class="pro-type">
                                        <span class="pro-type-name">满减</span>
                                    </div>
                                    <div class="pro-info">

                                        <p>满5元，减3元、包邮；</p>

                                        <p>满10元，减5元；</p>

                                    </div>
                                </div>
                            </li>

                            <!-- 搭配套餐弹出层 _start -->
                            <!-- 搭配套餐弹出层 _end -->

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

            <!-- 虚拟商品判断 -->
            {{--todo 判断 是否显示--}}
            @if(sysconf('goods_info_freight') == 0)
                {{--goods_info_freight=0 显示具体运费--}}
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
                <div class="freight freight-info">￥12.00</div>
            @endif

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


            {{--保障服务 如果无保障服务 不显示--}}
            @if(!empty($goods['contract_list']))
            <div class="service-con">

                @foreach($goods['contract_list'] as $v)
                <div class="service-item">

                    <i class="support-service-icon"></i>

                    <span class="service-icon-text">{{ $v['contract_name'] }}</span>

                </div>
                @endforeach

            </div>
            @endif

            <!-- 拼团活动_start -->



            <!-- 拼团活动_end -->

            <!-- 砍价活动_start -->



            <!-- 砍价活动_end -->

            {{--获取商品最新的一条评价信息 没有时 不显示--}}
            @if(!empty($goods['comment']))
            <div class="blank-div"></div>
            <div class="good-comment-box">
                <div class="good-comment-item">
                    <div class="good-comment-item-top clearfix">
                        <h3>宝贝评价({{ $goods['comment_count'] }})</h3>
                        <span class="SZY-ALL-COMMENT color">
					查看全部
					<i class="iconfont"></i>
				</span>
                    </div>
                    <ul>
                        <li>
                            <div class="user-info">
						<span class="face">
							<img src="{{ get_image_url($goods['comment']['headimg'], 'headimg') }}" class="user_img">
						</span>
                                <span class="user-name">

							{{ $goods['comment']['user_name_encrypt'] }}

						</span>

                                <!-- <span class="user-level">
                                    <img alt="{{ $goods['comment']['rank_name'] }}" src="{{ $goods['comment']['rank_img'] }}">
                                </span> -->

                            </div>
                            <div class="rate-list">
                                <p>{!! $goods['comment']['comment_desc'] !!}</p>
                                <p class="attr-info">
                                    <em>{{ format_time($goods['comment']['comment_time'], 'Y-m-d H:i:s') }}</em>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- <div class="app-detail">
                    <div class="sys-btn">
                        <span class="SZY-ALL-COMMENT">查看全部评价</span>
                    </div>
                </div> -->
            </div>
            @endif

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

                                @if($shop_info['shop']['is_own_shop'])
                                    <em class="bg-color">自营</em>
                                @endif
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
                        <img src="/images/loading.gif" width="20" height="20">
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
        <div class="goods-evaluate user-goods-ka hide" id="goods-evaluate"></div>
        <!-- 服务承诺 -->
        <!--红包弹出层-->
        <div class="f_block spec-menu-hide" id="select_coupon">
            <div class="discount-coupon">
                <div class="discount-coupon-header">
                    <h2>
                        领取红包
                        <a class="choose-attribute-close" href="javascript:void(0)" onclick=" close_choose_coupon();"></a>
                    </h2>
                </div>
                <div class="coupon-list">
                    <ul class="coupon-item-ing">
                        @foreach($bonus_list as $bonus)
                        <li>
                            <div class="coupon-info ">
                                <div class="coupon-dots">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                                <div class="coupon-item-left bg-color">
							<span class="coupon-money">
								<i>￥</i>
								<em>{{ format_price($bonus['bonus_amount'],0) }}</em>
							</span>
                                    <h3>满{{ format_price($bonus['min_goods_amount'], 0) }}元使用</h3>
                                </div>
                                <div class="coupon-item-right">
                                    <div class="coupon-left-top">
                                        <p class="coupon-name">{{ $bonus['bonus_name'] }}</p>
                                    </div>
                                    <div class="coupon-left-bottom">
                                        <span class="coupon-time"> {{ $bonus['start_time_format'] }}-{{ $bonus['end_time_format'] }} </span>
                                        <div class="op-btns">

                                        @if($bonus['is_receive'])

                                            <!-- 已领取的红包 _start -->
                                            <a href="javascript:void(0);" class="coupon-btn border-color bonus-received">已领取</a>
                                            <!-- 领取的红包 _end -->
                                        @else
                                            <!-- 未领取的红包 _start -->
                                            <a href="javascript:void(0);" title="点击领取红包" data-bonus-id="{{ $bonus['bonus_id'] }}" class="bonus-receive color coupon-btn border-color">领取</a>
                                            <!-- 未领取的红包 _end -->
                                        @endif

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        <!--会员等级价格弹出层-->
        <div class="rank-price-content rank-price-back">

            <ul>



                <li>

                    <p>高级会员(VIP2)：</p>

                    <span>￥48.89</span>

                </li>



            </ul>

            <div class="rank-price-btn">

                <a href="javascript:void(0);" class="bg-color">关闭</a>

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


        <a href="javascript:void(0)" class="qr-code" data-uuid="" style="display: none">
            <i></i>
        </a>
        <!--微信分享弹出层-->
        <div class="give-share-popup hide" onclick="colse_bdshare_popup()">
            <img src="/images/give-share-popup.png">
        </div>
        <!--小程序分享弹出层-->
        <div class="mini-program-share-popup hide">
            <img src="/images/mini-program-share-popup.png">
        </div>
        <script type="text/javascript">
            $('.mini-program-share-popup').click(function () {
                $(this).addClass('hide');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            })
        </script>

        <!-- 分享 -->
        <script src="http://res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
        <script type="text/javascript">
            $().ready(function() {

                // $("body").append('<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><\/script>');

                var url =  location.href;

                if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState){
                    if(url.indexOf("?") == -1){
                        url += "?user_id=";
                    }else{
                        url += "&user_id=";
                    }
                }else{
                    url = location.href.split('#')[0];
                }

                if ("{{ $user_info['user_id'] ?? '' }}" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState){
                    if(url.indexOf("?") == -1){
                        url += "?user_id=" + "{{ $user_info['user_id'] ?? '' }}";
                    }else{
                        url += "&user_id=" + "{{ $user_info['user_id'] ?? '' }}";
                    }
                }else{
                    url = location.href.split('#')[0];
                }

                        @if(!empty($user_info))
                var share_url = "{{ route('mobile_show_goods',['goods_id'=>$goods['goods_id']]) }}?user_id={{ $user_info['user_id'] }}";
                        @else
                var share_url = "";
                @endif

                if (share_url == '') {
                    share_url = url;
                }

                $.ajax({
                    type: "GET",
                    url: "/index/information/get-weixinconfig.html",
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
            });
        </script>

        <script type="text/javascript">
            function miniprogramready() {
                var share_info = {
                    title: '陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很-商之翼1',
                    imgUrl: 'http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036307529844.jpg'
                };
                wx.miniProgram.postMessage({
                    data: share_info
                });
            }
            if (!window.WeixinJSBridge || !WeixinJSBridge.invoke) {
                document.addEventListener('WeixinJSBridgeReady', miniprogramready, false);
            } else {
                miniprogramready();
            }
        </script>


        <script type="text/javascript">
            $('.procedure-tip-btn').click(function(){
                $('.pre-sale-rule-box').addClass('show');
                $('.pre-sale-rule-close').addClass('show');
            });
            $('.pre-sale-rule-close,.pre-sale-rule-box,.rule-footer-btn').click(function(){
                $('.pre-sale-rule-box').removeClass('show');
                $('.pre-sale-rule-close').removeClass('show');
            });

            $('body').on('click', '.content-down',function(){
                $(".give-share-popup").removeClass('hide');
                scrollheight = $(document).scrollTop();
                $("body").css("top", "-" + scrollheight + "px");
                $("body").addClass("visibly");
            });


            /* 分享弹出 */
            function bdshare_popup() {
                if (window.__wxjs_environment !== 'miniprogram') {
                    $(".give-share-popup").removeClass('hide');
                } else {
                    $('.mini-program-share-popup').removeClass('hide');
                }
                scrollheight = $(document).scrollTop();
                $("body").css("top", "-" + scrollheight + "px");
                $("body").addClass("visibly");
            }


            function colse_bdshare_popup() {
                $(".give-share-popup").addClass('hide');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            }

            $('body').on('click','.colse-bdshare-popup',function(){
                $(".give-share-popup").addClass('hide');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
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
            var widthmobile=$(document).width()-50;
            console.info(widthmobile);
            if (IsPC()) {
                $(window).scroll(function() {
                    if ($(window).scrollTop() <= widthmobile) {
                        $(".goods-header").addClass('fixed-header');
                    } else {
                        $(".goods-header").removeClass('fixed-header');
                    }
                    if($('.goods-evaluate').is(':hidden')){

                        if($(window).scrollTop() >= $('.user-goods-ka').eq(1).offset().top){
                            $('.goods-header-nav li').eq(1).addClass('cur').siblings().removeClass('cur');
                        }else{
                            $('.goods-header-nav li').eq(0).addClass('cur').siblings().removeClass('cur');
                        }
                    }
                });
            } else {
                $(document).bind("touchmove", function(event) {
                    $(window).scroll(function() {
                        if ($(window).scrollTop() <= widthmobile) {
                            $(".goods-header").addClass('fixed-header');
                        } else {
                            $(".goods-header").removeClass('fixed-header');
                        }
                        if($('.goods-evaluate').is(':hidden')){
                            if($(window).scrollTop() >= $('.user-goods-ka').eq(1).offset().top){
                                $('.goods-header-nav li').eq(1).addClass('cur').siblings().removeClass('cur');
                            }else{
                                $('.goods-header-nav li').eq(0).addClass('cur').siblings().removeClass('cur');
                            }
                        }
                    });
                });
            }
            function IsPC() {
                var userAgentInfo = navigator.userAgent;
                var Agents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
                var flag = true;
                for (var v = 0; v < Agents.length; v++) {
                    if (userAgentInfo.indexOf(Agents[v]) > 0) {
                        flag = false;
                        break;
                    }
                }
                return flag;
            }

            function getHistoryUrl(url){
                url = url.split('&split');
                return url[0];
            }

            window.addEventListener("popstate",function(res) {

                document.title = '陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很';
                if(location.href.indexOf('&goods') != -1){
                    $('.goods-header-nav li').eq(0).addClass('cur').siblings().removeClass('cur');
                    $('.goods-header').addClass('fixed-header');
                    $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                    $('html,body').scrollTop($('.user-goods-ka').eq(0).offset().top + 5);
                }else if(location.href.indexOf('&desc') != -1){
                    $('.goods-header-nav li').eq(1).addClass('cur').siblings().removeClass('cur');
                    $('.goods-header').removeClass('fixed-header');
                    $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                    $('html,body').scrollTop($('.user-goods-ka').eq(1).offset().top + 5);
                }else if(location.href.indexOf('&comment') != -1){
                    $('.goods-header-nav li').eq(2).addClass('cur').siblings().removeClass('cur');
                    $('.goods-header').removeClass('fixed-header');
                    $('.goods-evaluate').show().siblings('.user-goods-ka').hide();
                    $('.goods-header').addClass('fixed-header-two');
                }else{
                    $('.goods-header-nav li').eq(0).addClass('cur').siblings().removeClass('cur');
                    $('.goods-header').addClass('fixed-header');
                    $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                    $('html,body').scrollTop($('.user-goods-ka').eq(0).offset().top + 5);
                }
            });

            $('.goods-header-nav li').click(function(){
                if($(this).hasClass('cur')){
                    return;
                }
                if($('.goods-header').hasClass('fixed-header-two')){
                    $('.goods-header').removeClass('fixed-header-two');
                }
                if($(this).index() == 0){
                    $('.goods-header').addClass('fixed-header');
                    $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                    $('html,body').animate({
                        scrollTop: $('.user-goods-ka').eq(0).offset().top + 5
                    }, 500);
                    history.pushState({}, '陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很', getHistoryUrl(location.href)+'&split&goods');
                }else if($(this).index() == 1){
                    $('.goods-header').removeClass('fixed-header');
                    $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                    $('html,body').animate({
                        scrollTop: $('.user-goods-ka').eq(1).offset().top + 5
                    }, 500);
                    history.pushState({}, '陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很', getHistoryUrl(location.href)+'&split&desc');
                }else if($(this).index() == 2){
                    $(this).addClass('cur').siblings().removeClass('cur');
                    $('.goods-header').removeClass('fixed-header');
                    $('.goods-evaluate').show().siblings('.user-goods-ka').hide();
                    $('.goods-header').addClass('fixed-header-two');
                    history.pushState({}, '陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很', getHistoryUrl(location.href)+'&split&comment');
                }
            });
            $('.goods-details-nav li').click(function(){
                $(this).addClass('current').siblings().removeClass('current');
                $('.goods-details-tab').eq($(this).index()).show().siblings('.goods-details-tab').hide();
            });

            // 销量和收藏数切换
            $('.sale-collect-nav li').click(function(){
                $(this).addClass('current').siblings().removeClass('current');
                $('.sale-collect-tab').eq($(this).index()).show().siblings('.sale-collect-tab').hide();
            });
            // 点击跳转详情
            $('.scroll-tips').click(function() {
                $('html,body').scrollTop(0);
                $('.goods-header-nav li').removeClass('cur');
                $('.goods-header-nav li').eq(1).addClass('cur');
                $('.user-goods-ka').eq(1).show().siblings('.user-goods-ka').hide();
            });

            // 点击跳转到评价详情
            $('.SZY-ALL-COMMENT').click(function(){
                $('.goods-header-nav li').removeClass('cur');
                $('.goods-header-nav li').eq(2).addClass('cur');
                $('.user-goods-ka').eq(2).show().siblings('.user-goods-ka').hide();
                $('.goods-header').addClass('fixed-header-two');
                history.pushState({}, '', getHistoryUrl(location.href)+'&split&comment');
            });
        </script>


        <!--底部菜单 start-->

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
            <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=410284576&amp;site=qq&amp;menu=yes" class="nav-button customer">
                <em class="goods-qq-nav"></em>
                <span>客服</span>
            </a>	<div class="btn-group">
                <dl class="ub">



                    <dd class="flow">
                        <a href="javascript:void(0)" class="button" onclick="select_spec('add-cart')">加入购物车</a>
                    </dd>
                    <dd>
                        <a href="javascript:void(0)" class="button" onclick="select_spec('buy-goods')">立即购买</a>
                    </dd>



                </dl>
            </div>
        </div>

        <div class="choose-attribute-mask"></div>
        <div class="choose-attribute-main" id="choose_attr">
            <div class="choose-attribute-header clearfix">
                <div class="choose-attribute-pic">
                    <img class="SZY-GOODS-IMAGE-THUMB" src="{{ get_image_url($sku['sku_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" />
                </div>
                <div class="attribute-header-right">
                    <span class="goodprice price-color choose-result-price SZY-GOODS-PRICE"> ￥{{ $sku['goods_price'] }} </span>
                    <p>

                        <i class="SZY-GOODS-NUMBER">库存：{{ $sku['goods_number'] }}件</i>

                        {{--todo 限购商品展示--}}
                        <i>（每人限购5件）</i>

                    </p>

                    {{--判断 有规格时显示--}}
                    @if(!empty($sku['spec_attr_value']))
                    <span class="choose-result-attr SZY-GOODS-SPEC">
                        已选：
                        <i>



                            {{ $sku['spec_attr_value'] }}



                        </i>
                    </span>
                    @endif

                </div>
                <a class="choose-attribute-close" href="javascript:close_choose_spec();" title="关闭"> </a>
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
                                <span class="decrease amount-minus">
                                    <i class="row"></i>
                                </span>
                                <input type="number" class="amount-input num" value="1" data-amount-min="1" data-amount-max="{{ $sku['goods_number'] }}" maxlength="8" title="请输入购买量" onclick="$(this).select();">
                                <span class="increase amount-plus">
                                    <i class="row"></i>
                                    <i class="col"></i>
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

                    var act_type = "11";
                    var purchase = "15";
                    var pre_sale = "2";
                    var virtual = "0";
                    var is_lib_goods = "";
                    if (is_lib_goods == true) {
                        return;
                    }
                    if ($(this).hasClass("disabled")) {
                        return;
                    }

                    var sku_id = getSkuId();
                    var number = $(".goods-num").find('.num').val();
                    var data = {};
                    if (act_type == 'purchase' || act_type == 'pre_sale') {
                        data.act_type = act_type;
                    }
                    if (virtual > 0) {
                        data.virtual = virtual;
                    }
                    $.cart.quickBuy(sku_id, number, data);
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
                                $(".goods-num").find('.num').val(1);
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
                /* if (window.__wxjs_environment === 'miniprogram') {
                    var service_tel = '18108765433';
                    if (service_tel != '' || service_tel != null) {
                        $('.customer').attr('href', 'tel:' + service_tel);
                        $('.customer').attr('class', 'nav-button customer');
                        $('.customer').html('<em class="goods-phone-nav"></em><span>电话</span>');
                    } else {
                        $('.customer').attr('href', 'javascript:void(0)');
                        $('.customer').attr('onClick', '$.msg("卖家没有设置联系电话")');
                        $('.customer').attr('class', 'nav-button customer');
                    }
                } */
            });
        </script>

        <!--底部菜单 end-->
        <section class="mask-div" style="display: none;" onclick="close_coupon();"></section>
        {{--判断 登录状态显示--}}
        @if(!empty($user_info))
        <script type="text/javascript">
            var url =  location.href;
            if (url.indexOf("user_id=") == -1 && window.history && history.pushState){
                if(url.indexOf("?") == -1){
                    url += "?user_id=" + "{{ $user_info['user_id'] }}";
                }else{
                    url += "&user_id=" + "{{ $user_info['user_id'] }}";
                }
                history.replaceState(null, document.title, url);
            }
        </script>
        @endif


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
        <!--身份验证-->
        <link rel="stylesheet" href="/css/login.css?v=20180702"/>
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
        <div class="preview-attribute-pic hide"></div>

        <script type="text/javascript">
            $(document).ready(function(){
                /*图片预览 start*/
                $("#goods_pic .SZY-GOODS-IMAGE").on("click", ".swiper-slide a img", function() {
                    //$(this).parents('#goods_pic').addClass('preview-picture');
                    if ($(this).parents('#goods_pic').hasClass('preview-picture')) {
                        $('#goods_pic').removeClass('preview-picture');
                        $('.icon-guanbi').remove();
                    }
                    else{
                        $('#goods_pic').addClass('preview-picture');
                        //document.getElementById("goods_pic").innerHTML+'<i class='iconfont icon-guanbi'></i>';
                        var em=document.createElement("i");
                        em.setAttribute("class", "iconfont icon-guanbi");
                        $('#goods_pic').append(em);
                    }
                });
                $(document).bind("click",function(e){
                    if($('#goods_pic').hasClass('preview-picture')){
                        var target  = $(e.target);
                        if(target.closest(".swiper-slide").length == 0){
                            $('#goods_pic').removeClass('preview-picture');
                            $('.icon-guanbi').remove();
                        }
                    }
                })
                $('body').on('click','.icon-guanbi',function(){
                    $('#goods_pic').removeClass('preview-picture');
                    $('.icon-guanbi').remove();
                })
            });
            /*图片预览 end*/
            /*弹层内容预览*/
            $('.choose-attribute-pic').on('click','img',function(){
                var imgBox = $(this).parents(".choose-attribute-pic").find("img");
                $(".preview-attribute-pic").append('<img src="' + imgBox.attr("src") + '" / >');
                $(".preview-attribute-pic").removeClass('hide');
                var em=document.createElement("i");
                em.setAttribute("class", "iconfont icon-guanbi");
                $('.preview-attribute-pic').append(em);
            })
            $(".preview-attribute-pic,.preview-attribute-pic .icon-guanbi").on("click",
                function() {
                    $(this).addClass('hide');
                    $(".preview-attribute-pic img").remove();
                    $('.icon-guanbi').remove();
                });
        </script>


        {{--todo 判断 团购商品倒计时显示--}}
        <script type="text/javascript">
            $().ready(function() {
                // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
                $("#groupbuy_countdown").countdown({
                    time: "604741000",
                    leadingZero: true,

                    htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",

                    onComplete: function(event) {
                        $(this).parent('.goods-promotion-right').html("团购活动已结束！");
                        $.go("{{ route('mobile_show_goods',['goods_id'=>$goods['goods_id']]) }}");
                    }
                });
            });
        </script>

        {{--todo 判断 限时折扣倒计时显示--}}
        <!-- 倒计时 -->
        <script type="text/javascript">
            $().ready(function() {
                // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
                $("#limit_discount_countdown").countdown({
                    time: "603248000",
                    leadingZero: true,

                    htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",

                    onComplete: function(event) {
                        //$(this).parent().html("活动已结束！");
                        $.go("{{ route('mobile_show_goods',['goods_id'=>$goods['goods_id']]) }}");
                    }
                });
            });
        </script>

        <!-- 预售倒计时 -->

        <script type="text/javascript">
            var goods_pic_swiper = new Swiper('#goods_pic', {
                lazyLoading : true,
                lazyLoadingInPrevNext: true,
                autoplayDisableOnInteraction: true,
                pagination : '.swiper-pagination',
                paginationType : 'fraction',
                loop: true,
                observer:true,//修改swiper自己或子元素时，自动初始化swiper
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

                // 门店自提
                $("body").on('click', '.pickup', function() {
                    $.go('/pickup/{{ $shop_info['shop']['shop_id'] }}.html');
                });

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
            //
            //
            //加载评论
            function loadComment() {
                $.ajax({
                    type: "get",
                    url: '/goods/comment',
                    dataType: 'json',
                    data: {
                        sku_id: '1127',
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
            //
            //
        </script>
        <script src="/assets/d2eace91/js/jquery.history.js?v=20190121"></script>
        <script type="text/javascript">
            var main_image_size = "2";
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
                            // 区域限售商品
                            //goods_number = sku_freights[local_region_code].goods_number;
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
                $(".selected-attr.SZY-GOODS-SPEC").html("已选：<i class='i_dd ub-f1'>"+sku.spec_attr_value+"</i>	<span class='more'><i class='iconfont'>&#xe607;</i></span>");
                $(".choose-result-attr.SZY-GOODS-SPEC").html("已选：<i class='i_dd'>"+sku.spec_attr_value+"</i>");
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
                    $(".SZY-GIFT-LIST").html("");
                    var element = $($.parseHTML('<div class="prom-gift"></div>'));
                    element.append('<div class="dt">赠品</div><div class="dd"></div>');
                    for (var i = 0; i < sku.gift_list.length; i++) {
                        var gift = sku.gift_list[i];
                        element.find('.dd:last').append('<div class="prom-gift-list"><a href="/'+ gift.gift_sku_id +'.html" title="'+gift.sku_name+'"><img src="'+gift.goods_image_thumb+'" width="20" height="20" class="gift-img" /></a><em class="gift-number color">× '+gift.gift_number+'</em></div>')
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

                    $("title").html("彩椒");
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
                            if(result.data == 0){
                                $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                            }
                            $.msg(result.message);
                            return;
                        } else if (result.code == 130) {
                            $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                        } else if (result.code == 131) {
                            $(target).html("已抢光").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                            $(target).parents('.coupon-info').addClass('coupon-item-ed');
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
                                $('.bar-amount').html('￥'+result.bar_info.bar_amount);
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
                                $('.bar-amount').html('￥'+result.bar_amount);
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

        <script type="text/javascript">
            var goods_share_mode = "php"
            var qrcode_type = '0';
            var click_loading = false;

            // 商品分享
            $('body').on('click', '.qr-code', function(event){
                var obj = $(this);
                if($('#goods_share_'+$(obj).attr('data-uuid')).length > 0){
                    $('#goods_share_'+$(obj).attr('data-uuid')).show();
                    return ;
                }
                if(click_loading == false){
                    click_loading = true;
                    $(obj).goodsshare({
                        goods_id: '{{ $goods['goods_id'] }}',
                        mode: goods_share_mode,
                        qrcode_type: qrcode_type,
                        callback: function(res){
                            click_loading = false;
                            $(obj).attr('data-uuid',res.uuid);
                        }
                    });
                }
            });
            $('.qr-code').show();

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
        <script src="/assets/d2eace91/js/geolocation/amap.js?v=20190121"></script>
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
        <div class="copyright">
            <div class="footer-copyright">
                <a class="copyright-img" href="javascript:go_laravelvip()">
                    <img src="/images/support-logo.png">
                    技术支持：乐融沃
                </a>
            </div>
        </div>
        <script type="text/javascript">
            function go_laravelvip() {
                if (window.__wxjs_environment !== 'miniprogram') {
                    window.location.href = 'http://m.laravelvip.com/statistics.html?product_type=shop&domain=http://{{ env('MOBILE_DOMAIN') }}';
                } else {
                    window.location.href = 'http://{{ env('MOBILE_DOMAIN') }}';
                }
            }
        </script>
        <div style="height: 50px;"></div>
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