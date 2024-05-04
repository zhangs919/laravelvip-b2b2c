@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/live.css?v=123" rel="stylesheet">

@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <header class="header-top-nav">
            <div class="header bg-color">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">直播列表</div>
                <div class="header-right">
                    <!-- 控制展示更多按钮 -->
                    <aside class="show-menu-btn">
                        <div class="show-menu" id="show_more">
                            <a href="javascript:void(0);">
                                <i class="iconfont">&#xe6cd;</i>
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </header>
        <div class="scroll-y-menu swiper-container bg-color">
            <ul class="swiper-wrapper">
                <li class="swiper-slide @if($cat_id == 0){{ 'active' }}@endif">
                    <a href="/live/index/list.html">全部</a>
                </li>
                @foreach($cat_list as $item)
                    <li class="swiper-slide @if($cat_id == $item['cat_id']){{ 'active' }}@endif">
                        <a href="/live/index/list.html?cat_id={{ $item['cat_id'] }}">{{ $item['cat_name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div id="table_list">
            @if(!empty($list))
                <div class="live-list-con tablelist-append">
                    <ul>
                        @foreach($list as $item)
                        <li class="live-item" data-id="{{ $item['id'] }}">
                            <div class="live-item-bd">
                                <img src="{{ get_image_url($item['live_img']) }}">
                                <div class="live-num">
                                    <div class="live-tip">
                                        <div class="loader-live-icon"></div>
                                    </div>
                                    <span class="refresh" id="online_num_{{ $item['id'] }}">{{ $item['online_number'] }}人</span>
                                </div>
                                <!-- 关注人数 -->
                                <div class="follow-num">
                                    <i></i>
                                    <span class="num">{{ $item['view_number'] }}</span>
                                </div>
                            </div>
                            <div class="live-item-info">
                                <div class="live-title">{{ $item['live_name'] }}</div>
                                <div class="live-shop-item">
                                    <div class="shop-logo">
                                        <img src="{{ get_image_url($item['shop_image']) }}">
                                    </div>
                                    <div class="shop-info">
                                        <a class="shop-name">{{ $item['shop_name'] }}</a>
                                        <a class="live-position">{{ $item['region_name'] ?? '' }}</a>
                                    </div>
                                </div>
                                @if(!empty($item['goods_info']))
                                    <div class="goods-list">
                                        @foreach($item['goods_info'] as $g)
                                        <div class="live-goods-pic">
                                            <img src="{{ get_image_url($g['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                                            <div class="goods-price">{{ $g['goods_price'] }}</div>
                                            <div class="goods-amount">+ {{ count($item['goods_info']) }}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- 分页 -->
                <div id="pagination" class="page">
                    <div class="more-loader-spinner">
                        <div class="is-loaded">
                            <div class="loaded-bg">我是有底线的</div>
                        </div>
                    </div>
                    <script data-page-json="true" type="text" id="page_json">
                        {!! $json_page !!}
                    </script>
                </div>
            @else
                <div class="no-data-div">
                    <div class="no-data-img">
                        <img src="/images/bg_empty_data.png" />
                    </div>
                    <dl>
                        <dt>没有直播数据</dt>
                    </dl>
                </div>
            @endif

        </div>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
    </div>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        
    </div>
    <!-- 底部 _end-->
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>

    <script>
        //滚动菜单
        var mySwiper;
        $(function(){
            mySwiper = new Swiper('.scroll-y-menu', {
                // loop : true,
                slidesPerView: 'auto',
                loopedSlides: 8,
                touchRatio: 1,
            });
        });
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 50) {
                if ($.isFunction($.pagemore)) {
                    $.pagemore({
                        callback: function(result) {
                            refreshNum();
                        }
                    });
                }
            }
        });
        //
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
            $('body').on('click', '.live-item', function() {
                $.go('/live/' + $(this).data('id') + '.html');
            });
        });
        //
    </script>

@stop