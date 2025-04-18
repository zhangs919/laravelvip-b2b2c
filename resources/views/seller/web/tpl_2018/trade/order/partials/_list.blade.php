<link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"><!-- ================== BEGIN BASE  ================== -->
<!-- ================== END BASE  ================== -->
<!-- 新订单列表 -->
<div id="table_list">
    <div class="common-title">
        <div class="ftitle">
            <h3>订单列表</h3>
            <h5>
                ( 共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录 )
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <!-- 不要格式化！！！ -->
    <div class="item-list-hd order-list">
        <ul class="item-list-tabs">
            <li id="all" class="tabs-t @if($params['order_status'] == '') current @endif">
                <a>
                    全部订单 （<span id="order-all"></span>）
                </a>
            </li>
            <li id="unpayed" class="tabs-t @if($params['order_status'] == 'unpayed') current @endif">
                <a>
                    等待买家付款 （<span id="order-unpayed"></span>）
                </a>
            </li>
            <li id="unshipped" class="tabs-t @if($params['order_status'] == 'unshipped') current @endif">
                <a>
                    待发货未指派订单 （<span id="order-unshipped"></span>）
                </a>
            </li>
            <li id="assign" class="tabs-t @if($params['order_status'] == 'assign') current @endif">
                <a>
                    待发货已指派订单 （<span id="order-assign"></span>）
                </a>
            </li>
            <li id="shipped_part" class="tabs-b @if($params['order_status'] == 'shipped_part') current @endif">
                <a>
                    发货中 （<span id="order-shipped-part"></span>）
                </a>
            </li>
            <li id="shipped" class="tabs-b @if($params['order_status'] == 'shipped') current @endif">
                <a>
                    已发货 （<span id="order-shipped"></span>）
                </a>
            </li>
            <li id="finished" class="tabs-b @if($params['order_status'] == 'finished') current @endif">
                <a>
                    已完成 （<span id="order-finished"></span>）
                </a>
            </li>
            <li id="closed" class="tabs-b @if($params['order_status'] == 'closed') current @endif">
                <a>
                    已关闭 （<span id="order-closed"></span>）
                </a>
            </li>
            <li id="backing" class="tabs-b @if($params['order_status'] == 'backing') current @endif">
                <a>
                    退款中 （<span id="order-backing"></span>）
                </a>
            </li>
            <li id="cancel" class="tabs-b last @if($params['order_status'] == 'cancel') current @endif">
                <a>
                    取消订单申请 （<span id="order-cancel"></span>）
                </a>
            </li>
        </ul>

    </div>
    <style type="text/css">
        .item-list-hd.order-list ul li {padding: 8px 0px 5px 3px; min-width: auto;}
        .item-list-hd.order-list ul li.current{padding: 8px 0px 6px 5px;}
    </style>
    <script type="text/javascript">
        // 
    </script>
    @if(!empty($list))
        @foreach($list as $v)

            @php
                $format_order_status_seller = format_order_status_seller($v['order_status'],$v['shipping_status'],$v['pay_status'], $v['order_cancel'])
            @endphp

            <div class="new-order-item">
                <!--订单基本信息及状态-->
                <div class="order-item-title">
                    <input name="order_id_box" type="checkbox" class="table-list-checkbox checkBox cur-p m-r-5" value="{{ $v['order_id'] }}" />

                    <h5 class="order-id">#{{ $v['sub_order_id'] }}</h5>

                    （订单ID：{{ $v['order_id'] }}）

                    <span>
                        <em class="c-red">{{ $v['best_time'] }}</em>
                        送达
                    </span>

                    <span>订单编号：{{ $v['order_sn'] }}</span>
                    <span>下单时间：{{ $v['created_at'] }}</span>




                    <!-- -->
                    <label class="label label-primary">{{ $v['pay_name'] }}</label>

                </div>
                <!--订单提示信息-->
                @if(!empty(format_order_status_reminder($v['order_status'],$v['shipping_status'],$v['pay_status'], $v['close_reason'])))
                    <div class="order-item-reminder order-item-layout">
                        <h5>温馨提示：</h5>
                        @foreach(format_order_status_reminder($v['order_status'],$v['shipping_status'], $v['pay_status'],$v['close_reason']) as $reminderMsg)
                        <p>{!! $reminderMsg !!}</p>
                        @endforeach
                    </div>
                @endif




                <!--买家信息-->

                <div class="order-item-user order-item-layout over-visible pos-r">
                    <h5 class="name">

                        {{ $v['consignee'] }}

                        <span class="name-label popover-box buyer">
                            {{ $v['user_name'] }}
                            <div class="popover-info" style="right: -280px; left: auto;">
                                <i class="fa fa-caret-left"></i>
                                <ul>
                                    <li>
                                        <h3>
                                            <i class="fa fa-user"></i>
                                            联系信息
                                        </h3>
                                    </li>
                                    <li>
                                        <div class="dt">
                                            <span>会员账号：</span>
                                        </div>
                                        <div class="dd">{{ $v['user_name'] }}</div>
                                    </li>
                                    <li>
                                        <div class="dt">
                                            <span>会员昵称：</span>
                                        </div>
                                        <div class="dd">{{ $v['nickname'] }}</div>
                                    </li>
                                    <li>
                                        <div class="dt">
                                            <span>绑定电话：</span>
                                        </div>
                                        <div class="dd">{{ $v['mobile'] }}</div>
                                    </li>
                                    <li>
                                        <div class="dt">
                                            <span>绑定邮箱：</span>
                                        </div>
                                        <div class="dd">{{ $v['user_email'] }}</div>
                                    </li>
                                    <li>
                                        <div class="dt">
                                            <span>交易订单：</span>
                                        </div>
                                        <div class="dd">
                                            {{ $v['order_number'] }}笔

                                            <a class="c-blue m-l-10" href="/trade/order/list.html?uid={{ $v['user_id'] }}" target="_blank">（会员所有订单）</a>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </span>
                    </h5>


                    <p class="tel">{{ $v['tel'] }}</p>
                    <p class="address">
                        {{ $v['region_name'] }} {{ $v['address'] }}
                        <!-- 地图功能，暂时没有 -->
                        <!-- <a class="address-map m-l-10">
                            <i class="fa fa-map-marker"></i>
                        </a> -->

                        @if(get_order_operate_state('shop_edit_address', $v)){{--修改收货人信息--}}
                            <a class="pull-right btn btn-primary btn-xs m-t-10 edit-address" data-id="{{ $v['order_id'] }}" data-type="address">
                                <i class="fa fa-edit"></i>
                                修改
                            </a>
                        @else

                        @endif
                    </p>

                    @if($v['receiving_mode'] == 2){{--上门自提--}}
                    <div class="seal-state ziti pos-a"></div>
                    @endif

                </div>

                <div class="clear"></div>
                <!--买家留言-->
                <!-- 其它信息 -->
                <!-- 预售发货时间 -->


                <!-- 配送状态 -->
                <div class="order-item-delivery">
                    <div class="order-item-title">


                        <h5>配送状态：</h5>
                        <span class="c-green m-l-10">{{ $v['shipping_status_format'] }}</span>

                        @if(get_order_operate_state('shop_assign', $v))
                            <a class="btn btn-primary btn-sm pull-right m-l-10 edit-order" href="javascript:;"
                               data-id="{{ $v['order_id'] }}" data-type="assign">订单指派网点</a>
                        @endif

                        {{--todo 多门店店铺展示--}}
                        @if(get_order_operate_state('shop_assign', $v))
                            {{--<a class="btn btn-primary btn-sm pull-right m-l-10 edit-order" href="javascript:;"--}}
                               {{--data-id="{{ $v['order_id'] }}" data-type="assign">订单指派门店</a>--}}
                        @endif

                        @if(get_order_operate_state('shop_to_shipping', $v))
                            <a class="btn btn-warning btn-sm pull-right m-l-10 " href="/trade/delivery/to-shipping?order_id={{ $v['order_id'] }}">拆单发货</a>
                        @endif

                        @if(get_order_operate_state('shop_delivery', $v))
                            <a class="btn btn-warning btn-sm pull-right m-l-10 edit-order" href="javascript:;"
                               data-id="{{ $v['order_id'] }}" data-type="delivery">拆单发货</a>
                        @endif

                        @if(get_order_operate_state('shop_quick_delivery', $v))
                            <a class="btn btn-warning btn-sm pull-right m-l-10 quick-delivery"
                               data-id="{{ $v['order_id'] }}" href="javascript:;">一键发货</a>
                        @endif

                        @if(get_order_operate_state('shop_view_logistics', $v))
                            <a class="c-blue m-l-10" href="/trade/order/info.html?id={{ $v['order_id'] }}/#logistics">【查看物流】</a>
                        @endif

                        {{--todo 以下代码可删--}}
                        {{--@if($format_order_status_seller == 'unshipped')
                            --}}{{--todo unshipped-待发货未指派 状态展示--}}{{--
                            <a class="btn btn-primary btn-sm pull-right m-l-10 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="assign">订单指派网点</a>
                            <a class="btn btn-warning btn-sm pull-right m-l-10 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="delivery">拆单发货</a>
                            <a class="btn btn-warning btn-sm pull-right m-l-10 quick-delivery" data-id="{{ $v['order_id'] }}" href="javascript:;">一键发货</a>


                        @elseif($format_order_status_seller == 'shipped')
                            --}}{{--todo shipped-已发货 状态展示--}}{{--
                            <a class="btn btn-primary btn-sm pull-right m-l-10 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="assign">订单指派网点</a>
                            <a class="btn btn-warning btn-sm pull-right m-l-10 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="delivery">拆单发货</a>
                            <a class="c-blue m-l-10" href="/trade/order/info.html?id={{ $v['order_id'] }}/#logistics">【查看物流】</a>


                        @elseif($format_order_status_seller == 'finished')
                            --}}{{--todo finished-交易成功 状态展示--}}{{--
                            <a class="btn btn-primary btn-sm pull-right m-l-10 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="assign">订单指派网点</a>
                            <a class="btn btn-warning btn-sm pull-right m-l-10 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="delivery">拆单发货</a>
                            <a class="btn btn-warning btn-sm pull-right m-l-10 quick-delivery" data-id="{{ $v['order_id'] }}" href="javascript:;">一键发货</a>
                            <a class="c-blue m-l-10" href="/trade/order/info.html?id={{ $v['order_id'] }}/#logistics">【查看物流】</a>


                        --}}{{--todo closed-交易关闭 状态展示--}}{{--
                        @elseif($format_order_status_seller == 'closed')


                        @elseif($format_order_status_seller == 'backing')
                            --}}{{--todo backing-退款中的订单 状态展示--}}{{--
                            --}}{{--<a class="btn btn-primary btn-sm pull-right m-l-10 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="assign">订单指派网点</a>--}}{{--
                            --}}{{--<a class="btn btn-warning btn-sm pull-right m-l-10 edit-order" href="javascript:;" data-id="{{ $v['order_id'] }}" data-type="delivery">拆单发货</a>--}}{{--
                            --}}{{--<a class="c-blue m-l-10" href="/trade/order/info.html?id={{ $v['order_id'] }}/#logistics">【查看物流】</a>--}}{{--

                        @endif--}}


                    </div>

                </div>
                <!-- 商品信息 -->
                <div class="order-item-goods">
                    <div class="order-item-title">
                        <h5>
                            商品信息（共&nbsp;
                            <em>{{ $v['goods_number'] }}</em>
                            &nbsp;件商品）
                        </h5>
                        <a class="goods-toggle-btn btn btn-primary btn-xs c-fff pull-right">
                            收起
                            <i class="fa fa-angle-down m-r-0 m-l-5"></i>
                        </a>
                    </div>
                    <table class="table m-b-0 order-item-layout goods-toggle-panel">

                        @foreach($v['goods_list'] as $goods)
                            <tr class="order-item">
                                <td class="item w300">
                                    <div class="pic-info">
                                        <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                                            <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情" />
                                        </a>
                                    </div>
                                    <div class="txt-info">
                                        <div class="desc">
                                            <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" class="goods-name" target="_blank" title="{{ $goods['goods_name'] }}">

                                                @if(!empty($goods['act_labels']))
                                                    @foreach($goods['act_labels'] as $act_label)
                                                        @if(!empty($act_label['group_sn']))
                                                            <a href="{{ $act_label['url'] }}" target="_blank" title="{{ $act_label['title'] }}">
                                                            <span style="display: inline-block;">
                                                                <em class="act-type {{ $act_label['code'] }}">{{ $act_label['name'] }}</em>
                                                                <span class="c-red">【{{ $v['groupon_status_format'] }}】</span>
                                                            </span>
                                                            </a>
                                                        @else
                                                        <!-- 活动标签 -->
                                                            <em class="act-type {{ $act_label['code'] }}">{{ $act_label['name'] }}</em>
                                                        @endif
                                                    @endforeach
                                                @endif

                                                {{ $goods['goods_name'] }}
                                            </a>
                                            <!-- <a href="http://www.laravelvip.com/3" class="snap">【交易快照】</a> -->
                                        </div>


                                        <div class="icon m-b-5">

                                            @if(!empty($goods['saleservice']))
                                                @foreach($goods['saleservice'] as $service)
                                                    <a href="javascript:;" target="_blank" title="【{{ $service['contract_name'] }}】{{ $service['contract_desc'] }}">
                                                        <img src="{{ get_image_url($service['contract_image']) }}">
                                                    </a>
                                                @endforeach
                                            @endif

                                        </div>


                                    </div>
                                </td>
                                <td class="w200">

                                    <span></span>

                                </td>

                                <td class="w100">￥{{ $goods['goods_price'] }}</td>

                                <td class="c-red w100">× {{ $goods['goods_number'] }}</td>

                                {{--todo 价格不确定是否正确--}}
                                <td class="w100">￥{{ $goods['goods_price']*$goods['goods_number'] }}</td>

                            </tr>
                        @endforeach


                    </table>
                    <!-- 商品小计 -->

                    <div class="order-item-layout text-r">
                        <strong>小计</strong>
                        <p class="m-t-5">
                            商品总金额：
                            <em class="m-r-5">￥{{ $v['goods_amount'] }}</em>

                            + 运费：
                            <em class="m-r-5">￥{{ $v['shipping_fee'] }}</em>


                            - 店铺红包：
                            <em class="m-r-5">￥{{ $v['shop_bonus'] }}</em>
                            - 平台红包：
                            <em class="m-r-5">￥{{ $v['bonus'] }}</em>

                            - 积分抵扣：
                            <em class="m-r-5">￥{{ $v['integral_money'] }}</em>

                            - 卖家优惠：
                            <em class="m-r-5">￥{{ $v['discount_fee'] }}</em>

                            = 订单总金额：
                            <em class="m-r-5">￥{{ $v['order_amount'] }}</em>
                        </p>
                    </div>

                    <div class="order-item-layout text-r">
                        @if($v['pay_status'] == 2)
                            <span class="c-green">[ 已支付 ]</span>
                        @else
                            <span class="c-red">[ 未支付 ]</span>
                        @endif
                            <strong class="m-l-10">￥{{ $v['money_paid'] }}</strong>
                    </div>

                    {{--todo 平台佣金待计算--}}
                    <div class="order-item-layout text-r">
                        <strong>平台佣金：</strong>
                        <strong class="c-red m-l-10">￥{{ $v['commission'] }}</strong>
                    </div>

                    <div class="order-item-layout text-r">
                        <strong>本单预计收入：</strong>
                        <strong class="c-red m-l-10">￥{{ $v['order_final'] }}</strong>
                    </div>

                </div>
                <!-- 订单备注信息 -->
                @if(!empty($v['shop_remark']))

                    <div class="order-item-message order-item-layout">

                        @foreach($v['shop_remark'] as $or)
                            <p class="m-b-10">
                                <span class="m-r-20">备注人：{{ $or['user_name'] }}</span>
                                <span class="m-r-20">备注时间：{{ format_time($or['add_time']) }}</span>
                                <span class="m-r-30">备注内容：{!! $or['remark'] !!}</span>
                            </p>
                        @endforeach

                    </div>

            @endif


                <!-- 退款信息 -->
                @if($format_order_status_seller == 'backing')
                    {{--todo backing-退款中的订单 状态展示--}}
                    <div class="order-item-return">
                        <div class="order-item-title">
                            <h5>售后信息</h5>
                            <label class="label label-warning">售后中 × 3</label>

                        </div>
                        <div class="order-item-layout">

                            <p class="pull-left w800">

                                用户对【创建红茶 均色 XS】商品提出了退款申请 退款原因：收到商品破损

                            </p>

                            <a class="btn btn-default pull-right" href="/trade/back/list.html?oid={{ $v['order_id'] }}" target="_blank">查看售后详情</a>
                            <div class="clear"></div>
                        </div>
                    </div>
                @endif


                <!-- 订单操作 -->

                <div class="order-item-handle">
                    <div class="pull-left">

                        <a class="btn btn-warning" id="order_print_{{ $v['order_id'] }}" href="javascript:order_print('{{ $v['order_id'] }}')">打印订单</a>
                        <a class="btn btn-default m-l-5" id="remark" data-id="{{ $v['order_id'] }}">备注</a>

                    </div>


                    <div class="pull-right">


                        @if(get_order_operate_state('shop_edit_order_price', $v))
                            <a class="btn btn-primary m-l-5 edit-order" href="javascript:;"
                               data-id="{{ $v['order_id'] }}" data-type="order">修改订单价格</a>
                        @endif

                        @if(get_order_operate_state('shop_cancel', $v))
                            <a class="btn btn-default m-l-5 edit-order" href="javascript:;"
                               data-id="{{ $v['order_id'] }}" data-type="close">关闭订单</a>
                        @endif

                        @if(get_order_operate_state('shop_assign_cancel', $v))
                            <a class="btn btn-primary m-l-5" href="javascript:assignCancel({{ $v['order_id'] }})">取消指派</a>
                        @endif

                        @if(get_order_operate_state('shop_audit_cancel', $v))
                            <a class="btn btn-warning m-l-5 audit" href="javascript:;" data-id="{{ $v['order_id'] }}">审核取消订单</a>
                        @endif

                        @if(get_order_operate_state('shop_delay', $v))
                            <a class="btn btn-primary m-l-5 edit-order" href="javascript:;"
                               data-id="{{ $v['order_id'] }}" data-type="delay">延迟收货时间</a>
                        @endif

                        @if(get_order_operate_state('shop_received_pay', $v))
                            <a class="btn btn-primary m-l-5" href="javascript:getReceived('{{ $v['order_id'] }}')">收到货款</a>
                        @endif


                        <a class="btn btn-primary m-l-5" href="info.html?id={{ $v['order_id'] }}">订单详情</a>

                    </div>

                </div>

                <!-- 订单状态 -->
                <div class="seal-state-box">
                    <div class="seal-state state{{ format_seal_state($v['order_status'],$v['shipping_status'],$v['pay_status']) }}"></div>
                    @if($v['order_cancel'] == 1)
                    <!--买家申请退款标识-->
                    <div class="seal-state apply-cancel"></div>
                    <!--已锁定标签-->
                    <div class="seal-state locking hide"></div>
                    @endif
                </div>
            </div>
        @endforeach
        <table id="order-item-page" class="table">
            <tfoot>
            <tr>
                <td class="text-c w10">
                    <input type="checkbox" class="allCheckBox checkBox">
                </td>
                <td>
                    <div class="pull-left">
                        <div class="btn-group dropup m-r-2">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                批量操作
                                <span class="caret m-l-5"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="javascript:;" onclick="batch_print()">批量打印</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:void(0);" onclick="batch_delivery(0)">批量发货</a>
                                </li>
                                {{--todo 暂时注释 后期再做--}}
                                {{--<li>
                                    <a href="javascript:void(0);" onclick="batch_delivery(1)">批量一键发货</a>
                                </li>--}}
                            </ul>
                        </div>
                        <a class="btn btn-primary m-l-5" href="javascript:getReceived(0);">收到货款</a>
                    </div>
                    <div id="pagination" class="pull-right page-box">


                        {!! $pageHtml !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    @else
        <div class="no-data-page">
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <h5>暂无指定订单</h5>
            <p>暂时没有符合条件的订单，稍后再来看看吧！</p>
        </div>
    @endif
</div>
<script type="text/javascript">
    // 
</script>
<script src="/assets/d2eace91/min/js/validate.min.js"></script>
<script src="/assets/d2eace91/min/js/upload.min.js"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script>

    $().ready(function() {
        $("li[class^='tabs-']").click(function() {
            $("li[class^='tabs-']").removeClass('current');
            $(this).addClass('current');

// 订单状态下拉框中必须存在此状态，才能被选中
            $("#order_status").val($(this).attr("id"));

            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            tablelist.load();
        });

        var url = '/trade/order/get-order-counts';
// <!--  -->
        var data = $("#searchForm").serializeJson();
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'POST',
            data: data,
            success: function(data) {
                $("#order-all").html(data.all);
                <!--  -->
                $("#order-unpayed").html(data.unpayed);
                <!--  -->
                <!--  -->
                $("#order-unshipped").html(data.unshipped);
                $("#order-assign").html(data.assign);
                <!--  -->
                <!--  -->
                $("#order-shipped-part").html(data.shipped_part);
                $("#order-shipped").html(data.shipped);
                <!--  -->
                $("#order-finished").html(data.finished);
                <!--  -->
                $("#order-closed").html(data.closed);
                <!--  -->
                <!--  -->
                $("#order-backing").html(data.backing);
                <!--  -->
                <!--  -->
                $("#order-cancel").html(data.cancel);
                <!--  -->
                $("#order-pending").html(data.pending);
            }
        });
    });

    // 



    $().ready(function() {
        $(".pagination-goto > .goto-input").keyup(function(e) {
            $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
            if (e.keyCode == 13) {
                $(".pagination-goto > .goto-link").click();
            }
        });
        $(".pagination-goto > .goto-button").click(function() {
            var page = $(".pagination-goto > .goto-link").attr("data-go-page");
            if ($.trim(page) == '') {
                return false;
            }
            $(".pagination-goto > .goto-link").attr("data-go-page", page);
            $(".pagination-goto > .goto-link").click();
            return false;
        });
    });

    // 



    $('body').find('.order-toggle-btn').click(function() {
        if ($(this).hasClass('toggle')) {
            $(this).html('收起<i class="fa fa-angle-down m-r-0 m-l-5"></i>').removeClass('toggle');
            $(this).parents().next(".order-toggle-panel").slideToggle(300);
        } else {
            $(this).html('展开<i class="fa fa-angle-up m-r-0 m-l-5"></i>').addClass('toggle');
            $(this).parents().next(".order-toggle-panel").slideToggle(300);
        }
    })

    // 
</script>