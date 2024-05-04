@extends('layouts.news_layout')

@section('header_css')
    <link href="/css/index.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
    <link href="/css/news.css" rel="stylesheet">
@stop

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
       //
    </script>

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