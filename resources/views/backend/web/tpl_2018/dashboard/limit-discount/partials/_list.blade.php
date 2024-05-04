<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w50">编号</th>
        <th class="w100">活动名称</th>
        <th class="w100">店铺名称</th>
        <th class="text-c w300">活动有效期</th>
        <th class="w150">活动标签</th>
        <th class="text-c w120">活动状态</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td>{{ $v['act_id'] }}</td>
        <td>{{ $v['act_name'] }}</td>
        <td>{{ $v['shop_name'] }}</td>
        <td class="text-c">
            {{ $v['start_time'] }}
            <br>
            ~
            <br>
            {{ $v['end_time'] }}
        </td>
        <td>{{ $v['act_label'] }}</td>
        <td class="text-c">
            <font class="{{ str_replace(['未开始','进行中','已结束'],['c-red','c-green','c-999'],$v['status_message']) }}">{{ $v['status_message'] }}</font>
        </td>
        <td class="handle">
            <a href="view?id={{ $v['act_id'] }}">查看</a>
        </td>
    </tr>
    @endforeach

    </tbody>

    <tfoot>
    <tr>
        <td colspan="7">
            <div class="pull-left"></div>
            <div class="pull-right page-box">

                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>
