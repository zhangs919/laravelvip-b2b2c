@extends('layouts.base')

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->

@stop



@section('content')

    <!-- 内容 -->
    <link rel="stylesheet" href="/css/exchange.css?v=20180428"/>
    <!-- 积分商城内容部分 _start -->
    <div class="w1210">

        <!-- 当前位置 _start -->
        <div class="breadcrumb clearfix">
            <a href="/" class="index">首页</a>
            <span class="crumbs-arrow">&gt;</span>
            <span class="last">积分商城</span>
        </div>
        <!-- 当前位置 _end -->

        <div class="banner">

            @if(!auth('user')->check())
            <!-- 未登录的显示布局 _start -->
            <div class="banner-left">
                <div class="member">
                    <a href="/login.html">立即登录</a>
                    <p>登录后获知会员积分详情</p>
                </div>
                <div class="banner-left-info first">
                    <i class="bonus"></i>
                    <dl>
                        <dt>店铺红包</dt>
                        <dd>换取店铺红包购买商品更划算</dd>
                    </dl>
                </div>
                <div class="banner-left-info">
                    <i class="exchange"></i>
                    <dl>
                        <dt>积分兑换礼品</dt>
                        <dd>可使用积分兑换商城超值礼品</dd>
                    </dl>
                </div>
            </div>
            <!-- 未登录的显示布局 _end -->
            @else
            <!-- 登录的显示布局 _start -->
            <div class="banner-left">
                <div class="user-info-box">
                    <div class="user-header fl">
					<span class="header-img">
						<img src="{{ get_image_url(sysconf('default_user_portrait')) }}" />
					</span>
                    </div>
                    <div class="user-info fl">
                        <p>{{ auth('user')->user()->user_name }}</p>
                        <p>
                            <span class="type">会员等级：</span>
                            <img src="{{ get_image_url($user_rank_info['rank_img']) }}" />
                            <span>注册会员</span>
                        </p>
                        <a href="/user/growth-value.html">
                            <p>
                                <span class="type">当前成长值：</span>
                                {{ $user_info->rank_point ?? 0 }}
                            </p>
                        </a>
                    </div>
                </div>
                <div class="user-info-down">
                    <div class="user-info-data first">
                        <i class="my-exchange"></i>
                        <a href="/user/integral.html" target="_blank">
                            <span>我的积分</span>
                            <strong>
                                <em class="SZY-PAY-POINT">{{ $user_info->pay_point ?? 0 }}</em>
                                分
                            </strong>
                        </a>
                    </div>
                    <div class="user-info-data">
                        <i class="my-change"></i>
                        <a href="/user/integral/order-list.html" target="_blank">
                            <span>已兑换商品</span>
                            <strong>
                                <em>0</em>
                                个
                            </strong>
                        </a>
                    </div>
                </div>
            </div>
            <!-- 登录的显示布局 _end -->
            @endif

            <div class="banner-img">
                <!-- banner轮播 _star -->
                <ul id="fullScreenSlides" class="full-screen-slides">

                </ul>

                <!-- banner轮播 _end -->
            </div>
        </div>

        <!-- 热门红包兑换 _start -->
        <!---->
        <div class="hot-bonus">
            <div class="title">
                <h3>
                    <i></i>
                    红包兑换
                </h3>
                <div class="slogan s2">总有你想要的</div>
                <div class="more">
                    <a href="/integralmall/index/bonus-list.html">更多></a>
                </div>
                <div class="line"></div>
            </div>
            <div class="hot-bonus-list">
                <div class="hot-bonus-con">

                    <div class="item ">
                        <div class="item-left">
                            <p class="price">
                                <em>￥</em>
                                <strong class="num">50.00</strong>
                            </p>
                            <p class="row">
                                使用条件：

                                满399.00元可用

                            </p>
                            <p class="row issuer">发行方：阿迪达斯旗舰店</p>
                            <p class="row">
                                限品类：


                                全店通用


                            </p>
                            <p class="row">发放数量：1000</p>
                            <p class="row">使用有效期：2018-04-17 ~ 2018-12-31</p>
                        </div>
                        <div class="item-right">
                            <b class="semi-circle"></b>
                            <div class="item-right-con">
                                <p class="exchange">
                                    <strong>500</strong>
                                    <em>积分</em>
                                </p>
                                <p>红包兑换有效期</p>
                                <p class="time">不限</p>

                                <a href="javascript:void(0);" class="receive bonus-exchange" data-id="8" data-shop-id="15" data-shop-name="阿迪达斯旗舰店" data-points="500">
                                    <span class="txt">立即兑换</span>
                                </a>

                                <p id="send_number">1人兑换</p>
                            </div>
                        </div>
                    </div>

                    <div class="item ">
                        <div class="item-left">
                            <p class="price">
                                <em>￥</em>
                                <strong class="num">10.00</strong>
                            </p>
                            <p class="row">
                                使用条件：

                                红包使用条件不限

                            </p>
                            <p class="row issuer">发行方：尚客联盟采购平台</p>
                            <p class="row">
                                限品类：


                                全店通用


                            </p>
                            <p class="row">发放数量：10</p>
                            <p class="row">使用有效期：2017-06-29 ~ 2018-11-28</p>
                        </div>
                        <div class="item-right">
                            <b class="semi-circle"></b>
                            <div class="item-right-con">
                                <p class="exchange">
                                    <strong>100</strong>
                                    <em>积分</em>
                                </p>
                                <p>红包兑换有效期</p>
                                <p class="time">不限</p>

                                <a href="javascript:void(0);" class="receive bonus-exchange" data-id="2" data-shop-id="1" data-shop-name="尚客联盟采购平台" data-points="100">
                                    <span class="txt">立即兑换</span>
                                </a>

                                <p id="send_number">0人兑换</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 热门红包兑换 _end -->

        <!-- 积分商品列表 _start -->
        <div class="main">

            <div id="table_list">
                <div id="filter">
                    <form method="GET" name="listform" action="">
                        <div class="fore1">
                            <dl class="order">
                                <dd class="first curr">
                                    <a href="/integralmall.html">默认排序</a>
                                </dd>
                                <dd class="">
                                    <a href="/integralmall.html?sort=1&order=desc&is_self=&can_exchange=">
                                        兑换量
                                        <i class="iconfont icon-DESC"></i>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="/integralmall.html?sort=2&order=desc&is_self=&can_exchange=">
                                        积分值
                                        <i class="iconfont icon-DESC"></i>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="/integralmall.html?sort=3&order=desc&is_self=&can_exchange=">
                                        上架时间
                                        <i class="iconfont icon-DESC"></i>
                                    </a>
                                </dd>
                            </dl>
                            <div class="filter-btn">
                                <a href="/integralmall.html?sort=&order=&is_self=&can_exchange=1" class="filter-tag ">
                                    <input class="none" name="fff" onclick="" type="checkbox">
                                    <i class="iconfont">&#xe715;</i>
                                    <span class="text">只看我能兑换</span>
                                </a>
                            </div>
                            <div class="pagin">

                                <a class="prev disabled">
                                    <span class="icon prev-disabled"></span>
                                </a>


                                <span class="text">
								<font class="color">1</font>
								/

								1

							</span>

                                <a class="next disabled" href="javascript:;">
                                    <span class="icon next-disabled"></span>
                                </a>

                            </div>
                            <div class="total">
                                共
                                <span class="color">1</span>
                                个商品
                            </div>
                        </div>
                    </form>
                </div>
                <!-- -->
                <ul class="list-grid clearfix">

                    <!-- 如果是5的整数倍，给 li 标签添加class="last"值，即class="item last" -->
                    @foreach($list as $k=>$v)
                    <li class="item @if(($k % 5) == 0) last @endif">
                        <div class="item-con">
                            <!--售罄-->

                            <div class="item-pic">
                                <a href="{{ route('show_integral_goods', ['goods_id'=>$v->goods_id]) }}" title="{{ $v->goods_name }}" style="background: url() no-repeat center center" target="_blank">
                                    <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="{{ $v->goods_name }}" />
                                </a>
                            </div>
                            <div class="item-info">
                                <p class="item-exchange">
								<span class="sale-exchange fl">
									{{ $v->goods_integral }}
									<em>积分</em>
								</span>
                                    <em class="sale-count fr">{{ $v->exchange_number }} 人兑换</em>
                                </p>
                                <p class="item-name">
                                    <a href="{{ route('show_integral_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank" title="">{{ $v->goods_name }}</a>
                                </p>
                                <p class="item-time">
                                    @if($v->is_limit == 0)
                                        无时间条件限制
                                    @elseif($v->is_limit == 1)
                                        有效期: {{ $v->start_time }} 至 {{ $v->end_time }}
                                    @endif
                                </p>
                                <div class="item-con-info">

                                    <div class="item-shop fl">
                                        <a href="{{ route('pc_shop_home', ['shop_id'=>$v->shop_id]) }}" target="_blank" title="">{{ $v->shop->shop_name ?? '' }}</a>
                                    </div>

                                    {{--todo 需要根据当前登录用户 及该商品需要积分与用户拥有积分对比判断是否可以兑换--}}
                                    <a href="javascript:void(0)" data-goods_id="{{ $v->goods_id }}" data-goods_number="{{ $v->goods_number }}" data-diff="-1" class="goods-exchange on-exchange fr disabled">立即兑换</a>
                                    {{--<a href="javascript:void(0)" data-goods_id="11" data-goods_number="92" data-diff="-1" class="goods-exchange on-exchange fr disabled">立即兑换</a>--}}
                                    {{--<a href="javascript:void(0)" data-goods_id="11" data-goods_number="92" data-diff="9230" class="goods-exchange on-exchange fr ">立即兑换</a>--}}
                                </div>

                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>

                {!! $pageHtml !!}

            </div>

        </div>
        <!-- 积分商品列表 _end -->
    </div>
    <!-- 积分商城内容部分 _end -->
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
    <script src="/js/group_buy.js?v=20180528"></script>
    <script type="text/javascript">
        $().ready(function() {

            var tablelist = $("#table_list").tablelist({
                callback: function() {
                    $.imgloading.loading();
                }
            });

            $(".prev-page").click(function() {
                tablelist.prePage();
            });

            $(".next-page").click(function() {
                tablelist.nextPage();
            });

            $("body").on("click", ".bonus-exchange", function() {
                var id = $(this).data("id");
                var shop_id = $(this).data("shop-id");
                var shop_name = $(this).data("shop-name");
                var points = $(this).data("points");
                var confirm_text = '';
                if (shop_name != '') {
                    confirm_text = "兑换此红包，将需要扣除您<span class='color'>" + shop_name + "</span>店铺<span class='color'>" + points + "</span>积分，您确定是否兑换？";
                } else {
                    confirm_text = "兑换此红包，将需要扣除您<span class='color'>" + points + "</span>积分，您确定是否兑换？";
                }

                $.confirm(confirm_text, function() {
                    $.ajax({
                        type: "POST",
                        url: "/integralmall/index/bonus-exchange",
                        dataType: "json",
                        data: {
                            id: id,
                            shop_id: shop_id
                        },
                        success: function(result) {
                            if (result.code == 0) {
                                $("#send_number").html(result.send_number + "人兑换");
                                $(".SZY-PAY-POINT").html(result.pay_point);
                            }
                            $.msg(result.message);
                        }
                    })
                });
            });

            // 立即兑换
            $("body").on("click", ".goods-exchange", function() {

                if ($(this).hasClass("disabled")) {
                    if ($(this).data('diff') < 0) {
                        $.msg('积分不足');
                    } else if ($(this).data('goods_number') <= 0) {
                        $.msg('库存不足');
                    }
                    return;
                }
                var goods_id = $(this).data('goods_id');
                var number = 1;
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

            });

            //ajax校验
            $.get('/integralmall/index/validate', function(result) {

                if (result.code == 0) {
                    $('.SZY-PAY-POINT').html(result.data);
                }
            }, 'json');

        });
    </script>

@stop