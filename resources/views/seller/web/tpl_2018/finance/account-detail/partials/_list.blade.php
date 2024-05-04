<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th colspan="8" class="text-c handle bg-fff">
            <div class="balance m-t-0 m-b-0">
							<span>
								收入：
								<font class="ft-amount ft-in">0.00</font>
								元
							</span>
                <span>
								支出：
								<font class="ft-amount ft-out">0.00</font>
								元
							</span>
            </div>
        </th>
    </tr>
    </thead>
    <thead>
    <tr>
        <th data-sortname="">流水号</th>
        <th data-sortname="">账户变动时间</th>
        <th data-sortname="">分类</th>
        <th data-sortname="">名称/备注</th>
        <th data-sortname="">收入（元）</th>
        <th data-sortname="">支出（元）</th>
        <th data-sortname="">账户余额（元）</th>
        <th data-sortname="">支付方式</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
        <tr>
            <td>{{ $v['account_sn'] }}</td>
            <td>{{ $v['add_time'] }}</td>
            <td>{{ $v['trade_type'] }}</td>
            <td>{!! $v['note'] !!}</td>
            <td>
                {{ $v['amount'] }}
            </td>
            <td>
                <font class="c-red">{{ $v['amount'] }}</font>
            </td>
            <td>{{ $v['cur_balance'] }}</td>
            <td>{{ $v['payment_name'] }}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="8">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
