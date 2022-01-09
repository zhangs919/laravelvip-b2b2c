@extends('layouts.news_layout')


@section('content')

    <div class="w1210">

        <div class="article-cat-box">
            <ul class="article-cat-list clearfix">


                @foreach($cat_list as $v)
                <!-- 0 -->
                <li class="item ">
                    <div class="content">
                        <div class="name">

                            <img src="{{ get_image_url($v['cat_image']) }}" />

                            <a href="{{ route('pc_news_list', ['cat_id'=>$v['cat_id']]) }}" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                        </div>

                        @if(!empty($v['_child']))

                        <div class="extra">
                            @foreach($v['_child'] as $child)
                            <span>
                                <a href="{{ route('pc_news_list', ['cat_id'=>$child['cat_id']]) }}" title="{{ $child['cat_name'] }}">{{ $child['cat_name'] }}</a>
                            </span>
                            @endforeach
                        </div>
                        @endif

                    </div>
                </li>
                @endforeach

            </ul>
        </div>

        <!-- 当前位置 _start -->
        <div class="breadcrumb clearfix">
            <a href="/news.html" class="index">首页</a>

            @foreach($crumbs as $v)
            <span class="crumbs-arrow">&gt;</span>
            <a class="last" href="{{ route('pc_news_list',['cat_id'=>$v['cat_id']]) }}">{{ $v['cat_name'] }}</a>
            @endforeach

            <span class="crumbs-arrow">&gt;</span>
            <a class="last" href="{{ route('pc_news_list',['cat_id'=>$cat['cat_id']]) }}">{{ $cat['cat_name'] }}</a>

        </div>
        <!-- 当前位置 _end -->
        <div class="main-left fl">


        {{--引入列表--}}
        @include('news.partials._list')

        </div>
        <!-- 推荐文章 -->
        @if(!empty($recommend))
            @include('news.partials._recommend_list')
        @endif

    </div>

    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            var data =  $("#articleSearchForm").serializeJson();
            data.go = '{0}';
            var params = '';
            $.each(data, function(i, v) {
                if(v != ''){
                    params = params + '&' + i + '=' + v;
                }
            });
            var page_url = location.href;

            page_url = page_url.split('?')[0];
            if (page_url.indexOf("?") == -1) {
                params = params.replace(/&/, "?");
            }
            page_url = page_url + params;

            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#articleSearchForm").serializeJson(),
                page_mode: 1,
                go: function(page){
                    page_url = page_url.replace('{0}', page);
                    $.go(page_url);
                }

            });
        });
    </script>

@endsection