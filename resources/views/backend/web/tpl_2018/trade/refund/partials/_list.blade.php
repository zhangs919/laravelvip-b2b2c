<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="w150" data-sortname="order_id">店铺信息</th>
        <th class="w300" data-sortname="goods_id">商品信息</th>
        <th class="w100" data-sortname="user_name">买家</th>
        <th class="w90" data-sortname="order_amount">交易金额</th>
        <th class="w90" data-sortname="refund_money">退款金额</th>
        <th class="w90" data-sortname="bo.add_time">申请时间</th>
        <th class="w90" data-sortname="disabled_time">超时时间</th>
        <th class="w100" data-sortname="back_status">@if($is_after_sale)售后@else退款@endif状态</th>
        <!--操作列样式handle-->
        <th class="handle w70">操作</th>
    </tr>
    </thead>
    <tbody>

    <!--以下为循环内容-->

    @foreach($list as $item)
    <tr>
        <td>
            <div class="ng-binding refund-message w150">
                <span class="name" title="楠丹木业"> 店铺名称：{{ $item['shop']['shop']['shop_name'] }}</span>

                <span class="id">
								店铺ID：{{ $item['shop_id'] }}
								<font class="c-green m-l-10"> {{ $item['shop']['shop_type_fmt'] }}</font>
							</span>
            </div>
        </td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <img src="{{ $item['sku_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
            </div>
            <div class="ng-binding refund-message" style="width: 210px;">
                <div class="name">
                    <a href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}" target="_blank" title="{{ $item['sku_name'] }}" class="c-blue">{{ $item['sku_name'] }}</a>
                </div>
                <div class="order-num">订单编号：{{ $item['order_sn'] }}</div>
                <div class="refund-num">退款编号：{{ $item['back_sn'] }}</div>
            </div>
        </td>
        <td>
            <div class="ng-binding">
                <span>{{ $item['user_name'] }}</span>
            </div>
        </td>
        <td>￥{{ $item['order_amount'] }}</td>
        <td>￥{{ $item['refund_money'] }}</td>
        <td>{{ format_time($item['add_time']) }}</td>
        <td>{{ format_time($item['disabled_time']) }}</td>
        <td>

            <font class="c-red">{{ $item['back_status_format'] }}</font>
            <!---->
            <!-- -->
            <!-- -->
        </td>
        <td class="handle">
            <a href="/trade/refund/info?id={{ $item['back_id'] }}">查看</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="9">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
