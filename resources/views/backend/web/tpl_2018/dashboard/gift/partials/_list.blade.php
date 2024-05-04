<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" />
        </th>
        <th class="text-c w60">编号</th>
        <th class="w200">赠品活动名称</th>
        <th class="w100">店铺名称</th>
        <th class="text-c w200">赠品活动有效期</th>
        <th class="text-c w120">活动状态</th>
        <th class="text-c w120">已赠送</th>
        <th class="text-c w120">已领取</th>
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
        <td class="f13">{{ $v['act_name'] }}</td>
        <td>{{ $v['shop_name'] }}</td>
        <td class="text-c">
            {{ $v['start_time'] }}
            <br>
            ~
            <br>
            {{ $v['end_time'] }}
        </td>
        <td class="text-c">
            <font class="{{ str_replace(['未开始','进行中','已结束'],['c-red','c-green','c-999'],$v['status_message']) }}">{{ $v['status_message'] }}</font>
        </td>
        <td class="text-c">--</td>
        <td class="text-c">--</td>
        <td class="handle">
            <a href="edit?id={{ $v['act_id'] }}">编辑</a>
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
        <td colspan="8">
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
