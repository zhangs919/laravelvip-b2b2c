<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th colspan="6" class="text-c handle bg-fff" style="cursor: default;">
            <div class="balance f14 m-t-0 m-b-0">

							<span>
								收入：
								<font class="ft-amount ft-in">{{ $income }}</font>
								元
							</span>

            </div>
        </th>
    </tr>
    <tr>
        <th class="w150" data-sortname="account_sn" data-sortorder="asc" style="cursor: pointer;">流水号<span class="sort"></span></th>
        <th class="w200" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">账户变动时间<span class="sort"></span></th>
        <th class="w120" data-sortname="account_type" data-sortorder="asc" style="cursor: pointer;">分类<span class="sort"></span></th>
        <th class="w200" data-sortname="note" data-sortorder="asc" style="cursor: pointer;">名称/备注<span class="sort"></span></th>
        <th class="w120" data-sortname="amount" data-sortorder="asc" style="cursor: pointer;">进账（元）<span class="sort"></span></th>

        <th class="w100" data-sortname="pay_name" data-sortorder="asc" style="cursor: pointer;">进账账户<span class="sort"></span></th>

    </tr>
    </thead>
    <tbody>

    @foreach($list as $item)
    <tr>
        <td>{{ $item->account_sn }}</td>
        <td>{{ $item->created_at }}</td>
        <td>{{ $item->account_type }}</td>
        <td>
            <div class="ng-binding popover-box message">
                {!! $item->note !!}
                <div class="popover-info">
                    <i class="fa fa-caret-left"></i>
                    <ul>
                        <li>
                            <div class="dd" style="max-width:250px;">{!! $item->note !!}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </td>
        <td>

            <font class="c-green">+{{ $item->amount }}</font>

        </td>
        <td>{{ $item->pay_name }}</td>
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
