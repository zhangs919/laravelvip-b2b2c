<script>
    $().ready(function () {
        /*静态页面开启时*/
        @if($webStatic)
        @foreach($template as $item)
        @switch ($item['temp_code'])

            {{--1--}}
            @case('m_ad_s1')
                //
                $.imgloading.loading();
                @break

            @case('m_hots_pot')
                //
                $.imgloading.loading();
                @break

            @case('m_ad_s2')
                //
                $.imgloading.loading();
                @break

            @case('m_ad_s3')
                //
                $.imgloading.loading();
                @break

            @case('m_ad_s4')
                //
                /*无script*/
                @break

            @case('m_ad_s5')
                //
                if(!localStorage.fixed_ad_layer_{{ time() }}){
                    $('.fixed-img-layer').show();
                }
                //悬浮广告弹出层
                $('body').on('click','.close-fixed-ad-btn',function(){
                    localStorage.fixed_ad_layer_{{ time() }} = true;
                    $('.fixed-img-layer').hide();
                });

                $.imgloading.loading();
                @break

            @case('m_banner')

                @if(!empty($item['99-1']))
                var bannerSwiper;
                $().ready(function(){
                    bannerSwiper = $('#{{ $item['uid'] }} .swiper-banner-3d').swiper({
                        slidesPerView: "auto",
                        lazyLoading : true,
                        lazyLoadingInPrevNext: true,
                        centeredSlides: !0,
                        autoplay: 3000,
                        loop: true,
                        watchSlidesProgress: !0,
                        onProgress: function(a) {
                            var b, c, d;
                            for (b = 0; b < a.slides.length; b++)
                                c = a.slides[b], d = c.progress, scale = 1 - Math.min(Math.abs(.2 * d), 1), es = c.style, es.opacity = 1 - Math.min(Math.abs(d / 2), 1), es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = "translate3d(0px,0," + -Math.abs(150 * d) + "px)"
                        },
                        onSetTransition: function(a, b) {
                            for (var c = 0; c < a.slides.length; c++)
                                es = a.slides[c].style, es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = b + "ms"
                        }
                    });
                });
                @else
                var swiper;
                $().ready(function(){
                    swiper = $('#{{ $item['uid'] }} .swiper-banner').swiper({
                        pagination: '#{{ $item['uid'] }} .swiper-pagination',
                        paginationClickable: true,
                        autoplay: 3000,
                        loop: true,
                        autoplayDisableOnInteraction: false,
                        lazyLoading : true,
                        lazyLoadingInPrevNext: true,
                    });
                });
                @endif

                $().ready(function(){
                    $('.hot-space').each(function(){
                        $(this).planetmap();
                    });
                });

                // $(function(){
                //     $.imgloading.loading();
                // });
                @break

            {{--2--}}
            @case('m_goods_floor_s1')
                //
                /*无script*/
                @break

            @case('m_goods_floor_s2')
                //
                /*无script*/
                @break

            @case('m_goods_promotion')
                //
                var swiper;
                $().ready(function(){
                    swiper = $('#{{ $item['uid'] }} .goods-promotion').swiper({
                        pagination: '#{{ $item['uid'] }} .pagination',
                        touchRatio: 1,
                    });
                });
                var swiper;
                $().ready(function(){
                    swiper = new Swiper('.seamless-rolling', {
                        slidesPerView: 3.5,
                        freeMode: true
                    });
                });
                @break


            {{--3--}}
            @case('m_ad_title_s1')
            //
            /*无script*/
            @break

            @case('m_ad_title_s2')
            //
            /*无script*/
            @break

            @case('m_article')
                //
                function comments_scroll() {
                    var liLen = $('.hot ul li').length;
                    var num3 = 0;
                    $('.hot ul').append($('.hot ul').html());
                    function autoplay() {
                        if (num3 > liLen) {
                            num3 = 1;
                            $('.hot ul').css('top', 0);
                        }
                        $('.hot ul').stop().animate({
                            'top': -60 * num3
                        }, 500);
                        num3++;
                    }
                    var mytime = setInterval(autoplay, 5000)
                }
                comments_scroll();

                $.imgloading.loading();
                @break

            @case('m_article_s2')
                //
                function notice_scroll() {
                    var totalHeight = $('.shop-notice-info').height();
                    var top = 0;
                    var lineHeight = 30;
                    var mytime;
                    $('.shop-notice-info p').eq(0).clone().appendTo('.shop-notice-info');
                    function marquee() {
                        if (top >= totalHeight + lineHeight) {
                            top = 0;
                            $('.shop-notice-info').css('top', 0);
                        }
                        $('.shop-notice-info').stop().animate({
                            'top': -top
                        }, 600);
                        top = top + lineHeight;
                    }
                    mytime = setInterval(marquee, 3000)
                }
                var noticeHeight = $('.shop-notice-info p').height();
                if (noticeHeight > 30) {
                    notice_scroll();
                }

                $.imgloading.loading();
                @break

            @case('m_blank_line')
            //
            /*无script*/
            @break

            @case('m_custom_s1')
            //
            /*无script*/
            @break

            @case('m_goods_title_s1')
            //
            /*无script*/
            @break

            @case('m_goods_title_s2')
            //
            /*无script*/
            @break

            @case('m_goods_title_s3')
            //
            /*无script*/
            @break

            @case('m_nav_s1')
                //
                var swiper;
                $().ready(function(){
                    swiper = $('#{{ $item['uid'] }} .nav-list-container').swiper({
                        pagination: '.swiper-pagination',
                        paginationClickable: true,
                        autoplay: false,
                        autoplayDisableOnInteraction: false,
                        lazyLoading: true,
                    });
                    if ($('#{{ $item['uid'] }} ul').length <= 1) {
                        $('#{{ $item['uid'] }}').find('.swiper-pagination').addClass('hide');
                    }
                });
                @break
            @case('m_nav_s2')
                //
                var swiper;
                $().ready(function(){
                    swiper = $('#{{ $item['uid'] }} .nav-list-container').swiper({
                        pagination: '.swiper-pagination',
                        paginationClickable: true,
                        autoplay: false,
                        autoplayDisableOnInteraction: false,
                        lazyLoading: true,
                    });
                    if ($('#{{ $item['uid'] }} ul').length <= 1) {
                        $('#{{ $item['uid'] }}').find('.swiper-pagination').addClass('hide');
                    }
                });
                @break

            @case('m_shop_street')
                //
                var mySwiper = new Swiper('.shop-container', {
                //loop : true,
                    slidesPerView: 'auto',
                // loopedSlides :8,
                    touchRatio: 1,
                })
                @break

            @case('m_tab_s1')
                //
                if ($('#{{ $item['uid'] }}').find('.goods-category-container-0').length > 0) {
                    $('.tab-category-item').eq(0).addClass('current');
                    var cat_ids = $('#{{ $item['uid'] }} .category-container-0').find('input[name="cat_id"]').val();
                    var is_last = '';
                    // 判断是否为最后一个楼层
                    if ($('#{{ $item['uid'] }}').find('.goods-category-container-0').next('.floor').length > 0) {
                        is_last = 0;
                    }
                    $.get($.baseurl('/site/tpl-data'), {
                        cat_ids: cat_ids,
                        tpl_code: 'cat_goods_list',
                        is_last: is_last,
                        uid: '{{ $item['uid'] }}',
                        shop_id: ''
                    }, function(result) {
                        if (result.code == 0) {
                            $('#{{ $item['uid'] }}').find('.goods-category-container-0').html(result.data);
                            $.imgloading.loading();
                        } else {
                            $.msg(result.message);
                        }
                    }, 'JSON');
                }
                if ($('#{{ $item['uid'] }}').find('.scroll-y-menu')) {
                    $('#{{ $item['uid'] }} .scroll-y-menu li').click(function() {
                        var event = true;
                        if ($(this).hasClass('active')) {
                            event = false;
                        }
                        $(this).addClass('active').siblings().removeClass('active');
                        $('#{{ $item['uid'] }} .tab-con').eq($(this).index()).show().siblings('.tab-con').hide();
                        var index = $(this).index();
                        if ($('#{{ $item['uid'] }} .category-container-' + index).length > 0 && event) {
                            var cat_ids = $('#{{ $item['uid'] }} .category-container-' + index).find('input[name="cat_id"]').val();
                            if ($('#{{ $item['uid'] }}').find('.goods-category-container-' + index).length > 0) {
                                var is_last = '';
                                // 判断是否为最后一个楼层
                                if ($('#{{ $item['uid'] }}').find('.goods-category-container-' + index).next('.floor').length > 0) {
                                    is_last = 0;
                                }
                                $.get($.baseurl('/site/tpl-data'), {
                                    cat_ids: cat_ids,
                                    tpl_code: 'cat_goods_list',
                                    is_last: is_last,
                                    uid: '{{ $item['uid'] }}',
                                    shop_id: '511'
                                }, function(result) {
                                    if (result.code == 0) {
                                        $('#{{ $item['uid'] }}').find('.goods-category-container-' + index).html(result.data);
                                        $.imgloading.loading();
                                    } else {
                                        $.msg(result.message);
                                    }
                                }, 'JSON');
                            }
                        }
                    });
                }
                $('#{{ $item['uid'] }} .tab-menu li').click(function() {
                    var event = true;
                    if ($(this).hasClass('active')) {
                        event = false;
                    }
                    $(this).addClass('active').siblings().removeClass('active');
                    $('#{{ $item['uid'] }} .tab-con').eq($(this).index()).show().siblings('.tab-con').hide();
                    var index = $(this).index();
                    if ($('#{{ $item['uid'] }} .category-container-' + index).length > 0 && event) {
                        var cat_ids = $('#{{ $item['uid'] }} .category-container-' + index).find('input[name="cat_id"]').val();
                        if ($('#{{ $item['uid'] }}').find('.goods-category-container-' + index).length > 0) {
                            var is_last = '';
                            // 判断是否为最后一个楼层
                            if ($('#{{ $item['uid'] }}').find('.goods-category-container-' + index).next('.floor').length > 0) {
                                is_last = 0;
                            }
                            $.get($.baseurl('/site/tpl-data'), {
                                cat_ids: cat_ids,
                                tpl_code: 'cat_goods_list',
                                is_last: is_last,
                                uid: '{{ $item['uid'] }}',
                                shop_id: ''
                            }, function(result) {
                                if (result.code == 0) {
                                    $('#{{ $item['uid'] }}').find('.goods-category-container-' + index).html(result.data);
                                    $.imgloading.loading();
                                } else {
                                    $.msg(result.message);
                                }
                            }, 'JSON');
                        }
                    }
                });
                $('#{{ $item['uid'] }} .tab-nav-fold li').click(function() {
                    var event = true;
                    if ($(this).hasClass('current')) {
                        event = false;
                    }
                    $(this).addClass('current').siblings().removeClass('current');
                    $('#{{ $item['uid'] }} .tab-con').eq($(this).index()).show().siblings('.tab-con').hide();
                    var index = $(this).index();
                    if ($('#{{ $item['uid'] }} .category-container-' + index).length > 0 && event) {
                        var cat_ids = $('#{{ $item['uid'] }} .category-container-' + index).find('input[name="cat_id"]').val();
                        if ($('#{{ $item['uid'] }}').find('.goods-category-container-' + index).length > 0) {
                            var is_last = '';
                            // 判断是否为最后一个楼层
                            if ($('#{{ $item['uid'] }}').find('.goods-category-container-' + index).next('.floor').length > 0) {
                                is_last = 0;
                            }
                            $.get($.baseurl('/site/tpl-data'), {
                                cat_ids: cat_ids,
                                tpl_code: 'cat_goods_list',
                                is_last: is_last,
                                uid: '{{ $item['uid'] }}',
                                shop_id: ''
                            }, function(result) {
                                if (result.code == 0) {
                                    $('#{{ $item['uid'] }}').find('.goods-category-container-' + index).html(result.data);
                                    $.imgloading.loading();
                                } else {
                                    $.msg(result.message);
                                }
                            }, 'JSON');
                        }
                    }
                });
                $('#{{ $item['uid'] }}').find('.tab-category-item').click(function() {
                    var index = $(this).data('index');
                    var cat_id = $(this).data('cat_id');
                    var link = $(this).data('link');
                    $('.tab-category-item').removeClass('current');
                    $(this).addClass('current');
                    if ($('#{{ $item['uid'] }}').find('.goods-category-container-' + index).length > 0) {
                        var is_last = '';
                        if ($('#{{ $item['uid'] }}').find('.goods-category-container-' + index).next('.floor').length > 0) {
                            is_last = 0;
                        }
                        $.get($.baseurl('/site/tpl-data'), {
                            cat_ids: cat_id,
                            tpl_code: 'cat_goods_list',
                            is_last: is_last,
                            uid: '{{ $item['uid'] }}',
                            shop_id: ''
                        }, function(result) {
                            if (result.code == 0) {
                                if (result.count > 0) {
                                    $('#{{ $item['uid'] }}').find('.goods-category-container-' + index).html(result.data);
                                    $.imgloading.loading();
                                } else {
                                    $.go('/list.html?cat_id=' + cat_id);
                                }
                            } else {
                                $.msg(result.message);
                            }
                        }, 'JSON');
                    } else {
                        $.go(link);
                    }
                });
                @break

            @case('m_video')
            //
            /*无script*/
            @break

            {{--4--}}
            @case('m_goods_list')
                //
                $().ready(function() {
                    $.ajax({
        //url: '/index/information/goods-list',
                        url: $.baseurl('/site/tpl-data'),
                        dataType: 'json',
                        <!--  -->
                        data: {
                            tpl_code: 'm_goods_list',
                            goods_ids: '@if(!empty($item['2-1'])){{ implode(',',array_column($item['2-1'], 'goods_id')) }}@else{{ 0 }}@endif',
                            output: 0,
                            shop_id: '{{ $shop_info['shop']['shop_id'] ?? 0 }}',
                            is_last: ''
                        },
                        success: function(result) {
                            $('#{{ $item['uid'] }}').find('.goods-loading-box').html(result.data);
                            $.imgloading.loading();
                        }
                    });
                });
                @break

            @case('m_near_shop')
                //
                var is_design = '';
                var is_frontend = '';
                if(sessionStorage.near_shop_ && is_frontend){
                    $('.nearby-shops-box').html(sessionStorage.near_shop_);
                }else{
                    $('.nearby-shops-box').html('<div class="shop-loading-con"><img src="/assets/d2eace91/images/common/shop_loading_icon.png"><div class="shop-loading-text">正在为您定位,搜索附近店铺...</div></div>');
                    if (sessionStorage.geolocation) {
                        var data = $.parseJSON(sessionStorage.geolocation);
                        loadlist(data);
                    }else{
                        setTimeout(function() {
        //获取坐标
                            $.geolocation({
                                callback: function(data) {
                                    loadlist(data);
                                }
                            });
                        },500);
                    }
                }
                function loadlist(data) {
                    $.ajax({
                        url: '/site/tpl-data',
                        dataType: 'json',

                        data: {
                            lat: data.lat,
                            lng: data.lng,
                            tpl_code: 'm_near_shop',


                            is_last: ''
                        },
                        success: function(result) {

                            if (result.data == null) {
                                $('.nearby-shops-box').html('<div class="shop-loading-con"><img src="/assets/d2eace91/images/common/shop_loading_icon.png"><div class="shop-loading-text">'+result.message+'</div></div>');
                            } else {
                                $('.nearby-shops-box').html(result.data);
                                is_opening();
                                sessionStorage.near_shop_ = result.data;
                            }
                        }
                    });
                }
                //判断商家是否休息
                function is_opening() {

                }
                @break

            {{--6--}}
            @case('m_news_s1')
            //
            /*无script*/
            @break

            @case('m_news_s2')
            //
            /*无script*/
            @break

            {{--7--}}
            @case('m_topic_s1')
            //
            /*无script*/
            @break

            @case('m_topic_s2')
            //
            /*无script*/
            @break

            {{--8--}}
            @case('m_activity_s1')
                //
                $.each($('#{{ $item['uid'] }}').find(".settime"),function(){
                    var time = $(this).data('countdown')*1000;
                    $(this).countdown({
                        time: time,
                        leadingZero: true,

                        htmlTemplate: "<span>%{d}天%{h}时%{m}分%{s}秒</span>",

                        onComplete: function(event) {
                            $(this).html("活动已结束！");
                        }
                    });
                });

                //
                $.get('/site/tpl-data', {
                    tpl_code: 'act_goods_info',
                    act_goods_ids: '2788',
                }, function(result) {
                    if (result.data) {
                        $.each(result.data, function(i, v) {
                            $('#{{ $item['uid'] }}').find('#SZY_ACT_GOODS_INFO_' + i).find('.status-num span').eq(0).find('em').html(v.act_total_sale);
                            $('#{{ $item['uid'] }}').find('#SZY_ACT_GOODS_INFO_' + i).find('.status-num span').eq(1).find('em').html(v.act_surplus);
                            $('#{{ $item['uid'] }}').find('#SZY_ACT_GOODS_INFO_' + i).find('.status-progress').css('width', v.rate + '%');
                            $('#{{ $item['uid'] }}').find('#SZY_ACT_GOODS_INFO_' + i).find('.status-soldrate').html(v.rate + '%');
                        });
                    }
                }, 'JSON');
                //
                @break

            @case('m_activity_s2')
            //
            /*无script*/
            @break

            @case('m_bonus_s1')
                $('#{{ $item['uid'] }}').on('click', '.receive-bonus', function() {
                    var target = $(this);
                    var bonus_id = $(this).data('bonus_id');
                    $.loading.start();
                    $.post("/activity/bonus/index.html", {
                        bonus_id: bonus_id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            $(target).parent().html('<span class="coupon-action-btn use-bonus" data-url="'+result.data.url+'?is_redirect=1">立即使用</span>');
                            // 清除缓存
                            if (sessionStorage.getItem('template_{{ $item['uid'] }}')) {
                                sessionStorage.removeItem('template_{{ $item['uid'] }}');
                            }
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, 'json').always(function() {
                        $.loading.stop();
                    });
                });
                $('#{{ $item['uid'] }}').on('click', '.use-bonus', function() {
                    var url = $(this).data('url');
                    if (url) {
                        $.go(url);
                        return;
                    }
                });
                @break

            
            @default
            

        @endswitch

        @endforeach
        @endif
    });
</script>