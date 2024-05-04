<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!-- 申请时间 -->
        <th data-sortname="apply_time">申请时间</th>
        <!-- 续签时长 -->
        <th data-sortname="">续签时长</th>
        <!-- 平台使用费（元） -->
        <th data-sortname="">平台使用费（元）</th>
        <!-- 续签起止有效期 -->
        <th data-sortname="">续签起止有效期</th>
        <!-- 付款状态 -->
        <th class="text-c"  data-sortname="">付款状态</th>
        <!-- 操作-->
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $item)
    <tr>
        <!-- 申请时间 -->
        <td>{{ format_time($item->apply_time) }}</td>
        <!-- 续签时长 -->
        <td>{{ $item->duration }}{{ str_replace([0,1,2], ['年','个月', '日'], $item->unit) }}</td>
        <!-- 平台使用费（元） -->
        <td>{{ $item->system_fee }}</td>
        <!-- 续签起止有效期 -->
        <td>{{ format_time(strtotime($item->begin_time), 'Y-m-d') }} ~ {{ format_time(strtotime($item->end_time), 'Y-m-d') }}</td>
        <!-- 付款状态 -->
        <td class="text-c" >

            @if($item->pay_status == 1)
            <font class="c-green">已付款</font>
            @else
                <font class="c-red">未付款</font>
            @endif
        </td>
        <!-- 操作 -->
        <td class="handle">

            @if($item->pay_status == 1)
                --
            @else
                <a href="javascript:void(0);" object_id="{{ $item->pay_id }}" class="del border-none">取消续签</a>
            @endif

        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>