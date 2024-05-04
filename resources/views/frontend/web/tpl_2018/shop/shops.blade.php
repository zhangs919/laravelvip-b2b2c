@extends('layouts.base')

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->
    <script src="/js/index.js?v=20180528"></script>
    <script src="/js/tabs.js?v=20180528"></script>
    <script src="/js/bubbleup.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/js/index_tab.js?v=20180528"></script>
    <script src="/js/jump.js?v=20180528"></script>
    <script src="/js/nav.js?v=20180528"></script>
@stop



@section('content')

    <!-- 内容 -->

    <link rel="stylesheet" href="/css/shop_street.css?v=20180428"/>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
    <div class="w1210">
        <div class="classify-screen">

            @if(sysconf('site_open'))
                <div class="classify-box clearfix">
                    <h5 class="classify-name">区域站点：</h5>
                    <div class="classify-screen-con">
                        <div class="classify-choose">

                            <a target="_self" href="/shop/street/index.html?cls_id=&amp;site_id=1" class="selected">
                                <span>开州区</span>
                            </a>

                            <a target="_self" href="/shop/street/index.html?cls_id=&amp;site_id=2">
                                <span>北京站</span>
                            </a>


                        </div>
                    </div>
                </div>
            @endif

            <div class="classify-box clearfix">
                <h5 class="classify-name">店铺分类：</h5>
                <div class="classify-screen-con">
                    <div class="classify-choose">
                        <a target="_self" href="/shop/street/index.html" @if($cls_id == 0) class="selected" @endif>
                            <span>全部</span>
                        </a>

                        @foreach($cls_list_1 as $v)
                        <a target="_self" href="?cls_id=1_{{ $v['cls_id'] }}_0" title="{{ $v['cls_name'] }}" @if($query_parent_cls_id == $v['cls_id']) class="selected" @endif>
                            <span>{{ $v['cls_name'] }}</span>
                        </a>
                        @endforeach

                    </div>

                    @if(!empty($child_class_list))
                    <div class="classify-screen-con1">
                        <a target="_self" href="?cls_id=1_{{ $query_parent_cls_id }}_0" @if($cls_id_arr[2] == 0 && $cls_id_arr[0] == 1) class="selected" @endif>
                            <span>全部</span>
                        </a>

                        @foreach($child_class_list as $v)
                        <a target="_self" href="?cls_id=2_{{ $v->cls_id }}_{{ $v->parent_id }}" title="{{ $v->cls_name }}" @if($cls_id_arr[1] == $v->cls_id) class="selected" @endif>
                            <span>{{ $v->cls_name }}</span>
                        </a>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="w1210">
        <div id="filter">
            <form method="get" name="listform" id="listform" action="">
                <div class="fore1">
                    <dl class="order">
                        <dd class="first  curr ">
                            <a href="?cls_id=&name=&sort=default"> 默认 </a>
                        </dd>
                        <dd class="">
                            <a href="?cls_id=&name=&sort=sale-desc">
                                销量

                                <i class="iconfont icon-DESC"></i>

                            </a>
                        </dd>
                        <dd class="">
                            <a href="?cls_id=&name=&sort=credit-desc">
                                信誉

                                <i class="iconfont icon-DESC"></i>

                            </a>
                        </dd>
                    </dl>
                    <dl class="shop-name">
                        <dt>店铺名称：</dt>
                        <dd>
                            <input type="text" placeholder="" name="name" value="" />
                            <input type="submit" class="btn" value="搜索" />
                        </dd>
                    </dl>
                </div>
            </form>
        </div>

        {{--引入列表--}}
        @include('shop.partials.street_shop_list')

    </div>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            $("#checkbox").click(function() {
                $("#listform").submit();
            });
        });
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
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
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
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            $("#checkbox").click(function() {
                $("#listform").submit();
            });
        });
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