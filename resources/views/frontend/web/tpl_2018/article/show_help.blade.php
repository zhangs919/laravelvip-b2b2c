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
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=20180428"/>
    <link rel="stylesheet" href="/css/common.css?v=20180428"/>
    <link rel="stylesheet" href="/css/help.css?v=20180428"/>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=20180528"></script>
    <script src="/js/common.js?v=20180528"></script>
    <script src="/js/help.js?v=20180528"></script>
</head>
<body>
<!---商城公共头部--->

<!-- 判断url链接 -->



<!-- 引入头部文件 -->
<!-- 站点选择 -->
@include('layouts.partials.header_top')

@include('layouts.partials.help_header')



{{--内容--}}
<div class="content w990 clearfix">
    <!-- 左半部分内容 -->
    <div class="fl">
        <div class="store-category">
            <h3 class="left-title bg-color">帮助中心</h3>
            <div class="left-content tree">
                <ul>

                    @foreach($class_list as $k=>$v)
                    <li>
                        <h4>
                            <a href="javascript:;" title="" class="tree-first">{{ $v['cat_name'] }}</a>
                            <span>
                                <i class="icon-plus-sign @if($article_info->cat_id == $v['cat_id']) icon-minus-sign @endif"></i>
                            </span>
                        </h4>
                        <ul @if($article_info->cat_id == $v['cat_id']) style="display: block;" @endif>

                        @if(!empty($v['article']))
                            @foreach($v['article'] as $key=>$child)
                            <li>
                                <a href="{{ route('pc_show_help', ['article_id' => $child['article_id']]) }}" target="_self" @if($article_info->article_id == $child['article_id']) class="current" @endif title="{{ $child['title'] }}">{{ $child['title'] }}</a>
                            </li>
                            @endforeach
                        @endif

                        </ul>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    <!-- 右半部分内容 -->
    <div class="fr">
        <div class="right-inner">


            <h3 class="help-tit">{{ $article_info->title }}</h3>
            <div class="help-detail">
                {!! $article_info->content !!}
                <br class="Apple-interchange-newline" />
            </div>


        </div>
    </div>
</div>


<!-- 引入底部文件 -->
@include('layouts.partials.short_footer')

</body>
<script src="/js/jquery.fly.min.js?v=20180528"></script>
<script src="/assets/d2eace91/js/szy.cart.js?v=1.2"></script>
</html>
