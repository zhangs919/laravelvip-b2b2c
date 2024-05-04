<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta content="telephone=no,email=no,address=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="wap-font-scale" content="no" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    {!! $lrw_tag ?? '' !!}
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />
    <!-- #is_wabp_end -->
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/css/common.css?v=20181217"/>
    <link rel="stylesheet" href="/css/shop_header.css?v=20181217"/>
    <link rel="stylesheet" href="/css/shop_coupon.css?v=20181217"/>
    <link rel="stylesheet" href="/css/bonus_message.css?v=20181217"/>
    <link rel="stylesheet" href="/css/swiper.min.css?v=20181217"/>
    <link rel="stylesheet" href="/css/swiper.3dmin.css?v=20181217"/>
    <!---->

    <!-- ================== END BASE CSS STYLE ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=20181227"></script>
    <script src="/js/zepto.min.js?v=20181227"></script>
    <script src="/js/zepto.waypoints.js?v=20181227"></script>
    <script src="/js/swiper.jquery.min.js?v=20181227"></script>
    <script src="/js/shop.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/yii.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20181227"></script>
    <script src="/js/common.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20181227"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20181227"></script>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
    @endif

    <link rel="stylesheet" href="/css/common.css?v=20181217"/>

    {{--国家默哀日期--}}
    {!! $national_memorial_day_html ?? '' !!}
</head>
<body>
<!-- 引入头部文件 -->
<!-- -->
<!-- -->
<!---->
<!-- 内容 -->
<link rel="stylesheet" href="/css/dianpu.css?v=20181217"/>
<link rel="stylesheet" href="/css/dianpu_info.css?v=20181217"/>
<header class="header-top-nav">
    <div class="header">
        <div class="header-left">
            <a class="sb-back" href="javascript:history.back(-1);" title="返回" szy_tag_compiled="1">
                <i class="iconfont"></i>
            </a>
        </div>
        <div class="header-middle">店铺详情</div>
        <div class="header-right">

            <aside class="show-menu-btn">
                <div class="show-menu" id="show_more">
                    <a href="javascript:void(0);" szy_tag_compiled="1">
                        <i class="iconfont"></i>
                    </a>
                </div>
            </aside>

        </div>
    </div>
</header>

<div class="shop-introduction-box">
    <div class="shop-introduction-top ui-flex">
        <div class="shop-desc cell">
            <a class="shop-logo" href="javascript:void(0)">
                <img src="{{ get_image_url($shop_info['shop']['shop_logo']) }}">
            </a>
            <div class="shop-info cell">
                <a class="shop-name">{{ $shop_info['shop']['shop_name'] }}</a>

                <span class="collect-num" id="collect-count">{{ $shop_info['shop']['collect_num'] }}人关注</span>

            </div>
        </div>
        <div class="collect-btn">
            <i class="iconfont">&#xe615;</i>
            <span onClick="toggleShop('{{ $shop_info['shop']['shop_id'] }}',this)">

				@if($shop_info['shop']['is_collect'])已关注@else关注@endif

			</span>
        </div>
    </div>
    <div class="store-detail-score">
        <div class="detail-score-centent ui-flex ">
            <a href="javascript:;" class="cell">
                <span class="score-num">{{ $shop_info['shop']['desc_score'] }}</span>
                <span class="score-text">描述相符</span>
            </a>
            <a href="javascript:;" class="cell">
                <span class="score-num">{{ $shop_info['shop']['service_score'] }}</span>
                <span class="score-text">服务态度</span>
            </a>
            <a href="javascript:;" class="cell">
                <span class="score-num">{{ $shop_info['shop']['send_score'] }}</span>
                <span class="score-text">发货速度</span>
            </a>
        </div>
    </div>
    <div class="shop-detail-item">
        <a class="shop-item-list" href="javascript:void(0)">
            <div class="item-list-left ui-flex ">
                <span class="list-title">掌柜名</span>
                <span class="cell list-desc">{{ $shop_info['user']['user_name'] }}</span>
            </div>
            <div class="item-list-right"></div>
        </a>
        <a class="shop-item-list" href="javascript:void(0)">
            <div class="item-list-left ui-flex ">
                <span class="list-title">服务电话</span>
                <span class="cell list-desc">暂无</span>
            </div>
            <div class="item-list-right phone-number"></div>
        </a>
        <a class="shop-item-list" href="javascript:void(0)" id="shop_qrcode">
            <div class="item-list-left ui-flex ">
                <span class="list-title">店铺名片</span>
            </div>
            <div class="item-list-right shop-qrcode"></div>
        </a>
    </div>
    <div class="shop-detail-item">
        <a class="shop-item-list" href="javascript:void(0)" szy_tag_compiled="1">
            <div class="item-list-left ui-flex ">
                <span class="list-title">开店时长</span>
                <span class="cell list-desc">5个月 16天</span>
            </div>
        </a>

        <div class="common-field border-b">
            <div class="name">所在地区</div>
            <div class="content">
                <p class="info">{{ $region_name }} {{ $shop_info['shop']['address'] }}</p>
            </div>
        </div>

        <div class="shop-item-list">
            <div class="item-list-left ui-flex ">
                <span class="list-title">工商执照</span>
                <span class="cell list-desc">


					<a id="" href="/shop/index/license.html?id={{ $shop_info['shop']['shop_id'] }}" szy_tag_compiled="1">
						<img src="/images/national_emblem_light2.png" width="20" height="20" border="0" alt="特殊行业资质">
					</a>

				</span>
            </div>
        </div>
    </div>
</div>
<div class="shop-qrcode-section hide">
    <div class="qrcode-mask"></div>
    <div class="qrcode-box">
        <div class="qrcode-content">
			<span class="qrcode-content-hd">
                {{ $shop_info['shop']['shop_name'] }}
			</span>
            <div class="qrcode-content-bd">
                {{--<img src="{{ $shop_info['shop']['wx_barcode'] }}" alt="店铺二维码" />--}}
                <img src="/shop/qrcode.html?id={{ $shop_info['shop']['shop_id'] }}" alt="店铺二维码" />
                <span class="qrcode-tips">邀请好友来扫一扫分享店铺给TA</span>
            </div>
        </div>
    </div>
</div>
<!--底部菜单 start-->
<!--底部菜单 start-->
<div style="height: 45px;"></div>
<div class="shop-footer">
    <div class="shop-footer-l">



        <a href="{{ shop_prefix_url($shop_info['shop']['shop_id']) }}">
            <i class="shop-nav-icon"></i>
            <span>首页</span>
        </a>

    </div>
    <ul>
        <!---->
        {{--<li class="goods-category disabled">
            <a href="javascript:void(0)">
				<span>
					<i class="shop-index"></i>
					<div class="loader-img">
						<div></div>
					</div>
					商品分类
				</span>
            </a>
        </li>--}}
        <li>
            <a href="{{ shop_prefix_url($shop_info['shop']['shop_id'],'mobile_shop_goods_list') }}">
                <span>
                    <i class="shop-index"></i>
                    全部商品
                </span>
            </a>
        </li>
        <li>
            <a href="{{ shop_prefix_url($shop_info['shop']['shop_id'],'mobile_shop_info') }}">
				<span>
					<i class="shop-index"></i>
					店铺详情
				</span>
            </a>
        </li>

        <!-- -->
        {{--<li>
            <a href="/bonus/list/{{ $shop_info['shop']['shop_id'] }}.html">
				<span>
					<i class="shop-index"></i>
					店铺红包
				</span>
            </a>
        </li>--}}
        <li>
            <!-- 微商城客服调用qq -->
            <a href="javascript:void(0)" onClick="$.msg('卖家没有设置联系电话')">
                <span>
                    <i class="shop-index"></i>
                    联系客服
                </span>
            </a>
        </li>
    </ul>
</div>
<div class="classify-content SZY-SHOP-CATEGORY-LIST hide"></div>
<script type="text/javascript">
    var scrollheight = 0;
    var loaded = false;
    var position = 'info';
    var shop_id = '{{ $shop_info['shop']['shop_id'] }}';
    var cat_id = '';
    var parent_id = '';
    $().ready(function() {
        $('.goods-category').click(function() {
            var $this = $(this);
            if ($this.hasClass('disabled')) {
                return;
            }
            if ($(".classify-content").hasClass('hide')) {
                if (loaded) {
                    showClassifyContent($this);
                    return;
                }
                $.get('/shop/index/shop-cat-list', {
                    'shop_id': shop_id,
                    'cat_id': cat_id
                }, function(result) {
                    $('.SZY-SHOP-CATEGORY-LIST').html(result.data);
                    showClassifyContent($this);
                }, "json");
            } else {
                hideClassifyContent($this);
            }
        });
        $('.shop-submenu-left li').click(function() {
            $(this).addClass('current').siblings().removeClass('current');
            $('#cat_chr_' + $(this).data("cid")).removeClass('hide').siblings().addClass('hide');
        });
        //滑动触发
        try {
            document.createEvent("TouchEvent");
            document.getElementById("maskdiv").addEventListener('touchmove', function(event) {
                $(".classify-content").addClass('hide');
                $(".classify-content").animate({
                    height: '0'
                }, [10000]);
                $('.mask-div').hide();
                $('.goods-category').removeClass('goods-category-after');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            }, false);

            $('.mask-div').click(function() {
                $(".classify-content").addClass('hide');
                $(".classify-content").animate({
                    height: '0'
                }, [10000]);
                $('.mask-div').hide();
                $('.goods-category').removeClass('goods-category-after');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            });
        } catch (e) {
            $('.mask-div').click(function() {
                $(".classify-content").addClass('hide');
                $(".classify-content").animate({
                    height: '0'
                }, [10000]);
                $('.mask-div').hide();
                $('.goods-category').removeClass('goods-category-after');
                $("body").css("top", "auto");
                $("body").removeClass("visibly");
                $(window).scrollTop(scrollheight);
            });
        }
        if(sessionStorage.goods_category_{{ $shop_info['shop']['shop_id'] }}){
            $('.SZY-SHOP-CATEGORY-LIST').html(sessionStorage.goods_category_{{ $shop_info['shop']['shop_id'] }});
            $("li[id^='cat_item']").removeClass('current');
            if(cat_id == parent_id){
                $('#cat_item_'+cat_id).addClass('current');
            }else{
                $('#cat_item_'+parent_id).addClass('current');
                $('#cat_item_'+cat_id).addClass('current');
            }
            $('.SZY-SHOP-GOODS-CHR ul').addClass('hide');
            $('#cat_item_'+cat_id).parent('ul').removeClass('hide');
            $('.goods-category').removeClass('disabled');
            $(".classify-content").addClass('hide');
            loaded = true;
            return;
        }else{
            $.get('/shop/index/shop-cat-list', {
                'shop_id': shop_id,
                'cat_id': cat_id
            }, function(result) {
                $('.SZY-SHOP-CATEGORY-LIST').html(result.data);
                sessionStorage.goods_category_5 = result.data;
                $('.goods-category').removeClass('disabled');
                $(".classify-content").addClass('hide');
                loaded = true;
            }, "json");
        }

    });
    //显示弹出层
    function showClassifyContent($this) {
        $(".classify-content").removeClass('hide');
        $(".classify-content").animate({
            height: '70%'
        }, [10000]);
        $('.mask-div').show();
        $this.addClass('goods-category-after');
        scrollheight = $(document).scrollTop();
        $("body").css("top", "-" + scrollheight + "px");
        $("body").css("top", "-" + scrollheight + "px");
        $("body").addClass("visibly");
    }

    //隐藏弹出层
    function hideClassifyContent($this) {
        if ($this.hasClass('disabled')) {
            $this.removeClass('disabled');
        }
        $(".classify-content").addClass('hide');
        $(".classify-content").animate({
            height: '0'
        }, [10000]);
        $('.mask-div').hide();
        $this.removeClass('goods-category-after');
        $("body").css("top", "auto");
        $("body").removeClass("visibly");
        $(window).scrollTop(scrollheight);
    }
</script>
<!--底部菜单 end-->
<script type='text/javascript'>
    $('#shop_qrcode').click(function() {
        $('.shop-qrcode-section').removeClass('hide');
        $('.shop-introduction-box').height($(window).height() - 50);
        $('.shop-introduction-box').css('overflow', 'hidden');
    });
    $('.qrcode-mask').click(function() {
        $('.shop-qrcode-section').addClass('hide');
        $('.shop-introduction-box').removeAttr('style');
    });
</script>

<script type='text/javascript'>
    function toggleShop(shop_id, obj) {
        $.collect.toggleShop(shop_id, function(callback) {
            if (callback.code == 0) {
                $('#collect-count').html(callback.collect_count + "人关注");
                if ($.trim($(obj).html()) == "关注") {
                    $(obj).html("已关注");
                } else {
                    $(obj).html("关注");
                }
            }
        }, true);
    }
</script>
<!-- 引底部文件 -->
<!-- -->

<!-- 隐藏菜单_start -->
{{--引入右上角菜单--}}
@include('layouts.partials.right_top_menu')
<!-- 隐藏菜单_end -->
<!---->
<!-- 购物车js -->
<script src="/js/jquery.fly.min.js?v=20181227"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20181227"></script>


<script type="text/javascript">
    $().ready(function() {
        // 缓载图片
        $.imgloading.loading();
    });

    //图片预加载
    document.onreadystatechange = function() {
        if (document.readyState == "complete") {
            $.imgloading.setting({
                threshold: 1000
            });
            $.imgloading.loading();
        }
    }
</script>
<!-- 第三方流量统计 -->

<!-- 底部 _end-->
</body>
</html>