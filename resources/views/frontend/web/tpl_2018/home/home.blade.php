@extends('layouts.base')

@section('header_css')
    <link href="/css/online.css" rel="stylesheet">
    <link href="/css/index.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
@stop

@section('header_js')
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')
    @include('layouts.partials.follow_box')
@stop

@section('content')


    <div class="template-one">

        <!-- banner模块 _start -->
        <div class="banner">

            <!-- banner轮播 _start -->
            <ul id="fullScreenSlides" class="full-screen-slides">

                @foreach($nav_banner as $v)
                    <li style="background: url('{{ get_image_url($v->banner_image) }}') center center no-repeat;  display:list-item; ">
                        <a href="{{ $v->banner_link ?? 'javascript:void(0)' }}" target="_blank" title="{{ $v->banner_name }}">{{ $v->banner_name ?? '&nbsp;' }}</a>
                    </li>
                @endforeach

            </ul>

            <ul class="full-screen-slides-pagination">

                @foreach($nav_banner as $k=>$v)
                    <li @if($k == 0) class="current" @endif>
                        <a href="javascript:void(0);">{{ $k }}</a>
                    </li>
                @endforeach

            </ul>
            <!-- banner轮播 _end -->


            <div class="right-sidebar  SZY-TEMPLATE-NAV-CONTAINER">




                {!! $navContainerHtml !!}




            </div>
            <!-- banner背景图 _end -->
        </div>
        <!-- banner模块 _end -->
    </div>

    <script type="text/javascript">
        // {jsBlock}
        $(document).ready(function() {
            var nowtime = Date.parse(new Date());
            $(".time-remain").each(function(i) {
                var time = $(this).data("end_time") * 1000 - nowtime;
                $(this).countdown({
                    time: time,
                    htmlTemplate: '<span><em class="bg-color">%{d}</em> 天 <em class="bg-color">%{h}</em> 小时 <em class="bg-color">%{m}</em> 分 <em class="bg-color">%{s}</em> 秒</span>',
                    leadingZero: true,
                    onComplete: function(event) {
                        $(this).html("活动已经结束啦!");
                    }
                });
            });
            //加入购物车
            $('body').on('click', '.add-cart', function(event) {
                var goods_id = $(this).data('goods_id');
                var image_url = $(this).data('image_url');
                $.cart.add(goods_id, 1, {
                    is_sku: false,
                    image_url: image_url,
                    event: event,
                    callback: function() {
                        var attr_list = $('.attr-list').height();
                        $('.attr-list').css({
                            "overflow": "hidden"
                        });
                        if (attr_list >= 200) {
                            $('.attr-list').addClass("attr-list-border");
                            $('.attr-list').css({
                                "overflow-y": "auto"
                            });
                        }
                    }
                });
                return false;
            });
        });
        // {/jsBlock}
    </script>

    <div class="template-one">
        <div class="floor"></div>
        <!--模块内容-->
        <!-- #tpl_region_start -->
        {!! $tplHtml !!}
        <!-- #tpl_region_end -->
        <!-- 左侧楼层定位 _start-->
        <div class="elevator">
            <div class="elevator-floor"></div>
        </div>
    </div>

    <style>
        .drop-item:hover {
            border: 0px
        }
    </style>

    <script type="text/javascript">
        //
    </script>

    <script type="text/javascript">
        //首页左侧楼层定位
       /* $(function() {
            if ($(".floor-list")) {
                var elevatorfloor = $(".elevator-floor");
                $.each($('.floor-list'), function(i, v) {
                    var fnum = $.trim($(v).find('.SZY-FLOOR-NAME').text());
                    var short_name = $.trim($(v).find('.SZY-SHORT-NAME').val());
                    if (short_name == '')
                        short_name = fnum;
                    var $el = $("<a class='smooth' href='javascript:;'><b class='fs'>" + fnum + "</b><em class='fs-name'>" + short_name + "</em></a>")
                    var $i = $("<i class='fs-line'></i>");
                    if (i < $('.floor-list').length - 1) {
                        $el.append($i);
                    }
                    elevatorfloor.append($el);
                });

                var conTop = 0;
                if ($(".floor-list").length > 0) {
                    conTop = $(".floor-list").offset().top;
                }
                $(window).scroll(function() {
                    var scrt = $(window).scrollTop();
                    if (scrt > conTop) {

                        $(".elevator").show("fast", function() {
                            $(".elevator-floor").css({

                                "-webkit-transform": "scale(1)",
                                "-moz-transform": "scale(1)",
                                "transform": "scale(1)",
                                "opacity": "1"
                            })
                        }).css({
                            "visibility": "visible"
                        })
                    } else {
                        $(".elevator-floor").css({
                            "-webkit-transform": "scale(1.2)",
                            "-moz-transform": "scale(1.2)",
                            "transform": "scale(1.2)",
                            "opacity": "0"
                        });
                        $(".elevator").css({
                            "visibility": "hidden"
                        });
                    }
                    setTab();
                });

                var arr = [], fsOffset = 0;
                for (var i = 1; i < $(".floor").length; i++) {
                    arr.push(parseInt($(".floor").eq(i).offset().top) + 30)
                }
                $(".elevator-floor a.smooth").on("click", function() {
                    var _th = $(this);
                    _th.blur();
                    var index = $(".elevator-floor a.smooth").index(this);
                    if (index > 0) {
                        fsOffset = 50
                    }
                    var hh = arr[index];
                    $("html,body").stop().animate({
                        scrollTop: hh - fsOffset + "px"
                    }, 400)
                });
                $(".elevator-floor a.fsbacktotop").click(function() {
                    $("html,body").stop().animate({
                        scrollTop: 0
                    }, 400)
                });

                function setTab() {
                    var Objs = $(".floor:gt(0)");
                    var textSt = $(window).scrollTop();
                    for (var i = Objs.length - 1; i >= 0; i--) {
                        if (textSt >= $(Objs[i]).offset().top - $(Objs[i - 1]).height() / 2) {
                            $(".elevator-floor a").eq(i).addClass("active").siblings().removeClass("active");
                            return;
                        }
                    }
                }
            }
        });*/
    </script>


@stop

{{--平台客服系统--}}
@section('site_yikf_form')
    @include('layouts.partials.site_yikf_form')
@stop


{{--底部js--}}
@section('footer_js')
{{--    <script src="{{ mix('/assets/d2eace91/min/js/core.min.js') }}"></script>--}}
    <script src="/assets/d2eace91/min/js/core.min.js?v={{ $web_version }}"></script>
    <script src="/js/common.js?v={{ $web_version }}"></script>
    <script src="/js/jquery.fly.min.js?v={{ $web_version }}"></script>
    <script src="/js/placeholder.js?v={{ $web_version }}"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v={{ $web_version }}"></script>
    <script src="/js/requestAnimationFrame.js?v={{ $web_version }}"></script>
{{--    <script src="{{ mix('/js/app.frontend.index.min.js') }}"></script>--}}
    <script src="/js/app.frontend.index.min.js?v={{ $web_version }}"></script>



{{--    <script src="/assets/d2eace91/js/jquery.lazyload.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/layer/layer.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.cookie.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.history.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.method.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.widget.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/jquery.modal.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/szy.page.more.js?v={{ $web_version }}"></script>--}}

{{--    <script src="/js/common.js?v={{ $web_version }}"></script>--}}

{{--    <script src="/js/jquery.fly.min.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/js/placeholder.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/assets/d2eace91/js/szy.cart.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/js/requestAnimationFrame.js?v={{ $web_version }}"></script>--}}

{{--    <script src="/js/index.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/js/tabs.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/js/bubbleup.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/js/jquery.hiSlider.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/js/index_tab.js?v={{ $web_version }}"></script>--}}
{{--    <script src="/js/nav.js?v={{ $web_version }}"></script>--}}

    <script src="/js/jump.js?v={{ $web_version }}"></script>

{{--todo 以下script是页面装修模板用到的，从页面装修数据中判断，独立放到一个地方，后面再改--}}
    @include('frontend.web.modules.library.design_scripts')


    <script>

        @if(!$webStatic){{--静态页面关闭时 显示--}}
        $.templateloading();
        @endif

        //首页左侧楼层定位
        $(function() {
            if ($(".floor-list")) {
                var elevatorfloor = $(".elevator-floor");
                $.each($('.floor-list'), function(i, v) {
                    var fnum = $.trim($(v).data('floor_name'));
                    var short_name = $.trim($(v).data('short_name'));
                    if (short_name == '')
                        short_name = fnum;
                    var $el = $("<a class='smooth' href='javascript:;'><b class='fs'>" + fnum + "</b><em class='fs-name'>" + short_name + "</em></a>")
                    var $i = $("<i class='fs-line'></i>");
                    if (i < $('.floor-list').length - 1) {
                        $el.append($i);
                    }
                    elevatorfloor.append($el);
                });
                var conTop = 0;
                if ($(".floor-list").length > 0) {
                    conTop = $(".floor-list").offset().top;
                }
                $(window).scroll(function() {
                    var scrt = $(window).scrollTop();
                    if (scrt > conTop) {
                        $(".elevator").show("fast", function() {
                            $(".elevator-floor").css({
                                "-webkit-transform": "scale(1)",
                                "-moz-transform": "scale(1)",
                                "transform": "scale(1)",
                                "opacity": "1"
                            })
                        }).css({
                            "visibility": "visible"
                        })
                    } else {
                        $(".elevator-floor").css({
                            "-webkit-transform": "scale(1.2)",
                            "-moz-transform": "scale(1.2)",
                            "transform": "scale(1.2)",
                            "opacity": "0"
                        });
                        $(".elevator").css({
                            "visibility": "hidden"
                        });
                    }
                    setTab();
                });
                var arr = [], fsOffset = 0;
                for (var i = 1; i < $(".floor").length; i++) {
                    arr.push(parseInt($(".floor").eq(i).offset().top) + 30)
                }
                $(".elevator-floor a.smooth").on("click", function() {
                    var _th = $(this);
                    _th.blur();
                    var index = $(".elevator-floor a.smooth").index(this);
                    if (index > 0) {
                        fsOffset = 50
                    }
                    var hh = arr[index];
                    $("html,body").stop().animate({
                        scrollTop: hh - fsOffset + "px"
                    }, 400)
                });
                $(".elevator-floor a.fsbacktotop").click(function() {
                    $("html,body").stop().animate({
                        scrollTop: 0
                    }, 400)
                });
                function setTab() {
                    var Objs = $(".floor:gt(0)");
                    var textSt = $(window).scrollTop();
                    for (var i = Objs.length - 1; i >= 0; i--) {
                        if (textSt >= $(Objs[i]).offset().top - $(Objs[i - 1]).height() / 2) {
                            $(".elevator-floor a").eq(i).addClass("active").siblings().removeClass("active");
                            return;
                        }
                    }
                }
            }
        });

        // //首页左侧楼层定位
        // $(function() {
        //     if ($(".floor-list")) {
        //         var elevatorfloor = $(".elevator-floor");
        //         $.each($('.floor-list'), function(i, v) {
        //             var fnum = $.trim($(v).data('floor_name'));
        //             var short_name = $.trim($(v).data('short_name'));
        //             if (short_name == '')
        //                 short_name = fnum;
        //             var $el = $("<a class='smooth' href='javascript:;'><b class='fs'>" + fnum + "</b><em class='fs-name'>" + short_name + "</em></a>")
        //             var $i = $("<i class='fs-line'></i>");
        //             if (i < $('.floor-list').length - 1) {
        //                 $el.append($i);
        //             }
        //             elevatorfloor.append($el);
        //         });
        //         var conTop = 0;
        //         if ($(".floor-list").length > 0) {
        //             conTop = $(".floor-list").offset().top;
        //         }
        //         $(window).scroll(function() {
        //             var scrt = $(window).scrollTop();
        //             if (scrt > conTop) {
        //                 $(".elevator").show("fast", function() {
        //                     $(".elevator-floor").css({
        //                         "-webkit-transform": "scale(1)",
        //                         "-moz-transform": "scale(1)",
        //                         "transform": "scale(1)",
        //                         "opacity": "1"
        //                     })
        //                 }).css({
        //                     "visibility": "visible"
        //                 })
        //             } else {
        //                 $(".elevator-floor").css({
        //                     "-webkit-transform": "scale(1.2)",
        //                     "-moz-transform": "scale(1.2)",
        //                     "transform": "scale(1.2)",
        //                     "opacity": "0"
        //                 });
        //                 $(".elevator").css({
        //                     "visibility": "hidden"
        //                 });
        //             }
        //             setTab();
        //         });
        //         var arr = [], fsOffset = 0;
        //         for (var i = 1; i < $(".floor").length; i++) {
        //             arr.push(parseInt($(".floor").eq(i).offset().top) + 30)
        //         }
        //         $(".elevator-floor a.smooth").on("click", function() {
        //             var _th = $(this);
        //             _th.blur();
        //             var index = $(".elevator-floor a.smooth").index(this);
        //             if (index > 0) {
        //                 fsOffset = 50
        //             }
        //             var hh = arr[index];
        //             $("html,body").stop().animate({
        //                 scrollTop: hh - fsOffset + "px"
        //             }, 400)
        //         });
        //         $(".elevator-floor a.fsbacktotop").click(function() {
        //             $("html,body").stop().animate({
        //                 scrollTop: 0
        //             }, 400)
        //         });
        //         function setTab() {
        //             var Objs = $(".floor:gt(0)");
        //             var textSt = $(window).scrollTop();
        //             for (var i = Objs.length - 1; i >= 0; i--) {
        //                 if (textSt >= $(Objs[i]).offset().top - $(Objs[i - 1]).height() / 2) {
        //                     $(".elevator-floor a").eq(i).addClass("active").siblings().removeClass("active");
        //                     return;
        //                 }
        //             }
        //         }
        //     }
        // });
        //
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $(document).ready(function() {
            // 搜索框提示显示
            $('.SZY-SEARCH-BOX .SZY-SEARCH-BOX-KEYWORD').focus(function() {
                $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-HELPER").show();
            });
            // 搜索框提示隐藏
            $(".SZY-SEARCH-BOX-HELPER .close").on('click', function() {
                $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-HELPER").hide();
            });
            // 清除记录
            $(".SZY-SEARCH-BOX-HELPER .clear").click(function() {
                var url = '/search/clear-record.html';
                $.post(url, {}, function(result) {
                    if (result.code == 0) {
                        $(".history-results .active").empty();
                    } else {
                        $.msg(result.message);
                    }
                }, 'json');
            });
        });
        function search_box_remove(key) {
            console.info(key);
            var url = '/search/delete-record.html';
            $.post(url, {
                data: key
            }, function(result) {
                if (result.code == 0) {
                    $("#search_record_" + key).remove();
                } else {
                    $.msg(result.message);
                }
            }, 'json');
        }
        $(document).on("click", function(e) {
            var target = $(e.target);
            if (target.closest(".SZY-SEARCH-BOX").length == 0) {
                $('.SZY-SEARCH-BOX-HELPER').hide();
            }
        })
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
        $().ready(function() {
            $('.site_to_yikf').click(function() {
                $(this).parent('form').submit();
            })
        });
        //
        //
        // 缓载图片
        $().ready(function(){
            $.imgloading.loading();
            //图片预加载
            document.onreadystatechange = function() {
                if (document.readyState == "complete") {
                    $.imgloading.setting({
                        threshold: 1000
                    });
                    $.imgloading.loading();
                }
            }
        });
        //
    </script>
@stop