@extends('layouts.base')

@section('header_css')
    <link href="/css/live.css?v=3.1" rel="stylesheet">

@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop


@section('content')

    <!-- 内容 -->

    <!-- 直播内容 -->
    <div class="w1210">
        <!-- 当前位置 -->
        <div class="breadcrumb clearfix">
            <a href="javascript:;" class="index">首页</a>
            <span class="crumbs-arrow">&gt;</span>
            <span class="last">直播列表</span>
        </div>
        <!-- 直播分类 -->
        <div class="classify-screen">
            <div class="classify-box clearfix">
                <h5 class="classify-name">直播分类：</h5>
                <div class="classify-screen-con">
                    <div class="classify-choose">
                        <a class="@if($cat_id == 0){{ 'selected' }}@endif" target="_self" href="/live/index/list.html">
                            <span>全部</span>
                        </a>
                        @foreach($cat_list as $item)
                            <a class="@if($cat_id == $item['cat_id']){{ 'selected' }}@endif" target="_self" href="/live/index/list.html?cat_id={{ $item['cat_id'] }}">
                                <span>{{ $item['cat_name'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- 排序 -->
        <div id="filter">
            <form method="GET" name="listform" id="searchForm" onSubmit="return false">
                <input type="hidden" name="sort" value="0">
                <input type="hidden" name="order" value="desc">
                <div class="fore1">
                    <dl class="order">
                        <dd class="first curr live-sort" data-sort='0'>
                            <a href="javascript:void(0);">
                                默认
                                <i class="iconfont icon-DESC"></i>
                            </a>
                        </dd>
                        <dd class="live-sort" data-sort='1'>
                            <a href="javascript:void(0);">
                                观看人数
                                <i class="iconfont icon-DESC"></i>
                            </a>
                        </dd>
                        <dd class="live-sort" data-sort='2'>
                            <a href="javascript:void(0);">
                                观看次数
                                <i class="iconfont icon-DESC"></i>
                            </a>
                        </dd>
                    </dl>
                    <dl class="shop-name">
                        <dt>店铺名称：</dt>
                        <dd>
                            <input type="text" value="" name="shop_name" />
                        </dd>
                    </dl>
                    <dl class="search">
                        <dd>
                            <input type="submit" class="btn" value="搜索" />
                        </dd>
                    </dl>
                </div>
            </form>
        </div>
        <!-- 直播列表 -->
        <div class="main" id="table_list">
            <!-- -->
            @if(!empty($list))
            <ul class="live-list">
                @foreach($list as $item)
                <li>
                    <a href="javascript:void(0)" title="{{ $item['live_name'] }}">
                        <div class="shop-info clearfix">
                            <div class="shop-logo">
                                <img alt="{{ $item['nickname'] }}" src="{{ get_image_url($item['shop_logo']) }}">
                            </div>
                            <div class="shop-name">{{ $item['shop_name'] }}</div>
                            <div class="shop-region">{{ $item['region_name'] }}</div>
                        </div>
                        <div class="live-info">
                            <img class="live-img" alt="{{ $item['live_name'] }}" src="{{ get_image_url($item['live_img']) }}">
                            <div class="live-num">
                            <span class="live-tip">
                                <i></i>
                                直播中
                            </span>
                                <span class="refresh online-num">{{ $item['online_number'] }}人正在观看</span>
                            </div>
                            <div class="live-title">{{ $item['live_name'] }}</div>
                        </div>
                        <div class="live-mask">
                            <div class="mask-bg"></div>
                            <div class="mask-info">
                                <p>扫码进直播间参与互动抢购</p>
{{--                                <img src="http://xxxx/live/qrcode_266.png">--}}
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            <!--分页-->
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
            @else
                <div class="tip-box">
                    <img src="{{ get_image_url(sysconf('default_noresult')) }}" class="tip-icon">
                    <div class="tip-text">抱歉！没有您想要的结果……</div>
                </div>
            @endif
        </div>
    </div>

@stop


{{--底部js--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=1.1"></script>
    <script src="/js/common.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/js/placeholder.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=1.1"></script>
    <script src="/js/requestAnimationFrame.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.qrcode.min.js?v=1.1"></script>
    <script src="/js/index.js?v=1.1"></script>
    <script src="/js/tabs.js?v=1.1"></script>
    <script src="/js/bubbleup.js?v=1.1"></script>
    <script src="/js/jquery.hiSlider.js?v=1.1"></script>
    <script src="/js/index_tab.js?v=1.1"></script>
    <script src="/js/jump.js?v=1.1"></script>
    <script src="/js/nav.js?v=1.1"></script>
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
        var online_num_list = [];
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            $('.live-sort').click(function() {
                $('input[name="sort"]').val($(this).data('sort'));
                if ($(this).hasClass('curr')) {
                    if ($('input[name="order"]').val() == 'desc') {
                        $('input[name="order"]').val('asc');
                        $(this).find('i').attr('class', 'iconfont icon-ASC');
                    } else {
                        $('input[name="order"]').val('desc');
                        $(this).find('i').attr('class', 'iconfont icon-DESC');
                    }
                } else {
                    $(this).addClass('curr').siblings().removeClass('curr');
                    $(this).find('i').attr('class', 'iconfont icon-DESC');
                    $('input[name="order"]').val('desc');
                }
                $("#searchForm").submit();
            });
        });
        //
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
