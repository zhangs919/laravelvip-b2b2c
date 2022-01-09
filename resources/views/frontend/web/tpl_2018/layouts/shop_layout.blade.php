{{--店铺模板--}}
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
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=20180702"/>
    <link rel="stylesheet" href="/frontend/css/common.css?v=20180702"/>
    <link rel="stylesheet" href="/frontend/css/shop_index.css?v=20180702"/>
    <link rel="stylesheet" href="/frontend/css/template.css?v=20180702"/>

    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="/frontend/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/frontend/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->
    <!-- ================== END BASE CSS STYLE ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/yii.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180710"></script>
    <script src="/frontend/js/common.js?v=20180710"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180710"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180710"></script>
</head>
<body>
<!-- 引入头部文件 -->
<!-- 引入头部文件 -->
<script src="/frontend/js/index.js?v=20180710"></script>
<script src="/frontend/js/tabs.js?v=20180710"></script>
<script src="/frontend/js/bubbleup.js?v=20180710"></script>
<script src="/frontend/js/jquery.hiSlider.js?v=20180710"></script>
<script src="/frontend/js/index_tab.js?v=20180710"></script>
<script src="/frontend/js/jump.js?v=20180710"></script>
<script src="/frontend/js/nav.js?v=20180710"></script>
<!-- 站点选择 -->
{{-- include header_top --}}
@include('layouts/partials/header_top')


{{-- include shop_header --}}
@section('shop_header')
    @include('layouts.partials.shop_header')
@show

{{--页面css/js--}}
@section('style_js')@show

<!-- 右侧客服 _start-->
<div class="customer-service-box">
    <div class="box-content">
        <div class="box-small">


            <div class="customer-service">
				<span class="ww-light">

					<!-- 旺旺不在线 i 标签的 class="ww-offline" -->






                    <!-- s等于1时带文字，等于2时不带文字 -->
                    <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&groupid=0&charset=utf-8">
                        <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                        <span></span>
                    </a>







				</span>
                <span class="text">客服</span>
            </div>

        </div>
        <div class="box-large">
            <ul>
                <li class="service-item">
                    <a href="" rel="nofollow" class="color">{{ $shop_info['shop']['shop_name'] }}</a>
                    <span class="ww-light">
						<!-- 旺旺不在线 i 标签的 class="ww-offline" -->






                        <!-- s等于1时带文字，等于2时不带文字 -->
                        <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&groupid=0&charset=utf-8">
                            <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                            <span></span>
                        </a>





                        <!-- -->
					</span>
                </li>

                <li class="service-item">
                    <h4>在线客服</h4>
                    <ul class="service-info">

                        <li class="group clearfix">
                            <span>售前客服</span>
                            <div class="customer-info">


                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=xxxxxx&site=qq&menu=yes" class="ww-inline service-btn-qq">
                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:xxxxxx:51" alt="QQ" title="点击这里给我发消息" style="height: 20px;"/>
                                </a>
                                </br>


                            </div>
                        </li>

                        <li class="group clearfix">
                            <span>售后客服</span>
                            <div class="customer-info">


                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=xxxxxx&site=qq&menu=yes" class="ww-inline service-btn-qq">
                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:xxxxxx:51" alt="QQ" title="点击这里给我发消息" style="height: 20px;"/>
                                </a>
                                </br>


                            </div>
                        </li>

                        <!---->
                    </ul>
                </li>


                <li class="service-item">
                    <h4>工作时间</h4>
                    <ul class="service-info">
                        <li>
                            <span>{!! $shop_info['shop']['service_hours'] !!}</span>
                        </li>
                    </ul>
                </li>



            </ul>
        </div>
    </div>
</div>
<!-- 右侧客服_end -->

{{--店铺导航--}}
<div class="layout">





    <div class="shop-menu" @if(!empty(shopconf('nav_bgcolor', false, $shop_info['shop']['shop_id']))) style='background-color:{{ shopconf('nav_bgcolor', false, $shop_info['shop']['shop_id']) }};' @endif>
        <div class="shop-menu-box">
            <ul class="shop-menu-left">
                <li>
                    <a href="{{ route('pc_shop_home', ['shop_id' => $shop_info['shop']['shop_id']]) }}" target="">首页</a>
                </li>
                <li class="all-category">
                    <a href="{{ route('pc_shop_goods_list', ['filter_str' => $shop_info['shop']['shop_id']]) }}" target="">
                        全部分类
                        <span class="arrow"></span>
                    </a>
                    <div class="all-category-coupon">

                        <!-- 获取店铺内商品分类 -->





                        <dl>
                            <dt>
                                <a href="{{ route('pc_shop_goods_list', ['filter_str' => $shop_info['shop']['shop_id'].'-0']) }}" target="_blank">全部商品 ></a>
                            </dt>
                            <dd>
                                <ul>


                                </ul>
                            </dd>
                        </dl>


                        @foreach($shop_category_list as $v)
                            <dl>
                                <dt>
                                    <a href="{{ route('pc_shop_goods_list', ['filter_str' => $shop_info['shop']['shop_id'].'-'.$v['cat_id']]) }}" target="_blank">{{ $v['cat_name'] }} ></a>
                                </dt>
                                <dd>
                                    <ul>

                                        @if(!empty($v['_child']))
                                            @foreach($v['_child'] as $child)
                                                <li>
                                                    <a href="{{ route('pc_shop_goods_list', ['filter_str' => $shop_info['shop']['shop_id'].'-'.$child['cat_id']]) }}" target="_blank">{{ $child['cat_name'] }}</a>
                                                </li>
                                            @endforeach
                                        @endif

                                    </ul>
                                </dd>
                            </dl>
                        @endforeach


                    </div>
                </li>
                <!-- 获取店铺导航 -->
            </ul>
            <ul class="shop-menu-right">


                @foreach($shop_navigation as $v)
                    <li class="shop-nav">

                        <a href="{{ $v->nav_link }}" target="@if($v->new_open == 1) _blank @else _self @endif">{{ $v->nav_name }}</a>

                    </li>
                @endforeach


            </ul>
        </div>
    </div>
</div>
<script type='text/javascript'>
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
                if ($(obj).html() == "收藏本店") {
                    $(obj).html("取消收藏");
                    $(".collect-tip").html("已收藏");
                } else {
                    $(obj).html("收藏本店");
                    $(".collect-tip").html("收藏");
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
</script>
<script type="text/javascript">
    $().ready(function() {
        $.ajax({
            url: '/shop/index/info.html?shop_id={{ $shop_info['shop']['shop_id'] }}',
            dataType: 'json',
            success: function(result) {
                var is_collect = result.data.is_collect;
                var collect_count = result.data.collect_count;
                var duration_time = result.data.duration_time;
                if (is_collect == false) {
                    $(".collect-btn").html("收藏本店");
                    $(".collect-tip").html("收藏");
                } else {
                    $(".collect-btn").html("取消收藏");
                    $(".collect-tip").html("已收藏");
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
</script>


{{--content--}}
@yield('content')




{{-- include right_sidebar --}}
@include('layouts.partials.right_sidebar')



{{-- include common footer --}}
@section('common_footer')
    @include('layouts.partials.common_footer')
@show


</body>
<script src="/assets/d2eace91/js/design/shop_index.js?v=20180710"></script>
<script src="/frontend/js/jquery.fly.min.js?v=20180710"></script>
<script src="/assets/d2eace91/js/szy.cart.js?v=20180710"></script>
<script type="text/javascript">
    $().ready(function(){
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
</script>

<script>
    /* TODO 设置 Ajax LARAVEL 419 POST error */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</html>