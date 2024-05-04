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
            <div class="header-middle">退货换货</div>
            <div class="header-right">

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
    <div class="back-info-content">

        @if(in_array($back_info['back_type'], [1,2]))
            <!-- 提交仅退款申请后的页面 _start -->
            <div class="content-status">
                <dl class="user-status-imfor ub">
                    <dt class="imfor-icon">
                        <img src="/images/warning.png">
                    </dt>
                    <dd class="imfor-title ub-f1">
                        <h3>等待卖家处理{{ $service_name }}申请</h3>
                    </dd>
                </dl>
                <ul class="user-status-prompt">
                    <li>
                        <span>如果卖家同意：</span>
                        申请将达成并退款
                    </li>
                    <li>
                        <span>如果卖家拒绝：</span>
                        可与卖家协商修改{{ $service_name }}申请，若协商不成可申请平台方介入
                    </li>
                    <li>
                        <span>如果卖家未处理：</span>
                        超过
                        <strong class="color" id="counter_confirm"></strong>
                        {{ $service_name }}申请将自动达成
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#counter_confirm").countdown({
                                    time: "{{ $back_info['counter'] }}",
                                    leadingZero: true,
                                    onComplete: function (event) {
                                        $(this).html("已超时！");

                                        // 超时事件，预留
                                        $.ajax({
                                            type: 'GET',
                                            url: '/user/back/confirm-sys.html',
                                            data: {
                                                back_id: '{{ $back_info['back_id'] }}'
                                            },
                                            dataType: 'json',
                                            success: function (data) {
                                                if (data.code == 0) {
                                                    window.location.reload();
                                                }
                                            }
                                        });
                                    }
                                });
                            });
                        </script>

                    </li>
                </ul>
                <div class="user-status-operate ub">
                    <a href="javascript:_edit('{{ $back_info['back_id'] }}',1)" class="return-apply ub-f1">修改{{ $service_name }}申请</a>
                    <a href="javascript:_cancel('{{ $back_info['back_id'] }}',1)" class="return-apply ub-f1">撤销{{ $service_name }}申请</a>
                </div>
            </div>
            <!-- 提交仅退款申请后的页面 _end -->


            <!-- 买家撤销退款之后 _start -->
            @if($back_info['back_status'] == 7)
                <div class="content-status">
                    <dl class="user-status-imfor ub">
                        <dt class="imfor-icon">
                            <img src="/images/warning.png">
                        </dt>
                        <dd class="imfor-title ub-f1">
                            <h3>已撤销{{ $service_name }}申请</h3>
                        </dd>
                    </dl>
                    <ul class="user-status-prompt">
                        <li>
                            <span>撤销时间：</span>
                            {{ $back_info['updated_at'] }}
                        </li>
                    </ul>
                    <div class="user-status-operate ub">
                        <a href="/user/back/apply?id={{ $back_info['back_id'] }}&record_id={{ $back_info['record_id'] }}&gid={{ $back_info['goods_id'] }}&sid={{ $back_info['sku_id'] }}" class="return-apply ub-f1">再次申请{{ $service_name }}</a>
                    </div>
                </div>
            @endif
            <!-- 买家撤销退款之后 _end -->


            <!-- 退款失效之后 _start -->
            @if($back_info['back_status'] == 6)
                <div class="content-status">
                    <dl class="user-status-imfor ub">
                        <dt class="imfor-icon">
                            <img src="/images/warning.png">
                        </dt>
                        <dd class="imfor-title ub-f1">
                            <h3>因卖家超时未处理{{ $service_name }}申请，{{ $service_name }}已关闭，交易将正常进行</h3>
                        </dd>
                    </dl>
                </div>
            @endif
            <!-- 退款失效之后 _end -->


            <!-- 卖家拒绝退款申请 _start -->
            @if($back_info['back_status'] == 5)
                <div class="content-status">
                    <dl class="user-status-imfor ub">
                        <dt class="imfor-icon">
                            <img src="/images/warning.png">
                        </dt>
                        <dd class="imfor-title ub-f1">
                            <h3>卖家拒绝了您的{{ $service_name }}申请，请修改{{ $service_name }}信息。</h3>
                        </dd>
                    </dl>
                    <ul class="user-status-prompt">
                        <li>
                            <span>如果卖家同意：</span>
                            {{ $service_name }}申请将达成
                        </li>
                        <li>
                            <span>如果卖家拒绝：</span>
                            可与卖家协商修改{{ $service_name }}申请，若协商不成可申请平台方介入
                        </li>
                        <li>
                            如果您在
                            <strong class="color" id="counter_confirm"></strong>
                            前，未处理{{ $service_name }}信息，系统将自动取消{{ $service_name }}申请。
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#counter_confirm").countdown({
                                        time: "{{ $back_info['counter'] }}",
                                        leadingZero: true,
                                        onComplete: function (event) {
                                            $(this).html("已超时！");

                                            // 超时事件，预留
                                            $.ajax({
                                                type: 'GET',
                                                url: '/user/back/confirm-sys.html',
                                                data: {
                                                    back_id: '{{ $back_info['back_id'] }}'
                                                },
                                                dataType: 'json',
                                                success: function (data) {
                                                    if (data.code == 0) {
                                                        window.location.reload();
                                                    }
                                                }
                                            });
                                        }
                                    });
                                });
                            </script>

                        </li>
                    </ul>
                    <div class="user-status-operate ub">
                        <a href="javascript:_edit('{{ $back_info['back_id'] }}',1)" class="return-apply ub-f1">修改{{ $service_name }}申请</a>
                        <a href="javascript:_cancel('{{ $back_info['back_id'] }}',1)" class="return-apply ub-f1">撤销{{ $service_name }}申请</a>
                    </div>
                </div>
            @endif
            <!-- 卖家拒绝退款申请 _end -->


            <!-- 卖家已同意退款退货申请，等待买家寄回货物 _start -->
            <!-- 卖家已同意退款退货申请，等待买家寄回货物 _end -->


            <!-- 买家寄回货物已发出 _start -->
            <!-- 买家寄回货物已发出 _end -->


            <!-- 卖家已同意退款申请，等待平台方退款 _start -->
            <!-- 卖家已同意退款申请，等待平台方退款 _end -->


            <!-- 退款成功 _start -->
            @if($back_info['back_status'] == 4 && $back_info['back_type'] == 2)
                <div class="content-status">
                    <dl class="user-status-imfor ub">
                        <dt class="imfor-icon">
                            <img src="/images/common/success.png">
                        </dt>
                        <dd class="imfor-title ub-f1">
                            <h3>退款成功</h3>
                        </dd>
                    </dl>
                    <ul class="user-status-prompt">
                        <li>
                            <span>退款成功时间：</span>
                            {{ $back_info['updated_at'] }}
                        </li>
                        <li>
                            <span>退款金额：</span>
                            ￥{{ $back_info['refund_money'] }}
                        </li>
                    </ul>
                </div>
            @endif
            <!-- 退款成功 _end -->

        @elseif(in_array($back_info['back_type'], [3,4]))
            <!-- 提交仅退款申请后的页面 _start -->
            <div class="content-status">
                <dl class="user-status-imfor ub">
                    <dt class="imfor-icon">
                        <img src="/images/warning.png">
                    </dt>
                    <dd class="imfor-title ub-f1">
                        <h3>等待卖家处理{{ $service_name }}申请</h3>
                    </dd>
                </dl>
                <ul class="user-status-prompt">
                    <li>
                        <span>如果卖家同意：</span>
                        申请将达成并退款
                    </li>
                    <li>
                        <span>如果卖家拒绝：</span>
                        可与卖家协商修改{{ $service_name }}申请，若协商不成可申请平台方介入
                    </li>
                    <li>
                        <span>如果卖家未处理：</span>
                        超过
                        <strong class="color" id="counter_confirm"></strong>
                        {{ $service_name }}申请将自动达成
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#counter_confirm").countdown({
                                    time: "{{ $back_info['counter'] }}",
                                    leadingZero: true,
                                    onComplete: function (event) {
                                        $(this).html("已超时！");

                                        // 超时事件，预留
                                        $.ajax({
                                            type: 'GET',
                                            url: '/user/back/confirm-sys.html',
                                            data: {
                                                back_id: '{{ $back_info['back_id'] }}'
                                            },
                                            dataType: 'json',
                                            success: function (data) {
                                                if (data.code == 0) {
                                                    window.location.reload();
                                                }
                                            }
                                        });
                                    }
                                });
                            });
                        </script>

                    </li>
                </ul>
                <div class="user-status-operate ub">
                    <a href="javascript:_edit('{{ $back_info['back_id'] }}',1)" class="return-apply ub-f1">修改{{ $service_name }}申请</a>
                    <a href="javascript:_cancel('{{ $back_info['back_id'] }}',1)" class="return-apply ub-f1">撤销{{ $service_name }}申请</a>
                </div>
            </div>
            <!-- 提交换货申请后的页面 _end -->


            <!-- 买家撤销退款之后 _start -->

            <!-- 买家撤销退款之后 _end -->



            <!-- 退款失效之后 _start -->

            <!-- 退款失效之后 _end -->



            <!-- 卖家已同意换货申请 _start -->

            <!-- 卖家已同意退款退货申请，等待买家寄回货物 _end -->


            <!-- 换货成功 _start -->

            <!-- 卖家已同意退款退货申请，等待买家寄回货物 _end -->
        @endif

        <a class="consult-record-title" href="javascript:void(0)">
            <h3>协商记录</h3>
        </a>
        <div class="consult-record-message" style="display: none;">
            <ul>

                @if(!empty($back_logs))
                    @foreach($back_logs as $log)
                        <li class="bdr-bottom">
                            <div class="message-hd">
                                <div class="head">
                                    <img src="{{ get_image_url($log['headimg']) }}">
                                </div>
                                <div class="user-info">
                                    <span class="name">{{ $log['title'] }}</span>
                                    <span class="time">{{ format_time($log['add_time']) }}</span>
                                </div>
                                <div class="msg">
                                    {!! $log['contents'] !!}
                                </div>
                            </div>

                            <div class="message-bd">

                            </div>

                        </li>
                    @endforeach
                @endif

            </ul>
        </div>

        <div class="blank-div"></div>
        <div class="content-imfor">
            <div class="imfor-title">
                <h3>退款申请</h3>
            </div>
            <ul class="back-info-ul">
                <li>
                    <div class="imfor-dt">店铺名称：</div>
                    <div class="imfor-dd">{{ $shop_info['shop']['shop_name'] }}</div>
                </li>
                <li>
                    <div class="imfor-dt">退款类型：</div>
                    <div class="imfor-dd">仅退款</div>
                </li>
                <li>
                    <div class="imfor-dt">退款金额：</div>
                    <div class="imfor-dd">￥{{ $back_info['refund_money'] }}</div>
                </li>
                <li>
                    <div class="imfor-dt">退款原因：</div>
                    <div class="imfor-dd">{{ format_refund_reason($back_info['back_reason']) }}
                    </div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">退款方式：</div>
                    <div class="imfor-dd">{{ format_refund_type($back_info['refund_type']) }}</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">退款编号：</div>
                    <div class="imfor-dd">{{ $back_info['back_sn'] }}</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">申请时间：</div>
                    <div class="imfor-dd">{{ $back_info['created_at'] }}</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">退款说明：</div>
                    <div class="imfor-dd">
                        {!! $back_info['back_desc'] !!}
                    </div>
                </li>
                <li>
                    <a href="javascript:;" class="get-more-info">
                        <span>更多</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->


    <script type="text/javascript">
        //
    </script>
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $('.consult-record-title').click(function () {
            $('.consult-record-message').slideToggle();
        })
        $('.get-more-info').click(function () {
            $('.back-info-ul li').each(function () {
                if ($(this).hasClass('hide')) {
                    $(this).removeClass('hide');
                }
                $('.get-more-info').parent('li').addClass('hide');
            });
        });

        function _edit(back_id, send_id) {

            $.loading.start();
            $.get('/user/back/edit', {
                id: back_id,
                send_id: send_id
            }, function (result) {
                $.msg(result.message);
                if (result.code == 0) {
                    if (send_id == 2) {
                        window.location.href = "/user/back/edit-order?id=" + back_id + "&type=shipping";
                    } else {
                        window.location.href = "/user/back/edit?id=" + back_id;
                    }
                } else {
                    window.location.reload();
                }
            }, 'json');
        }

        function _cancel(back_id, send_id) {
            $.loading.start();
            $.post('/user/back/cancel', {
                id: back_id,
                send_id: send_id
            }, function (result) {
                $.msg(result.message);
                if (result.code == 0) {
                    window.location.href = "/user/back/info?id=" + back_id;
                } else {
                    window.location.reload();
                }
            }, 'json');
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
        function go_laravelvip() {
            if (window.__wxjs_environment !== 'miniprogram') {
                window.location.href = 'http://m.laravelvip.com/statistics.html?product_type=shop&domain=http://{{ config('lrw.mobile_domain') }}';
            } else {
                window.location.href = 'http://{{ config('lrw.mobile_domain') }}';
            }
        }

        function GetUrlRelativePath() {
            var url = document.location.toString();
            var arrUrl = url.split("//");
            var start = arrUrl[1].indexOf("/");
            var relUrl = arrUrl[1].substring(start);
            if (relUrl.indexOf("?") != -1) {
                relUrl = relUrl.split("?")[0];
            }
            if (relUrl.indexOf(".htm") != -1) {
                relUrl = relUrl.split(".htm")[0];
            }
            return relUrl;
        }

        var hide_list = ['/bill', '/bill.html', '/user/order/bill-list', '/user/scan-code/index', '/user/sign-in/info'];
        if ($.inArray(GetUrlRelativePath(), hide_list) == -1) {
            $('.copyright').removeClass('hide');
        }
        //
    </script>
@stop
