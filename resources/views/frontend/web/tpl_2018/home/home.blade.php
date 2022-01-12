@extends('layouts.base')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190121"></script>
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')
    @include('layouts.partials.follow_box')
@stop

@section('style_js')
    <!--页面css/js-->
    <link rel="stylesheet" href="/frontend/css/index.css?v=1.1"/>
    <link rel="stylesheet" href="/frontend/css/template.css?v=20180702"/>
    <script src="/frontend/js/index.js?v=1.1"></script>
    <script src="/frontend/js/tabs.js?v=1.1"></script>
    <script src="/frontend/js/bubbleup.js?v=1.1"></script>
    <script src="/frontend/js/jquery.hiSlider.js?v=1.1"></script>
    <script src="/frontend/js/index_tab.js?v=1.1"></script>
    <script src="/frontend/js/jump.js?v=1.1"></script>
    <script src="/frontend/js/nav.js?v=1.1"></script>
@stop



@section('content')


    <div class="template-one">

        <!-- banner模块 _start -->
        <div class="banner">

            <!-- banner轮播 _start -->
            <ul id="fullScreenSlides" class="full-screen-slides">

                @foreach($nav_banner as $v)
                    <li style="background: url('{{ get_image_url($v->banner_image) }}') center center no-repeat;  display:list-item; ">
                        <a href="{{ $v->banner_link ?? 'javascript:void(0)' }}" target="_blank" title="{{ $v->banner_name }}">{{ $v->banner_name ?? '&nbsp;' }}</a>
                    </li>
                @endforeach

            </ul>

            <ul class="full-screen-slides-pagination">

                @foreach($nav_banner as $k=>$v)
                    <li @if($k == 0) class="current" @endif>
                        <a href="javascript:void(0);">{{ $k }}</a>
                    </li>
                @endforeach

            </ul>
            <!-- banner轮播 _end -->


            <div class="right-sidebar  SZY-TEMPLATE-NAV-CONTAINER">




                {!! $navContainerHtml !!}




            </div>

            <!-- banner背景图 _start -->
            <!-- <div class="banner-bg">
        	<a href="" target="_blank" class="banner-bg-img" style="background: url(Array) no-repeat 50% 0;"></a>
        </div>-->

            {{--<div class="banner-bg-left">
                <a href="javascript:void(0)"  target="_blank" class="banner-bg-img">
                    <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/images/system/config/nav_banner_site/site_nav_banner_bgimg_left.jpg" />
                </a>
            </div>


            <div class="banner-bg-right">
                <a href="javascript:void(0)" target="_blank" class="banner-bg-img">
                    <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/images/system/config/nav_banner_site/site_nav_banner_bgimg_right.jpg" />
                </a>
            </div>--}}

            <!-- banner背景图 _end -->
        </div>
        <!-- banner模块 _end -->
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".time-remain").each(function(i) {
                var time = $(this).data("time");
                time = parseInt(time) * 1000  - new Date().getTime();
                $(this).countdown({
                    time: time,
                    htmlTemplate: '<span><em class="bg-color">%{d}</em> 天 <em class="bg-color">%{h}</em> 小时 <em class="bg-color">%{m}</em> 分 <em class="bg-color">%{s}</em> 秒</span>',
                    leadingZero: true,
                    onComplete: function(event) {
                        $(this).html("活动已经结束啦!");
                    }
                });
            });

            //加入购物车
            $('body').on('click', '.add-cart', function(event) {
                var goods_id = $(this).data('goods_id');
                var image_url = $(this).data('image_url');
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
            });
        });
    </script>

    <div class="template-one">
        <div class="floor"></div>

        <!--模块内容-->
        <!-- #tpl_region_start -->
        {{--商城悬浮广告模板 特殊处理 无论静态页面开启与否 都加载出来--}}

        {!! $tplHtml !!}



        <!-- #tpl_region_end -->

        <!-- 左侧楼层定位 _start-->
        <div class="elevator">
            <div class="elevator-floor">
            </div>
        </div>
    </div>

    <style>
        .drop-item:hover {
            border: 0px
        }
    </style>

    @if(!$webStatic)
    <script type="text/javascript">
        $.templateloading();
    </script>
    @endif
@stop