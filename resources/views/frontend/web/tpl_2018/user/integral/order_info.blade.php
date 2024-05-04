@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')
    <!-- 正文，由view提供 -->
    <div class="con-right fr"><div class="con-right-text">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">兑换详情</li>
                </ul>
                <div class="user-tab-right">
                    <a href="/user/integral/order-list.html">返回兑换单列表</a>
                </div>
            </div>
            <div class="content-info">
                <div class="order-step">
                    <!--完成步骤为dl添加current样式，完成操作内容后会显示完成时间-->
                    @foreach($order_schedules as $key=>$schedule)
                        <dl class="@if($schedule['status']){{ 'current' }}@endif @if($key == 0){{ 'step-first' }}@endif">
                            <dt>{{ $schedule['title'] }}</dt>
                            <dd class="step-bg"></dd>
                            <dd class="date" title="{{ $schedule['title_sub'] ?? '' }}">{{ format_time($schedule['time']) }}</dd>
                        </dl>
                    @endforeach
                </div>
                <div class="trade-details">
                    <table class="trade-details-table" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td class="table-td trade-imfor">
                                <div class="trade-imfor-title">
                                    <h3>订单信息</h3>
                                </div>
                                <ul>
                                    <li class="table-list">
                                        <div class="trade-imfor-dt">收货地址：</div>
                                        <div class="trade-imfor-dd">
                                            <div class="address-detail">
                                                {{ $order_info['consignee'] }}
                                                <br />
                                                {{ $order_info['tel'] }}
                                                <br />
                                                {{ $order_info['region_name'] }} {{ $order_info['address'] }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="table-list">
                                        <div class="trade-imfor-dt">买家留言：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">{!! $order_info['postscript'] ?? '-' !!}</span>
                                        </div>
                                    </li>
                                    <li class="table-list">
                                        <div class="trade-imfor-dt">送货时间：</div>
                                        <div class="trade-imfor-dd message-detail">
                                            <span class="no-content">{{ $order_info['best_time'] ?? '立即配送' }}</span>
                                        </div>
                                    </li>
                                    <li class="table-list separate-top">
                                        <div class="trade-imfor-dt">兑换单号：</div>
                                        <div class="trade-imfor-dd imfor-short-dd">{{ $order_info['order_sn'] }}</div>
                                        <div class="drop-down-container order-number">
                                            <span class="more-detail">更多</span>
                                            <div class="small-drop-down">
                                                <div class="drop-down-content trade-detail-list">
                                                    <div class="list-pointer"></div>
                                                    <table class="trade-dropdown-table">
                                                        <tbody>
                                                        @foreach($order_schedules as $key=>$schedule)
                                                            @if($schedule['status'])
                                                                <tr>
                                                                    <td class="trade-dropdown-title">{{ $schedule['title'] }}：</td>
                                                                    <td class="trade-dropdown-data">{{ format_time($schedule['time']) }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td class="table-td">
                                <dl class="user-status-imfor">
                                    <dt class="imfor-icon">
                                        <!-- 订单完成的图标 -->
                                        @if($order_info['order_status'] == 1)
                                            <img src="/images/common/success.png">
                                        @else
                                            <img src="/images/common/warning.png">
                                        @endif
                                    </dt>
                                    <dd class="imfor-title">
                                        <h3>状态：{{ $order_info['order_status_format'] }}</h3>
                                    </dd>
                                </dl>
                                <ul class="user-status-prompt">
                                    <!-- 待收货 -->
                                </ul>
                                <dl class="user-status-operate">
                                </dl>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bought-listform">
                    <dl class="bought-listform-header">
                        <dd class="header-item">兑换商品</dd>
                        <dd class="header-price" style="width: 180px;">兑换积分</dd>
                        <dd class="header-count" style="width: 200px;">兑换数量</dd>
                        <dd class="header-count" style="width: 205px;">状态</dd>
                        <!--<dd class="header-status">状态</dd>-->
                    </dl>
                    <table class="bought-goods-list" cellspacing="0" cellpadding="0">
                        <tbody>
                        @foreach($order_info['goods_list'] as $goods)
                            <tr>
                                <td class="header-item">
                                    <div class="item-container clearfix">
                                        <div class="item-img">
                                            <a class="pic s50" href="/integralmall/goods-{{ $goods['goods_id'] }}.html" title="查看宝贝详情" target="_blank">
                                                <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                                            </a>
                                        </div>
                                        <div class="item-meta">
                                            <a class="item-link" href="/integralmall/goods-{{ $goods['goods_id'] }}.html" title="查看宝贝详情" target="_blank"> {{ $goods['goods_name'] }} </a>
                                            <div class="goods-active exchange">
                                                <a>积分兑换</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="header-price font-high-light" style="width: 180px;">{{ $goods['goods_points'] }}</td>
                                <td class="header-count font-high-light" style="width: 200px;">{{ $goods['goods_number'] }}</td>
                                <td class="header-count font-high-light" style="width: 205px;">
                                    待发货
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="order-total">
                    <div class="total-count">
                        <div class="total-count-pay">
                            <div class="total-count-pay-info">
                                <span>所需总积分：{{ $order_info['order_points'] }} 积分</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
    </div>
@stop

{{--底部js--}}
@section('footer_js')
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
    <script src="/assets/d2eace91/js/common.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/message.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/messageWS.js?v=1.1"></script>
    <script>
        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                title = '';
                if (type == 'delay') {
                    title = "延长确认收货时间";
                }
                if (type == 'confirm') {
                    title = "确认收货";
                }
                if (type == 'cancel') {
                    title = "取消订单";
                }
                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        // 标题
                        title: title,
                        trigger: $(this),
                        // ajax加载的设置
                        ajax: {
                            url: '/user/integral/edit-order.html?from=info',
                            data: {
                                type: type,
                                id: id,
                            }
                        },
                    });
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
            $('.site_to_yikf').click(function() {
                $(this).parent('form').submit();
            })
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