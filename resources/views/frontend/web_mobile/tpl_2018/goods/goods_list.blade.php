@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/category.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')
    <!-- 内容 -->
    <div id="index_content"><!-- 默认缓载图片 -->
        <!-- 加载列表页CSS -->
        <!--列表页内容start-->
        <section class="category-content-section">
            <form id="searchForm" class="screen-term" method="GET" action="">
                <header>
                    <div class="category-header">
                        <div class="category-left">
                            <a href="javascript:history.back(-1)" class="sb-back iconfont icon-fanhui1" title="返回"></a>
                        </div>
                        <div class="header-middle">
                            <div class="search-box ub">
                                <input class="submit" value="">
                                <input name="keyword" type="search" placeholder="搜索该分类下商品" class="text" value="">
                                <input name="cat_id" type="hidden" value="{{ $cat_id ?? '' }}">
                                <input name="is_self" type="hidden" value="0">
                                <input name="is_free" type="hidden" value="0">
                                <input name="is_stock" type="hidden" value="0">
                                <input name="is_cash" type="hidden" value="0">
                                <input name="brand_id" type="hidden" value="">
                                <input name="filter_attr" type="hidden" value="">
                                <input name="sort" type="hidden" value="0">
                                <input name="order" type="hidden" value="ASC">
                            </div>
                        </div>
                        <!--grid布局的a有show-list这个class，list布局没有-->
                        <div class="category-right">
                            <a href="javascript:void(0)" class="show-type show-list">&nbsp;</a>
                            <a class="submit" href="javascript:void(0)">
                                <input class="bg-color" type="submit" value="搜索">
                            </a>
                        </div>
                    </div>
                </header>
                <!--筛选样式start-->
                <section class="filtrate-pop-section">
                    <div class="mask-content"></div>
                    <section class="close-filter-content">
                        <div class="close-btn">
                            <i class="iconfont">&#xe636;</i>
                            <span>关闭</span>
                        </div>
                    </section>
                    <div class="sidebar-content">
                        <section id="filter_content">
                            <div class="base-filter-title">通用筛选</div>
                            <ul class="show base-filter">
                                <li data-type="is_self">平台自营</li>
                                <li data-type="is_free">包邮</li>
                                <li data-type="is_cash">支持货到付款</li>
                                <li data-type="is_stock">仅显示有货</li>
                            </ul>
                            <div class="price-box">
                                <label>价格</label>
                                <div class="price-select">
                                    <div id="slider-range" class="price-select-info">
                                        <div class="current-price-range" style="left: 0%; width: 0%;"></div>
                                    </div>
                                    <input name="price_min" type="hidden" value="3">
                                    <input name="price_max" type="hidden" value="588">
                                    <div class="price-info">
                                        <span id="slider-range-amount">3 ~ 588</span>
                                    </div>
                                </div>
                                <!-- 价格区间 -->
                                <script type="text/javascript">
                                    //
                                </script>
                            </div>
                            @if(!empty($filter['brand']['items']))
                                <div class="attr-info">
                                    <div class="filtrate-list">
                                        <a href="javascript:void(0);">
                                            <label>品牌</label>

                                            <span>
                                        全部
                                        <i class="iconfont">&#xe607;</i>
                                    </span>

                                        </a>
                                    </div>
                                    <ul class="brand-list attr-info-ul" data-type="brand" style="display: block">
                                        <!--品牌-->

                                        @foreach($filter['brand']['items'] as $k=>$v)
                                            <li data-brand_id="{{ $v['value'] }}" @if($k > 2)class="hide"@endif>{{ $v['name'] }}</li>
                                        @endforeach

                                    </ul>
                                </div>
                            @endif
                            <div style="height: 55px; line-height: 55px;"></div>
                            <div class="filter-footer">
                                <a href="javascript:void(0)" class="filter-clear">清空</a>
                                <button type="button" class="btn-submit">确定</button>
                            </div>
                        </section>
                    </div>
                </section>
                <!--筛选内容end-->
            </form>
            <section class="filtrate-term">
                <ul>
                    <li class="icon-sort active" data-sort="0">
                        <span>综合</span>
                    </li>
                    <li class="" data-sort="1">
                        <span>销量</span>
                    </li>
                    <li class="icon-sort-price " data-sort="4">
                <span class="">
                    价格
                    <i></i>
                </span>
                    </li>
                    <li>
                <span>
                    筛选
                    <i class="iconfont icon-shaixuan"></i>
                </span>
                    </li>
                </ul>
            </section>
            <div class="mask-div"></div>
            <div class="filtrate-more hide sale-num">
        <span>
            <a href="javascript:void(0)" data-sort="0" data-name="综合" class="current"> 综合排序 </a>
        </span>
                <span>
            <a href="javascript:void(0)" data-sort="2" data-name="新品" class=""> 新品优先 </a>
        </span>
                <span>
            <a href="javascript:void(0)" data-sort="3" data-name="评论" class=""> 评论数从高到低 </a>
        </span>
                <span>
            <a href="javascript:void(0)" data-sort="5" data-name="人气" class=""> 人气从高到低 </a>
        </span>
            </div>
            <!--goods_grid布局start-->
            <div class="goods-list-grid openList">
                <div class="blank-div"></div>

                {{--引入商品列表--}}
                @include('goods.partials._goods_list')

            </div>
            <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
            <script type="text/javascript">
                //
            </script></section>
        <!--购物车-->
        <script type="text" id="cartbox_template">
<div class="shopcar cartbox">
    <a href="/cart.html">
        <span class="flow-cartnum SZY-CART-COUNT bg-color">0</span>
    </a>
</div>
</script>
        <script type="text/javascript">
            //
        </script>
        {{--引入底部菜单--}}
        @include('frontend.web_mobile.modules.library.site_footer_menu')

        <!--列表页内容 end-->
        <script type="text/javascript">
            (function(){
                var url = location.href;
                if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {
                    if (url.indexOf("?") == -1) {
                        url += "?user_id=";
                    } else {
                        url += "&user_id=";
                    }
                } else {
                    url = location.href.split('#')[0];
                }
                var share_url = "";
                if (share_url == '') {
                    share_url = url;
                }
                if (window.__wxjs_environment !== 'miniprogram') {
                    window.history.replaceState(null, document.title, url);
                }
            })();
        </script>
        <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
        <script type="text/javascript">
            $().ready(function() {
                // $("body").append('<script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"><\/script>');
                var url = location.href;
                if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {
                    if (url.indexOf("?") == -1) {
                        url += "?user_id=";
                    } else {
                        url += "&user_id=";
                    }
                } else {
                    url = location.href.split('#')[0];
                }
                var share_url = "";
                if (share_url == '') {
                    share_url = url;
                }
                //
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
                //
                // 微信JSSDK开发
                wx && wx.ready(function() {
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
                    // window.history.replaceState(null, document.title, url);
                });
            });
        </script>
        <script type="text/javascript">
            $().ready(function() {
                setTimeout(function() {
                    if (window.__wxjs_environment === 'miniprogram') {
                        var share_info = {
                            title: '{{ $seo_title }}',
                            imgUrl: '{{ get_image_url($seo_image) }}'
                        };
                        wx.miniProgram.postMessage({
                            data: share_info
                        });
                    }
                }, 3000);
            });
        </script>
        <script type="text/javascript">
            //
        </script>
        <!-- 地区选择器 -->
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
    </div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 底部 _end-->
    <script type="text/javascript">
        //
    </script>
    <!-- 积分提醒 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/js/jquery.rotate.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.ui.touch-punch.min.js"></script>
    <script src="/js/goods_list.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function(){
            var min = '3';
            var max = '588';
            min = Math.floor(min);
            max = Math.ceil(max);
            var step = parseInt((max - min) / 5);
            var sliders = function() {
                $("#slider-range").slider({
                    range: true,
                    min: min,
                    max: max,
                    step: step,
                    values: [0, 0],
                    slide: function(event, ui) {
                        $("#slider-range-amount").text(ui.values[0] + " ~ " + ui.values[1]);
                        $('input[name=price_min]').val(ui.values[0]);
                        $('input[name=price_max]').val(ui.values[1]);
                    }
                });
                var price_min = $('input[name=price_min]').val();
                var price_max = $('input[name=price_max]').val();
                $("#slider-range").slider({
                    values: [price_min, price_max]
                });
                $("#slider-range-amount").text(parseInt(price_min) + " ~ " + parseInt(price_max));
            }();
        });
        //
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
        //
        $().ready(function() {
            if ($('.cartbox').length == 0) {
                $('body').append($('#cartbox_template').html());
            }
        });
        //
        $('#searchForm input[type=search]').focus(function() {
            $('.header-middle').css("margin-right", "60px");
            $('.category-right').addClass('search-btn-show');
        });
        $('#searchForm').submit(function(e) {
            $(".header-middle").removeAttr("style");
            $('.category-right').removeClass('search-btn-show');
        });
        // 滚动加载数据
        $().ready(function() {
            var page_num_time_out;
            $(window).on('scroll', function() {
                // 当前页数
                $('.page-num').show();
                $.each($('.SZY-GOODS-ITEM'), function() {
                    var item_top = $(this).offset().top;
                    if (item_top >= $(window).scrollTop() && item_top < ($(window).scrollTop() + $(window).height())) {
                        $('.page-num span em').eq(0).html($(this).parent().data('cur_page'));
                    }
                });
                clearTimeout(page_num_time_out);
                // 判断滚动条是否停止
                clearTimeout($.data(this, 'scrollTimer'));
                $.data(this, 'scrollTimer', setTimeout(function() {
                    page_num_time_out = setTimeout(function() {
                        $('.page-num').show().fadeOut(1000);
                    }, 2000);
                }, 250));
                if (($(document).scrollTop() + $(window).height() + 500) > $(document).height()) {
                    if ($.isFunction($.pagemore)) {
                        $.pagemore({
                            callback: function(result) {
                                // 图片缓载
                                $.imgloading.loading();
                            }
                        });
                    }
                }
            });
        });
        //
        $(document).ready(function() {
            //加入购物车
            $('body').on('click', '.cart-box .add-cart', function(event) {
                var this_target = $(this);
                var goods_id = $(this).data('goods_id');
                var image_url = $(this).data('image_url');
                var buy_enable = $(this).data("buy_enable");
                var cart_step = $(this).data("cart_step");
                if(isNaN(cart_step)){
                    cart_step = 1;
                }
                if (buy_enable) {
                    $.msg(buy_enable);
                    return false;
                }
                $.cart.add(goods_id, cart_step, {
                    image_url: image_url,
                    event: event,
                    show_message: [false, true],
                    is_sku: false,
                    callback: function(result) {
                        if (result.code == 0) {
                            var $numbtn = this_target.parent().find(".num");
                            if (parseInt($numbtn.val()) == 0) {
                                $numbtn.show();
                                //减号的按钮动画显示
                                this_target.parent().find(".decrease").show();
                            }
                            // 点击加入购物车相应的购买数量
                            $numbtn.val(parseInt($numbtn.val()) + cart_step);
                        }
                    }
                });
                return false;
            });
            //减少购物车
            $('body').on('click', '.cart-box .remove-cart', function() {
                var this_target = $(this);
                var data = {};
                data.goods_id = this_target.data("goods_id");
                data.number = 1;
                $.cart.remove(data, function(result) {
                    if (result.code == 0) {
                        $numbtn = this_target.parent().find(".num");
                        if (parseInt($numbtn.val()) <= 1) {
                            $numbtn.val(0);
                            $numbtn.hide();
                            this_target.hide();
                        } else {
                            $numbtn.val(parseInt($numbtn.val()) - 1);
                        }
                    }
                });
                return false;
            });
        });
        //
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#goods_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $(".btn-submit").click(function() {
                $('.close-filter-content').click();
                var params = $("#searchForm").serializeJson();
                params.page = {
                    cur_page: 1,
                };
                params.go = 1;
                tablelist.load(params, function() {
                    $.imgloading.loading();
                    $(".filtrate-term  ul").find("li").eq(3).addClass("active").siblings().removeClass("active");
                    $(window).scrollTop("0");
                    $(".category-content-section header").show();
                    $(".filtrate-term").css('top', "44px");
                    $('.filtrate-more').css('top', "84px");
                });
                return false;
            });
            if (($(document).scrollTop() + $(window).height() == $(document).height())) {
                $.pagemore({
                    callback: function(result) {
                        $.imgloading.loading();
                    }
                });
            }
            $('body').on('click', '.GO-GOODS-INFO', function() {
                var go = $(this).data('cur_page');
                var url = $(this).data('goods_url');
                var data = $('#searchForm').serializeJson();
                var params = '';
                $.each(data, function(i, v) {
                    params = params + '&' + i + '=' + v;
                });
                var page_url = location.href;
                page_url = page_url.split('?')[0];
                if (page_url.indexOf("?") == -1) {
                    params = params.replace(/&/, "?");
                }
                page_url = page_url + params;
                page_url = page_url + '&go=' + go;
                history.pushState({}, '', page_url);
                $.go(url);
            });
        });
        //
        $().ready(function() {
            // 缓载图片
            $.imgloading.loading();
        });
        //
        $().ready(function () {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('7272') }}",
                type: "add_point_set"
            });
        });

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
    </script>

@stop
