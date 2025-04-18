<table class="table" id="table_list">
    <thead>
    <tr>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="w300">商品信息</th>
        <th class="w80 text-c">单价（元）</th>
        <th class="w60 text-c">数量</th>
        <th class="w80 text-c">所需人数</th>
        <th class="w80 text-c">缺少人数</th>
        <th class="w100">团长</th>
        <th class="w80 text-c">拼团状态</th>
        <th class="w80 text-c">已发货</th>
        <th class="w120 text-c">实收款</th>
        <!--操作列样式handle-->
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <!--以下为循环内容-->
    <tbody class="order last">
    @foreach($list as $item)
    <tr class="sep-row">
        <td colspan="10"></td>
    </tr>
    <!--订单编号-->
    <tr class="order-hd">
        <td colspan="10">
            <div class="basic-info p-l-10">
                <span class="order-num">团编号：{{ $item['group_sn'] }}</span>
                <span class="deal-time">开团时间：{{ $item['created_at'] }}</span>
                <span class="order-source">结束时间：{{ format_time($item['end_time']) }}</span>
            </div>
        </td>
    </tr>
    <!--订单内容-->
    <tr class="order-item">
        <td class="item">
            <div class="pic-info">
                <a href="{{ route('mobile_show_goods', ['goods_id' => $item['goods_id']]) }}" class="goods-thumb" title="查看商品详情" target="_blank">
                    <img src="{{ $item['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="查看商品详情"></img>
                </a>
            </div>
            <div class="txt-info w200">
                <div class="desc">
                    <a href="{{ route('mobile_show_goods', ['goods_id' => $item['goods_id']]) }}" class="goods-name" target="_blank" title="{{ $item['goods_name'] }}">{{ $item['goods_name'] }}</a>
                </div>
                <div class="props">
                    <span>{{ $item['spec_info'] }}</span>
                </div>
            </div>
        </td>
        <!--单价-->
        <td class="price">
            <div class="price m-b-3">￥{{ $item['goods_price'] }}</div>
        </td>
        <!--数量-->
        <td class="num text-c">{{ $item['goods_number'] }}</td>
        <!--所需人数-->
        <td class="text-c">{{ $item['fight_num'] }}</td>
        <!--缺少人数-->
        <td class="text-c">{{ $item['diff_num'] }}</td>
        <!--团长-->
        <td class="contact">{{ $item['user_name'] }}</td>
        <!--拼团状态-->
        <td class="trade-status text-c">
            <font class="{{ str_replace([0,1,2], ['c-yellow', 'c-green', 'c-red'], $item['status']) }}">{{ str_replace([0,1,2], ['组团中', '拼团成功', '拼团失败'], $item['status']) }}</font>
        </td>
        <!--已发货-->
        <td class="trade-status">
            <div class="ng-binding">
                <span class="text-c c-green">{{ $item['shipping_count'] }}</span>
            </div>
        </td>
        <td class="order-price" sumrows="1" rowspan="">
            <div class="ng-binding">
                <span class="text-c"> 总金额：￥{{ $item['order_amount'] }} </span>
                <span class="text-c">{{ $item['pay_name'] }}</span>
                <span class="text-c">
                                (                                 <font class="c-orange">免邮</font>
                                 )
                            </span>
            </div>
        </td>
        <!--操作-->
        <td class="handle" sumrows="1" rowspan="">
            <a href="info?group_sn={{ $item['group_sn'] }}">查看详情</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10"></td>
        <td colspan="9">
            <div class="pull-left">
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
