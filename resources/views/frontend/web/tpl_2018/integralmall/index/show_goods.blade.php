@extends('layouts.base')

@section('header_css')
    <link href="/css/goods.css" rel="stylesheet">
    <link href="/css/online.css" rel="stylesheet">
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop




@section('content')

    <!-- 内容 -->
    <!-- css -->
    <!-- 地区选择器 -->
    <!-- 放大镜 _start -->
    <!-- 放大镜 _end -->
    <div class="w1210">

        <div class="breadcrumb clearfix">
            <a href="/" class="index">首页</a>
            <span class="crumbs-arrow">&gt;</span>
            <a href="/integralmall.html" class="last">积分商城</a>
            <span class="crumbs-arrow">&gt;</span>
            <a href="{{ route('show_integral_goods', ['goods_id'=>$goods['goods_id']]) }}" class="last">{{ $goods['goods_name'] }}</a>
        </div>
        <div class="goods-info">
            <!-- 商品图片以及相册 _star-->
            <div id="preview" class="preview">
                <!-- 商品相册容器 -->
                <div class="goodsgallery"></div>
                <script id="SZY_GOODS_IMAGES" type="text">{!! json_encode($goods['goods_images']) !!}</script>
                <script type="text/javascript">
                    //
                </script>
                <!--相册 END-->
                <div class="goods-gallery-bottom"></div>
            </div>
            <!-- 商品详细信息 _star-->
            <div class="detail-info">
                <form action="" method="post" name="" id="">

                    <!-- 商品名称 -->
                    <h1 class="goods-name SZY-GOODS-NAME">{{ $goods['goods_name'] }}</h1>
                    <!-- 商品简单描述 -->
                    <!-- <p class="goods-brief second-color"></p> -->

                    <div class="goods-price">
                        <div class="now-prices">
                            <span class="price">售&nbsp;&nbsp;&nbsp;价</span>
                            <font class="market-price">
                                <s>￥{{ $goods['market_price'] }}</s>
                            </font>
                        </div>
                        <div class="goods-price">
                            <div class="goods-info-other">
                                <div class="item">
                                    <p>累计兑换</p>
                                    <em class="second-color">{{ $goods['exchange_number'] }}</em>
                                </div>
                            </div>
                            <div class="realy-price">
                                <div class="now-prices">
                                    <span class="price">积&nbsp;&nbsp;&nbsp;分</span>
                                    <strong class="p-price second-color SZY-GOODS-POINTS">{{ $goods['goods_integral'] }}积分</strong>
                                </div>
                            </div>
                        </div>
                        <div class="now-prices">
                            <span class="price">兑换时间</span>
                            <strong class="p-price second-color">

                                @if($goods['is_limit'] == 0)
                                    无时间条件限制
                                @elseif($goods['is_limit'] == 1)
                                    有效期: {{ $goods['start_time'] }} 至 {{ $goods['end_time'] }}
                                @endif

                            </strong>
                        </div>
                    </div>

                    <div class="choose SZY-GOODS-SPEC-ITEMS">


                        <!-- 自提点 -->
                        <div class="pickup">
                            <div class="dt">自提点</div>
                            <div class="dd">
                                <div class="pickup-info">
                                    <a href="javascript:void(0);" id="self_pickup">
                                        <i class="iconfont color">&#xe6a7;</i>
                                        <span>上门自提</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- 购买数量 -->
                        <dl class="amount">
                            <dt class="dt">数&nbsp;&nbsp;&nbsp;量</dt>
                            <dd class="dd">
							<span class="amount-widget">
								<input type="text" class="amount-input" value="1" data-goods_id="{{ $goods['goods_id'] }}" data-amount-min="1" data-amount-max="{{ $goods['goods_number'] }}" maxlength="8" title="请输入购买量">
								<span class="amount-btn">
									<span class="amount-plus">
										<i>+</i>
									</span>
									<span class="amount-minus">
										<i>-</i>
									</span>
								</span>
								<span class="amount-unit">件</span>
							</span>
                                <em class="stock">

                                    库存{{ $goods['goods_number'] }}件

                                </em>

                            </dd>
                        </dl>

                        <div class="action">

                            @if(empty($user_info))
                            <div class="btn-buy">
                                <a href="/login.html" class="buy-enable bg-color">
                                    <span class="buy-goods-bg bg-color"></span>
                                    <span class="buy-goods-border"></span>
                                    立即登录
                                </a>
                            </div>
                            @else
                            <div class="btn-buy">
                                <a href="javascript:void(0);" class="exchange-goods color disabled" data-message="积分不足" data-goods_number="{{ $goods['goods_number'] }}">
                                    <span class="buy-goods-bg bg-color"></span>
                                    <span class="buy-goods-border"></span>
                                    立即兑换
                                </a>
                            </div>
                            @endif

                        </div>
                    </div>
                </form>
            </div>

            @if(!empty($hot_list))
            <!-- 热卖推荐 _start-->
            <div class="recommend-info">
                <h3 class="recommend-title bg-color">兑换排行</h3>
                <div class="recommend-content">
                    <ul class="recommend-list">

                        @foreach($hot_list as $v)
                        <li class="goods-item first">
                            <div class="picture">
                                <a class="SZY-PIC-BG" title="{{ $v['goods_name'] }}" href="/integralmall/goods-{{ $v['goods_id'] }}.html" style="">
                                    <img class="" src="{{ get_image_url($v['goods_image'],'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original="{{ get_image_url($v['goods_image'],'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220">
                                </a>
                            </div>
                            <div class="price">
                                <a title="{{ $v['goods_name'] }}" href="/integralmall/goods-{{ $v['goods_id'] }}.html">{{ $v['goods_name'] }}</a>
                                <p class="color">{{ $v['goods_integral'] }}积分</p>
                                <p class="color">已兑换{{ $v['exchange_number'] }}次</p>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <!-- 热卖推荐 _end -->
            @endif


            {{--<div class="store-info">
                <dl class="store-logo">
                    <a href="{{ route('pc_shop_home', ['shop_id'=>$goods['shop_id']]) }}" target="_blank">
                        <img src="{{ get_image_url($shop_info['shop']['shop_logo'], 'shop_logo') }}" width="" height="" />
                    </a>
                </dl>
                <dl class="store-name third-store">

                    <a href="{{ route('pc_shop_home', ['shop_id'=>$goods['shop_id']]) }}" target="_blank" class="name" title="{{ $shop_info['shop']['shop_name'] }}">{{ $shop_info['shop']['shop_name'] }}</a>
                </dl>

                <dl class="store-score">
                    <dd>
                        <!-- 通过分数判断width的宽度-->
                        <div class="score-sum color">
                            5.00
                            <span>综合</span>
                        </div>
                        <ul class="score-part">
                            <li>
                                <span class="score-desc">描述相符</span>
                                <span class="score-detail color">{{ $shop_info['shop']['desc_score'] }}</span>
                            </li>
                            <li>
                                <span class="score-desc">服务态度</span>
                                <span class="score-detail color">{{ $shop_info['shop']['service_score'] }}</span>
                            </li>
                            <li>
                                <span class="score-desc">发货速度</span>
                                <span class="score-detail color">{{ $shop_info['shop']['send_score'] }}</span>
                            </li>
                        </ul>
                    </dd>
                </dl>
                <dl class="store-other">
                    <dt>信 誉：</dt>
                    <dd>

                        <img src="{{ get_image_url($shop_info['credit']['credit_img']) }}" class="rank" title="{{ $shop_info['credit']['credit_name'] }}" />

                    </dd>
                </dl>


                <dl class="store-other">
                    <dt>所在地：</dt>
                    <dd>{{ get_region_names_by_region_code($shop_info['shop']['region_code'],' ') }}</dd>
                </dl>
                <!-- 客服 -->

                @if(!empty($shop_info['customer_main']))
                    <dl class="store-other">
                        <dt class="tool">客 服：</dt>

                        <dd class="tool"><!-- s等于1时带文字，等于2时不带文字 -->
                            @if($shop_info['customer_main']['customer_tool'] == 1)
                                --}}{{--QQ--}}{{--
                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin={{ $shop_info['customer_main']['customer_account'] }}&amp;site=qq&amp;menu=yes" class="service-btn">
                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $shop_info['customer_main']['customer_account'] }}:52" alt="QQ" title="点击这里给我发消息" style="height: 20px;">
                                    <span>QQ 交谈</span>
                                </a>
                            @elseif($shop_info['customer_main']['customer_tool'] == 2)
                                --}}{{--旺旺--}}{{--
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $shop_info['customer_main']['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $shop_info['customer_main']['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                    <span>给我留言</span>
                                </a>
                            @endif
                        </dd>


                    </dl>
                @endif


                @if(!empty($shop_info['real']['special_aptitude']))
                    <dl class="store-other">
                        <dt>工商执照：</dt>
                        <dd>
                            @php
                                $special_aptitude = explode('|', $shop_info['real']['special_aptitude'])
                            @endphp
                            @if(!empty($special_aptitude))
                                @foreach($special_aptitude as $v)
                                    <a id="" href="/shop/index/license.html?id=1&code=special_aptitude" target="_blank">
                                        <img src="{{ get_image_url($v) }}" height="22" title="特殊行业资质" />
                                    </a>
                                @endforeach
                            @endif
                        </dd>
                    </dl>
                @endif


                <div class="enter-store">
                    <div class="enter-store-item">
                        <a class="bg-color goto-shop" href="{{ route('pc_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" target="_blank">
                            <i></i>
                            进入店铺
                        </a>
                        <a class="bg-color shop-add collect-shop" href="javascript:void(0);">
                            @if($goods['shop_collect'])
                                --}}{{--已关注--}}{{--
                                <i class="iconfont collect">&#xe6b1;</i>
                                <span>取消关注</span>
                            @else
                                --}}{{--未关注--}}{{--
                                <i class="iconfont collect">&#xe6b3;</i>
                                <span>关注本店</span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>--}}

        </div>
        <!-- 内容 -->
        <div class="clearfix">
            <!-- 内容 -->
            <div class="right right-con right-integralmall">
                <div class="wrapper">
                    <div id="main-nav-holder" class="goods-detail">
                        <ul id="nav" class="tab">
                            <li class="title-list current">
                                <a href="javascript:void(0);">商品详情</a>
                            </li>
                        </ul>
                        <div class="right-side">
                            <a href="javascript:void(0);" class="right-addcart exchange-goods " id="right-addcart">
                                <i></i>
                                立即兑换
                            </a>
                            <div class="right-side-con">
                                <ul class="right-side-ul">

                                    <li>
                                        <i></i>
                                        <span>商品详情</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="main_widget_1">
                        <!-- 商品详情 _star -->
                        <div id="goods_introduce" class="goods-detail-con goods-detail-tabs">
                            <!-- 商品后台上传的商品描述 -->
                            <div class="detail-content goods-detail-content">
                                {!! $goods['pc_desc'] !!}
                            </div>
                        </div>
                        <!-- 商品详情 end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 自提点弹框 _start-->
    <!-- 自提点 _start -->
    <div id="goods_pickup" class="goods-pickup">
        <div class="box-title">自提点列表</div>
        <div class="box-oprate" data-shop_id='15'></div>
        <div class="content-info">
            <form method="post" onSubmit="return false;">
                <div class="logistics-search-box">
                    <input class="logistics-search-input" placeholder="请输入自提点名称或自提点所在地" type="text" name="logistics-search" data-shop_id='{{ $goods['shop_id'] }}' onkeydown='logistics(event);' />
                    <a class="btn btn-primary" data-shop_id='{{ $goods['shop_id'] }}'>搜索</a>
                </div>
                <ul class="logistics-store-list">



                    {{--引入自提点--}}
                    @include('goods.partials._self_pickup_list')


                </ul>

            </form>
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>
    <!-- 自提点 _end -->
    <!-- 自提点弹框 _end-->
    <div id="content" style="display: none;">
        <p class="common-right">
            一般情况下，退货处理周期（不包含检测时间）：自接收到问题商品之日起 7 日之内为您处理完成，各支付方式退款时间请点击查阅退款多久可以到账；
            </br>
            换货处理周期：自接收到问题商品之日起 15 日之内为您处理完成；
            </br>
            正常维修处理周期：自接收到问题商品之日起 30 日内为您处理完成。
        </p>
    </div>

    <!-- 头部右侧鼠标经过图片放大效果 _start -->
    <!-- 头部右侧鼠标经过图片放大效果 _end -->
    <!-- 右侧商品信息等定位切换效果 _start -->
    <!-- 右侧商品信息等定位切换效果 _end -->
    <!-- 控制图片经过放大 -->
    <script type="text/javascript">
        //
    </script>
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
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/assets/d2eace91/js/jquery.history.js"></script>
    <script src="/js/magiczoom.js"></script>
    <script src="/js/tabs_totop.js"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        // 图片相册
        $(".goodsgallery").goodsgallery({
            images: $.parseJSON($("#SZY_GOODS_IMAGES").html())
        });
        // 
        // 添加对比
        $(".btn-primary").click(function() {
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
        // 
        $().ready(function() {
            //固定滚动条位置
            $.fixedScorll.read("SZY_GOODS_SCORLL");
            // 立即兑换
            $(".exchange-goods").click(function() {
                if ($(this).hasClass("disabled")) {
                    var message = $(this).data('message');
                    $.msg(message);
                    return;
                }
                var goods_id = '{{ $goods['goods_id'] }}';
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
            });
            // 步进器
            var goods_number_amount = $(".amount-input").amount({
                value: 1,
                min: $(this).data('amount-min'),
                max: $(this).data('amount-max'),
                change: function(element, value) {
                },
                max_callback: function() {
                    $.msg("最多只能购买" + this.max + "件");
                },
                min_callback: function() {
                    $.msg("商品数量必须大于" + (this.min - 1));
                }
            });
            // 添加收藏
            $(".collect-shop").click(function(event) {
                var target = $(this);
                var shop_id = "{{ $goods['shop_id'] }}";
                $.collect.toggleShop(shop_id, function(result) {
                    if (result.data == 1) {
                        $(target).find("span").html("取消收藏");
                    } else {
                        $(target).find("span").html("收藏本店");
                    }
                });
            });
            //自提弹框
            $("body").on('click', '#self_pickup', function() {
                $(".goods-pickup").show();
                $("input[name=logistics-search]").focus();
                $(".bg").show();
            })
            // 自提弹框关闭事件
            $("body").on('click', '.goods-pickup .box-oprate', function() {
                $('.goods-pickup').hide();
                $('.bg').hide();
            });
        });
        // 
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