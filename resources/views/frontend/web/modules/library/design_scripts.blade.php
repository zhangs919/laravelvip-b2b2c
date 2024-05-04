<script>
    $().ready(function () {
        /*静态页面开启时*/
        @if($webStatic)
        @foreach($template as $item)
        @switch ($item['temp_code'])

        {{--1--}}
        @case('ad_five_column')
        //
        /*无script*/
        @break

        @case('hots_pot')
        //
        /*无script*/
        @break

        @case('ad_groups')
        //
        /*无script*/
        @break

        @case('ad_one_column')
        //
        /*无script*/
        @break

        @case('ad_six_column')
        //
        /*无script*/
        @break

        @case('ad_suspend')
            //
            {{--悬浮广告倒计时--}}
            @if(!empty($item['data']['style_1']))
            @foreach($item['data']['style_1'] as $v)
            @if($v['timer'] > 0)
            var timer = '{{ $v['timer'] }}';
            timer = parseInt(timer);
            setTimeout(function(){
                sessionStorage.fixed_ad_layer_{{ time() }} = true;
                $('.fixed-suspend-layer').hide();
            },timer*1000);
            @endif
            @endforeach
            @endif

            if(!localStorage.fixed_ad_layer_{{ time() }}){
                $('.fixed-suspend-layer').show();
            }
            //悬浮广告弹出层
            $('body').on('click','.close-fixed-suspend',function(){
                localStorage.fixed_ad_layer_{{ time() }} = true;
                $('.fixed-suspend-layer').hide();
            });
        @break

        @case('shop_floor_ad1')
        //
        /*无script*/
        @break

        @case('shop_floor_ad2')
        //
        /*无script*/
        @break

        @case('shop_floor_category_ad1')
        //
        /*无script*/
        @break

        @case('shop_floor_category_ad2')
        //
        /*无script*/
        @break

        @case('shop_focus')
        //首页banner图轮播
        function banner_play(a,b,c,d){
            var blength = $(a).length;
            if(blength > 1){
                $(b).mouseover(function(){
                    $(this).addClass(c).siblings().removeClass(c);
                    $(a).eq($(this).index()).hide().fadeIn().siblings().fadeOut();

                    num=$(this).index();
                    clearInterval(bannerTime);
                });
                var num=0;
                function bannerPlay(){
                    num++;
                    if(num>blength-1){
                        num=0;
                    }
                    $(b).eq(num).addClass(c).siblings().removeClass(c);
                    $(a).eq(num).hide().fadeIn().siblings().fadeOut();
                }
                var bannerTime = setInterval(bannerPlay,6000);
                $(d).hover(function(){
                    clearInterval(bannerTime);
                },function(){
                    bannerTime = setInterval(bannerPlay,6000);
                })
            }
        }

        banner_play($('#{{ $item['uid'] }}').find('.full-screen-slides li'),$('#{{ $item['uid'] }}').find('.full-screen-slides-pagination li'),'current',$('#{{ $item['uid'] }}').find('#fullScreenSlides'));//首页主广告轮播
        @break

        @case('topic_focus')
        //首页banner图轮播
        function banner_play(a,b,c,d){
            var blength = $(a).length;
            if(blength > 1){
                $(b).mouseover(function(){
                    $(this).addClass(c).siblings().removeClass(c);
                    $(a).eq($(this).index()).hide().fadeIn().siblings().fadeOut();

                    num=$(this).index();
                    clearInterval(bannerTime);
                });
                var num=0;
                function bannerPlay(){
                    num++;
                    if(num>blength-1){
                        num=0;
                    }
                    $(b).eq(num).addClass(c).siblings().removeClass(c);
                    $(a).eq(num).hide().fadeIn().siblings().fadeOut();
                }
                var bannerTime = setInterval(bannerPlay,6000);
                $(d).hover(function(){
                    clearInterval(bannerTime);
                },function(){
                    bannerTime = setInterval(bannerPlay,6000);
                })
            }
        }

        banner_play($('#{{ $item['uid'] }}').find('.full-screen-slides li'),$('#{{ $item['uid'] }}').find('.full-screen-slides-pagination li'),'current',$('#{{ $item['uid'] }}').find('#fullScreenSlides'));//首页主广告轮播
        @break

        {{--2--}}
        @case('goods_floor')
        //
        $(function() {
            var $floor_focus = $("#{{ $item['uid'] }}").find(".SZY-FLOOR-FOCUS");
            var sWidth = $floor_focus.width();
            var len = $floor_focus.find("ul li").length; //获取焦点图个数
            var index = 0;
            var picTimer;
            //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
            var btn = "<div class='focus-btn'>";

            for (var i = 0; i < len; i++) {
                btn += "<span></span>";
            }
            btn += "</div>";
            $floor_focus.append(btn);
            $floor_focus.find(".btnBg").css("opacity", 0.5);

            //为小按钮添加鼠标滑入事件，以显示相应的内容
            $floor_focus.find(".focus-btn span").css("opacity", 0.3).mouseover(function() {
                index = $floor_focus.find(".focus-btn span").index(this);
                showPics(index);
            }).eq(0).trigger("mouseover");

            //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
            $floor_focus.find("ul").css("width", sWidth * (len));

            //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
            $floor_focus.hover(function() {
                clearInterval(picTimer);
            }, function() {
                picTimer = setInterval(function() {
                    showPics(index);
                    index++;
                    if (index == len) {
                        index = 0;
                    }
                }, 3000); //此4000代表自动播放的间隔，单位：毫秒
            }).trigger("mouseleave");

            //显示图片函数，根据接收的index值显示相应的内容
            function showPics(index) { //普通切换
                var nowLeft = -index * sWidth; //根据index值计算ul元素的left值
                $floor_focus.find("ul").stop(true, false).animate({
                    "left": nowLeft
                }, 300);
                $floor_focus.find(".focus-btn span").stop(true, false).animate({
                    "opacity": "0.3"
                }, 300).eq(index).stop(true, false).animate({
                    "opacity": "0.7"
                }, 300); //为当前的按钮切换到选中的效果
            }
        });
        //首页楼层Tab标签卡滑门切换
        $(function() {
            $("#{{ $item['uid'] }}").find(".floor-tabs-nav > li").bind('mouseover', (function(e) {
                var color = $(this).parents(".floor").attr("color");
                $(this).addClass('floor-tabs-selected').siblings().removeClass('floor-tabs-selected');
                $(this).find('h3').css({
                    "border-color": color + " " + color + " #fff",
                    "color": color
                }).parents('li').siblings('li').find('h3').css({
                    "border-color": "",
                    "color": ""
                });
                $(this).parents('.floor-con').find('.floor-tabs-panel').eq($(this).index()).removeClass('floor-tabs-hide').siblings().addClass('floor-tabs-hide');
            }));
        });
        @break

        @case('goods_floor_s2')
        //
        /*无script*/
        @break

        @case('goods_floor_s3')
        //
        /*无script*/
        @break

        @case('goods_floor_s4')
        //
        $(function() {
            var $floor_focus = $("#{{ $item['uid'] }}").find(".SZY-FLOOR-FOCUS");
            var sWidth = $floor_focus.width();
            var len = $floor_focus.find("ul li").length; //获取焦点图个数
            var index = 0;
            var picTimer;
            //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
            var btn = "<div class='focus-btn'>";

            for (var i = 0; i < len; i++) {
                btn += "<span></span>";
            }
            btn += "</div>";
            $floor_focus.append(btn);
            $floor_focus.find(".btnBg").css("opacity", 0.5);

            //为小按钮添加鼠标滑入事件，以显示相应的内容
            $floor_focus.find(".focus-btn span").css("opacity", 0.3).mouseover(function() {
                index = $floor_focus.find(".focus-btn span").index(this);
                showPics(index);
            }).eq(0).trigger("mouseover");

            //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
            $floor_focus.find("ul").css("width", sWidth * (len));

            //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
            $floor_focus.hover(function() {
                clearInterval(picTimer);
            }, function() {
                picTimer = setInterval(function() {
                    showPics(index);
                    index++;
                    if (index == len) {
                        index = 0;
                    }
                }, 3000); //此4000代表自动播放的间隔，单位：毫秒
            }).trigger("mouseleave");

            //显示图片函数，根据接收的index值显示相应的内容
            function showPics(index) { //普通切换
                var nowLeft = -index * sWidth; //根据index值计算ul元素的left值
                $floor_focus.find("ul").stop(true, false).animate({
                    "left": nowLeft
                }, 300);
                $floor_focus.find(".focus-btn span").stop(true, false).animate({
                    "opacity": "0.3"
                }, 300).eq(index).stop(true, false).animate({
                    "opacity": "0.7"
                }, 300); //为当前的按钮切换到选中的效果
            }
        });

        //楼层广告切换效果 注意：依赖于 js/jquery.hiSlider.js
        $("#{{ $item['uid'] }}").find('.SZY-FLOOR-HISLIDER').hiSlider();

        //首页楼层Tab标签卡滑门切换
        $(function() {
            $("#{{ $item['uid'] }}").find(".floor-tabs-nav > li").bind('mouseover', (function(e) {
                var color = $(this).parents(".floor").attr("color");
                $(this).addClass('floor-tabs-selected').siblings().removeClass('floor-tabs-selected');
                $(this).find('h3').css({
                    "border-color": color + " " + color + " #fff",
                    "color": color
                }).parents('li').siblings('li').find('h3').css({
                    "border-color": "",
                    "color": ""
                });
                $(this).parents('.floor-con').find('.floor-tabs-panel').eq($(this).index()).removeClass('floor-tabs-hide').siblings().addClass('floor-tabs-hide');
            }));
        });
        @break

        @case('goods_floor_s5')
        //
        $(function() {
            var $floor_focus = $("#{{ $item['uid'] }}").find(".SZY-FLOOR-FOCUS");
            var sWidth = $floor_focus.width();
            var len = $floor_focus.find("ul li").length; //获取焦点图个数
            var index = 0;
            var picTimer;
            //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
            var btn = "<div class='focus-btn'>";

            for (var i = 0; i < len; i++) {
                btn += "<span></span>";
            }
            btn += "</div>";
            $floor_focus.append(btn);
            $floor_focus.find(".btnBg").css("opacity", 0.5);

            //为小按钮添加鼠标滑入事件，以显示相应的内容
            $floor_focus.find(".focus-btn span").css("opacity", 0.3).mouseover(function() {
                index = $floor_focus.find(".focus-btn span").index(this);
                showPics(index);
            }).eq(0).trigger("mouseover");

            //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
            $floor_focus.find("ul").css("width", sWidth * (len));

            //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
            $floor_focus.hover(function() {
                clearInterval(picTimer);
            }, function() {
                picTimer = setInterval(function() {
                    showPics(index);
                    index++;
                    if (index == len) {
                        index = 0;
                    }
                }, 3000); //此4000代表自动播放的间隔，单位：毫秒
            }).trigger("mouseleave");

            //显示图片函数，根据接收的index值显示相应的内容
            function showPics(index) { //普通切换
                var nowLeft = -index * sWidth; //根据index值计算ul元素的left值
                $floor_focus.find("ul").stop(true, false).animate({
                    "left": nowLeft
                }, 300);
                $floor_focus.find(".focus-btn span").stop(true, false).animate({
                    "opacity": "0.3"
                }, 300).eq(index).stop(true, false).animate({
                    "opacity": "0.7"
                }, 300); //为当前的按钮切换到选中的效果
            }
        });

        //楼层广告切换效果 注意：依赖于 js/jquery.hiSlider.js
        $("#{{ $item['uid'] }}").find('.SZY-FLOOR-HISLIDER').hiSlider();

        //首页楼层Tab标签卡滑门切换
        $(function() {
            $("#{{ $item['uid'] }}").find(".floor-tabs-nav > li").bind('mouseover', (function(e) {
                var color = $(this).parents(".floor").attr("color");
                $(this).addClass('floor-tabs-selected').siblings().removeClass('floor-tabs-selected');
                $(this).find('h3').css({
                    "border-color": color + " " + color + " #fff",
                    "color": color
                }).parents('li').siblings('li').find('h3').css({
                    "border-color": "",
                    "color": ""
                });
                $(this).parents('.floor-con').find('.floor-tabs-panel').eq($(this).index()).removeClass('floor-tabs-hide').siblings().addClass('floor-tabs-hide');
            }));
        });
        @break

        @case('goods_floor_s6')
        //
        /*无script*/
        @break

        @case('goods_floor_s7')
        //
        /*无script*/
        @break

        @case('goods_floor_s8')
        //
        /*无script*/
        @break

        @case('goods_floor_s9')
        //
        /*无script*/
        @break

        @case('goods_promotion')
        //
        $(function() {
            //首页Tab标签卡滑门切换
            $("#{{ $item['uid'] }}").find(".tabs-nav > li > h3").bind('mouseover', (function(e) {

                if (e.target == this) {
                    var tabs = $(this).parent().parent().children("li");
                    var panels = $(this).parent().parent().parent().children(".tabs-panel");
                    var index = $.inArray(this, $(this).parent().parent().find("h3"));
                    if (panels.eq(index)[0]) {
                        tabs.removeClass("tabs-selected").eq(index).addClass("tabs-selected");
                        var color = $(this).parents(".floor:first").attr("color");
                        $(this).parents(".tabs-nav").find("h3").css({
                            "border-color": "",
                            "color": ""
                        });
                        $(this).css({
                            "border-color": color + " " + color + " #fff",
                            "color": color
                        });
                        panels.addClass("tabs-hide").eq(index).removeClass("tabs-hide");
                    }
                }
            }));

        });
        @break

        @case('goods_promotion_s2')
        //
        $(function() {
            //首页Tab标签卡滑门切换
            $("#{{ $item['uid'] }}").find(".tabs-nav > li > h3").bind('mouseover', (function(e) {
                if (e.target == this) {
                    var tabs = $(this).parent().parent().children("li");
                    var panels = $(this).parents().children(".tabs-panel");
                    var index = $.inArray(this, $(this).parent().parent().find("h3"));
                    if (panels.eq(index)[0]) {
                        tabs.removeClass("tabs-selected").eq(index).addClass("tabs-selected");
                        var color = $(this).parents(".floor:first").attr("color");
                        $(this).parents(".tabs-nav").find("h3").css({
                            "border-color": "",
                            "color": ""
                        });
                        $(this).css({
                            "border-color": color + " " + color + " #fff",
                            "color": color
                        });
                        panels.addClass("tabs-hide").eq(index).removeClass("tabs-hide");
                    }
                }
            }));

        });
        @break

        @case('market_goods_floor_s1')
        //
        $(function() {
            var $floor_focus = $("#{{ $item['uid'] }}").find(".SZY-FLOOR-FOCUS");
            var sWidth = $floor_focus.width();
            var len = $floor_focus.find("ul li").length; //获取焦点图个数
            var index = 0;
            var picTimer;
            //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
            var btn = "<div class='focus-btn'>";

            for (var i = 0; i < len; i++) {
                btn += "<span></span>";
            }
            btn += "</div>";
            $floor_focus.append(btn);
            $floor_focus.find(".btnBg").css("opacity", 0.5);

            //为小按钮添加鼠标滑入事件，以显示相应的内容
            $floor_focus.find(".focus-btn span").css("opacity", 0.3).mouseover(function() {
                index = $floor_focus.find(".focus-btn span").index(this);
                showPics(index);
            }).eq(0).trigger("mouseover");

            //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
            $floor_focus.find("ul").css("width", sWidth * (len));

            //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
            $floor_focus.hover(function() {
                clearInterval(picTimer);
            }, function() {
                picTimer = setInterval(function() {
                    showPics(index);
                    index++;
                    if (index == len) {
                        index = 0;
                    }
                }, 3000); //此4000代表自动播放的间隔，单位：毫秒
            }).trigger("mouseleave");

            //显示图片函数，根据接收的index值显示相应的内容
            function showPics(index) { //普通切换
                var nowLeft = -index * sWidth; //根据index值计算ul元素的left值
                $floor_focus.find("ul").stop(true, false).animate({
                    "left": nowLeft
                }, 300);
                $floor_focus.find(".focus-btn span").stop(true, false).animate({
                    "opacity": "0.3"
                }, 300).eq(index).stop(true, false).animate({
                    "opacity": "0.7"
                }, 300); //为当前的按钮切换到选中的效果
            }
        });
        @break

        @case('market_goods_floor_s2')
        //
        /*无script*/
        @break

        @case('market_goods_floor_s3')
        //
        /*无script*/
        @break

        @case('market_goods_floor_s4')
        //
        /*无script*/
        @break

        @case('market_goods_floor_s5')
        //
        $(function() {
            var sWidth = $("#focus_3").width(); //获取焦点图的宽度（显示面积）
            var len = $("#focus_3 ul li").length; //获取焦点图个数
            var index = 0;
            var picTimer;
            //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
            var btn = "<div class='focus-btn'>";

            for (var i = 0; i < len; i++) {
                btn += "<span></span>";
            }
            btn += "</div>";
            $("#focus_3").append(btn);
            $("#focus_3 .btnBg").css("opacity", 0.5);

            //为小按钮添加鼠标滑入事件，以显示相应的内容
            $("#focus_3 .focus-btn span").css("opacity", 0.3).mouseover(function() {
                index = $("#focus_3 .focus-btn span").index(this);
                showPics(index);
            }).eq(0).trigger("mouseover");

            //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
            $("#focus_3 ul").css("width", sWidth * (len));

            //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
            $("#focus_3").hover(function() {
                clearInterval(picTimer);
            }, function() {
                picTimer = setInterval(function() {
                    showPics(index);
                    index++;
                    if (index == len) {
                        index = 0;
                    }
                }, 3000); //此4000代表自动播放的间隔，单位：毫秒
            }).trigger("mouseleave");

            //显示图片函数，根据接收的index值显示相应的内容
            function showPics(index) { //普通切换
                var nowLeft = -index * sWidth; //根据index值计算ul元素的left值
                $("#focus_3 ul").stop(true, false).animate({
                    "left": nowLeft
                }, 300);
                $("#focus_3 .focus-btn span").stop(true, false).animate({
                    "opacity": "0.3"
                }, 300).eq(index).stop(true, false).animate({
                    "opacity": "0.7"
                }, 300); //为当前的按钮切换到选中的效果
            }
        });
        @break

        @case('market_goods_floor_s6')
        //
        $(function() {
            var sWidth = $("#focus_3").width(); //获取焦点图的宽度（显示面积）
            var len = $("#focus_3 ul li").length; //获取焦点图个数
            var index = 0;
            var picTimer;
//以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
            var btn = "<div class='focus-btn'>";

            for (var i = 0; i < len; i++) {
                btn += "<span></span>";
            }
            btn += "</div>";
            $("#focus_3").append(btn);
            $("#focus_3 .btnBg").css("opacity", 0.5);

//为小按钮添加鼠标滑入事件，以显示相应的内容
            $("#focus_3 .focus-btn span").css("opacity", 0.3).mouseover(function() {
                index = $("#focus_3 .focus-btn span").index(this);
                showPics(index);
            }).eq(0).trigger("mouseover");

//本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
            $("#focus_3 ul").css("width", sWidth * (len));

//鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
            $("#focus_3").hover(function() {
                clearInterval(picTimer);
            }, function() {
                picTimer = setInterval(function() {
                    showPics(index);
                    index++;
                    if (index == len) {
                        index = 0;
                    }
                }, 3000); //此4000代表自动播放的间隔，单位：毫秒
            }).trigger("mouseleave");

//显示图片函数，根据接收的index值显示相应的内容
            function showPics(index) { //普通切换
                var nowLeft = -index * sWidth; //根据index值计算ul元素的left值
                $("#focus_3 ul").stop(true, false).animate({
                    "left": nowLeft
                }, 300);
                $("#focus_3 .focus-btn span").stop(true, false).animate({
                    "opacity": "0.3"
                }, 300).eq(index).stop(true, false).animate({
                    "opacity": "0.7"
                }, 300); //为当前的按钮切换到选中的效果
            }
        });

        //楼层广告切换效果 注意：依赖于 js/jquery.hiSlider.js
        $("#{{ $item['uid'] }}").find('.SZY-FLOOR-HISLIDER').hiSlider();

        //首页楼层Tab标签卡滑门切换
        $(function() {
            $("#{{ $item['uid'] }}").find(".floor-tabs-nav > li").bind('mouseover', (function(e) {
                var color = $(this).parents(".floor").attr("color");
                $(this).addClass('floor-tabs-selected').siblings().removeClass('floor-tabs-selected');
                $(this).find('h3').css({
                    "border-color": color + " " + color + " #fff",
                    "color": color
                }).parents('li').siblings('li').find('h3').css({
                    "border-color": "",
                    "color": ""
                });
                $(this).parents('.floor-con').find('.floor-tabs-panel').eq($(this).index()).removeClass('floor-tabs-hide').siblings().addClass('floor-tabs-hide');
            }));
        });
        @break

        @case('shop_floor_s1')
        //
        /*无script*/
        @break

        @case('shop_floor_s2')
        //
        /*无script*/
        @break

        {{--3--}}
        @case('article_s1')
        //
        $.imgloading.loading();
        @break

        @case('brand_s1')
        //
        $(function() {
            // 楼层品牌切换效果 注意：依赖于 js/index_tab.js
            $("#{{ $item['uid'] }}").find(".brand-con").hover(function() {
                var num = $(this).find("li").length;
                if (num > 10) {
                    $(this).find(".brand-btn").fadeTo('fast', 0.4);
                }
            }, function() {
                $(this).find(".brand-btn").fadeTo('fast', 0);
            });

            $("#{{ $item['uid'] }}").find('.tabs-brand').each(function() {
                var num = 0;
                var shu = 10;
                var llishu = $(this).find(".brand-list").first().children().length;
                var liwidth = $(this).find(".brand-list").children().width();
                var boxwidth = llishu * liwidth;
                var shuliang = llishu - shu;
                $(this).find('.brand-right').click(function() {
                    $(this).parents(".brand-con").find(".brand-list").css('width', boxwidth + 'px');
                    num++;
                    if (num > shuliang) {
                        num = shuliang;
                    }
                    var move = -liwidth * num;
                    $(this).closest($(this).parents(".brand")).find(".brand-list").stop().animate({
                        'left': move + 'px'
                    }, 500);
                })
                $(this).find('.brand-left').click(function() {
                    $(this).parents(".brand-con").find(".brand-list").css('width', '' + boxwidth + 'px');
                    num--;
                    if (num < 0) {
                        num = 0;
                    }
                    var move = -liwidth * num;
                    $(this).closest($(this).parents(".brand")).find(".brand-list").stop().animate({
                        'left': move + 'px'
                    }, 500);
                })

            });
        });
        @break

        @case('custom_s1')
        //
        /*无script*/
        @break

        @case('lc_title_s1')
        //
        /*无script*/
        @break

        @case('shop_street')
        //
        //店铺街logo鼠标经过抖动效果 注意：依赖于 js/jump.js
        $("#{{ $item['uid'] }}").find(".store-wall1 .store-con img").each(function(k, img) {
            new JumpObj(img, 10);
        });
        @break

        @case('shop_street_s2')
        //
        //店铺街logo鼠标经过效果
        $("#{{ $item['uid'] }}").find(".store-wall2-list li").hover(function() {
            $(this).find('.black-cover').css('display', 'block');
            $(this).find('.cover-content').css('display', 'block');
        }, function() {
            $(this).find('.black-cover').css('display', 'none');
            $(this).find('.cover-content').css('display', 'none');
        });

        $(function() {
            //图片缓载
            $('#{{ $item['uid'] }}').find("img").lazyload({
                skip_invisible: false,
                effect: 'fadeIn',
                failure_limit: 20,
                threshold: 200
            });
        });
        @break

        {{--4--}}

        {{--5--}}
        @case('nav_activity_s1')
        //
        $(document).ready(function() {
            var nowtime = Date.parse(new Date());
            $('#{{ $item['uid'] }}').find(".time-remain").each(function(i) {
                var obj = $(this);
                var time = $(this).data("time") * 1000 - nowtime;
                $(obj).countdown({
                    time: time,
                    htmlTemplate: '<span><em class="bg-color">%{d}</em> 天 <em class="bg-color">%{h}</em> 小时 <em class="bg-color">%{m}</em> 分 <em class="bg-color">%{s}</em> 秒</span>',
                    leadingZero: true,
                    onComplete: function(event) {
                        $(obj).html("活动已经结束啦!");
                    }
                });
            });
        });
        @break

        @case('nav_custom_s1')
        //
        /*无script*/
        @break

        @case('nav_login')
        //
        /*无script*/
        @break

        @case('nav_notice_s1')
        //
        /*无script*/
        @break

        @case('nav_notice_s2')
        //
        /*无script*/
        @break

        @case('nav_quick_service')
        //
        /*无script*/
        @break

        @case('nav_shop_apply')
        //
        /*无script*/
        @break

        {{--6--}}
        @case('news_s1')
        //
        /*无script*/
        @break

        @case('news_s2')
        //
        /*无script*/
        @break

        @case('news_s3')
        //
        /*无script*/
        @break

        {{--7--}}
        @case('topic_s1')
        //
        $(function() {
            //首页Tab标签卡滑门切换
            $("#{{ $item['uid'] }}").find(".tabs-nav > li > h3").bind('mouseover', (function(e) {
                if (e.target == this) {
                    var tabs = $(this).parent().parent().children("li");
                    var panels = $(this).parent().parent().parent().children(".tabs-panel");
                    var index = $.inArray(this, $(this).parent().parent().find("h3"));

                    if (panels.eq(index)[0]) {

                        tabs.removeClass("tabs-selected").eq(index).addClass("tabs-selected");
                        var color = $(this).parents(".floor:first").attr("color");
                        $(this).parents(".tabs-nav").find("h3").css({
                            "border-color": "",
                        });
                        $(this).css({
                            "border-color": color + " " + color + " #fff",
                        });
                        panels.addClass("tabs-hide").eq(index).removeClass("tabs-hide");
                    }
                }
            }));

        });
        @break

        @case('topic_s2')
        //
        $(function() {
            //首页Tab标签卡滑门切换
            $("#{{ $item['uid'] }}").find(".tabs-nav > li > h3").bind('mouseover', (function(e) {
                if (e.target == this) {
                    var tabs = $(this).parent().parent().children("li");
                    var panels = $(this).parent().parent().parent().children(".tabs-panel");
                    var index = $.inArray(this, $(this).parent().parent().find("h3"));
                    if (panels.eq(index)[0]) {
                        tabs.removeClass("tabs-selected").eq(index).addClass("tabs-selected");
                        var color = $(this).parents(".floor:first").attr("color");
                        $(this).parents(".tabs-nav").find("h3").css({
                            "border-color": "",
                            "color": ""
                        });
                        $(this).css({
                            "border-color": color + " " + color + " #fff",
                            "color": color
                        });
                        panels.addClass("tabs-hide").eq(index).removeClass("tabs-hide");
                    }
                }
            }));

        });
        @break

        @case('topic_s3')
        //
        /*无script*/
        @break

        {{--8--}}
        @case('bonus_s1')
        //
        $('#{{ $item['uid'] }}').on('click', '.receive-bonus', function() {
            var target = $(this);
            var bonus_id = $(this).data('bonus_id');
            $.loading.start();
            $.post("/activity/bonus/index.html", {
                bonus_id: bonus_id
            }, function(result) {
                if (result.code == 0) {
                    $.msg(result.message);
                    $(target).parent().html('<div class="btn bg-color use-bonus" data-url="' + result.data.url + '?is_redirect=1">立即使用</div>');
                    // 清除缓存
                    if (sessionStorage.getItem('template_{{ $item['uid'] }}')) {
                        sessionStorage.removeItem('template_{{ $item['uid'] }}');
                    }
                } else {
                    $.msg(result.message, {
                        time: 3000
                    });
                    if (result.data.url) {
                        $.go(result.data.url);
                    } else {
                        $.msg(result.message, {
                            time: 3000
                        });
                    }
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