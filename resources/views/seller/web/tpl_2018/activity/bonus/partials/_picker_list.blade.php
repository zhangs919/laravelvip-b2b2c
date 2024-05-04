<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c" data-sortname="brand_id">编号</th>
        <th data-sortname="bonus_name">红包名称</th>
        <th data-sortname="bonus_amount">红包金额</th>
        <th data-sortname="min_goods_amount">最小订单金额</th>
        <th data-sortname="start_time">开始时间</th>
        <th data-sortname="end_time">结束时间</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
        <tr>
            <td class="text-c">{{ $v->bonus_id }}</td>
            <td>{{ $v->bonus_name }}</td>
            <td>{{ $v->bonus_amount }}</td>
            <td>{{ $v->min_goods_amount }}</td>
            <td>{{ $v->start_time }}</td>
            <td>{{ $v->end_time }}</td>
            <td class="handle" id="handle_{{ $v->bonus_id }}">

                <a href="javascript:void(0);" data-bonus_id='{{ $v->bonus_id }}' data-bonus_name='{{ $v->bonus_name }}' data-bonus_amount='{{ $v->bonus_amount }}'
                   data-min_goods_amount='{{ $v->min_goods_amount }}' data-start_time='{{ $v->start_time }}' data-end_time='{{ $v->end_time }}'
                   class="select-bonus @if(in_array($v->bonus_id, $selected_ids)){{ 'active' }}@endif">
                    @if(in_array($v->bonus_id, $selected_ids)){{ '已选' }}@else{{ '选择' }}@endif
                </a>

            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="7">
            <div class="pull-right page-box">

                {{--分页--}}
                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>
