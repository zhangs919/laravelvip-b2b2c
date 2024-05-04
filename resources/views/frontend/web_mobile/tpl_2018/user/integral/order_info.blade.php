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
            <div class="header-middle">兑换详情</div>
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
    <div class="order-info-box order-info-integral">
        <div class="order-info-detail">
            <h3>
                <i class="iconfont">&#xe612;</i>
                交易状态
            </h3>
            <div class="order-state color">{{ $order_info['order_status_format'] }}</div>
            <div class="order-qrcode-con">
                <div class="order-qrcode SZY-ORDER-QRCODE"></div>
                <div class="order-qrcode-text">
                    <p>兑换单号：{{ $order_info['order_sn'] }}</p>
                    <p>可截屏保存二维码出示给商家</p>
                </div>
            </div>
        </div>
        <div class="order-info-detail clearfix">
            <dl class="clearfix">
                <dt>
                    <span>{{ $order_info['consignee'] }}</span>
                    <span>{{ $order_info['tel'] }}</span>
                </dt>
                <dd>
                    <i class="iconfont">&#xe613;</i>
                    {{ $order_info['region_name'] }} {{ $order_info['address'] }}
                </dd>
            </dl>
        </div>
        <!-- <div class="address-footer-bg"></div> -->
        <!--订单中商品-->
        <div class="order-item">
            <h2>兑换单商品</h2>
            <div class="order-good-list clearfix">
                @foreach($order_info['goods_list'] as $goods)
                    <a href="/integralmall/goods-{{ $goods['goods_id'] }}.html" class="clearfix">
                        <div class="goods-pic">
                            <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                        </div>
                        <dl class="goods-info">
                            <dt class="goods-name">
                                <em class="goods-active exchange-label">积分兑换</em>
                                {{ $goods['goods_name'] }}
                            </dt>
                            <dd class="goods-price price-color">
                                <em>{{ $goods['goods_points'] }}积分</em>
                                <span class="goods-num">x{{ $goods['goods_number'] }}</span>
                            </dd>
                        </dl>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="goods-subtotle">
            <div class="order-reality-pic">
                <p class="clearfix">
                    <span class="order-text">所需总积分</span>
                    <span class="order-pic price-color">
                    <em>{{ $order_info['order_points'] }} 积分</em>
                </span>
                </p>
            </div>
        </div>
        <div class="order-info-detail nav-content">
            <ul>
                <li>
                    <span>兑换单号：</span>
                    <span>{{ $order_info['order_sn'] }}</span>
                </li>
                <li>
                    <span>成交时间：</span>
                    <span>{{ format_time($order_info['add_time']) }}</span>
                </li>
                <li>
                    <span>买家留言：</span>
                    <span>{!! $order_info['postscript'] ?? '-' !!}</span>
                </li>
                <li>
                    <span>送货时间：</span>
                    <span>{{ $order_info['best_time'] ?? '立即配送' }}</span>
                </li>
            </ul>
        </div>
    </div>
    <!-- 操作按钮 -->
    <div class="detail-dowm order-handle">
    </div>
    <script type="text/javascript">
        //
    </script>
    <!--点击取消按钮弹出框-->
    <div class="mask-div" style="display: none;"></div>
    <div class="f-block-box" id="affirm_info" style="height: 0; overflow: hidden;">加载中...</div>
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
    <script src="/assets/40c2dc05/js/jquery.lazyload.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/jquery.history.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/jquery.method.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/jquery.widget.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/jquery.modal.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/table/jquery.tablelist.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/szy.page.more.js?v=1.1"></script>
    <script src="/js/common.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/js/placeholder.js?v=1.1"></script>
    <script src="/js/user.js?v=1.1"></script>
    <script src="/js/address.js?v=1.1"></script>
    <script src="/js/center.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/szy.cart.mobile.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/jquery.qrcode.min.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/message/message.js?v=1.1"></script>
    <script src="/assets/40c2dc05/js/message/messageWS.js?v=1.1"></script>
    <script>
        if ($('.order-handle').find('.operate').length == 0) {
            $('.handle-spacing').hide();
        }
        //
        var scrollheight = 0;
        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                var is_exchange = "";
                $.ajax({
                    url: '/user/integral/edit-order.html?from=info',
                    dataType: 'json',
                    data: {
                        type: type,
                        id: id,
                        is_exchange: is_exchange
                    },
                    success: function(result) {
                        $("#affirm_info").html(result.data);
                        $("#affirm_info").show();
                        $(".mask-div").show();
                        $('.pop-up-content').show();
                        scrollheight = $(document).scrollTop();
                        var yScroll = $(document).scrollTop() - 103;
                        $("body").css("top", "-" + scrollheight + "px");
                        $('.pop-up-content').css('margin-top', yScroll);
                        $("body").css("top", "-" + scrollheight + "px");
                        $("body").addClass("visibly");
                    }
                });
            });
            // 订单二维码
            $('.SZY-ORDER-QRCODE').qrcode({
                width:140,
                height:140,
                text: '{{ $order_info['order_sn'] }}'
            });
        });
        $('.mask-div').click(function() {
            $(".mask-div").hide();
            $(".order-box").removeAttr("style");
            $('#affirm_info').hide();
            $('.pop-up-content').hide();
            $('.pop-up-content').removeAttr('style');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        });
        function close_choose() {
            $(".mask-div").hide();
            $(".order-box").removeAttr("style");
            $('#affirm_info').hide();
            $('.pop-up-content').hide();
            $('.pop-up-content').removeAttr('style');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
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
