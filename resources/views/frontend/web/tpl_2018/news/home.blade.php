@extends('layouts.news_layout')

@section('header_css')
    <link href="/css/index.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
    <link href="/css/news.css" rel="stylesheet">
@stop

@section('content')

    <!--顶部topbar-->

    <!--模块内容-->
    <!-- #tpl_region_start -->
    <!-- 默认缓载图片 -->

    {!! $tplHtml !!}

    <!-- #tpl_region_end -->

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
        $().ready(function() {
            $('.site_to_yikf').click(function() {
                $(this).parent('form').submit();
            })
        });
        // 
        $().ready(function(){
            //图片缓载
            $.imgloading.loading();
        });
        // 
    </script>
@stop