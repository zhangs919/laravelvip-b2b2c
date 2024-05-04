@extends('layouts.base')

@section('header_css')
    <link href="/css/goods.css" rel="stylesheet">
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
                    //
                </script>
                <!--相册 END-->

                <script type="text/javascript">
                    //
                </script>
            </div>
            <!-- 商品图片以及相册 _end-->
            <!-- 商品详细信息 _star-->
            <div class="detail-info">
                <form action="" method="post" name="" id="">
                    <!-- 商品名称 -->
                    <h1 class="goods-name SZY-GOODS-NAME">{{ $sku['sku_name'] }}</h1>
                    <!-- 限时折扣 -->
                    <!-- 预售 -->
                    <!-- 商品简单描述 -->
                    <p class="goods-brief second-color">{{ $goods['goods_subname'] }}</p>
                    <!-- 商品团购倒计时 -->
                    <!--当团购商品未开始时-->
                    <div class="goods-price">
                        <!-- 商品不同的价格 -->
                        <div class="show-price" style="display: none;">
                            <span class="price SZY-MARKET-PRICE-LABEL"></span>
                            <em class="market-price SZY-MARKET-PRICE"></em>
                        </div>
                        <!-- 商品市场价 _end -->
                        <!-- 销量及评价 _start -->
                        <div class="goods-info-other">

                            <div class="item sale">
                                <p>累计销量</p>
                                <em class="second-color">{{ $goods['sale_num'] }}</em>
                            </div>
                        </div>
                        <!-- 销量及评价 _end -->

                        <div class="realy-price">
                            <div class="now-prices">
                                <span class="price">售价</span>
                                <strong class="p-price second-color SZY-GOODS-PRICE">￥{{ $goods['goods_price'] }}</strong>
                            </div>
                            <!--
                                    <div class="depreciate">
                                        <a href="" title="">（降价通知）</a>
                                    </div>
                                     -->
                            <!-- 跨境商品显示总价规则 -->
                        </div>
                        <!--会员权益卡 内容 start-->
                        <!--会员权益卡 内容 end-->
                        <!-- 跨境商品显示进口税 -->
                    </div>
                    <!-- 在售的商品 _start -->
                    <!-- 虚拟商品判断 -->
                    @if(sysconf('goods_info_freight') == 0)
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
                                <a href="/" target="_blank" class="color">{{ $shop_info['shop']['shop_name'] }}</a>
                                负责发货，并提供售后服务。
                            </div>
                        </div>
                    </div>


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
                                    <!-- 属性值被选中的状态 -->
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
                                            <img src="/goods/qrcode.html?id={{ $goods['goods_id'] }}&is_lib_goods=1" width="100" height="100" />
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- 服务承诺 -->
                    </div>
                    <!-- 在售的商品 _end -->
                </form>
            </div>
            <script id="SZY_SKU_LIST" type="text">
                {{--sku list--}}
                {!! json_encode($goods['sku_list']) !!}
            </script>
            <script type="text/javascript">
                //
            </script>
            <!-- 商品详细信息 _end-->
            <!-- 店铺信息 _star-->
            <!-- 店铺信息 _end-->
        </div>
        <!-- 搭配套餐 -->
        <!-- 内容 -->
        <div class="clearfix">
            <!-- 左半部分内容 -->
            <div class="fl">
                <!-- 客服组 -->
                <!-- 店内分类 -->
                <!-- -->
                <!-- 排行榜 -->
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
                                    <span id="goods_attr_shop_name" title="" class="goods-attr-value"></span>
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
                        <!-- 商品评价 end -->
                        <!-- 服务 start -->
                        <!-- 常见问题 _star -->
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
    <!-- 头部右侧鼠标经过图片放大效果 _start -->
    <!-- 头部右侧鼠标经过图片放大效果 _end -->
    <!-- 套餐、店内排行等左右切换效果 _start-->
    <!-- 套餐、店内排行等左右切换效果 _end -->
    <!-- 右侧商品信息等定位切换效果 _start -->
    <!-- 右侧商品信息等定位切换效果 _end -->
    <!-- 控制图片经过放大 -->
    <!-- 地址选择 _start -->
    <!-- 地址选择 _end -->
    <script id="SZY_GIFT_TEMPLATE" type="text">
    <div class="prom-gift-list">
        <a href="" title="" target="_blank">
            <img src="" width="25" height="25" class="gift-img" />
        </a>
        <em class="gift-number color">×</em>
    </div>
    </script>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Geocoder,AMap.Geolocation,AMap.Autocomplete"></script>
    <!-- 获取当前地址 -->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <!-- 预售倒计时 -->
@stop


{{--平台客服系统--}}
@section('site_yikf_form')
{{--    @include('layouts.partials.site_yikf_form')--}}
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
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/assets/d2eace91/js/jquery.history.js"></script>
    <script src="/js/magiczoom.js"></script>
    <script src="/js/tabs_totop.js"></script>
    <script src="/js/goods.js"></script>
    <script src="/js/select_region.js"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        // 图片相册
        $(".goodsgallery").goodsgallery({
            images: $.parseJSON($("#SZY_SKU_IMAGES").html()),
            video: "{{ get_video_url($goods['goods_video']) }}"
        });
        //
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
        //
        var sku_ids = [];
        var local_region_code = "{{ $region_code ?? '' }}";
        var sku_freights = [];
        var change_sku_images = false;
        var is_cross_border = "0";
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
                    if (is_cross_border == 1) {
                        var freight_rate = '';
                        var goods_tax_price = '';
                        var tax = ((Number(result.data.freight_fee) * Number(freight_rate) / Number(100)) + Number(goods_tax_price));
                        $('.tax').html(tax.toFixed(2) + '元');
                    }
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
                            if ("0" == 1) {
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
                    is_lib_goods: "{{ $is_lib_goods }}"
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
            var is_lib_goods = "{{ $is_lib_goods }}";
            if (is_lib_goods == true) {
                // 商品名称
                $(".SZY-GOODS-NAME").html(sku.sku_name);
                // 售价
                $(".SZY-GOODS-PRICE").html(sku.goods_price_format);
                // 点击默认规格才会切换相册
                if (change_sku_images == true) {
                    // 相册
                    $(".goodsgallery").goodsgallery({
                        images: sku.sku_images,
                        video: "{{ get_video_url($goods['goods_video']) }}"
                    });
                    change_sku_images = false;
                }
                return;
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
                    video: "{{ get_video_url($goods['goods_video']) }}"
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
            $(".RANK-PRICE-FORMAT").html(sku.rank_price_format);
            $(".SAVE-PRICE-FORMAT").html(sku.save_price_format);
            // 市场价
            // 限时折扣 显示原价
            if (sku.activity && sku.activity.act_sub_label) {
                $("#limit_discount_label").find(".discount").html(sku.activity.act_sub_label);
                // $(".discount").html(discount_msg);
            } else {
                $("#limit_discount_label").find(".discount").html("");
            }
            if (sku.floor_price) {
                $(".SZY-MARKET-PRICE").html(sku.floor_price_format);
                $(".SZY-MARKET-PRICE-LABEL").html(sku.floor_price_label);
                $(".SZY-MARKET-PRICE").parents(".show-price").show();
            } else {
                $(".SZY-MARKET-PRICE").parents(".show-price").hide();
            }
            // 预售定金显示
            if (parseFloat(sku.earnest_money) > 0 && $('.SZY-EARNST-MONEY').length > 0) {
                $('.SZY-EARNST-MONEY').html(sku.earnest_money_format);
                $('.SZY-TAIL-MONEY').html(sku.tail_money_format);
            }
            // 库存
            if (goods_number > 0) {
                if ("" == 1) {
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
            // 最大购买数量
            if (sku.goods_max_number == null || sku.goods_max_number == undefined || isNaN(sku.goods_max_number)) {
                sku.goods_max_number = goods_number;
            }
            $(".amount-input").data("amount-step", sku.cart_step);
            $(".amount-input").data("amount-min", sku.cart_step);
            $(".amount-input").data("amount-max", sku.goods_max_number);
            if (goods_number > 0 && $(".amount-input").val() == 0) {
                $(".amount-input").val(sku.cart_step);
            } else if (goods_number == 0 && $(".amount-input").val() != 0) {
                $(".amount-input").val(0);
            } else if ($(".amount-input").val() < sku.cart_step) {
                $(".amount-input").val(sku.cart_step);
            } else if ($(".amount-input").val() % sku.cart_step != 0) {
                $(".amount-input").val(sku.cart_step);
            }
            var goods_number_input = parseInt($(".amount-input").val());
            if (goods_number_input > goods_number) {
                $(".amount-input").val(goods_number);
            }
            // 判断促销模块是否显示
            var show_activity = false;
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
                $(".SZY-MEMBER-PRICES").hide();
                // 展示促销
                show_activity = true;
            } else {
                $(".SZY-RANK-PRICES").hide();
            }
            if (sku.member_price_message) {
                $(".SZY-MEMBER-PRICES").show();
                $(".SZY-RANK-PRICES").hide();
                $(".SZY-MEMBER-MESSAGE").html(sku.member_price_message);
                // 展示促销
                show_activity = true;
            } else {
                $(".SZY-MEMBER-PRICES").hide();
            }
            // 处理赠品
            if (sku.gift_list && sku.gift_list.length > 0) {
                $(".SZY-GIFT-LIST").parent().show();
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
                $(".SZY-GIFT-LIST").parent().hide();
                //$(".SZY-GIFT-LABEL").nextAll().remove();
            }
            //订单返现
            if (sku.cash_back.message) {
                show_activity = true;
            }
            // 积分抵扣
            if (sku.integral_label) {
                $(".SZY-INTEGRAL-LABEL").show();
                show_activity = true;
            } else {
                $(".SZY-INTEGRAL-LABEL").hide();
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
                value: "1",
                min: "1",
                max: "{{ $sku['goods_number'] }}",
                change: function(element, value) {
                    var sku_id = element.data('sku_id');
                    if (value % this.step != 0) {
                        $.msg("商品数量必须是" + this.step + "的整数倍");
                        $(element).val(parseInt(value / this.step) * this.step);
                        return false;
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
                var is_lib_goods = "{{ $is_lib_goods }}";
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
                var act_type = "";
                var purchase = "15";
                var pre_sale = "2";
                var virtual = "0";
                var is_lib_goods = "{{ $is_lib_goods }}";
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
            // 设置默认权益卡
            {{--$.get('/goods/set-default-card', {--}}
                {{--shop_id: "{{ $shop_info['shop']['shop_id'] }}"--}}
            {{--}, function(result) {--}}
                {{--if (result.code == 0) {--}}
                    {{--window.location.reload();--}}
                    {{--$.msg(result.message);--}}
                {{--} else {--}}
                {{--}--}}
            {{--}, "json");--}}
            //身份验证弹框
            //        $(".buy-goods").click(function() {
            //            layer.open({
            //                type: 1,
            //                title: '身份验证',
            //                area: ['700px', '330px'],
            //                content: $('#status-verify').html()
            //            });
            //        });
        });
        //
        var deferred = $.Deferred();
        var local_region_code = "{{ $region_code ?? '' }}";
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
            /*     $(".service-online").click(function() {
                    var goods_id = 40828;
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
                var shop_id = "{{ $shop_info['shop']['shop_id'] ?? '' }}";
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
        //
        $().ready(function() {
            //固定滚动条位置
            $.fixedScorll.read("SZY_GOODS_SCORLL");
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
                                title: "申请代理    ",
                                //type:2,
                                ajax: {
                                    url: '/compare/agent',
                                    data: {
                                        goods_id: id
                                        //    single: single
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
                            is_lib_goods: "{{ $is_lib_goods }}"
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
                            sku_id: "{{ $goods['sku_id'] }}",
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
            WS_AddUser({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_user"
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
