<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="{{ $seo_keywords ?? '乐融沃B2B2C商城演示站' }}" />
    <meta name="Description" content="{{ $seo_description ?? '乐融沃B2B2C商城演示站' }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.2"/>
    <link rel="stylesheet" href="/frontend/css/common.css?v=1.2"/>
    <!-- 文章css -->
    <link rel="stylesheet" href="/frontend/css/article.css?v=1.2"/>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/frontend/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/frontend/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
    <script src="/frontend/js/common.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.2"></script>
</head>
<body>
<!---商城公共头部--->

<!-- 判断url链接 -->



<!-- 引入头部文件 -->
<!-- 站点选择 -->
@include('layouts.partials.header_top')

@include('layouts.partials.header')

{{--引入顶部分类box列表--}}
@include('layouts.partials.category_box')



<div class="w1210">
    <!-- 当前位置 -->
    <div class="breadcrumb clearfix">
        <a href="/" class="index">首页</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="/article.html">文章列表</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="{{ route('pc_show_article_list',['cat_id'>$cat['cat_id']]) }}">{{ $cat['cat_name'] }}</a>
    </div>
    <div class="content clearfix">
        <!---文章左侧导航--->
        <div class="content-left">
            <div class="title bg-color">文章列表</div>
            <div class="article-menu">

                @foreach($cat_list as $v)
                    <div class="menu-list">
                        <h4 ><a href="{{ route('pc_show_article_list', ['cat_id' => $v['cat_id']]) }}" @if($v['cat_id'] == $cat['cat_id']) class='color' @endif>{{ $v['cat_name'] }}</a>@if(!empty($v['_child']))<b></b>@endif</h4>
                        <ul @if(!empty($v['childs']) && in_array($cat['cat_id'], $v['childs'])){{ 'style="display: block;"' }}@endif>

                            @if(!empty($v['_child']))
                                @foreach($v['_child'] as $key=>$child)
                                    <li @if($key == 0)class="first"@endif><a href="{{ route('pc_show_article_list', ['cat_id' => $child['cat_id']]) }}" @if($child['cat_id'] == $cat['cat_id']) class='color' @endif data-cat_id="{{ $child['cat_id'] }}">{{ $child['cat_name'] }}</a></li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                @endforeach

            </div>

        </div>


        <script type="text/javascript">
            $.each($('.menu-list h4'),function(){
                if($(this).find('a').attr('class')=='color'){
                    $(this).parents('.menu-list').toggleClass('current').find('ul').slideToggle();
                }
            });

            $.each($('.menu-list li'),function(){
                if($(this).find('a').attr('class')=='color'){
                    $(this).parents().parents('.menu-list').toggleClass('current').find('ul').slideToggle();
                }
            });

            //左侧文章分类点击效果
            $('.menu-list h4').click(function(){
                if($(this).parents('.menu-list').find('ul li').length > 0){
                    $(this).parents('.menu-list').toggleClass('current').find('ul').slideToggle();
                }
            })
        </script>
        <!-- 文章内容 _star -->

        <div class="content-right">
            <div class="mod-tit">
                <h4>文章列表</h4>
                <div class="article-search">
                    <form id="articleSearchForm" action="{{ route('pc_show_article_list',['cat_id'>$cat['cat_id']]) }}" method="GET">
                        <input name="keyword" id="keywords" type="text" size="40" value="" class="article-input" />
                        <input type="submit" value="立即搜索" class="article-search-btn bg-color" />
                    </form>
                </div>
            </div>
            <div class="right-inner clearfix">

                {{--引入列表--}}
                @include('article.partials._article_list')
            </div>
        </div>


        <script type="text/javascript">
            var tablelist;
            $().ready(function() {
                tablelist = $("#table_list").tablelist({
                    // 支持保存查询条件
                    params: $("#articleSearchForm").serializeJson()
                });
                // 搜索

                $("#articleSearchForm").submit(function() {
                    // 序列化表单为JSON对象
                    var data = $(this).serializeJson();
                    // Ajax加载数据
                    tablelist.load(data);
                    // 阻止表单提交
                    return false;
                });

                $('body').on('click', '.article-cat', function() {
                    tablelist.load({
                        'cat_id': $(this).data('cat_id'),
                    });
                    $('body').find('.article-cat').removeClass('color');
                    $(this).addClass('color');
                });

                $('body').on('click','.article-link',function(){

                    if ($(this).data('link') != '') {
                        var link = $(this).data('link');
                        window.open(link);
                    } else {
                        window.location.href = $(this).data('url');
                    }
                });
            });
        </script>
        <!-- 文章内容  _end -->
    </div>
</div>


<!-- 引入底部文件 -->
@include('layouts.partials.short_footer')

</body>
<script src="/assets/d2eace91/js/szy.cart.js?v=1.2"></script>
</html>
