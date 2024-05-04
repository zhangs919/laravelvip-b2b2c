@extends('layouts.base')

@section('header_css')
    <link href="/css/coupon.css?v=3.1" rel="stylesheet">

@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop


@section('content')


    <!-- 内容 -->
    <!-- banner轮播 _star -->
    <!-- banner轮播 _end -->
    <div class="coupon-list  w1210">
        <div class="coupon-title">
            <img src="/images/market-coupon-title.png">
        </div>


        @include('bonus.partials._list')

    </div>
@stop


{{--底部js--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
    <script src="/js/jquery.fly.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=20201016"></script>
    <script src="/js/requestAnimationFrame.js?v=20201016"></script>
    <script src="/js/group_buy.js?v=20201016"></script>
    <script src="/js/common.js"></script>
    <script src="/js/app.frontend.index.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/min/js/message.min.js?v=20201016"></script>
    <script>
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "227";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "230";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "229";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "228";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "254";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "251";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "250";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "249";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "248";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "244";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "243";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            var act_id = "242";
            $("#bonus_countdown" + act_id).countdown({
                time: "-1604325934000",
                leadingZero: true,
                htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
                onComplete: function (event) {
                }
            });
        });
        //
        $().ready(function () {
            $(".pagination-goto > .goto-input").keyup(function (e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function () {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        $().ready(function () {
            var page_url = "/bonus-list-0-0-0-{0}.html";
            page_url = page_url.replace(/&amp;/g, '&');
            var tablelist = $("#table_list").tablelist({
                page_mode: 1,
                go: function (page) {
                    page_url = page_url.replace("{0}", page);
                    $.go(page_url);
                }
            });
            $(".prev-page").click(function () {
                if ($(this).find('span').hasClass('prev-disabled')) {
                    return;
                }
                tablelist.prePage();
            });
            $(".next-page").click(function () {
                if ($(this).find('span').hasClass('next-disabled')) {
                    return;
                }
                tablelist.nextPage();
            });
            $(".send").click(function () {
                var bonus_id = $(this).data('bonus_id');
                var shop_id = "0";
                $.loading.start();
                $.post("/activity/bonus/index.html", {
                    bonus_id: bonus_id
                }, function (result) {
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 3000
                        }, function () {
                            tablelist.load();
                        });
                    } else {
                        if (result.message == '红包不存在或已失效') {
                            $.msg(result.message, {
                                time: 3000
                            }, function () {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            }, function () {
                                $.go(result.data.url);
                            });
                        }
                    }
                }, 'json').always(function () {
                    $.loading.stop();
                });
            });
        });
        //
        //解决因为缓存导致获取分类ID不正确问题，需在ready之前执行
        $(".SZY-DEFAULT-SEARCH").data("cat_id", "");
        $().ready(function () {
            $(".SZY-SEARCH-BOX-KEYWORD").val("");
            $(".SZY-SEARCH-BOX-KEYWORD").data("search_type", "");
            //
            $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-SUBMIT").click(function () {
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
        $().ready(function () {
            $('.site_to_yikf').click(function () {
                $(this).parent('form').submit();
            })
        });
        //
        $().ready(function () {
            // 缓载图片
            $.imgloading.loading();
        });
        //
        $().ready(function () {
			WS_AddUser({
				user_id: 'user_{{ $user_info['user_id'] ?? 0 }}',
				url: "{{ get_ws_url('4431') }}",
				type: "add_user"
			});
        }, 'JSON');

        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '金豆'
                    });
                }
            }
        }

        //
        $().ready(function () {
        })
        //
    </script>
@stop
