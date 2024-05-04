<div id="table_list">


    <div class="common-title">
        <div class="ftitle">
            <h3>订单列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>


    <!--列表内容-->
    <!-- 不要格式化！！！ -->
    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <li id="all" class="tabs-t @if($params['order_status'] == '') current @endif">
                <a>
                    全部订单（
                    <span id="order-all">0</span>
                    ）
                </a>
            </li>

            <li id="unpayed" class="tabs-t @if($params['order_status'] == 'unpayed') current @endif">
                <a>
                    等待买家付款（
                    <span id="order-unpayed">0</span>
                    ）
                </a>
            </li>

            <li id="pending" class="tabs-t @if($params['order_status'] == 'pending') current @endif">
                <a>
                    待接单（
                    <span id="order-pending">0</span>
                    ）
                </a>
            </li>



            <li id="unshipped" class="tabs-t @if($params['order_status'] == 'unshipped') current @endif">
                <a>
                    待发货（
                    <span id="order-unshipped">0</span>
                    ）
                </a>
            </li>


            <li id="shipped" class="tabs-t last @if($params['order_status'] == 'shipped') current @endif">
                <a>
                    已发货（
                    <span id="order-shipped">0</span>
                    ）
                </a>
            </li>


            <li id="backing" class="tabs-b @if($params['order_status'] == 'backing') current @endif">
                <a>
                    退款中（
                    <span id="order-backing">0</span>
                    ）
                </a>
            </li>

            <li id="finished" class="tabs-b last @if($params['order_status'] == 'finished') current @endif">
                <a>
                    交易成功（
                    <span id="order-finished">0</span>
                    ）
                </a>
            </li>

            <li id="closed" class="tabs-b @if($params['order_status'] == 'closed') current @endif">
                <a>
                    交易关闭（
                    <span id="order-closed">0</span>
                    ）
                </a>
            </li>
            <li id="cancel" class="tabs-b last @if($params['order_status'] == 'cancel') current @endif">
                <a>
                    取消订单申请（
                    <span id="order-cancel">0</span>
                    ）
                </a>
            </li>

        </ul>
    </div>

    <script type="text/javascript">
        $().ready(function() {
            $("li[class^='tabs-']").click(function() {
                $("li[class^='tabs-']").removeClass('current');
                $(this).addClass('current');

                $("#order_status").val($(this).attr("id"));

                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load();
            });

            var url = '/trade/order/get-order-counts';
            var data = $("#searchForm").serializeJson();
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'POST',
                data: data,
                success: function(data) {
                    $("#order-all").html(data.all);

                    $("#order-unpayed").html(data.unpayed);
                    $("#order-pending").html(data.pending);

                    $("#order-unshipped").html(data.unshipped);

                    $("#order-shipped").html(data.shipped);


                    $("#order-backing").html(data.backing);

                    $("#order-finished").html(data.finished);

                    $("#order-closed").html(data.closed);
                    $("#order-cancel").html(data.cancel);

                }
            });
        });
    </script>
    <div class="table-responsive order">


        <table class="table">
            <colgroup>
                <col class="item-list-col0">
                </col>

                <!--商品信息-->
                <col class="item-list-col1">
                </col>


                <!--单价（元）-->
                <col class="item-list-col2">
                </col>


                <!--数量-->
                <col class="item-list-col3">
                </col>


                <!--售后-->
                <col class="item-list-col4">
                </col>


                <!--买家信息-->
                <col class="item-list-col5">
                </col>

                <!--交易状态-->
                <col class="item-list-col6">
                </col>


                <!--实收款-->
                <col class="item-list-col7">
                </col>



                <!--评价-->
                <col class="item-list-col8 w60">
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
                <th>商品信息</th>

                <th>单价（元）</th>

                <th class="text-c">数量</th>

                <th class="text-c">售后</th>

                <th class="text-c w130">买家</th>
                <th class="text-c">交易状态</th>

                <th class="text-c">金额（元）</th>


                <th class="text-c">评价</th>

                <!--操作列样式handle-->
                <th class="handle text-c">操作</th>
            </tr>
            </thead>
            <tbody style="display: none">
            <!--新加操作按钮，可批量操作，默认或没有选择的时候，是为禁用的状态（将按钮btn-default样式替换为disabled），当点击复选时，为可操作状态-->
            <tr>
                <!--此年colspan="10",10代表着表格table的列数-->
                <th colspan="10">
                    <div class="pull-left">

                        <button class="btn btn-default m-r-2" type="button">批量打印订单</button>
                        <button class="btn btn-default m-r-2" type="button">批量打印快递单</button>
                        <span class="text-explode m-r-5 m-l-5">|</span>
                        <label class="input-label">
                            <input class="checkBox m-r-5" type="checkbox" />
                            不显示已关闭的订单
                        </label>
                    </div>
                    <div class="pull-right">
                        <button onclick="prePage()" class="btn disabled m-r-2" type="button">上一页</button>
                        <button onclick="nextPage()" class="btn disabled m-r-2" type="button">下一页</button>
                    </div>
                </th>
            </tr>
            </tbody>

            @if(!empty($list))
                <!--以下为循环内容-->
                <tbody class="order ">
                @foreach($list as $v)
                <tr class="sep-row">
                    <td colspan="10"></td>
                </tr>
                <!--订单编号-->
                <tr class="order-hd">
                    <td class="tcheck">
                        <input name="order_id_box" type="checkbox" class="table-list-checkbox checkBox cur-p m-r-5" value="{{ $v['order_id'] }}" />
                        </input>
                    </td>
                    <td colspan="9">
                        <div class="basic-info">
                            <span class="order-num">订单编号：{{ $v['order_sn'] }}</span>
                            <span class="deal-time">下单时间：{{ $v['created_at'] }}</span>

                            <span class="order-source">订单来源：{{ format_order_from($v['order_from']) }}</span>
                            <span class="order-source" title="{{ $v['shop_name'] }}">店铺：{{ $v['shop_name'] }}</span>
                        </div>
                    </td>
                </tr>
                <!--订单内容-->
                @foreach($v['goods_list'] as $gKey=>$goods)
                <tr class="order-item">
                    <td class="item" colspan="2">
                        <div class="pic-info">
                            <a href="{{ route('pc_show_goods', ['goods_id' => $goods['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                                <img src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情" />
                            </a>
                        </div>
                        <div class="txt-info">
                            <div class="desc">
                                <a href="{{ route('pc_show_goods', ['goods_id' => $goods['goods_id']]) }}" class="goods-name" target="_blank" title="{{ $goods['goods_name'] }}">


                                    {{ $goods['goods_name'] }}
                                </a>
                                <!-- <a href="http://www.b2b2c.yunmall.laravelvip.com/725" class="snap">【交易快照】</a> -->
                            </div>
                            <!---->
                            <div class="props">
                                @if(!empty($goods['spec_info']))
                                    @foreach(explode(' ', $goods['spec_info']) as $spec)
                                        <span>{{ $spec }}</span>
                                    @endforeach
                                @endif
                            </div>

                            @if($goods['third_id'] > 0)
                                <a class="product-label info m-r-10" href="https://item.taobao.com/item.htm?id={{ $goods['third_id'] }}" target="_blank">云产品库</a>
                            @endif

                            <div class="icon m-t-3">
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

                    <!--单价-->

                    <td class="price">
                        <div class="price m-b-3">￥{{ $goods['goods_price'] }}</div>

                        {{--商品活动标识--}}
                        @if($goods['goods_type'] > 0)
                            <div class="goods-active {{ format_order_goods_type($goods['goods_type'],1) }}">
                                <a>{{ format_order_goods_type($goods['goods_type']) }}</a>
                            </div>
                        @endif

                    </td>


                    <!--数量-->
                    <td class="num text-c">{{ $goods['goods_number'] }}</td>
                    <!--售后-->

                    <td class="text-c">
                        <div class="ng-binding">

                            @if($goods['back_id'] > 0)
                                <a href="/trade/refund/info?id={{ $goods['back_id'] }}" class="refund">
                                    <i class="fa fa-clock-o"></i>
                                    {{ $goods['goods_back_format'] }}
                                </a>
                            @endif
                            {{--<a href="/trade/refund/info?id=19" class="refund">
                                <i class="fa fa-clock-o"></i>
                                换货中
                            </a>--}}

                            {{--<a href="/trade/refund/info?id=17" class="refund">
                                <i class="fa fa-clock-o"></i>
                                退款退货中
                            </a>

                            <a href="/trade/refund/info?id=18" class="refund">
                                <i class="fa fa-clock-o"></i>
                                退款中
                            </a>--}}

                        </div>
                    </td>


                    <!-- 共用start -->
                    @if($gKey == 0)
                        <!--买家信息-->
                        <td class="contact" sumrows="1" rowspan="{{ count($v['goods_list']) }}">
                            <div class="ng-binding popover-box buyer">
                                        <span class="text-c">
                                            <a class="nickname">{{ $v['nickname'] }}</a>

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
                                                        <div class="dd">{{ $v['consignee'] }}</div>
                                                    </li>
                                                    <li>
                                                        <div class="dt">
                                                            <span>电话：</span>
                                                        </div>
                                                        <div class="dd">{{ $v['mobile'] }}</div>
                                                    </li>
                                                    <li>
                                                        <div class="dt">
                                                            <span>地址：</span>
                                                        </div>
                                                        <div class="dd">{{ $v['region_name'] }} {{ $v['address'] }} </div>
                                                    </li>
                                                    <li>
                                                        <div class="dt">
                                                            <span>留言：</span>
                                                        </div>
                                                        <div class="dd">{!! $v['postscript'] !!}</div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </span>
                                        <span class="text-c">

                                            <a class="btn btn-warning c-fff btn-xs " href="/trade/order/list?uid={{ $v['user_id'] }}&from=user">查看所有订单</a>

                                        </span>

                                        <span class="tool text-c">
                                            <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxx&site=cntaobao&s=1&groupid=0&charset=utf-8">
                                                <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxx&site=cntaobao&s=1&charset=utf-8" alt="淘宝旺旺" title="" />
                                            </a>
                                        </span>

                            </div>
                        </td>
                        <!--交易状态-->
                        <td class="trade-status" sumrows="1" rowspan="{{ count($v['goods_list']) }}">
                            <div class="ng-binding pos-r">
                                        <span class="text-c pos-r">

                                            <font class="{{ str_replace([0,1,2,3,4],['c-red','c-green','c-999','c-999','c-999'], $v['order_status']) }}">{{ $v['order_status_format'] }}</font>

                                        </span>
                                <span class="text-c">{{ $v['order_from_format'] }}</span>


                                <span class="text-c">{{ $v['shipping_type'] }}</span>

                            </div>
                        </td>
                        <!--查看物流现在点击跳转到订单详情页面，直接定位到物流模块-->
                        <!--实收款-->

                        <td class="order-price" sumrows="1" rowspan="{{ count($v['goods_list']) }}">
                            <div class="ng-binding">

                                <span class="text-c"> 总金额：￥{{ $v['order_amount'] }} </span>

                                <span class="text-c">{{ $v['pay_name'] }}</span>

                                <span class="text-c">
                                    @if($v['shipping_fee'] > 0)
                                        ( 含快递：￥{{ $v['shipping_fee'] }} )
                                    @else
                                        （<font class="c-orange">免邮</font>）
                                    @endif
                                </span>


                            </div>
                        </td>

                        <!--评价-->

                        <td class="remark" sumrows="1" rowspan="{{ count($v['goods_list']) }}">
                            <div class="ng-binding">
                                <span class="text-c"></span>
                            </div>
                        </td>

                        <!--操作-->
                        <td class="handle" sumrows="1" rowspan="{{ count($v['goods_list']) }}">
                            <div class="ng-binding">
                                        <span class="text-c">
                                            <a href="info?id={{ $v['order_id'] }}">订单详情</a>
                                        </span>
                            </div>
                            <div class="ng-binding">
                                        <span class="text-c">
                                            <a href="javascript:void(0);" id="remark" data-id="{{ $v['order_id'] }}">备注</a>
                                        </span>
                            </div>

                            <div class="ng-binding">
                                        <span class="text-c">
                                            <a id="order_print_{{ $v['order_id'] }}" href="javascript:order_print('{{ $v['order_id'] }}')">打印订单</a>
                                        </span>
                            </div>

                        </td>
                    @endif
                    <!-- 共用end -->
                </tr>
                <!-- 商品自带赠品 -->
                @endforeach

                @if(!empty($v['mall_remark']))
                    <tr class="order-item">
                        <td colspan="10" class="userLabel">
                            <p class="m-l-10">

                                @foreach($v['mall_remark'] as $or)
                                    <span class="m-r-20">备注人：{{ $or['user_name'] }}</span>
                                    <span class="m-r-20">备注时间：{{ format_time($or['add_time']) }}</span>
                                    <span class="m-r-20" title="我的订单">备注内容：{!! $or['remark'] !!}</span>
                                    <br>
                                @endforeach

                            </p>
                        </td>
                    </tr>
                @endif

                @endforeach
                </tbody>
            @else
                <tbody class="tbody-nodata">
                <tr>
                    <td class="no-data" colspan="10">
                        <i class="fa fa-exclamation-circle"></i>
                        没有符合条件的记录
                    </td>
                </tr>
                </tbody>
            @endif

            <tfoot>
            <tr>
                <td class="text-c w10">
                    <input type="checkbox" class="allCheckBox checkBox">
                </td>
                <td colspan="9">
                    <div class="pull-left">

                        <a class="btn btn-danger" href="javascript:;" onclick="batch_print()">批量打印</a>

                        <a class="btn btn-danger hide" href="javascript:;">批量删除</a>
                    </div>

                    <div id="pagination" class="pull-right page-box">


                        {!! $pageHtml !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>


    </div>
</div>