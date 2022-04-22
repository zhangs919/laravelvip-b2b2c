@extends('layouts.base')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')

    <!--页面css/js-->
    <script src="/js/index.js?v=20180528"></script>
    <script src="/js/tabs.js?v=20180528"></script>
    <script src="/js/bubbleup.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/js/index_tab.js?v=20180528"></script>
    <script src="/js/jump.js?v=20180528"></script>
    <script src="/js/nav.js?v=20180528"></script>
@stop



@section('content')

    <!-- 内容 -->
    <!-- css -->
    <link rel="stylesheet" href="/css/goods.css?v=20180428"/>
    <!-- 地区选择器 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=20180528"></script>
    <!-- 放大镜 _start -->
    <script type="text/javascript" src="/js/magiczoom.js"></script>
    <!-- 放大镜 _end -->
    <div class="w1210">

        <div class="breadcrumb clearfix">
            <a href="/" class="index">首页</a>
            <span class="crumbs-arrow">&gt;</span>
            <a href="/integralmall.html" class="last">积分商城</a>
            <span class="crumbs-arrow">&gt;</span>
            <a href="{{ route('show_integral_goods', ['goods_id'=>$goods_info->goods_id]) }}" class="last">{{ $goods_info->goods_name }}</a>
        </div>
        <div class="goods-info">
            <!-- 商品图片以及相册 _star-->
            <div id="preview" class="preview">
                <!-- 商品相册容器 -->
                <div class="goodsgallery"></div>
                <script id="SZY_GOODS_IMAGES" type="text">{!! $goods_info->goods_images !!}</script>
                <script type="text/javascript">
                    // 图片相册
                    $(".goodsgallery").goodsgallery({
                        images: $.parseJSON($("#SZY_GOODS_IMAGES").html())
                    });
                </script>
                <!--相册 END-->
                <div class="goods-gallery-bottom"></div>
            </div>
            <!-- 商品详细信息 _star-->
            <div class="detail-info">
                <form action="" method="post" name="" id="">

                    <!-- 商品名称 -->
                    <h1 class="goods-name SZY-GOODS-NAME">{{ $goods_info->goods_name }}</h1>
                    <!-- 商品简单描述 -->
                    <!-- <p class="goods-brief second-color"></p> -->

                    <div class="goods-price">
                        <div class="now-prices">
                            <span class="price">售&nbsp;&nbsp;&nbsp;价</span>
                            <font class="market-price">
                                <s>￥{{ $goods_info->market_price }}</s>
                            </font>
                        </div>
                        <div class="goods-price">
                            <div class="goods-info-other">
                                <div class="item">
                                    <p>累计兑换</p>
                                    <em class="second-color">{{ $goods_info->exchange_number }}</em>
                                </div>
                            </div>
                            <div class="realy-price">
                                <div class="now-prices">
                                    <span class="price">积&nbsp;&nbsp;&nbsp;分</span>
                                    <strong class="p-price second-color SZY-GOODS-POINTS">{{ $goods_info->goods_integral }}积分</strong>
                                </div>
                            </div>
                        </div>
                        <div class="now-prices">
                            <span class="price">兑换时间</span>
                            <strong class="p-price second-color">

                                @if($goods_info->is_limit == 0)
                                    无时间条件限制
                                @elseif($goods_info->is_limit == 1)
                                    有效期: {{ $goods_info->start_time }} 至 {{ $goods_info->end_time }}
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
								<input type="text" class="amount-input" value="1" data-goods_id="{{ $goods_info->goods_id }}" data-amount-min="1" data-amount-max="{{ $goods_info->goods_number }}" maxlength="8" title="请输入购买量">
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

                                    库存{{ $goods_info->goods_number }}件

                                </em>

                            </dd>
                        </dl>

                        <div class="action">

                            <div class="btn-buy">
                                <a href="javascript:void(0);" class="exchange-goods color disabled" data-message="积分不足" data-goods_number="{{ $goods_info->goods_number }}">
                                    <span class="buy-goods-bg bg-color"></span>
                                    <span class="buy-goods-border"></span>
                                    立即兑换
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>


            <div class="store-info">
                <dl class="store-logo">
                    <a href="{{ route('pc_shop_home', ['shop_id'=>$goods_info->shop_id]) }}" target="_blank">
                        <img src="{{ get_image_url($goods_info->shop->shop_logo, 'shop_logo') }}" width="" height="" />
                    </a>
                </dl>
                <dl class="store-name third-store">

                    <a href="{{ route('pc_shop_home', ['shop_id'=>$goods_info->shop_id]) }}" target="_blank" class="name" title="{{ $goods_info->shop->shop_name }}">{{ $goods_info->shop->shop_name }}</a>
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
                                <span class="score-detail color">5.00</span>
                            </li>
                            <li>
                                <span class="score-desc">服务态度</span>
                                <span class="score-detail color">5.00</span>
                            </li>
                            <li>
                                <span class="score-desc">发货速度</span>
                                <span class="score-detail color">5.00</span>
                            </li>
                        </ul>
                    </dd>
                </dl>
                <dl class="store-other">
                    <dt>信 誉：</dt>
                    <dd>

                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/shop-credit/2018/05/11/15260223670677.jpg" class="rank" title="一星" />

                    </dd>
                </dl>


                <dl class="store-other">
                    <dt>所在地：</dt>
                    <dd>甘肃省 张掖市 甘州区</dd>
                </dl>
                <!-- 客服 -->

                <dl class="store-other">
                    <dt class="tool">客 服：</dt>



                    <dd class="tool">
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=625995346&site=qq&menu=yes" class="service-btn">
                            <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:625995346:52" alt="QQ" title="点击这里给我发消息" style="height: 20px;" />
                            <span>QQ 交谈</span>
                        </a>
                    </dd>





                </dl>


                <div class="enter-store">
                    <div class="enter-store-item">
                        <a class="bg-color goto-shop" href="{{ route('pc_shop_home', ['shop_id'=>$goods_info->shop_id]) }}" target="_blank">
                            <i></i>
                            进入店铺
                        </a>
                        <a class="bg-color shop-add collect-shop" href="javascript:void(0);">
                            @if($goods_info->shop->is_collected)
                                {{--已收藏--}}
                                <i class="iconfont collect">&#xe6b1;</i>
                                <span>取消收藏</span>
                            @else
                                {{--未收藏--}}
                                <i class="iconfont collect">&#xe6b3;</i>
                                <span>收藏本店</span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>

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
                                {!! $goods_info->pc_desc !!}
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
                    <input class="logistics-search-input" placeholder="请输入自提点名称或自提点所在地" type="text" name="logistics-search" data-shop_id='15' onkeydown='logistics(event);' />
                    <a class="btn btn-primary" data-shop_id='15'>搜索</a>
                </div>
                <ul class="logistics-store-list">



                    <li class="logistics-item">
                        <a href="/goods/pickup-info.html?id=4" title="点击查看自提点详情" target="_blank" class="logistics-inner">
                            <img src="http://images.68mall.com/system/config/default_image/default-pickup.jpg" alt="11" class="logistics-img" />
                            <div class="logistics-info">
                                <p class="logistics-name">11</p>
                                <p class="logistics-address" title="西街街道祁连中路河西学院"><i class="iconfont color">&#xe6a7;</i>西街街道祁连中路河西学院</p>
                            </div>
                        </a>
                    </li>


                </ul>

            </form>
        </div>
    </div>
    <script type="text/javascript">
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
    <script type="text/javascript" src="/js/bubbleup.js"></script>
    <!-- 头部右侧鼠标经过图片放大效果 _end -->
    <!-- 右侧商品信息等定位切换效果 _start -->
    <script type="text/javascript" src="/js/tabs_totop.js"></script>
    <!-- 右侧商品信息等定位切换效果 _end -->
    <!-- 控制图片经过放大 -->
    <script type="text/javascript">
        //固定滚动条位置
        $.fixedScorll.read("SZY_GOODS_SCORLL");
    </script>
    <script type="text/javascript">
        $().ready(function() {
            // 立即兑换
            $(".exchange-goods").click(function() {
                if ($(this).hasClass("disabled")) {
                    var message = $(this).data('message');
                    $.msg(message);
                    return;
                }
                var goods_id = '{{ $goods_info->goods_id }}';
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
                }
            });

            // 添加收藏
            $(".collect-shop").click(function(event) {
                var target = $(this);
                var shop_id = "{{ $goods_info->shop_id }}";
                $.collect.toggleShop(shop_id, function(result) {
                    if (result.data == 1) {
                        $(target).find("span").html("取消收藏");
                        $(target).find('i').html('&#xe6b1;');
                    } else {
                        $(target).find("span").html("收藏本店");
                        $(target).find('i').html('&#xe6b3;');
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
    </script>

@stop