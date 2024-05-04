
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
    <meta name="is_frontend" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!--整站改色 _start-->
    <!--整站改色 _end-->
    <link href="/assets/d2eace91/iconfont/iconfont.css?v=20201012" rel="stylesheet">
    <link href="/css/common.css?v=20201012" rel="stylesheet">
    <link href="/css/shop_index.css?v=20201012" rel="stylesheet">
    <link href="/css/template.css?v=20201012" rel="stylesheet">
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/css/color-style.css?v=1.7" id="site_style"/>
    @endif
    <script src="/assets/d2eace91/js/jquery.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/szy.head.js?v=20201016"></script>
</head>
<body class="shop-index">
<!-- 引入头部文件 -->
<!-- 引入头部文件 -->
<!-- 首页JS资源包 -->
<!-- 站点选择 -->
{{-- include header_top --}}
@include('layouts.partials.header_top')

{{-- include shop_header --}}
@include('layouts.partials.shop_header')

<script type="text/javascript">
    // 
</script>
<script type="text/javascript">
    // 
</script>
<div class="layout" style="min-height: 400px;">
    <!-- 内容 -->
    <!--模块内容-->
    <!-- #tpl_region_start -->
    <!-- 红包模板 bouns_s1 -->

    {!! $tplHtml !!}

    <!-- #tpl_region_end -->


    @if(!$webStatic){{--静态页面关闭时 显示--}}
    <script type="text/javascript">
        $.templateloading();
    </script>
    @endif

</div>

{{-- include right_sidebar --}}
@include('layouts.partials.right_sidebar')



{{-- include common footer --}}
@section('common_footer')
    @include('layouts.partials.common_footer')
@show


<script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
<script src="/js/common.js?v=20201016"></script>
<script src="/js/jquery.fly.min.js?v=20201016"></script>
<script src="/js/placeholder.js?v=20201016"></script>
<script src="/assets/d2eace91/js/design/shop_index.js?v=20201016"></script>
<script src="/assets/d2eace91/js/szy.cart.js?v=20201016"></script>
<script src="/js/app.frontend.index.min.js?v=20201016"></script>


{{--todo 以下script是页面装修模板用到的，从页面装修数据中判断，独立放到一个地方，后面再改--}}
@include('frontend.web.modules.library.design_scripts')


<script>
    @if(!$webStatic){{--静态页面关闭时 显示--}}
    $.templateloading();
    @endif
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
    function search_all() {
        document.getElementById('search-form').action = "{{ route('pc_global_search') }}";
        document.getElementById("search-form").submit();
    }
    function search_me() {
        document.getElementById('search-form').action = "{{ route('pc_shop_search', ['shop_id' => $shop_info['shop']['shop_id']]) }}";
        document.getElementById("search-form").submit();
    }
    function toggleShop(shop_id, obj) {
        $.collect.toggleShop(shop_id, function(result) {
            if (result.code == 0) {
                $(".collect-count").html(result.collect_count);
                $(obj).parent().toggleClass("fav-shop-box-select");
                if ($(obj).html() == "关注本店") {
                    $(obj).html("取消关注");
                    $(".collect-tip").html("已关注");
                } else {
                    $(obj).html("关注本店");
                    $(".collect-tip").html("关注");
                }
                if(result.show_collect_count == 1 && result.collect_count > 0){
                    $(".collect-tip").show();
                    $(".collect-count").show();
                }else{
                    $(".collect-tip").hide();
                    $(".collect-count").hide();
                }
            }
        }, true);
    }
    // 
    $().ready(function() {
        $.ajax({
            url: '/shop/index/info.html?shop_id={{ $shop_info['shop']['shop_id'] }}',
            dataType: 'json',
            success: function(result) {
                var is_collect = result.data.is_collect;
                var collect_count = result.data.collect_count;
                var duration_time = result.data.duration_time;
                if (is_collect == false) {
                    $(".collect-btn").html("关注本店");
                    $(".collect-tip").html("关注");
                } else {
                    $(".collect-btn").html("取消关注");
                    $(".collect-tip").html("已关注");
                }
                $('.duration-time').html(duration_time);
                $(".collect-count").html(collect_count);
                if(result.data.show_collect_count == 1 && collect_count > 0){
                    $(".collect-tip").show();
                    $(".collect-count").show();
                }else{
                    $(".collect-tip").hide();
                    $(".collect-count").hide();
                }
            }
        });
        //加入购物车
        $('body').on('click', '.add-cart', function(event) {
            var goods_id = $(this).data('goods_id');
            var image_url = $(this).data('image_url');
            var buy_enable = $(this).data("buy-enable");
            if(buy_enable){
                $.msg(buy_enable);
                return false;
            }
            $.cart.add(goods_id, 1, {
                is_sku: false,
                image_url: image_url,
                event: event,
                callback: function() {
                    var attr_list = $('.attr-list').height();
                    $('.attr-list').css({
                        "overflow": "hidden"
                    });
                    if (attr_list >= 200) {
                        $('.attr-list').addClass("attr-list-border");
                        $('.attr-list').css({
                            "overflow-y": "auto"
                        });
                    }
                }
            });
            return false;
        });
    });
    $('#shop_header_yikf').click(function(){
        $('#from_shop_yikf').submit();
    })
    // 
    $().ready(function() {
        $('.site_to_yikf').click(function() {
            $(this).parent('form').submit();
        })
    });
    // 
    $().ready(function() {
        // 缓载图片
        $.imgloading.loading();
        //图片预加载
        document.onreadystatechange = function() {
            if (document.readyState == "complete") {
                $.imgloading.setting({
                    threshold: 1000
                });
                $.imgloading.loading();
            }
        }
    });
    // 
</script>
</body>
</html>
