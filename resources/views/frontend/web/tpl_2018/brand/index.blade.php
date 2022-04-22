@extends('layouts.base')

@section('header_js')

@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->
    <script src="/js/index.js?v=20180813"></script>
    <script src="/js/tabs.js?v=20180813"></script>
    <script src="/js/bubbleup.js?v=20180813"></script>
    <script src="/js/jquery.hiSlider.js?v=20180813"></script>
    <script src="/js/index_tab.js?v=20180813"></script>
    <script src="/js/jump.js?v=20180813"></script>
    <script src="/js/nav.js?v=20180813"></script>
@stop



@section('content')

    <!-- 内容 -->
    <link rel="stylesheet" href="/css/brand.css?v=20180702"/>
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
                                <a href="{{ route('pc_goods_list', ['cat_id'=>$v['cat_id']]) }}">{{ $v['cat_name'] }}</a>
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
    <script src="/js/brand.js?v=20180813"></script>

@stop