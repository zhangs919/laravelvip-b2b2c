@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/city.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content"><!--站点 start-->
        <!--   -->
        <!--   -->
        <!--   -->
        <!--   -->
        <!--   -->
        <!--   -->
        <!--   -->
        <!--   -->
        <!--   -->
        <!--   -->
        <script type="text/javascript">
            //
        </script>
        <header class="header fixed-header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">选择站点</div>
        </header>
        <ul class="cl-c-letter">
            <li data-key="B">
                <span>B</span>
            </li>
            <li data-key="Q">
                <span>Q</span>
            </li>
            <li data-key="S">
                <span>S</span>
            </li>
            <li data-key="T">
                <span>T</span>
            </li>
        </ul>
        <div class="cl-container">
            <div class="current-city">
                <div class="">
                    <span>当前站点</span>
                </div>
                <ul class="cl-c-l-ul current-city-ul">
                    <li class="cl-c-l-li">
                        <a href="/subsite/index.html?site_id=2&back_url=https://m.lrw.com">北京站</a>
                    </li>
                </ul>
            </div>
            <div class="cl-c-list">
                <div class="cl-c-l-h" id="letter-B">
                    <div class="">
                        <span>B</span>
                    </div>
                </div>
                <ul class="cl-c-l-ul">
                    <li class="cl-c-l-li">
                        <a href="/subsite/index.html?site_id=2&back_url=https://m.lrw.com">北京站</a>
                    </li>
                </ul>
                <div class="cl-c-l-h" id="letter-Q">
                    <div class="">
                        <span>Q</span>
                    </div>
                </div>
                <ul class="cl-c-l-ul">
                    <li class="cl-c-l-li">
                        <a href="/subsite/index.html?site_id=1&back_url=https://m.lrw.com">秦皇岛</a>
                    </li>
                </ul>
                <div class="cl-c-l-h" id="letter-S">
                    <div class="">
                        <span>S</span>
                    </div>
                </div>
                <ul class="cl-c-l-ul">
                    <li class="cl-c-l-li">
                        <a href="/subsite/index.html?site_id=13&back_url=https://m.lrw.com">上海站</a>
                    </li>
                </ul>
                <div class="cl-c-l-h" id="letter-T">
                    <div class="">
                        <span>T</span>
                    </div>
                </div>
                <ul class="cl-c-l-ul">
                    <li class="cl-c-l-li">
                        <a href="/subsite/index.html?site_id=3&back_url=https://m.lrw.com">天津站</a>
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
        <!--站点 end-->
    </div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 底部 _end-->
    <script type="text/javascript">
        //
    </script>
    <!-- 积分提醒 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/js/zepto.js"></script>
    <script src="/js/city.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        var $data = '{"\u5317\u4eac\u7ad9":{"city_name":"\u5317\u4eac\u7ad9"},"\u79e6\u7687\u5c9b":{"city_name":"\u79e6\u7687\u5c9b"},"\u4e0a\u6d77\u7ad9":{"city_name":"\u4e0a\u6d77\u7ad9"},"\u5929\u6d25\u7ad9":{"city_name":"\u5929\u6d25\u7ad9"}}';
        //
        new touch.CitySearch({
            data: jQuery.parseJSON($data)
        });
        new touch.CityList({});
        //
        $().ready(function() {
            // 缓载图片
            $.imgloading.loading();
        });
        //
        $().ready(function(){
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