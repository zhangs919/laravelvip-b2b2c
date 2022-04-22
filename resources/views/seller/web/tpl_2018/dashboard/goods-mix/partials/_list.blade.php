<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" />
        </th>
        <th class="text-c w50">编号</th>
        <th class="w200">套餐名称</th>
        <th class="text-c w200">套餐有效期</th>
        <th class="w150">套餐总价格</th>
        <th class="text-c w120">活动状态</th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkbox" value="{{ $v['act_id'] }}" />
        </td>
        <td class="text-c">{{ $v['act_id'] }}</td>
        <td>{{ $v['act_name'] }}</td>
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
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v['act_id'] }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" value="" />
        </td>
        <td colspan="6">
            <div class="pull-left">

                <input type="button" class="btn btn-danger m-r-2 delete-goods" value="批量删除" />
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>