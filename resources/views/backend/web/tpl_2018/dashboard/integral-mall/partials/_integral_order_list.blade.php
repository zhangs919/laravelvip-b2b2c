<div id="table_list">

    <div class="common-title">
        <div class="ftitle">
            <h3>积分兑换列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <!--列表内容-->
    <!-- 不要格式化！！！ -->
    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <li id="all" class="tabs-t @if($params['order_status'] == '') current @endif">
                <a>
                    全部订单（
                    <span id="order-all">{{ $order_count['all'] }}</span>
                    ）
                </a>
            </li>
            <li id="unshipped" class="tabs-t @if($params['order_status'] == 'unshipped') current @endif">
                <a>
                    待发货（
                    <span id="order-unshipped">{{ $order_count['unshipped'] }}</span>
                    ）
                </a>
            </li>
            <li id="shipped" class="tabs-t last @if($params['order_status'] == 'shipped') current @endif">
                <a>
                    已发货（
                    <span id="order-shipped">{{ $order_count['shipped'] }}</span>
                    ）
                </a>
            </li>
            <li id="finished" class="tabs-b last @if($params['order_status'] == 'finished') current @endif">
                <a>
                    交易成功（
                    <span id="order-finished">{{ $order_count['finished'] }}</span>
                    ）
                </a>
            </li>
            <!-- <li id="closed" class="tabs-b">
                <a>
                    交易关闭（<span id="order-closed">0</span>）
                </a>
            </li>-->
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
        });
    </script>
    <div class="table-responsive order">
        <table class="table">
            <thead>
            <tr>
                <!--复选框列样式tcheck，一般复选框样式checkBox,全选复选框样式在一般复选框样式后再新加allCheckBox样式-->
                <th class="tcheck">
                    <input type="checkbox" class="checkBox allCheckBox">
                </th>
                <!--排序样式sort默认，asc升序，desc降序-->
                <th class="w300">兑换商品信息</th>
                <th class="text-c w100">兑换积分</th>
                <th class="text-c">兑换数量</th>
                <th class="text-c w130">买家</th>
                <th class="text-c">交易状态</th>
                <th class="text-c">合计 （积分）</th>
                <!--操作列样式handle-->
                <th class="handle text-c" style="width: 170px;">操作</th>
            </tr>
            </thead>
        @if(!empty($list))
            <!--以下为循环内容-->
                <tbody class="order ">
                @foreach($list as $v)
                    <tr class="sep-row">
                        <td colspan="10"></td>
                    </tr>
                    <!--兑换单编号-->
                    <tr class="order-hd">
                        <td class="tcheck">
                            <input type="checkbox" class="checkBox" data-id="{{ $v['order_id'] }}">
                        </td>
                        <td colspan="9">
                            <div class="basic-info">
                                <span class="order-num">兑换单号：{{ $v['order_sn'] }}</span>
                                <span class="deal-time">下单时间：{{ format_time($v['add_time'],'Y-m-d H:i:s') }}</span>
                                <span class="order-source">兑换单来源：{{ $v['order_from_format'] }}</span>

                            </div>
                        </td>
                    </tr>
                    <!--兑换单内容-->
                    @foreach($v['goods_list'] as $goods)
                        <tr class="order-item">
                            <td class="item" colspan="2">
                                <div class="pic-info">
                                    <a href="{{ route('show_integral_goods',['goods_id'=>$goods['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                                        <img src="{{ get_image_url($goods['goods_image'],'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情" />
                                    </a>
                                </div>
                                <div class="txt-info">
                                    <div class="desc">
                                        <a href="{{ route('show_integral_goods',['goods_id'=>$goods['goods_id']]) }}" class="goods-name" target="_blank" title="{{ $goods['goods_name'] }}">{{ $goods['goods_name'] }}</a>
                                    </div>
                                </div>
                            </td>
                            <!--单价-->
                            <td class="price text-c">
                                <div class="price m-b-3">{{ $goods['goods_points'] }} 积分</div>

                                <div class="goods-active exchange pull-none">
                                    <a>积分兑换</a>
                                </div>
                            </td>
                            <!--数量-->
                            <td class="num text-c">{{ $goods['goods_number'] }}</td>
                            <!-- 共用start -->
                            <!--买家信息-->
                            <td class="contact" rowspan="1">
                                <div class="ng-binding popover-box buyer">
                                        <span class="text-c">
                                            <a class="nickname">{{ $v['user_name'] }}</a>

                                            <div class="popover-info" style="left: 125px;">
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
                                                        <div class="dd">{{ $v['tel'] }}</div>
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
                                            <a class="btn btn-warning c-fff btn-xs " href="/dashboard/integral-mall/integral-order-list?uid={{ $v['user_id'] }}">查看买家兑换单</a>
                                        </span>
                                </div>
                            </td>
                            <!--交易状态-->
                            <td class="trade-status" rowspan="1">
                                <div class="ng-binding">
                                        <span class="text-c">
                                            <font class="c-green">{{ $v['order_status_format'] }}</font>
                                        </span>
                                    <span class="text-c">{{ $v['order_from_format'] }}</span>
                                    <span class="text-c">普通快递</span>
                                </div>
                            </td>
                            <!--查看物流现在点击跳转到兑换单详情页面，直接定位到物流模块-->
                            <!--实收款-->
                            <td class="order-price" rowspan="1">
                                <div class="ng-binding">
                                    <span class="text-c">{{ $v['order_points'] }}</span>
                                </div>
                            </td>
                            <!--评价-->
                            <!--操作-->
                            <td class="handle text-c" rowspan="1">
                                <a href="/dashboard/integral-mall/print.html?id={{ $v['order_id'] }}" target="_blank">打印</a>
                                <a href="integral-order-info?id={{ $v['order_id'] }}">详情</a>
                                <span>|</span>

                                <a href="javascript:void(0);" class="del" data-id="{{ $v['order_id'] }}">删除</a>
                                <span>|</span>
                                <a href="javascript:void(0);" class="edit-remark" data-id="{{ $v['order_id'] }}">备注</a>
                            </td>
                            <!-- 共用end -->
                        </tr>
                    @endforeach

                    @if(!empty($v['remark']))
                        <tr class="order-item">
                            <td colspan="10" class="userLabel">
                                @foreach(unserialize($v['remark']) as $remark)
                                    <p class="m-l-10">

                                        <span class="m-r-20">备注人：{{ $remark['user_name'] }}</span>
                                        <span class="m-r-20">备注时间：{{ format_time($remark['add_time'],'Y-m-d H:i:s') }}</span>
                                        <span class="m-r-20">备注内容：{!! $remark['remark'] !!}</span>
                                        <br>

                                    </p>
                                @endforeach
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
                        <a id="batch-delete" class="btn btn-danger" href="javascript:void(0);">批量删除</a>
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