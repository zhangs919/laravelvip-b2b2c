@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')
@stop


@section('content')

    <header>
        <div class="tab_nav">
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">
                    关闭余额支付密码
                </div>
                <div class="header-right">
                    <!-- 控制展示更多按钮 -->
                    <aside class="show-menu-btn">
                        <div class="show-menu" id="show_more">
                            <a href="javascript:void(0)">
                                <i class="iconfont">&#xe6cd;</i>
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </header>
    <div class="content-info m-t-0">
        <div id="safe-info" class="safe-con">
            {{--include file--}}
            @include('user.security.edit_password_1')
        </div>
    </div>
    <!-- 验证码脚本 -->

    <script type="text/javascript">
        //
    </script>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    {{--引入版权信息--}}
    {{--    @include('frontend.web_mobile.modules.library.copy_right')--}}
    <script type="text/javascript">
        //
    </script>
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
    <script src="/js/app.frontend.mobile.min.js?v=20201016"></script>
    <script src="/js/user.js?v=20201016"></script>
    <script src="/js/address.js?v=20201016"></script>
    <script src="/js/center.js?v=20201016"></script>
    <script src="/js/jquery.fly.min.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20201016"></script>
    <script src="/assets/d2eace91/js/jquery.captcha.js?v=20201016"></script>
    <script src="/js/login.js?v=20201016"></script>
    <script src="/assets/d2eace91/min/js/message.min.js?v=20201016"></script>
    <script>
        if ('1' == '') {
            load_form();
        }
        function load_form(type) {
            var url = '/user/security/validate.html';
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                data: {
                    type: type
                },
                success: function(result) {
                    if (result.code == 0) {
                        $("#safe-info").html(result.data);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        }
        $('body').on('click', '.select-layer-info li', function() {
            $(this).addClass('seleted').siblings().removeClass('seleted');
            $('.select-layer').addClass('hide');
            load_edit($(this).data('value'));
        });
        $('body').on('click', '#cancel', function() {
            $('.select-layer').addClass('hide');
        });
        function load_edit(type) {
            var service_type = '{{ $service_type }}';
            var s_type = service_type.replace(/_/g, '-');
            $.ajax({
                type: 'GET',
                url: '/user/security/' + s_type + '.html',
                data: {
                    type: type
                },
                dataType: 'json',
                success: function(result) {
                    if(result.code == 0){
                        load_form(type);
                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        }


        //
        /**
         $().ready(function(){
        WS_AddUser({
            user_id: 'user_{{ $user_info['user_id'] ?? 0 }}',
            url: "{{ get_ws_url('4431') }}",
            type: "add_user"
        });
    });
         **/
        function currentUserId(){
            return "{{ $user_info['user_id'] ?? 0 }}";
        }
        function getIntegralName(){
            return '积分';
        }
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == currentUserId()) {
                    $.intergal({
                        point: ob.point,
                        name: getIntegralName()
                    });
                }
            }
        }
        //
        function go_laravelvip() {
            if (window.__wxjs_environment !== 'miniprogram') {
                window.location.href = 'http://m.laravelvip.com/statistics.html?product_type=shop&domain=http://{{ config('lrw.mobile_domain') }}';
            } else {
                window.location.href = 'http://{{ config('lrw.mobile_domain') }}';
            }
        }
        function GetUrlRelativePath(){
            var url = document.location.toString();
            var arrUrl = url.split("//");
            var start = arrUrl[1].indexOf("/");
            var relUrl = arrUrl[1].substring(start);
            if(relUrl.indexOf("?") != -1){
                relUrl = relUrl.split("?")[0];
            }
            if(relUrl.indexOf(".htm") != -1){
                relUrl = relUrl.split(".htm")[0];
            }
            return relUrl;
        }
        var hide_list = ['/bill','/bill.html','/user/order/bill-list','/user/scan-code/index','/user/sign-in/info'];
        if($.inArray(GetUrlRelativePath(), hide_list) == -1){
            $('.copyright').removeClass('hide');
        }
        //
    </script>
@stop
