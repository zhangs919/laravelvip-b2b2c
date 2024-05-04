<table id="table_list" class="table table-hover">
    <thead>

    <tr>
        <th colspan="10" class="text-c handle bg-fff" style="cursor: default;">
						<span class="f16 balance">
							待提现总额：
							<font class="ft-amount c-red">￥0.00</font>
						</span>
        </th>
    </tr>

    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
        </th>
        <th class="w100" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">申请时间<span class="sort"></span></th>
        <th class="w100" data-sortname="user_id" data-sortorder="asc" style="cursor: pointer;">会员名称<span class="sort"></span></th>
        <th class="w90" data-sortname="amount" data-sortorder="asc" style="cursor: pointer;">提现金额<span class="sort"></span></th>
        <th class="w250" data-sortname="account_id" data-sortorder="asc" style="cursor: pointer;">提现帐号<span class="sort"></span></th>
        <th class="w80" data-sortname="admin_user" data-sortorder="asc" style="cursor: pointer;">操作人<span class="sort"></span></th>
        <th class="w100" data-sortname="update_time" data-sortorder="asc" style="cursor: pointer;">操作时间<span class="sort"></span></th>
        <th class="w200" data-sortname="user_note" data-sortorder="asc" style="cursor: pointer;">用户留言<span class="sort"></span></th>
        <th class="w100 text-c" data-sortname="status" data-sortorder="asc" style="cursor: pointer;">提现状态<span class="sort"></span></th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $item->id }}">
            </td>
            <td>{{ $item->created_at }}</td>
            <td class="text-c">{{ $item->user->user_name ?? '' }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ $item->account_id }}</td>
            <td>{{ $item->admin_user }}</td>
            <td>{{ format_time($item->update_time) }}</td>
            <td>{{ $item->user_note }}</td>
            <td>{{ format_user_capital_status($item->status) }}</td>

            <td class="handle">
                @if($item->status == 0)
                    <a href="javascript:void(0);" data-id="{{ $item->id }}" class="examine">审核</a>
                @endif
                @if($item->status == 1)
                    <span>|</span>
                    <a href="javascript:void(0);" data-id="{{ $item->id }}" class="finish">转账</a>
                @endif
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
