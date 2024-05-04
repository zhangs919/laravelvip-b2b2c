@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')
    <link href="/css/membercard.css" rel="stylesheet">
@stop

@section('content')
    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">会员卡</div>
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
    <div class="get-card-con">
        <div class="card-info"style="background-color:#00b0f0">
            <div class="card-info-hd">
                <h3 class="shop-name">
                    <img src="https://xxxx/images/shop/309/images/2019/01/25/15484069028906.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="shop-logo">
                    三只松鼠旗舰店
                </h3>
            </div>
            <div class="member-card-type">
                高级会员(VIP2)
                <em class="color">默认</em>
            </div>
            <div class="card-info-ft">
                <p class="card-time">
                    类型：
                    按规则发放
                </p>
                <div class="privilege-inner">
                    <p class="card-time">
                        有效期：
                        永久有效
                    </p>
                </div>
            </div>
            <div class="card-status">
                使用中
            </div>
        </div>
        <div class="user-card-con">
            <div class="user-logo">
                <img src="https://xxxx/images/">
            </div>
            <div class="user-info-item">
                <p>
                    lrw
                </p>
                <p>213123123123123</p>
            </div>
        </div>
        <div class="blank-div"></div>
        <!--会员权益-->
        <div class="member-benefits">
            <div class="member-benefits-title bdr-bottom">
                <i class="iconfont icon-zuanshi"></i>
                会员权益
            </div>
            <ul class="clearfix">
                <li>
                    <i class="iconfont discount"></i>
                    <p>2.00折</p>
                    <p>消费享2.00折</p>
                </li>
            </ul>
        </div>
        <div class='clearfix give-coupon-con'>
            <ul class="coupon-ul">
            </ul>
        </div>
        {{--<div class="give-gift-con">
            <div class="gift-con">
                <div class="gift-pic">
                    <img src="images/ceshi.jpg" alt="">
                </div>
                <div class="gift-info">
                    <h3 class="gift-name">满婷除螨皂滋润清香型肥皂洗澡后背痘痘面部去螨虫香皂 正品 沐浴</h3>
                    <p class="gift-num">x1</p>
                </div>
            </div>
        </div>--}}
        <!--使用須知-->
    </div>
    <div style="height: 50px; line-height: 50px;"></div>
    <div class="card-buy-ft card-details-ft">
        <a class="bg-color del-card-btn" title="">删除卡片</a>
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
        $('.give-coupon-show').click(function() {
            $('.give-coupon-con').slideToggle();
        })
        $('.give-gift-show').click(function() {
            $('.give-gift-con').slideToggle();
        })
        //
        $("body").on("click", ".bonus-receive", function() {
            var bonus_id = $(this).data("bonus-id");
            var user_card_id = "192";
            var target = $(this);
            $.post("/user/rights-card/receive.html", {
                bonus_id: bonus_id,
                user_card_id: user_card_id
            }, function(result) {
                if (result.code == 0) {
                    if (result.code == 0) {
                        // 0-已领取 1-还可以继续领取
                        if (result.data == 0) {
                            $(target).html("已领取").removeClass("bonus-receive").addClass("bonus-received");
                        }
                        $.msg(result.message);
                        return;
                    } else if (result.code == 130) {
                        $(target).html("已领取").removeClass("bonus-receive").addClass("bonus-received");
                    } else if (result.code == 131) {
                        $(target).html("已抢光").removeClass("bonus-receive").addClass("bonus-received");
                    } else {
                    }
                    $.msg(result.message, {
                        time: 5000
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });
        });
        // 设为默认
        $("body").on("click", ".set-default", function() {
            var user_card_id = "192";
            $.post("/user/rights-card/set-default.html", {
                id: user_card_id
            }, function(result) {
                if (result.code == 0) {
                    // $(".set-default").hide();
                    window.location.reload();
                    $.msg(result.message);
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });
        });
        // 删除卡片
        $("body").on("click", ".del-card-btn", function() {
            var user_card_id = "192";
            var card_type = "0";
            if (card_type == 2) {
                $.msg('付费权益卡不可删除！');
                return;
            }
            var is_default = "1";
            if (is_default == 1) {
                $.msg('默认权益卡不可删除！');
                return;
            }
            $.confirm("您确定要删除此权益卡吗？", function() {
                $.ajax({
                    type: 'GET',
                    url: '/user/rights-card/delete',
                    data: {
                        id: user_card_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 1000
                            }, function() {
                                $.go('/user/rights-card/index.html');
                            });
                        } else {
                            $.msg(result.message);
                        }
                    }
                });
            });
        });
        $("body").on("click", ".quick-get", function() {
            var rank_id = "54";
            $.post("/user/rights-card/quick-get.html", {
                rank_id: rank_id
            }, function(result) {
                if (result.code == 0) {
                    $.go('/user/rights-card/info?id=' + result.id);
                    $.msg(result.message, {
                        time: 5000
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });
        });
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
