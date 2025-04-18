<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w60">活动ID</th>
        <th class="w150">活动名称</th>
        <th class="text-c w150">活动有效时间</th>
        <th class="text-c w70">活动状态</th>
        <th class="text-c w100">砍价时限（时）</th>
        <th class="text-c w100">总发起砍价次数</th>
        <th class="text-c w80">帮砍次数</th>
        <th class="text-c w80">虚拟参与人数</th>
        <th class="text-c w80">商品数量</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
        <tr>
            <td class="text-c">{{ $v['act_id'] }}</td>
            <td class="">{{ $v['act_name'] }}</td>
            <td class="text-c">
                {{ $v['start_time'] }}
                <br>
                ~
                <br>
                {{ $v['end_time'] }}
            </td>
            <td class="text-c">
                <font class="{{ str_replace(['未开始','进行中','已结束'],['c-red','c-green','c-999'],$v['status']) }}">{{ $v['status_message'] }}</font>
            </td>
            <td class="text-c">{{ $v['bargain_time'] }}</td>
            <td class="text-c">{{ $v['total_bargain_num'] }}</td>
            <td class="text-c">{{ $v['total_help_bargain_num'] }}</td>
            <td class="text-c">{{ $v['total_virtual_num'] }}</td>
            <td class="text-c">{{ $v['goods_count'] }}</td>
            <td class="handle">
                <a href="view?act_id={{ $v['act_id'] }}" class="border-none">查看</a>
                <span>|</span>
                <span>|</span>
                <a href="shop-activity-goods-list?act_id={{ $v['act_id'] }}" data-id="{{ $v['act_id'] }}" class="goods-list">活动商品</a>
                @if($v['is_finish'] == 1)
                    <span>|</span>
                    <a href="javascript:void(0);" data-id="{{ $v['act_id'] }}" data-name="{{ $v['act_name'] }}" class="del end-activity">结束活动</a>
                @endif
                @if($v['is_finish'] == 2)
                    <span>|</span>
                    <a href="javascript:void(0);" data-id="{{ $v['act_id'] }}" data-name="{{ $v['act_name'] }}" class="del delete-activity">删除</a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="10">
            <div class="pull-left">
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
