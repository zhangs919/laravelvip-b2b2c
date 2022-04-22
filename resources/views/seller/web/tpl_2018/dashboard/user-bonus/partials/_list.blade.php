<table class="table table-hover" id="table_list">
    <thead>
    <tr>
        <th class="w80" data-sortname="user_bonus_id">编号</th>
        <th class="w200" data-sortname="bonus_sn">红包序号</th>
        <th class="w120" data-sortname="bonus_price">红包金额</th>
        <th data-sortname="bonus_type">红包类型</th>
        <th data-sortname="bonus_status">使用状态</th>
        <th data-sortname="user_name">会员</th>
        <th data-sortname="receive_time">领取时间</th>
        <th data-sortname="used_time">使用时间</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    @foreach($list as $v)
    <tr>
        <td>{{ $v['user_bonus_id'] }}</td>
        <td>
            {{ $v['bonus_sn'] }}

            <i class="c-yellow m-l-5 fa fa-exclamation-circle bonus-desc" data-bonus-desc="{{ $v['bonus_desc'] }}</br>起始时间：{{ $v['start_time_format'] }}</br>截至时间：{{ $v['end_time_format'] }}" style="cursor: pointer;"></i>

        </td>
        <td>{{ $v['bonus_price_format'] }}</td>
        <td>{{ $v['bonus_type_format'] }}</td>
        <td>
            <font class="c-red">未使用</font>
        </td>
        <td>{{ $v['user_name'] }}</td>
        <td>{{ $v['receive_time_format'] }}</td>
        <td>@if(empty($v['used_time']))—— ——@else{{ $v['used_time_format'] }}@endif</td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="8">
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>