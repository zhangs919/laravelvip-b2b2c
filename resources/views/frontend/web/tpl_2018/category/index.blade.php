@extends('layouts.base')

@section('header_css')
    <link href="/css/category_all.css" rel="stylesheet">
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop


@section('content')

    <!-- 判断url链接 -->

    <div class="w1210 category-all-box">
        <div class="breadcrumb clearfix"> <a href="{{ route('pc_home') }}" class="index">首页</a> <span class="crumbs-arrow">&gt;</span> <span class="last">全部商品分类</span> </div>
        <div class="w1210 all-category-list">
            <div class="all-category-items">
                <ul>

                    @foreach($list as $k=>$v)
                        <li class="category-list"> <a>{{ $v['cat_name'] }}</a> </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="all-warpper w1210">


            @foreach($list as $v)
                <div class="all-category-floor">
                <div class="floor-top">
                    <div class="title"><a href="/list-{{ $v['cat_id'] }}.html">{{ $v['cat_name'] }}</a></div>
                </div>
                <div class="floor-bot">
                    <div class="floor-category-list">

                        @if(!empty($v['items']))
                            @foreach($v['items'] as $vv)
                                <dl>
                                    <dt> <a href="/list-{{ $vv['cat_id'] }}.html" target="_blank">{{ $vv['cat_name'] }}</a>
                                    </dt>
                                    <dd>

                                        @if(!empty($vv['items']))
                                            @foreach($vv['items'] as $vvv)
                                                <a href="/list-{{ $vvv['cat_id'] }}.html" target="_blank">{{ $vvv['cat_name'] }}</a>
                                            @endforeach
                                        @endif

                                    </dd>
                                </dl>
                            @endforeach
                        @endif


                    </div>
                </div>
            </div>
            @endforeach


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
    <script src="/js/category_all.js"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        //解决因为缓存导致获取分类ID不正确问题，需在ready之前执行
        $(".SZY-DEFAULT-SEARCH").data("cat_id", "0");
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