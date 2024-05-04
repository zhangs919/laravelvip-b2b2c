<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="text-c" data-sortname="complaint_id">
            投诉编号
            <span class="sort asc"></span>
        </th>
        <th class="text-c" data-sortname="order_id">
            订单编号
            <span class="sort desc"></span>
        </th>
        <th class="w200">
        投诉方
        </th>
        <th>
            投诉原因
        </th>
        <th>
            申请时间
        </th>
        <th>
            投诉状态
        </th>
        <!--操作列样式handle-->
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    @if(!empty($list))
        @foreach($list as $item)
            <tr>
                <td class="text-c">{{ $item['complaint_sn'] }}</td>
                <td class="text-c">
                    <a class="c-blue" target="_blank" href="/trade/order/info?id={{ $item['order_id'] }}">{{ $item['order_sn'] }}</a>
                </td>
                <td>
                    <div class="ng-binding">
                        <span>{{ $item['user_name'] }}</span>
                        <span title="{{ $item['consignee'] }}">{{ $item['consignee'] }}</span>
                    </div>
                </td>
                <td>{{ format_complaint_type($item['complaint_type']) }}</td>
                <td>{{ format_time($item['add_time']) }}</td>
                <td>
                    <font class="c-green">{{ format_complaint_status($item['complaint_status'],1) }}</font>
                </td>
                <td class="handle">
                    <a href="/trade/complaint/info?complaint_id={{ $item['complaint_id'] }}">查看</a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td colspan="7">
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
