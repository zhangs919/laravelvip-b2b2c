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
    <script src="/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <script src="/js/swiper.jquery.min.js?v=201902541"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <!-- 飞入购物车 -->
    <script src="/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>

@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <!-- 默认缓载图片 -->
        <link rel="stylesheet" href="/css/catalog.css?v=20190422"/>
        <link rel="stylesheet" href="/css/swiper.min.css?v=20190422"/>
        <style>
            body {
                background: #fff;
            }
        </style>
        <header class="header-search-con" style="position: fixed; top: 0">
            <div class="header-search-left">
                <a class="sb-back  iconfont icon-fanhui1" href="javascript:history.back(-1)" title="返回"></a>
            </div>

            <form id="searchForm" class="screen-term header-search-middle" method="GET" action="" onsubmit="return search()">
                <div class="search-box">
                    <input name="keyword" type="search" placeholder="搜索商品名称" class="text" value="">
                    <input name="cat_id" type="hidden" value="0">
                    <input name="is_self" type="hidden" value="0">
                    <input name="is_free" type="hidden" value="0">
                    <input name="is_stock" type="hidden" value="0">
                    <input name="is_cash" type="hidden" value="0">
                    <input name="brand_id" type="hidden" value="">
                    <input name="filter_attr" type="hidden" value="">
                    <input name="sort" type="hidden" value="">
                    <input name="order" type="hidden" value="">
                    <i class="submit"></i>
                </div>
            </form>

            <div class="header-search-right">
                <aside class="show-menu-btn">
                    <div class="show-menu iconfont icon-gengduo3" id="show_more"></div>
                </aside>
            </div>
        </header>

        <div class="container">
            <div class="category-box category-box2">
                <div class="category-left">
                    <ul class="clearfix SZY-CAT-UL-1">

                        <li class="cur" data-cat_id="0">
                            <span>全部商品</span>
                        </li>
                        @foreach($list as $k=>$v)
                            <li class="" data-cat_id="{{ $v['cat_id'] }}">
                                <span>{{ $v['cat_name'] }}</span>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="goods-content" style="outline: none;" tabindex="5001">
                    <!--二级分类-->

                    @foreach($list as $k=>$v)
                    <div class="second-catetory-wrap SZY-CAT-DIV-2 hide" id="cat_level_2_{{ $v['cat_id'] }}">
                        <div class="swiper-container swiper-container-horizontal second-category-swiper" id="second_swiper_container_{{ $v['cat_id'] }}">
                            <ul class="swiper-wrapper SZY-CAT-UL-2">
                                <li class="swiper-slide current SZY-CAT-LI-2-{{ $v['cat_id'] }}" data-cat_id="{{ $v['cat_id'] }}">全部商品</li>

                                @if(!empty($v['items']))
                                    @foreach($v['items'] as $kk=>$vv)
                                        <li class="swiper-slide SZY-CAT-LI-2-{{ $vv['cat_id'] }} swiper-slide-next" data-cat_id="{{ $vv['cat_id'] }}"> {{ $vv['cat_name'] }} </li>
                                    @endforeach
                                @endif

                            </ul>
                            <div class="second-category-more">
                                <i class="iconfont"></i>
                            </div>
                        </div>
                        <ul class="second-category hide SZY-CAT-UL-HIDE-2">
                            <li class="current SZY-CAT-LI-2-{{ $v['cat_id'] }}" data-cat_id="{{ $v['cat_id'] }}">全部商品</li>

                            @if(!empty($v['items']))
                                @foreach($v['items'] as $kk=>$vv)
                                    <li class="SZY-CAT-LI-2-{{ $vv['cat_id'] }}" data-cat_id="{{ $vv['cat_id'] }}">{{ $vv['cat_name'] }}</li>
                                @endforeach
                            @endif

                        </ul>
                        <!--三级分类-->

                        @if(!empty($v['items']))
                            @foreach($v['items'] as $kk=>$vv)


                                @if(!empty($vv['items']))
                                    <div class="swiper-container swiper-container-horizontal third-category-swiper hide SZY-CAT-DIV-3" id="cat_level_3_{{ $vv['cat_id'] }}">
                                        <ul class="swiper-wrapper third-category SZY-CAT-UL-3">
                                            <li class="swiper-slide current" data-cat_id="{{ $vv['cat_id'] }}">全部商品</li>

                                            @foreach($vv['items'] as $kkk=>$vvv)
                                                <li class="swiper-slide swiper-slide-next" data-cat_id="{{ $vvv['cat_id'] }}">{{ $vvv['cat_name'] }}</li>
                                            @endforeach

                                        </ul>
                                    </div>

                                @endif

                            @endforeach
                        @endif

                    </div>
                    @endforeach


                    <!--商品-->
                    <div class="goods-list-box">

                        {{--引入商品列表--}}
                        @include('category.partials._goods_list')

                    </div>
                </div>
            </div>
        </div>
        <!--底部-->
        <div style="height: 50px; line-height: 50px; clear: both;"></div>
        <!--遮罩层-->
        <div class="mask-div"></div>

        {{--引入底部菜单--}}
        @include('frontend.web_mobile.modules.library.site_footer_menu')


        <!--  滚动加载 -->
        <script src="/assets/d2eace91/js/szy.page.more.js?v=201902541"></script>
        <script type="text/javascript">
            $(window).scroll(function() {
                if (($(document).scrollTop() + $(window).height() + 500) > $(document).height()) {
                    if ($.isFunction($.pagemore)) {
                        $.pagemore({
                            callback: function(result) {
                                $.imgloading.loading();
                            }
                        });
                    }
                }
            });
        </script>

        <script type="text/javascript">
            var tablelist = null;
            $().ready(function() {
                tablelist = $("#goods_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });

                $('.submit').click(function() {
                    search();
                });
            });

            function search() {
                tablelist.load($("#searchForm").serializeJson(), function() {
                    $.imgloading.loading();
                });
                return false;
            }
        </script>

        <script type="text/javascript">
            function menuSwiper(obj) {
                new Swiper(obj, {
                    direction: 'horizontal',
                    initialSlide: 0,
                    slidesPerView: "auto",
                    slideToClickedSlide: true,
                    onInit: function(swiper) {
                        swiper.activeIndex = 0;
                        swiper.update();
                    }
                });
            }
            $(document).ready(function() {
                // 左侧菜单
                $('.category-box2 .category-left').css({
                    'max-height': $(window).height() - 101
                })
                //加入购物车
                $('body').on('click', '.cart-box .add-cart', function(event) {
                    var this_target = $(this);
                    var goods_id = $(this).data('goods_id');
                    var image_url = $(this).data('image_url');
                    var buy_enable = $(this).data("buy_enable");
                    var max_number = $(this).data("max_number");
                    if (buy_enable) {
                        $.msg(buy_enable);
                        return false;
                    }

                    var step = $(this).data("step");
                    if(!isNaN(step)){
                        step = 1;
                    }

                    // this_target.addClass('cart-loading-circular').removeClass('icon-jia1');
                    $.cart.add(goods_id, "1", {
                        image_url: image_url,
                        event: event,
                        show_message: [false, true],
                        is_sku: false,
                        callback: function(result) {
                            if (result.code == 0) {
                                var numbtn = this_target.parent().find(".num");
                                if (parseInt(numbtn.val()) == 0) {
                                    numbtn.show();
                                    //减号的按钮动画显示
                                    this_target.parent().find(".decrease").show();
                                }
                                // 点击加入购物车相应的购买数量
                                numbtn.val(parseInt(numbtn.val()) + 1);

                                if (numbtn.val() >= max_number) {
                                    $(this_target).addClass('disabled');
                                }
                            }
                            // this_target.removeClass('cart-loading-circular').addClass('icon-jia1');
                        }
                    });
                    return false;
                });

                //减少购物车
                $('body').on('click', '.cart-box .remove-cart', function() {
                    var this_target = $(this);
                    var sku_open = $(this).data("sku_open");
                    if (sku_open) {
                        $.msg('此商品有多个规格，请到购物车中移除');
                        return false;
                    }
                    var data = {};
                    data.goods_id = this_target.data("goods_id");
                    data.number = 1;
                    $numbtn = this_target.parent().find(".num");
                    if (parseInt($numbtn.val()) <= 1) {
                        $numbtn.val(0);
                        $numbtn.hide();
                        this_target.hide();
                    } else {
                        $numbtn.val(parseInt($numbtn.val()) - 1);
                    }
                    $.cart.remove(data, function(result) {
                        if (result.code == 0) {
                            this_target.parent().find(".increase").removeClass('disabled');
                        }
                    });
                    return false;
                });
            })
            $('body').on('click', '.second-category-more', function(e) {
                event.stopPropagation();
                $('.second-category').toggleClass('hide');
            });
            $(document).on('click', ':not(.second-category-more)', function() {
                $('.second-category').addClass('hide');
                return;
            })
            $('body').on('click', '.SZY-CAT-UL-2 li', function() {
                var cat_id = $(this).data('cat_id');
                if ($(this).hasClass('current')) {
                    return;
                }
                $(this).addClass('current').siblings().removeClass('current');

                $('.SZY-CAT-UL-HIDE-2 li').removeClass('current');
                $('.SZY-CAT-UL-HIDE-2').find('.SZY-CAT-LI-2-' + cat_id).addClass('current');
                $('.second-category').addClass('hide');

                $('.SZY-CAT-DIV-3').addClass('hide');

                if ($('#cat_level_3_' + cat_id + ' li').length > 1) {
                    $('#cat_level_3_' + cat_id).removeClass('hide');
                    $('#cat_level_3_' + cat_id + ' li').removeClass('current').eq(0).addClass('current');
                    $('.goods-content').css({
                        'paddingTop': '74px'
                    });
                } else {
                    $('.goods-content').css({
                        'paddingTop': '40px'
                    });
                }
                tablelist.page.cur_page = 1;
                tablelist.load({
                    cat_id: cat_id,
                    go: 1
                }, function() {
                    menuSwiper('#cat_level_3_' + cat_id);
                    $(window).scrollTop(0);
                    $('#searchForm').find('[name="cat_id"]').val(cat_id);
                    $.imgloading.loading();
                });
            });
            $('body').on('click', '.SZY-CAT-UL-3 li', function() {
                var cat_id = $(this).data('cat_id');
                if ($(this).hasClass('current')) {
                    return;
                }
                $(this).addClass('current').siblings().removeClass('current');
                tablelist.page.cur_page = 1;
                tablelist.load({
                    cat_id: cat_id,
                    go: 1
                }, function() {
                    $(window).scrollTop(0);
                    $('#searchForm').find('[name="cat_id"]').val(cat_id);
                    $.imgloading.loading();
                });
            });

            $('body').on('click', '.SZY-CAT-UL-1 li', function() {
                var cat_id = $(this).data('cat_id');
                if ($(this).hasClass('current')) {
                    return;
                }
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.SZY-CAT-DIV-2').addClass('hide');
                $('#cat_level_2_' + cat_id).removeClass('hide');
                $('#cat_level_2_' + cat_id + ' .SZY-CAT-UL-2 li').removeClass('current').eq(0).addClass('current');
                if ($('.goods-content').find($('#cat_level_2_' + $(this).data('cat_id'))).length > 0) {
                    $('.goods-content').css({
                        'paddingTop': '40px'
                    })
                } else {
                    $('.goods-content').css({
                        'paddingTop': 0
                    })
                }
                tablelist.load({
                    cat_id: cat_id
                }, function() {
                    menuSwiper('#second_swiper_container_' + cat_id);
                    $(window).scrollTop(0);
                    $('#searchForm').find('[name="cat_id"]').val(cat_id);
                    $.imgloading.loading();
                });
            });

            $('body').on('click', '.SZY-CAT-UL-HIDE-2 li', function() {
                var cat_id = $(this).data('cat_id');
                if ($(this).hasClass('current')) {
                    return;
                }
                $(this).addClass('current').siblings().removeClass('current');

                $('.SZY-CAT-UL-2').find('.SZY-CAT-LI-2-' + cat_id).click();
                $('.second-category').addClass('hide');
            });

            $.each($('.SZY-CAT-UL-1 li'), function() {
                if ($(this).hasClass('cur')) {
                    $('#cat_level_2_' + $(this).data('cat_id')).removeClass('hide');
                }
            });

            $.each($('.SZY-CAT-UL-2 li'), function() {
                var cat_id = $(this).data('cat_id');
                if ($(this).hasClass('current')) {
                    $('.SZY-CAT-DIV-3').addClass('hide');
                    if ($('#cat_level_3_' + cat_id + ' li').length > 1) {
                        $('#cat_level_3_' + cat_id).removeClass('hide');
                        $('#cat_level_3_' + cat_id + ' li').removeClass('current').eq(0).addClass('current');
                    }
                }
            });
        </script>
    </div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 底部 _end-->
    <script type="text/javascript">
        $().ready(function() {
            // 缓载图片
            $.imgloading.loading();
        });
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>





@stop