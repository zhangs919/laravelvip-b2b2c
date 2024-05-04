@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')
@stop


@section('content')

    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">账户安全</div>
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
    <section>
        <div class="safe-box">
            <div class="operat-tips">建议您启动全部安全设置，以保障账户及资金安全</div>
            <div class="middle-content">
                <div class="safe-list">
                    <a href="/user/security/edit-password.html">
                        <i class="iconfont safe-icon yes-open">&#xe62c;</i>
                        <h4>登录密码</h4>
                        <p>已设置登录密码。</p>
                        <i class="iconfont right-icon">&#xe607;</i>
                    </a>
                </div>
                @if(empty($user_info->mobile))
                    <div class="safe-list">
                        <a href="/user/security/edit-mobile.html">
                            <i class="iconfont safe-icon no-open"></i>
                            <h4>手机验证</h4>
                            <p>
                                绑定后，可用于账号登录，快速找回登录密码、支付密码，接收账户余额变动提醒等。                     </p>
                            <i class="iconfont right-icon"></i>
                        </a>
                    </div>
                @else
                    <div class="safe-list">
                        <a href="/user/security/edit-mobile.html">
                            <i class="iconfont safe-icon yes-open"></i>
                            <h4>手机验证</h4>
                            <p>
                                您绑定的手机：
                                <font class="color">{{ hide_tel($user_info->mobile) }}</font>
                                ，该手机可用于账号登录，快速找回登录密码、支付密码，接收账户余额变动提醒等。                     </p>
                            <i class="iconfont right-icon"></i>
                        </a>
                    </div>
                @endif

                @if(empty($user_info->email))
                    <div class="safe-list">
                        <a href="/user/security/edit-email.html">
                            <i class="iconfont safe-icon no-open">&#xe64f;</i>
                            <h4>邮箱验证</h4>
                            <p>
                                绑定后，可用于账号登录，快速找回登录密码、支付密码，接收账户余额变动提醒等。                     </p>
                            <i class="iconfont right-icon">&#xe607;</i>
                        </a>
                    </div>
                @else
                    <div class="safe-list">
                        <a href="/user/security/edit-mobile.html">
                            <i class="iconfont safe-icon yes-open"></i>
                            <h4>邮箱验证</h4>
                            <p>
                                您绑定的邮箱：
                                <font class="color">{{ $user_info->email }}</font>
                                ，该邮箱可用于账号登录，快速找回登录密码、支付密码，接收账户余额变动提醒等。                     </p>
                            <i class="iconfont right-icon"></i>
                        </a>
                    </div>
                @endif

                @if(empty($user_info->surplus_password))
                    <div class="safe-list">
                        <a  href="/user/security/edit-surplus-password.html">
                            <i class="iconfont safe-icon no-open">&#xe64f;</i>
                            <h4>支付密码</h4>
                            <p>启用支付密码后，可保障您账户余额的支付安全,在使用账户资产时，需通过支付密码进行支付认证。</p>
                            <i class="iconfont right-icon">&#xe607;</i>
                        </a>
                    </div>
                @else
                    <div class="safe-list">
                        <a id="btn" href="javascript:void(0)">
                            <i class="iconfont safe-icon yes-open"></i>
                            <h4>支付密码</h4>
                            <p>启用支付密码后，可保障您账户余额的支付安全,在使用账户资产时，需通过支付密码进行支付认证。</p>
                            <i class="iconfont right-icon"></i>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!-- 管理支付密码弹框 _star -->
    <div id="modal-box" style="display: none">
        <div class="modal-box-con pay-info">
            <p class="end-info">您的支付密码已开启！</p>
            <p>
                <a href="/user/security/close-surplus-password.html" title="关闭支付密码" class="btn">关闭支付密码</a>
                <a href="/user/security/edit-surplus-password.html" title="修改支付密码" class="btn">修改支付密码</a>
            </p>
            <p>
                <a href="/user/security/edit-surplus-password.html" title="前去找回密码">忘记支付密码？</a>
            </p>
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>
    <!-- 管理支付密码弹框 _end -->

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
    <script src="/assets/d2eace91/min/js/message.min.js?v=20201016"></script>
    <script>
        $("#btn").click(function() {
            layer.open({
                type: 1,
                content: $('#modal-box').html()
            });
        });
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
