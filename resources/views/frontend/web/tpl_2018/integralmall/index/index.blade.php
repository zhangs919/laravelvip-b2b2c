@extends('layouts.base')

@section('header_css')
    <link href="/css/exchange.css" rel="stylesheet">
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop





@section('content')

    <!-- 内容 -->
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
						<img src="{{ get_image_url($default_user_portrait) }}" />
					</span>
                    </div>
                    <div class="user-info fl">
                        <p>{{ $user['user_name'] }}</p>
                        <p>
                            <span class="type">会员等级：</span>
                            <img src="{{ get_image_url($user_rank['rank_img']) }}" />
                            <span>{{ $user_rank['rank_name'] }}</span>
                        </p>
                        <a href="/user/growth-value.html">
                            <p>
                                <span class="type">当前成长值：</span>
                                {{ $user['rank_point'] ?? 0 }}
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
                                <em class="SZY-PAY-POINT">{{ $user['pay_point'] ?? 0 }}</em>
                                分
                            </strong>
                        </a>
                    </div>
                    <div class="user-info-data">
                        <i class="my-change"></i>
                        <a href="/user/integral/order-list.html" target="_blank">
                            <span>已兑换商品</span>
                            <strong>
                                <em>{{ $exchanged_count }}</em>
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
                    @if(!empty($banner))
                        @foreach($banner as $k=>$v)
                            <li style="background: url({{ get_image_url($v['img']) }}) center no-repeat; @if($k == 0){{ 'display: list-item;' }}@else{{ 'display: none;' }}@endif">
                                <a href="{{ $v['link'] }}" target="_blank" title="">&nbsp;</a>
                            </li>
                        @endforeach
                    @endif
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

                    @foreach($bonus_list as $v)
                    <div class="item ">
                        <div class="item-left">
                            <p class="price">
                                <em>￥</em>
                                <strong class="num">{{ $v['bonus_amount'] }}</strong>
                            </p>
                            <p class="row">
                                使用条件：

                                满{{ $v['min_goods_amount'] }}元可用

                            </p>
                            <p class="row issuer">发行方：{{ $v['shop_name'] }}</p>
                            <p class="row">
                                限品类：

                                @if($v['use_range'] == 0)
                                全店通用
                                @elseif($v['use_range'] == 1)
                                指定商品
                                @endif


                            </p>
                            <p class="row">发放数量：{{ $v['bonus_number'] }}</p>
                            <p class="row">使用有效期：{{ $v['start_time_format'] }} ~ {{ $v['end_time_format'] }}</p>
                        </div>
                        <div class="item-right">
                            <b class="semi-circle"></b>
                            <div class="item-right-con">
                                <p class="exchange">
                                    <strong>{{ $v['bonus_data']['exchange_points'] ?? 0 }}</strong>
                                    <em>积分</em>
                                </p>
                                <p>红包兑换有效期</p>
                                <p class="time">不限</p>

                                <a href="javascript:void(0);" class="receive bonus-exchange" data-id="{{ $v['bonus_id'] }}"
                                   data-shop-id="{{ $v['shop_id'] }}" data-shop-name="{{ $v['shop_name'] }}" data-points="{{ $v['bonus_data']['exchange_points'] ?? 0 }}">
                                    <span class="txt">立即兑换</span>
                                </a>

                                <p id="send_number">{{ $v['receive_number'] }}人兑换</p>
                            </div>
                        </div>
                    </div>
                    @endforeach



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
                                <a href="{{ route('show_integral_goods', ['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" style="background: url() no-repeat center center" target="_blank">
                                    <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="{{ $v['goods_name'] }}" />
                                </a>
                            </div>
                            <div class="item-info">
                                <p class="item-exchange">
								<span class="sale-exchange fl">
									{{ $v['goods_integral'] }}
									<em>积分</em>
								</span>
                                    <em class="sale-count fr">{{ $v['exchange_number'] }} 人兑换</em>
                                </p>
                                <p class="item-name">
                                    <a href="{{ route('show_integral_goods', ['goods_id'=>$v['goods_id']]) }}" target="_blank" title="">{{ $v['goods_name'] }}</a>
                                </p>
                                <p class="item-time">
                                    @if($v['is_limit'] == 0)
                                        无时间条件限制
                                    @elseif($v->is_limit == 1)
                                        有效期: {{ $v['start_time'] }} 至 {{ $v['end_time'] }}
                                    @endif
                                </p>
                                <div class="item-con-info">

                                    <div class="item-shop fl">
                                        <a href="{{ route('pc_shop_home', ['shop_id'=>$v['shop_id']]) }}" target="_blank" title="">{{ $v['shop_name'] }}</a>
                                    </div>

                                    {{--todo 需要根据当前登录用户 及该商品需要积分与用户拥有积分对比判断是否可以兑换--}}
                                    <a href="javascript:void(0)" data-goods_id="{{ $v['goods_id'] }}" data-goods_number="{{ $v['goods_number'] }}" data-diff="{{ $v['diff'] }}" class="goods-exchange on-exchange fr disabled">立即兑换</a>
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
    <script type="text/javascript">
        //
    </script>

@stop


{{--底部js--}}
@section('footer_js')
    <script src="/js/index.js"></script>
    <script src="/js/tabs.js"></script>
    <script src="/js/bubbleup.js"></script>
    <script src="/js/jquery.hiSlider.js"></script>
    <script src="/js/index_tab.js"></script>
    <script src="/js/jump.js"></script>
    <script src="/js/nav.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/jquery.lazyload.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/js/requestAnimationFrame.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/js/group_buy.js"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                callback: function() {
                    $.imgloading.loading();
                }
            });
            $('body').on('click','.prev-page',function(){
                tablelist.prePage();
            });
            $('body').on('click','.next-page',function(){
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
                                $("#send_number").html("已兑换" + result.send_number + "次");
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
            $('body').on('click', '.use-range-info', function() {
                var bonus_id = $(this).data('bonus_id');
                var title = $(this).data('title');
                $.loading.start();
                $.open({
                    type: 1,
                    area: ['702px', '400px'],
                    title: title,
                    btn: ['关闭'],
                    btnAlign: 'c',
                    ajax: {
                        url: '/integralmall/index/view-bonus-use-range',
                        data: {
                            bonus_id: bonus_id
                        }
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        });
        //
        //解决因为缓存导致获取分类ID不正确问题，需在ready之前执行
        $(".SZY-DEFAULT-SEARCH").data("cat_id", "");
        $().ready(function() {
            $(".SZY-SEARCH-BOX-KEYWORD").val("");
            $(".SZY-SEARCH-BOX-KEYWORD").data("search_type", "");
            //
            $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-SUBMIT").click(function() {
                if ($(".search-li.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入要搜索的关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                        $(keyword_obj).val(keywords);
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
        //
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        //
        $().ready(function() {
        })
        //
    </script>
@stop
