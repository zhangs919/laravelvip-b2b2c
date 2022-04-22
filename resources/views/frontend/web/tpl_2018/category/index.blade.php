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

    <link rel="stylesheet" href="/css/category_all.css?v=20180702"/>
    <script src="/js/category_all.js?v=20180813"></script>
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