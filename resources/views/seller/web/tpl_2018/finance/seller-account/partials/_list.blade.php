<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th colspan="6" class="text-c handle bg-fff">
            <div class="balance f14 m-t-0 m-b-0">
							<span>
								收入：
								<font class="ft-amount ft-in">{{ $income }}</font>
								元
							</span>
                <span>
								支出：
								<font class="ft-amount ft-out">{{ $expend }}</font>
								元
							</span>
            </div>
        </th>
    </tr>
    <tr>
        <th class="w150" data-sortname="account_sn">流水号</th>
        <th class="w150" data-sortname="add_time">账户变动时间</th>
        <th class="w120" data-sortname="account_type">分类</th>
        <th class="w250" data-sortname="note">名称/备注</th>
        <th class="w120 text-c" data-sortname="amount">收入（元）</th>
        <th class="w100 text-c" data-sortname="status">状态</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>{{ $v['account_sn'] }}</td>
        <td>{{ format_time($v['add_time']) }}</td>
        <td>{{ format_seller_account_type($v['account_type']) }}</td>
        <td>
            <div class="ng-binding popover-box message">
                {!! $v['note'] !!}
                <div class="popover-info">
                    <i class="fa fa-caret-left"></i>
                    <ul>
                        <li>
                            <div class="dt">
                                <span></span>
                            </div>
                            <div class="dd">{!! $v['note'] !!}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </td>
        <td class="text-c">

            @if($v['amount'] >= 0)
                <font class="c-green">+{{ $v['amount'] }}</font>
            @else
                <font class="c-red">-{{ $v['amount'] }}</font>
            @endif

        </td>
        <td class="text-c">
            <font class="{{ str_replace([0,1,2,3],['c-green','c-green','c-999','c-green'], $v['status']) }}">{{ str_replace([0,1,2,3],['进行中','交易成功','交易关闭','退款成功'], $v['status']) }}</font>
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
