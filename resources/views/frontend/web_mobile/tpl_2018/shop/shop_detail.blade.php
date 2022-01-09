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
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />
    <!-- #is_wabp_end -->
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="http://lanse31.oss-cn-beijing.aliyuncs.com/images/system/config/website/favicon_0.png" />
    <link rel="shortcut icon" type="image/x-icon" href="http://lanse31.oss-cn-beijing.aliyuncs.com/images/system/config/website/favicon_0.png" />
    <link rel="stylesheet" href="/mobile/css/common.css?v=20181217"/>
    <link rel="stylesheet" href="/mobile/css/shop_header.css?v=20181217"/>
    <link rel="stylesheet" href="/mobile/css/shop_coupon.css?v=20181217"/>
    <link rel="stylesheet" href="/mobile/css/bonus_message.css?v=20181217"/>
    <link rel="stylesheet" href="/mobile/css/swiper.min.css?v=20181217"/>
    <link rel="stylesheet" href="/mobile/css/swiper.3dmin.css?v=20181217"/>
    <!---->

    <!-- ================== END BASE CSS STYLE ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=20181227"></script>
    <script src="/mobile/js/zepto.min.js?v=20181227"></script>
    <script src="/mobile/js/zepto.waypoints.js?v=20181227"></script>
    <script src="/mobile/js/swiper.jquery.min.js?v=20181227"></script>
    <script src="/mobile/js/shop.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/yii.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20181227"></script>
    <script src="/mobile/js/common.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20181227"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20181227"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20181227"></script>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable_m_site') == 1)
        <link rel="stylesheet" href="/mobile/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/mobile/css/color-style.css?v=1.2" id="site_style"/>
    @endif

    <link rel="stylesheet" href="/mobile/css/common.css?v=20181217"/>
</head>
<body>
<!-- 引入头部文件 -->
<!-- -->
<!-- -->
<!---->
<!-- 内容 -->
<link rel="stylesheet" href="/mobile/css/dianpu.css?v=20181217"/>
<link rel="stylesheet" href="/mobile/css/dianpu_info.css?v=20181217"/>
<header class="header">
    <div class="header-left">
        <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
    </div>
    <div class="header-middle">店铺详情</div>
    <div class="header-right">
        <aside class="show-menu-btn">
            <div id="show_more" class="show-menu">
                <a href="javascript:void(0);"></a>
            </div>
        </aside>
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

                <span class="collect-num" id="collect-count">32人关注</span>

            </div>
        </div>
        <div class="collect-btn">
            <i class="iconfont">&#xe615;</i>
            <span onClick="toggleShop('5',this)">

				已收藏

			</span>
        </div>
    </div>
    <div class="store-detail-score">
        <div class="detail-score-centent ui-flex ">
            <a href="javascript:;" class="cell">
                <span class="score-num">5.00</span>
                <span class="score-text">描述相符</span>
            </a>
            <a href="javascript:;" class="cell">
                <span class="score-num">5.00</span>
                <span class="score-text">服务态度</span>
            </a>
            <a href="javascript:;" class="cell">
                <span class="score-num">5.00</span>
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

        <div class="common-field border-b">
            <div class="name">所在地区</div>
            <div class="content">
                <p class="info">湖北省 黄冈市 红安县 园艺路三1良品运营中心（广吉康购物广场）</p>
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
                <img src="{{ $shop_info['shop']['wx_barcode'] }}" alt="店铺二维码" />
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



        <a href="/shop/5.html">
            <i class="shop-nav-icon"></i>
            <span>首页</span>
        </a>

    </div>
    <ul>
        <!---->
        <li class="goods-category disabled">
            <a href="javascript:void(0)">
				<span>
					<i class="shop-index"></i>
					<div class="loader-img">
						<div></div>
					</div>
					商品分类
				</span>
            </a>
        </li>

        <li>
            <a href="/shop/5/info.html">
				<span>
					<i class="shop-index"></i>
					店铺详情
				</span>
            </a>
        </li>

        <!-- -->
        <li>
            <a href="/bonus/list/5.html">
				<span>
					<i class="shop-index"></i>
					店铺红包
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
    var shop_id = '5';
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
        if(sessionStorage.goods_category_5){
            $('.SZY-SHOP-CATEGORY-LIST').html(sessionStorage.goods_category_5);
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
                if ($.trim($(obj).html()) == "收藏") {
                    $(obj).html("已收藏");
                } else {
                    $(obj).html("收藏");
                }
            }
        }, true);
    }
</script>
<!-- 引底部文件 -->
<!-- -->

<!-- 隐藏菜单_start -->
<div class="show-menu-info" id="menu">
    <ul>
        <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
        <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
        <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
        <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
    </ul>
</div>
<!-- 隐藏菜单_end -->
<!---->
<!-- 购物车js -->
<script src="/mobile/js/jquery.fly.min.js?v=20181227"></script>
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