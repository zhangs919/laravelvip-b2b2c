@extends('layouts.news_layout')

@section('header_css')
    <link href="/css/index.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
    <link href="/css/news.css" rel="stylesheet">
@stop

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

@stop


{{--底部js--}}
@section('footer_js')
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/assets/d2eace91/js/jquery.lazyload.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/js/news.js"></script>
    <script>
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $('#articleSearchForm').find('.search-btn').click(function(){
            if($(this).hasClass('disabled')){
                return false;
            }
            if($.trim($('#articleSearchForm').find("input[name='keyword']").val())==''){
                $.msg("请输入关键字");
                $('#articleSearchForm').find("input[name='keyword']").focus();
                return false;
            }
            $('#articleSearchForm').submit();
        });
        //
        $().ready(function(){
            //图片缓载
            $.imgloading.loading();
        });
        //
    </script>
@stop