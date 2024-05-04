@extends('layouts.base')

@section('header_css')
    <link rel="stylesheet" href="/css/flow.css?v=20180702"/>
@stop

@section('header_js')

@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->

@stop

{{--不显示分类box--}}
@section('category_box')

@show

@section('content')

    <div class="w990" id="content">

        {{--引入列表--}}
        @include('cart.partials._cart_list')

    </div>

    <!-- 猜你喜欢 -->
    @if(!empty($guess_goods_list))
    <div class="interested-box">
        <div class="interested-title">
            <ul>
                <li class="selected">
                    <a href="javascript:;">猜你喜欢</a>
                </li>
                <!-- <li class="">
                        <a href="javascript:;">随手购</a>
                    </li> -->
            </ul>
        </div>
        <div class="interested-main">
            <div class="interested-panel products-item1" style="display: block">
                <div class="focus-tab">
                    @foreach($guess_goods_list as $key=>$item)
                        <a @if($key == 0)class="selected"@endif></a>
                    @endforeach
                </div>
                <div class="goods-list-panel">
                    @foreach($guess_goods_list as $key=>$item)
                    <ul @if($key == 0)style="display: block"@endif>
                        @foreach($item as $v)
                        <li>
                            <div class="item">
                                <a class="" href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" target="_blank">
                                    <img class="p-img" src="{{ get_image_url($v['goods_image']) }}" alt="">
                                    <div class="p-name">{{ $v['goods_name'] }}</div>
                                    <div class="p-price color">￥{{ $v['goods_price'] }}</div>
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
                <div class="interested-page">
                    <a class="prev" href="javascript:;">&lt;</a>
                    <a class="next" href="javascript:;">&gt;</a>
                </div>
            </div>
        </div>
    </div>
    @endif

@stop

@section('footer_js')
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=20180726"></script>
    <script src="/js/common.js?v=20180726"></script>
    <script src="/js/tabs.js?v=20180726"></script>
    <script src="/js/cart.js?v=20180726"></script>

    <script>
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
        var guess_goods_count = "{{ count($guess_goods_list) }}";
        if (guess_goods_count > 2) {
            var last_index = 2;
        } else if (guess_goods_count > 1) {
            var last_index = 1;
        }
        $("body").on('click', '.prev', function() {
            var parent = $(this).parent().parent();
            var focus = parent.children(":first");
            var index = 0;
            var prev = 0;
            focus.children("a").each(function() {
                if ($(this).attr("class") == "selected") {
                    index = $(this).index();
                    $(this).removeClass("selected");
                }
            });
            focus.children("a").each(function() {
                if (index > 0) {
                    prev = index - 1;
                } else {
                    prev = last_index;
                }
                if ($(this).index() == prev) {
                    $(this).addClass("selected");
                }
            });
            focus = focus.next();
            var index = 0;
            focus.children("ul").each(function() {
                if ($(this).is(":visible")) {
                    index = $(this).index();
                    $(this).hide();
                }
            });
            focus.children("ul").each(function() {
                if (index > 0) {
                    prev = index - 1;
                } else {
                    prev = last_index;
                }
                if ($(this).index() == prev) {
                    $(this).show();
                }
            });
        });
        $("body").on('click', '.next', function() {
            var parent = $(this).parent().parent();
            var focus = parent.children(":first");
            var index = 0;
            var next = 0;
            focus.children("a").each(function() {
                if ($(this).attr("class") == "selected") {
                    index = $(this).index();
                    $(this).removeClass("selected");
                }
            });
            focus.children("a").each(function() {
                if (index == last_index) {
                    next = 0;
                } else {
                    next = index + 1;
                }
                if ($(this).index() == next) {
                    $(this).addClass("selected");
                }
            });
            focus = focus.next();
            var index = 0;
            focus.children("ul").each(function() {
                if ($(this).is(":visible")) {
                    index = $(this).index();
                    $(this).hide();
                }
            });
            focus.children("ul").each(function() {
                if (index == last_index) {
                    next = 0;
                } else {
                    next = index + 1;
                }
                if ($(this).index() == next) {
                    $(this).show();
                }
            });
        });
        //
        var shop_id = '0';
        /*鼠标滑过切换tab*/
        function mouseover_tabs(a,b,c){
            $(a).mouseover(function(){
                $(this).addClass(c).siblings().removeClass(c);
                $(b).eq($(this).index()).show().siblings().hide();
            })
        }
        mouseover_tabs(".interested-title ul li",".interested-main .interested-panel",'selected');
        mouseover_tabs(".products-item1 .focus-tab a",".products-item1 .goods-list-panel ul",'selected');
        mouseover_tabs(".products-item2 .focus-tab a",".products-item2 .goods-list-panel ul",'selected');
        mouseover_tabs(".products-item3 .focus-tab a",".products-item3 .goods-list-panel ul",'selected');
        mouseover_tabs(".products-item4 .focus-tab a",".products-item4 .goods-list-panel ul",'selected');
        //
    </script>
@stop