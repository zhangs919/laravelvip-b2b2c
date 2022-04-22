<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!-- <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th> -->
        <th class="text-c w80" data-sortname="rank_id">编号</th>
        <th class="w150" data-sortname="rank_name">等级名称</th>
        <th class="w120" data-sortname="discount">会员折扣</th>
        <th class="text-c w250" data-sortname="start_time">会员有效期</th>
        <th class="text-c w100" data-sortname="is_special">特殊会员等级</th>
        <th class="text-c w120" data-sortname="is_enable">是否启用</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <!-- <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->rank_id }}" />
        </td> -->
        <td class="text-c">{{ $v->rank_id }}</td>
        <td>{{ $v->rank_name }}</td>
        <td>{{ $v->discount }}折</td>
        <td class="text-c">
            @if($v->is_special == 1)
                @if($v->use_between == 0)
                    无限期
                @elseif($v->use_between == 1)
                    {{ $v->start_time }}~{{ $v->end_time }}
                @elseif($v->use_between == 2)
                    成为等级会员后{{ $v->valid_days }}天内有效
                @endif
            @else
                --
            @endif
        </td>
        <td class="text-c">@if($v->is_special == 1) √ @else -- @endif</td>
        <td class="text-c">
            @if($v->is_enable == 1)
                <span data-action="set-is-enable?id={{ $v->rank_id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-enable?id={{ $v->rank_id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->rank_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-rank-id="{{ $v->rank_id }}" data-rank-name="{{ $v->rank_name }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="7">
            <!-- <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="删除" />
            </div> -->
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
