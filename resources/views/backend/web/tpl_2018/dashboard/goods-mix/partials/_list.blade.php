<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w150">套餐名称</th>
        <th class="w200">店铺名称</th>
        <th class="text-c w300">套餐有效期</th>
        <th class="text-c w130">套餐总价格</th>
        <th class="text-c w100">活动状态</th>
        <th class="text-c handle w80">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
        <tr>
            <td>{{ $v['act_name'] }}</td>
            <td>{{ $v['shop_name'] }}</td>
            <td class="text-c">
                {{ $v['start_time'] }}
                <br>
                ~
                <br>
                {{ $v['end_time'] }}
            </td>
            <td>{{ $v['act_price'] }}</td>
            <td class="text-c">
                <font class="{{ str_replace([0,1,2],['c-red','c-warning','c-999'],$v['is_finish']) }}">{{ str_replace([0,1,2],['未开始','进行中','已结束'],$v['is_finish']) }}</font>
            </td>
            <td class="handle">
                <a href="check?id={{ $v['act_id'] }}">查看</a>
            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <div class="pull-left"></div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
