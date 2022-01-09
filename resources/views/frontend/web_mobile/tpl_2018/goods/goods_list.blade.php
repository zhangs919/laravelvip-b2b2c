@extends('layouts.base')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/mobile/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <!-- 飞入购物车 -->
    <script src="/mobile/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content"><!-- 默认缓载图片 -->
        <!-- 加载列表页CSS -->
        <link rel="stylesheet" href="/mobile/css/category.css?v=20180702"/>
        <script src="/mobile/js/jquery.rotate.min.js?v=20180813"></script>
        <script src="/mobile/js/jquery-ui.min.js?v=20180813"></script>
        <script src="/mobile/js/jquery.ui.touch-punch.min.js?v=20180813"></script>

        <!--列表页内容start-->
        <section class="category-content-section">
            <form id="searchForm" class="screen-term" method="GET">
                <header>
                    <div class="category-header">
                        <div class="category-left">
                            <a href="javascript:history.back(-1)" class="sb-back" title="返回"></a>
                        </div>
                        <div class="header-middle">

                            <div class="search-box ub">
                                <input type="submit" class="submit" value="">
                                <input name="keyword" type="text" placeholder="搜索该分类下商品" class="text" value="">
                                <input name="cat_id" type="hidden" value="{{ $cat_id ?? '' }}">
                                <input name="is_self" type="hidden" value="0">
                                <input name="is_free" type="hidden" value="0">
                                <input name="is_stock" type="hidden" value="0">
                                <input name="is_cash" type="hidden" value="0">
                                <input name="brand_id" type="hidden" value="">
                                <input name="filter_attr" type="hidden" value="">
                                <input name="sort" type="hidden" value="0">
                                <input name="order" type="hidden" value="DESC">
                            </div>

                        </div>
                        <!--grid布局的a有show-list这个class，list布局没有-->
                        <div class="category-right">
                            <a href="javascript:void(0)" class="show-type show-list">&nbsp;</a>
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






                                    <input name="price_min" type="hidden" value="0">
                                    <input name="price_max" type="hidden" value="6000">
                                    <div class="price-info">
                                        <span id="slider-range-amount">0 ~ 6000</span>
                                    </div>
                                </div>
                                <!-- 价格区间 -->
                                <script type="text/javascript">
                                    var min = '0';
                                    var max = '6000';
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
                                </script>
                            </div>


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
                    <li class="icon-sort active">
                        <span>综合</span>
                    </li>
                    <li class="">
                        <span>销量</span>
                    </li>
                    <li class="icon-sort-price ">
                        <span class="">价格</span>
                    </li>
                    <li>
				<span>
					筛选
					<span class="choose-icon"></span>
				</span>
                    </li>
                </ul>
            </section>
            <div class="mask-div"></div>
            <div class="filtrate-more hide sale-num">
		<span>
			<a href="javascript:void(0)" data-sort="0" data-name="综合" class="current">
				综合排序				<i></i>
							</a>
		</span>
                <span>
			<a href="javascript:void(0)" data-sort="2" data-name="新品" class="">
				新品优先			</a>
		</span>
                <span>
			<a href="javascript:void(0)" data-sort="3" data-name="评论" class="">
				评论数从高到低			</a>
		</span>
            </div>
            <!--goods_grid布局start-->







            <div class="goods-list-grid openList">
                <div class="blank-div"></div>

                {{--引入商品列表--}}
                @include('goods.partials._goods_list')

            </div>
            <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/mobile/images/topup.png"></a>
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
        </section>
        <!--购物车-->
        <div class="shopcar cartbox">
            <a href="/cart.html">
                <span class="flow-cartnum SZY-CART-COUNT bg-color">0</span>
            </a>
        </div>


        {{--引入底部菜单--}}
        @include('frontend.web_mobile.modules.library.site_footer_menu')

        <!--列表页内容 end-->
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript">
            $().ready(function() {
                $.get("/index/information/is-weixin.html", function(result) {
                    if (result.code == 0) {
                        var url = location.href.split('#')[0];

                        var share_url = "";

                        if (share_url == '') {
                            share_url = url;
                        }

                        $.ajax({
                            type: "GET",
                            url: "/site/index",
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
                    }
                }, 'json');
            });
        </script>

        <!--  滚动加载 -->
        <script src="/assets/d2eace91/js/szy.page.more.js?v=20180813"></script>
        <script type="text/javascript">
            var scroll = '{{ $page_array['cur_page'] + 1 }}';
            // 滚动加载数据
            $().ready(function() {
                var scroll_arr = [];
                var page_count = '{{ $page_array['page_count'] }}';
                $(window).on('scroll', function() {
                    if (($(document).scrollTop() + $(window).height() + 1000) > $(document).height()) {
                        $.pagemore({
                            cur_page: scroll,
                            page_count: page_count,
                            page_size: '12',
                            callback: function(result) {
                                // 图片缓载
                                scroll++;
                                $.imgloading.loading();
                                //$('.page-num span').html(result.cur_page + '/' + result.page_count);
                            }
                        });

                    }
                });
            });
        </script>
        <!-- 地区选择器 -->
        <script src="/assets/d2eace91/js/jquery.region.js?v=20180813"></script>
        <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
        <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
        <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
        <script src="/mobile/js/goods_list.js?v=20180813"></script>
        <script type='text/javascript'>
            $(document).ready(function() {
                //加入购物车
                $('body').on('click', '.add-cart', function(event) {
                    var this_target = $(this);
                    var image_url = $(this).data('image_url');
                    var buy_enable = $(this).data("buy-enable");
                    if (buy_enable) {
                        $.msg(buy_enable);
                        return false;
                    }
                    $.cart.add(this_target.data("goods_id"), "1", {
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
                                $numbtn.val(parseInt($numbtn.val()) + 1);
                            }
                        }
                    });
                    return false;
                });

                //减少购物车
                $('body').on('click', '.decrease', function() {
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
                });

            });
        </script>

        <script type="text/javascript">
            var tablelist = null;
            $().ready(function() {
                tablelist = $("#goods_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });

                $(".btn-submit").click(function() {
                    $('.close-filter-content').click();
                    scroll = 2;
                    var params = $("#searchForm").serializeJson();
                    params.page = {
                        cur_page: 1,
                    };
                    params.go = 1;
                    tablelist.load(params, $.imgloading.loading);
                    $(".filtrate-term  ul").find("li").eq(3).addClass("active").siblings().removeClass("active");
                    $(window).scrollTop("0");
                    $(".category-content-section header").show();
                    $(".filtrate-term").css('top', "44px");
                    $('.filtrate-more').css('top', "84px");
                    return false;
                });

                if (($(document).scrollTop() + $(window).height() == $(document).height())) {
                    $.pagemore({
                        cur_page: scroll,
                        page_count: '{{ $page_array['page_count'] }}',
                        page_size: '12',
                        callback: function(result) {
                            scroll++;
                            $.imgloading.loading();
                        }
                    });
                }

                $('body').on('click', '.GO-GOODS-INFO', function() {
                    var scroll = $(this).data('scroll');
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
                    page_url = page_url + '&scroll=' + scroll;
                    history.pushState({}, '', page_url);
                    window.location.href = url;
                });
            });
        </script>
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