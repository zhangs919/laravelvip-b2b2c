@extends('layouts.base')

@section('header_css')
    <link rel="stylesheet" href="/css/topic_activity.css"/>
    <link href="/css/template.css" rel="stylesheet">
@stop

@section('header_js')
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop



@section('content')

    <div class="topic-box" {!! $bgStyle !!}>
        <!-- #tpl_region_start -->

        {!! $tplHtml !!}

        <!-- #tpl_region_end -->
    </div>
@stop

{{--底部js--}}
@section('footer_js')
<script src="/js/common.js"></script>
<script src="/assets/d2eace91/js/jquery.lazyload.js"></script>
<script src="/assets/d2eace91/js/jquery.widget.js"></script>
<script src="/js/topic.js"></script>
<script src="/js/tabs.js"></script>
<script src="/js/index_tab.js"></script>
<script src="/js/jquery.fly.min.js"></script>
<script src="/assets/d2eace91/js/szy.cart.js"></script>
<script src="/js/requestAnimationFrame.js"></script>
<script src="/js/index.js"></script>
<script src="/js/tabs.js"></script>
<script src="/js/bubbleup.js"></script>
<script src="/js/jquery.hiSlider.js"></script>
<script src="/js/index_tab.js"></script>
<script src="/js/jump.js"></script>
<script src="/js/nav.js"></script>

{{--todo 以下script是页面装修模板用到的，从页面装修数据中判断，独立放到一个地方，后面再改--}}
@include('frontend.web.modules.library.design_scripts')


    <script>
        $.templateloading();
        //
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
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
        //
        $().ready(function() {
        })
        //
    </script>
@stop