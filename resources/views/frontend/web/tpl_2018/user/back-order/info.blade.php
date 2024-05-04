@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">申请售后</li>
                </ul>
            </div>
            <div class="content-info">

                <div class="order-step order-return-step">
                    <!--完成步骤为dl添加current样式，完成操作内容后会显示完成时间-->

                    @foreach($order_schedules as $key=>$schedule)
                        <dl class="@if($schedule['status']){{ 'current' }}@endif @if($key == 0){{ 'step-first' }}@endif">
                            <dt>{{ $schedule['title'] }}</dt>
                            <dd class="step-bg"></dd>
                            <dd class="date" title="{{ $schedule['title_sub'] ?? '' }}">{{ format_time($schedule['time']) }}</dd>
                        </dl>
                    @endforeach

                </div>


                <div class="content-con">
                    <div class="imfor-info">
                        <table class="content-info-table" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="content-imfor">
                                    <div class="imfor-title">
                                        <h3>申请售后商品</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="imfor-dt imfor-dt-spe">
                                                <a href="{{ route('pc_show_goods',['goods_id'=>$goods_info['goods_id']]) }}" title="查看商品详情" target="_blank" class="item-img">
                                                    <img src="{{ get_image_url($goods_info['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="" />
                                                </a>
                                            </div>
                                            <div class="imfor-dd color">
                                                <div class="item-name">
                                                    <a href="{{ route('pc_show_goods',['goods_id'=>$goods_info['goods_id']]) }}" title="查看商品详情" target="_blank">
                                                        <span>{{ $goods_info['goods_name'] }}</span>
                                                    </a>
                                                </div>
                                                @if(!empty($goods_info['spec_info']))
                                                    <div class="item-props">
                                                        <span class="sku">
                                                            @foreach(explode(' ', $goods['spec_info']) as $spec)
                                                                <span>{{ $spec }}</span>
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                        <li class="separate-top">
                                            <div class="imfor-dt">单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价：</div>
                                            <div class="imfor-dd">￥{{ $goods_info['goods_price'] }} * {{ $goods_info['goods_number'] }} (数量)</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</div>
                                            <div class="imfor-dd color">￥{{ $goods_info['goods_price']*$goods_info['goods_number'] }}</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">商&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家：</div>
                                            <div class="imfor-dd imfor-short-dd">
                                                <a href="{{ route('pc_shop_home',['shop_id'=>$back_info['shop_id']]) }}" target="_blank" title="{{ $shop_info['shop']['shop_name'] }}" class="btn-link">{{ $shop_info['shop']['shop_name'] }}</a>

                                                {{--客服工具 默认0 0无客服 1QQ 2旺旺--}}
                                                @if($shop_info['customer_main']['customer_tool'] == 2)
                                                    <span class="ww-light">
                                <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                                                        <!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $shop_info['customer_main']['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $shop_info['customer_main']['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                    <span></span>
                                </a>

                            </span>
                                                @elseif($shop_info['customer_main']['customer_tool'] == 1)
                                                <!-- s等于1时带文字，等于2时不带文字 -->
                                                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $shop_info['customer_main']['customer_account'] }}&site=qq&menu=yes" class="service-btn">
                                                        <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $shop_info['customer_main']['customer_account'] }}:52" alt="QQ" title="" style="height: 20px;" />
                                                        <span></span>
                                                    </a>
                                                @else{{--默认 平台客服--}}
                                                <a href='{{ $shop_info['customer_main']['yikf_url'] ?? 'javascript:;' }}' class="ww-light  color" target="_blank" title="点击联系在线客服">
                                                    <i class="iconfont">&#xe6ad;</i>
                                                </a>
                                                @endif

                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">物流信息：</div>
                                            <div class="imfor-dd">
                                                <a href="/user/order/express?id={{ $back_info['order_id'] }}" target="_blank">发货物流信息</a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="imfor-title imfor-title-top">
                                        <h3>订单信息</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="imfor-dt">订单编号：</div>
                                            <div class="imfor-dd">
                                                <a href="/user/order/info?id={{ $back_info['order_id'] }}" title="查看订单详情" class="btn-link" target="_blank">{{ $order_info['order_sn'] }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</div>
                                            <div class="imfor-dd">￥{{ $order_info['shipping_fee'] }}</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</div>
                                            <div class="imfor-dd color">￥{{ $order_info['order_amount'] }}</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">成交时间：</div>
                                            <div class="imfor-dd">{{ format_time($order_info['pay_time']) }}</div>
                                        </li>
                                    </ul>
                                </td>

                                @if(in_array($back_info['back_type'], [1,2]))
                                    <!-- 提交仅退款申请后的页面 _start -->
                                    @if(back_order_operate_state('buyer_wait', $order_info, $back_info))
                                    <td class="content-status">
                                        <dl class="user-status-imfor">
                                            <dt class="imfor-icon">
                                                <img src="/images/common/warning.png">
                                            </dt>
                                            <dd class="imfor-title">
                                                <h3>您已提交了{{ $service_name }}申请，请等待卖家处理{{ $service_name }}申请</h3>
                                            </dd>
                                        </dl>
                                        <ul class="user-status-prompt">
                                            <li>
                                                <span>如果卖家同意，{{ $service_name }}申请将达成</span>
                                            </li>
                                            <li>
                                                <span>如果卖家拒绝，可与卖家协商修改{{ $service_name }}申请，若协商不成可申请平台方介入</span>
                                            </li>
                                            <li>
                                            <span>
                                                如果
                                                <strong class="color" id="counter_confirm"></strong>
                                                内卖家尚未处理，{{ $service_name }}申请将自动达成
                                            </span>
                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        $("#counter_confirm").countdown({
                                                            time: "{{ $back_info['counter'] }}",
                                                            leadingZero: true,
                                                            onComplete: function(event) {
                                                                $(this).html("已超时！");

                                                                // 超时事件，预留
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: '/user/back/confirm-sys.html',
                                                                    data: {
                                                                        back_id: '{{ $back_info['back_id'] }}'
                                                                    },
                                                                    dataType: 'json',
                                                                    success: function(data) {
                                                                        $.msg(data.message);
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
                                        <dl class="user-status-operate">
                                            <dt>您可以</dt>
                                            <dd>
                                                <a href="javascript:_edit('{{ $back_info['back_id'] }}',1)" class="return-apply">修改{{ $service_name }}申请</a>
                                            </dd>
                                            <dd>
                                                <a href="javascript:_cancel('{{ $back_info['back_id'] }}',1)" class="btn-link">撤销{{ $service_name }}申请</a>
                                            </dd>
                                        </dl>
                                    </td>
                                    @endif
                                    <!-- 提交仅退款申请后的页面 _end -->

                                    <!-- 买家撤销退款之后 _start -->
                                    @if($back_info['back_status'] == 7)
                                        <td class="content-status">
                                            <dl class="user-status-imfor">
                                                <dt class="imfor-icon">
                                                    <img src="/images/common/warning.png">
                                                </dt>
                                                <dd class="imfor-title">
                                                    <h3>因买家取消{{ $service_name }}申请，{{ $service_name }}已关闭，交易将正常进行</h3>
                                                </dd>
                                            </dl>
                                        </td>
                                    @endif
                                    <!-- 买家撤销退款之后 _end -->

                                    <!-- 退款失效之后 _start -->
                                    @if($back_info['back_status'] == 6)
                                        <td class="content-status">
                                            <dl class="user-status-imfor">
                                                <dt class="imfor-icon">
                                                    <img src="/images/common/warning.png">
                                                </dt>
                                                <dd class="imfor-title">
                                                    <h3>因卖家超时未处理{{ $service_name }}申请，{{ $service_name }}已关闭，交易将正常进行</h3>
                                                </dd>
                                            </dl>
                                        </td>
                                    @endif
                                    <!-- 退款失效之后 _end -->

                                    <!-- 卖家拒绝退款申请 _start -->
                                    @if($back_info['back_status'] == 5)
                                        <td class="content-status">
                                            <dl class="user-status-imfor">
                                                <dt class="imfor-icon">
                                                    <img src="/images/common/warning.png">
                                                </dt>
                                                <dd class="imfor-title">
                                                    <h3>卖家拒绝了您的{{ $service_name }}申请，请修改{{ $service_name }}信息。</h3>
                                                </dd>
                                            </dl>
                                            <ul class="user-status-prompt">
                                                <li>
                                                    <span>如果卖家同意，{{ $service_name }}申请将达成</span>
                                                </li>
                                                <li>
                                                    <span>如果卖家拒绝，可与卖家协商修改{{ $service_name }}申请，若协商不成可申请平台方介入</span>
                                                </li>
                                                <li>
                                                    <span>
                                                        如果您在
                                                        <strong class="color" id="counter_confirm"></strong>
                                                        前，未处理{{ $service_name }}信息，系统将自动取消{{ $service_name }}申请。
                                                    </span>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $("#counter_dismiss").countdown({
                                                                time: "{{ $back_info['counter'] }}",
                                                                leadingZero: true,
                                                                onComplete: function(event) {
                                                                    $(this).html("已超时！");

                                                                    // 超时事件，预留
                                                                    $.ajax({
                                                                        type: 'GET',
                                                                        url: '/trade/refund/cancel-sys.html',
                                                                        data: {
                                                                            back_id: '{{ $back_info['back_id'] }}'
                                                                        },
                                                                        dataType: 'json',
                                                                        success: function(data) {
                                                                            if (data.code == 0){
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
                                            <dl class="user-status-operate">
                                                <dt>您可以</dt>
                                                <dd>
                                                    <a href="javascript:_edit('{{ $back_info['back_id'] }}',1)" class="return-apply">修改{{ $service_name }}申请</a>
                                                </dd>
                                                <dd>
                                                    <a href="javascript:_cancel('{{ $back_info['back_id'] }}',1)" class="btn-link">撤销{{ $service_name }}申请</a>
                                                </dd>
                                            </dl>
                                        </td>
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
                                    <td class="content-status">
                                        <dl class="user-status-imfor">
                                            <dt class="imfor-icon">
                                                <img src="/images/common/success.png">
                                            </dt>
                                            <dd class="imfor-title">
                                                <h3>退款成功</h3>
                                            </dd>
                                        </dl>
                                        <ul class="user-status-prompt">
                                            <li>
                                                <span>退款成功时间：</span>
                                                <div class="user-status-logistic">
                                                    <span class="package-detail">{{ $back_info['updated_at'] }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <span>退款金额：</span>
                                                <div class="user-status-logistic">
                                                    <span class="package-detail">￥{{ $back_info['refund_money'] }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                    @endif
                                    <!-- 退款成功 _end -->

                                @elseif(in_array($back_info['back_type'], [3,4]))
                                    <!-- 提交换货申请后的页面 _start -->
                                    @if(back_order_operate_state('buyer_wait', $order_info, $back_info))
                                        <td class="content-status">
                                            <dl class="user-status-imfor">
                                                <dt class="imfor-icon">
                                                    <img src="/images/common/warning.png">
                                                </dt>
                                                <dd class="imfor-title">
                                                    <h3>您已提交了{{ $service_name }}申请，请等待卖家处理{{ $service_name }}申请</h3>
                                                </dd>
                                            </dl>
                                            <ul class="user-status-prompt">
                                                <li>
                                                    <span>如果卖家同意，{{ $service_name }}申请将达成</span>
                                                </li>
                                                <li>
                                                    <span>如果卖家拒绝，可与卖家协商修改{{ $service_name }}申请，若协商不成可申请平台方介入</span>
                                                </li>
                                                <li>
                                            <span>
                                                如果
                                                <strong class="color" id="counter_confirm"></strong>
                                                内卖家尚未处理，{{ $service_name }}申请将自动达成
                                            </span>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $("#counter_confirm").countdown({
                                                                time: "{{ $back_info['counter'] }}",
                                                                leadingZero: true,
                                                                onComplete: function(event) {
                                                                    $(this).html("已超时！");

                                                                    // 超时事件，预留
                                                                    $.ajax({
                                                                        type: 'GET',
                                                                        url: '/user/back/confirm-sys.html',
                                                                        data: {
                                                                            back_id: '{{ $back_info['back_id'] }}'
                                                                        },
                                                                        dataType: 'json',
                                                                        success: function(data) {
                                                                            $.msg(data.message);
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
                                            <dl class="user-status-operate">
                                                <dt>您可以</dt>
                                                <dd>
                                                    <a href="javascript:_edit('{{ $back_info['back_id'] }}',1)" class="return-apply">修改{{ $service_name }}申请</a>
                                                </dd>
                                                <dd>
                                                    <a href="javascript:_cancel('{{ $back_info['back_id'] }}',1)" class="btn-link">撤销{{ $service_name }}申请</a>
                                                </dd>
                                            </dl>
                                        </td>
                                    @endif
                                    <!-- 提交换货申请后的页面 _end -->

                                    <!-- 买家撤销换货申请之后 _start -->

                                    <!-- 买家撤销换货申请之后 _end -->

                                    <!-- 卖家拒绝换货申请 _start -->

                                    <!-- 卖家拒绝换货申请 _end -->

                                    <!-- 卖家已同意换货申请 _start -->

                                    <!-- 卖家已同意退款退货申请，等待买家寄回货物 _end -->

                                    <!-- 换货成功 _start -->
                                    @if($back_info['back_status'] == 4)
                                        <td class="content-status">
                                            <dl class="user-status-imfor">
                                                <dt class="imfor-icon">
                                                    <img src="/images/common/success.png">
                                                </dt>
                                                <dd class="imfor-title">
                                                    <h3>换货成功</h3>
                                                </dd>
                                            </dl>
                                            <ul class="user-status-prompt">
                                                <li>
                                                    <span>成功时间：</span>
                                                    <div class="user-status-logistic">
                                                        <span class="package-detail">{{ $back_info['updated_at'] }}</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    @endif
                                    <!-- 换货成功 _end -->
                                @endif

                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="consult-record">
                        <div class="tabmenu">
                            <ul class="tab">
                                <li class="active">协商记录</li>
                            </ul>
                        </div>
                        <div class="consult-record-message">
                            <ul>

                                @if(!empty($back_logs))
                                    @foreach($back_logs as $log)
                                        <li>
                                            <div class="message-content">
                                                <div class="message-info">
                                                    <p class="message-admin">
                                                        <span class="name btn-link">{{ $log['title'] }}</span>
                                                        <span class="time">{{ format_time($log['add_time']) }}</span>
                                                    </p>
                                                    <ul>
                                                        <li>
                                                            <div class="dt">凭证信息：</div>
                                                            <div class="dd">
												<span>{!! $log['contents'] !!}</span>

                                                                <div class="voucher">
                                                                    @if(!empty($log['images']))
                                                                        @foreach($log['images'] as $image)
                                                                            <a href="{{ $image }}" onclick="return hs.expand(this)">
                                                                                <img src="{{ $image }}" class="goods-thumb" />
                                                                            </a>
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif



                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            //
        </script>
        <!-- 填写退货物流单弹框 _start -->
        <script>
            //
        </script>

        <!-- 点击大图展示 -->
        <!-- 填写退货物流单弹框 _end -->
    </div>

@stop

{{--底部js--}}
@section('footer_js')
    <script src="/js/common.js"></script>
    <script src="/js/user.js"></script>
    <script src="/assets/d2eace91/js/yii.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/common.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js"></script>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        function _edit(back_id, send_id) {
            $.loading.start();
            $.get('/user/back/edit', {
                id: back_id,
                send_id: send_id
            }, function(result) {
                // $.msg(result.message);
                if (result.code == 0) {
                    if (send_id == 2) {
                        if ($.modal($(this))) {
                            $.modal($(this)).show();
                        } else {
                            $.modal({
                                // 标题  
                                title: '请填写退货物流信息',
                                trigger: $(this),
                                // ajax加载的设置  
                                ajax: {
                                    url: '/user/back/edit-order',
                                    data: {
                                        type: 'shipping',
                                        id: back_id
                                    }
                                },
                            });
                        }
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
            }, function(result) {
                setTimeout(function() {
                    $.msg(result.message, {
                        time: 2000
                    }, function() {
                        if (result.code == 0) {
                            window.location.href = "/user/back/info?id=" + back_id;
                        } else {
                            window.location.reload();
                        }
                    });
                }, 1000);
            }, 'json');
        }
        // 
        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        // 标题  
                        title: '请填写退货物流信息',
                        trigger: $(this),
                        // ajax加载的设置  
                        ajax: {
                            url: '/user/back/edit-order',
                            data: {
                                type: type,
                                id: id
                            }
                        },
                    });
                }
            });
        });
        // 
        $(function(){
            //图片弹窗
            hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
            hs.align = 'center';
            hs.transitions = ['expand', 'crossfade'];
            hs.outlineType = 'rounded-white';
            hs.fadeInOut = true;
            hs.addSlideshow({
                interval: 5000,
                repeat: false,
                useControls: true,
                fixedControls: 'fit',
                overlayOptions: {
                    opacity: .75,
                    position: 'bottom center',
                    hideOnMouseOut: true
                }
            });
        });
        // 
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        // 
        $().ready(function() {
        })
        // 
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
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