<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w80">编号</th>
        <th class="w350">商品信息</th>
        <th class="w150">计价方式</th>
        <th class="w150">销售单位</th>
        <th class="text-c w150">店铺价</th>
        <th class="text-c w150">销售单价</th>
        <th class="text-c w100">数量</th>
        <th class="text-c w150">销售总额</th>
        <th class="text-c w150">优惠金额</th>
        <!-- <th class="text-c w150">佣金金额</th> -->
        <th class="text-c w150">实收总额</th>
        <th class="text-c w250">订单类型</th>
        <th class="text-c w300">订单编号</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($list))
        @foreach($list as $item)
            <tr>
                <td class="text-c">7325</td>
                <td>
                    <span>ipad钢化膜2018新款air2苹果mini4平板pro9.7英寸10.5电脑11新12.9版</span>
                    <br>
                    <span>颜色分类：iPad mini1/2/3【高清款HZ68】9H耐磨防刮◆裸机手感</span>
                    <br>
                    <span>商品货号：</span>
                    <br>
                    <span>商品条形码：</span>
                </td>
                <td>
                    计件
                </td>
                <td class="text-c"></td>
                <td class="text-c">29.90</td>
                <td class="text-c">29.90</td>
                <td class="text-c">1</td>
                <td class="text-c">29.90</td>
                <td class="text-c">0.00</td>
                <!-- <td class="text-c">佣金</td> -->
                <td class="text-c">29.90</td>
                <td class="text-c">普通订单</td>
                <td class="text-c">
                    <a href="/trade/order/info.html?id=5997" target="_blank">20191231004621681640</a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td colspan="12">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
