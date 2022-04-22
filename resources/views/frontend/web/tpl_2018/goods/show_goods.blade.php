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
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=20180528"></script>
    <!-- 放大镜 _start -->
    <script type="text/javascript" src="/js/magiczoom.js"></script>
    <!-- 放大镜 _end -->
    <div class="w1210">

        <!--当前位置，面包屑-->
        @include('frontend.web.modules.library.url_here')

        <div class="goods-info">
            <!-- 商品详细信息 -->

            <span class="SZY-GOODS-NAME-BASE" style="display: none;">{{ $goods['goods_name'] }}</span>
            <!-- 商品图片以及相册 _star-->
            <div id="preview" class="preview">
                <!-- 商品相册容器 -->
                <div class="goodsgallery"></div>
                <script id="SZY_SKU_IMAGES" type="text">
                    {!! json_encode($sku['sku_images']) !!}
                </script>
                <script type="text/javascript">
                    // 图片相册
                    $(".goodsgallery").goodsgallery({
                        images: $.parseJSON($("#SZY_SKU_IMAGES").html()),
                        video: "{{ get_video_url($goods['goods_video']) }}"
                    });
                </script>
                <!--相册 END-->

                <div class="goods-gallery-bottom">


                    <a href="javascript:void(0);" class="goods-compare compare-btn fr add-compare" data-goods-id="{{ $goods['goods_id'] }}" data-sku-id="{{ $sku['sku_id'] }}" data-image-url="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                        <i class="iconfont">&#xe715;</i>
                        对比
                    </a>



                    <a href="javascript:void(0);" class="goods-col fr @if($goods['is_collect']) curr @endif collect-goods" data-goods-id="{{ $goods['goods_id'] }}">
                        @if($goods['is_collect'])
                            {{--已收藏--}}
                            <i class="iconfont">&#xe6b1;</i>
                            <span>取消收藏({{ $goods['collect_num'] }}人气)</span>
                        @else
                            {{--未收藏--}}
                            <i class="iconfont">&#xe6b3;</i>
                            <span>收藏商品</span>
                        @endif
                    </a>

                    <div class="bdsharebuttonbox fr">
                        <a class="bds_more" href="#" data-cmd="more" style="background: none; color: #999; line-height: 25px; height: 25px; margin: 0px 10px; padding-left: 20px; display: block;">
                            <i class="iconfont">&#xe6ac;</i>
                            分享
                        </a>
                    </div>
                </div>

                <script type="text/javascript">
                    window._bd_share_config = {
                        "common": {
                            "bdSnsKey": {},
                            "bdText": "我在@" + "{{ sysconf('site_name') }}" + " 发现了一个非常不错的商品：" + $(".SZY-GOODS-NAME-BASE").text() + "。感觉不错，分享一下~",
                            "bdMini": "2",
                            "bdMiniList": false,
                            "bdPic": "{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320",
                            "bdStyle": "0",
                            "bdSize": "16"
                        },
                        "share": {}
                    };
                    with (document) {
                        0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = '//bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                    }
                </script>
            </div>
            <!-- 商品图片以及相册 _end-->
            <!-- 商品详细信息 _star-->
            <div class="detail-info">
                <form action="" method="post" name="" id="">


                    <!-- 商品名称 -->
                    <h1 class="goods-name SZY-GOODS-NAME">{{ $sku['sku_name'] }}</h1>
                    <!-- 限时折扣 -->
                    {{--todo 判断 限时折扣显示 后期再做促销功能--}}
                    {{--<p class="end-time bg-color">
                        <font id="limit_discount_label">
                            <span class="activity-label">标签</span>
                            <em class="discount"> 减5元 </em>
                            <span class="fr small-text">
                                <strong id="limit_discount_countdown">00 天 00 小时 00 分 00 秒</strong>
                                后结束，请尽快购买！
                            </span>
                        </font>
                    </p>--}}



                    <!-- 预售 -->


                    <!-- 商品简单描述 -->
                    <p class="goods-brief second-color">{{ $goods['goods_subname'] }}</p>
                    <!-- 商品团购倒计时 -->
                    <!--当团购商品未开始时-->

                    {{--todo 判断 限时团购显示 后期再做促销功能--}}
                    {{--<div class="activity-banner bg-color">
                        <div class="activity-type">
                            <i class="icon iconfont">&#xe6aa;</i>
                            <strong>限时团购</strong>
                        </div>
                        <div class="activity-message">
                            距离结束
                            <div id="groupbuy_countdown" class="fr">
                                <span>00</span>
                                :
                                <span>00</span>
                                :
                                <span>00</span>
                            </div>
                        </div>
                    </div>--}}


                    <div class="goods-price">

                        <!-- 商品不同的价格 -->
                        <div class="show-price" >


                            <span class="price">市场价</span>
                            <font class="market-price SZY-MARKET-PRICE">￥{{ $goods['market_price'] }}</font>


                        </div>
                        <!-- 商品市场价 _end -->
                        <!-- 销量及评价 _start -->
                        <div class="goods-info-other">

                            <div class="item sale">
                                <p>累计销量</p>
                                <em class="second-color">{{ $goods['sale_num'] }}</em>
                            </div>

                            <div class="item evaluate">
                                <p>用户评价</p>
                                <a id="evaluate_num" href="#goods_evaluate" class="second-color">{{ $goods['comment_num'] }}</a>
                            </div>
                        </div>
                        <!-- 销量及评价 _end -->

                        <div class="realy-price">

                            <div class="now-prices">
                                <span class="price">售&nbsp;&nbsp;&nbsp;价</span>
                                <strong class="p-price second-color SZY-GOODS-PRICE">￥{{ $goods['goods_price'] }}</strong>
                            </div>

                            <!--
                                    <div class="depreciate">
                                        <a href="" title="">（降价通知）</a>
                                    </div>
                                     -->
                        </div>

                        <!-- 促销 -->
                        <div class="shop-prom SZY-ACTIVITY" >
                            <div class="shop-prom-title">
                                <dl>
                                    <dt class="dt">促&nbsp;&nbsp;&nbsp;销</dt>
                                    <div class="shop-prom-box">
                                        <!--会员价 _start-->

                                        <!-- 会员价 _end -->
                                        <!-- 领红包 _start -->

                                        {{--todo 判断 有红包时显示--}}
                                        @if(!empty($bonus_list))
                                            <dd>
                                                <div>
                                                    <span class="pro-type">红包</span>
                                                    <div class="pro-info">
                                            <span class="shop-coupon">
                                                <span class="bonus">点击此处领取并查看红包详情</span>
                                                <!-- 优惠券弹框 -->
                                                <div class="coupon-popup">
                                                    <i class="close"></i>
                                                    <div class="popup-content">
                                                        <div class="coupon-list">
                                                            <ul>
                                                                @foreach($bonus_list as $bonus)
                                                                    <li class="coupon">
                                                                        <div class="coupon-amount">
                                                                            <div class="coupon-price">
                                                                                {{ $bonus['bonus_amount_format'] }}
                                                                                <i></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="coupon-detail">
                                                                            <div class="coupon-info">
                                                                                <p class="coupon-title" title="">{{ $bonus['bonus_name'] }}</p>
                                                                                <p class="coupon-time">{{ $bonus['start_time_format'] }}&nbsp;-&nbsp;{{ $bonus['end_time_format'] }}</p>
                                                                            </div>
                                                                        </div>

                                                                        @if($bonus['is_receive'])
                                                                            <!-- 已领取的红包 _start -->
                                                                            <span class="bonus-received">已领取</span>
                                                                            <!-- 已领取的红包 _end -->
                                                                        @else
                                                                            <!-- 未领取的红包 _start -->
                                                                            <a href="javascript:void(0);" title="点击领取红包" data-bonus-id="{{ $bonus['bonus_id'] }}" class="bonus-receive color">领取</a>
                                                                            <!-- 未领取的红包 _end -->
                                                                        @endif


                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <span class="popup-arrow"></span>
                                                    </div>
                                                </div>
                                            </span>
                                                    </div>
                                                </div>
                                            </dd>
                                        @endif
                                        <!-- 领红包 _end -->
                                        <!-- 赠品 _start -->

                                        {{--todo 判断 有赠品时显示 后期再做促销功能--}}
                                        {{--<dd>
                                            <div class="prom-gift SZY-GIFT-LIST">
                                                <span class="pro-type SZY-GIFT-LABEL">赠品</span>
                                                <span class="pro-info">
                                                    <div class="prom-gift">

                                                        <div class="prom-gift-list SZY-GIFT m-l-5">
                                                            <a href="/1112.html" title="彩椒  C之王" target="_blank">
                                                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2019/01/15/15475140324781.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="25" height="25" class="gift-img" />
                                                            </a>
                                                            <em class="gift-number color">× 1</em>
                                                        </div>

                                                        <div class="prom-gift-list SZY-GIFT m-l-5">
                                                            <a href="/1127.html" title="彩椒 123 1" target="_blank">
                                                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2019/01/11/15472021222241.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="25" height="25" class="gift-img" />
                                                            </a>
                                                            <em class="gift-number color">× 1</em>
                                                        </div>

                                                    </div>
                                                </span>
                                            </div>
                                        </dd>--}}
                                        <!--赠品 _end-->
                                        <!-- 满减、满折 _start -->

                                        {{--todo 判断 有满减、满折时显示 后期再做促销功能--}}
                                        {{--<dd class="discount">
                                            <div class="pro-item">

                                                <span class="pro-type">满减</span>


                                                <span class="pro-type">包邮</span>


                                                <div class="pro-info">
                                                    <div class="pro-info-list">
                                                        <p title="满5元，减3元、包邮；">满5元，减3元、包邮；</p>
                                                    </div>

                                                    <div class="list-bomb-box">
                                                        <i></i>
                                                        <ul>

                                                            <li>满5元，减3元、包邮；</li>

                                                            <li>满10元，减5元；</li>

                                                        </ul>
                                                    </div>

                                                </div>
                                                <!-- 当条件大于1个时，此标签显示 _start -->

                                                <i class="more"></i>

                                                <!-- 当条件大于1个时，此标签显示 _end -->
                                            </div>
                                        </dd>--}}

                                        <!-- 满减送_end -->
                                        <!-- 当促销方式多于2个时，此模块显示----显示的是所有活动前面的标签 _start -->
                                        <div class="pro-type-group">
                                            <span class="pro-info-down">
                                                展开促销
                                                <i class="more"></i>
                                            </span>
                                        </div>
                                        <!-- <dd class="pro-type-group">
                                        <div class="pro-item">
                                            <span class="pro-type">红包</span>
                                            <span class="pro-type">赠品</span>
                                            <span class="pro-type">限购</span>
                                            <span class="pro-type">满减</span>
                                            <span class="pro-type">包邮</span>
                                            <span class="pro-type">赠</span>
                                            <span class="pro-type">加价购</span>
                                            <span class="pro-info-down">
                                                展开促销
                                                <i class="more"></i>
                                            </span>
                                        </div>
                                    </dd> -->
                                        <!-- 当促销方式多于2个时，此模块显示 _end -->
                                    </div>
                                </dl>
                            </div>
                        </div>


                        @if($goods['goods_moq'] > 0)
                            <div class="start-batch">
                                <span>起订量</span>
                                <font class="start-batch-num">≥&nbsp;{{ $goods['goods_moq'] }}&nbsp;件</font>
                            </div>
                        @endif


                    </div>
                    <!-- 在售的商品 _start -->
                    <!-- 虚拟商品判断 -->

                    {{--todo 判断 是否显示--}}
                    @if(sysconf('goods_info_freight') == 0)
                    {{--goods_info_freight=0 显示具体运费--}}
                    <!-- 运费 -->
                    <div class="freight">
                        <div class="dt">配送至</div>
                        <div class="dd">
                            <div class="post-age">
                                <div class="region-chooser-container" style="z-index: 3"></div>
                                <div class="post-age-info">
                                    <span class="freight-info"></span>
                                    <div class="service-tips freight-free-info" style="display: none;">
                                        <i class="sprite-question"></i>
                                        <div class="tips">
                                            <div class="sprite-arrow"></div>
                                            <div class="tips-bg"></div>
                                            <div class="content">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                    <!-- 服务 -->
                    <div class="freight">
                        <div class="dt">服&nbsp;&nbsp;&nbsp;务</div>
                        <div class="dd">
                            <div class="post-age">
                                由
                                <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" target="_blank" class="color">{{ $shop_info['shop']['shop_name'] }}</a>
                                负责发货，并提供售后服务。
                            </div>
                        </div>
                    </div>


                    @if(sysconf('goods_info_pickup'))
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
                    @endif


                    <div class="choose SZY-GOODS-SPEC-ITEMS">
                        <!-- 商品规格 -->

                        @if(!empty($goods['spec_list']))
                        @foreach($goods['spec_list'] as $k=>$v)
                        <!-- 如果规格下没有库存，红色提示背景给dl标签追加class值"no-stock-bg" -->
                        <dl class="attr">
                            <dt class="dt">{{ $v['attr_name'] }}</dt>
                            <dd class="dd">
                                <ul data-attr-id="{{ $v['attr_id'] }}">

                                    @foreach($v['attr_values'] as $kk=>$vv)
                                    <!-- 属性值被选中的状态 -
                                    <!-- 如果规格下没有库存，虚线格式给li标签追加class值“no-stock” -->
                                    <li class="goods-spec-item @if(in_array($vv['spec_id'], $sku['spec_ids'])) selected @endif"
                                        data-spec-id="{{ $vv['spec_id'] }}" data-attr-id="{{ $v['attr_id'] }}" data-is-default="{{ $v['is_default'] }}" data-points-goods="0">
                                        <a href="javascript:void(0);" title="{{ $vv['attr_value'] }}">
                                            @if($v['is_default'] && !empty($vv['spec_image']))
                                                <img src="{{ get_image_url($vv['spec_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="34" height="34" alt="">
                                            @endif
                                            <span class="value-label">{{ $vv['attr_value'] }}</span>
                                        </a>
                                        <i></i>
                                    </li>
                                    @endforeach

                                </ul>
                            </dd>
                        </dl>
                        @endforeach
                        @endif

                        <!-- 购买数量 -->
                        <dl class="amount">
                            <dt class="dt">数量</dt>
                            <dd class="dd">
                                <span class="amount-widget">
                                    <input type="text" class="amount-input" value="1"
                                           data-sales_model="{{ $goods['sales_model'] }}"
                                           data-goods_id="{{ $goods['goods_id'] }}"
                                           data-sku_id="{{ $sku['sku_id'] }}"
                                           data-amount-min="1"
                                           data-amount-max="{{ $sku['goods_number'] }}"
                                           maxlength="8" title="请输入购买量">
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

                                <em class="stock SZY-GOODS-NUMBER">

                                    库存{{ $sku['goods_number'] }}件

                                </em>


                            </dd>
                        </dl>

                        <!-- 限购提示语 -->
                        {{--todo 判断 有限购数量时显示--}}
                        @if($sku['purchase_num'] > 0)
                        <div class="purchase-msg">
                            <div class="msg-con">
                                每人限购{{ $sku['purchase_num'] }}件
                                <i class="msg-icon"></i>
                            </div>
                        </div>
                        @endif


                        <!-- 加入购物车按钮、手机购买 -->
                        <div class="action">

                            <div class="btn-buy">
                                <a href="javascript:void(0);" class="buy-goods color ">
                                    <span class="buy-goods-bg bg-color"></span>
                                    <span class="buy-goods-border"></span>
                                    立即购买					</a>
                            </div>
                            <!-- 判断不能加入购物车的商品 -->

                            <div class="btn-buy">
                                <a href="javascript:void(0);" class="add-cart bg-color ">
                                    <i class="iconfont">&#xe6a8;</i>
                                    加入购物车
                                </a>
                            </div>

                            <div class="btn-phone">
                                <a href="javascript:void(0);" class="go-phone">
                                    <span>手机购买</span>
                                    <i class="iconfont">&#xe6bc;</i>
                                    <div id="phone-tan">
                                        <span class="arr"></span>
                                        <div class="m-qrcode-wrap">
                                            <img src="/goods/qrcode.html?id={{ $goods['goods_id'] }}" width="100" height="100" />
                                        </div>
                                    </div>
                                </a>
                            </div>


                        </div>

                        <!-- 服务承诺 -->
                        {{--保障服务 如果无保障服务 不显示--}}
                        @if(!empty($goods['contract_list']))
                            <dl class="service">
                                <dt class="dt">服务承诺</dt>
                                <dd class="dd">
                                    <ul class="contract-list">

                                        @foreach($goods['contract_list'] as $v)
                                            <li>
                                                <a href="javascript:void(0);" title="{{ $v['contract_desc'] }}">
                                                    <img src="{{ get_image_url($v['contract_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_16,w_16" />
                                                    <span>{{ $v['contract_name'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </dd>
                            </dl>
                        @endif

                    </div>

                    <!-- 在售的商品 _end -->

                </form>
            </div>
            <script id="SZY_SKU_LIST" type="text">
                {{--sku list--}}
                {!! json_encode($goods['sku_list']) !!}
            </script>
            <script type="text/javascript">
                var sku_ids = [];
                var local_region_code = "{{ $region_code }}";
                var sku_freights = [];
                var change_sku_images = false;

                function getSkuId() {
                    var spec_ids = [];

                    $(".choose").find(".attr").each(function() {
                        var spec_id = $(this).find(".selected").data("spec-id");
                        spec_ids.push(spec_id);
                    });

                    var sku_id = $.cart.getSkuId(spec_ids, sku_ids);

                    if (sku_id == null) {
                        return false;
                    }

                    return sku_id;
                }

                function changeLocation(region_code) {
                    if (region_code == undefined || region_code == null || region_code.length == 0) {
                        return;
                    }

                    var sku_id = getSkuId();

                    return $.get("/goods/change-location.html", {
                        "sku_id": sku_id,
                        "region_code": region_code
                    }, function(result) {
                        if (result.code == 0) {
                            local_region_code = region_code;
                            sku_freights[region_code] = result.data;

                            if (result.data.is_last == 0) {
                                // return;
                            }

                            $(".freight-info").html(result.data.freight_info);
                            $(".freight-free-info").find(".content").html("");

                            if ($.isArray(result.data.free_list) && result.data.free_list.length > 0) {

                                for (var i = 0; i < result.data.free_list.length; i++) {
                                    $(".freight-free-info").find(".content").append("<p>" + result.data.free_list[i] + "</p>");
                                }

                                // 显示包邮条件
                                $(".freight-free-info").show();
                            } else {
                                // 隐藏包邮条件
                                $(".freight-free-info").hide();
                            }

                            if ($(document).data("SZY-SKU-" + sku_id)) {
                                var sku = $(document).data("SZY-SKU-" + sku_id);
                                setSkuInfo(sku);
                            } else {

                                // 库存
                                if (result.data.goods_number > 0) {
                                    if ("1" == 1) {
                                        $(".SZY-GOODS-NUMBER").html("库存" + result.data.goods_number + "件");
                                    } else {
                                        $(".SZY-GOODS-NUMBER").html("");
                                    }
                                } else {
                                    $(".SZY-GOODS-NUMBER").html("库存不足");
                                }
                                // 购买
                                if (result.data.goods_number == 0) {
                                    $(".add-cart").addClass("disabled");
                                    $(".buy-goods").addClass("disabled");
                                } else {
                                    $(".buy-goods").removeClass("disabled");
                                    $(".add-cart").removeClass("disabled");
                                }
                            }
                        }
                    }, "json");
                }

                function getSkuInfo(sku_id, callback) {
                    if ($(document).data("SZY-SKU-" + sku_id)) {
                        var sku = $(document).data("SZY-SKU-" + sku_id);
                        // 回调
                        if ($.isFunction(callback)) {
                            callback.call({}, sku);
                        }
                    } else {
                        $.get('/goods/sku', {
                            sku_id: sku_id,
                            is_lib_goods: ""
                        }, function(result) {
                            if (result.code == 0) {
                                var sku = result.data;
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
                    var is_lib_goods = "";
                    if (is_lib_goods == true) {
                        return false;
                    }

                    if (sku == undefined || sku == null || sku == false) {
                        $(".add-cart").addClass("disabled");
                        $(".buy-goods").addClass("disabled");
                        $(".SZY-GOODS-NUMBER").html("库存不足");
                        return;
                    }

                    // 点击默认规格才会切换相册
                    if (change_sku_images == true) {
                        // 相册
                        $(".goodsgallery").goodsgallery({
                            images: sku.sku_images,
                            video: ""
                        });
                        change_sku_images = false;
                    }

                    var goods_number = sku.goods_number;

                    if (goods_number > 0) {
                        if (sku_freights[local_region_code]) {
                            if (sku_freights[local_region_code].limit_sale == 1) {
                                // 区域限售商品
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

                    // 商品名称
                    $(".SZY-GOODS-NAME").html(sku.sku_name);
                    // 售价
                    $(".SZY-GOODS-PRICE").html(sku.goods_price_format);
                    // 市场价
                    //搭配套餐 显示原价
                    if (sku.activity && sku.activity.act_type == '11' && sku.activity.act_status == 1) {
                        $(".SZY-MARKET-PRICE").html(sku.original_price_format);
                    } else {
                        $(".SZY-MARKET-PRICE").html(sku.market_price_format);
                    }

                    if (parseFloat(sku.market_price) == 0) {
                        $(".SZY-MARKET-PRICE").parents(".show-price").hide();
                    } else {
                        $(".SZY-MARKET-PRICE").parents(".show-price").show();
                    }
                    // 预售定金显示
                    if (parseFloat(sku.earnest_money) > 0 && $('.SZY-EARNST-MONEY').length > 0) {
                        $('.SZY-EARNST-MONEY').html(sku.earnest_money_format);
                        $('.SZY-TAIL-MONEY').html(sku.tail_money_format);
                    }

                    // 库存
                    if (goods_number > 0) {
                        if ("1" == 1) {
                            $(".SZY-GOODS-NUMBER").html("库存" + goods_number + "件");
                        } else {
                            $(".SZY-GOODS-NUMBER").html("");
                        }
                    } else {
                        $(".SZY-GOODS-NUMBER").html("库存不足");
                    }

                    if (goods_number == 0) {
                        $(".add-cart").addClass("disabled");
                        $(".buy-goods").addClass("disabled");
                    } else {
                        $(".buy-goods").removeClass("disabled");
                        $(".add-cart").removeClass("disabled");
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

                    // 判断促销模块是否显示
                    var show_activity = false;

                    //
                    show_activity = true;
                    //

                    // 会员价格
                    if (sku.rank_prices != undefined && sku.rank_prices != null) {
                        $(".SZY-RANK-LIST").find("p").remove();
                        var html = "";
                        for (var i = 0; i < sku.rank_prices.length; i++) {
                            var item = sku.rank_prices[i];
                            html += "<p>" + item.rank_name + ":" + item.rank_price_format + "</p>";
                        }
                        $(".SZY-RANK-LIST").append(html);
                        $(".SZY-RANK-PRICES").show();
                        // 展示促销
                        show_activity = true;
                    } else {
                        $(".SZY-RANK-PRICES").hide();
                    }

                    if (sku.member_price_message) {
                        $(".SZY-RANK-PRICES").show();
                        $(".SZY-RANK-MESSAGE").html(sku.member_price_message);
                        // 展示促销
                        show_activity = true;
                    } else {
                        $(".SZY-RANK-PRICES").hide();
                    }

                    // 处理赠品
                    if (sku.gift_list && sku.gift_list.length > 0) {

                        $(".SZY-GIFT-LIST").show();
                        $(".SZY-GIFT-LIST").find(".prom-gift").children().remove();

                        for (var i = 0; i < sku.gift_list.length; i++) {
                            var gift = sku.gift_list[i];
                            var template = $("#SZY_GIFT_TEMPLATE").html();
                            var element = $($.parseHTML(template));
                            $(element).find("img").attr("src", gift.goods_image_thumb);
                            $(element).find("a").attr("href", "/" + gift.gift_sku_id + ".html");
                            $(element).find("a").attr("title", "/" + gift.sku_name);
                            $(element).find(".gift-number").html("× " + gift.gift_number);
                            $(".SZY-GIFT-LIST").find(".prom-gift").append(element);
                        }

                        // 展示促销
                        show_activity = true;
                    } else {
                        $(".SZY-GIFT-LIST").hide();
                        $(".SZY-GIFT-LABEL").nextAll().remove();
                    }
                    //订单返现
                    if (sku.cash_back.message) {
                        show_activity = true;
                    }

                    if ($(".SZY-ACTIVITY").find(".discount").size() > 0) {
                        // 展示促销
                        show_activity = true;
                        $(".SZY-MARKET-PRICE").html(sku.original_price_format);
                    }

                    if (show_activity) {

                        $(".SZY-ACTIVITY").show();
                    } else {
                        $(".SZY-ACTIVITY").hide();
                    }
                }

                $().ready(function() {

                    // 获取SKU列表
                    sku_ids = $.parseJSON($("#SZY_SKU_LIST").html());
                    // 检查SKU组合
                    $.cart.checkSkus($(".SZY-GOODS-SPEC-ITEMS > .attr"), sku_ids);
                    // 绑定规格事件
                    $.cart.checkSpecs($(".SZY-GOODS-SPEC-ITEMS > .attr"), sku_ids, $(".SZY-GOODS-SPEC-ITEMS > .attr").find("li"), function(sku) {

                        // 是否为默认规格
                        var is_default = $(this).data("is-default");

                        if (is_default) {
                            // 如果是默认规格则标识将切换SKU的图片相册
                            change_sku_images = true;
                        }

                        // SKU存在
                        getSkuInfo(sku.sku_id, function(sku) {
                            setSkuInfo(sku);
                            $("title").html(sku.sku_name);
                        });
                    }, function() {

                        // 是否为默认规格
                        var is_default = $(this).data("is-default");

                        if (is_default) {
                            // 如果是默认规格则标识将切换SKU的图片相册
                            change_sku_images = true;
                        }

                        // SKU不存在
                        $(".add-cart").addClass("disabled");
                        $(".buy-goods").addClass("disabled");
                        $(".SZY-GOODS-NUMBER").html("库存不足");

                        $("title").html($(".SZY-GOODS-NAME-BASE").text());
                    });

                    // 步进器
                    var goods_number_amount = $(".amount-input").amount({
                        value: 1,
                        min: 1,
                        max: "97",
                        change: function(element, value) {
                            var sku_id = element.data('sku_id');
                            if (value == this.max) {

                            }
                        },
                        max_callback: function() {
                            $.msg("最多只能购买" + this.max + "件");
                        },
                        min_callback: function() {
                            $.msg("商品数量必须大于" + (this.min - 1));
                        }
                    });

                    // 添加购物车
                    $(".add-cart").click(function(event) {

                        var is_lib_goods = "";
                        if (is_lib_goods == true) {
                            return false;
                        }

                        if ($(this).hasClass("disabled")) {
                            return false;
                        }

                        var image_url = $(".goodsgallery").find(".gg-handler li:first img").attr("src");
                        var sku_id = getSkuId();
                        $.cart.add(sku_id, $(".amount-input").val(), {
                            is_sku: true,
                            image_url: image_url,
                            event: event,
                            info_callback: function() {

                            }
                        });
                        return false;
                    });

                    // 立即购买
                    $(".buy-goods").click(function() {
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
                        var number = $(".amount-input").val();
                        var data = {};
                        if (act_type == purchase || act_type == pre_sale) {
                            data.act_type = act_type;
                        }
                        if (virtual > 0) {
                            data.virtual = virtual;
                        }
                        $.cart.quickBuy(sku_id, number, data);

                    });

                    // 立即兑换
                    $(".exchange-goods").click(function() {

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
                        var number = $(".amount-input").val();
                        var data = {};
                        data.exchange = true;
                        $.cart.quickBuy(sku_id, number, data);
                    });

                    //身份验证弹框
                    //        $(".buy-goods").click(function() {
                    //			layer.open({
                    //				type: 1,
                    //                title: '身份验证',
                    //                area: ['700px', '330px'],
                    //				content: $('#status-verify').html()
                    //			});
                    //        });
                });
            </script>
            <!-- 商品详细信息 _end-->
            <!-- 店铺信息 _star-->

            <div class="store-info">
                <dl class="store-logo">
                    <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" target="_blank">
                        <img src="{{ get_image_url($shop_info['shop']['shop_logo'], 'shop_logo') }}" width="" height="" />
                    </a>
                </dl>
                <dl class="store-name third-store">

                    <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" target="_blank" class="name" title="{{ $shop_info['shop']['shop_name'] }}">{{ $shop_info['shop']['shop_name'] }}</a>
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
                        {{--QQ--}}
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin={{ $shop_info['customer_main']['customer_account'] }}&amp;site=qq&amp;menu=yes" class="service-btn">
                            <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $shop_info['customer_main']['customer_account'] }}:52" alt="QQ" title="点击这里给我发消息" style="height: 20px;">
                            <span>QQ 交谈</span>
                        </a>
                    @elseif($shop_info['customer_main']['customer_tool'] == 2)
                        {{--旺旺--}}
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
                            <i class="iconfont">&#xe895;</i>
                            进入店铺
                        </a>
                        <a class="bg-color shop-add collect-shop" href="javascript:void(0);">

                            @if($goods['shop_collect'])
                                {{--已关注--}}
                                <i class="iconfont collect">&#xe6b1;</i>
                                <span>取消关注</span>
                            @else
                                {{--未关注--}}
                                <i class="iconfont collect">&#xe6b3;</i>
                                <span>关注本店</span>
                            @endif


                        </a>
                    </div>
                </div>
            </div>

            <!-- 店铺信息 _end-->

            <!--看了又看 _star-->
            <div class="goods-recommend" style="display: none">
                <div class="title">
                    <h3>看了又看</h3>
                    <span></span>
                </div>
                <div id="recommend-list" class="recommend-stage">
                    <ul>
                        <li>
                            <a class="" href="javascript:;" title="" target="_blank">
                                <img src="/images/user_headimg.gif" alt="" width="150" height="150">
                                <p class="price">￥18.00</p>
                            </a>
                        </li>
                        <li>
                            <a class="" href="javascript:;" title="" target="_blank">
                                <img src="/images/user_headimg.gif" alt="" width="150" height="150">
                                <p class="price">￥38.00</p>
                            </a>
                        </li>
                        <li>
                            <a class="" href="javascript:;" title="" target="_blank">
                                <img src="/images/user_headimg.gif" alt="" width="150" height="150">
                                <p class="price">￥38.00</p>
                            </a>
                        </li>
                        <li>
                            <a class="" href="javascript:;" title="" target="_blank">
                                <img src="/images/user_headimg.gif" alt="" width="150" height="150">
                                <p class="price">￥18.00</p>
                            </a>
                        </li>
                        <li>
                            <a class="" href="javascript:;" title="" target="_blank">
                                <img src="/images/user_headimg.gif" alt="" width="150" height="150">
                                <p class="price">￥58.00</p>
                            </a>
                        </li>
                        <li>
                            <a class="" href="javascript:;" title="" target="_blank">
                                <img src="/images/user_headimg.gif" alt="" width="150" height="150">
                                <p class="price">￥58.00</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="recommend-btn">
                    <a class="prev" href="javascript:;"></a>
                    <a class="next" href="javascript:;"></a>
                </div>
            </div>

            <!--看了又看 _end-->
        </div>

        <!-- 搭配套餐 -->

        <!-- 内容 -->
        <div class="clearfix">
            <!-- 左半部分内容 -->
            <div class="fl">
                <!-- 客服组 -->

                <div class="store-service">
                    <div class="store-logo">
                        <img src="/images/service.png" width="" height="" />
                    </div>
                    <div class="store-service-group left-content">

                        <div class="store-service-type first">
                            <h4>在线咨询</h4>

                            <div class="service-list">
                                <em>售前客服</em>


                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=410284576&site=qq&menu=yes" class="service-btn">
                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:410284576:52" alt="QQ" title="点击这里给我发消息" style="height: 20px;" />
                                    <span>小李</span>
                                </a>


                            </div>

                            <div class="service-list">
                                <em>售后客服</em>


                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=410284576&site=qq&menu=yes" class="service-btn">
                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:410284576:52" alt="QQ" title="点击这里给我发消息" style="height: 20px;" />
                                    <span>小乐</span>
                                </a>


                            </div>


                        </div>

                        <!---->
                        <div class="store-service-type">
                            <h4>工作时间</h4>
                            <div class="service-time">
                                <p>{{ $shop_info['shop']['service_hours'] }}</p>
                            </div>
                        </div>
                        <!---->
                    </div>

                </div>


                <!-- 店内分类 -->
                <!-- -->
                <div class="store-category">
                    <h3 class="left-title">店内分类</h3>
                    <div class="left-content tree">
                        <ul>


                            @foreach($shop_category_list as $v)
                            <li>
							<span>
								<i class="icon-minus-sign"></i>
							</span>
                                <a href="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html?cat_id={{ $v['cat_id'] }}"
                                   target="_self" title="{{ $v['cat_name'] }}" class="tree-first">{{ $v['cat_name'] }}</a>
                                <ul>



                                    @if(!empty($v['_child']))
                                        @foreach($v['_child'] as $child)
                                        <li>
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                            <a href="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html?cat_id={{ $child['cat_id'] }}"
                                               target="_self" title="{{ $child['cat_name'] }}">{{ $child['cat_name'] }}</a>
                                        </li>
                                        @endforeach
                                    @endif


                                </ul>
                            </li>
                            @endforeach


                        </ul>
                    </div>
                </div>

                <!-- 排行榜 -->

                <div class="store-rank-list">
                    <h3 class="left-title">店内排行榜</h3>
                    <div class="left-content rank-list">
                        <ul class="tab-nav j-tab-nav">
                            <li class="current">销售量</li>
                            <li>收藏数</li>
                        </ul>
                        <div class="tab-con">
                            <div class="j-tab-con">
                                <ul class="goods-list" style="display: block">

                                    @foreach($sale_top_list as $v)
                                    <li class="goods-item first">
                                        <div class="picture">
                                            <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}">
                                                <img src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                                            </a>
                                        </div>
                                        <div class="price">
                                            <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}">{{ msubstr($v['goods_name'],0,20) }}</a>
                                            <span class="color">￥{{ $v['goods_price'] }}</span>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                                <ul class="goods-list">

                                    @foreach($collect_top_list as $v)
                                        <li class="goods-item first">
                                            <div class="picture">
                                                <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}">
                                                    <img src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                                                </a>
                                            </div>
                                            <div class="price">
                                                <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}">{{ msubstr($v['goods_name'],0,20) }}</a>
                                                <span class="color">￥{{ $v['goods_price'] }}</span>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 您浏览过 -->

            </div>
            <!-- 右半部分内容 -->
            <div class="right right-con ">
                <div class="wrapper">
                    <div id="main-nav-holder" class="goods-detail">
                        <ul id="nav" class="tab">
                            <li class="title-list current">
                                <a href="javascript:;">规格参数</a>
                            </li>
                            <li class="title-list">
                                <a href="javascript:;">商品详情</a>
                            </li>

                            <li class="title-list">
                                <a id="evaluate_count" href="javascript:;">累计评价(0)</a>
                            </li>

                            <li class="title-list">
                                <a href="javascript:;">服务保障</a>
                            </li>


                        </ul>
                        <div class="right-side">
                            <!-- 失效不展示 -->


                            <a href="javascript:void(0);" class="right-addcart add-cart " id="right-addcart">
                                <i class="iconfont">&#xe6a8;</i>
                                加入购物车
                            </a>


                            <div class="right-side-con">
                                <ul class="right-side-ul">
                                    <li class="abs-active">
                                        <i></i>
                                        <span>规格参数</span>
                                    </li>
                                    <li>
                                        <i></i>
                                        <span>商品详情</span>
                                    </li>

                                    <li>
                                        <i></i>
                                        <span>商品评价</span>
                                    </li>



                                    <li>
                                        <i></i>
                                        <span>常见问题</span>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="main_widget_1">
                        <!-- 规格参数 _star -->
                        <div id="goods_attr_list" class="goods-detail-con goods-detail-tabs">
                            <ul class="goods-spec">
                                <li>
                                    商品名称：
                                    <span id="goods_attr_goods_name" title="{{ $goods['goods_name'] }}" class="goods-attr-value">{{ $goods['goods_name'] }}</span>
                                </li>
                                <li>
                                    商品编号：
                                    <span id="goods_attr_goods_id" title="{{ $goods['goods_id'] }}" class="goods-attr-value">{{ $goods['goods_id'] }}</span>
                                </li>
                                <li>
                                    店铺：
                                    <span id="goods_attr_shop_name" title="{{ $shop_info['shop']['shop_name'] }}" class="goods-attr-value">{{ $shop_info['shop']['shop_name'] }}</span>
                                </li>

                                @if(!empty($goods['brand_name']))
                                <li>
                                    商品品牌：
                                    <span id="goods_attr_brand_name" title="{{ $goods['brand_name'] }}" class="goods-attr-value">{{ $goods['brand_name'] }}</span>
                                </li>
                                @endif


                                <!-- 商品规格 -->

                                @if(!empty($goods['spec_list']))
                                    @foreach($goods['spec_list'] as $v)
                                        <li>
                                            {{ $v['attr_name'] }}：
                                            <span title="{{ $v['attr_name'] }}" class="goods-attr-value">

                                                {{ implode(' ', array_column($v['attr_values'], 'attr_value')) }}

                                            </span>
                                        </li>
                                    @endforeach
                                @endif

                                {{--属性列表--}}
                                @if(!empty($goods['other_attrs']))
                                    @foreach($goods['other_attrs'] as $v)
                                        <li>
                                            {{ $v['attr_name'] }}：
                                            <span id="goods_attr_" title="{{ $v['attr_value'] }}" class="goods-attr-value">{{ $v['attr_value'] }}</span>
                                        </li>
                                    @endforeach
                                @endif
                                @if(!empty($goods['attr_list']))
                                   @foreach($goods['attr_list'] as $v)
                                        <li>
                                            {{ $v['attr_name'] }}：
                                            <span id="goods_attr_" title="{{ $v['attr_values'] }}" class="goods-attr-value">{{ $v['attr_values'] }}</span>
                                        </li>
                                    @endforeach
                                @endif


                            </ul>
                        </div>
                        <!-- 规格参数 _end -->
                        <!-- 商品详情 _star -->
                        <div id="goods_introduce" class="goods-detail-con goods-detail-tabs">
                            <!-- 店铺红包 -->

                            <!-- 推荐商品 -->

                            <!-- 商品后台上传的商品描述 -->
                            <div class="detail-content goods-detail-content">
                                <div class="ajax-loading">
                                    <img src="/images/loading.gif" />
                                </div>



                            </div>
                        </div>
                        <!-- 商品详情 end -->

                        <!-- 商品评价 start -->
                        <div id="goods_evaluate" class="goods-detail-con goods-detail-tabs"></div>
                        <!-- 商品评价 end -->

                        <!-- 服务 start -->

                        <!-- 常见问题 _star -->
                        <div id="common_problem" class="goods-detail-con goods-detail-tabs">
                            <div class="wenti">
                                <div class="tab-title">
                                    <span class="color">常见问题</span>
                                </div>
                                <div class="tab-body">

                                    @foreach($goods['question_list'] as $k=>$v)
                                    <div class="list @if($k == 4) last @endif">
                                        <div class="question">
                                            <span class="icon fl"></span>
                                            <strong class="common-right">{{ $v['question'] }}</strong>
                                        </div>
                                        <div class="answer">
                                            <span class="icon fl"></span>
                                            <p class="common-right">{{ $v['answer'] }}</p>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- 常见问题 _end -->
                        <!-- 服务 end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content" style="display: none;">
        <p class="common-right">
            一般情况下，退货处理周期（不包含检测时间）：自接收到问题商品之日起 7 日之内为您处理完成，各支付方式退款时间请点击查阅退款多久可以到账；
            </br>
            换货处理周期：自接收到问题商品之日起 15 日之内为您处理完成；
            </br>
            正常维修处理周期：自接收到问题商品之日起 30 日内为您处理完成。
        </p>
    </div>

    @if(sysconf('goods_info_pickup'))
    <!-- 自提点弹框 _start-->
    <!-- 自提点 _start -->
    <div id="goods_pickup" class="goods-pickup">
        <div class="box-title">自提点列表</div>
        <div class="box-oprate" data-shop_id='1'></div>
        <div class="content-info">
            <form method="post" onSubmit="return false;">
                <div class="logistics-search-box">
                    <input class="logistics-search-input" placeholder="请输入自提点名称或自提点所在地" type="text" name="logistics-search" data-shop_id='1' onkeydown='logistics(event);' />
                    <a class="btn btn-primary" data-shop_id='1'>搜索</a>
                </div>
                <ul class="logistics-store-list">


                    {{--引入自提点--}}
                    @include('goods.partials._self_pickup_list')


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
    @endif

    <!-- 头部右侧鼠标经过图片放大效果 _start -->
    <script type="text/javascript" src="/js/bubbleup.js"></script>
    <!-- 头部右侧鼠标经过图片放大效果 _end -->
    <!-- 套餐、店内排行等左右切换效果 _start-->
    <script type="text/javascript" src="/js/tabs.js"></script>
    <!-- 套餐、店内排行等左右切换效果 _end -->
    <!-- 右侧商品信息等定位切换效果 _start -->
    <script type="text/javascript" src="/js/tabs_totop.js"></script>
    <!-- 右侧商品信息等定位切换效果 _end -->
    <!-- 控制图片经过放大 -->
    <script type="text/javascript" src="/js/goods.js"></script>
    <!-- 地址选择 _start -->
    <script type="text/javascript" src="/js/select_region.js"></script>
    <!-- 地址选择 _end -->
    <script id="SZY_GIFT_TEMPLATE" type="text">
<div class="prom-gift-list">
	<a href="" title="" target="_blank">
		<img src="" width="25" height="25" class="gift-img" />
	</a>
	<em class="gift-number color">×</em>
</div>
</script>
    @if(!empty($user_info))
        <!-- 分享 -->
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
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Geocoder,AMap.Geolocation,AMap.Autocomplete"></script>
    <!-- 获取当前地址 -->
    <script type="text/javascript">
        var deferred = $.Deferred();

        var local_region_code = "{{ $region_code }}";

        $().ready(function() {

            //
            if (local_region_code && local_region_code.length > 0) {
                changeLocation(local_region_code);
            }
            //

            //变更配送地址
            var region_chooser = $(".region-chooser-container").regionchooser({
                value: local_region_code,
                change: function(value, names, is_last) {
                    if (!is_last) {
                        return;
                    }
                    // 记录当前地址选择
                    local_region_code = value;
                    changeLocation(value);
                }
            });

            //在线客服
            /* 	$(".service-online").click(function() {
                    var goods_id = 249;
                    $.openim({
                        goods_id:goods_id
                    });
                }) */


            // 添加对比
            $(".add-compare").click(function(event) {
                var target = $(this);
                var goods_id = $(this).data("goods-id");
                var sku_id = $(this).add("sku-id");
                var image_url = $(this).data("image-url");
                $.compare.toggle(goods_id, image_url, event, function(result) {
                    if (result.data == 1) {
                        $(target).addClass("curr");
                        $(target).find('i').html('&#xe6ae;');
                    } else {
                        $(target).removeClass("curr");
                        $(target).find('i').html('&#xe715;');
                    }
                });
            });

            // 添加收藏
            $(".collect-goods").click(function(event) {
                var target = $(this);
                var goods_id = $(this).data("goods-id");

                var sku_id = getSkuId();

                $.collect.toggleGoods(goods_id, sku_id, function(result) {
                    if (result.code != 0) {
                        return;
                    }

                    var desc = "";

                    //
                    if(result.collect_count > 0){
                        desc = "(" + result.collect_count + "人气)";
                    }
                    //
                    if (result.data == 1) {
                        $(target).addClass("curr");
                        $(target).find('i').html('&#xe6b1;');
                        $(target).find("span").html("取消收藏" + desc);
                    } else {
                        $(target).removeClass("curr");
                        $(target).find('i').html('&#xe6b3;');
                        $(target).find("span").html("收藏商品" + desc);
                    }
                }, true);
            });
            // 添加收藏
            $(".collect-shop").click(function(event) {
                var target = $(this);
                var shop_id = "1";
                $.collect.toggleShop(shop_id, function(result) {
                    if (result.data == 1) {
                        $(target).find("span").html("取消关注");
                        $(target).find('i').html('&#xe6b1;');
                    } else {
                        $(target).find("span").html("关注本店");
                        $(target).find('i').html('&#xe6b3;');
                    }
                });
            });

            // 领取红包
            $("body").on("click", ".bonus-receive", function() {
                var bonus_id = $(this).data("bonus-id");
                var target = $(this);
                $.bonus.receive(bonus_id, function(result) {
                    if (result.code == 0) {
                        // 0-已领取 1-还可以继续领取
                        if (result.data == 0) {
                            $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                        }
                        $.msg(result.message);
                        return;
                    } else if (result.code == 130) {
                        $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                    } else if (result.code == 131) {
                        $(target).html("已抢光").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                    } else {

                    }
                    $.msg(result.message, {
                        time: 5000
                    });
                });
            });
        });
    </script>
    <script type="text/javascript">
        //固定滚动条位置
        $.fixedScorll.read("SZY_GOODS_SCORLL");

        $().ready(function() {

            // 申请代理
            $("body").on("click", ".no-auth", function() {
                // 商品ID
                var id = $(this).data("goods_id");

                $.ajax({
                    type:"POST",
                    url:'/goods/shop-type-by-goods',
                    data: {
                        goods_id: id
                    },
                    dataType: "json",
                    success:function(result){
                        if(result.code==0){
                            $.open({
                                title: "申请代理	",
                                //type:2,
                                ajax: {
                                    url: '/compare/agent',
                                    data: {
                                        goods_id: id
                                        //	single: single
                                    }
                                },
                                width: "900px",
                                btn: ['确定', '取消'],
                                yes: function(index, container) {
                                    if (!validator.form()) {
                                        return;
                                    }

                                    var data = $(container).serializeJson();
                                    $.loading.start();
                                    $.post('/compare/agent', data, function(result) {
                                        $.loading.stop();
                                        if (result.code == 0) {
                                            //tablelist.load();
                                            $.msg(result.message);
                                            $.closeDialog(index);
                                        } else {
                                            $.msg(result.message, {
                                                time: 5000
                                            })
                                        }
                                    }, "json");
                                }
                            });
                        }
                    }
                });
            });

            var desc_container = $(".goods-detail-content");
            var evaluate_container = $("#goods_evaluate");

            function load() {

                // 加载商品详情
                if (!$("body").data("loading-goods-desc")) {
                    // 计算高度
                    if ($(document).scrollTop() >= $(desc_container).offset().top - $(window).height()) {
                        $("body").data("loading-goods-desc", true);
                        $.get("/goods/desc.html", {
                            sku_id: "{{ $goods['sku_id'] }}",
                            is_lib_goods: ""
                        }, function(result) {
                            $(desc_container).html(result.pc_desc);
                        }, "json");
                    }
                }
                // 评论
                if (!$("body").data("loading-goods-comment") && $(evaluate_container).size() > 0) {
                    // 计算高度
                    if ($(document).scrollTop() >= $(evaluate_container).offset().top - $(window).height()) {
                        $("body").data("loading-goods-comment", true);
                        $.get('/goods/comment.html', {
                            sku_id: "{{ $goods['goods_id'] }}",
                            output: 1
                        }, function(result) {
                            if (result.code == 0) {
                                $(evaluate_container).html(result.data);
                            }
                        }, "json");
                    }
                }
            }

            load();

            // 加载商品详情和评论
            $(window).scroll(function() {
                load();
            });
        });
        //计算阶梯价格
        function getFinalPrice(sku_id, number) {
            var data = {
                sku_id: sku_id,
                number: number
            };
            $.get('/goods/get-final-price.html', data, function(result) {

                $('.SZY-GOODS-PRICE').html(result.data.goods_price_format);

            }, 'json');
        }
    </script>

    {{--todo 判断 限时团购倒计时显示--}}
    <!-- 倒计时 -->
    <script type="text/javascript">
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            $("#groupbuy_countdown").countdown({
                time: "596522000",

                htmlTemplate: '<span>%{d}</span>:<span>%{h}</span>:<span>%{m}</span>:<span>%{s}</span>',

                leadingZero: true,
                onComplete: function(event) {
                    $(this).parent().html("团购活动已结束！");
                    $.go("{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}");
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
                time: "594235000",
                leadingZero: true,
                onComplete: function(event) {
                    //$(this).parent().html("活动已结束！");
                    $.go("{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}");
                }
            });
        });
    </script>


    <!-- 预售倒计时 -->
    <link rel="stylesheet" href="/css/online.css?v=20190130"/>
    <div class="yikf-form site_yikf_form" id="yikf-kefu" style='display:none;'>
        <i class="yikf-icon"></i>

        <form class="yikf-item " action="https://kf.mall.laravelvip.com/index/index/home?business_id=eb5bf6642a5a445221241a51842b901c&groupid=0&shop_id=1&goods_id=249" method="post" target="_blank">
            <input type="hidden" name="visiter_id" value=''>
            <input type="hidden" name="visiter_name" value=''>
            <input type="hidden" name="avatar" value=''>
            <input type="hidden" name="domain" value=''>

            <input type="hidden" name="product" value='{"pid":249,"title":"\u6c5f\u534e-\u6d4b\u8bd5H1","img":"http:\/\/68yun.oss-cn-beijing.aliyuncs.com\/images\/15164\/shop\/1\/gallery\/2018\/05\/17\/15265253513800.jpg","info":"\u6d4b\u8bd5H1","price":"95.00","goods_type":null,"url":"http:\/\/www.b2b2c.yunmall.68mall.com\/goods-249.html"}'>

            <input type="submit" value='在线咨询'>
        </form>

        <form class="yikf-item " action="https://kf.yunmall.68mall.com/index/index/home?business_id=eb5bf6642a5afe7621241a51842b901c&groupid=151&shop_id=1&goods_id=249" method="post" target="_blank">
            <input type="hidden" name="visiter_id" value=''>
            <input type="hidden" name="visiter_name" value=''>
            <input type="hidden" name="avatar" value=''>
            <input type="hidden" name="domain" value=''>

            <input type="hidden" name="product" value='{"pid":249,"title":"\u6c5f\u534e-\u6d4b\u8bd5H1","img":"http:\/\/68yun.oss-cn-beijing.aliyuncs.com\/images\/15164\/shop\/1\/gallery\/2018\/05\/17\/15265253513800.jpg","info":"\u6d4b\u8bd5H1","price":"95.00","goods_type":null,"url":"http:\/\/www.b2b2c.yunmall.68mall.com\/goods-249.html"}'>

            <input type="submit" value='售前客服'>
        </form>

    </div>
    <script type="text/javascript">

    </script>
@stop