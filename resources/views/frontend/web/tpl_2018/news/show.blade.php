@extends('layouts.news_layout')


@section('content')

    <div class="w1210">
        <!-- 当前位置 _start -->
        <div class="breadcrumb clearfix">
            <a href="/news.html" class="index">首页</a>


            @foreach($crumbs as $v)
                <span class="crumbs-arrow">&gt;</span>
                <a class="last" href="{{ route('pc_news_list',['cat_id'=>$v['cat_id']]) }}">{{ $v['cat_name'] }}</a>
            @endforeach

            <span class="crumbs-arrow">&gt;</span>
            <a class="last" href="{{ route('pc_news_list',['cat_id'=>$cat['cat_id']]) }}">{{ $cat['cat_name'] }}</a>


            <span class="crumbs-arrow">&gt;</span>
            <a class="last" href="{{ route('pc_show_news', ['article_id'=>$article['article_id']]) }}">{{ $article['title'] }}</a>

        </div>
        <!-- 当前位置 _end -->
        <div class="main-left fl">
            <div class="article-content">
                <div class="article-right">
                    <div class="article-tit">
                        <h3>{{ $article['title'] }}</h3>
                        <p>{{ $article['add_time'] }}</p>
                    </div>
                    <div class="article-detail">
                        <h3 class="black w800 m_auto marb30 wow fadeInUp animated">
                            {!! $article['content'] !!}
                        </h3>
                    </div>
                    <div class="article-bottom clearfix">

                        <div class="article-bottom-left">
                            上一篇:
                            @if(!empty($article_pre))
                                <a href="{{ route('pc_show_news', ['article_id'=>$article_pre['article_id']]) }}" title="{{ $article_pre['title'] }}">{{ $article_pre['title'] }}</a>
                            @else
                                无更多文章了！
                            @endif
                        </div>

                        <div class="article-bottom-right">
                            下一篇:
                            @if(!empty($article_next))
                                <a href="{{ route('pc_show_news', ['article_id'=>$article_next['article_id']]) }}" title="{{ $article_next['title'] }}">{{ $article_next['title'] }}</a>
                            @else
                                无更多文章了！
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- 推荐文章 -->
        @include('news.partials._recommend_list')

    </div>

@endsection