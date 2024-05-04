@extends('layouts.base')

@section('header_css')
    <link href="/css/brand.css" rel="stylesheet">
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('content')

    <!-- 内容 -->
    <div class="brand-banner">
        <div class="brand-scroll">

            <a href="javascript:void(0);" class="scrleft disabled"></a>

            <div class="banner">
                <ul id="goods-banner">

                    @foreach($banner_list as $v)
                    <li>
                        <a href="{{ route('pc_goods_list', ['filter_str' => $v['cat_id'].'-0-0-0-0-0-0-0-0-0-0-'.$v['brand_id']]) }}" title="{{ $v['brand_name'] }}" target="_blank">
                            <img src="{{ $v['promotion_image'] }}" alt="{{ $v['brand_name'] }}" />
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>

            <a href="javascript:void(0);" class="scrright"></a>

        </div>
    </div>
    <div class="w1210">
        <!--当前位置，面包屑-->
        <div class="breadcrumb clearfix">
            <a href="{{ route('pc_home') }}" class="index">首页</a>
            <span class="crumbs-arrow">&gt;</span>
            <span class="last">品牌专区</span>
        </div>
        <!--主体内容-->
        <div class="main">
            <div class="brand-left">
                <dl class="sort-menu">
                    <dd>
                        <ul class="all-brands">

                            @foreach($cat_list as $v)
                            <li class="">
                                <a href="javascript:void(0);">{{ $v['cat_name'] }}</a>
                            </li>
                            @endforeach

                            <li class="go-top">
                                <a href="javascript:void(0);">返回顶部</a>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>
            <div class="brand-right">
                <div class="brand-list">

                    @foreach($cat_list as $v)
                        <div class="brand-floor">
                            <h2>
                                <i></i>
                                <a href="{{ route('pc_goods_list', ['filter_str'=>$v['cat_id']]) }}">{{ $v['cat_name'] }}</a>
                            </h2>
                            <ul>

                                @foreach($v['brand_list'] as $brand)
                                <li class="li-spe">
                                    <a href="{{ route('pc_goods_list', ['filter_str' => $v['cat_id'].'-0-0-0-0-0-0-0-0-0-0-'.$brand['brand_id']]) }}" class="listbox" target="_blank" title="{{ $brand['brand_name'] }}">
                                        <div class="brand-suspend-img">
                                            <img src="{{ $brand['promotion_image'] }}" />
                                        </div>
                                        <div class="brand-con">
                                            <div class="brand-img">
                                                <img src="{{ $brand['brand_logo'] }}" />
                                            </div>
                                            <div class="brand-name">
                                                <span>{{ $brand['brand_name'] }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

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
    <script src="/js/brand.js"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
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