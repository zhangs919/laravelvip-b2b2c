@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link href="/css/swiper.min.css" rel="stylesheet">
@stop

@section('content')

    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">物流详情</div>
            <div class="header-right">
                <!-- 控制展示更多按钮 -->
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);">
                            <i class="iconfont">&#xe6cd;</i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </header>
    @foreach($express as $key=>$item)
    <div class="content-info m-t-0" id="con_status_{{ $key+1 }}" >
        <div class="about-good-box">
            <dl class="about-good-info">
                <dd>
                <span>
                    物流方式：
                    {{ $item['shipping_type_format'] }}
                </span>
                    @if($item['shipping_type'] == 3){{--第三方物流--}}
                    <span>
                    物流公司：
                    {{ $item['info']['shipping_name'] }}
                </span>
                    <span>运单号码：{{ $item['info']['express_sn'] }}</span>
                    <span>
                    官方快递查询：
                    <a href="{{ $item['info']['site_url'] ?? 'javascript:;' }}" target="_blank"
                       title="点击进入{{ $item['info']['shipping_name'] }}官方网站" class="color">{{ $item['info']['shipping_name'] }}官网</a>
                </span>
                    @else{{--0 无需物流 1 指派 2 众包--}}

                    @endif
                </dd>
            </dl>
            <div class="good-pic-swiper">
                <div class="swiper-wrapper">
                    @foreach($item['info']['goods_list'] as $goods)
                    <div class="about-good-pic swiper-slide">
                        <a href="/{{ $goods['sku_id'] }}.html" title="{{ $goods['sku_name'] }}">
                            <img src="{{ $goods['sku_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="" />
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <script type="text/javascript">
                // 
            </script>
        </div>
        <div class="logistics-box">
            <h2>物流跟踪</h2>
            @if($item['error'] > 0)
                <div class="no-data-div">
                    <div class="no-data-img">
                        <img src="/images/bg_empty_data.png" />
                    </div>
                    <dl>
                        <dt>{!! $item['content']['list'][0]['msg'] !!}</dt>
                    </dl>
                </div>
            @else
                <ul>
                    @foreach($item['content']['list'] as $ck=>$content)
                        <li class="@if($ck == 0){{ 'first' }}@endif">
                            <p>{!! $content['msg'] !!}</p>
                            <p>{{ $content['time'] }}</p>
                            <span class="before"></span>
                            <span class="after"></span>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
    @endforeach
    <script type="text/javascript">
        // 
    </script>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        // 
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/js/iscroll-probe.min.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        var mySwiper;
        $(function(){
            mySwiper = new Swiper('.good-pic-swiper',{
                slidesPerView : 'auto',
                touchRatio : 1,
            });
        });
        // 
        function setTab(name, cursel, n) {
            for (i = 1; i <= n; i++) {
                var menu = $("#" + name + i);
                var con = $("#con_" + name + "_" + i);
                if (i == cursel) {
                    $(con).show();
                    $(menu).addClass("cur");
                } else {
                    $(con).hide();
                    $(menu).removeClass("cur");
                }
            }
        }
        $('#good-logistics ul li').click(function(){
            $(this).addClass('cur').siblings().removeClass('cur');
            var b = $(window).width();
            var d = $("#good-logistics li.cur").offset().left;
            var liTotalWidth1 = 0;
            $('#good-logistics ul li').each(function(){
                liTotalWidth1 += $(this).width()+40;
            });
            var c = liTotalWidth1;
            var a = c - $("#good-logistics").width();
            if(a>0){
                if (d < a) {
                    logisticsScroll.scrollTo(-d,0,200);
                } else {
                    logisticsScroll.scrollTo(-a,0,200);
                }
            }
        });
        window.onload = function(){
            if($("#good-logistics .scroll").length>0){
                initLogisticsScroll();
            }
        };
        var liTotalWidth = 0;
        var logisticsScroll;
        function initLogisticsScroll() {
            $('#good-logistics ul li').each(function(){
                liTotalWidth += $(this).width()+45;
            });
            $('#good-logistics ul').css({
                'width': liTotalWidth+'px'
            });
            if(logisticsScroll instanceof IScroll ) {
                logisticsScroll.destroy();
            }
            var scrollwidth = 0;
            logisticsScroll = new IScroll('#good-logistics .scroll',  {
                'mouseWheel': true,
                'scrollX': true,
                'scrollY': false,
                'click': true,
                'interactiveScrollbars': true
            },200);
        }
        // 
        $().ready(function () {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('7272') }}",
                type: "add_point_set"
            });
        });

        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        // 
    </script>

@stop