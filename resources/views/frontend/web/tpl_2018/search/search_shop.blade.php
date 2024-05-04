@extends('layouts.base')


@section('header_css')
    <link href="/css/shop_street.css" rel="stylesheet">
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop




@section('content')

    <!-- 内容 -->
    <div class="w1210">
        <div id="filter">
            <!--排序-->
            <form method="GET" name="listform" action="/search.html">
                <div class="fore1">
                    <dl class="order">
                        <dd class="first curr">
                            <a href="{{ $credit }}">
                                默认
                                <b class="icon-order-DESCending"></b>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="{{ $sale_num }}">
                                销量
                                <b class="icon-order-DESCending"></b>
                            </a>
                        </dd>
                    </dl>
                    <dl class="shop-name">
                        <dt>店铺名称：</dt>
                        <dd>
                            <input type="text" placeholder="{{ $keyword }}" name="keyword" />
                            <input type='hidden' name='type' value="1">
                            <input type="submit" class="btn" value="搜索" />
                        </dd>
                    </dl>
                </div>
            </form>
        </div>
        <div class="main">

			@include('frontend.web.tpl_2018.search.partials._shop_list')

        </div>
    </div>
    <script type="text/javascript">
        //
    </script>

@stop


{{--底部js--}}
@section('footer_js')
    <script src="/js/index.js"></script>
    <script src="/js/tabs.js"></script>
    <script src="/js/bubbleup.js"></script>
    <script src="/js/jquery.hiSlider.js"></script>
    <script src="/js/index_tab.js"></script>
    <script src="/js/jump.js"></script>
    <script src="/js/nav.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/jquery.lazyload.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/js/requestAnimationFrame.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                page_mode: 2
            });
        });
        //
        //解决因为缓存导致获取分类ID不正确问题，需在ready之前执行
        $(".SZY-DEFAULT-SEARCH").data("cat_id", "");
        $().ready(function() {
            $(".SZY-SEARCH-BOX-KEYWORD").val("{{ request('keyword', '') }}");
            $(".SZY-SEARCH-BOX-KEYWORD").data("search_type", "{{ request('search_type', 0) }}");
            //
            $(".SZY-SEARCH-BOX-KEYWORD").attr("placeholder", "请输入要搜索的关键词");
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
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
        //
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
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
        $().ready(function() {
        })
        //
    </script>
@stop
