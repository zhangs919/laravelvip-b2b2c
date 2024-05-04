@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')
@stop


@section('content')

    <section id="account-content">
        <header class="header-top-nav">
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">积分明细</div>
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
        <ul class="exchange-list-top ub tabmenu-new">
            <li class="ub-f1">
                <a href="/user/integral/detail.html" class="active">积分明细</a>
            </li>
            <li class="ub-f1">
                <a href="/user/integral/order-list.html">积分兑换</a>
            </li>
        </ul>
        <div class="exchange-list">
            <div class="exchange-user-detail">
                <dl>
                    <dt>线上可用积分</dt>
                    <dd>
                        <em class="second-color SZY-PAY-POINT"></em>
                    </dd>
                </dl>
                <dl>
                    <dt>线上冻结积分</dt>
                    <dd>
                        <em class="second-color SZY-FROZEN-POINT"></em>
                    </dd>
                </dl>
                <dl>
                    <dt>线下会员积分</dt>
                    <dd>
                        <em class="second-color ERP-PAY-POINT">0</em>
                    </dd>
                </dl>
                <a href="javascript:void(0);" title="查看各商家账户积分" class="go-info-btn see-btn">查看各商家账户积分</a>
            </div>

            @include('user.integral.partials._detail')

        </div>
    </section>
    <div id="see-account-content-container">
    </div>
    <script type="text/javascript">
        //
    </script>
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
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=1.1"></script>
    <script src="/js/common.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/js/placeholder.js?v=1.1"></script>
    <script src="/js/user.js?v=1.1"></script>
    <script src="/js/address.js?v=1.1"></script>
    <script src="/js/center.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/message.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/messageWS.js?v=1.1"></script>
    <script>
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
            //ajax校验
            $.get('/integralmall/index/validate', function(result) {
                if (result.code == 0) {
                    $('.SZY-TOTAL-POINT').html(result.data);
                    $('.SZY-PAY-POINT').html(result.pay_point);
                    $('.SZY-FROZEN-POINT').html(result.frozen_point);
                }
            }, 'json');
            $.ajax({
                url: '/user/capital-account/get-data',
                dataType: 'json',
                success: function(data) {
                    $('.ERP-PAY-POINT').html(data.points);
                }
            });
        });
        //
        // 滚动加载数据
        $(window).on('scroll', function() {
            if (($(document).scrollTop() + $(window).height() + 100) > $(document).height()) {
                if ($.isFunction($.pagemore)) {
                    $.pagemore();
                }
            }
        });
        $('#sync-btn').click(function() {
            //ajax校验
            var status = $('#sync-btn').attr('status');
            if (status != 1) {
                $('#sync-btn').attr('status', '1');
                $.post('/user/integral/sync-integral', {}, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 3000
                        }, function() {
                            location.reload();
                        })
                    } else {
                        $.msg(result.message, {
                            time: 3000
                        }, function() {
                            $('#sync-btn').attr('status', '0');
                        })
                    }
                }, 'json');
            }
        })
        $("body").on("click", ".see-btn", function() {
            $.post('/user/integral/view.html', {}, function(result) {
                $('#see-account-content-container').html(result.data);
                $('#account-content').hide();
            }, 'json');
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
