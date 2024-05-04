<link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"><!-- ================== BEGIN BASE  ================== -->
<!-- ================== END BASE  ================== -->
<div id="table_list">
    <div class="common-title">
        <div class="ftitle">
            <h3>发货单列表</h3>
            <h5>
                ( 共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录 )
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <li id="all" class="tabs-t current">
                <a>全部发货单（<span id="delivery-all"></span>）</a>
            </li>
            <li id="unshipped" class="tabs-t">
                <a>等待发货（<span id="delivery-unshipped"></span>）</a>
            </li>
            <li id="shipped" class="tabs-t last">
                <a>已发货（<span id="delivery-shipped"></span>）</a>
            </li>
        </ul>
    </div>
    <script type="text/javascript">
        //
    </script>
    <div class="table-responsive order">
        <table class="table">
            <colgroup>
                <col class="item-list-col0">
                </col>
                <!--商品信息-->
                <col class="w250">
                </col>
                <!--单价（元）-->
                <col class="item-list-col2">
                </col>
                <!--数量-->
                <col class="item-list-col3">
                </col>
                <!--买家信息-->
                <col class="item-list-col5">
                </col>
                <!--交易状态-->
                <col class="item-list-col6">
                </col>
                <!--操作-->
                <col class="item-list-col9">
                </col>
            </colgroup>
            <thead>
            <tr>
                <!--复选框列样式tcheck，一般复选框样式checkBox,全选复选框样式在一般复选框样式后再新加allCheckBox样式-->
                <th class="tcheck">
                    <input type="checkbox" class="checkBox allCheckBox">
                    </input>
                </th>
                <!--排序样式sort默认，asc升序，desc降序-->
                <th>
                    商品信息
                    <span class=""></span>
                </th>
                <th>
                    单价（元）
                    <span class=""></span>
                </th>
                <th class="text-c">
                    数量
                    <span class=""></span>
                </th>
                <th class="text-c">
                    买家
                    <span class=""></span>
                </th>
                <th class="text-c">
                    发货单状态
                    <span class=""></span>
                </th>
                <!--操作列样式handle-->
                <th class="handle">操作</th>
            </tr>
            </thead>
            @if(!empty($list))
                <!--以下为循环内容-->
                @foreach($list as $key=>$v)
                <tbody class="order @if(array_key_last($list) == $key){{ 'last' }}@endif">
                <tr class="sep-row">
                    <td colspan="7"></td>
                </tr>
                <!--订单编号-->
                <tr class="order-hd">
                    <td class="tcheck">
                        <input name="delivery_id_box" type="checkbox" class="checkBox" value="{{ $v['delivery_id'] }}" />
                    </td>
                    <td colspan="6">
                        <div class="basic-info" >
                            <span class="invoice-num">发货单编号：{{ $v['delivery_sn'] }}</span>
                            <span class="deal-time">发货时间：{{ format_time($v['add_time']) }}</span>
                            <span class="order-num">
                                        订单编号：
                                        <a href="/trade/order/info.html?id={{ $v['order_id'] }}" target="_blank" title="点击查看订单详情">{{ $v['order_sn'] }}</a>
                                    </span>
                            <span class="deal-time">下单时间：{{ format_time($v['order_add_time']) }}</span>
                        </div>

                        @if(get_order_operate_state('shop_sheet_print', $v['order_info'],$v))
                            <a class="btn c-fff btn-warning btn-xs m-r-10 pull-right print-sheet" data-id="{{ $v['delivery_id'] }}" data-code="{{ $v['shipping_code'] }}">打印电子面单</a>
                        @endif

                        @if(get_order_operate_state('shop_shipping_print', $v['order_info'],$v))
                            <a class="btn c-fff btn-warning btn-xs m-r-10 pull-right" href="/trade/delivery/print?id={{ $v['delivery_id'] }}" target="_blank">打印快递单</a>
                        @endif
                    </td>
                </tr>
                <!--订单内容-->
                @foreach($v['goods_list'] as $k=>$goods)
                <tr class="order-item">
                    <td class="item" colspan="2">
                        <div class="pic-info">
                            <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" data-sku_id="{{ $goods['sku_id'] }}" class="goods-thumb" title="查看商品详情" target="_blank">
                                <img src="{{ $goods['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情"></img>
                            </a>
                        </div>
                        <div class="txt-info">
                            <div class="desc">
                                <a class="goods-name" href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" target="_blank" title="查看商品详情">
                                    {{ $goods['goods_name'] }}
                                </a>
                                <!-- <a class="snap">【交易快照】</a> -->
                            </div>
                            <div class="props">
                                @if(!empty($goods['spec_info']))
                                    @foreach(explode(' ', $goods['spec_info']) as $spec)
                                        <span>{{ $spec }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <!--
                        <div class="icon">
                            <a class="icon-7day" href="javascript:;" target="_blank" title="7天退货" data-toggle="tooltip" data-placement="auto bottom">
                                <img src="/images/common/7day_60.gif">
                            </a>
                            <a class="icon-pz" href="javascript:;" target="_blank" title="品质保证" data-toggle="tooltip" data-placement="auto bottom">
                                <img src="/images/common/pz_60.gif">
                            </a>
                            <a class="icon-jswl" href="javascript:;" target="_blank" title="破损补寄" data-toggle="tooltip" data-placement="auto bottom">
                                <img src="/images/common/jswl_60.gif">
                            </a>
                            <a class="icon-psbf" href="javascript:;" target="_blank" title="急速物流" data-toggle="tooltip" data-placement="auto bottom">
                                <img src="/images/common/psbf_60.gif">
                            </a>
                        </div> -->
                        </div>
                    </td>
                    <!--单价-->
                    <td class="price">
                        <div class="price m-b-3">￥{{ $goods['goods_price'] }}</div>
                    </td>
                    <!--数量-->
                    <td class="num text-c">{{ $goods['goods_number'] }}</td>
                    <!-- 公共部分开始 -->
                    @if($k == 0)
                    <!--买家信息-->
                    <td class="contact" rowspan="{{ count($v['goods_list']) }}">
                        <div class="ng-binding">
                            <span class="text-c popover-box buyer">
                                <a class="nickname">{{ $v['user_name'] }}</a>
                                <div class="popover-info" style="left: auto; right: -280px">
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
                                                <span>姓名：</span>
                                            </div>
                                            <div class="dd">{{ $v['order_info']['consignee'] }}</div>
                                        </li>
                                        <li>
                                            <div class="dt">
                                                <span>电话：</span>
                                            </div>
                                            <div class="dd">{{ $v['order_info']['tel'] }}</div>
                                        </li>
                                        <li>
                                            <div class="dt">
                                                <span>地址：</span>
                                            </div>
                                            <div class="dd">{{ $v['order_info']['region_name'] }} {{ $v['order_info']['address'] }} </div>
                                        </li>
                                        <li>
                                            <div class="dt">
                                                <span>留言：</span>
                                            </div>
                                            <div class="dd">{!! $v['order_info']['postscript'] !!}</div>
                                        </li>
                                    </ul>
                                </div>
                            </span>
                            <span class="text-c">
                                <a class="btn btn-info btn-xs c-fff" href="/trade/order/list?uid={{ $v['user_id'] }}" target="_blank">查看所有订单</a>
                            </span>
                        </div>
                    </td>
                    <!--交易状态-->
                    <td class="trade-status" rowspan="{{ count($v['goods_list']) }}">
                        <div class="ng-binding">
                            <span class="text-c">
                                <font @if($v['shipping_status'] == 1)class="c-green"@else{{ 'class="c-red"' }}@endif>{{ $v['delivery_status_format'] }}</font>
                            </span>
                            <span class="text-c">@if(in_array($v['shipping_type'], [1,2]))嗖嗖物流@else普通快递@endif</span>
                            @if(get_order_operate_state('shop_view_logistics', $v['order_info']))
                            <span class="text-c">
                                <a class="view-logistics" href="/trade/delivery/info?id={{ $v['delivery_id'] }}">查看物流</a>
                            </span>
                            @endif
                        </div>
                    </td>
                    <!--查看物流现在点击跳转到订单详情页面，直接定位到物流模块-->
                    <!--操作-->
                    <td class="handle" rowspan="{{ count($v['goods_list']) }}">
                        <a href="info?id={{ $v['delivery_id'] }}">发货单详情</a>
                        <a href="/trade/order/print.html?did={{ $v['delivery_id'] }}" target="_blank">打印发货单</a>

                        @if(get_order_operate_state('shop_to_shipping', $v['order_info']))
                            <a href="/trade/delivery/to-shipping?id={{ $v['delivery_id'] }}" class="active">去发货</a>
                        @endif

                    </td>
                    @endif
                    <!-- 公共部分结束 -->
                </tr>
                @endforeach
                </tbody>
                @endforeach
            @else
                    <tbody class="tbody-nodata">
                    <tr>
                        <td colspan="7" class="no-data">
                            <i class="fa fa-exclamation-triangle"></i>
                            没有符合条件的记录
                        </td>
                    </tr>
                    </tbody>
            @endif
            <tfoot>
            <tr>
                <td class="text-c w10">
                    <input type="checkbox" class="allCheckBox checkBox">
                    </input>
                </td>
                <td colspan="6">
                    <div class="pull-left">
                        <a class="btn btn-default" href="javascript:;" onclick="batch_print()">批量打印</a>
                        <!--
                    <a class="btn btn-danger m-l-5" href="javascript:;">批量删除</a>
                     -->
                        <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                    </div>
                    <div id="pagination" class="pull-right page-box">
                        {!! $pageHtml !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
        <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
        <script>

            $().ready(function() {
                $("li[class^='tabs-']").click(function() {
                    $("li[class^='tabs-']").removeClass('current');
                    $(this).addClass('current');

                    $("#delivery_status").val($(this).attr("id"));

                    tablelist = $("#table_list").tablelist({
                        params: $("#searchForm").serializeJson()
                    });
                    tablelist.load();
                });

                var url = '/trade/delivery/get-delivery-counts';
                var data = $("#searchForm").serializeJson();
                $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        $("#delivery-all").html(data.all);
                        $("#delivery-unshipped").html(data.unshipped);
                        $("#delivery-shipped").html(data.shipped);
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
        </script>
    </div>
</div>