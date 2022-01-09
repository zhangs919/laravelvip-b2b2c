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
        <a class="last" href="/help/shop.html">商家指南</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="/help/shop/list/26.html">信息公告</a>
        <span class="crumbs-arrow">&gt;</span>
        <a class="last" href="/help/shop/27.html">商城招商公告</a>
    </div>
    <div class="content clearfix">
        <!---文章左侧导航--->
        <div class="content-left">
            <div class="title bg-color">商家指南</div>
            <div class="article-menu">


                @foreach($class_list as $v)
                <div class="menu-list">
                    <h4 ><a href="{{ route('show_shop_list', ['cat_id' => $v['cat_id']]) }}" >{{ $v['cat_name'] }}</a>@if(!empty($v['_child']))<b></b>@endif</h4>
                    <ul>

                        @if(!empty($v['_child']))
                        @foreach($v['_child'] as $key=>$child)
                        <li @if($key == 0)class="first"@endif><a href="/help/shop/{{ $child['cat_id'] }}.html"  data-cat_id="{{ $child['cat_id'] }}">{{ $child['cat_name'] }}</a></li>
                        @endforeach
                        @endif

                    </ul>
                </div>
                @endforeach

                {{--<div class="menu-list">
                    <h4 ><a href="/help/shop/list/8.html" >店铺续签/终止合作</a><b></b></h4>
                    <ul>

                        <li class="first"><a href="/help/shop/17.html"  data-cat_id="18">店铺续签</a></li>

                        <li ><a href="/help/shop/18.html"  data-cat_id="19">终止合作</a></li>

                    </ul>
                </div>

                <div class="menu-list">
                    <h4 ><a href="/help/shop/list/9.html" >店铺管理</a><b></b></h4>
                    <ul>

                        <li class="first"><a href="/help/shop/list/12.html"  data-cat_id="12">我的店铺</a></li>

                        <li ><a href="/help/shop/list/13.html"  data-cat_id="13">商品管理</a></li>

                        <li ><a href="/help/shop/list/14.html"  data-cat_id="14">订单管理</a></li>

                        <li ><a href="/help/shop/list/15.html"  data-cat_id="15">会员管理</a></li>

                        <li ><a href="/help/shop/list/16.html"  data-cat_id="16">账号管理</a></li>

                        <li ><a href="/help/shop/list/17.html"  data-cat_id="17">客服管理</a></li>

                    </ul>
                </div>

                <div class="menu-list">
                    <h4 ><a href="/help/shop/list/10.html" >促销推广</a><b></b></h4>
                    <ul>

                        <li class="first"><a href="/help/shop/list/11.html"  data-cat_id="11">团购</a></li>

                    </ul>
                </div>

                <div class="menu-list">
                    <h4 ><a href="/help/shop/list/25.html" >入驻指南</a></h4>
                    <ul>

                    </ul>
                </div>

                <div class="menu-list">
                    <h4 ><a href="/help/shop/list/26.html" class='color'>信息公告</a></h4>
                    <ul>

                    </ul>
                </div>--}}

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

            <div class="article-right">
                <div class="article-tit">
                    <h3>{{ $article_info->title }}</h3>
                    <p>{{ $article_info->add_time }}</p>
                </div>
                <div class="article-detail">
                    {!! $article_info->content !!}
                </div>
                <div class="article-bottom clearfix">
                    <div class="article-bottom-right">下一篇:<a href="/help/shop/30.html">批发市场已正式上线</a></div>          </div>
            </div>

        </div>


        <!-- 文章内容  _end -->
    </div>
</div>


<!-- 引入底部文件 -->
@include('layouts.partials.short_footer')

</body>
<script src="/assets/d2eace91/js/szy.cart.js?v=1.2"></script>
</html>
