<table class="table table-hover" id="table_list">
    <thead>
    <tr>
        <th class="w80" data-sortname="user_bonus_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="w200" data-sortname="bonus_sn" data-sortorder="asc" style="cursor: pointer;">红包序号<span class="sort"></span></th>
        <th class="w120" data-sortname="bonus_price" data-sortorder="asc" style="cursor: pointer;">红包金额<span class="sort"></span></th>
        <th data-sortname="bonus_type" data-sortorder="asc" style="cursor: pointer;">红包类型<span class="sort"></span></th>
        <th data-sortname="bonus_status" data-sortorder="asc" style="cursor: pointer;">使用状态<span class="sort"></span></th>
        <th data-sortname="user_name" data-sortorder="asc" style="cursor: pointer;">会员<span class="sort"></span></th>
        <th data-sortname="receive_time" data-sortorder="asc" style="cursor: pointer;">领取时间<span class="sort"></span></th>
        <th data-sortname="used_time" data-sortorder="asc" style="cursor: pointer;">使用时间<span class="sort"></span></th>
        <th class="text-c">操作</th>
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

        <td class="handle">

            {{--todo 具体操作按钮未知--}}
            <a href="/dashboard/user-bonus/unknown?bonus_id={{ $v['bonus_id'] }}">未知操作</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="9">
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>

